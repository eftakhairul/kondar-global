<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Menu_model_ab extends MY_Model {
	public $_table = 'menus';
    /*function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
	function get_menu_info($menu_name){
		$sql = "SELECT * FROM menus where menu_name = '".$menu_name."'";
		//echo $sql; exit;
		$result	= $this->db->query($sql)->result_array() ;
		return $result;
	}

	function update_menu_info($info,$menu_name)
	{
		$this->db->where('menu_name', $menu_name);
		$this->db->update('menus', $info);
	}
	
	function get_all_menus()
	{
		$sql = "SELECT * FROM menus";
		//echo $sql; exit;
		return $result	= $this->db->query($sql)->result_array() ;
		//echo "<pre>"; print_r($result); echo "</pre>"; exit;
	}
	
	function insert_menu($post)
	{
		$strquery = "insert into  menu_management (name,menu_catogery,menu_style,separater,class,menu_befor_txt,menu_after_txt,background_colur,background_img,status) values('".$post['name']."','".$post['catogery']."','".$post['style']."','".$post['separater']."','".$post['class']."','".$post['befotxt']."','".$post['aftertxt']."','".$post['background']."','".$post['imgurl']."','".$post['status']."')";
		$result	= $this->db->query($strquery);
		if($result)
			return TRUE;
		else
			return FALSE;
	}
	
	function show_menus()
	{
		$sql = "SELECT * FROM menu_management";
		$result	= $this->db->query($sql)->result_array() ;
		return $result;
	}
	
	function get_menubyid($id)
	{
		$query = "select * from  menu_management where id='".$id."' ";
		$result	= $this->db->query($query)->result_array() ;
		return $result;
	}
	
	function  menu_status($id,$status)
	{
	
		$strQuery = 'UPDATE  menu_management SET  status="'.$status.'" WHERE id="'.$id.'"';
		$result	= $this->db->query($strQuery);
		if($result)
			return TRUE;
		else
			return FALSE;
	
	}
	
	function deletemenu($id)
	{
		$strQuery = 'DELETE  FROM  menu_items WHERE id="'.$id.'"';
		$result	= $this->db->query($strQuery);
		if($result)
			return TRUE;
		else
			return FALSE;
	
	}
	
	function update_menu($id,$post)
	{
		$strQuery = "UPDATE  menu_management SET name='".$post['name']."',menu_catogery='".$post['catogery']."',menu_style='".$post['style']."',separater='".$post['separater']."',class='".$post['class']."',menu_befor_txt='".$post['befotxt']."',menu_after_txt='".$post['aftertxt']."',background_colur='".$post['background']."',	status='".$post['status']."'";
		if($post['imgurl']!='')
			$strQuery	.= ",background_img='".$post['imgurl']."'";
			$strQuery	.=" WHERE  id='".$id."' ";
		
		$result	= $this->db->query($strQuery);
		if($result)
			return TRUE;
		else
			return FALSE;
	
	}
	
	function show_menus_items($id='')
	{
		$sql = "SELECT * FROM menu_items ";
		if($id != '')
			$sql.= 'where id = '.$id.'';
			
		$result	= $this->db->query($sql)->result_array() ;
		return $result;
	}
	
	function show_menus_byid($id='')
	{
		$sql = "SELECT * FROM menu_items ";
		if($id)
			$sql.= 'where menu_group_id = '.$id.'';
			
		$result	= $this->db->query($sql)->result_array() ;
		$result = $this->getparentmenu($result);
		//var_dump($result);
		return $result;
	}
	
	function getparentmenu($menus)
	{
		foreach($menus as $key => $menu)
		{
			$parent_menu = $this->show_menus_items($menu['menu_parant']);
			
			if(!empty($parent_menu))
				$menus[$key]['parent_menu_name'] = $parent_menu[0]['menu_name'];
			else
				$menus[$key]['parent_menu_name'] = '';
		}
		
		return $menus;
	}
	
	function menuItemByGroupId($id='')
	{
		$sql = "SELECT * FROM menu_items ";
		if($id)
			$sql.= 'where menu_group_id='.$id.'';
		$sql.=' order by displayorder';
		$result	=	$this->db->query($sql)->result_array() ;
		return $result;
	}
	
	function menu_itemsManagement($post)
	{
		if($post['id'] == '')
		{
			$inserttable = "insert into menu_items(menu_parant,level,menu_name,menu_group_id,menu_type,value_name,value_url,class,menu_style,style,befor_txt,after_txt,bg_color,bg_img,status,displayorder) values('".$post['menu_parant']."','".$post['level']."','".$post['menu_name']."','".$post['menu_group_id']."','".$post['menu_type']."','".$post['value_name']."','".$post['value_url']."','".$post['class']."','".$post['menu_style']."','".$post['style']."','".$post['befor_txt']."','".$post['after_txt']."','".$post['bg_color']."','".$post['bg_img']."','".$post['status']."','".$post['order']."')";
		}
		else
		{
			$inserttable = "UPDATE menu_items SET menu_parant='".$post['menu_parant']."', level='".$post['level']."', menu_name='".$post['menu_name']."', menu_group_id='".$post['menu_group_id']."', menu_type='".$post['menu_type']."', value_name='".$post['value_name']."',value_url='".$post['value_url']."', class='".$post['class']."', menu_style='".$post['menu_style']."', style='".$post['style']."', befor_txt='".$post['befor_txt']."', after_txt='".$post['after_txt']."', bg_color='".$post['bg_color']."', bg_img='".$post['bg_img']."', status='".$post['status']."',displayorder='".$post['order']."'  WHERE id='".$post['id']."' ";
		}
		$result	= $this->db->query($inserttable);
		if($result)
			return TRUE;
		else
			return FALSE;
	}
	
	function  menuItem_status($id,$status)
	{
		$strQuery =	'UPDATE  menu_items SET  status="'.$status.'" WHERE id="'.$id.'"';
		$result	= $this->db->query($strQuery);
		if($result)
			return TRUE;
		else
			return FALSE;
	}
	
	function getExtension($str) 
	 {
         $i = strrpos($str,".");
         if (!$i) { return ""; }
         $l = strlen($str) - $i;
         $ext = substr($str,$i+1,$l);
         return $ext;
 	}
	*/			
}
