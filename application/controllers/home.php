<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Home extends MY_Controller {

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
        $this->load->helper(array('url','date','av_helper','cart_helper','assets','language'));
        $this->load->library(array("pagination",'form_validation'));
        $this->load->language(array('header','home','footer'));        
    }

    public function index() {
        $css_e[] = css_url('bootstrap', 'template/');
        $css_e[] = css_url('font-awesome', 'template/');
        $css_e[] = css_url('bootstrap-select', 'template/');
        $css_e[] = css_url('style', 'template/');
        $css_e[] = css_url('avstyles', 'template/');
        $css_e[] = css_url('style_repos', 'template/');
        $css_e[] = css_url('demo', 'template/');
        $css_e[] = css_url('home', $this->_configs['template']);



        $data = array();
        $this->load->model('comman_model');
        $this->load->model('home_page_model');
        $this->load->model('menu_model');
        $this->load->model('product_model');
        $this->load->model('country_model');
        $this->load->model('content_model');
        $this->load->model('slider_model');
        $this->load->model('vehicle_model');
        $this->load->model('promotion_section_model');

        $data['all_data'] = $this->home_page_model->as_array()->get(1);
        $data['country_data'] = $this->country_model->as_array()->get_many_by(array('status' => 1));
        $data['menus'] = $this->menu_model->as_array()->get_all();
        $data['page_data'] = $this->content_model->as_array()->get_many_by(array('status' => 1));
        $data['slider_data'] = $this->slider_model->as_array()->get_many_by(array('status' => 1));
        $data['login'] = $this->session->all_userdata();
        $data['menus'] = $this->menu_model->as_array()->get_all();
        $data['download'] = $this->promotion_section_model->as_array()->get_many_by(array('type' => 'knowledge_center'));
        $data['vehicle_menu'] = $this->vehicle_model->as_array()->get_many_by(array('status' => 1));

        //added by rinosh
        $cart = $this->session->userdata('cart');
        $card = cartCleanUp($cart);
        $this->session->set_userdata('cart', $card);
        $data['cartcount'] = getcartcount($cart);
        $data['title'] = "Welcome To Company Name";
        $data['active'] = "home";
        $data['product_catagory'] = $this->product_model->getallvehiclecategory_data('tbl_vehicle_categories');
        //$data['product_types'] = $this->product_model->getall_producttype_data('tbl_product_types');
        $data['product_types'] = $this->product_model->get_product_type_by_catagoryid('');
        //var_dump($data['product_types']);
        $data['product_makers'] = $this->product_model->get_all_makers_by_type();

        //added by rinosh ends

        $data['vehicle_categories'] = $this->comman_model->all_data('tbl_vehicle_categories');

        $data['menu_vehicle_categories'] = $this->comman_model->all_data('tbl_vehicle_categories');

        $data['menu_product_types'] = $this->comman_model->get_product_type_for_menu();

        $cart = $this->session->userdata('cart');

        $data['cartcount'] = getcartcount($cart);

        $data['vehicle_category_ids'] = $this->session->userdata('vehicle_category_id');

        if ($data['vehicle_category_ids'] == false)
            $data['vehicle_category_ids'] = array();



        $js_e = array();
        $js_e[] = js_url('bootstrap', 'template/');
        $js_e[] = js_url('lang_select', 'template/');
        $js_e[] = js_url('bootstrap-select.min', 'template/');
        $js_e[] = js_url('jskgt', 'template/');
        $js_e[] = js_url('modernizr.custom.min', 'template/');
        $js_e[] = js_url('jquery.wmuslider', 'template/');
        $js_e[] = js_url('home', $this->_configs['template']);
        $js_e[] = js_url('quicksearch', 'template/');

        $js_f = array();


        $this->_header($css_e);
        $this->_content('include/menu', $data);
        $this->_content('home/home', $data);
        $this->_content('include/footer_content', $data);
        $this->_footer($js_e, $js_f);
    }

    public function index_avv4() {
        $this->check_lang();
        $data = array();
        $data['title'] = "Welcome To Company Name";
        $data['active'] = "home";
        $cart = $this->session->userdata('cart');
        $data['cartcount'] = getcartcount($cart);
        $data['all_data'] = $this->comman_model->get_data_by_id('home_page', array('id' => 1));
        $data['page_data'] = $this->comman_model->get_all_data_by_id('content', array('status' => 1));
        $data['slider_data'] = $this->comman_model->get_all_data_by_id('slider', array('status' => 1));
        $data['country_data'] = $this->comman_model->get_all_data_by_id('country', array('status' => 1));

        $data['product_catagory'] = $this->product_model->getallvehiclecategory_data('tbl_vehicle_categories');
        //$data['product_types'] = $this->product_model->getall_producttype_data('tbl_product_types');
        $data['product_types'] = $this->product_model->get_product_type_by_catagoryid('');
        //var_dump($data['product_types']);
        $data['product_makers'] = $this->product_model->get_all_makers_by_type();

        $data['menus'] = $this->menu_model->get_all_menus();
        //$data['menus'] = $this->menu_model->as_array()->get_all();
        $this->load->view('temp/include/header', $data);
        $this->load->view('temp/home', $data);
        $this->load->view('temp/footer', $data);
    }


    function check_lang() {
        $lang = $this->session->all_userdata();
        if (isset($lang['lang'])) {
            if ($lang['lang'] == 'english') {
                $this->lang->load("common", "english");
                $this->lang->load("user", "english");
            } else if ($lang['lang'] == 'russian') {
                $this->lang->load("common", "russian");
                $this->lang->load("user", "russian");
            }
        } else {
            $this->lang->load("common", "english");
            $this->lang->load("user", "english");
        }
    }

    function validateLogin() {
        $logged_in = $this->session->userdata('logged_in');
        if ((isset($logged_in) || $logged_in == true) && $logged_in != "user") {
            redirect('/front', 'refresh');
        }
    }

    function user_form($id = false) {
        $this->load->model('menu_model'); 
        $this->load->model('comman_model');
        if (!$id) {
            redirect('promotion');
        }
        $this->check_lang();
        $data = array();
        $data['menus'] = $this->menu_model->get_all_menus();
        //check for 
        $data['title'] = "Welcome To Company Name";
        $data['active'] = "applyForm";
        $data['user_data'] = $this->comman_model->check_user_id('promotion_form', 'id', $id);
        if (empty($data['user_data'])) {
            redirect('promotion');
        }
        if ($this->input->post('operation')) {
            $code = $this->input->post('code');
            $check_user = $this->comman_model->get_data_by_id('promotion_form', array('md5(id)' => $id, 'user_code' => $code));
            if (empty($check_user)) {
                $this->session->set_flashdata('error', 'Invalid code. Please Try again.');
                redirect('home/user_form/' . $id);
            }

            $check_code = $this->comman_model->get_data_by_id('promotion_section', array('id' => $check_user['promotion_id']));
            //check emppty product
            if (empty($check_code)) {
                $this->session->set_flashdata('error', 'Sorry There is no download file.');
                redirect('home/user_form/' . $id);
            }
            //if user expired
            $current_time = time();
            $expired_time = strtotime('+' . $check_user['duration'] . ' minutes', $check_user['create_date']);
            if ($expired_time < $current_time) {
                $this->session->set_flashdata('error', 'Sorry this code is not valid any more as it is either expired or used more then authorized times. Please repeat the verification process. Please use another email ID.');
                redirect('home/user_form/' . $id);
            }

            //check many time download file
            if (empty($check_user['download_file'])) {
                $download_file = 1;
            } else {
                $download_file = $check_user['download_file'] + 1;
            }
            //check download file limited
            if ($download_file > $check_user['total_download']) {
                $this->session->set_flashdata('error', 'Sorry you can not download file , your limit has been exeed from limt permitted by Admin. Please contact to KGT.');
                redirect('home/user_form/' . $id);
            }

            $this->comman_model->update_data_by_id('promotion_form', array('download_file' => $download_file), 'id', $check_user['id']);
            //$this->session->set_flashdata('success','success');


            $file_name = 'assets/uploads/promotion_section/file/' . $check_code['file'];
            $mime = 'application/force-download';
            header('Pragma: public');
            header('Expires: 0');
            header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
            header('Cache-Control: private', false);
            header('Content-Type: ' . $mime);
            header('Content-Disposition: attachment; filename="' . basename($file_name) . '"');
            header('Content-Transfer-Encoding: binary');
            header('Connection: close');
            readfile($file_name);
            exit();
            redirect('home/user_form/' . $id);
        }
        $data['menus'] = $this->menu_model->get_all_menus();
        $cart = $this->session->userdata('cart');
        $data['cartcount'] = $this->getcartcount($cart);
        $this->load->view('temp/include/header', $data);
        $this->load->view('temp/user_form', $data);
        $this->load->view('temp/footer', $data);
    }

    function getcartcount() {
        $cart = $this->session->userdata('cart');
        $cart = cartCleanUp($cart);
        $cartcount = is_array($cart) ? count($cart) : 0;
        return $cartcount;
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */