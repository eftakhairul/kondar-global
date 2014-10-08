<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Show_model extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
	function userLogin($array){
		$query = $this->db->get_where('user',$array);
		//echo $this->db->last_query();die;
		return $query->row_array();
	}

	function userRegister($array){
		$query = $this->db->insert('user',$array);
		//echo $this->db->last_query();die;
		//return $query->row_array();
		return $this->db->insert_id();
	}
	
	function left_data($array,$limit){
		//$limit =3;
		//$array = array('position'=>'left','status'=>1);
		$query = $this->db->get_where('products',$array,$limit);
		//echo $this->db->last_query();die;
		return $query->result_array();
	}
	
	function about_data(){
		//$limit =3;
		//$array = array('position'=>'left','status'=>1);
		$query = $this->db->get_where('about_us');
		//echo $this->db->last_query();die;
		return $query->result_array();
	}

	function privacy_data(){
		//$limit =3;
		//$array = array('position'=>'left','status'=>1);
		$query = $this->db->get_where('privacy');
		//echo $this->db->last_query();die;
		return $query->result_array();
	}

	function delivery_data(){
		//$limit =3;
		//$array = array('position'=>'left','status'=>1);
		$query = $this->db->get_where('delivery');
		//echo $this->db->last_query();die;
		return $query->result_array();
	}
	function get_product_data($id){
		$this->db->where('id', $id);
		$query = $this->db->get('products');
		return $query->result_array();
		//echo $this->db->last_query();die;
	}
	
		// this method is used for the add user
	/*function add_user($post_data)
	{		
		
		$this->db->insert('users', $post_data);
		return $this->db->insert_id(); 
	}
	
	
	function add_user_friends($post_data)
	{
		$this->db->insert('user_friends', $post_data);
		return $this->db->insert_id(); 
	}
	
	function add_unique_view_table($post_data)
	{
		$this->db->insert('unique_view_table', $post_data);
		return $this->db->insert_id(); 
	}		
	
	
	// this method is used for the check user name already exits or not
	function verify_username_already_exit($user_name)
	{
		$query = $this->db->get_where('users', array('user_name'=> $user_name));
		return $query->row_array();	
	}
	
		// this method is used for the check user name already exits or not
	function verify_userid_already_exit($user_id)
	{
		$query = $this->db->get_where('users', array('user_id'=> $user_id));
		return $query->row_array();	
	}
	
	//  this method is used for the update category detail
	function update_user_detail($siteData,$user_id)
	{
		$this->db->where('user_id', $user_id);
		$this->db->update('users', $siteData); 
		
	}
	
	
	
	// this method is used for the add story
	function add_story($post_data)
	{	
		//$query = $this->db->query("select count(*) from storys");
		
		$this->db->from('storys');
		$query = $this->db->get();
		$rowcount = $query->num_rows();
		//die;
		
		//$idvalue = $rowcount+1;	
		//$post_data['story_id'] = $idvalue;
		$this->db->insert('storys', $post_data);
		return $this->db->insert_id(); 
	}
	
	//  This method is used for the get category list
	function story_List($offset,$user_id)
	{		
		$this->db->where('user_id',$user_id);
		$query = $this->db->get('storys',RESULTS_PER_PAGE,$offset);
		//echo $this->db->last_query();
		return $query->result_array();
	
	}
	
	//  This method is used for the count user 
	function story_count($user_id)
	{
		$this->db->select('story_id');
		$this->db->where('user_id',$user_id);
		$query = $this->db->get('storys');
		return $query->num_rows();
	}
	
	// this method is used for the get story detail by id
	function get_story_detail_by_id($where_condition)
	{
		if(!empty($where_condition))
		{
			foreach($where_condition as $key=>$value)
			{
				$this->db->where($key,$value);
			}
		}
		$query = $this->db->get('storys');
		return $query->row_array();	
	}
	
	
	function get_unique_view_table_detail_by_id($where_condition)
	{
		if(!empty($where_condition))
		{
			foreach($where_condition as $key=>$value)
			{
				$this->db->where($key,$value);
			}
		}
		$query = $this->db->get('unique_view_table');
		return $query->row_array();	
	}
	
	
	
	//  this method is used for the update story detail
	function update_story_detail($siteData,$where_condition)
	{
		
		if(!empty($where_condition))
		{
			foreach($where_condition as $key=>$value)
			{
				$this->db->where($key,$value);
			}
		}
		
		$this->db->update('storys', $siteData); 
		
	}
	
	
	
	
	
	
	
	function top_ten_story()
	{		
		$query = $this->db->query("select * from storys Order By Like_count DESC  limit 10  ");
		
		//echo $this->db->last_query();
		return $query->result_array();
	
	}
	
	
	
	function feature_story_three()
	{		
		
		$query = $this->db->query("select * from storys  ");
		
		//echo $this->db->last_query();
		return $query->result_array();
	
	}
	
	
	function recent_story_List($user_id)
	{		
		
		//$query = $this->db->get('storys',RESULTS_PER_PAGE,$offset);
		$per_page = RESULTS_PER_PAGE;
		$story_create_date_time = date('Y-m-d');		
		
		
		if($this->input->post('search_value')!='')
		{
			 $search_value = $_POST['search_value'];
			
			$query = $this->db->query("select * from storys where story_title like '%$search_value%'	 ORDER BY story_create_date_time  ");
			
			return $query->result_array();
			
		}else{
		
		
		if($this->uri->segment(3)=='t')
		{
			$query = $this->db->query("select * from storys Order By Like_count DESC  limit 10  ");
		
			//echo $this->db->last_query();
			return $query->result_array();	
		}
		
		if($this->uri->segment(3)=='fe')
		{
		
		$query = $this->db->query("select * from storys Order By Like_count DESC  limit 10  ");
		
		//echo $this->db->last_query();
		return $query->result_array();
		
		}
		
		
		if($this->uri->segment(3)=='f')
		{
			$query = $this->db->query("select * from storys as ST , user_friends as UF where
		ST.user_id = UF.friend_id 
		and ST.user_id!= '$user_id'
		");
		//echo $this->db->last_query();
		return $query->result_array();
		}
		
		
		$query = $this->db->query("select * from storys ORDER BY story_create_date_time DESC  ");
		return $query->result_array();
		
		}
		
		//echo $this->db->last_query();
		
	
	}
	
	
	function date_wise_story_list()
	{
		$query = $this->db->query("select * from storys ORDER BY story_create_date_time asc  ");
		return $query->result_array();
	}
	
	
	//  This method is used for the count recent user 
	function recent_story_count()
	{
		
		if($this->input->post('search_value')!='')
		{
			 $search_value = $_POST['search_value'];
			
			$query = $this->db->query("select * from storys where story_title = '$search_value'	 ORDER BY story_create_date_time  ");
			
			
		}else{
		
		$query = $this->db->query("select * from storys");
		
		}
		//echo $this->db->last_query();
		return $query->num_rows();
	}
	

	function friends_stories($user_id)
	{
		
		
		
		
		$query = $this->db->query("select * from storys as ST , user_friends as UF where
		ST.user_id = UF.friend_id 
		and ST.user_id!= '$user_id'
		");
		//echo $this->db->last_query();
		return $query->result_array();
	}
	
	
	function get_two_story()
	{
	
		$query = $this->db->query("select * from storys limit 2");
		return $query->result_array();
		
	}
	
	
	function vote_count_unique_view_by_id($story_id)
	{
		$this->db->where('story_id',$story_id);
		$query = $this->db->get("unique_view_table");
		return count($query->result_array());
		
	}
	
	function check_user_vote_are_not($story_id,$user_id)
	{
		$this->db->where('story_id',$story_id);
		$this->db->where('user_id',$user_id);
		$query = $this->db->get("vote_user_detail");
		return $query->row_array();
	
	}
	
	
	function add_vote_deatil($post_data)
	{
		$this->db->insert('vote_user_detail', $post_data);
		return $this->db->insert_id(); 
	}
	
	*/
	
	
	
					
}



/* End of file super_admin_model.php */
/* Location: ./system/application/models/super_admin_model.php */
?>