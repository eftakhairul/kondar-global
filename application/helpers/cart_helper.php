<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


function getcartcount($cart)
{
	$cart = cartCleanUp($cart);
	$cartcount=is_array($cart)?count($cart):0;	
	return $cartcount;
}
function avalphabetialsort($a, $b)
{
	 return strcmp($a["display"], $b["display"]);
}
function productypesort($a, $b)
{
	 return strcmp($a["type"], $b["type"]);
}

 function cartCleanUp($cart = array())
 {
     if(empty($cart)) return false;

    foreach($cart as $key => $value)
    {
        if($key != $value['item_id']) unset($cart[$key]);
    }

    return $cart;
 }


function getIdByVichleName($name)
{
    $CI =& get_instance();
    $CI->load->model("comman_model");
    return $CI->comman_model->getIdByVichleName($name);
}


function getIdByProductTypeandVichleId($product_name, $vichle_id)
{
    $CI =& get_instance();
    $CI->load->model("comman_model");
    return $CI->comman_model->getIdByProductTypeandVichleId($product_name, $vichle_id);
}
