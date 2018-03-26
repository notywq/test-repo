<?php

class Home extends CI_Controller {
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
        
        $is_member = $this->member->identify([
            'm_id'=>$this->session->m_id
        ]);
        if (empty($is_member)) {
            $is_member['m_id'] = '';
        }
        
        $this->load->view('templates/metahead', [
            'page_title' => 'Home',
            'sidebar' => !empty($is_member['m_id']),
        ]);
        $this->load->view('pieces/navbar', [
            'page_title' => 'Home',
            'm_id' => $is_member['m_id'],
            'system_notify' => $system_notify,
            'system_notify_context' => $system_notify_context,
        ]);
        $this->clear_notifs();
        if (!empty($is_member['m_id'])) {
            $this->load->view('pieces/sidebar', [
                'page_title' => 'Home',
                'parent_page_title' => 'Home'
            ]);
        }
        $this->load->view('home/home');
        $this->load->view('templates/metafoot', [
            'sidebar' => !empty($is_member['m_id']),
        ]);
    }
    public function browse() {
        $this->load->library('session');
        
        $system_notify = "";
        if (!empty($this->session->system_notify)) {
            $system_notify = $this->session->system_notify;
        }
        $system_notify_context = "info";
        if (!empty($this->session->system_notify_context)) {
            $system_notify_context = $this->session->system_notify_context;
        }
        
        $is_member = $this->member->identify([
            'm_id'=>$this->session->m_id
        ]);
        if (empty($is_member)) {
            $is_member['m_id'] = "";
        }
		
		$data = $this->input->post(null, true);
		if(isset($data['advsearchSubmit']))
		{
			$sort = $data['sort'];
			$beankey = "";
			$pkgkey = "";
			$roastkey = "";
			$prockey ="";
		if(empty($data['isbeans']) && empty($data['isroast']) && empty($data['ispkg']) && empty($data['isproc']))
		{
			if(!empty($data['seller']) || $data['location'] != "Any" || !empty($data['pricerangelow']) || !empty($data['pricerangehigh'])) 
			{
				$pricetrigger = "false";
				if(!empty($data['pricerangelow']) || !empty($data['pricerangehigh']))
				{
					if(!empty($data['pricerangelow']) && !empty($data['pricerangehigh']))
					{
						$beankey .= "b_unitprice between ".$data['pricerangelow']." and ".$data['pricerangehigh'];
						$pkgkey .= "pk_unitprice between ".$data['pricerangelow']." and ".$data['pricerangehigh'];
						$roastkey .= "ro_unitprice between ".$data['pricerangelow']." and ".$data['pricerangehigh'];
						$prockey .= "proc_unitprice between ".$data['pricerangelow']." and ".$data['pricerangehigh'];
						$pricetrigger = "true";
					}
					else if(!empty($data['pricerangelow']) && empty($data['pricerangehigh']))
					{
						$beankey .= "b_unitprice >= ".$data['pricerangelow']."";
						$pkgkey .= "pk_unitprice >= ".$data['pricerangelow']."";
						$roastkey .= "ro_unitprice >= ".$data['pricerangelow']."";
						$prockey .= "proc_unitprice >= ".$data['pricerangelow']."";
						$pricetrigger = "true";
					}
					else if(empty($data['pricerangelow']) && !empty($data['pricerangehigh']))
					{
						$beankey .= "b_unitprice <= ".$data['pricerangehigh']."";
						$pkgkey .= "pk_unitprice <= ".$data['pricerangehigh']."";
						$roastkey .= "ro_unitprice <= ".$data['pricerangehigh']."";
						$prockey .= "proc_unitprice <= ".$data['pricerangehigh']."";
						$pricetrigger = "true";
					}
				
				}
				if(!empty($data['seller']))
				{
					if($pricetrigger == "true")
					{
						$beankey .= " AND";
						$roastkey .= " AND";
						$prockey .= " AND";
						$pkgkey .= " AND";
					}
					else
					{
						$pricetrigger = "true";
					}
					$beankey .= " s_name = '".$data['seller']."' ";	
					$pkgkey .= " s_name = '".$data['seller']."' ";	
					$roastkey .= " s_name = '".$data['seller']."' ";	
					$prockey .= " s_name = '".$data['seller']."' ";	
					
				
				}
				if($data['location'] != "Any")
				{
					if($pricetrigger == "true")
					{
						$beankey .= " AND";
						$roastkey .= " AND";
						$prockey .= " AND";
						$pkgkey .= " AND";
					}
					else
					{
						$pricetrigger = "true";
					}
					$beankey .= " a_province = '".$data['location']."' ";	
					$pkgkey .= " a_province = '".$data['location']."' ";	
					$roastkey .= " a_province = '".$data['location']."' ";	
					$prockey .= " a_province = '".$data['location']."' ";	
					
				
				}
				$beans_list = $this->beans->get_advBeans([
				'm_id'=>$this->session->m_id,
				'key'=>$beankey,
				'sort'=>$sort
				]);
				$roast_list = $this->roast->get_advRoasts([
					'm_id'=>$this->session->m_id,
					'key'=>$roastkey,
				'sort'=>$sort
				]);
				$pack_list = $this->package->get_advPackages([
					'm_id'=>$this->session->m_id,
					'key'=>$pkgkey,
				'sort'=>$sort
				]);
				$proc_list = $this->processing->get_advProcesses([
					'm_id'=>$this->session->m_id,
					'key'=>$prockey,
				'sort'=>$sort
				]);
			}	
			else
			{
				$beans_list = $this->beans->get_advBeans([
				'm_id'=>$this->session->m_id,
				'key'=>$beankey,
				'sort'=>$sort
				]);
				$roast_list = $this->roast->get_advRoasts([
					'm_id'=>$this->session->m_id,
					'key'=>$roastkey,
				'sort'=>$sort
				]);
				$pack_list = $this->package->get_advPackages([
					'm_id'=>$this->session->m_id,
					'key'=>$pkgkey,
				'sort'=>$sort
				]);
				$proc_list = $this->processing->get_advProcesses([
					'm_id'=>$this->session->m_id,
					'key'=>$prockey,
				'sort'=>$sort
				]);
			}
				
			
			
				
			
		}
		else
		{
			
		
			if(!empty($data['isbeans']))
			{
				$pricetrigger = "false";
				if(!empty($data['pricerangelow']) && !empty($data['pricerangehigh']))
				{
					$beankey .= "b_unitprice between ".$data['pricerangelow']." and ".$data['pricerangehigh'];
					$pricetrigger = "true";
				}
				else if(!empty($data['pricerangelow']) && empty($data['pricerangehigh']))
				{
					$beankey .= "b_unitprice >= ".$data['pricerangelow']."";
					$pricetrigger = "true";
				}
				else if(empty($data['pricerangelow']) && !empty($data['pricerangehigh']))
				{
					$beankey .= "b_unitprice <= ".$data['pricerangehigh']."";
					$pricetrigger = "true";
				}
				
				if(!empty($data['seller'])) 
				{
					if($pricetrigger == "true")
					{
						$beankey .= " AND";
					}
					else
						$pricetrigger = "true";
						$beankey .= " s_name = '".$data['seller']."' ";
					
				}
				
				if($data['location'] != "Any") 
				{
					if($pricetrigger == "true")
					{
						$beankey .= " AND";
					}
					else
						$pricetrigger = "true";
						$beankey .= " a_province = '".$data['location']."' ";
					
				}
				
				if(!empty($data['bean_list']) || !empty($data['bean_roast']) || !empty($data['beanmin']))
				{
					if($pricetrigger == "true")
						{
							$beankey .= " AND";
						}
					if(!empty($data['bean_list'])) 
					{
						$ortrigger = "true";
						foreach($data['bean_list'] as $check) 
						{
							if($ortrigger == "true")
							{
								$ortrigger = "false";
							}
							else
								$beankey .= " OR ";
							$beankey .= " b_species = '".$check."' ";
						}
					}
					if(!empty($data['bean_roast'])) 
					{
						if(isset($ortrigger))
						{
							$beankey .= " AND";
						}
						$ortrigger = "true";
						foreach($data['bean_roast'] as $check) 
						{
							if($ortrigger == "true")
							{
								$ortrigger = "false";
							}
							else
								$beankey .= " OR ";
							$beankey .= " b_roast = '".$check."' ";
						}
					}
					if(!empty($data['beanmin'])) 
					{
						if(isset($ortrigger))
						{
							$beankey .= " AND";
						}
						$ortrigger = "true";
							$beankey .= " b_minqty <= '".$data['beanmin']."' ";
						
					}
					
				}
				$beans_list = $this->beans->get_advBeans([
					'm_id'=>$this->session->m_id,
					'key'=>$beankey,
				'sort'=>$sort
				]);
			}
			else
			{
				$beans_list = $this->beans->get_advBeans([
					'm_id'=>$this->session->m_id,
					'key'=>" beans.b_id = -1",
				'sort'=>$sort
				]);
			}
			
			if(!empty($data['isroast']))
			{
				$pricetrigger = "false";
				if(!empty($data['pricerangelow']) && !empty($data['pricerangehigh']))
				{
					$roastkey .= "ro_unitprice between ".$data['pricerangelow']." and ".$data['pricerangehigh'];
					$pricetrigger = "true";
				}
				else if(!empty($data['pricerangelow']) && empty($data['pricerangehigh']))
				{
					$roastkey .= "ro_unitprice >= ".$data['pricerangelow']."";
					$pricetrigger = "true";
				}
				else if(empty($data['pricerangelow']) && !empty($data['pricerangehigh']))
				{
					$roastkey .= "ro_unitprice <= ".$data['pricerangehigh']."";
					$pricetrigger = "true";
				}
				if(!empty($data['beanmin']))
				{
					if($pricetrigger == "true")
						{
							$roastkey .= " AND";
						}
						else
						$pricetrigger = "true";
					$roastkey .= " ro_minqty <= '".$data['beanmin']."' ";
				}
				if(!empty($data['seller'])) 
				{
					if($pricetrigger == "true")
					{
						$roastkey .= " AND";
					}
					else
						$pricetrigger = "true";
						$roastkey .= " s_name = '".$data['seller']."' ";
					
				}
				
				if($data['location'] != "Any") 
				{
					if($pricetrigger == "true")
					{
						$roastkey .= " AND";
					}
					else
						$pricetrigger = "true";
						$roastkey .= " a_province = '".$data['location']."' ";
					
				}
				$roast_list = $this->roast->get_advRoasts([
				'm_id'=>$this->session->m_id,
				'key'=>$roastkey,
				'sort'=>$sort
			]);
				
			}
			else
			{
				$roast_list = $this->roast->get_advRoasts([
					'm_id'=>$this->session->m_id,
					'key'=>" roast.ro_id = -1",
				'sort'=>$sort
					]);
			}
			
			if(!empty($data['ispkg']))
			{
				$pricetrigger = "false";
				if(!empty($data['pricerangelow']) && !empty($data['pricerangehigh']))
				{
					$pkgkey .= "pk_unitprice between ".$data['pricerangelow']." and ".$data['pricerangehigh'];
					$pricetrigger = "true";
				}
				else if(!empty($data['pricerangelow']) && empty($data['pricerangehigh']))
				{
					$pkgkey .= "pk_unitprice >= ".$data['pricerangelow']."";
					$pricetrigger = "true";
				}
				else if(empty($data['pricerangelow']) && !empty($data['pricerangehigh']))
				{
					$pkgkey .= "pk_unitprice <= ".$data['pricerangehigh']."";
					$pricetrigger = "true";
				}
				if(!empty($data['capacity']))
				{
					if($pricetrigger == "true")
						{
							$pkgkey .= " AND";
						}
						else
							$pricetrigger = "true";
					$pkgkey .= " pk_capacity >= '".$data['capacity']."' ";
				}
				if(!empty($data['seller'])) 
				{
					if($pricetrigger == "true")
					{
						$pkgkey .= " AND";
					}
					else
						$pricetrigger = "true";
						$pkgkey .= " s_name = '".$data['seller']."' ";
					
				}
				
				if($data['location'] != "Any") 
				{
					if($pricetrigger == "true")
					{
						$pkgkey .= " AND";
					}
					else
						$pricetrigger = "true";
						$pkgkey .= " a_province = '".$data['location']."' ";
					
				}
				$pack_list = $this->package->get_advPackages([
				'm_id'=>$this->session->m_id,
				'key'=>$pkgkey,
				'sort'=>$sort
			]);
				
			}
			else
			{
				$pack_list = $this->package->get_advPackages([
					'm_id'=>$this->session->m_id,
					'key'=>" package.pk_id = -1",
				'sort'=>$sort
					]);
			}
			if(!empty($data['isproc']))
			{
				$pricetrigger = "false";
				if(!empty($data['pricerangelow']) && !empty($data['pricerangehigh']))
				{
					$prockey .= "proc_unitprice between ".$data['pricerangelow']." and ".$data['pricerangehigh'];
					$pricetrigger = "true";
				}
				else if(!empty($data['pricerangelow']) && empty($data['pricerangehigh']))
				{
					$prockey .= "proc_unitprice >= ".$data['pricerangelow']."";
					$pricetrigger = "true";
				}
				else if(empty($data['pricerangelow']) && !empty($data['pricerangehigh']))
				{
					$prockey .= "proc_unitprice <= ".$data['pricerangehigh']."";
					$pricetrigger = "true";
				}
				if(!empty($data['pcapacity']))
				{
					if($pricetrigger == "true")
						{
							$prockey .= " AND";
						}
						else
							$pricetrigger = "true";
					$prockey .= " proc_minqty <= '".$data['pcapacity']."' ";
				}
				if(!empty($data['seller'])) 
				{
					if($pricetrigger == "true")
					{
						$prockey .= " AND";
					}
					else
						$pricetrigger = "true";
						$prockey .= " s_name = '".$data['seller']."' ";
					
				}
				
				if($data['location'] != "Any") 
				{
					if($pricetrigger == "true")
					{
						$prockey .= " AND";
					}
					else
						$pricetrigger = "true";
						$prockey .= " a_province = '".$data['location']."' ";
					
				}
				$proc_list = $this->processing->get_advProcesses([
				'm_id'=>$this->session->m_id,
				'key'=>$prockey,
				'sort'=>$sort
			]);
				
			}
			else
			{
				$proc_list = $this->processing->get_advProcesses([
				'm_id'=>$this->session->m_id,
				'key'=>" proc_id = -1",
				'sort'=>$sort
			]);
			}
		}
			
			
			
		}
		else if (!empty($data['search']))
		{
			$beans_list = $this->beans->get_someBeans([
            'm_id'=>$this->session->m_id,
			'key'=>$data['search']
			]);
			$roast_list = $this->roast->get_someRoasts([
				'm_id'=>$this->session->m_id,
				'key'=>$data['search']
			]);
			$proc_list = $this->processing->get_someProcesses([
				'm_id'=>$this->session->m_id,
				'key'=>$data['search']
			]);
			$pack_list = $this->package->get_somePackages([
				'm_id'=>$this->session->m_id,
				'key'=>$data['search']
			]);
			
		}
		else
			{
				$beans_list = $this->beans->get_theirBeans([
					'm_id'=>$this->session->m_id
				]);
				$roast_list = $this->roast->get_theirRoasts([
					'm_id'=>$this->session->m_id
				]);
				$proc_list = $this->processing->get_theirProcesses([
					'm_id'=>$this->session->m_id
				]);
				$pack_list = $this->package->get_theirPackages([
					'm_id'=>$this->session->m_id
				]);
			}
		

        
        $this->load->view('templates/metahead', [
            'page_title' => 'Browse',
            'sidebar' => !empty($is_member['m_id']),
        ]);
        $this->load->view('pieces/navbar', [
            'page_title' => 'Browse',
            'm_id' => $is_member['m_id'],
            'system_notify' => $system_notify,
            'system_notify_context' => $system_notify_context,
        ]);
        $this->clear_notifs();
        if (!empty($is_member['m_id'])) {
            $this->load->view('pieces/sidebar', [
                'page_title' => 'Browse',
                'parent_page_title' => 'Browse'
            ]);
        }
        $this->load->view('home/browse', [
            'beans_list' => $beans_list,
            'roast_list' => $roast_list,
            'proc_list' => $proc_list,
            'pack_list' => $pack_list,
        ]);
        $this->load->view('templates/metafoot', [
            'sidebar' => !empty($is_member['m_id']),
        ]);
		
    }
    public function signup() {
        $this->load->library('session');
        $is_member = $this->member->identify([
            'm_id'=>$this->session->m_id
        ]);
        if (!empty($is_member['m_id'])) {
            $this->session->system_notify = "Hey, you are still logged in!";
            $this->session->system_notify_context = "warning";
            session_write_close();
            header("Location: ".site_url('dashboard'));
        }
        
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('fname', 'First name', 'required|alpha_numeric_spaces');
        $this->form_validation->set_rules('mname', 'Middle name', 'required|alpha_numeric_spaces');
        $this->form_validation->set_rules('lname', 'Last name', 'required|alpha_numeric_spaces');
        $this->form_validation->set_rules('cellno', 'Mobile number',
                'required|is_numeric|exact_length[11]'
        );
        $this->form_validation->set_rules('province', 'Province', 'required');
        $this->form_validation->set_rules('city', 'City', 'required');
        $this->form_validation->set_rules('address', 'Specific address', 'trim|required|max_length[140]');
        $this->form_validation->set_rules('username', 'Username', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[8]');
        $this->form_validation->set_rules('passpass', 'Confirm password',
                'trim|required|matches[password]'
        );
        
        $this->load->view('templates/metahead', ['page_title' => 'Sign up']);
        $this->load->view('pieces/navbar', ['page_title' => 'Sign up']);
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('pieces/form-pieces');
            $this->load->view('home/signup');
        }
        else {
            $data = $this->input->post(null, true);
            if (isset($data['signup'])) {
                $fname = $data['fname'];
                $mname = $data['mname'];
                $lname = $data['lname'];
                $cellno = $data['cellno'];
                $city = $data['city'];
                $address = $data['address'];
                $use = $data['username'];
                $pw = $data['passpass'];
                $entry = [
                    'm_fname' => $fname,
                    'm_mname' => $mname,
                    'm_lname' => $lname,
                    'u_cellno' => $cellno,
                    'ac_id' => $city,
                    'a_address' => $address,
                    'u_name' => $use,
                    'u_pw' => $pw
                ];
                
                $success = $this->user->create($entry);
                $entry['u_pw'] = '';
                if ($success == TRUE) {
                    $this->load->library('session');
                    $this->session->m_id = $this->user->get_mID();
                    $this->session->system_notify = "Signup succeeded! Welcome to WebKape, ".$fname."!";
                    $this->session->system_notify_context = "success";
                    session_write_close();

                    // Bring to dashboard page
                    header("Location: ".site_url('dashboard'));
                }
            }
            $this->load->view('pieces/form-pieces');
            $this->load->view('home/signup', [
                'signup_error' => $this->user->get_msgError()
            ]);
        }
        $this->load->view('templates/metafoot', [
            'addressselect' => true
        ]);
    }
    public function login() {
        $this->load->library('session');
        $is_member = $this->member->identify([
            'm_id'=>$this->session->m_id
        ]);
        if (!empty($is_member['m_id'])) {
            $this->session->system_notify = "Hey, you are still logged in!";
            $this->session->system_notify_context = "warning";
            session_write_close();
            header("Location: ".site_url('dashboard'));
        }
        
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('username', 'Username', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[8]');
        
        $this->load->view('templates/metahead', ['page_title' => 'Log in']);
        $this->load->view('pieces/navbar', ['page_title' => 'Log in']);
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('pieces/form-pieces');
            $this->load->view('home/login');
        }
        else {
            $data = $this->input->post(null, true);
            if (isset($data['login'])) {
                $login_name = $data['username'];
                $login_pw = $data['password'];
                $entry = [
                    'u_name' => $login_name,
                    'u_pw' => $login_pw
                ];
                
                $success = $this->user->authorize($entry);
                $entry['u_pw'] = '';
                if ($success == TRUE) {
                    $this->load->library('session');
                    $this->session->m_id = $success['m_id'];
                    $fname = $this->member->get_name([
                        'm_id'=>$success['m_id'],
                        'pref'=>'f'
                    ]);
                    $this->session->system_notify = "Login succeeded! Welcome back, ".$fname.".";
                    $this->session->system_notify_context = "success";
                    session_write_close();

                    // Bring to dashboard page
                    header("Location: ".site_url('dashboard'));
                }
            }
            $this->load->view('pieces/form-pieces');
            $this->load->view('home/login', [
                'login_error' => $this->user->get_msgError()
            ]);
        }
        $this->load->view('templates/metafoot');
    }
    public function logout() {
        $this->load->library('session');
        session_unset();
        session_destroy();

        // Return home
        header("Location: ".site_url('home'));
    }
    
    private function clear_notifs() {
        $this->load->library('session');
        $this->session->system_notify = "";
        $this->session->system_notify_context = "info";
    }
}
