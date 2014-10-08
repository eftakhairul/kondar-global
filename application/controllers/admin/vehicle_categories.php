<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Vehicle_categories extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
        $this->load->model('admin_model');
        $this->load->model('comman_model');
        $this->load->model('serial_model');
        $this->load->model('vehicle_categories_model');
        $this->load->helper('date');
        $this->load->helper('form');
        $this->load->library('session');
        $this->load->helper('language');
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
        $data['title'] = 'Vehicle Category';
        $data['active'] = 'vehicle_categories';

        if ($this->input->post('DeleteAll')) {
            $this->vehicle_categories_model->deleteallvehiclecategories();

            $files = glob('assets/uploads/vehicle_categories/*'); // get all file names
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
            $selectedvehiclecategories = $this->input->post('deleteitem');
            foreach ($selectedvehiclecategories as $vehtodelete) {

                $p_type_data = $this->comman_model->get_data_by_id('tbl_vehicle_categories', array('id' => $vehtodelete));

                $product_data = $this->comman_model->get_all_data_by_id('tbl_products', array('vehicle_category_id' => $vehtodelete));

                //$result = $this->comman_model->delete_by_id('tbl_vehicle_categories', array('id' => $vehtodelete));

                $result = $this->vehicle_categories_model->deleteSelectedvehiclecategories($vehtodelete);

                if ($result) {

                    if (file_exists("assets/uploads/vehicle_categories/" . $p_type_data['VehicleType_Photo']))
                        unlink("assets/uploads/vehicle_categories/" . $p_type_data['VehicleType_Photo']);

                    if (file_exists("assets/uploads/vehicle_categories/" . $p_type_data['vehicle_category_icon']))
                        unlink("assets/uploads/vehicle_categories/" . $p_type_data['vehicle_category_icon']);

                    if (file_exists("assets/uploads/vehicle_categories/" . $p_type_data['menu_image']))
                        unlink("assets/uploads/vehicle_categories/" . $p_type_data['menu_image']);

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
        $null = '';
        $data['all_data'] = $this->vehicle_categories_model->search_vehicle_category_data('tbl_vehicle_categories', $key, 'category_name');
        $data['search'] = $key;
        //$data['all_data'] = $this->comman_model->all_data('tbl_vehicle_categories');
        //var_dump($data['search']);
        $this->load->view('admin/header', $data);
        $this->load->view('admin/left_menu', $data);
        $this->load->view('admin/product_catagory_list', $data);
        $this->load->view('admin/footer', $data);
    }

    function delete($id) {


        $p_type_data = $this->comman_model->get_data_by_id('tbl_vehicle_categories', array('id' => $id));

        $product_data = $this->comman_model->get_all_data_by_id('tbl_products', array('vehicle_category_id' => $id));

        $result = $this->comman_model->delete_by_id('tbl_vehicle_categories', array('id' => $id));

        if ($result) {

            if (file_exists("assets/uploads/vehicle_categories/" . $p_type_data['VehicleType_Photo']))
                unlink("assets/uploads/vehicle_categories/" . $p_type_data['VehicleType_Photo']);

            if (file_exists("assets/uploads/vehicle_categories/" . $p_type_data['vehicle_category_icon']))
                unlink("assets/uploads/vehicle_categories/" . $p_type_data['vehicle_category_icon']);

            if (file_exists("assets/uploads/vehicle_categories/" . $p_type_data['menu_image']))
                unlink("assets/uploads/vehicle_categories/" . $p_type_data['menu_image']);

            foreach ($product_data as $item) {

                if (file_exists("assets/uploads/product_images/" . $item['drawing_photo']))
                    unlink("assets/uploads/product_images/" . $item['drawing_photo']);

                if (file_exists("assets/uploads/product_images/" . $item['product_photo']))
                    unlink("assets/uploads/product_images/" . $item['product_photo']);

                if (file_exists("assets/uploads/product_images/" . $item['vehicle_photo']))
                    unlink("assets/uploads/product_images/" . $item['vehicle_photo']);
            }
        }


        $this->session->set_flashdata('success', 'Vehicle category has successfully deleted.');
        redirect('admin/vehicle_categories');
    }

    function delete_winner($id) {
        $result = $this->comman_model->delete_winner_id('winner_list', array('id' => $id));
        $this->session->set_flashdata('success', 'Winner successfully deleted.');
        redirect('admin/serial/winners');
    }

    function add_product_category() {
        
        $this->check_lang();
        $this->validateLogin();
        
        $data = array();
        $data['login'] = $this->session->all_userdata();
        $data['title'] = 'Vehicle Category';
        $data['active'] = 'vehicle_categories';
        $data['sub_menu'] = 'add_article';
        if ($this->input->post('operation')) {

            $field_name1 = 'VehicleType_Photo';
            $field_name2 = 'vehicle_category_icon';
            $field_name3 = 'menu_image';
            $config['upload_path'] = './assets/uploads/vehicle_categories';
            $config['allowed_types'] = 'gif|jpg|png|pdf';
            $config['max_size'] = '1024';
            $config['max_width'] = '100000';
            $config['max_height'] = '10000';
            $this->load->library('upload', $config);

            $post_data = array(
                'category_name' => $this->input->post('category_name'),
                'status' => $this->input->post('status'),
                'created_date' => date('Y-m-d')
            );
            $this->upload->do_upload($field_name1);
            $upload_data = $this->upload->data();
            if ($upload_data['file_name'] != '')
                $post_data['VehicleType_Photo'] = $upload_data['file_name'];

            //$config['upload_path'] = './assets/uploads/product_catagory_icon';
            //$this->load->library('upload', $config);
            $this->upload->do_upload($field_name2);
            $upload_data2 = $this->upload->data();
            if ($upload_data2['file_name'] != '')
                $post_data['vehicle_category_icon'] = $upload_data2['file_name'];


            $this->upload->do_upload($field_name3);
            $upload_data3 = $this->upload->data();
            if ($upload_data3['file_name'] != '')
                $post_data['menu_image'] = $upload_data3['file_name'];

            $result = $this->comman_model->add('tbl_vehicle_categories', $post_data);
            $this->session->set_flashdata('success', 'Vehicle category has been successfully added.');
            redirect('admin/vehicle_categories');
        }
        $this->load->view('admin/header', $data);
        $this->load->view('admin/left_menu', $data);
        $this->load->view('admin/add_product_category', $data);
        $this->load->view('admin/footer', $data);
    }

    function edit_product_category($id = false) {
        if (!$id) {
            redirect('admin/vehicle_categories');
        }
        
        $this->check_lang();
        $this->validateLogin();
        
        $data = array();
        $data['login'] = $this->session->all_userdata();
        $data['title'] = 'Vehicle Category';

        $edit_data = $this->comman_model->get_data_by_id('serial_code', array('id' => $id));

        //if($edit_data["status"] != $this->input->post('status'))
        if ($this->input->post('status') == '1') {
            //$serial_code_id = $this->comman_model->get_data_by_id('serial_code',array('code'=>$edit_data["id"]));
            $this->comman_model->delete_blocked_id('winner_list', array('serial_id' => $edit_data["id"]));
        }



        if ($this->input->post('operation')) {

            $field_name1 = 'VehicleType_Photo';
            $field_name2 = 'vehicle_category_icon';
            $field_name3 = 'menu_image';
            $config['upload_path'] = './assets/uploads/vehicle_categories';
            $config['allowed_types'] = 'gif|jpg|png|pdf';
            $config['max_size'] = '1024';
            $config['max_width'] = '100000';
            $config['max_height'] = '10000';
            $this->load->library('upload', $config);
            $post_data = array(
                'category_name' => $this->input->post('category_name'),
                'status' => $this->input->post('status')
            );
            $this->upload->do_upload($field_name1);
            $upload_data = $this->upload->data();
            if ($upload_data['file_name'] != '')
                $post_data['VehicleType_Photo'] = $upload_data['file_name'];
            $this->upload->initialize($config);
            $this->upload->do_upload($field_name2);
            $upload_data2 = $this->upload->data();
            if ($upload_data2['file_name'] != '')
                $post_data['vehicle_category_icon'] = $upload_data2['file_name'];
            $this->upload->initialize($config);
            $this->upload->do_upload($field_name3);
            $upload_data3 = $this->upload->data();
            if ($upload_data3['file_name'] != '')
                $post_data['menu_image'] = $upload_data3['file_name'];


            $all_data = $this->comman_model->get_data_by_id('tbl_vehicle_categories', array('id' => $id));

            $result = $this->comman_model->update_data_by_id('tbl_vehicle_categories', $post_data, 'id', $id);

            if ($result) {

                if ($post_data['VehicleType_Photo']) {
                    if (file_exists("assets/uploads/vehicle_categories/" . $all_data['VehicleType_Photo']))
                        unlink("assets/uploads/vehicle_categories/" . $all_data['VehicleType_Photo']);
                }

                if ($post_data['vehicle_category_icon']) {
                    if (file_exists("assets/uploads/vehicle_categories/" . $all_data['vehicle_category_icon']))
                        unlink("assets/uploads/vehicle_categories/" . $all_data['vehicle_category_icon']);
                }

                if ($post_data['menu_image']) {
                    if (file_exists("assets/uploads/vehicle_categories/" . $all_data['menu_image']))
                        unlink("assets/uploads/vehicle_categories/" . $all_data['menu_image']);
                }
            }


            $this->session->set_flashdata('success', 'Vehicle Category has been successfully updated.');
            redirect('admin/vehicle_categories');
        }
        $data['edit_data'] = $this->comman_model->get_data_by_id('tbl_vehicle_categories', array('id' => $id));
        $data['winners_entry'] = $this->comman_model->get_data_by_id('winner_list', array('serial_id' => $id));
        $this->load->view('admin/header', $data);
        $this->load->view('admin/left_menu', $data);
        $this->load->view('admin/edit_product_category', $data);
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