<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Product_type extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
        $this->load->model('admin_model');
        $this->load->model('comman_model');
        $this->load->model('product_type_model');
        $this->load->helper('date');
        $this->load->helper('form');
        $this->load->helper('language');
        $this->load->library('session');
        $this->load->library("pagination");
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

    function validateLogin() {
        $logged_in = $this->session->userdata('logged_in');
        if ((isset($logged_in) || $logged_in == true)) {
            if ($logged_in != "admin") {
                redirect('/admin/index/login', 'refresh');
            }
        } else {
            redirect('/admin/index/login', 'refresh');
        }
    }

    function index() {

        $this->check_lang();
        $this->validateLogin();

        $data = array();
        $data['login'] = $this->session->all_userdata();
        $data['title'] = 'Product Type';
        $data['active'] = 'product_type';

        if ($this->input->post('DeleteAll')) {
            $this->product_type_model->deleteallproducttypes();


            $files = glob('assets/uploads/product_type_images/*'); // get all file names
            foreach ($files as $file) { // iterate files
                if (is_file($file))
                    unlink($file); // delete file
            }

            $files = glob('assets/uploads/product_images/*'); // get all file names
            foreach ($files as $file) { // iterate files
                if (is_file($file))
                    unlink($file); // delete file
            }
        }
        if ($this->input->post('DeleteSelected')) {
            $selectedproducttypestodelete = $this->input->post('deleteitem');
            foreach ($selectedproducttypestodelete as $typetodelete) {


                $p_type_data = $this->comman_model->get_data_by_id('tbl_product_types', array('id' => $typetodelete));

                $product_data = $this->comman_model->get_all_data_by_id('tbl_products', array('product_type_id' => $typetodelete));

                //$result = $this->comman_model->delete_winner_id('tbl_product_types', array('id' => $id));

                $result = $this->product_type_model->deleteSelectedproducttypes($typetodelete);

                if ($result) {

                    if (file_exists("assets/uploads/product_type_images/" . $p_type_data['Product_Type_Photo']))
                        unlink("assets/uploads/product_type_images/" . $p_type_data['Product_Type_Photo']);

                    foreach ($product_data as $item) {

                        if (file_exists("assets/uploads/product_images/" . $item['drawing_photo']))
                            unlink("assets/uploads/product_images/" . $item['drawing_photo']);

                        if (file_exists("assets/uploads/product_images/" . $item['product_photo']))
                            unlink("assets/uploads/product_images/" . $item['product_photo']);

                        if (file_exists("assets/uploads/product_images/" . $item['vehicle_photo']))
                            unlink("assets/uploads/product_images/" . $item['vehicle_photo']);
                    }
                }
            }
        }

        $key = $this->input->post('search');
        //$data['all_data'] = $this->product_type_model->search_producttype_data('serial_code',$key,'','');
        $data['all_data'] = $this->product_type_model->search_producttype_data('tbl_product_types', $key, 'product_type_name');
        $data['search'] = $key;
        //$data['all_data'] = $this->comman_model->all_data('tbl_product_types');

        $this->load->view('admin/header', $data);
        $this->load->view('admin/left_menu', $data);
        $this->load->view('admin/product_type_list', $data);
        $this->load->view('admin/footer', $data);
    }

    function delete_product($id) {

        $p_type_data = $this->comman_model->get_data_by_id('tbl_product_types', array('id' => $id));

        $product_data = $this->comman_model->get_all_data_by_id('tbl_products', array('product_type_id' => $id));

        $result = $this->comman_model->delete_winner_id('tbl_product_types', array('id' => $id));

        if ($result) {

            if (file_exists("assets/uploads/product_type_images/" . $p_type_data['Product_Type_Photo']))
                unlink("assets/uploads/product_type_images/" . $p_type_data['Product_Type_Photo']);

            foreach ($product_data as $item) {

                if (file_exists("assets/uploads/product_images/" . $item['drawing_photo']))
                    unlink("assets/uploads/product_images/" . $item['drawing_photo']);

                if (file_exists("assets/uploads/product_images/" . $item['product_photo']))
                    unlink("assets/uploads/product_images/" . $item['product_photo']);

                if (file_exists("assets/uploads/product_images/" . $item['vehicle_photo']))
                    unlink("assets/uploads/product_images/" . $item['vehicle_photo']);
            }
        }

        $this->session->set_flashdata('success', 'Product Type successfully deleted.');
        redirect('admin/product_type');
    }

    function add_producttype() {
        
        $this->check_lang();
        $this->validateLogin();
        
        $data = array();
        $data['login'] = $this->session->all_userdata();
        $data['title'] = 'Product Type';
        $data['active'] = 'serial';
        $data['sub_menu'] = 'add_article';

        if ($this->input->post('operation')) {
            $field_name1 = 'pro_image';
            $config['upload_path'] = './assets/uploads/product_type_images';
            $config['allowed_types'] = 'gif|jpg|png|pdf';
            $config['max_size'] = '1024';
            $config['max_width'] = '100000';
            $config['max_height'] = '10000';
            $this->load->library('upload', $config);

            $menu_string = '';
            $menu_items = $this->input->post('menu');
            foreach ($menu_items as $menudata) {
                $menu_string.=$menudata . '#';
            }

            $menuadmin_string = '';
            $menuadmin_items = $this->input->post('menuadmin');
            foreach ($menuadmin_items as $menu_admindata) {
                $menu_adminstring.=$menu_admindata . '#';
            }


            $post_data = array(
                'product_type_name' => $this->input->post('pro_typename'),
                'vehicle_category_id' => $this->input->post('vehicle_category_id'),
                'status' => $this->input->post('status'),
                'menu_privilages' => $menu_string,
                'menu_privilages_admin' => $menu_adminstring,
                'created_date' => date('Y-m-d')
            );

            $this->upload->do_upload($field_name1);
            $upload_data = $this->upload->data();
            $post_data['Product_Type_Photo'] = $upload_data['file_name'];

            $result = $this->comman_model->add('tbl_product_types', $post_data);
            $this->session->set_flashdata('success', 'Product Type has been successfully added.');
            redirect('admin/product_type');
        }
        $data['product_catagory'] = $this->comman_model->all_data('tbl_vehicle_categories');
        $this->load->view('admin/header', $data);
        $this->load->view('admin/left_menu', $data);
        $this->load->view('admin/add_producttype', $data);
        $this->load->view('admin/footer', $data);
    }

    function edit_product($id = false) {
        if (!$id) {
            redirect('admin/product_type');
        }
        $this->check_lang();
        $this->validateLogin();
        $data = array();
        $data['login'] = $this->session->all_userdata();
        $data['title'] = 'Product Type';

        //if($edit_data["status"] != $this->input->post('status'))

        if ($this->input->post('operation')) {
            $field_name1 = 'pro_image';
            $config['upload_path'] = './assets/uploads/product_type_images';
            $config['allowed_types'] = 'gif|jpg|png|pdf';
            $config['max_size'] = '1024';
            $config['max_width'] = '100000';
            $config['max_height'] = '10000';
            $this->load->library('upload', $config);

            $menu_string = '';
            $menu_items = $this->input->post('menu');
            foreach ($menu_items as $menudata) {
                $menu_string.=$menudata . '#';
            }

            $menuadmin_string = '';
            $menuadmin_items = $this->input->post('menuadmin');
            $menu_adminstring = '';
            foreach ($menuadmin_items as $menu_admindata) {
                $menu_adminstring.=$menu_admindata . '#';
            }

            $post_data = array(
                'product_type_name' => $this->input->post('pro_typename'),
                'vehicle_category_id' => $this->input->post('vehicle_category_id'),
                'menu_privilages' => $menu_string,
                'menu_privilages_admin' => $menu_adminstring,
                'status' => $this->input->post('status'),
            );


            $this->upload->do_upload($field_name1);
            $upload_data = $this->upload->data();
            if ($upload_data['file_name'] != '')
                $post_data['Product_Type_Photo'] = $upload_data['file_name'];

            $p_type_data = $this->comman_model->get_data_by_id('tbl_product_types', array('id' => $id));

            $result = $this->comman_model->update_data_by_id('tbl_product_types', $post_data, 'id', $id);

            if ($result && $post_data['Product_Type_Photo']) {

                if (file_exists("assets/uploads/product_type_images/" . $p_type_data['Product_Type_Photo']))
                    unlink("assets/uploads/product_type_images/" . $p_type_data['Product_Type_Photo']);
            }

            $this->session->set_flashdata('success', 'Product Type has been successfully updated.');
            redirect('admin/product_type');
        }

        $data['edit_data'] = $this->comman_model->get_data_by_id('tbl_product_types', array('id' => $id));
        $data['product_catagory'] = $this->comman_model->all_data('tbl_vehicle_categories');
        //$data['winners_entry'] = $this->comman_model->get_data_by_id('winner_list',array('serial_id'=>$id));
        $this->load->view('admin/header', $data);
        $this->load->view('admin/left_menu', $data);
        $this->load->view('admin/edit_producttype', $data);
        $this->load->view('admin/footer', $data);
    }

    function winners() {
        $this->validateLogin();
        $data = array();
        $data['login'] = $this->session->all_userdata();
        $data['title'] = 'Winner list';
        $data['active'] = 'winner_list';

        $data['all_data'] = $this->comman_model->search_serial_data('winner_list');
        $data['countries'] = $this->comman_model->search_serial_data('countries');
        $data['serial_codes'] = $this->comman_model->search_serial_data('serial_code');
        $this->load->view('admin/header', $data);
        $this->load->view('admin/left_menu', $data);
        $this->load->view('admin/winner_list', $data);
        $this->load->view('admin/footer', $data);
    }

    function blocked() {
        $this->validateLogin();
        $data = array();
        $data['login'] = $this->session->all_userdata();
        $data['title'] = 'Blocked Users List';
        $data['active'] = 'blocked';

        //$data['all_data'] = $this->comman_model->get_list_by_group('block_users','email');
        $data['all_data'] = $this->serial_model->getBlockDetails();

        $this->load->view('admin/header', $data);
        $this->load->view('admin/left_menu', $data);
        $this->load->view('admin/blocked_list', $data);
        $this->load->view('admin/footer', $data);
    }

    function delete_blocked($id) {
        $result = $this->comman_model->delete_blocked_id('block_users', array('id' => $id));
        $this->session->set_flashdata('success', 'Blocked user successfully deleted.');
        redirect('admin/serial/blocked');
    }

    function delete_blocked_all() {
        $result = $this->comman_model->delete_blocked_all('block_users');
        $this->session->set_flashdata('success', 'Deleted all blocked users.');
        redirect('admin/serial/blocked');
    }

    function view_winner($id) {
        $this->validateLogin();
        $data = array();
        $data['login'] = $this->session->all_userdata();
        $data['title'] = 'View winner';
        $data['active'] = 'view_winner';

        $data['set_data'] = $this->comman_model->get_winner_by_id('winner_list', array('id' => $id));
        $this->load->view('admin/header', $data);
        $this->load->view('admin/left_menu', $data);
        $this->load->view('admin/view_winner', $data);
        $this->load->view('admin/footer', $data);
    }

}

/* End of file admin.php */
/* Location: ./application/controllers/admin.php */