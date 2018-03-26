<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class SmsItexmo {

    private $api_code = "get-your-own";

    public function itexmo($number, $message) {
        $url = 'https://www.itexmo.com/php_api/api.php';
        $itexmo = array('1' => $number, '2' => $message, '3' => $this->api_code);
        $param = array(
            'http' => array(
                'header' => "Content-type: application/x-www-form-urlencoded\r\n",
                'method' => 'POST',
                'content' => http_build_query($itexmo),
            ),
        );
        $context = stream_context_create($param);
        return file_get_contents($url, false, $context);
    }
    
    public function notify_sms($data = array()) {
        $CI =& get_instance();
        $ticker = $data['n_ticker'];
        $msg = "";
        $href = $data['n_slug'];
        
        switch ($data['n_type']) {
            case 'request': {
                $request_split = explode('/', $href);
                $rh_type = $request_split[1];
                $ritem_split = explode('+', $request_split[2]);
                $ritem_id = array_pop($ritem_split);
                $msg_line1 = "";
                $msg_line2 = "";
                
                $CI->load->model('request_history');
                $CI->load->model('address');
                switch ($rh_type) {
                    case 'beans': {
                        $CI->load->model('request_beans');
                        $rbean = $CI->request_beans->identify([
                            'rb_id' => $ritem_id
                        ]);
                        
                        $rbean_quantity = $CI->request_history->get_entry([
                            'request_id' => $ritem_id,
                            'type' => $rh_type,
                            'inquiry' => 'rb_quantity',
                            'timestamp' => $data['n_created']
                        ]);
                        $bean_species = $CI->request_history->get_entry([
                            'request_id' => $ritem_id,
                            'type' => $rh_type,
                            'inquiry' => 'b_species',
                            'timestamp' => $rbean['rb_created']
                        ]);
                        $bean_roast = $CI->request_history->get_entry([
                            'request_id' => $ritem_id,
                            'type' => $rh_type,
                            'inquiry' => 'b_roast',
                            'timestamp' => $rbean['rb_created']
                        ]);
                        $msg_line1 = $rbean_quantity." kg of";
                        $msg_line2 = $bean_roast." ".$bean_species;
                        break;
                    }
                    case 'pack': {
                        $CI->load->model('request_packaging');
                        $rpack = $CI->request_packaging->identify([
                            'rpk_id' => $ritem_id
                        ]);

                        $rpack_quantity = $CI->request_history->get_entry([
                            'request_id' => $ritem_id,
                            'type' => $rh_type,
                            'inquiry' => 'rpk_quantity',
                            'timestamp' => $data['n_created']
                        ]);
                        $pack_capacity = $CI->request_history->get_entry([
                            'request_id' => $ritem_id,
                            'type' => $rh_type,
                            'inquiry' => 'pk_capacity',
                            'timestamp' => $rpack['rpk_created']
                        ]);
                        $pack_type = $CI->request_history->get_entry([
                            'request_id' => $ritem_id,
                            'type' => $rh_type,
                            'inquiry' => 'pk_type',
                            'timestamp' => $rpack['rpk_created']
                        ]);
                        $msg_line1 = $rpack_quantity." sets of";
                        $msg_line2 = $pack_capacity." g ".$pack_type;
                        break;
                    }
                    case 'roast': {
                        $CI->load->model('request_roast');
                        $rroast = $CI->request_roast->identify([
                            'rro_id' => $ritem_id
                        ]);

                        $roast_quantity = $CI->request_history->get_entry([
                            'request_id' => $ritem_id,
                            'type' => $rh_type,
                            'inquiry' => 'rro_quantity',
                            'timestamp' => $data['n_created']
                        ]);
                        $roast_addressID = $CI->request_history->get_entry([
                            'request_id' => $ritem_id,
                            'type' => $rh_type,
                            'inquiry' => 'rro_deliverto',
                            'timestamp' => $data['n_created']
                        ]);
                        $roast_address = $CI->address->get_string([
                            'a_id'=>$roast_addressID,
                            'pref'=>'c',
                        ]);
                        $msg_line1 = "Roasting ".$roast_quantity." kg";
                        $msg_line2 = "at ".$roast_address;
                        break;
                    }
                    case 'proc': {
                        $CI->load->model('request_processing');
                        $rproc = $CI->request_processing->identify([
                            'rproc_id' => $ritem_id
                        ]);

                        $proc_activity = $CI->request_history->get_entry([
                            'request_id' => $ritem_id,
                            'type' => $rh_type,
                            'inquiry' => 'proc_activity',
                            'timestamp' => $rproc['rproc_created']
                        ]);
                        $proc_quantity = $CI->request_history->get_entry([
                            'request_id' => $ritem_id,
                            'type' => $rh_type,
                            'inquiry' => 'rproc_quantity',
                            'timestamp' => $data['n_created']
                        ]);
                        $proc_addressID = $CI->request_history->get_entry([
                            'request_id' => $ritem_id,
                            'type' => $rh_type,
                            'inquiry' => 'rproc_deliverto',
                            'timestamp' => $data['n_created']
                        ]);
                        $proc_address = $CI->address->get_string([
                            'a_id'=>$proc_addressID,
                            'pref'=>'c',
                        ]);
                        $msg_line1 = $proc_activity." ".$proc_quantity." kg";
                        $msg_line2 = "at ".$proc_address;
                        break;
                    }
                }
                $msg = $msg_line1." ".$msg_line2;
                break;
            }
        }
        
        $CI->load->model('message');
        $full_msg = $CI->message->cut_body([
            'msg_body'=>"WEBKAPE: ".$ticker." for ".$msg.".",
            'limit'=>97,
        ]);
        $CI->load->model('member');
        $recipient_number = $CI->member->get_number([
            'm_id'=>$data['n_recipient'],
        ]);
        $sms_result = $this->itexmo($recipient_number, $full_msg);
        if ($sms_result === 0) {
            return $sms_result;
        }
        else {
            return $this->notify_sms_error($sms_result);
        }
    }
    public function notify_sms_error($sms_result) {
        if (!is_numeric($sms_result)) {
            $sms_result = -1;
        }
        switch ($sms_result) {
            case 1: {
                return "The recipient does not seem to have a valid number. "
                        . "We will note this issue and talk with the receiver accordingly.";
                break;
            }
            case 2: {
                return "The recipient's number does not seem to be valid. "
                        . "We will note this issue and talk with the receiver accordingly.";
                break;
            }
            case 3:
            case 5:
            case 13:{
                return "We seem to have technical difficulties; we will know about "
                        . "this and will adjust our system accordingly.";
                break;
            }
            case 4: {
                return "We apologize that we cannot accept any more messages today; "
                        . "our system will be able to send messages again on the next day.";
                break;
            }
            case 6:
            case 7:
            case 8:
            case 9: {
                return "Our messaging system is down. "
                        . "We will work on it as soon as possible.";
                break;
            }
            case 10:{
                return "Sorry, but we could not send a message due to the recipient being flooded with messages. Please try again later.";
                break;
            }
            case 11:{
                return "Sorry, but we could not send a message due to many failed attempts doing so. Please try again in an hour.";
                break;
            }
            default: {
                return "A message could not be sent to the recipient; please try again.";
                break;
            }
        }
    }

}
