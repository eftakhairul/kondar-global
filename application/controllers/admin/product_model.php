<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Product_model extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
        $this->load->model('admin_model');
        $this->load->model('comman_model');
        $this->load->model('pro_model');
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
        $data['title'] = 'Product Model';
        $data['active'] = 'product_model';
        //$key  = $this->input->post('search');
        //$data['all_data'] = $this->comman_model->all_data('tbl_models');
        if ($this->input->post('DeleteAll')) {

            $this->pro_model->deleteallproductmodels();

            $files = glob('assets/uploads/product_model/*'); // get all file names
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

            $selectedproductmodeltodelete = $this->input->post('deleteitem');

            foreach ($selectedproductmodeltodelete as $modeltodelete) {


                $p_type_data = $this->comman_model->get_data_by_id('tbl_models', array('id' => $modeltodelete));

                $product_data = $this->comman_model->get_all_data_by_id('tbl_products', array('model_id' => $modeltodelete));

                //$result = $this->comman_model->delete_winner_id('tbl_models ', array('id' => $id));

                $result = $this->pro_model->deleteSelectedproductmodel($modeltodelete);

                if ($result) {

                    if (file_exists("assets/uploads/product_model/" . $p_type_data['model_photo']))
                        unlink("assets/uploads/product_model/" . $p_type_data['model_photo']);

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

        $data['all_data'] = $this->pro_model->get_models_details();


        $this->load->view('admin/header', $data);
        $this->load->view('admin/left_menu', $data);
        $this->load->view('admin/product_model_list', $data);
        $this->load->view('admin/footer', $data);
    }

    function delete_model($id) {

        $p_type_data = $this->comman_model->get_data_by_id('tbl_models', array('id' => $id));

        $product_data = $this->comman_model->get_all_data_by_id('tbl_products', array('model_id' => $id));

        $result = $this->comman_model->delete_winner_id('tbl_models ', array('id' => $id));

        if ($result) {

            if (file_exists("assets/uploads/product_model/" . $p_type_data['model_photo']))
                unlink("assets/uploads/product_model/" . $p_type_data['model_photo']);

            foreach ($product_data as $item) {

                if (file_exists("assets/uploads/product_images/" . $item['drawing_photo']))
                    unlink("assets/uploads/product_images/" . $item['drawing_photo']);

                if (file_exists("assets/uploads/product_images/" . $item['product_photo']))
                    unlink("assets/uploads/product_images/" . $item['product_photo']);

                if (file_exists("assets/uploads/product_images/" . $item['vehicle_photo']))
                    unlink("assets/uploads/product_images/" . $item['vehicle_photo']);
            }
        }

        $this->session->set_flashdata('success', 'Product Model successfully deleted.');
        redirect('admin/product_model');
    }

    function add_model() {
        
        $this->check_lang();
        $this->validateLogin();
        
        $data = array();
        $data['login'] = $this->session->all_userdata();
        $data['title'] = 'Product Model';
        $data['active'] = 'product_model';
        $data['sub_menu'] = 'add_article';

        if ($this->input->post('operation')) {
            $field_name1 = 'pro_modelimage';
            $config['upload_path'] = './assets/uploads/product_model';
            $config['allowed_types'] = 'gif|jpg|png|pdf|jpeg';
            $config['max_size'] = '1024';
            $config['max_width'] = '100000';
            $config['max_height'] = '10000';
            $this->load->library('upload', $config);

            $post_data = array(
                'model_name' => $this->input->post('pro_modelname'),
                'kgt_ref_number' => $this->input->post('ref_no'),
                'maker_id' => $this->input->post('maker_id'),
                'status' => $this->input->post('status'),
                'created_date' => date('Y-m-d')
            );

            $this->upload->do_upload($field_name1);
            $upload_data = $this->upload->data();
            $post_data['model_photo'] = $upload_data['file_name'];

            $result = $this->comman_model->add('tbl_models', $post_data);
            $this->session->set_flashdata('success', 'Product Model has been successfully added.');
            redirect('admin/product_model');
        }
        $data['maker_info'] = $this->comman_model->all_data('tbl_makers');
        $this->load->view('admin/header', $data);
        $this->load->view('admin/left_menu', $data);
        $this->load->view('admin/add_model', $data);
        $this->load->view('admin/footer', $data);
    }

    function edit_model($id = false) {
        if (!$id) {
            redirect('admin/product_model');
        }

        $this->check_lang();
        $this->validateLogin();
        
        $data = array();
        $data['login'] = $this->session->all_userdata();
        $data['title'] = 'Product Model';

        //if($edit_data["status"] != $this->input->post('status'))

        if ($this->input->post('operation')) {
            $field_name1 = 'pro_modelimage';
            $config['upload_path'] = './assets/uploads/product_model';
            $config['allowed_types'] = 'gif|jpg|png|pdf|jpeg';
            $config['max_size'] = '1024';
            $config['max_width'] = '100000';
            $config['max_height'] = '10000';
            $this->load->library('upload', $config);

            $post_data = array(
                'model_name' => $this->input->post('pro_modelname'),
                'kgt_ref_number' => $this->input->post('pro_modelref_no'),
                'maker_id' => $this->input->post('maker_id'),
                'status' => $this->input->post('status')
            );


            $this->upload->do_upload($field_name1);
            $upload_data = $this->upload->data();
            if ($upload_data['file_name'] != '')
                $post_data['model_photo'] = $upload_data['file_name'];


            $p_type_data = $this->comman_model->get_data_by_id('tbl_models', array('id' => $id));

            $result = $this->comman_model->update_data_by_id('tbl_models', $post_data, 'id', $id);

            if ($result && $post_data['model_photo']) {

                if (file_exists("assets/uploads/product_model/" . $p_type_data['model_photo']))
                    unlink("assets/uploads/product_model/" . $p_type_data['model_photo']);
            }

            $this->session->set_flashdata('success', 'Product Model has been successfully updated.');
            redirect('admin/product_model');
        }
        $data['maker_info'] = $this->comman_model->all_data('tbl_makers');
        $data['edit_data'] = $this->comman_model->get_data_by_id('tbl_models', array('id' => $id));
        //$data['winners_entry'] = $this->comman_model->get_data_by_id('winner_list',array('serial_id'=>$id));
        $this->load->view('admin/header', $data);
        $this->load->view('admin/left_menu', $data);
        $this->load->view('admin/edit_product_model', $data);
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