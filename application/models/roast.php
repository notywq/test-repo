<?php

class Roast extends CI_Model {
    private $msg_error;
    
    public function __construct() {
        $this->load->database();
    }
    
    public function create($data = array()) {
        $this->db->trans_start();
        
        // Check if they want a new address
        $timestamp = date('Y-m-d H:i:s');
        $delivery_address = $data['ro_address'];
        if (empty($delivery_address['a_id'])) {
            $address = [
                'ac_id'=>$delivery_address['ac_id'],
                'a_address'=>$delivery_address['a_address'],
                'a_created'=>$timestamp
            ];
            $this->db->insert('address', $address);
            if ($this->db->affected_rows() === 1) {
                $delivery_address['a_id'] = $this->db->insert_id();
            }
        }
        
        $roast = [
            's_id'=>$data['s_id'],
            'ro_desc'=>$data['ro_desc'],
            'ro_open'=>$data['ro_open'],
            'ro_unitprice'=>$data['ro_unitprice'],
            'ro_address'=>$delivery_address['a_id'],
            'ro_orderdays'=>$data['ro_orderdays'],
            'ro_minqty'=>$data['ro_minqty'],
            'ro_created'=>$timestamp,
            'ro_updated'=>$timestamp,
        ];
        $this->db->insert('roast', $roast);
        
        $that_roast_id = $this->db->insert_id();
        $b_roast_array = $data['b_roast_array'];
        foreach ($b_roast_array as $b_roast) {
            $roast_support = [
                'ro_id'=>$that_roast_id,
                'b_roast'=>$b_roast,
            ];
            $this->db->insert('roast_support',$roast_support);
        }
        
        $this->db->trans_complete();
        if ($this->db->trans_status() == TRUE) {
            $this->db->trans_commit();
            return true;
        }
        else {
            $this->db->trans_rollback();
            $this->msg_error = "Sorry, but we couldn't add your roaster. Try again later.";
            return false;
        }
    }
    public function identify($data = array()) {
        if (empty($data['ro_id'])) {
            return array();
        }
        $query = $this->db->get_where('roast', ['ro_id'=>$data['ro_id']]);
        if ($query->num_rows() == 1) {
            return $query->row_array();
        }
        return array();
    }
    
    public function get_myRoasts($data = array()) {
        if (empty($data['s_id'])){
            return array();
        }
        
        $query = $this->db->from('roast')
                ->where([
                    's_id'=>$data['s_id'],
                    'ro_open'=>1,
                ])
                ->order_by('ro_updated', 'desc')
                ->get();
        return $query->result_array();
    }
    public function get_theirRoasts($data = array()) {
        if (empty($data['m_id'])) {
            // Get everyone's beans
            $data['m_id'] = -1;
        }
        $query1 = $this->db->select('s_id')
                ->from('store')
                ->where('s_open', 0)    // TODO To be changed when a store CAN be opened
                ->where('m_id', $data['m_id'])
                ->get();
        $your_store = $query1->row_array();
        $query2 = $this->db->select('*')
                ->from('roast')
                ->where('ro_open', 1)
                ->where_in('s_id NOT', $your_store)
                ->get();
        
        return $query2->result_array();
    }
    public function get_roastSupport($data = array()) {
        if (empty($data['ro_id'])) {
            return array();
        }
        $query = $this->db->get_where('roast_support', [
            'ro_id'=>$data['ro_id']
        ]);
        $answers = $query->result_array();
        $output = array();
        foreach ($answers as $answer) {
            array_push($output, $answer['b_roast']);
        }
        return $output;
    }
    public function get_roastSupportString($data = array()) {
        if (empty($data['ro_id'])) {
            return "";
        }
        $query = $this->db->get_where('roast_support', [
            'ro_id'=>$data['ro_id']
        ]);
        $answers = $query->result_array();
        $output = "";
        foreach ($answers as $roast) {
            $output .= $roast['b_roast'];
            if (!empty(next($answers))) {
                $output .= ", ";
            }
        }
        return $output;
    }
    
    public function get_msgError() {
        return $this->msg_error;
    }
	
	//Search
	
	public function get_someRoasts($data = array()) {
        if (empty($data['m_id'])) {
            // Get some beans
            $data['m_id'] = -1;
        }
		$key = $data['key'];
		
        $query1 = $this->db->select('s_id')
                ->from('store')
                ->where('s_open', 0)    // TODO To be changed when a store CAN be opened
                ->where('m_id', $data['m_id'])
                ->get();
        $your_store = $query1->row_array();
        $query2 = $this->db->select('*')
                ->from('roast')
				->join('store','roast.s_id = store.s_id','left')
				->join('roast_support','roast.ro_id = roast_support.ro_id','right')
				->join('address','ro_address = a_id','left')
				->join('address_city','address.ac_id = address_city.ac_id','left')
				->where('ro_open', 1)
				->group_start()
					->or_where('ro_unitprice',$key)
					->or_where('b_roast',$key)
					->or_where('a_city',$key)
					->or_where('a_province',$key)
					->or_where('s_name',$key)
					->or_like('ro_desc', $key)
				->group_end()
				->group_by('roast.ro_id')
                ->where_in('roast.s_id NOT', $your_store)
				
                ->get();
        
        return $query2->result_array();
    }
	
	public function get_advRoasts($data = array()) {
        if (empty($data['m_id'])) {
            // Get everyone's beans
            $data['m_id'] = -1;
        }
		
		$key = $data['key'];
		$sort = $data['sort'];
		$sortkey = "";
		$sortorder = "";
		
		switch ($sort) 
		{
			case "1":
				$sortkey = "ro_created";
				$sortorder = "desc";
				break;
			case "2":
				$sortkey = "ro_created";
				$sortorder = "asc";
				break;
			case "3":
				$sortkey = "ro_unitprice";
				$sortorder = "asc";
				break;
			case "4":
				$sortkey = "ro_unitprice";
				$sortorder = "desc";
				break;
			case "5":
				$sortkey = "b_roast";
				$sortorder = "asc";
				break;
			case "6":
				$sortkey = "b_roast";
				$sortorder = "desc";
				break;
		}
		
        $query1 = $this->db->select('s_id')
                ->from('store')
                ->where('s_open', 0)    // TODO To be changed when a store CAN be opened
                ->where('m_id', $data['m_id'])
                ->get();
        $your_store = $query1->row_array();
		
		if(!empty($key))
		{
        $query2 = $this->db->select('*')
                ->from('roast')
				->join('store','roast.s_id = store.s_id','left')
				->join('roast_support','roast.ro_id = roast_support.ro_id','right')
				->join('address','ro_address = a_id','left')
				->join('address_city','address.ac_id = address_city.ac_id','left')
                ->where('ro_open', 1)
				->where($key)
                ->where_in('s_id NOT', $your_store)
				->group_by('roast.ro_id')
				->order_by($sortkey,$sortorder)
                ->get();
		}
		else
		{
        $query2 = $this->db->select('*')
                ->from('roast')
				->join('roast_support','roast.ro_id = roast_support.ro_id','right')
                ->where('ro_open', 1)
                ->where_in('s_id NOT', $your_store)
				->group_by('roast.ro_id')
				->order_by($sortkey,$sortorder)
                ->get();
		}
        
        return $query2->result_array();
    }
}