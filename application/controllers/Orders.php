<?php

class Orders extends CI_Controller {
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
        $request_beans = $this->request_beans->get_allMyRequests([
            'm_id'=>$member['m_id']
        ]);
        $requesting_beans = $this->request_beans->get_allMyRequests([
            's_id'=>$has_store['s_id']
        ]);
        $request_roast = $this->request_roast->get_allMyRequests([
            'm_id'=>$member['m_id']
        ]);
        $requesting_roast = $this->request_roast->get_allMyRequests([
            's_id'=>$has_store['s_id']
        ]);
        $request_proc = $this->request_processing->get_allMyRequests([
            'm_id'=>$member['m_id']
        ]);
        $requesting_proc = $this->request_processing->get_allMyRequests([
            's_id'=>$has_store['s_id']
        ]);
        $request_pack = $this->request_packaging->get_allMyRequests([
            'm_id'=>$member['m_id']
        ]);
        $requesting_pack = $this->request_packaging->get_allMyRequests([
            's_id'=>$has_store['s_id']
        ]);
        
        $this->load->view('templates/metahead', [
            'page_title' => 'Orders',
            'sidebar' => TRUE
        ]);
        $this->load->view('pieces/navbar', [
            'page_title' => 'Orders',
            'system_notify' => $system_notify,
            'system_notify_context' => $system_notify_context,
            'm_id' => $member['m_id'],
            'm_fmlname' => $member_fmlName,
            'm_flname' => $member_flName
        ]);
        $this->clear_notifs();
        $this->load->view('pieces/sidebar', [
            'page_title' => 'Orders',
            'parent_page_title' => 'Orders'
        ]);
        $this->load->view('orders/orders', [
            'page_title' => 'Orders',
            'has_store' => $has_store,
            'request_beans' => $request_beans,
            'requesting_beans' => $requesting_beans,
            'request_roast' => $request_roast,
            'requesting_roast' => $requesting_roast,
            'request_proc' => $request_proc,
            'requesting_proc' => $requesting_proc,
            'request_pack' => $request_pack,
            'requesting_pack' => $requesting_pack,
        ]);
        $this->load->view('templates/metafoot', [
            'sidebar'=>TRUE
        ]);
    }
    
    public function badbeans() {
        $this->load->library('session');
        
        $member = $this->member->identify([
            'm_id'=>$this->session->m_id
        ]);
        if ($member == FALSE) {
            // Force logout
            header("Location: ".site_url('logout'));
        }
        $member_fmlName = $this->member->get_name([
            'm_id'=>$this->session->m_id,
        ]);
        $member_flName = $this->member->get_name([
            'm_id'=>$this->session->m_id,
            'pref'=>'fl'
        ]);
        
        $this->load->view('templates/metahead', [
            'page_title' => 'Return damaged beans',
            'sidebar' => TRUE
        ]);
        $this->load->view('pieces/navbar', [
            'page_title' => 'Return damaged beans',
            'm_id' => $member['m_id'],
            'm_fmlname' => $member_fmlName,
            'm_flname' => $member_flName
        ]);
        $this->load->view('pieces/sidebar', [
            'page_title' => 'Return damaged beans',
            'parent_page_title' => 'Orders'
        ]);
        $this->load->view('orders/badorder', [
            'page_title' => 'Return damaged beans',
        ]);
        $this->load->view('templates/metafoot', [
            'sidebar'=>TRUE
        ]);
    }
    
    private function clear_notifs() {
        $this->load->library('session');
        $this->session->system_notify = "";
        $this->session->system_notify_context = "info";
    }
}
