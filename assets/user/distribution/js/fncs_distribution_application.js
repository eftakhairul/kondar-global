//js function to support the Distribution application page
//JLL March 17, 2014
var clock;
var clock1;
var clock2;
var clock3;


function fn_Set_Cookies(str_email, str_country, str_applicant, str_telephone){
    document.cookie="email=" + str_email + "; expires=; path=/";
    document.cookie="country=" + str_country + "; expires=; path=/";
    document.cookie="applicant=" + str_applicant + "; expires=; path=/";
    document.cookie="telephone=" + str_telephone + "; expires=; path=/";
}

function getCookie(cname){
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i=0; i<ca.length; i++){
        var c = ca[i].trim();
        if(c.indexOf(name)==0) 
            return c.substring(name.length,c.length);
    }
    return "";
}

function fn_Delete_Cookies(str_cookie){
    if(str_cookie == 'email' || str_cookie == '*')
        document.cookie = "email=; expires=Thu, 01 Jan 1970 00:00:00 GMT; path=/";
    if(str_cookie == 'applicant' || str_cookie == '*')
        document.cookie = "applicant=; expires=Thu, 01 Jan 1970 00:00:00 GMT; path=/";
    if(str_cookie == 'country' || str_cookie == '*')
        document.cookie = "country=; expires=Thu, 01 Jan 1970 00:00:00 GMT; path=/";
    if(str_cookie == 'telephone' || str_cookie == '*')
        document.cookie = "telephone=; expires=Thu, 01 Jan 1970 00:00:00 GMT; path=/";
    if(str_cookie == 'preview' || str_cookie == '*')
        document.cookie = "preview=; expires=Thu, 01 Jan 1970 00:00:00 GMT; path=/";
    if(str_cookie == 'verification' || str_cookie == '*')
        document.cookie = "verification=; expires=Thu, 01 Jan 1970 00:00:00 GMT; path=/";
}

function readURL(input){
    if(input.files && input.files[0]){
        var reader = new FileReader();
        reader.onload = function(e){
            $('#img_preview').attr('src', e.target.result);
            fn_Handle_Fields('license', 1, 'companysize_medium');
            fn_Handle_Fields('license', 1, 'companysize_big');
        }
        if(input.files[0].name.toLowerCase().indexOf('.doc') > 0)
            $('#img_preview').attr('src', str_Base_URL + 'assets/user/distribution/imgs/doc.png');
        else if(input.files[0].name.toLowerCase().indexOf('.pdf') > 0)
            $('#img_preview').attr('src', str_Base_URL + 'assets/user/distribution/imgs/pdf.png');
        else if(input.files[0].name.toLowerCase().indexOf('.png') > 0 || input.files[0].name.toLowerCase().indexOf('.jpg') > 0 || input.files[0].name.toLowerCase().indexOf('.bmp') > 0 || input.files[0].name.toLowerCase().indexOf('.gif') > 0 || input.files[0].name.toLowerCase().indexOf('.tif') > 0)
            reader.readAsDataURL(input.files[0]);
        else
            $('#img_preview').attr('src', str_Base_URL + 'assets/user/distribution/imgs/unsupported.png');
    }
}

function fn_Edit_Form(){
    if(typeof clock !== "undefined")
        clock.reset();
    var url =  "distribution/get_timer";
    var postData = {
        value:'edit'
    };
    $.post(url, postData, function(data) {
        
        $('#contact_msg').html(data[0]['distribution_edit_msg']);
        $('#contact_msg').hide();
        var time = data[0]['distribution_edit_timer']*60;
        
        runCountDownClck('timer1',time);
    },'JSON');
    // $('#frm_id_distribution_application_preview').get(0).setAttribute('action', 'distribution/index');
    // $('#frm_id_distribution_application_preview').submit();
    setTimeout(function(){
        $("#modal_dist_preview_popup").animate({
            scrollTop: 0
        }, "slow");
        $("#modal_dist_popup").animate({
            scrollTop: 0
        }, "slow");
    },1000);
    $('#modal_dist_preview_popup').modal('hide');
    $('#modal_dist_popup').modal('show');
}

function runCountDownClck(str_targetdiv, int_seconds,first)
{
    // alert(int_seconds);
    // if($('#'+str_targetdiv).html() == ''){
    $('#'+str_targetdiv).html('');
    if(str_targetdiv == 'timer1'){
        //            obj_countDown = new Countdown({
        //                time: int_seconds, 
        //                width: 100,
        //                height: 40,
        //                rangeHi  : "hour",
        //                rangeLo  : "second",
        //                style:"flip",
        //                target:str_targetdiv,
        //                onComplete	: countdownDistribution
        //            });

        clock = $('#'+str_targetdiv).FlipClock(int_seconds, {
            clockFace: 'HourCounter',
            countdown: true,
            callbacks: {
                stop: function() {
                    if(first!='first'){
                        countdownDistribution();
                    }
                    else{
                        countdownDistributionfirst();
                    }
                }
            }
        });
    }else if(str_targetdiv == 'timer2')
        //            obj_countDown = new Countdown({
        //                time: int_seconds, 
        //                width: 100,
        //                height: 40,
        //                rangeHi  : "hour",
        //                rangeLo  : "second",
        //                style:"flip",
        //                target:str_targetdiv,
        //                onComplete	: countdownDistributionPreview
        //            });
        clock = $('#'+str_targetdiv).FlipClock(int_seconds, {
            clockFace: 'HourCounter',
            countdown: true,
            callbacks: {
                stop: function() {
                    countdownDistributionPreview();
                }
            }
        });
    else if(str_targetdiv == 'timer3')
        //            obj_countDown = new Countdown({
        //                time: int_seconds,  
        //                width: 100,
        //                height: 40,
        //                rangeHi  : "hour",
        //                rangeLo  : "second",
        //                style:"flip",
        //                target:str_targetdiv,
        //                onComplete	: countdownDistributionCodeVerification
        //            });
        clock = $('#'+str_targetdiv).FlipClock(int_seconds, {
            clockFace: 'HourCounter',
            countdown: true,
            callbacks: {
                stop: function() {
                    countdownDistributionCodeVerification();
                }
            }
        });
    else if(str_targetdiv == 'timer4')
        //            obj_countDown = new Countdown({
        //                time: int_seconds, 
        //                width: 100,
        //                height: 40,
        //                rangeHi  : "hour",
        //                rangeLo  : "second",
        //                style:"flip",
        //                target:str_targetdiv,
        //                onComplete	: countdownDistributionCodeVerification4
        //            });
        clock = $('#'+str_targetdiv).FlipClock(int_seconds, {
            clockFace: 'HourCounter',
            countdown: true,
            callbacks: {
                stop: function() {
                    countdownDistributionCodeVerification4();
                }
            }
        });

// }
}

function countdownDistributionCodeVerification(){
    if(typeof clock !== "undefined")
        clock.reset();
    $('#code_verification').modal('hide');
    // $('#block_box').modal('show');
    setTimeout(function(){
        $("#modal_dist_preview_popup").animate({
            scrollTop: 0
        }, "slow");
        $("#modal_dist_popup").animate({
            scrollTop: 0
        }, "slow");
    },1000);
    fn_Send_Block($('.email').val(), $('.applicant').val(), $('#country_title').text(), $('.telephone').val(), 5);
    fn_Delete_Cookies('*');
    var blockMsg = "Unfortunately, you did not enter the correct code within the given lead-time.  Therefore, you will be welcome to use an alternative email or wait for 120 minutes to use the current email "+$('.email').val()+" within our website. ";
    //	$('#blckMsg').html(str_Block_No_Response);
   
    $('#blckMsg').html(blockMsg);


}

function formReset(form_id){

    $(form_id).removeClass('resetForm');
    $(form_id)[0].reset();

    document.getElementByClass('applicant').disabled = true;
    //document.getElementByClass('promotion_salutation').disabled = true;
    $('#country').data('dd').set('disabled', true);
    document.getElementByClass('address').disabled = true;
    document.getElementByClass('designation').disabled = true;
    document.getElementByClass('telephone').disabled = true;
    document.getElementByClass('email').disabled = true;
    //document.getElementByClass('license').disabled = true;
    //document.getElementByClass('companysize_medium').disabled = true;
    // document.getElementByClass('companysize_big').disabled = true;
    document.getElementByClass('companystart_brake_pads').disabled = true;
    document.getElementByClass('companystart_filters').disabled = true;
    document.getElementByClass('companystart_brake_lining').disabled = true;
    document.getElementByClass('txt_id_salesbrief').disabled = true;
    document.getElementById('chk_id_agree').disabled = true;
    document.getElementById('chk_id_signup').disabled = true;

    document.getElementByClass('sel_id_indoor_sales').disabled = true;
    document.getElementByClass('sel_id_outdoor_sales').disabled = true;


    if(typeof clock !== "undefined")
        clock.reset();
    $('#timer4').empty();
    $('#timer1').empty();
    $('.imagepreview').hide();
}

function countdownDistributionCodeVerification4(){
    if(typeof clock !== "undefined")
        clock.reset();
    $('#code_verification').modal('hide');
    $('#block_box').modal('show');
    fn_Send_Block($('.email').val(), $('.applicant').val(), $('#country_title').text(), $('.telephone').val(), 5);
    fn_Delete_Cookies('*');
    //var blockMsg = "Unfortunately, you did not enter the correct code within the given lead-time.  Therefore, you will be welcome to use an alternative email or wait for 120 minutes to use the current email "+$('.email').val()+" within our website. ";
    var blockMsg = "Unfortunately, you did not finish editing the contact us form during the given lead-time. Therefore, you will be welcome to use an alternative email or wait for 120 minutes to use the current email "+$('.email').val()+" within our website.";
    //	$('#blckMsg').html(str_Block_No_Response);
    // alert(blockMsg);
    $('#blckMsg').html(blockMsg);
    $('#modal_dist_popup input').val('');
    $('#modal_dist_popup .txt_id_salesbrief').val('');
    $('#modal_dist_popup .sel_id_indoor_sales').val(0);
    $('#modal_dist_popup .sel_id_outdoor_sales').val(0);
    $('#modal_dist_popup .flag').removeAttr('class');
    $('#modal_dist_popup img').attr('class','flag ca fnone');
    $('#modal_dist_popup .ddlabel').html('Canada');
    $('#modal_dist_popup checkbox').attr("checked", false);
    $('#modal_dist_popup .chk_id_agree').attr("checked", false);
    $('#modal_dist_popup .chk_id_signup').attr("checked", false);
    $('#modal_dist_popup input[name=companysize]').attr('checked',false);
    $('#modal_dist_popup input[name=companystart]').attr('checked',false);
    $('#timer4').hide();
    $('#timer1').hide();
}
function countdownDistribution()
{
    if(typeof clock !== "undefined")
        clock.reset();
    $('#modal_dist_popup').modal('hide');
    // $('#block_box').modal('show');
    fn_Send_Block($('.email').val(), $('.applicant').val(), $('#country_title').text(), $('.telephone').val(), 5);
    fn_Delete_Cookies('*');
//var blockMsg = "Unfortunately, you did not take necessary action within the given lead-time.  Therefore, you will be welcome to use an alternative email or wait for 120 minutes to use the current email "+$('.email').val()+" within our website. ";
//	$('#blckMsg').html(str_Block_No_Response);
// $('#blckMsg').html(blockMsg);


}
function countdownDistributionfirst(){
    if(typeof clock !== "undefined")
        clock.reset();
    $('#modal_dist_popup').modal('hide');
    // $('#block_box').modal('show');
    fn_Send_Block($('.email').val(), $('.applicant').val(), $('#country_title').text(), $('.telephone').val(), 6);
    fn_Delete_Cookies('*');
}
function countdownDistributionPreview()
{
    if(typeof clock !== "undefined")
        clock.reset();
    $('#modal_dist_preview_popup').modal('hide');
    //$('#block_box').modal('show');
    fn_Send_Block($('.email').val(), $('.applicant').val(), $('#country_title').text(), $('.telephone').val(), 6);
    fn_Delete_Cookies('*');
//var blockMsg = "Unfortunately, you did not take necessary action within the given lead-time.  Therefore, you will be welcome to use an alternative email or wait for 120 minutes to use the current email "+$('.email').val()+" within our website. ";
//	$('#blckMsg').html(str_Block_No_Response);
//$('#blckMsg').html(blockMsg);
}

function fn_Check_Email(str_email){
    if(int_fn_Validate_Field('email', str_email) == 1){
        if ($('#timer1').html() == '') {
            fn_Set_Cookies(str_email, $('#country_title').text(), $('.applicant').val(), $('.telephone').val());
            var url = "distribution/get_timer";
            var postData = {
                value: 'main'
            };
            $.post(url, postData, function (data) {
                $('#contact_msg').html(data[0]['main_distribution_msg']);
                $('#contact_msg').hide();
                var time = data[0]['main_distribution_timer'] * 60;
                runCountDownClck("timer1", time,'first');
            }, 'JSON');
        }
    }
}

function fn_UpdateValues(obj_value, str_spn_ids){
    var arr_ = str_spn_ids.split(",");
    for(var int_I = 0; int_I < arr_.length; int_I++){
        document.getElementById(arr_[int_I]).innerHTML = obj_value;
    }
}

function fn_Handle_Fields(str_type, gen_value, str_id_next_field){
    switch(str_type){
        case 'txt':
            if(gen_value != ''){                       
                if(str_id_next_field == 'country'){
                    $('#' + str_id_next_field).data('dd').set('disabled', false);
                }else
                    //document.getElementByClass(str_id_next_field).disabled = false;
                    $('.'+str_id_next_field).prop('disabled', false);
            }
            break;
        case 'file':
            if(gen_value != ''){
                if(str_id_next_field == 'country'){
                    $('#' + str_id_next_field).data('dd').set('disabled', false);
                }else
                    //document.getElementByClass(str_id_next_field).disabled = false;
                    $('.'+str_id_next_field).prop('disabled', false);
            }
            break;
	
        case 'license':
            if(gen_value == 1){
                //document.getElementByClass(str_id_next_field).disabled = false;
                $('.'+str_id_next_field).prop('disabled', false);
            }                
            break;

        case 'sel':
            if(gen_value != -1){
                if(str_id_next_field == 'country'){
                    $('#' + str_id_next_field).data('dd').set('disabled', false);
                }else
                    //document.getElementByClass(str_id_next_field).disabled = false;
                    $('.'+str_id_next_field).prop('disabled', false);
            }
            break;
        case 'dd':
            //document.getElementByClass(str_id_next_field).disabled = false;
            $('.'+str_id_next_field).prop('disabled', false);
            break;
        case 'email':
            $('.'+str_id_next_field).prop('disabled', false);
            if(int_fn_Validate_Field('email', gen_value) == 1){                
                if(str_id_next_field == 'country'){                    
                    $('#' + str_id_next_field).data('dd').set('disabled', false);
                }else
                    //document.getElementByClass(str_id_next_field).disabled = false;
                    $('.'+str_id_next_field).prop('disabled', false);
            }
            break;
    }
}
 
function fn_Handle_Form_Startup(bln_enabled){
    if(!bln_enabled){
       
        $('#frm_id_distribution_application')[0].reset();
        //document.getElementsByClassName('applicant').disabled = true;

        $('#frm_id_distribution_application input,#frm_id_distribution_application select,#frm_id_distribution_application textarea').prop('disabled', true);
        $('#frm_id_distribution_application #company:input,#frm_id_distribution_application .promotion_salutation').prop('disabled', false);
    /*
        
        //document.getElementById('promotion_salutation').disabled = true;
        $('#country').data('dd').set('disabled', true);
        //document.getElementsByClassName('address').disabled = true;
        $('.address').prop('disabled', true);
        //document.getElementsByClassName('designation').disabled = true;
        $('.designation').prop('disabled', true);
        //document.getElementsByClassName('telephone').disabled = true;
        $('.telephone').prop('disabled', true);
        //document.getElementsByClassName('email').disabled = true;
        $('.email').prop('disabled', true);
        //document.getElementById('license').disabled = true;
        document.getElementsByClassName('companysize_medium').disabled = true;
        $('.companysize_medium').prop('disabled', true);
        //document.getElementsByClassName('companysize_big').disabled = true;
        $('.companysize_big').prop('disabled', true);
        //document.getElementsByClassName('companystart_brake_pads').disabled = true;
        $('.companystart_brake_pads').prop('disabled', true);
        //document.getElementsByClassName('companystart_filters').disabled = true;
        $('.companystart_filters').prop('disabled', true);
        //document.getElementsByClassName('companystart_brake_lining').disabled = true;
        $('.companystart_brake_lining').prop('disabled', true);
        //document.getElementsByClassName('txt_id_salesbrief').disabled = true;
        $('.txt_id_salesbrief').prop('disabled', true);
        document.getElementById('chk_id_agree').disabled = true;
        document.getElementById('chk_id_signup').disabled = true;
	
        //document.getElementsByClassName('sel_id_indoor_sales').disabled = true;
        $('.sel_id_indoor_sales').prop('disabled', true);
        //document.getElementsByClassName('sel_id_outdoor_sales').disabled = true;
        $('.sel_id_outdoor_sales').prop('disabled', true);
        
         */
    }
}

function fn_Handle_Block(int_case, bln_edit){
    if(typeof clock !== "undefined")
        clock.reset();

    if($('#frm_id_distribution_application').hasClass('resetForm')|| int_case==6){
        document.location.href = "\distribution";
    }else{

        $('#frm_id_distribution_application').addClass('resetForm');
        setTimeout(function(){
            $("#modal_dist_preview_popup").animate({
                scrollTop: 0
            }, "slow");
            $("#modal_dist_popup").animate({
                scrollTop: 0
            }, "slow");
        },1000);
        var url =  "distribution/get_timer";
        var postData = {
            value:'edit'
        };
        $.post(url, postData, function(data) {

            $('#contact_msg').html(data[0]['distribution_edit_msg']);
            $('#contact_msg').hide();
            var time = data[0]['distribution_edit_timer']*60;

            runCountDownClck('timer1',time);
        },'JSON');
        //runCountDownClck('timer1',86400);

        $('#modal_dist_popup .loading').hide();
        $('#modal_dist_preview_popup .loading').hide();
        switch(int_case){
            case 1:
                $('#block_box').modal('hide');
                $('#modal_dist_popup').modal('show');
                $('#modal_dist_preview_popup').modal('hide');
                $('#modal_dist_popup .loading').hide();
                $('#modal_dist_preview_popup .loading').hide();

                //  $('#timer1').hide();

                break;
            case 2:
                $('#code_verification').modal('hide');
                $('.div_id_verification_warning').hide();
                $('#txt_verification_code').val('');
                $('#div_id_verification_panel').show();
                $('#all_button').show();
                $('#modal_dist_popup').modal('show');
                break;
        }
        if(bln_edit){
            $('#modal_dist_preview_popup .loading').hide();
            $('#modal_dist_popup .loading').hide();
            $('#frm_id_distribution_application_preview').get(0).setAttribute('action', "distribution/index");
            $('#frm_id_distribution_application_preview').submit();
        }
    }
}

function fn_Send_Verification_Code(str_email, str_applicant, int_resend, str_country, str_telephone){

    // runCountDownClck('timer2',86400);
    
    //    if(int_resend == 0)
    //        document.cookie="verification=1; expires=; path=/";
    var data = {
        company: $('div#modal_dist_preview_popup .company_preview').val(),
        salutation: $('div#modal_dist_preview_popup .salutation').val(),
        applicant: $('div#modal_dist_preview_popup .applicant').val(),
        hdn_country_name: $('div#modal_dist_preview_popup .hdn_country_name').val(),
        hdn_country_label: $('div#modal_dist_preview_popup .hdn_country_label').val(),
        country: $('div#modal_dist_preview_popup #country').val(),
        address: $('div#modal_dist_preview_popup .address').val(),
        designation: $('div#modal_dist_preview_popup .designation').val(),
        telephone: $('div#modal_dist_preview_popup .telephone').val(),
        email: $('div#modal_dist_preview_popup .email').val(),
        hdn_license_preview: $('div#modal_dist_preview_popup .hdn_license_preview').val(),
        companysize: $('div#modal_dist_preview_popup .companysize').val(),
        companystart: $('div#modal_dist_preview_popup .companystart').val(),
        sel_indoor_sales: $('div#modal_dist_preview_popup .sel_indoor_sales').val(),
        sel_outdoor_sales: $('div#modal_dist_preview_popup .sel_outdoor_sales').val(),
        salesbrief: $('div#modal_dist_preview_popup .salesbrief').val(),
        int_resend: int_resend,
        send_mail:'sendmail'
    }
    
    $('div.loading').show();
    if(str_email!='send_mail'){
        var url =  "distribution/index/do_send_verification_email";
    }else{
        var url =  "distribution/index/do_send_email";
    }
    // alert(int_resend)
    $.ajax({
        type: "POST",
        url: url,
        data: data,
        async:false,
        dataType: "json",
        success: function (data) {
            $('#user_email').html($('div#modal_dist_preview_popup .email').val())
            $('.loading').hide();
            if(data['end']!='end'){
                if(data['str_verification_message']!=''){
                    $('#code_verification #div_id_verification_message').html('<blink>'+data['str_verification_message']+'</blink>');
                }else{
                    $('#code_verification #div_id_verification_message').html('');
                }
                $('div#modal_dist_preview_popup').modal('hide');
                $('#code_verification').modal('show');
                $('.div_id_verification_block').hide();
                if(data['end']=='first'){
                    var url =  "distribution/get_timer";
                    var postData = {
                        value:'verify'
                    };
                    $.post(url, postData, function(data) {
        
                        $('#contact_msg').html(data[0]['distribution_popup_msg']);
                        $('#contact_msg').hide();
                        var time = data[0]['distribution_popup_timer']*60;
        
                        runCountDownClck('timer3', time);
                
                    },'JSON');
                }
            }else{
                if(typeof clock !== "undefined")
                    clock.reset();
                $('#code_verification').modal('hide');
                $('#block_box').modal('show');
                $('#block_box #blckMsg').html(data['str_verification_error']);
            }
        }
    });
   
//    return false;
//    $('#frm_id_distribution_application_preview').get(0).setAttribute('action', "distribution/index/do_send_verification_email/" + encodeURIComponent(str_email) + "/" + encodeURIComponent(str_applicant) + "/" + int_resend + "/" + encodeURIComponent(str_country) + "/" + encodeURIComponent(str_telephone));
//    $('#frm_id_distribution_application_preview').submit();
}

function fn_Send_Block(str_email, str_applicant, str_country, str_telephone, int_case){
   
   
    if(int_case<4){
        if(typeof clock !== "undefined")
            clock.reset();
        
        
        var url =  "distribution/get_timer";
        var postData = {
            value:'edit'
        };
        $.post(url, postData, function(data) {
        
            $('#contact_msg').html(data[0]['distribution_edit_msg']);
            $('#contact_msg').hide();
            var time = data[0]['distribution_edit_timer']*60;
        
            runCountDownClck('timer1',time);
        },'JSON');
    // runCountDownClck('timer1', 86400);
    }
  
    $('#modal_dist_popup .loading').hide();
    $('#modal_dist_preview_popup .loading').hide();
    
    var bln_Limpiar = false;
    if(str_email == ''){
        $('.email').disabled = false;
        str_email = $('.email').value;
        $('.email').disabled = true;
        bln_Limpiar = true;		
    }
    if(str_email != ''){
        $.ajax({
            url: "distribution/index/do_block/" + encodeURIComponent(str_email) + "/" + int_case + "/" + encodeURIComponent(str_applicant) + "/" + encodeURIComponent(str_country) + "/" + encodeURIComponent(str_telephone)
        }).done(function(data){
            // alert(data);
            // data = parseInt(data);
          
            if(!bln_Limpiar){
                $('#modal_dist_popup').modal('hide');
                $('#modal_dist_preview_popup').modal('hide');
                if(int_case==6){
                    if(typeof clock !== "undefined")
                        clock.reset();
                    $('#block_box1').modal('show');
                    $('#blckMsg1').html(data);  
                }else{
                    $('#block_box').modal('show');
                    $('#blckMsg').html(data);
                }
                // $('#div_id_verification_panel').hide();
                if(int_case==1){
                    $('#code_verification').modal('hide');
                    $('#div_id_verification_panel').show();
                    $('#all_button').show();
                    $('#txt_verification_code').val('');
                    $('#modal_dist_popup').modal('show');

                    setTimeout(function(){
                        $("#modal_dist_preview_popup").animate({
                            scrollTop: 0
                        }, "slow");
                        $("#modal_dist_popup").animate({
                            scrollTop: 0
                        }, "slow");
                    },1000);


                }
                $('.div_id_verification_block').show();
            }else{
                $('#modal_dist_popup').modal('hide');
                document.location.href = base_url+'home';
					
            // $('#block_box').modal('show');
            }
            fn_Delete_Cookies('*');
        });
    }else{
        $('#modal_dist_popup').modal('hide');
         document.location.href = base_url+'home';
    }
		
}

function fn_Verify_Code(str_email, str_verification_code){
    //clock.reset();
    if(str_verification_code != ''){
        $('div.loading').show();
        $.ajax({
            url: "distribution/index/do_verify_code/" + encodeURIComponent(str_email) + "/" + str_verification_code
        }).done(function(data){
            data = parseInt(data);
            $('div.loading').hide();
            if(data > 0){
                var str_message = '';
                if(data < 3){
                    str_message = str_Wrong_Code_1 + (3 - data) + str_Wrong_Code_2;
                    $('#div_id_verification_message').html('<blink>'+str_message+'</blink>');
                }else{
                    switch(data){
                        case 3:
                            //                                                    str_message = str_Block_Wrong_Code;
                            //   str_message = "Unfortunately, you did not enter the correct code within the given lead-time.  Therefore, you will be welcome to use an alternative email or wait for 120 minutes to use the current email "+str_email+" within our website.";
                            //str_message = "Unfortunately, you entered wrong verification code during the 3 attempts. Therefore, you will be welcome to use an alternative email or wait for 120  minutes to use the current email "+str_email+" within our website.";
                         str_message = $("#wrong_code_msg").html();
                         str_message = str_message.replace(/EMAILVAR/g, str_email);
                        break;
                        case 4:
                            str_message = str_Block_Previous_Attempt;
                            break;
                        default:
                            str_message = str_System_Problem;
                    }
                    // alert(str_message);
                    $('.div_id_verification_warning').html('<div class="blink">WARNING</div>');
                    $('div.div_id_verification_block div#div_id_verification_message1').html(str_message);
                    $('#all_button').hide();
                    $('#div_id_verification_panel').hide();
                    $('.div_id_verification_block').show();
                }
            }else{
                fn_Handle_Submit_Verification(0);
            }
        });
    }
}
function checkEmail(inputvalue){
    var pattern=/^([a-zA-Z0-9_.-])+@([a-zA-Z0-9_.-])+\.([a-zA-Z])+([a-zA-Z])+/;
    if(pattern.test(inputvalue)==false){		
        return false;
    }
    else return true;
}
function fn_Handle_Submit_Verification(int_check_signup){    
    $('#frm_id_distribution_application').removeClass('resetForm');
    setTimeout(function(){
        $("#modal_dist_preview_popup").animate({
            scrollTop: 0
        }, "slow");
        $("#modal_dist_popup").animate({
            scrollTop: 0
        }, "slow");
    },1000);
    if($('div#modal_dist_popup .email').val()==''){
        alert('Please Enter your email address');
        return false;
    }else if(checkEmail($('div#modal_dist_popup .email').val())==false){
        alert('Please Enter a valid email address');
        return false;
    }
    if(clock !=  undefined)
        clock.reset();

    //runCountDownClck('timer2',86400);
   
    $('.hdn_country_label').val(encodeURIComponent(($('#country_title').html())));
    $('.hdn_country_name').val(($('#country_title').text()));
    var country_img = $('#country_title').children('img').attr('class');
    
   
    
    var data = {
        company: $('div#modal_dist_popup #company').val(),
        salutation: $('div#modal_dist_popup .promotion_salutation').val(),
        applicant: $('div#modal_dist_popup .applicant').val(),
        hdn_country_name: $('div#modal_dist_popup .hdn_country_name').val(),
        hdn_country_label: $('div#modal_dist_popup .hdn_country_label').val(),
        country: $('div#modal_dist_popup #country').val(),
        address: $('div#modal_dist_popup .address').val(),
        designation: $('div#modal_dist_popup .designation').val(),
        telephone: $('div#modal_dist_popup .telephone').val(),
        email: $('div#modal_dist_popup .email').val(),
        hdn_license_preview: $('div#modal_dist_popup #filename').val(),
        companysize: $('div#modal_dist_popup input[name="companysize"]:checked').val(),
        companystart: $('div#modal_dist_popup input[name="companystart"]:checked').val(),
        sel_indoor_sales: $('div#modal_dist_popup .sel_id_indoor_sales').val(),
        sel_outdoor_sales: $('div#modal_dist_popup .sel_id_outdoor_sales').val(),
        salesbrief: $('div#modal_dist_popup .txt_id_salesbrief').val()
    }
  
    
    
    if(int_check_signup == 0){
        fn_Delete_Cookies('*');
        document.getElementById('frm_id_distribution_application_preview').submit();
    }else{
        if($(".chk_id_signup").is(":checked")){
            $('.hdn_country_label').val(encodeURIComponent(($('#country_title').html())));
            $('.hdn_country_name').val(($('#country_title').text()));
            document.cookie="preview=1; expires=; path=/";
            $('.loading').show();
            $.ajax({
                type: "POST",
                url: 'distribution/index/do_upload',
                data: data,
                async:false,
                dataType: "text",
                success: function (data) {
                    $('.loading').hide();
                    var url =  "distribution/get_timer";
                    var postData = {
                        value:'preview'
                    };
                    
                    $.post(url, postData, function(data) {
        
                        $('#contact_msg').html(data[0]['distribution_preview_msg']);
                        $('#contact_msg').hide();
                        var time = data[0]['distribution_preview_timer']*60;
        
                        runCountDownClck("timer2", time);
                    
                    },'JSON');
                    $('div#modal_dist_preview_popup .company_preview').val($('div#modal_dist_popup #company').val());
                    $('div#modal_dist_preview_popup .company_preview').html($('div#modal_dist_popup #company').val());
                   
                    $('div#modal_dist_preview_popup .salutation').val($('div#modal_dist_popup .promotion_salutation').val());
                    $('div#modal_dist_preview_popup .salutation').html($('div#modal_dist_popup .promotion_salutation').val());
                   
                    $('div#modal_dist_preview_popup .applicant').val($('div#modal_dist_popup .applicant').val());
                    $('div#modal_dist_preview_popup .applicant').html($('div#modal_dist_popup .applicant').val());
                   
                    $('div#modal_dist_preview_popup .hdn_country_name').val($('div#modal_dist_popup .hdn_country_name').val());
                    $('div#modal_dist_preview_popup .hdn_country_name').html($('div#modal_dist_popup .hdn_country_name').val());
                    
                    $('div#modal_dist_preview_popup #country_img').attr('class',country_img);
                   
                    $('div#modal_dist_preview_popup .hdn_country_label').val($('div#modal_dist_popup .hdn_country_label').val());
                    $('div#modal_dist_preview_popup .hdn_country_label').html($('div#modal_dist_popup .hdn_country_label').val());
                  
                    $('div#modal_dist_preview_popup #country').val($('div#modal_dist_popup #country').val());
                    $('div#modal_dist_preview_popup #country').html($('div#modal_dist_popup #country').val());
                  
                    $('div#modal_dist_preview_popup .address').val($('div#modal_dist_popup .address').val());
                    $('div#modal_dist_preview_popup .address').html($('div#modal_dist_popup .address').val());
                   
                    $('div#modal_dist_preview_popup .designation').val($('div#modal_dist_popup .designation').val());
                    $('div#modal_dist_preview_popup .designation').html($('div#modal_dist_popup .designation').val());
                   
                    $('div#modal_dist_preview_popup .telephone').val($('div#modal_dist_popup .telephone').val());
                    $('div#modal_dist_preview_popup .telephone').html($('div#modal_dist_popup .telephone').val());
                    
                    $('div#modal_dist_preview_popup .email').val($('div#modal_dist_popup .email').val());
                    $('div#modal_dist_preview_popup .email').html($('div#modal_dist_popup .email').val());
                  
                    $('div#modal_dist_preview_popup .hdn_license_preview').val($('div#modal_dist_popup #filename').val());
                    $('div#modal_dist_preview_popup .hdn_license_preview').html($('div#modal_dist_popup #filename').val());
                   
                    $('div#modal_dist_preview_popup .companysize').val($('div#modal_dist_popup input[name="companysize"]:checked').val());
                    $('div#modal_dist_preview_popup .companysize').html($('div#modal_dist_popup input[name="companysize"]:checked').children('.companysize_html').html());
                   
                    $('div#modal_dist_preview_popup .companystart').val($('div#modal_dist_popup input[name="companystart"]:checked').val());
                    $('div#modal_dist_preview_popup .companystart').html($('div#modal_dist_popup input[name="companystart"]:checked').val());
                   
                    $('div#modal_dist_preview_popup .sel_indoor_sales').val($('div#modal_dist_popup .sel_id_indoor_sales').val());
                    $('div#modal_dist_preview_popup .sel_indoor_sales').html($('div#modal_dist_popup .sel_id_indoor_sales').val());
                   
                    $('div#modal_dist_preview_popup .sel_outdoor_sales').val($('div#modal_dist_popup .sel_id_outdoor_sales').val());
                    $('div#modal_dist_preview_popup .sel_outdoor_sales').html($('div#modal_dist_popup .sel_id_outdoor_sales').val());
                    
                    
                  
                    $('div#modal_dist_preview_popup .salesbrief').val($('div#modal_dist_popup .txt_id_salesbrief').val());
                    $('div#modal_dist_preview_popup .salesbrief').html($('div#modal_dist_popup .txt_id_salesbrief').val());
                    
                    $('#modal_dist_popup').modal('hide');
                    $('#modal_dist_preview_popup').modal('show');                    
                }
            });
            
            
        // document.getElementById('frm_id_distribution_application').submit();
        }else{
            $('#notify_panel').modal('show');
        }
    }
}

function fn_Prepare_List(obj_id, int_limit){
    for(var int_I = 1; int_I <= int_limit; int_I++){
        fn_Add_List_Option(obj_id, int_I, int_I);
    }
}

function fn_Select_From_List(obj_id, gen_value){
	
    if(obj_id != 'country'){
        if(gen_value > -1){
            for(var int_I = 0; int_I < document.getElementById(obj_id).length; int_I++){
                if(document.getElementById(obj_id).options[int_I].value == gen_value)
                    document.getElementById(obj_id).selectedIndex = int_I;
            }
        }
    }else{
        if(gen_value != ''){
            var oHandler = $('#' + obj_id).msDropDown().data("dd");
            if(oHandler){
                for(var int_I = 0; int_I < document.getElementById(obj_id).length; int_I++){
                    if(document.getElementById(obj_id).options[int_I].value == gen_value)
                        oHandler.set("selectedIndex", int_I);
                }
            }
        }
    }
}

function fn_Add_List_Option(str_sel_id, str_value, str_text){
    var elSel, elOptNew;
    var int_I, i;

    elSel = document.getElementById(str_sel_id);
    elOptNew = document.createElement('option');

    elOptNew.text = str_text;
    elOptNew.value = str_value;
    try {
        elSel.add(elOptNew, null); // standards compliant; doesn't work in IE
    }
    catch(ex) {
    // elSel.add(elOptNew); // IE only
    }
}

function fn_Validate_Options_Group(options_group){
    for (var int_I = 0; int_I < options_group.length; ++int_I){
        if (options_group[int_I].checked) return true;
    }
    return false;
}