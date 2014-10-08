function doneHandler(result) {
    var id = $("#question_id").val();
    $.ajax({
        type: "POST",
        url: "career/set_next_question",
        data: "id=" + id,
        beforeSend: function() {
        // $(".show_class").html("Loading ...");
        },
        success: function(msg) {
            // alert(msg);
            msg_split = msg.split("#**#");
            if (msg_split[0] == 'success') {
                var block_msg = "Unfortunately, you did not perform necessary action within the given lead-time.  Therefore, you will be welcome to use an alternative email or wait for 120 minutes to use the current email " + msg_split[1] + " within our website. ";
                $('.modal_block').modal('show');
                $("#modal_alert").html(block_msg);
            }
        }
    });
// alert('hello');
}

$(document).ready(function() {
    $('#modal_success').modal('show');

    setTimeout(function() {
        $('.modal,fade').animate({
            scrollTop: $(".modal input[type='submit']").offset().top
        }, 2000);
    }, 1000);

    $('#ok_bttn').click(function() {
        window.location.href = "/career";
        return false;
    });

    $(document).on('change', 'input[type="file"]', function(event) {
        $(".filepreview").html("");
        $(".filepreview").append("<span class='blink'><span style='margin-left:10%'>Please wait we are generating preview ...</span></span>");
        
        blink(1);
        $.ajax("career/resume_form_upload", {
            files: $(":file"),
            iframe: true
        }).success(function(data) {
            if(data != '')
            {
                $("blink").remove();
                blink(0);
                $(".filepreview").addClass("notempty").html(data);
            }
        });

    });



})

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
