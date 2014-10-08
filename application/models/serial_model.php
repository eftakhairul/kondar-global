<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Serial_model extends CI_Model {



    function __construct()

    {

        // Call the Model constructor

        parent::__construct();

    }

    

	function search_serial_data($table,$key,$field1,$field2){

		if($key!="")

		{

			$this->db->or_like($field1,$key);

			$this->db->or_like($field2,$key);

		}

		$query = $this->db->get_where($table);

		//echo $this->db->last_query();die;

		return $query->result_array();

	}	

	function search_productlist_data($table,$key,$field1,$field2,$field3,$field4,$field5,$field6,$field7,$field8,$field9){

		if($key!="")

		{

			$this->db->or_like($field1,$key);

			$this->db->or_like($field2,$key);

			$this->db->or_like($field3,$key);

			$this->db->or_like($field4,$key);

			$this->db->or_like($field5,$key);

			$this->db->or_like($field6,$key);

			$this->db->or_like($field7,$key);

			$this->db->or_like($field8,$key);

			$this->db->or_like($field9,$key);

		}

		$query = $this->db->get_where($table);

		//echo $this->db->last_query();die;

		return $query->result_array();

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

/*	function getUserBlockByStatus($table,$email,$status){

		$query =$this->db->query('SELECT * FROM '.$table.' WHERE id = (SELECT MAX(id) FROM '.$table.' WHERE email = "'.$email.'" and status = "'.$status.'")');



		return $query->result();

	}*/

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

	function getUserBlockByStatus($table,$email,$status=''){

  		$querystr='SELECT * FROM '.$table.' WHERE id = (SELECT MAX(id) FROM '.$table.' WHERE email = "'.$email.'" ';
		if($status!='')
			$querystr.=' and status = "'.$status.'" ';
		$querystr.=' and FROM_UNIXTIME(created_time)>DATE_SUB(now(), INTERVAL 2 HOUR )  )';

		

  		$query =$this->db->query($querystr);	

		return $query->result();

  }		

}







/* End of file super_admin_model.php */

/* Location: ./system/application/models/super_admin_model.php */

?>