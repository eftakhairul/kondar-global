<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class block_list_email extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
	
    function insert_column($table_name, $data){
        $this->db->insert($table_name,$data);
        return $this->db->insert_id();
    }	
    
    function delete_row($table_name, $where_param){
        $this->db->where($where_param);
        return $this->db->delete($table_name);
    }
    
    function update_column($table_name,$where_param,$data){
        $this->db->where($where_param);
        return $this->db->update($table_name,$data);
    }
    
    function get_row($table_name,$select_param,$where_param){
        $this->db->select($select_param);        
        $this->db->where($where_param);
        $result = $this->db->get($table_name);
        return $result->result();
    }
    
    function get_row_in_array($table_name,$select_param,$where_param){
        $this->db->select($select_param);
        $this->db->where($where_param);
        $result = $this->db->get($table_name);
        return $result->result_array();
    }
}

// END Admin_model Class

/* End of file admin_model.php */
/* Location: ./application/models/admin_model.php */