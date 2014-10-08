<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class State_city_model extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
	
	
	
	// this method is used for the add state
	function add_state($post_data)
	{		
		$this->db->insert('tbl_state', $post_data); 
	}
	
	// this method is used for the add state
	function add_city($post_data)
	{		
		$this->db->insert('tbl_city', $post_data); 
	}

	//  This method is used for the get state list
	function fetchStateList($offset)
	{		
		$query = $this->db->get('tbl_state',RESULTS_PER_PAGE,$offset);
		return $query->result_array();
	
	}
	
	//  This method is used for the get city list
	function fetchCityList($offset)
	{		
		$query = $this->db->get('tbl_city',RESULTS_PER_PAGE,$offset);
		return $query->result_array();
	
	}
	
	
	
	//  This method is used for the count state 
	function fetchStateCount()
	{
		$this->db->select('state_id');
		$query = $this->db->get('tbl_state');
		return $query->num_rows();
	}
	
	//  This method is used for the count city 
	function fetchCityCount()
	{
		$this->db->select('city_id');
		$query = $this->db->get('tbl_city');
		return $query->num_rows();
	}

	
	function deleteState($state_id)
	{		
		$this->db->delete('tbl_state', array('state_id' => $state_id));
		
	}
	
	// this method is used for the get state detail by id
	function get_state_detail_by_id($state_id)
	{
		$query = $this->db->get_where('tbl_state', array('state_id' => $state_id));
		return $query->row_array();	
	}
	
	
		// this method is used for the get state detail by id
	function get_city_detail_by_id($city_id)
	{
		$query = $this->db->get_where('tbl_city', array('city_id' => $city_id));
		return $query->row_array();	
	}
	
	
	
	//  this method is used for the update state detail
	function update_state_detail($siteData,$state_id)
	{
		$this->db->where('state_id', $state_id);
		$this->db->update('tbl_state', $siteData); 
		
	}
	
		//  this method is used for the update state detail
	function update_city_detail($siteData,$city_id)
	{
		$this->db->where('city_id', $city_id);
		$this->db->update('tbl_city', $siteData); 
		
	}
	
	
	
	//  This method is used for the  - get all state
	function fetchAllState()
	{		
		$query = $this->db->get('tbl_state');
		return $query->result_array();
	
	}
	

						
}

// END State_city_model Class

/* End of file state_city_model.php */
/* Location: ./application/models/state_city_model.php */