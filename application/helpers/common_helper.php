<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	 // this function is used for the show array result for the checking result	
	function pr($data){
		print_r('<pre>');
		print_r($data);
	}
	
	 // this function is used for the show variable value 
	function e($data){
		echo $data;
	}

	function test()
	{
		echo "this is from common helper";
	}




function getRealIpAddr()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
    {
      $ip=$_SERVER['HTTP_CLIENT_IP'];
    }
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
    {
      $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    else
    {
      $ip=$_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}





	if(!function_exists("gender")) {
		function gender()
		{
			$gender = array(
				'1'=>'Male',				
				'2'=>'Female',
				
				);
			
			
			
			
			return $gender;
		
		}
		
	}	
	
if(!function_exists("display_error")) {
	function display_error($message,$label)
	{
		
	?>
		
		<span>
			<?php echo($label);?>
		</span>
		
        
		<div>
			<?php echo($message);?>
		</div>
						
			
	<?php 
		}
}   
 
 
   
   
	 // this function is used for the display error message and notice	
	if(!function_exists("display_error_small_div")) {
		function display_error_small_div($message,$label)
		{
		?>
			
			 <div class="error-contacts">
        	<div class="error-contacts1"></div>
            <div class="error-contacts2">
          	<h1 class="error-title"><?php echo($label);?></h1>
            <p class="error-text">
           <?php echo($message);?>           
            <br />
          	</div>
            <div class="error-contacts3"></div>
        </div>
<?php 
		}
	}  
     

//  Function get detail by Id 
if(!function_exists("fetchDataById")) { 
 
	function fetchDataById($condition,$table)
	{
		  
		$ci =& get_instance();
		$ci->load->database();
		
		if(!empty($condition))
			{
				foreach($condition as $fieldName=>$fieldValue){
					$ci->db->where($fieldName,$fieldValue);
				}
			}
			
		$query = $ci->db->get_where($table);
		//echo $ci->db->last_query();
		return $query->row_array();	
	}
	
}	


//  Function get detail by Id 
if(!function_exists("fetchAllData")) {
 
	function fetchAllData($condition,$table)
	{
		
		$ci =& get_instance();
		$ci->load->database();
		
		if(!empty($condition))
			{
				foreach($condition as $fieldName=>$fieldValue){
					$ci->db->where($fieldName,$fieldValue);
				}
			}
			
		$query = $ci->db->get_where($table);
		//echo $ci->db->last_query();
		return $query->result_array();	
	}
	
}	

//  Function get detail by Id 
if(!function_exists("addData")) {

	
	function addData($table,$post_data)
	{		
		$ci =& get_instance();
		$ci->load->database();		
		$ci->db->insert($table, $post_data);
		return $ci->db->insert_id(); 
	}	

}
	
	if ( ! function_exists('xmlToArray'))
	{
		function xmlToArray($xml,$ns=null)
		{
			$a = array();
			for($xml->rewind(); $xml->valid(); $xml->next())
			{
				$key = $xml->key();
				if(!isset($a[$key])) { $a[$key] = array(); $i=0; }
				else $i = count($a[$key]);
				$simple = true;
				foreach($xml->current()->attributes() as $k=>$v) {
					$a[$key][$i][$k]=(string)$v;
					$simple = false;
				}
			
				if($ns) foreach($ns as $nid=>$name) 
				{
					foreach($xml->current()->attributes($name) as $k=>$v) 
					{
						$a[$key][$i][$nid.':'.$k]=(string)$v;
						$simple = false;
					}			
				}
			
				if($xml->hasChildren())
				{
					if($simple) $a[$key][$i] = xmlToArray($xml->current(), $ns);
					else $a[$key][$i]['content'] = xmlToArray($xml->current(), $ns);
				} else {
					if($simple) $a[$key][$i] = strval($xml->current());
						else $a[$key][$i]['content'] = strval($xml->current());
					}
					$i++;
			}
			return $a;
		}
	}
	
	//  Function to update detail by id
if(!function_exists("updateDataById")) {
	
	function updateDataById($table,$condition,$siteData)
	{
		$ci=& get_instance();		
		$ci->load->database();	
		
		if(!empty($condition))
			{
				foreach($condition as $fieldName=>$fieldValue){
					$ci->db->where($fieldName,$fieldValue);
				}
		}
			$ci->db->update($table, $siteData); 
		
	}
	
}



//  Function to delete data by Id		
	function deleteRecordByCondition($tablename,$condition)
	{
		$ci=& get_instance();		
		$ci->load->database();	
		$ci->db->delete($tablename,$condition);
	}
	
// get session detail

	 function get_session_detail()
	 {
	 	$CI=& get_instance();
		$session_data = $CI->session->all_userdata();
		return $session_data;
	 }
	 
	 
	 //  check story exits or not
	 	
	function check_story_exits_or_not($where_condition)
	{
		$ci=& get_instance();		
		$ci->load->database();	
		
		if(!empty($where_condition))
		{
			foreach($where_condition as $key=>$value)
			{
				$ci->db->where($key,$value);
			}
		}
		$query = $ci->db->get('storys');
		return $query->row_array();	
		
	}
	
	
	 
  // Set timezone
 // date_default_timezone_set("UTC");
 
  // Time format is UNIX timestamp or
  // PHP strtotime compatible strings
  function dateDiff($time1, $time2, $precision = 6) {
    // If not numeric then convert texts to unix timestamps
    if (!is_int($time1)) {
      $time1 = strtotime($time1);
    }
    if (!is_int($time2)) {
      $time2 = strtotime($time2);
    }
 
    // If time1 is bigger than time2
    // Then swap time1 and time2
    if ($time1 > $time2) {
      $ttime = $time1;
      $time1 = $time2;
      $time2 = $ttime;
    }
 
    // Set up intervals and diffs arrays
    $intervals = array('year','month','day','hour','minute','second');
    $diffs = array();
 
    // Loop thru all intervals
    foreach ($intervals as $interval) {
      // Set default diff to 0
      $diffs[$interval] = 0;
      // Create temp time from time1 and interval
      $ttime = strtotime("+1 " . $interval, $time1);
      // Loop until temp time is smaller than time2
      while ($time2 >= $ttime) {
	$time1 = $ttime;
	$diffs[$interval]++;
	// Create new temp time from time1 and interval
	$ttime = strtotime("+1 " . $interval, $time1);
      }
    }
 
    $count = 0;
    $times = array();
    // Loop thru all diffs
    foreach ($diffs as $interval => $value) {
      // Break if we have needed precission
      if ($count >= $precision) {
	break;
      }
      // Add value and interval 
      // if value is bigger than 0
      if ($value > 0) {
	// Add s if value is not 1
	if ($value != 1) {
	  $interval .= "s";
	}
	// Add value and interval to times array
	$times[] = $value . " " . $interval;
	$count++;
      }
    }
 
    // Return string with times
    return implode(", ", $times);
  }


function addCSS($css) {

	$GLOBALS['css'][] = $css;

}
function addJS($js) {

	$GLOBALS['js'][] = $js;

}



function sss()
{
	//die('asasasa');
    $CI =& get_instance();
    $CI->db->where('id', 1);
    $query = $CI->db->get('settings');
    return $query->row_array();  
    //return $membres;      
}


function get_maker_data1($category_id = NULL, $type_id = NULL)
{
		$CI =& get_instance();
		$session_data = $CI->session->all_userdata();
		$vehicle_type_id = isset($session_data['vehicle_type_id_new']) ? $session_data['vehicle_type_id_new'] : '';
		//echo $category_id;
		//echo "<pre>"; print_r($vehicle_type_id); die;
		$querysql = "SELECT  tbl_products.vehicle_category_id, tbl_product_types.id as type_id,tbl_product_types.product_type_name as type,tbl_product_types.Product_Type_Photo as type_photo,tbl_product_types.vehicle_category_id as category_id FROM tbl_products JOIN tbl_product_types ON tbl_product_types.id = tbl_products. product_type_id  WHERE 1";
		if (!empty($category_id)) $querysql .= " AND tbl_products.vehicle_category_id = ".$category_id;
		if (!empty($type_id)) $querysql .= " AND tbl_products.product_type_id = ".$type_id;
		if(!empty($vehicle_type_id)) {
            $querysql_1 = "";
            $j = 1;
            foreach ($vehicle_type_id as $arr) 
			{
				//echo "<pre>"; print_r($arr);
                //var_dump($type_id);
                if ($arr['type_id'] != '' && $arr['type_cat_id'] == $category_id) {
					if ($j > 1)
                        $querysql_1.= " OR tbl_product_types.id = " . $arr['type_id'] . " ";
                    else
                        $querysql_1.= " AND ( tbl_product_types.id = " . $arr['type_id'] . " ";

                    $j++;
                }
            }
			 if ($querysql_1 != '')
                $querysql_1.= " ) ";
            $querysql.= $querysql_1;
		}
		 $querysql.= " GROUP BY tbl_products.product_type_id ";
		//echo $querysql; 
		$query = $CI->db->query($querysql);
       
        return $query->result_array();
    
}

function get_maker_data2($category_id = null,$product_type_id = null)
{
		$CI =& get_instance();
		
		$querysql = "SELECT tbl_makers.id as maker_id,tbl_makers.maker_name as maker_name, tbl_makers.maker_logo as maker_logo FROM tbl_products JOIN tbl_makers ON tbl_makers.id = tbl_products.maker_id  WHERE tbl_products.vehicle_category_id = ".$category_id." AND tbl_products.product_type_id = ".$product_type_id." GROUP BY tbl_products.maker_id";
		//echo $querysql; 
		$query = $CI->db->query($querysql);
       
        return $query->result_array();
    
}
// ------------------------------------------------------------------------

/* End of file xml_helper.php */
/* Location: ./system/helpers/xml_helper.php */