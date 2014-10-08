<style>
.error{
  background: url("../images/elements/ui/progress_overlay.png") repeat scroll 0 0%, -moz-linear-gradient(center top , #CD4900 0%, #CD0200 100%) repeat scroll 0 0 rgba(0, 0, 0, 0);
  border-radius: 3px;
  box-shadow: 0 1px 0 rgba(255, 255, 255, 0.3) inset, 0 1px 1px #333333;
  color: #FFFFFF;
  font-size: 12px;
  padding: 9px 35px 8px;
  text-align: center;
}
</style>
<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
<div style="margin-right: 0px;" class="content">
<?php
if($this->session->flashdata('success')) {
    $msg = $this->session->flashdata('success');
?>
    <div class="notice outer">
      <div class="note"><?php echo $msg;?>
      </div>
    </div>
<?php
}
?>    
<?php
if($this->session->flashdata('error')) {
    $msg = $this->session->flashdata('error');
?>
    <div class="notice outer">
      <div class="error"><?php echo $msg;?>
      </div>
    </div>
<?php
}
?>    

<script>
	 function readURL(input) {
			if (input.files && input.files[0]) {
				var reader = new FileReader();
				reader.onload = function (e) {
					$('#typeimg_prvw').attr('src', e.target.result);
					$("#delimagebtn").show();
				}
				reader.readAsDataURL(input.files[0]);
			}
		}
		$(document).ready(function(e) {	
			$("#pro_image").change(function(){
				readURL(this);
				showdelbtn();
			});
			});
			function showdelbtn()
			{
			$("#delimagebtn").html("<input type='button' class='focustip' value='Delete Image' style='padding:2px;' onclick='removeimg();'>");
			//	$("#delimagebtn").show();
			}
			function removeimg()
			{
				$("#typeimg_prvw").attr("src", "./assets/admin/previewimage.jpg");
				$("#delimagebtn").hide();
				del_typeimagepermanently();
			}
 </script> 
 
 <script>
	function del_typeimagepermanently(){
		$.ajax({
				   type: "POST",
				   data:  '',
				   url: "admin/index/delete_typeimage/"+$('#delimageid').val(), 
				   success: function(msg){
					}
				});
		}
</script>    

<style>
	.fieldalign{float:left; width: 250px;}
</style>
    
        <div class="outer">
            <div class="inner">
                <div class="page-header">
		<!-- page title -->
                    <h5><i class="font-user"></i><?php echo $this->lang->line('').'Product Type';?></h5>
            <!-- End page title -->
                <div class="body">

	<?php //var_dump(count($winners_entry));?>
                    <!-- Content container -->
                    <div class="container">
<?php
if(isset($edit_data)&&!empty($edit_data)){

	$privilage=explode('#',$edit_data['menu_privilages']);
	$admin_menuprivilage=explode('#',$edit_data['menu_privilages_admin']);
	

?>
                        <form class="form-horizontal" method="post" enctype="multipart/form-data">
                        	<input type="hidden" name="operation" value="set" />
                            <div class="row-fluid">
                                <input type="hidden" id="delimageid" value="<?php echo $edit_data['id'];?>"/> 
                                <!-- Column -->
                                <div class="span12">
                                    <!-- Time pickers -->
                                    <div class="block well">
                                        <div class="navbar"><div class="navbar-inner"><h5> <?php echo $this->lang->line('').'Edit Product Type';?></h5></div></div>
                                    <div class="control-group">
                                        <label class="control-label">Product Type Name:</label>
                                        <div class="controls"><input id="pro_typename" name="pro_typename" class="focustip span12" type="text" value="<?php echo $edit_data['product_type_name']; ?>" ></div>
						                <span style="color:#F00;"><?php echo form_error('pro_typename'); ?></span>
                                    </div>
                                    
                                     <div class="control-group">
                                        <label class="control-label">Upload Photo:</label>
                                        <div class="controls">
                                        <input id="pro_image" name="pro_image" class="focustip span12" type="file" value="" > 
                                        <?php if($edit_data['Product_Type_Photo']) {?>
                                            <img src="<?php echo './assets/uploads/product_type_images/'.$edit_data['Product_Type_Photo'];?>" id="typeimg_prvw" class="typeimg_prvw" style="width:100px;margin-top: 12px;"/>
                                            <div id="delimagebtn" style="margin-top: 10px;"><input type="button" class="focustip" value="Delete Image" style="padding:2px;" onclick="removeimg();"></div>
                                        <?php } else {?>
                                        	 <img src="./assets/admin/previewimage.jpg" id="typeimg_prvw" class="typeimg_prvw" style="width:100px;margin-top: 12px;"/>
                                            <div id="delimagebtn" style="margin-top: 10px;"><input type="button" class="focustip" value="Delete Image" style="padding:2px;" onclick="removeimg();"></div>
                                        <?php }?> 
                                            </div>
						                <span style="color:#F00;"><?php echo form_error('pro_image'); ?></span>
                                    </div>
                                    
                                    <div class="control-group">
                                        <label class="control-label">Category:</label>
                                        <div class="controls">
                                        	<select name="vehicle_category_id" id="vehicle_category_id" class="focustip span12" >
                                            	<?php foreach($product_catagory as $catagory){?>
                                                	<option value="<?php echo $catagory['id'];?>" <?php if($catagory['id'] == $edit_data['vehicle_category_id']){?> selected="selected"<?php }?>><?php echo $catagory['category_name'];?></option>
                                                <?php }?>
                                            </select>
                                         </div>
						                <span style="color:#F00;"><?php echo form_error('part_number'); ?></span>
                                    </div>
                                    
                                    <div class="control-group">
                                        <label class="control-label">Status:</label>
                                        <div class="controls">
                                           
                                            <input type="checkbox" name="status" value="1" <?php if($edit_data['status'] == 1){ echo 'checked="checked"';}?>  /> 
                                        </div>
						                <span style="color:#F00;"><?php echo form_error('status'); ?></span>
                                    </div>
                                    
                                    
                                     <div class="control-group">
                                        <label class="control-label">Menu items to display: Front End</label>
                                        <div class="controls">
                                        	<div class="fieldalign"><input <?php  if(in_array("kgt_ref_number", $privilage)) { echo 'checked="checked"';} ?>name="menu[]" type="checkbox" class="focustip" value="<?php echo KGT_REFERENCE_NUMBER;?>"/><label style="margin-left:10px;">KGT Ref</label></div>
                                           
                                            <div class="fieldalign"><input <?php  if(in_array("vehicle_category_id", $privilage)) { echo 'checked="checked"';} ?>name="menu[]" type="checkbox" class="focustip" value="<?php echo VEHICLE_CATEGORY;?>" /><label style="margin-left:10px;">KGT Vehicle Category Title</label></div>
                                            
                                        	<div><input <?php  if(in_array("maker_id", $privilage)) { echo 'checked="checked"';} ?>name="menu[]" type="checkbox" class="focustip" value="<?php echo MAKER;?>" /><label style="margin-left:10px;">Vehicle Brand Name</label></div>
                                            <div style="clear:both"></div>
                                        </div>
                                        
                                        <div class="controls">
                                        	<div class="fieldalign"><input <?php  if(in_array("model_id", $privilage)) { echo 'checked="checked"';} ?>name="menu[]" type="checkbox" class="focustip" value="<?php echo MODEL;?>" /><label style="margin-left:10px;">Vehicle Model Name</label></div>
                                            
                                        	<div class="fieldalign"><input <?php  if(in_array("product_type_id", $privilage)) { echo 'checked="checked"';} ?>name="menu[]" type="checkbox" class="focustip" value="<?php echo PRODUCT_TYPE;?>" /><label style="margin-left:10px;">Product Type Title</label></div>
                                            
                                        	<div><input <?php  if(in_array("drawing_photo", $privilage)) { echo 'checked="checked"';} ?>name="menu[]" type="checkbox" class="focustip" value="<?php echo DRAWING_PHOTO;?>"/><label style="margin-left:10px;">Product type drawing photo</label></div>
                                            
                                            <div style="clear:both"></div>
                                        </div>
                                        
                                        <div class="controls">
                                        	<div class="fieldalign"><input <?php  if(in_array("product_photo", $privilage)) { echo 'checked="checked"';} ?>name="menu[]" type="checkbox" class="focustip" value="<?php echo PRODUCT_PHOTO;?>"/><label style="margin-left:10px;">Product Type Photo</label></div>
                                        	<div class="fieldalign"><input <?php  if(in_array("knect", $privilage)) { echo 'checked="checked"';} ?>name="menu[]" type="checkbox" class="focustip" value="<?php echo KNECT;?>"/><label style="margin-left:10px;">Knecht</label></div>
                                        	<div><input <?php  if(in_array("filtron", $privilage)) { echo 'checked="checked"';} ?>name="menu[]" type="checkbox" class="focustip" value="<?php echo FILTRON;?>"/><label style="margin-left:10px;">Filtron</label></div>
                                            <div style="clear:both"></div>
                                        </div>
                                        
                                        <div class="controls">
                                        	<div class="fieldalign"><input <?php  if(in_array("purflux", $privilage)) { echo 'checked="checked"';} ?>name="menu[]" type="checkbox" class="focustip" value="<?php echo PURFLUX;?>"/><label style="margin-left:10px;">Purflux</label></div>
                                        	<div class="fieldalign"><input <?php  if(in_array("mann", $privilage)) { echo 'checked="checked"';} ?>name="menu[]" type="checkbox" class="focustip" value="<?php echo MANN;?>"/><label style="margin-left:10px;">Mann</label></div>
                                        	<div><input <?php  if(in_array("mecafilter", $privilage)) { echo 'checked="checked"';} ?>name="menu[]" type="checkbox" class="focustip" value="<?php echo MECAFILTER;?>"/><label style="margin-left:10px;">Mecafilter</label></div>
                                            <div style="clear:both"></div>
                                        </div>
                                        
                                        <div class="controls">
                                        	<div class="fieldalign"><input <?php  if(in_array("oem_part_number", $privilage)) { echo 'checked="checked"';} ?>name="menu[]" type="checkbox" class="focustip" value="<?php echo OEM_PART_NUMBER;?>"/><label style="margin-left:10px;">OEM Part Number</label></div>
                                        	<div class="fieldalign"><input <?php  if(in_array("application", $privilage)) { echo 'checked="checked"';} ?>name="menu[]" type="checkbox" class="focustip" value="<?php echo APPLICATION;?>"/><label style="margin-left:10px;">Application</label></div>
                                        	<div><input <?php  if(in_array("fleet", $privilage)) { echo 'checked="checked"';} ?>name="menu[]" type="checkbox" class="focustip" value="<?php echo FLEET;?>"/><label style="margin-left:10px;">Fleetguard</label></div>
                                            <div style="clear:both"></div>
                                        </div>
                                        
                                        <div class="controls">
                                        	<div class="fieldalign"><input <?php  if(in_array("baldwin", $privilage)) { echo 'checked="checked"';} ?>name="menu[]" type="checkbox" class="focustip" value="<?php echo BALDWIN;?>"/><label style="margin-left:10px;">Baldwin</label></div>
                                        	<div class="fieldalign"><input <?php  if(in_array("others", $privilage)) { echo 'checked="checked"';} ?>name="menu[]" type="checkbox" class="focustip" value="<?php echo OTHERS;?>"/><label style="margin-left:10px;">Others</label></div>
                                        	<div><input <?php  if(in_array("fmsi_ref_number", $privilage)) { echo 'checked="checked"';} ?>name="menu[]" type="checkbox" class="focustip" value="<?php echo FMSI_REFERENCE_NUMBER;?>"/><label style="margin-left:10px;">FMSI Ref.</label></div>
                                            <div style="clear:both"></div>
                                        </div>
                                        
                                        <div class="controls">
                                        	<div class="fieldalign"><input <?php  if(in_array("year", $privilage)) { echo 'checked="checked"';} ?>name="menu[]" type="checkbox" class="focustip" value="<?php echo YEAR;?>"/><label style="margin-left:10px;">Model Manufacturing Year</label></div>
                                        	<div class="fieldalign"><input <?php  if(in_array("front_rear", $privilage)) { echo 'checked="checked"';} ?>name="menu[]" type="checkbox" class="focustip" value="<?php echo FRONT_REAR;?>"/><label style="margin-left:10px;">Front/rear(wheel)</label></div>
                                        	<div><input <?php  if(in_array("designation", $privilage)) { echo 'checked="checked"';} ?>name="menu[]" type="checkbox" class="focustip" value="<?php echo DESIGNATION;?>"/><label style="margin-left:10px;">Designation</label></div>
                                            <div style="clear:both"></div>
                                        </div>
                                        
                                        <div class="controls">
                                        	<div class="fieldalign"><input <?php  if(in_array("wva", $privilage)) { echo 'checked="checked"';} ?>name="menu[]" type="checkbox" class="focustip" value="<?php echo WVA;?>"/><label style="margin-left:10px;">WVA</label></div>
                                        	<div class="fieldalign"><input <?php  if(in_array("qty", $privilage)) { echo 'checked="checked"';} ?>name="menu[]" type="checkbox" class="focustip" value="<?php echo QTY;?>"/><label style="margin-left:10px;">QTY</label></div>
                                        	<div><input <?php  if(in_array("diameter", $privilage)) { echo 'checked="checked"';} ?>name="menu[]" type="checkbox" class="focustip" value="<?php echo DIAMETER;?>"/><label style="margin-left:10px;">Diameter</label></div>
                                            <div style="clear:both"></div>
                                        </div>
                                        
                                        <div class="controls">
                                        	<div class="fieldalign"><input <?php  if(in_array("width", $privilage)) { echo 'checked="checked"';} ?>name="menu[]" type="checkbox" class="focustip" value="<?php echo WIDTH;?>"/><label style="margin-left:10px;">Width</label></div>
                                        	<div class="fieldalign"><input <?php  if(in_array("holes_no", $privilage)) { echo 'checked="checked"';} ?>name="menu[]" type="checkbox" class="focustip" value="<?php echo HOLES_NO;?>"/><label style="margin-left:10px;">Holes No.</label></div>
                                            <div class="fieldalign"><input <?php  if(in_array("vehicle_photo", $privilage)) { echo 'checked="checked"';} ?>name="menu[]" type="checkbox" class="focustip" value="<?php echo VEHICLE_PHOTO;?>"/><label style="margin-left:10px;">Vehicle Model Photo</label></div>
                                            <div style="clear:both"></div>
                                        </div>
                                        
                                        <div class="controls">
                                        	<div class="fieldalign"><input <?php  if(in_array("vehicle_brand_logo", $admin_menuprivilage)) { echo 'checked="checked"';} ?>name="menu[]" type="checkbox" class="focustip" value="<?php echo VEHICLE_BRAND_LOGO;?>"/><label style="margin-left:10px;">Vehicle Brand Logo</label></div>
                                            
                                        	<div class="fieldalign"><input <?php  if(in_array("vehicle_category_photo", $admin_menuprivilage)) { echo 'checked="checked"';} ?>name="menu[]" type="checkbox" class="focustip" value="<?php echo VEHICLE_CATEGORY_GENERIC_PHOTO;?>"/><label style="margin-left:10px;">KGT Vehicle Category Generic Photo</label></div>
                                            
                                          <div class="fieldalign"><input <?php  if(in_array("product_type_photo", $admin_menuprivilage)) { echo 'checked="checked"';} ?>name="menu[]" type="checkbox" class="focustip" value="<?php echo PRODUCT_TYPE_GENERIC_PHOTO;?>"/><label style="margin-left:10px;">Product Type Generic Photo</label></div>  
                                            
                                            <div style="clear:both"></div>
                                        </div>
                                        
                                     </div>
                                     
                                     
                                     
<!--  ------------------------------------------------------------ back end menus --------------------------------------------------------------    -->                         
                                        
                  					<div class="control-group">
                                        <label class="control-label">Menu items to display in Admin:</label>
                                        <div class="controls">
                                        	<div class="fieldalign" ><input <?php  if(in_array("kgt_ref_number", $admin_menuprivilage)) { echo 'checked="checked"';} ?>name="menuadmin[]" type="checkbox" class="focustip" value="<?php echo KGT_REFERENCE_NUMBER;?>" /><label style="margin-left:10px;">KGT Ref</label></div>
                                            <div class="fieldalign"><input <?php  if(in_array("vehicle_category_id", $admin_menuprivilage)) { echo 'checked="checked"';} ?>name="menuadmin[]" type="checkbox" class="focustip" value="<?php echo VEHICLE_CATEGORY;?>"/><label style="margin-left:10px;">KGT Vehicle Category Title</label></div>
                                        	<div><input <?php if(in_array("maker_id", $admin_menuprivilage)) { echo 'checked="checked"';} ?>name="menuadmin[]" type="checkbox" class="focustip" value="<?php echo MAKER;?>" /><label style="margin-left:10px;">Vehicle Brand Name</label></div>
                                            <div style="clear:both"></div>
                                        </div>
                                        
                                        <div class="controls">
                                        	<div class="fieldalign"><input <?php  if(in_array("model_id", $admin_menuprivilage)) { echo 'checked="checked"';} ?>name="menuadmin[]" type="checkbox" class="focustip" value="<?php echo MODEL;?>"/><label style="margin-left:10px;">Vehicle Model Name</label></div>
                                            
                                        	<div class="fieldalign"><input <?php  if(in_array("product_type_id", $admin_menuprivilage)) { echo 'checked="checked"';} ?>name="menuadmin[]" type="checkbox" class="focustip" value="<?php echo PRODUCT_TYPE;?>" /><label style="margin-left:10px;">Product Type Title</label></div>
                                            
                                        	<div><input <?php  if(in_array("drawing_photo", $admin_menuprivilage)) { echo 'checked="checked"';} ?>name="menuadmin[]" type="checkbox" class="focustip" value="<?php echo DRAWING_PHOTO;?>"/><label style="margin-left:10px;">Product type drawing photo</label></div>
                                            
                                            <div style="clear:both"></div>
                                        </div>
                                        
                                        <div class="controls">
                                        	<div class="fieldalign"><input <?php  if(in_array("product_photo", $admin_menuprivilage)) { echo 'checked="checked"';} ?>name="menuadmin[]" type="checkbox" class="focustip" value="<?php echo PRODUCT_PHOTO;?>"/><label style="margin-left:10px;">Product Type Photo</label></div>
                                        	<div class="fieldalign"><input <?php  if(in_array("knect", $admin_menuprivilage)) { echo 'checked="checked"';} ?>name="menuadmin[]" type="checkbox" class="focustip" value="<?php echo KNECT;?>"/><label style="margin-left:10px;">Knecht</label></div>
                                        	<div><input <?php  if(in_array("filtron", $admin_menuprivilage)) { echo 'checked="checked"';} ?>name="menuadmin[]" type="checkbox" class="focustip" value="<?php echo FILTRON;?>"/><label style="margin-left:10px;">Filtron</label></div>
                                            <div style="clear:both"></div>
                                        </div>
                                        
                                        <div class="controls">
                                        	<div class="fieldalign"><input <?php  if(in_array("purflux", $admin_menuprivilage)) { echo 'checked="checked"';} ?>name="menuadmin[]" type="checkbox" class="focustip" value="<?php echo PURFLUX;?>"/><label style="margin-left:10px;">Purflux</label></div>
                                        	<div class="fieldalign"><input <?php  if(in_array("mann", $admin_menuprivilage)) { echo 'checked="checked"';} ?>name="menuadmin[]" type="checkbox" class="focustip" value="<?php echo MANN;?>"/><label style="margin-left:10px;">Mann</label></div>
                                        	<div><input <?php  if(in_array("mecafilter", $admin_menuprivilage)) { echo 'checked="checked"';} ?>name="menuadmin[]" type="checkbox" class="focustip" value="<?php echo MECAFILTER;?>"/><label style="margin-left:10px;">Mecafilter</label></div>
                                            <div style="clear:both"></div>
                                        </div>
                                        
                                        <div class="controls">
                                        	<div class="fieldalign" style="float:left;width: 250px; "><input <?php  if(in_array("oem_part_number", $admin_menuprivilage)) { echo 'checked="checked"';} ?>name="menuadmin[]" type="checkbox" class="focustip" value="<?php echo OEM_PART_NUMBER;?>"/><label style="margin-left:10px;">OEM Part Number</label></div>
                                            
                                        	<div class="fieldalign"><input <?php  if(in_array("application", $admin_menuprivilage)) { echo 'checked="checked"';} ?>name="menuadmin[]" type="checkbox" class="focustip" value="<?php echo APPLICATION;?>"/><label style="margin-left:10px;">Application</label></div>
                                            
                                        	<div><input <?php  if(in_array("fleet", $admin_menuprivilage)) { echo 'checked="checked"';} ?>name="menuadmin[]" type="checkbox" class="focustip" value="<?php echo FLEET;?>"/><label style="margin-left:10px;">Fleetguard</label></div>
                                            
                                            <div style="clear:both"></div>
                                        </div>
                                        
                                        <div class="controls">
                                        	<div class="fieldalign"><input <?php  if(in_array("baldwin", $admin_menuprivilage)) { echo 'checked="checked"';} ?>name="menuadmin[]" type="checkbox" class="focustip" value="<?php echo BALDWIN;?>"/><label style="margin-left:10px;">Baldwin</label></div>
                                        	<div class="fieldalign"><input <?php  if(in_array("others", $admin_menuprivilage)) { echo 'checked="checked"';} ?>name="menuadmin[]" type="checkbox" class="focustip" value="<?php echo OTHERS;?>"/><label style="margin-left:10px;">Others</label></div>
                                        	<div><input <?php  if(in_array("fmsi_ref_number", $admin_menuprivilage)) { echo 'checked="checked"';} ?>name="menuadmin[]" type="checkbox" class="focustip" value="<?php echo FMSI_REFERENCE_NUMBER;?>"/><label style="margin-left:10px;">FMSI Ref.</label></div>
                                            <div style="clear:both"></div>
                                        </div>
                                        
                                        <div class="controls">
                                        	<div class="fieldalign"><input <?php  if(in_array("year", $admin_menuprivilage)) { echo 'checked="checked"';} ?>name="menuadmin[]" type="checkbox" class="focustip" value="<?php echo YEAR;?>"/><label style="margin-left:10px;">Model Manufacturing Year</label></div>
                                        	<div class="fieldalign"><input <?php  if(in_array("front_rear", $admin_menuprivilage)) { echo 'checked="checked"';} ?>name="menuadmin[]" type="checkbox" class="focustip" value="<?php echo FRONT_REAR;?>"/><label style="margin-left:10px;">Front/rear(wheel)</label></div>
                                        	<div><input <?php  if(in_array("designation", $admin_menuprivilage)) { echo 'checked="checked"';} ?>name="menuadmin[]" type="checkbox" class="focustip" value="<?php echo DESIGNATION;?>"/><label style="margin-left:10px;">Designation</label></div>
                                            <div style="clear:both"></div>
                                        </div>
                                        
                                        <div class="controls">
                                        	<div class="fieldalign"><input <?php  if(in_array("wva", $admin_menuprivilage)) { echo 'checked="checked"';} ?>name="menuadmin[]" type="checkbox" class="focustip" value="<?php echo WVA;?>"/><label style="margin-left:10px;">WVA</label></div>
                                        	<div class="fieldalign"><input <?php  if(in_array("qty", $admin_menuprivilage)) { echo 'checked="checked"';} ?>name="menuadmin[]" type="checkbox" class="focustip" value="<?php echo QTY;?>"/><label style="margin-left:10px;">QTY</label></div>
                                        	<div><input <?php  if(in_array("diameter", $admin_menuprivilage)) { echo 'checked="checked"';} ?>name="menuadmin[]" type="checkbox" class="focustip" value="<?php echo DIAMETER;?>"/><label style="margin-left:10px;">Diameter</label></div>
                                            <div style="clear:both"></div>
                                        </div>
                                        
                                        <div class="controls">
                                        	<div class="fieldalign"><input <?php  if(in_array("width", $admin_menuprivilage)) { echo 'checked="checked"';} ?>name="menuadmin[]" type="checkbox" class="focustip" value="<?php echo WIDTH;?>"/><label style="margin-left:10px;">Width</label></div>
                                        	<div class="fieldalign"><input <?php  if(in_array("holes_no", $admin_menuprivilage)) { echo 'checked="checked"';} ?>name="menuadmin[]" type="checkbox" class="focustip" value="<?php echo HOLES_NO;?>"/><label style="margin-left:10px;">Holes No.</label></div>
                                            <div class="fieldalign"><input <?php  if(in_array("vehicle_photo", $admin_menuprivilage)) { echo 'checked="checked"';} ?>name="menuadmin[]" type="checkbox" class="focustip" value="<?php echo VEHICLE_PHOTO;?>"/><label style="margin-left:10px;">Vehicle Model Photo</label></div>
                                            <div style="clear:both"></div>
                                        </div>
                                        
                                        
                                         <div class="controls">
                                        	<div class="fieldalign"><input <?php  if(in_array("vehicle_brand_logo", $admin_menuprivilage)) { echo 'checked="checked"';} ?>name="menuadmin[]" type="checkbox" class="focustip" value="<?php echo VEHICLE_BRAND_LOGO;?>"/><label style="margin-left:10px;">Vehicle Brand Logo</label></div>
                                        	<div class="fieldalign"><input <?php  if(in_array("vehicle_category_photo", $admin_menuprivilage)) { echo 'checked="checked"';} ?>name="menuadmin[]" type="checkbox" class="focustip" value="<?php echo VEHICLE_CATEGORY_GENERIC_PHOTO;?>"/><label style="margin-left:10px;">KGT Vehicle Category Generic Photo</label></div>
                                          <div class="fieldalign"><input <?php  if(in_array("product_type_photo", $admin_menuprivilage)) { echo 'checked="checked"';} ?>name="menuadmin[]" type="checkbox" class="focustip" value="<?php echo PRODUCT_TYPE_GENERIC_PHOTO;?>"/><label style="margin-left:10px;">Product Type Generic Photo</label></div>  
                                            <div style="clear:both"></div>
                                        </div>
                                        
                                     </div>                  
                                    
                            		<div class="form-actions align-right">
                                        <input class="btn btn-primary" value="Update" id="send" type="submit">
									</div>
		
                                 </div>
                                    </div>
                                    <!-- /time pickers -->


                                    
                                </div>
                                <!-- /column -->
                                
                            </form>
<?php	
}?>
                       <!-- Pickers -->
    				</div>
                        
                        <!-- /pickers -->

                    </div>
                    <!-- /content container -->
                
                </div>
            </div>
        </div>
    </div>