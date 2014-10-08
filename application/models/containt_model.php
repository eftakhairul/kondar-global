<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Containt_model extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
	
	
	
	// this method is used for the add containt
	function add_containt($post_data)
	{		
		$this->db->insert('tbl_containt', $post_data); 
	}

	//  This method is used for the get containt list 
	function fetchContaintlist($offset)
	{		
		$query = $this->db->get('tbl_containt',RESULTS_PER_PAGE,$offset);
		return $query->result_array();
	
	}
	
	//  This method is used for the count user 
	function fetchContaintlistCount()
	{
		//$this->db->select('containt_id');
		$query = $this->db->get('tbl_containt');
		return $query->num_rows();
	}

	
	function deleteContaint($id)
	{		
		$this->db->delete('tbl_containt', array('containt_id' => $id));
		
	}
	
	// this method is used for the get containt detail by id
	function get_containt_detail_by_id($id)
	{
		$query = $this->db->get_where('tbl_containt', array('containt_id' => $id));
		return $query->row_array();	
	}
	
	//  this method is used for the update containt detail
	function update_containt_detail($siteData,$id)
	{
		$this->db->where('containt_id', $id);
		$this->db->update('tbl_containt', $siteData); 
		
	}
	
	//  This method is used for the get category list - get all category
	function fetchAllCategory()
	{		
		$query = $this->db->get('tbl_category');
		return $query->result_array();
	
	}
	
	
}

// END Check_list_model Class

/* End of file check_list_model.php */
/* Location: ./application/models/check_list_model.php */