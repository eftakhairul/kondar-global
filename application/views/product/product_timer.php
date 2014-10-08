<?php
if ($last_inserted_cart_block_id && !empty($current_cart_user_data)) {

    $bal_time = time() - $current_cart_user_data['created_time'];
    $bal_count_time = $cart_timer[0]->main_cart_timer * 60 - $bal_time;
    if ($edit_cart_mode == 1)
        $bal_count_time = $cart_timer[0]->cart_edit_timer * 60 - $bal_time;
    ?>
    <script type="text/javascript">
        $(document).ready(function() {
            var time = '<?php echo $bal_count_time; ?>';
            var edit_cart_mode = '<?php echo $edit_cart_mode; ?>';
            if (edit_cart_mode == '1') {
                if (time > 0) {
                    runPrdCountDownClock('timer1', time, 1);
                }
                else {
                    $("#user_timeout_cart").modal("show");
                }
            }
            else {
                if (time > 0) {
                    runPrdCountDownClock('timer1', time, 2);
                }
                else {
                    $("#user_timeout_cart").modal("show");
                }
            }




        });
    </script>
<?php } ?>

<?php if ($last_inserted_cart_block_id && !empty($current_cart_user_data)) {
    ?>
    <div class="alert-message block-message warning" style="margin: 0 18px 20px 18px;">

        <div class="product_counter_msg counter_msg_wrap"><?php
            if ($edit_cart_mode == 1) {
                echo $cart_timer[0]->cart_edit_msg;
                ;
            } else {
                echo $cart_timer[0]->main_cart_msg;
                ;
            }
            ?>
        </div> 
        <div class="counter_msg_wrap_counter">
            <div id="timer1"></div>
        </div>
        <div class="clear"></div>
    </div>
<?php } ?>




<!-- this might happen when user was in another page and then time has ended. then after that if he comes in cart then he will get this message. -->
<!--Modal shopping decision cart-->
<div class="modal fade" id="user_timeout_cart">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title">Modal title</h4>
            </div> -->
            <div class="modal-body">
                <div class="box-content-modal">
                        <?php /* ?><img src="<?php echo base_url();?>assets/template/images/Blocked.jpg" alt="" class="img-responsive"><?php */ ?>
                    <div class="blockElementWrap">
                        <?php
                        $session_data = $this->session->userdata('cart_users_data');
                        $email = $session_data['email'];
                        ?>
                        
                        <div class="blockMsg" >Unfortunately, you did not finish shopping during the given lead-time. Therefore, you will be welcome to use an alternative email or wait for 120 minutes to use the current email <?php echo $email; ?> within our website.  </div>

                    </div>

                    <div class="clearfix"></div>
                    <div class="btn-modal">
                        <div class="row">

                            <div class="col-md-12 col-xs-12 text-right" >
                                <a href="javascript:void(0)" style="padding: 0px;" onClick="
                                        window.location.href = ' <?php echo base_url(); ?>cart/make_user_block';" class="btn btn-primary btn-sm" id="block_confirm_msg"><?php echo lang('OK') ?> <i class="glyphicon glyphicon-chevron-right"></i></a>	
                            </div>
                        </div>



                    </div>
                </div>
            </div>
            <!-- <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary">Save changes</button>
            </div> -->
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->