<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Promotion_model extends CI_Model {

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
	
	function search_serial_data($table)
	{
		$query = $this->db->get_where($table);
		//echo $this->db->last_query();die;
		return $query->result_array();
	}
	function all_data($table_Name)
	{
		
		$query=$this->db->get($table_Name); 
		//echo $this->db->last_query();die;
		return $query->result_array();
	}
	function get_product_type_for_menu()
	{
		$querysql = "SELECT tbl_product_types.* FROM tbl_product_types group by tbl_product_types.product_type_name";
		$query = $this->db->query($querysql);
		return $query->result();
	}
	function get_data_by_id($tablename,$condition){
		$query=$this->db->get_where($tablename,$condition);
		//echo $this->db->last_query();die;
		return $query->row_array(); 
	}
	function delete_by_id($table,$where)
	{		
		$this->db->delete($table, $where);
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
        
        function get_block_user($id){
            $this->db->where('promotion_id',$id);
            $result = $this->db->get('promotion_form'); 
            return $result->result_array();
        }

}	
	

/* End of file super_admin_model.php */
/* Location: ./system/application/models/super_admin_model.php */
?>