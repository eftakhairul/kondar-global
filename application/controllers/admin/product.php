<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Product extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
        $this->load->model('admin_model');
        $this->load->model('comman_model');
        $this->load->model('serial_model');
        $this->load->model('product_model');
        $this->load->helper('date');
        $this->load->helper('form');
        $this->load->library('session');
        $this->load->helper('language');
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
        $data['title'] = 'Products';
        $data['active'] = 'product';
        if ($this->input->post('DeleteAll')) {

            $this->product_model->deleteallproducts();

            $files = glob('assets/uploads/product_images/*'); // get all file names
            foreach ($files as $file) { // iterate files
                if (is_file($file))
                    unlink($file); // delete file
            }
        }
        if ($this->input->post('DeleteSelected')) {

            $selectedproductstodelete = $this->input->post('deleteitem');

            //var_dump($selectedproductstodelete);

            foreach ($selectedproductstodelete as $productstodelete) {

                $all_data = $this->comman_model->get_data_by_id('tbl_products', array('id' => $productstodelete));

                $result = $this->product_model->deleteSelectedproducts($productstodelete);

                if ($result) {

                    if (file_exists("assets/uploads/product_images/" . $all_data['drawing_photo']))
                        unlink("assets/uploads/product_images/" . $all_data['drawing_photo']);


                    if (file_exists("assets/uploads/product_images/" . $all_data['product_photo']))
                        unlink("assets/uploads/product_images/" . $all_data['product_photo']);

                    if (file_exists("assets/uploads/product_images/" . $all_data['vehicle_photo']))
                        unlink("assets/uploads/product_images/" . $all_data['vehicle_photo']);
                }
            }

            $this->session->set_flashdata('success', 'Product successfully deleted.');
            ///todo
            redirect('admin/product');
        }

        $key = $this->input->post('search');
        $data['all_data'] = $this->product_model->search_product_data('tbl_products', $key, 'kgt_ref_number', 'knect');
        $data['search'] = $key;

        //$data['all_data'] = $this->serial_model->search_serial_data('tbl_products',$key,'kgt_ref_number','knect');
        $this->load->view('admin/header', $data);
        $this->load->view('admin/left_menu', $data);
        $this->load->view('admin/product_list', $data);
        $this->load->view('admin/footer', $data);
    }

    function delete($id) {

        $result = $this->comman_model->delete_by_id('serial_code', array('id' => $id));
        $this->session->set_flashdata('success', 'Serial code has successfully deleted.');
        redirect('admin/serial');
    }

    function delete_product($id) {

        $all_data = $this->comman_model->get_data_by_id('tbl_products', array('id' => $id));

        $result = $this->comman_model->delete_winner_id('tbl_products', array('id' => $id));


        if ($result) {

            if (file_exists("assets/uploads/product_images/" . $all_data['drawing_photo']))
                unlink("assets/uploads/product_images/" . $all_data['drawing_photo']);


            if (file_exists("assets/uploads/product_images/" . $all_data['product_photo']))
                unlink("assets/uploads/product_images/" . $all_data['product_photo']);

            if (file_exists("assets/uploads/product_images/" . $all_data['vehicle_photo']))
                unlink("assets/uploads/product_images/" . $all_data['vehicle_photo']);
        }

        $this->session->set_flashdata('success', 'Product successfully deleted.');
        redirect('admin/product');
    }

    function add_product() {
        
        $this->check_lang();
        $this->validateLogin();
        
        $data = array();
        $data['login'] = $this->session->all_userdata();
        $data['title'] = 'Products';
        $data['active'] = 'product';
        $data['sub_menu'] = 'add_article';
        if ($this->input->post('operation')) {

            $field_name1 = 'drawing_photo';
            $field_name2 = 'product_photo';
            $field_name3 = 'vehicle_photo';
            $config['upload_path'] = './assets/uploads/product_images';
            $config['allowed_types'] = 'gif|jpg|png|pdf';
            $config['max_size'] = '1024';
            $config['max_width'] = '100000';
            $config['max_height'] = '10000';
            $this->load->library('upload', $config);



            /* $post_data = array(
              'kgt_ref_number' =>$this->input->post('kgt_ref_number'),
              'vehicle_category_id' =>$this->input->post('vehicle_category_id'),
              'maker_id' =>$this->input->post('maker_id'),
              'model_id' =>$this->input->post('model_id'),
              'product_type_id' =>$this->input->post('product_type_id'),
              'knect' =>$this->input->post('knect'),
              'filtron' =>$this->input->post('filtron'),
              'purflux' =>$this->input->post('purflux'),
              'mann' =>$this->input->post('mann'),
              'mecafilter' =>$this->input->post('mecafilter'),
              'oem_part_number' =>$this->input->post('oem_part_number'),
              'application' =>$this->input->post('application'),
              'fleet' =>$this->input->post('fleet'),
              'baldwin' =>$this->input->post('baldwin'),
              'others' =>$this->input->post('others'),
              'fmsi_ref_number' =>$this->input->post('fmsi_ref_number'),
              'year' =>$this->input->post('year'),
              'front_rear' =>$this->input->post('front_rear'),
              'designation' =>$this->input->post('designation'),
              'wva' =>$this->input->post('wva'),
              'qty' =>$this->input->post('qty'),
              'diameter' =>$this->input->post('diameter'),
              'width' =>$this->input->post('width'),
              'holes_no' =>$this->input->post('holes_no')
              ); */


            if ($this->input->post('kgt_ref_number'))
                $post_data['kgt_ref_number'] = $this->input->post('kgt_ref_number');
            if ($this->input->post('vehicle_category_id'))
                $post_data['vehicle_category_id'] = $this->input->post('vehicle_category_id');
            if ($this->input->post('maker_id'))
                $post_data['maker_id'] = $this->input->post('maker_id');
            if ($this->input->post('model_id'))
                $post_data['model_id'] = $this->input->post('model_id');
            if ($this->input->post('product_type_id'))
                $post_data['product_type_id'] = $this->input->post('product_type_id');
            if ($this->input->post('knect'))
                $post_data['knect'] = $this->input->post('knect');
            if ($this->input->post('filtron'))
                $post_data['filtron'] = $this->input->post('filtron');
            if ($this->input->post('purflux'))
                $post_data['purflux'] = $this->input->post('purflux');
            if ($this->input->post('mann'))
                $post_data['mann'] = $this->input->post('mann');
            if ($this->input->post('mecafilter'))
                $post_data['mecafilter'] = $this->input->post('mecafilter');
            if ($this->input->post('oem_part_number'))
                $post_data['oem_part_number'] = $this->input->post('oem_part_number');
            if ($this->input->post('application'))
                $post_data['application'] = $this->input->post('application');
            if ($this->input->post('fleet'))
                $post_data['fleet'] = $this->input->post('fleet');
            if ($this->input->post('baldwin'))
                $post_data['baldwin'] = $this->input->post('baldwin');
            if ($this->input->post('others'))
                $post_data['others'] = $this->input->post('others');
            if ($this->input->post('fmsi_ref_number'))
                $post_data['fmsi_ref_number'] = $this->input->post('fmsi_ref_number');
            if ($this->input->post('year'))
                $post_data['year'] = $this->input->post('year');
            if ($this->input->post('front_rear'))
                $post_data['front_rear'] = $this->input->post('front_rear');
            if ($this->input->post('designation'))
                $post_data['designation'] = $this->input->post('designation');
            if ($this->input->post('wva'))
                $post_data['wva'] = $this->input->post('wva');
            if ($this->input->post('qty'))
                $post_data['qty'] = $this->input->post('qty');
            if ($this->input->post('diameter'))
                $post_data['diameter'] = $this->input->post('diameter');
            if ($this->input->post('width'))
                $post_data['width'] = $this->input->post('width');
            if ($this->input->post('holes_no'))
                $post_data['holes_no'] = $this->input->post('holes_no');


            $this->upload->do_upload($field_name1);
            $upload_data = $this->upload->data();
            if ($upload_data['file_name'])
                $post_data['drawing_photo'] = $upload_data['file_name'];

            $this->upload->do_upload($field_name2);
            $upload_data = $this->upload->data();
            if ($upload_data['file_name'])
                $post_data['product_photo'] = $upload_data['file_name'];

            $this->upload->do_upload($field_name3);
            $upload_data = $this->upload->data();
            if ($upload_data['file_name'])
                $post_data['vehicle_photo'] = $upload_data['file_name'];

            $result = $this->comman_model->add('tbl_products', $post_data);
            $this->session->set_flashdata('success', 'Product has been successfully added.');
            redirect('admin/product');
        }
        $data['product_catagory'] = $this->product_model->getallvehiclecategory_data('tbl_vehicle_categories');
        $data['product_makers'] = $this->comman_model->all_data('tbl_makers');
        $data['product_models'] = $this->comman_model->all_data('tbl_models');
        //$data['product_types'] = $this->comman_model->all_data('tbl_product_types');	
        $data['product_types'] = $this->product_model->getall_producttype_data('tbl_product_types');
        //var_dump($data['product_types']);		
        $this->load->view('admin/header', $data);
        $this->load->view('admin/left_menu', $data);
        $this->load->view('admin/add_product', $data);
        $this->load->view('admin/footer', $data);
    }

    function edit_product($id = false) {
        
        $this->check_lang();
        $this->validateLogin();
        
        if (!$id) {
            redirect('admin/serial');
        }
        $this->validateLogin();
        $data = array();
        $data['login'] = $this->session->all_userdata();
        $data['title'] = 'Product';

        $edit_data = $this->comman_model->get_data_by_id('serial_code', array('id' => $id));


        //if($edit_data["status"] != $this->input->post('status'))
        if ($this->input->post('status') == '1') {
            //$serial_code_id = $this->comman_model->get_data_by_id('serial_code',array('code'=>$edit_data["id"]));
            $this->comman_model->delete_blocked_id('winner_list', array('serial_id' => $edit_data["id"]));
        }


        if ($this->input->post('operation')) {

            $field_name1 = 'drawing_photo';
            $field_name2 = 'product_photo';
            $field_name3 = 'vehicle_photo';
            $config['upload_path'] = './assets/uploads/product_images';
            $config['allowed_types'] = 'gif|jpg|png|pdf|jpeg';
            $config['max_size'] = '1024';
            $config['max_width'] = '100000';
            $config['max_height'] = '10000';
            $this->load->library('upload', $config);

            /* $post_data = array(
              'kgt_ref_number' =>$this->input->post('kgt_ref_number'),
              'vehicle_category_id' =>$this->input->post('vehicle_category_id'),
              'maker_id' =>$this->input->post('maker_id'),
              'model_id' =>$this->input->post('model_id'),
              'product_type_id' =>$this->input->post('product_type_id'),
              'knect' =>$this->input->post('knect'),
              'filtron' =>$this->input->post('filtron'),
              'purflux' =>$this->input->post('purflux'),
              'mann' =>$this->input->post('mann'),
              'mecafilter' =>$this->input->post('mecafilter'),
              'oem_part_number' =>$this->input->post('oem_part_number'),
              'application' =>$this->input->post('application'),
              'fleet' =>$this->input->post('fleet'),
              'baldwin' =>$this->input->post('baldwin'),
              'others' =>$this->input->post('others'),
              'fmsi_ref_number' =>$this->input->post('fmsi_ref_number'),
              'year' =>$this->input->post('year'),
              'front_rear' =>$this->input->post('front_rear'),
              'designation' =>$this->input->post('designation'),
              'wva' =>$this->input->post('wva')
              ); */
            /* $this->upload->do_upload($field_name1);
              $upload_data	= $this->upload->data();
              if($upload_data['file_name']!="")
              $post_data['drawing_photo'] =$upload_data['file_name'];
              $upload_data ="";

              $this->upload->initialize($config);

              $this->upload->do_upload($field_name2);
              $upload_data	= $this->upload->data();
              if($upload_data['file_name']!="")
              $post_data['product_photo'] =$upload_data['file_name'];

              $result = $this->comman_model->update_data_by_id('tbl_products',$post_data,'id',$id);
              $this->session->set_flashdata('success', 'Product has been successfully updated.');
              redirect('product'); */

//		----------------------------------------------		

            if ($this->input->post('kgt_ref_number'))
                $post_data['kgt_ref_number'] = $this->input->post('kgt_ref_number');
            if ($this->input->post('vehicle_category_id'))
                $post_data['vehicle_category_id'] = $this->input->post('vehicle_category_id');
            if ($this->input->post('maker_id'))
                $post_data['maker_id'] = $this->input->post('maker_id');
            if ($this->input->post('model_id'))
                $post_data['model_id'] = $this->input->post('model_id');
            if ($this->input->post('product_type_id'))
                $post_data['product_type_id'] = $this->input->post('product_type_id');
            if ($this->input->post('knect'))
                $post_data['knect'] = $this->input->post('knect');
            if ($this->input->post('filtron'))
                $post_data['filtron'] = $this->input->post('filtron');
            if ($this->input->post('purflux'))
                $post_data['purflux'] = $this->input->post('purflux');
            if ($this->input->post('mann'))
                $post_data['mann'] = $this->input->post('mann');
            if ($this->input->post('mecafilter'))
                $post_data['mecafilter'] = $this->input->post('mecafilter');
            if ($this->input->post('oem_part_number'))
                $post_data['oem_part_number'] = $this->input->post('oem_part_number');
            if ($this->input->post('application'))
                $post_data['application'] = $this->input->post('application');
            if ($this->input->post('fleet'))
                $post_data['fleet'] = $this->input->post('fleet');
            if ($this->input->post('baldwin'))
                $post_data['baldwin'] = $this->input->post('baldwin');
            if ($this->input->post('others'))
                $post_data['others'] = $this->input->post('others');
            if ($this->input->post('fmsi_ref_number'))
                $post_data['fmsi_ref_number'] = $this->input->post('fmsi_ref_number');
            if ($this->input->post('year'))
                $post_data['year'] = $this->input->post('year');
            if ($this->input->post('front_rear'))
                $post_data['front_rear'] = $this->input->post('front_rear');
            if ($this->input->post('designation'))
                $post_data['designation'] = $this->input->post('designation');
            if ($this->input->post('wva'))
                $post_data['wva'] = $this->input->post('wva');
            if ($this->input->post('qty'))
                $post_data['qty'] = $this->input->post('qty');
            if ($this->input->post('diameter'))
                $post_data['diameter'] = $this->input->post('diameter');
            if ($this->input->post('width'))
                $post_data['width'] = $this->input->post('width');
            if ($this->input->post('holes_no'))
                $post_data['holes_no'] = $this->input->post('holes_no');

            $this->upload->do_upload($field_name1);
            $upload_data = $this->upload->data();
            if ($upload_data['file_name'])
                $post_data['drawing_photo'] = $upload_data['file_name'];
            $upload_data = "";

            $this->upload->initialize($config);

            $this->upload->do_upload($field_name2);
            $upload_data = $this->upload->data();
            if ($upload_data['file_name'])
                $post_data['product_photo'] = $upload_data['file_name'];

            $this->upload->do_upload($field_name3);
            $upload_data = $this->upload->data();
            if ($upload_data['file_name'])
                $post_data['vehicle_photo'] = $upload_data['file_name'];


            $all_data = $this->comman_model->get_data_by_id('tbl_products', array('id' => $id));

            $result = $this->comman_model->update_data_by_id('tbl_products', $post_data, 'id', $id);

            //print_r($all_data);

            if ($result) {

                if ($post_data['drawing_photo']) {

                    if (file_exists("assets/uploads/product_images/" . $all_data['drawing_photo']))
                        unlink("assets/uploads/product_images/" . $all_data['drawing_photo']);
                }

                if ($post_data['product_photo']) {

                    if (file_exists("assets/uploads/product_images/" . $all_data['product_photo']))
                        unlink("assets/uploads/product_images/" . $all_data['product_photo']);
                }

                if ($post_data['vehicle_photo']) {

                    if (file_exists("assets/uploads/product_images/" . $all_data['vehicle_photo']))
                        unlink("assets/uploads/product_images/" . $all_data['vehicle_photo']);
                }
            }

            $this->session->set_flashdata('success', 'Product has been successfully updated.');
            redirect('admin/product');
        }

        $data['product_catagory'] = $this->product_model->getallvehiclecategory_data('tbl_vehicle_categories');
        $data['product_makers'] = $this->comman_model->all_data('tbl_makers');
        $data['product_models'] = $this->comman_model->all_data('tbl_models');
        $data['product_types'] = $this->product_model->getall_producttype_data('tbl_product_types');
        $data['edit_data'] = $this->comman_model->get_data_by_id('tbl_products', array('id' => $id));
        $data['winners_entry'] = $this->comman_model->get_data_by_id('winner_list', array('serial_id' => $id));
        $this->load->view('admin/header', $data);
        $this->load->view('admin/left_menu', $data);
        $this->load->view('admin/edit_product', $data);
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