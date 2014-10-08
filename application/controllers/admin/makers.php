<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Makers extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
        $this->load->model('admin_model');
        $this->load->model('comman_model');
        $this->load->model('product_maker_model');
        $this->load->helper('date');
        $this->load->helper('form');
        $this->load->helper('language');
        $this->load->library('session');
        $this->load->library("pagination");
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
        $data['title'] = 'Product Makers';
        $data['active'] = 'makers';

        if ($this->input->post('DeleteAll')) {

            $this->product_maker_model->deleteallproductmakers();

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

            $files = glob('assets/uploads/product_maker/*'); // get all file names
            foreach ($files as $file) { // iterate files
                if (is_file($file))
                    unlink($file); // delete file
            }
        }
        if ($this->input->post('DeleteSelected')) {
            $selectedproductmakertodelete = $this->input->post('deleteitem');

            foreach ($selectedproductmakertodelete as $makertodelete) {

                $p_type_data = $this->comman_model->get_data_by_id('tbl_makers', array('id' => $makertodelete));

                $product_data = $this->comman_model->get_all_data_by_id('tbl_products', array('maker_id' => $makertodelete));

                $models_data = $this->comman_model->get_all_data_by_id('tbl_models', array('maker_id' => $makertodelete));

                //$result = $this->comman_model->delete_winner_id('tbl_makers ', array('id' => $id));

                $result = $this->product_maker_model->deleteSelectedproductmaker($makertodelete);

                if ($result) {

                    if (file_exists("assets/uploads/product_maker/" . $p_type_data['maker_logo']))
                        unlink("assets/uploads/product_maker/" . $p_type_data['maker_logo']);

                    foreach ($product_data as $item) {

                        if (file_exists("assets/uploads/product_images/" . $item['drawing_photo']))
                            unlink("assets/uploads/product_images/" . $item['drawing_photo']);

                        if (file_exists("assets/uploads/product_images/" . $item['product_photo']))
                            unlink("assets/uploads/product_images/" . $item['product_photo']);

                        if (file_exists("assets/uploads/product_images/" . $item['vehicle_photo']))
                            unlink("assets/uploads/product_images/" . $item['vehicle_photo']);
                    }

                    foreach ($models_data as $model) {

                        if (file_exists("assets/uploads/product_model/" . $model['model_photo']))
                            unlink("assets/uploads/product_model/" . $item['model_photo']);
                    }
                }
            }
        }

        $key = $this->input->post('search');
        $data['all_data'] = $this->product_maker_model->search_maker_data('tbl_makers', $key, 'maker_name');
        $data['search'] = $key;
        //$data['all_data'] = $this->comman_model->all_data('tbl_makers');
        $this->load->view('admin/header', $data);
        $this->load->view('admin/left_menu', $data);
        $this->load->view('admin/makers_list', $data);
        $this->load->view('admin/footer', $data);
    }

    function delete_maker($id) {

        $p_type_data = $this->comman_model->get_data_by_id('tbl_makers', array('id' => $id));

        $product_data = $this->comman_model->get_all_data_by_id('tbl_products', array('maker_id' => $id));

        $models_data = $this->comman_model->get_all_data_by_id('tbl_models', array('maker_id' => $id));

        $result = $this->comman_model->delete_winner_id('tbl_makers ', array('id' => $id));

        if ($result) {

            if (file_exists("assets/uploads/product_maker/" . $p_type_data['maker_logo']))
                unlink("assets/uploads/product_maker/" . $p_type_data['maker_logo']);

            foreach ($product_data as $item) {

                if (file_exists("assets/uploads/product_images/" . $item['drawing_photo']))
                    unlink("assets/uploads/product_images/" . $item['drawing_photo']);

                if (file_exists("assets/uploads/product_images/" . $item['product_photo']))
                    unlink("assets/uploads/product_images/" . $item['product_photo']);

                if (file_exists("assets/uploads/product_images/" . $item['vehicle_photo']))
                    unlink("assets/uploads/product_images/" . $item['vehicle_photo']);
            }

            foreach ($models_data as $model) {

                if (file_exists("assets/uploads/product_model/" . $model['model_photo']))
                    unlink("assets/uploads/product_model/" . $item['model_photo']);
            }
        }

        $this->session->set_flashdata('success', 'Product Maker successfully deleted.');
        redirect('admin/makers');
    }

    function add_productmakers() {
        
        $this->check_lang();
        $this->validateLogin();
        
        $data = array();
        $data['login'] = $this->session->all_userdata();
        $data['title'] = 'Product Makers';
        $data['active'] = 'makers';
        $data['sub_menu'] = 'add_article';

        if ($this->input->post('operation')) {
            $field_name1 = 'pro_makerlogo';
            $config['upload_path'] = './assets/uploads/product_maker';
            $config['allowed_types'] = 'gif|jpg|png|pdf';
            $config['max_size'] = '1024';
            $config['max_width'] = '100000';
            $config['max_height'] = '10000';
            $this->load->library('upload', $config);

            $post_data = array(
                'maker_name' => $this->input->post('pro_makername'),
                'status' => $this->input->post('status'),
                'created_date' => date('Y-m-d')
            );

            $this->upload->do_upload($field_name1);
            $upload_data = $this->upload->data();
            $post_data['maker_logo'] = $upload_data['file_name'];

            $result = $this->comman_model->add('tbl_makers', $post_data);
            $this->session->set_flashdata('success', 'Product Makers has been successfully added.');
            redirect('admin/makers');
        }
        $this->load->view('admin/header', $data);
        $this->load->view('admin/left_menu', $data);
        $this->load->view('admin/add_productmakers', $data);
        $this->load->view('admin/footer', $data);
    }

    function edit_maker($id = false) {
        if (!$id) {
            redirect('admin/makers');
        }
        
        $this->check_lang();
        $this->validateLogin();
        
        $data = array();
        $data['login'] = $this->session->all_userdata();
        $data['title'] = 'Product Maker';

        //if($edit_data["status"] != $this->input->post('status'))

        if ($this->input->post('operation')) {
            $field_name1 = 'pro_makerlogo';
            $config['upload_path'] = './assets/uploads/product_maker';
            $config['allowed_types'] = 'gif|jpg|png|pdf';
            $config['max_size'] = '1024';
            $config['max_width'] = '100000';
            $config['max_height'] = '10000';
            $this->load->library('upload', $config);

            $post_data = array(
                'maker_name' => $this->input->post('pro_makername'),
                'status' => $this->input->post('status')
            );

            $this->upload->do_upload($field_name1);
            $upload_data = $this->upload->data();
            if ($upload_data['file_name'] != '')
                $post_data['maker_logo'] = $upload_data['file_name'];


            $all_data = $this->comman_model->get_data_by_id('tbl_makers', array('id' => $id));

            $result = $this->comman_model->update_data_by_id('tbl_makers', $post_data, 'id', $id);

            if ($result && $post_data['maker_logo']) {

                if (file_exists("assets/uploads/product_maker/" . $all_data['maker_logo']))
                    unlink("assets/uploads/product_maker/" . $all_data['maker_logo']);
            }


            $this->session->set_flashdata('success', 'Product Maker has been successfully updated.');
            redirect('admin/makers');
        }
        $data['edit_data'] = $this->comman_model->get_data_by_id('tbl_makers', array('id' => $id));
        //$data['winners_entry'] = $this->comman_model->get_data_by_id('winner_list',array('serial_id'=>$id));
        $this->load->view('admin/header', $data);
        $this->load->view('admin/left_menu', $data);
        $this->load->view('admin/edit_maker', $data);
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

    function check_lang() {
        $lang = $this->session->all_userdata();
        if (isset($lang['lang'])) {
            if ($lang['lang'] == 'english') {
//				echo 'eng';
                $this->lang->load("common", "english");
                $this->lang->load("admin", "english");
            } else if ($lang['lang'] == 'russian') {
                //			echo 'rus';
                $this->lang->load("common", "russian");
                $this->lang->load("admin", "russian");
            }
        } else {
            //		echo 'eng';
            $this->lang->load("common", "english");
            $this->lang->load("admin", "english");
        }
    }

}

/* End of file admin.php */
/* Location: ./application/controllers/admin.php */