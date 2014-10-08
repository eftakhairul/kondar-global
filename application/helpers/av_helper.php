<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class KGTMailer extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->library('cart');
        $this->load->library('form_validation');
        $this->load->model('menu_model_ab');
        $this->load->model('comman_model');
        $this->load->model('menu_model');
        $this->load->library("pagination");
        $this->load->helper('date');
        $this->load->helper('common_helper');
        $this->load->helper('language');
        $this->load->language('header');
        $this->load->language('contact');
        $this->load->language('footer');
        $this->load->helper('assets');
        $this->load->helper('av_helper');
        $this->check_lang();
    }

    function getcartcount($cart) {
        //$cart =  $this->session->userdata('cart');	

        $cartcount = is_array($cart) ? count($cart) : 0;

        return $cartcount;
    }

    function avalphabetialsort($a, $b) {

        return strcmp($a["display"], $b["display"]);
    }

    function productypesort($a, $b) {

        return strcmp($a["type"], $b["type"]);
    }

    function sendmail($subject, $body, $to, $from = 'riadh@kondarglobal.ca', $fromname = 'Kondar Global Trading Ltd', $cc = '', $bcc = '',$toname='') {

        $status = false;

        //$this = get_instance(); 

        $config = $this->config->item('emailconfig');


        //var_dump($config);
        // added by 4axiz to solve the problem of email not sending.
        $config = array();
        $config['protocol'] = 'smtp';
        $config['smtp_host'] = 'mail.kondar.ca';
        $config['smtp_port'] = '25';
        $config['smtp_timeout'] = '7';
        $config ['smtp_user'] = "admin@kondar.ca";
        $config ['smtp_pass'] = "Kondar@2014";
        $config['charset'] = 'utf-8';
        $config['newline'] = "\r\n";
        $config['validation'] = TRUE; // bool whether to validate email or not 
//		$config = array(
//					  'protocol' => 'smtp',
//					  'smtp_host' => 'ssl://smtp.googlemail.com',
//					  'smtp_port' => 465,
//					  'smtp_user' => 'rije.avanix@gmail.com',
//					  'smtp_pass' => 'rije06213',
//					  'mailtype'  => 'html', 
//					  'charset'   => 'utf-8'
//					 );				 
//		$config = array (
//					  'mailtype' => 'html',
//					  'charset'  => 'utf-8',
//					  'priority' => '1'
//					   );
        if (!empty($config)) {

            $this->load->library('email', $config);
        } else {
            $this->load->library('email');
        }
        $this->email->set_newline("\r\n");
        $this->email->from($from, $fromname);
        //$this->email->to($to);
        // $this->email->reply_to($to, $toname);

        if ($cc != '')
            $this->email->cc($cc);
        if ($bcc != '')
            $this->email->bcc($bcc);

        $this->email->to($to);
        $this->email->set_header("To",$toname.'<'.$to.'>');
        
        $this->email->subject($subject);
        $this->email->message($body);
        //	$this->email->send();

        $status = $this->email->send();
        //var_dump($status);
        //return $status;
    }

}

/*function samplefunction()
{
	echo "Sample Function";
}
*/
