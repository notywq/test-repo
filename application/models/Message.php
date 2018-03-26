<?php
class Message extends CI_Model {
    private $msg_error;
    
    public function __construct() {
        $this->load->database();
    }
    
    public function create($data = array()) {
        if (empty($data['msg_sender']) || empty($data['msg_recipient'])) {
            $this->msg_error = "You do not have someone to send or receive this message.";
            return false;
        }
        if (empty($data['msg_subject']) || empty($data['msg_body'])) {
            $this->msg_error = "The message must be complete. Please fill up the form properly.";
            return false;
        }
        
        $this->db->trans_start();
        
        // Insert into message
        $timestamp = date('Y-m-d H:i:s');
        $message = [
            'msg_sender'=>$data['msg_sender'],
            'msg_recipient'=>$data['msg_recipient'],
            'msg_subject'=>$data['msg_subject'],
            'msg_body'=>$data['msg_body'],
            'msg_read'=>$data['msg_read'],
            'msg_created'=>$timestamp,
        ];
        $this->db->insert('message',$message);
        
        $this->db->trans_complete();
        
        if ($this->db->trans_status() == TRUE) {
            $this->db->trans_commit();
            return true;
        }
        else {
            $this->db->trans_rollback();
            return false;
        }
    }
    public function cut_body($data = array()) {
        $text = $data['msg_body'];
        if (empty($text)) {
            return "Open this message to view its content.";
        }
        $length = 140;
        if (!empty($data['length']) && is_numeric($data['length'])) {
            $length = $data['length'];
        }
        $ending = "...";
        if (isset($data['ending']) && is_string($data['ending'])) {
            $ending = $data['ending'];
        }
        
        // Thanks to http://www.hashbangcode.com/blog/cut-string-specified-length-php
        // #laziness
        if (strlen($text) > $length || $text == '') {
            $words = preg_split('/\s/', $text);
            $output = '';
            $i      = 0;
            $next_length = 0;
            foreach($words as $word) {
                $next_length = strlen($output)+strlen($word);
                if ($next_length > $length) {
                    break;
                } 
                else {
                    $output .= " " . $words[$i];
                    $i++;
                }
            }
            $output .= $ending;
        }
        else {
            $output = $text;
        }
        return $output;
    }
    
    public function get_msgs($data = array()) {
        if (empty($data['m_id'])) {
            return array();
        }
        $msg_details = [
            'msg_recipient'=> $data['m_id'],
        ];
        if (!empty($data['msg_read'])) {
            $msg_details['msg_read'] = $data['msg_read'];
        }
        $query = $this->db->from('message')
                ->where($msg_details)
                ->order_by('msg_created', "DESC")
                ->get();
        return $query->result_array();
    }
    public function get_msgError() {
        return $this->msg_error;
    }
}
