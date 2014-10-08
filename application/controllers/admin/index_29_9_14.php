<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Index extends CI_Controller {

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
        $this->clear_cache();
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

    //  Landing page of admin section.
    function index() {
        $this->check_lang();
        $this->validateLogin();
        $data['active'] = 'dashboard';
        $data['title'] = 'Admin Dashboard';
        $data['login'] = $this->session->all_userdata();

        $this->load->view('admin/header', $data);
        $this->load->view('admin/left_menu', $data);
        $this->load->view('admin/dashboard', $data);
        //$this->load->view('admin/content',$data);
        //$this->load->view('admin/add_tip_of_day',$data);
        $this->load->view('admin/footer', $data);
    }

    function clear_cache() {
        $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
        $this->output->set_header("Pragma: no-cache");
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

    function dashboard() {
        $this->check_lang();
        $this->validateLogin();
        $data = array();
        $data['active'] = 'dashboard';
        $data['title'] = 'Admin Dashboard';
        $data['login'] = $this->session->all_userdata();

        $this->load->view('admin/header', $data);
        $this->load->view('admin/left_menu', $data);
        $this->load->view('admin/dashboard', $data);
        //$this->load->view('admin/content',$data);
        //$this->load->view('admin/add_tip_of_day',$data);
        $this->load->view('admin/footer', $data);
    }

    function login() {
        //$this->validateLogin();
        /* 		if($this->session->userdata('logged_in'))
          {
          redirect('/admin');
          }
         */
        $this->check_lang();
        $data = array();
        $error = '';
        if ($this->input->post('operation')) {
            $email = $this->input->post('username');
            $password = $this->input->post('password');
            if (trim($this->input->post('username') == "")) {
                $error .="Please enter email!<br />";
            }
            if (trim($this->input->post('password') == "")) {
                $error .="Please enter password!<br />";
            }
            if ($error == '') {
                $valid_login = $this->admin_model->verifyUserLogin($email, $password);
                if (!empty($valid_login)) {
                    $session_data = array(
                        'logged_in' => 'admin',
                        'login' => true,
                        'admin_email' => $valid_login['email'],
                        'admin_id' => $valid_login['id']
                    );
                    //print_r($session_data);
                    $this->session->set_userdata($session_data);
                    redirect('/admin/index/dashboard');
                } else {
                    $error .= "Invalid email address or password";
                }
            }
        }
        $data['error'] = $error;
        $data['title'] = 'Admin Login';
        $this->load->view('admin/header', $data);
        $this->load->view('admin/login', $data);
    }

    function send_mail() {
        $this->check_lang();
        $this->validateLogin();
        $data = array();
        $data['title'] = 'Welcome To CompanyName';
        $data['login'] = $this->session->all_userdata();
        $data['active'] = 'mail';
        if ($this->input->post('operation')) {
            $user_data = $this->comman_model->all_data('user');
            $str = '';
            foreach ($user_data as $set_data) {
                $str = $set_data['email'] . ',' . $str;
            }
            $user = rtrim($str, ',');
            $title = $this->input->post('title');
            $subject = $this->input->post('subject');
            $msge = $this->input->post('description');
            $this->load->library('email');
            $this->email->from('sushant.goralkar@gmail.com', $title);
            //$this->email->to('sushant.goralkar@gmail.com');
            $this->email->to($user);
            $this->email->subject($subject);
            $this->email->message($msge);
            $this->email->send();
            $this->session->set_flashdata('success', 'Your Mail has successfully sent.');
            redirect('admin/index/send_mail');
        }
        $this->load->view('admin/header', $data);
        $this->load->view('admin/left_menu', $data);
        $this->load->view('admin/send_mail', $data);
        //$this->load->view('admin/content',$data);
        //$this->load->view('admin/add_tip_of_day',$data);
        $this->load->view('admin/footer', $data);
    }

    function all_home_page() {
        $this->check_lang();
        $this->validateLogin();
        $data = array();
        $data['title'] = 'Welcome To CompanyName';
        $data['login'] = $this->session->all_userdata();
        $data['active'] = 'home';
        $data['name'] = 'Home Page';
        $this->load->view('admin/header', $data);
        $this->load->view('admin/left_menu', $data);
        $this->load->view('admin/home_page', $data);
        //$this->load->view('admin/content',$data);
        //$this->load->view('admin/add_tip_of_day',$data);
        $this->load->view('admin/footer', $data);
    }

    function all_welcome_page() {
        $this->check_lang();
        $this->validateLogin();
        $data = array();
        $data['title'] = 'Welcome To CompanyName';
        $data['login'] = $this->session->all_userdata();
        $data['active'] = 'welcome';
        $data['name'] = 'Welcome Page';
        $this->load->view('admin/header', $data);
        $this->load->view('admin/left_menu', $data);
        $this->load->view('admin/home_page', $data);
        //$this->load->view('admin/content',$data);
        //$this->load->view('admin/add_tip_of_day',$data);
        $this->load->view('admin/footer', $data);
    }

    function library_page() {
        $this->check_lang();
        $this->validateLogin();
        $data = array();
        $data['title'] = 'Welcome To CompanyName';
        $data['login'] = $this->session->all_userdata();
        $data['active'] = 'home';
        $data['all_data'] = $this->comman_model->all_data('home_page');
        $this->load->view('admin/header', $data);
        $this->load->view('admin/left_menu', $data);
        $this->load->view('admin/library_list', $data);
        //$this->load->view('admin/content',$data);
        //$this->load->view('admin/add_tip_of_day',$data);
        $this->load->view('admin/footer', $data);
    }

    function welcome_page() {
        $this->check_lang();
        $this->validateLogin();
        $data = array();
        $data['title'] = 'Welcome To CompanyName';
        $data['login'] = $this->session->all_userdata();
        $data['active'] = 'welcome';
        $data['all_data'] = $this->comman_model->all_data('home_page');
        $this->load->view('admin/header', $data);
        $this->load->view('admin/left_menu', $data);
        $this->load->view('admin/welcome_page_list', $data);
        //$this->load->view('admin/content',$data);
        //$this->load->view('admin/add_tip_of_day',$data);
        $this->load->view('admin/footer', $data);
    }

    function edit_welcome_page($action = false, $id = false) {
        $this->check_lang();
        $this->validateLogin();
        if (!$action) {
            redirect('admin/index/welcome_page');
        }
        if (!$id) {
            redirect('admin/index/welcome_page');
        }
        $data = array();
        $data['login'] = $this->session->all_userdata();
        $data['title'] = 'Welcome To CompanyName';
        if ($action == 'library') {
            $data['active'] = 'home';
        } else {
            $data['active'] = 'welcome';
        }

        $data['edit_page'] = $action;
        $data['edit_data'] = $this->comman_model->get_data_by_id('home_page', array('id' => $id));
        if (empty($data['edit_data'])) {
            redirect('admin/index/welcome_page');
        }
        if ($this->input->post('logo')) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('title', 'Title', 'trim|required');
            if ($this->form_validation->run() == FALSE) {
                
            } else {
                if (!empty($_FILES['file']['name'])) {
                    $field_name = 'file';
                    $config['upload_path'] = './assets/uploads/logo/full/';
                    $config['allowed_types'] = 'gif|jpg|png';
                    $config['max_size'] = '800';
                    $config['max_width'] = '2000';
                    $config['max_height'] = '2000';
                    $this->load->library('upload', $config);
                    if (!$this->upload->do_upload($field_name)) {
                        /* 			$error = array('error' => $this->upload->display_errors());
                          $this->load->view('admin/add_upload', $error); */
                        $this->session->set_flashdata('error', $this->upload->display_errors());
                        redirect('admin/index/edit_welcome_page/' . $action . '/' . $id);
                    } else {
                        $upload_data = $this->upload->data();
                        $this->load->library('image_lib');
                        $config['image_library'] = 'gd2';
                        $config['source_image'] = 'assets/uploads/logo/full/' . $upload_data['file_name'];
                        $config['new_image'] = 'assets/uploads/logo/thumbnails/' . $upload_data['file_name'];
                        $config['maintain_ratio'] = TRUE;
                        $config['width'] = 450;
                        $config['height'] = 133;
                        $this->image_lib->initialize($config);
                        $this->image_lib->resize();
                        $this->image_lib->clear();

                        $config['image_library'] = 'gd2';
                        $config['source_image'] = 'assets/uploads/logo/full/' . $upload_data['file_name'];
                        $config['new_image'] = 'assets/uploads/logo/small/' . $upload_data['file_name'];
                        $config['maintain_ratio'] = TRUE;
                        $config['width'] = 100;
                        $config['height'] = 100;
                        $this->image_lib->initialize($config);
                        $this->image_lib->resize();
                        $this->image_lib->clear();
                    }
                }
                $post_data = array(
                    'name' => $this->input->post('title'),
                    'logo' => $upload_data['file_name']);

                $all_data = $this->comman_model->get_data_by_id('home_page', array('id' => $id));

                $result = $this->comman_model->update_by_id('home_page', $post_data, $id);

                if ($result) {

                    if (file_exists("assets/uploads/logo/" . $all_data['logo']))
                        unlink("assets/uploads/logo/" . $all_data['logo']);


                    if (file_exists("assets/uploads/logo/full/" . $all_data['logo']))
                        unlink("assets/uploads/logo/full/" . $all_data['logo']);


                    if (file_exists("assets/uploads/logo/small/" . $all_data['logo']))
                        unlink("assets/uploads/logo/small/" . $all_data['logo']);

                    if (file_exists("assets/uploads/logo/thumbnails/" . $all_data['logo']))
                        unlink("assets/uploads/logo/thumbnails/" . $all_data['logo']);

                    $this->session->set_flashdata('success', 'Logo image has been successfully updated.');

                    redirect('admin/index/welcome_page');
                }
            }
        }

        if ($this->input->post('footer_name')) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('title', 'Title', 'trim|required');
            if ($this->form_validation->run() == FALSE) {
                
            } else {
                $post_data = array('footer_name' => $this->input->post('title'));
                $result = $this->comman_model->update_by_id('home_page', $post_data, $id);
                $this->session->set_flashdata('success', 'Footer has been successfully updated.');
                redirect('admin/index/welcome_page');
            }
        }
        if ($this->input->post('admin_mail')) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('title', 'Title', 'trim|required');
            if ($this->form_validation->run() == FALSE) {
                
            } else {
                $post_data = array('admin_mail' => $this->input->post('title'));
                $result = $this->comman_model->update_by_id('home_page', $post_data, $id);
                $this->session->set_flashdata('success', 'Footer has been successfully updated.');
                redirect('admin/index/welcome_page');
            }
        }
        if ($this->input->post('cart_photo')) {
            if (!empty($_FILES['file']['name'])) {
                $field_name = 'file';
                $config['upload_path'] = './assets/uploads/cart';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = '800';
                $config['max_width'] = '2000';
                $config['max_height'] = '2000';
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload($field_name)) {
                    /* 			$error = array('error' => $this->upload->display_errors());
                      $this->load->view('admin/add_upload', $error); */
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                    redirect('admin/index/edit_welcome_page/' . $action . '/' . $id);
                } else {
                    $upload_data = $this->upload->data();

                    /* $this->load->library('image_lib');
                      $config['image_library'] = 'gd2';
                      $config['source_image'] = 'assets/uploads/footer/full/'.$upload_data['file_name'];
                      $config['new_image']	= 'assets/uploads/footer/thumbnails/'.$upload_data['file_name'];
                      $config['maintain_ratio'] = TRUE;
                      $config['width'] = 760;
                      $config['height'] = 190;
                      $this->image_lib->initialize($config);
                      $this->image_lib->resize();
                      $this->image_lib->clear();

                      $config['image_library'] = 'gd2';
                      $config['source_image'] = 'assets/uploads/footer/full/'.$upload_data['file_name'];
                      $config['new_image'] = 'assets/uploads/footer/small/'.$upload_data['file_name'];
                      $config['maintain_ratio'] = TRUE;
                      $config['width'] = 100;
                      $config['height'] = 100;
                      $this->image_lib->initialize($config);
                      $this->image_lib->resize();
                      $this->image_lib->clear(); */
                }
                $post_data = array('cart_photo' => $upload_data['file_name']);

                $all_data = $this->comman_model->get_data_by_id('home_page', array('id' => $id));

                $result = $this->comman_model->update_by_id('home_page', $post_data, $id);

                if ($result) {

                    if (file_exists("assets/uploads/cart/" . $all_data['cart_photo']))
                        unlink("assets/uploads/cart/" . $all_data['cart_photo']);


                    if (file_exists("assets/uploads/cart/full/" . $all_data['cart_photo']))
                        unlink("assets/uploads/cart/full/" . $all_data['cart_photo']);


                    if (file_exists("assets/uploads/cart/small/" . $all_data['cart_photo']))
                        unlink("assets/uploads/cart/small/" . $all_data['cart_photo']);

                    if (file_exists("assets/uploads/cart/thumbnails/" . $all_data['cart_photo']))
                        unlink("assets/uploads/cart/thumbnails/" . $all_data['cart_photo']);

                    $this->session->set_flashdata('success', 'Cart Image has been successfully updated.');

                    redirect('admin/index/welcome_page');
                }

//                $this->session->set_flashdata('success', 'Cart Image has been successfully updated.');
//                redirect('admin/index/welcome_page');
            }
        }

        if ($this->input->post('footer')) {
            if (!empty($_FILES['file']['name'])) {
                $field_name = 'file';
                $config['upload_path'] = './assets/uploads/footer/full/';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = '800';
                $config['max_width'] = '2000';
                $config['max_height'] = '2000';
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload($field_name)) {
                    /* 			$error = array('error' => $this->upload->display_errors());
                      $this->load->view('admin/add_upload', $error); */
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                    redirect('admin/index/edit_welcome_page/' . $action . '/' . $id);
                } else {
                    $upload_data = $this->upload->data();
                    $this->load->library('image_lib');
                    $config['image_library'] = 'gd2';
                    $config['source_image'] = 'assets/uploads/footer/full/' . $upload_data['file_name'];
                    $config['new_image'] = 'assets/uploads/footer/thumbnails/' . $upload_data['file_name'];
                    $config['maintain_ratio'] = TRUE;
                    $config['width'] = 760;
                    $config['height'] = 190;
                    $this->image_lib->initialize($config);
                    $this->image_lib->resize();
                    $this->image_lib->clear();

                    $config['image_library'] = 'gd2';
                    $config['source_image'] = 'assets/uploads/footer/full/' . $upload_data['file_name'];
                    $config['new_image'] = 'assets/uploads/footer/small/' . $upload_data['file_name'];
                    $config['maintain_ratio'] = TRUE;
                    $config['width'] = 100;
                    $config['height'] = 100;
                    $this->image_lib->initialize($config);
                    $this->image_lib->resize();
                    $this->image_lib->clear();
                }
                $post_data = array('footer_image' => $upload_data['file_name']);

                $all_data = $this->comman_model->get_data_by_id('home_page', array('id' => $id));

                $result = $this->comman_model->update_by_id('home_page', $post_data, $id);

                if ($result) {

                    if (file_exists("assets/uploads/footer/" . $all_data['footer_image']))
                        unlink("assets/uploads/footer/" . $all_data['footer_image']);


                    if (file_exists("assets/uploads/footer/full/" . $all_data['footer_image']))
                        unlink("assets/uploads/footer/full/" . $all_data['footer_image']);


                    if (file_exists("assets/uploads/footer/small/" . $all_data['footer_image']))
                        unlink("assets/uploads/footer/small/" . $all_data['footer_image']);

                    if (file_exists("assets/uploads/footer/thumbnails/" . $all_data['footer_image']))
                        unlink("assets/uploads/footer/thumbnails/" . $all_data['footer_image']);

                    $this->session->set_flashdata('success', 'Footer has been successfully updated.');

                    redirect('admin/index/welcome_page');
                }

//                $this->session->set_flashdata('success', 'Footer has been successfully updated.');
//                redirect('admin/index/welcome_page');
            }
        }


        if ($this->input->post('library')) {
            if (!empty($_FILES['file']['name'])) {
                $field_name = 'file';
                $config['upload_path'] = './assets/uploads/background/full/';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = '800';
                $config['max_width'] = '3000';
                $config['max_height'] = '3000';
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload($field_name)) {
                    /* 			$error = array('error' => $this->upload->display_errors());
                      $this->load->view('admin/add_upload', $error); */
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                    redirect('admin/index/edit_welcome_page/' . $action . '/' . $id);
                } else {
                    $upload_data = $this->upload->data();
                    $this->load->library('image_lib');
                    $config['image_library'] = 'gd2';
                    $config['source_image'] = 'assets/uploads/background/full/' . $upload_data['file_name'];
                    $config['new_image'] = 'assets/uploads/background/thumbnails/' . $upload_data['file_name'];
                    $config['maintain_ratio'] = TRUE;
                    $config['width'] = 450;
                    $config['height'] = 450;
                    $this->image_lib->initialize($config);
                    $this->image_lib->resize();
                    $this->image_lib->clear();

                    $config['image_library'] = 'gd2';
                    $config['source_image'] = 'assets/uploads/background/full/' . $upload_data['file_name'];
                    $config['new_image'] = 'assets/uploads/background/small/' . $upload_data['file_name'];
                    $config['maintain_ratio'] = TRUE;
                    $config['width'] = 100;
                    $config['height'] = 100;
                    $this->image_lib->initialize($config);
                    $this->image_lib->resize();
                    $this->image_lib->clear();
                }
                $post_data = array('library_image' => $upload_data['file_name']);


                $all_data = $this->comman_model->get_data_by_id('home_page', array('id' => $id));

                $result = $this->comman_model->update_by_id('home_page', $post_data, $id);

                if ($result) {

                    if (file_exists("assets/uploads/background/" . $all_data['library_image']))
                        unlink("assets/uploads/background/" . $all_data['library_image']);


                    if (file_exists("assets/uploads/background/full/" . $all_data['library_image']))
                        unlink("assets/uploads/background/full/" . $all_data['library_image']);


                    if (file_exists("assets/uploads/background/small/" . $all_data['library_image']))
                        unlink("assets/uploads/background/small/" . $all_data['library_image']);

                    if (file_exists("assets/uploads/background/thumbnails/" . $all_data['library_image']))
                        unlink("assets/uploads/background/thumbnails/" . $all_data['library_image']);

                    $this->session->set_flashdata('success', 'Library image has been successfully updated.');
                    redirect('admin/index/library_page');
                }
            }
        }
        if ($this->input->post('background')) {
            if (!empty($_FILES['file']['name'])) {
                $field_name = 'file';
                $config['upload_path'] = './assets/uploads/background/full/';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = '800';
                $config['max_width'] = '3000';
                $config['max_height'] = '3000';
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload($field_name)) {
                    /* 			$error = array('error' => $this->upload->display_errors());
                      $this->load->view('admin/add_upload', $error); */
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                    redirect('admin/index/edit_welcome_page/' . $action . '/' . $id);
                } else {
                    $upload_data = $this->upload->data();
                    $this->load->library('image_lib');
                    $config['image_library'] = 'gd2';
                    $config['source_image'] = 'assets/uploads/background/full/' . $upload_data['file_name'];
                    $config['new_image'] = 'assets/uploads/background/thumbnails/' . $upload_data['file_name'];
                    $config['maintain_ratio'] = TRUE;
                    $config['width'] = 450;
                    $config['height'] = 450;
                    $this->image_lib->initialize($config);
                    $this->image_lib->resize();
                    $this->image_lib->clear();

                    $config['image_library'] = 'gd2';
                    $config['source_image'] = 'assets/uploads/background/full/' . $upload_data['file_name'];
                    $config['new_image'] = 'assets/uploads/background/small/' . $upload_data['file_name'];
                    $config['maintain_ratio'] = TRUE;
                    $config['width'] = 100;
                    $config['height'] = 100;
                    $this->image_lib->initialize($config);
                    $this->image_lib->resize();
                    $this->image_lib->clear();
                }
                $post_data = array('background_image' => $upload_data['file_name']);

                $all_data = $this->comman_model->get_data_by_id('home_page', array('id' => $id));

                $result = $this->comman_model->update_by_id('home_page', $post_data, $id);

                if ($result) {

                    if (file_exists("assets/uploads/background/" . $all_data['background_image']))
                        unlink("assets/uploads/background/" . $all_data['background_image']);


                    if (file_exists("assets/uploads/background/full/" . $all_data['background_image']))
                        unlink("assets/uploads/background/full/" . $all_data['background_image']);


                    if (file_exists("assets/uploads/background/small/" . $all_data['background_image']))
                        unlink("assets/uploads/background/small/" . $all_data['background_image']);

                    if (file_exists("assets/uploads/background/thumbnails/" . $all_data['background_image']))
                        unlink("assets/uploads/background/thumbnails/" . $all_data['background_image']);

                    $this->session->set_flashdata('success', 'Logo image has been successfully updated.');

                    redirect('admin/index/welcome_page');
                }

//                $this->session->set_flashdata('success', 'Background image has been successfully updated.');
//                redirect('admin/index/welcome_page');
            }
        }

        if ($this->input->post('globe')) {
            if (!empty($_FILES['file']['name'])) {
                $field_name = 'file';
                $config['upload_path'] = './assets/uploads/logo/full/';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = '800';
                $config['max_width'] = '3000';
                $config['max_height'] = '3000';
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload($field_name)) {
                    /* 			$error = array('error' => $this->upload->display_errors());
                      $this->load->view('admin/add_upload', $error); */
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                    redirect('admin/index/edit_welcome_page/' . $action . '/' . $id);
                } else {
                    $upload_data = $this->upload->data();
                    $this->load->library('image_lib');
                    $config['image_library'] = 'gd2';
                    $config['source_image'] = 'assets/uploads/logo/full/' . $upload_data['file_name'];
                    $config['new_image'] = 'assets/uploads/logo/thumbnails/' . $upload_data['file_name'];
                    $config['maintain_ratio'] = TRUE;
                    $config['width'] = 450;
                    $config['height'] = 450;
                    $this->image_lib->initialize($config);
                    $this->image_lib->resize();
                    $this->image_lib->clear();

                    $config['image_library'] = 'gd2';
                    $config['source_image'] = 'assets/uploads/logo/full/' . $upload_data['file_name'];
                    $config['new_image'] = 'assets/uploads/logo/small/' . $upload_data['file_name'];
                    $config['maintain_ratio'] = TRUE;
                    $config['width'] = 100;
                    $config['height'] = 100;
                    $this->image_lib->initialize($config);
                    $this->image_lib->resize();
                    $this->image_lib->clear();
                }

                $post_data = array('globe_image' => $upload_data['file_name']);

                $all_data = $this->comman_model->get_data_by_id('home_page', array('id' => $id));

                $result = $this->comman_model->update_by_id('home_page', $post_data, $id);

                if ($result) {

                    if (file_exists("assets/uploads/logo/" . $all_data['globe_image']))
                        unlink("assets/uploads/logo/" . $all_data['globe_image']);


                    if (file_exists("assets/uploads/logo/full/" . $all_data['globe_image']))
                        unlink("assets/uploads/logo/full/" . $all_data['globe_image']);


                    if (file_exists("assets/uploads/logo/small/" . $all_data['globe_image']))
                        unlink("assets/uploads/logo/small/" . $all_data['globe_image']);

                    if (file_exists("assets/uploads/logo/thumbnails/" . $all_data['globe_image']))
                        unlink("assets/uploads/logo/thumbnails/" . $all_data['globe_image']);

                    $this->session->set_flashdata('success', 'Logo image has been successfully updated.');

                    redirect('admin/index/welcome_page');
                }

//                $this->session->set_flashdata('success', 'Globe image has been successfully updated.');
//                redirect('admin/index/welcome_page');
            }
        }

        if ($this->input->post('time')) {
            $post_data = array('time_position' => $this->input->post('time_position'));
            $result = $this->comman_model->update_by_id('home_page', $post_data, $id);
            $this->session->set_flashdata('success', 'Time Position has been successfully updated.');
            redirect('admin/index/welcome_page');
        }

        if ($this->input->post('globe_size')) {
            $post_data = array('globe_size' => $this->input->post('globe_size_data'));
            $result = $this->comman_model->update_by_id('home_page', $post_data, $id);
            $this->session->set_flashdata('success', 'Globe Size has been successfully updated.');
            redirect('admin/index/welcome_page');
        }

        if ($this->input->post('globe_position')) {
            $post_data = array('globe_position' => $this->input->post('globe_position'));
            $result = $this->comman_model->update_by_id('home_page', $post_data, $id);
            $this->session->set_flashdata('success', 'Globe Position has been successfully updated.');
            redirect('admin/index/welcome_page');
        }

        if ($this->input->post('product_position')) {
            $post_data = array('product_position' => $this->input->post('product_position'));
            $result = $this->comman_model->update_by_id('home_page', $post_data, $id);
            $this->session->set_flashdata('success', 'Product Position has been successfully updated.');
            redirect('admin/index/welcome_page');
        }
        $this->load->view('admin/header', $data);
        $this->load->view('admin/left_menu', $data);
        $this->load->view('admin/edit_home_page', $data);
        $this->load->view('admin/footer', $data);
    }

    function language() {
        $this->check_lang();
        $this->validateLogin();
        $data = array();
        $data['login'] = $this->session->all_userdata();
        $data['title'] = 'Welcome To CompanyName';
        $data['active'] = 'country';
        $data['all_data'] = $this->comman_model->all_data('country');
        $this->load->view('admin/header', $data);
        $this->load->view('admin/left_menu', $data);
        $this->load->view('admin/country_list', $data);
        $this->load->view('admin/footer', $data);
    }

    function add_language() {
        $this->check_lang();
        $this->validateLogin();
        $data = array();
        $data['login'] = $this->session->all_userdata();
        $data['title'] = 'Welcome To CompanyName';
        $data['active'] = 'bookies';
        $data['sub_menu'] = 'add_article';
        if ($this->input->post('operation')) {
            if (!empty($_FILES['file']['name'])) {
                $field_name = 'file';
                $config['upload_path'] = './assets/uploads/country/full/';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = '800';
                $config['max_width'] = '2000';
                $config['max_height'] = '2000';
                $this->load->library('upload', $config);

                if (!$this->upload->do_upload($field_name)) {
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                    redirect('admin/index/add_language');
                } else {
                    $upload_data = $this->upload->data();
                    $this->load->library('image_lib');
                    $config['image_library'] = 'gd2';
                    $config['source_image'] = 'assets/uploads/country/full/' . $upload_data['file_name'];
                    $config['new_image'] = 'assets/uploads/country/thumbnails/' . $upload_data['file_name'];
                    $config['maintain_ratio'] = TRUE;
                    $config['width'] = 450;
                    $config['height'] = 450;
                    $this->image_lib->initialize($config);
                    $this->image_lib->resize();
                    $this->image_lib->clear();

                    $config['image_library'] = 'gd2';
                    $config['source_image'] = 'assets/uploads/country/full/' . $upload_data['file_name'];
                    $config['new_image'] = 'assets/uploads/country/small/' . $upload_data['file_name'];
                    $config['maintain_ratio'] = TRUE;
                    $config['width'] = 16;
                    $config['height'] = 11;
                    $this->image_lib->initialize($config);
                    $this->image_lib->resize();
                    $this->image_lib->clear();
                }
                $post_data = array(
                    'name' => $this->input->post('title'),
                    'image' => $upload_data['file_name'],
                    'create_date' => time(),
                    'status' => 1
                );
                $result = $this->comman_model->add('country', $post_data);
                $this->session->set_flashdata('success', 'Language has been successfully added.');
                redirect('admin/index/language');
            }
        }
        $this->load->view('admin/header', $data);
        $this->load->view('admin/left_menu', $data);
        $this->load->view('admin/add_country', $data);
        $this->load->view('admin/footer', $data);
    }

    function edit_language($id = false) {
        if (!$id) {
            redirect('admin/index/language');
        }
        $this->check_lang();
        $this->validateLogin();
        $data = array();
        $data['login'] = $this->session->all_userdata();
        $data['title'] = 'Welcome To CompanyName';
        $data['active'] = 'bookies';
        $data['sub_menu'] = 'add_article';
        if ($this->input->post('operation')) {
            if (!empty($_FILES['file']['name'])) {
                $field_name = 'file';
                $config['upload_path'] = './assets/uploads/country/full/';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = '800';
                $config['max_width'] = '2000';
                $config['max_height'] = '2000';
                $this->load->library('upload', $config);

                if (!$this->upload->do_upload($field_name)) {
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                    redirect('admin/index/edit_language');
                } else {
                    $upload_data = $this->upload->data();
                    $this->load->library('image_lib');
                    $config['image_library'] = 'gd2';
                    $config['source_image'] = 'assets/uploads/country/full/' . $upload_data['file_name'];
                    $config['new_image'] = 'assets/uploads/country/thumbnails/' . $upload_data['file_name'];
                    $config['maintain_ratio'] = TRUE;
                    $config['width'] = 450;
                    $config['height'] = 450;
                    $this->image_lib->initialize($config);
                    $this->image_lib->resize();
                    $this->image_lib->clear();

                    $config['image_library'] = 'gd2';
                    $config['source_image'] = 'assets/uploads/country/full/' . $upload_data['file_name'];
                    $config['new_image'] = 'assets/uploads/country/small/' . $upload_data['file_name'];
                    $config['maintain_ratio'] = TRUE;
                    $config['width'] = 16;
                    $config['height'] = 11;
                    $this->image_lib->initialize($config);
                    $this->image_lib->resize();
                    $this->image_lib->clear();
                }
            }
            if (!empty($_FILES['file']['name'])) {
                $post_data = array(
                    'name' => $this->input->post('title'),
                    'image' => $upload_data['file_name'],
                );
            } else {
                $post_data = array(
                    'name' => $this->input->post('title'),
                );
            }

            $path = 'country';

            $all_data = $this->comman_model->get_data_by_id('country', array('id' => $id));
            $result = $this->comman_model->update_data_by_id('country', $post_data, 'id', $id);

            if ($result && $post_data['image']) {

                if (file_exists("assets/uploads/" . $path . "/full/" . $all_data['image']))
                    unlink("assets/uploads/" . $path . "/full/" . $all_data['image']);

                if (file_exists("assets/uploads/" . $path . "/small/" . $all_data['image']))
                    unlink("assets/uploads/" . $path . "/small/" . $all_data['image']);

                if (file_exists("assets/uploads/" . $path . "/thumbnails/" . $all_data['image']))
                    unlink("assets/uploads/" . $path . "/thumbnails/" . $all_data['image']);
            }

            $this->session->set_flashdata('success', 'Language has been successfully updated.');
            redirect('admin/index/language');
        }
        $data['edit_data'] = $this->comman_model->get_data_by_id('country', array('id' => $id));
        $this->load->view('admin/header', $data);
        $this->load->view('admin/left_menu', $data);
        $this->load->view('admin/edit_country', $data);
        $this->load->view('admin/footer', $data);
    }

    function slider() {
        $this->check_lang();
        $this->validateLogin();
        $data = array();
        $data['login'] = $this->session->all_userdata();
        $data['title'] = 'Welcome To CompanyName';
        $data['active'] = 'home';
        $data['all_data'] = $this->comman_model->all_data('slider');
        $this->load->view('admin/header', $data);
        $this->load->view('admin/left_menu', $data);
        $this->load->view('admin/slider_list', $data);
        $this->load->view('admin/footer', $data);
    }

    function add_slider() {
        $this->check_lang();
        $this->validateLogin();
        $data = array();
        $data['login'] = $this->session->all_userdata();
        $data['title'] = 'Welcome To CompanyName';
        $data['active'] = 'home';
        if ($this->input->post('operation')) {
            if (!empty($_FILES['file']['name'])) {
                $field_name = 'file';
                $config['upload_path'] = './assets/uploads/slider/full/';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = '800';
                $config['max_width'] = '2000';
                $config['max_height'] = '2000';
                $this->load->library('upload', $config);

                if (!$this->upload->do_upload($field_name)) {
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                    redirect('admin/index/add_slider');
                } else {
                    $upload_data = $this->upload->data();
                    $this->load->library('image_lib');
                    $config['image_library'] = 'gd2';
                    $config['source_image'] = 'assets/uploads/slider/full/' . $upload_data['file_name'];
                    $config['new_image'] = 'assets/uploads/slider/thumbnails/' . $upload_data['file_name'];
                    $config['maintain_ratio'] = TRUE;
                    $config['width'] = 500;
                    $config['height'] = 500;
                    $this->image_lib->initialize($config);
                    $this->image_lib->resize();
                    $this->image_lib->clear();

                    $config['image_library'] = 'gd2';
                    $config['source_image'] = 'assets/uploads/slider/full/' . $upload_data['file_name'];
                    $config['new_image'] = 'assets/uploads/slider/small/' . $upload_data['file_name'];
                    $config['maintain_ratio'] = TRUE;
                    $config['width'] = 100;
                    $config['height'] = 100;
                    $this->image_lib->initialize($config);
                    $this->image_lib->resize();
                    $this->image_lib->clear();
                }
                $post_data = array(
                    'name' => $this->input->post('title'),
                    'image' => $upload_data['file_name'],
                    'create_date' => time(),
                    'link' => $this->input->post('link'),
                    'alt' => $this->input->post('alt'),
                    'status' => 1
                );
                $result = $this->comman_model->add('slider', $post_data);
                $this->session->set_flashdata('success', 'Slider Image has been successfully added.');
                redirect('admin/index/slider');
            }
        }
        $this->load->view('admin/header', $data);
        $this->load->view('admin/left_menu', $data);
        $this->load->view('admin/add_slider', $data);
        $this->load->view('admin/footer', $data);
    }

    function edit_slider($id = false) {
        if (!$id) {
            redirect('admin/index/slider');
        }
        $this->check_lang();
        $this->validateLogin();
        $data = array();
        $data['login'] = $this->session->all_userdata();
        $data['title'] = 'Welcome To CompanyName';
        $data['active'] = 'home';
        if ($this->input->post('operation')) {
            if (!empty($_FILES['file']['name'])) {
                $field_name = 'file';
                $config['upload_path'] = './assets/uploads/slider/full/';
                $config['allowed_types'] = 'gif|jpg|png|JPG|PNG';
                $config['max_size'] = '800';
                $config['max_width'] = '2024';
                $config['max_height'] = '2024';
                $this->load->library('upload', $config);

                if (!$this->upload->do_upload($field_name)) {
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                    redirect('admin/index/edit_slider/' . $id);
                } else {
                    $upload_data = $this->upload->data();
                    $this->load->library('image_lib');
                    $config['image_library'] = 'gd2';
                    $config['source_image'] = 'assets/uploads/slider/full/' . $upload_data['file_name'];
                    $config['new_image'] = 'assets/uploads/slider/thumbnails/' . $upload_data['file_name'];
                    $config['maintain_ratio'] = TRUE;
                    $config['width'] = 500;
                    $config['height'] = 500;
                    $this->image_lib->initialize($config);
                    $this->image_lib->resize();
                    $this->image_lib->clear();

                    $config['image_library'] = 'gd2';
                    $config['source_image'] = 'assets/uploads/slider/full/' . $upload_data['file_name'];
                    $config['new_image'] = 'assets/uploads/slider/small/' . $upload_data['file_name'];
                    $config['maintain_ratio'] = TRUE;
                    $config['width'] = 100;
                    $config['height'] = 100;
                    $this->image_lib->initialize($config);
                    $this->image_lib->resize();
                    $this->image_lib->clear();
                }
            }
            if (!empty($_FILES['file']['name'])) {
                $post_data = array(
                    'name' => $this->input->post('title'),
                    'image' => $upload_data['file_name'],
                    'link' => $this->input->post('link'),
                    'alt' => $this->input->post('alt'),
                );
            } else {
                $post_data = array(
                    'name' => $this->input->post('title'),
                    'link' => $this->input->post('link'),
                    'alt' => $this->input->post('alt'),
                );
            }


            $all_data = $this->comman_model->get_data_by_id('slider', array('id' => $id));

            $result = $this->comman_model->update_data_by_id('slider', $post_data, 'id', $id);


            if ($result) {

                if (file_exists("assets/uploads/slider/full/" . $all_data['image']))
                    unlink("assets/uploads/slider/full/" . $all_data['image']);


                if (file_exists("assets/uploads/slider/small/" . $all_data['image']))
                    unlink("assets/uploads/slider/small/" . $all_data['image']);

                if (file_exists("assets/uploads/slider/thumbnails/" . $all_data['image']))
                    unlink("assets/uploads/slider/thumbnails/" . $all_data['image']);
            }

            $this->session->set_flashdata('success', 'Slider Image has been successfully updated.');
            redirect('admin/index/slider');
        }
        $data['edit_data'] = $this->comman_model->get_data_by_id('slider', array('id' => $id));
        $this->load->view('admin/header', $data);
        $this->load->view('admin/left_menu', $data);
        $this->load->view('admin/edit_slider', $data);
        $this->load->view('admin/footer', $data);
    }

    function globe_product() {
        $this->check_lang();
        $this->validateLogin();
        $data = array();
        $data['login'] = $this->session->all_userdata();
        $data['title'] = 'Welcome To CompanyName';
        $data['active'] = 'welcome';
        $data['all_data'] = $this->comman_model->all_data('product_image');
        $this->load->view('admin/header', $data);
        $this->load->view('admin/left_menu', $data);
        $this->load->view('admin/globe_list', $data);
        $this->load->view('admin/footer', $data);
    }

    function add_globe() {
        $this->check_lang();
        $this->validateLogin();
        $data = array();
        $data['login'] = $this->session->all_userdata();
        $data['title'] = 'Welcome To CompanyName';
        $data['active'] = 'welcome';
        $data['product_name'] = 'Globe';
        if ($this->input->post('operation')) {
            if (!empty($_FILES['file']['name'])) {
                $field_name = 'file';
                $config['upload_path'] = './assets/uploads/globe_product/full/';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = '800';
                $config['max_width'] = '2000';
                $config['max_height'] = '2000';
                $this->load->library('upload', $config);

                if (!$this->upload->do_upload($field_name)) {
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                    redirect('admin/index/add_globe');
                } else {
                    $upload_data = $this->upload->data();
                    $this->load->library('image_lib');
                    $config['image_library'] = 'gd2';
                    $config['source_image'] = 'assets/uploads/globe_product/full/' . $upload_data['file_name'];
                    $config['new_image'] = 'assets/uploads/globe_product/thumbnails/' . $upload_data['file_name'];
                    $config['maintain_ratio'] = TRUE;
                    $config['width'] = 450;
                    $config['height'] = 450;
                    $this->image_lib->initialize($config);
                    $this->image_lib->resize();
                    $this->image_lib->clear();

                    $config['image_library'] = 'gd2';
                    $config['source_image'] = 'assets/uploads/globe_product/full/' . $upload_data['file_name'];
                    $config['new_image'] = 'assets/uploads/globe_product/small/' . $upload_data['file_name'];
                    $config['maintain_ratio'] = TRUE;
                    $config['width'] = 100;
                    $config['height'] = 100;
                    $this->image_lib->initialize($config);
                    $this->image_lib->resize();
                    $this->image_lib->clear();
                }
                $post_data = array(
                    'name' => $this->input->post('title'),
                    'image' => $upload_data['file_name'],
                    'set_image' => 'welcome',
                    'create_date' => time(),
                    'link' => $this->input->post('link'),
                    'alt' => $this->input->post('alt'),
                    'status' => 1
                );
                $result = $this->comman_model->add('product_image', $post_data);
                $this->session->set_flashdata('success', 'Globe Product has been successfully added.');
                redirect('admin/index/globe_product');
            }
        }
        $this->load->view('admin/header', $data);
        $this->load->view('admin/left_menu', $data);
        $this->load->view('admin/add_globe', $data);
        $this->load->view('admin/footer', $data);
    }

    function edit_globe($id = false) {
        if (!$id) {
            redirect('admin/index/globe_product');
        }
        $this->check_lang();
        $this->validateLogin();
        $data = array();
        $data['login'] = $this->session->all_userdata();
        $data['title'] = 'Welcome To CompanyName';
        $data['active'] = 'welcome';
        $data['product_name'] = 'Globe';
        if ($this->input->post('operation')) {
            if (!empty($_FILES['file']['name'])) {
                $field_name = 'file';
                $config['upload_path'] = './assets/uploads/globe_product/full/';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = '800';
                $config['max_width'] = '2000';
                $config['max_height'] = '2000';
                $this->load->library('upload', $config);

                if (!$this->upload->do_upload($field_name)) {
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                    redirect('admin/index/edit_globe');
                } else {
                    $upload_data = $this->upload->data();
                    $this->load->library('image_lib');
                    $config['image_library'] = 'gd2';
                    $config['source_image'] = 'assets/uploads/globe_product/full/' . $upload_data['file_name'];
                    $config['new_image'] = 'assets/uploads/globe_product/thumbnails/' . $upload_data['file_name'];
                    $config['maintain_ratio'] = TRUE;
                    $config['width'] = 450;
                    $config['height'] = 450;
                    $this->image_lib->initialize($config);
                    $this->image_lib->resize();
                    $this->image_lib->clear();

                    $config['image_library'] = 'gd2';
                    $config['source_image'] = 'assets/uploads/globe_product/full/' . $upload_data['file_name'];
                    $config['new_image'] = 'assets/uploads/globe_product/small/' . $upload_data['file_name'];
                    $config['maintain_ratio'] = TRUE;
                    $config['width'] = 100;
                    $config['height'] = 100;
                    $this->image_lib->initialize($config);
                    $this->image_lib->resize();
                    $this->image_lib->clear();
                }
            }
            if (!empty($_FILES['file']['name'])) {
                $post_data = array(
                    'name' => $this->input->post('title'),
                    'image' => $upload_data['file_name'],
                    'link' => $this->input->post('link'),
                    'alt' => $this->input->post('alt'),
                );
            } else {
                $post_data = array(
                    'name' => $this->input->post('title'),
                    'link' => $this->input->post('link'),
                    'alt' => $this->input->post('alt'),
                );
            }


            $all_data = $this->comman_model->get_data_by_id('product_image', array('id' => $id));

            $result = $this->comman_model->update_data_by_id('product_image', $post_data, 'id', $id);


            if ($result) {

                if (file_exists("assets/uploads/globe_product/full/" . $all_data['image']))
                    unlink("assets/uploads/globe_product/full/" . $all_data['image']);


                if (file_exists("assets/uploads/globe_product/small/" . $all_data['image']))
                    unlink("assets/uploads/globe_product/small/" . $all_data['image']);

                if (file_exists("assets/uploads/globe_product/thumbnails/" . $all_data['image']))
                    unlink("assets/uploads/globe_product/thumbnails/" . $all_data['image']);
            }

//            $this->session->set_flashdata('success', $name . ' has successfully deleted.');
//            redirect('admin/index/' . $page);

            $this->session->set_flashdata('success', 'Globe product has been successfully updated.');
            redirect('admin/index/globe_product');
        }
        $data['edit_data'] = $this->comman_model->get_data_by_id('product_image', array('id' => $id));
        $this->load->view('admin/header', $data);
        $this->load->view('admin/left_menu', $data);
        $this->load->view('admin/edit_globe', $data);
        $this->load->view('admin/footer', $data);
    }

    function question($id = false) {
        if (!$id) {
            redirect('admin/index/job_section');
        }
        $this->check_lang();
        $this->validateLogin();
        $data = array();
        $data['login'] = $this->session->all_userdata();
        $data['title'] = 'Welcome To CompanyName';
        $data['active'] = 'job';
        $data['all_data'] = $this->comman_model->get_all_data_by_id('question', array('job_id' => $id));
        $data['job_data'] = $this->comman_model->get_data_by_id('job_section', array('id' => $id));
        if (empty($data['all_data'])) {
            redirect('admin/index/job_section');
        }
        $this->load->view('admin/header', $data);
        $this->load->view('admin/left_menu', $data);
        $this->load->view('admin/question_list', $data);
        $this->load->view('admin/footer', $data);
    }

    function edit_question($page = false, $id = false) {
        if (!$page) {
            redirect('admin/index/job_section');
        }
        if (!$id) {
            redirect('admin/index/question/' . $page);
        }
        $this->check_lang();
        $this->validateLogin();
        $data = array();
        $data['login'] = $this->session->all_userdata();
        $data['title'] = 'Welcome To CompanyName';
        $data['active'] = 'job';
        $data['product_name'] = 'Question';
        if ($this->input->post('operation')) {
            $post_data = array(
                'name' => $this->input->post('title'),
                'duration' => $this->input->post('duration'),
                'min_words' => $this->input->post('min_word'),
                'update_date' => time()
            );
            $result = $this->comman_model->update_data_by_id('question', $post_data, 'id', $id);
            $this->session->set_flashdata('success', 'Question has been successfully updated.');
            redirect('admin/index/question/' . $page);
        }
        $data['edit_data'] = $this->comman_model->get_data_by_id('question', array('id' => $id));
        $this->load->view('admin/header', $data);
        $this->load->view('admin/left_menu', $data);
        $this->load->view('admin/edit_question', $data);
        $this->load->view('admin/footer', $data);
    }

    function user_block() {
        $this->check_lang();
        $this->validateLogin();
        $data = array();
        $data['login'] = $this->session->all_userdata();
        $data['title'] = 'Welcome To CompanyName';
        $data['active'] = 'interview';
        $data['label'] = 'block';
        $data['all_data1'] = $this->comman_model->all_data('apply_form');
        $this->load->view('admin/header', $data);
        $this->load->view('admin/left_menu', $data);
        $this->load->view('admin/interview_list', $data);
        $this->load->view('admin/footer', $data);
    }

    function job_page() {
        $this->check_lang();
        $this->validateLogin();
        $data = array();
        $data['title'] = 'Welcome To CompanyName';
        $data['login'] = $this->session->all_userdata();
        $data['active'] = 'interview';
        $data['name'] = 'interview';
        $this->load->view('admin/header', $data);
        $this->load->view('admin/left_menu', $data);
        $this->load->view('admin/home_page', $data);
        //$this->load->view('admin/content',$data);
        //$this->load->view('admin/add_tip_of_day',$data);
        $this->load->view('admin/footer', $data);
    }

    function interview_section() {
        $this->check_lang();
        $this->validateLogin();
        $data = array();
        $data['login'] = $this->session->all_userdata();
        $data['title'] = 'Welcome To CompanyName';
        $data['active'] = 'interview';
        $data['label'] = 'Interview Section';
        $data['all_data'] = $this->comman_model->all_data('apply_form');
        $this->load->view('admin/header', $data);
        $this->load->view('admin/left_menu', $data);
        $this->load->view('admin/interview_list', $data);
        $this->load->view('admin/footer', $data);
    }

    function view($page = false, $id = false) {
        if (!$page) {
            redirect('admin/index/interview_section');
        }
        if (!$id) {
            redirect('admin/index/interview_section');
        }
        $this->check_lang();
        $this->validateLogin();
        $data = array();
        $data['login'] = $this->session->all_userdata();
        $data['title'] = 'Welcome To CompanyName';
        $data['active'] = 'interview';
        $this->load->view('admin/header', $data);
        $this->load->view('admin/left_menu', $data);
        if ($page == 'interview') {
            $data['view_data'] = $this->comman_model->get_all_data_by_id('user_ans', array('user_id' => $id));
            $this->load->view('admin/view_interview', $data);
        } else {
            redirect('admin/index/interview_section');
        }
        $this->load->view('admin/footer', $data);
    }

    function download_file($files = false) {
        /* 		$file = 'assets/uploads/document/'.$files;
          if(file_exists($file)) {
          header('Content-Description: File Transfer');
          header('Content-Type: application/octet-stream');
          header('Content-Disposition: attachment; filename='.basename($file));
          header('Expires: 0');
          header('Cache-Control: must-revalidate');
          header('Pragma: public');
          header('Content-Length: ' . filesize($file));
          ob_clean();
          flush();
          readfile($file);
          exit;
          } */
        $file_name = 'assets/uploads/document/' . $files;
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

    function job_section() {
        $this->check_lang();
        $this->validateLogin();
        $data = array();
        $data['login'] = $this->session->all_userdata();
        $data['title'] = 'Welcome To CompanyName';
        $data['active'] = 'interview';
        $data['all_data'] = $this->comman_model->all_data('job_section');
        $this->load->view('admin/header', $data);
        $this->load->view('admin/left_menu', $data);
        $this->load->view('admin/job_list', $data);
        $this->load->view('admin/footer', $data);
    }

    function add_job_section() {
        $this->check_lang();
        $this->validateLogin();
        $data = array();
        $data['login'] = $this->session->all_userdata();
        $data['title'] = 'Welcome To CompanyName';
        $data['active'] = 'job';
        $data['product_name'] = 'Job Section';
        if ($this->input->post('operation')) {
            if (!empty($_FILES['file']['name'])) {
                $field_name = 'file';
                $config['upload_path'] = './assets/uploads/job_section/full/';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = '800';
                $config['max_width'] = '2000';
                $config['max_height'] = '2000';
                $this->load->library('upload', $config);

                if (!$this->upload->do_upload($field_name)) {
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                    redirect('admin/index/add_globe');
                } else {
                    $upload_data = $this->upload->data();
                    $this->load->library('image_lib');
                    $config['image_library'] = 'gd2';
                    $config['source_image'] = 'assets/uploads/job_section/full/' . $upload_data['file_name'];
                    $config['new_image'] = 'assets/uploads/job_section/thumbnails/' . $upload_data['file_name'];
                    $config['maintain_ratio'] = TRUE;
                    $config['width'] = 450;
                    $config['height'] = 450;
                    $this->image_lib->initialize($config);
                    $this->image_lib->resize();
                    $this->image_lib->clear();

                    $config['image_library'] = 'gd2';
                    $config['source_image'] = 'assets/uploads/job_section/full/' . $upload_data['file_name'];
                    $config['new_image'] = 'assets/uploads/job_section/small/' . $upload_data['file_name'];
                    $config['maintain_ratio'] = TRUE;
                    $config['width'] = 100;
                    $config['height'] = 100;
                    $this->image_lib->initialize($config);
                    $this->image_lib->resize();
                    $this->image_lib->clear();
                }
            }
            if (!empty($_FILES['file']['name'])) {
                $post_data = array(
                    'name' => $this->input->post('title'),
                    'category' => $this->input->post('category'),
                    'scope' => $this->input->post('scope'),
                    'qualification' => $this->input->post('qualification'),
                    'image' => $upload_data['file_name'],
                    'create_date' => time(),
                    'status' => 1
                );
            } else {
                $post_data = array(
                    'name' => $this->input->post('title'),
                    'category' => $this->input->post('category'),
                    'scope' => $this->input->post('scope'),
                    'qualification' => $this->input->post('qualification'),
                    'create_date' => time(),
                    'status' => 1
                );
            }
            $result = $this->comman_model->add('job_section', $post_data);
            if ($this->input->post('question') && $this->input->post('duration')) {
                $question_no = $this->input->post('question');
                $duration = $this->input->post('duration');
                $words = $this->input->post('minword');

                for ($i = 0; $i < count($question_no); $i++) {
                    $result1 = $this->comman_model->add('question', array('job_id' => $result, 'name' => $question_no[$i], 'duration' => $duration[$i], 'min_words' => $words[$i], 'status' => 1, 'create_date' => time()));
                }
            }
            $this->session->set_flashdata('success', 'Job has been successfully added.');
            redirect('admin/index/add_job_section');
        }
        $this->load->view('admin/header', $data);
        $this->load->view('admin/left_menu', $data);
        $this->load->view('admin/add_job', $data);
        $this->load->view('admin/footer', $data);
    }

    /* function edit_job_section($id = false){
      if(!$id){
      redirect('admin/index/job_section');
      }
      $this->check_lang();
      $this->validateLogin();
      $data = array();
      $data['login'] = $this->session->all_userdata();
      $data['title'] = 'Welcome To CompanyName';
      $data['active'] = 'job';
      $data['product_name']= 'Job Section';
      $data['id'] = $id;
      if($this->input->post('operation')){
      if(!empty($_FILES['file']['name'])){
      $field_name = 'file';
      $config['upload_path'] = './assets/uploads/job_section/full/';
      $config['allowed_types'] = 'gif|jpg|png';
      $config['max_size']	= '800';
      $config['max_width']  = '2000';
      $config['max_height']  = '2000';
      $this->load->library('upload', $config);

      if ( ! $this->upload->do_upload($field_name)){
      $this->session->set_flashdata('error',$this->upload->display_errors());
      redirect('admin/index/edit_globe');
      }
      else{
      $upload_data	= $this->upload->data();
      $this->load->library('image_lib');
      $config['image_library'] = 'gd2';
      $config['source_image'] = 'assets/uploads/job_section/full/'.$upload_data['file_name'];
      $config['new_image']	= 'assets/uploads/job_section/thumbnails/'.$upload_data['file_name'];
      $config['maintain_ratio'] = TRUE;
      $config['width'] = 450;
      $config['height'] = 450;
      $this->image_lib->initialize($config);
      $this->image_lib->resize();
      $this->image_lib->clear();

      $config['image_library'] = 'gd2';
      $config['source_image'] = 'assets/uploads/job_section/full/'.$upload_data['file_name'];
      $config['new_image'] = 'assets/uploads/job_section/small/'.$upload_data['file_name'];
      $config['maintain_ratio'] = TRUE;
      $config['width'] = 100;
      $config['height'] = 100;
      $this->image_lib->initialize($config);
      $this->image_lib->resize();
      $this->image_lib->clear();
      }
      }
      if (!empty($_FILES['file']['name'])){
      $post_data = array(
      'name' =>$this->input->post('title'),
      'category' =>$this->input->post('category'),
      'scope' =>$this->input->post('scope'),
      'qualification' =>$this->input->post('qualification'),
      'image'=>$upload_data['file_name'],
      'update_date' =>time(),
      );
      }
      else{
      $post_data = array(
      'name' =>$this->input->post('title'),
      'category' =>$this->input->post('category'),
      'scope' =>$this->input->post('scope'),
      'qualification' =>$this->input->post('qualification'),
      'update_date' =>time(),
      );
      }
      $result = $this->comman_model->update_data_by_id('job_section',$post_data,'id',$id);
      if($this->input->post('question')&&$this->input->post('duration')){
      $question_no = $this->input->post('question');
      $duration 	 = $this->input->post('duration');
      $words 	 	 = $this->input->post('minword');
      for($i = 0; $i < count($question_no); $i++){
      $result1 = $this->comman_model->add('question',array('job_id'=>$this->input->post('id'),'name'=>$question_no[$i],'duration'=>$duration[$i],'min_words'=>$words[$i],'status'=>1,'create_date'=>time()));
      }

      }
      $this->session->set_flashdata('success', 'Job has been successfully updated.');
      redirect('admin/index/job_section');
      }
      $data['edit_data'] = $this->comman_model->get_data_by_id('job_section',array('id'=>$id));
      $this->load->view('admin/header',$data);
      $this->load->view('admin/left_menu',$data);
      $this->load->view('admin/edit_job',$data);
      $this->load->view('admin/footer',$data);
      }
     */

    function edit_job_section($id = false) {

        if (!$id) {
            redirect('admin/index/job_section');
        }
        $this->check_lang();
        $this->validateLogin();
        $data = array();
        $data['login'] = $this->session->all_userdata();
        $data['title'] = 'Welcome To CompanyName';
        $data['active'] = 'job';
        $data['product_name'] = 'Job Section';
        $data['id'] = $id;
        if (!empty($_FILES['file']['name']) && !$this->input->post('operation')) {
            $field_name = 'file';
            $config['upload_path'] = './assets/uploads/job_section/full/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '800';
            $config['max_width'] = '2000';
            $config['max_height'] = '2000';
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload($field_name)) {
                echo($this->upload->display_errors());
            } else {
                $upload_data = $this->upload->data();
                $this->load->library('image_lib');
                $config['image_library'] = 'gd2';
                $config['source_image'] = 'assets/uploads/job_section/full/' . $upload_data['file_name'];
                $config['new_image'] = 'assets/uploads/job_section/thumbnails/' . $upload_data['file_name'];
                $config['maintain_ratio'] = TRUE;
                $config['width'] = 450;
                $config['height'] = 450;
                $this->image_lib->initialize($config);
                $this->image_lib->resize();
                $this->image_lib->clear();

                $config['image_library'] = 'gd2';
                $config['source_image'] = 'assets/uploads/job_section/full/' . $upload_data['file_name'];
                $config['new_image'] = 'assets/uploads/job_section/small/' . $upload_data['file_name'];
                $config['maintain_ratio'] = TRUE;
                $config['width'] = 100;
                $config['height'] = 100;
                $this->image_lib->initialize($config);
                $this->image_lib->resize();
                $this->image_lib->clear();

                $post_data = array(
                    'image' => $upload_data['file_name'],
                    'update_date' => time(),
                );

                $result = $this->comman_model->update_data_by_id('job_section', $post_data, 'id', $id);
                echo('assets/uploads/job_section/small/' . $upload_data['file_name']);
            }
            die();
        }
        if ($this->input->post('operation')) {
            $post_data = array(
                'name' => $this->input->post('title'),
                'category' => $this->input->post('category'),
                'scope' => $this->input->post('scope'),
                'qualification' => $this->input->post('qualification'),
                'update_date' => time(),
            );

            $result = $this->comman_model->update_data_by_id('job_section', $post_data, 'id', $id);
            if ($this->input->post('question') && $this->input->post('duration')) {
                $question_no = $this->input->post('question');
                $duration = $this->input->post('duration');
                $words = $this->input->post('minword');
                $quesids = $this->input->post('quesid');

                for ($i = 0; $i < count($question_no); $i++) {
                    $qid = isset($quesids[$i]) ? $quesids[$i] : null;
                    if ($qid) {
                        $result1 = $this->comman_model->update_by_id('question', array(
                            'job_id' => $this->input->post('id'),
                            'name' => $question_no[$i],
                            'duration' => $duration[$i],
                            'min_words' => $words[$i],
                            'status' => 1,
                            'create_date' => time()
                                ), $qid);
                    } else {

                        $result1 = $this->comman_model->add('question', array(
                            'job_id' => $this->input->post('id'),
                            'name' => $question_no[$i],
                            'duration' => $duration[$i],
                            'min_words' => $words[$i],
                            'status' => 1,
                            'create_date' => time()
                                ));
                        $quesids[] = $result1;
                    }
                }
                $newquesids = array();
                foreach ($quesids as $qid) {
                    if ($qid)
                        $newquesids[] = $qid;
                }
                $newquesids = implode(",", $newquesids);
                $quesids = trim($newquesids, ',');
                if ($quesids)
                    $this->comman_model->delete_by_id("question", "id not in ({$quesids}) and job_id = " . $this->input->post('id'));
            }
            $this->session->set_flashdata('success', lang('Job has been successfully updated.'));
            redirect('admin/index/job_section');
        }
        $data['edit_data'] = $this->comman_model->get_data_by_id('job_section', array('id' => $id));
        $this->load->view('admin/header', $data);
        $this->load->view('admin/left_menu', $data);
        $this->load->view('admin/edit_job', $data);
        $this->load->view('admin/footer', $data);
    }

    function library_product() {
        $this->check_lang();
        $this->validateLogin();
        $data = array();
        $data['login'] = $this->session->all_userdata();
        $data['title'] = 'Welcome To CompanyName';
        $data['active'] = 'home';
        $data['all_data'] = $this->comman_model->all_data('product_image');
        $this->load->view('admin/header', $data);
        $this->load->view('admin/left_menu', $data);
        $this->load->view('admin/library_product_list', $data);
        $this->load->view('admin/footer', $data);
    }

    function add_library() {
        $this->check_lang();
        $this->validateLogin();
        $data = array();
        $data['login'] = $this->session->all_userdata();
        $data['title'] = 'Welcome To CompanyName';
        $data['active'] = 'home';
        $data['product_name'] = 'Library';
        if ($this->input->post('operation')) {
            if (!empty($_FILES['file']['name'])) {
                $field_name = 'file';
                $config['upload_path'] = './assets/uploads/globe_product/full/';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = '800';
                $config['max_width'] = '2000';
                $config['max_height'] = '2000';
                $this->load->library('upload', $config);

                if (!$this->upload->do_upload($field_name)) {
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                    redirect('admin/index/add_library');
                } else {
                    $upload_data = $this->upload->data();
                    $this->load->library('image_lib');
                    $config['image_library'] = 'gd2';
                    $config['source_image'] = 'assets/uploads/globe_product/full/' . $upload_data['file_name'];
                    $config['new_image'] = 'assets/uploads/globe_product/thumbnails/' . $upload_data['file_name'];
                    $config['maintain_ratio'] = TRUE;
                    $config['width'] = 450;
                    $config['height'] = 450;
                    $this->image_lib->initialize($config);
                    $this->image_lib->resize();
                    $this->image_lib->clear();

                    $config['image_library'] = 'gd2';
                    $config['source_image'] = 'assets/uploads/globe_product/full/' . $upload_data['file_name'];
                    $config['new_image'] = 'assets/uploads/globe_product/small/' . $upload_data['file_name'];
                    $config['maintain_ratio'] = TRUE;
                    $config['width'] = 100;
                    $config['height'] = 100;
                    $this->image_lib->initialize($config);
                    $this->image_lib->resize();
                    $this->image_lib->clear();
                }
                $post_data = array(
                    'name' => $this->input->post('title'),
                    'image' => $upload_data['file_name'],
                    'set_image' => 'home',
                    'create_date' => time(),
                    'link' => $this->input->post('link'),
                    'alt' => $this->input->post('alt'),
                    'status' => 1
                );
                $result = $this->comman_model->add('product_image', $post_data);
                $this->session->set_flashdata('success', 'Globe Product has been successfully added.');
                redirect('admin/index/library_product');
            }
        }
        $this->load->view('admin/header', $data);
        $this->load->view('admin/left_menu', $data);
        $this->load->view('admin/add_globe', $data);
        $this->load->view('admin/footer', $data);
    }

    function edit_library($id = false) {
        if (!$id) {
            redirect('admin/index/library_product');
        }
        $this->check_lang();
        $this->validateLogin();
        $data = array();
        $data['login'] = $this->session->all_userdata();
        $data['title'] = 'Welcome To CompanyName';
        $data['active'] = 'home';
        $data['product_name'] = 'Library';
        if ($this->input->post('operation')) {
            if (!empty($_FILES['file']['name'])) {
                $field_name = 'file';
                $config['upload_path'] = './assets/uploads/globe_product/full/';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = '800';
                $config['max_width'] = '2000';
                $config['max_height'] = '2000';
                $this->load->library('upload', $config);

                if (!$this->upload->do_upload($field_name)) {
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                    redirect('admin/index/edit_library');
                } else {
                    $upload_data = $this->upload->data();
                    $this->load->library('image_lib');
                    $config['image_library'] = 'gd2';
                    $config['source_image'] = 'assets/uploads/globe_product/full/' . $upload_data['file_name'];
                    $config['new_image'] = 'assets/uploads/globe_product/thumbnails/' . $upload_data['file_name'];
                    $config['maintain_ratio'] = TRUE;
                    $config['width'] = 450;
                    $config['height'] = 450;
                    $this->image_lib->initialize($config);
                    $this->image_lib->resize();
                    $this->image_lib->clear();

                    $config['image_library'] = 'gd2';
                    $config['source_image'] = 'assets/uploads/globe_product/full/' . $upload_data['file_name'];
                    $config['new_image'] = 'assets/uploads/globe_product/small/' . $upload_data['file_name'];
                    $config['maintain_ratio'] = TRUE;
                    $config['width'] = 100;
                    $config['height'] = 100;
                    $this->image_lib->initialize($config);
                    $this->image_lib->resize();
                    $this->image_lib->clear();
                }
            }
            if (!empty($_FILES['file']['name'])) {
                $post_data = array(
                    'name' => $this->input->post('title'),
                    'image' => $upload_data['file_name'],
                    'link' => $this->input->post('link'),
                    'alt' => $this->input->post('alt'),
                );
            } else {
                $post_data = array(
                    'name' => $this->input->post('title'),
                    'link' => $this->input->post('link'),
                    'alt' => $this->input->post('alt'),
                );
            }


            $all_data = $this->comman_model->get_data_by_id('product_image', array('id' => $id));

            $result = $this->comman_model->update_data_by_id('product_image', $post_data, 'id', $id);

            if ($result) {

                if (file_exists("assets/uploads/globe_product/full/" . $all_data['image']))
                    unlink("assets/uploads/globe_product/full/" . $all_data['image']);


                if (file_exists("assets/uploads/globe_product/small/" . $all_data['image']))
                    unlink("assets/uploads/globe_product/small/" . $all_data['image']);

                if (file_exists("assets/uploads/globe_product/thumbnails/" . $all_data['image']))
                    unlink("assets/uploads/globe_product/thumbnails/" . $all_data['image']);
            }

//            $this->session->set_flashdata('success', $name . ' has successfully deleted.');
//            redirect('admin/index/' . $page);

            $this->session->set_flashdata('success', 'Globe product has been successfully updated.');
            redirect('admin/index/library_product');
        }

        $data['edit_data'] = $this->comman_model->get_data_by_id('product_image', array('id' => $id));
        $this->load->view('admin/header', $data);
        $this->load->view('admin/left_menu', $data);
        $this->load->view('admin/edit_globe', $data);
        $this->load->view('admin/footer', $data);
    }

    function delete($page = false, $id = false, $is_ajax=false) {
        
        $data = array();
        $data['login'] = $this->session->all_userdata();
        $this->validateLogin();
        if (!$page) {
            redirect('admin/index/');
        }

        if ($page == 'globe_product') {
            $table = 'product_image';
            $name = 'Globe Product';
            $path = 'globe_product';
            $column = 'image';
        } else if ($page == 'library_product') {
            $table = 'product_image';
            $name = 'Library Product';
            $path = 'globe_product';
            $column = 'image';
        } else if ($page == 'language') {
            $path = 'country';
            $table = 'country';
            $name = 'Language';
            $column = 'image';
        } else if ($page == 'slider') {
            $table = 'slider';
            $name = 'Slider';
            $path = 'slider';
            $column = 'image';
        } else if ($page == 'job_section') {
            $table = 'job_section';
            $name = 'Job Section';
        } else if ($page == 'promotion_user' || $page == 'promotion_block_user') {
            $table = 'promotion_form';
            $name = 'User';
            $where = 'block';
            $delete_data = $this->comman_model->get_tabledata_by_id($table, $id, $where);
        } else if ($page == 'promotion_section' || $page == 'knowledge_subtitle') {

            $table = 'promotion_section';
            $name = 'Promotion Section';
            $path = 'promotion_section';

            $all_data = $this->comman_model->get_data_by_id($table, array('id' => $id));
            $result = $this->comman_model->delete_by_id($table, array('id' => $id));

            if ($result) {

                if (file_exists("assets/uploads/" . $path . "/full/" . $all_data['image']))
                    unlink("assets/uploads/" . $path . "/full/" . $all_data['image']);

                if (file_exists("assets/uploads/" . $path . "/small/" . $all_data['image']))
                    unlink("assets/uploads/" . $path . "/small/" . $all_data['image']);

                if (file_exists("assets/uploads/" . $path . "/thumbnails/" . $all_data['image']))
                    unlink("assets/uploads/" . $path . "/thumbnails/" . $all_data['image']);

                if (file_exists("assets/uploads/" . $path . "/file/" . $all_data['file']))
                    unlink("assets/uploads/" . $path . "/file/" . $all_data['file']);

                if (file_exists("assets/uploads/" . $path . "/video/" . $all_data['video']))
                    unlink("assets/uploads/" . $path . "/video/" . $all_data['video']);
            }
        } else if ($page == 'contact_user' || $page == 'contact_user_block') {
            $table = 'contact_form';
            $name = 'User';
            $where = 'block';
            $delete_data = $this->comman_model->get_tabledata_by_id($table, $id, $where);
        } else if ($page == 'promotion_category') {
            $table = 'promotion_category';
            $name = 'Category';
        } else if ($page == 'interview_section' || $page == 'user_block') {
            $table = 'apply_form';
            $name = 'User';
        } else if ($page == 'edit_job_section') {
            $table = 'job_section';
            $name = 'Image';
        } else if ($page == 'edit_image_section') {
            $table = 'promotion_section';
            $name = 'image';
            $path = 'promotion_section';
        } else if ($page == 'edit_image_knowledge_section') {
            $table = 'promotion_section';
            $name = 'image';
            $path = 'promotion_section';
        } else if ($page == 'edit_video_section') {
            $table = 'promotion_section';
            $name = 'video';
        } else if ($page == 'edit_file_section') {
            $table = 'promotion_section';
            $name = 'file';
            $path = 'promotion_section';
        } else {
            redirect('admin/index/');
        }
        if (!$id) {
            redirect('admin/index/' . $page);
        }
        if ($page == 'job_section') {
            $result1 = $this->comman_model->delete_by_id('question', array('job_id' => $id));
            $result2 = $this->comman_model->delete_by_id($table, array('id' => $id));
        } else if ($page == 'interview_section') {
            $result1 = $this->comman_model->delete_by_id('user_ans', array('user_id' => $id));
            $result2 = $this->comman_model->delete_by_id($table, array('id' => $id));
        } else if ($page == 'language') {
            //  $result1 = $this->comman_model->delete_by_id('country', array('user_id' => $id));
            $all_data = $this->comman_model->get_data_by_id($table, array('id' => $id));
            $result2 = $this->comman_model->delete_by_id($table, array('id' => $id));
            if ($all_data) {
                if (file_exists("assets/uploads/" . $path . "/full/" . $all_data['image']))
                    unlink("assets/uploads/" . $path . "/full/" . $all_data['image']);
                if (file_exists("assets/uploads/" . $path . "/small/" . $all_data['image']))
                    unlink("assets/uploads/" . $path . "/small/" . $all_data['image']);

                if (file_exists("assets/uploads/" . $path . "/thumbnails/" . $all_data['image']))
                    unlink("assets/uploads/" . $path . "/thumbnails/" . $all_data['image']);
            }
            if($is_ajax == true){
                echo "success";exit;
            }
            $this->session->set_flashdata('success', $name . ' has successfully deleted.');
            redirect('admin/index/' . $page);
        }
        else if ($page == 'promotion_category') {

            $result1 = $this->comman_model->delete_by_id('promotion_section', array('category_id' => $id));
            $result2 = $this->comman_model->delete_by_id($table, array('id' => $id));
        } else if ($page == 'edit_job_section') {
            $result = $this->comman_model->update_data_by_id($table, array('image' => ''), 'id', $id);
            if($is_ajax == true){
                echo "success";exit;
            }
            $this->session->set_flashdata('success', $name . ' has successfully deleted.');
            redirect('admin/index/' . $page . '/' . $id);
        } else if ($page == 'edit_video_section') {
            $result = $this->comman_model->update_data_by_id($table, array('video' => ''), 'id', $id);
            if($is_ajax == true){
                echo "success";exit;
            }
            $this->session->set_flashdata('success', $name . ' has successfully deleted.');
            redirect('admin/index/edit_promotion_section/' . $id);
        } else if ($page == 'edit_image_section') {

            $all_data = $this->comman_model->get_data_by_id($table, array('id' => $id));
            $result = $this->comman_model->update_data_by_id($table, array('image' => ''), 'id', $id);

            if ($result) {

                if (file_exists("assets/uploads/" . $path . "/full/" . $all_data['image']))
                    unlink("assets/uploads/" . $path . "/full/" . $all_data['image']);
                if (file_exists("assets/uploads/" . $path . "/small/" . $all_data['image']))
                    unlink("assets/uploads/" . $path . "/small/" . $all_data['image']);

                if (file_exists("assets/uploads/" . $path . "/thumbnails/" . $all_data['image']))
                    unlink("assets/uploads/" . $path . "/thumbnails/" . $all_data['image']);
            }
            
            if($is_ajax == true){
                echo "success";exit;
            }

            $this->session->set_flashdata('success', $name . ' has successfully deleted.');
            redirect('admin/index/edit_promotion_section/' . $id);
        } else if ($page == 'edit_image_knowledge_section') {

            $all_data = $this->comman_model->get_data_by_id($table, array('id' => $id));
            $result = $this->comman_model->update_data_by_id($table, array('image' => ''), 'id', $id);

            if ($result) {

                if (file_exists("assets/uploads/" . $path . "/full/" . $all_data['image']))
                    unlink("assets/uploads/" . $path . "/full/" . $all_data['image']);

                if (file_exists("assets/uploads/" . $path . "/small/" . $all_data['image']))
                    unlink("assets/uploads/" . $path . "/small/" . $all_data['image']);

                if (file_exists("assets/uploads/" . $path . "/thumbnails/" . $all_data['image']))
                    unlink("assets/uploads/" . $path . "/thumbnails/" . $all_data['image']);
            }
            
            if($is_ajax == true){
                echo "success";exit;
            }
            
            $this->session->set_flashdata('success', $name . ' has successfully deleted.');
            redirect('admin/index/edit_knowledge_subtitle/' . $id);
        } else if ($page == 'edit_file_section') {

            $all_data = $this->comman_model->get_data_by_id($table, array('id' => $id));
            $result = $this->comman_model->update_data_by_id($table, array('file' => ''), 'id', $id);

            if ($result) {

                if (file_exists("assets/uploads/" . $path . "/file/" . $all_data['file']))
                    unlink("assets/uploads/" . $path . "/file/" . $all_data['file']);
            }
            if($is_ajax == true){
                echo "success";exit;
            }
            $this->session->set_flashdata('success', $name . ' has successfully deleted.');
            redirect('admin/index/edit_promotion_section/' . $id);
        } else if ($page == 'edit_video_section') {
            $result = $this->comman_model->update_data_by_id($table, array('video' => ''), 'id', $id);
            
            if($is_ajax == true){
                echo "success";exit;
            }
            
            $this->session->set_flashdata('success', $name . ' has successfully deleted.');
            redirect('admin/edit_promotion_section/' . $id);
        } else {
            foreach ($delete_data as $item) {
                $this->comman_model->delete_block_email_list_by_id($item['email']);
            }

            $all_data = $this->comman_model->get_data_by_id($table, array('id' => $id));

            $result = $this->comman_model->delete_by_id($table, array('id' => $id));


            if ($result) {

                if (file_exists("assets/uploads/" . $path . "/full/" . $all_data[$column]))
                    unlink("assets/uploads/" . $path . "/full/" . $all_data[$column]);


                if (file_exists("assets/uploads/" . $path . "/small/" . $all_data[$column]))
                    unlink("assets/uploads/" . $path . "/small/" . $all_data[$column]);

                if (file_exists("assets/uploads/" . $path . "/thumbnails/" . $all_data[$column]))
                    unlink("assets/uploads/" . $path . "/thumbnails/" . $all_data[$column]);
            }
            
            if($is_ajax == true){
                echo "success";exit;
            }

            $this->session->set_flashdata('success', $name . ' has successfully deleted.');
            redirect('admin/index/' . $page);
        }
    }

    function delete_question($page = false, $id = false) {
        $this->validateLogin();
        if (!$page) {
            redirect('admin/index/');
        }
        if (!$id) {
            redirect('admin/index/question' . $page);
        }
        $data = array();
        $data['login'] = $this->session->all_userdata();
        $result = $this->comman_model->delete_by_id('question', array('id' => $id));
        $this->session->set_flashdata('success', 'Question has successfully deleted.');
        redirect('admin/index/question/' . $page);
    }

    function empty_data($page = false, $id = false) {
        $this->validateLogin();
        if (!$page) {
            redirect('admin/index/welcome_page');
        }
        if ($page == 'logo') {
            $field = array('logo' => '', 'name' => '');
            $column = 'logo';
            $name = 'Logo';
            $path = 'logo';
        } else if ($page == 'background') {
            $field = array('background_image' => '');
            $column = 'background_image';
            $name = 'Background';
            $path = 'background';
        } else if ($page == 'library') {
            $field = array('library_image' => '');
            $column = 'library_image';
            $name = 'Library';
            $path = 'background';
        } else if ($page == 'footer_name') {
            $field = array('footer_name' => '');
            $name = 'Footer';
        } else if ($page == 'globe') {
            $field = array('globe_image' => '');
            $column = 'globe_image';
            $name = 'Globe ';
            $path = 'logo';
        } else if ($page == 'cart_photo') {
            $field = array('cart_photo' => '');
            $column = 'cart_photo';
            $name = 'Cart';
            $path = 'cart';
        } else if ($page == 'footer') {
            $field = array('footer_image' => '');
            $column = 'footer_image';
            $name = 'Footer';
            $path = 'footer';
        } else {
            redirect('admin/index/welcome_page');
        }
        if (!$id) {
            redirect('admin/index/welcome_page');
        }

        $data = array();
        $data['login'] = $this->session->all_userdata();
        $check = $this->comman_model->get_data_by_id('home_page', array('id' => $id));


        if (empty($check)) {
            redirect('admin/index/welcome_page');
        }
        $result = $this->comman_model->update_data_by_id('home_page', $field, 'id', $id);

        if ($result) {

            if (file_exists("assets/uploads/" . $path . "/" . $check[$column]))
                unlink("assets/uploads/" . $path . "/" . $check[$column]);


            if (file_exists("assets/uploads/" . $path . "/full/" . $check[$column]))
                unlink("assets/uploads/" . $path . "/full/" . $check[$column]);


            if (file_exists("assets/uploads/" . $path . "/small/" . $check[$column]))
                unlink("assets/uploads/" . $path . "/small/" . $check[$column]);

            if (file_exists("assets/uploads/" . $path . "/thumbnails/" . $check[$column]))
                unlink("assets/uploads/" . $path . "/thumbnails/" . $check[$column]);

            $this->session->set_flashdata('success', $name . ' has successfully deleted.');
        }
        if ($page == 'library') {
            redirect('admin/index/library_page');
        } else {
            redirect('admin/index/welcome_page');
        }
    }

    function contact_page() {
        $this->check_lang();
        $this->validateLogin();
        $data = array();
        $data['title'] = 'Welcome To CompanyName';
        $data['login'] = $this->session->all_userdata();
        $data['active'] = 'contact_section';
        $data['name'] = 'contact';
        $this->load->view('admin/header', $data);
        $this->load->view('admin/left_menu', $data);
        $this->load->view('admin/home_page', $data);
        //$this->load->view('admin/content',$data);
        //$this->load->view('admin/add_tip_of_day',$data);
        $this->load->view('admin/footer', $data);
    }

    function contact_user_block() {
        $this->check_lang();
        $this->validateLogin();
        $data = array();
        $data['login'] = $this->session->all_userdata();
        $data['title'] = 'Welcome To CompanyName';
        $data['active'] = 'contact_section';
        $data['label'] = 'Block User List';
        $data['all_data1'] = $this->comman_model->all_data('contact_form');
        $this->load->view('admin/header', $data);
        $this->load->view('admin/left_menu', $data);
        $this->load->view('admin/contact_user_list', $data);
        $this->load->view('admin/footer', $data);
    }

    function contact_user() {
        $this->check_lang();
        $this->validateLogin();
        $data = array();
        $data['login'] = $this->session->all_userdata();
        $data['title'] = 'Welcome To CompanyName';
        $data['label'] = 'User List';
        $data['active'] = 'contact_section';
        $data['all_data'] = $this->comman_model->all_data('contact_form');
        $this->load->view('admin/header', $data);
        $this->load->view('admin/left_menu', $data);
        $this->load->view('admin/contact_user_list', $data);
        $this->load->view('admin/footer', $data);
    }

    function promotion_page() {
        $this->check_lang();
        $this->validateLogin();
        $data = array();
        $data['title'] = 'Welcome To CompanyName';
        $data['login'] = $this->session->all_userdata();
        $data['active'] = 'promotion_section';
        $data['name'] = 'Promotion';
        $this->load->view('admin/header', $data);
        $this->load->view('admin/left_menu', $data);
        $this->load->view('admin/home_page', $data);
        //$this->load->view('admin/content',$data);
        //$this->load->view('admin/add_tip_of_day',$data);
        $this->load->view('admin/footer', $data);
    }

    function promotion_category() {
        $this->check_lang();
        $this->validateLogin();
        $data = array();
        $data['login'] = $this->session->all_userdata();
        $data['title'] = 'Welcome To CompanyName';
        $data['active'] = 'promotion_section';
        $data['all_data'] = $this->comman_model->all_data('promotion_category');
        $this->load->view('admin/header', $data);
        $this->load->view('admin/left_menu', $data);
        $this->load->view('admin/promotion_category_list', $data);
        $this->load->view('admin/footer', $data);
    }

    function add_promotion_category() {
        $this->check_lang();
        $this->validateLogin();
        $data = array();
        $data['login'] = $this->session->all_userdata();
        $data['title'] = 'Welcome To CompanyName';
        $data['active'] = 'bookies';
        $data['sub_menu'] = 'add_article';
        if ($this->input->post('operation')) {
            if (!empty($_FILES['file']['name'])) {
                $field_name = 'file';
                $config['upload_path'] = './assets/uploads/promotion_section/full/';
                $config['allowed_types'] = 'gif|jpg|png|GIF|JPG|PNG';
                $config['max_size'] = '900';
                $config['max_width'] = '2000';
                $config['max_height'] = '2000';
                $this->load->library('upload', $config);

                if (!$this->upload->do_upload($field_name)) {
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                    redirect('admin/index/add_promotion_category');
                } else {
                    $upload_data = $this->upload->data();
                    $this->load->library('image_lib');
                    $config['image_library'] = 'gd2';
                    $config['source_image'] = 'assets/uploads/promotion_section/full/' . $upload_data['file_name'];
                    $config['new_image'] = 'assets/uploads/promotion_section/thumbnails/' . $upload_data['file_name'];
                    $config['maintain_ratio'] = TRUE;
                    $config['width'] = 450;
                    $config['height'] = 450;
                    $this->image_lib->initialize($config);
                    $this->image_lib->resize();
                    $this->image_lib->clear();

                    $config['image_library'] = 'gd2';
                    $config['source_image'] = 'assets/uploads/promotion_section/full/' . $upload_data['file_name'];
                    $config['new_image'] = 'assets/uploads/promotion_section/small/' . $upload_data['file_name'];
                    $config['maintain_ratio'] = TRUE;
                    $config['width'] = 100;
                    $config['height'] = 100;
                    $this->image_lib->initialize($config);
                    $this->image_lib->resize();
                    $this->image_lib->clear();
                }
                $post_data = array(
                    'name' => $this->input->post('title'),
                    'image' => $upload_data['file_name'],
                    'create_date' => time(),
                    'status' => 1
                );
                $result = $this->comman_model->add('promotion_category', $post_data);
                $this->session->set_flashdata('success', 'Category has been successfully added.');
                redirect('admin/index/promotion_category');
            }
        }
        $this->load->view('admin/header', $data);
        $this->load->view('admin/left_menu', $data);
        $this->load->view('admin/add_promotion_category', $data);
        $this->load->view('admin/footer', $data);
    }

    function edit_promotion_category($id = false) {
        if (!$id) {
            redirect('admin/index/promotion_category');
        }
        $this->check_lang();
        $this->validateLogin();
        $data = array();
        $data['login'] = $this->session->all_userdata();
        $data['title'] = 'Welcome To CompanyName';
        $data['active'] = 'bookies';
        $data['sub_menu'] = 'add_article';
        if ($this->input->post('operation')) {
            if (!empty($_FILES['file']['name'])) {
                $field_name = 'file';
                $config['upload_path'] = './assets/uploads/promotion_section/full/';
                $config['allowed_types'] = 'gif|jpg|png|GIF|JPG|PNG';
                $config['max_size'] = '900';
                $config['max_width'] = '2000';
                $config['max_height'] = '2000';
                $this->load->library('upload', $config);

                if (!$this->upload->do_upload($field_name)) {
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                    redirect('admin/index/edit_promotion_category');
                } else {
                    $upload_data = $this->upload->data();
                    $this->load->library('image_lib');
                    $config['image_library'] = 'gd2';
                    $config['source_image'] = 'assets/uploads/promotion_section/full/' . $upload_data['file_name'];
                    $config['new_image'] = 'assets/uploads/promotion_section/thumbnails/' . $upload_data['file_name'];
                    $config['maintain_ratio'] = TRUE;
                    $config['width'] = 450;
                    $config['height'] = 450;
                    $this->image_lib->initialize($config);
                    $this->image_lib->resize();
                    $this->image_lib->clear();

                    $config['image_library'] = 'gd2';
                    $config['source_image'] = 'assets/uploads/promotion_section/full/' . $upload_data['file_name'];
                    $config['new_image'] = 'assets/uploads/promotion_section/small/' . $upload_data['file_name'];
                    $config['maintain_ratio'] = TRUE;
                    $config['width'] = 100;
                    $config['height'] = 100;
                    $this->image_lib->initialize($config);
                    $this->image_lib->resize();
                    $this->image_lib->clear();
                }
            }
            if (!empty($_FILES['file']['name'])) {
                $post_data = array(
                    'name' => $this->input->post('title'),
                    'image' => $upload_data['file_name'],
                    'update_date' => time(),
                );
            } else {
                $post_data = array(
                    'name' => $this->input->post('title'),
                    'update_date' => time(),
                );
            }
            $result = $this->comman_model->update_data_by_id('promotion_category', $post_data, 'id', $id);
            $this->session->set_flashdata('success', 'Category has been successfully updated.');
            redirect('admin/index/promotion_category');
        }
        $data['edit_data'] = $this->comman_model->get_data_by_id('promotion_category', array('id' => $id));
        $this->load->view('admin/header', $data);
        $this->load->view('admin/left_menu', $data);
        $this->load->view('admin/edit_promotion_category', $data);
        $this->load->view('admin/footer', $data);
    }

    function knowledge_subtitle() {
        $this->check_lang();
        $this->validateLogin();
        $data = array();
        $data['login'] = $this->session->all_userdata();
        $data['title'] = 'Welcome To CompanyName';
        $data['active'] = 'promotion_section';
        $data['all_data'] = $this->comman_model->get_all_data_by_id('promotion_section', array('parent_id !=' => 0));
        $this->load->view('admin/header', $data);
        $this->load->view('admin/left_menu', $data);
        $this->load->view('admin/knowledge_sub_list', $data);
        $this->load->view('admin/footer', $data);
    }

    function add_knowledge_subtitle() {
        $this->validateLogin();
        $data = array();
        $data['login'] = $this->session->all_userdata();
        $data['title'] = 'Welcome To CompanyName';
        $data['active'] = 'promotion_section';
        if ($this->input->post('operation')) {
            if (!empty($_FILES['file']['name'])) {
                $field_name = 'file';
                $config['upload_path'] = './assets/uploads/promotion_section/file/';
                $config['allowed_types'] = 'doc|docx|DOC|DOCX|pdf|jpg|JPG|mp4|MP4';
                $config['max_size'] = '10000';
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if (!$this->upload->do_upload($field_name)) {
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                    redirect('admin/index/add_knowledge_subtitle');
                } else {
                    $upload_data1 = $this->upload->data();
                }
            }
            if (!empty($_FILES['photo']['name'])) {
                $field_name = 'photo';
                $config['upload_path'] = './assets/uploads/promotion_section/full/';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = '800';
                $config['max_width'] = '2000';
                $config['max_height'] = '2000';
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if (!$this->upload->do_upload($field_name)) {
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                    redirect('admin/index/add_knowledge_subtitle');
                } else {
                    $upload_data = $this->upload->data();
                    $this->load->library('image_lib');
                    $config['image_library'] = 'gd2';
                    $config['source_image'] = 'assets/uploads/promotion_section/full/' . $upload_data['file_name'];
                    $config['new_image'] = 'assets/uploads/promotion_section/thumbnails/' . $upload_data['file_name'];
                    $config['maintain_ratio'] = TRUE;
                    $config['width'] = 450;
                    $config['height'] = 450;
                    $this->image_lib->initialize($config);
                    $this->image_lib->resize();
                    $this->image_lib->clear();

                    $config['image_library'] = 'gd2';
                    $config['source_image'] = 'assets/uploads/promotion_section/full/' . $upload_data['file_name'];
                    $config['new_image'] = 'assets/uploads/promotion_section/small/' . $upload_data['file_name'];
                    $config['maintain_ratio'] = TRUE;
                    $config['width'] = 100;
                    $config['height'] = 100;
                    $this->image_lib->initialize($config);
                    $this->image_lib->resize();
                    $this->image_lib->clear();
                }
            }

            if (!empty($_FILES['video']['name'])) {
                $configVideo['upload_path'] = './assets/uploads/promotion_section/video/';
                $configVideo['max_size'] = '190240';
//				$configVideo['allowed_types'] = 'avi|flv|wmv|mp4';
                $configVideo['allowed_types'] = 'mp4|MP4';
                $configVideo['overwrite'] = FALSE;
                $configVideo['remove_spaces'] = TRUE;
                $video_name = $_FILES['video']['name'];
                $configVideo['file_name'] = $video_name;
                $this->load->library('upload', $configVideo);
                $this->upload->initialize($configVideo);
                if (!$this->upload->do_upload('video')) {
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                    redirect('admin/index/add_knowledge_subtitle');
                } else {
                    $videoDetails = $this->upload->data();
                }
            }

            if (!empty($_FILES['photo']['name'])) {
                if (!empty($_FILES['video']['name'])) {
                    if (!empty($_FILES['file']['name'])) {
                        $post_data = array('name' => $this->input->post('title'),
                            'sort' => $this->input->post('sort'),
                            'parent_id' => $this->input->post('type'),
                            'file' => $upload_data1['file_name'],
                            'image' => $upload_data['file_name'],
                            'video' => $videoDetails['file_name'],
                            'description' => $this->input->post('description'),
                            'status' => 1,
                            'create_date' => time());
                    } else {
                        $post_data = array('name' => $this->input->post('title'),
                            'sort' => $this->input->post('sort'),
                            'parent_id' => $this->input->post('type'),
                            'image' => $upload_data['file_name'],
                            'video' => $videoDetails['file_name'],
                            'description' => $this->input->post('description'),
                            'status' => 1,
                            'create_date' => time());
                    }
                } else {
                    if (!empty($_FILES['file']['name'])) {
                        $post_data = array('name' => $this->input->post('title'),
                            'sort' => $this->input->post('sort'),
                            'parent_id' => $this->input->post('type'),
                            'file' => $upload_data1['file_name'],
                            'image' => $upload_data['file_name'],
                            'description' => $this->input->post('description'),
                            'status' => 1,
                            'create_date' => time());
                    } else {
                        $post_data = array('name' => $this->input->post('title'),
                            'sort' => $this->input->post('sort'),
                            'parent_id' => $this->input->post('type'),
                            'image' => $upload_data['file_name'],
                            'description' => $this->input->post('description'),
                            'status' => 1,
                            'create_date' => time());
                    }
                }
            } else {
                if (!empty($_FILES['video']['name'])) {
                    if (!empty($_FILES['file']['name'])) {
                        $post_data = array('name' => $this->input->post('title'),
                            'sort' => $this->input->post('sort'),
                            'parent_id' => $this->input->post('type'),
                            'file' => $upload_data1['file_name'],
                            'video' => $videoDetails['file_name'],
                            'description' => $this->input->post('description'),
                            'status' => 1,
                            'create_date' => time());
                    } else {
                        $post_data = array('name' => $this->input->post('title'),
                            'sort' => $this->input->post('sort'),
                            'parent_id' => $this->input->post('type'),
                            'video' => $videoDetails['file_name'],
                            'description' => $this->input->post('description'),
                            'status' => 1,
                            'create_date' => time());
                    }
                } else {
                    if (!empty($_FILES['file']['name'])) {
                        $post_data = array('name' => $this->input->post('title'),
                            'sort' => $this->input->post('sort'),
                            'parent_id' => $this->input->post('type'),
                            'file' => $upload_data1['file_name'],
                            'description' => $this->input->post('description'),
                            'status' => 1,
                            'create_date' => time());
                    } else {
                        $post_data = array('name' => $this->input->post('title'),
                            'sort' => $this->input->post('sort'),
                            'parent_id' => $this->input->post('type'),
                            'description' => $this->input->post('description'),
                            'status' => 1,
                            'create_date' => time());
                    }
                }
            }
            $result = $this->comman_model->add('promotion_section', $post_data);
            $this->session->set_flashdata('success', 'Knowledge Subtitle has been successfully added.');
            redirect('admin/index/knowledge_subtitle');
        }
        $this->load->view('admin/header', $data);
        $this->load->view('admin/left_menu', $data);
        $this->load->view('admin/add_knowledge', $data);
        $this->load->view('admin/footer', $data);
    }

    function edit_knowledge_subtitle($id = false) {
        if (!$id) {
            redirect('admin/index/edit_knowledge_subtitle');
        }
        $this->validateLogin();
        $data = array();
        $data['login'] = $this->session->all_userdata();
        $data['title'] = 'Welcome To CompanyName';
        $data['active'] = 'promotion_section';
        if ($this->input->post('operation')) {
            if (!empty($_FILES['file']['name'])) {
                $field_name = 'file';
                $config['upload_path'] = './assets/uploads/promotion_section/file/';
                $config['allowed_types'] = 'doc|docx|DOC|DOCX|pdf|jpg|JPG|mp4|MP4';
                $config['max_size'] = '10000';
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if (!$this->upload->do_upload($field_name)) {
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                    redirect('admin/index/edit_knowledge_subtitle/' . $id);
                } else {
                    $upload_data1 = $this->upload->data();
                }
            }

            if (!empty($_FILES['photo']['name'])) {
                $field_name = 'photo';
                $config['upload_path'] = './assets/uploads/promotion_section/full/';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = '800';
                $config['max_width'] = '2000';
                $config['max_height'] = '2000';
                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                if (!$this->upload->do_upload($field_name)) {
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                    redirect('admin/index/edit_knowledge_subtitle/' . $id);
                } else {
                    $upload_data = $this->upload->data();
                    $this->load->library('image_lib');
                    $config['image_library'] = 'gd2';
                    $config['source_image'] = 'assets/uploads/promotion_section/full/' . $upload_data['file_name'];
                    $config['new_image'] = 'assets/uploads/promotion_section/thumbnails/' . $upload_data['file_name'];
                    $config['maintain_ratio'] = TRUE;
                    $config['width'] = 450;
                    $config['height'] = 450;
                    $this->image_lib->initialize($config);
                    $this->image_lib->resize();
                    $this->image_lib->clear();

                    $config['image_library'] = 'gd2';
                    $config['source_image'] = 'assets/uploads/promotion_section/full/' . $upload_data['file_name'];
                    $config['new_image'] = 'assets/uploads/promotion_section/small/' . $upload_data['file_name'];
                    $config['maintain_ratio'] = TRUE;
                    $config['width'] = 100;
                    $config['height'] = 100;
                    $this->image_lib->initialize($config);
                    $this->image_lib->resize();
                    $this->image_lib->clear();
                }
            }

            if (!empty($_FILES['video']['name'])) {
                $configVideo['upload_path'] = './assets/uploads/promotion_section/video/';
                $configVideo['max_size'] = '190240';
                $configVideo['allowed_types'] = 'avi|flv|wmv|mp4';
                $configVideo['allowed_types'] = 'mp4|MP4';
                $configVideo['overwrite'] = FALSE;
                $configVideo['remove_spaces'] = TRUE;
                $video_name = $_FILES['video']['name'];
                $configVideo['file_name'] = $video_name;
                $this->load->library('upload', $configVideo);
                $this->upload->initialize($configVideo);
                if (!$this->upload->do_upload('video')) {
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                    redirect('admin/index/edit_knowledge_subtitle/' . $id);
                } else {
                    $videoDetails = $this->upload->data();
                }
            }
            if (!empty($_FILES['photo']['name'])) {
                if (!empty($_FILES['video']['name'])) {
                    if (!empty($_FILES['file']['name'])) {
                        $post_data = array('name' => $this->input->post('title'),
                            'sort' => $this->input->post('sort'),
                            'parent_id' => $this->input->post('type'),
                            'file' => $upload_data1['file_name'],
                            'image' => $upload_data['file_name'],
                            'video' => $videoDetails['file_name'],
                            'description' => $this->input->post('description'),
                            'update_date' => time());
                    } else {
                        $post_data = array('name' => $this->input->post('title'),
                            'sort' => $this->input->post('sort'),
                            'parent_id' => $this->input->post('type'),
                            'image' => $upload_data['file_name'],
                            'video' => $videoDetails['file_name'],
                            'description' => $this->input->post('description'),
                            'update_date' => time());
                    }
                } else {
                    if (!empty($_FILES['file']['name'])) {
                        $post_data = array('name' => $this->input->post('title'),
                            'sort' => $this->input->post('sort'),
                            'parent_id' => $this->input->post('type'),
                            'file' => $upload_data1['file_name'],
                            'image' => $upload_data['file_name'],
                            'description' => $this->input->post('description'),
                            'update_date' => time());
                    } else {
                        $post_data = array('name' => $this->input->post('title'),
                            'sort' => $this->input->post('sort'),
                            'parent_id' => $this->input->post('type'),
                            'image' => $upload_data['file_name'],
                            'description' => $this->input->post('description'),
                            'update_date' => time());
                    }
                }
            } else {
                if (!empty($_FILES['video']['name'])) {
                    if (!empty($_FILES['file']['name'])) {
                        $post_data = array('name' => $this->input->post('title'),
                            'sort' => $this->input->post('sort'),
                            'parent_id' => $this->input->post('type'),
                            'file' => $upload_data1['file_name'],
                            'video' => $videoDetails['file_name'],
                            'description' => $this->input->post('description'),
                            'update_date' => time());
                    } else {
                        $post_data = array('name' => $this->input->post('title'),
                            'sort' => $this->input->post('sort'),
                            'parent_id' => $this->input->post('type'),
                            'video' => $videoDetails['file_name'],
                            'description' => $this->input->post('description'),
                            'update_date' => time());
                    }
                } else {
                    if (!empty($_FILES['file']['name'])) {
                        $post_data = array('name' => $this->input->post('title'),
                            'sort' => $this->input->post('sort'),
                            'parent_id' => $this->input->post('type'),
                            'file' => $upload_data1['file_name'],
                            'description' => $this->input->post('description'),
                            'update_date' => time());
                    } else {
                        $post_data = array('name' => $this->input->post('title'),
                            'sort' => $this->input->post('sort'),
                            'parent_id' => $this->input->post('type'),
                            'description' => $this->input->post('description'),
                            'update_date' => time());
                    }
                }
            }

            $path = 'promotion_section';

            $all_data = $this->comman_model->get_data_by_id('promotion_section', array('id' => $id));
            $result = $this->comman_model->update_data_by_id('promotion_section', $post_data, 'id', $id);

            if ($result) {

                if ($post_data['image']) {

                    if (file_exists("assets/uploads/" . $path . "/full/" . $all_data['image']))
                        unlink("assets/uploads/" . $path . "/full/" . $all_data['image']);

                    if (file_exists("assets/uploads/" . $path . "/small/" . $all_data['image']))
                        unlink("assets/uploads/" . $path . "/small/" . $all_data['image']);

                    if (file_exists("assets/uploads/" . $path . "/thumbnails/" . $all_data['image']))
                        unlink("assets/uploads/" . $path . "/thumbnails/" . $all_data['image']);
                }

                if ($post_data['file']) {
                    if (file_exists("assets/uploads/" . $path . "/file/" . $all_data['file']))
                        unlink("assets/uploads/" . $path . "/file/" . $all_data['file']);
                }

                if ($post_data['video']) {
                    if (file_exists("assets/uploads/" . $path . "/video/" . $all_data['video']))
                        unlink("assets/uploads/" . $path . "/video/" . $all_data['video']);
                }
            }

            $this->session->set_flashdata('success', 'Knowledge Subtitle has been successfully updated.');
            redirect('admin/index/knowledge_subtitle');
        }
        $data['edit_data'] = $this->comman_model->get_data_by_id('promotion_section', array('id' => $id));
        $this->load->view('admin/header', $data);
        $this->load->view('admin/left_menu', $data);
        $this->load->view('admin/edit_knowledge_subtitle', $data);
        $this->load->view('admin/footer', $data);
    }

    function promotion_section() {
        $this->check_lang();
        $this->validateLogin();
        $data = array();
        $data['login'] = $this->session->all_userdata();
        $data['title'] = 'Welcome To CompanyName';
        $data['active'] = 'promotion_section';
        $data['all_data'] = $this->comman_model->all_data('promotion_section');
        $this->load->view('admin/header', $data);
        $this->load->view('admin/left_menu', $data);
        $this->load->view('admin/promotion_list', $data);
        $this->load->view('admin/footer', $data);
    }

    function add_promotion_section() {
        $this->validateLogin();
        $data = array();
        $data['login'] = $this->session->all_userdata();
        $data['title'] = 'Welcome To CompanyName';
        $data['active'] = 'promotion_section';
        if ($this->input->post('operation')) {
            if (!empty($_FILES['file']['name'])) {
                $field_name = 'file';
                $config['upload_path'] = './assets/uploads/promotion_section/file/';
                $config['allowed_types'] = 'doc|docx|DOC|DOCX|pdf|jpg|JPG|mp4|MP4|png|PNG';
                $config['max_size'] = '10000';
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if (!$this->upload->do_upload($field_name)) {
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                    redirect('admin/index/add_promotion_section');
                } else {
                    $upload_data1 = $this->upload->data();
                }
            }
            if (!empty($_FILES['photo']['name'])) {
                $field_name = 'photo';
                $config['upload_path'] = './assets/uploads/promotion_section/full/';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = '800';
                $config['max_width'] = '2000';
                $config['max_height'] = '2000';
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if (!$this->upload->do_upload($field_name)) {
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                    redirect('admin/index/add_promotion_section');
                } else {
                    $upload_data = $this->upload->data();
                    $this->load->library('image_lib');
                    $config['image_library'] = 'gd2';
                    $config['source_image'] = 'assets/uploads/promotion_section/full/' . $upload_data['file_name'];
                    $config['new_image'] = 'assets/uploads/promotion_section/thumbnails/' . $upload_data['file_name'];
                    $config['maintain_ratio'] = TRUE;
                    $config['width'] = 450;
                    $config['height'] = 450;
                    $this->image_lib->initialize($config);
                    $this->image_lib->resize();
                    $this->image_lib->clear();

                    $config['image_library'] = 'gd2';
                    $config['source_image'] = 'assets/uploads/promotion_section/full/' . $upload_data['file_name'];
                    $config['new_image'] = 'assets/uploads/promotion_section/small/' . $upload_data['file_name'];
                    $config['maintain_ratio'] = TRUE;
                    $config['width'] = 100;
                    $config['height'] = 100;
                    $this->image_lib->initialize($config);
                    $this->image_lib->resize();
                    $this->image_lib->clear();
                }
            }

            if (!empty($_FILES['video']['name'])) {
                $configVideo['upload_path'] = './assets/uploads/promotion_section/video/';
                $configVideo['max_size'] = '19024000';
//				$configVideo['allowed_types'] = 'avi|flv|wmv|mp4';
                $configVideo['allowed_types'] = 'mp4|MP4|PNG|png';
                $configVideo['overwrite'] = FALSE;
                $configVideo['remove_spaces'] = TRUE;
                $video_name = $_FILES['video']['name'];
                $configVideo['file_name'] = $video_name;
                $this->load->library('upload', $configVideo);
                $this->upload->initialize($configVideo);
                if (!$this->upload->do_upload('video')) {
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                    redirect('admin/index/add_promotion_section');
                } else {
                    $videoDetails = $this->upload->data();
                }
            }

            if (!empty($_FILES['photo']['name'])) {
                if (!empty($_FILES['video']['name'])) {
                    if (!empty($_FILES['file']['name'])) {
                        $post_data = array('name' => $this->input->post('title'),
                            'sort' => $this->input->post('sort'),
                            'type' => $this->input->post('type'),
                            'file' => $upload_data1['file_name'],
                            'image' => $upload_data['file_name'],
                            'video' => $videoDetails['file_name'],
                            'description' => $this->input->post('description'),
                            'status' => 1,
                            'create_date' => time());
                    } else {
                        $post_data = array('name' => $this->input->post('title'),
                            'sort' => $this->input->post('sort'),
                            'type' => $this->input->post('type'),
                            'image' => $upload_data['file_name'],
                            'video' => $videoDetails['file_name'],
                            'description' => $this->input->post('description'),
                            'status' => 1,
                            'create_date' => time());
                    }
                } else {
                    if (!empty($_FILES['file']['name'])) {
                        $post_data = array('name' => $this->input->post('title'),
                            'sort' => $this->input->post('sort'),
                            'type' => $this->input->post('type'),
                            'file' => $upload_data1['file_name'],
                            'image' => $upload_data['file_name'],
                            'description' => $this->input->post('description'),
                            'status' => 1,
                            'create_date' => time());
                    } else {
                        $post_data = array('name' => $this->input->post('title'),
                            'sort' => $this->input->post('sort'),
                            'type' => $this->input->post('type'),
                            'image' => $upload_data['file_name'],
                            'description' => $this->input->post('description'),
                            'status' => 1,
                            'create_date' => time());
                    }
                }
            } else {
                if (!empty($_FILES['video']['name'])) {
                    if (!empty($_FILES['file']['name'])) {
                        $post_data = array('name' => $this->input->post('title'),
                            'sort' => $this->input->post('sort'),
                            'type' => $this->input->post('type'),
                            'file' => $upload_data1['file_name'],
                            'video' => $videoDetails['file_name'],
                            'description' => $this->input->post('description'),
                            'status' => 1,
                            'create_date' => time());
                    } else {
                        $post_data = array('name' => $this->input->post('title'),
                            'sort' => $this->input->post('sort'),
                            'type' => $this->input->post('type'),
                            'video' => $videoDetails['file_name'],
                            'description' => $this->input->post('description'),
                            'status' => 1,
                            'create_date' => time());
                    }
                } else {
                    if (!empty($_FILES['file']['name'])) {
                        $post_data = array('name' => $this->input->post('title'),
                            'sort' => $this->input->post('sort'),
                            'type' => $this->input->post('type'),
                            'file' => $upload_data1['file_name'],
                            'description' => $this->input->post('description'),
                            'status' => 1,
                            'create_date' => time());
                    } else {
                        $post_data = array('name' => $this->input->post('title'),
                            'sort' => $this->input->post('sort'),
                            'type' => $this->input->post('type'),
                            'description' => $this->input->post('description'),
                            'status' => 1,
                            'create_date' => time());
                    }
                }
            }


            $result = $this->comman_model->add('promotion_section', $post_data);
            $this->session->set_flashdata('success', 'Promotion Section has been successfully added.');
            redirect('admin/index/promotion_section');
        }
        $this->load->view('admin/header', $data);
        $this->load->view('admin/left_menu', $data);
        $this->load->view('admin/add_promotion', $data);
        $this->load->view('admin/footer', $data);
    }

    function edit_promotion_section($id = false) {
        if (!$id) {
            redirect('admin/index/promotion_section');
        }
        $this->validateLogin();
        $data = array();
        $data['login'] = $this->session->all_userdata();
        $data['title'] = 'Welcome To CompanyName';
        $data['active'] = 'promotion_section';
        if ($this->input->post('operation')) {
            if (!empty($_FILES['file']['name'])) {
                $field_name = 'file';
                $config['upload_path'] = './assets/uploads/promotion_section/file/';
                $config['allowed_types'] = 'png|PNG|doc|docx|DOC|DOCX|pdf|jpg|JPG|mp4|MP4';
                $config['max_size'] = '10000';
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if (!$this->upload->do_upload($field_name)) {
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                    redirect('admin/index/edit_promotion_section/' . $id);
                } else {
                    $upload_data1 = $this->upload->data();
                }
            }

            if (!empty($_FILES['photo']['name'])) {
                $field_name = 'photo';
                $config['upload_path'] = './assets/uploads/promotion_section/full/';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = '800';
                $config['max_width'] = '2000';
                $config['max_height'] = '2000';
                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                if (!$this->upload->do_upload($field_name)) {
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                    redirect('admin/index/edit_promotion_section/' . $id);
                } else {
                    $upload_data = $this->upload->data();
                    $this->load->library('image_lib');
                    $config['image_library'] = 'gd2';
                    $config['source_image'] = 'assets/uploads/promotion_section/full/' . $upload_data['file_name'];
                    $config['new_image'] = 'assets/uploads/promotion_section/thumbnails/' . $upload_data['file_name'];
                    $config['maintain_ratio'] = TRUE;
                    $config['width'] = 450;
                    $config['height'] = 450;
                    $this->image_lib->initialize($config);
                    $this->image_lib->resize();
                    $this->image_lib->clear();

                    $config['image_library'] = 'gd2';
                    $config['source_image'] = 'assets/uploads/promotion_section/full/' . $upload_data['file_name'];
                    $config['new_image'] = 'assets/uploads/promotion_section/small/' . $upload_data['file_name'];
                    $config['maintain_ratio'] = TRUE;
                    $config['width'] = 100;
                    $config['height'] = 100;
                    $this->image_lib->initialize($config);
                    $this->image_lib->resize();
                    $this->image_lib->clear();
                }
            }

            if (!empty($_FILES['video']['name'])) {
                $configVideo['upload_path'] = './assets/uploads/promotion_section/video/';
                $configVideo['max_size'] = '190240';
//				$configVideo['allowed_types'] = 'avi|flv|wmv|mp4';
                $configVideo['allowed_types'] = 'mp4|MP4';
                $configVideo['overwrite'] = FALSE;
                $configVideo['remove_spaces'] = TRUE;
                $video_name = $_FILES['video']['name'];
                $configVideo['file_name'] = $video_name;
                $this->load->library('upload', $configVideo);
                $this->upload->initialize($configVideo);
                if (!$this->upload->do_upload('video')) {
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                    redirect('admin/index/edit_promotion_section/' . $id);
                } else {
                    $videoDetails = $this->upload->data();
                }
            }
            if (!empty($_FILES['photo']['name'])) {
                if (!empty($_FILES['video']['name'])) {
                    if (!empty($_FILES['file']['name'])) {
                        $post_data = array('name' => $this->input->post('title'),
                            'sort' => $this->input->post('sort'),
                            //'category_id'=>$this->input->post('category'),
                            'type' => $this->input->post('type'),
                            'file' => $upload_data1['file_name'],
                            'image' => $upload_data['file_name'],
                            'video' => $videoDetails['file_name'],
                            'description' => $this->input->post('description'),
                            'update_date' => time());
                    } else {
                        $post_data = array('name' => $this->input->post('title'),
                            'sort' => $this->input->post('sort'),
                            //'category_id'=>$this->input->post('category'),
                            'type' => $this->input->post('type'),
                            'image' => $upload_data['file_name'],
                            'video' => $videoDetails['file_name'],
                            'description' => $this->input->post('description'),
                            'update_date' => time());
                    }
                } else {
                    if (!empty($_FILES['file']['name'])) {
                        $post_data = array('name' => $this->input->post('title'),
                            'sort' => $this->input->post('sort'),
                            //'category_id'=>$this->input->post('category'),
                            'type' => $this->input->post('type'),
                            'file' => $upload_data1['file_name'],
                            'image' => $upload_data['file_name'],
                            'description' => $this->input->post('description'),
                            'update_date' => time());
                    } else {
                        $post_data = array('name' => $this->input->post('title'),
                            'sort' => $this->input->post('sort'),
                            //'category_id'=>$this->input->post('category'),
                            'type' => $this->input->post('type'),
                            'image' => $upload_data['file_name'],
                            'description' => $this->input->post('description'),
                            'update_date' => time());
                    }
                }
            } else {
                if (!empty($_FILES['video']['name'])) {
                    if (!empty($_FILES['file']['name'])) {
                        $post_data = array('name' => $this->input->post('title'),
                            'sort' => $this->input->post('sort'),
                            //'category_id'=>$this->input->post('category'),
                            'type' => $this->input->post('type'),
                            'file' => $upload_data1['file_name'],
                            'video' => $videoDetails['file_name'],
                            'description' => $this->input->post('description'),
                            'update_date' => time());
                    } else {
                        $post_data = array('name' => $this->input->post('title'),
                            'sort' => $this->input->post('sort'),
                            //'category_id'=>$this->input->post('category'),
                            'type' => $this->input->post('type'),
                            'video' => $videoDetails['file_name'],
                            'description' => $this->input->post('description'),
                            'update_date' => time());
                    }
                } else {
                    if (!empty($_FILES['file']['name'])) {
                        $post_data = array('name' => $this->input->post('title'),
                            'sort' => $this->input->post('sort'),
                            //'category_id'=>$this->input->post('category'),
                            'type' => $this->input->post('type'),
                            'file' => $upload_data1['file_name'],
                            'description' => $this->input->post('description'),
                            'update_date' => time());
                    } else {
                        $post_data = array('name' => $this->input->post('title'),
                            'sort' => $this->input->post('sort'),
                            //'category_id'=>$this->input->post('category'),
                            'type' => $this->input->post('type'),
                            'description' => $this->input->post('description'),
                            'update_date' => time());
                    }
                }
            }

            $path = 'promotion_section';

            $all_data = $this->comman_model->get_data_by_id('promotion_section', array('id' => $id));
            $result = $this->comman_model->update_data_by_id('promotion_section', $post_data, 'id', $id);

            if ($result) {

                if ($post_data['image']) {

                    if (file_exists("assets/uploads/" . $path . "/full/" . $all_data['image']))
                        unlink("assets/uploads/" . $path . "/full/" . $all_data['image']);

                    if (file_exists("assets/uploads/" . $path . "/small/" . $all_data['image']))
                        unlink("assets/uploads/" . $path . "/small/" . $all_data['image']);

                    if (file_exists("assets/uploads/" . $path . "/thumbnails/" . $all_data['image']))
                        unlink("assets/uploads/" . $path . "/thumbnails/" . $all_data['image']);
                }

                if ($post_data['file']) {
                    if (file_exists("assets/uploads/" . $path . "/file/" . $all_data['file']))
                        unlink("assets/uploads/" . $path . "/file/" . $all_data['file']);
                }

                if ($post_data['video']) {
                    if (file_exists("assets/uploads/" . $path . "/video/" . $all_data['video']))
                        unlink("assets/uploads/" . $path . "/video/" . $all_data['video']);
                }
            }

            $this->session->set_flashdata('success', 'Promotion Section has been successfully updated.');
            redirect('admin/index/promotion_section');
        }
        $data['edit_data'] = $this->comman_model->get_data_by_id('promotion_section', array('id' => $id));
        $this->load->view('admin/header', $data);
        $this->load->view('admin/left_menu', $data);
        $this->load->view('admin/edit_promotion', $data);
        $this->load->view('admin/footer', $data);
    }

    function view_promotion_section($id = false) {
        if (!$id) {
            redirect('admin/index/promotion_section');
        }
        $this->validateLogin();
        $data = array();
        $data['login'] = $this->session->all_userdata();
        $data['title'] = 'Welcome To CompanyName';
        $data['active'] = 'promotion_section';
        $data['view_data'] = $this->comman_model->get_data_by_id('promotion_section', array('id' => $id));
        $this->load->view('admin/header', $data);
        $this->load->view('admin/left_menu', $data);
        $this->load->view('admin/view_promotion_section', $data);
        $this->load->view('admin/footer', $data);
    }

    function promotion_block_user() {
        $this->check_lang();
        $this->validateLogin();
        $data = array();
        $data['login'] = $this->session->all_userdata();
        $data['title'] = 'Welcome To CompanyName';
        $data['active'] = 'promotion_section';
        $data['label'] = 'Block User List';
        $data['all_data1'] = $this->comman_model->all_data('promotion_form');
        $this->load->view('admin/header', $data);
        $this->load->view('admin/left_menu', $data);
        $this->load->view('admin/promotion_user_list', $data);
        $this->load->view('admin/footer', $data);
    }

    function promotion_user() {
        $this->check_lang();
        $this->validateLogin();
        $data = array();
        $data['login'] = $this->session->all_userdata();
        $data['title'] = 'Welcome To CompanyName';
        $data['label'] = 'Download Request User List';
        $data['active'] = 'promotion_section';
        $data['all_data'] = $this->comman_model->all_data('promotion_form');
        $this->load->view('admin/header', $data);
        $this->load->view('admin/left_menu', $data);
        $this->load->view('admin/promotion_user_list', $data);
        $this->load->view('admin/footer', $data);
    }

    function content() {
        $this->check_lang();
        $this->validateLogin();
        $data = array();
        $data['login'] = $this->session->all_userdata();
        $data['title'] = 'Welcome To CompanyName';
        $data['active'] = 'content';
        $data['all_data'] = $this->comman_model->all_data('content');
        $this->load->view('admin/header', $data);
        $this->load->view('admin/left_menu', $data);
        $this->load->view('admin/content_list', $data);
        $this->load->view('admin/footer', $data);
    }

    function edit_content($id = false) {
        if (!$id) {
            redirect('admin/index/content');
        }
        $this->validateLogin();
        $data = array();
        $data['login'] = $this->session->all_userdata();
        $data['title'] = 'Welcome To CompanyName';
        $data['active'] = 'content';
        if ($this->input->post('about')) {
            if (!empty($_FILES['file']['name'])) {
                $field_name = 'file';
                $config['upload_path'] = './assets/uploads/content/full/';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = '800';
                $config['max_width'] = '2000';
                $config['max_height'] = '2000';
                $this->load->library('upload', $config);

                if (!$this->upload->do_upload($field_name)) {
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                    redirect('admin/index/edit_content/' . $id);
                } else {
                    $upload_data = $this->upload->data();
                    $this->load->library('image_lib');
                    $config['image_library'] = 'gd2';
                    $config['source_image'] = 'assets/uploads/content/full/' . $upload_data['file_name'];
                    $config['new_image'] = 'assets/uploads/content/thumbnails/' . $upload_data['file_name'];
                    $config['maintain_ratio'] = TRUE;
                    $config['width'] = 450;
                    $config['height'] = 450;
                    $this->image_lib->initialize($config);
                    $this->image_lib->resize();
                    $this->image_lib->clear();

                    $config['image_library'] = 'gd2';
                    $config['source_image'] = 'assets/uploads/content/full/' . $upload_data['file_name'];
                    $config['new_image'] = 'assets/uploads/content/small/' . $upload_data['file_name'];
                    $config['maintain_ratio'] = TRUE;
                    $config['width'] = 100;
                    $config['height'] = 100;
                    $this->image_lib->initialize($config);
                    $this->image_lib->resize();
                    $this->image_lib->clear();
                }
            }

            if (!empty($_FILES['video']['name'])) {
                $configVideo['upload_path'] = './assets/uploads/content/video/';
                $configVideo['max_size'] = '190240';
//				$configVideo['allowed_types'] = 'avi|flv|wmv|mp4';
                $configVideo['allowed_types'] = 'mp4|MP4';
                $configVideo['overwrite'] = FALSE;
                $configVideo['remove_spaces'] = TRUE;
                $video_name = $_FILES['video']['name'];
                $configVideo['file_name'] = $video_name;
                $this->load->library('upload', $configVideo);
                $this->upload->initialize($configVideo);
                if (!$this->upload->do_upload('video')) {
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                    redirect('admin/index/edit_content/' . $id);
                } else {
                    $videoDetails = $this->upload->data();
                }
            }
            if (!empty($_FILES['file']['name'])) {
                if (!empty($_FILES['video']['name'])) {
                    $post_data = array('title' => $this->input->post('title'),
                        'sort' => $this->input->post('sort'),
                        'image' => $upload_data['file_name'],
                        'video' => $videoDetails['file_name'],
                        'description' => $this->input->post('description'),
                        'update_date' => time());
                } else {
                    $post_data = array('title' => $this->input->post('title'),
                        'sort' => $this->input->post('sort'),
                        'image' => $upload_data['file_name'],
                        'description' => $this->input->post('description'),
                        'update_date' => time());
                }
            } else {
                if (!empty($_FILES['video']['name'])) {
                    $post_data = array('title' => $this->input->post('title'),
                        'sort' => $this->input->post('sort'),
                        'video' => $videoDetails['file_name'],
                        'description' => $this->input->post('description'),
                        'update_date' => time());
                } else {
                    $post_data = array('title' => $this->input->post('title'),
                        'sort' => $this->input->post('sort'),
                        'description' => $this->input->post('description'),
                        'update_date' => time());
                }
            }
            $result = $this->comman_model->update_data_by_id('content', $post_data, 'id', $id);
            $this->session->set_flashdata('success', 'Content has been successfully updated.');
            redirect('admin/index/content');
        }
        if ($this->input->post('vision')) {
            if (!empty($_FILES['file']['name'])) {
                $field_name = 'file';
                $config['upload_path'] = './assets/uploads/content/full/';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = '800';
                $config['max_width'] = '2000';
                $config['max_height'] = '2000';
                $this->load->library('upload', $config);

                if (!$this->upload->do_upload($field_name)) {
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                    redirect('admin/index/edit_content/' . $id);
                } else {
                    $upload_data = $this->upload->data();
                    $this->load->library('image_lib');
                    $config['image_library'] = 'gd2';
                    $config['source_image'] = 'assets/uploads/content/full/' . $upload_data['file_name'];
                    $config['new_image'] = 'assets/uploads/content/thumbnails/' . $upload_data['file_name'];
                    $config['maintain_ratio'] = TRUE;
                    $config['width'] = 450;
                    $config['height'] = 450;
                    $this->image_lib->initialize($config);
                    $this->image_lib->resize();
                    $this->image_lib->clear();

                    $config['image_library'] = 'gd2';
                    $config['source_image'] = 'assets/uploads/content/full/' . $upload_data['file_name'];
                    $config['new_image'] = 'assets/uploads/content/small/' . $upload_data['file_name'];
                    $config['maintain_ratio'] = TRUE;
                    $config['width'] = 100;
                    $config['height'] = 100;
                    $this->image_lib->initialize($config);
                    $this->image_lib->resize();
                    $this->image_lib->clear();
                }
            }

            if (!empty($_FILES['video']['name'])) {
                $configVideo['upload_path'] = './assets/uploads/content/video/';
                $configVideo['max_size'] = '20000';
//				$configVideo['allowed_types'] = 'avi|flv|wmv|mp4';
                $configVideo['allowed_types'] = 'mp4|MP4';
                $configVideo['overwrite'] = FALSE;
                $configVideo['remove_spaces'] = TRUE;
                $video_name = $_FILES['video']['name'];
                $configVideo['file_name'] = $video_name;
                $this->load->library('upload', $configVideo);
                $this->upload->initialize($configVideo);
                if (!$this->upload->do_upload('video')) {
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                    redirect('admin/index/edit_content/' . $id);
                } else {
                    $videoDetails = $this->upload->data();
                }
            }
            if (!empty($_FILES['file']['name'])) {
                if (!empty($_FILES['video']['name'])) {
                    $post_data = array('title' => $this->input->post('title'),
                        'sort' => $this->input->post('sort'),
                        'image' => $upload_data['file_name'],
                        'video' => $videoDetails['file_name'],
                        'description' => $this->input->post('description'),
                        'update_date' => time());
                } else {
                    $post_data = array('title' => $this->input->post('title'),
                        'sort' => $this->input->post('sort'),
                        'image' => $upload_data['file_name'],
                        'description' => $this->input->post('description'),
                        'update_date' => time());
                }
            } else {
                if (!empty($_FILES['video']['name'])) {
                    $post_data = array('title' => $this->input->post('title'),
                        'sort' => $this->input->post('sort'),
                        'video' => $videoDetails['file_name'],
                        'description' => $this->input->post('description'),
                        'update_date' => time());
                } else {
                    $post_data = array('title' => $this->input->post('title'),
                        'sort' => $this->input->post('sort'),
                        'description' => $this->input->post('description'),
                        'update_date' => time());
                }
            }
            $result = $this->comman_model->update_data_by_id('content', $post_data, 'id', $id);
            $this->session->set_flashdata('success', 'Content has been successfully updated.');
            redirect('admin/index/content');
        }
        if ($this->input->post('mission')) {
            if (!empty($_FILES['file']['name'])) {
                $field_name = 'file';
                $config['upload_path'] = './assets/uploads/content/full/';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = '800';
                $config['max_width'] = '2000';
                $config['max_height'] = '2000';
                $this->load->library('upload', $config);

                if (!$this->upload->do_upload($field_name)) {
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                    redirect('admin/index/edit_content/' . $id);
                } else {
                    $upload_data = $this->upload->data();
                    $this->load->library('image_lib');
                    $config['image_library'] = 'gd2';
                    $config['source_image'] = 'assets/uploads/content/full/' . $upload_data['file_name'];
                    $config['new_image'] = 'assets/uploads/content/thumbnails/' . $upload_data['file_name'];
                    $config['maintain_ratio'] = TRUE;
                    $config['width'] = 450;
                    $config['height'] = 450;
                    $this->image_lib->initialize($config);
                    $this->image_lib->resize();
                    $this->image_lib->clear();

                    $config['image_library'] = 'gd2';
                    $config['source_image'] = 'assets/uploads/content/full/' . $upload_data['file_name'];
                    $config['new_image'] = 'assets/uploads/content/small/' . $upload_data['file_name'];
                    $config['maintain_ratio'] = TRUE;
                    $config['width'] = 100;
                    $config['height'] = 100;
                    $this->image_lib->initialize($config);
                    $this->image_lib->resize();
                    $this->image_lib->clear();
                }
            }

            if (!empty($_FILES['video']['name'])) {
                $configVideo['upload_path'] = './assets/uploads/content/video/';
                $configVideo['max_size'] = '20000';
//				$configVideo['allowed_types'] = 'avi|flv|wmv|mp4';
                $configVideo['allowed_types'] = 'mp4|MP4';
                $configVideo['overwrite'] = FALSE;
                $configVideo['remove_spaces'] = TRUE;
                $video_name = $_FILES['video']['name'];
                $configVideo['file_name'] = $video_name;
                $this->load->library('upload', $configVideo);
                $this->upload->initialize($configVideo);
                if (!$this->upload->do_upload('video')) {
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                    redirect('admin/index/edit_content/' . $id);
                } else {
                    $videoDetails = $this->upload->data();
                }
            }
            if (!empty($_FILES['file']['name'])) {
                if (!empty($_FILES['video']['name'])) {
                    $post_data = array('title' => $this->input->post('title'),
                        'sort' => $this->input->post('sort'),
                        'image' => $upload_data['file_name'],
                        'video' => $videoDetails['file_name'],
                        'description' => $this->input->post('description'),
                        'update_date' => time());
                } else {
                    $post_data = array('title' => $this->input->post('title'),
                        'sort' => $this->input->post('sort'),
                        'image' => $upload_data['file_name'],
                        'description' => $this->input->post('description'),
                        'update_date' => time());
                }
            } else {
                if (!empty($_FILES['video']['name'])) {
                    $post_data = array('title' => $this->input->post('title'),
                        'sort' => $this->input->post('sort'),
                        'video' => $videoDetails['file_name'],
                        'description' => $this->input->post('description'),
                        'update_date' => time());
                } else {
                    $post_data = array('title' => $this->input->post('title'),
                        'sort' => $this->input->post('sort'),
                        'description' => $this->input->post('description'),
                        'update_date' => time());
                }
            }
            $result = $this->comman_model->update_data_by_id('content', $post_data, 'id', $id);
            $this->session->set_flashdata('success', 'Content has been successfully updated.');
            redirect('admin/index/content');
        }
        if ($this->input->post('career')) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('title', 'Title', 'trim|required');
            if ($this->form_validation->run() == FALSE) {
                
            } else {
                $post_data = array(
                    'title' => $this->input->post('title'),
                    'sort' => $this->input->post('sort'),
                    'description' => $this->input->post('description'),
                    'update_date' => time()
                );
                $result = $this->comman_model->update_data_by_id('content', $post_data, 'id', $id);
                $this->session->set_flashdata('success', 'Content has been successfully updated.');
                redirect('admin/index/content');
            }
        }
        $data['edit_data'] = $this->comman_model->get_data_by_id('content', array('id' => $id));
        $this->load->view('admin/header', $data);
        $this->load->view('admin/left_menu', $data);
        $this->load->view('admin/edit_content', $data);
        $this->load->view('admin/footer', $data);
    }

    function view_content($id = false) {
        if (!$id) {
            redirect('admin/index/content');
        }
        $this->validateLogin();
        $data = array();
        $data['login'] = $this->session->all_userdata();
        $data['title'] = 'Welcome To CompanyName';
        $data['active'] = 'content';
        $data['view_data'] = $this->comman_model->get_data_by_id('content', array('id' => $id));
        $this->load->view('admin/header', $data);
        $this->load->view('admin/left_menu', $data);
        $this->load->view('admin/view_content', $data);
        $this->load->view('admin/footer', $data);
    }

    function add_video() {
        if (isset($_FILES['video']['name']) && $_FILES['video']['name'] != '') {
            $date = date("ymd");
            $configVideo['upload_path'] = './assets/uploads/globe_product/full/';
            $configVideo['max_size'] = '200000';
            $configVideo['allowed_types'] = 'avi|flv|wmv|mp4';
            $configVideo['overwrite'] = FALSE;
            $configVideo['remove_spaces'] = TRUE;
            $video_name = $date . $_FILES['video']['name'];
            $configVideo['file_name'] = $video_name;
            $this->load->library('upload', $configVideo);
            $this->upload->initialize($configVideo);
            if (!$this->upload->do_upload('video')) {
                echo $this->upload->display_errors();
            } else {
                $videoDetails = $this->upload->data();
                echo "Successfully Uploaded";
            }
        }
        $this->load->view('admin/video');
    }

    function play_video() {
        $this->load->view('admin/play_video');
    }

    function withdrawal() {
        $this->check_lang();
        $this->validateLogin();
        $data = array();
        $data['login'] = $this->session->all_userdata();
        $data['title'] = 'Welcome To CompanyName';
        $data['active'] = 'withdrawal';
        $data['all_data'] = $this->comman_model->all_data('withdrawal');
        $this->load->view('admin/header', $data);
        $this->load->view('admin/left_menu', $data);
        $this->load->view('admin/withdrawal', $data);
        $this->load->view('admin/footer', $data);
    }

    function confirm_withdrawal($id = false) {
        $this->check_lang();
        $this->validateLogin();
        if (!$id) {
            redirect('admin/index/withdrawal');
        }
        $data = array();
        $data['login'] = $this->session->all_userdata();
        $data['title'] = 'Welcome To';

        $prediction_data = $this->comman_model->get_data_by_id('withdrawal', array('id' => $id));
        if (empty($prediction_data)) {
            $this->session->set_flashdata('error', 'There is no data.');
            redirect('admin/index/withdrawal');
        }

        $check_user = $this->comman_model->get_data_by_id('user', array('id' => $prediction_data['user_id']));
        //check user quantity
        if ($check_user['total_amount'] < $prediction_data['amount']) {
            //echo 'no qua';
            $this->session->set_flashdata('error', 'Enough amount.');
            redirect('admin/index/withdrawal');
        }

        $total_user = (float) $check_user['total_amount'] - (float) $prediction_data['amount'];
        $result = $this->comman_model->update_data_by_id('withdrawal', array('confirm' => 1), 'id', $id);
        $this->comman_model->update_data_by_id('user', array('total_amount' => $total_user), 'id', $data['login']['id']);
        $this->session->set_flashdata('success', 'Withdrawal has been successfully confirmed.');
        redirect('admin/index/withdrawal');
    }

    function update_status1() {
        $this->validateLogin();
        $page = $this->input->post('page');
        if ($page == 'promotion_duration') {
            $name = $this->input->post('table_name');
            $post_data = array('duration' => $this->input->post('value'));
            $id = $this->input->post('id');
            $result = $this->comman_model->update_data_by_id($name, $post_data, 'id', $id);
        }
        if ($page == 'promotion_download') {
            $name = $this->input->post('table_name');
            $post_data = array('total_download' => $this->input->post('value'));
            $id = $this->input->post('id');
            $result = $this->comman_model->update_data_by_id($name, $post_data, 'id', $id);
        }
    }

    function update_status() {
        $this->validateLogin();
        $name = $this->input->post('table_name');
        $post_data = array('status' => $this->input->post('status'));
        $id = $this->input->post('id');
        $result = $this->comman_model->update_data_by_id($name, $post_data, 'id', $id);
    }

    function update_user_level() {
        $this->validateLogin();
        $name = $this->input->post('table_name');
        $post_data = array('user_level' => $this->input->post('status'));
        $id = $this->input->post('id');
        $result = $this->comman_model->update_data_by_id($name, $post_data, 'id', $id);
    }

    function user_confirm() {
        $this->validateLogin();
        $name = $this->input->post('table_name');
        $post_data = array('status' => $this->input->post('status'));
        $id = $this->input->post('id');
        $result = $this->comman_model->update_data_by_id($name, $post_data, 'id', $id);
    }

    function user_confirm1() {
        $this->validateLogin();
        $name = $this->input->post('table_name');
        $post_data = array('confirm' => $this->input->post('status'));
        $id = $this->input->post('id');
        $result = $this->comman_model->update_data_by_id($name, $post_data, 'id', $id);
    }

    function menu_category() {
        $this->check_lang();
        $this->validateLogin();
        $data = array();
        $data['login'] = $this->session->all_userdata();
        $data['title'] = 'Welcome To CompanyName';
        $data['active'] = 'content';
        $data['all_data'] = $this->comman_model->all_data('menu_category');
        $this->load->view('admin/header', $data);
        $this->load->view('admin/left_menu', $data);
        $this->load->view('admin/menu_category', $data);
        $this->load->view('admin/footer', $data);
    }

    function add_menu_category() {
        $this->check_lang();
        $this->validateLogin();
        $data = array();
        $data['login'] = $this->session->all_userdata();
        $data['title'] = 'Welcome To CompanyName';
        $data['active'] = 'bookies';
        $data['sub_menu'] = 'add_article';
        if ($this->input->post('operation')) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('title', 'Title', 'trim|required');
            if ($this->form_validation->run() == FALSE) {
                
            } else {
                $post_data = array(
                    'name' => $this->input->post('title'),
                    'description' => $this->input->post('description'),
                    'create_date' => time(),
                    'status' => 1
                );
                $result = $this->comman_model->add('menu_category', $post_data);
                $this->session->set_flashdata('success', 'Menu Category has been successfully added.');
                redirect('admin/index/menu_category');
            }
        }
        $this->load->view('admin/header', $data);
        $this->load->view('admin/left_menu', $data);
        $this->load->view('admin/add_menu_category', $data);
        $this->load->view('admin/footer', $data);
    }

    function menu_content() {
        $this->check_lang();
        $this->validateLogin();
        $data = array();
        $data['login'] = $this->session->all_userdata();
        $data['title'] = 'Welcome To CompanyName';
        $data['active'] = 'content';
        $data['all_data'] = $this->comman_model->all_data('menu_content');
        $this->load->view('admin/header', $data);
        $this->load->view('admin/left_menu', $data);
        $this->load->view('admin/menu_content_list', $data);
        $this->load->view('admin/footer', $data);
    }

    function add_menu_content() {
        $this->check_lang();
        $this->validateLogin();
        $data = array();
        $data['login'] = $this->session->all_userdata();
        $data['title'] = 'Welcome To CompanyName';
        $data['active'] = 'bookies';
        $data['sub_menu'] = 'add_article';
        if ($this->input->post('operation')) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('title', 'Title', 'trim|required');
            if ($this->form_validation->run() == FALSE) {
                
            } else {
                $post_data = array(
                    'title' => $this->input->post('title'),
                    'menu_id' => $this->input->post('category'),
                    'description' => $this->input->post('description'),
                    'create_date' => time(),
                    'status' => 1
                );
                $result = $this->comman_model->add('menu_content', $post_data);
                $this->session->set_flashdata('success', 'Menu Content has been successfully added.');
                redirect('admin/index/menu_content');
            }
        }
        $this->load->view('admin/header', $data);
        $this->load->view('admin/left_menu', $data);
        $this->load->view('admin/add_menu', $data);
        $this->load->view('admin/footer', $data);
    }

    function money_control() {
        $this->check_lang();
        $this->validateLogin();
        $data = array();
        $data['login'] = $this->session->all_userdata();
        $data['title'] = 'Welcome To CompanyName';
        $data['active'] = 'money_control';
        $data['all_data'] = $this->comman_model->get_all_data_by_id_with_order1('money_transaction', array(), 'id', 'desc', 'id', 'desc');
        if ($this->input->post('operation')) {
            $from = strtotime($this->input->post('from_date') . ' 00:00:00');
            $to = strtotime($this->input->post('to_date') . ' 23:59:59');
            $query = 'select * from money_transaction where create_date >="' . $from . '" and create_date<="' . $to . '"';
            $data['date_transection_data'] = $this->comman_model->query_result($query);
            //	$this->pre($data['date_transection_data']);
        }

        $this->load->view('admin/header', $data);
        $this->load->view('admin/left_menu', $data);
        $this->load->view('admin/transection_list', $data);
        $this->load->view('admin/footer', $data);
    }

    function blog() {
        $this->check_lang();
        $this->validateLogin();
        $data = array();
        $data['login'] = $this->session->all_userdata();
        $data['title'] = 'Welcome To CompanyName';
        $data['active'] = 'blog';
        $data['all_data'] = $this->comman_model->all_data('blog');
        $this->load->view('admin/header', $data);
        $this->load->view('admin/left_menu', $data);
        $this->load->view('admin/blog_list', $data);
        $this->load->view('admin/footer', $data);
    }

    function view_blog($id = false) {
        if (!$id) {
            redirect('admin/index/blog');
        }
        $this->check_lang();
        $this->validateLogin();
        $data = array();
        $data['login'] = $this->session->all_userdata();
        $data['title'] = 'Welcome To CompanyName';
        $data['active'] = 'user';
        $data['view_data'] = $this->comman_model->get_data_by_id('blog', array('id' => $id));
        $data['all_comment'] = $this->comman_model->get_data_by_id('blog_comment', array('blog_id' => $id));
        $this->load->view('admin/header', $data);
        $this->load->view('admin/left_menu', $data);
        $this->load->view('admin/view_blog', $data);
        $this->load->view('admin/footer', $data);
    }

    function forum($id = false) {
        $this->check_lang();
        $this->validateLogin();
        $data = array();
        $data['login'] = $this->session->all_userdata();
        $data['title'] = 'Welcome To CompanyName';
        $data['active'] = 'forum';
        if ($id) {
            $data['set_category'] = $this->comman_model->get_all_data_by_id('forum', array('forum_category' => $id));
        } else {
            $data['all_data'] = $this->comman_model->all_data('forum_category');
        }
        $this->load->view('admin/header', $data);
        $this->load->view('admin/left_menu', $data);
        $this->load->view('admin/forum_list', $data);
        $this->load->view('admin/footer', $data);
    }

    function add_forum_category() {
        $this->check_lang();
        $this->validateLogin();
        $data = array();
        $data['login'] = $this->session->all_userdata();
        $data['title'] = 'Welcome To CompanyName';
        $data['active'] = 'forum';
        $data['sub_menu'] = 'add_article';
        if ($this->input->post('operation')) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('title', 'Title', 'trim|required');
            if ($this->form_validation->run() == FALSE) {
                
            } else {
                $post_data = array(
                    'name' => $this->input->post('title'),
                    'description' => $this->input->post('description'),
                    'create_date' => time(),
                    'status' => 1
                );
                $result = $this->comman_model->add('forum_category', $post_data);
                $this->session->set_flashdata('success', 'Forum Category has been successfully added.');
                redirect('admin/index/forum');
            }
        }
        $this->load->view('admin/header', $data);
        $this->load->view('admin/left_menu', $data);
        $this->load->view('admin/add_category', $data);
        $this->load->view('admin/footer', $data);
    }

    function view_forum($id = false) {
        if (!$id) {
            redirect('admin/index/forum');
        }
        $this->check_lang();
        $this->validateLogin();
        $data = array();
        $data['login'] = $this->session->all_userdata();
        $data['title'] = 'Welcome To CompanyName';
        $data['active'] = 'forum';
        $data['view_data'] = $this->comman_model->get_data_by_id('forum', array('id' => $id));
        $data['all_comment'] = $this->comman_model->get_all_data_by_id('forum_comment', array('forum_id' => $id));
        $this->load->view('admin/header', $data);
        $this->load->view('admin/left_menu', $data);
        $this->load->view('admin/view_forum', $data);
        $this->load->view('admin/footer', $data);
    }

    function user_list() {
        $this->check_lang();
        $this->validateLogin();
        $data = array();
        $data['login'] = $this->session->all_userdata();
        $data['title'] = 'Welcome To CompanyName';
        $data['active'] = 'user';
        $data['user_list'] = $this->comman_model->all_data('user');
        $this->load->view('admin/header', $data);
        $this->load->view('admin/left_menu', $data);
        $this->load->view('admin/user_list', $data);
        $this->load->view('admin/footer', $data);
    }

    function get_balance($id = false) {
        $this->check_lang();
        $this->validateLogin();
        if ($id == '') {
            redirect('admin/index/user_list');
        }
        $data = array();
        $data['user_data'] = $this->comman_model->get_data_by_id('user', array('id' => $id));
        $data['login'] = $this->session->all_userdata();
        $data['title'] = 'Welcome To CompanyName';
        $data['active'] = 'user';
        $data['sub_menu'] = 'add_article';
        if ($this->input->post('operation')) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('balance', 'Balance', 'trim|required|numeric');
            if ($this->form_validation->run() == FALSE) {
                
            } else {
                $total = (int) $data['user_data']['total_amount'] + $this->input->post('balance');
                $post_data = array(
                    'total_amount' => $total,
                );
                $result = $this->comman_model->update_data_by_id('user', $post_data, 'id', $id);
                $this->session->set_flashdata('success', 'User has been successfully Updated.');
                redirect('admin/index/user_list');
            }
        }

        $this->load->view('admin/header', $data);
        $this->load->view('admin/left_menu', $data);
        $this->load->view('admin/get_balance', $data);
        $this->load->view('admin/footer', $data);
    }

    function subscribe() {
        $this->check_lang();
        $this->validateLogin();
        $data = array();
        $data['title'] = 'Welcome To CompanyName';
        $data['login'] = $this->session->all_userdata();
        $data['active'] = 'subscribe';
        $data['payment_data'] = $this->comman_model->all_data('payment_detail');
        $this->load->view('admin/header', $data);
        $this->load->view('admin/left_menu', $data);
        $this->load->view('admin/subscribe_list', $data);
        //$this->load->view('admin/content',$data);
        //$this->load->view('admin/add_tip_of_day',$data);
        $this->load->view('admin/footer', $data);
    }

    function edit_subscribe($id = false) {
        $this->check_lang();
        $this->validateLogin();
        $data = array();
        $data['title'] = 'Welcome To CompanyName';
        $data['login'] = $this->session->all_userdata();
        $data['active'] = 'subscribe';
        if (!$id) {
            redirect('admin/index/subscribe');
        }

        if ($this->input->post('pay')) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('quantity', 'Quantity', 'trim|required|integer');
            $this->form_validation->set_rules('amount', 'Amount', 'trim|required|integer');
            $this->form_validation->set_rules('price', 'Price', 'trim|required|integer');
            $this->form_validation->set_rules('product_name', 'Product Name', 'trim|required');
            $this->form_validation->set_rules('package_name', 'Package Name', 'trim|required');
            if ($this->form_validation->run() == FALSE) {
                
            } else {
                $set_data = array(
                    "package_name" => $this->input->post('package_name'),
                    "rate" => $this->input->post('rate'),
                    "amount" => $this->input->post('amount'),
                    "product_name" => $this->input->post('product_name'),
                    "product_price" => $this->input->post('price'),
                    "product_quantity" => $this->input->post('quantity'),
                    "update_date" => time(),
                );
                $result = $this->comman_model->update_by_id('payment_detail', $set_data, $id);
                $this->session->set_flashdata('success', 'Subscribe has been successfully updated.');
                redirect('admin/index/subscribe');
            }
        }
        $data['payment_data'] = $this->comman_model->get_data_by_id('payment_detail', array('id' => $id));
        $this->load->view('admin/header', $data);
        $this->load->view('admin/left_menu', $data);
        $this->load->view('admin/edit_subscribe', $data);
        //$this->load->view('admin/content',$data);
        //$this->load->view('admin/add_tip_of_day',$data);
        $this->load->view('admin/footer', $data);
    }

    function category() {
        $this->check_lang();
        $this->validateLogin();
        $data = array();
        $data['title'] = 'Welcome To CompanyName';
        $data['login'] = $this->session->all_userdata();
        $data['active'] = 'subscribe';
        $data['all_data'] = $this->comman_model->all_data('category');
        $this->load->view('admin/header', $data);
        $this->load->view('admin/left_menu', $data);
        $this->load->view('admin/category_list', $data);
        //$this->load->view('admin/content',$data);
        //$this->load->view('admin/add_tip_of_day',$data);
        $this->load->view('admin/footer', $data);
    }

    function add_category() {
        $this->check_lang();
        $this->validateLogin();
        $data = array();
        $data['login'] = $this->session->all_userdata();
        $data['title'] = 'Welcome To CompanyName';
        $data['active'] = 'category';
        $data['sub_menu'] = 'add_article';
        if ($this->input->post('operation')) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('title', 'Title', 'trim|required');
            if ($this->form_validation->run() == FALSE) {
                
            } else {
                if (!empty($_FILES['file']['name'])) {
                    $field_name = 'file';
                    $config['upload_path'] = './assets/uploads/team/full/';
                    $config['allowed_types'] = 'gif|jpg|png';
                    $config['max_size'] = '800';
                    $config['max_width'] = '2000';
                    $config['max_height'] = '2000';
                    $this->load->library('upload', $config);

                    if (!$this->upload->do_upload($field_name)) {
                        /* 			$error = array('error' => $this->upload->display_errors());
                          $this->load->view('admin/add_upload', $error); */
                        $this->session->set_flashdata('error', $this->upload->display_errors());
                        redirect('user/upload_photo');
                    } else {
                        $upload_data = $this->upload->data();
                        $this->load->library('image_lib');
                        $config['image_library'] = 'gd2';
                        $config['source_image'] = 'assets/uploads/team/full/' . $upload_data['file_name'];
                        $config['new_image'] = 'assets/uploads/team/thumbnails/' . $upload_data['file_name'];
                        $config['maintain_ratio'] = TRUE;
                        $config['width'] = 200;
                        $config['height'] = 200;
                        $this->image_lib->initialize($config);
                        $this->image_lib->resize();
                        $this->image_lib->clear();

                        $config['image_library'] = 'gd2';
                        $config['source_image'] = 'assets/uploads/team/full/' . $upload_data['file_name'];
                        $config['new_image'] = 'assets/uploads/team/small/' . $upload_data['file_name'];
                        $config['maintain_ratio'] = TRUE;
                        $config['width'] = 70;
                        $config['height'] = 70;
                        $this->image_lib->initialize($config);
                        $this->image_lib->resize();
                        $this->image_lib->clear();
                    }
                }
                $post_data = array(
                    'name' => $this->input->post('title'),
                    'description' => $this->input->post('description'),
                    'create_date' => time(),
                    'status' => 1
                );
                $result = $this->comman_model->add('category', $post_data);
                $this->session->set_flashdata('success', 'Category has been successfully added.');
                redirect('admin/index/category');
            }
        }


        $this->load->view('admin/header', $data);
        $this->load->view('admin/left_menu', $data);
        $this->load->view('admin/add_category', $data);
        $this->load->view('admin/footer', $data);
    }

    function edit_category($id = false) {
        $this->check_lang();
        $this->validateLogin();
        $data = array();
        $data['title'] = 'Welcome To CompanyName';
        $data['login'] = $this->session->all_userdata();
        $data['active'] = 'category';
        if (!$id) {
            redirect('admin/index/category');
        }

        if ($this->input->post('pay')) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('title', 'Name', 'trim|required');
            if ($this->form_validation->run() == FALSE) {
                
            } else {
                $set_data = array(
                    "name" => $this->input->post('title'),
                    "description" => $this->input->post('description'),
                    "update_date" => time(),
                );
                $result = $this->comman_model->update_by_id('category', $set_data, $id);
                $this->session->set_flashdata('success', 'category has been successfully updated.');
                redirect('admin/index/category');
            }
        }
        $data['edit_data'] = $this->comman_model->get_data_by_id('category', array('id' => $id));
        $this->load->view('admin/header', $data);
        $this->load->view('admin/left_menu', $data);
        $this->load->view('admin/edit_category', $data);
        //$this->load->view('admin/content',$data);
        //$this->load->view('admin/add_tip_of_day',$data);
        $this->load->view('admin/footer', $data);
    }

    function team() {
        $this->check_lang();
        $this->validateLogin();
        $data = array();
        $data['title'] = 'Welcome To CompanyName';
        $data['login'] = $this->session->all_userdata();
        $data['active'] = 'team';
        $data['all_data'] = $this->comman_model->all_data('team');
        $this->load->view('admin/header', $data);
        $this->load->view('admin/left_menu', $data);
        $this->load->view('admin/team_list', $data);
        //$this->load->view('admin/content',$data);
        //$this->load->view('admin/add_tip_of_day',$data);
        $this->load->view('admin/footer', $data);
    }

    function add_team() {
        $this->check_lang();
        $this->validateLogin();
        $data = array();
        $data['login'] = $this->session->all_userdata();
        $data['title'] = 'Welcome To CompanyName';
        $data['active'] = 'team';
        $data['sub_menu'] = 'add_article';
        if ($this->input->post('operation')) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('title', 'Title', 'trim|required');
            if ($this->form_validation->run() == FALSE) {
                
            } else {
                if (!empty($_FILES['file']['name'])) {
                    $field_name = 'file';
                    $config['upload_path'] = './assets/uploads/team/full/';
                    $config['allowed_types'] = 'gif|jpg|png';
                    $config['max_size'] = '800';
                    $config['max_width'] = '2000';
                    $config['max_height'] = '2000';
                    $this->load->library('upload', $config);

                    if (!$this->upload->do_upload($field_name)) {
                        /* 			$error = array('error' => $this->upload->display_errors());
                          $this->load->view('admin/add_upload', $error); */
                        $this->session->set_flashdata('error', $this->upload->display_errors());
                        redirect('user/upload_photo');
                    } else {
                        $upload_data = $this->upload->data();
                        $this->load->library('image_lib');
                        $config['image_library'] = 'gd2';
                        $config['source_image'] = 'assets/uploads/team/full/' . $upload_data['file_name'];
                        $config['new_image'] = 'assets/uploads/team/thumbnails/' . $upload_data['file_name'];
                        $config['maintain_ratio'] = TRUE;
                        $config['width'] = 200;
                        $config['height'] = 200;
                        $this->image_lib->initialize($config);
                        $this->image_lib->resize();
                        $this->image_lib->clear();

                        $config['image_library'] = 'gd2';
                        $config['source_image'] = 'assets/uploads/team/full/' . $upload_data['file_name'];
                        $config['new_image'] = 'assets/uploads/team/small/' . $upload_data['file_name'];
                        $config['maintain_ratio'] = TRUE;
                        $config['width'] = 70;
                        $config['height'] = 70;
                        $this->image_lib->initialize($config);
                        $this->image_lib->resize();
                        $this->image_lib->clear();
                    }
                }
                $post_data = array(
                    'name' => $this->input->post('title'),
                    'image' => $upload_data['file_name'],
                    'event_id' => $this->input->post('category'),
                    'description' => $this->input->post('description'),
                    'create_date' => time(),
                    'status' => 1
                );
                $result = $this->comman_model->add('team', $post_data);
                $this->session->set_flashdata('success', 'Team has been successfully added.');
                redirect('admin/index/team');
            }
        }
        $this->load->view('admin/header', $data);
        $this->load->view('admin/left_menu', $data);
        $this->load->view('admin/add_team', $data);
        $this->load->view('admin/footer', $data);
    }

    function edit_team($id = false) {
        $this->check_lang();
        $this->validateLogin();
        $data = array();
        $data['title'] = 'Welcome To CompanyName';
        $data['login'] = $this->session->all_userdata();
        $data['active'] = 'event';
        if (!$id) {
            redirect('admin/index/team');
        }

        if ($this->input->post('pay')) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('title', 'Name', 'trim|required');
            if ($this->form_validation->run() == FALSE) {
                
            } else {
                if (!empty($_FILES['file']['name'])) {
                    $field_name = 'file';
                    $config['upload_path'] = './assets/uploads/team/full/';
                    $config['allowed_types'] = 'gif|jpg|png';
                    $config['max_size'] = '800';
                    $config['max_width'] = '2000';
                    $config['max_height'] = '2000';
                    $this->load->library('upload', $config);

                    if (!$this->upload->do_upload($field_name)) {
                        /* 			$error = array('error' => $this->upload->display_errors());
                          $this->load->view('admin/add_upload', $error); */
                        $this->session->set_flashdata('error', $this->upload->display_errors());
                        redirect('user/upload_photo');
                    } else {
                        $upload_data = $this->upload->data();
                        $this->load->library('image_lib');
                        $config['image_library'] = 'gd2';
                        $config['source_image'] = 'assets/uploads/team/full/' . $upload_data['file_name'];
                        $config['new_image'] = 'assets/uploads/team/thumbnails/' . $upload_data['file_name'];
                        $config['maintain_ratio'] = TRUE;
                        $config['width'] = 200;
                        $config['height'] = 200;
                        $this->image_lib->initialize($config);
                        $this->image_lib->resize();
                        $this->image_lib->clear();

                        $config['image_library'] = 'gd2';
                        $config['source_image'] = 'assets/uploads/team/full/' . $upload_data['file_name'];
                        $config['new_image'] = 'assets/uploads/team/small/' . $upload_data['file_name'];
                        $config['maintain_ratio'] = TRUE;
                        $config['width'] = 70;
                        $config['height'] = 70;
                        $this->image_lib->initialize($config);
                        $this->image_lib->resize();
                        $this->image_lib->clear();
                    }
                }
                if (!empty($_FILES['file']['name'])) {
                    $set_data = array(
                        "name" => $this->input->post('title'),
                        'image' => $upload_data['file_name'],
                        "description" => $this->input->post('description'),
                        "update_date" => time(),
                    );
                } else {
                    $set_data = array(
                        "name" => $this->input->post('title'),
                        "description" => $this->input->post('description'),
                        "update_date" => time(),
                    );
                }
                $result = $this->comman_model->update_by_id('team', $set_data, $id);
                $this->session->set_flashdata('success', 'Team has been successfully updated.');
                redirect('admin/index/team');
            }
        }
        $data['edit_data'] = $this->comman_model->get_data_by_id('team', array('id' => $id));
        $this->load->view('admin/header', $data);
        $this->load->view('admin/left_menu', $data);
        $this->load->view('admin/edit_team', $data);
        //$this->load->view('admin/content',$data);
        //$this->load->view('admin/add_tip_of_day',$data);
        $this->load->view('admin/footer', $data);
    }

    function event() {
        $this->check_lang();
        $this->validateLogin();
        $data = array();
        $data['title'] = 'Welcome To CompanyName';
        $data['login'] = $this->session->all_userdata();
        $data['active'] = 'event';
        $data['all_data'] = $this->comman_model->all_data('event');
        $this->load->view('admin/header', $data);
        $this->load->view('admin/left_menu', $data);
        $this->load->view('admin/event_list', $data);
        //$this->load->view('admin/content',$data);
        //$this->load->view('admin/add_tip_of_day',$data);
        $this->load->view('admin/footer', $data);
    }

    function add_event() {
        $this->check_lang();
        $this->validateLogin();
        $data = array();
        $data['login'] = $this->session->all_userdata();
        $data['title'] = 'Welcome To CompanyName';
        $data['active'] = 'event';
        $data['sub_menu'] = 'add_article';
        if ($this->input->post('operation')) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('title', 'Title', 'trim|required');
            if ($this->form_validation->run() == FALSE) {
                
            } else {
                $post_data = array(
                    'name' => $this->input->post('title'),
                    'category_id' => $this->input->post('category'),
                    'description' => $this->input->post('description'),
                    'create_date' => time(),
                    'status' => 1
                );
                //			$this->pre($post_data);		
                $result = $this->comman_model->add('event', $post_data);
                $this->session->set_flashdata('success', 'Event has been successfully added.');
                redirect('admin/index/event');
            }
        }
        $this->load->view('admin/header', $data);
        $this->load->view('admin/left_menu', $data);
        $this->load->view('admin/add_event', $data);
        $this->load->view('admin/footer', $data);
    }

    function edit_event($id = false) {
        $this->check_lang();
        $this->validateLogin();
        $data = array();
        $data['title'] = 'Welcome To CompanyName';
        $data['login'] = $this->session->all_userdata();
        $data['active'] = 'event';
        if (!$id) {
            redirect('admin/index/event');
        }

        if ($this->input->post('pay')) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('title', 'Name', 'trim|required');
            if ($this->form_validation->run() == FALSE) {
                
            } else {
                $set_data = array(
                    "name" => $this->input->post('title'),
                    "description" => $this->input->post('description'),
                    "update_date" => time(),
                );
                $result = $this->comman_model->update_by_id('event', $set_data, $id);
                $this->session->set_flashdata('success', 'Event has been successfully updated.');
                redirect('admin/index/event');
            }
        }
        $data['edit_data'] = $this->comman_model->get_data_by_id('event', array('id' => $id));
        $this->load->view('admin/header', $data);
        $this->load->view('admin/left_menu', $data);
        $this->load->view('admin/edit_event', $data);
        //$this->load->view('admin/content',$data);
        //$this->load->view('admin/add_tip_of_day',$data);
        $this->load->view('admin/footer', $data);
    }

    function prediction_history() {
        $this->check_lang();
        $this->validateLogin();
        $data = array();
        $data['login'] = $this->session->all_userdata();
        $data['title'] = 'Welcome To CompanyName';
        $data['active'] = 'prediction_history';
        $data['all_data'] = $this->comman_model->all_data('prediction');
        $this->load->view('admin/header', $data);
        $this->load->view('admin/left_menu', $data);
        $this->load->view('admin/prediction_list', $data);
        $this->load->view('admin/footer', $data);
    }

    function bonus_price() {
        $this->check_lang();
        $this->validateLogin();
        $data = array();
        $data['title'] = 'Welcome To CompanyName';
        $data['login'] = $this->session->all_userdata();
        $data['active'] = 'bonus_price';
        $data['all_data'] = $this->comman_model->all_data('bonus_price');
        $this->load->view('admin/header', $data);
        $this->load->view('admin/left_menu', $data);
        $this->load->view('admin/bonus_list', $data);
        //$this->load->view('admin/content',$data);
        //$this->load->view('admin/add_tip_of_day',$data);
        $this->load->view('admin/footer', $data);
    }

    function add_bonus() {
        $this->check_lang();
        $this->validateLogin();
        $data = array();
        $data['login'] = $this->session->all_userdata();
        $data['title'] = 'Welcome To CompanyName';
        $data['active'] = 'currency';
        $data['sub_menu'] = 'add_article';
        if ($this->input->post('operation')) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('title', 'Title', 'trim|required');
            $this->form_validation->set_rules('amount', 'Amount', 'trim|required|numeric');
            $this->form_validation->set_rules('price', 'Price', 'trim|required');
            if ($this->form_validation->run() == FALSE) {
                
            } else {
                $post_data = array(
                    'name' => $this->input->post('title'),
                    'amount' => $this->input->post('amount'),
                    'price' => $this->input->post('price'),
                    'create_date' => time(),
                    'status' => 1
                );
                $result = $this->comman_model->add('bonus_price', $post_data);
                $this->session->set_flashdata('success', 'Bonus Price has been successfully added.');
                redirect('admin/index/bonus_price');
            }
        }


        $this->load->view('admin/header', $data);
        $this->load->view('admin/left_menu', $data);
        $this->load->view('admin/add_bonus', $data);
        $this->load->view('admin/footer', $data);
    }

    function edit_bonus($id = false) {
        $this->check_lang();
        $this->validateLogin();
        $data = array();
        $data['title'] = 'Welcome To CompanyName';
        $data['login'] = $this->session->all_userdata();
        $data['active'] = 'category';
        if (!$id) {
            redirect('admin/index/bonus_price');
        }

        if ($this->input->post('pay')) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('title', 'Name', 'trim|required');
            $this->form_validation->set_rules('amount', 'Amount', 'trim|required|numeric');
            $this->form_validation->set_rules('price', 'Price', 'trim|required');
            if ($this->form_validation->run() == FALSE) {
                
            } else {
                $set_data = array(
                    'name' => $this->input->post('title'),
                    'amount' => $this->input->post('amount'),
                    'price' => $this->input->post('price'),
                    "update_date" => time(),
                );
                $result = $this->comman_model->update_by_id('bonus_price', $set_data, $id);
                $this->session->set_flashdata('success', 'Bonus has been successfully updated.');
                redirect('admin/index/bonus_price');
            }
        }
        $data['edit_data'] = $this->comman_model->get_data_by_id('bonus_price', array('id' => $id));
        $this->load->view('admin/header', $data);
        $this->load->view('admin/left_menu', $data);
        $this->load->view('admin/edit_bonus', $data);
        $this->load->view('admin/footer', $data);
    }

    function subscribe_history() {
        $this->check_lang();
        $this->validateLogin();
        $data = array();
        $data['login'] = $this->session->all_userdata();
        $data['title'] = 'Welcome To CompanyName';
        $data['active'] = 'subscribe_history';
        $data['all_data'] = $this->comman_model->all_data('user_subscribe');
        $this->load->view('admin/header', $data);
        $this->load->view('admin/left_menu', $data);
        $this->load->view('admin/user_subscribe_list', $data);
        $this->load->view('admin/footer', $data);
    }

    function view_prediction($id = false) {
        $this->check_lang();
        if (!$id) {
            redirect('user/prediction_history');
        }
        $this->validateLogin();
        $data = array();
        $data['login'] = $this->session->all_userdata();
        $data['title'] = 'Welcome To CompanyName';
        $data['active'] = 'prediction_history';
        $data['show_data'] = $this->comman_model->get_data_by_id('prediction', array('id' => $id));
//		$this->pre($data['show_data']);
//		$data['payment_data'] = $this->comman_model->all_data('payment_detail');
        $this->load->view('admin/header', $data);
        $this->load->view('admin/left_menu', $data);
        $this->load->view('admin/view_prediction', $data);
        $this->load->view('admin/footer', $data);
    }

    function confirm_prediction($id = false) {
        $this->check_lang();
        $this->validateLogin();
        if (!$id) {
            redirect('admin/index/prediction_history');
        }
        $data = array();
        $data['login'] = $this->session->all_userdata();
        $data['title'] = 'Welcome To';

        $prediction_data = $this->comman_model->get_data_by_id('prediction', array('id' => $id));
        if (empty($prediction_data)) {
            $this->session->set_flashdata('error', 'There is no data.');
            redirect('admin/index/prediction_history');
        }

        $result = $this->comman_model->update_data_by_id('prediction', array('confirm' => 1), 'id', $id);
        $this->session->set_flashdata('success', 'Prediction has been successfully Updated.');
        redirect('admin/index/prediction_history');
    }

    function payment_gateway() {
        $this->validateLogin();
        $data = array();
        $data['login'] = $this->session->all_userdata();
        $data['title'] = 'Welcome To CompanyName';
        $data['active'] = 'payment';
        $data['payment_list'] = $this->comman_model->all_data('payment_gateway');
        $this->load->view('admin/header', $data);
        $this->load->view('admin/left_menu', $data);
        $this->load->view('admin/gateway_list', $data);
        $this->load->view('admin/footer', $data);
    }

    function add_payment_gateway() {
        $this->validateLogin();
        $data = array();
        $data['login'] = $this->session->all_userdata();
        $data['title'] = 'Welcome To CompanyName';
        $data['active'] = 'payment';
        $data['sub_menu'] = 'add_article';
        if ($this->input->post('operation')) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('title', 'Name', 'trim|required');
            $this->form_validation->set_rules('address', 'Address', 'trim|required');
            if ($this->form_validation->run() == FALSE) {
                
            } else {
                $post_data = array(
                    'payment_name' => $this->input->post('title'),
                    'account_name' => $this->input->post('address'),
                    'create_date' => time(),
                    'status' => 1
                );
                $result = $this->comman_model->add('payment_gateway', $post_data);
                $this->session->set_flashdata('success', 'Payment Gateway has been successfully added.');
                redirect('admin/index/payment_gateway');
            }
        }
        $this->load->view('admin/header', $data);
        $this->load->view('admin/left_menu', $data);
        $this->load->view('admin/add_gateway', $data);
        $this->load->view('admin/footer', $data);
    }

    function edit_payment_gateway($id = false) {
        $this->validateLogin();
        if ($id == '') {
            redirect('admin/index/payment_gateway');
        }
        $data = array();
        $data['currency_data'] = $this->comman_model->get_data_by_id('payment_gateway', array('id' => $id));
        $data['login'] = $this->session->all_userdata();
        $data['title'] = 'Welcome To CompanyName';
        $data['active'] = 'payment';
        $data['sub_menu'] = 'add_article';
        if ($this->input->post('operation')) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('title', 'Title', 'trim|required');
            $this->form_validation->set_rules('address', 'Address', 'trim|required');
            if ($this->form_validation->run() == FALSE) {
                
            } else {
                $post_data = array(
                    'payment_name' => $this->input->post('title'),
                    'account_name' => $this->input->post('address'),
                    'update_date' => time()
                );
                $result = $this->comman_model->update_data_by_id('payment_gateway', $post_data, 'id', $id);
                $this->session->set_flashdata('success', 'Payment Gateway has been successfully Updated.');
                redirect('admin/index/payment_gateway');
            }
        }
        $this->load->view('admin/header', $data);
        $this->load->view('admin/left_menu', $data);
        $this->load->view('admin/edit_gateway', $data);
        $this->load->view('admin/footer', $data);
    }

    function currency() {
        $this->validateLogin();
        $data = array();
        $data['login'] = $this->session->all_userdata();
        $data['title'] = 'Welcome To CompanyName';
        $data['active'] = 'currency';
        $data['payment_list'] = $this->comman_model->all_data('currency');
        $this->load->view('admin/header', $data);
        $this->load->view('admin/left_menu', $data);
        $this->load->view('admin/currency_list', $data);
        $this->load->view('admin/footer', $data);
    }

    function add_currency() {
        $this->validateLogin();
        $data = array();
        $data['login'] = $this->session->all_userdata();
        $data['title'] = 'Welcome To CompanyName';
        $data['active'] = 'currency';
        $data['sub_menu'] = 'add_article';
        if ($this->input->post('operation')) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('title', 'Title', 'trim|required');
            $this->form_validation->set_rules('address', 'Address', 'trim|required');
            $this->form_validation->set_rules('buy_price', 'Buy Price', 'trim|required|numeric');
            $this->form_validation->set_rules('sell_price', 'Sell Price', 'trim|required|numeric');
            if ($this->form_validation->run() == FALSE) {
                
            } else {
                $post_data = array(
                    'name' => $this->input->post('title'),
                    'address' => $this->input->post('address'),
                    'sell_price' => $this->input->post('sell_price'),
                    'buy_price' => $this->input->post('buy_price'),
                    'description' => $this->input->post('description'),
                    'create_date' => time(),
                    'status' => 1
                );
                $result = $this->comman_model->add('currency', $post_data);

                $post_data1 = array(
                    'currency_id' => $result,
                    'sell_price' => $this->input->post('sell_price'),
                    'buy_price' => $this->input->post('buy_price'),
                    'create_date' => time()
                );
                $result2 = $this->comman_model->add('buy_sell_history', $post_data1);

                $this->session->set_flashdata('success', 'Currency has been successfully added.');
                redirect('admin/index/currency');
            }
        }


        $this->load->view('admin/header', $data);
        $this->load->view('admin/left_menu', $data);
        $this->load->view('admin/add_currency', $data);
        $this->load->view('admin/footer', $data);
    }

    function edit_currency($id = false) {
        $this->validateLogin();
        if ($id == '') {
            redirect('admin/index/currency');
        }
        $data = array();
        $data['currency_data'] = $this->comman_model->get_data_by_id('currency', array('id' => $id));
        $data['login'] = $this->session->all_userdata();
        $data['title'] = 'Welcome To CompanyName';
        $data['active'] = 'currency';
        $data['sub_menu'] = 'add_article';
        if ($this->input->post('operation')) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('title', 'Title', 'trim|required');
            $this->form_validation->set_rules('address', 'Address', 'trim|required');
            $this->form_validation->set_rules('buy_price', 'Buy Price', 'trim|required|numeric');
            $this->form_validation->set_rules('sell_price', 'Sell Price', 'trim|required|numeric');
            if ($this->form_validation->run() == FALSE) {
                
            } else {
                $post_data = array(
                    'name' => $this->input->post('title'),
                    'address' => $this->input->post('address'),
                    'sell_price' => $this->input->post('sell_price'),
                    'buy_price' => $this->input->post('buy_price'),
                    'description' => $this->input->post('description'),
                    'update_date' => time()
                );
                $result = $this->comman_model->update_data_by_id('currency', $post_data, 'id', $id);

                $post_data1 = array(
                    'currency_id' => $id,
                    'sell_price' => $this->input->post('sell_price'),
                    'buy_price' => $this->input->post('buy_price'),
                    'create_date' => time()
                );
                $result2 = $this->comman_model->add('buy_sell_history', $post_data1);
                $this->session->set_flashdata('success', 'Currency has been successfully Updated.');
                redirect('admin/index/currency');
            }
        }
        $this->load->view('admin/header', $data);
        $this->load->view('admin/left_menu', $data);
        $this->load->view('admin/edit_currency', $data);
        $this->load->view('admin/footer', $data);
    }

    function delete_currency($id = false) {
        $this->validateLogin();
        $data = array();
        if ($id == '') {
            redirect('admin/index/currency');
        }
        $data['login'] = $this->session->all_userdata();
        $result = $this->comman_model->delete_by_id('currency', array('id' => $id));
        $this->session->set_flashdata('success', 'Currency has successfully deleted.');
        redirect('admin/index/currency');
    }

    function exchange_rate() {
        $this->validateLogin();
        $data = array();
        $data['login'] = $this->session->all_userdata();
        $data['title'] = 'Welcome To CompanyName';
        $data['active'] = 'exchange';
        $data['exchange_list'] = $this->comman_model->all_data('exchange_rate');
        $this->load->view('admin/header', $data);
        $this->load->view('admin/left_menu', $data);
        $this->load->view('admin/exchange_rate_list', $data);
        $this->load->view('admin/footer', $data);
    }

    function add_exchange_rate() {
        $this->validateLogin();
        $data = array();
        $data['login'] = $this->session->all_userdata();
        $data['title'] = 'Welcome To CompanyName';
        $data['active'] = 'exchange';
        $data['sub_menu'] = 'add_article';
        if ($this->input->post('operation')) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('percent', 'Percent', 'trim|required|numeric');
            if ($this->form_validation->run() == FALSE) {
                
            } else {
                $check1 = $this->comman_model->get_data_by_id('exchange_rate', array('from_payment' => $this->input->post('from_payment'), 'to_payment' => $this->input->post('to_payment')));
                //	$check2 = $this->comman_model->get_data_by_id('exchange_rate',array('to_payment'=>$this->input->post('from_payment'),'from_payment'=>$this->input->post('to_payment')));				
                if (!empty($check1)) {
//				if(!empty($check1)||!empty($check2)){
                    $this->session->set_flashdata('error', 'Exchange rate is Already Added.');
                    redirect('admin/index/add_exchange_rate');
                }
                $post_data = array(
                    'from_payment' => $this->input->post('from_payment'),
                    'to_payment' => $this->input->post('to_payment'),
                    'percent' => $this->input->post('percent'),
                    'create_date' => time(),
                    'status' => 1
                );
                $result = $this->comman_model->add('exchange_rate', $post_data);
                $this->session->set_flashdata('success', 'Exchange rate has been successfully added.');
                redirect('admin/index/exchange_rate');
            }
        }
        $this->load->view('admin/header', $data);
        $this->load->view('admin/left_menu', $data);
        $this->load->view('admin/add_exchange_rate', $data);
        $this->load->view('admin/footer', $data);
    }

    function edit_exchange_rate($id = false) {
        $this->validateLogin();
        if ($id == '') {
            redirect('admin/index/exchange_rate');
        }
        $data = array();
        $data['exchange_rate_data'] = $this->comman_model->get_data_by_id('exchange_rate', array('id' => $id));
        $data['login'] = $this->session->all_userdata();
        $data['title'] = 'Welcome To CompanyName';
        $data['active'] = 'exchange';
        if ($this->input->post('operation')) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('percent', 'Percent', 'trim|required|numeric');
            if ($this->form_validation->run() == FALSE) {
                
            } else {
                $post_data = array(
                    'percent' => $this->input->post('percent'),
                    'update_date' => time()
                );
                $result = $this->comman_model->update_data_by_id('exchange_rate', $post_data, 'id', $id);
                $this->session->set_flashdata('success', 'Exchange rate has been successfully Updated.');
                redirect('admin/index/exchange_rate');
            }
        }
        $this->load->view('admin/header', $data);
        $this->load->view('admin/left_menu', $data);
        $this->load->view('admin/edit_exchange_rate', $data);
        $this->load->view('admin/footer', $data);
    }

    function delete_exchange_rate($id = false) {
        $this->validateLogin();
        $data = array();
        if ($id == '') {
            redirect('admin/index/exchange_rate');
        }
        $data['login'] = $this->session->all_userdata();
        $result = $this->comman_model->delete_by_id('exchange_rate', array('id' => $id));
        $this->session->set_flashdata('success', 'Exchange rate has successfully deleted.');
        redirect('admin/index/exchange_rate');
    }

    function edit_balance($id = false) {

        $this->validateLogin();
        if ($id == '') {
            redirect('admin/index/user_list');
        }
        $data = array();
        $data['user_data'] = $this->comman_model->get_data_by_id('user', array('id' => $id));
        $data['login'] = $this->session->all_userdata();
        $data['title'] = 'Welcome To CompanyName';
        $data['active'] = 'user';
        $data['sub_menu'] = 'add_article';
        if ($this->input->post('operation')) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('balance', 'Balance', 'trim|required|numeric');
            if ($this->form_validation->run() == FALSE) {
                
            } else {
                $post_data = array(
                    'total_amount' => $this->input->post('balance'),
                );
                $result = $this->comman_model->update_data_by_id('user', $post_data, 'id', $id);
                $this->session->set_flashdata('success', 'User has been successfully Updated.');
                redirect('admin/index/user_list');
            }
        }

        $this->load->view('admin/header', $data);
        $this->load->view('admin/left_menu', $data);
        $this->load->view('admin/edit_balance', $data);
        $this->load->view('admin/footer', $data);
    }

    function update_user($id = false) {
        $this->validateLogin();
        if (!$id) {
            redirect('admin/index/user_list');
        }
        $data = array();
        $data['user_data'] = $this->comman_model->get_data_by_id('user', array('id' => $id));
        $data['login'] = $this->session->all_userdata();
        $data['title'] = 'Welcome To CompanyName';
        $data['active'] = 'user';
        $data['sub_menu'] = 'add_article';
        if ($this->input->post('operation')) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('password', 'Password', 'trim|required|matches[rpassword]');
            $this->form_validation->set_rules('rpassword', 'Confirm Password', 'trim|required');
            if ($this->form_validation->run() == FALSE) {
                
            } else {
                $post_data = array(
                    'password' => $this->input->post('password'),
                );
                $result = $this->comman_model->update_data_by_id('user', $post_data, 'id', $id);
                $this->session->set_flashdata('success', 'User has been successfully Updated.');
                redirect('admin/index/user_list');
            }
        }

        $this->load->view('admin/header', $data);
        $this->load->view('admin/left_menu', $data);
        $this->load->view('admin/update_user', $data);
        $this->load->view('admin/footer', $data);
    }

    function reserve_list() {
        $this->validateLogin();
        $data = array();
        $data['login'] = $this->session->all_userdata();
        $data['title'] = 'Welcome To CompanyName';
        $data['active'] = 'reserve';
        $data['reserve_list'] = $this->comman_model->all_data('currency');
        $this->load->view('admin/header', $data);
        $this->load->view('admin/left_menu', $data);
        $this->load->view('admin/reserve_list', $data);
        $this->load->view('admin/footer', $data);
    }

    function add_reserve() {
        $this->validateLogin();
        $data = array();
        $data['login'] = $this->session->all_userdata();
        $data['title'] = 'Welcome To CompanyName';
        $data['active'] = 'reserve';
        if ($this->input->post('operation')) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('price', 'Price', 'trim|required|numeric');
            if ($this->form_validation->run() == FALSE) {
                
            } else {
                $check = $this->comman_model->get_data_by_id('reserve', array('payment_id' => $this->input->post('payment_id')));
                if (!empty($check)) {
                    $this->session->set_flashdata('error', 'Reserve is already Added.');
                    redirect('admin/index/add_reserve');
                }

                $post_data = array(
                    'payment_id' => $this->input->post('payment_id'),
                    'price' => $this->input->post('price'),
                    'create_date' => time(),
                    'status' => 1
                );
                $result = $this->comman_model->add('reserve', $post_data);
                $this->session->set_flashdata('success', 'Reserve has been successfully added.');
                redirect('admin/index/reserve_list');
            }
        }
        $this->load->view('admin/header', $data);
        $this->load->view('admin/left_menu', $data);
        $this->load->view('admin/add_reserve', $data);
        $this->load->view('admin/footer', $data);
    }

    function edit_reserve($id = false) {
        $this->validateLogin();
        if ($id == '') {
            redirect('admin/index/reserve_list');
        }
        $data = array();
        //$data['reserve_data']=$this->comman_model->get_data_by_id('reserve',array('id'=>$id));
        $data['reserve_data'] = $this->comman_model->get_data_by_id('currency', array('id' => $id));
        $data['login'] = $this->session->all_userdata();
        $data['title'] = 'Welcome To CompanyName';
        $data['active'] = 'reserve';
        if ($this->input->post('operation')) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('price', 'Price', 'trim|required|numeric');
            if ($this->form_validation->run() == FALSE) {
                
            } else {
                $post_data = array(
                    'reserve_quantity' => $this->input->post('price'),
                    'update_date' => time()
                );
                $result = $this->comman_model->update_data_by_id('currency', $post_data, 'id', $id);
                $this->session->set_flashdata('success', 'Reserve has been successfully Updated.');
                redirect('admin/index/reserve_list');
            }
        }

        $this->load->view('admin/header', $data);
        $this->load->view('admin/left_menu', $data);
        $this->load->view('admin/edit_reserve', $data);
        $this->load->view('admin/footer', $data);
    }

    function get_reserve($id = false) {
        $this->validateLogin();
        if ($id == '') {
            redirect('admin/index/reserve_list');
        }
        $data = array();
        //	$data['user_data']=$this->comman_model->get_data_by_id('reserve',array('id'=>$id));
        $data['user_data'] = $this->comman_model->get_data_by_id('currency', array('id' => $id));
        $data['login'] = $this->session->all_userdata();
        $data['title'] = 'Welcome To CompanyName';
        $data['active'] = 'reserve';
        if ($this->input->post('operation')) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('balance', 'Balance', 'trim|required|numeric');
            if ($this->form_validation->run() == FALSE) {
                
            } else {
                $total = (int) $data['user_data']['reserve_quantity'] + $this->input->post('balance');
                $post_data = array(
                    'reserve_quantity' => $total,
                );
                $result = $this->comman_model->update_data_by_id('currency', $post_data, 'id', $id);
                $this->session->set_flashdata('success', 'Reserve has been successfully Updated.');
                redirect('admin/index/reserve_list');
            }
        }
        $this->load->view('admin/header', $data);
        $this->load->view('admin/left_menu', $data);
        $this->load->view('admin/get_reserve', $data);
        $this->load->view('admin/footer', $data);
    }

    function history() {
        $this->validateLogin();
        $data = array();
        $data['login'] = $this->session->all_userdata();
        $data['title'] = 'Welcome To CompanyName';
        $data['active'] = 'history';
        $data['fund_list'] = $this->comman_model->all_data('fund');
        $this->load->view('admin/header', $data);
        $this->load->view('admin/left_menu', $data);
        $this->load->view('admin/history_list', $data);
        $this->load->view('admin/footer', $data);
    }

    function reserve_history() {
        $this->validateLogin();
        $data = array();
        $data['login'] = $this->session->all_userdata();
        $data['title'] = 'Welcome To CompanyName';
        $data['active'] = 'history';
        $data['fund_list'] = $this->comman_model->all_data('user_reserve');
        $this->load->view('admin/header', $data);
        $this->load->view('admin/left_menu', $data);
        $this->load->view('admin/user_reserve_history', $data);
        $this->load->view('admin/footer', $data);
    }

    function confirm_reserve($id = false) {
        $this->validateLogin();
        if (!$id) {
            redirect('admin/index/reserve_history');
        }
        $data = array();
        $data['login'] = $this->session->all_userdata();
        $data['title'] = 'Welcome To CompanyName';

        $reserve_data = $this->comman_model->get_data_by_id('user_reserve', array('id' => $id));
        if (empty($reserve_data)) {
            $this->session->set_flashdata('error', 'There is no data.');
            redirect('admin/index/reserve_history');
        }

        $user_currency = $this->comman_model->get_data_by_id('user_currency', array('user_id' => $reserve_data['user_id'], 'currency_id' => $reserve_data['from_type']));
        if (!empty($user_currency)) {
            $total = $user_currency['quantity'] + $reserve_data['amount'];
            $currency_data = array('quantity' => $total);
            $result = $this->comman_model->update_data_by_condition('user_currency', $currency_data, array('user_id' => $reserve_data['user_id'], 'currency_id' => $reserve_data['from_type']));
        } else {
            $currency_data = array('user_id' => $reserve_data['user_id'], 'currency_id' => $reserve_data['from_type'], 'quantity' => $reserve_data['amount'], 'create_date' => time());
            $result4 = $this->comman_model->add('user_currency', $currency_data);
        }

        $result = $this->comman_model->update_data_by_id('user_reserve', array('confirm' => 1), 'id', $id);
        $this->session->set_flashdata('success', 'User Reserve has been successfully Confirmed.');
        redirect('admin/index/reserve_history');
    }

    function password() {
        $this->validateLogin();
        $data = array();
        $data['login'] = $this->session->all_userdata();
        $data['title'] = 'Welcome To CompanyName';

        $data['active'] = 'password';
        if ($this->input->post('operation')) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('old_password', 'Old Password', 'trim|required');
            $this->form_validation->set_rules('new_password', 'Password', 'trim|required|matches[rpassword]');
            $this->form_validation->set_rules('rpassword', 'Confirm Password', 'trim|required');
            if ($this->form_validation->run() == FALSE) {
                
            } else {
                $check = $this->admin_model->update_password($this->input->post('old_password'), $this->input->post('new_password'), $data['login']['admin_id']);
                if ($check == 'yes') {
                    $this->session->set_flashdata('success', 'Your Password has successfully been Updated.');
                } else {
                    $this->session->set_flashdata('success', 'Please type the right password..');
                }
                redirect('admin/index/password');
            }
        }
        $this->load->view('admin/header', $data);
        $this->load->view('admin/left_menu', $data);
        $this->load->view('admin/password', $data);
        $this->load->view('admin/footer', $data);
    }

    // this function is done to set the timer and message for the cart section.
    function timer_cart() {
        $this->validateLogin();
        $this->load->model("block_list_email");
        $data = array();
        $data['login'] = $this->session->all_userdata();
        $data['title'] = 'Welcome To CompanyName';

        $data['active'] = 'timer_cart';
        if ($this->input->post('operation')) {
            $update_data = array();
            $update_data['main_cart_timer'] = $this->input->post("main_cart_timer");
            $update_data['main_cart_msg'] = $this->input->post("main_cart_msg");
            $update_data['cart_preview_timer'] = $this->input->post("cart_preview_timer");
            $update_data['cart_preview_msg'] = $this->input->post("cart_preview_msg");
            $update_data['cart_popup_timer'] = $this->input->post("cart_popup_timer");
            $update_data['cart_popup_msg'] = $this->input->post("cart_popup_msg");
            $update_data['cart_edit_timer'] = $this->input->post("cart_edit_timer");
            $update_data['cart_edit_msg'] = $this->input->post("cart_edit_msg");
            $where_param = array();
            $where_param['id'] = 1;
            $this->block_list_email->update_column("cart_timer", $where_param, $update_data);
        }
        $where_param = array();
        $where_param['id'] = 1;
        $select_param = "*";
        $data['cart_timer'] = $this->block_list_email->get_row("cart_timer", $select_param, $where_param);
        $this->load->view('admin/header', $data);
        $this->load->view('admin/left_menu', $data);
        $this->load->view('admin/cart_timer', $data);
        $this->load->view('admin/footer', $data);
    }

    // this function is done to set the timer and message for the cart section.
    function timer_contact() {
        $this->validateLogin();
        $this->load->model("block_list_email");
        $data = array();
        $data['login'] = $this->session->all_userdata();
        $data['title'] = 'Welcome To CompanyName';

        $data['active'] = 'timer_contact';
        if ($this->input->post('operation')) {
            $update_data = array();
            $update_data['main_contact_timer'] = $this->input->post("main_contact_timer");
            $update_data['main_contact_msg'] = $this->input->post("main_contact_msg");
            $update_data['contact_preview_timer'] = $this->input->post("contact_preview_timer");
            $update_data['contact_preview_msg'] = $this->input->post("contact_preview_msg");
            $update_data['contact_popup_timer'] = $this->input->post("contact_popup_timer");
            $update_data['contact_popup_msg'] = $this->input->post("contact_popup_msg");
            $update_data['contact_edit_timer'] = $this->input->post("contact_edit_timer");
            $update_data['contact_edit_msg'] = $this->input->post("contact_edit_msg");
            $where_param = array();
            $where_param['id'] = 1;
            $this->block_list_email->update_column("contact_timer", $where_param, $update_data);
        }
        $where_param = array();
        $where_param['id'] = 1;
        $select_param = "*";
        $data['contact_timer'] = $this->block_list_email->get_row("contact_timer", $select_param, $where_param);
        $this->load->view('admin/header', $data);
        $this->load->view('admin/left_menu', $data);
        $this->load->view('admin/contact_timer', $data);
        $this->load->view('admin/footer', $data);
    }

    function timer_promotion() {
        $this->validateLogin();
        $this->load->model("block_list_email");
        $data = array();
        $data['login'] = $this->session->all_userdata();
        $data['title'] = 'Welcome To CompanyName';

        $data['active'] = 'timer_promotion';
        if ($this->input->post('operation')) {
            $update_data = array();
            $update_data['main_promotion_timer'] = $this->input->post("main_promotion_timer");
            $update_data['main_promotion_msg'] = $this->input->post("main_promotion_msg");
            $update_data['promotion_preview_timer'] = $this->input->post("promotion_preview_timer");
            $update_data['promotion_preview_msg'] = $this->input->post("promotion_preview_msg");
            $update_data['promotion_popup_timer'] = $this->input->post("promotion_popup_timer");
            $update_data['promotion_popup_msg'] = $this->input->post("promotion_popup_msg");
            $update_data['promotion_edit_timer'] = $this->input->post("promotion_edit_timer");
            $update_data['promotion_edit_msg'] = $this->input->post("promotion_edit_msg");
            $where_param = array();
            $where_param['id'] = 1;
            $this->block_list_email->update_column("promotion_timer", $where_param, $update_data);
        }
        $where_param = array();
        $where_param['id'] = 1;
        $select_param = "*";
        $data['promotion_timer'] = $this->block_list_email->get_row("promotion_timer", $select_param, $where_param);
        $this->load->view('admin/header', $data);
        $this->load->view('admin/left_menu', $data);
        $this->load->view('admin/promotion_timer', $data);
        $this->load->view('admin/footer', $data);
    }

    function timer_award() {
        $this->validateLogin();
        $this->load->model("block_list_email");
        $data = array();
        $data['login'] = $this->session->all_userdata();
        $data['title'] = 'Welcome To CompanyName';

        $data['active'] = 'timer_award';
        if ($this->input->post('operation')) {
            $update_data = array();
            $update_data['main_award_timer'] = $this->input->post("main_award_timer");
            $update_data['main_award_msg'] = $this->input->post("main_award_msg");
            $update_data['award_preview_timer'] = $this->input->post("award_preview_timer");
            $update_data['award_preview_msg'] = $this->input->post("award_preview_msg");
            $update_data['award_popup_timer'] = $this->input->post("award_popup_timer");
            $update_data['award_popup_msg'] = $this->input->post("award_popup_msg");
            $update_data['award_edit_timer'] = $this->input->post("award_edit_timer");
            $update_data['award_edit_msg'] = $this->input->post("award_edit_msg");
            $where_param = array();
            $where_param['id'] = 1;
            $this->block_list_email->update_column("award_timer", $where_param, $update_data);
        }
        $where_param = array();
        $where_param['id'] = 1;
        $select_param = "*";
        $data['award_timer'] = $this->block_list_email->get_row("award_timer", $select_param, $where_param);
        $this->load->view('admin/header', $data);
        $this->load->view('admin/left_menu', $data);
        $this->load->view('admin/award_timer', $data);
        $this->load->view('admin/footer', $data);
    }

    function timer_career() {
        $this->validateLogin();
        $this->load->model("block_list_email");
        $data = array();
        $data['login'] = $this->session->all_userdata();
        $data['title'] = 'Welcome To CompanyName';

        $data['active'] = 'timer_career';
        if ($this->input->post('operation')) {
            $update_data = array();
            $update_data['main_career_timer'] = $this->input->post("main_career_timer");
            $update_data['main_career_msg'] = $this->input->post("main_career_msg");
            $update_data['career_preview_timer'] = $this->input->post("career_preview_timer");
            $update_data['career_preview_msg'] = $this->input->post("career_preview_msg");
            $update_data['career_popup_timer'] = $this->input->post("career_popup_timer");
            $update_data['career_popup_msg'] = $this->input->post("career_popup_msg");
            $update_data['career_edit_timer'] = $this->input->post("career_edit_timer");
            $update_data['career_edit_msg'] = $this->input->post("career_edit_msg");
            $where_param = array();
            $where_param['id'] = 1;
            $this->block_list_email->update_column("career_timer", $where_param, $update_data);
        }
        $where_param = array();
        $where_param['id'] = 1;
        $select_param = "*";
        $data['career_timer'] = $this->block_list_email->get_row("career_timer", $select_param, $where_param);
        $this->load->view('admin/header', $data);
        $this->load->view('admin/left_menu', $data);
        $this->load->view('admin/career_timer', $data);
        $this->load->view('admin/footer', $data);
    }

    function timer_distribution() {
        $this->validateLogin();
        $this->load->model("block_list_email");
        $data = array();
        $data['login'] = $this->session->all_userdata();
        $data['title'] = 'Welcome To CompanyName';

        $data['active'] = 'timer_distribution';
        if ($this->input->post('operation')) {
            $update_data = array();
            $update_data['main_distribution_timer'] = $this->input->post("main_distribution_timer");
            $update_data['main_distribution_msg'] = $this->input->post("main_distribution_msg");
            $update_data['distribution_preview_timer'] = $this->input->post("distribution_preview_timer");
            $update_data['distribution_preview_msg'] = $this->input->post("distribution_preview_msg");
            $update_data['distribution_popup_timer'] = $this->input->post("distribution_popup_timer");
            $update_data['distribution_popup_msg'] = $this->input->post("distribution_popup_msg");
            $update_data['distribution_edit_timer'] = $this->input->post("distribution_edit_timer");
            $update_data['distribution_edit_msg'] = $this->input->post("distribution_edit_msg");
            $where_param = array();
            $where_param['id'] = 1;
            $this->block_list_email->update_column("distribution_timer", $where_param, $update_data);
        }
        $where_param = array();
        $where_param['id'] = 1;
        $select_param = "*";
        $data['distribution_timer'] = $this->block_list_email->get_row("distribution_timer", $select_param, $where_param);
        $this->load->view('admin/header', $data);
        $this->load->view('admin/left_menu', $data);
        $this->load->view('admin/distribution_timer', $data);
        $this->load->view('admin/footer', $data);
    }

    function clear_session() {
        $table = 'ci_sessions';
        $parameter = 'last_activity,session_id';
        $where = array();
        $this->load->model("block_list_email");
        $date = time();
        $daylen = 60 * 60 * 24;
        $result = $this->block_list_email->get_row($table, $parameter, $where);
        foreach ($result as $row) {
            $last_activity = $row->last_activity;
            $delete_where['session_id'] = $row->session_id;
            $date_differ = ($date - $last_activity) / $daylen;
            if (floor($date_differ) > 1) {
                $this->block_list_email->delete_row($table, $delete_where);
            }
        }
        $this->index();
    }

    function logout() {
        $data['login'] = $this->session->all_userdata();
        $this->session->unset_userdata('logged_in');
        $this->session->unset_userdata('second_confirmation');
        $this->session->unset_userdata('login');
        $this->session->unset_userdata('first_name');
        $this->session->unset_userdata('last_name');
        $this->session->unset_userdata('user_id');
        $this->session->sess_destroy();
        redirect('admin/index/login');
    }

    function pre($table) {
        echo '<pre>';
        print_r($table);
        die;
    }

    function del_vehiclecategoryimagepermanently($id, $imagetodelete) {

        $post_data[$imagetodelete] = '';

        $all_data = $this->comman_model->get_data_by_id('tbl_vehicle_categories', array('id' => $id));

        $update = $this->comman_model->update_data_by_id('tbl_vehicle_categories', $post_data, 'id', $id);

        if ($update) {
            if (file_exists("assets/uploads/vehicle_categories/" . $all_data[$imagetodelete]))
                unlink("assets/uploads/vehicle_categories/" . $all_data[$imagetodelete]);
        }
    }

    /* ------- functions changed from front controller on 4-4-2014 ------- */

    function delete_makerimage($id) {

        $post_data['maker_logo'] = '';

        $all_data = $this->comman_model->get_data_by_id('tbl_makers', array('id' => $id));

        $update = $this->comman_model->update_data_by_id('tbl_makers', $post_data, 'id', $id);

        if ($update) {
            if (file_exists("assets/uploads/product_maker/" . $all_data['maker_logo']))
                unlink("assets/uploads/product_maker/" . $all_data['maker_logo']);
        }
    }

    function delete_modelimage($id) {

        $post_data['model_photo'] = '';

        $all_data = $this->comman_model->get_data_by_id('tbl_models', array('id' => $id));

        $update = $this->comman_model->update_data_by_id('tbl_models', $post_data, 'id', $id);

        if ($update) {
            if (file_exists("assets/uploads/product_model/" . $all_data['model_photo']))
                unlink("assets/uploads/product_model/" . $all_data['model_photo']);
        }
    }

    function delete_typeimage($id) {
        $post_data['Product_Type_Photo'] = '';
        $update = $this->comman_model->update_data_by_id('tbl_product_types', $post_data, 'id', $id);
    }

    function delete_productimagepermanently($id, $imagetodelete) {

        $post_data[$imagetodelete] = '';

        $all_data = $this->comman_model->get_data_by_id('tbl_products', array('id' => $id));

        $update = $this->comman_model->update_data_by_id('tbl_products', $post_data, 'id', $id);

        if ($update) {

            if (file_exists("assets/uploads/product_images/" . $all_data[$imagetodelete]))
                unlink("assets/uploads/product_images/" . $all_data[$imagetodelete]);
        }
    }

    function listfields($type) {

        $data['menu_details'] = $this->product_model->get_menu_fields($type);
        $product_models = $this->comman_model->all_data('tbl_models');
        $product_catagory = $this->comman_model->all_data('tbl_vehicle_categories');
        $product_makers = $this->comman_model->all_data('tbl_makers');
        $menustring = $data['menu_details']['menu_privilages_admin'];
        $menuname = explode('#', $menustring);

        if (in_array("kgt_ref_number", $menuname)) {
            echo '<div class="control-group">
					<label class="control-label">Kgt Reference Number:</label>
					<div class="controls"><input id="kgt_ref_number" name="kgt_ref_number" class="focustip span12" type="text" value="" ></div>
				</div>';
        }
        if (in_array("vehicle_category_id", $menuname)) {
            echo '<div class="control-group">
					<label class="control-label">Category:</label>
					<div class="controls">
						<select name="vehicle_category_id" id="vehicle_category_id" class="focustip span12" >';
            foreach ($product_catagory as $catagory) {
                echo '<option value="' . $catagory['id'] . '">' . $catagory['category_name'] . '</option>';
            }
            echo '</select>
					</div>
				</div>';
        }
        if (in_array("maker_id", $menuname)) {
            echo '<div class="control-group">
					<label class="control-label">Maker:</label>
					<div class="controls">
					<select name="maker_id" id="maker_id" class="focustip span12" >';
            foreach ($product_makers as $make) {
                echo '<option value="' . $make['id'] . '">' . $make['maker_name'] . '</option>';
            }
            echo '</select>
					</div>
				</div>';
        }
        if (in_array("model_id", $menuname)) {
            echo '<div class="control-group">
					<label class="control-label">Model:</label>
					<div class="controls">
						<select name="model_id" id="model_id" class="focustip span12">';
            foreach ($product_models as $model) {
                echo '<option value="' . $model['id'] . '">' . $model['model_name'] . '</option>';
            }
            echo ' </select>
					</div>
				</div>';
        }
        if (in_array("drawing_photo", $menuname)) {
            echo '<div class="control-group">
					<label class="control-label">Drawing Photo::</label>
					<div class="controls"><input id="drawing_photo" name="drawing_photo" class="focustip span12" type="file">
						<img id="modelimg_prvw1" src="./assets/admin/previewimage.jpg" alt=" image preview" style="width: 115px;height: 90px;margin-top: 12px;"/>
                    	<div id="modelimg_prvw1_delete" style="margin-top: 10px;"></div>
					</div>
				</div>';
        }
        if (in_array("product_photo", $menuname)) {
            echo '<div class="control-group">
					<label class="control-label">Product Photo:</label>
					<div class="controls"><input id="product_photo" name="product_photo" class="focustip span12" type="file" >
						<img id="modelimg_prvw2" src="./assets/admin/previewimage.jpg" alt=" image preview" style="width: 115px;height: 90px;margin-top: 12px;"/>
                        <div id="modelimg_prvw2_delete" style="margin-top: 10px;"></div>
					</div>
				</div>';
        }
        if (in_array("vehicle_photo", $menuname)) {
            echo '<div class="control-group">
					<label class="control-label">Vehicle Photo:</label>
					<div class="controls"><input id="vehicle_photo" name="vehicle_photo" class="focustip span12" type="file" >
						<img id="modelimg_prvw3" src="./assets/admin/previewimage.jpg" alt=" image preview" style="width: 115px;height: 90px;margin-top: 12px;"/>
                        <div id="modelimg_prvw3_delete" style="margin-top: 10px;"></div>
					</div>
				</div>';
        }
        if (in_array("knect", $menuname)) {
            echo '<div class="control-group">
					<label class="control-label">Knect:</label>
					<div class="controls"><input id="knect" name="knect" class="focustip span12" type="text" value="" ></div>
				</div>';
        }
        if (in_array("filtron", $menuname)) {
            echo '<div class="control-group">
					<label class="control-label">Filtron:</label>
					<div class="controls"><input id="filtron" name="filtron" class="focustip span12" type="text" value="" ></div>
				</div>';
        }
        if (in_array("purflux", $menuname)) {
            echo '<div class="control-group">
					<label class="control-label">Purflux:</label>
					<div class="controls"><input id="purflux" name="purflux" class="focustip span12" type="text" value="" ></div>
				</div>';
        }
        if (in_array("mann", $menuname)) {
            echo '<div class="control-group">
					<label class="control-label">Mann:</label>
					<div class="controls"><input id="mann" name="mann" class="focustip span12" type="text" value="" ></div>
				</div>';
        }
        if (in_array("mecafilter", $menuname)) {
            echo '<div class="control-group">
					<label class="control-label">Mecafilter:</label>
					<div class="controls"><input id="mecafilter" name="mecafilter" class="focustip span12" type="text" value="" ></div>
				</div>';
        }
        if (in_array("oem_part_number", $menuname)) {
            echo '<div class="control-group">
					<label class="control-label">Oem_part_number:</label>
					<div class="controls"><input id="oem_part_number" name="oem_part_number" class="focustip span12" type="text" value="" ></div>
				</div>';
        }
        if (in_array("application", $menuname)) {
            echo '<div class="control-group">
					<label class="control-label">Application:</label>
					<div class="controls"><input id="application" name="application" class="focustip span12" type="text" value="" ></div>
				</div>';
        }
        if (in_array("fleet", $menuname)) {
            echo '<div class="control-group">
					<label class="control-label">Fleet:</label>
					<div class="controls"><input id="fleet" name="fleet" class="focustip span12" type="text" value="" ></div>
				</div>';
        }
        if (in_array("baldwin", $menuname)) {
            echo '<div class="control-group">
					<label class="control-label">Baldwin:</label>
					<div class="controls"><input id="baldwin" name="baldwin" class="focustip span12" type="text" value="" ></div>
				</div>';
        }
        if (in_array("others", $menuname)) {
            echo '<div class="control-group">
					<label class="control-label">Others:</label>
					<div class="controls"><input id="others" name="others" class="focustip span12" type="text" value="" ></div>
				</div>';
        }
        if (in_array("fmsi_ref_number", $menuname)) {
            echo '<div class="control-group">
					<label class="control-label">FMSI Ref Number:</label>
					<div class="controls"><input id="fmsi_ref_number" name="fmsi_ref_number" class="focustip span12" type="text" value="" ></div>
				</div>';
        }
        if (in_array("year", $menuname)) {
            echo '<div class="control-group">
					<label class="control-label">Year:</label>
					<div class="controls"><input id="year" name="year" class="focustip span12" type="text" value="" ></div>
				</div>';
        }
        if (in_array("front_rear", $menuname)) {
            echo '<div class="control-group">
					<label class="control-label">Front Rear:</label>
					<div class="controls"><input id="front_rear" name="front_rear" class="focustip span12" type="text" value="" ></div>
				</div>';
        }
        if (in_array("designation", $menuname)) {
            echo '<div class="control-group">
					<label class="control-label">Designation:</label>
					<div class="controls"><input id="designation" name="designation" class="focustip span12" type="text" value="" ></div>
				</div>';
        }
        if (in_array("wva", $menuname)) {
            echo '<div class="control-group">
					<label class="control-label">WVA:</label>
					<div class="controls"><input id="wva" name="wva" class="focustip span12" type="text" value="" ></div>
				</div>';
        }
        if (in_array("qty", $menuname)) {
            echo '<div class="control-group">
					<label class="control-label">Quantity:</label>
					<div class="controls"><input id="qty" name="qty" class="focustip span12" type="text" value="" ></div>
				</div>';
        }
        if (in_array("diameter", $menuname)) {
            echo '<div class="control-group">
					<label class="control-label">Diameter:</label>
					<div class="controls"><input id="diameter" name="diameter" class="focustip span12" type="text" value="" ></div>
				</div>';
        }
        if (in_array("width", $menuname)) {
            echo '<div class="control-group">
					<label class="control-label">Width:</label>
					<div class="controls"><input id="width" name="width" class="focustip span12" type="text" value="" ></div>
				</div>';
        }
        if (in_array("holes_no", $menuname)) {
            echo '<div class="control-group">
					<label class="control-label">Holes No:</label>
					<div class="controls"><input id="holes_no" name="holes_no" class="focustip span12" type="text" value="" ></div>
				</div>';
        }
    }

    function manage_menu($menu_name = false) {
        if ($menu_name) {
            $this->load->model('menu_model');
            $menu_info = $this->menu_model->get_menu_info($menu_name);
            //echo "<pre>"; print_r($menu_info[0]['menu_image']); echo "</pre>"; exit;
            $this->check_lang();
            $this->validateLogin();
            $data = array();
            $data['title'] = 'Welcome To CompanyName';
            $data['login'] = $this->session->all_userdata();
            //$data['active'] = 'manage_menus';
            $data['menu_name'] = $menu_name;
            $data['menu_image'] = $menu_info[0]['menu_image'];
            $this->load->view('admin/header', $data);
            $this->load->view('admin/left_menu', $data);
            $this->load->view('admin/single_menu', $data);
            //$this->load->view('admin/content',$data);
            //$this->load->view('admin/add_tip_of_day',$data);
            $this->load->view('admin/footer', $data);
        } else {
            $this->check_lang();
            $this->validateLogin();
            $data = array();
            $data['title'] = 'Welcome To CompanyName';
            $data['login'] = $this->session->all_userdata();
            $data['active'] = 'manage_menus';
            $data['name'] = 'Manage Menus';
            $this->load->view('admin/header', $data);
            $this->load->view('admin/left_menu', $data);
            $this->load->view('admin/manage_menus', $data);
            $this->load->view('admin/footer', $data);
        }
    }

    function edit_menu($menu_name = false) {
        
        $this->check_lang();
        $this->validateLogin();
        $data['active'] = 'manage_menus';
        
        if ($menu_name) {
            $this->load->model('menu_model');
            if ($this->input->post('menu_label')) {
                $mlabel = $this->input->post('menu_label');
                if (empty($mlabel))
                    $mlabel = $menu_name;
                if (!empty($_FILES['file']['name'])) {
                    $field_name = 'file';
                    $config['upload_path'] = './assets/uploads/menus/temp/';
                    $config['allowed_types'] = 'gif|jpeg|jpg|png|JPG|PNG|GIF|JPEG';
                    $config['max_size'] = '800';
                    $config['max_width'] = '2000';
                    $config['max_height'] = '2000';
                    $this->load->library('upload', $config);

                    if (!$this->upload->do_upload($field_name)) {
                        $this->session->set_flashdata('error', $this->upload->display_errors());
                        //redirect('admin/edit_vehicle');
                    } else {
                        $upload_data = $this->upload->data();
                        $this->load->library('image_lib');
                        $config['image_library'] = 'gd2';
                        $config['source_image'] = 'assets/uploads/menus/temp/' . $upload_data['file_name'];
                        $config['new_image'] = 'assets/uploads/menus/' . $upload_data['file_name'];
                        $config['maintain_ratio'] = TRUE;
                        $config['width'] = 75;
                        $config['height'] = 44;
                        $this->image_lib->initialize($config);
                        $this->image_lib->resize();
                        $this->image_lib->clear();
                        unlink('assets/uploads/menus/temp/' . $upload_data['file_name']);
                    }
                }
                if ($upload_data['file_name']) {

                    $info = array(
                        'menu_label' => $mlabel,
                        'menu_image' => $upload_data['file_name']
                    );
                }
                else
                    $info = array(
                        'menu_label' => $mlabel
                    );


                $all_data = $this->menu_model->get_menu_info($menu_name);
                $result = $this->menu_model->update_menu_info($info, $menu_name);

                if ($result) {

                    if ($info['menu_image']) {
                        if (file_exists("assets/uploads/menus/" . $all_data[0]['menu_image']))
                            unlink("assets/uploads/menus/" . $all_data[0]['menu_image']);
                    }
                }

                $this->manage_menu($menu_name);
            }
            else {
                $menu_info = array();
                $menu_info = $this->menu_model->get_menu_info($menu_name);
                //echo "<pre>"; print_r($menu_info); echo "</pre>"; exit;
                $data['menu_name'] = $menu_name;
                $data['menu_info'] = $menu_info;
                $this->load->view('admin/header', $data);
                $this->load->view('admin/left_menu', $data);
                $this->load->view('admin/edit_menu', $data);
                $this->load->view('admin/footer', $data);
            }
        }
    }

    function delete_job_image($id = false) {
        //var_dump('ssssss');exit;
        $data = array();

        $data['login'] = $this->session->all_userdata();

        $this->validateLogin();

        $table = 'job_section';

        $name = 'Image';

        if (!$id) {

            redirect('admin/' . $page);
        }

        $result = $this->comman_model->update_data_by_id($table, array('image' => ''), 'id', $id);

        $this->session->set_flashdata('success', sprintf(lang('%s has successfully deleted.'), $name));

        redirect('admin/index/edit_job_section/' . $id);
    }
    
    function deleteAll(){
        $data = array();
        $data['login'] = $this->session->all_userdata();
        $this->validateLogin();

        $block_ids = $this->input->post('block_ids');
        $table = $this->input->post('table');
        $path = $this->input->post('path');
        $have_image = $this->input->post('have_image');
        
          if($have_image == true){ 
            $fields = array('image');
            $all_datas = $this->comman_model->getAllById($table, $block_ids,$fields);
            if ($all_datas) {                
                foreach($all_datas as $all_data){
                if (file_exists("assets/uploads/" . $path . "/full/" . $all_data['image']))
                    unlink("assets/uploads/" . $path . "/full/" . $all_data['image']);
                if (file_exists("assets/uploads/" . $path . "/small/" . $all_data['image']))
                    unlink("assets/uploads/" . $path . "/small/" . $all_data['image']);

                if (file_exists("assets/uploads/" . $path . "/thumbnails/" . $all_data['image']))
                    unlink("assets/uploads/" . $path . "/thumbnails/" . $all_data['image']);
                }                
            }
          }
          
          $deleteuser = $this->input->post('deleteuser');          
          if ($deleteuser == true) {
            $field = $this->input->post('field');
            $where_field = $this->input->post('where_field');
            if (empty($field)) {
                $field = 'str_email';
            }
            if (empty($where_field)) {
                $where_field = 'int_id';
            }
            /*             * ****** get all block email and delete all email from block list start by razib 4axiz ***** */

            $fields = array($field);
            $all_datas = $this->comman_model->getAllById($table, $block_ids, $fields, $where_field);

            if ($all_datas) {
                $str_email_array = array();
                foreach ($all_datas as $all_data) {
                    $str_email_array[] = $all_data[$field];
                }
                $this->comman_model->deleteAllById('block_email_list', $str_email_array, 'str_email');
                //$this->comman_model->deleteAllById('block_users', $str_email_array, 'email');
            }
        }
          
          
          $result = $this->comman_model->deleteAllById($table, $block_ids);        
        echo "Successfully Delete";
        exit;
    }
    
    // this function is done to set the selection instruction for the product, product type, product brand, vehicle type, product list for the cart section.
    function selection_instruction() {
        $this->validateLogin();
        $this->load->model("block_list_email");
        $data = array();
        $data['login'] = $this->session->all_userdata();
        $data['title'] = 'Welcome To CompanyName';

        $data['active'] = 'selection_instruction';
        if ($this->input->post('operation')) {
            $update_data = array();
            $update_data['product_msg'] = $this->input->post("product_msg");
            $update_data['product_type_msg'] = $this->input->post("product_type_msg");
            $update_data['vehicle_type_msg'] = $this->input->post("vehicle_type_msg");
            $update_data['product_brand_msg'] = $this->input->post("product_brand_msg");
            $update_data['product_list_msg'] = $this->input->post("product_list_msg");
            $update_data['selection_popup_header'] = $this->input->post("selection_popup_header");
            $update_data['selection_popup_body'] = $this->input->post("selection_popup_body");
            $update_data['already_exist_msg'] = $this->input->post("already_exist_msg");
            $update_data['addtocart_popup_header'] = $this->input->post("addtocart_popup_header");
            $update_data['addtocart_msg'] = $this->input->post("addtocart_msg");
            $update_data['maincart_block_msg'] = $this->input->post("maincart_block_msg");
            $update_data['editcart_block_msg'] = $this->input->post("editcart_block_msg");
            $update_data['cartpreview_block_msg'] = $this->input->post("cartpreview_block_msg");
            $update_data['cartverification_block_msg'] = $this->input->post("cartverification_block_msg");
            $update_data['block_notification_msg'] = $this->input->post("block_notification_msg");
            $update_data['cartverification_resent_block_msg'] = $this->input->post("cartverification_resent_block_msg");
            $update_data['cartverification_wrong_block_msg'] = $this->input->post("cartverification_wrong_block_msg");
            $where_param = array();
            $where_param['id'] = 1;
            $this->block_list_email->update_column("selection_instruction", $where_param, $update_data);
        }
        $where_param = array();
        $where_param['id'] = 1;
        $select_param = "*";
        $data['selection_instruction'] = $this->block_list_email->get_row("selection_instruction", $select_param, $where_param);
        $this->load->view('admin/header', $data);
        $this->load->view('admin/left_menu', $data);
        $this->load->view('admin/selection_instruction', $data);
        $this->load->view('admin/footer', $data);
    }
    
    function promotion_message(){
        $this->validateLogin();
        $this->load->model("block_list_email");
        $data = array();
        $data['login'] = $this->session->all_userdata();
        $data['title'] = 'Welcome To CompanyName';

        $data['active'] = 'promotion_message';
        if ($this->input->post('operation')) {
            $update_data = array();
            $update_data['firstThank_you_msg'] = $this->input->post("firstThank_you_msg");
            $update_data['firstThank_you_header'] = $this->input->post("firstThank_you_header");
            $update_data['secondThank_you_msg'] = $this->input->post("secondThank_you_msg");
            $update_data['secondThank_you_header'] = $this->input->post("secondThank_you_header");
            $update_data['already_request_msg'] = $this->input->post("already_request_msg");
            $update_data['already_request_header'] = $this->input->post("already_request_header");
            $update_data['blocked_email_msg'] = $this->input->post("blocked_email_msg");
            $update_data['resend_block_msg'] = $this->input->post("resend_block_msg");
            $update_data['error_code_block_msg'] = $this->input->post("error_code_block_msg");
            $update_data['verification_timeout'] = $this->input->post("verification_timeout");
            $update_data['contactus_timeout'] = $this->input->post("contactus_timeout");
            $update_data['preview_contactus_timeout'] = $this->input->post("preview_contactus_timeout");
            $where_param = array();
            $where_param['id'] = 1;
            $this->block_list_email->update_column("promotion_message", $where_param, $update_data);
        }
        $where_param = array();
        $where_param['id'] = 1;
        $select_param = "*";
        $data['promotion_message'] = $this->block_list_email->get_row("promotion_message", $select_param, $where_param);
        $this->load->view('admin/header', $data);
        $this->load->view('admin/left_menu', $data);
        $this->load->view('admin/promotion_message', $data);
        $this->load->view('admin/footer', $data);
    }
    
    function award_message(){
        $this->validateLogin();
        $this->load->model("block_list_email");
        $data = array();
        $data['login'] = $this->session->all_userdata();
        $data['title'] = 'Welcome To CompanyName';

        $data['active'] = 'award_message';
        if ($this->input->post('operation')) {
            $update_data = array();
            $update_data['Thank_you_msg'] = $this->input->post("Thank_you_msg");
            $update_data['Thank_you_header'] = $this->input->post("Thank_you_header");
            $update_data['already_submitted'] = $this->input->post("already_submitted");
            $update_data['verification_timeout'] = $this->input->post("verification_timeout");
            $update_data['error_code_block_msg'] = $this->input->post("error_code_block_msg");
            $update_data['blocked_email_msg'] = $this->input->post("blocked_email_msg");
            $update_data['email_verification_message'] = $this->input->post("email_verification_message");  
            $update_data['not_winning_no'] = $this->input->post("not_winning_no");     
            $update_data['congratulation'] = $this->input->post("congratulation");     
            $update_data['dealing_msg'] = $this->input->post("dealing_msg");
            
            $where_param = array();
            $where_param['id'] = 1;
            $this->block_list_email->update_column("award_message", $where_param, $update_data);
        }
        $where_param = array();
        $where_param['id'] = 1;
        $select_param = "*";
        $data['award_message'] = $this->block_list_email->get_row("award_message", $select_param, $where_param);
        $this->load->view('admin/header', $data);
        $this->load->view('admin/left_menu', $data);
        $this->load->view('admin/award_message', $data);
        $this->load->view('admin/footer', $data);
    }

     function contact_message(){
        $this->validateLogin();
        $this->load->model("block_list_email");
        $data = array();
        $data['login'] = $this->session->all_userdata();
        $data['title'] = 'Welcome To CompanyName';

        $data['active'] = 'contact_message';
        if ($this->input->post('operation')) {
            $update_data = array();
            $update_data['preview_timeout'] = $this->input->post("preview_timeout");
            $update_data['refreshed_msg'] = $this->input->post("refreshed_msg");
            $update_data['resend_block_msg'] = $this->input->post("resend_block_msg");
            $update_data['verification_timeout'] = $this->input->post("verification_timeout");
            $update_data['error_code_block_msg'] = $this->input->post("error_code_block_msg");
            $update_data['blocked_email_msg'] = $this->input->post("blocked_email_msg");
            $update_data['code_timeout_block_msg'] = $this->input->post("code_timeout_block_msg");
            $update_data['modal_success_header'] = $this->input->post("modal_success_header");
            $update_data['modal_success_body'] = $this->input->post("modal_success_body");
            $where_param = array();
            $where_param['id'] = 1;
            $this->block_list_email->update_column("contact_message", $where_param, $update_data);
        }
        $where_param = array();
        $where_param['id'] = 1;
        $select_param = "*";
        $data['contact_message'] = $this->block_list_email->get_row("contact_message", $select_param, $where_param);
        $this->load->view('admin/header', $data);
        $this->load->view('admin/left_menu', $data);
        $this->load->view('admin/contact_message', $data);
        $this->load->view('admin/footer', $data);
    }
    function career_message(){
        $this->validateLogin();
        $this->load->model("block_list_email");
        $data = array();
        $data['login'] = $this->session->all_userdata();
        $data['title'] = 'Welcome To CompanyName';

        $data['active'] = 'career_message';
        if ($this->input->post('operation')) {
            $update_data = array();
            $update_data['validate_confirm'] = $this->input->post("validate_confirm");
            $update_data['upload_resume'] = $this->input->post("upload_resume");
            $update_data['resend_block_msg'] = $this->input->post("resend_block_msg");
            $update_data['verification_timeout'] = $this->input->post("verification_timeout");
            $update_data['error_code_block_msg'] = $this->input->post("error_code_block_msg");
            $update_data['blocked_email_msg'] = $this->input->post("blocked_email_msg");
            $update_data['code_timeout_block_msg'] = $this->input->post("code_timeout_block_msg");
            $update_data['modal_success_header'] = $this->input->post("modal_success_header");
            $update_data['modal_success_body'] = $this->input->post("modal_success_body");
            $where_param = array();
            $where_param['id'] = 1;
            $this->block_list_email->update_column("career_message", $where_param, $update_data);
        }
        $where_param = array();
        $where_param['id'] = 1;
        $select_param = "*";
        $data['career_message'] = $this->block_list_email->get_row("career_message", $select_param, $where_param);
        $this->load->view('admin/header', $data);
        $this->load->view('admin/left_menu', $data);
        $this->load->view('admin/career_message', $data);
        $this->load->view('admin/footer', $data);
    }
    
    // this function is done to set the dynamic message for the distribution section
    function distribution_message() {
        $this->validateLogin();
        $this->load->model("block_list_email");
        $data = array();
        $data['login'] = $this->session->all_userdata();
        $data['title'] = 'Welcome To CompanyName';
        $data['active'] = 'Distribution message';
        if ($this->input->post('operation')) {
            $update_data = array();
            $update_data['timeout_msg'] = $this->input->post("timeout_msg");
            $update_data['resent_msg'] = $this->input->post("resent_msg");
            $update_data['wrong_code_msg'] = $this->input->post("wrong_code_msg");
            $update_data['application_receipt_msg'] = $this->input->post("application_receipt_msg");
            $update_data['blocked_email_msg'] = $this->input->post("blocked_email_msg");
            $where_param = array();
            $where_param['id'] = 1;
            $this->block_list_email->update_column("distribution_message", $where_param, $update_data);
        }
        $where_param = array();
        $where_param['id'] = 1;
        $select_param = "*";
        $data['distribution_message'] = $this->block_list_email->get_row("distribution_message", $select_param, $where_param);
        $this->load->view('admin/header', $data);
        $this->load->view('admin/left_menu', $data);
        $this->load->view('admin/distribution_message', $data);
        $this->load->view('admin/footer', $data);
    }
    
}

/* End of file admin.php */
/* Location: ./application/controllers/admin.php */