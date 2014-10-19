<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function printdbg($data) {
	echo "All \$_POST values:<pre>";
	print_r($_POST);
	echo "</pre>";
	echo "All \$data values:<pre>";
	print_r($data);
	echo "</pre>";
	$CI =& get_instance();
	$sess = $CI->session->all_userdata();
	echo "All Session Data:<pre>";
	print_r($sess);
	echo "</pre>";
}

/* End of file dbg_helper.php */
/* Location: ./system/helpers/dbg_helper.php */