<script src="assets/master/js/flipclock.js" type="text/javascript"></script>

<script type="text/javascript">
    $(document).ready(function() {
        var resend_attempt = 1;

        var cart_preview_timer = '<?php echo $cart_timer[0]->cart_preview_timer * 60; ?>';
        runPrdCountDownClock('timer5', cart_preview_timer, 0);

    });
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

    function cancel_popup_click() {
        clock.reset();
        var cart_preview_timer = $('#cart_preview_timer').html();
        runCountDownClock('timer5', cart_preview_timer);
        $('#notify_submit').modal('hide');
    }

    function redirect_edit_mode() {
        $('#user_block_box').modal('hide');
        if ($("#edit_cart_mode_on").html() == "edit_cart_mode_on") {
            window.location.href = '<?php echo base_url(); ?>cart/edittocart';
        }
        else {

            window.location.href = '<?php echo base_url(); ?>cart/index';
        }

    }
</script>

<div class="container varify-submit-page productlisting">
    <div class="row"> 
        <div class="col-md-12 text-left"> 
            <a class="logo" href="index.php"><img src="assets/template/images/logo.png" alt="logo" style="float:left; margin-top:30px"/></a>
        </div>
    </div>
    <div class="alert-message block-message warning " style="margin: 0 18px 20px 18px;">

        <div class="product_counter_msg counter_msg_wrap"><?php
            echo $cart_timer[0]->cart_preview_msg;
            ;
            ?>
        </div>
        <div class="counter_msg_wrap_counter" id="cart_review_time">
            <div id="timer5"></div>
        </div>
        <div class="clear"></div>
    </div>
<?php //var_dump($cart_users_data);   ?>
    <h2 class="text-center"><?php echo lang('REQUEST FOR QUOTATION') ?></h2> 
    <form action="#" id="cart_conifrm_form" method="post" enctype="multipart/form-data" > 
        <input type="hidden" value="" id="email_attempt" name="email_attempt">
        <div class="row varify-submit-info">
            <div class="col-md-6 col-xs-12">
                <p><?php echo isset($cart_users_data['user_name']) ? $cart_users_data['user_name'] : ''; ?><input type="hidden" value="<?php echo isset($cart_users_data['user_name']) ? $cart_users_data['user_name'] : ''; ?>" id="user_name" name="user_name"></p>
                <p><?php echo isset($cart_users_data['designation']) ? $cart_users_data['designation'] : ''; ?></p>
                <p><?php echo isset($cart_users_data['company']) ? $cart_users_data['company'] : ''; ?></p>
                <p>Telephone: <?php echo isset($cart_users_data['telephone']) ? $cart_users_data['telephone'] : ''; ?></p>
                <p>Email: <?php echo isset($cart_users_data['email']) ? $cart_users_data['email'] : ''; ?><input type="hidden" value="<?php echo isset($cart_users_data['email']) ? $cart_users_data['email'] : ''; ?>" id="email" name="email"></p>
            </div>
            <div class="col-md-6 col-xs-12" style="float: right; margin: 23px 7px 0px 0px; width:auto;">
                <p>Country: <?php echo isset($cart_users_data['country']) ? $cart_users_data['country'] : ''; ?></p>
                <p>RFQ Number: <?php echo isset($cart_users_data['rfq']) ? $cart_users_data['rfq'] : ''; ?></p>
                <p>Deadline: <?php echo isset($cart_users_data['deadline']) ? $cart_users_data['deadline'] : ''; ?></p>
                <p>Incoterms: <?php echo isset($cart_users_data['incoterms']) ? $cart_users_data['incoterms'] : ''; ?></p>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered my-table">
                <?php
                $i = 1;
                if (!empty($cart_details)) {
                    $currentproducttype = '';
                    foreach ($cart_details as $cart) {
                        $privilage = explode('#', $cart['menu_privilages']);
                        ?>

                        <?php
                        if ($currentproducttype != $cart['type']) {
                            if ($i > 1)
                                echo '</tbody></table><table class="table table-bordered my-table productsbytype">';
                            ?>

                            <thead>
                            <th colspan="11"><?php echo $cart['type']; ?>
                                <input type="button" id="minimize_block_<?php echo strtolower(str_replace(' ', '_', $cart['type'])); ?>" class="minimize_block" name="minimize_block" value="-" style="float:right;"></th>
                            </thead>
                            <thead class="minimize_block_<?php
                            echo strtolower(str_replace(' ', '_', $cart['type']));
                            ;
                            ?>">
                                <tr>
                                    <th><?php echo lang('No.') ?></th>	
                                    <th><?php echo lang('QTY') ?></th>	
                                    <th><?php echo lang('COMMENTS') ?></th>	
                                    <th><?php echo lang('KGT REF#') ?></th>	
                                    <th><?php echo lang('PRODUCT PHOTO') ?></th>	
                                    <th><?php echo lang('VEHICLE PHOTO') ?></th>	
                                    <?php if (in_array("drawing_photo", $privilage)) { ?>
                                        <th><?php echo lang('DRAWING PHOTO') ?></th>   	
            <?php } ?>
                                    <th>&nbsp;</th>
                                </tr>
                            </thead>  
                            <tbody class="minimize_block_<?php
                            echo strtolower(str_replace(' ', '_', $cart['type']));
                            ;
                            ?> ">                                            
        <?php } ?>

                            <tr class="cart_details_row">  

                                <td style="color: #575757; font-family: arial; font-size: 12px; text-align: center;"><span><?php echo $i; ?></span></td>
                                <td><span style="color: #575757; font-family: arial; font-size: 12px; text-align: center;"><?php echo $cart_data[$cart['id']]['quantity']; ?></span></td>
                                <td style="color: #575757; font-family: arial; font-size: 12px; text-align: center;"><span><?php echo $cart_data[$cart['id']]['comment']; ?></span></td>
                                <td style="color: #575757; font-family: arial; font-size: 12px; text-align: center;"><span><?php echo $cart['kgt_ref_number']; ?></span></td>
                                <td style="color: #575757; font-family: arial; font-size: 12px; text-align: center;"><span>
        <?php if ($cart['product_photo'] != '' && file_exists("assets/uploads/product_images/" . $cart['product_photo'])) { ?>
                                            <a class="example-image-link" data-lightbox="example-<?php echo $cart['id']; ?>" href="assets/uploads/product_images/<?php echo $cart['product_photo']; ?>">
                                                <img src="assets/uploads/product_images/<?php echo $cart['product_photo']; ?>" height="75" alt="<?php echo $cart['product_photo']; ?>" />
                                            </a>&nbsp;
        <?php } else { ?>
                                            <a class="example-image-link" data-lightbox="example-<?php echo $cart['id']; ?>" href="images/coming_soon.jpg">
                                                <img src="images/coming_soon.jpg" width="100" height="80">
                                            </a>&nbsp;
        <?php } ?>
                                    </span></td>
                                <td style="color: #575757; font-family: arial; font-size: 12px; text-align: center;"><span> 
        <?php if ($cart['vehicle_photo'] != '' && file_exists("assets/uploads/product_images/" . $cart['vehicle_photo'])) { ?>
                                            <a class="example-image-link" data-lightbox="example-<?php echo $cart['id']; ?>" href="assets/uploads/product_images/<?php echo $cart['vehicle_photo']; ?>">
                                                <img src="assets/uploads/product_images/<?php echo $cart['vehicle_photo']; ?>" height="75" alt="<?php echo $cart['vehicle_photo']; ?>" />
                                            </a>&nbsp;
        <?php } else { ?>
                                            <a class="example-image-link" data-lightbox="example-<?php echo $cart['id']; ?>" href="images/coming_soon.jpg">
                                                <img src="images/coming_soon.jpg" width="100" height="80">
                                            </a>&nbsp;
                                <?php } ?>
                                    </span></td>
                                <?php
                                if (in_array("drawing_photo", $privilage)) {
                                    if ($cart['drawing_photo'] != '') {
                                        ?>
                                        <td style="color: #575757; font-family: arial; font-size: 12px; text-align: center;">
                                            <span>

                <?php if ($cart['drawing_photo'] != '' && file_exists("assets/uploads/product_images/" . $cart['drawing_photo'])) { ?>
                                                    <a class="example-image-link" data-lightbox="example-<?php echo $cart['id']; ?>" href="assets/uploads/product_images/<?php echo $cart['drawing_photo']; ?>">
                                                        <img src="assets/uploads/product_images/<?php echo $cart['drawing_photo']; ?>" alt="<?php echo $cart['drawing_photo']; ?>" height="75" /></a>&nbsp;
                <?php } else { ?>
                                                    <a class="example-image-link" data-lightbox="example-<?php echo $cart['id']; ?>" href="images/coming_soon.jpg">
                                                        <img src="images/coming_soon.jpg" width="100" height="80">
                                                    </a>&nbsp;
                <?php } ?>

                                            </span>
                                        </td> 
                                        <?php
                                    }
                                }
                                ?>

                                <td style="color: #575757; font-family: arial; font-size: 12px; text-align: center;">
                                    <a href="javascript:void(0)" onClick="$(this).parent().parent().next('.less_info').toggle();
                                            $(this).find('.less_img').toggle();
                                            $(this).find('.more_img').toggle();">
                                   <!-- <img class="less_img" src="assets/template/images/less_info.png" style="display:none" alt=""/>
                                    <img class="more_img" src="assets/template/images/more_info.png" style="display:inline" alt=""/>-->
                                        <img class="less_img" src="" style="display:inline; color: black;  background-color: whitesmoke;" alt=" - "/>
                                        <img class="more_img" src="" style="display:none; color: black;  background-color: whitesmoke;" alt=" + "/>




                                    </a>
                                </td>
                            </tr>
                            <tr class="less_info" style="background-color: rgb(219, 219, 219);">
                                <td colspan="11" style="color: #575757; font-family: arial; font-size: 12px;"><div class="single_product_wrapper">
                                        <div class="detail_wrap" style="text-align:left">
                                            <?php if ($cart['oem_part_number'] != '' && in_array("oem_part_number", $privilage)) { ?>
                                                <div class="single_detail"> <span><?php echo lang('OEM PART NUMBER') ?> :</span> <span><?php echo $cart['oem_part_number']; ?></span> </div>
                                            <?php } ?>	

                                            <?php if ($cart['application'] != '' && in_array("application", $privilage)) { ?>
                                                <div class="single_detail"> <span><?php echo lang('APPLICATION') ?> :</span> <span><?php echo $cart['application']; ?></span> </div>
                                            <?php } ?>	

                                            <?php if ($cart['others'] != '' && in_array("others", $privilage)) { ?>
                                                <div class="single_detail"> <span><?php echo lang('OTHER') ?> :</span> <span><?php echo $cart['others']; ?></span> </div>
                                            <?php } ?>	

                                            <?php if ($cart['wva'] != '' && in_array("wva", $privilage)) { ?>
                                                <div class="single_detail"> <span><?php echo lang('WVA') ?> :</span> <span><?php echo $cart['wva']; ?></span> </div>
        <?php } ?>




                                            <?php if ($cart['make'] != '' && in_array("maker_id", $privilage)) { ?>
                                                <div class="single_detail"> <span><?php echo lang('Vehicle Brand Name') ?> :</span> <span><?php echo $cart['make']; ?></span> </div>
                                            <?php } ?>

                                            <?php if ($cart['mann'] != '' && in_array("mann", $privilage)) { ?>
                                                <div class="single_detail"> <span>Mann :</span> <span><?php echo $cart['mann']; ?></span> </div>
        <?php } ?>

                                        </div>
                                        <div class="detail_wrap" style="text-align:center">
                                            <?php if ($cart['fmsi_ref_number'] != '' && in_array("fmsi_ref_number", $privilage)) { ?>
                                                <div class="single_detail"> <span><?php echo lang('FMSI Ref.') ?> :</span> <span><?php echo $cart['fmsi_ref_number']; ?></span> </div>
                                            <?php } ?>	

                                            <?php if ($cart['year'] != '' && in_array("year", $privilage)) { ?>
                                                <div class="single_detail"> <span><?php echo lang('Model manufacturing year') ?> :</span> <span><?php echo $cart['year']; ?></span> </div>
                                            <?php } ?>	

                                            <?php if ($cart['front_rear'] != '' && in_array("front_rear", $privilage)) { ?>
                                                <div class="single_detail"> <span><?php echo lang('front/rear (wheel)') ?> :</span> <span><?php echo $cart['front_rear']; ?></span> </div>
                                            <?php } ?>	

                                            <?php if ($cart['model'] != '' && in_array("model", $privilage)) { ?>
                                                <?php echo lang('Vehicle Model Name') ?> :<?php echo $cart['drawing_photo']; ?>
        <?php } ?>	

                                        </div>
                                        <div class="clear"></div>
                                    </div></td>
                            </tr>
                            <?php
                            $i++;
                            $currentproducttype = $cart['type'];
                        }
                        ?>
                    </tbody>
                    <?php
                }
                ?>

            </table>
        </div>
    </form>
    <div class="clearfix"></div>
    <div class="nav-prex-next text-right">
<?php if (!empty($cart_details)) { ?>
            <div class="row">
                <div class="col-md-12">
        <!--<img class="loaderimagecontinue" style="display:none;" src="images/loading.gif" alt="loaderimagecontinue" />-->
                    <a href="cart/edittocart" class="btn btn-primary btn-sm"><?php echo lang('Edit') ?></a> 
                    <!--<a href="front/continueshopping_in_cart" class="btn btn-primary btn-sm">CONTINUE SHOPPING</a>-->
                    <!--<a data-toggle="modal" data-target="#notify_submit" href="" class="btn btn-primary btn-sm">SUBMIT</a>	-->
                    <a href="javascript:void(0)" class="btn btn-primary btn-sm" id="submit_confirm_cart"><?php echo lang('SUBMIT') ?></a>	 
                </div>
            </div>
<?php } ?>
    </div>

    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 text-left varify-foot">
            <p><?php echo isset($cart_users_data['user_name']) ? $cart_users_data['user_name'] : ''; ?> </p>
            <p><?php echo isset($cart_users_data['designation']) ? $cart_users_data['designation'] : ''; ?></p>
        </div>
    </div>

</div>

<!--Modal shopping decision cart-->
<div class="modal fade" id="modal_success">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title">Modal title</h4>
            </div> -->
            <div class="modal-body">
                <div class="box-content-modal">
                    <h2 class="title-modal"><?php echo lang('THANK YOU FOR YOUR INQUIRY') ?></h2> 
                    <p><?php echo lang('We will get in touch with you within the next 24 hours. A copy of the RFQ Number') ?> <?php echo $cart_users_data['rfq']; ?> <?php echo lang('is already sent to the email') ?>: <?php echo $cart_users_data['email']; ?></p>  
                    <div class="clearfix"></div>
                    <div class="btn-modal">

                        <a style="float:right" href="javascript:void(0)" onClick="$('#modal_success').modal('hide');
                                window.location.href = ' <?php echo base_url(); ?>products'" class="btn btn-primary btn-sm"><?php echo lang('OK') ?> <i class="glyphicon glyphicon-chevron-right"></i></a>	
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


<!--Modal shopping decision cart-->
<div class="modal fade" id="user_block_box">
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
                        <div class="blockMsg" id="blockMsg"><?php echo lang('You Have Been Blocked.') ?><br> <?php echo lang('Please Try After 120 minutes.') ?></div>
                        <div id="edit_cart_mode_on" style="display: none;"></div>
                    </div>

                    <div class="clearfix"></div>
                    <div class="btn-modal">
                        <div class="row">

                            <div class="col-md-12 col-xs-12 text-right">
                                <a href="javascript:void(0)" onClick="redirect_edit_mode();" class="btn btn-primary btn-sm" id="block_confirm_msg"><?php echo lang('OK') ?> <i class="glyphicon glyphicon-chevron-right"></i></a>	
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

<!-- this modal will remove to verify the code sent in the user's email for the cart section. 3 times wrong entry or 3 times email sent will block that user's email-->
<div class="modal fade" id="notify_submit">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title">Modal title</h4>
            </div> -->
            <div class="modal-body">

                <div class="box-content-modal">
                    <input type="hidden" id="cart_email" value="<?php echo $cart_users_data['email']; ?>" />
                    <form action="#" id="cart_verification_form" method="post" enctype="multipart/form-data" > 

                        <h2 class="title-modal" style="text-decoration:none; text-transform: inherit;">We sent a verification code to : <?php echo $cart_users_data['email']; ?></h2> 

                        <div class="blink"><div class="product_counter_msg counter_msg_wrap verfication_error_msg" style="color: gray;">	</div></div>

                        <div class="alert-message block-message warning" > <!-- style="margin-left: 49px; width: 407px;"> -->
                            <div class="product_counter_msg counter_msg_wrap" id="cart_pop_msg"></div>
                            <span style="display:none;" id="cart_preview_timer"></span>
                        </div>
                        <div class="alert-message block-message warning" > <!-- style="margin-left: 49px; width: 407px;"> -->

                        </div>
                        <div class="col-md-12">
                            <div class="col-md-6"><label><?php echo lang('Please enter the code') ?>: <input type="text" name="ecart_verification_codemail" id="ecart_verification_codemail"></label></div>                     
                            <div class="col-md-6">
                                <div id="timer11"></div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="btn-modal toyota-page">

                            <div class="row">

                                <div class="col-xs-4 col-md-4 text-center">
                                    <img class="loaderimagecontinue" style="display:none;" src="images/loading.gif" alt="loaderimagecontinue" />

                                    <!-- when user click to cancel the verification code popup then it allocates 1200 seconds in the cart preview. -->
                                    <a href="javascript:void(0);" onclick="cancel_popup_click();"  id="cart_pop_cancel" class="btn btn-primary btn-sm"><?php echo lang('cancel') ?> <i class="glyphicon glyphicon-chevron-right"></i></a>	
                                </div>
                                <div class="col-xs-4 col-md-4 text-center">
                                    <a href= "javascript:void(0);" class="btn btn-primary btn-sm" id="resend_email_code"><?php echo lang('resend') ?> <i class="glyphicon glyphicon-chevron-right"></i></a>
                                </div>
                                <div class="col-xs-4 col-md-4 text-center">
                                    <a href="javascript:void(0);" class="btn btn-primary btn-sm" id="cart_verification_confirm"><?php echo lang('confirm') ?> <i class="glyphicon glyphicon-chevron-right"></i></a> 
                                </div>
                            </div>
                        </div>
                    </form>	
                    <span style="display:none;" id="maincart_block_msg"><?php if (isset($selection_instruction[0]->maincart_block_msg)) echo $selection_instruction[0]->maincart_block_msg; ?></span>
                    <span style="display:none;" id="editcart_block_msg"><?php if (isset($selection_instruction[0]->editcart_block_msg)) echo $selection_instruction[0]->editcart_block_msg; ?></span>
                    <span style="display:none;" id="cartpreview_block_msg"><?php if (isset($selection_instruction[0]->cartpreview_block_msg)) echo $selection_instruction[0]->cartpreview_block_msg; ?></span>
                    <span style="display:none;" id="cartverification_block_msg"><?php if (isset($selection_instruction[0]->cartverification_block_msg)) echo $selection_instruction[0]->cartverification_block_msg; ?></span>
                    <span style="display:none;" id="cartverification_resent_block_msg"><?php if (isset($selection_instruction[0]->cartverification_resent_block_msg)) echo $selection_instruction[0]->cartverification_resent_block_msg;?></span>
  <span style="display:none;" id="cartverification_wrong_block_msg"><?php if (isset($selection_instruction[0]->cartverification_wrong_block_msg)) echo $selection_instruction[0]->cartverification_wrong_block_msg;?></span>
                    <span style="display:none;" id="block_notification_msg"><?php if (isset($selection_instruction[0]->block_notification_msg)) echo $selection_instruction[0]->block_notification_msg; ?></span>


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


</body>
</html>
