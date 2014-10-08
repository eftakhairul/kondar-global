<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class questions_model extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    function query_result($query){
		$query = $this->db->query($query);
		//echo $this->db->last_query();die;
		return $query->result_array(); 
	}
}



/* End of file super_admin_model.php */
/* Location: ./system/application/models/super_admin_model.php */
?>