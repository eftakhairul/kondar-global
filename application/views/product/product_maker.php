<script type="text/javascript">
    function redirect_edit_mode() {
        $('#user_block_box').modal('hide');
        if ($("#edit_cart_mode_on").html() == "edit_cart_mode_on") {
            window.location.href = '<?php echo base_url(); ?>cart/edittocart';
        }
        else {

            window.location.href = '<?php echo base_url(); ?>cart/index';
        }

    }
    
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

        $("#check_all_btn,#check_all_btn #checkbox").click(function(){  
            var chkbtn = $("#check_all_btn #checkbox"); 

            if(chkbtn.is(':checked')){
                chkbtn.prop('checked',false);
            }else{
                chkbtn.prop('checked',true);
            }
            
            if($("#check_all_btn #checkbox").is(':checked')){
                $.each( $(".product_type_image_wrap"), function( key, value ) {                    
                    $(this).find(".vehicle_type_id").attr('value',$(this).find(".product_image_wrap").data('rel'));
                });
                $(".product_type_image_wrap").addClass('boarder_2_red');                
                $("#check_all_btn #checkbox").prop('checked',true);
            }else{
                $(".product_type_image_wrap").removeClass('boarder_2_red');
                $(".vehicle_type_id").attr('value',0);
                $("#check_all_btn #checkbox").prop('checked',false);
            }
        });

        $(".show_all_types").on('click', function(){
            if($(this).is(':checked')) {
                $(this).parent().next().children("div").each(function( key, value ) {
                    $(this).find('.product_type_image_wrap').addClass('boarder_2_red');
                    $(this).find('.product_type_image_wrap').each(function(key, value ){
                        $(this).find(".vehicle_type_id").attr('value',$(this).find(".product_image_wrap").data('rel'));
                    });
                });

            }else{
                 $(this).parent().next().children("div").each(function( key, value ) {
                    $(this).find('.product_type_image_wrap').removeClass('boarder_2_red');
                    $(this).find('.product_type_image_wrap').each(function(key, value ){
                        $(this).find(".vehicle_type_id").attr('value', '');
                    });
                });
            }
        });

        $(".select_all_vichles").on('click', function() {

            if($(this).is(':checked')) {
                $(this).parent().next().children("p").each(function(index, value){
                    $(this).find('.show_all_types').prop('checked',true);
                    $(this).next().children("div").each(function( key, value ) {
                        $(this).find('.product_type_image_wrap').addClass('boarder_2_red');
                        $(this).find('.product_type_image_wrap').each(function (key, value) {
                            $(this).find(".vehicle_type_id").attr('value', $(this).find(".product_image_wrap").data('rel'));
                        });
                    });
                });
            }else{
                 $(this).parent().next().children("p").each(function(index, value){
                    $(this).find('.show_all_types').prop('checked',false);
                    $(this).next().children("div").each(function( key, value ) {
                        $(this).find('.product_type_image_wrap').removeClass('boarder_2_red');
                        $(this).find('.product_type_image_wrap').each(function (key, value) {
                            $(this).find(".vehicle_type_id").attr('value', '');
                        });
                    });
                });
            }

        });
    });
</script>     
<div class="container">
    <div class="row bread">
        <div class="col-md-12">
            <div class="text-bread">
                <?php echo '<a href="products">' . lang('PRODUCT GALLERY (APPLICATION)') . '</a>'; ?> / <?php echo $breadcrumb; ?>
            </div>
        </div>
        <!--<div class="col-md-6">
            <div class="text-bread">
                 NOTE: SIMULTANEOUS SELECTION IS POSSIBLE.
            </div>
        </div>-->
    </div>
</div>
<form action="products/product_list" id="products_brand_list_form" enctype="multipart/form-data" method="post"> 
    <div class="container">
        <div class="main-page">
            <div style="color: red;"><span><span style="font-weight:bold; color:black; text-decoration: underline;">Selection instruction</span></span><span style="color:black;">:</span><?php echo $selection_instruction[0]->product_brand_msg;?></div>
            <div class="car-lists text-center productbaselisting">
                <div class="row">
                    <?php include('product_timer.php'); ?> 

                    <div class="col-md-12">
                        <?php if ($this->comman_model->get_isactive_checkbox('settings', 'id', 1)) { ?>
                            <div id="check_all_btn" class="col-md-2 custom_btn">
                                <input id="checkbox" type="checkbox" name="product_option[]" value="all">    
                                Select All (<span id="vehicle_makers_num"><?php echo $vehicle_makers_cnt; ?></span>)
                            </div>                        
                        <?php } ?>
                    </div>
                    <div class="clearfix"></div> 

                    <div id="product_maker_block">
                        <?php foreach ($vehicle_makers as $category => $types): ?>
                            <?php $vichle_id = getIdByVichleName($category); ?>

                            <p style="padding-left: 16px; text-decoration:#575757; font-family: Arial; font-size: 26px;">
                                <input class="select_all_vichles" type="checkbox" name="" value="" />&nbsp;
                                <?php echo $category ?>&nbsp;
                                <a class="show_div">-</a>
                            </p>
                            <div>
                                <?php foreach ($types as $type_name => $markers): ?>
                                    <?php $product_type_id = getIdByProductTypeandVichleId($type_name, $vichle_id); ?>
                                    <p style="padding-left: 40px; text-decoration:#575757; font-family: Arial">
                                        <input type="checkbox" class='show_all_types' name="" value="" />&nbsp;
                                        <?php echo $type_name ?>&nbsp;
                                        <a class="show_div">-</a>
                                    </p>
                                    <div>
                                    <?php foreach($markers as $maker):?>
                                        <div class="col-md-3">
                                            <div class="pro-item product_type_image_wrap product_type_image_wrap1 singlestep <?php if (in_array($maker['id'], $product_maker_id)) { echo "boarder_2_red"; } ?>">
                                                <div class="" style="height:180px;"><?php /* ?>front/product_list/<?php echo $maker['id'];?><?php */ ?>
                                                    <a href="javascript:void(0);" class="product_image_wrap" data-rel="<?php echo $vichle_id."_".$product_type_id."_".$maker['id']; ?>"><img src="assets/uploads/product_maker/<?php echo $maker['maker_logo']; ?>" alt="" /></a>
                                                    <input type="hidden" name="vehicle_brand_id[]" value="<?php if (in_array($maker['id'], $product_maker_id)) {echo $vichle_id."_".$product_type_id."_".$maker['id'];} ?>" class="vehicle_type_id">
                                                </div>
                                                <div class="clearfix"></div>
                                                <a href="javascript:void(0);" class="btn btn-primary btn-sm"><?php echo $maker['maker_name']; ?></a>
                                            </div>
                                        </div>
                                     <?php endforeach ?>
                                     </div>
                                    <div class="clearfix"></div>
                                <?php endforeach ?>
                            </div>
                            <div class="clearfix"></div>
                        <?php endforeach ?>
                    </div>
                    <div class="clearfix"></div> 


                    <!--<div class="col-md-3">
                            <div class="pro-item">
            <img src="images/car_pic2.png"   id="image1" />
            <div class="clearfix"></div>
            <a href="car.php" class="btn btn-primary btn-sm">car</a>
                            </div>
                    </div>
                    <div class="col-md-3">
                            <div class="pro-item">
            <img src="images/pickup_pic2.png"   id="image1" />
            <div class="clearfix"></div>
            <a href="car.php" class="btn btn-primary btn-sm">Pickup</a>
                            </div>
                    </div>
                    <div class="col-md-3">
                            <div class="pro-item">
            <img src="images/van_pic2.png"   id="image1" />
            <div class="clearfix"></div>
            <a href="car.php" class="btn btn-primary btn-sm">Van</a>
                            </div>
                    </div>
                    <div class="col-md-3">
                            <div class="pro-item">
            <img src="images/truck_pic2.png"   id="image1" />
            <div class="clearfix"></div>
            <a href="truck.php" class="btn btn-primary btn-sm">Truck</a>
                            </div>
                    </div>
                    <div class="col-md-3">
                            <div class="pro-item">
            <img src="images/bus_pic2.png"   id="image1" />
            <div class="clearfix"></div>
            <a href="truck.php" class="btn btn-primary btn-sm">Bus</a>
                            </div>
                    </div>-->

                </div>
            </div>

            <div class="clearfix"></div>
            <div class="nav-prex-next text-right">
                <div class="row">
                    <div class="col-md-12">
                        <a href="products/product_type" class="btn btn-primary btn-sm"><?php echo lang('Back') ?></a> 
                        <a href="javascript:void(0)" class="btn btn-primary btn-sm" id="product_brand_next"><?php echo lang('Next') ?></a>	
                    </div>
                </div>
            </div>

        </div><!--End content-->
    </div>
</form>
<span style="display:none;" id="maincart_block_msg"><?php if (isset($selection_instruction[0]->maincart_block_msg)) echo $selection_instruction[0]->maincart_block_msg;?></span>
  <span style="display:none;" id="editcart_block_msg"><?php if (isset($selection_instruction[0]->editcart_block_msg)) echo $selection_instruction[0]->editcart_block_msg;?></span>
  <span style="display:none;" id="cartpreview_block_msg"><?php if (isset($selection_instruction[0]->cartpreview_block_msg)) echo $selection_instruction[0]->cartpreview_block_msg;?></span>
  <span style="display:none;" id="cartverification_block_msg"><?php if (isset($selection_instruction[0]->cartverification_block_msg)) echo $selection_instruction[0]->cartverification_block_msg;?></span>
  <span style="display:none;" id="block_notification_msg"><?php if (isset($selection_instruction[0]->block_notification_msg)) echo $selection_instruction[0]->block_notification_msg;?></span>
  <span style="display:none;" id="cartverification_resent_block_msg"><?php if (isset($selection_instruction[0]->cartverification_resent_block_msg)) echo $selection_instruction[0]->cartverification_resent_block_msg;?></span>
  <span style="display:none;" id="cartverification_wrong_block_msg"><?php if (isset($selection_instruction[0]->cartverification_wrong_block_msg)) echo $selection_instruction[0]->cartverification_wrong_block_msg;?></span>

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
                    </div>
                    <div id="edit_cart_mode_on" style="display: none;"></div>
                    <h2 class="title-modal" id="blockMsg1"><?php echo lang('You Have Been Blocked. Please Try After 120 minutes.') ?></h2> 
                    <div class="clearfix"></div>
                    <div class="btn-modal">
                        <div class="row">

                            <div class="col-md-12 col-xs-12 text-right">
                                <a href="javascript:void(0)" onClick="redirect_edit_mode();" class="btn btn-primary btn-sm" id="block_confirm_msg1"> <?php echo lang('OK') ?><i class="glyphicon glyphicon-chevron-right"></i></a>	
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

<!--Modal Custom warning-->
<div class="modal fade" id="customwarning">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title">Modal title</h4>
            </div> -->
            <div class="modal-body">
                <div class="box-content-modal">
                    <h2 id="customwarning_msg_title" class="title-modal">
                       <span class="blink">  <?php $selection_instruction[0]->selection_popup_header;?> </span>
                    </h2>
                    <p id="customwarning_msg"><?php echo $selection_instruction[0]->selection_popup_body; ?></p>
                    <div class="clearfix"></div>
                    <div class="btn-modal">

                        <a style="float:right" href="javascript:void(0)" onClick="$('#customwarning').modal('hide');" class="btn btn-primary btn-sm"><?php echo lang('OK') ?> <i class="glyphicon glyphicon-chevron-right"></i></a>	
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
<!--Modal Custom warning ends-->
<script type="text/javascript">
    $(document).ready(function(){

        $("a.show_div").on('click', function(){
            if ($(this).html() == "-") {
                $(this).html("+")
            } else {
                $(this).html("-")
            }

            $(this).parent().next().toggle();
        });


        $(".hide_div").on('click', function(){
            $(this).parent().next().hide();
        });

        var tot_pro_types = <?php echo $vehicle_makers_count; ?>;
        var loaded_types = 0;
        var plsWaitText = 'Please Wait...';
        $("#more_button").click(function(){   
            if(loaded_types < tot_pro_types - <?php echo $this->config->item('pagination_limit'); ?>)
            {
                var btnText = $("#more_button").text();
                $("#more_button").text(plsWaitText);
                loaded_types += <?php echo $this->config->item('pagination_limit'); ?>;
                $.get("products/get_product_makers/" + loaded_types, function(data){
                    $("#product_maker_block").append(data);
                    $("#more_button").text(btnText);
                    $("#vehicle_makers_num").text($('.vehicle_type_id').length);  
                    $("#checkbox").prop('checked',false);
                    if(loaded_types >= tot_pro_types - <?php echo $this->config->item('pagination_limit'); ?>)
                    {
                        $("#more_button").html(' No more brands to load');					
                    }
                });
            }
 
				
        });
    });
</script>