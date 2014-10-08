<?php
error_reporting(E_ALL);

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Distribution extends CI_Controller {

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
        $this->load->language("admin/distribution");
        $this->check_lang();
        $this->validateLogin();
    }

//  Landing page of admin section.
    function index() {
        
        $data = array();
        $data['login'] = $this->session->all_userdata();
        $data['title'] = 'Welcome To CompanyName';
        $data['active'] = 'd_blocks';
        $data['name'] = 'distribution';

        $this->load->view('admin/header', $data);
        $this->load->view('admin/left_menu', $data);
        //$this->load->view('admin/d_blocks_list', $data);
        $this->load->view('admin/home_page', $data);
        $this->load->view('admin/footer', $data);
    }

    function user_list() {
        
        $data = array();
        $data['login'] = $this->session->all_userdata();
        $data['title'] = 'Welcome To CompanyName';
        $data['active'] = 'd_blocks';


        $data['all_data'] = $this->comman_model->all_data('distribution_form');
        $select_param = "*";
        $where_param = array();
        $data['all_data'] = $this->block_list_email->get_row_in_array('distribution_form', $select_param, $where_param);
//        print_r($data['all_data']);

        $this->load->view('admin/header', $data);
        $this->load->view('admin/left_menu', $data);
        $this->load->view('admin/distribution_list', $data);
        $this->load->view('admin/footer', $data);
    }

    function distribution_blocks_list() {
        
        
        $data = array();
        $data['login'] = $this->session->all_userdata();
        $data['title'] = 'Welcome To CompanyName';
        $data['active'] = 'd_blocks';


        $data['all_data'] = $this->comman_model->all_data('tbl_dist_app_support');
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

    function disDeleteAll() {
        $data = array();
        $data['login'] = $this->session->all_userdata();
        $this->validateLogin();

        $ids = $this->input->post('ids');


        foreach ($ids as $id) {
            $table = "distribution_form";
            $where['id'] = $id;
            $delete_row = $this->block_list_email->delete_row($table, $where);
        }

        echo "Successfully Delete";
        exit;
    }

    function delete($id = false, $is_ajax=false) {
        $data = array();
        $data['login'] = $this->session->all_userdata();
        $this->validateLogin();


        $this->blocksDeleteById($id);
        
        if($is_ajax === true){
           echo "success";exit; 
        }
		
        $this->session->set_flashdata('success', 'Block has been removed successfully.');
        redirect('admin/distribution/distribution_blocks_list');
    }

    function delete_distribution($id = false, $is_ajax = false) {

        $data = array();
        $data['login'] = $this->session->all_userdata();
        $this->validateLogin();
        
		 //lookup distribution id, get record
		$tmp_distribution_form = $this->comman_model->get_data_by_id('distribution_form', array('id' => $id));
		
		
		
        $table = "distribution_form";
        $where['id'] = $id;
        $delete_row = $this->block_list_email->delete_row($table, $where);
        
        
        //check if distribution attachment is present
        if ($tmp_distribution_form && is_array($tmp_distribution_form))
        {
			if (isset($tmp_distribution_form['license']) && !empty($tmp_distribution_form['license']))
			{
				$tmp_filename = $_SERVER['DOCUMENT_ROOT']."/mia/assets/uploads/licenses/".$tmp_distribution_form['license'];
				
				print($tmp_filename);
				
				// make sure there is a file on hd
				if (file_exists($tmp_filename))
				{
					// found an attachment, lets remove it
					unlink($tmp_filename);
				}
				
			}
			
		}
		
                if($is_ajax){
                    echo "success";exit;
                }
		        
               $this->session->set_flashdata('success', 'Distribution has been removed successfully.');
        redirect('admin/distribution/user_list');
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
    
    function download_file($files = false) {
       
        $file_name = 'assets/uploads/licenses/' . $files;
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
    }

    function deleteAll(){
        $data = array();
        
        $data['login'] = $this->session->all_userdata();
        $this->validateLogin();

        $block_ids = $this->input->post('block_ids');
        $table = $this->input->post('table');         
        $field = $this->input->post('field'); 
        $where_field = $this->input->post('where_field'); 
        if(empty($field)){
            $field = 'str_email';
        }
        if(empty($where_field)){
            $where_field = 'int_id';
        }
        /******** get all block email and delete all email from block list start by razib 4axiz ******/
        
        $fields = array($field);
        $all_datas = $this->comman_model->getAllById($table, $block_ids,$fields, $where_field); 
        
        if ($all_datas) {   
                $str_email_array = array();             
                foreach($all_datas as $all_data){
                    $str_email_array[] = $all_data[$field];
               }
               $this->comman_model->deleteAllById('block_email_list', $str_email_array,'str_email');
               //$this->comman_model->deleteAllById('block_users', $str_email_array,'email');
           }

        /******** get all block email and delete all email from block list end by razib 4axiz ******/        

        /******** delete all user from apply_form by razib 4axiz ******/
        $result = $this->comman_model->deleteAllById($table, $block_ids,$where_field); 

        echo "Successfully Delete";
        exit;
    }
}

/* End of file admin.php */
/* Location: ./application/controllers/admin.php */
