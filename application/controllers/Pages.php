<?php

class Pages extends CI_Controller {
    
    public function index() {
        // No.
        header("Location: ".site_url('home'));
    }
    public function profile($username = null) {
        $this->load->library('session');
        $this->load->library('form_validation');
        
        $data = $this->input->post(null, true);
        if (isset($data['mycertify'])) {
            $this->form_validation->set_rules('cert_name', 'Certification name', 'required');
        }
        
        $is_member = $this->member->identify([
            'm_id'=>$this->session->m_id
        ]);
        if (empty($is_member['m_id'])) {
            $is_member['m_id'] = "";
        }
        if (!empty($username)) {
            $that_member = $this->member->identify([
                'username'=>$username
            ]);
        }
        else {
            $that_member = $is_member;
        }
        $page_title = $this->member->get_name([
            'm_id'=>$that_member['m_id'],
            'pref'=>'fl'
        ]);
        
        $this->load->view('templates/metahead', [
            'page_title' => $page_title,
            'sidebar' => !empty($is_member['m_id']),
        ]);
        $this->load->view('pieces/navbar', [
            'page_title' => 'Profile',
            'm_id' => $is_member['m_id'],
        ]);
        if (!empty($is_member['m_id'])) {
            $this->load->view('pieces/sidebar', [
                'page_title' => $page_title,
                'parent_page_title' => 'Profile'
            ]);
        }
        
        $this->load->helper('form');
        $this->load->view('pieces/form-pieces');
        if ($this->form_validation->run() == false) {
            $this->load->view('pages/profile', [
                'member'=>$that_member,
                'is_you'=>$that_member['m_id'] == $is_member['m_id'],
            ]);
        }
        else {
            $profile_error = "This does NOT mean the image of your certificate is fine!";
            if (isset($data['mycertify'])) {
                $certify = [
                    'm_cert'=>$data['cert_name'],
                    'mc_desc'=>$data['cert_desc'],
                    'mc_slug'=>'',
                ];
                $profile_error = "Database was unknowledgeable and failed you miserably.";
                // TODO Database command for certificates
                
                // TODO Rename file to user-specific name and cert_image ID.
                $config = [
                    'upload_path'=>'private/certs/',
                    'allowed_types'=>'gif|jpg|png',
                    'file_name'=>'tell-you',
                    'max_size'=>'200',
                    'max_width'=>'2000',
                    'max_height'=>'2000',
                ];
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('cert_image')) {
                    $profile_error = $this->upload->display_errors('<span>','</span>');
                }
                else {
                    $profile_error .= " At least the picture was safely uploaded!";
                }
            }
            
            $this->load->view('pages/profile', [
                'member'=>$that_member,
                'is_you'=>$that_member['m_id'] == $is_member['m_id'],
                'profile_error'=>$profile_error,
            ]);
        }
        
        $this->load->view('templates/metafoot', [
            'sidebar'=>!empty($is_member['m_id'])
        ]);
    }
    public function beans($bean_string) {
        if (empty($bean_string)){
            // No. Back to shopping.
            header("Location: ". site_url('browse'));
        }
        
        $this->load->helper('form');
        $this->load->library('form_validation');
        
        $data = $this->input->post(null, true);
        if (isset($data['buybeans'])) {
            $this->form_validation->set_rules('quantity', 'Quantity needed', 'required|greater_than[0]|decimal',[
                'greater_than' => 'You must enter a positive value of %s.'
            ]);
            $this->form_validation->set_rules('duedate', 'Date needed', 'required');
            $this->form_validation->set_rules('use_member', 'Address to use', 'required');
            if (isset($data['use_member']) && $data['use_member'] == 0) {
                $this->form_validation->set_rules('province', 'Delivery address (province)', 'required');
                $this->form_validation->set_rules('city', 'Delivery address (city)', 'required');
                $this->form_validation->set_rules('address', 'Delivery address (address)', 'trim|required|max_length[140]');
            }
        }
        if (isset($data['heybeans'])) {
            $this->form_validation->set_rules('subject', 'Subject', 'trim|required|max_length[140]');
            $this->form_validation->set_rules('message', 'Message', 'trim|required');
        }
        
        $this->load->library('session');
        
        $is_member = $this->member->identify([
            'm_id'=>$this->session->m_id
        ]);
        if (empty($is_member)) {
            $is_member['m_id'] = "";
        }
        
        $bean_array = preg_split('/\+/', $bean_string);
        $bean_id = array_pop($bean_array);
        $bean_species = array_pop($bean_array);
        $bean_roast_string = urldecode(implode("-", $bean_array));
        $bean_roast = str_replace('_',' ',$bean_roast_string);
        $has_store = $this->store->track(['b_id'=>$bean_id]);
        $page_title=$bean_roast.' roast '.$bean_species.' from '.$has_store['s_name'];
        $bean_details = $this->beans->identify(['b_id'=>$bean_id]);
        $bean_additions = $this->beans->get_thoseAdditions(['b_id'=>$bean_id]);
        
        $this->load->view('templates/metahead', [
            'page_title' => $page_title,
            'sidebar' => !empty($is_member['m_id']),
            'datetimepicker' => TRUE
        ]);
        $this->load->view('pieces/navbar', [
            'page_title' => 'Browse',
            'm_id' => $is_member['m_id']
        ]);
        if (!empty($is_member['m_id'])) {
            $this->load->view('pieces/sidebar', [
                'page_title' => $page_title,
                'parent_page_title' => 'Browse'
            ]);
        }
        
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('pieces/form-pieces');
            $this->load->view('pages/beans', [
                'm_id'=>$is_member['m_id'],
                'bean_string' => $bean_string,
                'bean_id' => $bean_id,
                'bean_species' => $bean_species,
                'bean_roast' => $bean_roast,
                'bean_details' => $bean_details,
                'bean_additions' => $bean_additions,
            ]);
        }
        else {
            $buy_error='';
            if (empty($is_member['m_id'])) {
                $buy_error = 'You must be logged in to your account.<br />'
                        . '<a target="_blank" class="btn btn-sm btn-default" '
                        . 'href="'. site_url('signup').'">Make one now</a>';
            }
            
            if (isset($data['buybeans']) && !empty($is_member['m_id'])) {
                $this->load->library('smsitexmo');
                $address_in_use = [];
                if ($data['use_member'] == 0) {
                    $address_in_use['ac_id'] = $data['city'];
                    $address_in_use['a_address'] = $data['address'];
                }
                else {
                    $address_in_use['a_id'] = $data['use_member'];
                }
                $entry = [
                    'b_id'=>$bean_id,
                    'rb_quantity'=>$data['quantity'],
                    'rb_duedate'=>$data['duedate'],
                    'rb_deliverto'=>$address_in_use,
                    'rb_delivernotes'=> html_escape($data['notes']),
                    's_id'=>$has_store['s_id'],
                    'm_id'=>$is_member['m_id'],
                    'rb_status'=>0,
                ];
                $success = $this->request_beans->create($entry);
                if ($success == TRUE) {
                    $this->session->system_notify = "Request sent successfully! Your "
                            . "recipient will be informed shortly.";
                    $this->session->system_notify_context = "success";
                    $extra_error = $this->request_beans->get_msgError();
                    if (!empty($extra_error)) {
                        $this->session->system_notify = $extra_error;
                        $this->session->system_notify_context = "warning";
                    }
                    session_write_close();
                    header("Location: ". site_url('browse'));
                }
                $buy_error = $this->request_beans->get_msgError();
            }
            if (isset($data['heybeans']) && !empty($is_member['m_id'])) {
                $seller = $this->member->find_owner([
                    's_id'=>$has_store['s_id']
                ]);
                $entry = [
                    'msg_sender'=>$is_member['m_id'],
                    'msg_recipient'=>$seller['m_id'],
                    'msg_subject'=>$data['subject'],
                    'msg_body'=>$data['message'],
                    'msg_read'=>0,
                ];
                $success = $this->message->create($entry);
                if ($success == TRUE) {
                    // TODO Inform on that page
                    header("Location: ". site_url('browse'));
                }
                $buy_error = $this->message->get_msgError();
            }
            
            $this->load->view('pieces/form-pieces');
            $this->load->view('pages/beans', [
                'm_id'=>$is_member['m_id'],
                'bean_string' => $bean_string,
                'bean_id' => $bean_id,
                'bean_species' => $bean_species,
                'bean_roast' => $bean_roast,
                'bean_details' => $bean_details,                
                'bean_additions' => $bean_additions,
                'buy_error' => $buy_error
            ]);
        }
        $this->load->view('templates/metafoot', [
            'sidebar' => !empty($is_member['m_id']),
            'datetimepicker' => TRUE,
            'addressselect' => TRUE,
        ]);
    }
    public function roast($roast_string) {
        if (empty($roast_string)){
            // No. Back to shopping.
            header("Location: ". site_url('browse'));
        }
        
        $this->load->helper('form');
        $this->load->library('form_validation');
        
        $data = $this->input->post(null, true);
        if (isset($data['buyroast'])) {
            $this->form_validation->set_rules('roast', 'Roast type', 'required');
            $this->form_validation->set_rules('quantity', 'Quantity needed', 'required|greater_than[0]|decimal',[
                'greater_than' => 'You must enter a positive value of %s.'
            ]);
            $this->form_validation->set_rules('duedate', 'Date needed', 'required');
            $this->form_validation->set_rules('use_member', 'Address to use', 'required');
            if (isset($data['use_member']) && $data['use_member'] == 0) {
                $this->form_validation->set_rules('province', 'Delivery address (province)', 'required');
                $this->form_validation->set_rules('city', 'Delivery address (city)', 'required');
                $this->form_validation->set_rules('address', 'Delivery address (address)', 'trim|required|max_length[140]');
            }
        }
        if (isset($data['heyroast'])) {
            $this->form_validation->set_rules('subject', 'Subject', 'trim|required|max_length[140]');
            $this->form_validation->set_rules('message', 'Message', 'trim|required');
        }
        
        $this->load->library('session');
        
        $is_member = $this->member->identify([
            'm_id'=>$this->session->m_id
        ]);
        if (empty($is_member)) {
            $is_member['m_id'] = '';
        }
        
        $roast_array = preg_split('/\+/', $roast_string);
        $roast_id = array_pop($roast_array);
        $roast_address = array_pop($roast_array);
        $roast_support_raw = urldecode(implode("-", $roast_array));
        $roast_support_string = str_replace('_',' ',$roast_support_raw);
        $has_store = $this->store->track(['ro_id'=>$roast_id]);
        $page_title=$roast_support_string.' roasts at '.$roast_address.' from '.$has_store['s_name'];
        $roast_details = $this->roast->identify(['ro_id'=>$roast_id]);
        $roast_support = $this->roast->get_roastSupport(['ro_id'=>$roast_id]);
        
        $this->load->view('templates/metahead', [
            'page_title' => $page_title,
            'sidebar' => !empty($is_member['m_id']),
            'datetimepicker' => TRUE
        ]);
        $this->load->view('pieces/navbar', [
            'page_title' => 'Browse',
            'm_id' => $is_member['m_id']
        ]);
        if (!empty($is_member['m_id'])) {
            $this->load->view('pieces/sidebar', [
                'page_title' => $page_title,
                'parent_page_title' => 'Browse'
            ]);
        }
        
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('pieces/form-pieces');
            $this->load->view('pages/roast', [
                'm_id'=>$is_member['m_id'],
                'roast_string' => $roast_string,
                'roast_id' => $roast_id,
                'roast_details' => $roast_details,
                'roast_support' => $roast_support,
            ]);
        }
        else {
            $buy_error='';
            if (empty($is_member['m_id'])) {
                $buy_error = 'You must be logged in to your account.<br />'
                        . '<a target="_blank" class="btn btn-sm btn-default" '
                        . 'href="'. site_url('signup').'">Make one now</a>';
            }
            
            if (isset($data['buyroast']) && !empty($is_member['m_id'])) {
                $this->load->library('smsitexmo');
                $address_in_use = [];
                if ($data['use_member'] == 0) {
                    $address_in_use['ac_id'] = $data['city'];
                    $address_in_use['a_address'] = $data['address'];
                }
                else {
                    $address_in_use['a_id'] = $data['use_member'];
                }
                $entry = [
                    'ro_id'=>$roast_id,
                    'rro_roast'=> html_escape($data['roast']),
                    'rro_quantity'=>$data['quantity'],
                    'rro_roastnotes'=> html_escape($data['roast_notes']),
                    'rro_duedate'=>$data['duedate'],
                    'rro_deliverto'=>$address_in_use,
                    'rro_delivernotes'=> html_escape($data['notes']),
                    's_id'=>$has_store['s_id'],
                    'm_id'=>$is_member['m_id'],
                    'rro_status'=>0,
                ];
                $success = $this->request_roast->create($entry);
                if ($success == TRUE) {
                    $this->session->system_notify = "Request sent successfully! Your "
                            . "recipient will be informed shortly.";
                    $this->session->system_notify_context = "success";
                    $extra_error = $this->request_roast->get_msgError();
                    if (!empty($extra_error)) {
                        $this->session->system_notify = $extra_error;
                        $this->session->system_notify_context = "warning";
                    }
                    session_write_close();
                    header("Location: ". site_url('browse'));
                }
                $buy_error = $this->request_roast->get_msgError();
            }
            if (isset($data['heyroast']) && !empty($is_member['m_id'])) {
                $seller = $this->member->find_owner([
                    's_id'=>$has_store['s_id']
                ]);
                $entry = [
                    'msg_sender'=>$is_member['m_id'],
                    'msg_recipient'=>$seller['m_id'],
                    'msg_subject'=>$data['subject'],
                    'msg_body'=>$data['message'],
                    'msg_read'=>0,
                ];
                $success = $this->message->create($entry);
                if ($success == TRUE) {
                    // TODO Inform on that page
                    header("Location: ". site_url('browse'));
                }
                $buy_error = $this->message->get_msgError();
            }
            
            $this->load->view('pieces/form-pieces');
            $this->load->view('pages/roast', [
                'm_id'=>$is_member['m_id'],
                'roast_string' => $roast_string,
                'roast_id' => $roast_id,
                'roast_details' => $roast_details,
                'roast_support' => $roast_support,
                'buy_error' => $buy_error
            ]);
        }
        $this->load->view('templates/metafoot', [
            'sidebar' => !empty($is_member['m_id']),
            'datetimepicker' => TRUE,
            'addressselect' => TRUE,
        ]);
    }
    public function proc($proc_string) {
        if (empty($proc_string)){
            // No. Back to shopping.
            header("Location: ". site_url('browse'));
        }
        
        $this->load->helper('form');
        $this->load->library('form_validation');
        
        $data = $this->input->post(null, true);
        if (isset($data['buyproc'])) {
            $this->form_validation->set_rules('quantity', 'Quantity needed', 'required|greater_than[0]|decimal',[
                'greater_than' => 'You must enter a positive value of %s.'
            ]);
            $this->form_validation->set_rules('duedate', 'Date needed', 'required');
            $this->form_validation->set_rules('use_member', 'Address to use', 'required');
            if (isset($data['use_member']) && $data['use_member'] == 0) {
                $this->form_validation->set_rules('province', 'Delivery address (province)', 'required');
                $this->form_validation->set_rules('city', 'Delivery address (city)', 'required');
                $this->form_validation->set_rules('address', 'Delivery address (address)', 'trim|required|max_length[140]');
            }
        }
        if (isset($data['heyproc'])) {
            $this->form_validation->set_rules('subject', 'Subject', 'trim|required|max_length[140]');
            $this->form_validation->set_rules('message', 'Message', 'trim|required');
        }
        
        $this->load->library('session');
        
        $is_member = $this->member->identify([
            'm_id'=>$this->session->m_id
        ]);
        if (empty($is_member)) {
            $is_member['m_id'] = '';
        }
        
        $proc_array = preg_split('/\+/', $proc_string);
        $proc_id = array_pop($proc_array);
        $proc_address = array_pop($proc_array);
        $proc_activity_raw = urldecode(implode("-", $proc_array));
        $proc_activity_string = str_replace('_',' ',$proc_activity_raw);
        $has_store = $this->store->track(['proc_id'=>$proc_id]);
        $page_title=$proc_activity_string.' at '.$proc_address.' from '.$has_store['s_name'];
        $proc_details = $this->processing->identify(['proc_id'=>$proc_id]);
        
        $this->load->view('templates/metahead', [
            'page_title' => $page_title,
            'sidebar' => !empty($is_member['m_id']),
            'datetimepicker' => TRUE
        ]);
        $this->load->view('pieces/navbar', [
            'page_title' => 'Browse',
            'm_id' => $is_member['m_id']
        ]);
        if (!empty($is_member['m_id'])) {
            $this->load->view('pieces/sidebar', [
                'page_title' => $page_title,
                'parent_page_title' => 'Browse'
            ]);
        }
        
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('pieces/form-pieces');
            $this->load->view('pages/proc', [
                'm_id'=>$is_member['m_id'],
                'proc_string' => $proc_string,
                'proc_id' => $proc_id,
                'proc_details' => $proc_details,
            ]);
        }
        else {
            $buy_error='';
            if (empty($is_member['m_id'])) {
                $buy_error = 'You must be logged in to your account.<br />'
                        . '<a target="_blank" class="btn btn-sm btn-default" '
                        . 'href="'. site_url('signup').'">Make one now</a>';
            }
            
            if (isset($data['buyproc']) && !empty($is_member['m_id'])) {
                $this->load->library('smsitexmo');
                $address_in_use = [];
                if ($data['use_member'] == 0) {
                    $address_in_use['ac_id'] = $data['city'];
                    $address_in_use['a_address'] = $data['address'];
                }
                else {
                    $address_in_use['a_id'] = $data['use_member'];
                }
                $entry = [
                    'proc_id'=>$proc_id,
                    'rproc_procnotes'=> html_escape($data['proc_notes']),
                    'rproc_quantity'=>$data['quantity'],
                    'rproc_duedate'=>$data['duedate'],
                    'rproc_deliverto'=>$address_in_use,
                    'rproc_delivernotes'=> html_escape($data['notes']),
                    's_id'=>$has_store['s_id'],
                    'm_id'=>$is_member['m_id'],
                    'rproc_status'=>0,
                ];
                $success = $this->request_processing->create($entry);
                if ($success == TRUE) {
                    $this->session->system_notify = "Request sent successfully! Your "
                            . "recipient will be informed shortly.";
                    $this->session->system_notify_context = "success";
                    $extra_error = $this->request_processing->get_msgError();
                    if (!empty($extra_error)) {
                        $this->session->system_notify = $extra_error;
                        $this->session->system_notify_context = "warning";
                    }
                    session_write_close();
                    header("Location: ". site_url('browse'));
                }
                $buy_error = $this->request_processing->get_msgError();
            }
            if (isset($data['heyproc']) && !empty($is_member['m_id'])) {
                $seller = $this->member->find_owner([
                    's_id'=>$has_store['s_id']
                ]);
                $entry = [
                    'msg_sender'=>$is_member['m_id'],
                    'msg_recipient'=>$seller['m_id'],
                    'msg_subject'=>$data['subject'],
                    'msg_body'=>$data['message'],
                    'msg_read'=>0,
                ];
                $success = $this->message->create($entry);
                if ($success == TRUE) {
                    // TODO Inform on that page
                    header("Location: ". site_url('browse'));
                }
                $buy_error = $this->message->get_msgError();
            }
            
            $this->load->view('pieces/form-pieces');
            $this->load->view('pages/proc', [
                'm_id'=>$is_member['m_id'],
                'proc_string' => $proc_string,
                'proc_id' => $proc_id,
                'proc_details' => $proc_details,
                'buy_error' => $buy_error
            ]);
        }
        $this->load->view('templates/metafoot', [
            'sidebar' => !empty($is_member['m_id']),
            'datetimepicker' => TRUE,
            'addressselect' => TRUE,
        ]);
    }
    public function pack($pack_string) {
        if (empty($pack_string)){
            // No. Back to shopping.
            header("Location: ". site_url('browse'));
        }
        
        $this->load->helper('form');
        $this->load->library('form_validation');
        
        $data = $this->input->post(null, true);
        if (isset($data['buypack'])) {
            $this->form_validation->set_rules('quantity', 'Quantity needed', 'required|is_natural');
            $this->form_validation->set_rules('duedate', 'Date needed', 'required');
            $this->form_validation->set_rules('use_member', 'Address to use', 'required');
            if (isset($data['use_member']) && $data['use_member'] == 0) {
                $this->form_validation->set_rules('province', 'Delivery address (province)', 'required');
                $this->form_validation->set_rules('city', 'Delivery address (city)', 'required');
                $this->form_validation->set_rules('address', 'Delivery address (address)', 'trim|required|max_length[140]');
            }
        }
        if (isset($data['heypack'])) {
            $this->form_validation->set_rules('subject', 'Subject', 'trim|required|max_length[140]');
            $this->form_validation->set_rules('message', 'Message', 'trim|required');
        }
        
        $this->load->library('session');
        
        $is_member = $this->member->identify([
            'm_id'=>$this->session->m_id
        ]);
        if (empty($is_member)) {
            $is_member['m_id'] = '';
        }
        
        $pack_array = preg_split('/\+/', $pack_string);
        $pack_id = array_pop($pack_array);
        $pack_type = array_pop($pack_array);
        $pack_color_raw = urldecode(implode("-", $pack_array));
        $pack_color_string = str_replace('_',' ',$pack_color_raw);
        $has_store = $this->store->track(['pk_id'=>$pack_id]);
        $page_title=$pack_color_string.' '.$pack_type.' from '.$has_store['s_name'];
        $pack_details = $this->package->identify(['pk_id'=>$pack_id]);
        $pack_options = $this->package->get_myOptions(['pk_id'=>$pack_id]);
        
        $this->load->view('templates/metahead', [
            'page_title' => $page_title,
            'sidebar' => !empty($is_member['m_id']),
            'datetimepicker' => TRUE
        ]);
        $this->load->view('pieces/navbar', [
            'page_title' => 'Browse',
            'm_id' => $is_member['m_id']
        ]);
        if (!empty($is_member['m_id'])) {
            $this->load->view('pieces/sidebar', [
                'page_title' => $page_title,
                'parent_page_title' => 'Browse'
            ]);
        }
        
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('pieces/form-pieces');
            $this->load->view('pages/pack', [
                'm_id'=>$is_member['m_id'],
                'pack_string' => $pack_string,
                'pack_id' => $pack_id,
                'pack_details' => $pack_details,
                'pack_options' => $pack_options,
            ]);
        }
        else {
            $buy_error='';
            if (empty($is_member['m_id'])) {
                $buy_error = 'You must be logged in to your account.<br />'
                        . '<a target="_blank" class="btn btn-sm btn-default" '
                        . 'href="'. site_url('signup').'">Make one now</a>';
            }
            
            if (isset($data['buypack']) && !empty($is_member['m_id'])) {
                $this->load->library('smsitexmo');
                $address_in_use = [];
                if ($data['use_member'] == 0) {
                    $address_in_use['ac_id'] = $data['city'];
                    $address_in_use['a_address'] = $data['address'];
                }
                else {
                    $address_in_use['a_id'] = $data['use_member'];
                }
                $entry = [
                    'pk_id'=>$pack_id,
                    'rpk_options'=>$data['pack_options'],
                    'rpk_packnotes'=> html_escape($data['pack_notes']),
                    'rpk_quantity'=>$data['quantity'],
                    'rpk_duedate'=>$data['duedate'],
                    'rpk_deliverto'=>$address_in_use,
                    'rpk_delivernotes'=> html_escape($data['notes']),
                    's_id'=>$has_store['s_id'],
                    'm_id'=>$is_member['m_id'],
                    'rpk_status'=>0,
                ];
                $success = $this->request_packaging->create($entry);
                if ($success == TRUE) {
                    $this->session->system_notify = "Request sent successfully! Your "
                            . "recipient will be informed shortly.";
                    $this->session->system_notify_context = "success";
                    $extra_error = $this->request_packaging->get_msgError();
                    if (!empty($extra_error)) {
                        $this->session->system_notify = $extra_error;
                        $this->session->system_notify_context = "warning";
                    }
                    header("Location: ". site_url('browse'));
                }
                $buy_error = $this->request_packaging->get_msgError();
            }
            if (isset($data['heypack']) && !empty($is_member['m_id'])) {
                $seller = $this->member->find_owner([
                    's_id'=>$has_store['s_id']
                ]);
                $entry = [
                    'msg_sender'=>$is_member['m_id'],
                    'msg_recipient'=>$seller['m_id'],
                    'msg_subject'=>$data['subject'],
                    'msg_body'=>$data['message'],
                    'msg_read'=>0,
                ];
                $success = $this->message->create($entry);
                if ($success == TRUE) {
                    // TODO Inform on that page
                    header("Location: ". site_url('browse'));
                }
                $buy_error = $this->message->get_msgError();
            }
            
            $this->load->view('pieces/form-pieces');
            $this->load->view('pages/pack', [
                'm_id'=>$is_member['m_id'],
                'pack_string' => $pack_string,
                'pack_id' => $pack_id,
                'pack_details' => $pack_details,
                'pack_options' => $pack_options,
                'buy_error' => $buy_error
            ]);
        }
        $this->load->view('templates/metafoot', [
            'sidebar' => !empty($is_member['m_id']),
            'datetimepicker' => TRUE,
            'addressselect' => TRUE,
        ]);
    }
    public function orders($ordertype, $order_string) {
        $this->load->library('session');
        
        $member = $this->member->identify([
            'm_id'=>$this->session->m_id
                ]);
        if ($member == FALSE) {
            // Force logout
            header("Location: ".site_url('home/logout'));
        }
        if (empty($order_string)) {
            // No. Back to dashboard.
            header("Location: ".site_url('dashboard'));
        }
        
        switch ($ordertype) {
            case 'beans': {
                $this->orders_beans($member, $order_string);
                break;
            }
            case 'pack': {
                $this->orders_pack($member, $order_string);
                break;
            }
            case 'roast': {
                $this->orders_roast($member, $order_string);
                break;
            }
            case 'proc': {
                $this->orders_proc($member, $order_string);
                break;
            }
        }
    }
    private function orders_beans($member, $order_string) {
        $order_array = preg_split("/\+/", $order_string);
        $request_id = array_pop($order_array);
        $request_client_name_string = array_shift($order_array);
        $request_store_name_string = urldecode(implode('-',$order_array));
        $request_client_name = str_replace('_',' ',$request_client_name_string);
        $request_store_name = str_replace('_',' ',$request_store_name_string);
        
        $this->load->helper('form');
        $this->load->library('form_validation');
        
        $page_title = 'Beans for '.$request_client_name.' by '.$request_store_name;
        $request = $this->request_beans->identify([
            'rb_id'=>$request_id
        ]);
        
        $offer_error='';
        $data = $this->input->post(null, true);
        if (isset($data['offerbeans'])) {
            $this->load->library('smsitexmo');
            // No validation.
            $success = false;
            switch ($data['offerbeans']) {
                case 'yes': {
                    // Use 2 to accept
                    $success = $this->request_beans->eval_order([
                        'rb_id'=>$request['rb_id'],
                        'm_id'=>$member['m_id'],
                        'rb_status'=>2,
                    ]);
                    break;
                }
                case 'no': {
                    // Use 6 to reject
                    $success = $this->request_beans->eval_order([
                        'rb_id'=>$request['rb_id'],
                        'm_id'=>$member['m_id'],
                        'rb_status'=>6,
                    ]);
                    break;
                }
            }
            if ($success) {
                $this->session->system_notify = "Evaluation sent successfully! Your "
                            . "recipient will be informed shortly.";
                $this->session->system_notify_context = "success";
                $extra_error = $this->request_beans->get_msgError();
                if (!empty($extra_error)) {
                    $this->session->system_notify = $extra_error;
                    $this->session->system_notify_context = "warning";
                }
                session_write_close();
                header("Location: ".site_url('orders'));
            }
            $offer_error = $this->request_beans->get_msgError();
        }
        if (isset($data['receivebeans'])) {
            $this->load->library('smsitexmo');
            $success = $this->request_beans->eval_order([
                'rb_id'=>$request['rb_id'],
                'm_id'=>$member['m_id'],
                'rb_status'=>4,
            ]);
            if ($success) {
                $this->session->system_notify = "Receiving confirmed! Your "
                            . "recipient will be informed shortly.";
                $this->session->system_notify_context = "success";
                $extra_error = $this->request_beans->get_msgError();
                if (!empty($extra_error)) {
                    $this->session->system_notify = $extra_error;
                    $this->session->system_notify_context = "warning";
                }
                session_write_close();
                header("Location: ".site_url('orders'));
            }
            $offer_error = $this->request_beans->get_msgError();
        }
        if (isset($data['paybeans'])) {
            $this->load->library('smsitexmo');
            $success = $this->request_beans->eval_order([
                'rb_id'=>$request['rb_id'],
                'm_id'=>$member['m_id'],
                'rb_status'=>5,
            ]);
            if ($success) {
                $this->session->system_notify = "Payment confirmed! Your "
                            . "recipient will be informed shortly.";
                $this->session->system_notify_context = "success";
                $extra_error = $this->request_beans->get_msgError();
                if (!empty($extra_error)) {
                    $this->session->system_notify = $extra_error;
                    $this->session->system_notify_context = "warning";
                }
                session_write_close();
                header("Location: ".site_url('orders'));
            }
            $offer_error = $this->request_beans->get_msgError();
        }
        if (isset($data['negbeans'])) {
            $this->form_validation->set_rules('quantity', 'Quantity needed', 'required|greater_than[0]|decimal',[
                'greater_than' => 'You must enter a positive value of %s.'
            ]);
            $this->form_validation->set_rules('duedate', 'Date needed', 'required');
            if (isset($data['use_member']) && $data['use_member'] == 0) {
                $this->form_validation->set_rules('province', 'Store address (province)', 'required');
                $this->form_validation->set_rules('city', 'Store address (city)', 'required');
                $this->form_validation->set_rules('address', 'Store address (address)', 'trim|required|max_length[140]');
            }
        }
        if (isset($data['sendbeans'])) {
            $this->form_validation->set_rules('courier', 'Courier name', 'alpha_numeric_spaces');
            if (isset($data['track']) && $data['track'] == 1) {
                $this->form_validation->set_rules('trackno', 'Tracking number', 'required|alpha_numeric');
            }
        }
        if (isset($data['heybeans'])) {
            $this->form_validation->set_rules('subject', 'Subject', 'trim|required|max_length[140]');
            $this->form_validation->set_rules('message', 'Message', 'trim|required');
        }
        
        $this->load->view('templates/metahead', [
            'page_title' => $page_title,
            'sidebar' => TRUE,
            'datetimepicker' => TRUE,
            'addressselect' => TRUE,
        ]);
        $this->load->view('pieces/navbar', [
            'page_title' => 'Orders',
            'm_id' => $member['m_id'],
        ]);
        $this->load->view('pieces/sidebar', [
            'page_title' => $page_title,
            'parent_page_title' => 'Orders'
        ]);
        
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('pieces/form-pieces');
            $this->load->view('pages/beans_request', [
                'm_id'=>$member['m_id'],
                'request_string' => $order_string,
                'request_id' => $request_id,
                'request_client_name' => $request_client_name,
                'request_store_name' => $request_store_name,
                'request' => $request,
                'cities' => $this->address->get_city(),
                'offer_error' => $offer_error,
            ]);
        }
        else {
            if (isset($data['negbeans'])) {
                $this->load->library('smsitexmo');
                $success = false;
                $new_status = 0;
                if ($request['m_id']==$member['m_id']) {
                    $new_status = 0;
                }
                else {
                    $new_status = 1;
                }
                
                $address_in_use = [];
                if ($data['use_member'] == 0) {
                    $address_in_use['ac_id'] = $data['city'];
                    $address_in_use['a_address'] = $data['address'];
                }
                else {
                    $address_in_use['a_id'] = $data['use_member'];
                }
                $entry = [
                    'm_id'=>$member['m_id'],
                    'rb_quantity'=>$data['quantity'],
                    'rb_duedate'=>$data['duedate'],
                    'rb_deliverto'=>$address_in_use,
                    'rb_delivernotes'=> html_escape($data['notes']),
                    'rb_id'=>$request_id,
                    'rb_status'=>$new_status,
                ];
                $success = $this->request_beans->nego_order($entry);
                if ($success) {
                    $this->session->system_notify = "Negotiation sent successfully! Your "
                            . "recipient will be informed shortly.";
                    $this->session->system_notify_context = "success";
                    $extra_error = $this->request_beans->get_msgError();
                    if (!empty($extra_error)) {
                        $this->session->system_notify = $extra_error;
                        $this->session->system_notify_context = "warning";
                    }
                    session_write_close();
                    header("Location: ".site_url('orders'));
                }
                $offer_error = $this->request_beans->get_msgError();
            }
            if (isset($data['sendbeans'])) {
                $this->load->library('smsitexmo');
                $success = false;
                $new_status = 3;
                $courier = $data['courier'];
                if (empty($data['courier'])) {
                    $courier = "Own courier";
                }
                $trackno = 0;
                if (isset($data['track']) && $data['track'] == 1) {
                    $trackno = strtoupper($data['trackno']);
                }
                
                $send_offer = [
                    'm_id'=>$member['m_id'],
                    'rb_status'=>$new_status,
                    'rb_id'=>$request_id,
                    'rbsh_courier'=>$courier,
                    'rbsh_trackno'=>$trackno,
                ];
                $success = $this->request_beans->send_order($send_offer);
                if ($success) {
                    $this->session->system_notify = "Batch of beans sent successfully! Your "
                            . "recipient will be informed shortly.";
                    $this->session->system_notify_context = "success";
                    $extra_error = $this->request_beans->get_msgError();
                    if (!empty($extra_error)) {
                        $this->session->system_notify = $extra_error;
                        $this->session->system_notify_context = "warning";
                    }
                    session_write_close();
                    header("Location: ". site_url('orders'));
                }
                $offer_error = $this->request_beans->get_msgError();
            }
            if (isset($data['heybeans'])) {
                $seller = $this->member->find_owner([
                    's_id'=>$request['s_id']
                ]);
                $is_seller = $seller['m_id'] == $member['m_id'];
                $recipient_id = "";
                if ($is_seller) {
                    $recipient_id = $request['m_id'];
                }
                else {
                    $recipient_id = $seller['m_id'];
                }
                $entry = [
                    'msg_sender'=>$member['m_id'],
                    'msg_recipient'=>$recipient_id,
                    'msg_subject'=>$data['subject'],
                    'msg_body'=>$data['message'],
                    'msg_read'=>0,
                ];
                unset($recipient_id,$seller,$is_seller);
                $success = $this->message->create($entry);
                if ($success == TRUE) {
                    // TODO Inform on that page
                    header("Location: ". site_url('orders'));
                }
                $offer_error = $this->message->get_msgError();
            }
            
            $this->load->view('pieces/form-pieces');
            $this->load->view('pages/beans_request', [
                'm_id'=>$member['m_id'],
                'request_string' => $order_string,
                'request_id' => $request_id,
                'request_client_name' => $request_client_name,
                'request_store_name' => $request_store_name,
                'request' => $request,
                'cities' => $this->address->get_city(),
                'offer_error' => $offer_error,
            ]);
        }
        $this->load->view('templates/metafoot', [
            'sidebar' => TRUE,
            'datetimepicker' => TRUE,
            'addressselect' => TRUE,
        ]);
    }
    private function orders_pack($member, $order_string) {
        $order_array = preg_split("/\+/", $order_string);
        $request_id = array_pop($order_array);
        $request_client_name_string = array_shift($order_array);
        $request_store_name_string = urldecode(implode('-',$order_array));
        $request_client_name = str_replace('_',' ',$request_client_name_string);
        $request_store_name = str_replace('_',' ',$request_store_name_string);
        
        $this->load->helper('form');
        $this->load->library('form_validation');
        
        $page_title = 'Package for '.$request_client_name.' by '.$request_store_name;
        $request = $this->request_packaging->identify([
            'rpk_id'=>$request_id
        ]);
        
        $data = $this->input->post(null, true);
        if (isset($data['offerpack'])) {
            $this->load->library('smsitexmo');
            // No validation.
            $success = false;
            switch ($data['offerpack']) {
                case 'yes': {
                    // Use 2 to accept
                    $success = $this->request_packaging->eval_order([
                        'rpk_id'=>$request['rpk_id'],
                        'm_id'=>$member['m_id'],
                        'rpk_status'=>2,
                    ]);
                    break;
                }
                case 'no': {
                    // Use 6 to reject
                    $success = $this->request_packaging->eval_order([
                        'rpk_id'=>$request['rpk_id'],
                        'm_id'=>$member['m_id'],
                        'rpk_status'=>6,
                    ]);
                    break;
                }
            }
            if ($success) {
                $this->session->system_notify = "Evaluation sent successfully! Your "
                        . "recipient will be informed shortly.";
                $this->session->system_notify_context = "success";
                $extra_error = $this->request_packaging->get_msgError();
                if (!empty($extra_error)) {
                    $this->session->system_notify = $extra_error;
                    $this->session->system_notify_context = "warning";
                }
                header("Location: ".site_url('orders'));
            }
            $offer_error = $this->request_packaging->get_msgError();
        }
        if (isset($data['receivepack'])) {
            $this->load->library('smsitexmo');
            $success = $this->request_packaging->eval_order([
                'rpk_id'=>$request['rpk_id'],
                'm_id'=>$member['m_id'],
                'rpk_status'=>4,
            ]);
            if ($success) {
                $this->session->system_notify = "Receiving confirmed! Your "
                        . "recipient will be informed shortly.";
                $this->session->system_notify_context = "success";
                $extra_error = $this->request_packaging->get_msgError();
                if (!empty($extra_error)) {
                    $this->session->system_notify = $extra_error;
                    $this->session->system_notify_context = "warning";
                }
                header("Location: ".site_url('orders'));
            }
            $offer_error = $this->request_packaging->get_msgError();
        }
        if (isset($data['paypack'])) {
            $this->load->library('smsitexmo');
            $success = $this->request_packaging->eval_order([
                'rpk_id'=>$request['rpk_id'],
                'm_id'=>$member['m_id'],
                'rpk_status'=>5,
            ]);
            if ($success) {
                $this->session->system_notify = "Payment confirmed! Your "
                        . "recipient will be informed shortly.";
                $this->session->system_notify_context = "success";
                $extra_error = $this->request_packaging->get_msgError();
                if (!empty($extra_error)) {
                    $this->session->system_notify = $extra_error;
                    $this->session->system_notify_context = "warning";
                }
                header("Location: ".site_url('orders'));
            }
            $offer_error = $this->request_packaging->get_msgError();
        }
        if (isset($data['negpack'])) {
            $this->form_validation->set_rules('quantity', 'Quantity needed', 'required|is_natural');
            $this->form_validation->set_rules('duedate', 'Date needed', 'required');
            $this->form_validation->set_rules('use_member', 'Address to use', 'required');
            if (isset($data['use_member']) && $data['use_member'] == 0) {
                $this->form_validation->set_rules('province', 'Delivery address (province)', 'required');
                $this->form_validation->set_rules('city', 'Delivery address (city)', 'required');
                $this->form_validation->set_rules('address', 'Delivery address (address)', 'trim|required|max_length[140]');
            }
        }
        if (isset($data['sendpack'])) {
            $this->form_validation->set_rules('courier', 'Courier name', 'alpha_numeric_spaces');
            if (isset($data['track']) && $data['track'] == 1) {
                $this->form_validation->set_rules('trackno', 'Tracking number', 'required|alpha_numeric');
            }
        }
        if (isset($data['heypack'])) {
            $this->form_validation->set_rules('subject', 'Subject', 'trim|required|max_length[140]');
            $this->form_validation->set_rules('message', 'Message', 'trim|required');
        }
        
        $this->load->view('templates/metahead', [
            'page_title' => $page_title,
            'sidebar' => TRUE,
            'datetimepicker' => TRUE,
            'addressselect' => TRUE,
        ]);
        $this->load->view('pieces/navbar', [
            'page_title' => 'Orders',
            'm_id' => $member['m_id'],
        ]);
        $this->load->view('pieces/sidebar', [
            'page_title' => $page_title,
            'parent_page_title' => 'Orders'
        ]);
        
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('pieces/form-pieces');
            $this->load->view('pages/pack_request', [
                'm_id'=>$member['m_id'],
                'request_string' => $order_string,
                'request_id' => $request_id,
                'request_client_name' => $request_client_name,
                'request_store_name' => $request_store_name,
                'request' => $request,
                'cities' => $this->address->get_city(),
            ]);
        }
        else {
            $offer_error='';
            if (isset($data['negpack'])) {
                $this->load->library('smsitexmo');
                $success = false;
                $new_status = 0;
                if ($request['m_id']==$member['m_id']) {
                    $new_status = 0;
                }
                else {
                    $new_status = 1;
                }
                
                $address_in_use = [];
                if ($data['use_member'] == 0) {
                    $address_in_use['ac_id'] = $data['city'];
                    $address_in_use['a_address'] = $data['address'];
                }
                else {
                    $address_in_use['a_id'] = $data['use_member'];
                }
                $entry = [
                    'm_id'=>$member['m_id'],
                    'rpk_options'=>$data['pack_options'],
                    'rpk_packnotes'=> html_escape($data['pack_notes']),
                    'rpk_quantity'=>$data['quantity'],
                    'rpk_duedate'=>$data['duedate'],
                    'rpk_deliverto'=>$address_in_use,
                    'rpk_delivernotes'=> html_escape($data['notes']),
                    'rpk_id'=>$request_id,
                    'rpk_status'=>$new_status,
                ];
                $success = $this->request_packaging->nego_order($entry);
                if ($success) {
                    $this->session->system_notify = "Negotiation sent successfully! Your "
                            . "recipient will be informed shortly.";
                    $this->session->system_notify_context = "success";
                    $extra_error = $this->request_packaging->get_msgError();
                    if (!empty($extra_error)) {
                        $this->session->system_notify = $extra_error;
                        $this->session->system_notify_context = "warning";
                    }
                    header("Location: ".site_url('orders'));
                }
                $offer_error = $this->request_packaging->get_msgError();
            }
            if (isset($data['sendpack'])) {
                $this->load->library('smsitexmo');
                $success = false;
                $new_status = 3;
                $courier = $data['courier'];
                if (empty($data['courier'])) {
                    $courier = "Own courier";
                }
                $trackno = 0;
                if (isset($data['track']) && $data['track'] == 1) {
                    $trackno = strtoupper($data['trackno']);
                }
                
                $send_offer = [
                    'm_id'=>$member['m_id'],
                    'rpk_status'=>$new_status,
                    'rpk_id'=>$request_id,
                    'rpksh_courier'=>$courier,
                    'rpksh_trackno'=>$trackno,
                ];
                $success = $this->request_packaging->send_order($send_offer);
                if ($success) {
                    $this->session->system_notify = "Packages sent successfully! Your "
                            . "recipient will be informed shortly.";
                    $this->session->system_notify_context = "success";
                    $extra_error = $this->request_packaging->get_msgError();
                    if (!empty($extra_error)) {
                        $this->session->system_notify = $extra_error;
                        $this->session->system_notify_context = "warning";
                    }
                    header("Location: ". site_url('orders'));
                }
                $offer_error = 'You man send out your order.';
            }
            if (isset($data['heypack'])) {
                $seller = $this->member->find_owner([
                    's_id'=>$request['s_id']
                ]);
                $is_seller = $seller['m_id'] == $member['m_id'];
                $recipient_id = "";
                if ($is_seller) {
                    $recipient_id = $request['m_id'];
                }
                else {
                    $recipient_id = $seller['m_id'];
                }
                $entry = [
                    'msg_sender'=>$member['m_id'],
                    'msg_recipient'=>$recipient_id,
                    'msg_subject'=>$data['subject'],
                    'msg_body'=>$data['message'],
                    'msg_read'=>0,
                ];
                unset($recipient_id,$seller,$is_seller);
                $success = $this->message->create($entry);
                if ($success == TRUE) {
                    // TODO Inform on that page
                    header("Location: ". site_url('orders'));
                }
                $offer_error = $this->message->get_msgError();
            }
            
            $this->load->view('pieces/form-pieces');
            $this->load->view('pages/pack_request', [
                'm_id'=>$member['m_id'],
                'request_string' => $order_string,
                'request_id' => $request_id,
                'request_client_name' => $request_client_name,
                'request_store_name' => $request_store_name,
                'request' => $request,
                'cities' => $this->address->get_city(),
                'offer_error' => $offer_error,
            ]);
        }
        $this->load->view('templates/metafoot', [
            'sidebar' => TRUE,
            'datetimepicker' => TRUE,
            'addressselect' => TRUE,
        ]);
    }
    private function orders_roast($member, $order_string) {
        $order_array = preg_split("/\+/", $order_string);
        $request_id = array_pop($order_array);
        $request_client_name_string = array_shift($order_array);
        $request_store_name_string = urldecode(implode('-',$order_array));
        $request_client_name = str_replace('_',' ',$request_client_name_string);
        $request_store_name = str_replace('_',' ',$request_store_name_string);
        
        $this->load->helper('form');
        $this->load->library('form_validation');
        
        $page_title = 'Roast for '.$request_client_name.' by '.$request_store_name;
        $request = $this->request_roast->identify([
            'rro_id'=>$request_id
        ]);
        
        $offer_error='';
        $data = $this->input->post(null, true);
        if (isset($data['offerroast'])) {
            $this->load->library('smsitexmo');
            // No validation.
            $success = false;
            switch ($data['offerroast']) {
                case 'yes': {
                    // Use 2 to accept
                    $success = $this->request_roast->eval_order([
                        'rro_id'=>$request['rro_id'],
                        'm_id'=>$member['m_id'],
                        'rro_status'=>2,
                    ]);
                    break;
                }
                case 'no': {
                    // Use 6 to reject
                    $success = $this->request_roast->eval_order([
                        'rro_id'=>$request['rro_id'],
                        'm_id'=>$member['m_id'],
                        'rro_status'=>6,
                    ]);
                    break;
                }
            }
            if ($success) {
                $this->session->system_notify = "Evaluation sent successfully! Your "
                        . "recipient will be informed shortly.";
                $this->session->system_notify_context = "success";
                $extra_error = $this->request_roast->get_msgError();
                if (!empty($extra_error)) {
                    $this->session->system_notify = $extra_error;
                    $this->session->system_notify_context = "warning";
                }
                session_write_close();
                header("Location: ".site_url('orders'));
            }
            $offer_error = $this->request_roast->get_msgError();
        }
        if (isset($data['receiveroast'])) {
            $this->load->library('smsitexmo');
            $success = $this->request_roast->eval_order([
                'rro_id'=>$request['rro_id'],
                'm_id'=>$member['m_id'],
                'rro_status'=>4,
            ]);
            if ($success) {
                $this->session->system_notify = "Receiving confirmed! Your "
                        . "recipient will be informed shortly.";
                $this->session->system_notify_context = "success";
                $extra_error = $this->request_roast->get_msgError();
                if (!empty($extra_error)) {
                    $this->session->system_notify = $extra_error;
                    $this->session->system_notify_context = "warning";
                }
                session_write_close();
                header("Location: ".site_url('orders'));
            }
            $offer_error = $this->request_roast->get_msgError();
        }
        if (isset($data['payroast'])) {
            $this->load->library('smsitexmo');
            $success = $this->request_roast->eval_order([
                'rro_id'=>$request['rro_id'],
                'm_id'=>$member['m_id'],
                'rro_status'=>5,
            ]);
            if ($success) {
                $this->session->system_notify = "Payment confirmed! Your "
                        . "recipient will be informed shortly.";
                $this->session->system_notify_context = "success";
                $extra_error = $this->request_roast->get_msgError();
                if (!empty($extra_error)) {
                    $this->session->system_notify = $extra_error;
                    $this->session->system_notify_context = "warning";
                }
                session_write_close();
                header("Location: ".site_url('orders'));
            }
            $offer_error = $this->request_roast->get_msgError();
        }
        if (isset($data['negroast'])) {
            $this->form_validation->set_rules('roast', 'Roast type', 'required');
            $this->form_validation->set_rules('quantity', 'Quantity needed', 'required|greater_than[0]|decimal',[
                'greater_than' => 'You must enter a positive value of %s.'
            ]);
            $this->form_validation->set_rules('duedate', 'Date needed', 'required');
            if (isset($data['use_member']) && $data['use_member'] == 0) {
                $this->form_validation->set_rules('province', 'Store address (province)', 'required');
                $this->form_validation->set_rules('city', 'Store address (city)', 'required');
                $this->form_validation->set_rules('address', 'Store address (address)', 'trim|required|max_length[140]');
            }
        }
        if (isset($data['sendroast'])) {
            $this->form_validation->set_rules('courier', 'Courier name', 'alpha_numeric_spaces');
            if (isset($data['track']) && $data['track'] == 1) {
                $this->form_validation->set_rules('trackno', 'Tracking number', 'required|alpha_numeric');
            }
        }
        if (isset($data['heyroast'])) {
            $this->form_validation->set_rules('subject', 'Subject', 'trim|required|max_length[140]');
            $this->form_validation->set_rules('message', 'Message', 'trim|required');
        }
        
        $this->load->view('templates/metahead', [
            'page_title' => $page_title,
            'sidebar' => TRUE,
            'datetimepicker' => TRUE,
            'addressselect' => TRUE,
        ]);
        $this->load->view('pieces/navbar', [
            'page_title' => 'Orders',
            'm_id' => $member['m_id'],
        ]);
        $this->load->view('pieces/sidebar', [
            'page_title' => $page_title,
            'parent_page_title' => 'Orders'
        ]);
        
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('pieces/form-pieces');
            $this->load->view('pages/roast_request', [
                'm_id'=>$member['m_id'],
                'request_string' => $order_string,
                'request_id' => $request_id,
                'request_client_name' => $request_client_name,
                'request_store_name' => $request_store_name,
                'request' => $request,
                'cities' => $this->address->get_city(),
                'offer_error' => $offer_error,
            ]);
        }
        else {
            if (isset($data['negroast'])) {
                $this->load->library('smsitexmo');
                $success = false;
                $new_status = 0;
                if ($request['m_id']==$member['m_id']) {
                    $new_status = 0;
                }
                else {
                    $new_status = 1;
                }
                
                $address_in_use = [];
                if ($data['use_member'] == 0) {
                    $address_in_use['ac_id'] = $data['city'];
                    $address_in_use['a_address'] = $data['address'];
                }
                else {
                    $address_in_use['a_id'] = $data['use_member'];
                }
                $entry = [
                    'm_id'=>$member['m_id'],
                    'rro_roast'=>$data['roast'],
                    'rro_quantity'=>$data['quantity'],
                    'rro_roastnotes'=>$data['roast_notes'],
                    'rro_duedate'=>$data['duedate'],
                    'rro_deliverto'=>$address_in_use,
                    'rro_delivernotes'=> html_escape($data['notes']),
                    'rro_id'=>$request_id,
                    'rro_status'=>$new_status,
                ];
                $success = $this->request_roast->nego_order($entry);
                if ($success) {
                    $this->session->system_notify = "Negotiation sent successfully! Your "
                            . "recipient will be informed shortly.";
                    $this->session->system_notify_context = "success";
                    $extra_error = $this->request_roast->get_msgError();
                    if (!empty($extra_error)) {
                        $this->session->system_notify = $extra_error;
                        $this->session->system_notify_context = "warning";
                    }
                    session_write_close();
                    header("Location: ".site_url('orders'));
                }
                $offer_error = $this->request_roast->get_msgError();
            }
            if (isset($data['sendroast'])) {
                $this->load->library('smsitexmo');
                $success = false;
                $new_status = 3;
                $courier = $data['courier'];
                if (empty($data['courier'])) {
                    $courier = "Own courier";
                }
                $trackno = 0;
                if (isset($data['track']) && $data['track'] == 1) {
                    $trackno = strtoupper($data['trackno']);
                }
                
                $send_offer = [
                    'm_id'=>$member['m_id'],
                    'rro_status'=>$new_status,
                    'rro_id'=>$request_id,
                    'rrosh_courier'=>$courier,
                    'rrosh_trackno'=>$trackno,
                ];
                $success = $this->request_roast->send_order($send_offer);
                if ($success) {
                    $this->session->system_notify = "Roasted beans sent successfully! Your "
                            . "recipient will be informed shortly.";
                    $this->session->system_notify_context = "success";
                    $extra_error = $this->request_roast->get_msgError();
                    if (!empty($extra_error)) {
                        $this->session->system_notify = $extra_error;
                        $this->session->system_notify_context = "warning";
                    }
                    session_write_close();
                    header("Location: ". site_url('orders'));
                }
                $offer_error = 'You man send out your order.';
            }
            if (isset($data['heyroast'])) {
                $seller = $this->member->find_owner([
                    's_id'=>$request['s_id']
                ]);
                $is_seller = $seller['m_id'] == $member['m_id'];
                $recipient_id = "";
                if ($is_seller) {
                    $recipient_id = $request['m_id'];
                }
                else {
                    $recipient_id = $seller['m_id'];
                }
                $entry = [
                    'msg_sender'=>$member['m_id'],
                    'msg_recipient'=>$recipient_id,
                    'msg_subject'=>$data['subject'],
                    'msg_body'=>$data['message'],
                    'msg_read'=>0,
                ];
                unset($recipient_id,$seller,$is_seller);
                $success = $this->message->create($entry);
                if ($success == TRUE) {
                    // TODO Inform on that page
                    header("Location: ". site_url('orders'));
                }
                $offer_error = $this->message->get_msgError();
            }
            
            $this->load->view('pieces/form-pieces');
            $this->load->view('pages/roast_request', [
                'm_id'=>$member['m_id'],
                'request_string' => $order_string,
                'request_id' => $request_id,
                'request_client_name' => $request_client_name,
                'request_store_name' => $request_store_name,
                'request' => $request,
                'cities' => $this->address->get_city(),
                'offer_error' => $offer_error,
            ]);
        }
        $this->load->view('templates/metafoot', [
            'sidebar' => TRUE,
            'datetimepicker' => TRUE,
            'addressselect' => TRUE,
        ]);
    }
    private function orders_proc($member, $order_string) {
        $order_array = preg_split("/\+/", $order_string);
        $request_id = array_pop($order_array);
        $request_client_name_string = array_shift($order_array);
        $request_store_name_string = urldecode(implode('-',$order_array));
        $request_client_name = str_replace('_',' ',$request_client_name_string);
        $request_store_name = str_replace('_',' ',$request_store_name_string);
        
        $this->load->helper('form');
        $this->load->library('form_validation');
        
        $page_title = 'Processing for '.$request_client_name.' by '.$request_store_name;
        $request = $this->request_processing->identify([
            'rproc_id'=>$request_id
        ]);
        
        $offer_error='';
        $data = $this->input->post(null, true);
        if (isset($data['offerproc'])) {
            $this->load->library('smsitexmo');
            // No validation.
            $success = false;
            switch ($data['offerproc']) {
                case 'yes': {
                    // Use 2 to accept
                    $success = $this->request_processing->eval_order([
                        'rproc_id'=>$request['rproc_id'],
                        'm_id'=>$member['m_id'],
                        'rproc_status'=>2,
                    ]);
                    break;
                }
                case 'no': {
                    // Use 6 to reject
                    $success = $this->request_processing->eval_order([
                        'rproc_id'=>$request['rproc_id'],
                        'm_id'=>$member['m_id'],
                        'rproc_status'=>6,
                    ]);
                    break;
                }
            }
            if ($success) {
                $this->session->system_notify = "Evaluation sent successfully! Your "
                        . "recipient will be informed shortly.";
                $this->session->system_notify_context = "success";
                $extra_error = $this->request_processing->get_msgError();
                if (!empty($extra_error)) {
                    $this->session->system_notify = $extra_error;
                    $this->session->system_notify_context = "warning";
                }
                header("Location: ".site_url('orders'));
            }
            $offer_error = $this->request_processing->get_msgError();
        }
        if (isset($data['receiveproc'])) {
            $this->load->library('smsitexmo');
            $success = $this->request_processing->eval_order([
                'rproc_id'=>$request['rproc_id'],
                'm_id'=>$member['m_id'],
                'rproc_status'=>4,
            ]);
            if ($success) {
                $this->session->system_notify = "Receiving confirmed! Your "
                        . "recipient will be informed shortly.";
                $this->session->system_notify_context = "success";
                $extra_error = $this->request_processing->get_msgError();
                if (!empty($extra_error)) {
                    $this->session->system_notify = $extra_error;
                    $this->session->system_notify_context = "warning";
                }
                header("Location: ".site_url('orders'));
            }
            $offer_error = $this->request_processing->get_msgError();
        }
        if (isset($data['payproc'])) {
            $this->load->library('smsitexmo');
            $success = $this->request_processing->eval_order([
                'rproc_id'=>$request['rproc_id'],
                'm_id'=>$member['m_id'],
                'rproc_status'=>5,
            ]);
            if ($success) {
                $this->session->system_notify = "Payment confirmed! Your "
                        . "recipient will be informed shortly.";
                $this->session->system_notify_context = "success";
                $extra_error = $this->request_processing->get_msgError();
                if (!empty($extra_error)) {
                    $this->session->system_notify = $extra_error;
                    $this->session->system_notify_context = "warning";
                }
                header("Location: ".site_url('orders'));
            }
            $offer_error = $this->request_processing->get_msgError();
        }
        if (isset($data['negproc'])) {
            $this->form_validation->set_rules('quantity', 'Quantity needed', 'required|greater_than[0]|decimal',[
                'greater_than' => 'You must enter a positive value of %s.'
            ]);
            $this->form_validation->set_rules('duedate', 'Date needed', 'required');
            if (isset($data['use_member']) && $data['use_member'] == 0) {
                $this->form_validation->set_rules('province', 'Store address (province)', 'required');
                $this->form_validation->set_rules('city', 'Store address (city)', 'required');
                $this->form_validation->set_rules('address', 'Store address (address)', 'trim|required|max_length[140]');
            }
        }
        if (isset($data['sendproc'])) {
            $this->form_validation->set_rules('courier', 'Courier name', 'alpha_numeric_spaces');
            if (isset($data['track']) && $data['track'] == 1) {
                $this->form_validation->set_rules('trackno', 'Tracking number', 'required|alpha_numeric');
            }
        }
        if (isset($data['heyproc'])) {
            $this->form_validation->set_rules('subject', 'Subject', 'trim|required|max_length[140]');
            $this->form_validation->set_rules('message', 'Message', 'trim|required');
        }
        
        $this->load->view('templates/metahead', [
            'page_title' => $page_title,
            'sidebar' => TRUE,
            'datetimepicker' => TRUE,
            'addressselect' => TRUE,
        ]);
        $this->load->view('pieces/navbar', [
            'page_title' => 'Orders',
            'm_id' => $member['m_id'],
        ]);
        $this->load->view('pieces/sidebar', [
            'page_title' => $page_title,
            'parent_page_title' => 'Orders'
        ]);
        
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('pieces/form-pieces');
            $this->load->view('pages/proc_request', [
                'm_id'=>$member['m_id'],
                'request_string' => $order_string,
                'request_id' => $request_id,
                'request_client_name' => $request_client_name,
                'request_store_name' => $request_store_name,
                'request' => $request,
                'cities' => $this->address->get_city(),
                'offer_error' => $offer_error,
            ]);
        }
        else {
            if (isset($data['negproc'])) {
                $this->load->library('smsitexmo');
                $success = false;
                $new_status = 0;
                if ($request['m_id']==$member['m_id']) {
                    $new_status = 0;
                }
                else {
                    $new_status = 1;
                }
                
                $address_in_use = [];
                if ($data['use_member'] == 0) {
                    $address_in_use['ac_id'] = $data['city'];
                    $address_in_use['a_address'] = $data['address'];
                }
                else {
                    $address_in_use['a_id'] = $data['use_member'];
                }
                $entry = [
                    'm_id'=>$member['m_id'],
                    'rproc_procnotes'=>$data['proc_notes'],
                    'rproc_quantity'=>$data['quantity'],
                    'rproc_duedate'=>$data['duedate'],
                    'rproc_deliverto'=>$address_in_use,
                    'rproc_delivernotes'=> html_escape($data['notes']),
                    'rproc_id'=>$request_id,
                    'rproc_status'=>$new_status,
                ];
                $success = $this->request_processing->nego_order($entry);
                if ($success) {
                    $this->session->system_notify = "Negotiation sent successfully! Your "
                            . "recipient will be informed shortly.";
                    $this->session->system_notify_context = "success";
                    $extra_error = $this->request_processing->get_msgError();
                    if (!empty($extra_error)) {
                        $this->session->system_notify = $extra_error;
                        $this->session->system_notify_context = "warning";
                    }
                    header("Location: ".site_url('orders'));
                }
                $offer_error = $this->request_processing->get_msgError();
            }
            if (isset($data['sendproc'])) {
                $this->load->library('smsitexmo');
                $success = false;
                $new_status = 3;
                $courier = $data['courier'];
                if (empty($data['courier'])) {
                    $courier = "Own courier";
                }
                $trackno = 0;
                if (isset($data['track']) && $data['track'] == 1) {
                    $trackno = strtoupper($data['trackno']);
                }
                
                $send_offer = [
                    'm_id'=>$member['m_id'],
                    'rproc_status'=>$new_status,
                    'rproc_id'=>$request_id,
                    'rprocsh_courier'=>$courier,
                    'rprocsh_trackno'=>$trackno,
                ];
                $success = $this->request_processing->send_order($send_offer);
                if ($success) {
                    $this->session->system_notify = "Processed beans sent successfully! Your "
                            . "recipient will be informed shortly.";
                    $this->session->system_notify_context = "success";
                    $extra_error = $this->request_processing->get_msgError();
                    if (!empty($extra_error)) {
                        $this->session->system_notify = $extra_error;
                        $this->session->system_notify_context = "warning";
                    }
                    header("Location: ". site_url('orders'));
                }
                $offer_error = 'You man send out your order.';
            }
            if (isset($data['heyproc'])) {
                $seller = $this->member->find_owner([
                    's_id'=>$request['s_id']
                ]);
                $is_seller = $seller['m_id'] == $member['m_id'];
                $recipient_id = "";
                if ($is_seller) {
                    $recipient_id = $request['m_id'];
                }
                else {
                    $recipient_id = $seller['m_id'];
                }
                $entry = [
                    'msg_sender'=>$member['m_id'],
                    'msg_recipient'=>$recipient_id,
                    'msg_subject'=>$data['subject'],
                    'msg_body'=>$data['message'],
                    'msg_read'=>0,
                ];
                unset($recipient_id,$seller,$is_seller);
                $success = $this->message->create($entry);
                if ($success == TRUE) {
                    // TODO Inform on that page
                    header("Location: ". site_url('orders'));
                }
                $offer_error = $this->message->get_msgError();
            }
            
            $this->load->view('pieces/form-pieces');
            $this->load->view('pages/proc_request', [
                'm_id'=>$member['m_id'],
                'request_string' => $order_string,
                'request_id' => $request_id,
                'request_client_name' => $request_client_name,
                'request_store_name' => $request_store_name,
                'request' => $request,
                'cities' => $this->address->get_city(),
                'offer_error' => $offer_error,
            ]);
        }
        $this->load->view('templates/metafoot', [
            'sidebar' => TRUE,
            'datetimepicker' => TRUE,
            'addressselect' => TRUE,
        ]);
    }
    
    public function view($wanted_page = "sample_page", $page_title = "Test page") {
        $this->load->helper('form');
        $this->load->library('session');
        $is_member = $this->member->identify([
            'm_id'=>$this->session->m_id
        ]);
        if (empty($is_member)) {
            $is_member['m_id'] = "";
        }
        
        $this->load->view('templates/metahead', [
            'page_title' => $page_title,
            'sidebar' => !empty($is_member['m_id']),
        ]);
        $this->load->view('pieces/navbar', [
            'page_title' => $page_title,
            'm_id' => $is_member['m_id'],
        ]);
        if ($is_member) {
            $this->load->view('pieces/sidebar', [
                'page_title' => $page_title,
                'parent_page_title' => $page_title
            ]);
        }
        $this->load->view('pieces/form-pieces');
        $this->load->view('pages/view/'.$wanted_page);
        $this->load->view('templates/metafoot', [
            'sidebar' => !empty($is_member['m_id']),
            'addressselect'=>TRUE,
            'packoptions'=>TRUE,
        ]);
    }
    
}
