<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Contact extends MY_Controller {

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
        $this->load->model('country_model');        
        $this->load->library("pagination");
        $this->load->helper('date');
        $this->load->helper('common_helper');
        $this->load->helper('language');
        $this->load->language('header');
        $this->load->language('contact');
        $this->load->language('footer');
        $this->load->helper('assets');
        $this->load->helper('av_helper');
        $this->load->helper('cart_helper');
        $this->check_lang();
    }

    public function index() {
        $this->set_unblock_user();
        $this->session->unset_userdata('set_user');
        $this->load->model("block_list_email");
        $this->load->model('promotion_section_model');
        $this->load->model('vehicle_model');
        $data = array();

        $data['country_data'] = $this->country_model->as_array()->get_many_by(array('status' => 1));        
        $data['menus'] = $this->menu_model_ab->as_array()->get_all();
        $data['download'] = $this->promotion_section_model->as_array()->get_many_by(array('type' => 'knowledge_center'));

        $data['vehicle_menu'] = $this->vehicle_model->as_array()->get_many_by(array('status' => 1));

        $css_e[] = css_url('bootstrap', 'template/');
        $css_e[] = css_url('font-awesome', 'template/');
        $css_e[] = css_url('bootstrap-select', 'template/');
        $css_e[] = css_url('style', 'template/');
        $css_e[] = css_url('avstyles', 'template/');
        $css_e[] = css_url('style_repos', 'template/');
        $css_e[] = css_url('msdropdown/dd', 'template/');
        $css_e[] = css_url('msdropdown/flags', 'template/');
        $css_e[] = css_url('flipclock', $this->_configs['template']);
        $css_e[] = css_url('contact_us', $this->_configs['template']);
        

        $js_e = array();
        $js_e[] = js_url('bootstrap', 'template/');
        $js_e[] = js_url('lang_select', 'template/');
        $js_e[] = js_url('bootstrap-select.min', 'template/');
        $js_e[] = js_url('msdropdown/jquery.dd.min', 'template/');
        $js_e[] = js_url('countdown', 'template/'); 
        $js_e[] = js_url('quicksearch', 'template/');       
        $js_e[] = js_url('flipclock', 'master/');        
        //$js_e[] = js_url('home', 'master/');        
        $js_e[] = js_url('contact_us', $this->_configs['template']);        

        $js_f = array();
        if ($this->session->flashdata('error')) {
            $js_f[] = 'show_error()';
        }      

        $cart = $this->session->userdata('cart');
        $data['cartcount'] = getcartcount($cart);
        $data['vehicle_categories'] = $this->comman_model->all_data('tbl_vehicle_categories');
        $data['menu_vehicle_categories'] = $this->comman_model->all_data('tbl_vehicle_categories');
        $data['menu_product_types'] = $this->comman_model->get_product_type_for_menu();
        
        $user_contact_data = $this->session->userdata("user_contact_data");
        if (!empty($user_contact_data)) {
            $where_param = array();
            $where_param['id'] = $user_contact_data['user_id'];
            $where_param['block'] = 1;
            $select_param = "*";
            $data['block_email_info'] = $this->block_list_email->get_row("contact_form", $select_param, $where_param);
        }


        $data['menus'] = $this->menu_model->get_all_menus();

        $this->_header($css_e);
        $this->_content('include/menu', $data);
        $this->_content('include/address', $data);
        $this->_content('home/contact_us', $data);
        $this->_content('include/footer_content', $data);
        $this->_footer($js_e, $js_f);
    }

    public function verify_contact() {
        $this->load->model('contact_form_model');
        $this->load->model('job_section_model');
        $this->load->model('vehicle_model');
        $this->load->model('promotion_section_model');
        $this->load->model("block_list_email");

        $data = array();
        $data['menus'] = $this->menu_model_ab->as_array()->get_all();
        //check for 
        $user_data = $this->session->userdata('user_contact_data');
        //$this->pre($user_data);
        if (empty($user_data)) {
            /* echo 'user session is empty then redirect to career';
              die; */
            redirect('contact');
        }
        $set_user = $this->session->userdata('set_user');
        if (empty($set_user)) {
            $this->session->set_userdata('set_user', true);
        } else {
            $this->contact_form_model->update($user_data['user_id'], array('block' => 1, 'block_time' => time()));

            $where_param = array();
            $where_param['id'] = $user_data['user_id'];
            $select_param = array("name", "email", "country", "contact");
            $block_emails = $this->block_list_email->get_row("contact_form", $select_param, $where_param);

            $block_data = array();
            $block_data['int_errors'] = 0;
            $block_data['int_sents'] = 0;
            $block_data['dte_block'] = date("Y-m-d H:i:s", time());
            $block_data['int_block'] = 1;
            $block_data['str_code'] = "";
            $block_data['str_email'] = $block_emails[0]->email;
            $block_data['str_applicant'] = $block_emails[0]->name;
            $block_data['str_country'] = $block_emails[0]->country;
            $block_data['str_ip_address'] = $_SERVER['REMOTE_ADDR'];
            $block_data['str_telephone'] = $block_emails[0]->contact;
            $block_data['region'] = "Contact us";
            $this->block_list_email->insert_column("block_email_list", $block_data);

            //$this->session->unset_userdata('user_contact_data');
            $this->session->unset_userdata('set_user');
            $this->session->set_flashdata('error', 'Invalid code');
            $this->session->set_flashdata("email_address", $block_emails[0]->email);
            redirect('contact');
        }

        $cart = $this->session->userdata('cart');
        $data['cartcount'] = getcartcount($cart);

        $data['user_email'] = $user_data['email'];
        $data['apply_form'] = $this->job_section_model->as_array()->get_by(array('id' => $user_data['user_id'], 'status' => 1));
        $data['vehicle_menu'] = $this->vehicle_model->as_array()->get_many_by(array('status' => 1));

        $data['download'] = $this->promotion_section_model->as_array()->get_many_by(array('type' => 'knowledge_center'));


        $css_e[] = css_url('bootstrap', 'template/');
        $css_e[] = css_url('font-awesome', 'template/');
        $css_e[] = css_url('bootstrap-select', 'template/');
        $css_e[] = css_url('style', 'template/');
        $css_e[] = css_url('style_repos', 'template/');
        $css_e[] = css_url('flipclock', $this->_configs['template']);
        $css_e[] = css_url('verify_contact', $this->_configs['template']);



        $js_e = array();
        $js_e[] = js_url('bootstrap', 'template/');
        $js_e[] = js_url('lang_select', 'template/');
        $js_e[] = js_url('bootstrap-select.min', 'template/');
        $js_e[] = js_url('countdown', 'template/');
        $js_e[] = js_url('flipclock', $this->_configs['template']);
        $js_e[] = js_url('verify_contact', $this->_configs['template']);

        $js_f = array();
        if ($this->session->flashdata('error')) {
            $js_f[] = "$('#modal_block').modal('show')";
        }

        $this->_header($css_e);

        $this->_content('include/menu', $data);
        $this->_content('include/address', $data);

        $this->_content('home/verify_contact', $data);
        $this->_content('include/footer_content', $data);
        $this->_footer($js_e, $js_f);
    }

    function getcartcount($cart) {
        //$cart =  $this->session->userdata('cart');	
        $cartcount = is_array($cart) ? count($cart) : 0;
        return $cartcount;
    }

    public function get_model() {
        $id = $this->input->post('id');
        $this->load->model('model_model');
        $belt_data = $this->model_model->as_array()->get_many_by(array('brand_id' => $id));
        echo '<select name="model"  required>';
        echo '<option value="">select</option>';
        foreach ($belt_data as $set_data) {
            echo '<option value="' . $set_data['id'] . '" >' . $set_data['name'] . '</option>';
        }
        echo "</select>";
    }

    public function set_unblock_user() {
        $this->load->model('promotion_form_model');
        $this->load->model('apply_form_model');
        $this->load->model('contact_form_model');

        //edited by 4axiz to perform action of block_email_list table

        $this->load->model("block_list_email");

        $where_param = array();
        $select_param = array("dte_block", "str_email");
        $block_emails = $this->block_list_email->get_row("block_email_list", $select_param, $where_param);
        foreach ($block_emails as $each_email) {
            $date = date("Y-m-d H:i:s", time());
            $datelimit = strtotime('-120 minute', strtotime($date));
            $datelimit = date("Y-m-d H:i:s", $datelimit);
            if ($datelimit > $each_email->dte_block) {   //block time expired
                $where_param = array();
                $where_param['str_email'] = $each_email->str_email;
                $this->block_list_email->delete_row("block_email_list", $where_param);
            }
        }

        //end region

        $set_unblock_user = $this->promotion_form_model->as_array()->get_all();
        $set_unblock_user1 = $this->apply_form_model->as_array()->get_all();
        $set_unblock_user2 = $this->contact_form_model->as_array()->get_all();
        foreach ($set_unblock_user as $set_data2) {
            if ($set_data2['block'] == 1) {
                $currentTime = time();
                $blockTime = strtotime('+120 minutes', $set_data2['block_time']);
                if ($blockTime < $currentTime) {
                    $result1 = $this->promotion_form_model->delete_by(array('id' => $set_data2['id']));
                }
            }
        }
        foreach ($set_unblock_user1 as $set_data2) {
            if ($set_data2['block'] == 1) {
                $currentTime = time();
                $blockTime = strtotime('+120 minutes', $set_data2['block_time']);
                if ($blockTime < $currentTime) {
                    $result1 = $this->apply_form_model->delete_by(array('id' => $set_data2['id']));
                }
            }
        }
        foreach ($set_unblock_user2 as $set_data2) {
            if ($set_data2['block'] == 1) {
                $currentTime = time();
                $blockTime = strtotime('+120 minutes', $set_data2['block_time']);
                if ($blockTime < $currentTime) {
                    $result1 = $this->contact_form_model->delete_by(array('id' => $set_data2['id']));
                }
            }
        }
    }

    public function set_contact_form() {

        $operation = $this->input->post('operation');
        $title = $this->input->post('salutation');
        $name = $this->input->post('name');
        $email = $this->input->post('email');
        $branch = $this->input->post('branch');
        $branchflag = explode(' ', $this->input->post('branchflag'));
        $country = $this->input->post('country');
        $countryflag = explode(' ', $this->input->post('countryflag'));
        $contact = $this->input->post('contact');
        $company = $this->input->post('company');
        $msge = $this->input->post('msge');
        $design = $this->input->post('design');
        if ($this->input->post('operation')) {


            $this->load->model('promotion_form_model');
            $this->load->model('apply_form_model');
            $this->load->model('contact_form_model');
            $word = "a,b,c,d,e,f,g,h,i,j,k,l,m,1,2,3,4,5,6,7,8,9,0";
            $array = explode(",", $word);
            shuffle($array);
            $newstring = implode($array, "");
            $dynamic_code = substr($newstring, 0, 10);
            $post_data = array(
                'name' => $title . '. ' . $name,
                'email' => $email,
                'contact' => $contact,
                'type' => 'contact',
                'branch' => $branch,
                'company' => $company,
                'designation' => $design,
                'message' => $msge,
                'create_date' => time(),
                'country' => $country,
                'code' => $dynamic_code,
                'confirm' => $dynamic_code);

            //edited by 4axiz to perform action of block_email_list table

            $this->load->model("block_list_email");
            $check_user1 = $this->contact_form_model->as_array()->get_by(array('email' => $email, 'block' => 1));
            $check_user2 = $this->apply_form_model->as_array()->get_by(array('email' => $email, 'block' => 1));
            $check_user3 = $this->promotion_form_model->as_array()->get_by(array('email' => $email, 'block' => 1));

            $where_param = array();
            $where_param['str_email'] = $email;
            $select_param = array("dte_block", "str_email", "region");
            $blocked_email = $this->block_list_email->get_row("block_email_list", $select_param, $where_param);

            $date = date("Y-m-d H:i:s", time());
            $datelimit = strtotime('-120 minute', strtotime($date));
            $datelimit = date("Y-m-d H:i:s", $datelimit);

            $int_block = strtotime($blocked_email[0]->dte_block);
            $int_TR = 120 - intval(((time() - $int_block) / 60));
            if ($int_TR < 0)
                $int_TR = 0;

            if (!empty($blocked_email) && $blocked_email[0]->dte_block != NULL && $blocked_email[0]->dte_block > $datelimit) {
                //echo "Sorry your email ID has been blocked in the " . $blocked_email[0]->region . " section";
                echo "The email " . $email . "  is blocked in the section " . $blocked_email[0]->region . " . Therefore, please use an alternative email or wait " . $int_TR . "  minutes to use this email again within our website. Thank you";
            } else {
                $where_param = array();
                $where_param['str_email'] = $blocked_email[0]->str_email;
                $this->block_list_email->delete_row("block_email_list", $where_param);
                //end region
                if (!empty($check_user1)) {
                    $currentTime1 = time();
                    $blockTime1 = strtotime('+120 minutes', $check_user1['block_time']);
                    //echo '<br> add date: '.date('d-m-Y H:i',$blockTime1);
                    if ($blockTime1 > $currentTime1) {
                        $diff = strtotime(date('d-m-Y', $currentTime1) . " 00:00:00") + ($blockTime1 - $currentTime1);
                        $h = date('H', $diff);
                        $min = date('i', $diff);
                        if ($h == 00 || $h == 0) {
                            //$h =1;
                            $min = $min;
                        } else {
                            $min = (($h * 60) + $min);
                        }
                    }
                    echo "The email " . $email . "  is blocked in the section " . $blocked_email[0]->region . " . Therefore, please use an alternative email or wait " . $int_TR . "  minutes to use this email again within our website. Thank you";
                    //echo 'Sorry your email ID has been blocked. Please try again after ' . $min . ' minutes.';
                } else if (!empty($check_user2)) {
                    $currentTime1 = time();
                    $blockTime1 = strtotime('+120 minutes', $check_user2['block_time']);
                    //echo '<br> add date: '.date('d-m-Y H:i',$blockTime1);
                    if ($blockTime1 > $currentTime1) {
                        $diff = strtotime(date('d-m-Y', $currentTime1) . " 00:00:00") + ($blockTime1 - $currentTime1);
                        $h = date('H', $diff);
                        $min = date('i', $diff);
                        if ($h == 00 || $h == 0) {
                            //$h =1;
                            $min = $min;
                        } else {
                            $min = (($h * 60) + $min);
                        }
                    }
                    echo "The email " . $email . "  is blocked in the section " . $blocked_email[0]->region . " . Therefore, please use an alternative email or wait " . $int_TR . "  minutes to use this email again within our website. Thank you";
                    //echo 'Sorry your email ID has been blocked. Please try again after ' . $min . ' minutes.';
                } else if (!empty($check_user3)) {
                    $currentTime2 = time();
                    $blockTime2 = strtotime('+120 minutes', $check_user3['block_time']);
                    //echo '<br> add date: '.date('d-m-Y H:i',$blockTime1);
                    if ($blockTime2 > $currentTime2) {
                        $diff = strtotime(date('d-m-Y', $currentTime2) . " 00:00:00") + ($blockTime2 - $currentTime2);
                        $h = date('H', $diff);
                        $min = date('i', $diff);
                        if ($h == 00 || $h == 0) {
                            //$h =1;
                            $min = $min;
                        } else {
                            $min = (($h * 60) + $min);
                        }
                    }
                    echo 'Sorry your email ID has been blocked. Please try again after ' . $min . ' minutes.';
                } else {

                    $result = $this->contact_form_model->insert($post_data);
                    //create use session
                    $session_data = array('name' => $post_data['name'], 'email' => $this->input->post('email'), 'user_id' => $result, 'countryflag' => $countryflag[1], 'branchflag' => $branchflag[1],);
                    $this->session->set_userdata('user_contact_data', $session_data);



                    //$your_message = ('Hello '.$this->input->post('name').' Your code: '.$dynamic_code);
                    $html = $this->load->view('master/email/code_email', array('name' => $post_data['name'], 'dynamic_code' => $dynamic_code, 'attempt' => 1), TRUE);

                    //edited by 4axiz to execute the operation of block_email_list table

                    $block_data = array();
                    $block_data['int_errors'] = 0;
                    $block_data['int_sents'] = 1;
                    $block_data['dte_block'] = NULL;
                    $block_data['int_block'] = 0;
                    $block_data['str_code'] = $dynamic_code;
                    $block_data['str_email'] = $this->input->post('email');
                    $block_data['str_applicant'] = $this->input->post('name');
                    $block_data['str_country'] = $this->input->post('country');
                    $block_data['str_ip_address'] = $_SERVER['REMOTE_ADDR'];
                    $block_data['str_telephone'] = $this->input->post('contact');
                    $block_data['region'] = "Contact us";
                    $this->block_list_email->insert_column("block_email_list", $block_data);

                    //region end

                    $this->load->library('email');
                    $config = array(
                        'mailtype' => 'html',
                        'charset' => 'utf-8',
                        'priority' => '1'
                    );
                    $this->email->initialize($config);
                    $this->load->helper('av_helper');

                    $kgtmailer = new KGTMailer();

//                    $from = 'customerservice@kondarglobal.ca';
                    $from = "customerservice@kondar.ca";
                    $fromname = 'KGT customer service department';
                    $to = $this->input->post('email');
                    $toname = $post_data['name'];
                    $subject = 'Contact Us Form Verification Code';
                    $message = $html;
                    $cc = '';
                    $bcc = '';


                    //$mailerstatus = $kgtmailer->sendmail($subject, $message, $to, $from, $fromname, $cc, $bcc, $toname);
                    $this->email->from($from, $fromname);
                    $this->email->to($to);
                    $this->email->set_header("To", $toname . '<' . $to . '>');
                    $this->email->subject($subject);
                    $this->email->message($message);
                    $result = $this->email->send();
                    //if($mailer=='true')
                    echo 'success';
                }
            }
        }
    }

    public function set_block_user() {
        $page = $this->input->post('form');
        $this->load->model('contact_form_model');
        $this->load->model('promotion_form_model');
        $this->load->model('apply_form_model');

        if ($page == 'contact') {
            $user_data = $this->session->userdata('user_contact_data');
            if (empty($user_data)) {
                redirect('contact');
            }
            $this->contact_form_model->update($user_data['user_id'], array('block' => 1, 'block_time' => time()));
            $this->session->unset_userdata('user_contact_data');
            $this->session->unset_userdata('attempts');
            echo 'success';
        }
    }

    public function get_cancel_form1() {
        $page = $this->input->post('form');

        if ($page == 'contact') {
            $this->load->model('contact_form_model');
            $user_data = $this->session->userdata('user_contact_data');
            if (empty($user_data)) {
                redirect('contact');
            }
//date_default_timezone_set('Asia/Calcutta');
            $result1 = $this->contact_form_model->delete_by(array('id' => $user_data['user_id']));

//edited by 4axiz to execute operation on block_email_list

            $this->load->model("block_list_email");
            $where_param = array();
            $where_param['str_email'] = $user_data['email'];
            $block_data = array();
            $block_data['int_block'] = 1;
            $block_data['dte_block'] = date("Y-m-d H:i:s", time());
            $this->block_list_email->update_column("block_email_list", $where_param, $block_data);

//end region

            $this->session->unset_userdata('user_contact_data');
            echo 'success';
        }
    }

    public function get_send_mail1($attempt = '') {
        $page = $this->input->post('form');
        if ($page == 'contact') {
            $this->load->model('contact_form_model');
            $this->load->model("block_list_email");
            $user_data = $this->session->userdata('user_contact_data');
            if (empty($user_data)) {
//redirect('contact');
            }
            $word = "a,b,c,d,e,f,g,h,i,j,k,l,m,1,2,3,4,5,6,7,8,9,0";
            $array = explode(",", $word);
            shuffle($array);
            $newstring = implode($array, "");
            $dynamic_code = substr($newstring, 0, 10);
            $this->contact_form_model->update($user_data['user_id'], array('code' => $dynamic_code, 'confirm' => $dynamic_code));

//edited by to excute the operation for the block_email_list table

            $where_param = array();
            $where_param['str_email'] = $user_data['email'];
            $select_param = array('int_sents' => 'int_sents');
            $block_info = $this->block_list_email->get_row("block_email_list", $select_param, $where_param);
            $block_data = array();
            $block_data['int_sents'] = $block_info[0]->int_sents + 1;
            $block_data['str_code'] = $dynamic_code;
            $this->block_list_email->update_column("block_email_list", $where_param, $block_data);

//region end

            $html = $this->load->view('master/email/code_email', array('name' => $user_data['name'], 'dynamic_code' => $dynamic_code, 'attempt' => $attempt), TRUE);
            $this->load->library('email');
            $config = array(
                'mailtype' => 'html',
                'charset' => 'utf-8',
                'priority' => '1'
            );
            $this->email->initialize($config);
            $this->load->helper('av_helper');
            $kgtmailer = new KGTMailer();

// send to user email verification
//            $from = 'customerservice@kondarglobal.ca';
            $from = "customerservice@kondar.ca";
            $fromname = 'KGT Customer Service Department ';
            $to = $user_data['email'];
            $toname = $user_data['name'];
            $subject = 'Contact US Form Verification Code Resend Attempt : ' . $attempt;
            $message = $html;
            $cc = '';
            $bcc = '';



//            $mailerstatus = $kgtmailer->sendmail($subject, $message, $to, $from, $fromname, $cc, $bcc, $toname);
//
////if($mailer=='true')
//            echo 'success';

            $this->email->from($from, $fromname);
            $this->email->to($to);
            $this->email->set_header("To", $toname . '<' . $to . '>');
            $this->email->subject($subject);
            $this->email->message($message);
            $result = $this->email->send();
            echo 'success';
        }
    }

    public function user_block() {
        $user_data = $this->session->userdata('user_contact_data');
        $this->load->model('contact_form_model');
        $this->contact_form_model->update($user_data['user_id'], array('block' => 1, 'block_time' => time()));

//edited by 4axiz to execute operation on block_email_list
        $this->load->model("block_list_email");
        $where_param = array();
        $where_param["str_email"] = $user_data['email'];
        $select_param = array("str_email" => "str_email");
        $block_info = $this->block_list_email->get_row('block_email_list', $select_param, $where_param);
        $int_block = $this->input->post('int_block');
        
        if (!empty($block_info)) {
            $where_param = array();
            $where_param["str_email"] = $user_data['email'];
            $block_data = array();
            if($int_block){
                $block_data['int_block'] = $int_block;
            }else{
                $block_data['int_block'] = 5;
            }
            $block_data['dte_block'] = date("Y-m-d H:i:s", time());
            $this->block_list_email->update_column("block_email_list", $where_param, $block_data);
        } else {

            $where_param = array();
            $where_param["email"] = $user_data['email'];
            $select_param = array("name" => "name", "country" => "country", "contact" => "contact");
            $user_info = $this->block_list_email->get_row('contact_form', $select_param, $where_param);


            $block_data = array();
            $block_data['int_errors'] = 0;
            $block_data['int_sents'] = 0;
            $block_data['int_block'] = 5;
            $block_data['dte_block'] = date("Y-m-d H:i:s", time());
            $block_data['str_email'] = $user_data['email'];
            $block_data['str_applicant'] = $user_info[0]->name;
            $block_data['str_country'] = $user_info[0]->country;
            $block_data['str_ip_address'] = $_SERVER['REMOTE_ADDR'];
            $block_data['str_telephone'] = $user_info[0]->contact;
            $block_data['region'] = "Contact us";
            $this->block_list_email->insert_column("block_email_list", $block_data);
        }
//end region
//$this->session->unset_userdata('user_contact_data');
        $this->session->unset_userdata('attempts');
        echo "success";
    }

    public function get_verify1() {
        $page = $this->input->post('form');
        $this->load->model('contact_form_model');
        $this->load->model('promotion_form_model');
        $this->load->model('promotion_section_model');
        $this->load->model('order_model');
        $this->load->model('order_item_model');
        $this->load->model("block_list_email");

        if ($page == 'contact') {
            $user_data = $this->session->userdata('user_contact_data');
            if (empty($user_data)) {
//redirect('contact');
            }
            $check_attempt = $this->session->userdata('attempts');
            if ($check_attempt < 3) {
                $code = $this->input->post('code');
                $check1 = $this->contact_form_model->as_array()->get_by(array('code' => $code));
                if (empty($check1)) {
                    //		$time = $this->session->set_userdata(array('attempt_time'=>time()));
                    $attmpt = $this->session->userdata('attempts') + 1;
                    $set = array('attempts' => $attmpt);
                    $this->session->set_userdata($set);
                    $this->session->userdata('attempts');

                    //edited by 4axiz to execute operation on block_email_list table

                    $where_param = array();
                    $where_param['str_email'] = $user_data['email'];
                    $select_param = array('int_errors' => 'int_errors');
                    $block_info = $this->block_list_email->get_row("block_email_list", $select_param, $where_param);
                    $block_data = array();
                    $block_data['int_errors'] = $block_info[0]->int_errors + 1;
                    $this->block_list_email->update_column("block_email_list", $where_param, $block_data);

                    //region end



                    echo 'Your code is wrong.Please try again.';
                } else {
                    $user_data1 = $this->contact_form_model->as_array()->get_by(array('id' => $user_data['user_id']));
                    $html = $this->load->view('master/email/contact_email', array('user_data1' => $user_data1, 'user' => 'admin'), TRUE);
                    $html1 = $this->load->view('master/email/contact_email', array('user_data1' => $user_data1, 'user' => $user_data1['name']), TRUE);

                    //edited by 4axiz to execute the block_email_list table

                    $where_param = array();
                    //$where_param['int_id'] = $row->int_id;
                    $where_param['str_email'] = $user_data['email'];
                    $this->block_list_email->delete_row("block_email_list", $where_param);

                    //end the block

                    $this->load->library('email');
                    $config = array(
                        'mailtype' => 'html',
                        'charset' => 'utf-8',
                        'priority' => '1'
                    );
                    $this->email->initialize($config);
                    //for admin mail
                    //$this->email->from($user_data['email'], 'Contact Us Form');
                    //$this->email->from($user_data['email']);
                    /* if($user_data1['branch']=='Vancouver')
                      $this->email->to('admin@kondarglobal.ca,customerservice@kondarglobal.ca');
                      else if($user_data1['branch']=='London')
                      $this->email->to('maoui@kondarglobal.ca,admin@kondarglobal.ca,customerservice@kondarglobal.ca');
                      else if($user_data1['branch']=='Dubai')
                      $this->email->to('rguez@kondarglobal.ca,admin@kondarglobal.ca,customerservice@kondarglobal.ca');
                      else if($user_data1['branch']=='Tunis')
                      $this->email->to('benmohamed@kondarglobal.ca,admin@kondarglobal.ca,customerservice@kondarglobal.ca'); */
                    //$this->email->subject("Contact Us Form");			
                    //$this->email->message($html);
                    //$this->email->send();	
                    $this->load->helper('av_helper');
                    $kgtmailer = new KGTMailer();

                    $from = $user_data['email'];
                    $fromname = $user_data['name'];
                    if ($user_data1['branch'] == 'Canada-Vancouver') {
//                        $to = 'admin@kondarglobal.ca,customerservice@kondarglobal.ca';
                        $to = 'admin@kondar.ca,customerservice@kondar.ca';
                    } else if ($user_data1['branch'] == 'UK-London') {
//                        $to = 'maoui@kondarglobal.ca,admin@kondarglobal.ca,customerservice@kondarglobal.ca';
                        $to = 'maoui@kondar.ca,admin@kondar.ca,customerservice@kondar.ca';
                    } else if ($user_data1['branch'] == 'UAE-Dubai') {
//                        $to = 'rguez@kondarglobal.ca,admin@kondarglobal.ca,customerservice@kondarglobal.ca';
                        $to = 'rguez@kondar.ca,admin@kondar.ca,customerservice@kondar.ca';
                    } else if ($user_data1['branch'] == 'Tunisia-Tunis') {
                        $to = 'benmohamed@kondar.ca,admin@kondar.ca,customerservice@kondar.ca';
                        $to = 'benmohamed@kondar.ca,admin@kondar.ca,customerservice@kondar.ca';
                    }


                    $subject = 'New Contact Us Form';
                    $toname = 'KGT Customer Service Department';
                    $message = $html;
                    $cc = '';
                    $bcc = '';



                    $this->email->from($from, $fromname);
                    //$this->email->to($to);
                    $this->email->to($to);

                    if ($to == 'admin@kondar.ca,customerservice@kondar.ca') {
                        $this->email->set_header("To", 'KGT Customer Service Department <customerservice@kondar.ca>;Vancouver <admin@kondar.ca>');
                    } else if ($to == 'maoui@kondar.ca,admin@kondar.ca,customerservice@kondar.ca') {
                        $this->email->set_header("To", 'KGT Customer Service Department <customerservice@kondar.ca>;Vancouver <admin@kondar.ca>,London <maoui@kondar.ca>');
                    } else if ($to == 'rguez@kondar.ca,admin@kondar.ca,customerservice@kondar.ca') {
                        $this->email->set_header("To", 'KGT Customer Service Department <customerservice@kondar.ca>;Vancouver <admin@kondar.ca>,Dubai <rguez@kondar.ca>');
                    } else if ($to == 'benmohamed@kondar.ca,admin@kondar.ca,customerservice@kondar.ca') {
                        $this->email->set_header("To", 'KGT Customer Service Department <customerservice@kondar.ca>;Vancouver <admin@kondar.ca>,Dubai <benmohamed@kondar.ca>');
                    }

                    $this->email->subject("New Contact Us Form");
                    $this->email->message($message);
                    $result = $this->email->send();


                    //$mailerstatus = $kgtmailer->sendmail($subject, $message, $to, $from, $fromname, $cc, $bcc, $toname);
                    //for user mail
//                    $from = 'customerservice@kondarglobal.ca';
                    $from = 'customerservice@kondar.ca';
                    $fromname = 'KGT Customer Service Department';
                    $to = $user_data['email'];
                    $toname = $user_data['name'];
                    $subject = 'Contact Us Form Acknowledgement Receipt';
                    $message = $html1;
                    $cc = '';
                    $bcc = '';
                    //$too = $this->email->set_custom_header($toname,$to);
                    //$mailerstatus = $kgtmailer->sendmail($subject, $message, $to, $from, $fromname, $cc, $bcc, $toname);
                    $this->email->from($from, $fromname);
                    $this->email->to($to);
                    $this->email->set_header("To", $toname . '<' . $to . '>');
                    $this->email->subject($subject);
                    $this->email->message($message);
                    $result = $this->email->send();


                    $this->contact_form_model->update($user_data['user_id'], array('confirm' => 'confirm'));
                    $this->session->unset_userdata('user_contact_data');
                    echo 'success';
                }
            } else {
                $this->contact_form_model->update($user_data['user_id'], array('block' => 1, 'block_time' => time()));
//$this->session->unset_userdata('user_contact_data');
                $this->session->unset_userdata('attempts');
//echo 'Your code is wrong.Please try again.';
//edited by 4axiz to execute operation on block_email_list table

                $where_param = array();
                $where_param['str_email'] = $user_data['email'];

                $block_data = array();
                $block_data['int_block'] = 2;
                $block_data['dte_block'] = date("Y-m-d H:i:s", time());
                $this->block_list_email->update_column("block_email_list", $where_param, $block_data);

//region end


                echo 'redirect';
            }
        }
    }

    function put_data_session() {
        $new_session['email'] = $this->input->post("email");
        $new_session['country'] = $this->input->post("country");
        $new_session['contact'] = $this->input->post("contact");
        $new_session['name'] = $this->input->post("name");

        $this->session->set_userdata("new_session", $new_session);
        echo "success";
    }

    function preview_state_block() {
        $user_data = $this->session->userdata('new_session');

//edited by 4axiz to execute operation on block_email_list
        $this->load->model("block_list_email");
        $where_param = array();
        $where_param["str_email"] = $user_data['email'];
        $select_param = array("str_email" => "str_email");
        $block_info = $this->block_list_email->get_row('block_email_list', $select_param, $where_param);

        if (!empty($block_info)) {
            $where_param = array();
            $where_param["str_email"] = $user_data['email'];
            $block_data = array();
            $block_data['int_block'] = 5;
            $block_data['dte_block'] = date("Y-m-d H:i:s", time());
            $this->block_list_email->update_column("block_email_list", $where_param, $block_data);
        } else {
            $block_data = array();
            $block_data['int_errors'] = 0;
            $block_data['int_sents'] = 0;
            $block_data['int_block'] = 5;
            $block_data['dte_block'] = date("Y-m-d H:i:s", time());
            $block_data['str_email'] = $user_data['email'];
            $block_data['str_applicant'] = $user_data['name'];
            $block_data['str_country'] = $user_data['country'];
            $block_data['str_ip_address'] = $_SERVER['REMOTE_ADDR'];
            $block_data['str_telephone'] = $user_data['contact'];
            $block_data['region'] = "Contact us";
            $this->block_list_email->insert_column("block_email_list", $block_data);
        }
//end region
//$this->session->unset_userdata('user_contact_data');
        echo "success";
    }

    /*
     * This function will evoke in the blur event of an email is given
     * to check whether this email address is already blocked or not
     */

    function block_email_check() {
        $this->load->model("block_list_email");
        $email = $this->input->post("email");
        $where_param = array();
        $where_param['str_email'] = $email;
        $where_param['int_block !='] = 0;
        $select_param = array("int_id", "str_email", "dte_block", "region");
        $block_emails = $this->block_list_email->get_row("block_email_list", $select_param, $where_param);
        if (count($block_emails) > 0) {
            $int_block = strtotime($block_emails[0]->dte_block);
            $int_TR = 120 - intval(((time() - $int_block) / 60));
            echo $block_emails[0]->str_email . "#**#" . $int_TR . "#**#" . $block_emails[0]->region;
        } else {
            echo "no_block";
        }
    }

    /*
     * This function will evoke when timeout will happen from the contact us form. 
     * 
     */

    function block_email_timeout() {
        $this->load->model("block_list_email");
        $email = $this->input->post("email");
        $name = $this->input->post("name");
        $country = $this->input->post("country");
        $contact = $this->input->post("contact");
        $where_param = array();
        $where_param['str_email'] = $email;
        $where_param['int_block !='] = 0;
        $select_param = array("int_id", "str_email", "dte_block", "region");
        $block_emails = $this->block_list_email->get_row("block_email_list", $select_param, $where_param);
        if (count($block_emails) == 0) {

            $block_data = array();
            $block_data['int_errors'] = 0;
            $block_data['int_sents'] = 0;
            $block_data['dte_block'] = date("Y-m-d H:i:s", time());
            $block_data['int_block'] = 5;
            $block_data['str_code'] = "";
            $block_data['str_email'] = $email;
            $block_data['str_applicant'] = $name;
            $block_data['str_country'] = $country;
            $block_data['str_ip_address'] = $_SERVER['REMOTE_ADDR'];
            $block_data['str_telephone'] = $contact;
            $block_data['region'] = "Contact us";
            $this->block_list_email->insert_column("block_email_list", $block_data);
        }
        $this->session->unset_userdata('user_contact_data');
        echo "success";
    }

    function get_timer() {
        $value = $this->input->post('value');
           $value = $this->input->post('value');
         if($value=='edit'){
            $select = "contact_edit_timer,contact_edit_msg";
        }elseif($value=='main'){
            $select = "main_contact_timer,main_contact_msg";
        }elseif($value=='preview'){
            $select="contact_preview_timer,contact_preview_msg";
        }else{
            $select = "contact_popup_timer,contact_popup_msg";
        }
        $time = $this->comman_model->get_timer('contact_timer',$select);
        echo json_encode($time);
    }

}

/* End of file front.php */
/* Location: ./application/controllers/front.php */
