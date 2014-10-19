$(document).ready(function() {

    $('#notify_submit').modal('show');

    $('#ok_bttn').click(function() {

        window.location.href = "career/interview";

        return false;

    });



    $('.block_bttn').click(function() {

        window.location.href = "career";

        return false;

    });



    $('#cancel_form').click(function() {

        $.ajax({
            type: "POST",
            url: "career/get_cancel_form",
            data: "code=1",
            beforeSend: function() {

                $(".show_class").html("Loading ...");

            },
            success: function(msg) {

                $(".show_class").html('');

                if (msg == 'success') {

                    window.location.href = "career";

                }

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
                url: "career/get_send_mail/" + resend_attempt,
                data: "code=1",
                beforeSend: function() {

                    $(".show_class").html("Loading ...");

                },
                success: function(msg) {

                    //  alert(msg);

                    $(".show_class").html('');

                    if (msg == 'success') {

//                        alert('We sent a varification code.Please Check Your mail.');
                        $(".show_error").html('Resend Attempt:#' + resend_attempt + ' . Try again');
                        $(".show_class").html('We sent a verification code. Please Check Your mail.');
                        resend_attempt++;
                    }

                }

            });
        }
        else {
            
             if(typeof clock !== "undefined")
                clock.reset();
            
            career_userblock();
            $('#notify_submit').modal('hide');

            $('#modal_block_email_sent').modal('show');
        }

        return false;

    });

});

function show(form) {

    var view = form.code.value;

    $.ajax({
        type: "POST",
        url: "career/get_verify",
        data: "code=" + view,
        beforeSend: function() {

            $(".show_class").html("Loading ...");

        },
        success: function(msg) {

            $(".show_class").html('');

            if (msg == 'success') {

                $('#notify_submit').modal('hide');

                $('#modal_success').modal('show');

            }

            else if (msg == 'redirect') {

                $('#notify_submit').modal('hide');

                $('.modal_block').modal('show');

            }

            $(".show_error").html(msg);

        }

    });

    return false;

}





function blockHandler(result) {
    $.ajax({
        type: "POST",
        url: "career/set_block_user",
        data: "form=career",
        beforeSend: function() {

        },
        success: function(msg) {

            if (msg == 'success') {

                $('#notify_submit').modal('hide');

                $('#modal_block_timeout').modal('show');

            }

        }

    });

    return false;

}

function career_userblock()
{
    var url = "career/set_block_user_sent_email";
    $.post(url,function(){
        
        
    },"text");
    
    
    
}