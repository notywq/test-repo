<?php

class Request_processing extends CI_Model {
    private $status_tickers = [
        0=>"Added new request",
        1=>"Negotiation ongoing",
        2=>"Placed new order",
        3=>"Delivery ongoing",
        4=>"Received order",
        5=>"Completed order",
        6=>"Rejected order",
        7=>"Canceled order",
    ];
    private $progress_statuses = [
        0,1,2,3,4
    ];
    private $progress_statuses_seller = [
        0, // SELLER evals the order
        2, // SELLER prepares the tracking information, if any, before sending
        4, // SELLER confirms payment from the customer
    ];
    private $progress_statuses_buyer = [
        1, // BUYER negotiates a change from what the seller gave
        3, // BUYER confirms the arrival of their product
    ];
    private $event_statuses = [
        5,6,7
    ];
    private $request_type = 'proc';
    private $msg_error;
    
    public function __construct() {
        $this->load->database();
    }
    
    public function create($data = array()) {
        if (empty($data['proc_id'])) {
            $this->msg_error = "Sorry, but we couldn't find the processor for your "
                    . "request. Try again later.";
            return false;
        }
        
        $timestamp = date('Y-m-d H:i:s');
        $proc_reference = $this->processing->identify(['proc_id'=>$data['proc_id']]);
        
        $minimum_quantity = $proc_reference['proc_minqty'];
        if (round($data['rproc_quantity']) < $minimum_quantity) {
            $this->msg_error = "Your desired quantity does not meet the "
                    . "minimum required.";
            return false;
        }
        
        $datetime1 = new DateTime($timestamp);
        $datetime2 = new DateTime($data['rproc_duedate']);
        $interval = $datetime1->diff($datetime2);
        $datediffdays = $interval->format('%r%d');
        if ($datediffdays < 0) {
            $this->msg_error = "Please choose a date at least "
                    .$proc_reference['proc_orderdays']." days from now.";
            return false;
        }
        if ($datediffdays < $proc_reference['proc_orderdays']) {
            $lacking_days = $proc_reference['proc_orderdays']-$datediffdays;
            $this->msg_error = "Valid due dates start ".$lacking_days." days "
                    . "from your input.";
            return false;
        }
        
        $this->db->trans_start();
        
        // 0. Check if they want a new address
        $delivery_address = $data['rproc_deliverto'];
        if (empty($delivery_address['a_id'])) {
            $address = [
                'ac_id'=>$delivery_address['ac_id'],
                'a_address'=>$delivery_address['a_address'],
                'a_created'=>$timestamp
            ];
            $this->db->insert('address', $address);
            if ($this->db->affected_rows() === 1) {
                $delivery_address['a_id'] = $this->db->insert_id();
            }
        }
        else {
            // Needed for request_history
            $address_id = $delivery_address['a_id'];
            $delivery_address = $this->address->identify([
                'a_id'=>$address_id
            ]);
        }
        
        // 1. Insert into request_processing
        $refund = 0.00;
        $request_proc = [
            'proc_id'=>$data['proc_id'],
            'rproc_procnotes'=>$data['rproc_procnotes'],
            'rproc_quantity'=>$data['rproc_quantity'],
            'rproc_duedate'=>$data['rproc_duedate'],
            'rproc_deliverto'=>$delivery_address['a_id'],
            'rproc_delivernotes'=>$data['rproc_delivernotes'],
            's_id'=>$data['s_id'],
            'm_id'=>$data['m_id'],
            'rproc_status'=>$data['rproc_status'],
            'rproc_refund'=>$refund,
            'rproc_created' => $timestamp,
            'rproc_updated' => $timestamp,
        ];
        $this->db->insert('request_processing', $request_proc);
        
        // 2. Insert into request_history
        $that_request_id = $this->db->insert_id();
        $that_process = $this->processing->identify(['proc_id'=>$data['proc_id']]);
        
        $store = $this->store->identify(['s_id'=>$data['s_id']]);
        if (empty($store['s_editdays'])) {
            $store['s_editdays'] = "0";
        }
        if (empty($store['s_returndays'])) {
            $store['s_returndays'] = "0";
        }
        $those_store_rules = [
            "s_editdays"=>$store['s_editdays'],
            "s_returndays"=>$store['s_returndays'],
        ];
        
        $that_request = array_merge($request_proc, $that_process,
                $those_store_rules, $delivery_address);
        $this->order_record([
            'request_id'=>$that_request_id,
            'timestamp'=>$timestamp,
            'type'=> $this->request_type,
            'concerned'=>$that_request,
        ]);
        unset($that_request);
        
        // 3. Insert into notifications (no need to read status)
        $fName = $this->member->get_name([
            'm_id'=>$data['m_id'],
            'pref'=>'f'
        ]);
        $link_fName = preg_replace('/\s+/', '_', $fName);
        $link_sName = preg_replace('/\s+/', '_', $store['s_name']);
        $link_id = preg_replace('/\s+/', '_', $that_request_id);
        $order_link = 'orders/proc/'.html_escape($link_fName.
                "+".$link_sName.
                "+".$link_id);
        $owner = $this->member->find_owner([
            's_id'=>$data['s_id']
        ]);
        $sms_problem = $this->notify_record([
            'request_id'=>$that_request_id,
            'recipient_id'=>$owner['m_id'],
            'status'=>0,
            'slug'=>$order_link,
            'timestamp'=>$timestamp,
        ]);
        
        $this->db->trans_complete();
        if ($this->db->trans_status() == TRUE && $sms_problem === 0) {
            $this->db->trans_commit();
            return true;
        }
        else if ($this->db->trans_status() == TRUE && $sms_problem !== 0) {
            $this->db->trans_commit();
            $this->msg_error = "Your request was successfully sent, but the "
                    . "system could not inform the recipient. You may message "
                    . "them instead."
                    . "<br /><br />".$sms_problem;
            return true;
        }
        else {
            $this->db->trans_rollback();
            if (empty($this->msg_error)) {
                $this->msg_error = "Sorry, but we couldn't send your request. "
                        . "Try again later.";
            }
            return false;
        }
    }
    public function identify($data = array()) {
        if (empty($data['rproc_id'])) {
            // No.
            return array ();
        }
        $query = $this->db->get_where('request_processing', [
            'rproc_id' => $data['rproc_id']
        ]);
        return $query->row_array();
    }
    
    public function get_myRequests($data = array()) {
        if (empty($data['m_id']) && empty($data['s_id'])) {
            return array();
        }
        $used_member = !empty($data['m_id']);
        $used_store = !empty($data['s_id']);
        
        $this->db->from('request_processing');
        if ($used_member) {
            $this->db->where([
                'm_id'=>$data['m_id']
                    ]);    
        }
        else if ($used_store) {
            $this->db->where([
                's_id'=>$data['s_id']
                    ]);
        }
        $query = $this->db
                ->where_in('rproc_status', $this->progress_statuses)
                ->order_by('rproc_updated', 'DESC')
                ->get();
        return $query->result_array();
    }
    public function get_allMyRequests($data = array()) {
        if (empty($data['m_id']) && empty($data['s_id'])) {
            return array();
        }
        $used_member = !empty($data['m_id']);
        $used_store = !empty($data['s_id']);
        
        $this->db->from('request_processing');
        if ($used_member) {
            $this->db->where([
                'm_id'=>$data['m_id']
                    ]);    
        }
        else if ($used_store) {
            $this->db->where([
                's_id'=>$data['s_id']
                    ]);
        }
        $query = $this->db
                ->order_by('rproc_updated', 'DESC')
                ->get();
        return $query->result_array();
    }
    public function get_thatStatus($data = array()) {
        if (!isset($data['rproc_status']) || !isset($data['is_seller'])) {
            return 'Invalid status';
        }
        $query = $this->db->get_where('request_processing_status', [
            'rproc_status' => $data['rproc_status']
        ]);
        $prefix = '';
        if ($data['is_seller'] == true) {
            $prefix = 's';
        }
        else {
            $prefix = 'm';
        }
        $answer = $query->row_array();
        return $answer['rproc_'.$prefix.'desc'];
    }
    public function get_thatShip ($data = array()) {
        if (empty($data['rproc_id'])) {
            return false;
        }
        $query = $this->db->get_where('request_processing_shipping', [
            'rproc_id' => $data['rproc_id']
        ]);
        if ($query->num_rows() == 1) {
            return $query->row_array();
        }
        return array();
    }
    
    public function eval_order ($data = array()) {
        if (!isset($data['rproc_status']) || empty($data['rproc_id']) || empty($data['m_id'])) {
            return false;
        }
        $refund = 0.00;
        if (isset($data['rproc_refund'])) {
            $refund = $data['rproc_refund'];
        }
        $this->db->trans_start();
        
        $that_request_id = $data['rproc_id'];
        $timestamp = date('Y-m-d H:i:s');
        $request_update = [
            'rproc_status' => $data['rproc_status'],
            'rproc_updated' => $timestamp,
        ];
        if ($refund > 0.00) {
            $request_update['rproc_refund'] = $refund;
        }
        $this->db->where('rproc_id', $data['rproc_id']);
        $this->db->update('request_processing', $request_update);
        $this->order_record([
            'request_id'=>$that_request_id,
            'timestamp'=>$timestamp,
            'type'=> $this->request_type,
            'concerned'=>$request_update,
        ]);
        
        $recipient = "";
        $request_self = $this->identify(['rproc_id'=>$that_request_id]);
        $is_buyer = $request_self['m_id'] == $data['m_id'];
        if ($is_buyer) {
            $recipient = $this->member->find_owner([
                's_id'=>$request_self['s_id']
            ]);
        }
        else {
            $recipient = $this->member->identify([
                'm_id'=>$request_self['m_id']
            ]);
        }
        $fName = $this->member->get_name([
            'm_id'=>$request_self['m_id'],
            'pref'=>'f'
        ]);
        $store = $this->store->identify([
            's_id'=>$request_self['s_id'],
        ]);
        $link_fName = preg_replace('/\s+/', '_', $fName);
        $link_sName = preg_replace('/\s+/', '_', $store['s_name']);
        $link_id = preg_replace('/\s+/', '_', $that_request_id);
        $order_link = 'orders/proc/'.html_escape($link_fName.
                "+".$link_sName.
                "+".$link_id);
        $sms_problem = $this->notify_record([
            'request_id'=>$that_request_id,
            'recipient_id'=>$recipient['m_id'],
            'status'=>$data['rproc_status'],
            'slug'=>$order_link,
            'timestamp'=>$timestamp,
        ]);
        
        $this->db->trans_complete();
        if ($this->db->trans_status() == TRUE && $sms_problem === 0) {
            $this->db->trans_commit();
            return true;
        }
        else if ($this->db->trans_status() == TRUE && $sms_problem !== 0) {
            $this->db->trans_commit();
            $this->msg_error = "Your evaluation was successfully sent, but the "
                    . "system could not inform the recipient. You may message "
                    . "them instead."
                    . "<br /><br />".$sms_problem;
            return true;
        }
        else {
            $this->db->trans_rollback();
            if (empty($this->msg_error)) {
                $this->msg_error = "Sorry, but we couldn't send your request. "
                        . "Try again later.";
            }
            return false;
        }
    }
    public function nego_order ($data = array()) {
        if (!isset($data['rproc_status']) || empty($data['rproc_id']) || empty($data['m_id'])) {
            return false;
        }
        
        $timestamp = date('Y-m-d H:i:s');
        $request_reference = $this->request_processing->identify(['rproc_id'=>$data['rproc_id']]);
        $proc_reference = $this->processing->identify(['proc_id'=>$request_reference['proc_id']]);
        
        $minimum_quantity = $proc_reference['proc_minqty'];
        if (round($data['rproc_quantity']) < $minimum_quantity) {
            $this->msg_error = "Your desired quantity does not meet the "
                    . "minimum required.";
            return false;
        }
        
        $datetime1 = new DateTime($request_reference['rproc_created']);
        $datetime2 = new DateTime($data['rproc_duedate']);
        $interval = $datetime1->diff($datetime2);
        $datediffdays = $interval->format('%r%d');
        $original_orderdays = $this->request_history->get_entry([
            'request_id'=>$request_reference['rproc_id'],
            'type'=>$this->request_type,
            'inquiry'=>'proc_orderdays',
            'timestamp'=>$request_reference['rproc_created'],
        ]);
        if ($datediffdays < 0) {
            $this->msg_error = "Please choose a date at least "
                    .$proc_reference['proc_orderdays']." days from now.";
            return false;
        }
        if ($datediffdays < $original_orderdays) {
            $lacking_days = $proc_reference['proc_orderdays']-$datediffdays;
            $this->msg_error = "Valid due dates start ".$lacking_days." days "
                    . "from your input.";
            return false;
        }
        
        $this->db->trans_start();
        
        // 0. Check if they want a new address
        $delivery_address = $data['rproc_deliverto'];
        if (empty($delivery_address['a_id'])) {
            $address = [
                'ac_id'=>$delivery_address['ac_id'],
                'a_address'=>$delivery_address['a_address'],
                'a_created'=>$timestamp
            ];
            $this->db->insert('address', $address);
            if ($this->db->affected_rows() === 1) {
                $delivery_address['a_id'] = $this->db->insert_id();
            }
        }
        else {
            // Needed for request_history
            $address_id = $delivery_address['a_id'];
            $delivery_address = $this->address->identify([
                'a_id'=>$address_id
            ]);
        }
        
        $that_request_id = $data['rproc_id'];
        $request_update = [
            'rproc_procnotes'=>$data['rproc_procnotes'],
            'rproc_quantity'=>$data['rproc_quantity'],
            'rproc_duedate'=>$data['rproc_duedate'],
            'rproc_deliverto'=>$delivery_address['a_id'],
            'rproc_delivernotes'=>$data['rproc_delivernotes'],
            'rproc_status'=>$data['rproc_status'],
            'rproc_updated' => $timestamp,
        ];
        $this->db->where('rproc_id', $data['rproc_id']);
        $this->db->update('request_processing', $request_update);
        $request_update_history = array_merge($request_update, $delivery_address);
        $this->order_record([
            'request_id'=>$that_request_id,
            'timestamp'=>$timestamp,
            'type'=> $this->request_type,
            'concerned'=>$request_update_history,
        ]);
        
        $recipient = "";
        $request_self = $this->identify(['rproc_id'=>$that_request_id]);
        $is_buyer = $request_self['m_id'] == $data['m_id'];
        if ($is_buyer) {
            $recipient = $this->member->find_owner([
                's_id'=>$request_self['s_id']
            ]);
        }
        else {
            $recipient = $this->member->identify([
                'm_id'=>$request_self['m_id']
            ]);
        }
        $fName = $this->member->get_name([
            'm_id'=>$request_self['m_id'],
            'pref'=>'f'
        ]);
        $store = $this->store->identify([
            's_id'=>$request_self['s_id'],
        ]);
        $link_fName = preg_replace('/\s+/', '_', $fName);
        $link_sName = preg_replace('/\s+/', '_', $store['s_name']);
        $link_id = preg_replace('/\s+/', '_', $that_request_id);
        $order_link = 'orders/proc/'.html_escape($link_fName.
                "+".$link_sName.
                "+".$link_id);
        $sms_problem = $this->notify_record([
            'request_id'=>$that_request_id,
            'recipient_id'=>$recipient['m_id'],
            'status'=>1,
            'slug'=>$order_link,
            'timestamp'=>$timestamp,
        ]);
        
        $this->db->trans_complete();
        if ($this->db->trans_status() == TRUE && $sms_problem === 0) {
            $this->db->trans_commit();
            return true;
        }
        else if ($this->db->trans_status() == TRUE && $sms_problem !== 0) {
            $this->db->trans_commit();
            $this->msg_error = "Your negotiation was successfully sent, but the "
                    . "system could not inform the recipient. You may message "
                    . "them instead."
                    . "<br /><br />".$sms_problem;
            return true;
        }
        else {
            $this->db->trans_rollback();
            if (empty($this->msg_error)) {
                $this->msg_error = "Sorry, but we couldn't send your request. "
                        . "Try again later.";
            }
            return false;
        }
    }
    public function send_order ($data = array()) {
        if (!isset($data['rproc_status']) || empty($data['rproc_id']) || empty($data['m_id'])) {
            return false;
        }
        $this->db->trans_start();
        $timestamp = date('Y-m-d H:i:s');
        $that_request_id = $data['rproc_id'];
        
        $request_processing_shipping = [
            'rproc_id' => $data['rproc_id'],
            'rprocsh_courier' => $data['rprocsh_courier'],
            'rprocsh_trackno' => $data['rprocsh_trackno'],
        ];
        $this->db->insert('request_processing_shipping', $request_processing_shipping);
        $this->order_record([
            'request_id'=>$that_request_id,
            'timestamp'=>$timestamp,
            'type'=> $this->request_type,
            'concerned'=>$request_processing_shipping,
        ]);
        
        $request_update = [
            'rproc_status'=>$data['rproc_status'],
            'rproc_updated' => $timestamp,
        ];
        $this->db->where('rproc_id', $data['rproc_id']);
        $this->db->update('request_processing', $request_update);
        $this->order_record([
            'request_id'=>$that_request_id,
            'timestamp'=>$timestamp,
            'type'=> $this->request_type,
            'concerned'=>$request_update,
        ]);
        
        $recipient = "";
        $request_self = $this->identify(['rproc_id'=>$that_request_id]);
        $is_buyer = $request_self['m_id'] == $data['m_id'];
        if ($is_buyer) {
            $recipient = $this->member->find_owner([
                's_id'=>$request_self['s_id']
            ]);
        }
        else {
            $recipient = $this->member->identify([
                'm_id'=>$request_self['m_id']
            ]);
        }
        $fName = $this->member->get_name([
            'm_id'=>$request_self['m_id'],
            'pref'=>'f'
        ]);
        $store = $this->store->identify([
            's_id'=>$request_self['s_id'],
        ]);
        $link_fName = preg_replace('/\s+/', '_', $fName);
        $link_sName = preg_replace('/\s+/', '_', $store['s_name']);
        $link_id = preg_replace('/\s+/', '_', $that_request_id);
        $order_link = 'orders/proc/'.html_escape($link_fName.
                "+".$link_sName.
                "+".$link_id);
        $sms_problem = $this->notify_record([
            'request_id'=>$that_request_id,
            'recipient_id'=>$recipient['m_id'],
            'status'=>$data['rproc_status'],
            'slug'=>$order_link,
            'timestamp'=>$timestamp,
        ]);
        
        $this->db->trans_complete();
        if ($this->db->trans_status() == TRUE && $sms_problem === 0) {
            $this->db->trans_commit();
            return true;
        }
        else if ($this->db->trans_status() == TRUE && $sms_problem !== 0) {
            $this->db->trans_commit();
            $this->msg_error = "The processed beans were successfully sent, but the "
                    . "system could not inform the recipient. You may message "
                    . "them instead."
                    . "<br /><br />".$sms_problem;
            return true;
        }
        else {
            $this->db->trans_rollback();
            if (empty($this->msg_error)) {
                $this->msg_error = "Sorry, but we couldn't send your request. "
                        . "Try again later.";
            }
            return false;
        }
    }
    
    private function order_record($data = array()) {
        // TODO Use this for other creations and updates on other requests
        if (!empty($data['request_id']) && !empty($data['concerned'])) {
            $request_id = $data['request_id'];
            if (!empty($data['timestamp'])) {
                $timestamp = $data['timestamp'];
            }
            else {
                $timestamp = date('Y-m-d H:i:s');
            }
            if (!empty($data['request_type'])) {
                $request_type = $data['type'];
            }
            else {
                $request_type = $this->request_type;
            }
            
            $array_concerned = $data['concerned'];
            $request_keys = array_keys($array_concerned);
            foreach ($request_keys as $request_key) {
                $request_history = [
                    'rh_reqid' => $request_id,
                    'rh_type' => $request_type,
                    'rh_changecol' => $request_key,
                    'rh_changeval' => $array_concerned[$request_key],
                    'rh_created' => $timestamp,
                ];
                $this->db->insert('request_history',$request_history);
            }
            return true;
        }
        return false;
    }
    private function notify_record($data = array()) {
        if (!empty($data['request_id'])
                && !empty($data['recipient_id'])
                && isset($data['status'])
                ) {
            $timestamp = date('Y-m-d H:i:s');
            if (!empty($data['timestamp'])) {
                $timestamp = $data['timestamp'];
            }
            $notify_request = [
                'n_recipient' => $data['recipient_id'],
                'n_slug' => $data['slug'],
                'n_type' => 'request',
                'n_ticker' => $this->status_tickers[$data['status']],
                'n_read' => 0,
                'n_created' => $timestamp,
            ];
            $this->db->insert('notification', $notify_request);
            $notify_request['n_id'] = $this->db->insert_id();
            return $this->smsitexmo->notify_sms($notify_request);
        }
        return false;
    }
    
    public function get_progressStatuses($data = array()) {
        if (!isset($data['is_seller'])) {
            return $this->progress_statuses;
        }
        if ($data['is_seller'] == true) {
            return $this->progress_statuses_seller;
        } else {
            return $this->progress_statuses_buyer;
        }
    }
    public function get_eventStatuses() {
        return $this->event_statuses;
    }
    public function get_msgError() {
        return $this->msg_error;
    }
}
