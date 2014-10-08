<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Category_model extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
	
	
	function category(){
		$query = $this->db->get('category');
		return $query->result_array();
	}
	
	
	// this method is used for the add category
	function add_category($post_data)
	{	
		$this->db->insert('category', $post_data); 
		//echo $this->db->last_query();die;
		

	}

	function delete_category_data($id){
		$this->db->where('id', $id);
		$this->db->delete('category');
		//echo $this->db->last_query();die;
	}
	//  This method is used for the get category list
	function fetchCategoryList($offset)
	{		
		$query = $this->db->get('tbl_category',RESULTS_PER_PAGE,$offset);
		return $query->result_array();
	
	}
	
	function categoryByName(){
		$query = $this->db->get_where('category', array('status' => 1));
		//echo $this->db->last_query();die;
		return $query->result_array();
	}
	//  This method is used for the count user 
	function fetchCategoryCount()
	{
		$this->db->select('category_id');
		$query = $this->db->get('tbl_category');
		return $query->num_rows();
	}
	
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

	
	function deleteCategory($category_id)
	{		
		$this->db->delete('tbl_category', array('category_id' => $category_id));
		
	}
	
	// this method is used for the get category detail by id
	function get_category_detail_by_id($category_id)
	{
		$query = $this->db->get_where('category', array('id' => $category_id));
		return $query->row_array();	
	}
	
	//  this method is used for the update category detail
	function update_category_detail($siteData,$category_id)
	{
		$this->db->where('id', $category_id);
		$this->db->update('category', $siteData); 
		
	}
	
	//  This method is used for the get category list - get all category
	function fetchAllCategory()
	{		
		$query = $this->db->get('tbl_category');
		return $query->result_array();
	
	}
	
	
	
	function getCheckPointByCategoryid($category_id)
	{		
		$this->db->where("category_id",$category_id);
		$query = $this->db->get('checklist');
		return $query->result_array();
	
	}
	
	function get_user_check_point($category_id,$user_id)
	{		
		$this->db->where('category_id',$category_id);
		$this->db->where('user_id',$user_id);
		$query = $this->db->get('users_list');
		return $query->result_array();
	
	}
	
	
	function getAllCheckPoint()
	{		
		
	
		$query = $this->db->get('checklist');
		return $query->result_array();
	
	}
	
	
	// this method is used for the add user list
	function add_user_list($post_data)
	{		
		$this->db->insert('users_list', $post_data); 
	}
	
	
	
	function delete_user_check_point($id,$user_id)
	{		
		
		$this->db->where('id',$id);
		$this->db->where('user_id',$user_id);
		$this->db->delete('users_list'); 
	}
	
	
	
	function add_checkpoint($post_data)
	{		
		$this->db->insert('users_list', $post_data); 
	}
	
	
	

	//  This method is used for the count user 
	function all_category()
	{
	
		$query = $this->db->get('tbl_category');
		return $query->result_array();
	}

	
						
}

// END Category_model Class

/* End of file category_model.php */
/* Location: ./application/models/category_model.php */