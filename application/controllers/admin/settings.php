<?php

error_reporting(E_ALL);

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Settings extends CI_Controller {

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
        $this->load->helper('common_helper');
        $this->load->helper('language');
        $this->load->language('career');
        //$this->clear_cache();
    }

	function index() {
		
        $data = array();
        $data['login'] = $this->session->all_userdata();
        $data['title'] = 'Welcome To CompanyName';
        $data['active'] = 'home';
        if ($this->input->post('settings')) {
                $post_data = array(
                    'is_product_selectall' => $this->input->post('is_product_selectall'),
                    'pagination_limit' => $this->input->post('pagination_limit'),
                    'pagination_limit_product_list' => $this->input->post('pagination_limit_product_list'),
                    'pagination_limit_product_list_frist_page' => $this->input->post('pagination_limit_product_list_frist_page'),                        
                );
            
            //$all_data = $this->comman_model->get_data_by_id('settings', array('id' => 1));

            $result = $this->comman_model->update_data_by_id('settings', $post_data, 'id', 1);

			$this->session->set_flashdata('success', 'Settings has been successfully updated.');
			redirect('admin/settings/index');
        }
        $data['edit_data'] = $this->comman_model->get_data_by_id('settings', array('id' => 1));
        $this->load->view('admin/header', $data);
        $this->load->view('admin/left_menu', $data);
        $this->load->view('admin/edit_settings', $data);
        $this->load->view('admin/footer', $data);
    }
	
}

/* End of file admin.php */
/* Location: ./application/controllers/admin.php */
