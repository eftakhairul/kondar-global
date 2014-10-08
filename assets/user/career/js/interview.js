function show(form) {

    var view = form.answer.value.length;

    if (view < size) {
        //alert(kk);
        //alert(warning_qus1_msg);
        $('#text_msge').text(warning_qus1_msg);

        $('#modal_text').modal('show');



        //alert('Please type '+size+' minimum words.');

        return false;

    }

}



function countChar(val) {

    var len = val.value.length;

    if (len >= size) {

        $('#charNum').text('');

    } else {

        $('#charNum').text(size - len + ' characters remaining');

    }

}
;









$(document).ready(function() {

    $('#modal_success').modal('show');


    setTimeout(function() {
        $('.modal,fade').animate({
            scrollTop: $(".modal input[type='submit']").offset().top
        }, 2000);
        $("textarea").focus();
    }, 1000);




    $('#ok_bttn').click(function() {

        window.location.href = "career/index";

        return false;

    });

})





$(document).ready(function() {


    $('.block_bttn').click(function() {

        window.location.href = "career";

        return false;

    });

    $('#check_bttn').click(function() {

        //		window.location.href = "career/index";

        return false;

    });

});



function blockHandler(result) {

    var id = $("#question_id").val();

    $.ajax({
        type: "POST",
        url: "career/set_next_question",
        data: "id=" + id,
        beforeSend: function() {

            //	      $(".show_class").html("Loading ...");

        },
        success: function(msg) {

            //  alert(msg);



                msg_split = msg.split("#**#");
                if (msg_split[0] == 'success') {
                    var block_msg = "Unfortunately, you did not perform necessary action within the given lead-time.  Therefore, you will be welcome to use an alternative email or wait for 120 minutes to use the current email " + msg_split[1] + " within our website. ";
                    $('.modal_block').modal('show');
                    $("#modal_alert").html(block_msg);
                }

                //alert('Sorry Time is over.You have been blocked for 120 minutes.');

        }

    });

    //alert('hello');

}







	