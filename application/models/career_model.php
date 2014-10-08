<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Career_model extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
	function get_all_data_by_id($table_name,$condition)
	{
		$query=$this->db->get_where($table_name,$condition);
		//echo $this->db->last_query();die;
		return $query->result_array(); 
	}
	
	function delete_by_id($table,$where)
	{		
		$this->db->delete($table, $where);
	}
	
	function get_data_by_id($tablename,$condition){
		$query=$this->db->get_where($tablename,$condition);
		//echo $this->db->last_query();die;
		return $query->row_array(); 
	}
	
	function add($table,$array){
		$query = $this->db->insert($table,$array);
		//echo $this->db->last_query();die;
		//return $query->row_array();
		return $this->db->insert_id();
	}
	
	function update_data_by_id($table_Name,$updatequery, $field_name,$value){
		$this->db->where($field_name, $value);
		$this->db->update($table_Name, $updatequery);	
	}
	
	function get_data_by_where_in($table,$condition,$where,$id,$value){
		if($where=='not'){			
			$this->db->where_not_in($id, $value);
		}
		$query=$this->db->get_where($table,$condition);
		return $query->result_array(); 		
	}
	
}



/* End of file super_admin_model.php */
/* Location: ./system/application/models/super_admin_model.php */
?>