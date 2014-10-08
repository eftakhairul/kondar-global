<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Career extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
        $this->load->model('admin_model');
        $this->load->model('comman_model');
        $this->load->model('block_list_email');
        $this->load->helper('date');
        $this->load->helper('form');
        $this->load->library('session');
        $this->load->library("pagination");
        $this->load->helper("language");
        $this->load->language("admin/career");

        $this->clear_cache();
    }

    function add_job_section() {
        $this->check_lang();
        $this->validateLogin();
        $data = array();
        $data['login'] = $this->session->all_userdata();
        $data['title'] = 'Welcome To CompanyName';
        $data['active'] = 'job';
        $data['product_name'] = 'Job Section';


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
                redirect('admin/add_globe');
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

                if (!$this->input->post('operation')) {
                    die($upload_data['file_name']);
                }
            }
        }

        if ($this->input->post('operation')) {
            if (!empty($_POST['imagefile'])) {
                $post_data = array(
                    'name' => $this->input->post('title'),
                    'category' => $this->input->post('category'),
                    'scope' => $this->input->post('scope'),
                    'qualification' => $this->input->post('qualification'),
                    'image' => $_POST['imagefile'],
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
                    $result1 = $this->comman_model->add('question', array(
                        'job_id' => $result,
                        'name' => $question_no[$i],
                        'duration' => $duration[$i],
                        'min_words' => $words[$i],
                        'status' => 1,
                        'create_date' => time()
                            ));
                }
            }
            $this->session->set_flashdata('success', lang('Job has been successfully added.'));
            redirect('admin/career/job_section');
        }
        $this->load->view('admin/header', $data);
        $this->load->view('admin/left_menu', $data);
        $this->load->view('admin/career/add_job', $data);
        $this->load->view('admin/footer', $data);
    }

    function index() {
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

    function edit_job_section($id = false) {

        if (!$id) {
            redirect('admin/career/job_section');
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



                $all_data = $this->comman_model->get_data_by_id('job_section', array('id' => $id));

                $result = $this->comman_model->update_data_by_id('job_section', $post_data, 'id', $id);


                if ($result) {

                    if (file_exists("assets/uploads/job_section/full/" . $all_data['image']))
                        unlink("assets/uploads/job_section/full/" . $all_data['image']);


                    if (file_exists("assets/uploads/job_section/small/" . $all_data['image']))
                        unlink("assets/uploads/job_section/small/" . $all_data['image']);

                    if (file_exists("assets/uploads/job_section/thumbnails/" . $all_data['image']))
                        unlink("assets/uploads/job_section/thumbnails/" . $all_data['image']);
                }

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
            redirect('admin/career/job_section');
        }
        $data['edit_data'] = $this->comman_model->get_data_by_id('job_section', array('id' => $id));
        $this->load->view('admin/header', $data);
        $this->load->view('admin/left_menu', $data);
        $this->load->view('admin/career/edit_job', $data);
        $this->load->view('admin/footer', $data);
    }

    function delete_job_question() {

        $table = 'question';
        $result = $this->block_list_email->delete_row($table, array('id' => $_POST['id']));
        echo $result;
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
                redirect('/admin/login', 'refresh');
            }
        } else {
            redirect('/admin/login', 'refresh');
        }
    }

    function question($id = false) {
        if (!$id) {
            redirect('admin/job_section');
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
            redirect('admin/job_section');
        }
        $this->load->view('admin/header', $data);
        $this->load->view('admin/left_menu', $data);
        $this->load->view('admin/career/question_list', $data);
        $this->load->view('admin/footer', $data);
    }

    function edit_question($page = false, $id = false) {
        if (!$page) {
            redirect('admin/career/job_section');
        }
        if (!$id) {
            redirect('admin/career/question/' . $page);
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
            $this->session->set_flashdata('success', lang('Question has been successfully updated.'));
            redirect('admin/career/question/' . $page);
        }
        $data['edit_data'] = $this->comman_model->get_data_by_id('question', array('id' => $id));
        $this->load->view('admin/header', $data);
        $this->load->view('admin/left_menu', $data);
        $this->load->view('admin/career/edit_question', $data);
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
        $this->load->view('admin/career/interview_list', $data);
        $this->load->view('admin/footer', $data);
    }

    function interview($id) {
        if (!$id) {
            redirect('admin/interview_section');
        }
        $this->check_lang();
        $this->validateLogin();
        $data = array();
        $data['login'] = $this->session->all_userdata();
        $data['title'] = 'Welcome To CompanyName';
        $data['active'] = 'interview';

        $this->db->join("question", "question.id=user_ans.question_id");
        $this->db->join("apply_form", "user_ans.user_id=apply_form.id");
        $data['view_data'] = $this->comman_model->get_all_data_by_id('user_ans', array('user_id' => $id));

        $this->load->view('admin/header', $data);
        $this->load->view('admin/left_menu', $data);

        $this->load->view('admin/career/view_interview', $data);

        $this->load->view('admin/footer', $data);
    }

    function delete_user_block($id) {
        $data = array();
        $data['login'] = $this->session->all_userdata();
        $this->validateLogin();
        $table = 'apply_form';
        $name = 'User';

        if (!$id) {
            redirect('admin/career/user_block');
        }

        $where = 'block';
        $data = $this->comman_model->get_tabledata_by_id($table, $id, $where);
        foreach ($data as $item) {
            $this->comman_model->delete_block_email_list_by_id($item['email']);
        }

        $result = $this->comman_model->delete_by_id($table, array('id' => $id));
        $this->session->set_flashdata('success', sprintf(lang('%s has successfully deleted.'), $name));
        redirect('admin/career/user_block/');
    }
    
    function delete_all_user_block() {
        $block_ids = $this->input->post('block_ids');
        if ($block_ids) {
            $table = 'apply_form';
            $name = 'User';
            $where = 'block';

            foreach ($block_ids as $id) {                
                $data = $this->comman_model->get_tabledata_by_id($table, $id, $where);
                foreach ($data as $item) {
                    $this->comman_model->delete_block_email_list_by_id($item['email']);
                }
                $result = $this->comman_model->delete_by_id($table, array('id' => $id));
            }
            echo 'success';
            exit;
        }
    }

    function delete_interview_section($id, $job_id) {
        $data = array();
        $data['login'] = $this->session->all_userdata();
        $this->validateLogin();
        $table_apply_form = 'apply_form';
        $table_user_ans = 'user_ans';

        $name = 'User';

        if (!$id) {
            redirect('admin/career/interview_section');
        }
        $result = $this->block_list_email->delete_row($table_apply_form, array('id' => $id));

        if ($result)
            $this->block_list_email->delete_row($table_user_ans, array('user_id' => $id, 'job_id' => $job_id));

        $this->session->set_flashdata('success', sprintf(lang('%s has successfully deleted.'), $name));
        redirect('admin/career/interview_section/');
    }
    
    function delete_all_interview_section() {
        $block_ids = $this->input->post('block_ids');
        $jobidarray = $this->input->post('jobidarray');
        if ($block_ids) {
            $data = array();
            $data['login'] = $this->session->all_userdata();
            $this->validateLogin();
            $table_apply_form = 'apply_form';
            $table_user_ans = 'user_ans';

            $name = 'User';   
            foreach ($block_ids as $key => $id) { 
            $result = $this->block_list_email->delete_row($table_apply_form, array('id' => $id));
            $job_id = $jobidarray[$key];
            
            if ($result)
                $this->block_list_email->delete_row($table_user_ans, array('user_id' => $id, 'job_id' => $job_id));

            }

            echo "success";
            exit;
        }
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
        //print_r($data['all_data']);
        $this->load->view('admin/header', $data);
        $this->load->view('admin/left_menu', $data);
        $this->load->view('admin/career/interview_list', $data);
        $this->load->view('admin/footer', $data);
    }

    function delete_job_section($id) {
        $data = array();
        $data['login'] = $this->session->all_userdata();
        $this->validateLogin();
        $table = 'job_section';
        $name = 'Job';
        if (!$id) {
            redirect('admin/career/job_section');
        }


        $all_data = $this->comman_model->get_data_by_id($table, array('id' => $id));
        $result = $this->comman_model->delete_by_id($table, array('id' => $id));

        if ($all_data) {
            if (file_exists("assets/uploads/job_section/full/" . $all_data['image']))
                unlink("assets/uploads/job_section/full/" . $all_data['image']);

            if (file_exists("assets/uploads/job_section/small/" . $all_data['image']))
                unlink("assets/uploads/job_section/small/" . $all_data['image']);

            if (file_exists("assets/uploads/job_section/thumbnails/" . $all_data['image']))
                unlink("assets/uploads/job_section/thumbnails/" . $all_data['image']);
        }

        $this->session->set_flashdata('success', sprintf(lang('%s has successfully deleted.'), $name));
        redirect('admin/career/job_section/');
    }
    
    
    function delete_all_job_section() {
        $ids = $this->input->post('ids');
        if ($ids) {
        $data = array();
        $data['login'] = $this->session->all_userdata();
        $this->validateLogin();
        $table = 'job_section';
        $name = 'Job';
        foreach ($ids as $id){
      

        $all_data = $this->comman_model->get_data_by_id($table, array('id' => $id));
        $result = $this->comman_model->delete_by_id($table, array('id' => $id));

        if ($all_data) {
            if (file_exists("assets/uploads/job_section/full/" . $all_data['image']))
                unlink("assets/uploads/job_section/full/" . $all_data['image']);

            if (file_exists("assets/uploads/job_section/small/" . $all_data['image']))
                unlink("assets/uploads/job_section/small/" . $all_data['image']);

            if (file_exists("assets/uploads/job_section/thumbnails/" . $all_data['image']))
                unlink("assets/uploads/job_section/thumbnails/" . $all_data['image']);
        }
        }
        echo "success";exit;
    }
    }
    
    function delete_job_image($id = false) {
        $data = array();
        $data['login'] = $this->session->all_userdata();
        $this->validateLogin();
        $table = 'job_section';
        $name = 'Image';
        if (!$id) {
            redirect('admin/' . $page);
        }

        $all_data = $this->comman_model->get_data_by_id($table, array('id' => $id));
        $result = $this->comman_model->update_data_by_id($table, array('image' => ''), 'id', $id);

        if ($result) {
            if (file_exists("assets/uploads/job_section/full/" . $all_data['image']))
                unlink("assets/uploads/job_section/full/" . $all_data['image']);

            if (file_exists("assets/uploads/job_section/small/" . $all_data['image']))
                unlink("assets/uploads/job_section/small/" . $all_data['image']);

            if (file_exists("assets/uploads/job_section/thumbnails/" . $all_data['image']))
                unlink("assets/uploads/job_section/thumbnails/" . $all_data['image']);
        }

        $this->session->set_flashdata('success', sprintf(lang('%s has successfully deleted.'), $name));
        redirect('admin/career/edit_job_section/' . $id);
    }

    function delete_question($page = false, $id = false) {
        $this->validateLogin();
        if (!$page) {
            redirect('admin/');
        }
        if (!$id) {
            redirect('admin/career/question' . $page);
        }
        $data = array();
        $data['login'] = $this->session->all_userdata();
        $result = $this->comman_model->delete_by_id('question', array('id' => $id));
        $this->session->set_flashdata('success', lang('Question has successfully deleted.'));
        redirect('admin/career/question/' . $page);
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
        $this->load->view('admin/career/job_list', $data);
        $this->load->view('admin/footer', $data);
    }

    function clear_cache() {
        $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
        $this->output->set_header("Pragma: no-cache");
    }

    function update_status() {
        $this->validateLogin();
        $name = $this->input->post('table_name');
        $post_data = array('status' => $this->input->post('status'));
        $id = $this->input->post('id');
        $result = $this->comman_model->update_data_by_id($name, $post_data, 'id', $id);
    }

    function deleteAll() {
        $data = array();
        $data['login'] = $this->session->all_userdata();
        $this->validateLogin();

        $block_ids = $this->input->post('block_ids');
        $table = $this->input->post('table');



        $have_image = $this->input->post('have_image');

        if ($have_image == true) {            
            $path = $this->input->post('imagepath');
            $fields = array('image');
            $all_datas = $this->comman_model->getAllById($table, $block_ids, $fields);
            if ($all_datas) {
                foreach ($all_datas as $all_data) {
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
        if ($deleteuser === true) {

            /*             * ****** get all block email and delete all email from block list start by razib 4axiz ***** */
            $fields = array('email');
            $all_datas = $this->comman_model->getAllById($table, $block_ids, $fields);

            if ($all_datas) {
                $str_email_array = array();
                foreach ($all_datas as $all_data) {
                    $str_email_array[] = $all_data['email'];
                }
                $this->comman_model->deleteAllById('block_email_list', $str_email_array, 'str_email');
                $this->comman_model->deleteAllById('block_users', $str_email_array, 'email');
            }

            /*             * ****** get all block email and delete all email from block list end by razib 4axiz ***** */

            /*             * ****** delete all user from apply_form by razib 4axiz ***** */
        }
        $result = $this->comman_model->deleteAllById($table, $block_ids);

        echo "Successfully Delete";
        exit;
    }

}

/* End of file admin.php */
	/* Location: ./application/controllers/admin.php */
