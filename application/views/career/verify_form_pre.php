<script type="text/javascript">
    var clock;
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
        blink(1);
    });
    
    $('#ok_button').click(function(){
        clock.reset();
    })
</script>
<div class="bodywrapper">
    <div class="container">
        <div class="main-page">
            <div class="car-lists">
                <div class="form-fill-cart">
                    <div class="row">
                        <div class="col-md-6"> </div>
                    </div>
                </div>
            </div>
        </div>
        <!--End content-->
    </div>
</div>
<div class="modal fade" id="notify_submit">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="box-content-modal">
                    <form action="" method="post" id="target" onsubmit="return show(this)">

                        <h2 style="text-decoration: none;text-transform: inherit;"  class="title-modal">We sent a verification code to : <?php echo $user_email; ?></h2>
                        <span class="blink"><div class="show_error" style="color:gray;"></div></span>

                        <div class="alert-message block-message warning">
                            <div class="product_counter_msg counter_msg_wrap verfication_error_msg"> </div>
                        </div>
                        <div>
                            <div class="col-md-6">
                                <label><?php echo lang('Please enter the code'); ?>:
                                    <input type="text" name="code" required autofacus>
                                </label>
                            </div>
                            <div class="col-md-6">
                                <div id="timer"></div>
                            </div>

                        </div>
                        <div class="clearfix"></div>
                        <div class="show_class" style="text-align: center;color:red;"></div>
                        <div class="btn-modal toyota-page">
                            <div class="row">
                                <div class="col-xs-4 col-md-4 text-center">
                                    <input type="submit" class="btn btn-primary btn-sm" value="Confirm">
                                </div>
                                <div class="col-xs-4 col-md-4 text-center"> <a href="#" id="resend_mail" class="btn btn-primary btn-sm"><?php echo lang('resend'); ?> <i class="glyphicon glyphicon-chevron-right"></i></a> </div>
                                <div class="col-xs-4 col-md-4 text-center"> <a href="javascript:void(0)" onClick="$('#notify_submit').modal('hide');document.location='<?php echo site_url('career') ?>'" id="cancel_form" class="btn btn-primary btn-sm"><?php echo lang('cancel'); ?> <i class="glyphicon glyphicon-chevron-right"></i></a> </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<div class="modal fade" id="modal_success">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="box-content-modal">
                    <?php /* ?> <h2 class="title-modal"><?php echo lang('THANK YOU');?></h2><?php */ ?>
                    <p><?php echo lang("Email's validity confirmed. Please proceed to the screening questions and upload your resume accordingly. Kindly, be prepared to answer the questions during the given time and type the minimum characters required without refreshing the browser's page. We wish you all the best."); ?></p>
                    <div class="clearfix"></div>
                    <div class="btn-modal"> <a style="float:right" href="javascript:void(0)" id="ok_bttn" onClick="$('#modal_success').modal('hide')" class="btn btn-primary btn-sm"><?php echo lang('OK'); ?> <i class="glyphicon glyphicon-chevron-right"></i></a> </div>
                </div>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<div class="modal fade modal_block">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="box-content-modal">
                    <span class="blink"><h2 class="title-modal">Warning</h2></span>
          <!--          <p><?php //echo lang('Sorry your email ID has been blocked for 120 minutes.');         ?></p>-->
                    <?php
                    $user_data = $this->session->userdata("user_interview_data");
                    ?>
                    <p id="block_message">Unfortunately, you entered wrong verification code during the 3 attempts. Therefore, you will be welcome to use an alternative email or wait for 120 minutes to use the current email <?php echo $user_data['email']; ?> within our website.</p>

                    <div class="clearfix"></div>
                    <div class="btn-modal"> <a style="float:right" href="javascript:void(0)" onClick="$('.modal_block').modal('hide');document.location='<?php echo site_url('career') ?>'" class="btn btn-primary btn-sm"><?php echo lang('OK'); ?> <i class="block_bttn glyphicon glyphicon-chevron-right"></i></a> </div>
                </div>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="modal_block_timeout">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="box-content-modal">
                    <span class="blink"><h2 class="title-modal">Warning</h2></span>
          <!--          <p><?php //echo lang('Sorry your email ID has been blocked for 120 minutes.');         ?></p>-->
                    <?php
                    $user_data = $this->session->userdata("user_interview_data");
                    ?>
                    <p id="block_message">Unfortunately, you did not enter the correct code within the given lead-time. Therefore, you will be welcome to use an alternative email or wait for 120 minutes to use the current email <?php echo $user_data['email']; ?> within our website.</p>

                    <div class="clearfix"></div>
                    <div class="btn-modal"> <a style="float:right" href="javascript:void(0)" onClick="$('.modal_block').modal('hide');document.location='<?php echo site_url('career') ?>'" class="block_bttn btn btn-primary btn-sm"><?php echo lang('OK'); ?> <i class="glyphicon glyphicon-chevron-right"></i></a> </div>
                </div>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="modal_block_email_sent">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="box-content-modal">
                    <span class="blink"><h2 class="title-modal">Warning</h2></span>
          <!--          <p><?php //echo lang('Sorry your email ID has been blocked for 120 minutes.');         ?></p>-->
                    <?php
                    $user_data = $this->session->userdata("user_interview_data");
                    ?>
                    <p>Unfortunately, after we resent you 3 verification code you did not enter the right code yet.  Therefore, you will be welcome to use an alternative email or wait for 120  minutes to use the current email  <?php echo $user_data['email']; ?> within our website.</p>

                    <div class="clearfix"></div>
                    <div class="btn-modal"> <a style="float:right" href="javascript:void(0)" onClick="$('.modal_block').modal('hide');document.location='<?php echo site_url('career') ?>'" class="block_bttn btn btn-primary btn-sm"><?php echo lang('OK'); ?> <i class="glyphicon glyphicon-chevron-right"></i></a> </div>
                </div>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<script type="text/javascript">
    var url =  "career/get_timer";
    var postData = {
        value:'verify'
    };
    $.post(url, postData, function(data) {
        // $('#promotion_preview_msg').html(data[0]['career_preview_msg']);
        //  $('#promotion_preview_msg').hide();
        var time = data[0]['career_popup_timer']*60;
        clock = $('#timer').FlipClock(time, {
            clockFace: 'HourCounter',
            countdown: true,
            callbacks: {
                stop: function() {
                    blockHandler(true);
                }
            }
        });
    },'JSON');
    
    $('#cancel_form').click(function(){
        if(typeof clock !== "undefined")
            clock.reset();
    })
    $('.block_bttn').click(function(){
        if(typeof clock !== "undefined")
            clock.reset();
    })
</script>