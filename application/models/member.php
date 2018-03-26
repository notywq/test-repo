<?php

class Member extends CI_Model {
    
    public function __construct() {
        $this->load->database();
    }
    
    public function identify($data = array()) {
        if (!empty($data['username']) && empty($data['m_id'])) {
            $that_user = $this->user->identify(['username'=>$data['username']]);
            $data['m_id'] = $that_user['m_id'];
            unset($that_user);
        }
        $query=$this->db->get_where('member', [
            'm_id' => $data['m_id']
        ]);
        if ($query->num_rows() == 1) {
            return $query->row_array();
        }
        return array();
    }
    public function find_owner($data = array()) {
        $query = $this->db->get_where('store', [
            's_id' => $data['s_id']
        ]);
        if ($query->num_rows() == 1) {
            $answer = $query->row_array();
            return $this->identify([
                'm_id' => $answer['m_id']
            ]);
        }
        return array();
    }
    
    public function get_name($data = array()) {
        if (empty($data['m_id'])) {
            return "";
        }
        $query=$this->db
                ->from('member')
                ->where('m_id',$data['m_id'])
                ->get();
        if ($query->num_rows() == 1) {
            $response = $query->row_array();
            $answer = "";
            if (empty($data['pref'])) {
                $data['pref'] = "fml";
            }
            $preference = str_split($data['pref'], 1);
            $linked_characters = ['f','m','l'];
            foreach ($preference as $pref) {
                switch ($pref) {
                    case 'f': {
                        $answer .= $response['m_fname'];
                        break;
                    }
                    case 'm': {
                        $answer .= $response['m_mname'];
                        break;
                    }
                    case 'l': {
                        $answer .= $response['m_lname'];
                        break;
                    }
                    default: {
                        $answer .= html_escape($pref);
                        break;
                    }
                }
                $next_char = next($preference);
                if ($next_char !== FALSE && in_array($pref, $linked_characters)) {
                    $answer .= " ";
                }
            }
            return $answer;
        }
        return "";
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
                $this->db->select('m_telno');
                break;
            }
            case 'cell':
            default : {
                $data['desired'] = "cell";
                $this->db->select('m_cellno');
                break;
            }
        }
        $this->db->from('member');
        $this->db->where('m_id',$data['m_id']);
        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            $answer = $query->row_array();
            $output = "";
            switch ($data['desired']) {
                case 'tel': {
                    $output = $answer['m_telno'];
                    break;
                }
                case 'cell':
                default : {
                    $output = $answer['m_cellno'];
                    break;
                }
            }
            if (empty($output)) {
                return $this->user->get_number($data);
            }
        }
        else {
            return "Number not found.";
        }
    }
}
