<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Delivery_model extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
	
	//  This method is used for the get advt list 
	function delivery_data(){		
		$query = $this->db->get('delivery');
		return $query->result_array();
	
	}
	
	function get_delivery_data($id){		
		$query = $this->db->get_where('delivery', array('id' => $id));
		//echo $this->db->last_query();die;
		return $query->result_array();
	
	}

	function set_delivery_data($data,$id){	
		$this->db->where('id', $id);
		$this->db->update('delivery',$data);
		//echo $this->db->last_query();die;
		//return $query->result_array();
	
	}
	
	function add_delivery_data($data){	
		$this->db->insert('delivery',$data);
		//echo $this->db->last_query();die;
	}
	
	function delete_delivery_data($id){	
		$this->db->where('id', $id);
		$this->db->delete('delivery');
		//echo $this->db->last_query();die;
	}
	
	
	
	
	
	
	
	
	
	// this method is used for the add advt
	function add_advt($post_data)
	{		
		$this->db->insert('tbl_advt', $post_data); 
	}

	
	//  This method is used for the count user 
	function fetchAdvtlistCount()
	{
		//$this->db->select('advt_id');
		$query = $this->db->get('tbl_advt');
		return $query->num_rows();
	}

	
	function deleteAdvt($id)
	{		
		$this->db->delete('tbl_advt', array('advt_id' => $id));
		
	}
	
	// this method is used for the get advt detail by id
	function get_advt_detail_by_id($id)
	{
		$query = $this->db->get_where('tbl_advt', array('advt_id' => $id));
		return $query->row_array();	
	}
	
	//  this method is used for the update advt detail
	function update_advt_detail($siteData,$id)
	{
		$this->db->where('advt_id', $id);
		$this->db->update('tbl_advt', $siteData); 
		
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