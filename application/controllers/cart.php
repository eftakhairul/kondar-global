<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cart extends CI_Controller {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     * 	- or -  
     * 		http://example.com/index.php/welcome/index
     * 	- or -
     * Since this controller is set as the default controller in 
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will 
     * map to /index.php/welcome/<method_name>
     * @see http://codeigniter.com/user_guide/general/urls.html
     */
    public function __construct() {

        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
        $this->load->model(array('user_model', 'search_model', 'serial_model', 'product_model', 'menu_model'));
        $this->load->model('country_model');
        $this->load->library('form_validation');
        $this->load->model('comman_model');
        $this->load->model('product_model');
        $this->load->model('cart_model');
        $this->load->library("pagination");
        $this->load->helper('date');
        $this->load->helper('av_helper');
        $this->load->helper('cart_helper');
        $this->load->helper('assets');
        $this->load->helper('language');
        $this->load->language('header');
        $this->load->language('cart');
        $this->load->language('footer');
    }

    function index() {
        $this->check_lang();

        $data['country_data'] = $this->country_model->as_array()->get_many_by(array('status' => 1));
        $data['session_data'] = $this->session->all_userdata();
        $data['title'] = 'Kondar Global';
        $cart = $this->session->userdata('cart');

        $cart = cartCleanUp($cart);
        $this->session->set_userdata('cart', $cart);
        $this->session->set_userdata('new_cart', $cart);

        /* $data['cart_details'] =  $this->product_model->get_cart_items($cart); */
        $cart_details = $this->product_model->get_cart_items($cart);

        $this->load->model("block_list_email");
        $select_param = array("*");
        $where_param = array();
        $where_param['id'] = 1;
        $data["cart_timer"] = $this->block_list_email->get_row("cart_timer", $select_param, $where_param);

        usort($cart_details, "productypesort");
        $data['cart_details'] = $cart_details;

        //$data['cart_data'] = $cart;

        $data['countries'] = $this->comman_model->search_serial_data('countries');
        $homepage_data = $this->comman_model->search_serial_data('home_page');
        $data['cart_image'] = $homepage_data[0]['cart_photo'];

        $data['menu_vehicle_categories'] = $this->comman_model->all_data('tbl_vehicle_categories');
        $data['menu_product_types'] = $this->comman_model->get_product_type_for_menu();

        $data['cart_users_data'] = $this->session->userdata('cart_users_data');

        $cart = $this->session->userdata('cart');
        $data['cartcount'] = getcartcount($cart);


        $last_inserted_cart_block_id = $this->session->userdata('last_inserted_cart_block_id');
        $data['last_inserted_cart_block_id'] = $last_inserted_cart_block_id;

        if ($last_inserted_cart_block_id)
            $data['current_cart_user_data'] = $this->comman_model->get_data_by_id('cart_block_users', array('id' => $last_inserted_cart_block_id));


        $data['edit_cart_mode'] = isset($data['current_cart_user_data']['cartmode']) ? $data['current_cart_user_data']['cartmode'] : '';
        $data['menus'] = $this->menu_model->get_all_menus();
        
        
        //to get selection instruction
        
        $where_param = array();
        $where_param['id'] = 1;
        $select_param = array("maincart_block_msg","editcart_block_msg","cartpreview_block_msg","cartverification_block_msg","block_notification_msg","cartverification_resent_block_msg","cartverification_wrong_block_msg");
        $data['selection_instruction'] = $this->block_list_email->get_row("selection_instruction",$select_param,$where_param);
        
        
        //to get selection instruction  end
        
        $this->load->view('temp/include/header', $data);
        $this->load->view('cart/cart', $data);
        $this->load->view('temp/footer', $data);
    }

    function save_cart_data()
    {
        $this->load->model("block_list_email");
        $this->check_lang();
        $user_name = $this->input->post('salutation') . ' ' . $this->input->post('surname');
        $cart_users_data = array(
            'user_name' => $user_name,
            'company' => $this->input->post('company'),
            'designation' => $this->input->post('designation'),
            'address' => $this->input->post('address'),
            'country' => $this->input->post('country'),
            'telephone' => $this->input->post('telephone'),
            'email' => $this->input->post('email'),
            'deadline' => $this->input->post('deadline'),
            'rfq' => $this->input->post('rfq'),
            'incoterms' => $this->input->post('incoterms')
        );
        $session_data = array(
            'cart_users_data' => $cart_users_data
        );

        $this->session->set_userdata($session_data);
        $data['cart_users_data'] = $this->session->userdata('cart_users_data');

        $cart_email_attempt = $this->session->userdata('cart_email_attempt');

        if ($data['cart_users_data'] != $this->input->post('email')) {
            $cart_email_attempt = 0;
        }

        $cart_email = array(
            'cart_email_attempt' => $cart_email_attempt
        );
        $this->session->set_userdata($cart_email);

        $this->updatedcart();

        $data['cart_users_data'] = $this->session->userdata('cart_users_data');
        $cart_email_attempt = $this->session->userdata('cart_email_attempt');

        if ($this->input->post('button_checkings') == 'continue')
            redirect('products');
        else if ($this->input->post('button_checkings') == 'back')
            redirect('products/product_list');
        else {

            $edit_cart_mode = array(
                'edit_cart_mode' => 1
            );
            $this->session->set_userdata($edit_cart_mode);




            $last_inserted_cart_block_id = $this->session->userdata('last_inserted_cart_block_id');
            if (!$last_inserted_cart_block_id) {
                $where_param = array();
                $where_param['email'] = $cart_users_data['email'];
                $select_param = array('id' => 'id');
                $recent_id = $this->block_list_email->get_row("cart_block_users", $select_param, $where_param);
                if ($recent_id[0]->id != "") {
                    $last_inserted_cart_block_id = $recent_id[0]->id;
                } else {
                    $last_inserted_cart_block_id = $this->block_list_email->insert_column("cart_block_users", $cart_users_data);
                }
            }
            $update_data = array(
                'cartmode' => 1
            );

            $this->db->where('id', $last_inserted_cart_block_id);
            $this->db->update('cart_block_users', $update_data);

            $where_param = array();
            $where_param['id!='] = $last_inserted_cart_block_id;
            //$where_param['']
            //edited by 4axiz to execute the operation of block_email_list table

            $block_data = array();
            $block_data['int_errors'] = 0;
            $block_data['int_sents'] = 0;
            $block_data['dte_block'] = NULL;
            $block_data['int_block'] = 0;
//            $block_data['str_code'] = $dynamic_code;
            $block_data['str_email'] = $this->input->post('email');
            $block_data['str_applicant'] = $this->input->post('surname');
            $block_data['str_country'] = $this->input->post('country');
            $block_data['str_ip_address'] = $_SERVER['REMOTE_ADDR'];
            $block_data['str_telephone'] = $this->input->post('telephone');
            $block_data['region'] = "Cart";
            $this->block_list_email->insert_column("block_email_list", $block_data);

            //region end

            redirect('cart/cart_confirm');
        }
    }

    function remove_all_items_from_cart($check = 0, $user_data_delete = 0) {
        $this->load->model("block_list_email");
        $this->check_lang();

        $cart_users_data = $this->session->userdata('cart_users_data');

        $last_inserted_cart_block_id = $this->session->userdata('last_inserted_cart_block_id');
        $condtion = array("id" => $last_inserted_cart_block_id);
        $block_data = $this->comman_model->all_data_by_id('cart_block_users', $condtion);
        //var_dump($block_data);

        $last_inserted_cart_block_id = $this->session->userdata('last_inserted_cart_block_id');
        $update_data = array(
            'status' => 1,
            'created_time' => time()
        );

        $this->db->where('id', $last_inserted_cart_block_id);
        $this->db->update('cart_block_users', $update_data);
        //edited by 4axiz to execute operation on block_email_list table : to block user when user inputs wrong validaion code for more than 3 times

        if ($check == 0) {
            $where_param = array();
            $where_param['str_email'] = $cart_users_data['email'];

            $select_param = array('dte_block' => 'dte_block', 'region' => 'region');
            $block_info = $this->block_list_email->get_row("block_email_list", $select_param, $where_param);
            if (!empty($block_info)) {
                $block_data = array();
                $block_data['int_block'] = 5;
                $block_data['dte_block'] = date("Y-m-d H:i:s", time());
                $this->block_list_email->update_column("block_email_list", $where_param, $block_data);
            } else {
                $block_data = array();
                $block_data['int_errors'] = 0;
                $block_data['int_sents'] = 0;
                $block_data['dte_block'] = date("Y-m-d H:i:s", time());
                $block_data['int_block'] = 5;
//            $block_data['str_code'] = $dynamic_code;
                $block_data['str_email'] = $cart_users_data['email'];
                $block_data['str_applicant'] = $cart_users_data['user_name'];
                $block_data['str_country'] = $cart_users_data['country'];
                $block_data['str_ip_address'] = $_SERVER['REMOTE_ADDR'];
                $block_data['str_telephone'] = $cart_users_data['telephone'];
                $block_data['region'] = "Cart";
                $this->block_list_email->insert_column("block_email_list", $block_data);
            }
        }


        //end region
        if ($user_data_delete) {
            $session_data = array(
                'cart_users_data' => '',
                /* 'cart'  => '', */
//            'last_inserted_cart_block_id' => $last_inserted_cart_block_id,
                'last_inserted_cart_block_id' => "",
                'edit_cart_mode' => 'false'
            );
        } else {
            $session_data = array(
                'last_inserted_cart_block_id' => $last_inserted_cart_block_id,
                'edit_cart_mode' => 'false'
            );
        }


        $this->session->set_userdata($session_data);
        echo isset($cart_users_data['email']) ? $cart_users_data['email'] : $block_data[0]['email'];
        //  var_dump( $this->session->userdata);exit;
    }

    function check_cart_user_block() {
        $this->check_lang();

        $data['cart_users_data'] = $this->session->userdata('cart_users_data');

        $email = $data['cart_users_data']['email'];
        $block_data = $this->serial_model->getUserBlockByStatus('cart_block_users', $email);
        //var_dump($block_data[0]->created_time);
        if (!empty($block_data)) {
            $edit_cart_mode = isset($block_data[0]->cartmode) ? $block_data[0]->cartmode : 0;

            if (isset($block_data[0]->created_time) && $block_data[0]->created_time > 0) {
                $block_user_time = $block_data[0]->created_time;
            } else {
                $block_user_time = time();
            }
        } else {
            $block_user_time = time();
            $edit_cart_mode = 0;
        }
        /* 	if(!empty($block_data))
          $block_user_time = $block_data[0]->created_time;
          else
          $block_user_time =time(); */




        $now = time();
        $check_time_block = $now - $block_user_time;
        $block_flag = 0;
        $data['cart_users_data']['created_time'] = time();


        if (!empty($block_data)) {

            //if($check_time_block >= 7200 && $wrong_attempt_email== $email)
            $blocklimit = 3600;
            $edit_cart_mode = isset($block_data[0]->cartmode) ? $block_data[0]->cartmode : 0;
            if ($edit_cart_mode == 1)
                $blocklimit = 600;
            $block_status = isset($block_data[0]->status) ? $block_data[0]->status : 0;
            if ($block_status == 1) {
                $block_flag = 1;
            } else {
                $block_flag = 0;
            }
        } else {
            $block_flag = 0;
        }
        echo $block_flag . '##*##' . $check_time_block;
    }

    function savecartblockdetails() {
        $this->check_lang();
        $edit_cart_mode = "";
        $email = $this->input->post('user_email');
        $block_data = $this->serial_model->getUserBlockByStatus('cart_block_users', $email);
        $edit_cart_mode = 0; //$this->session->userdata('edit_cart_mode');

        if (!empty($block_data)) {
            $edit_cart_mode = isset($block_data[0]->cartmode) ? $block_data[0]->cartmode : 0;

            if (isset($block_data[0]->created_time) && $block_data[0]->created_time > 0) {
                $block_user_time = $block_data[0]->created_time;
            } else {
                $block_user_time = time();
            }
        } else {
            $block_user_time = time();
            $edit_cart_mode = 0;
        }


        $now = time();
        //echo $block_user_time.'--';
        $check_time_block = intval($now) - intval($block_user_time);
        //echo $check_time_block ;
        $block_flag = 0;
        $cart_users_data = array(
            'email' => $this->input->post('user_email'),
            'created_time' => time(),
            'cartmode' => $edit_cart_mode
        );

        //edited by to excute the operation for the block_email_list table
        $this->load->model("block_list_email");
        $where_param = array();
        $where_param['str_email'] = $this->input->post('user_email');
        $select_param = array('dte_block' => 'dte_block', 'region' => 'region');
        $block_info = $this->block_list_email->get_row("block_email_list", $select_param, $where_param);
        $date = date("Y-m-d H:i:s", time());
        $datelimit = strtotime('-120 minute', strtotime($date));
        $datelimit = date("Y-m-d H:i:s", $datelimit);
        if (!empty($block_info) && $block_info[0]->dte_block != NULL && $datelimit < $block_info[0]->dte_block) {

            $int_block = strtotime($block_info[0]->dte_block);
            $int_TR = 120 - intval(((time() - $int_block) / 60));
            if ($int_TR < 0)
                $int_TR = 0;

            echo $int_TR . '##*##' . 2 . '##*##' . $block_info[0]->region . "##*##" . $this->input->post('user_email');
        } else {
            //region end

            $where_param = array();
            $where_param['str_email'] = $this->input->post('user_email');
            $this->block_list_email->delete_row("block_email_list", $where_param);

            if (!empty($block_data)) {

                //if($check_time_block >= 7200 && $wrong_attempt_email== $email)	
                $blocklimit = 3600;

                if ($edit_cart_mode == 1)
                    $blocklimit = 600;

                $block_status = isset($block_data[0]->status) ? $block_data[0]->status : 0;
                if ($block_status == 1) {
                    $block_flag = 1;
                } else {
                    $block_flag = 0;
                }
            } else if (!empty($block_info)) {
                $block_flag = 1;
            } else {

                $block_flag = 0;
                $this->comman_model->add('cart_block_users', $cart_users_data);
                $last_insert_id = $this->db->insert_id();
                $session_data = array(
                    'last_inserted_cart_block_id' => $last_insert_id,
                    'cart_users_data' => $cart_users_data
                );
                $this->session->set_userdata($session_data);
            }

            $check_time_block = $check_time_block / 60;

            //$check_time_block = (($edit_cart_mode==1)?1:2) - $check_time_block;
            $check_time_block = (($edit_cart_mode == 1) ? 10 : 60) - $check_time_block;
            $check_time_block = ($check_time_block < 0) ? 0 : $check_time_block; // added by rinosh to block -values 
            //this is done by dhrubo because in the previous coder adds an email as block in database, when simply input the email in form
            //now this will not cause any problem to show email block, as in this cases email should not be blocked 
            $check_time_block = 20;
            $block_flag = 0;
            //
            echo round($check_time_block) . '##*##' . $block_flag;
        }
    }

    function cart_confirm() {
        $this->check_lang();
        $edit_cart_mode = array(
            'edit_cart_mode' => 1
        );
        $this->session->set_userdata($edit_cart_mode);

        $this->load->model("block_list_email");
        $select_param = array("*");
        $where_param = array();
        $where_param['id'] = 1;
        $data["cart_timer"] = $this->block_list_email->get_row("cart_timer", $select_param, $where_param);

        $data['cart_users_data'] = $this->session->userdata('cart_users_data');

        $new_cart = $this->session->userdata('new_cart');
        $data['cartcount'] = getcartcount($new_cart);
        $cart = $new_cart;

        $email = $data['cart_users_data']['email'];
        $block_data = $this->serial_model->getUserBlockByStatus('cart_block_users', $email, '1');
        //var_dump($block_data[0]->created_time);
        if (!empty($block_data))
            $block_user_time = $block_data[0]->created_time;
        else
            $block_user_time = time();


        $now = time();
        $check_time_block = $now - $block_user_time;
        $block_flag = 0;
        $data['cart_users_data']['created_time'] = time();


        if (!empty($block_data)) {
            //if($check_time_block >= 7200 && $wrong_attempt_email== $email)
            if ($check_time_block <= 3600 || $check_time_block >= 7200) {
                //
                $block_flag = 0;
                $last_inserted_cart_block_id = $this->session->userdata('last_inserted_cart_block_id');

                $this->comman_model->update_by_id('cart_block_users', $data['cart_users_data'], $last_inserted_cart_block_id);
            } else if ($check_time_block >= 7200) {
                $block_flag = 0;
                $last_inserted_cart_block_id = $this->session->userdata('last_inserted_cart_block_id');
                $this->comman_model->update_by_id('cart_block_users', $data['cart_users_data'], $last_inserted_cart_block_id);
            } else {
                $block_flag = 1;
            }
        } else {
            $block_flag = 0;
            $last_inserted_cart_block_id = $this->session->userdata('last_inserted_cart_block_id');
            $this->comman_model->update_by_id('cart_block_users', $data['cart_users_data'], $last_inserted_cart_block_id);
        }

        $check_time_block = $check_time_block / 60;
        $check_time_block = 120 - $check_time_block;

        $data['block_time'] = round($check_time_block);
        $data['block_flag'] = $block_flag;
        $cart = $this->session->userdata('new_cart');
        $cart = cartCleanUp($cart);
        $this->session->set_userdata('new_cart', $cart);

        $cart_details = $this->product_model->get_cart_items($cart);
        usort($cart_details, "productypesort");

        $data['cart_details'] = $cart_details;
        $data['cart_data'] = $cart;
        $data['title'] = 'Kondar Global';
        $data['menus'] = $this->menu_model->get_all_menus();

        //to get selection instruction
        
        $where_param = array();
        $where_param['id'] = 1;
        $select_param = array("maincart_block_msg","editcart_block_msg","cartpreview_block_msg","cartverification_block_msg","block_notification_msg","cartverification_resent_block_msg","cartverification_wrong_block_msg");
        $data['selection_instruction'] = $this->block_list_email->get_row("selection_instruction",$select_param,$where_param);
        
        
        //to get selection instruction  end
        
        $this->load->view('temp/include/header_confirm', $data);
        $this->load->view('cart/verify_submit', $data);
    }

    function edittocart() {
        $this->check_lang();
        $last_inserted_cart_block_id = $this->session->userdata('last_inserted_cart_block_id');
        $update_data = array(
            'cartmode' => 1,
            'created_time' => time()
        );

        $this->db->where('id', $last_inserted_cart_block_id);
        $this->db->update('cart_block_users', $update_data);
        redirect('cart/cart');
    }

    function continueshopping_in_cart() {
        $last_inserted_cart_block_id = $this->session->userdata('last_inserted_cart_block_id');
        $this->db->delete('cart_block_users', array('id' => $last_inserted_cart_block_id));
        redirect('products');
    }

    function save_cart_details() {
        $this->load->model("block_list_email");
        $this->check_lang();
        $cart_email_attempt = $this->session->userdata('cart_email_attempt');
        $last_inserted_cart_block_id = $this->session->userdata('last_inserted_cart_block_id');
        if ($cart_email_attempt == '')
            $cart_email_attempt = 1;

        $cart_details = $this->session->userdata('cart_randomString');
        $cart_verification_code = trim($this->input->post('ecart_verification_codemail'));

        if ($cart_verification_code == $cart_details && $cart_email_attempt <= 3) {

            $last_inserted_cart_block_id = $this->session->userdata('last_inserted_cart_block_id');
            $this->db->delete('cart_block_users', array('id' => $last_inserted_cart_block_id));



            $cart_users_data = $this->session->userdata('cart_users_data');
            $this->db->insert('cart_users', $cart_users_data);
            $user_id = $this->db->insert_id();

            $new_cart = $this->session->userdata('new_cart');
            $cart_details = $new_cart;



            $this->db->delete("cart_block_users", array("email" => $cart_users_data['email']));
            //edited by 4axiz to execute operation on block_email_list table : to remove from that table if user inputs right code

            $where_param = array();
            $where_param['str_email'] = $cart_users_data['email'];
            $this->block_list_email->delete_row("block_email_list", $where_param);

            //region end


            foreach ($cart_details as $cart) {
                $cart1['user_id'] = $user_id;
                $cart1['quantity'] = empty($cart['quantity'])?0:$cart['quantity'];
                $cart1['comment'] = $cart['comment'];
                $cart1['product_id'] = $cart['item_id'];
                $this->db->insert('cart', $cart1);
            }

            $homepage_data = $this->comman_model->search_serial_data('home_page');
            //$this->cart_mail($cart_users_data['email'],$cart_users_data,$cart_details,$homepage_data[0]['admin_mail'],$name="");
//            $this->cart_mail($cart_users_data['email'], $cart_users_data, $cart_details, 'sales@kondarglobal.ca', $name = "");
            $this->cart_mail($cart_users_data['email'], $cart_users_data, $cart_details, 'sales@kondar.ca', $name = "");
            $homepage_data = $this->comman_model->search_serial_data('home_page');

            //$this->cart_mail($homepage_data[0]['admin_mail'],$cart_users_data,$cart_details,$cart_users_data['email'],"admin");
            $this->cart_mail('sales@kondar.ca', $cart_users_data, $cart_details, $cart_users_data['email'], "admin");
            // $this->cart_mail('swathy.avanix@gmail.com',$cart_users_data,$cart_details,$cart_users_data['email'],"admin");

            $session_data = array(
                'cart_users_data' => '',
                'cart' => '',
                'last_inserted_cart_block_id' => false,
                'edit_cart_mode' => 'false'
            );

            $this->session->set_userdata($session_data);
            $this->remove_all_items_from_cart(1);
            echo 'success##*##' . $cart_email_attempt;
        } else {
            $cart_email_attempt = $this->session->userdata('cart_email_attempt');
            if ($cart_email_attempt > 2) {
                //$cart_email_attempt = 1;
                $cart_email_attempt++;
                $last_inserted_cart_block_id = $this->session->userdata('last_inserted_cart_block_id');
                $update_data = array(
                    'status' => 1,
                    'created_time' => time()
                );

                $this->db->where('id', $last_inserted_cart_block_id);
                $this->db->update('cart_block_users', $update_data);

                //edited by 4axiz to execute operation on block_email_list table : to block user when user inputs wrong validaion code for more than 3 times

                $where_param = array();
                $session_user = $this->session->userdata("cart_users_data");
                $where_param['str_email'] = $session_user['email'];

                $block_data = array();
                $block_data['int_block'] = 2;
                $block_data['dte_block'] = date("Y-m-d H:i:s", time());
                $this->block_list_email->update_column("block_email_list", $where_param, $block_data);

                //region end
                //$this->db->update('cart_block_users', array('status' => '1'), array('id' => $last_inserted_cart_block_id)); 
            } else {

                $cart_email_attempt++;

                //edited by 4axiz to execute operation on block_email_list table : user inputs wrong validation data.


                $where_param = array();
                $session_user = $this->session->userdata("cart_users_data");
                $where_param['str_email'] = $session_user['email'];
                $select_param = array('int_errors' => 'int_errors');
                $block_info = $this->block_list_email->get_row("block_email_list", $select_param, $where_param);
                $block_data = array();
                $block_data['int_errors'] = $block_info[0]->int_errors + 1;
                $this->block_list_email->update_column("block_email_list", $where_param, $block_data);

                //region end
            }



            $condtion = array("id" => $last_inserted_cart_block_id);
            $block_data = $this->comman_model->all_data_by_id('cart_block_users', $condtion);
            $block_email = isset($block_data[0]['email']) ? $block_data[0]['email'] : '';
            echo 'fail##*##' . $cart_email_attempt . '##*##' . $block_email;
            if ($cart_email_attempt >= 5)
                $cart_email_attempt = 1;
        }

        $session_data = array(
            'cart_email_attempt' => $cart_email_attempt
        );
        $this->session->set_userdata($session_data);
    }

    function cart_mail($email, $cart_users_data, $cart_details, $fromemailid, $name = "") {
        $this->check_lang();
        $flag = $this->session->userdata('flag');
        $config = $this->config->item('emailconfig');
        if (!empty($config))
            $this->load->library('email', $config);
        else
            $this->load->library('email');
        $this->email->set_newline("\r\n");
        $products_details = $this->comman_model->all_data('tbl_products');

        $orderdetails = '<table width="100%" border="1px">
							<tr><td style="color:red">No</td><td style="color:red">KGT Number</td><td style="color:red">Quantity</td><td style="color:red">Comment</td></tr>';
        $i = 1;
        foreach ($cart_details as $cart) {

            foreach ($products_details as $product) {

                if ($product['id'] == $cart['item_id']) {
                    $orderdetails.='<tr><td>' . $i . '</td>';
                    $orderdetails.='<td>' . $product['kgt_ref_number'] . '</td>';
                    $orderdetails.='<td>' . $cart['quantity'] . '</td>';
                    $orderdetails.='<td>' . $cart['comment'] . '</td></tr>';
                    $i++;
                }
            }
        }

        $orderdetails.='</table>';
        $homepage_data = $this->comman_model->search_serial_data('home_page');

        //$this->email->from($homepage_data[0]['admin_mail'], 'KGT');
//        $this->email->from('sales@kondarglobal.ca', 'KGT');
//        $this->email->to($email);
        if ($name != "") {
            //	$name_details = "Sales Department";
            $fromname = $cart_users_data['user_name'];
            $toname = 'KGT Sales Department';
            $name_details = "Sales Manager";
            $content = 'The following is our request for quotation. Please review and send us your offer before the mentioned deadline.';
            $signature = $cart_users_data['user_name'];
            $logo = '';
            $subject = 'KGT Request for quotation No.' . $cart_users_data['rfq'];
        } else {
            $fromname = 'KGT Sales Department';
            $toname = $cart_users_data['user_name'];
            $content = 'We appreciate your interest in dealing with KGT. We will review your request for quotation and then act accordingly.';
            $name_details = $cart_users_data['user_name'];
            $signature = 'KGT Sales Department';
            $logo = '<img src="{base_url}/assets/template/images/logo.png" style="border-width:0px; float: left; max-width: 108px; padding: 4px 0px 1px 9px;">';
            $subject = 'KGT Request for quotation No.' . $cart_users_data['rfq'] . ' receipt acknowledgment ';
        }
        //$this->email->cc('another@another-example.com'); 
        //$this->email->bcc('them@their-example.com'); 
        $products_details = $this->comman_model->all_data('tbl_products');

//        $this->email->subject('KGT');

        $msg = file_get_contents('cart_mail.html');
        $msg = str_replace('{logo}', $logo, $msg);
        $msg = str_replace('{base_url}', base_url(), $msg);
        $msg = str_replace('{name_details}', $name_details, $msg);
        $msg = str_replace('{content}', $content, $msg);
        $msg = str_replace('{rfq}', $cart_users_data['rfq'], $msg);
        $msg = str_replace('{user_name}', $cart_users_data['user_name'], $msg);
        $msg = str_replace('{designation}', $cart_users_data['designation'], $msg);
        $msg = str_replace('{address}', $cart_users_data['address'], $msg);
        $msg = str_replace('{company}', $cart_users_data['company'], $msg);
        $msg = str_replace('{telephone}', $cart_users_data['telephone'], $msg);
        $msg = str_replace('{email}', $cart_users_data['email'], $msg);
        $msg = str_replace('{country}', $cart_users_data['country'], $msg);
        $msg = str_replace('{flag}', $flag, $msg);
        $msg = str_replace('{deadline}', $cart_users_data['deadline'], $msg);
        $msg = str_replace('{incoterms}', $cart_users_data['incoterms'], $msg);
        $msg = str_replace('{order_details}', $orderdetails, $msg);
        $msg = str_replace('{signature}', $signature, $msg);

        $this->email->from($fromemailid, $fromname);
        $this->email->to($email);
        $this->email->set_header("To", $toname . '<' . $email . '>');
        $this->email->subject($subject);
        $this->email->message($msg);
        $result = $this->email->send();


        $session_data = array(
            'randomString' => "",
            'user_email' => ""
        );

        $this->session->set_userdata($session_data);
    }

    function cart_verification_code($attempt = '') {
        $this->load->model("block_list_email");
        $this->check_lang();
        $length = 10;
        $cart_randomString = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);


        $session_data = array(
            'cart_randomString' => $cart_randomString
        );
        $this->session->set_userdata($session_data);

        $email = $this->input->post('email');
        $name = $this->input->post('user_name');


        $config = $this->config->item('emailconfig');
        $email_attempt = $this->input->post('email_attempt');

        if ($email_attempt > 3) {
            $last_inserted_cart_block_id = $this->session->userdata('last_inserted_cart_block_id');
            $update_data = array(
                'status' => 1,
                'created_time' => time()
            );

            $this->db->where('id', $last_inserted_cart_block_id);
            $this->db->update('cart_block_users', $update_data);

            //edited by to excute the operation for the block_email_list table

            $where_param = array();
            $where_param['str_email'] = $email;
            $block_data = array();
            $block_data['int_block'] = 3;
            $block_data['dte_block'] = date("Y-m-d H:i:s", time());
            $this->block_list_email->update_column("block_email_list", $where_param, $block_data);

            //region end
        } else {

            //edited by to excute the operation for the block_email_list table

            $where_param = array();
            $where_param['str_email'] = $email;
            $select_param = array('int_sents' => 'int_sents');
            $block_info = $this->block_list_email->get_row("block_email_list", $select_param, $where_param);
            $block_data = array();
            $block_data['int_sents'] = $block_info[0]->int_sents + 1;
            $block_data['str_code'] = $cart_randomString;
            $this->block_list_email->update_column("block_email_list", $where_param, $block_data);

            //region end

            $this->load->library('email');
            $config = array(
                'mailtype' => 'html',
                'charset' => 'utf-8',
                'priority' => '1'
            );
            $this->email->initialize($config);


            $homepage_data = $this->comman_model->search_serial_data('home_page');
            $cart_email_attempt = $this->session->userdata('cart_email_attempt');
            //$this->email->from($homepage_data[0]['admin_mail'], 'KGT');
            //$this->email->to($email); 

            $msg = file_get_contents('cart_verification_code.html');
            $msg = str_replace('{base_url}', base_url(), $msg);
            $msg = str_replace('{name}', $name, $msg);
            $msg = str_replace('{cart_randomString}', $cart_randomString, $msg);
            $msg = str_replace('{verification_code_attempt}', $attempt + 1, $msg);

            $this->load->helper('av_helper');
            $kgtmailer = new KGTMailer();

            if ($attempt == "")
                $subject = 'Cart Verification Code';
            else
                $subject = 'Cart Verification Code Resend Attempt ' . ($attempt);

            $to = $email;
            $cc = '';
            $bcc = '';
            $fromname = 'KGT Sales Department';
            $from = 'sales@kondar.ca';
//            $from = 'shaheen@4axiz.com';
            $message = $msg;

            //$mailerstatus=$kgtmailer->sendmail($subject,$message,$to,$from,$fromname,$cc,$bcc);

            $this->email->set_newline("\r\n");
            $this->email->from($from, $fromname);
            $this->email->to($to);
            $this->email->set_header("To", $name . '<' . $to . '>');
            $this->email->subject($subject);
            $this->email->message($message);
            $this->email->send();
        }
        echo isset($email) ? $email : '';
    }

    function updatedcart() {
        $this->check_lang();
        $product_ids = $this->input->post('product_id');
        $quantity = $this->input->post('quantity');
        $comments = $this->input->post('comment');
        $update = $this->input->post('update');
        $cart = $this->session->userdata('cart');

        $cart = cartCleanUp($cart);
        foreach ($cart as $key => $value)
        {
                $cart[$key]['comment'] = $comments[$key];
                $cart[$key]['quantity'] = $quantity[$key];
        }


        $this->session->set_userdata('cart', $cart);
        $this->session->set_userdata('new_cart', $cart);
    }

    function addtocart() {

        $this->load->model("block_list_email");

        //to get selection instruction

        $where_param = array();
        $where_param['id'] = 1;
        $select_param = "*";
        $selection_instruction = $this->block_list_email->get_row("selection_instruction", $select_param, $where_param);


        //to get selection instruction  end  

        $this->check_lang();
        $product_ids = $this->input->post('product_id');
        $quantity = 1;
        $update = $this->input->post('update');
        $productcount = 0;
        $cart = $this->session->userdata('cart');

        $cart_products = array();
        if (is_array($product_ids)) {

            foreach ($product_ids as $product_id) {
                if ($update == 1) {
                    $cartitems['quantity'] = $quantity;
                } else {
                    if ((isset($cart[$product_id])) && ($cart[$product_id] != "")) {
                        $cartitems['quantity'] = $quantity + $cart[$product_id]['quantity'];
                        $cartitems['comment'] = $cart[$product_id]['comment'];
                    } else {
                        $cartitems['quantity'] = $quantity;
                        $cartitems['comment'] = "";
                        $productnames = $this->product_model->get_productModelname($product_id);
                        $cart_products[] = $productnames[0]['kgt_ref_number'];
                        $productcount++;
                    }
                }
                $cartitems['item_id'] = $product_id;

                $cart[$product_id] = $cartitems;
            }
        }
        $session_data = array(
            'cart' => $cart
        );

        $this->session->set_userdata($session_data);
        $i = 1;
        $refname = '';
        foreach ($cart_products as $productname) {
            if ($refname != '') {
                if ($i == $productcount)
                    $refname.=' and ';
                else
                    $refname.=', ';
            }
            $refname.=$productname;
            $i++;
        }
        $msg = $this->session->userdata('cart_msg');
        $i = $i - 1;

        $phrase = ($productcount > 1 ? 'are' : 'is');
        $phrase1 = ($productcount > 1 ? 'items' : 'item');
        $phrase2 = ($productcount > 1 ? 'these' : 'this');
        $phrase3 = ($productcount > 1 ? 'them' : 'it');

//        if ($i) {
//            $msg .= $i . " New Product(s) added in Cart.<br>";
//        }
//        if ($msg == '') {
//            $msg = $msg . 'The ' . $phrase1 . ' <b>' . $refname . '</b> ' . $phrase . ' successfully added into the cart.';
//        } else if ($refname != '') {
//            $msg = $msg . 'In addition, The ' . $phrase1 . ' <b>' . $refname . '</b> ' . $phrase . ' successfully added into the cart. ';
//        } else {
//            $msg = $msg;
//        }
        if ($i) {
            $new_msg = $selection_instruction[0]->addtocart_msg;
            $new_msg = preg_replace('/\bITEMNUMBER\b/', $i, $new_msg);
            $new_msg = preg_replace('/\bPHRASE\b/', $phrase, $new_msg);
            $new_msg = preg_replace('/\bPHRASEITEM\b/', $phrase1, $new_msg);
            $new_msg = preg_replace('/\bPHRASETHIS\b/', $phrase2, $new_msg);
            $new_msg = preg_replace("/\bPHRASEIT\b/", $phrase3, $new_msg);
            $new_msg = preg_replace("/\bREFNAME\b/", $refname, $new_msg);
        }

        echo $msg . $new_msg;
    }

    function removecart()
    {
        $this->check_lang();
        $product_id = $this->input->post('id');
        $cart       = $this->session->userdata('cart');

        unset($cart[$product_id]);
        $this->session->unset_userdata('cart');

        $this->session->set_userdata('cart', $cart);
        $this->session->set_userdata('new_cart', $cart);
    }

    function set_lang() {
        $name = $this->input->post('lang');
        $lang = array('lang' => $name);
        $this->session->set_userdata($lang);
        echo 'success';
    }

    function check_lang() {
        $lang = $this->session->all_userdata();
        if (isset($lang['lang'])) {
            if ($lang['lang'] == 'english') {
                $this->lang->load("common", "english");
                $this->lang->load("admin", "english");
            } else if ($lang['lang'] == 'russian') {
                $this->lang->load("common", "russian");
                $this->lang->load("admin", "russian");
            }
        } else {
            $this->lang->load("common", "english");
            $this->lang->load("admin", "english");
        }
    }

    function cart_blockedemail_check($email = '') {
        $email = $_POST['email'];
        $email_check = $this->db->get_where('cart_block_users', array('email' => $email, 'status' => '1'))->result_array();

        $block_user_time = $email_check[0]['created_time'];

        $now = time();
        $check_time_block = $now - $block_user_time;
        $this->session->set_userdata('flag', $this->input->post('country_flag'));
        //edited by 4axiz to perform action of block_email_list table

        $this->load->model("block_list_email");

        $where_param = array();
        $where_param['str_email'] = $email;
        $select_param = array("dte_block", "str_email", "region");
        $block_emails = $this->block_list_email->get_row("block_email_list", $select_param, $where_param);
        foreach ($block_emails as $each_email) {
            $date = date("Y-m-d H:i:s", time());
            $datelimit = strtotime('-120 minute', strtotime($date));
            $datelimit = date("Y-m-d H:i:s", $datelimit);
            if ($datelimit > $each_email->dte_block) {   //block time expired
                $where_param = array();
                $where_param['str_email'] = $each_email->str_email;
                $this->block_list_email->delete_row("block_email_list", $where_param);
            } else {
                $int_block = strtotime($each_email->dte_block);
                $check_time_block = 120 - intval(((time() - $int_block) / 60));
                $region = $each_email->region;
            }
        }

        //end region
//        if (!empty($email_check) || isset($region)) {
        if (isset($region)) {
            echo $check_time_block . "##*##1##*##" . $region;
        } else {
            echo $check_time_block . "##*##0";
        }
    }

    function get_cart_pop_time() {
        $this->load->model("block_list_email");
        $select_param = array("*");
        $where_param = array();
        $where_param['id'] = 1;
        $cart_timer = $this->block_list_email->get_row("cart_timer", $select_param, $where_param);
        $cart_pop_info["cart_popup_timer"] = $cart_timer[0]->cart_popup_timer * 60;
        $cart_pop_info["cart_popup_msg"] = $cart_timer[0]->cart_popup_msg;
        $cart_pop_info['cart_preview_timer'] = $cart_timer[0]->cart_preview_timer * 60;
        echo json_encode($cart_pop_info);
    }

    // this function will evoke when an user finishes his time in another windown and then come in the cart. 
    //then a timer popup will apprear and then he will redirect in this function
    function make_user_block() {
        $this->load->model("block_list_email");
        $session_data = $this->session->userdata('cart_users_data');
        $email = $session_data['email'];
        $where_param = array();
        $where_param['email'] = $email;
        $this->block_list_email->delete_row("cart_block_users", $where_param);
        $where_param = array();
        $where_param['str_email'] = $email;
        $this->block_list_email->delete_row("block_email_list", $where_param);

        $insert_data = array();
        $insert_data['int_errors'] = 0;
        $insert_data['int_sents'] = 0;
        $insert_data['int_block'] = 5;
        $insert_data['dte_block'] = date("Y-m-d H:i:s", time());
        $insert_data['str_code'] = "";
        $insert_data['str_email'] = $session_data["email"];
        $insert_data['str_applicant'] = $session_data["user_name"];
        $insert_data['str_country'] = $session_data["country"];
        $insert_data['str_ip_address'] = $_SERVER['REMOTE_ADDR'];
        $insert_data['str_telephone'] = $session_data["telephone"];
        $insert_data['region'] = "Cart";
        $this->block_list_email->insert_column("block_email_list", $insert_data);
        $session_data_to_remove = array(
            'cart_users_data' => '',
            /* 'cart'  => '', */
//            'last_inserted_cart_block_id' => $last_inserted_cart_block_id,
            'last_inserted_cart_block_id' => "",
            'edit_cart_mode' => 'false'
        );
        $this->session->set_userdata($session_data_to_remove);
        redirect("cart/index");
    }
    
    function clear_user_session(){
        $this->session->unset_userdata('last_inserted_cart_block_id');
        $this->session->unset_userdata('cart_users_data');
        redirect("cart/index");
        
    }

}