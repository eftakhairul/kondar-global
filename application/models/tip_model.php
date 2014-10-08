<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tip_model extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
	
	
	
	// this method is used for the add tip
	function add_tip_of_day($post_data)
	{		
		$this->db->insert('tip_of_the_day', $post_data); 
	}

	//  This method is used for the get tip of day list
	function fetchTipofdayList($offset)
	{		
		$query = $this->db->get('tip_of_the_day',RESULTS_PER_PAGE,$offset);
		return $query->result_array();
	
	}
	
	//  This method is used for the count tip of day  
	function fetchTipofdayCount()
	{
		
		$query = $this->db->get('tip_of_the_day');
		return $query->num_rows();
	}

	
	function deleteTipofday($id)
	{		
		$this->db->delete('tip_of_the_day', array('id' => $id));
		
	}
	
	// this method is used for the get category detail by id
	function get_tip_of_day_detail_by_id($id)
	{
		$query = $this->db->get_where('tip_of_the_day', array('id' => $id));
		return $query->row_array();	
	}
	
	//  this method is used for the update category detail
	function update_tip_of_day_detail($siteData,$id)
	{
		$this->db->where('id', $id);
		$this->db->update('tip_of_the_day', $siteData); 
		
	}
	
						
}

// END tip_model Class

/* End of file tip_model.php */
/* Location: ./application/models/tip_model.php */