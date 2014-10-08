<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sponser_model  extends CI_Model 
{
 
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
	
	
	
	// this method is used for the add sponser
	function add_sponser($post_data)
	{		
		$this->db->insert('tbl_sponser', $post_data); 
	}

	//  This method is used for the get sponser list
	function fetchSponserList($offset)
	{		
		$query = $this->db->get('tbl_sponser',RESULTS_PER_PAGE,$offset);
		return $query->result_array();
	
	}
	
	//  This method is used for the count user 
	function fetchSponserCount()
	{
		$this->db->select('sponser_id');
		$query = $this->db->get('tbl_sponser');
		return $query->num_rows();
	}

	
	function deleteSponser($sponser_id)
	{		
		$this->db->delete('tbl_sponser', array('sponser_id' => $sponser_id));
		
	}
	
	// this method is used for the get category detail by id
	function get_sponser_detail_by_id($sponser_id)
	{
		$query = $this->db->get_where('tbl_sponser', array('sponser_id' => $sponser_id));
		return $query->row_array();	
	}
	
	//  this method is used for the update category detail
	function update_sponser_detail($siteData,$sponser_id)
	{
		$this->db->where('sponser_id', $sponser_id);
		$this->db->update('tbl_sponser', $siteData); 
		
	}
	
	//  This method is used for the get category list - get all category
	function fetchAllSponser()
	{		
		$query = $this->db->get('tbl_sponser');
		return $query->result_array();
	
	}
	

						
}

// END Sponser_model Class

/* End of file sponser_model.php */
/* Location: ./application/models/sponser_model.php */