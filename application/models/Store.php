<?php

class Store extends CI_Model {
    private $msg_error;
    
    public function __construct() {
        $this->load->database();
    }
    
    public function identify($data = array()) {
        $used_store = false;
        $used_member = false;
        if (!empty($data['s_id'])) {
            $used_store = $data['s_id'];
        }
        if (!empty($data['m_id'])) {
            $used_member = $data['m_id'];
        }
        
        $used = [];
        if (!empty($used_store)) {
            $used = ['s_id'=>$data['s_id']];
        }
        else if (!empty($used_member)) {
            $used = ['m_id'=>$data['m_id']];
        }
        else {
            return false;
        }
        
        $query = $this->db->get_where('store', $used);
        if ($query->num_rows() == 1) {
            return $query->row_array();
        }
        return false;
    }
    public function track($data = array()) {
        $this->db->select('s_id');
        $query = "";
        if (!empty($data['b_id'])) {
            $query = $this->db->get_where('beans', [
                'b_id' => $data['b_id']
            ]);
        }
        else if (!empty($data['pk_id'])) {
            $query = $this->db->get_where('package', [
                'pk_id' => $data['pk_id']
            ]);
        }
        else if (!empty($data['proc_id'])) {
            $query = $this->db->get_where('processing', [
                'proc_id' => $data['proc_id']
            ]);
        }
        else if (!empty($data['ro_id'])) {
            $query = $this->db->get_where('roast', [
                'ro_id' => $data['ro_id']
            ]);
        }
        
        $source_offer = $query->row_array();
        
        $query2 = $this->db->get_where('store', [
            's_id' => $source_offer['s_id']
        ]);
        if ($query2->num_rows() == 1) {
            return $query2->row_array();
        }
        return false;
    }
    
    public function create($data = array()) {
        $this->db->trans_start();
        
        // 0. Check if they want a new address
        $timestamp = date('Y-m-d H:i:s');
        $store_address = $data['s_address'];
        if (empty($store_address['a_id'])) {
            $address = [
                'ac_id'=>$store_address['ac_id'],
                'a_address'=>$store_address['a_address'],
                'a_created'=>$timestamp
            ];
            $this->db->insert('address', $address);
            if ($this->db->affected_rows() === 1) {
                $store_address['a_id'] = $this->db->insert_id();
            }
        }
        
        // 1. Insert into store table
        if (empty($data['s_orderdays'])) {
            $data['s_orderdays']="0";
        }
        if (empty($data['s_editdays'])) {
            $data['s_editdays']="0";
        }
        if (empty($data['s_orderdays'])) {
            $data['s_returndays']="0";
        }
        $store = [
            's_name' => $data['s_name'],
            'm_id' => $data['m_id'],
            's_address' => $store_address['a_id'],
            's_open' => 0,
            's_desc' => $data['s_desc'],
            's_rules' => $data['s_rules'],
            's_orderdays' => $data['s_orderdays'],
            's_editdays' => $data['s_editdays'],
            's_returndays' => $data['s_returndays'],
            's_created' => $timestamp,
            's_updated' => $timestamp,
        ];
        $this->db->insert('store',$store);
        
        $this->db->trans_complete();
        
        if($this->db->trans_status() == TRUE) {
            $this->db->trans_commit();
            $this->s_id=$this->db->insert_id();
            $this->s_name=$data['s_name'];
            return true;
        }
        else {
            $this->db->trans_rollback();
            $this->msg_error = "We're sorry this didn't work. We'll take note "
                    . "of this, so in the meantime please try again later.";
            return false;
        }
    }
    
    public function get_msgError() {
        return $this->msg_error;
    }
}
