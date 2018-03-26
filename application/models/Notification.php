<?php
class Notification extends CI_Model {
    public function __construct() {
        $this->load->database();
    }
    
    public function get_notifs($data = array()) {
        if (empty($data['m_id'])) {
            return array();
        }
        $notify_details = [
            'n_recipient'=> $data['m_id'],
        ];
        if (!empty($data['n_read'])) {
            $notify_details['n_read'] = $data['n_read'];
        }
        $this->db->from('notification')
                ->where($notify_details)
                ->order_by('n_created', "DESC");
        if (!empty($data['limit']) && is_integer($data['limit'])) {
            if ($data['limit'] < 0) {
                // Turn positive
                $data['limit'] += $data['limit']*2;
            }
            if ($data['limit'] !== 0) {
                $this->db->limit($data['limit']);
            }
        }
        $query = $this->db->get();
        return $query->result_array();
    }
}
