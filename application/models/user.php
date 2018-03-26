<?php

class User extends CI_Model {
    private $m_id;
    private $u_name;
    
    private $msg_error;
    
    public function __construct() {
        $this->load->database();
    }
    public function get_theirUName($data = array()) {
        $this->db->select('u_name');
        $query = $this->db->get_where('user', [
            'm_id'=>$data['m_id'],
        ]);
        $user = $query->row_array();
        return $user['u_name'];
    }
    public function get_number($data = array()) {
        if (empty($data['m_id'])) {
            return "";
        }
        if (empty($data['desired'])) {
            $data['desired'] = "cell";
        }
        switch ($data['desired']) {
            case 'tel': {
                $this->db->select('u_telno');
                break;
            }
            case 'cell':
            default : {
                $data['desired'] = "cell";
                $this->db->select('u_cellno');
                break;
            }
        }
        $this->db->from('user');
        $this->db->where('m_id',$data['m_id']);
        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            $answer = $query->row_array();
            switch ($data['desired']) {
                case 'tel': {
                    return $answer['u_telno'];
                    break;
                }
                case 'cell':
                default : {
                    return $answer['u_cellno'];
                    break;
                }
            }
        }
        else {
            return "Number not found.";
        }
    }
    
    public function authorize($data = array()) {
        $this->db->select('m_id, u_name');
        $query = $this->db->get_where('user', [
            'u_name'=>$data['u_name'],
            'u_pw'=>$data['u_pw']
        ]);
        if ($query->num_rows() == 1) {
            return $query->row_array();
        }
        $this->msg_error = "Your username or password may be incorrect. Please check "
                . "it.";
        return false;
    }
    public function create($data = array()) {
        // TODO Encrypt the password from here
        $this->db->trans_start();
        
        // 1. Insert into `address` table
        $timestamp = date('Y-m-d H:i:s');
        $address = [
            'ac_id'=>$data['ac_id'],
            'a_address'=>$data['a_address'],
            'a_created'=>$timestamp
        ];
        $this->db->insert('address', $address);
        
        // 2. Insert into `member` table
        $that_address_id = $this->db->insert_id();
        $member = [
            'm_fname'=>$data['m_fname'],
            'm_mname'=>$data['m_mname'],
            'm_lname'=>$data['m_lname'],
            'm_created'=>$timestamp,
            'm_updated'=>$timestamp,
            'm_office'=>$that_address_id
        ];
        $this->db->insert('member', $member);
        
        // 3. Insert into `user` table
        $that_member_id = $this->db->insert_id();
        $user=[
            'm_id'=>$that_member_id,
            'u_cellno'=>$data['u_cellno'],
            'u_name'=>$data['u_name'],
            'u_pw'=>$data['u_pw'],
            'u_created'=>$timestamp,
            'u_updated'=>$timestamp
        ];
        $this->db->insert('user', $user);
        
        $this->db->trans_complete();
        
        if ($this->db->trans_status() == TRUE) {
            $this->db->trans_commit();
            $this->m_id = $user['m_id'];
            $this->u_name = $user['u_name'];
            return true;
        }
        else {
            $this->db->trans_rollback();
            $this->msg_error = "That username is already taken. Write a different "
                    . "one.";
            return false;
        }
    }
    public function identify($data = array()) {
        $user = [];
        if (!empty($data['m_id'])) {
            $user['m_id'] = $data['m_id'];
        }
        if (!empty($data['username'])) {
            $user['u_name'] = $data['username'];
        }
        $query = $this->db->get_where('user',$user);
        if ($query->num_rows() == 1) {
            return $query->row_array();
        }
        return array();
    }
    
    public function get_mID() {
        return $this->m_id;
    }
    public function get_uName() {
        return $this->u_name;
    }
    public function get_msgError() {
        return $this->msg_error;
    }
}
