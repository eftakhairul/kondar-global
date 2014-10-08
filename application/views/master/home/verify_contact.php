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
    $(document).ready(function(){
        blink(1);
    });
</script>
<div class="container">
    <div class="main-page">
        <div class="car-lists">
            <div class="form-fill-cart">
                <div class="row">
                    <div class="col-md-6">
                        <?php /* ?>	        					<h3>Verify Form</h3>

                          We have just sent a verification code to <?php echo $user_email;?><br />

                          Please validate it now<br>

                          <br>

                          <br>



                          <a data-toggle="modal" data-target="#notify_submit" href="" class="btn btn-primary btn-sm">Verify</a><?php */ ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--End content-->
</div>
<div class="modal fade" id="notify_submit">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- <div class="modal-header">
      
                              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      
                              <h4 class="modal-title">Modal title</h4>
      
                            </div> -->
            <div class="modal-body">
                <div class="box-content-modal">
                    <form action="#" method="post" id="target" onsubmit="return show(this)">
                        <input type="hidden" id="resend_attempt" value="" />
                        <div class="alert-message block-message warning" style="margin-left: 49px; width: 407px;">
                            <div class="product_counter_msg counter_msg_wrap verfication_error_msg"> </div>
                        </div>
                        
                        <h2 style="text-decoration: none;text-transform: inherit;" class="title-modal">We sent a verification code to :<?php echo $user_email; ?></h2>
                        <div class="blink"><div class="show_error" style="color:gray;"></div></div>
                        <p style="float:left">
                            <label>Please enter the code:
                                <input type="text" name="code" required autofocus>
                            </label>
                        </p>
                        <div id="countdownplace" style="float: right;margin: 0px !important; margin-bottom: 2% !important; width:28%;"></div>
                        <div class="clearfix"></div>
                        <div class="show_class" style="margin-left:160px"></div>
                        
                        <div class="btn-modal toyota-page">
                            <div class="row">
                                <div class="col-xs-4 col-md-4 text-center"> <a href="#" id="cancel_form" class="btn btn-primary btn-sm">cancel <i class="glyphicon glyphicon-chevron-right"></i></a> </div>
                                <div class="col-xs-4 col-md-4 text-center"> <a href="#" id="resend_mail" class="btn btn-primary btn-sm">resend <i class="glyphicon glyphicon-chevron-right"></i></a> </div>
                                <div class="col-xs-4 col-md-4 text-center">
                                    <input type="submit" class="btn btn-primary btn-sm" value="Confirm">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- <div class="modal-footer">
      
                              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      
                              <button type="button" class="btn btn-primary">Save changes</button>
      
                            </div> -->
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<div class="modal fade" id="modal_success">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- <div class="modal-header">
      
                                              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      
                                              <h4 class="modal-title">Modal title</h4>
      
                                            </div> -->
            <div class="modal-body">
                <div class="box-content-modal">
                    <h2 class="title-modal"><?php echo preg_replace('/\bPHRASE\b/', $user_data['email'], $contact_msg[0]['modal_success_header']); ?></h2>
                    <p><?php echo preg_replace('/\bPHRASE\b/', $user_email, $contact_msg[0]['modal_success_body']); ?></p>
                    <div class="clearfix"></div>
                    <div class="btn-modal"> <a style="float:right" href="javascript:void(0)" id="ok_bttn" onClick="$('#modal_success').modal('hide')" class="btn btn-primary btn-sm">OK <i class="glyphicon glyphicon-chevron-right"></i></a> </div>
                </div>
            </div>
            <!-- <div class="modal-footer">
      
                                              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      
                                              <button type="button" class="btn btn-primary">Save changes</button>
      
                                            </div> -->
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<div class="modal fade" id="modal_block">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- <div class="modal-header">
      
                                              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      
                                              <h4 class="modal-title">Modal title</h4>
      
                                            </div> -->
            <div class="modal-body"> 
                <div class="box-content-modal">
                    <h2 class="title-modal"><span class="blink">Warning</span></h2>
                    <?php
                    $user_data = $this->session->userdata('user_contact_data');

                    //$msg = "Unfortunately, you used the 3 attempts to enter a correct verification code without success. Therefore, you are welcome to use an alternative email or wait 120 minutes to be able to use your current email address ".$user_data['email']." within our website. Thank you.";
                    $msg = preg_replace('/\bPHRASE\b/', $user_data['email'], $contact_msg[0]['error_code_block_msg']);//"Unfortunately, you entered wrong verification code during the 3 attempts. Therefore, you will be welcome to use an alternative email or wait for 120 minutes to use the current email ".$user_data['email']." within our website.";
                    ?>
          <!--          <p>Sorry your email ID has been blocked for 120 minutes.</p>-->
                    <p><?php echo $msg; ?></p>
                    <div class="clearfix"></div>
                    <div class="btn-modal"> <a style="float:right" href="javascript:void(0)" id="block_bttn" onClick="$('#modal_block').modal('hide');window.location.href =' <?php echo base_url(); ?>contact'" class="btn btn-primary btn-sm">OK <i class="glyphicon glyphicon-chevron-right"></i></a> </div>
                </div>
            </div>
            <!-- <div class="modal-footer">
      
                                              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      
                                              <button type="button" class="btn btn-primary">Save changes</button>
      
                                            </div> -->
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="modal_block1">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Modal title</h4>
                  </div> -->
            <div class="modal-body">
                <div class="box-content-modal">
                    <h2 class="title-modal"><span class="blink">Warning</span></h2>

                    <?php
                    $user_data = $this->session->userdata('user_contact_data');
                   // $msg = "Unfortunately, after we resent you 3 verification code you did not enter the right code yet.  Therefore, you will be welcome to use an alternative email or wait for 120 minutes to use the current email ".$user_data['email']." within our website.";
                    $msg = preg_replace('/\bPHRASE\b/', $user_data['email'], $contact_msg[0]['resend_block_msg']);//"Unfortunately, you did not enter the correct verification code even after we resend it to you for consecutive 3 times. Therefore, you are welcome to use an alternative email or wait 120 minutes to be able to use your current email address ".$user_data['email']." within our website. Thank you.";
                    ?>

<!--          <p>Sorry your email ID has been blocked for 120 minutes.</p>-->
                    <p><?php echo $msg; ?></p>
                    <div class="clearfix"></div>
                    <div class="btn-modal"> <a style="float:right" href="javascript:void(0)"  onClick="$('#modal_block1').modal('hide');window.location.href =' <?php echo base_url(); ?>contact'" class="block_bttn1 btn btn-primary btn-sm">OK <i class="glyphicon glyphicon-chevron-right"></i></a> </div>
                </div>
            </div>
            <!-- <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                  </div> -->
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<!-- the following modal block is controlled by the verify_contact.js -> doneHandler() -->
<div class="modal fade" id="timeout_modal_block">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title">Modal title</h4>
            </div> -->
            <div class="modal-body">
                <div class="box-content-modal">
                    <h2 class="title-modal"><span class="blink">Warning</span></h2>

<?php
$user_data = $this->session->userdata('new_session');
$url = site_url("contact/index");
$msg = preg_replace('/\bPHRASE\b/', $user_data['email'], $contact_msg[0]['code_timeout_block_msg']);//"Unfortunately, you did not enter the correct verification code within the given lead-time. Therefore, you are welcome to use an alternative email or wait 120 minutes to be able to use your current email address " . $user_data['email'] . " within our website. Thank you.";
?>
                    <p><?php echo $msg; ?></p>
                    <div class="clearfix"></div>
                    <div class="btn-modal">
                        <a style="float:right" href="javascript:"  onClick="document.location.href = '<?php echo $url; ?>'" class="block_bttn1 btn btn-primary btn-sm">OK <i class="glyphicon glyphicon-chevron-right"></i></a>	
                    </div>
                </div>
            </div>
            <!-- <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary">Save changes</button>
            </div> -->
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
