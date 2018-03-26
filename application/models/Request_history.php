<?php
class Request_history extends CI_Model {
    public function __construct() {
        $this->load->database();
    }
    
    public function identify($data=array()) {
        if (empty($data['rh_reqid'])) {
            return array();
        }
        $query = $this->db->get_where('request_history', [
            'rh_reqid' => $data['rh_reqid']
        ]);
        return $query->result_array();
    }
    public function confirm_moment($data = array()) {
        if (empty($data['rh_id']) || empty($data['rh_created'])) {
            return array();
        }
        $query = $this->db->from('request_history')
                ->where([
                    'rh_id' => $data['rh_id'],
                    'rh_created' => $data['rh_created']
                ])
                ->get();
        return $query->num_rows() == 1;
    }
    public function get_entry($data = array()) {
        if (!empty($data['request_id'])
                || !empty($data['type'])
                || !empty($data['inquiry'])
                ){
            $query = $this->db->from('request_history')
                    ->where([
                'rh_reqid'=>$data['request_id'],
                'rh_type'=>$data['type'],
                'rh_changecol'=>$data['inquiry'],
            ])
                    ->order_by('rh_created','DESC')
                    ->get();
            if (!empty($data['timestamp'])) {
                $answer = $query->result_array();
                foreach ($answer as $item) {
                    if ($item['rh_created'] <= $data['timestamp']) {
                        return $item['rh_changeval'];
                    }
                }
            }
            else if ($query->num_rows() == 1) {
                $answer = $query->row_array();
                return $answer['rh_changeval'];
            }
            else if ($query->num_rows() > 1){
                $answer = $query->result_array();
                $output = [];
                foreach ($answer as $item) {
                    $output[$item['rh_created']] = $item['rh_changecol'];
                }
                return $output;
            }
        }
        return "";
    }
}
