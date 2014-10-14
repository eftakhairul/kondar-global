<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');
class Products extends CI_Controller
{

    public function __construct()
    {

        parent::__construct();

        $this->load->database();

        $this->load->helper('url');



        $this->load->model(array('user_model', 'search_model', 'serial_model', 'product_model', 'menu_model'));

        $this->load->model('country_model');

        $this->load->library('form_validation');

        $this->load->model('comman_model');

        $this->load->library("pagination");

        $this->load->helper('date');

        $this->load->helper('av_helper');

        $this->load->helper('cart_helper');

        $this->load->helper('language');

        $this->load->language('header');

        $this->load->language('product');
        $this->load->helper('assets');
        $this->load->language('footer');


        $pagination_data = $this->comman_model->get_data_by_id('settings', array('id' => 1));
        
        if(!empty($pagination_data['pagination_limit']) and ($pagination_data['pagination_limit'] != 0))
        $this->config->set_item('pagination_limit',$pagination_data['pagination_limit']);
        if(!empty($pagination_data['pagination_limit_product_list']) and ($pagination_data['pagination_limit_product_list'] != 0))
        $this->config->set_item('pagination_limit_product_list',$pagination_data['pagination_limit_product_list']);
        if(!empty($pagination_data['pagination_limit_product_list_frist_page']) and ($pagination_data['pagination_limit_product_list_frist_page'] != 0))
        $this->config->set_item('pagination_limit_product_list_frist_page',$pagination_data['pagination_limit_product_list_frist_page']);

//        if (!empty($pagination_data['pagination_limit']) and ($pagination_data['pagination_limit'] != 0))
//            $this->config->set_item('pagination_limit', $pagination_data['pagination_limit']);
//        if (!empty($pagination_data['pagination_limit_product_list']) and ($pagination_data['pagination_limit_product_list'] != 0))
//            $this->config->set_item('pagination_limit_product_list', $pagination_data['pagination_limit_product_list']);
//        if (!empty($pagination_data['pagination_limit_product_list_frist_page']) and ($pagination_data['pagination_limit_product_list_frist_page'] != 0))
//            $this->config->set_item('pagination_limit_product_list_frist_page', $pagination_data['pagination_limit_product_list_frist_page']);
    }

    function validateLogin() {

        $logged_in = $this->session->userdata('logged_in');

        if ((isset($logged_in) || $logged_in == true)) {

            if ($logged_in != "admin") {

                redirect('/admin/login', 'refresh');
            }
        } else {

            redirect('/admin/login', 'refresh');
        }
    }

    function index() {
        $this->load->model("block_list_email");

        $data['productsdropdown'] = true;
        $data['country_data'] = $this->country_model->as_array()->get_many_by(array('status' => 1));

        $this->session->unset_userdata('vehicle_category_id');

        $this->session->unset_userdata('vehicle_type_id');

        $this->session->unset_userdata('vehicle_brand_id');

        $data['title'] = 'Kondar Global';



        $select_param = array("*");
        $where_param = array();
        $where_param['id'] = 1;
        $data["cart_timer"] = $this->block_list_email->get_row("cart_timer", $select_param, $where_param);



        //in cart and product section sometimes this is $last_inserted_cart_block_id getting false as the timer isn't showing. to make that more confirm i did this code.
        $last_inserted_cart_block_id = $this->session->userdata('last_inserted_cart_block_id');
        if (!$last_inserted_cart_block_id) {
            $cart_user_info = $this->session->userdata("cart_users_data");
            if (!empty($cart_user_info)) {
                $where_param = array();
                $where_param['email'] = $cart_user_info['email'];
                $select_param = array("id");
                $cart_user_id = $this->block_list_email->get_row("cart_block_users", $select_param, $where_param);
                if (!empty($cart_user_id)) {
                    $last_inserted_cart_block_id = $cart_user_id[0]->id;
                    $update_data = array();
                    if (!empty($cart_user_info['user_name'])) {
                        $update_data['user_name'] = $cart_user_info['user_name'];
                    }
                    if (!empty($cart_user_info['company'])) {
                        $update_data['company'] = $cart_user_info['company'];
                    }
                    if (!empty($cart_user_info['designation'])) {
                        $update_data['designation'] = $cart_user_info['designation'];
                    }
                    if (!empty($cart_user_info['address'])) {
                        $update_data['address'] = $cart_user_info['address'];
                    }
                    if (!empty($cart_user_info['country'])) {
                        $update_data['country'] = $cart_user_info['country'];
                    }
                    if (!empty($cart_user_info['telephone'])) {
                        $update_data['telephone'] = $cart_user_info['telephone'];
                    }
                    if (!empty($cart_user_info['email'])) {
                        $update_data['email'] = $cart_user_info['email'];
                    }
                    if (!empty($cart_user_info['deadline'])) {
                        $update_data['deadline'] = $cart_user_info['deadline'];
                    }
                    if (!empty($cart_user_info['rfq'])) {
                        $update_data['rfq'] = $cart_user_info['rfq'];
                    }
                    if (!empty($cart_user_info['incoterms'])) {
                        $update_data['incoterms'] = $cart_user_info['incoterms'];
                    }
                    $where_param = array();
                    $where_param['id'] = $last_inserted_cart_block_id;
                    $this->block_list_email->update_column("cart_block_users", $where_param, $update_data);
                } else {
                    $last_inserted_cart_block_id = $this->block_list_email->insert_column("cart_block_users",$cart_user_info);
                }
            }
        }
        //block end  - in cart and product section sometimes this is $last_inserted_cart_block_id getting false as the timer isn't showing. to make that more confirm i did this code.
        $data['last_inserted_cart_block_id'] = $last_inserted_cart_block_id;

        if ($last_inserted_cart_block_id)
            $data['current_cart_user_data'] = $this->comman_model->get_data_by_id('cart_block_users', array('id' => $last_inserted_cart_block_id));



        //$data['vehicle_categories'] = $this->comman_model->all_data('tbl_vehicle_categories');
        //echo "<pre>"; print_r($this->comman_model->get_vehicle_type_for_menu()); die;
        $data['menu_vehicle_categories'] = $this->comman_model->all_data('tbl_vehicle_categories');
        $data['vehicle_categories'] = $this->comman_model->get_vehicle_type_for_menu();
        $data['num_vehicle_type_for_menu'] = $this->comman_model->num_vehicle_type_for_menu();
        //echo "<pre>"; print_r($data);
        $data['menu_product_types'] = $this->comman_model->get_product_type_for_menu();
        $data['num_product_type_for_menu'] = $this->comman_model->num_product_type_for_menu();

        $cart = $this->session->userdata('cart');


        $cart = cartCleanUp($cart);
        $this->session->set_userdata('cart', $cart);

       $data['cartcount'] = getcartcount($cart);



        $data['vehicle_category_ids'] = $this->session->userdata('vehicle_category_id');

        if ($data['vehicle_category_ids'] == false)
            $data['vehicle_category_ids'] = array();

        $data['edit_cart_mode'] = $this->session->userdata('edit_cart_mode');
        // cart mode
        //to get selection instruction

        $where_param = array();
        $where_param['id'] = 1;
        $select_param = "*";
        $data['selection_instruction'] = $this->block_list_email->get_row("selection_instruction", $select_param, $where_param);
        //to get selection instruction  end        

        $data['edit_cart_mode'] = isset($data['current_cart_user_data']['cartmode']) ? $data['current_cart_user_data']['cartmode'] : '';

        $data['menus'] = $this->menu_model->get_all_menus();


        $this->load->view('temp/include/header', $data);

        $this->load->view('product/product', $data);

        $this->load->view('temp/footer', $data);
    }

    function product_type($vehicle_categorie_id = '') {

        $this->session->unset_userdata('vehicle_type_id');

        $this->session->unset_userdata('vehicle_brand_id');


        $data['country_data'] = $this->country_model->as_array()->get_many_by(array('status' => 1));

        $data['title'] = 'Kondar Global';

        $data['vehicle_category_ids'] = $this->session->userdata('vehicle_category_id');

        $data['vehicle_type_ids'] = $this->session->userdata('vehicle_type_id');

        $data['vehicle_type_names'] = $this->session->userdata('vehicle_type_names');

        $this->load->model("block_list_email");
        $select_param = array("*");
        $where_param = array();
        $where_param['id'] = 1;
        $data["cart_timer"] = $this->block_list_email->get_row("cart_timer", $select_param, $where_param);

        //var_dump($data['vehicle_category_ids']);

        if ($this->input->post('vehicle_type_id')) {

            $vehicle_ids = $this->input->post('vehicle_type_id');
            //print_r($vehicle_ids);
            $data['vehicle_category_ids'] = $vehicle_ids;
        }



        if ($vehicle_categorie_id != '')
            $data['vehicle_category_ids'] = array(0 => $vehicle_categorie_id);

        if ($data['vehicle_category_ids'] == false)
            $data['vehicle_category_ids'] = array();

        if ($data['vehicle_type_ids'] == false)
            $data['vehicle_type_ids'] = array();

        if ($data['vehicle_type_names'] == false)
            $data['vehicle_type_names'] = array();

        //var_dump($data['vehicle_category_ids']);

        $data['vehicle_type'] = $this->product_model->get_product_type_by_typename($data['vehicle_category_ids']);



        $data['total_num_of_vehicle_type'] = $this->product_model->count_product_type_by_typename($data['vehicle_category_ids']);

        $session_data = array(
            'vehicle_category_id' => $data['vehicle_category_ids']
        );

        $this->session->set_userdata($session_data);


        $data['session_data'] = $this->session->all_userdata();

        $data['menu_vehicle_categories'] = $this->comman_model->all_data('tbl_vehicle_categories');

        $data['menu_product_types'] = $this->comman_model->get_product_type_for_menu();

        $cart = $this->session->userdata('cart');

        $data['cartcount'] = getcartcount($cart);

        $breadcrumbs = $this->breadcrumb();

        $breadcrumb = $breadcrumbs[0];

        $data['breadcrumb'] = $breadcrumb;

        //in cart and product section sometimes this is $last_inserted_cart_block_id getting false as the timer isn't showing. to make that more confirm i did this code.
        $last_inserted_cart_block_id = $this->session->userdata('last_inserted_cart_block_id');
        if (!$last_inserted_cart_block_id) {
            $cart_user_info = $this->session->userdata("cart_users_data");
            if (!empty($cart_user_info)) {
                $where_param = array();
                $where_param['email'] = $cart_user_info['email'];
                $select_param = array("id");
                $cart_user_id = $this->block_list_email->get_row("cart_block_users", $select_param, $where_param);
                if (!empty($cart_user_id)) {
                    $last_inserted_cart_block_id = $cart_user_id[0]->id;
                    $update_data = array();
                    if (!empty($cart_user_info['user_name'])) {
                        $update_data['user_name'] = $cart_user_info['user_name'];
                    }
                    if (!empty($cart_user_info['company'])) {
                        $update_data['company'] = $cart_user_info['company'];
                    }
                    if (!empty($cart_user_info['designation'])) {
                        $update_data['designation'] = $cart_user_info['designation'];
                    }
                    if (!empty($cart_user_info['address'])) {
                        $update_data['address'] = $cart_user_info['address'];
                    }
                    if (!empty($cart_user_info['country'])) {
                        $update_data['country'] = $cart_user_info['country'];
                    }
                    if (!empty($cart_user_info['telephone'])) {
                        $update_data['telephone'] = $cart_user_info['telephone'];
                    }
                    if (!empty($cart_user_info['email'])) {
                        $update_data['email'] = $cart_user_info['email'];
                    }
                    if (!empty($cart_user_info['deadline'])) {
                        $update_data['deadline'] = $cart_user_info['deadline'];
                    }
                    if (!empty($cart_user_info['rfq'])) {
                        $update_data['rfq'] = $cart_user_info['rfq'];
                    }
                    if (!empty($cart_user_info['incoterms'])) {
                        $update_data['incoterms'] = $cart_user_info['incoterms'];
                    }
                    $where_param = array();
                    $where_param['id'] = $last_inserted_cart_block_id;
                    $this->block_list_email->update_column("cart_block_users", $where_param, $update_data);
                } else {
                    $last_inserted_cart_block_id = $this->block_list_email->insert_column("cart_block_users", $cart_user_info);
                }
            }
        }
        //block end  - in cart and product section sometimes this is $last_inserted_cart_block_id getting false as the timer isn't showing. to make that more confirm i did this code.

        $data['last_inserted_cart_block_id'] = $last_inserted_cart_block_id;

        if ($last_inserted_cart_block_id)
            $data['current_cart_user_data'] = $this->comman_model->get_data_by_id('cart_block_users', array('id' => $last_inserted_cart_block_id));

        $data['edit_cart_mode'] = $this->session->userdata('edit_cart_mode');

        // cart mode
        $data['edit_cart_mode'] = isset($data['current_cart_user_data']['cartmode']) ? $data['current_cart_user_data']['cartmode'] : '';


        //to get selection instruction

        $where_param = array();
        $where_param['id'] = 1;
        $select_param = "*";
        $data['selection_instruction'] = $this->block_list_email->get_row("selection_instruction", $select_param, $where_param);
        //to get selection instruction  end 

        $data['menus'] = $this->menu_model->get_all_menus();

        $this->load->view('temp/include/header', $data);

        $this->load->view('product/product_type', $data);

        $this->load->view('temp/footer', $data);
    }

    function product_brand($vehicle_type_id = '')
    {

        $data['country_data'] = $this->country_model->as_array()->get_many_by(array('status' => 1));

        $data['title'] = 'Kondar Global';

        $this->session->unset_userdata('product_maker_id');

        $vehicle_type_id = $this->session->userdata('vehicle_type_id');


        $this->load->model("block_list_email");
        $select_param = array("*");
        $where_param = array();
        $where_param['id'] = 1;
        $data["cart_timer"] = $this->block_list_email->get_row("cart_timer",$select_param,$where_param);
        
        $data['vehicle_category_ids'] = $this->session->userdata('vehicle_category_id');



        $data['vehicle_type_id'] = $this->session->userdata('vehicle_type_id');

        $data['product_maker_id'] = $this->session->userdata('product_maker_id');

        $data['vehicle_type_names'] = $this->session->userdata('vehicle_type_names');

        $vehicle_type_names = array();

        if ($this->input->post('vehicle_type_id')) {

            $vehicle_type_id = $this->input->post('vehicle_type_id');

            $data['vehicle_type_id'] = $vehicle_type_id;


        }


        if ($this->input->post('vehicle_type_names')) {

            $vehicle_type_names = $this->input->post('vehicle_type_names');

            $data['vehicle_type_names'] = $vehicle_type_names;


        }



        if ($this->input->post('vehicle_cat_id')) {

            $vehicle_cat_id = $this->input->post('vehicle_cat_id');

            $data['vehicle_cat_id'] = $vehicle_cat_id;

        }

        if ($data['product_maker_id'] == false)
            $data['product_maker_id'] = array();

        if ($data['vehicle_category_ids'] == false)
            $data['vehicle_category_ids'] = array();

        if ($data['vehicle_type_id'] == false)
            $data['vehicle_type_id'] = array();

        if ($data['vehicle_type_names'] == false)
            $data['vehicle_type_names'] = array();


        $methodOneMarkers = array();
        $vehicle_category_ids = array();
        if(!empty($_POST['method_one'])) {
            $this->session->set_userdata('vehicle_category_id', false);

            //product category
           foreach($vehicle_type_id as $id)
            {
                $vehicle_type = $this->comman_model->getVicleDetailsById($id);
               $vehicle_category_ids[] = $vehicle_type->vehicle_category_id;
            }

            $vehicle_category_ids          = array_unique($vehicle_category_ids);
            $vehicle_category_ids          = array_filter($vehicle_category_ids);
            $data['vehicle_category_ids']  = $vehicle_category_ids;
            $vehicle_cat_id                = $vehicle_category_ids;
            $data['vehicle_cat_id']        = $vehicle_category_ids;


            //product type
            $vehicle_type_id_array = array();

            //remove null value from $vehicle_type_id
            foreach($vehicle_type_id as $key=>$value)
            {
                if(is_null($value) || $value == '')
                    unset($vehicle_type_id[$key]);
            }

            foreach($vehicle_type_id as $id)
            {
                $vichletypeDetails = $this->comman_model->getVicleDetailsById($id);


                $vehicle_type = $this->comman_model->get_vichle_type_by_id($id);

                $vehicle_type_details = $this->comman_model->get_vehicle_type_details_by_name($vehicle_type);

                $vehicle_type_id_array_fake = array();

                foreach ($vehicle_type_details as $details)
                {
                    if (!empty($details)) {
                        $vehicle_type_id_array[] = isset($details->id) ? $details->id : '';
                        $vehicle_type_id_array_fake[] = isset($details->id) ? $details->id : '';
                    }
                }

                $fakeSessionValue = array(
                            'vehicle_type_id' => $vehicle_type_id_array_fake,
                            'vehicle_category_id' => array(0 => $vichletypeDetails->vehicle_category_id),
                            'vehicle_type_names' => array()
                        );



                $markers = $this->product_model->get_products_by_makers_brand_details_with_values($fakeSessionValue);

                $methodOneMarkers[$vichletypeDetails->category_name][$vehicle_type] = $markers;
                $vehicle_type_id = $vehicle_type_id_array;
            }

            $this->session->set_userdata('vehicle_type_id', $vehicle_type_id);
        }else {

            $post_vehicle_type_ids =  $this->session->userdata('post_product_type_id');
             //remove null value from $vehicle_type_id
                foreach($post_vehicle_type_ids as $key=>$value)
                {
                    if(is_null($value) || $value == '')
                        unset($post_vehicle_type_ids[$key]);
                }
            foreach($post_vehicle_type_ids as $id)
            {

                 $vehicle_type = ucwords(str_replace('_', ' ', $id));

                 $vehicle_type_details = $this->comman_model->get_vehicle_type_details_by_name($vehicle_type);

                $vehicle_type_id_array_fake = array();

                foreach ($vehicle_type_details as $details)
                {
                    if (!empty($details)) {
                        $vehicle_type_id_array[] = isset($details->id) ? $details->id : '';
                        $vehicle_type_id_array_fake[] = isset($details->id) ? $details->id : '';
                    }
                }



                 //remove null value from $vehicle_type_id
                $fake_vehicle_cat_ids = $vehicle_cat_id;
                foreach($fake_vehicle_cat_ids as $key=>$value)
                {
                    if(is_null($value) || $value == '')
                        unset($fake_vehicle_cat_ids[$key]);
                }

                foreach($fake_vehicle_cat_ids as $key => $vichle_id)
                {
                    $fakeSessionValue = array(
                            'vehicle_type_id' => $vehicle_type_id_array_fake,
                            'vehicle_category_id' => array(0 => $vichle_id),
                            'vehicle_type_names' => array()
                        );


                    $markers = $this->product_model->get_products_by_makers_brand_details_with_values($fakeSessionValue);
                    $vichletypeDetails = $this->comman_model->getVichleByid($vichle_id);

                    if(!empty( $markers) ) {
                        $methodOneMarkers[$vichletypeDetails->category_name][$vehicle_type] = $markers;

                    }

                }

            }

        }

        $data['products'] = $this->product_model->get_products_by_makers();

        $session_data = array(
            'vehicle_type_id' => $vehicle_type_id,
            'vehicle_category_id' => $vehicle_cat_id,
            'vehicle_type_names' => $vehicle_type_names
        );

       $this->session->set_userdata($session_data);



         $data['vehicle_makers']  = $methodOneMarkers;
         $data['vehicle_makers_cnt']      = 0;

        $data['vehicle_makers_count']    = $this->product_model->num_products_by_makers_brand_details();

        $data['session_data']            = $this->session->all_userdata();
        $data['menu_vehicle_categories'] = $this->comman_model->all_data('tbl_vehicle_categories');
        $data['menu_product_types']      = $this->comman_model->get_product_type_for_menu();

        $cart = $this->session->userdata('cart');

        $data['cartcount'] = getcartcount($cart);

        $breadcrumbs = $this->breadcrumb();

        $breadcrumb = $breadcrumbs[0] . '&nbsp;&nbsp;/' . $breadcrumbs[1];

        $data['breadcrumb'] = $breadcrumb;

        //in cart and product section sometimes this is $last_inserted_cart_block_id getting false as the timer isn't showing. to make that more confirm i did this code.
        $last_inserted_cart_block_id = $this->session->userdata('last_inserted_cart_block_id');
        if (!$last_inserted_cart_block_id) {
            $cart_user_info = $this->session->userdata("cart_users_data");
            if (!empty($cart_user_info)) {
                $where_param = array();
                $where_param['email'] = $cart_user_info['email'];
                $select_param = array("id");
                $cart_user_id = $this->block_list_email->get_row("cart_block_users", $select_param, $where_param);
                if (!empty($cart_user_id)) {
                    $last_inserted_cart_block_id = $cart_user_id[0]->id;
                    $update_data = array();
                    if(!empty($cart_user_info['user_name'])){
                        $update_data['user_name'] = $cart_user_info['user_name'];
                    }
                    if(!empty($cart_user_info['company'])){
                        $update_data['company'] = $cart_user_info['company'];
                    }
                    if(!empty($cart_user_info['designation'])){
                        $update_data['designation'] = $cart_user_info['designation'];
                    }
                    if(!empty($cart_user_info['address'])){
                        $update_data['address'] = $cart_user_info['address'];
                    }
                    if(!empty($cart_user_info['country'])){
                        $update_data['country'] = $cart_user_info['country'];
                    }
                    if(!empty($cart_user_info['telephone'])){
                        $update_data['telephone'] = $cart_user_info['telephone'];
                    }
                    if(!empty($cart_user_info['email'])){
                        $update_data['email'] = $cart_user_info['email'];
                    }
                    if(!empty($cart_user_info['deadline'])){
                        $update_data['deadline'] = $cart_user_info['deadline'];
                    }
                    if(!empty($cart_user_info['rfq'])){
                        $update_data['rfq'] = $cart_user_info['rfq'];
                    }
                    if(!empty($cart_user_info['incoterms'])){
                        $update_data['incoterms'] = $cart_user_info['incoterms'];
                    }
                    $where_param = array();
                    $where_param['id'] = $last_inserted_cart_block_id;
                    $this->block_list_email->update_column("cart_block_users",$where_param,$update_data);
                }
                else{
                    $last_inserted_cart_block_id = $this->block_list_email->insert_column("cart_block_users",$cart_user_info);
                }
            }
        }
        //block end  - in cart and product section sometimes this is $last_inserted_cart_block_id getting false as the timer isn't showing. to make that more confirm i did this code.

        $data['last_inserted_cart_block_id'] = $last_inserted_cart_block_id;

        if ($last_inserted_cart_block_id)
            $data['current_cart_user_data'] = $this->comman_model->get_data_by_id('cart_block_users', array('id' => $last_inserted_cart_block_id));

        $data['edit_cart_mode'] = $this->session->userdata('edit_cart_mode');


        //to get selection instruction
        
        $where_param = array();
        $where_param['id'] = 1;
        $select_param = "*";
        $data['selection_instruction'] = $this->block_list_email->get_row("selection_instruction",$select_param,$where_param);
        //to get selection instruction  end 
        

        // cart mode
        $data['edit_cart_mode'] = isset($data['current_cart_user_data']['cartmode']) ? $data['current_cart_user_data']['cartmode'] : '';


        $data['menus'] = $this->menu_model->get_all_menus();

        $this->load->view('temp/include/header', $data);

        $this->load->view('product/product_maker', $data);

        $this->load->view('temp/footer', $data);
    }

    //function product_list($product_maker_id='')

     function product_list($kgt_ref_number = '')
    {


        $data['country_data'] = $this->country_model->as_array()->get_many_by(array('status' => 1));
        
        $data['title'] = 'Kondar Global';

        $productselected = false;
		$offset = 0;
                
        $data['productsdropdown'] = true;
        
        $this->load->model("block_list_email");
        $select_param = array("*");
        $where_param = array();
        $where_param['id'] = 1;
        $data["cart_timer"] = $this->block_list_email->get_row("cart_timer",$select_param,$where_param);

        if ($kgt_ref_number != '') {
			
            $kgt_ref_number = urldecode($kgt_ref_number);

            $kgt_ref_number = str_replace('_', '/', $kgt_ref_number);

            $productinfo = $this->product_model->productByKGTRefNo($kgt_ref_number);
			$data['products_counts'] = sizeof($productinfo);                        

            if (is_array($productinfo)) {

                $productselected = true;

                $data['products'] = $productinfo;



                $vehicle_type_id = array($productinfo[0]->product_type_id);

                $vehicle_category_ids = array($productinfo[0]->vehicle_category_id);

                $data['vehicle_brand_id'] = array($productinfo[0]->maker_id);
            }
        }



        if ($productselected == false) {

            $vehicle_type_id = $this->session->userdata('vehicle_type_id');

            $vehicle_category_ids = $this->session->userdata('vehicle_category_id');

            $data['vehicle_brand_id'] = $this->session->userdata('vehicle_brand_id');
        }





        if ($this->input->post('vehicle_brand_id')) {

            $vehicle_brand_id = $this->input->post('vehicle_brand_id');

            $data['vehicle_brand_id'] = $vehicle_brand_id;


        }

        $data['vehicle_category_ids'] = $vehicle_category_ids;

        if ($data['vehicle_brand_id'] == false)
            $data['vehicle_brand_id'] = array();




        $session_data = array(
            'product_maker_id' => $data['vehicle_brand_id'],
            'vehicle_category_id' => $data['vehicle_category_ids'],
            'vehicle_brand_id' => $data['vehicle_brand_id'],
            'vehicle_type_id' => $vehicle_type_id,
            'product_model_id' => ''
        );




        $this->session->set_userdata($session_data);
        //echo 'Im outsude';
        //var_dump($session_data);die;

        if ($productselected == false) {

            $data['products_counts'] = sizeof($this->product_model->get_products_count_by_makers());                        
            $data['products'] = $this->product_model->get_products_by_makers($this->config->item('pagination_limit_product_list_frist_page'), $offset);    
        }

        if ($this->input->post('quick_search')) {

            $vehicle_cat_id = $this->input->post('vehicle_category_id');
            $vehicle_type_id = $this->input->post('product_type_id');
            $product_maker_id = $this->input->post('maker_id');
            $product_model_id = $this->input->post('model_id');



             $vehicle_type_ids = array();
             $id = $vehicle_type_id[0];
             if(strlen($id) < 4 ) {
                 $vehicle_type = $this->comman_model->get_vichle_type_by_id($id);
                 $vehicle_type_details = $this->comman_model->get_vehicle_type_details_by_name($vehicle_type);
                 foreach ($vehicle_type_details as $details)
                 {

                    if (!empty($details))
                        $vehicle_type_ids[] = isset($details->id) ? $details->id : '';
                 }
             } else {
                 $vehicle_type = str_replace('_', ' ', $id);
                 $vehicle_type_details = $this->comman_model->get_vehicle_type_details_by_name($vehicle_type);
                foreach ($vehicle_type_details as $details)
                {

                    if (!empty($details))
                        $vehicle_type_ids[] = isset($details->id) ? $details->id : '';
                }

             }

            $session_data = array(
                'vehicle_type_id'     => $vehicle_type_ids,
                'vehicle_category_id' => $vehicle_cat_id,
                'product_maker_id'    => $product_maker_id,
                'vehicle_brand_id'    => $product_maker_id,
                'product_model_id'    => $product_model_id
            );



            $this->session->set_userdata($session_data);
			$data['products_counts'] = sizeof($this->product_model->get_products_count_by_makers());       
			$data['products'] = $this->product_model->get_products_by_makers($this->config->item('pagination_limit_product_list_frist_page'), $offset);
        }

        $data['session_data'] = $this->session->all_userdata();

        $data['menu_vehicle_categories'] = $this->comman_model->all_data('tbl_vehicle_categories');

        $data['menu_product_types'] = $this->comman_model->get_product_type_for_menu();

        $cart = $this->session->userdata('cart');

        $data['cartcount'] = getcartcount($cart);

		
        $breadcrumbs = $this->breadcrumb();

        $breadcrumb = $breadcrumbs[0] . '&nbsp;&nbsp;/' . $breadcrumbs[1]; /* .'&nbsp;&nbsp;/'.$breadcrumbs[2] */

        $data['breadcrumb'] = $breadcrumb;
        //in cart and product section sometimes this is $last_inserted_cart_block_id getting false as the timer isn't showing. to make that more confirm i did this code.
        $last_inserted_cart_block_id = $this->session->userdata('last_inserted_cart_block_id');
        if (!$last_inserted_cart_block_id) {
            $cart_user_info = $this->session->userdata("cart_users_data");
            if (!empty($cart_user_info)) {
                $where_param = array();
                $where_param['email'] = $cart_user_info['email'];
                $select_param = array("id");
                $cart_user_id = $this->block_list_email->get_row("cart_block_users", $select_param, $where_param);
                if (!empty($cart_user_id)) {
                    $last_inserted_cart_block_id = $cart_user_id[0]->id;
                    $update_data = array();
                    if(!empty($cart_user_info['user_name'])){
                        $update_data['user_name'] = $cart_user_info['user_name'];
                    }
                    if(!empty($cart_user_info['company'])){
                        $update_data['company'] = $cart_user_info['company'];
                    }
                    if(!empty($cart_user_info['designation'])){
                        $update_data['designation'] = $cart_user_info['designation'];
                    }
                    if(!empty($cart_user_info['address'])){
                        $update_data['address'] = $cart_user_info['address'];
                    }
                    if(!empty($cart_user_info['country'])){
                        $update_data['country'] = $cart_user_info['country'];
                    }
                    if(!empty($cart_user_info['telephone'])){
                        $update_data['telephone'] = $cart_user_info['telephone'];
                    }
                    if(!empty($cart_user_info['email'])){
                        $update_data['email'] = $cart_user_info['email'];
                    }
                    if(!empty($cart_user_info['deadline'])){
                        $update_data['deadline'] = $cart_user_info['deadline'];
                    }
                    if(!empty($cart_user_info['rfq'])){
                        $update_data['rfq'] = $cart_user_info['rfq'];
                    }
                    if(!empty($cart_user_info['incoterms'])){
                        $update_data['incoterms'] = $cart_user_info['incoterms'];
                    }
                    $where_param = array();
                    $where_param['id'] = $last_inserted_cart_block_id;
                    $this->block_list_email->update_column("cart_block_users",$where_param,$update_data);
                }
                else{
                    $last_inserted_cart_block_id = $this->block_list_email->insert_column("cart_block_users",$cart_user_info);
                }
            }
        }
        //block end  - in cart and product section sometimes this is $last_inserted_cart_block_id getting false as the timer isn't showing. to make that more confirm i did this code.
        $data['last_inserted_cart_block_id'] = $last_inserted_cart_block_id;

        if ($last_inserted_cart_block_id)
            $data['current_cart_user_data'] = $this->comman_model->get_data_by_id('cart_block_users', array('id' => $last_inserted_cart_block_id));


        $data['edit_cart_mode'] = isset($data['current_cart_user_data']['cartmode']) ? $data['current_cart_user_data']['cartmode'] : '';


        //to get selection instruction
        
        $where_param = array();
        $where_param['id'] = 1;
        $select_param = "*";
        $data['selection_instruction'] = $this->block_list_email->get_row("selection_instruction",$select_param,$where_param);
        //to get selection instruction  end 
        
        $data['menus'] = $this->menu_model->get_all_menus();
        $data['offset'] = $offset;
        $this->load->view('temp/include/header', $data);

        $this->load->view('product/product_list', $data);

        $this->load->view('temp/footer', $data);
    }

    function vehicle_type($product_type = '') {


        $data['country_data'] = $this->country_model->as_array()->get_many_by(array('status' => 1));

        $data['title'] = 'Kondar Global';

        $product_type = str_replace('_', ' ', $product_type);

        $data['vehicle_categories'] = $this->comman_model->get_vehicle_categories($product_type);
        $data['total_num_of_vehicle_categories'] = $this->comman_model->count_vehicle_categories($product_type);

        $data['vehicle_type_id'] = $this->comman_model->get_vehicle_type_details_by_name($product_type);

        $data['menu_vehicle_categories'] = $this->comman_model->all_data('tbl_vehicle_categories');

        $data['menu_product_types'] = $this->comman_model->get_product_type_for_menu();

        $data['vehicle_category_ids'] = $this->session->userdata('vehicle_category_id');

        $cart = $this->session->userdata('cart');

        $data['cartcount'] = getcartcount($cart);

        $this->load->model("block_list_email");
        $select_param = array("*");
        $where_param = array();
        $where_param['id'] = 1;
        $data["cart_timer"] = $this->block_list_email->get_row("cart_timer", $select_param, $where_param);

        foreach ($data['vehicle_type_id'] as $category) {

            $vehicle_type_id[] = $category->id;
        }

        if ($this->input->post('product_type_id')) {

            $post_product_type_id = array(
                'post_product_type_id' => $this->input->post('product_type_id'),
            );
            $this->session->set_userdata($post_product_type_id);

            $vehicle_type_id = $this->input->post('product_type_id');

            $data['vehicle_categories'] = $this->comman_model->get_vehicle_categories_by_id($vehicle_type_id);
            $data['total_num_of_vehicle_categories'] = $this->comman_model->count_vehicle_categories_by_id($vehicle_type_id);
            $vehicle_type_id_array = array();

            foreach ($vehicle_type_id as $vehicle_type) {
                $vehicle_type = str_replace('_', ' ', $vehicle_type);

                $vehicle_type_details = $this->comman_model->get_vehicle_type_details_by_name($vehicle_type);

                foreach ($vehicle_type_details as $details) {

                    if (!empty($details))
                        $vehicle_type_id_array[] = isset($details->id) ? $details->id : '';
                }
            }
            $vehicle_type_id = $vehicle_type_id_array;
        }

        $blankarray = array();

        $vehicle_category_id_for_session = ($product_type != '') ? $blankarray : $data['vehicle_category_ids'];

        $session_data = array(
            'vehicle_type_id' => $vehicle_type_id,
            'vehicle_category_id' => $vehicle_category_id_for_session
        );

        $this->session->set_userdata($session_data);

        //var_dump($data['vehicle_category_ids']);

        if ($data['vehicle_category_ids'] == false)
            $data['vehicle_category_ids'] = array();

        $data['product_type'] = $product_type;

        $breadcrumbs = $this->breadcrumb();

        $breadcrumb = $breadcrumbs[0];

        $breadcrumb.=($breadcrumb != '') ? '&nbsp;&nbsp;/' : '';

        $breadcrumb.=$breadcrumbs[1];

        $data['breadcrumb'] = $breadcrumb;

        //in cart and product section sometimes this is $last_inserted_cart_block_id getting false as the timer isn't showing. to make that more confirm i did this code.
        $last_inserted_cart_block_id = $this->session->userdata('last_inserted_cart_block_id');
        if (!$last_inserted_cart_block_id) {
            $cart_user_info = $this->session->userdata("cart_users_data");
            if (!empty($cart_user_info)) {
                $where_param = array();
                $where_param['email'] = $cart_user_info['email'];
                $select_param = array("id");
                $cart_user_id = $this->block_list_email->get_row("cart_block_users", $select_param, $where_param);
                if (!empty($cart_user_id)) {
                    $last_inserted_cart_block_id = $cart_user_id[0]->id;
                    $update_data = array();
                    if (!empty($cart_user_info['user_name'])) {
                        $update_data['user_name'] = $cart_user_info['user_name'];
                    }
                    if (!empty($cart_user_info['company'])) {
                        $update_data['company'] = $cart_user_info['company'];
                    }
                    if (!empty($cart_user_info['designation'])) {
                        $update_data['designation'] = $cart_user_info['designation'];
                    }
                    if (!empty($cart_user_info['address'])) {
                        $update_data['address'] = $cart_user_info['address'];
                    }
                    if (!empty($cart_user_info['country'])) {
                        $update_data['country'] = $cart_user_info['country'];
                    }
                    if (!empty($cart_user_info['telephone'])) {
                        $update_data['telephone'] = $cart_user_info['telephone'];
                    }
                    if (!empty($cart_user_info['email'])) {
                        $update_data['email'] = $cart_user_info['email'];
                    }
                    if (!empty($cart_user_info['deadline'])) {
                        $update_data['deadline'] = $cart_user_info['deadline'];
                    }
                    if (!empty($cart_user_info['rfq'])) {
                        $update_data['rfq'] = $cart_user_info['rfq'];
                    }
                    if (!empty($cart_user_info['incoterms'])) {
                        $update_data['incoterms'] = $cart_user_info['incoterms'];
                    }
                    $where_param = array();
                    $where_param['id'] = $last_inserted_cart_block_id;
                    $this->block_list_email->update_column("cart_block_users", $where_param, $update_data);
                } else {
                    $last_inserted_cart_block_id = $this->block_list_email->insert_column("cart_block_users",$cart_user_info);
                }
            }
        }
        //block end  - in cart and product section sometimes this is $last_inserted_cart_block_id getting false as the timer isn't showing. to make that more confirm i did this code.
        $data['last_inserted_cart_block_id'] = $last_inserted_cart_block_id;

        if ($last_inserted_cart_block_id)
            $data['current_cart_user_data'] = $this->comman_model->get_data_by_id('cart_block_users', array('id' => $last_inserted_cart_block_id));


        $data['edit_cart_mode'] = isset($data['current_cart_user_data']['cartmode']) ? $data['current_cart_user_data']['cartmode'] : '';


        //to get selection instruction

        $where_param = array();
        $where_param['id'] = 1;
        $select_param = "*";
        $data['selection_instruction'] = $this->block_list_email->get_row("selection_instruction", $select_param, $where_param);
        //to get selection instruction  end 


        $data['menus'] = $this->menu_model->get_all_menus();

        $this->load->view('temp/include/header', $data);

        $this->load->view('product/vehicle_type', $data);

        $this->load->view('temp/footer', $data);
    }

    function breadcrumb() {

        $vehicle_category_ids = $this->session->userdata('vehicle_category_id');

        $vehicle_type_ids = $this->session->userdata('vehicle_type_id');

        $product_maker_ids = $this->session->userdata('product_maker_id');
        $cat_breadcrumb = '';
        $type_breadcrumb = '';
        $maker_breadcrumb = '';
        if (!empty($vehicle_category_ids)) {

            foreach ($vehicle_category_ids as $key1 => $vehicle_category_id) {

                if ($vehicle_category_id == '')
                    unset($vehicle_category_ids[$key1]);
            }
            $cat_breadcrumbs = '';

            $cat_count = 0;
            foreach ($vehicle_category_ids as $key1 => $vehicle_category_id) {

                if ($cat_count > 0)
                    $cat_breadcrumbs.= ' - ' . '<a href="products/product_type/' . $vehicle_category_id . '">' . $this->comman_model->get_breadcrumbcategorydetailsbyid($vehicle_category_id) . '</a>';
                else
                    $cat_breadcrumbs.= '<a href="products/product_type/' . $vehicle_category_id . '">' . $this->comman_model->get_breadcrumbcategorydetailsbyid($vehicle_category_id) . '</a>';

                $cat_count++;
            }
            $cat_breadcrumb.= $cat_breadcrumbs;
        }
        if (!empty($vehicle_type_ids)) {

            foreach ($vehicle_type_ids as $key2 => $vehicle_type_id) {

                if ($vehicle_type_id == '')
                    unset($vehicle_type_ids[$key2]);
            }
            $type_breadcrumbs = '';

            $type_count = 0;
            foreach ($vehicle_type_ids as $key2 => $vehicle_type_id) {
                $t = $this->comman_model->get_breadcrumbproducttypedetailsbyid($vehicle_type_id);

                if ($type_count > 0) {

                    $type_breadcrumbs.= ' - ' .
                            '<a href="products/vehicle_type/' . strtolower(str_replace(' ', '_', str_replace("&nbsp;", "", $t))) . '">' . $t . '</a>';
                } else
                    $type_breadcrumbs.= '<a href="products/vehicle_type/' . strtolower(str_replace(' ', '_', str_replace("&nbsp;", "", $t))) . '">' . $t . '</a>';

                $type_count++;
            }
            $type_breadcrumb.= $type_breadcrumbs;
        }
        if (!empty($product_maker_ids)) {

            foreach ($product_maker_ids as $key3 => $product_maker_id) {

                if ($product_maker_id == '')
                    unset($product_maker_ids[$key3]);
            }



            $maker_breadcrumbs = '';

            $maker_count = 0;



            foreach ($product_maker_ids as $key3 => $product_maker_id) {

                if ($maker_count > 0)
                    $maker_breadcrumbs.= ' - ' . $this->comman_model->get_breadcrumbmakerdetailsbyid($product_maker_id);
                else
                    $maker_breadcrumbs.= $this->comman_model->get_breadcrumbmakerdetailsbyid($product_maker_id);

                $maker_count++;
            }
            $maker_breadcrumb.= '<a href="products/product_brand">' . $maker_breadcrumbs . '</a>';
        }
        return array($cat_breadcrumb, $type_breadcrumb, $maker_breadcrumb);
    }

    function checkItemInCartAjax() {


        $this->load->model("block_list_email");

        //to get selection instruction

        $where_param = array();
        $where_param['id'] = 1;
        $select_param = "*";
        $selection_instruction = $this->block_list_email->get_row("selection_instruction", $select_param, $where_param);
        //to get selection instruction  end  

        $product_ids = $this->input->post('product_id');

        $carts = $this->session->userdata('cart');

        $status = 0;

        $message = '';

        $refname = '';

        $product = '';

        $productcount = 0;

        $productnamesarr = array();
        $cart_product = array();

        foreach ($product_ids as $product_id) {

            if (!empty($carts)) {

                foreach ($carts as $cart) {

                    if ($cart['item_id'] == $product_id) {

                        //echo "pdct in cart";

                        $productcount++;

                        $status = 1;

                        if ($product != '')
                            $product.=',';

                        $product.=$product_id;



                        $productnames = $this->product_model->get_productModelname($product_id);

                        $productnamesarr[] = $productnames[0]['kgt_ref_number'];
                    }
                }
            }
        }
        $i = 1;
        $new_added_products = array();

        foreach ($productnamesarr as $productname) {

            if ($refname != '') {

                if ($i == $productcount)
                    $refname.=' and ';
                else
                    $refname.=', ';
            }

            $refname.=$productname;

            $i++;
        }
        $phrase = ($productcount > 1 ? 'are' : 'is');
        $phrase1 = ($productcount > 1 ? 'items' : 'item');
        $phrase2 = ($productcount > 1 ? 'these' : 'this');
        $phrase3 = ($productcount > 1 ? 'them' : 'it');


        //$message="The items ".$refname." ".$phrase." already added in the cart ,  you cannot add it again. So these items are unselected. ";
        if ($refname == '') {
            $message = '';
        } else {
            $message = $selection_instruction[0]->already_exist_msg;
            $message = preg_replace('/\bPHRASE\b/', $phrase, $message);
            $message = preg_replace('/\bPHRASEITEM\b/', $phrase1, $message);
            $message = preg_replace('/\bPHRASETHIS\b/', $phrase2, $message);
            $message = str_replace("PHRASEIT", $phrase3, $message);
            $message = str_replace("REFNAME", $refname, $message);

            //$message = "The " . $phrase1 . " " . $refname . " " . $phrase . " already  in the cart. It is better to save time and avoid adding it again. Therefore, " . $phrase2." ".$phrase1 . " ".$phrase." unselected and you can change its quantity status from the cart. ";
        }
        $this->session->set_userdata('cart_msg', $message);

        if ($productcount > 1)
            $title = 'Items are already in the cart';
        else
            $title = 'Item is already in the cart';
        $data = array('status' => $status, 'message' => $message, 'product' => $product, 'kgf_ref' => $refname, 'title' => $title);

        echo json_encode($data);
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

    function get_menu_product_types($offset) {
        //die('asdasdasdas');
        $data['menu_product_types'] = $this->comman_model->get_product_type_for_menu($offset);
        $this->load->view('product/get_menu_product_types', $data);
    }

    function get_product_types($offset) {
        $data['vehicle_type_ids'] = $this->session->userdata('vehicle_type_id');
        if (empty($data['vehicle_type_ids'])) {
            $data['vehicle_type_ids'] = array();
        }
        $data['vehicle_type'] = $this->product_model->get_product_type_by_typename($data['vehicle_type_ids'], $offset);
        $this->load->view('product/get_product_types', $data);
    }

    function ajax_vehicle_types($offset) {   //vehicle_category_ids
        $data['vehicle_category_ids'] = $this->session->userdata('vehicle_category_id');
        if (empty($data['vehicle_category_ids'])) {
            $data['vehicle_category_ids'] = array();
        }
        $vehicle_type_id = $this->session->userdata('post_product_type_id');
        //post_product_type_id
        $data['vehicle_categories'] = $this->comman_model->get_vehicle_categories_by_id($vehicle_type_id, $offset);

        $this->load->view('product/ajax_vehicle_types', $data);
    }

    function get_vehicle_types($offset) {
        //die('asdasdasdas');
        $data['vehicle_category_ids'] = $this->session->userdata('vehicle_category_id');

        if ($data['vehicle_category_ids'] == false)
            $data['vehicle_category_ids'] = array();
        $data['vehicle_categories'] = $this->comman_model->get_vehicle_type_for_menu($offset);
        $this->load->view('product/get_vehicle_types', $data);
    }

    function get_product_makers($offset) {
        //die('asdasdasdas');

        $data['product_maker_id'] = $this->session->userdata('product_maker_id');
        if ($data['product_maker_id'] == false)
            $data['product_maker_id'] = array();
        $data['vehicle_makers'] = $this->product_model->get_products_by_makers_brand_details($offset);
        //echo "<pre>"; print_r($data);
        $this->load->view('product/get_product_makers', $data);
    }

    function get_product_list($offset) {
        //die('asdasdasdas');

        $data['products'] = $this->product_model->get_products_by_makers($offset);
        //echo "<pre>"; print_r($data);
        $this->load->view('product/get_product_list', $data);
    }

    function getProducts() {
        $limit = $this->config->item('pagination_limit_product_list');
        $offset = 0;
        $limit = $this->input->post('limit');
        $offset = $this->input->post('offset');
        $data['offset'] = $offset;
        $data['checkbox'] = $this->input->post('checkbox');
        $data['products'] = $this->product_model->get_products_by_makers($limit, $offset);


        $this->load->view('product/get_product_list', $data);
    }

    private function sortBand($data  = array())
    {
        if(empty($data)) return array();

        $markerArray = array();


        foreach($data as $key => $value)
        {
            $markerArray[$value['category']][$value['type']][] = $value;
        }

        return $markerArray;
    }
}
