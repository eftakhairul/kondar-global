<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Welcome_model extends CI_Model
{
	
	 // Call the Model constructor
	  
	function __construct()
	{
		parent::__construct();	
	}
	
	  
 function get_all_category()
 {
 	
	
	
	
	
	
	$query = $this->db->query('select * from tbl_category');
	
	$result = $query->result_array();
	
	//echo $this->db->last_query();
	
	
	return $result;

	
	
 }
 
 
	
	
	// this method is used for the add user
	function add_user($post_data)
	{
		
		$this->db->insert('tbl_users', $post_data); 
	}

	function check_email_already_exits_or_not($email)
	{
		$query = $this->db->get_where('tbl_users', array('email' => $email));
		return $query->row_array();	
	}

	//  Function get detail by Id and get single row only
	function fetchDataById($condition,$table)
	{
		
		if(!empty($condition))
			{
				foreach($condition as $fieldName=>$fieldValue){
					$this->db->where($fieldName,$fieldValue);
				}
			}
		
		$query = $this->db->get_where($table);
		return $query->row_array();	
	}
	
	//  Function to update detail by id
	function updateDataById($table,$condition,$siteData)
	{
		if(!empty($condition))
			{
				foreach($condition as $fieldName=>$fieldValue){
					$this->db->where($fieldName,$fieldValue);
				}
		}
		$this->db->update($table, $siteData); 
		
	}
	

	

}
// END Welcome_model Class

/* End of file welcome_model.php */
/* Location: ./application/models/welcome_model.php */