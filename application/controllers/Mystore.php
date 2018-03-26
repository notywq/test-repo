<?php

class Mystore extends CI_Controller {
    public function index() {
        $this->load->library('session');
        
        $system_notify = "";
        if (!empty($this->session->system_notify)) {
            $system_notify = $this->session->system_notify;
        }
        $system_notify_context = "info";
        if (!empty($this->session->system_notify_context)) {
            $system_notify_context = $this->session->system_notify_context;
        }
        
        $member = $this->member->identify([
            'm_id'=>$this->session->m_id
        ]);
        if ($member == FALSE) {
            // Force logout
            header("Location: ".site_url('logout'));
        }
        $has_store = $this->store->identify([
            'm_id'=>$member['m_id']
                ]);
        if (!$has_store) {
            // Bring to setup automatically
            header("Location: ".site_url('mystore/setup'));
        }
        $s_open_word="";
        switch ($has_store['s_open']) {
            case 0: {
                $s_open_word="Closed";
                break;
            }
            case 1: {
                $s_open_word="Open";
                break;
            }
        }
        
        $beans_list = $this->beans->get_myBeans([
            's_id' => $has_store['s_id']
        ]);
        $roast_list = $this->roast->get_myRoasts([
            's_id' => $has_store['s_id']
        ]);
        $proc_list = $this->processing->get_myProcesses([
            's_id' => $has_store['s_id']
        ]);
        $pack_list = $this->package->get_myPackages([
            's_id' => $has_store['s_id']
        ]);
        
        $this->load->view('templates/metahead', [
            'page_title' => 'My store',
            'sidebar' => TRUE,
        ]);
        $this->load->view('pieces/navbar', [
            'page_title' => 'My store',
            'system_notify' => $system_notify,
            'system_notify_context' => $system_notify_context,
            'm_id' => $member['m_id'],
        ]);
        $this->load->view('pieces/sidebar', [
            'page_title' => 'My store',
            'parent_page_title' => 'My store'
        ]);
        $this->load->view('pieces/form-pieces');
        $this->load->view('mystore/mystore', [
            'page_title' => 'My store',
            'system_notify' => $system_notify,
            'system_notify_context' => $system_notify_context,
            's_id' => $has_store['s_id'],
            's_name' => $has_store['s_name'],
            's_open' => $s_open_word,
            'beans_list' => $beans_list,
            'roast_list' => $roast_list,
            'proc_list' => $proc_list,
            'pack_list' => $pack_list,
        ]);
        $this->clear_notifs();
        $this->load->view('templates/metafoot', [
            'sidebar' => TRUE,
        ]);
    }
    public function setup() {
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('sname', 'Store name', 'trim|required');
        $data = $this->input->post(null, true);
        $this->form_validation->set_rules('use_member', 'Store address to use', 'required');
        if (isset($data['use_member']) && $data['use_member'] == 0) {
            $this->form_validation->set_rules('province', 'Store address (province)', 'required');
            $this->form_validation->set_rules('city', 'Store address (city)', 'required');
            $this->form_validation->set_rules('address', 'Store address (address)', 'trim|required|max_length[140]');
        }
        $this->form_validation->set_rules('orderdays', 'Minimum order days',
                'trim|is_natural', [
                    'is_natural' => 'Enter a realistic number for %s.'
                ]);
        $this->form_validation->set_rules('editdays', 'Edit before',
                'trim|is_natural', [
                    'is_natural' => 'Enter a realistic number for %s.'
                ]);
        $this->form_validation->set_rules('returndays', 'Return before',
                'trim|is_natural', [
                    'is_natural' => 'Enter a realistic number for %s.'
                ]);
        
        $this->load->library('session');
        
        $member = $this->member->identify([
            'm_id'=>$this->session->m_id
                ]);
        if ($member == FALSE) {
            // Force logout
            header("Location: ".site_url('home/logout'));
        }
        
        $this->load->view('templates/metahead', [
            'page_title' => 'Setup store',
            'sidebar' => TRUE
        ]);
        $this->load->view('pieces/navbar', [
            'page_title' => 'My store',
            'm_id' => $member['m_id'],
        ]);
        $this->load->view('pieces/sidebar', [
            'page_title' => 'Setup store',
            'parent_page_title' => 'My store'
        ]);
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('pieces/form-pieces');
            $this->load->view('mystore/setup', [
                'page_title' => 'Setup store',
                'm_id' => $member['m_id'],
            ]);
        }
        else {
            // TODO Create or edit here
            $data = $this->input->post(null, true);
            $setup_error='';
            if (isset($data['setup'])) {
                $address_in_use = [];
                if ($data['use_member'] == 0) {
                    $address_in_use['ac_id'] = $data['city'];
                    $address_in_use['a_address'] = $data['address'];
                }
                else {
                    $address_in_use['a_id'] = $data['use_member'];
                }
                $entry = [
                    's_name'=>$data['sname'],
                    'm_id'=>$member['m_id'],
                    's_address'=>$address_in_use,
                    's_desc'=>$data['desc'],
                    's_rules'=>$data['rules'],
                    's_orderdays'=>$data['orderdays'],
                    's_editdays'=>$data['editdays'],
                    's_returndays'=>$data['returndays']
                ];
                $success = $this->store->create($entry);
                if ($success == TRUE) {
                    $this->session->system_notify = "Store created! "
                            . "Use the sections below to offer your products and services.";
                    $this->session->system_notify_context = "success";
                    session_write_close();
                    
                    header("Location: ".site_url('mystore'));
                }
                $setup_error=$this->store->get_msgError();
            }
            
            $s_name=$this->input->post('sname');
            $this->load->view('pieces/form-pieces');
            $this->load->view('mystore/setup', [
                'page_title' => 'Setup store',
                's_name' => html_escape($s_name),
                'm_id' => $member['m_id'],
                'setup_error' => $setup_error
            ]);
        }
        $this->load->view('templates/metafoot', [
            'sidebar' => TRUE,
            'addressselect' => TRUE
        ]);
    }
    public function addbeans() {
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('species[]', 'Species', 'required');
        $this->form_validation->set_rules('roast', 'Roast type', 'required');
        $this->form_validation->set_rules('roastdate', 'Roast date', 'trim|required');
        $this->form_validation->set_rules('origin', 'Origin', 'trim|required');
        $this->form_validation->set_rules('unitprice', 'Unit price', 'trim|required|decimal');
        $this->form_validation->set_rules('use_store', 'Delivery address to use', 'required');
        $data = $this->input->post(null, true);
        if (isset($data['use_store']) && $data['use_store'] == 0) {
            $this->form_validation->set_rules('province', 'Other address (province)', 'required');
            $this->form_validation->set_rules('city', 'Other address (city)', 'required');
            $this->form_validation->set_rules('address', 'Other address (address)', 'trim|required|max_length[140]');
        }
        $this->form_validation->set_rules('orderdays', 'Minimum order days', 'trim|is_natural', [
                'is_natural' => 'Enter a realistic number for %s.'
        ]);
        $this->form_validation->set_rules('minqty', 'Minimum order quantity', 'trim|decimal|greater_than_equal_to[0]', [
                'greater_than_equal_to' => 'Enter a realistic number for %s.'
        ]);
        
        $this->load->library('session');
        
        $member = $this->member->identify([
            'm_id'=>$this->session->m_id
        ]);
        if ($member == FALSE) {
            // Force logout
            header("Location: ".site_url('home/logout'));
        }
        $has_store = $this->store->identify([
            'm_id'=>$member['m_id']
                ]);
        if (!$has_store) {
            // Bring to index automatically
            header("Location: ".site_url('mystore'));
        }
        
        $this->load->view('templates/metahead', [
            'page_title' => 'Add beans',
            'datetimepicker' => TRUE,
            'sidebar' => TRUE
        ]);
        $this->load->view('pieces/navbar', [
            'page_title' => 'My store',
            'm_id' => $member['m_id'],
        ]);
        $this->load->view('pieces/sidebar', [
            'page_title' => 'Add beans',
            'parent_page_title' => 'My store'
        ]);
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('pieces/form-pieces');
            $this->load->view('mystore/addbeans', [
                'page_title' => 'Add beans',
                's_id'=>$has_store['s_id'],
            ]);
        }
        else {
            $data = $this->input->post(null, true);
            $addbeans_error='';
            if (isset($data['addbeans'])) {
                $address_in_use = [];
                if ($data['use_store'] == 0) {
                    $address_in_use['ac_id'] = $data['city'];
                    $address_in_use['a_address'] = $data['address'];
                }
                else {
                    $address_in_use['a_id'] = $data['use_store'];
                }
                $entry = [
                    's_id' => $has_store['s_id'],
                    'b_species_list' => $data['species'],
                    'b_roast' => $data['roast'],
                    'b_roastdate' => $data['roastdate'],
                    'b_desc' => $data['desc'],
                    'b_additions_list' => $data['additions'],
                    'b_origin' => $data['origin'],
                    'b_unitprice' => $data['unitprice'],
                    'b_deliverfrom' => $address_in_use,
                    'b_orderdays' => $data['orderdays'],
                    'b_minqty' => $data['minqty'],
                ];
                $success = $this->beans->create($entry);
                if ($success == TRUE) {
                    $this->session->system_notify = "Batch of beans added!";
                    $this->session->system_notify_context = "success";
                    session_write_close();
                    header("Location: ". site_url('mystore'));
                }
                $addbeans_error=$this->beans->get_msgError();
//                $addbeans_error="But the validation is ready now. Make the model!";
            }
            
            $this->load->view('pieces/form-pieces');
            $this->load->view('mystore/addbeans', [
                'page_title' => 'Add beans',
                's_id'=>$has_store['s_id'],
                'addbeans_error' => $addbeans_error
            ]);
        }
        $this->load->view('templates/metafoot', [
            'datetimepicker' => TRUE,
            'addressselect' => TRUE,
            'sidebar' => TRUE
        ]);
    }
    public function addroast() {
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('roast[]', 'Supported roasts', 'required');
        $this->form_validation->set_rules('desc', 'Description', 'trim');
        $this->form_validation->set_rules('use_store', 'Delivery address to use', 'required');
        $data = $this->input->post(null, true);
        if (isset($data['use_store']) && $data['use_store'] == 0) {
            $this->form_validation->set_rules('province', 'Other address (province)', 'required');
            $this->form_validation->set_rules('city', 'Other address (city)', 'required');
            $this->form_validation->set_rules('address', 'Other address (address)', 'trim|required|max_length[140]');
        }
        $this->form_validation->set_rules('unitprice', 'Unit price', 'trim|required|decimal');
        $this->form_validation->set_rules('orderdays', 'Minimum order days', 'trim|is_natural', [
                'is_natural' => 'Enter a realistic number for %s.'
        ]);
        $this->form_validation->set_rules('minqty', 'Minimum order quantity', 'trim|decimal|greater_than_equal_to[0]', [
                'greater_than_equal_to' => 'Enter a realistic number for %s.'
        ]);
        $this->load->library('session');
        
        $member = $this->member->identify([
            'm_id'=>$this->session->m_id
        ]);
        if ($member == FALSE) {
            // Force logout
            header("Location: ".site_url('home/logout'));
        }
        $has_store = $this->store->identify([
            'm_id'=>$member['m_id']
        ]);
        if (!$has_store) {
            // Bring to index automatically
            header("Location: ".site_url('mystore'));
        }
        
        $this->load->view('templates/metahead', [
            'page_title' => 'Add roast',
            'datetimepicker' => TRUE,
            'sidebar' => TRUE
        ]);
        $this->load->view('pieces/navbar', [
            'page_title' => 'My store',
            'm_id' => $member['m_id'],
        ]);
        $this->load->view('pieces/sidebar', [
            'page_title' => 'Add roast',
            'parent_page_title' => 'My store'
        ]);
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('pieces/form-pieces');
            $this->load->view('mystore/addroast', [
                'page_title' => 'Add roast',
                's_id'=>$has_store['s_id'],
            ]);
        }
        else {
            $addroast_error = "This could work.";
            $data = $this->input->post(null, true);
            if (isset($data['addroast'])) {
                $address_in_use = [];
                if ($data['use_store'] == 0) {
                    $address_in_use['ac_id'] = $data['city'];
                    $address_in_use['a_address'] = $data['address'];
                }
                else {
                    $address_in_use['a_id'] = $data['use_store'];
                }
                $roast = [
                    's_id'=>$has_store['s_id'],
                    'b_roast_array'=>$data['roast'],
                    'ro_desc'=>$data['desc'],
                    'ro_open'=>1,
                    'ro_address'=>$address_in_use,
                    'ro_unitprice'=>$data['unitprice'],
                    'ro_orderdays'=>$data['orderdays'],
                    'ro_minqty'=>$data['minqty'],
                ];
                $success = $this->roast->create($roast);
                if ($success === TRUE) {
                    $this->session->system_notify = "Roasting service added!";
                    $this->session->system_notify_context = "success";
                    session_write_close();
                    header("Location: ". site_url('mystore'));
                }
                $addroast_error = $this->roast->get_msgError();
            }
            
            $this->load->view('pieces/form-pieces');
            $this->load->view('mystore/addroast', [
                'page_title' => 'Add roast',
                's_id'=>$has_store['s_id'],
                'addroast_error' => $addroast_error,
            ]);
        }
        $this->load->view('templates/metafoot', [
            'datetimepicker' => TRUE,
            'addressselect' => TRUE,
            'sidebar' => TRUE
        ]);
    }
    public function addproc() {
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('processing', 'Processing activity', 'required');
        $this->form_validation->set_rules('desc', 'Description', 'trim');
        $this->form_validation->set_rules('use_store', 'Delivery address to use', 'required');
        $data = $this->input->post(null, true);
        if (isset($data['use_store']) && $data['use_store'] == 0) {
            $this->form_validation->set_rules('province', 'Other address (province)', 'required');
            $this->form_validation->set_rules('city', 'Other address (city)', 'required');
            $this->form_validation->set_rules('address', 'Other address (address)', 'trim|required|max_length[140]');
        }
        $this->form_validation->set_rules('unitprice', 'Unit price', 'trim|required|decimal');
        $this->form_validation->set_rules('orderdays', 'Minimum order days', 'trim|is_natural', [
                'is_natural' => 'Enter a realistic number for %s.'
        ]);
        $this->form_validation->set_rules('minqty', 'Minimum order quantity', 'trim|decimal|greater_than_equal_to[0]', [
                'greater_than_equal_to' => 'Enter a realistic number for %s.'
        ]);
        $this->load->library('session');
        
        $member = $this->member->identify([
            'm_id'=>$this->session->m_id
        ]);
        if ($member == FALSE) {
            // Force logout
            header("Location: ".site_url('home/logout'));
        }
        $has_store = $this->store->identify([
            'm_id'=>$member['m_id']
                ]);
        if (!$has_store) {
            // Bring to index automatically
            header("Location: ".site_url('mystore'));
        }
        
        $this->load->view('templates/metahead', [
            'page_title' => 'Add process',
            'datetimepicker' => TRUE,
            'sidebar' => TRUE
        ]);
        $this->load->view('pieces/navbar', [
            'page_title' => 'My store',
            'm_id' => $member['m_id'],
        ]);
        $this->load->view('pieces/sidebar', [
            'page_title' => 'Add process',
            'parent_page_title' => 'My store'
        ]);
        if ($this->form_validation->run() == false) {
            $this->load->view('pieces/form-pieces');
            $this->load->view('mystore/addproc', [
                'page_title' => 'Add processor',
                's_id'=>$has_store['s_id'],
            ]);
        }
        else {
            $addproc_error = "";
            $data = $this->input->post(null,true);
            if (isset($data['addproc'])) {
                $address_in_use = [];
                if ($data['use_store'] == 0) {
                    $address_in_use['ac_id'] = $data['city'];
                    $address_in_use['a_address'] = $data['address'];
                }
                else {
                    $address_in_use['a_id'] = $data['use_store'];
                }
                $processor = [
                    's_id'=>$has_store['s_id'],
                    'proc_desc'=>$data['desc'],
                    'proc_activity'=>$data['processing'],
                    'proc_unitprice'=>$data['unitprice'],
                    'proc_open'=>1,
                    'proc_address'=>$address_in_use,
                    'proc_orderdays'=>$data['orderdays'],
                    'proc_minqty'=>$data['minqty'],
                ];
                $success = $this->processing->create($processor);
                if ($success) {
                    $this->session->system_notify = "Processing service added!";
                    $this->session->system_notify_context = "success";
                    session_write_close();
                    header('Location: '.site_url('mystore'));
                }
                $addproc_error = $this->processing->get_msgError();
            }
            $this->load->view('pieces/form-pieces');
            $this->load->view('mystore/addproc', [
                'page_title' => 'Add processor',
                's_id'=>$has_store['s_id'],
                'addproc_error' => $addproc_error,
            ]);
        }
        $this->load->view('templates/metafoot', [
            'datetimepicker' => TRUE,
            'addressselect' => TRUE,
            'sidebar' => TRUE
        ]);
    }
    public function addpack() {
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('type', 'Package type', 'required');
        $this->form_validation->set_rules('material', 'Material', 'required');
        $this->form_validation->set_rules('capacity', 'Capacity', 'required|decimal');
        $this->form_validation->set_rules('color', 'Color', 'required');
        $this->form_validation->set_rules('desc', 'Description', 'trim');
        $this->form_validation->set_rules('use_store', 'Delivery address to use', 'required');
        $data = $this->input->post(null, true);
        if (isset($data['use_store']) && $data['use_store'] == 0) {
            $this->form_validation->set_rules('province', 'Other address (province)', 'required');
            $this->form_validation->set_rules('city', 'Other address (city)', 'required');
            $this->form_validation->set_rules('address', 'Other address (address)', 'trim|required|max_length[140]');
        }
        $this->form_validation->set_rules('unitprice', 'Unit price', 'trim|required|decimal');
        $this->form_validation->set_rules('qtyperunit', 'Quantity per unit', 'trim|required|is_natural_no_zero', [
                'is_natural' => 'Enter a realistic number for %s.'
        ]);
        $this->form_validation->set_rules('orderdays', 'Minimum order days', 'trim|is_natural', [
                'is_natural' => 'Enter a realistic number for %s.'
        ]);
        $this->form_validation->set_rules('minqty', 'Minimum order quantity', 'trim|is_natural_no_zero', [
                'is_natural_no_zero' => 'Enter a realistic number for %s.'
        ]);
        $this->load->library('session');
        
        $member = $this->member->identify([
            'm_id'=>$this->session->m_id
        ]);
        if ($member == FALSE) {
            // Force logout
            header("Location: ".site_url('home/logout'));
        }
        $member_fmlName = $this->member->get_name([
            'm_id'=>$this->session->m_id,
        ]);
        $member_flName = $this->member->get_name([
            'm_id'=>$this->session->m_id,
            'pref'=>'fl'
        ]);
        $has_store = $this->store->identify([
            'm_id'=>$member['m_id']
                ]);
        if (!$has_store) {
            // Bring to index automatically
            header("Location: ".site_url('mystore'));
        }
        
        $this->load->view('templates/metahead', [
            'page_title' => 'Add package',
            'datetimepicker' => TRUE,
            'sidebar' => TRUE
        ]);
        $this->load->view('pieces/navbar', [
            'page_title' => 'My store',
            'm_id' => $member['m_id'],
            'm_fmlname' => $member_fmlName,
            'm_flname' => $member_flName
        ]);
        $this->load->view('pieces/sidebar', [
            'page_title' => 'Add package',
            'parent_page_title' => 'My store'
        ]);
        if($this->form_validation->run() == false) {
            $this->load->view('pieces/form-pieces');
            $this->load->view('mystore/addpack', [
                'page_title' => 'Add package',
                's_id'=>$has_store['s_id']
            ]);
        }
        else {
            $addpack_error = "";
            $data = $this->input->post(null,true);
            if (isset($data['addpack'])) {
                $address_in_use = [];
                if ($data['use_store'] == 0) {
                    $address_in_use['ac_id'] = $data['city'];
                    $address_in_use['a_address'] = $data['address'];
                }
                else {
                    $address_in_use['a_id'] = $data['use_store'];
                }
                $package = [
                    's_id'=>$has_store['s_id'],
                    'pk_type'=>$data['type'],
                    'pk_material'=>$data['material'],
                    'pk_capacity'=>$data['capacity'],
                    'pk_color'=>$data['color'],
                    'pk_desc'=>$data['desc'],
                    'pk_address'=>$address_in_use,
                    'pk_unitprice'=>$data['unitprice'],
                    'pk_qtyperunit'=>$data['qtyperunit'],
                    'pk_open'=>1,
                    'pk_orderdays'=>$data['orderdays'],
                    'pk_minqty'=>$data['minqty'],
                    'pk_option_array'=>$data['pack_option'],
                    'pkopt_price_array'=>$data['packopt_price'],
                ];
                $success = $this->package->create($package);
                if ($success) {
                    $this->session->system_notify = "Package added!";
                    $this->session->system_notify_context = "success";
                    session_write_close();
                    header("Location: ".site_url('mystore'));
                }
                $addpack_error = $this->package->get_msgError();
            }
            $this->load->view('pieces/form-pieces');
            $this->load->view('mystore/addpack', [
                'page_title' => 'Add package',
                's_id'=>$has_store['s_id'],
                'addpack_error' => $addpack_error,
            ]);
        }
        $this->load->view('templates/metafoot', [
            'datetimepicker' => TRUE,
            'addressselect' => TRUE,
            'packoptions' => TRUE,
            'sidebar' => TRUE,
        ]);
    }
    
    private function clear_notifs() {
        $this->load->library('session');
        $this->session->system_notify = "";
        $this->session->system_notify_context = "info";
    }
}
