<script type="text/javascript">
    function redirect_edit_mode(){
        $('#user_block_box').modal('hide');
        if($("#edit_cart_mode_on").html()=="edit_cart_mode_on"){
            window.location.href = '<?php echo base_url(); ?>cart/edittocart';
        }
        else{

            window.location.href = '<?php echo base_url(); ?>cart/index';
        }
        
    }
    $(document).ready(function() {
    
        $("#vehicle_check_all_btn,#vehicle_check_all_btn #checkbox_vehicle").click(function(){  
            var chkbtn = $("#vehicle_check_all_btn #checkbox_vehicle"); 

            if(chkbtn.is(':checked')){
                chkbtn.prop('checked',false);
            }else{
                chkbtn.prop('checked',true);
            }
            
            if($("#vehicle_check_all_btn #checkbox_vehicle").is(':checked')){
                $.each( $(".vehicle_category_image_wrap"), function( key, value ) {                    
                    $(this).find(".vehicle_category_id").attr('value',$(this).find(".product_image_wrap").data('rel'));
                });

                $(".vehicle_category_image_wrap").addClass('boarder_2_red');
                
                $("#vehicle_check_all_btn #checkbox_vehicle").prop('checked',true);

                $(".product_type_image_wrap").removeClass('boarder_2_red');
                $(".product_types_id").attr('value',0);
                $("#product_check_all_btn #checkbox_product_option").prop('checked',false);
                $("#products_catagory_list_form").attr("action", "products/product_type");
            }else{
                $(".vehicle_category_image_wrap").removeClass('boarder_2_red');
                $(".vehicle_category_id").attr('value',0);
                $("#vehicle_check_all_btn #checkbox_vehicle").prop('checked',false);

                $(".product_type_image_wrap").removeClass('boarder_2_red');
                $(".product_types_id").attr('value',0);
                $("#product_check_all_btn #checkbox_product_option").prop('checked',false);
            }
        });

        $("#product_check_all_btn,#product_check_all_btn #checkbox_product_option").click(function(){  
            var chkbtn = $("#product_check_all_btn #checkbox_product_option"); 

            if(chkbtn.is(':checked')){
                chkbtn.prop('checked',false);
            }else{
                chkbtn.prop('checked',true);
            }
            
            if($("#product_check_all_btn #checkbox_product_option").is(':checked')){
                $.each( $(".product_type_image_wrap"), function( key, value ) {                    
                    $(this).find(".product_types_id").attr('value',$(this).find(".product_image_wrap").data('rel'));
                });
                $(".product_type_image_wrap").addClass('boarder_2_red');                
                $("#product_check_all_btn #checkbox_product_option").prop('checked',true);

                $(".vehicle_category_image_wrap").removeClass('boarder_2_red');
                $(".vehicle_category_id").attr('value',0);
                $("#vehicle_check_all_btn #checkbox_vehicle").prop('checked',false);
                $("#products_catagory_list_form").attr("action", "products/vehicle_type");
            }else{
                $(".product_type_image_wrap").removeClass('boarder_2_red');
                $(".product_types_id").attr('value',0);
                $("#product_check_all_btn #checkbox_product_option").prop('checked',false);

                $(".vehicle_category_image_wrap").removeClass('boarder_2_red');
                $(".vehicle_category_id").attr('value',0);
                $("#vehicle_check_all_btn #checkbox_vehicle").prop('checked',false);


            }
        });



    });
</script>
<div class="container">
    <div class="main-page">
        <div style="color: red;"><span style="font-weight:bold; color:black; text-decoration: underline;">Selection instruction : </span><?php echo $selection_instruction[0]->product_msg;?></div>
        <div class="car-lists text-center productbaselisting">
            <div class="col-md-12">
                <?php include('product_timer.php'); ?>  
                <form action="products/product_type" id="products_catagory_list_form" enctype="multipart/form-data" method="post"> 
                    <div class="product-list pull-left"> 
                        <div class="col-md-12">
                            <h3 class="col-md-12"><?php echo lang('Search Products by Vehicle Type') ?></h3>
                            <?php if ($this->comman_model->get_isactive_checkbox('settings', 'id', 1)) { ?>
                                <div id="vehicle_check_all_btn" class="col-md-6 custom_btn" style="margin-left:25%;">
                                    <input id="checkbox_vehicle" type="checkbox" name="vehicle_option[]" value="all">    
                                    Select All Vehicle Type (<span id="vehicle_categories_num"><?php echo count($vehicle_categories); ?></span>)                        
                                </div>
                            <?php } ?>
                        </div>
                        <div class="clearfix"></div>
                        <div class="col-md-12" id="vehicle_type_block">
                            <?php foreach ($vehicle_categories as $vehicle) { ?>
                                <div class="col-md-6 VehicleBlockItems">
                                    <div class="pro-item vehicle_category_image_wrap step1 <?php
                            if (in_array($vehicle['id'], $vehicle_category_ids)) {
                                echo 'boarder_2_red';
                            }
                                ?>">
                                        <div style="height:180px;overflow:hidden;" class="" >
                                            <?php /* ?>front/product_type/<?php echo $vehicle['id'];?><?php */ ?>
                                            <a href="javascript:void(0);" class="product_image_wrap" data-rel="<?php echo $vehicle['id']; ?>">
                                                <img  src="assets/uploads/vehicle_categories/<?php echo $vehicle['VehicleType_Photo']; ?>"  width="165"   id="image_id_<?php echo $vehicle['id']; ?>" alt="<?php echo $vehicle['category_name']; ?>" />
                                            </a>
                                            <input type="hidden" name="vehicle_type_id[]" value="<?php
                                        if (in_array($vehicle['id'], $vehicle_category_ids)) {
                                            echo $vehicle['id'];
                                        }
                                            ?>" class="vehicle_category_id">
                                        </div>
                                        <div class="clearfix"></div>
                                        <a href="javascript:void(0);" class="btn btn-primary btn-sm" ><?php echo $vehicle['category_name']; ?></a>
                                    </div>
                                </div>
                            <?php } ?>

                        </div>
                        <div class="clear"></div> 
                        <?php if ($num_vehicle_type_for_menu > count($vehicle_categories)) { ?>
                            <div id="more_button_vehicle_types" class="load-more-data"> Load more </div> 
                        <?php } ?>
                    </div>
                    <?php //echo "<pre>"; print_r($menu_product_types);  ?>
                    <div class="product-list-or pull-left"><h3><?php echo lang('OR') ?></h3></div>
                    <div class="product-list pull-right">                          
                        <div class="col-md-12">
                            <h3 class="col-md-12"><?php echo lang('Search Products by Product Type') ?></h3>
                            <?php if ($this->comman_model->get_isactive_checkbox('settings', 'id', 1)) { ?>
                                <div id="product_check_all_btn" class="col-md-6 custom_btn"  style="margin-left:25%;">
                                    <input id="checkbox_product_option" type="checkbox" name="product_option[]" value="all">    
                                    Select All Product Type  (<span id="menu_product_types_num"><?php echo count($menu_product_types); ?></span>)                       
                                </div>                        
                            <?php } ?>
                        </div>
                        <div class="clearfix"></div>
                        <div class="col-md-12" id="menu_product_types_block">
                            <?php foreach ($menu_product_types as $pro_type) { ?>

                                <div class="col-md-6 VehicleBlockItems">
                                    <div class="pro-item product_type_image_wrap step1">
                                        <div class=""  style="height:180px;overflow:hidden;" >
                                            <?php /* ?>front/product_type/<?php echo $vehicle['id'];?><?php */ ?>
                                            <a href="javascript:void(0);" class="product_image_wrap" data-rel="<?php echo strtolower(str_replace(' ', '_', $pro_type->product_type_name)); ?>"><img src="assets/uploads/product_type_images/<?php echo $pro_type->Product_Type_Photo; ?>"  width="165"   id="image_product_id_<?php echo $pro_type->id; ?>" alt="<?php echo $pro_type->product_type_name; ?>" /></a>
                                            <input type="hidden" name="product_type_id[]" value="" class="product_types_id">
                                        </div>
                                        <div class="clearfix"></div>
                                        <a href="javascript:void(0);" class="btn btn-primary btn-sm Type_title" ><?php echo $pro_type->product_type_name; ?></a>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                        <div class="clear"></div> 
                        <?php if ($num_product_type_for_menu > count($menu_product_types)) { ?>
                            <div id="more_button_product_types" class="load-more-data"> Load more </div>
                        <?php } ?>

                    </div>
                    <div class="clear"></div> 
                </form>
            </div>
        </div>
<span style="display:none;" id="maincart_block_msg"><?php if (isset($selection_instruction[0]->maincart_block_msg)) echo $selection_instruction[0]->maincart_block_msg;?></span>
  <span style="display:none;" id="editcart_block_msg"><?php if (isset($selection_instruction[0]->editcart_block_msg)) echo $selection_instruction[0]->editcart_block_msg;?></span>
  <span style="display:none;" id="cartpreview_block_msg"><?php if (isset($selection_instruction[0]->cartpreview_block_msg)) echo $selection_instruction[0]->cartpreview_block_msg;?></span>
  <span style="display:none;" id="cartverification_block_msg"><?php if (isset($selection_instruction[0]->cartverification_block_msg)) echo $selection_instruction[0]->cartverification_block_msg;?></span>
  <span style="display:none;" id="block_notification_msg"><?php if (isset($selection_instruction[0]->block_notification_msg)) echo $selection_instruction[0]->block_notification_msg;?></span>
  <span style="display:none;" id="cartverification_resent_block_msg"><?php if (isset($selection_instruction[0]->cartverification_resent_block_msg)) echo $selection_instruction[0]->cartverification_resent_block_msg;?></span>
  <span style="display:none;" id="cartverification_wrong_block_msg"><?php if (isset($selection_instruction[0]->cartverification_wrong_block_msg)) echo $selection_instruction[0]->cartverification_wrong_block_msg;?></span>

        <div class="clearfix"></div>
        <div class="nav-prex-next text-right">
            <div class="row">
                <div class="col-md-12">
                    <a href="javascript:void(0);" class="btn btn-primary btn-sm" id="product_catagory_next"><?php echo lang('Next') ?></a> 
                </div>
            </div>
        </div>

    </div><!--End content-->

</div>  
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
                       <span class="blink"> <?php echo $selection_instruction[0]->selection_popup_header;?> </span>
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
                    <h2 class="title-modal" id="blockMsg1"><?php echo lang('You Have Been Blocked. Please Try After 120 minutes.') ?></h2>

                    <div class="clearfix"></div>
                    <div class="btn-modal">
                        <div class="row">

                            <div class="col-md-12 col-xs-12 text-right">
                                <a href="javascript:void(0)" onClick="redirect_edit_mode();" class="btn btn-primary btn-sm" id="block_confirm_msg1"><?php echo lang('OK') ?> <i class="glyphicon glyphicon-chevron-right"></i></a>  
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

<script type="text/javascript">
    $(document).ready(function(){
        var tot_pro_types = <?php echo $num_product_type_for_menu; ?>;
        var loaded_types = 0;
        var page_limit = <?php echo $this->config->item('pagination_limit'); ?>;
        var plsWaitText = 'Please Wait...';
        $("#more_button_product_types").click(function(){
            if(loaded_types < tot_pro_types - page_limit)
            {   
                var btnText = $("#more_button_product_types").text();
                $("#more_button_product_types").html(' No more product type to load');
                loaded_types += page_limit;
                $("#more_button_product_types").text(plsWaitText);
                $.get("products/get_menu_product_types/" + loaded_types, function(data){
                    $("#menu_product_types_block").append(data);
                    $("#more_button_product_types").text(btnText);
                    $("#menu_product_types_num").text($('.product_types_id').length); 
                    $("#checkbox_product_option").prop('checked',false);
                    if(loaded_types >= tot_pro_types - page_limit)
                    {
                        $("#more_button_product_types").html(' No more product type to load');
                        $("#more_button_vehicle_types").attr('id','');
                    }   
                });
            }
 
				
        });

        var tot_vehicle_types = <?php echo $num_vehicle_type_for_menu; ?>;
        var loaded_messages = 0;
        $("#more_button_vehicle_types").click(function(){
            if(loaded_messages < tot_vehicle_types - <?php echo $this->config->item('pagination_limit'); ?>)
            {   
            
                var vehicleBtnText = $("#more_button_vehicle_types").text();
                $("#more_button_vehicle_types").text(plsWaitText);
                loaded_messages += <?php echo $this->config->item('pagination_limit'); ?>;
                $.get("products/get_vehicle_types/" + loaded_messages, function(data){
                    $("#vehicle_type_block").append(data);
                    $("#more_button_vehicle_types").text(vehicleBtnText);
                    $("#checkbox_vehicle").prop('checked',false);                    
                    $("#vehicle_categories_num").text($('.vehicle_category_id').length);
                    if(loaded_messages >= tot_vehicle_types - <?php echo $this->config->item('pagination_limit'); ?>)
                    {
                        $("#more_button_vehicle_types").html(' No more vehicle type to load');
                        $("#more_button_vehicle_types").attr('id','');
                    }
                });
            }
 
				
        });
    });
</script>