<script type="text/javascript">
    var clock;
    var base_url = '<?php echo base_url(); ?>';
    function doneHandler(result) {

        //alert('sdf');

        $.ajax({
            type: "POST",
            url: "promotion/user_block/5",
            data: "",
            beforeSend: function() {

                //	      $(".show_class").html("Loading ...");

            },
            success: function(msg) {

                //		  alert(msg);

                if (msg == 'block') {

                    $('#notify_submit').modal('hide');

                    $('#modal_block').modal('show');

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
            clock.reset();
            window.location.href = "promotion";

            return false;

        });



        $('#block_bttn').click(function() {
            clock.reset();
            window.location.href = "promotion";

            return false;

        });



        $('#cancel_form').click(function() {
            clock.reset();
            $.ajax({
                type: "POST",
                url: "promotion/get_cancel_form1",
                data: "form=promotion",
                beforeSend: function() {

                    $(".show_class").html("Loading ...");

                },
                success: function(msg) {

                    //  alert(msg);

                    $(".show_class").html('');

                    if (msg == 'success') {

                        //alert('We sent a varification code.Please Check Your mail.');

                        window.location.href = "promotion";

                    }

                    //$(".show_error").html(msg);			

                }

            });

            return false;

        });


        var resend_attempt = 1;
        $('#resend_mail').click(function(e) {
            if (resend_attempt < 4)
            {
                
                $.ajax({
                    type: "POST",
                    url: "promotion/get_send_mail1/" + resend_attempt,
                    data: "form=promotion",
                    beforeSend: function() {

                        $(".show_class").html("Loading ...");

                    },
                    success: function(msg) {

                        //  alert(msg);

                        $(".show_class").html('');

                        if (msg == 'success') {

                            //alert('We sent a varification code.Please Check Your mail.');
                            $(".show_error").html('Resend Attempt:#' + resend_attempt + ' . Try again');
                            resend_attempt++;
                            $(".show_class").html('We sent a verification code. Please Check Your mail.');

                        }else{
                            contact_userblock();
                            $("#notify_submit").modal('hide');
                            $("#modal_block1").modal('show');
                        }

                    }

                });
            }
            else
            {
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url:"promotion/user_block/3",
                    data: "",
                    beforeSend: function() {
                        $(".show_class").html("Loading ...");
                    },
                    success: function(msg) {
                        $("#notify_submit").modal('hide');
                        $("#modal_block1").modal('show');	
                    }
                });
               
            }
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
                url: "promotion/get_verify1",
                data: "form=promotion&code=" + view,
                beforeSend: function() {

                    $(".show_class").html("Loading ...");

                },
                success: function(msg) {

                    //  alert(msg);

                    $(".show_class").html('');

                    if (msg == 'success') {

                        $('#notify_submit').modal('hide');

                        $('#modal_success').modal('show');
                        clock.reset();
                        //alert('Thank you for proving that you are human. Now you can proceed to the screening interview. Good luck!');				

                    }

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
            contact_userblock();
            $("#notify_submit").modal('hide');
            $("#modal_block2").modal('show');
        }

        return false;

    }
    function contact_userblock()
    {
        var url = base_url+"promotion/user_block/2";
        $.ajax({
            type: "POST",
            url:url,
            data: "",
            beforeSend: function() {
                $(".show_class").html("Loading ...");
            },
            success: function(msg) {
                $("#notify_submit").modal('hide');
                $("#modal_block1").modal('show');	
            }
        });
    }

</script>
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
    $(document).ready(function() {
        blink(1);
    });
</script>
<!--
<style type="text/css">

    @media screen and (max-width: 320px) {

        .toyota-page .col-xs-4{margin-bottom: 10px; text-align: center; width: 100%}

        .toyota-page .col-xs-4 a{width: 100%}

    }

</style>
-->




<div>
    <div class="container">
        <div class="main-page">
            <div class="car-lists">
                <div class="form-fill-cart">

                    <div class="row">

                        <div class="col-md-6">                            
                        </div>	        				

                    </div>

                </div>	        		

            </div>

        </div><!--End content-->

    </div>



    <div class="modal fade" id="notify_submit">

        <div class="modal-dialog">

            <div class="modal-content">

                <div class="modal-body">

                    <div class="box-content-modal">

                        <form method="post" id="target" onsubmit="return show(this)">

                            <h2 class="title-modal" style="text-decoration:none; text-transform: inherit;">We sent a verification code to : <?php echo $user_email; ?></h2>		

                            <div class="show_error blink" style="color:#F00;color: gray;" >&nbsp;</div>

                            <div class="alert-message block-message warning col-md-12" style="text-align:center;color:red;">
                                <div class="product_counter_msg counter_msg_wrap verfication_error_msg" > </div>
                            </div>
                            
                            <div class="">
                            <div class="col-md-6 col-sm-12 col-xs-12"><label><?php echo lang('Please enter the code:') ?> <input type="text" name="code" required></label></div>	

                            <div class="col-md-6 col-sm-12 col-xs-12">
                                <div id="timer"></div>
                            </div>
                            </div>
                            

                            <div class="clearfix"></div>

                            <div class="show_class" style="text-align:center;color:red;"></div>



                            <div class="btn-modal toyota-page">

                                <div class="row">

                                    <div class="col-xs-4 col-md-4 text-center">

                                        <input type="submit" class="btn btn-primary btn-sm" value="Confirm"> 

                                    </div>

                                    <div class="col-xs-4 col-md-4 text-center">

                                        <a href="#" id="resend_mail" class="btn btn-primary btn-sm"><?php echo lang('resend') ?> <i class="glyphicon glyphicon-chevron-right"></i></a>	

                                    </div>

                                    <div class="col-xs-4 col-md-4 text-center">

                                        <a href="#" id="cancel_form" class="btn btn-primary btn-sm"><?php echo lang('cancel') ?> <i class="glyphicon glyphicon-chevron-right"></i></a>		

                                    </div>

                                </div>	        				

                            </div>

                        </form>

                    </div>

                </div>
            </div><!-- /.modal-content -->

        </div><!-- /.modal-dialog -->

    </div>



    <div class="modal fade" id="modal_success">

        <div class="modal-dialog">

            <div class="modal-content">            

                <div class="modal-body">

                    <div class="box-content-modal">

                        <h2 class="title-modal"><?php echo $promotion_message[0]['secondThank_you_header']; ?></h2>	

                        <p><?php echo $promotion_message[0]['secondThank_you_msg']; ?></p>		

                        <div class="clearfix"></div>

                        <div class="btn-modal">



                            <a style="float:right" href="javascript:void(0)" id="ok_bttn" onClick="$('#modal_success').modal('hide')" class="btn btn-primary btn-sm"><?php echo lang('OK') ?>	 <i class="glyphicon glyphicon-chevron-right"></i></a>	

                        </div>

                    </div>

                </div>

            </div><!-- /.modal-content -->

        </div><!-- /.modal-dialog -->

    </div>

    <div class="modal fade" id="modal_block">
        <div class="modal-dialog">
            <div class="modal-content">               
                <div class="modal-body">
                    <div class="box-content-modal">
                        <h2 class="title-modal blink">Warning:</h2>
                        <p><?php  echo preg_replace('/\bPHRASE\b/', $user_email, $promotion_message[0]['verification_timeout']); ?></p>
                        <div class="clearfix"></div>
                        <?php
                        $user_data = $this->session->userdata('user_promotion_data');
                        $promotion_url = base_url() . "promotion/promotion_form/" . $user_data['promotion_id'];
                        ?>
                        <div class="btn-modal"> <a style="float:right" href="javascript:void(0)" onClick="$('#modal_block1').modal('hide');
                                                       window.location.href = '<?php echo $promotion_url ?>'" class="block_bttn1 btn btn-primary btn-sm">OK <i class="glyphicon glyphicon-chevron-right"></i></a> </div>
                    </div>
                </div>              
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>              



    <div class="modal fade" id="modal_block1">
        <div class="modal-dialog">
            <div class="modal-content">           
                <div class="modal-body">
                    <div class="box-content-modal">
                        <h2 class="title-modal blink">Warning:</h2>
                        <p><?php  echo preg_replace('/\bPHRASE\b/', $user_email, $promotion_message[0]['resend_block_msg']); ?></p>
                        <div class="clearfix"></div>
                        <?php
                        $user_data = $this->session->userdata('user_promotion_data');
                        $promotion_url = base_url() . "promotion/promotion_form/" . $user_data['promotion_id'];
                        ?>
                        <div class="btn-modal"> <a style="float:right" href="javascript:void(0)" onClick="$('#modal_block1').modal('hide');
                                                       window.location.href = '<?php echo $promotion_url ?>'" class="block_bttn1 btn btn-primary btn-sm">OK <i class="glyphicon glyphicon-chevron-right"></i></a> </div>
                    </div>
                </div>             
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <div class="modal fade" id="modal_block2">
        <div class="modal-dialog">
            <div class="modal-content">               
                <div class="modal-body">
                    <div class="box-content-modal">
                        <h2 class="title-modal blink">Warning:</h2>
                        <p><?php  echo preg_replace('/\bPHRASE\b/', $user_email, $promotion_message[0]['error_code_block_msg']); ?></p>
                        <div class="clearfix"></div>
                        <?php
                        $user_data = $this->session->userdata('user_promotion_data');
                        $promotion_url = base_url() . "promotion/promotion_form/" . $user_data['promotion_id'];
                        ?>
                        <div class="btn-modal"> <a style="float:right" href="javascript:void(0)" onClick="$('#modal_block1').modal('hide');
                                                       window.location.href = '<?php echo $promotion_url ?>'" class="block_bttn1 btn btn-primary btn-sm">OK <i class="glyphicon glyphicon-chevron-right"></i></a> </div>
                    </div>
                </div>               
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    </div>
    <script type="text/javascript">

        var url =  "promotion/get_timer";
        var postData = {
            value:'verify'
        };
        $.post(url, postData, function(data) {
            var time = data[0]['promotion_popup_timer']*60;

            clock = $('#timer').FlipClock(time, {
                clockFace: 'HourCounter',
                countdown: true,
                callbacks: {
                    stop: function() {
                        doneHandler(true);
                    }
                }
            });
        },'JSON');
    </script>