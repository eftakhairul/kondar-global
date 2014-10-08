
<?php
if ($last_inserted_cart_block_id) {
    if (!empty($current_cart_user_data)) {
        $bal_time = time() - $current_cart_user_data['created_time'];

        $bal_count_time = $cart_timer[0]->main_cart_timer * 60 - $bal_time;
        //$bal_count_time = 30-$bal_time;

        if ($edit_cart_mode == 1)
            $bal_count_time = $cart_timer[0]->cart_edit_timer * 60 - $bal_time;
        //$bal_count_time = 20-$bal_time;
        ?>
        <script type="text/javascript">
            $(document).ready(function() {


                var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
                var time = '<?php echo $bal_count_time; ?>';
                var $edit_cart_mode = '<?php echo $edit_cart_mode; ?>';
                //$( ".alert-message" ).hide();
                if ($edit_cart_mode == 1) {
                    if (time > 0)
                    {
                        runPrdCountDownClock('timer11', time, 1);
                        //savecartblockdetails();
                        $(".alert-message").show();

                        $("#cart_rfq_number").show();
                    }
                    else if (time < 0) {
                        $("#user_timeout_cart").modal("show");
                    }
                }
                else{
                    var is_cartuser_empty = '<?php echo count($cart_users_data);?>';
                    if(is_cartuser_empty != 0){
                        runPrdCountDownClock('timer11', time, 0);
                        //savecartblockdetails();
                        $(".alert-message").show();

                        $("#cart_rfq_number").show();
                    }
                }


                $("#cart_email").blur(function() {

                    $("#cart_rfq_number").show();
                    var user_email = $.trim($("#cart_email").val());
                    if (user_email != '' && reg.test(user_email) == true)
                    {
                        var main_cart_timer = '<?php echo $cart_timer[0]->main_cart_timer * 60; ?>';
                        savecartblockdetails(main_cart_timer);


                    }
                });

            });
        </script>
        <?php
    }
    else {


        $bal_count_time = 3600;
        //$bal_count_time = 30;
        ?>

        <script type="text/javascript">

            var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
            $(document).ready(function() {
                var edit_cart_timer = '<?php echo $cart_timer[0]->cart_edit_timer * 60; ?>';
                var cart_edit_msg = '<?php echo $cart_timer[0]->cart_edit_msg; ?>';
                runPrdCountDownClock('timer11', edit_cart_timer, 1);
                //$( ".alert-message" ).hide();
                $("#cart_email").blur(function() {
                    $("#cart_rfq_number").show();
                    var user_email = $.trim($("#cart_email").val());

                    if (user_email != '' && reg.test(user_email) == true)
                    {
                        savecartblockdetails();
                        var time = '<?php echo $bal_count_time; ?>';
        //                                //alert(time);
                        $(".alert-message").show();
                        $(".counter_msg_wrap").html(cart_edit_msg);
                        //runPrdCountDownClock('timer11',time);
                    }
                });
            });
        </script>
        <?php
    }
    ?>
<?php
} else {
    ?>
    <script type="text/javascript">
        $(document).ready(function() {
            $(".alert-message").hide();
            var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
            var user_email = $.trim($("#cart_email").val());

            //if(user_email !='' )

            if (user_email != '' && reg.test(user_email) == true)
            {
                $(".alert-message").show();
                runPrdCountDownClock('timer11', '');
                $("#cart_rfq_number").show();
            }
            else
            {

                $("#cart_email").blur(function() {

                    $("#cart_rfq_number").show();
                    var user_email = $.trim($("#cart_email").val());

                    if (user_email != '' && reg.test(user_email) == true)
                    {
                        var main_cart_timer = '<?php echo $cart_timer[0]->main_cart_timer * 60; ?>';
                        savecartblockdetails(main_cart_timer);
                    }
                });
            }
        });
    </script>
<?php } ?>

<div class="alert-message block-message warning" style="margin: 0 18px 20px 18px; display: none;" >

    <div class="product_counter_msg counter_msg_wrap"><?php if ($edit_cart_mode == 1) {
    echo $cart_timer[0]->cart_edit_msg;
} else {
    echo $cart_timer[0]->main_cart_msg;
} ?>
    </div>
    <div class="counter_msg_wrap_counter">
        <div style="width: 100%;margin: 0px;" id="timer11"></div>
    </div>
    <div class="clear"></div>
</div>