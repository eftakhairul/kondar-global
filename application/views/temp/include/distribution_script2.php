<!--added for distribution by jluna-->
<script src="assets/master/js/flipclock.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="assets/master/css/flipclock.css" />
<link rel="stylesheet" type="text/css" href="<?php echo site_url('assets/user/distribution/css/distribution.css'); ?>" />
<script type="text/javascript" src="assets/user/distribution/js/fncs_Validation.js"></script>
<script type="text/javascript" src="assets/user/distribution/js/fncs_distribution_application.js"></script>
<script type="text/javascript">
  
    function blink(n) {
        var blinks = document.getElementsByTagName("blink");
        var visibility = n % 2 === 0 ? "visible" : "hidden";
        for (var i = 0; i < blinks.length; i++) {
            blinks[i].style.visibility = visibility;
        }
        setTimeout(function() {
            blink(n + 1);
        }, 500);
    }
    $(document).ready(function(){
        $('div#lightbox').hide();
        blink(1);
    });
</script>  
<script type="text/javascript">
    var str_Block_No_Response;
    var str_Block_No_Finished;
    var str_Wrong_Code_1;
    var str_Wrong_Code_2;
    var str_Block_Wrong_Code;
    var str_Block_Previous_Attempt;
    var str_System_Problem;
    var str_Base_URL;
    var bln_dd_clicked;
    var clock;
    var clock1;
    var clock2;
    var clock3;

    $(document).ready(function() {
       
        str_Block_No_Response = '<?php echo $this->lang->line('js_block_no_response'); ?>';
        str_Block_No_Finished = '<?php echo $this->lang->line('js_block_no_finished'); ?>';
        str_Wrong_Code_1 = '<?php echo $this->lang->line('js_wrong_code_1'); ?>';
        str_Wrong_Code_2 = '<?php echo $this->lang->line('js_wrong_code_2'); ?>';
        str_Block_Wrong_Code = '<?php echo $this->lang->line('js_block_wrong_code'); ?>';
        str_Block_Previous_Attempt = '<?php echo $this->lang->line('js_block_previous_attempt'); ?>';
        str_System_Problem = '<?php echo $this->lang->line('js_system_problem'); ?>';
        str_Base_URL = '<?php echo site_url(''); ?>';
        bln_dd_clicked = false;

        var str_email = getCookie('email');
<?php if ((isset($show_distribution_popup) && $show_distribution_popup) || (isset($show_distribution_preview_popup) && $show_distribution_preview_popup) || (isset($email_success)) || (isset($show_verification_popup) && $show_verification_popup)) { ?>
            $bln_block_email_by_cookie = false;
            $("#country").msDropdown({roundedBorder:false});
            fn_Prepare_List('sel_id_indoor_sales', 100);
            fn_Select_From_List('sel_id_indoor_sales', <?php echo (isset($_POST['sel_indoor_sales']) && $_POST['sel_indoor_sales'] > 0) ? $_POST['sel_indoor_sales'] : -1; ?>);
            fn_Prepare_List('sel_id_outdoor_sales', 1000);
            fn_Select_From_List('sel_id_outdoor_sales', <?php echo (isset($_POST['sel_outdoor_sales']) && $_POST['sel_outdoor_sales'] > 0) ? $_POST['sel_outdoor_sales'] : -1; ?>);
            fn_Select_From_List('country', '<?php echo (isset($_POST['country']) && $_POST['country'] != '') ? $_POST['country'] : -1; ?>');
            var obj_countDown;
                                              
    <?php if (isset($email_success)) { ?>
                    fn_Delete_Cookies('*');
                    $('#modal_success').modal({backdrop: 'static', show: true});
                                                   
                                                        
                                                                   
    <?php } ?>
                                              
    <?php
    if (isset($show_distribution_popup) && $show_distribution_popup) {
        $str_Edit = "false";
        ?>
                        $('#modal_dist_popup').modal({backdrop: 'static', show: true});
                        //                  $("#license").change(function(){
                        //                      readURL(this);
                        //                  });
        <?php if (!(isset($edit_distribution_popup) && $edit_distribution_popup)) { ?>
                            if(str_email == ""){
                                fn_Handle_Form_Startup(false);
                            }else{
                                fn_Send_Block(str_email, getCookie('applicant'), getCookie('country'), getCookie('telephone'), 4);
                                fn_Delete_Cookies('*');
                                $('#block_box').modal({backdrop: 'static', show: true});
                            }
        <?php } else { ?>
                            fn_Handle_Form_Startup(true);
                            runCountDownClck("timer1", 600);
        <?php } ?>
    <?php } ?>
                                              
    <?php
    if (isset($show_distribution_preview_popup) && $show_distribution_preview_popup) {
        $str_Edit = "true";
        ?>
                        var str_preview = getCookie('preview');
                        if(str_preview == "1"){
                            fn_Delete_Cookies('preview');
                            $('#modal_dist_preview_popup').modal({backdrop: 'static', show: true});
                            runCountDownClck("timer2", 86400);
                        }else{
                            fn_Send_Block(str_email, getCookie('applicant'), getCookie('country'), getCookie('telephone'), 4);
                            fn_Delete_Cookies('*');
                            $('#block_box').modal({backdrop: 'static', show: true});
                        }
    <?php } ?>

    <?php if (isset($show_verification_popup) && $show_verification_popup) { ?>
                    var str_verification = getCookie('verification');
                    if(str_verification == "1"){
                        $('#code_verification').modal({backdrop: 'static', show: true});
        <?php echo isset($str_verification_message) ? "$('#div_id_verification_message').html(\"" . $str_verification_message . "\");" : ""; ?>
        <?php echo isset($str_verification_error) ? "$('#code_verification1 .div_id_verification_warning').html('<blink>Warning</blink>');$('#code_verification1 .div_id_verification_error').html(\"" . $str_verification_error . "\");$('#code_verification').modal('hide');$('#code_verification1').modal('show');" : ""; ?>
        <?php if (isset($show_verification_block) && $show_verification_block) { ?>
                                $('#div_id_verification_panel').hide();
                                $('.div_id_verification_block').show();
                                fn_Delete_Cookies('*');
        <?php } else { ?>
                                $('.div_id_verification_block').hide();
                                runCountDownClck('timer3', 600);
        <?php } ?>
                        }else{
                            fn_Send_Block(str_email, getCookie('applicant'), getCookie('country'), getCookie('telephone'), 4);
                            fn_Delete_Cookies('*');
                            $('#block_box').modal({backdrop: 'static', show: true});
                        }
    <?php } ?>
                                              
<?php } ?>
<?php if ($bln_block_email_by_cookie) { ?>
            if(str_email != ""){
                history.forward(100);
            }
<?php } ?>
          
        $('#notify_panel_close_button').click(function (e){ $('#notify_panel').modal('hide'); return false;})
        $('#code_verification_ok_verify_button').click(function (e) { fn_Verify_Code($('div#modal_dist_popup #email').val(), $('#txt_verification_code').val()); return false;})
        $('#code_verification_resend_code_button').click(function (e) { fn_Send_Verification_Code($('div#modal_dist_popup #email').val(), $('div#modal_dist_popup #applicant').val(), 1, $('div#modal_dist_popup #hdn_country_name').val(), $('div#modal_dist_popup #telephone').val()); return false;})
        $('#code_verification_cancel_button').click(function (e) { fn_Send_Block($('div#modal_dist_popup #email').val(), $('div#modal_dist_popup #applicant').val(), $('div#modal_dist_popup #hdn_country_name').val(), $('div#modal_dist_popup #telephone').val(),1); return false;})
        $('.code_verification_block_close_button').click(function (e) { fn_Handle_Block(2, <?php echo isset($str_Edit) ? $str_Edit : "true"; ?>);})
        $('#code_verification1 .code_verification_block_close_button').click(function (e) { fn_Handle_Block(2, <?php echo isset($str_Edit) ? $str_Edit : "true"; ?>);})
        $('#blck_confirm_msg').click(function (e) { fn_Handle_Block(1, <?php echo isset($bln_Edit) ? $bln_Edit : "false"; ?>);})
        $('#company').keyup(function (e) {  fn_UpdateValues(this.value, 'spn_id_Company_1,spn_id_Company_2,spn_id_Company_3'); fn_Handle_Fields('txt', this.value, 'applicant');})
        $('#company').change(function (e) {  fn_UpdateValues(this.value, 'spn_id_Company_1,spn_id_Company_2,spn_id_Company_3'); fn_Handle_Fields('txt', this.value, 'applicant');})
        $('#applicant').keyup(function (e) { fn_UpdateValues(this.value, 'spn_id_Applicant_1'); fn_Handle_Fields('txt', this.value, 'country');})
        $('#applicant').change(function (e) { fn_UpdateValues(this.value, 'spn_id_Applicant_1'); fn_Handle_Fields('txt', this.value, 'country');})
        $('#country').change(function (e) { fn_Handle_Fields('dd', this.selectedIndex, 'address');})
        $('#country').click(function (e) { fn_Handle_Fields('dd', this.selectedIndex, 'address');})
        $('#address').keyup(function (e) { fn_Handle_Fields('txt', this.value, 'designation');})
        $('#address').change(function (e) { fn_Handle_Fields('txt', this.value, 'designation');})
        $('#designation').keyup(function (e) { fn_Handle_Fields('txt', this.value, 'telephone');})
        $('#designation').change(function (e) { fn_Handle_Fields('txt', this.value, 'telephone');})
        $('#telephone').keyup(function (e) { fn_Handle_Fields('txt', this.value, 'email');})
        $('#telephone').change(function (e) { fn_Handle_Fields('txt', this.value, 'email');})
        $('#email').keyup(function (e) { fn_Handle_Fields('email', this.value, 'license'); })
        $('#email').change(function (e) { fn_Handle_Fields('email', this.value, 'license'); })
        $('#email').blur(function (e) { fn_Check_Email(this.value);})
        $('#license').change(function (e) { fn_Handle_Fields('license', 1, 'companysize_medium');
            fn_Handle_Fields('license', 1, 'companysize_big'); })
        $('#companysize_big').click(function (e) { fn_Handle_Fields('txt', 'checked', 'companystart_brake_pads');fn_Handle_Fields('txt', 'checked', 'companystart_filters');fn_Handle_Fields('txt', 'checked', 'companystart_brake_lining');})
        $('#companysize_medium').click(function (e) { fn_Handle_Fields('txt', 'checked', 'companystart_brake_pads');fn_Handle_Fields('txt', 'checked', 'companystart_filters');fn_Handle_Fields('txt', 'checked', 'companystart_brake_lining');})
        $('#companystart_brake_pads').click(function (e) { fn_Handle_Fields('txt', 'checked','chk_id_agree');})
        $('#companystart_filters').click(function (e) { fn_Handle_Fields('txt', 'checked', 'chk_id_agree');})
        $('#companystart_brake_lining').click(function (e) { fn_Handle_Fields('txt', 'checked', 'chk_id_agree');})
        $('#chk_id_agree').change(function (e) { fn_Handle_Fields('txt', 'checked', 'sel_id_indoor_sales');})
        $('#sel_id_indoor_sales').click(function (e) { fn_Handle_Fields('sel', this.selectedIndex, 'sel_id_outdoor_sales');})
        $('#sel_id_outdoor_sales').click(function (e) { fn_Handle_Fields('sel', this.selectedIndex, 'txt_id_salesbrief');})
        $('#txt_id_salesbrief').keyup(function (e) { fn_Handle_Fields('txt', this.value, 'chk_id_signup');})
        $('#txt_id_salesbrief').change(function (e) { fn_Handle_Fields('txt', this.value, 'chk_id_signup');})
        $('#modal_dist_popup_cancel_button').click(function (e) { fn_Send_Block('', $('#applicant').val(), $('#country_title').text(), $('#telephone').val(), 1); return false;})
        $('#modal_dist_popup_submit_button').click(function (e) { fn_Handle_Submit_Verification(1); return false;})
        $('#modal_dist_preview_popup_back_button').click(function (e) { fn_Edit_Form();})
        $('#modal_dist_preview_popup_submit_button').click(function (e) {  if(typeof clock !== "undefined") clock.reset(); fn_Send_Verification_Code($('div#modal_dist_popup #email').val(), $('div#modal_dist_popup #applicant').val(), 0, $('div#modal_dist_popup #hdn_country_name').val(), $('div#modal_dist_popup #telephone').val()); return false;})
        $('#cancel').click(function (e) {fn_Send_Block('', $('div#modal_dist_popup #applicant').val(), $('div#modal_dist_popup #hdn_country_name').val(), $('div#modal_dist_popup #telephone').val(),1); return false;})
    }); 
</script>

