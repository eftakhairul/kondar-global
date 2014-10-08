<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product_type_model extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
	function search_block_data($table,$key,$field1){
		$query =$this->db->query('SELECT * FROM '.$table.' WHERE id = (SELECT MAX(id) FROM '.$table.' WHERE '.$field1.' = "'.$key.'")');
		//echo 'SELECT * FROM '.$table.' WHERE id = (SELECT MAX(id) FROM '.$table.' WHERE '.$field1.' = "'.$key.'")';
		/*if($key!="")
		{
			$this->db->or_like($field1,$key);
		}
		$query = $this->db->get_where($table);*/
		
		
		//var_dump($query->result());
		//echo $this->db->last_query();die;
		return $query->result();
	}	
	function getUserBlockByStatus($table,$email,$status){
		$query =$this->db->query('SELECT * FROM '.$table.' WHERE id = (SELECT MAX(id) FROM '.$table.' WHERE email = "'.$email.'" and status = "'.$status.'")');
		//echo 'SELECT * FROM '.$table.' WHERE id = (SELECT MAX(id) FROM '.$table.' WHERE '.$field1.' = "'.$key.'")';
		/*if($key!="")
		{
			$this->db->or_like($field1,$key);
		}
		$query = $this->db->get_where($table);*/
		
		
		//var_dump($query->result());
		//echo $this->db->last_query();die;
		return $query->result();
	}
	function getBlockDetails(){
		
		//$query =$this->db->query('SELECT * FROM block_users group by email order by id desc');
		$query =$this->db->query('SELECT * FROM block_users l JOIN (SELECT id FROM block_users s  ORDER BY created_time desc ) as block_users ON l.id=block_users .id group by email');
		return $query->result();
	}
	function check_serial_number($code){
		
		//$query = $this->db->get_where($table);
		$query = $this->db->get_where('serial_code', array('code' => $code));
		//echo $this->db->last_query();die;
		return $query->result();
	}	
	
	
	function search_producttype_data($table,$key,$field1)
	{
		$query='SELECT tbl_product_types.*, tbl_vehicle_categories.category_name as category_name, tbl_vehicle_categories.id as cat_id FROM '.$table.' LEFT JOIN tbl_vehicle_categories ON  tbl_product_types.vehicle_category_id = tbl_vehicle_categories.id WHERE 1=1';
		if($key!="")
		{
		$query .= ' AND '.$field1.' LIKE "%'.$key.'%" ';
		//$$this->db->or_like($field1,$key);
		}
		//echo $query;
		$query =$this->db->query($query);
		
		//var_dump($query->result());
		//echo $this->db->last_query();die;
		return $query->result_array();
	}	
	function deleteallproducttypes()
	{
		$this->db->empty_table('tbl_product_types');
		//$this->db->truncate('tbl_product_types');
	}
	function deleteSelectedproducttypes($id)
	{
		$this->db->delete('tbl_product_types', array('id' => $id)); 
                return TRUE;
	}
	
}



/* End of file super_admin_model.php */
/* Location: ./system/application/models/super_admin_model.php */
?>