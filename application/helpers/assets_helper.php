<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
function css_url($fileName,$template)
{
    return base_url() . 'assets/'.$template.'css/' . $fileName . '.css';
}

function js_url($fileName,$template)
{
    return base_url() . 'assets/'.$template.'js/' . $fileName . '.js';
}
function img_url($fileName,$template = '')
{
    return base_url() . 'assets/'.$template.'img/' . $fileName;
}
function global_img_link($fileName,$place)
{
    return base_url() . 'assets/'. $place . $fileName;
}