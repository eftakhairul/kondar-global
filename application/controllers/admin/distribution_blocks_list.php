<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Distribution_blocks_list extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
        $this->load->model('admin_model');
        $this->load->model('comman_model');
        $this->load->helper('date');
        $this->load->helper('form');
        $this->load->library('session');
        $this->load->library("pagination");
        $this->load->model("block_list_email");
    }

//  Landing page of admin section.
    function index() {
        $this->check_lang();
        $this->validateLogin();
        $data = array();
        $data['login'] = $this->session->all_userdata();
        $data['title'] = 'Welcome To CompanyName';
        $data['active'] = 'd_blocks';

        //$data['all_data'] = $this->comman_model->all_data('tbl_dist_app_support');
        $select_param = "*";
        $where_param = array();
        $data['all_data'] = $this->block_list_email->get_row_in_array('tbl_dist_app_support', $select_param, $where_param);

        $this->load->view('admin/header', $data);
        $this->load->view('admin/left_menu', $data);
        $this->load->view('admin/d_blocks_list', $data);
        $this->load->view('admin/footer', $data);
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

//  This function is used to check the login of admin.
    function validateLogin() {
        $this->check_lang();
        $logged_in = $this->session->userdata('logged_in');
        if ((isset($logged_in) || $logged_in == true)) {
            if ($logged_in != "admin") {
                redirect('/admin/index/login', 'refresh');
            }
        } else {
            redirect('/admin/index/login', 'refresh');
        }
    }

    function blocksDeleteAll() {
        $data = array();
        $data['login'] = $this->session->all_userdata();
        $this->validateLogin();

        $block_ids = $this->input->post('block_ids');
        //if(is_array($block_ids)){

        foreach ($block_ids as $block_id) {
            $this->blocksDeleteById($block_id);
        }
        //}
        echo "Successfully Delete";
        exit;
    }

    function delete($id = false) {
        $data = array();
        $data['login'] = $this->session->all_userdata();
        $this->validateLogin();

        $this->blocksDeleteById($id);

        $this->session->set_flashdata('success', 'Block has been removed successfully.');
        redirect('admin/distribution_blocks_list');
    }

    function blocksDeleteById($id) {
        $table = "tbl_dist_app_support";
        $table2 = 'block_email_list';
        $where['int_id'] = $id;
        $select = '*';       
        $d_table_data = $this->block_list_email->get_row($table, $select, $where);
        $email = $d_table_data[0]->str_email;
        $where_param['str_email'] = $email;
        $where_param['region'] = 'Distribution';
        $data['delete_row'] = $this->block_list_email->delete_row($table, $where);
        $this->comman_model->delete_by_id($table2, $where_param);
    }

}

/* End of file admin.php */
/* Location: ./application/controllers/admin.php */