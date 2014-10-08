<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_details extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
	
	
	function getUserDetails() {
	    $query = $this->db->get('products');
//		echo $this->db->last_query();die;

	    if ($query->num_rows() > 0) {
        return $query->result();
	    }
	}
}

// END Check_list_model Class

/* End of file check_list_model.php */
/* Location: ./application/models/check_list_model.php */