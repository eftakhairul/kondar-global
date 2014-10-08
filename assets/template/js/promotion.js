// JavaScript Document

var clock;
var clock1;
var clock2;

function ReloadSelectedTab()
{
    var seltab = window.location.hash;

    if (seltab != null)
    {
        //seltab=seltab.replace('#','');	
        //seltab=seltab.replace('_SEL','');
        $(seltab + '1').trigger('click');
    }

}
var new_time = 1200;
$(document).ready(function(e) {
    $("#country").msDropdown({
        roundedBorder: false
    });
    $("#claim_award_countries").msDropdown({
        roundedBorder: false
    });
    $(".imgInp").change(function() {
        readURL(this);
    });
    ReloadSelectedTab();
});
var myCountdown2;
var myCountdown3;
popwindowactive = false;
$(document).ready(function() {
    //$('#user_block_box').modal('show');
    //$('#claim_award').modal('show');
    //$('#claim_award').modal('show');
    $('#polyglotLanguageSwitcher1').polyglotLanguageSwitcher({
        effect: 'fade',
        testMode: true,
        onChange: function(evt) {
            var pathname = window.location;
            pathname = pathname.toString();
            var arr = pathname.split('home');

            window.location.href = arr[0] + evt.selectedItem + '/home';
        }
    });
    $('#polyglotLanguageSwitcher').polyglotLanguageSwitcher({
        effect: 'fade',
        testMode: true,
        onChange: function(evt) {
            if (evt.selectedItem != "en")
            {
                $('#language_popup').modal('show');
            }
            else
                return false;
        /*var pathname = window.location;
             pathname = pathname.toString();
             var langarr 	= '';
             var langsearch_fr = pathname.indexOf('/fr');
             var langsearch_ar = pathname.indexOf('/ar');
             
             if(langsearch_fr >= 0)
             {
             langarr = pathname.split('/fr');
             langarr = langarr[0]+'/';
             }
             else if(langsearch_ar >= 0)
             {
             langarr = pathname.split('/ar');
             langarr = langarr[0]+'/';
             }
             else
             {
             langarr = pathname.split('home');
             langarr = langarr[0];
             }
             
             if(evt.selectedItem != 'en')
             {
             window.location.href = langarr+evt.selectedItem+'/home';
             }
             else
             {
             window.location.href = langarr+'home';
             }		*/
        }
    });
    $('#checkSerialNumber').click(function() {
        $('#saveBasicDetailsForm')[0].reset();
        var serial_number = $('#serial_number').val();
        $('#enter_user_details #code').val(serial_number);
        if (serial_number != '')
        {
            $('#serial_number').removeClass('boarder_red');
            $('#enter_user_details').modal('show');
        }
        else
        {
            $('#serial_number').addClass('boarder_red');
        }
    });
    $('#saveBasicDetails').click(function() {
        $('.emailcode-error').hide();
        $('#emailVerificationCode').val('')
        $('#emailVerificationCode').removeClass('boarder_red');
        $('#code').val($('#serial_number').val());
        var name = $('#name').val();
        //var country = $('#country').val();

        var country = $('#country_title').find('.ddlabel').html();

        $('#country_title1').val(country);
        var telephone = $('#telephone').val();
        var email = $('#email').val();
        var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
        var error_flag = 0;

        if (name == '')
        {
            $('#name').addClass('boarder_red');
            error_flag = 1;
        }
        else
        {
            $('#name').removeClass('boarder_red');
        }
        if (country == '')
        {
            $('#country').addClass('boarder_red');
            error_flag = 1;
        }
        else
        {
            $('#country').removeClass('boarder_red');
        }
        if (telephone == '')
        {
            $('#telephone').addClass('boarder_red');
            error_flag = 1;
        }
        else
        {
            $('#telephone').removeClass('boarder_red');
        }
        if (email == '' || (reg.test(email) == false))
        {
            $('#email').addClass('boarder_red');
            error_flag = 1;
        }
        else
        {
            $('#email').removeClass('boarder_red');
        }

        if (error_flag == 0)
        {
            //var data = json($('#saveBasicDetailsForm').serializeArray());
            //alert(data);
            $('.loaderimage').show();
            $.ajax({
                type: "POST",
                url: "promotion/save_user_details",
                data: $('#saveBasicDetailsForm').serialize(),
                beforeSend: function() {
                //	   alert('asa');
                // $("#show_class").show();
                // $("#show_class").html("Loading ...");
                },
                success: function(msg) {
                    //alert($.trim(msg) == 0);
                    //notify_award_won
                    $split_msg = msg.split('##*##');
                    var time_diff = $split_msg[1];
                    msg = $split_msg[0];
                    if ($.trim(msg) != 2) {
                        var block_min = Math.round(time_diff / 60);
                        block_min = 120 - block_min;
                    }

                    //alert(block_min);
                    var response_email = $.trim($split_msg[2]);
                    $('.loaderimage').hide();
                    $('#enter_user_details').modal('hide');

                    $('#msg_email_span').html($('#email').val());
                    if ($.trim(msg) == 1)
                    {
                        var url =  "promotion/get_timer_award";
                        var postData = {
                            value:'verify'
                        };
                        $.post(url, postData, function(data) {
                            var time = data[0]['award_popup_timer']*60;
                            runCountDownClock1("timer1", time);
                        },'JSON');
                        $('#check_mail_code').modal('show');
                    }
                    else if ($.trim(msg) == 2) {
                        $.ajax({
                            type: "POST",
                            url: "promotion/getAwardMsg",
                            success: function(data){
                                data = JSON.parse(data)
                                $('#show_header').html(data[0].blocked_email_msg);
                                var data = data[0].blocked_email_msg.replace(/PHRASE/g,response_email);
                                var blockMsg = data.replace(/SECTION/g, time_diff);
                                $('#blockMsg').html(blockMsg);
                                $('#check_mail_code').modal('hide');
                                $('#user_block_box').modal('show');
                            }
                        });
                        //$('#blockMsg').html('You Have Been Blocked in '+time_diff+' section. Please Try After ' + block_min + ' minutes.');
                        //   var blockMsg = "The email "+$split_msg[2]+" is blocked in the section "+time_diff+". Therefore, please use an alternative email or wait "+$split_msg[3]+" minutes to use this email again within our website. Thank you";
                        
                        //$('#blockMsg1').html('You Have Been Blocked. Please Try After '+block_min+' minutes.');
                        //$('#blockMsg').html('You Have Been Blocked. Therefore, you will be able to use your email: ' + response_email + ' within our website only after ' + block_min + ' minutes from now. However, you will be welcome to use an alternative email');
                        
                        var new_time = 1200;
                        popwindowactive = false;
                    }
                    else
                    {

                        $('#blockMsg').html('You Have Been Blocked.<br> Please Try After ' + block_min + ' minutes.');

                        //$('#blockMsg1').html('You Have Been Blocked. Please Try After '+block_min+' minutes.');
                        $('#blockMsg').html('You Have Been Blocked. Therefore, you will be able to use your email: ' + response_email + ' within our website only after ' + block_min + ' minutes from now. However, you will be welcome to use an alternative email');
                        $('#check_mail_code').modal('hide');
                        $('#user_block_box').modal('show');
                        var new_time = 1200;
                        popwindowactive = false;
                    }

                //enter_user_detailscheck_mail_code
                //var msg = "Serial Code status successfully updated. ";
                // $("#show_class").html(msg);
                }
            });
        }
    });

    $('#resendemail').click(function() {
        $('#loaderimageback').show();
        $('.emailcode-error').hide();
        $('#emailVerificationCode').val('')
        $('#emailVerificationCode').removeClass('boarder_red');
        $('#loaderimageback').hide();
        $('#enter_user_details').modal('show');
        $('#check_mail_code').modal('hide');
    });
    $('#emailVerificationCodeSubmit').click(function() {
        $('#code_VerificationCode').val($('#serial_number').val());

        $('#user_email').val($('#email').val());
        $('#user_details_name').val($('#name').val());
        $('#user_details_countries').val($('#country_title1').val());
        $('#user_details_telephone').val($('#telephone').val());

        $('#claim_award_code_VerificationCode').val($('#serial_number').val());
        var verificationCode = $.trim($('#emailVerificationCode').val());
        if (verificationCode != '')
        {
            $('#loaderimagecontinue').show();
            $.ajax({
                type: "POST",
                url: "promotion/checkserialcode",
                data: $('#checkVerificationCode').serialize(),
                beforeSend: function() {
                //	   alert('asa');
                // $("#show_class").show();
                // $("#show_class").html("Loading ...");
                },
                success: function(msg) {
                    $split_msg = msg.split('##*##');
                    var email_attempt = $split_msg[1];
                    var email_ = $.trim($split_msg[1]);
                    msg = $split_msg[0];
                    $('#loaderimagecontinue').hide();

                    if ($.trim(msg) == 1)
                    {
                        $('.emailcode-error').hide();
                        $('#check_mail_code').modal('hide');
                        $('#claim_award_winning_number').html($('#serial_number').val());
                        clock.reset();
                        $.ajax({
                            type: "POST",
                            url: "promotion/get_award_title",
                            data:'code='+$('#serial_number').val(), 
                            success: function(data) {
                                
                                $('#notify_award_w0n #awards_file').html(data);
                                $('#notify_award_w0n').modal('show');
                            }
                        });
                        popwindowactive = false;
                    //runCountDownClock("promotiontimer");
                    //$('#claim_award').modal('show');

                    }
                    else if ($.trim(msg) == 2)
                    {
                        $('#check_mail_code').modal('show');
                        $('.emailcode-error').show();

                        $('.emailcode-error').html('Invalid verification code Attempt:#' + email_attempt + ' . Try again');
                        $('#emailVerificationCode').addClass('boarder_red');
                    }
                    else if ($.trim(msg) == 4)
                    {
                        // $('#blockMsg').html('Unfortunately, you entered wrong verification code during the 3 attempts. Therefore, you will be welcome to use an alternative email or wait for 120 minutes to use the current email ' + email_ + ' within our website.');
                       
                        $.ajax({
                            type: "POST",
                            url: "promotion/getAwardMsg",
                            success: function(data){
                                data = JSON.parse(data)
                                var blockMsg = data[0].error_code_block_msg.replace(/PHRASE/g,email_);
                                $('#blockMsg').html(blockMsg);
                                popwindowactive = false;  
                                $('#check_mail_code').modal('hide');
                                $('#user_block_box').modal('show');
                            }
                        });
                       
                       
                    }
                    else if ($.trim(msg) == 5)
                    {
                        $('.emailcode-error').hide();
                        $('#check_mail_code').modal('hide');
                        $('#notify_award_fail').modal('show');
                        popwindowactive = false;
                    }
                    else
                    {
                        $('.emailcode-error').hide();
                        $('#check_mail_code').modal('hide');
                        $('#not_kgt_part_no').modal('show');
                        popwindowactive = false;
                    }
                }
            });
            $('#emailVerificationCode').removeClass('boarder_red');
        }
        else
        {
            $('.emailcode-error').show();
            $('.emailcode-error').html('please enter the verification code before proceeding');
            $('#emailVerificationCode').addClass('boarder_red');

        }
    });
    $('#claim_award_button').click(function() {
        clock1.reset();
        var str = $('#claim_award_countries_title').find('img').attr('class');
   
        var flag = str.split(' ');
        $.cookie="flag="+flag[1];
        var claim_award_salutation = $('#salutation').val();
        var claim_award_name = $('#claim_award_name').val();
        var claim_award_country = $('#claim_award_country').val();

        var claim_award_country = $('#claim_award_countries_title').find('.ddlabel').html();
        $('#claim_award_countries_title1').val(claim_award_country);

        var claim_award_telephone = $('#claim_award_telephone').val();
        var claim_award_email = $('#claim_award_email').val();
        var claim_award_passport_id = $('#claim_award_passport_id').val();
        var imgInp2 = $('#imgInp2').val();
        var claim_award_address = $('#claim_award_address').val();
        var claim_award_occupation = $('#claim_award_occupation').val();
        var claim_award_product_supplier = $('#claim_award_product_supplier').val();
        var imgInp1 = $('#imgInp1').val();
        var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
        var claim_award_error_flag = 0;

        if (claim_award_salutation == '')
        {
            $('#claim_award_salutation').addClass('boarder_red');
            claim_award_error_flag = 1;
        }
        else
        {
            $('#claim_award_salutation').removeClass('boarder_red');
        }
        if (claim_award_name == '')
        {
            $('#claim_award_name').addClass('boarder_red');
            claim_award_error_flag = 1;
        }
        else
        {
            $('#claim_award_name').removeClass('boarder_red');
        }
        if (claim_award_country == '')
        {
            $('#claim_award_country').addClass('boarder_red');
            claim_award_error_flag = 1;
        }
        else
        {
            $('#claim_award_country').removeClass('boarder_red');
        }
        if (claim_award_telephone == '')
        {
            $('#claim_award_telephone').addClass('boarder_red');
            claim_award_error_flag = 1;
        }
        else
        {
            $('#claim_award_telephone').removeClass('boarder_red');
        }
        if (claim_award_email == '' || (reg.test(claim_award_email) == false))
        {
            $('#claim_award_email').addClass('boarder_red');
            claim_award_error_flag = 1;
        }
        else
        {
            $('#claim_award_email').removeClass('boarder_red');
        }
        if (claim_award_passport_id == '')
        {
            $('#claim_award_passport_id').addClass('boarder_red');
            claim_award_error_flag = 1;
        }
        else
        {
            $('#claim_award_passport_id').removeClass('boarder_red');
        }
        if (imgInp2 == '')
        {
            $('#blah_imgInp2').addClass('boarder_red');
            claim_award_error_flag = 1;
        }
        else
        {
            $('#blah_imgInp2').removeClass('boarder_red');
        }
        if (claim_award_address == '')
        {
            $('#claim_award_address').addClass('boarder_red');
            claim_award_error_flag = 1;
        }
        else
        {
            $('#claim_award_address').removeClass('boarder_red');
        }
        if (claim_award_occupation == '')
        {
            $('#claim_award_occupation').addClass('boarder_red');
            claim_award_error_flag = 1;
        }
        else
        {
            $('#claim_award_occupation').removeClass('boarder_red');
        }
        if (claim_award_product_supplier == '')
        {
            $('#claim_award_product_supplier').addClass('boarder_red');
            claim_award_error_flag = 1;
        }
        else
        {
            $('#claim_award_product_supplier').removeClass('boarder_red');
        }
        if (imgInp1 == '')
        {
            $('#blah_imgInp1').addClass('boarder_red');
            claim_award_error_flag = 1;
        }
        else
        {
            $('#blah_imgInp1').removeClass('boarder_red');
        }

        if (claim_award_error_flag == 0)
        {
            //var formData = new FormData($('#claim_award_form'));
            //alert($('#serial_number').val());
            $('#claim_award_winning_number_data').html($('#serial_number').val());
            $('#claim_award_salutation').html($('#salutation').val());
            $('#claim_award_data_name').html($('#claim_award_name').val());
            $('#claim_award_data_country').html($('#claim_award_countries_title').html());
            $('#claim_award_data_telephone').html($('#claim_award_telephone').val());
            $('#claim_award_data_email').html($('#claim_award_email').val());
            $('#claim_award_data_passport_id').html($('#claim_award_passport_id').val());
            $('#claim_award_data_address').html($('#claim_award_address').val());
            $('#claim_award_data_occupation').html($('#claim_award_occupation').val());
            $('#claim_award_data_product_supplier').html($('#claim_award_product_supplier').val());                        
            $('#img-preview1').html($('.filepreview').html());            
            $('#img-preview2').html($('.filepreview1').html());            
            //alert($(".imagepreview img").height());            
            $(".imagepreview img").height(300).width(500).css({
                "margin-left":"2%"
            });
            $("iframe").height(300).width(500).css({
                "margin-left":"2%"
            });
            
            //          $('#img-preview1 img').css({          
            //                "background-size": "80px 80px"
            //            });
        
            $('#claim_award').modal('hide');
            $('#claim_award_data').modal('show');
            popwindowactive = true;
            
            
            $('#timer3').html('');
            var url =  "promotion/get_timer_award";
            var postData = {
                value:'preview'
            };
            $.post(url, postData, function(data) {
                //$('#promotion_preview_msg').html(data[0]['award_preview_msg']);
                //$('#promotion_preview_msg').hide();
                var time = data[0]['award_preview_timer']*60;
                clock2 = $('#timer3').FlipClock(time, {
                    clockFace: 'HourCounter',
                    countdown: true,
                    callbacks: {
                        stop: function() {
                            promotiontimerCountdownComplete();
                        }
                    }
                });
            },'JSON');

        }


    });
    $('#claim_award_data_button').click(function() {
        clock2.reset();
        $('#claim_award_form').submit();
    });
    $('#block_confirm_msg').click(function() {
        $.ajax({
            type: "POST",
            url: "promotion/clearSession",
            data: '',
            beforeSend: function() {
            //	   alert('asa');
            // $("#show_class").show();
            // $("#show_class").html("Loading ...");
            },
            success: function(msg) {
            //alert('asa');
            }
        });

    });

    $('#backtoconfirmpage').click(function() {
        clock2.reset();
        $('#claim_award_data').modal('hide');
        $('#claim_award').modal('show');
        $("iframe").height(300).width(500).css({
            "margin-left":"5%"
        });
        $(".imagepreview img").height(300).width(500).css({
            "margin-left":"5%"
        });
        popwindowactive = true;
        $('#promotiontimer').html('');
        var url =  "promotion/get_timer_award";
        var postData = {
            value:'main'
        };
        $.post(url, postData, function(data) {
            $('#award_preview_msg').html(data[0]['main_award_msg']);
            $('#award_preview_msg').hide();
            var time = data[0]['main_award_timer']*60;
            clock1 = $('#promotiontimer').FlipClock(time, {
                clockFace: 'HourCounter',
                countdown: true,
                callbacks: {
                    stop: function() {
                        promotiontimerCountdownComplete();
                    }
                }
            });
        },'JSON');
    });
});
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
            //blah_imgInp1
            $('#blah_' + input.id).attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}
function ClaimAwardForm()
{

    var url =  "promotion/get_timer_award";
    var postData = {
        value:'main'
    };
    $.post(url, postData, function(data) {
        $('#award_preview_msg').html(data[0]['main_award_msg']);
        $('#award_preview_msg').hide();
        var time = data[0]['main_award_timer']*60;
        clock1 = $('#promotiontimer').FlipClock(time, {
            clockFace: 'HourCounter',
            countdown: true,
            callbacks: {
                stop: function() {
                    promotiontimerCountdownComplete();
                }
            }
        });
    },'JSON');
    
 
    $('#notify_award_w0n').modal('hide');
    $('#claim_award').modal('show');
    popwindowactive = true;
    
}
var countdowninstance = 0;
var closedinstance = 0;
function runCountDownClock(targetdiv, new_time)
{
    
    countdowninstance++;
    
    myCountdown3 = new Countdown({
        time: new_time,
        width: 100,
        height: 40,
        rangeHi  : "hour",
        rangeLo  : "second", // <- no comma on last item!
        style: "flip",
        target: targetdiv,
        onComplete: countdownComplete
    });
}
function runCountDownClock1(targetdiv, new_time)
{
    $('#' + targetdiv).html('');
    countdowninstance++;
    //    myCountdown3 = new Countdown({
    //        time: new_time,
    //        width: 100,
    //        height: 40,
    //        rangeHi  : "hour",
    //        rangeLo  : "second", // <- no comma on last item!
    //        style: "flip",
    //        target: targetdiv,
    //        onComplete: countdownComplete1
    //    });
    clock = $('#' + targetdiv).FlipClock(new_time, {
        clockFace: 'HourCounter',
        countdown: true,
        callbacks: {
            stop: function() {
                promotiontimerCountdownComplete();
            }
        }
    });
}
function countdownComplete1()
{
    $('#check_mail_code').modal('hide');
    var blockMsg = "Unfortunately, you did not enter the correct code within the given lead-time.  Therefore, you will be welcome to use an alternative email or wait for 120 minutes to use the current email "+$('#email').val()+" within our website.";
    $('#blockMsg').html(blockMsg);
    $('#blockMsg1').html("");
    //$('#blockMsg1').html("Your email ("+msg+") will be usuable in our website only after 120 mniutes");

    $('#user_block_box').modal('show');


}
function runCountDownClock_awards(targetdiv, new_time)
{

    $('#' + targetdiv).html('');
    if (new_time == '')
    {
        var new_time = 600;  //10*60  seconds
    }
    countdowninstance++;
    myCountdown3 = new Countdown({
        time: new_time,
        width: 100,
        height: 40,
        rangeHi: "minute", // <- no comma on last item!
        style: "flip",
        target: targetdiv,
        onComplete: countdownComplete_awards
    });
}

function countdownComplete_awards()
{

    $('#notify_submit').modal('hide');
    var blockMsg = "Unfortunately, you did not enter the correct code within the given lead-time.  Therefore, you will be welcome to use an alternative email or wait for 120 minutes to use the current email "+$('#email').val()+" within our website.";
    $('#blockMsg').html(blockMsg);
    $('#blockMsg1').html("");
    $('#user_block_box').modal('show');

}

function promotiontimerCountdownComplete()
{
   
    var email = $('#claim_award_email').val();
    var name = $('#claim_award_name').val();            
    var contact = $('#claim_award_telephone').val();
    var country = $('#claim_award_countries_title').find('.ddlabel').html();
    if(email == '')
        email = $('#email').val();
            
            
    $.ajax({
        type: "POST",
        url: "promotion/award_timeout_block",
        data: {
            'email':email,
            'name':name,
            'country':country,
            'contact':contact
        },               
        success: function(msg) {
            $('#claim_award').modal('hide');
            $('#claim_award_data').modal('hide');
            $('#enter_user_details').modal('hide');
            $('#check_mail_code').modal('hide');
            $('#user_block_box').modal('show');
            //var blockMsg = "Unfortunately, you did not take any action within the given lead-time.  Therefore, you will be welcome to use an alternative email or wait for 120 minutes to use the current email "+email+" within our website.";
           
            $.ajax({
                type: "POST",
                url: "promotion/getAwardMsg",
                success: function(data){
                    data = JSON.parse(data)
                    var blockMsg = data[0].verification_timeout.replace(/PHRASE/g,email);
                    $('#blockMsg').html(blockMsg);
                    popwindowactive = false;  
                }
            });
           
            
           
        }

    });

}

function countdownComplete()
{

    var verificationtimeOut = 0;
    if (typeof closedinstance == "undefined")
        var closedinstance = 0;
    if (typeof countdowninstance == "undefined")
        var countdowninstance = 1;
    if (typeof popwindowactive == "undefined")
    {
        var popwindowactive = true;
        verificationtimeOut = 1;
    }


    closedinstance++;
    var email = '';
    if (countdowninstance == closedinstance && popwindowactive == true)
    {
        if (verificationtimeOut == 1)
        {
            $('#notify_submit').modal('hide');
            //$('#blockMsg').html('Unfortunately you did not take any action during the given time therefore please go back to cart and use another email address to send us your request for quotation.  Thank you');
            var blockMsg = "Unfortunately, you did not take any action within the given lead-time.  Therefore, you will be welcome to use an alternative email or wait for 120 minutes to use the current email "+$('#email').val()+" within our website.";
           alert(blockMsg)
           $('#blockMsg').html(blockMsg);
            $('#blockMsg1').html("");
            //$('#blockMsg1').html("Your email ("+msg+") will be usuable in our website only after 120 mniutes");

            $('#user_block_box').modal('show');
            popwindowactive = false;
        }
        else
        {
            $('#claim_award').modal('hide');
            $('#claim_award_data').modal('hide');
            $('#enter_user_details').modal('hide');
            $('#check_mail_code').modal('hide');
            $('#user_block_box').modal('show');
            var blockMsg = "Unfortunately, you did not take any action within the given lead-time.  Therefore, you will be welcome to use an alternative email or wait for 120 minutes to use the current email "+$('#email').val()+" within our website.";
           alert(blockMsg+'testtest')
           $('#blockMsg').html(blockMsg);
            popwindowactive = false;
        }

    }
//myCountdown3.cancel();

}

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
            //blah_imgInp1
            $('#blah_' + input.id).attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}