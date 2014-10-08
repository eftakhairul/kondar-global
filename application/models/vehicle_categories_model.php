<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Vehicle_categories_model extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
	/*function search_vehicle_category_data($table,$key,$field1){
		if($key!="")
		{
			$this->db->or_like($field1,$key);
			//$this->db->or_like($field2,$key);
		}
		$query = $this->db->get_where($table);
		//echo $this->db->last_query();die;
		return $query->result_array();
	}	*/
	function search_vehicle_category_data($table,$key,$field1){
	
		$query='SELECT * FROM '.$table.' WHERE 1=1';
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
	function deleteallvehiclecategories()
	{
		$this->db->empty_table('tbl_vehicle_categories');
		//$this->db->truncate('tbl_product_types');
	}
	function deleteSelectedvehiclecategories($id)
	{
		$this->db->delete('tbl_vehicle_categories', array('id' => $id)); 
                return TRUE;
	}
	
}



/* End of file super_admin_model.php */
/* Location: ./system/application/models/super_admin_model.php */
?>