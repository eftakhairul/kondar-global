<style>
select#product_type_id option{ display:none;}
select#product_type_id option.selected{ display:inline;}
.displaynon{ display:none;}
</style>
<script type="text/javascript">
$(document).ready(function(e) { 
	/*$('#vehicle_category_id').change(function(e){
		e.preventDefault();
		get_product_type();
	});*/
	onchange_product_category();
	onchange_product_type();
	onchange_product_maker();
	get_product_type();
	get_product_maker();
	get_product_model();
	
	$('#quicker_search').click(function(e){
		$('#quick_search_form').submit();
	});
	/*$('#product_type_id').change(function(e){
		alert('ssssss');
		get_product_maker();
		e.preventDefault();
	});*/
	
	/*$('#vehicle_category_id').change(function(){
		var selectedcategoryid=$(this).val();
		var selclass="#product_type_id option."+selectedcategoryid;
		alert(selclass);
		$("#product_type_id option").removeClass('selected');
		$(selclass).addClass('selected');
		$("#product_type_id option.selected:first").attr('selected', true);
		AutosetfiledBoxesSelection();
	});
	
	$("#product_type_id").change(function(){
		AutosetfiledBoxesSelection();
	 
	});*/
	
});
function onchange_product_category()
{
	$('#vehicle_category_id').change(function(e){
		get_product_type();
	});
}
function onchange_product_type()
{
	$('#product_type_id').change(function(e){
		get_product_maker();
	});
}
function onchange_product_maker()
{
	$('#maker_id').change(function(e){
		get_product_model();
	});
}
function get_product_type()
{
	var vehicle_category_id =$("#vehicle_category_id").val();
	$.ajax({
			type: "POST",
			data:  '',
			url: "front/product_type_details/"+vehicle_category_id, 
			success: function(msg)
			{
				$('#product_type_span').html(msg);
				
				$('.selectpicker').selectpicker();
				get_product_maker();
				onchange_product_type();
			}
		});
}
function get_product_maker()
{
	var product_type_id =$("#product_type_id").val();
	$.ajax({
			type: "POST",
			data:  '',
			url: "front/product_maker_details/"+product_type_id, 
			success: function(msg)
			{
				$('#product_maker_span').html(msg);
				
				$('.selectpicker').selectpicker();
				get_product_model();
				onchange_product_maker();
			}
		});
}
function get_product_model()
{
	var maker_id =$("#maker_id").val();
	$.ajax({
			type: "POST",
			data:  '',
			url: "front/product_model_details/"+maker_id, 
			success: function(msg)
			{
				$('#product_model_span').html(msg);
				$('.selectpicker').selectpicker();
			}
		});
}
/*function AutosetfiledBoxesSelection()
{
	var element = $("#product_type_id");
	//var myTag = element.attr("prev");
	var selectedoption = $('option:selected', element).attr('prev');
	$(".productfield_display div.control-group").addClass("displaynon");
	var boxestodisplay=selectedoption.split('#');
	for(i=0;i<boxestodisplay.length;i++)
	{
		var currentoption="#"+boxestodisplay[i];
		$(currentoption).removeClass("displaynon");
		
	}		
}*/
</script>
<?php $selectedcat=''; 
	$defaultselectedfileds=''; ?> 
<body onLoad="itemSize();" onResize="onResizeWindow();" >
	<div class="bodywrapper">
        <?php //include 'include/menu.php';?>
        <?php include('/../temp/include/header_child.php');?>

        <div class="container">
        <div class="main-content" style="padding-bottom:20px; background-color: #ebebeb;">
            <div class="container" style="margin-top: -63px;">
                <div class="row">
                    <div class="col-md-12" style="display:inline-block; width:100%">
                        
                        <div class="row">
                        	<form action="products/product_list" method="post" id="quick_search_form">
                            	<input type="hidden" name="quick_search" id="quick_search" value="quick_search">
                            <div class="adv_srch"  style="margin-top:10px;">
                                <div class="col-md-2"><h4 style="padding-top: 0px"> Quick Search </h4></div>
                                <div class="col-md-8">
                                    <!-- <div class="ad_srch1" style="width:126px;">
                                        <select>
                                            <option value="eng" class="opt1">Products 1</option>
                                            <option value="eng" class="opt1">Products 2</option>
                                        </select>
                                    </div> -->
                                    <div class="box-list-select" style="display:inline-block; width:100%; margin-top:-3px">
                                        <div class="col-md-3">
											
                                            <select name="vehicle_category_id[]" id="vehicle_category_id" class="form-control selectpicker">
                                            	<?php foreach($product_catagory as $catagory){?>
                                                	<option value="<?php echo $catagory['id'];?>"><?php echo $catagory['category_name'];?></option>
													<?php 
													if($selectedcat=='')
                                                    	$selectedcat=$catagory['id'];
												}?>
                                            </select>
                                           <!-- <select class="form-control selectpicker">
                                                <option value="eng" class="opt1">Products 1</option>
                                                <option value="eng" class="opt1">Products 2</option>
                                            </select>-->
                                        </div>
                                        <div class="col-md-3">
                                        	<span id="product_type_span">
                                        	<select name="product_type_id[]" id="product_type_id" class="form-control selectpicker">
												<?php
												 foreach($product_types as $product_type){
												?>
                                                    <option value="<?php echo $product_type['id'];?>" class="<?php echo $product_type['cat_id'];?> <?php if($product_type['cat_id']==$selectedcat) echo "selected";?>"  prev="<?php echo $product_type['menu_privilages']; ?>"><?php echo $product_type['product_type_name'];?></option>
                                                <?php 
													if($defaultselectedfileds=='')
                                                    	$defaultselectedfileds="#".$product_type['menu_privilages'];
													}?>
                                            </select>
                                            </span>
                                           <!-- <select class="form-control selectpicker">
                                              <option value="eng" class="opt1">Ceramic Brake Pads</option>
                                            </select>-->
                                        </div>
                                        <div class="col-md-3">
                                        	<span id="product_maker_span">
                                        	<select name="maker_id[]" id="maker_id" class="form-control selectpicker" >
                                            	<?php foreach($product_makers as $make){?>
                                                	<option value="<?php echo $make['id'];?>"><?php echo $make['maker_name'];?></option>
                                                <?php }?>
                                            </select>
                                            </span>
                                            <!--<select class="form-control selectpicker">
                                              <option value="eng" class="opt1">Car</option>
                                            </select>-->
                                        </div>
                                        <div class="col-md-3">
                                        	<span id="product_model_span">
                                                <select name="model_id[]" id="model_id" class="form-control selectpicker" >
                                                    <?php foreach($product_models as $model){?>
                                                        <option value="<?php echo $model['id'];?>"><?php echo $model['model_name'];?></option>
                                                    <?php }?>
                                                </select>
                                           </span>
                                           <!-- <select class="form-control selectpicker">
                                              <option value="eng" class="opt1">Toyota</option>
                                            </select>-->
                                        </div>
                                        <!--<div class="col-md-2">
                                            <select class="form-control selectpicker">
                                              <option value="eng" class="opt1">Land Crusier</option>
                                            </select>
                                        </div>-->
                                    </div>
                                </div>
                                <div class="col-md-1 fix-btn-search-ad">
                                    <button  type="button" class="btn btn-primary btn-search-ad" id="quicker_search">search</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    </form>
                </div><!--End Adv-search-->


                <a href="#"><img src="assets/template/images/chat.png" alt="chat" style="margin-top: -65px; margin-left: -331px; display:none" /></a>
                <div class="clearfix"></div>
                <div class="row" style="margin-top:30px;">

                    <div class="col-md-3 container_left" style="position:relative">
                    	<div class="box-sp">
                            <img src="assets/template/images/call_center_women.png" alt="girl" style="float:left; height:88px;" />
                            <div class="support_24_7">

                                <h1 class="in_support_24_7">24/7</h1>
                                <div style="margin-top:-10px">
                                    <span  style="font-family: arial; font-weight: bold; font-size: 18px;">Support</span>
                                    <img src="assets/template/images/Email_icon.png" alt="email"  style="margin-bottom: 9px; " />
                                </div>
                            </div>
                        </div>
                            
                        <div class="left_side">
                        
                           
                         <h1 style="color: white; font-family: arial; font-size: 17px; padding-top: 4px; padding-left: 34px;">GET FREE QUOTE NOW</h1>
                            <div style="margin-top: -13px; padding-left: 3px;">
							<!--1 country-->
<?php /*?><?php
date_default_timezone_set('America/Vancouver');
?>
                            <div style="padding-top: 12px; padding-left: 4px; width: 25px;">
                                <img src="assets/template/images/flag_1.png" alt="" />
                            </div>
                            <div style="padding-left: 44px; margin-top: -20px;">
                                <span  style="color: white; font-family: arial; font-weight: bold; padding-top: 21px; text-align: start; font-size: 12px;">VANCOUVER <br /></span>
                                <span style="color: white; font-family: arial; padding-top: 21px; text-align: start; font-size: 9px;"><?php echo date('h:i:s, l');?></span>
                            </div>
                            <div style="width: 7px; padding-left: 138px; margin-top: -19px;">
                                <img src="assets/template/images/horizental_seperator.png" />
                            </div>
                            <div  style="padding-left: 152px; margin-top: -40px;">
                                    <span  style="color: white; font-family: arial; padding-top: 21px; font-size: 11px; font-weight: bold;">+1-604-360-8805 <br> </span>
                                    <span  style="color: white; font-family: arial; font-weight: bold; padding-top: 21px; font-size: 8px; letter-spacing: 0.5px;"><?php echo date('F j, Y');?></span>
                              </div>
                            <div style="margin-top: 3px; margin-left: 66px;"><img src="assets/template/images/left_seperator.png" alt="" /></div>
                            <!--end country-->
                            <!--2 country-->
<?php
date_default_timezone_set('Europe/London');
?>
                            <div style="padding-top: 12px; padding-left: 4px; width: 25px;"><img src="assets/template/images/flag_2.png" alt="" /></div>
                            <div style="padding-left: 42px; margin-top: -40px;">
                                <span  style="color: white; font-family: arial; font-weight: bold; padding-top: 21px; text-align: start; font-size: 12px;">LONDON <br /></span>
                                <span style="color: white; font-family: arial; padding-top: 21px; text-align: start; font-size: 9px;"><?php echo date('h:i:s, l');?></span>
                            </div>
                            <div style="width: 7px; padding-left: 138px; margin-top: -19px;"><img src="assets/template/images/horizental_seperator.png" /></div>
                            <div  style="padding-left: 152px;  margin-top: -41px;">
                                   <span  style="color: white; font-family: arial; padding-top: 21px; font-size: 11px; font-weight: bold;">+1-604-360-8805 <br> </span>
                                    <span  style="color: white; font-family: arial; font-weight: bold; padding-top: 21px; font-size: 8px; letter-spacing: 0.5px;"><?php echo date('F j, Y');?></span>
                            </div>
                            <div style="margin-top: 6px; margin-left: 66px;"><img src="assets/template/images/left_seperator.png" alt="" /></div>
                            <!--end country-->
                            <!--3 country-->
<?php
date_default_timezone_set('Asia/Dubai');
?>
                            <div style="padding-top: 12px; padding-left: 4px; width: 25px;"><img src="assets/template/images/flag_3.png" alt="" /></div>
                            <div style=" padding-left: 41px; margin-top: -40px;">
                                <span  style="color: white; font-family: arial; font-weight: bold; padding-top: 21px; text-align: start; font-size: 12px;">DUBAI <br /></span>
                                <span style="color: white; font-family: arial; padding-top: 21px; text-align: start; font-size: 9px;"><?php echo date('h:i:s, l');?></span>
                           </div>
                            <div style="width: 7px; padding-left: 138px; margin-top: -19px;"><img src="assets/template/images/horizental_seperator.png" /></div>
                            <div  style="padding-left: 152px;  margin-top: -41px;">
                                   <span  style="color: white; font-family: arial; padding-top: 21px; font-size: 11px; font-weight: bold;">+1-604-360-8805 <br> </span>
                                    <span  style="color: white; font-family: arial; font-weight: bold; padding-top: 21px; font-size: 8px; letter-spacing: 0.5px;"><?php echo date('F j, Y');?></span>
                            </div>
                            <div style="margin-top: 6px; margin-left: 66px;"><img src="assets/template/images/left_seperator.png" alt="" /></div>
                            <!--end country-->
                            <!--4country-->
<?php
date_default_timezone_set('Africa/Tunis');
?>
                            <div style="padding-top: 12px; padding-left: 4px; width: 25px;"><img src="assets/template/images/flag_4.png" alt="" /></div>
                            <div style=" padding-left: 41px; margin-top: -41px;">
                                <span  style="color: white; font-family: arial; font-weight: bold; padding-top: 21px; text-align: start; font-size: 12px;">TUNIS <br /></span>
                                <span style="color: white; font-family: arial; padding-top: 21px; text-align: start; font-size: 9px;"><?php echo date('h:i:s, l');?></span>
                            </div>
                            <div style="width: 7px; padding-left: 138px; margin-top: -19px;"><img src="assets/template/images/horizental_seperator.png" /></div>
                            <div  style="padding-left: 152px; ; margin-top: -41px; padding-bottom:5px;">
                                   <span  style="color: white; font-family: arial; padding-top: 21px; font-size: 11px; font-weight: bold;">+1-604-360-8805 <br> </span>
                                    <span  style="color: white; font-family: arial; font-weight: bold; padding-top: 21px; font-size: 8px; letter-spacing: 0.5px;"><?php echo date('F j, Y');?></span>
                            </div>
<?php */?> 

                            <div style="padding-top: 12px; padding-left: 4px; width: 25px;">
                                <img src="assets/template/images/flag_1.png" alt="" />
                            </div>
                            <div style="padding-left: 44px; margin-top: -20px;">
                                <span  style="color: white; font-family: arial; font-weight: bold; padding-top: 21px; text-align: start; font-size: 12px;">VANCOUVER <br /></span>
                                <span id="timeActive2" style="color: white; font-family: arial; padding-top: 21px; text-align: start; font-size: 9px;"></span>
                            </div>
                            <div style="width: 7px; padding-left: 138px; margin-top: -19px;">
                                <img src="assets/template/images/horizental_seperator.png" />
                            </div>
                            <div  style="padding-left: 152px; margin-top: -40px;">
                                    <span  style="color: white; font-family: arial; padding-top: 21px; font-size: 11px; font-weight: bold;">+1-604-360-8805 <br> </span>
                                    <span id="dateActive2"  style="color: white; font-family: arial; font-weight: bold; padding-top: 21px; font-size: 8px; letter-spacing: 0.5px;"></span>
                              </div>
                            <div style="margin-top: 3px; margin-left: 66px;"><img src="assets/template/images/left_seperator.png" alt="" /></div>
                            <!--end country-->
                            <!--2 country-->
                            <div style="padding-top: 12px; padding-left: 4px; width: 25px;"><img src="assets/template/images/flag_2.png" alt="" /></div>
                            <div style="padding-left: 42px; margin-top: -40px;">
                                <span  style="color: white; font-family: arial; font-weight: bold; padding-top: 21px; text-align: start; font-size: 12px;">LONDON <br /></span>
                                <span id="timeActive1" style="color: white; font-family: arial; padding-top: 21px; text-align: start; font-size: 9px;"></span>
                            </div>
                            <div style="width: 7px; padding-left: 138px; margin-top: -19px;"><img src="assets/template/images/horizental_seperator.png" /></div>
                            <div  style="padding-left: 152px;  margin-top: -41px;">
                                   <span  style="color: white; font-family: arial; padding-top: 21px; font-size: 11px; font-weight: bold;">+1-604-360-8805 <br> </span>
                                    <span id="dateActive1"  style="color: white; font-family: arial; font-weight: bold; padding-top: 21px; font-size: 8px; letter-spacing: 0.5px;"></span>
                            </div>
                            <div style="margin-top: 6px; margin-left: 66px;"><img src="assets/template/images/left_seperator.png" alt="" /></div>
                            <!--end country-->
                            <!--3 country-->
                            <div style="padding-top: 12px; padding-left: 4px; width: 25px;"><img src="assets/template/images/flag_3.png" alt="" /></div>
                            <div style=" padding-left: 41px; margin-top: -40px;">
                                <span  style="color: white; font-family: arial; font-weight: bold; padding-top: 21px; text-align: start; font-size: 12px;">DUBAI <br /></span>
                                <span id="timeActive3" style="color: white; font-family: arial; padding-top: 21px; text-align: start; font-size: 9px;"></span>
                           </div>
                            <div style="width: 7px; padding-left: 138px; margin-top: -19px;"><img src="assets/template/images/horizental_seperator.png" /></div>
                            <div  style="padding-left: 152px;  margin-top: -41px;">
                                   <span  style="color: white; font-family: arial; padding-top: 21px; font-size: 11px; font-weight: bold;">+1-604-360-8805 <br> </span>
                                    <span id="dateActive3" style="color: white; font-family: arial; font-weight: bold; padding-top: 21px; font-size: 8px; letter-spacing: 0.5px;"></span>
                            </div>
                            <div style="margin-top: 6px; margin-left: 66px;"><img src="assets/template/images/left_seperator.png" alt="" /></div>
                            <!--end country-->
                            <!--4country-->
                            <div style="padding-top: 12px; padding-left: 4px; width: 25px;"><img src="assets/template/images/flag_4.png" alt="" /></div>
                            <div style=" padding-left: 41px; margin-top: -41px;">
                                <span  style="color: white; font-family: arial; font-weight: bold; padding-top: 21px; text-align: start; font-size: 12px;">TUNIS <br /></span>
                                <span id="timeActive4" style="color: white; font-family: arial; padding-top: 21px; text-align: start; font-size: 9px;"></span>
                            </div>
                            <div style="width: 7px; padding-left: 138px; margin-top: -19px;"><img src="assets/template/images/horizental_seperator.png" /></div>
                            <div  style="padding-left: 152px; ; margin-top: -41px; padding-bottom:5px;">
                                   <span  style="color: white; font-family: arial; padding-top: 21px; font-size: 11px; font-weight: bold;">+1-604-360-8805 <br> </span>
                                    <span id="dateActive4" style="color: white; font-family: arial; font-weight: bold; padding-top: 21px; font-size: 8px; letter-spacing: 0.5px;"></span>
                            </div>

                           <!--end country-->
                            </div>
                            
                            
                           
                                
                            
                           
                                <span style="color: white; font-family: arial; font-size: 10px; font-weight: bold; padding-top: 21px; text-align: start;"></span>
                            
                            </div>
                       </div>
                    <div class="col-md-6" style="padding:0px">
                        <div class="container_center" style="padding:20px 15px">
<?php
if(isset($page_data)&&!empty($page_data)){
	foreach($page_data as $set_data){
		if($set_data['type']!='career'){		
?>
            <div class="about">
               <h2 style="font-family: arial; color: #de0200; height: 8px; font-size: 18px; font-weight: bold;text-transform:uppercase"><?php echo $set_data['type'];?></h2>
                <p><?php echo $set_data['sort'];?></p>
                <div class="nav-prex-next text-right">
	        		<div class="row">
	        			<div class="col-md-12">
	        				<a class="" style="color:#DE0200;text-decoration:underline" href="front/page/<?php echo $set_data['type'];?>">Read More>></a>	
	        			</div>
	        		</div>
	        	</div>
            </div>
<?php
		}
	}
}
?>
                        	
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="container_right">
                        <!-- <img src="assets/template/images/bussiness_women.png" alt=" " style="float: right; margin-top: -154px; margin-right: -2px;" /> -->
                              <a href="#">  <div class="box1">
                                <img src="assets/template/images/warranty_icon.png" alt="" />
                                	<h6> Get Free Shipping Now </h6>
                                </div>  </a>
                                
                                
                             <a href="#" >  <div class="box2">
                                <img src="assets/template/images/Laptop_icon.png" alt="" />
                                <h6> Win a Laptop </h6>
                                </div></a>
                        
                        
                            <a href="#"><div class="box3">
                                <img src="assets/template/images/Free_shipping_icon.png" alt="" />
                            <h6> Discover our Warranty </h6>
                            </div></a>
                        
                        
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="slider2">
                                <img src="assets/template/images/button1.png" alt="" style=" box-shadow: -3px -4px 3px gray;  margin-left: 14px; margin-top: -8px;position:absolute" />
<?php
if($all_data['library_image']!=''){
?>
<?php /*?><img class="background" src="<?php echo 'assets/uploads/background/full/'.$all_data['background_image'];?>" /><?php */?>

<img class="background" src="<?php echo 'assets/uploads/background/full/'.$all_data['library_image'];?>" />
<?php
}
?>
<script type="text/javascript" src="assets/template/js/jskgt.js"></script>

							<div id="content">
                                <div id="container">
                                  <div id="carousel"></div>
                                </div>
                            </div>
                            
                            </div>
                        </div>
                    </div>
            </div>
        </div><!--End content-->
        </div>

        