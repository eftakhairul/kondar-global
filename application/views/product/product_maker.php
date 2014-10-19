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
				$('.brandcheckbox').prop('checked',true);
				$('.brandselectcheckbox').prop('checked',true);
            }else{
                $(".product_type_image_wrap").removeClass('boarder_2_red');
                $(".vehicle_type_id").attr('value',0);
                $("#check_all_btn #checkbox").prop('checked',false);
				$('.brandcheckbox').prop('checked',false);
				$('.brandselectcheckbox').prop('checked',false);
            }
        });
		
		$('#productsearch_list_show').on('click', '.brandselectcheckbox', function() {
			 if ($(this).is(':checked'))
			{
				$.each( $(".product_brand_type_"+$(this).val()), function( key, value ) {                    
                    $(this).find(".vehicle_type_id").attr('value',$(this).find(".product_image_wrap").data('rel'));
                });
				$('.product_brand_type_'+$(this).val()).addClass('boarder_2_red');
				
			}
			else
			{
				$('.product_brand_type_'+$(this).val()).removeClass('boarder_2_red');
				$("#check_all_btn #checkbox").prop('checked',false);
				$.each( $(".product_brand_type_"+$(this).val()), function( key, value ) {                    
                    $(this).find(".vehicle_type_id").attr('value','');
                });
			}
	
		});
		
		$('#productsearch_list_show').on('click', '.brandcheckbox', function() {
			 if ($(this).is(':checked'))
			{
				$.each( $(".product_brand_category_"+$(this).val()), function( key, value ) {                    
                    $(this).find(".vehicle_type_id").attr('value',$(this).find(".product_image_wrap").data('rel'));
                });
				$('.product_brand_category_'+$(this).val()).addClass('boarder_2_red');
				
			}
			else
			{
				$('.product_brand_category_'+$(this).val()).removeClass('boarder_2_red');
				$("#check_all_btn #checkbox").prop('checked',false);
				$.each( $(".product_brand_category_"+$(this).val()), function( key, value ) {                    
                    $(this).find(".vehicle_type_id").attr('value','');
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
                                Select All (<span id="vehicle_makers_num"><?php echo $vehicle_makers_count1; ?></span>)
                            </div>                        
                        <?php } ?>
                    </div>
                    <div class="clearfix"></div> 

<div class="canload" id="productsearch_list_show" style="text-align:left; padding:18px;">
 <?php 	
 	foreach ($vehicle_makers as $maker) { 
	$category_id =  $maker['category_id'];
	?>
<h1 style="margin-top:0px;">
<input id="Checkbox_<?php echo $maker['category_id']; ?>" name="Checkbox_<?php echo $maker['category_id']; ?>" type="checkbox" class="brandcheckbox brandcheckbox_<?php echo $maker['category_id']; ?>" value="<?php echo $maker['category_id']; ?>" />
<span style="font-family: Arial; font-size: 22px;">
    <label for="Checkbox_<?php echo $maker['category_id']; ?>">
		<?php echo $maker['category']; ?> 
    </label>
    <img class="brandmodeltitlelogo" src="assets/uploads/vehicle_categories/<?php echo $maker['category_icon']; ?>"   id="image_maker_id_<?php echo $maker['category_id']; ?>" alt="<?php echo $maker['category_icon']; ?>" />                
    <a onclick="showHide('.brand_complete_info_<?php echo $maker['category_id']; ?>')" href="javascript:void(0)">
        <span style="display:inline; color: black;  background-color: whitesmoke;"  class="brand_complete_info_<?php echo $maker['category_id']; ?>_less_img">-</span>
        <span style="display:none; color: black;  background-color: whitesmoke;" class="brand_complete_info_<?php echo $maker['category_id']; ?>_more_img">+</span>
    </a>
    <br/>
</span>
</h1>
 <div class="brand_complete_info brand_complete_info_<?php echo $maker['category_id']; ?>" id="tbl-camry-<?php echo $maker['category_id']; ?>">
    <?php	
		$maker_data1 = get_maker_data1($maker['category_id']);
		if(isset($maker_data1)){
			foreach($maker_data1 as $maker1){
				$type_id =  $maker1['type_id'];
				if (!in_array($type_id,$vehicle_type_id)) continue;
				?>
            <h1 style="margin-top:0px;">
          <input id="Checkbox_model_<?php echo $maker1['type_id']; ?>" name="Checkbox_model_<?php echo $maker1['type_id']; ?>" type="checkbox" class="brandselectcheckbox modelcheckbox_<?php echo $maker1['type_id']; ?> productcheck_<?php echo $category_id; ?>" value="<?php echo $maker1['type_id']; ?>" />
            <span style="font-family: Arial; font-size: 22px;"> 
                <label for="Checkbox_model_<?php echo $maker1['type_id']; ?>"><?php echo $maker1['type']; ?> </label>
                <img class="brandmodeltitlelogo" src="assets/uploads/product_type_images/<?php echo $maker1['type_photo']; ?>"   id="image_model_id_<?php echo $maker1['type']; ?>" alt="<?php echo $maker1['type_photo']; ?>" />
                <a onclick="showHide('.model_table_<?php echo $maker1['type_id']; ?>')" href="javascript:void(0)">
                    <span style="display:inline; color: black;  background-color: whitesmoke;"  class="model_table_<?php echo $maker1['type_id']; ?>_less_img">-</span>
                    <span style="display:none; color: black;  background-color: whitesmoke;"  class="model_table_<?php echo $maker1['type_id']; ?>_more_img">+</span>
                </a>
                <br/>
            </span>
            </h1>
            
                <?php
					$maker_data2 = get_maker_data2($maker1['category_id'],$maker1['type_id']);
					if(isset($maker_data2) && !empty($maker_data2)){
						?>
                         <div id="product_maker_block" class="model_table_<?php echo $maker1['type_id']; ?>">
                        <?php
						foreach($maker_data2 as $maker2)
						{
							
								?>
                               
                      	<div class="col-md-3">
                            <div class="pro-item product_type_image_wrap product_brand_category_<?php echo $category_id ?> product_brand_type_<?php echo $type_id ?> product_type_image_wrap1 singlestep <?php if (in_array($maker2['maker_id'], $product_maker_id)) { echo "boarder_2_red"; } ?>">
                            <div class="" style="height:180px; text-align:center;"><?php /* ?>front/product_list/<?php echo $maker2['id'];?><?php */ ?>
                                <a href="javascript:void(0);" class="product_image_wrap product_image_wrap_type__<?php echo $type_id; ?>" data-rel="<?php echo $type_id.'#'.$maker2['maker_id']; ?>">
                                
                                <img src="assets/uploads/product_maker/<?php echo $maker2['maker_logo']; ?>" alt="" /></a>
                                <input type="hidden" name="vehicle_brand_id[]" value="<?php if (in_array($maker2['id'], $product_maker_id)) {
                            echo $maker2['id'];
                            } ?>" class="vehicle_type_id productcheck_<?php echo $type_id; ?>">
                            </div>
                            <div class="clearfix"></div>
                            <a href="javascript:void(0);" class="btn btn-primary btn-sm"><?php echo $maker2['maker_name']; ?></a>
                            </div>
                           
                            </div>
                           <?php
						} ?>
                        </div><div class="clearfix"></div> 
                        
                        <?php
					}else{ ?>
                    
					<div id="product_maker_block" class="model_table_<?php echo $maker1['type_id']; ?>">Brands not available !	</div>
                    <?php
					}
					
			}
			
		}
	?> </div> <?php
	}
?>
</div>


                    
                    

<?php /*if ($vehicle_makers_count1 > count($vehicle_makers)) { ?>
    <div id="more_button" class="load-more-data"> Load more </div>
<?php }else{ ?>
	<div id="" class="load-more-data"> No more data for load </div>
<?php } */?>
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
        var tot_pro_types = <?php echo $vehicle_makers_count1; ?>;
        var loaded_types = 0;
        var plsWaitText = 'Please Wait...';
        $("#more_button").click(function(){   
            if(loaded_types < tot_pro_types - <?php echo $this->config->item('pagination_limit'); ?>)
            {
                var btnText = $("#more_button").text();
                $("#more_button").text(plsWaitText);
                loaded_types += <?php echo $this->config->item('pagination_limit'); ?>;
                $.get("products/get_product_makers/" + loaded_types, function(data){
				    $("#productsearch_list_show").append(data);
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