<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cart_model extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
	function get_cart_details(){
		$query =$this->db->query('SELECT cu.*,count(c.id) as count_of_cart FROM cart_users cu LEFT JOIN cart c on cu.id = c.user_id where 1=1 group by cu.id');
		return $query->result();
	}	
	
	function get_cart_detailsbyid($id){
		$query =$this->db->query('SELECT cu.*,count(c.id) as count_of_cart FROM cart_users cu LEFT JOIN cart c on cu.id = c.user_id where cu.id='.$id.' group by cu.id');
		return $query->result();
	}
	
	function get_data_by_id($id){
		$query =$this->db->query('select c.*,cu.user_name as username,cu.id as userid,
pro.id as productid,pro.*,
vc.id as vehicleid,vc.category_name as veh_catname,
mk.id as makerid,mk.maker_name as makername,
md.id as modelid,md.model_name as modelname,
pt.product_type_name as producttype,pt.menu_privilages_admin as menuprivilages
from cart c
LEFT JOIN cart_users cu ON c.user_id=cu.id
LEFT JOIN tbl_products pro ON c.product_id=pro.id
LEFT JOIN tbl_vehicle_categories vc ON pro.vehicle_category_id	=vc.id
LEFT JOIN tbl_makers mk ON pro.maker_id=mk.id
LEFT JOIN tbl_models md ON pro.model_id = md.id
LEFT JOIN tbl_product_types pt ON pro.product_type_id=pt.id
where c.user_id='.$id);
		return $query->result();
	}
	function getBlockDetails(){
		
		//$query =$this->db->query('SELECT * FROM block_users group by email order by id desc');
		$query =$this->db->query('SELECT * FROM cart_block_users l JOIN (SELECT id FROM cart_block_users s  ORDER BY created_time desc ) as cart_block_users ON l.id=cart_block_users.id group by email');
		return $query->result();
	}
	
}



/* End of file super_admin_model.php */
/* Location: ./system/application/models/super_admin_model.php */
?>