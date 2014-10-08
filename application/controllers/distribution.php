<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Distribution extends CI_Controller {

    public function __construct() {

        parent::__construct();

        $this->load->database();
        $this->load->helper(array('url', 'form', 'date', 'av_helper', 'cart_helper', 'language'));

        $this->load->library(array('session', 'form_validation', "pagination"));
        $this->load->helper('assets');

        $this->load->model(array('user_model', 'search_model', 'serial_model', 'product_model', 'menu_model', 'comman_model', 'product_model', 'questions_model'));
        $this->load->model('country_model');
        $this->load->language(array('header', 'distribution', 'footer'));
    }

    function index($page = false, $arg1 = "", $arg2 = "", $arg3 = "", $arg4 = "", $arg5 = "") {


        $this->load->model("block_list_email");
        $data = array();
        $this->check_lang();

        $where_param = array();
        $where_param['id'] = 1;
        $select_param = "*";

        $data['distribution_message'] = $this->block_list_email->get_row("distribution_message", $select_param, $where_param);




        $data['country_data'] = $this->country_model->as_array()->get_many_by(array('status' => 1));

        $data['title'] = $this->lang->line('module_title');

        $data['active'] = "distribution";

        $data['menu_vehicle_categories'] = $this->comman_model->all_data('tbl_vehicle_categories');

        $data['menu_product_types'] = $this->comman_model->get_product_type_for_menu();

        $data['all_data'] = $this->comman_model->get_data_by_id('home_page', array('id' => 1));

        $data['page_data'] = $this->comman_model->get_all_data_by_id('content', array('status' => 1));

        $data['slider_data'] = $this->comman_model->get_all_data_by_id('slider', array('status' => 1));

        $data['country_data'] = $this->comman_model->get_all_data_by_id('country', array('status' => 1));

        $data['product_catagory'] = $this->product_model->getallvehiclecategory_data('tbl_vehicle_categories');

        $data['product_makers'] = $this->product_model->get_all_makers_by_type();

        $data['product_models'] = $this->comman_model->all_data('tbl_models');

        $data['product_types'] = $this->product_model->getall_producttype_data('tbl_product_types');

        $cart = $this->session->userdata('cart');

        $data['menus'] = $this->menu_model->get_all_menus();

        $data['cartcount'] = getcartcount($this->session->userdata('cart'));



        if ($page == 'do_upload') {

            $res = $this->do_upload();

            if ($res['hdn_license'] == "")
                $res['hdn_license'] = $this->input->post('hdn_license') != '' ? $this->input->post('hdn_license') : '';

            if ($res['result'] == 1)
                $res['show_distribution_preview_popup'] = true;

            else {

                $res['edit_distribution_popup'] = true;

                $res['show_distribution_popup'] = true;
            }

            $data['license_picture_path'] = $this->get_license_name(true, false, isset($res['upload_data']["file_name"]) ? $res['upload_data']["file_name"] : "");

            $data['license_picture_name'] = $this->get_license_name(false, true, isset($res['upload_data']["file_name"]) ? $res['upload_data']["file_name"] : "");
            if (isset($res['upload_data']["file_name"])) {
                $data2['file']['file_name'] = $res['upload_data']["file_name"];
                $data['preview'] = $this->load->view('distribution/filepreview', $data2, true);
            }

            $data = array_merge($data, $res);

            $this->load->view('temp/include/header', $data);

            $this->load->view('temp/home', $data);

            $this->load->view('distribution/distribution', $data);

            $this->load->view('temp/footer', $data);
            echo 'success';
            exit;
        } else if ($page == "do_verify_code") {

            $this->do_verify_code($arg1, $arg2);
        } else if ($page == "do_block") {

            $this->do_block($arg1, $arg2, $arg3, $arg4, $arg5);
        } else if ($page == "do_send_verification_email") {

            $res['license_picture_path'] = $this->get_license_name(true, false, "");

            $res['license_picture_name'] = $this->get_license_name(false, true, "");

            $res['int_verification_result'] = $this->do_send_verification_email($_POST['email'], $_POST['salutation'] . '. ' . $_POST['applicant'], $_POST['int_resend'], $_POST['hdn_country_name'], $_POST['telephone']);

            $res['show_verification_popup'] = true;

            $res['str_edit'] = "true";
            if ($res['int_verification_result'] < 1 || $res['int_verification_result'] > 4)
                $res['show_verification_block'] = true;
            else
                $res['show_verification_block'] = false;

            switch ($res['int_verification_result']) {

                case 1: $res['str_verification_message'] = ''; //$this->lang->line('module_first_verification');
                    $res['end'] = 'first';
                    break;

                case 2: $res['str_verification_message'] = $this->lang->line('module_second_verification');

                    break;

                case 3: $res['str_verification_message'] = $this->lang->line('module_third_verification');
                    break;

                case 4: $res['str_verification_message'] = $this->lang->line('module_fourth_verification');
                    break;

                case 5:
                    //$res['str_verification_error'] = $this->lang->line('module_block_3_resent');
                    //$res['str_verification_error'] = "Unfortunately, after we resent you 3 verification code you did not enter the right code yet.  Therefore, you will be welcome to use an alternative email or wait for 120 minutes to use the current email " . urldecode($arg1) . " within our website.";
                    $res['str_verification_error'] = $data['distribution_message'][0]->resent_msg;
                    $res['str_verification_error'] = preg_replace("/\bEMAILVAR\b/", urldecode($arg1), $res['str_verification_error']);
                    $res['end'] = 'end';
                    break;

//                case 5:
//                    $res['str_edit'] = "false";
//                    $res['str_verification_error'] = $this->lang->line('module_block_previous_attempt');
//                    //$res['str_verification_error'] = "Unfortunately, you did not perform the necessary action within the given lead-time.  Therefore, you will be welcome to use an alternative email or wait for 120 minutes to use the current email " . urldecode($arg1) . " within our website.";
//                    $res['end'] = 'end';
//                    break;

                case 6:

                    $where_param = array();
                    $where_param['str_email'] = urldecode($_POST['email']);
                    $select_param = array("dte_block", "str_email", "region");
                    $blocked_email = $this->block_list_email->get_row("block_email_list", $select_param, $where_param);
                    $int_block = strtotime($blocked_email[0]->dte_block);
                    $int_TR = 120 - intval(((time() - $int_block) / 60));
                    if ($int_TR < 0)
                        $int_TR = 0;

                    //$res['str_verification_error'] = $this->lang->line('module_block_still');
                    $res['str_verification_error'] = $data['distribution_message'][0]->blocked_email_msg;
                    $res['str_verification_error'] = preg_replace("/\bEMAILVAR\b/", urldecode($_POST['email']), $res['str_verification_error']);
                    $res['str_verification_error'] = preg_replace("/\SECTIONVAR\b/", $blocked_email[0]->region, $res['str_verification_error']);
                    $res['str_verification_error'] = preg_replace("/\TIMEVAR\b/", $int_TR, $res['str_verification_error']);
                    //$res['str_verification_error'] = "The email " . urldecode($_POST['email']) . " is blocked in the section " . $blocked_email[0]->region . ". Therefore, please use an alternative email or wait " . $int_TR . " minutes to use this email again within our website. Thank you";
                    $res['end'] = 'end';
                    break;

                default: $res['str_verification_error'] = $this->lang->line('module_system_problem');
                    $res['end'] = 'end';
                    break;
            }

            $data = array_merge($data, $res);
            $this->load->view('temp/include/header', $data);
            $this->load->view('temp/home', $data);
            $this->load->view('distribution/distribution', $data);
            $this->load->view('temp/footer', $data);
            echo json_encode($res);
            exit;
        } else if ($page == "do_send_email") {

            $this->do_send_email($arg1, $arg2);
//            $cart = $this->session->userdata('cart');
//            $data['menus'] = $this->menu_model->get_all_menus();
//            $data['cartcount'] = getcartcount($this->session->userdata('cart'));
//
//            $this->load->view('temp/include/header', $data);
//            $this->load->view('temp/home', $data);            
//            $this->load->view('temp/footer', $data);
        } else if ($page == "email_sent") {

            $this->email_sent($arg1);
        } else {



            if ($this->input->post('edit_distribution_popup'))
                $data['edit_distribution_popup'] = true;

            $data['show_distribution_popup'] = true;

            $data['license_picture_path'] = $this->get_license_name(true, false, "");

            $data['license_picture_name'] = $this->get_license_name(false, true, "");



            $this->load->view('temp/include/header', $data);

            $this->load->view('temp/home', $data);

            $this->load->view('distribution/distribution', $data);

            $this->load->view('temp/footer', $data);
        }
    }

    function license_form_upload() {
        //print_r($_FILES);
        //print_r($_FILES['file']['name']);
        //echo "fsdfsdfs";
        if (!empty($_FILES['license']['name'])) {

            $field_name = 'license';
            $config['upload_path'] = './assets/uploads/licenses/';
            $config['allowed_types'] = 'doc|docx|DOC|DOCX|pdf|jpg|JPG|png|gif|tif';
            $config['max_size'] = '1024';

            $this->load->library('upload', $config);
            if (!$this->upload->do_upload($field_name)) {
                echo $this->upload->display_errors();
            } else {
                $upload_data = $this->upload->data();
                $this->load->view("distribution/filepreview", array('file' => $upload_data));
            }
        }
    }

    private function validateLogin() {

        $logged_in = $this->session->userdata('logged_in');

        if ((isset($logged_in) || $logged_in == true)) {

            if ($logged_in != "admin") {

                redirect('/admin/login', 'refresh');
            }
        } else {

            redirect('/admin/login', 'refresh');
        }
    }

    private function get_license_name($bln_path, $bln_real, $file_name) {

        if (!$bln_path) {

            $str_Base_Path = "";

            $str_Base_Icons_Path = "";
        } else {

            $str_Base_Path = "assets/uploads/licenses/";

            $str_Base_Icons_Path = "assets/user/distribution/imgs/";
        }

        if ($file_name != "") {

            $str_Path = $str_Base_Path . $file_name;
        } else {

            if ($this->input->post('hdn_license') != "") {

                $str_Path = $str_Base_Path . $this->input->post('hdn_license');
            } else {

                if ($this->input->post('hdn_license_preview') != "") {

                    $str_Path = $str_Base_Path . $this->input->post('hdn_license_preview');
                } else {

                    $str_Path = $str_Base_Icons_Path . "no-license.png";
                }
            }
        }

        if (!$bln_real) {

            if ($bln_path) {

                if (strpos(strtolower($str_Path), '.doc') !== false)
                    $str_Path = site_url($str_Base_Icons_Path . 'doc.png');

                else if (strpos(strtolower($str_Path), '.pdf') !== false)
                    $str_Path = site_url($str_Base_Icons_Path . 'pdf.png');

                else if (strpos(strtolower($str_Path), '.png') !== false || strpos(strtolower($str_Path), '.jpg') !== false || strpos(strtolower($str_Path), '.bmp') !== false || strpos(strtolower($str_Path), '.gif') !== false || strpos(strtolower($str_Path), '.tif') !== false)
                    $str_Path = site_url($str_Path);
                else
                    $str_Path = site_url($str_Base_Icons_Path . 'unsupported.png');



                $str_Path = "src=\"" . $str_Path . "\"";
            }else {

                if (strpos(strtolower($str_Path), '.doc') !== false)
                    $str_Path = 'doc.png';

                else if (strpos(strtolower($str_Path), '.pdf') !== false)
                    $str_Path = 'pdf.png';

                else if (!(strpos(strtolower($str_Path), '.png') !== false || strpos(strtolower($str_Path), '.jpg') !== false || strpos(strtolower($str_Path), '.bmp') !== false || strpos(strtolower($str_Path), '.gif') !== false || strpos(strtolower($str_Path), '.tif') !== false))
                    $str_Path = 'unsupported.png';
            }
        }

        return $str_Path;
    }

    function do_upload() {

        if (!isset($data))
            $data = array();



        $this->check_lang();



        $data['title'] = $this->lang->line('module_title');

        $data['active'] = "distribution";

        $data['menu_vehicle_categories'] = $this->comman_model->all_data('tbl_vehicle_categories');

        $data['menu_product_types'] = $this->comman_model->get_product_type_for_menu();

        $data['all_data'] = $this->comman_model->get_data_by_id('home_page', array('id' => 1));

        $data['page_data'] = $this->comman_model->get_all_data_by_id('content', array('status' => 1));

        $data['slider_data'] = $this->comman_model->get_all_data_by_id('slider', array('status' => 1));

        $data['country_data'] = $this->comman_model->get_all_data_by_id('country', array('status' => 1));

        $data['product_catagory'] = $this->product_model->getallvehiclecategory_data('tbl_vehicle_categories');

        $data['product_makers'] = $this->product_model->get_all_makers_by_type();

        $data['product_models'] = $this->comman_model->all_data('tbl_models');

        $data['product_types'] = $this->product_model->getall_producttype_data('tbl_product_types');

        $cart = $this->session->userdata('cart');

        $res['menus'] = $this->menu_model->get_all_menus();

        $res['cartcount'] = getcartcount($this->session->userdata('cart'));



        $data['hdn_license'] = "";

        $bln_Continue = true;

        if (isset($_FILES['license']['name']) && $_FILES['license']['name'] != '') {

            $config['upload_path'] = './assets/uploads/licenses/';

            $config['allowed_types'] = 'gif|jpg|png|bmp|tif|doc|docx|pdf';

            $config['max_size'] = '1024';

            $config['max_width'] = '0';

            $config['max_height'] = '0';

            $config['remove_spaces'] = true;

            $config['encrypt_name'] = false;

            $config['max_filename'] = '0';

            $config['overwrite'] = true;



            $this->load->library('upload', $config);

            if (!$this->upload->do_upload("license")) {

                $bln_Continue = false;

                $data['upload_error'] = $this->upload->display_errors("<span style='color:#ff0000;'>", "</span>");
            } else {

                $data['upload_data'] = $this->upload->data();

                $data['hdn_license'] = $data['upload_data']['file_name'];
            }
        }

        if ($bln_Continue)
            $data['result'] = 1;
        else
            $data['result'] = 0;



        $data['menus'] = $this->menu_model->get_all_menus();

        $data['cartcount'] = getcartcount($this->session->userdata('cart'));



        return $data;
    }

    function do_block($str_email, $int_case = 1, $str_applicant = "", $str_country = "", $str_telephone = "") {

        $this->load->model("block_list_email");

        $where_param = array();
        $where_param['id'] = 1;
        $select_param = array("timeout_msg");
        $distribution_message = $this->block_list_email->get_row("distribution_message", $select_param, $where_param);


        if ($int_case == 6)
            $int_case = 5;
        $this->check_lang();



        $data = array();

        $data['title'] = $this->lang->line('module_title');

        $data['active'] = "distribution";

        $data['menu_vehicle_categories'] = $this->comman_model->all_data('tbl_vehicle_categories');

        $data['menu_product_types'] = $this->comman_model->get_product_type_for_menu();

        $data['all_data'] = $this->comman_model->get_data_by_id('home_page', array('id' => 1));

        $data['page_data'] = $this->comman_model->get_all_data_by_id('content', array('status' => 1));

        $data['slider_data'] = $this->comman_model->get_all_data_by_id('slider', array('status' => 1));

        $data['country_data'] = $this->comman_model->get_all_data_by_id('country', array('status' => 1));

        $data['product_catagory'] = $this->product_model->getallvehiclecategory_data('tbl_vehicle_categories');

        $data['product_makers'] = $this->product_model->get_all_makers_by_type();

        $data['product_models'] = $this->comman_model->all_data('tbl_models');

        $data['product_types'] = $this->product_model->getall_producttype_data('tbl_product_types');

        $cart = $this->session->userdata('cart');

        $res['menus'] = $this->menu_model->get_all_menus();

        $res['cartcount'] = getcartcount($this->session->userdata('cart'));



        $int_Result = 0;

        $str_email = urldecode($str_email);

        $str_applicant = urldecode($str_applicant);

        $str_country = urldecode($str_country);

        $str_telephone = urldecode($str_telephone);

        $dte_block = date("Y-m-d H:i:s", time());

        $db_res = $this->db->query("SELECT * FROM tbl_dist_app_support WHERE str_email = ? LIMIT 1", array(strtolower($str_email)));

        if ($db_res->num_rows() > 0) {

            $row = $db_res->row();

            $data = array('dte_block' => $dte_block, 'int_block' => $int_case);

            $where = "int_id = " . $row->int_id . " AND str_email = '" . $row->str_email . "'";

            $this->db->query($this->db->update_string('tbl_dist_app_support', $data, $where));

            //this block is edited by 4axiz to execute operation in block_email_list table 

            $where_param = array();
            //$where_param['int_id'] = $row->int_id;
            $where_param['str_email'] = $row->str_email;
            $this->block_list_email->update_column("block_email_list", $where_param, $data);


            //block end

            $int_Result = 1;
        } else {

            $data = array('int_errors' => 0, 'int_sents' => 0, 'dte_block' => $dte_block, 'int_block' => $int_case, 'str_code' => '', 'str_email' => $str_email, 'str_applicant' => $str_applicant, 'str_country' => $str_country, 'str_ip_address' => $_SERVER['REMOTE_ADDR'], 'str_telephone' => $str_telephone);

            $this->db->query($this->db->insert_string('tbl_dist_app_support', $data));

            //this block is edited by 4axiz to execute operation in block_email_list table 
            $data['region'] = "Distribution";

            $this->block_list_email->insert_column("block_email_list", $data);


            //block end

            $int_Result = 1;
        }

        $db_res->free_result();

        $this->db->close();

        $timeout_msg = $distribution_message[0]->timeout_msg;
        $timeout_msg = preg_replace("/\bEMAILVAR\b/", $str_email, $timeout_msg);
        //echo 'Unfortunately, you did not take necessary action within the given lead-time. Therefore, you will be welcome to use an alternative email or wait for 120 minutes to use the current email ' . $str_email . ' within our website.';
        echo $timeout_msg;
    }

    function do_verify_code($str_email, $str_code) {

        $this->check_lang();

        $this->load->model("block_list_email");

        $data = array();

        $data['title'] = $this->lang->line('module_title');

        $data['active'] = "distribution";

        $data['menu_vehicle_categories'] = $this->comman_model->all_data('tbl_vehicle_categories');

        $data['menu_product_types'] = $this->comman_model->get_product_type_for_menu();

        $data['all_data'] = $this->comman_model->get_data_by_id('home_page', array('id' => 1));

        $data['page_data'] = $this->comman_model->get_all_data_by_id('content', array('status' => 1));

        $data['slider_data'] = $this->comman_model->get_all_data_by_id('slider', array('status' => 1));

        $data['country_data'] = $this->comman_model->get_all_data_by_id('country', array('status' => 1));

        $data['product_catagory'] = $this->product_model->getallvehiclecategory_data('tbl_vehicle_categories');

        $data['product_makers'] = $this->product_model->get_all_makers_by_type();

        $data['product_models'] = $this->comman_model->all_data('tbl_models');

        $data['product_types'] = $this->product_model->getall_producttype_data('tbl_product_types');

        $cart = $this->session->userdata('cart');

        $res['menus'] = $this->menu_model->get_all_menus();

        $res['cartcount'] = getcartcount($this->session->userdata('cart'));



        $int_Result = 0;

        $str_email = urldecode($str_email);

        $db_res = $this->db->query("SELECT * FROM tbl_dist_app_support WHERE str_email = ? LIMIT 1", array(strtolower($str_email)));

        if ($db_res->num_rows() > 0) {

            $row = $db_res->row();

            if ($row->dte_block == NULL && $row->int_errors < 3) {

                if ($str_code == $row->str_code) {

                    $where = "int_id = " . $row->int_id . " AND str_email = '" . $row->str_email . "'";

                    /* edited by 4axiz to execute operation on block_email_list table */



                    $where_array = array();
                    //$where_array['int_id'] = $row->int_id;
                    $where_array['str_email'] = $row->str_email;

                    $this->block_list_email->delete_row("block_email_list", $where_array);


                    /*  end region */

                    $this->db->delete('tbl_dist_app_support', $where);
                } else {

                    $row->int_errors++;

                    if ($row->int_errors == 3) {

                        $int_block = 2;

                        $dte_block = date("Y-m-d H:i:s", time());
                    } else {

                        $int_block = 0;

                        $dte_block = NULL;
                    }

                    $data = array('dte_block' => $dte_block, 'int_block' => $int_block, 'int_errors' => $row->int_errors);

                    $where = "int_id = " . $row->int_id . " AND str_email = '" . $row->str_email . "'";

                    $this->db->query($this->db->update_string('tbl_dist_app_support', $data, $where));

                    /* edited by 4axiz to execute operation on block_email_list table */

                    $where_param = array();
                    //$where_param['int_id'] = $row->int_id;
                    $where_param['str_email'] = $row->str_email;

                    $this->block_list_email->update_column("block_email_list", $where_param, $data);

                    /* region end */

                    $int_Result = $row->int_errors;
                }
            } else {

                $int_Result = 4;
            }
        } else {

            $int_Result = 5;
        }

        $db_res->free_result();

        $this->db->close();

        echo $int_Result;
    }

    function do_send_verification_email($str_email, $str_applicant, $int_resend, $str_country, $str_telephone) {

        $this->check_lang();

        $this->load->model("block_list_email");

        $config = $this->config->item('emailconfig');
        if (!empty($config))
            $this->load->library('email', $config);
        else
            $this->load->library('email');
        $this->email->set_newline("\r\n");

        $data = array();

        $data['title'] = $this->lang->line('module_title');

        $data['active'] = "distribution";

        $int_Result = 0;

        $str_email = urldecode($str_email);

        $str_applicant = urldecode($str_applicant);

        $str_country = urldecode($str_country);

        $str_telephone = urldecode($str_telephone);

        $int_resend = intval($int_resend);

        $word = "a,b,c,d,e,f,g,h,i,j,k,l,m,1,2,3,4,5,6,7,8,9,0";
        $array = explode(",", $word);
        shuffle($array);
        $newstring = implode($array, "");
        $str_code = substr($newstring, 0, 10);



        //$str_code = md5($str_email . date("Y-m-d H:i:s", time()));

        $bln_Blocked = false;

        $db_res = $this->db->query("SELECT * FROM tbl_dist_app_support WHERE str_email = ? LIMIT 1", array(strtolower($str_email)));

        $where_param = array();
        $where_param['str_email'] = $str_email;
        $select_param = array("dte_block", "str_email", "region");
        $blocked_email = $this->block_list_email->get_row("block_email_list", $select_param, $where_param);

        $date = date("Y-m-d H:i:s", time());
        $datelimit = strtotime('-120 minute', strtotime($date));
        $datelimit = date("Y-m-d H:i:s", $datelimit);

        if (!empty($blocked_email) && $blocked_email[0]->dte_block != NULL && $datelimit < $blocked_email[0]->dte_block) {
            $bln_Blocked = true;

            $int_Result = 6;
        } else {

            if ($db_res->num_rows() > 0) {

                $row = $db_res->row();

                if ($row->dte_block == NULL) {

                    if ($int_resend == 1) {

                        if ($row->int_sents < 4) { //resends left
                            $data = array('str_code' => $str_code, 'int_sents' => ( ++$row->int_sents));

                            $where = "int_id = " . $row->int_id . " AND str_email = '" . $row->str_email . "'";

                            $this->db->query($this->db->update_string('tbl_dist_app_support', $data, $where));


                            //edited by 4axiz to execute the block_email_list table

                            $where_param = array();
                            //$where_param['int_id'] = $row->int_id;
                            $where_param['str_email'] = $row->str_email;
                            $this->block_list_email->update_column("block_email_list", $where_param, $data);

                            //end the block

                            $int_Result = $row->int_sents;

                            if ($int_Result == 2)
                                $str_Subject = $this->lang->line('module_verification_email_subject_second');
                            else if ($int_Result == 3)
                                $str_Subject = $this->lang->line('module_verification_email_subject_third');
                            else
                                $str_Subject = $this->lang->line('module_verification_email_subject_fourth');
                        }else { //3 limit exceded
                            $data = array('dte_block' => date("Y-m-d H:i:s", time()), 'int_block' => 3, 'int_sents' => ($row->int_sents));

                            $where = "int_id = " . $row->int_id . " AND str_email = '" . $row->str_email . "'";

                            $this->db->query($this->db->update_string('tbl_dist_app_support', $data, $where));

                            //edited by 4axiz to execute the block_email_list table

                            $where_param = array();
                            //$where_param['int_id'] = $row->int_id;
                            $where_param['str_email'] = $row->str_email;
                            $this->block_list_email->update_column("block_email_list", $where_param, $data);

                            //end the block

                            $bln_Blocked = true;

                            $int_Result = 5;
                        }
                    } else { //a previous application not finished
                        $data = array('dte_block' => date("Y-m-d H:i:s", time()), 'int_block' => 4, 'int_sents' => ($row->int_sents + 1));

                        $where = "int_id = " . $row->int_id . " AND str_email = '" . $row->str_email . "'";

                        $this->db->query($this->db->update_string('tbl_dist_app_support', $data, $where));

                        //edited by 4axiz to execute the block_email_list table

                        $where_param = array();
                        //$where_param['int_id'] = $row->int_id;
                        $where_param['str_email'] = $row->str_email;
                        $this->block_list_email->update_column("block_email_list", $where_param, $data);

                        //end the block

                        $bln_Blocked = true;

                        $int_Result = 6;
                    }
                } else {

                    $date = date("Y-m-d H:i:s", time());

                    $datelimit = strtotime('-120 minute', strtotime($date));

                    $datelimit = date("Y-m-d H:i:s", $datelimit);

                    if ($datelimit > $row->dte_block) { //block time expired; remove the block and recall send verification email
                        $where = "int_id = " . $row->int_id . " AND str_email = '" . $row->str_email . "'";

                        $this->db->delete('tbl_dist_app_support', $where);

                        //edited by 4axiz to execute the block_email_list table

                        $where_param = array();
                        //$where_param['int_id'] = $row->int_id;
                        $where_param['str_email'] = $row->str_email;
                        $this->block_list_email->delete_row("block_email_list", $where_param);

                        //end the block

                        echo $this->do_send_verification_email(urlencode($str_email), urlencode($str_applicant), $int_resend, urlencode($str_country), urlencode($str_telephone));

                        exit;
                    } else { //still blocked
                        $bln_Blocked = true;

                        $int_Result = 6;
                    }
                }
            } else { //send first time
                $data = array('int_errors' => 0, 'int_sents' => 1, 'dte_block' => NULL, 'int_block' => 0, 'str_code' => $str_code, 'str_email' => $str_email, 'str_applicant' => $str_applicant, 'str_country' => $str_country, 'str_ip_address' => $_SERVER['REMOTE_ADDR'], 'str_telephone' => $str_telephone);

                $this->db->query($this->db->insert_string('tbl_dist_app_support', $data));

                //edited by 4axiz to execute the block_email_list table
                $data['region'] = "Distribution";
                $this->block_list_email->insert_column("block_email_list", $data);

                //end the block


                $int_Result = 1;

                $str_Subject = $this->lang->line('module_verification_email_subject_first');
            }

            $db_res->free_result();

            $this->db->close();

            if (!$bln_Blocked) {

                $str_Email_Body = $this->load->view('distribution/verification_email', $data, true);
                $str_To_Email = $str_email;
                //$str_From_Email = "riadh@kondarglobal.ca";
                $str_From_Email = "sales@kondar.ca";
                $str_From_Name = $this->lang->line('module_verification_email_from_name');

                $str_Email_Body = str_replace('{Tag.str_Title}', $this->lang->line('verification_email_title'), $str_Email_Body);
                $str_Email_Body = str_replace('{Tag.str_Base_URL}', base_url(), $str_Email_Body);
                $str_Email_Body = str_replace('{Tag.str_Presentation}', $this->lang->line('verification_email_dear'), $str_Email_Body);
                $str_Email_Body = str_replace('{Tag.str_Applicant}', urldecode($str_applicant), $str_Email_Body);
                $str_Email_Body = str_replace('{Tag.str_Text_1}', $this->lang->line('verification_email_text_1'), $str_Email_Body);
                $str_Email_Body = str_replace('{Tag.str_Code}', $str_code, $str_Email_Body);
                $str_Email_Body = str_replace('{Tag.str_Text_2}', ' ', $str_Email_Body);
                $str_Email_Body = str_replace('{Tag.str_Regards_1}', $this->lang->line('verification_email_regards_1'), $str_Email_Body);
                $str_Email_Body = str_replace('{Tag.str_Regards_2}', $this->lang->line('verification_email_regards_2'), $str_Email_Body);

                $this->email->from($str_From_Email, $str_From_Name);
                $this->email->to($str_To_Email);
                $this->email->set_header("To", $str_applicant . '<' . $str_To_Email . '>');
                $this->email->subject($str_Subject);
                $this->email->message($str_Email_Body);
                $this->email->send();
            }
        }

        return $int_Result;
    }

    function do_send_email() {

        if (!isset($data))
            $data = array();



        $this->check_lang();



        $data = array();

        $data['title'] = $this->lang->line('module_title');

        $data['active'] = "distribution";

        $data['menu_vehicle_categories'] = $this->comman_model->all_data('tbl_vehicle_categories');

        $data['menu_product_types'] = $this->comman_model->get_product_type_for_menu();

        $data['all_data'] = $this->comman_model->get_data_by_id('home_page', array('id' => 1));

        $data['page_data'] = $this->comman_model->get_all_data_by_id('content', array('status' => 1));

        $data['slider_data'] = $this->comman_model->get_all_data_by_id('slider', array('status' => 1));

        $data['country_data'] = $this->comman_model->get_all_data_by_id('country', array('status' => 1));

        $data['product_catagory'] = $this->product_model->getallvehiclecategory_data('tbl_vehicle_categories');

        $data['product_makers'] = $this->product_model->get_all_makers_by_type();

        $data['product_models'] = $this->comman_model->all_data('tbl_models');

        $data['product_types'] = $this->product_model->getall_producttype_data('tbl_product_types');

        $cart = $this->session->userdata('cart');

        $res['menus'] = $this->menu_model->get_all_menus();

        $res['cartcount'] = getcartcount($this->session->userdata('cart'));



        $bln_Continue = true;

        //$str_Subject = this->lang->line('module_application_email_subject');
        $str_Subject = 'Distribution application acknowledgement receipt';

        $str_To_Email = $this->input->post('email');

        $str_To_name = $this->input->post('salutation') . '. ' . $this->input->post('applicant');
        //$str_Admin_Email = "riadh@kondarglobal.ca";
        $str_Admin_Email = "sales@kondar.ca";

        $str_From_Name = $this->lang->line('module_application_email_from_name');

        $str_File = "tmp-" . time();

        $str_Directory = "./assets/uploads/licenses";

        $res['license_picture_name'] = $this->get_license_name(false, true, "");

        $str_Original_Components = explode(".", $res['license_picture_name']);


        //edited by to excute the operation for the block_email_list table
        $this->load->model("block_list_email");
        $where_param = array();
        $where_param['countryName'] = $this->input->post('hdn_country_name');
        $select_param = array("alpha_2");
        $block_email = $this->block_list_email->get_row("countries", $select_param, $where_param);
        $flag_name = $block_email[0]->alpha_2;
        //region end

        $data['flag_name'] = $flag_name;
        $data['str_New_Path'] = $str_File . "." . strtolower($str_Original_Components[1]);
        $data['dear'] = $str_To_name;
        $data['title'] = 'Distribution Application Acknowledgement Receipt ';
        $data['regards'] = $this->lang->line('distribution_email_regards_2');
        $data['content'] = 'Thank you for showing interest to be KGT partner in your area. We hereby acknowledge receipt of your valuable request and we should review and contact you at the earliest to take practical steps ahead.';
        $str_Email_Body = $this->load->view('distribution/distribution_email', $data, true);

        $str_Extra_Header = "MIME-Version: 1.0\nContent-type: text/html; charset=iso-8859-1";

        $str_Attachment_Start_Message = "";

        $str_Attachment_End_Message = "";

        if (file_exists($str_Directory . "/" . $this->input->post('hdn_license_preview'))) {

            $str_New_Path = $str_Directory . "/" . $str_File . "." . strtolower($str_Original_Components[1]);

            if (file_exists($str_New_Path))
                @unlink($str_New_Path);

            //   if (@rename($str_Directory . "/" . $this->input->post('hdn_license_preview'), $str_New_Path)) {

            $fle_Pntr = fopen($str_New_Path, 'rb');

            $fle_Content = fread($fle_Pntr, filesize($str_New_Path));

            fclose($fle_Pntr);

            $fle_Content = chunk_split(base64_encode($fle_Content));

            $semi_rand = md5(time());

            $mime_boundary = "Multipart_Boundary_x" . $semi_rand . "_x";

            $str_Extra_Header = "MIME-Version: 1.0\nContent-Type: multipart/mixed;\n boundary=\"{" . $mime_boundary . "}\"";

            $str_Attachment_Start_Message = "This is a multi-part message in MIME format.\n\n--{" . $mime_boundary . "}\nContent-Type: text/html; charset=\"iso-8859-1\"\nContent-Transfer-Encoding: 7bit\n";

            $str_Attachment_End_Message = "--{" . $mime_boundary . "}\nContent-Type: {" . strtolower($str_Original_Components[1]) . "};\n name=\"{" . $str_File . "." . strtolower($str_Original_Components[1]) . "}\"\nContent-Disposition: attachment;\n filename=\"" . $str_File . "." . strtolower($str_Original_Components[1]) . "\"\nContent-Transfer-Encoding: base64\n\n" . $fle_Content . "\n\n--{" . $mime_boundary . "}--\n";



            /*

              $config = $this->config->item('emailconfig');

              if(!empty($config))

              $this->load->library('email', $config);

              else */
            $aa = $str_Directory . "/" . $this->input->post('filename');
            $this->load->library('email');

            $config['mailtype'] = 'html';

            $this->email->initialize($config);



            $this->email->from($str_Admin_Email, $str_From_Name);

            $this->email->to($str_To_Email);
            $this->email->set_header("To", $str_To_name . '<' . $str_To_Email . '>');

            $this->email->reply_to($str_Admin_Email);

            $this->email->subject($str_Subject);

            $this->email->message($str_Email_Body);
            $this->email->attach($aa);
            //   $this->email->attach(realpath(__DIR__ . '/../../assets/uploads/licenses/' . $this->input->post('hdn_license_preview')));
            if ($this->email->send()) {

                $insert_string = array();

                //print_r($_POST[]);
                //$insert_string  = $_POST;
                $insert_string['license'] = $_POST['filename'];
                $insert_string['create_date'] = date("Y-m-d");
                $insert_string['salutation'] = $_POST['salutation'];
                $insert_string['country'] = $_POST['hdn_country_name'];
                $insert_string['applicant'] = $_POST['applicant'];
                $insert_string['company'] = $_POST['company'];
                $insert_string['address'] = $_POST['address'];
                $insert_string['designation'] = $_POST['designation'];
                $insert_string['telephone'] = $_POST['telephone'] ? $_POST['telephone'] : 'no';
                $insert_string['email'] = $_POST['email'];
                $insert_string['companysize'] = $_POST['companysize'];
                $insert_string['companystart'] = $_POST['companystart'];
                $insert_string['sel_indoor_sales'] = $_POST['sel_indoor_sales'];
                $insert_string['sel_outdoor_sales'] = $_POST['sel_outdoor_sales'];
                $insert_string['salesbrief'] = $_POST['salesbrief'];


                $this->db->query($this->db->insert_string('distribution_form', $insert_string));

                $data['dear'] = 'Sales Manager';
                $data['regards'] = $str_To_name;
                $data['title'] = 'New Distribution Application Form';
                $data['content'] = 'We are interested to represent KGT in our area. Please review our application form and contact us to start practical steps at the earliest possible.';
                $str_Email_Body = $this->load->view('distribution/distribution_email', $data, true);


                $this->email->clear(TRUE);

                $this->email->from($str_To_Email, $str_To_name);

                $this->email->reply_to($str_To_Email);

                $this->email->subject('New Distribution application form');

                $this->email->message($str_Email_Body);

                $this->email->attach($aa);

                $this->email->to($str_Admin_Email);
                //$this->email->to($str_To_Email);
                $this->email->set_header("To", 'KGT Sales Department <' . $str_Admin_Email . '>');
                $this->email->send();

                $this->email_sent(1);
               
            } else {

                $this->email_sent(0);
               
            }
            //} else
            //$this->email_sent(2);
        } else
            $this->email_sent(2);
        if (isset($_POST['send_mail'])) {
            echo 'sendmail';
        } else {
            return $res;
        }
    }

    function email_sent($case) {

        $this->check_lang();



        $data = array();

        $data['title'] = $this->lang->line('module_title');

        $data['active'] = "distribution";

        $data['menu_vehicle_categories'] = $this->comman_model->all_data('tbl_vehicle_categories');

        $data['menu_product_types'] = $this->comman_model->get_product_type_for_menu();

        $data['all_data'] = $this->comman_model->get_data_by_id('home_page', array('id' => 1));

        $data['page_data'] = $this->comman_model->get_all_data_by_id('content', array('status' => 1));

        $data['slider_data'] = $this->comman_model->get_all_data_by_id('slider', array('status' => 1));

        $data['country_data'] = $this->comman_model->get_all_data_by_id('country', array('status' => 1));

        $data['product_catagory'] = $this->product_model->getallvehiclecategory_data('tbl_vehicle_categories');

        $data['product_makers'] = $this->product_model->get_all_makers_by_type();

        $data['product_models'] = $this->comman_model->all_data('tbl_models');

        $data['product_types'] = $this->product_model->getall_producttype_data('tbl_product_types');

        $cart = $this->session->userdata('cart');

        $res['menus'] = $this->menu_model->get_all_menus();

        $res['cartcount'] = getcartcount($this->session->userdata('cart'));



        $data = array();

        $data['email_success'] = false;

        $data['license_picture_path'] = $this->get_license_name(true, false, "");

        $data['license_picture_name'] = $this->get_license_name(false, true, "");

        switch (intval($case)) {

            case 0: $data['email_error'] = $this->lang->line('module_application_email_server_problem');

                break;

            case 1:
                $where_param = array();
                $where_param['id'] = 1;
                $select_param = array("application_receipt_msg");

                $distribution_msg = $this->block_list_email->get_row("distribution_message", $select_param, $where_param);
                //$data['email_message'] = $this->lang->line('module_application_email_sent');
                $data['email_message'] = $distribution_msg[0]->application_receipt_msg;

                $data['email_success'] = true;

                break;

            case 2: $data['email_error'] = $this->lang->line('module_application_email_attachment_problem');

                break;

            default:

                $data['email_error'] = $this->lang->line('module_application_email_server_unknow_problem');
        }
       
        
        $this->load->view('temp/include/header', $data);

        $this->load->view('temp/home', $data);

        $this->load->view('distribution/distribution', $data);

        $this->load->view('temp/footer', $data);
    }

    function check_indoor_default($post_string) {

        return $post_string == '0' ? FALSE : TRUE;
    }

    function check_outdoor_default($post_string) {

        return $post_string == '0' ? FALSE : TRUE;
    }

    /* ######################################################################################  */

    function check_lang() {

        $lang = $this->session->all_userdata();

        if (isset($lang['lang'])) {
            if ($lang['lang'] == 'english') {
                $this->lang->load("common", "english");
                $this->lang->load("user", "english");
                $this->lang->load("distribution", "english");
            } else if ($lang['lang'] == 'russian') {
                $this->lang->load("common", "russian");
                $this->lang->load("user", "russian");
                $this->lang->load("distribution", "russian");
            } else if ($lang['lang'] == 'french') {
                $this->lang->load("common", "french");
                $this->lang->load("user", "french");
                $this->lang->load("distribution", "french");
            }
        } else {

            $this->lang->load("common", "english");

            $this->lang->load("user", "english");

            $this->lang->load("distribution", "english");
        }
    }

    function get_timer() {
        $value = $this->input->post('value');
        if ($value == 'edit') {
            $select = "distribution_edit_timer,distribution_edit_msg";
        } elseif ($value == 'main') {
            $select = "main_distribution_timer,main_distribution_msg";
        } elseif ($value == 'preview') {
            $select = "distribution_preview_timer,distribution_preview_msg";
        } else {
            $select = "distribution_popup_timer,distribution_popup_msg";
        }
        $time = $this->comman_model->get_timer('distribution_timer', $select);
        echo json_encode($time);
    }

}

/* End of file admin.php */

    /* Location: ./application/controllers/admin.php */    
