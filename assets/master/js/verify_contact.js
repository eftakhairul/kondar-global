var clock;
$(document).ready(function() {
    $('#polyglotLanguageSwitcher').polyglotLanguageSwitcher({
        effect: 'fade',
        testMode: true,
        onChange: function(evt) {
            alert("The selected language is: " + evt.selectedItem);
        }
    });
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
    startTime();
});
function doneHandler(result) {
    var url = base_url+"contact/user_block";
    $.ajax({
        type: "POST",
        url: url,
        data: "form=career",
        beforeSend: function() {
        //	      $(".show_class").html("Loading ...");
        },
        success: function(msg) {
            if (msg == 'success') {
                $('.modal').modal('hide');
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
    $('#notify_submit').modal('show');
    $('#ok_bttn').click(function() {
        window.location.href = base_url + "contact";
        return false;
    });

    $('#block_bttn').click(function() {
        clock.reset();
        var url =  base_url+"contact/get_timer";
        var postData = {
            value:'edit'
        };
        $.post(url, postData, function(data) {
            $('#contact_msg').html(data[0]['contact_edit_msg']);
            $('#contact_msg').hide();
            var time = data[0]['contact_edit_timer']*60;
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
        window.location.href = base_url + "contact";
        return false;
    });
    $('.block_bttn1').click(function() {
        clock.reset();
        return false;
    });
   
    $('#cancel_form').click(function() {
        clock.reset();
        $.ajax({
            type: "POST",
            url: base_url + "contact/get_cancel_form1",
            data: "form=contact",
            beforeSend: function() {
                $(".show_class").html("Loading ...");
            },
            success: function(msg) {
                //  alert(msg);
                $(".show_class").html('');
                if (msg == 'success') {
                    //alert('We sent a varification code.Please Check Your mail.');
                    window.location.href = base_url + "contact";
                }
            //$(".show_error").html(msg);			
            }
        });
        return false;
    });
    var resend_attempt = 1;

    $('#resend_mail').click(function() {
        
        if (resend_attempt < 4)
        {
            $.ajax({
                type: "POST",
                url: base_url + "contact/get_send_mail1/" + resend_attempt,
                data: "form=contact",
                beforeSend: function() {
                    $(".show_class").html("Loading ...");
                },
                success: function(msg) {

                    $(".show_class").html('');
                    if (msg == 'success') {
                        //alert('We sent a varification code.Please Check Your mail.');
                        $(".show_class").html('We sent a verification code. Please Check Your mail.');
                        $(".show_error").html('Resend Attempt:#' + resend_attempt + ' . Try again');
                        resend_attempt++;
                    }
                }
            });
        }
        else
        {
            contact_userblock(int_block = 3); //3 = '3 verif. codes sent'
            $("#notify_submit").modal('hide');
            if (typeof clock !== 'undefined') {
                clock.reset();
            }
            $("#modal_block1").modal('show');
        }
        $('#resend_attempt').val(resend_attempt);

        return false;
    });
});
var verification_attempt = 1;
function show(form) {
    var view = form.code.value;

    if (verification_attempt < 4)
    {
        $.ajax({
            type: "POST",
            url: base_url + "contact/get_verify1",
            data: "form=contact&code=" + view,
            beforeSend: function() {
                $(".show_class").html("Loading ...");
            },
            success: function(msg) {
                //  alert(msg);

                $(".show_class").html('');
                if (msg == 'success') {
                    $('#notify_submit').modal('hide');
                    if (typeof clock !== 'undefined') {
                        clock.reset();
                    }
                    $('#modal_success').modal('show');
                //alert('Thank you for proving that you are human. Now you can proceed to the screening interview. Good luck!');				
                }
                /*else if(msg=='redirect'){
                 
                 $('#notify_submit').modal('hide');	
                 $('#modal_block').modal('show');	
                 //alert('Sorry your email ID has been blocked for 120 minutes.');
                 }*/
                else
                {
                    //$(".verfication_error_msg").html('Resend Attempt:#'+verification_attempt +' . Try again');

                    msg = 'Your code is wrong. Attempt :#' + verification_attempt + ' . Try again';
                    verification_attempt++;
                }
                $(".show_error").html(msg);
            }
        });
    }
    else
    {
        contact_userblock(2); //int_block for 2 = '3 wrong verif. codes',
        $("#notify_submit").modal('hide');
        if (typeof clock !== 'undefined') {
            clock.reset();
        }
        $("#modal_block").modal('show');
    }
    return false;
}
var url = base_url+"contact/get_timer";
var postData = {
    value:'verify'
};
$.post(url, postData, function(data) {
    $('#contact_preview_msg').html(data[0]['contact_popup_msg']);
    $('#contact_preview_msg').hide();
    var time = data[0]['contact_popup_timer']*60;
    clock = $('#countdownplace').FlipClock(time, {
        clockFace: 'HourCounter',
        countdown: true,
        callbacks: {
            stop: function() {
                doneHandler(true);
            }
        }
    });
},'JSON');

    
$(document).ready(function() {
    $('.login_pop').click(function() {
        var name = $(this).attr('value');
        $('.client_name').html(name);
        $('#client_section').modal('show');
        return false;
    });
})
function contact_userblock(int_block)
{
    $.ajax({
        type: "POST",
        url: base_url + "contact/user_block",
        data: {
            'int_block':int_block
        },
        beforeSend: function() {
            $(".show_class").html("Loading ...");
        },
        success: function(msg) {
        //	
        }
    });
}