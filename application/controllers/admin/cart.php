<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cart extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
        $this->load->model('admin_model');
        $this->load->model('comman_model');
        $this->load->model('serial_model');
        $this->load->model('cart_model');
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
        $data['title'] = 'List Order Details';
        $data['active'] = 'cart';

        $key = $this->input->post('search');

        //$data['all_data'] = $this->comman_model->all_data('cart_users');
        $data['all_data'] = $this->cart_model->get_cart_details();

        $this->load->view('admin/header', $data);
        $this->load->view('admin/left_menu', $data);
        $this->load->view('admin/cart_list', $data);
        $this->load->view('admin/footer', $data);
    }

    function deleteAll(){
        $data = array();
        $data['login'] = $this->session->all_userdata();
        $this->validateLogin();

        $block_ids = $this->input->post('block_ids');
        $table = $this->input->post('table'); 

        
        /******** delete all user from apply_form by razib 4axiz ******/
        $result = $this->comman_model->deleteAllById($table, $block_ids); 
        $this->comman_model->deleteAllById('cart', $block_ids,'user_id');


        echo "Successfully Delete";
        exit;
    }

    function delete($id) {

        $result = $this->comman_model->delete_by_id('cart_users', array('id' => $id));
        $result = $this->comman_model->delete_by_id('cart', array('user_id' => $id));
        $this->session->set_flashdata('success', 'Order has successfully deleted.');
        redirect('admin/cart');
    }

    /* function delete_winner($id)
      {
      $result = $this->comman_model->delete_winner_id('winner_list',array('id'=>$id));
      $this->session->set_flashdata('success','Winner successfully deleted.');
      redirect('serial/winners');
      } */

    function listcart($id = false) {
        $this->check_lang();
        $this->validateLogin();
        $data = array();
        $data['login'] = $this->session->all_userdata();
        $data['title'] = 'List Order Details';
        $data['active'] = 'cart';

        //$data['menu_privilage'] = $this->cart_model->get_menuprivilage_by_type($id);
        $data['main_data'] = $this->cart_model->get_cart_detailsbyid($id);
        $data['all_data'] = $this->cart_model->get_data_by_id($id);
        //var_dump($data['all_data']);
        //var_dump($data['main_data']);
        //var_dump($data['all_data']);exit;
        //$data['all_data'] = $this->cart_model->get_data_by_id('serial_code',array('id'=>$id));

        $this->load->view('admin/header', $data);
        $this->load->view('admin/left_menu', $data);
        $this->load->view('admin/list_cart_details', $data);
        //$this->load->view('admin/testfile',$data);
        $this->load->view('admin/footer', $data);
    }

    function add_serial() {

        $this->validateLogin();
        $data = array();
        $data['login'] = $this->session->all_userdata();
        $data['title'] = 'Serial Code';
        $data['active'] = 'serial';
        $data['sub_menu'] = 'add_article';
        if ($this->input->post('operation')) {
            $post_data = array(
                'title' => $this->input->post('title'),
                'code' => $this->input->post('code'),
                'part_number' => $this->input->post('part_number'),
                'status' => $this->input->post('status'),
                'created_date' => date('Y-m-d')
            );
            $result = $this->comman_model->add('serial_code', $post_data);
            $this->session->set_flashdata('success', 'Serial Code has been successfully added.');
            redirect('admin/serial');
        }
        $this->load->view('admin/header', $data);
        $this->load->view('admin/left_menu', $data);
        $this->load->view('admin/add_serial', $data);
        $this->load->view('admin/footer', $data);
    }

    function edit_serial($id = false) {
        if (!$id) {
            redirect('admin/serial');
        }
        $this->validateLogin();
        $data = array();
        $data['login'] = $this->session->all_userdata();
        $data['title'] = 'Serial code';

        $edit_data = $this->comman_model->get_data_by_id('serial_code', array('id' => $id));



        //if($edit_data["status"] != $this->input->post('status'))
        if ($this->input->post('status') == '1') {
            //$serial_code_id = $this->comman_model->get_data_by_id('serial_code',array('code'=>$edit_data["id"]));
            $this->comman_model->delete_blocked_id('winner_list', array('serial_id' => $edit_data["id"]));
        }




        if ($this->input->post('operation')) {
            $post_data = array(
                'title' => $this->input->post('title'),
                'code' => $this->input->post('code'),
                'part_number' => $this->input->post('part_number'),
                'status' => $this->input->post('status')
            );

            $result = $this->comman_model->update_data_by_id('serial_code', $post_data, 'id', $id);
            $this->session->set_flashdata('success', 'Serial Code has been successfully updated.');
            redirect('admin/serial');
        }
        $data['edit_data'] = $this->comman_model->get_data_by_id('serial_code', array('id' => $id));
        $data['winners_entry'] = $this->comman_model->get_data_by_id('winner_list', array('serial_id' => $id));
        $this->load->view('admin/header', $data);
        $this->load->view('admin/left_menu', $data);
        $this->load->view('admin/edit_serial', $data);
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
        $this->check_lang();
        $this->validateLogin();
        $data = array();
        $data['login'] = $this->session->all_userdata();
        $data['title'] = 'Order Blocked Users List';
        $data['active'] = 'cart_blocked';

        //$data['all_data'] = $this->comman_model->get_list_by_group('block_users','email');
        $data['all_data'] = $this->cart_model->getBlockDetails();

        $this->load->view('admin/header', $data);
        $this->load->view('admin/left_menu', $data);
        $this->load->view('admin/cart_blocked_list', $data);
        $this->load->view('admin/footer', $data);
    }

    function delete_blocked($id) {
        $where = 'status';
        $data = $this->comman_model->get_tabledata_by_id('cart_block_users', $id, $where);
        foreach ($data as $item) {
            $this->comman_model->delete_block_email_list_by_id($item['email']);
        }
        $result = $this->comman_model->delete_blocked_id('cart_block_users', array('id' => $id));
        $this->session->set_flashdata('success', 'Blocked user successfully deleted.');
        redirect('admin/cart/blocked');
    }

    function delete_blocked_all() {
        $result = $this->comman_model->delete_blocked_all('cart_block_users');
        $this->session->set_flashdata('success', 'Deleted all blocked users.');
        redirect('admin/cart/blocked');
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
