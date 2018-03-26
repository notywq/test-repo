<?php

class Address extends CI_Model {
    private $msg_error;
    
    public function __construct() {
        $this->load->database();
    }
    
    public function identify($data = array()) {
        if (empty($data['a_id'])) {
            return array ();
        }
        $query = $this->db->get_where('address', [
            'a_id' => $data['a_id']
        ]);
        return $query->row_array();
    }
    
    public function get_province($data = array()) {
        if (!empty($data['ac_id'])) {
            $this->db->select('a_province');
            $query = $this->db->get_where('address_city', [
                'ac_id'=>$data['ac_id']
            ]);
            $answer = $query->row_array();
            return $answer['a_province'];
        }
        $this->db->distinct();
        $this->db->select('a_province');
        $query = $this->db->get('address_city');
        return $query->result_array();
    }
    public function get_city($data = array()) {
        if (!empty($data['ac_id'])) {
            $this->db->select(['a_city']);
            $query = $this->db->get_where('address_city', [
                'ac_id'=>$data['ac_id']
            ]);
            $answer = $query->row_array();
            return $answer['a_city'];
        }
        else if (!empty($data['province'])) {
            $this->db->select(['ac_id','a_city']);
            $query = $this->db->get_where('address_city', [
                'a_province'=>$data['province']
            ]);
            return $query->result_array();
        }
        $this->db->select(['ac_id','a_city']);
        $query = $this->db->get('address_city');
        return $query->result_array();
    }
    public function get_myOffice($data = array()) {
        if (empty($data['m_id'])) {
            return array();
        }
        $query = $this->db->select('m_office')
                ->get_where('member', ['m_id'=>$data['m_id']]);
        if ($query->num_rows() == 1){
            $answer = $query->row_array();
            return $this->identify(['a_id'=>$answer['m_office']]);
        }
        return array();
    }
    public function get_myStore($data = array()) {
        if (empty($data['s_id'])) {
            return array();
        }
        $query = $this->db->select('s_address')
                ->get_where('store', ['s_id'=>$data['s_id']]);
        if ($query->num_rows() == 1){
            $answer = $query->row_array();
            return $this->identify(['a_id'=>$answer['s_address']]);
        }
        return array();
    }
    public function get_string($data = array()) {
        if (empty($data['a_id'])) {
            return "";
        }
        $query = $this->db->get_where('address', [
            'a_id' => $data['a_id']
        ]);
        if ($query->num_rows() == 1) {
            $output = "";
            $answer = $query->row_array();
            if (empty($data['pref']) || !is_string($data['pref']) || is_numeric($data['pref'])) {
                $data['pref'] = "a,c,p";
            }
            $pref = str_split($data['pref']);
            foreach ($pref as $p) {
                switch ($p) {
                    case 'a': {
                        $output .= $answer['a_address'];
                        break;
                    }
                    case 'c': {
                        $output .= $this->get_city(['ac_id'=>$answer['ac_id']]);
                        break;
                    }
                    case 'p': {
                        $output .= $this->get_province(['ac_id'=>$answer['ac_id']]);
                        break;
                    }
                    case ',': {
                        $output .= ',';
                        break;
                    }
                }
                $incoming = next($pref);
                if ($incoming !== false && $incoming !== ',') {
                    $output .= ' ';
                }
            }
            return $output;
        }
        return "Invalid address.";
    }
    
    public function get_msgError() {
        return $this->msg_error;
    }
}
