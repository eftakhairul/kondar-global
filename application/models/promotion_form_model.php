<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Promotion_form_model extends MY_Model {
	public $_table = 'promotion_form';
	function check_user_id($id,$value){
		$this->db->where('md5('.$id.')',$value);
		$query = $this->db->get('promotion_form');
		return $query->row_array(); 
	}
}