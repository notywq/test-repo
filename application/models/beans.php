<?php

class Beans extends CI_Model {
    private $msg_error;
    
    public function __construct() {
        $this->load->database();
    }
    
    public function create($data = array()) {
        $this->db->trans_start();
        
        // 0. Check if they want a new address
        $timestamp = date('Y-m-d H:i:s');
        $delivery_address = $data['b_deliverfrom'];
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
        
        // 1. Insert into beans table
        $beans = [
            's_id' => $data['s_id'],
            'b_roast' => $data['b_roast'],
            'b_open' => 1,
            'b_roastdate' => $data['b_roastdate'],
            'b_desc' => $data['b_desc'],
            'b_origin' => $data['b_origin'],
            'b_unitprice' => $data['b_unitprice'],
            'b_deliverfrom' => $delivery_address['a_id'],
            'b_orderdays' => $data['b_orderdays'],
            'b_minqty' => $data['b_minqty'],
            'b_created' => $timestamp,
            'b_updated' => $timestamp,
        ];
        $this->db->insert('beans', $beans);
        
        $that_batch_id = $this->db->insert_id();
        $species_entries = $data['b_species_list'];
        $additions_entries_raw = $data['b_additions_list'];
        
        // 2. Insert into beans_species table
        foreach ($species_entries as $species) {
            $bean_species = [
                'b_id' => $that_batch_id,
                'b_species' => $species
            ];
            $this->db->insert('beans_species', $bean_species);
        }
        
        // 3. Insert into beans_additions table
        if (!empty($additions_entries_raw)) {
            $additions_entries = preg_split('/\,\s*/', trim($additions_entries_raw));
            foreach ($additions_entries as $additions) {
                $bean_additions = [
                    'b_id' => $that_batch_id,
                    'b_additions' => $additions
                ];
                $this->db->insert('beans_additions', $bean_additions);
            }
        }
        
        $this->db->trans_complete();
        
        if ($this->db->trans_status() == TRUE) {
            $this->db->trans_commit();
            return true;
        }
        else {
            $this->db->trans_rollback();
            $this->msg_error = "Sorry, but we seem to be experiencing technical "
                    . "glitches. Try again later.";
            return false;
        }
    }
    public function identify($data = array()) {
        if (empty($data['b_id'])) {
            // No.
            return array();
        }
        $query = $this->db->get_where('beans', [
            'b_id' => $data['b_id']
        ]);
        
        return $query->row_array();
    }
    
    public function get_myBeans($data = array()) {
        if (empty($data['s_id'])) {
            // Deny access
            return array();
        }
        
        $query = $this->db->get_where('beans', [
            's_id'=>$data['s_id'],
        ]);
        return $query->result_array();
    }
	
	public function get_theirBeans($data = array()) {
        if (empty($data['m_id'])) {
            // Get some beans
            $data['m_id'] = -1;
        }
        $query1 = $this->db->select('s_id')
                ->from('store')
                ->where('s_open', 0)    // TODO To be changed when a store CAN be opened
                ->where('m_id', $data['m_id'])
                ->get();
        $your_store = $query1->row_array();
        $query2 = $this->db->select('*')
                ->from('beans')
                ->where('b_open', 1)
                ->where_in('s_id NOT', $your_store)
                ->get();
        
        return $query2->result_array();
    }
    
    public function get_allSpecies($detail = FALSE) {
        if ($detail == FALSE) {
            $this->db->select('b_species');
        }
        $query = $this->db->get('beans_species_list');
        return $query->result_array();
    }
    public function get_allRoasts($detail = FALSE, $roast_support = FALSE) {
        if ($detail == FALSE) {
            $this->db->select('b_roast');
        }
        $this->db->from('beans_roast_list');
        if ($roast_support == TRUE) {
            $this->db->where('b_roast !=', 'green');
        }
        $query = $this->db->get();
        return $query->result_array();
    }
    public function get_thatRoastDetail($data = array()) {
        $this->db->select('br_desc');
        $query = $this->db->get_where('beans_roast_list', [
            'b_roast'=>$data['b_roast']
        ]);
        $answer = $query->row_array();
        return $answer['br_desc'];
    }
    public function get_thatSpeciesString($data = array()) {
        if (empty($data['b_id'])) {
            // Deny access
            return array();
        }
        $output = '';
        
        $this->db->select('b_species');
        $query = $this->db->get_where('beans_species', [
            'b_id'=>$data['b_id'],
        ]);
        $answers = $query->result_array();
        $i = 0;
        foreach ($answers as $answer) {
            $output .= $answer['b_species'];
            if (count($answers)-$i > 1) {
                $output .= "-";
            }
            $i++;
        }
        unset($i);
        return $output;
    }
    public function get_thoseAdditions($data = array()) {
        if (empty($data['b_id'])) {
            // Deny access
            return array();
        }
        
        $this->db->select('b_additions');
        $query = $this->db->get_where('beans_additions', [
            'b_id'=>$data['b_id'],
        ]);
        
        $answers = $query->result_array();
        $output = array();
        foreach ($answers as $answer) {
            array_push($output, $answer['b_additions']);
        }
        return $output;
    }
    public function get_thoseAdditionsString($data = array()) {
        if (empty($data['b_id'])) {
            // Deny access
            return array();
        }
        
        $this->db->select('b_additions');
        $query = $this->db->get_where('beans_additions', [
            'b_id'=>$data['b_id'],
        ]);
        
        $answers = $query->result_array();
        $output = "";
        foreach ($answers as $answer) {
            $output .= $answer['b_additions'];
            if (!empty(next($answers))) {
                $output .= ", ";
            }
        }
        return $output;
    }
        
    public function get_msgError() {
        return $this->msg_error;
    }
	
	//For Search

	
	public function get_someBeans($data = array()) {
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
                ->from('beans')
				->join('store','beans.s_id = store.s_id','left')
				->join('beans_species','beans.b_id = beans_species.b_id','right')
				->join('address','b_deliverfrom = a_id','left')
				->join('address_city','address.ac_id = address_city.ac_id','left')
				->where('b_open', 1)
				->group_start()
					->or_where('b_roast',$key)
					->or_where('s_name',$key)
					->or_where('b_roastdate',$key)
					->or_where('b_origin',$key)
					->or_where('a_city',$key)
					->or_where('a_province',$key)
					->or_where('b_unitprice',$key)
					->or_where('b_species',$key)
					->or_like('b_desc', $key)
				->group_end()
                ->where_in('beans.s_id NOT', $your_store)
				->group_by('beans.b_id')
                ->get();
        
        return $query2->result_array();
    }
	
	public function get_advBeans($data = array()) {
        if (empty($data['m_id'])) {
            // Get some beans
            $data['m_id'] = -1;
        }
		$key = $data['key'];
		$sort = $data['sort'];
		$sortkey = "";
		$sortorder = "";
		
		switch ($sort) 
		{
			case "1":
				$sortkey = "b_created";
				$sortorder = "desc";
				break;
			case "2":
				$sortkey = "b_created";
				$sortorder = "asc";
				break;
			case "3":
				$sortkey = "b_unitprice";
				$sortorder = "asc";
				break;
			case "4":
				$sortkey = "b_unitprice";
				$sortorder = "desc";
				break;
			case "5":
				$sortkey = "b_species";
				$sortorder = "asc";
				break;
			case "6":
				$sortkey = "b_species";
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
                ->from('beans')
				->join('store','beans.s_id = store.s_id','left')
				->join('beans_species','beans.b_id = beans_species.b_id','right')
				->where('b_open', 1)
                ->where_in('beans.s_id NOT', $your_store)
				->group_by('beans.b_id')
				->order_by($sortkey,$sortorder)
                ->get();
		}
		else
		{
        $query2 = $this->db->select('*')
                ->from('beans')
				->join('store','beans.s_id = store.s_id','left')
				->join('beans_species','beans.b_id = beans_species.b_id','right')
				->join('address','b_deliverfrom = a_id','left')
				->join('address_city','address.ac_id = address_city.ac_id','left')
				->where('b_open', 1)
				->where($key)
                ->where_in('beans.s_id NOT', $your_store)
				->group_by('beans.b_id')
				->order_by($sortkey,$sortorder)
                ->get();
		}
        
        return $query2->result_array();
    }
}
