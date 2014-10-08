var clock;
var clock1;
$(document).ready(function() {
    //    $('#polyglotLanguageSwitcher').polyglotLanguageSwitcher({
    //        effect: 'fade',
    //        testMode: true,
    //        onChange: function(evt) {
    //            if (evt.selectedItem != "English")
    //            {
    //                $('#language_popup').modal('show');
    //                $("#polyglotLanguageSwitcher1 dl dt a span").html($("#polyglotLanguageSwitcher1 dl dd ul li:first-child a").html());
    //            }
    //            else
    //                return false;
    //        //alert("The selected language is: "+evt.selectedItem);
    //        }
    //    });

    $("#polyglotLanguageSwitcher1 dl dd ul li a ").click(function()
    {

        var language_selected 	= $.trim($("#polyglotLanguageSwitcher1 dl dt a span").find('img').attr('alt'));
			
        if(language_selected != 'English')
        {
				
            $("#language_popup").modal('show');
				
            $("#polyglotLanguageSwitcher1 dl dt a span").html($("#polyglotLanguageSwitcher1 dl dd ul li:first-child a").html());
            return false
        }
    });//
    $('.selectpicker').selectpicker();

});

    
function read_more(num) {
    var text = $("#read_more" + num).html();
    if (text == 'Less Information')
    {
        $("#read_more" + num).html('Read More>>');
        $("#read_data" + num).show();
        $("#hide_data" + num).toggle(200);
    }
    else
    {
        $(".hide_data").hide();
        $(".read_data").show();
        $("#read_data" + num).hide();
        $("#hide_data" + num).toggle(200);
        $(".read_more").html('Read More>>');
        $("#read_more" + num).html('Less Information');
    }
}

function startTime() {    
    var monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
    var dayNames = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];

    var today = new Date();
    var day = today.getDate();
    var month = today.getMonth();
    var year = today.getFullYear();
    var h = today.getHours();
    var m = today.getMinutes();
    var s = today.getSeconds();
    var week = today.getDay();

    /*(h < 12) ? time_t = "AM" : time_t = "PM";
     (h== 0) ?  h= 12 : h = h;
     (h > 12) ? h= h- 12 : h= h;*/
    // add a zero in front of numbers<10
    m = checkTime(m);
    s = checkTime(s);
    day = checkTime(day);
    //		month=checkTime(month);
    $('#dateActive').html(dayNames[week] + '. ' + monthNames[month] + ' ' + day + ', ' + year);
    $('#timeActive').html(h + '&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;' + m + '&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;' + s);

    var d = new Date();
    var utc = d.getTime() + (d.getTimezoneOffset() * 60000);

    //set VANCOUVER time
    var dubai = new Date(utc + (3600000 * '-7'));
    var day = dubai.getDate();
    var month = dubai.getMonth();
    var year = dubai.getFullYear();
    var h = dubai.getHours();
    var m = dubai.getMinutes();
    var s = dubai.getSeconds();
    var week = dubai.getDay();
    // add a zero in front of numbers<10
    m = checkTime(m);
    s = checkTime(s);
    day = checkTime(day);
    //month=checkTime(month);
    //$('#dateActive2').html(month+' '+day+', '+year);
    //$('#timeActive2').html(h+':'+m+':'+s);
    $('#dateActive2').html(monthNames[month] + ' ' + day + ', ' + year);
    $('#timeActive2').html(h + ':' + m + ':' + s + ', ' + dayNames[week]);

    //set londan time
    var dubai = new Date(utc + (3600000 * '+0'));
    var day = dubai.getDate();
    var month = dubai.getMonth();
    var year = dubai.getFullYear();
    var h = dubai.getHours();
    var m = dubai.getMinutes();
    var s = dubai.getSeconds();
    var week = dubai.getDay();
    // add a zero in front of numbers<10
    m = checkTime(m);
    s = checkTime(s);
    day = checkTime(day);
    //month=checkTime(month);
    //$('#dateActive1').html(month+' '+day+', '+year);
    //$('#timeActive1').html(h+':'+m+':'+s);
    $('#dateActive1').html(monthNames[month] + ' ' + day + ', ' + year);
    $('#timeActive1').html(h + ':' + m + ':' + s + ', ' + dayNames[week]);

    //set tunic time
    var dubai = new Date(utc + (3600000 * '+1'));
    var day = dubai.getDate();
    var month = dubai.getMonth();
    var year = dubai.getFullYear();
    var h = dubai.getHours();
    var m = dubai.getMinutes();
    var s = dubai.getSeconds();
    var week = dubai.getDay();
    // add a zero in front of numbers<10
    m = checkTime(m);
    s = checkTime(s);
    day = checkTime(day);
    //month=checkTime(month);
    $('#dateActive4').html(monthNames[month] + ' ' + day + ', ' + year);
    $('#timeActive4').html(h + ':' + m + ':' + s + ', ' + dayNames[week]);
    //$('#dateActive4').html(month+' '+day+', '+year);
    //$('#timeActive4').html(h+':'+m+':'+s);


    //set dubai time
    var dubai = new Date(utc + (3600000 * '+4'));
    var day = dubai.getDate();
    var month = dubai.getMonth();
    var year = dubai.getFullYear();
    var h = dubai.getHours();
    var m = dubai.getMinutes();
    var s = dubai.getSeconds();
    var week = dubai.getDay();
    // add a zero in front of numbers<10
    m = checkTime(m);
    s = checkTime(s);
    day = checkTime(day);
    //month=checkTime(month);
    //$('#dateActive3').html(month+' '+day+', '+year);
    //$('#timeActive3').html(h+':'+m+':'+s);
    $('#dateActive3').html(monthNames[month] + ' ' + day + ', ' + year);
    $('#timeActive3').html(h + ':' + m + ':' + s + ', ' + dayNames[week]);


    setTimeout(function() {
        startTime()
    }, 500);
}
function checkTime(i) {
    if (i < 10) {
        i = "0" + i;
    }
    return i;
}
$(function() {
    //startTime(); 
    });
$(document).ready(function() {
    $("#branch,#countries").msDropdown();
});
function show_error() {
    if (typeof clock !== 'undefined') {
        clock.reset();
    }
    $('#modal_block1').modal('show');
    $('.block_bttn1').click(function() {
        return false;
    });

}


function preview_state_block() {
    $.ajax({
        type: "POST",
        url: base_url+"contact/preview_state_block",
        data: "form=career",
        beforeSend: function() {
        //	      $(".show_class").html("Loading ...");
        },
        success: function(msg) {
            if (msg == 'success') {
                $('.modal.fade').modal('hide');
                if (typeof clock !== 'undefined') {
                    clock.reset();
                }
                $('#timeout_modal_block').modal('show');
            //alert('Sorry Time is over.You have been blocked for 120 minutes.');
            //window.location.href = "front/career";
            }
        }
    });
    return false;

}



$(document).ready(function() {
    //	$("#countries").msDropdown();
    //$("#branch").msDropdown();
    //	$('#modal_block').modal('show');

    $('#error_bttn').click(function() {
        $('#modal_error').modal('hide');
    });
    $('#send_form').click(function() {

        clock1.reset();
        var operation = $("input#operation").val();
        var name = $("input#name").val();
        var title = $("select#salutation").val();
        var country = $("select#countries").val();
        var countryflag = $("select#countries").find(':selected').attr('data-imagecss');
        var contact = $("input#contact_num").val();
        var msge = $("textarea#message").val();
        var branch = $("select#branch").val();
        var branchflag = $("select#branch").find(':selected').attr('data-imagecss');
        var design = $("input#designation").val();
        var email = $("input#email").val();
        var company = $("input#company").val();
        //	alert('<table><tr><td><strong>Name</strong></td><td>'+name+'</td></tr><tr><td><strong>Branch</strong></td><td>'+branch+'</td></tr><tr><td><strong>Country</strong></td><td>'+country+'</td></tr><tr><td><strong>Company</strong></td><td>'+company+'</td></tr><tr><td><strong>Designation</strong></td><td>'+design+'</td></tr><tr><td><strong>Telephone</strong></td><td>'+contact+'</td></tr><tr><td><strong>Email</strong></td><td>'+email+'</td></tr><tr><td><strong>Message</strong></td><td>'+msge+'</td></tr></table>');
        $.ajax({
            type: "POST",
            url: base_url + "contact/set_contact_form",
            data: "operation=" + operation + "&salutation=" + title + "&name=" + name + "&countryflag=" + countryflag + "&country=" + country + "&branchflag=" + branchflag + "&branch=" + branch + "&company=" + company + "&contact=" + contact + "&design=" + design + "&email=" + email + "&msge=" + msge,
            beforeSend: function() {
                $(".show_class").html("Loading ...");
            },
            success: function(msg) {
                //  alert(msg);
                //	alert(msg);
                $(".show_class").html('');
                if (msg == 'success') {
                    window.location.href = base_url + "contact/verify_contact";
                //alert('We sent a varification code.Please Check Your mail.');
                }
                else {
                    $('#modal_block').modal('hide');
                    $('#contact_form_error_msge').html(msg);
                    $('#modal_error').modal('show');
                }
            //$(".show_error").html(msg);			
            }
        });
        return false;
    });

    $('#edit_bttn').click(function(e) {
        e.preventDefault();
        clock1.reset();
        $('#modal_block').modal('hide');
        $('#contact_view_timer').html('');
        contact_timer('edit');
    });

    $("#myForm").submit(function(e) {
        e.preventDefault();
        clock.reset();
        var test = block_email_check();
        if(test == false){
            return false;
        }
        else{
            $('#countdownplace').html('');
            contact_view_timer();

            var url = base_url+"contact/put_data_session";
            var postData = {
                "email": $("input#email").val(),
                "country": $("select#countries").val(),
                "contact": $("input#contact_num").val(),
                "name": $("input#name").val()
            };
            $.post(url, postData, function() {

                }, "text");
            
            var name = $("input#name").val();
            var title = $("select#salutation").val();
            var country = $("select#countries").val();
            var contact = $("input#contact_num").val();
            var msge = $("textarea#message").val();
            var branch = $("select#branch").val();
            var design = $("input#designation").val();
            var email = $("input#email").val();
            var company = $("input#company").val();
            var countryflag = $("select#countries").find(':selected').attr('data-imagecss');
            var branchflag = $("select#branch").find(':selected').attr('data-imagecss');
            $('.show_data').html('<table><tr><td valign="top"><strong>Name</strong></td><td valign="top" style="padding-left: 9px;">' + title + '. ' + name + '</td></tr><tr><td valign="top"><strong>Branch</strong></td><td valign="top"  style="padding-left: 9px;"><i class="' + branchflag + '"></i>' + branch + '</td></tr><tr><td valign="top"><strong>Country</strong></td><td valign="top"  style="padding-left: 9px;"><i class="' + countryflag + '"></i>' + country + '</td></tr><tr><td valign="top"><strong>Company</strong></td><td valign="top"  style="padding-left: 9px;">' + company + '</td></tr><tr><td valign="top"><strong>Designation</strong></td><td valign="top"  style="padding-left: 9px;">' + design + '</td></tr><tr><td valign="top"><strong>Telephone</strong></td><td valign="top"  style="padding-left: 9px;">' + contact + '</td></tr><tr><td valign="top"><strong>Email</strong></td><td valign="top"  style="padding-left: 9px;">' + email + '</td></tr><tr><td valign="top"><strong>Message</strong></td><td valign="top"  style="padding-left: 9px;">' + msge + '</td></tr></table>');
            $('#modal_block').modal('show');
            return false;
        }
    });
});


function contact_timer(value)
{
    $("#countdownplace").html("");
    var url =  base_url+"contact/get_timer";
    var postData = {
        value:value
    };
    $.post(url, postData, function(data) {
        if(value=='edit'){
            $('#contact_msg').html(data[0]['contact_edit_msg']);
            $('#contact_msg').hide();
            var time = data[0]['contact_edit_timer']*60;
        }else{
            $('#contact_msg').html(data[0]['main_contact_msg']);
            $('#contact_msg').hide();
            var time = data[0]['main_contact_timer']*60;
        }
        clock = $('#countdownplace').FlipClock(time, {
            clockFace: 'HourCounter',
            countdown: true,
            callbacks: {
                stop: function() {
               
                    doneHandler('true');
                }
            }
        });
    }, "JSON");
}

function doneHandler(result) {
    //clock.reset();
    var email = $("#email").val();
    var name = $("#name").val();
    var country = $("select#countries").val();
    var contact = $("input#contact_num").val();
    
    var url = base_url + "contact/block_email_timeout";
    var postData = {
        "email": email,
        "name":name,
        "country":country,
        "contact":contact
    };
    $.ajaxSetup({
        "async":false
    });
    $.post(url, postData, function(msg) {
        if (msg == "success") {  
            $.ajax({
                type: "POST",
                url: "contact/get_contact_msg",
                success: function(data){
                    data = JSON.parse(data);
                    var block_msg = data[0].verification_timeout.replace(/PHRASE/g, email);
                    $("#timeout_msg").html("");
                    $("#timeout_msg").html(block_msg);
                    $("#block_email_timeout_modal").modal("show");
                }
            });
            
            
        //  var block_msg = "Unfortunately, you did not take any action on the contact us form during the given lead time. Therefore, you will be welcome to use an alternative email or wait for 120 minutes to use the current email "+email+" within our website.";
           
        }
    }, "text");
    $.ajaxSetup({
        "async":true
    });
    
}
function contact_view_timer()
{
    $("#contact_view_timer").html("");
    var url =  base_url+"contact/get_timer";
    var postData = {
        value:'preview'
    };
    $.post(url, postData, function(data) {
        $('#contact_preview_msg').html(data[0]['contact_preview_msg']);
        $('#contact_preview_msg').hide();
        var time = data[0]['contact_preview_timer']*60;
        clock1 = $('#contact_view_timer').FlipClock(time, {
            clockFace: 'HourCounter',
            countdown: true,
            callbacks: {
                stop: function() {
                    preview_state_block();
                }
            }
        });
    },'JSON');

}
$(document).ready(function() {

    $('.login_pop').click(function() {
        var name = $(this).children('span').text();
        $('.client_name').html(name);
        $('#client_section').modal('show');
        return false;
    });
    setTimeout(function() {
        $('#countries_msdd').show();
    }, 1000);
    
    $('.popuplogin').click(function(){
        //	alert('sss');
        var login_username = $.trim($('#login_username').val());
        var login_password = $.trim($('#login_password').val());
        var error_flag = 0;
        if(login_username=='')
        {
            $('#login_username').addClass('boarder_red');
            error_flag=1;
        }
        else
        {
            $('#login_username').removeClass('boarder_red');
        }
        if(login_password=='')
        {
            $('#login_password').addClass('boarder_red');
            error_flag=1;
        }
        else
        {
            $('#login_username').removeClass('boarder_red');
        }
        if(error_flag == 0)
        {
            $('#client_section').modal('hide');
            $('#login_redirect').modal('show');
        }
    });
});

function contact_userblock()
{
    $.ajax({
        type: "POST",
        url: base_url + "contact/user_block",
        data: "",
        beforeSend: function() {
            $(".show_class").html("Loading ...");
        },
        success: function(msg) {
        //	
        }
    });
}

/*
 * This function will evoke in the blur event of an email is given
 * to check whether this email address is already blocked or not
 */
function block_email_check() {
    var return_result_test = true;
    if ($("#countdownplace").html() == "") {
        contact_timer('main');
    }
    var email = $("#email").val();
    var url = base_url + "contact/block_email_check";
    var postData = {
        "email": email
    };
    $.ajaxSetup({
        "async":false
    });
    $.post(url, postData, function(msg) {
        if (msg == "no_block") {
            return_result_test = true;
        }
        else {
            var msg_split = msg.split("#**#");
            $.ajax({
                type: "POST",
                url: "contact/get_contact_msg",
                success: function(data){
                    data = JSON.parse(data)
                    var block_msg = data[0].blocked_email_msg.replace(/PHRASE/g,  msg_split[0]);
                    block_msg = block_msg.replace(/SECTION/g, msg_split[2]);
                    $("#block_message").html("");
                    $("#block_message").html(block_msg);
                    if (typeof clock !== 'undefined') {
                        clock.reset();
                    }
                    $("#block_email_check_modal").modal("show");
                    return_result_test = false;
                }
            });
          
          
        // var block_msg = "The email " + msg_split[0] + " is blocked in the section " + msg_split[2] + ". Therefore, please use an alternative email or wait " + msg_split[1] + " minutes to use this email again within our website. Thank you"
            
        }
    }, "text");
    $.ajaxSetup({
        "async":true
    });
    return return_result_test;
}