<?php

class Package extends CI_Model {
    private $msg_error;
    
    public function __construct() {
        $this->load->database();
    }
    
    public function create($data = array()) {
        $this->db->trans_start();
        
        // Check if they want a new address
        $timestamp = date('Y-m-d H:i:s');
        $delivery_address = $data['pk_address'];
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
        
        $package = [
            's_id'=>$data['s_id'],
            'pk_type'=>$data['pk_type'],
            'pk_material'=>$data['pk_material'],
            'pk_capacity'=>$data['pk_capacity'],
            'pk_color'=>$data['pk_color'],
            'pk_desc'=>$data['pk_desc'],
            'pk_address'=>$delivery_address['a_id'],
            'pk_unitprice'=>$data['pk_unitprice'],
            'pk_qtyperunit'=>$data['pk_qtyperunit'],
            'pk_open'=>$data['pk_open'],
            'pk_orderdays'=>$data['pk_orderdays'],
            'pk_minqty'=>$data['pk_minqty'],
            'pk_created'=>$timestamp,
            'pk_updated'=>$timestamp,
        ];
        $this->db->insert('package', $package);
        
        $pk_option_array = $data['pk_option_array'];
        $pkopt_price_array = $data['pkopt_price_array'];
        if (count($pk_option_array)!==count($pkopt_price_array)) {
            $this->db->trans_rollback();
            $this->msg_error = "Sorry, but we couldn't read your package options. Try again later.";
            return false;
        }
        $pk_options = array();
        for($i = 0; $i < count($pk_option_array); $i++) {
            if (isset($pk_option_array[$i]) && isset($pkopt_price_array[$i])) {
                $pk_options[$pk_option_array[$i]] = $pkopt_price_array[$i];
            }
            else {
                $this->db->trans_rollback();
                $this->msg_error = "Some of the options you selected do not have a set price entered. "
                        . "If this is intentional, type '0.0' instead.";
                return false;
            }
        }
        $that_pack_id = $this->db->insert_id();
        foreach ($pk_options as $option => $price) {
            $package_option = [
                'pk_id'=>$that_pack_id,
                'pk_option'=> $option,
                'pkopt_price'=> $price,
            ];
            $this->db->insert('package_option',$package_option);
        }
        
        $this->db->trans_complete();
        if ($this->db->trans_status() == TRUE) {
            $this->db->trans_commit();
            return true;
        }
        else {
            $this->db->trans_rollback();
            $this->msg_error = "Sorry, but we couldn't add your package. Try again later.";
            return false;
        }
    }
    public function identify($data = array()) {
        if (empty($data['pk_id'])) {
            return array();
        }
        $query = $this->db->get_where('package',['pk_id'=>$data['pk_id']]);
        if ($query->num_rows() == 1) {
            return $query->row_array();
        }
        return array();
    }
    
    public function get_myPackages($data = array()) {
        if (empty($data['s_id'])) {
            return array();
        }
        $query = $this->db->get_where('package', [
            's_id'=>$data['s_id']
        ]);
        return $query->result_array();
    }
    public function get_myOptions($data = array()) {
        if (empty($data['pk_id'])) {
            return array();
        }
        $query = $this->db->get_where('package_option', [
            'pk_id'=>$data['pk_id']
        ]);
        return $query->result_array();
    }
    public function get_thatOptionDetail($data = array()) {
        if (empty($data['pk_option'])) {
            return "";
        }
        $query = $this->db->get_where('package_option_list', [
            'pk_option'=>$data['pk_option']
        ]);
        if ($query->num_rows() == 1) {
            $answer = $query->row_array();
            return $answer['pkopt_desc'];
        }
        return "";
    }
    public function get_theirPackages($data = array()) {
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
                ->from('package')
                ->where('pk_open', 1)
                ->where_in('s_id NOT', $your_store)
                ->get();
        
        return $query2->result_array();
    }
    public function get_packMaterials($detail = false) {
        $materials = ["pk_material"];
        if ($detail) {
            array_push($materials, "pkmat_desc");
        }
        $query = $this->db->select($materials)
                ->get('package_material_list');
        return $query->result_array();
    }
    public function get_packTypes($detail = false) {
        $types = ["pk_type"];
        if ($detail) {
            array_push($types, "pktype_desc");
        }
        $query = $this->db->select($types)
                ->get('package_type_list');
        return $query->result_array();
    }
    public function get_packOptions($detail = false) {
        $options = ["pk_option"];
        if ($detail) {
            array_push($options, "pkopt_desc");
        }
        $query = $this->db->select($options)
                ->get('package_option_list');
        return $query->result_array();
    }
    
    public function get_msgError() {
        return $this->msg_error;
    }
	
	//SEARCH
	
	
	 public function get_somePackages($data = array()) {
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
   
				
		$key = $data['key'];
				
		$query2 = $this->db->select('*')
				->from('package')
				->join('store','package.s_id = store.s_id','left')
				->join('package_option','package.pk_id = package_option.pk_id','right')
				->join('address','pk_address = a_id','left')
				->join('address_city','address.ac_id = address_city.ac_id','left')
				->where('pk_open', 1)
				->group_start()
					->or_where('pk_unitprice',$key)
					->or_where('pk_color',$key)
					->or_where('s_name',$key)
					->or_where('a_city',$key)
					->or_where('a_province',$key)
					->or_where('pk_capacity',$key)
					->or_where('pk_material',$key)
					->or_where('pk_type',$key)
					->or_where('pk_option',$key)
					->or_like('pk_desc', $key)
				->group_end()
				->where_in('package.s_id NOT', $your_store)
				->group_by('package.pk_id')
				->get();
        
        return $query2->result_array();
    }
	
	 public function get_advPackages($data = array()) {
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
				$sortkey = "pk_created";
				$sortorder = "desc";
				break;
			case "2":
				$sortkey = "pk_created";
				$sortorder = "asc";
				break;
			case "3":
				$sortkey = "pk_unitprice";
				$sortorder = "asc";
				break;
			case "4":
				$sortkey = "pk_unitprice";
				$sortorder = "desc";
				break;
			case "5":
				$sortkey = "pk_type";
				$sortorder = "asc";
				break;
			case "6":
				$sortkey = "pk_type";
				$sortorder = "desc";
				break;
		}
		
        $query1 = $this->db->select('s_id')
                ->from('store')
                ->where('s_open', 0)    // TODO To be changed when a store CAN be opened
                ->where('m_id', $data['m_id'])
                ->get();
        $your_store = $query1->row_array();
		if(empty($key))
		{
			$query2 = $this->db->select('*')
                ->from('package')
                ->where('pk_open', 1)
                ->where_in('s_id NOT', $your_store)
				->order_by($sortkey,$sortorder)
                ->get();
		}
		else
		{
			$query2 = $this->db->select('*')
                ->from('package')
				->join('store','package.s_id = store.s_id','left')
				->join('package_option','package.pk_id = package_option.pk_id','right')
				->join('address','pk_address = a_id','left')
				->join('address_city','address.ac_id = address_city.ac_id','left')
                ->where('pk_open', 1)
				->where($key)
                ->where_in('s_id NOT', $your_store)
				->group_by('package.pk_id')
				->order_by($sortkey,$sortorder)
                ->get();
		}
   
        
        return $query2->result_array();
    }
}