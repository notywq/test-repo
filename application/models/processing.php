<?php

class Processing extends CI_Model {
    private $msg_error;
    
    public function __construct() {
        $this->load->database();
    }
    
    public function create($data = array()) {
        $this->db->trans_start();
        
        // Check if they want a new address
        $timestamp = date('Y-m-d H:i:s');
        $delivery_address = $data['proc_address'];
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
        
        $process = [
            's_id'=>$data['s_id'],
            'proc_desc'=>$data['proc_desc'],
            'proc_activity'=>$data['proc_activity'],
            'proc_unitprice'=>$data['proc_unitprice'],
            'proc_open'=>$data['proc_open'],
            'proc_address'=>$delivery_address['a_id'],
            'proc_orderdays'=>$data['proc_orderdays'],
            'proc_minqty'=>$data['proc_minqty'],
            'proc_created'=>$timestamp,
            'proc_updated'=>$timestamp,
        ];
        $this->db->insert('processing', $process);
        
        $this->db->trans_complete();
        if ($this->db->trans_status() == TRUE) {
            $this->db->trans_commit();
            return true;
        }
        else {
            $this->db->trans_rollback();
            $this->msg_error = "Sorry, but we couldn't add your processor. Try again later.";
            return false;
        }
    }
    public function identify($data = array()) {
        if (empty($data['proc_id'])) {
            return array();
        }
        $query = $this->db->get_where('processing',['proc_id'=>$data['proc_id']]);
        if ($query->num_rows() == 1) {
            return $query->row_array();
        }
        return array();
    }
    
    public function get_procActivities($detail = false) {
        $what_to_get = ['proc_activity'];
        if ($detail) {
            array_push($what_to_get, 'procact_desc');
        }
        $query = $this->db->select($what_to_get)
                ->from('processing_activity')
                ->get();
        return $query->result_array();
    }
    public function get_procDetail($data = array()) {
        if (empty($data['proc_activity'])) {
            return "";
        }
        $query = $this->db->select('procact_desc')
                ->from('processing_activity')
                ->where('proc_activity',$data['proc_activity'])
                ->get();
        if ($query->num_rows() == 1) {
            $answer = $query->row_array();
            return $answer['procact_desc'];
        }
        return "";
    }
    public function get_myProcesses($data = array()) {
        if (empty($data['s_id'])){
            return array();
        }
        
        $query = $this->db->from('processing')
                ->where([
                    's_id'=>$data['s_id'],
                    'proc_open'=>1,
                ])
                ->order_by('proc_updated', 'desc')
                ->get();
        return $query->result_array();
    }
    public function get_theirProcesses($data = array()) {
        if (empty($data['m_id'])) {
            // Get everyone's beans
            $data['m_id'] = -1;
        }
        $query1 = $this->db->select('s_id')
                ->from('store')
                ->where('s_open', 0)    // TODO To be changed when a store CAN be opened
                ->where('m_id', $data['m_id'])
                ->get();
        $your_store = $query1->row_array();
        $query2 = $this->db->select('*')
                ->from('processing')
                ->where('proc_open', 1)
                ->where_in('s_id NOT', $your_store)
                ->get();
        
        return $query2->result_array();
    }
    
    public function get_msgError() {
        return $this->msg_error;
    }
	
	//Search
	
	public function get_someProcesses($data = array()) {
        if (empty($data['m_id'])) {
            // Get everyone's beans
            $data['m_id'] = -1;
        }
        $query1 = $this->db->select('s_id')
                ->from('store')
                ->where('s_open', 0)    // TODO To be changed when a store CAN be opened
                ->where('m_id', $data['m_id'])
                ->get();
        $your_store = $query1->row_array();
		
		$key = $data['key'];
				
		$query2 = $this->db->select('*')
				->from('processing')
				->join('store','processing.s_id = store.s_id','left')
				->join('address','proc_address = address.a_id','left')
				->join('address_city','address.ac_id = address_city.ac_id','left')
				->where('proc_open', 1)
				->group_start()
					->or_like('a_address',$key)
					->or_where('a_city',$key)
					->or_where('s_name',$key)
					->or_where('a_province',$key)
					->or_where('proc_activity',$key)
					->or_where('proc_unitprice',$key)
					->or_like('proc_desc', $key)
				->group_end()
				->where_in('processing.s_id NOT', $your_store)
				->group_by('processing.proc_id')
				->get();
        
        return $query2->result_array();
    }
	
	public function get_advProcesses($data = array()) {
        if (empty($data['m_id'])) {
            // Get everyone's beans
            $data['m_id'] = -1;
        }
		
		$key = $data['key'];
		$sort = $data['sort'];
		$sortkey = "";
		$sortorder = "";
		
		switch ($sort) 
		{
			case "1":
				$sortkey = "proc_created";
				$sortorder = "desc";
				break;
			case "2":
				$sortkey = "proc_created";
				$sortorder = "asc";
				break;
			case "3":
				$sortkey = "proc_unitprice";
				$sortorder = "asc";
				break;
			case "4":
				$sortkey = "proc_unitprice";
				$sortorder = "desc";
				break;
			case "5":
				$sortkey = "proc_activity";
				$sortorder = "asc";
				break;
			case "6":
				$sortkey = "proc_activity";
				$sortorder = "desc";
				break;
		}
        $query1 = $this->db->select('s_id')
                ->from('store')
                ->where('s_open', 0)    // TODO To be changed when a store CAN be opened
                ->where('m_id', $data['m_id'])
                ->get();
        $your_store = $query1->row_array();
		
		if(empty($key))
		{
			$query2 = $this->db->select('*')
                ->from('processing')
                ->where('proc_open', 1)
                ->where_in('s_id NOT', $your_store)
				->order_by($sortkey,$sortorder)
                ->get();
		}
		else
		{
			$query2 = $this->db->select('*')
                ->from('processing')
				->join('store','processing.s_id = store.s_id','left')
				->join('address','proc_address = address.a_id','left')
				->join('address_city','address.ac_id = address_city.ac_id','left')
                ->where('proc_open', 1)
				->where($key)
                ->where_in('s_id NOT', $your_store)
				->group_by('processing.proc_id')
				->order_by($sortkey,$sortorder)
                ->get();
		}
        
        return $query2->result_array();
    }
}