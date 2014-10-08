// JavaScript Document
var clock;
var clock1;
var clock2;
function cart_count()
{
    var rowCount = $('tr.cart_details_row').length;
    $('#menu_cart_id').html('Cart [' + rowCount + ']');

}

function str_repeat(input, multiplier) {
    return new Array(multiplier + 1).join(input);
}

function typeOf(obj) {
    if (!obj)
        return "null";
    if (typeof (obj) == 'object') {
        if (obj.length)
            return 'array';
        else
            return 'object';
    } else
        return typeof (obj);
}

function dump(arr, level) {

    if (!level)
        level = 0;

    // The padding given at the beginning of the line.
    var level_padding = str_repeat("  ", level);
    var dumped_text = level_padding + typeOf(arr) + "\n";
    for (var j = 0; j < level + 1; j++)
        level_padding += "    ";

    if (typeof (arr) == 'object') { // Array/Hashes/Objects
        dumped_text += level_padding + "{\n";
        for (var item in arr) {
            var value = arr[item];

            if (typeof (value) == 'object') { // If it is an array,
                dumped_text += level_padding + "     [" + item + "] =>";
                dumped_text += dump(value, level + 1);
            } else {
                dumped_text += level_padding + "     [" + item + "] => "
                        + value + "\n";
            }
        }
        dumped_text += level_padding + "}\n";
    } else { // Stings/Chars/Numbers etc.
        dumped_text = "==>" + arr + "<==(" + typeof (arr) + ")";
    }
    return dumped_text;
}

function alert_r(arr) {
    alert(dump(arr));
}


$(document).ready(function() {
    $("#cart_country").msDropdown({
        roundedBorder: false
    });

    if ($('.datetimepicker').length > 0) {
        $('.datetimepicker').datetimepicker({
            timepicker: false,
            format: 'Y-m-d',
            minDate: 0
        });
    }


    $("#cart_checkout").click(function(e) {
        if (typeof clock !== "undefined")
            clock.reset();
        var email = $("#cart_email").val();
        if (checkEmail($('#cart_email').val()) == false) {
            alert('Please Enter a valid email address');
            $('#cart_email').focus();
            return false;
        }
        var aa = $('#cart_country_title').find('img').attr('class');
        var str = aa.split(" ");
        $('input#country_flag').val(str[1]);
        $.ajax({
            type: "POST",
            url: "cart/cart_blockedemail_check",
            data: $('#cart_details_form').serialize(),
            success: function(msg) {

                var splitmail = msg.split('##*##');

                var block_time = splitmail[0];

                /*  var new__time = block_time/60;
                 $new__time = 120 - $new__time;*/
                if (splitmail[1] == '1')
                {
                    if (block_time < 7200)
                    {
                        $('#user_block_box').modal('show');
                        $('#blockMsg').html('The email ' + email + ' is blocked in the section ' + splitmail[2] + '. Therefore, please use an alternative email or wait ' + block_time + ' minutes to use this email again within our website. Thank you');
                        $('#blockMsg1').html("");
                    }
                    else
                    {
                        $("#button_checkings").val('submit');
                        validationandsubmit();
                        e.preventDefault();
                        e.stopPropagation();
                    }
                }
                else
                {
                    $("#button_checkings").val('submit');
                    validationandsubmit();
                    e.preventDefault();
                    e.stopPropagation();
                }

                /**/
            }
        });
        return false;
        //$("#cart_details_update").submit();
        //alert('sssss');
    });
    $("#cart_continue_shopping").click(function(e) {
        // clock.reset();
        $("#button_checkings").val('continue');
        validationandsubmit();
        e.preventDefault();
        e.stopPropagation();
        //$("#cart_details_update").submit();
        //alert('sssss');
    });
    $("#cart_back").click(function(e) {
        if (typeof clock !== "undefined")
            clock.reset();
        $("#button_checkings").val('back');
        validationandsubmit();
        e.preventDefault();
        e.stopPropagation();
        //$("#cart_details_update").submit();
        //alert('sssss');
    });
    //$(".minimize_block").click(function(){
    $('body').on('click', '.minimize_block', function() {
        var hideid = $(this).attr('id');
        if ($(this).val() == '+') {
            $(this).val('-');
            $('.' + hideid).show();
        } else {
            $(this).val('+');
            $('.' + hideid).hide();
        }
    });


    $("#submit_confirm_cart").click(function(e) {
        if (typeof clock !== "undefined")
            clock.reset();
        e.preventDefault();
        e.stopPropagation();
        $('.loaderimagecontinue').show();
        var cart_popup_timer, cart_popup_msg, cart_preview_timer;
        $.ajaxSetup({
            "async": false
        });
        var url = "cart/get_cart_pop_time";
        $.post(url, function(msg) {
            cart_popup_timer = msg.cart_popup_timer;
            cart_popup_msg = msg.cart_popup_msg;
            cart_preview_timer = msg.cart_preview_timer;
        }, "json");
        $.ajax({
            type: "POST",
            url: "cart/cart_verification_code",
            data: $('#cart_conifrm_form').serialize(),
            beforeSend: function() {
                //	   alert('asa');
                // $("#show_class").show();
                // $("#show_class").html("Loading ...");
            },
            success: function(msg) {
                $('.loaderimagecontinue').hide();
                $("#cart_pop_msg").html(cart_popup_msg);
                $("#cart_preview_timer").html(cart_preview_timer);
                $("#notify_submit").modal('show');
                runCountDownClock('timer11', cart_popup_timer);
                $('#email_attempt').val(1);

            }
        });
        $.ajaxSetup({
            "async": true
        });
    });
    $("#resend_email_code").click(function(e) {
        //$("#notify_submit").modal('hide');
        var email_attempt = $('#email_attempt').val();
        $("#ecart_verification_codemail").val('');
        $('.loaderimagecontinue').show();
        $('.emailcode-error').hide();
        e.preventDefault();
        e.stopPropagation();
        var ajax_url = "cart/cart_verification_code/" + email_attempt;
        $.ajax({
            type: "POST",
            url: ajax_url,
            data: $('#cart_conifrm_form').serialize(),
            beforeSend: function() {
                //	   alert('asa');
                // $("#show_class").show();
                // $("#show_class").html("Loading ...");
            },
            success: function(msg) {


                if (typeof email_attempt === "undefined")
                    email_attempt = 0;

                $('#email_attempt').val(parseInt(email_attempt) + 1);
                $('.loaderimagecontinue').hide();
                if (email_attempt >= 4)
                {
                    $("#notify_submit").modal('hide');
                    $('#user_block_box').modal('show');
                    /*			$('#blockMsg').html('You have been blocked because there were no response from your side, for security  resaon you will be able only allowed to use this email in our website only after 120 minutes');
                     $('#blockMsg1').html('You Have Been Blocked. Please Try After 120 minutes.');*/
                    //$('#blockMsg').html('Unfortunately you did not take any action during the given time therefore please go back to cart and use another email address to send us your request for quotation.  Thank you');
                    var message = $("#cartverification_resent_block_msg").html();
                    message = message.replace(/EMAILVAR/g, msg);
                    $('#blockMsg').html(message);
                    $('#blockMsg1').html("");
                    $("#edit_cart_mode_on").html("edit_cart_mode_on");
                    email_attempt = 0;
                }
                else
                {
                    $('.verfication_error_msg').html('Resend Attempt:#' + (parseInt(email_attempt)) + ' . Try again');
                    email_attempt++;
                    //$("#notify_submit").modal('show');
                }


            }
        });
    });
    $("#cart_verification_confirm").click(function(e) {
        $('.loaderimagecontinue').show();
        e.preventDefault();
        e.stopPropagation();
        $.ajax({
            type: "POST",
            url: "cart/save_cart_details",
            data: $('#cart_verification_form').serialize(),
            beforeSend: function() {
                //	   alert('asa');
                // $("#show_class").show();
                // $("#show_class").html("Loading ...");
            },
            success: function(msg) {
                $('.loaderimagecontinue').hide();
                var split_data = msg.split('##*##');
                msg = $.trim(split_data[0]);
                var email_attempt = $.trim(split_data[1]);
                var block_email = $.trim(split_data[2]);

                if (msg.indexOf("fail") == 0)
                {

                    if (email_attempt == '4')
                    {
                        $("#notify_submit").modal('hide');
                        $('#user_block_box').modal('show');
                        /*$('#blockMsg').html('You have been blocked because there were no response from your side, for security  resaon you will be able only allowed to use this email in our website only after 120 minutes');
                         $('#blockMsg1').html('You Have Been Blocked. Please Try After 120 minutes.');*/
                        //$('#blockMsg').html('Unfortunately you did not take any action during the given time therefore please go back to cart and use another email address to send us your request for quotation.  Thank you');
                        var message = $("#cartverification_wrong_block_msg").html();
                        message = message.replace(/EMAILVAR/g, block_email);
                        $('#blockMsg').html(message);
                        
                        //$('#blockMsg').html('Unfortunately, you entered wrong verification code during the 3 attempts. Therefore, you will be welcome to use an alternative email or wait for 120 minutes to use the current email ' + block_email + ' within our website.');
                        $('#blockMsg1').html("");
                        $("#edit_cart_mode_on").html("edit_cart_mode_on");
                    }
                    else
                    {
                        $('.emailcode-error').show();
                        $('.verfication_error_msg').html('Invalid verification code Attempt:#' + (parseInt(email_attempt)) + ' . Try again');
                        //$('.emailcode-error').html('Invalid verification code Attempt:#'+email_attempt+' . Try again');
                        $("#ecart_verification_codemail").addClass("boarder_red");
                    }
                }
                else
                {
                    $('.emailcode-error').hide();
                    $("#notify_submit").modal('hide');
                    $("#modal_success").modal('show');
                }
                //$("#notify_submit").modal('show');
            }
        });
    });


});

function validationandsubmit()
{

    if ($('#cart_surname').val() == '')
    {
        $('#modal_mssg').modal('show');
        $('#already_added_msg_title').html('Fill Empty Fields');
        $('#already_added_msg').html('Kindly fill in the required details into the cart before proceeding : <b>Name and Surname<b/>');
        $('#cart_surname').focus();
    }
    else if ($('#cart_company').val() == '')
    {
        $('#modal_mssg').modal('show');
        $('#already_added_msg_title').html('Fill Empty Fields');
        $('#already_added_msg').html('Kindly fill in the required details into the cart before proceeding : <b>Company<b/>');
        $('#cart_company').focus();
    }
    else if ($('#cart_address').val() == '')
    {
        $('#modal_mssg').modal('show');
        $('#already_added_msg_title').html('Fill Empty Fields');
        $('#already_added_msg').html('Kindly fill in the required details into the cart before proceeding : <b>Address<b/>');
        $('#cart_address').focus();
    }
    else if ($('#cart_designation').val() == '')
    {
        $('#modal_mssg').modal('show');
        $('#already_added_msg_title').html('Fill Empty Fields');
        $('#already_added_msg').html('Kindly fill in the required details into the cart before proceeding : <b>Designation<b/>');
        $('#cart_designation').focus();
    }
    else if ($('#cart_country').val() == '')
    {
        $('#modal_mssg').modal('show');
        $('#already_added_msg_title').html('Fill Empty Fields');
        $('#already_added_msg').html('Kindly fill in the required details into the cart before proceeding : <b>Country<b/>');
        $('#cart_country').focus();
    }
    else if ($('#cart_telephone').val() == '')
    {
        $('#modal_mssg').modal('show');
        $('#already_added_msg_title').html('Fill Empty Fields');
        $('#already_added_msg').html('Kindly fill in the required details into the cart before proceeding : <b>Telephone<b/>');
        $('#cart_telephone').focus();
    }
    else if ($('#cart_email').val() == '')
    {
        $('#modal_mssg').modal('show');
        $('#already_added_msg_title').html('Fill Empty Fields');
        $('#already_added_msg').html('Kindly fill in the required details into the cart before proceeding : <b>Email<b/>');
        $('#cart_email').focus();
    }
    else if ($('#cart_deadline').val() == '')
    {
        $('#modal_mssg').modal('show');
        $('#already_added_msg_title').html('Fill Empty Fields');
        $('#already_added_msg').html('Kindly fill in the required details into the cart before proceeding : <b>Deadline<b/>');
        $('#cart_deadline').focus();
    }
    else if (validatecartdate($('#cart_deadline').val()) == false)
    {
        $('#modal_mssg').modal('show');
        $('#already_added_msg_title').html('Invalid Date');
        $('#already_added_msg').html('Choose future dates only');
        $('#cart_deadline').focus();
    }
    else if ($('#incoterms').val() == '')
    {
        $('#modal_mssg').modal('show');
        $('#already_added_msg_title').html('Fill Empty Fields');
        $('#already_added_msg').html('Kindly fill in the required details into the cart before proceeding : <b>Incoterms<b/>');
        $('#incoterms').focus();
    }
    else
    {

        $("#cart_details_form").submit();
    }

}
function validatecartdate(datestr)
{
    var dateEntered = datestr.split('-');
    //var date = dateEntered.substring(0, 2);
    //var month = dateEntered.substring(3, 5);
    //var year = dateEntered.substring(6, 10);
    var date = dateEntered[2];
    var month = dateEntered[1];
    var year = dateEntered[0];

    var CurrentDate = new Date();
    var SelectedDate = new Date(year, month, date);
    if (CurrentDate > SelectedDate) {
        return false
    }
    else
    {
        return true
    }
}
function remove_cart(ele, id)
{
    var trhtml = '<tr class="cart_details_row_' + id + '"><td style="opacity:1;color:red;position:absolute;text-align:center;">Please wait....</div></tr>';

    $('tr.cart_details_row_' + id).css({'opacity': '0.4'});
    $('tr.cart_details_row_' + id + ':first').before(trhtml);
    $.ajax({
        type: "POST",
        url: "cart/removecart",
        data: 'id=' + id,
        beforeSend: function() {

        },
        success: function(msg) {
            //alert($(ele).parent().parent().html());
            var parenttable = $(ele).closest(".productsbytype");
            var numberofchildrows = $(parenttable).find('tr.cart_details_row');
            $(ele).parent().parent().parent().remove();
            if ($(numberofchildrows).length <= 1)
            {
                $(parenttable).remove();
            }
            if (!$('.cart_details_row').length)
            {
                $('#not_empty_cart').hide();
                $('#cart_buttons').hide();
                $('#empty_cart').show();
            }
            $('tr.cart_details_row_' + id).remove();


             var item_count = 1;
            $(".cart_item_count").each(function(){
                $(this).text(item_count);
                item_count++;
            });
            cart_count();
            //$('#decision_cart').modal('show');
        }
    });

}

function savecartblockdetails(time)
{
    if (typeof (time) === 'undefined')
        time = 86400;

    var user_email = $.trim($("#cart_email").val());
    $.ajax({
        type: "POST",
        url: "cart/savecartblockdetails",
        data: 'user_email=' + user_email,
        beforeSend: function() {
            //	   alert('asa');
            // $("#show_class").show();
            // $("#show_class").html("Loading ...");
        },
        success: function(msg) {

            var split_msg = msg.split('##*##');
            var block_flag = split_msg[1];
            var block_time = split_msg[0];

            $(".alert-message").show();

            if ($.trim(block_flag) == '1')
            {
                $('#user_block_box').modal('show');
                var message = $("#block_notification_msg").html();
                message = message.replace(/EMAILVAR/g, split_msg[3]);
                message = message.replace(/SECTIONVAR/g, split_msg[2]);
                message = message.replace(/TIMEVAR/g, split_msg[0]);
                $('#blockMsg').html(message);
                //$('#blockMsg').html('The email ' + split_msg[3] + " is blocked in the section " + split_msg[2] + ". Therefore, please use an alternative email or wait " + split_msg[0] + " minutes to use this email again within our website. Thank you");
                $('#blockMsg1').html('');
            }
            else if ($.trim(block_flag) == '2') {
                $('#user_block_box').modal('show');
                var message = $("#block_notification_msg").html();
                message = message.replace(/EMAILVAR/g, split_msg[3]);
                message = message.replace(/SECTIONVAR/g, split_msg[2]);
                message = message.replace(/TIMEVAR/g, split_msg[0]);
                $('#blockMsg').html(message);
                
                //$('#blockMsg').html('The email ' + split_msg[3] + " is blocked in the section " + split_msg[2] + ". Therefore, please use an alternative email or wait " + split_msg[0] + " minutes to use this email again within our website. Thank you");
                $('#blockMsg1').html('');
            }
            else
            {
                $(".alert-message").show();
                //                runCountDownClock('timer11',block_time*60);
                if ($("#timer11").html() == "")
                    runCountDownClock('timer11', time);
            }

        }
    });
}
//function check_user_block()
//{
//    $.ajax({
//        type: "POST",
//        url: "cart/check_cart_user_block", 
//        data:  '',
//        beforeSend: function () {
//        //	   alert('asa');
//        // $("#show_class").show();
//        // $("#show_class").html("Loading ...");
//        },
//        success: function(msg){
//			
//            var split_msg = msg.split('##*##');
//            if($.trim(split_msg[0]) =='1')
//            {
//                $('#user_block_box').modal('show');
//            }
//			
//        //$('#blockMsg').html('You have been blocked because there were no response from your side, for security  resaon you will be able only allowed to use this email in our website only after '+split_msg[1]+' minutes');
//        //$('#blockMsg1').html('You Have Been Blocked. Please Try After +'split_msg[1]'+ minutes.');
//        }
//    });
//}
function remove_all_items_from_cart()
{
    $.ajax({
        type: "POST",
        url: "cart/remove_all_items_from_cart",
        data: '',
        beforeSend: function() {
            //	   alert('asa');
            // $("#show_class").show();
            // $("#show_class").html("Loading ...");
        },
        success: function(msg) {
            //
        }
    });
}

function runCountDownClock(targetdiv, new_time)
{
    $('#' + targetdiv).html('');

    if (new_time == '')
    {
        var new_time = 600;  //10*60  seconds
    }
    clock = $('#' + targetdiv).FlipClock(new_time, {
        clockFace: 'HourCounter',
        countdown: true,
        callbacks: {
            stop: function() {
                countdownComplete();
            }
        }
    });
}
function countdownComplete()
{
    remove_all_items_from_cart();
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

    if (countdowninstance == closedinstance && popwindowactive == true)
    {
        if (verificationtimeOut == 1)
        {

            if ($('#notify_submit').hasClass('in')) {
                var msg = "";
                msg = $("#cartverification_block_msg").html();
                msg = msg.replace(/EMAILVAR/g, $("#cart_email").val());
                $("#edit_cart_mode_on").html("edit_cart_mode_on");
                $('#notify_submit').modal('hide');
                $('#blockMsg').html(msg);
                $('#blockMsg1').html("");

                $('#user_block_box').modal('show');
                //msg = 'Unfortunately, you did not enter the correct code within the given lead-time.  Therefore, you will be welcome to use an alternative email or wait for 120 minutes to use the current email '+$("#cart_email").val()+' within our website.';
            }
            else {
                var msg = "";
                msg = $("#maincart_block_msg").html();
                msg = msg.replace(/EMAILVAR/g, $("#cart_email").val());
                $('#notify_submit').modal('hide');
                $('#blockMsg_main_cart').html(msg);
                

                $('#main_cart_block_box').modal('show');
                //msg = 'Unfortunately, you did not finish shopping during the given lead-time.  Therefore, you will be welcome to use an alternative email or wait for 120 minutes to use the current email '+$("#cart_email").val()+' within our website.';
            }

            popwindowactive = false;

        }
        else
        {
            alert("ajob function is cart.js");
            $('#claim_award').modal('hide');
            $('#claim_award_data').modal('hide');
            $('#enter_user_details').modal('hide');
            $('#check_mail_code').modal('hide');
            $('#user_block_box').modal('show');
            msg = "";
            msg = $("#maincart_block_msg").html();
            msg = msg.replace(/EMAILVAR/g, $("#cart_email").val());
            $('#blockMsg').html(msg);
            $('#blockMsg1').html("");
            popwindowactive = false;
        }

    }
//myCountdown3.cancel();

}

function checkEmail(inputvalue) {
    var pattern = /^([a-zA-Z0-9_.-])+@([a-zA-Z0-9_.-])+\.([a-zA-Z])+([a-zA-Z])+/;
    if (pattern.test(inputvalue) == false) {
        return false;
    }
    else
        return true;
}