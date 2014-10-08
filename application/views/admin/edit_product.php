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
select#product_type_id option{ display:none;}
select#product_type_id option.selected{ display:inline;}
.displaynon{ display:none;}

</style>
<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>

<script>
	function readURL(input,wrapper) {
	if (input.files && input.files[0]) {
		var reader = new FileReader();
		reader.onload = function (e) {
			$('#'+wrapper).attr('src', e.target.result);
			showdelbtn(wrapper);
		}
		reader.readAsDataURL(input.files[0]);
		}
	}
	$(document).ready(function(e) { 
		$('#vehicle_category_id').change(function(){
			var selectedcategoryid=$(this).val();
			var selclass="#product_type_id option."+selectedcategoryid;
			//alert(selclass);
			//$(this).val();
			$("#product_type_id option").removeClass('selected');
			$(selclass).addClass('selected');
			$("#product_type_id option.selected:first").attr('selected', true);
			AutosetfiledBoxesSelection();
		});
			
		$("#product_type_id").change(function(){
            AutosetfiledBoxesSelection();
		});
		//readyfunctns();
		$("#drawing_photo_img").change(function(){
			readURL(this,'modelimg_prvw1');
			//showdelbtn(this);
		});
		$("#product_photo_img").change(function(){
			readURL(this,'modelimg_prvw2');
			//showdelbtn(this);
		});
		$("#vehicle_photo_img").change(function(){
			readURL(this,'modelimg_prvw3');
			//showdelbtn(this);
		});
	});
	function AutosetfiledBoxesSelection()
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
	}
   function showdelbtn(wrapper)
   {
   		$('#'+wrapper+'_delete').show();
		$('#'+wrapper+'_delete').html('<input type="button" class="focustip" value="Delete Image" style="padding:0px;" onclick="removeimg(\''+wrapper+'\');">');
   }
   function removeimg(wrapper)
   {
   		$('#'+wrapper).attr("src", "./assets/admin/previewimage.jpg");
		$('#'+wrapper+'_delete').hide();
		if(wrapper=='modelimg_prvw1')
		{
			$("#drawing_photo_img").val('');
			var imagetodelete='drawing_photo';
			del_productimagepermanently(imagetodelete);
		}	
		if(wrapper=='modelimg_prvw2')
		{
			$("#product_photo_img").val('');
			var imagetodelete='product_photo';
			del_productimagepermanently(imagetodelete);
		}		
		if(wrapper=='modelimg_prvw3')
		{
			$("#vehicle_photo_img").val('');
			var imagetodelete='vehicle_photo';
			del_productimagepermanently(imagetodelete);
		}	
   }
       // not used ajax function - now changed with jquery
	function setmenufields()
	{
	
		$.ajax({
			type: "POST",
			data:  '',
			url: "admin/index/listfields/"+$('#product_type_id').val(), 
			success: function(msg)
			{
				$('.productfield_display').html(msg);
				readyfunctns();
			}
		});
	}
   function readyfunctns()
	{
		/*$('#product_type_id').change(function(){
			setmenufields();
		})*/;
	}

	function del_productimagepermanently(imagetodelete)
	{
		$.ajax({
		   type: "POST",
		   data:  '',
		   url: "admin/index/delete_productimagepermanently/"+$('#delimageid').val()+"/"+imagetodelete, 
		   success: function(msg){
			}
		});
	}
</script>  
 

 
 
 
 
 
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
  <?php $selectedcat=''; 

		$defaultselectedfileds=''; ?> 

    
        <div class="outer">
            <div class="inner">
                <div class="page-header">
		<!-- page title -->
                    <h5><i class="font-user"></i><?php echo $this->lang->line('').'Product';?></h5>
            <!-- End page title -->
                <div class="body">

	<?php //var_dump(count($winners_entry));?>
                    <!-- Content container -->
                    <div class="container">
                    
<?php
if(isset($edit_data)&&!empty($edit_data)){
?>
                        <form class="form-horizontal" method="post" enctype="multipart/form-data">
                        	<input type="hidden" name="operation" value="set" />
                            <div class="row-fluid">
                                <input type="hidden" id="delimageid" value="<?php echo $edit_data['id'];?>"/> 
                                <!-- Column -->
                                <div class="span12">
                                    <!-- Time pickers -->
                                    <div class="block well">
                                        <div class="navbar"><div class="navbar-inner"><h5> <?php echo $this->lang->line('').'Edit Product';?></h5></div>
                                       <input type="hidden" name="productid" id="productid" value="<?php echo $edit_data['id'];?>" />
                                    </div>
                                   
                                    <div class="control-group">
                                        <label class="control-label">KGT Vehicle Category Title:</label>
                                        <div class="controls">
                                   
                                        	<select name="vehicle_category_id" id="vehicle_category_id" class="focustip span12" >
                                            	<?php foreach($product_catagory as $catagory){?>
                                                	<option value="<?php echo $catagory['id'];?>" <?php if($catagory['id'] == $edit_data['vehicle_category_id']){?> selected="selected"<?php }?>><?php echo $catagory['category_name'];?></option>
                                                <?php 
												if($catagory['id'] == $edit_data['vehicle_category_id'] || $selectedcat=='')
                                                    	$selectedcat=$catagory['id'];
							}?>
                                            </select>
                                         </div>
						                <span style="color:#F00;"><?php echo form_error('part_number'); ?></span>
                                    </div>
                                     <div class="control-group">
                                        <label class="control-label">Product Type Title:</label>
                                        <div class="controls">
                                            <select name="product_type_id" id="product_type_id" class="focustip span12" >
												<?php foreach($product_types as $product_type){?>
                                                    <option value="<?php echo $product_type['id'];?>" <?php if($product_type['id'] == $edit_data['product_type_id']){?> selected="selected"<?php }?>  class="<?php echo $product_type['cat_id'];?> <?php if($product_type['cat_id']==$selectedcat) echo "selected";?>" prev="<?php echo $product_type['menu_privilages_admin']; ?>"><?php echo $product_type['product_type_name'];?></option>
                                                <?php 
						
													if($product_type['id'] == $edit_data['product_type_id'] || $defaultselectedfileds=='')
                                                    	$defaultselectedfileds="#".$product_type['menu_privilages_admin'];
												}?>
                                            </select>
                                        </div>
						                <span style="color:#F00;"><?php echo form_error('product_type_id'); ?></span>
                                    </div>
                                   <div class="productfield_display">
                                        <div class="control-group <?php if( strpos($defaultselectedfileds,"kgt_ref_number")<=0) {echo 'displaynon';}?>" id="kgt_ref_number">
                                        <label class="control-label">KGT Ref.:</label>
                                        <div class="controls"><input id="kgt_ref_number" name="kgt_ref_number" class="focustip span12" type="text" value="<?php echo $edit_data['kgt_ref_number']; ?>"  ></div>
						                <span style="color:#F00;"><?php echo form_error('kgt_ref_number'); ?></span>
                                    </div>
                                    
                                    
	                                    <div class="control-group <?php if( strpos($defaultselectedfileds,"maker_id")<=0) { echo 'displaynon';}?>" id="maker_id">
                                        <label class="control-label">Vehicle Brand Name:</label>
                                        <div class="controls">
                                            <select name="maker_id" id="maker_id" class="focustip span12" >
                                            	<?php foreach($product_makers as $make){?>
                                                	<option value="<?php echo $make['id'];?>" <?php if($make['id'] == $edit_data['maker_id']){?> selected="selected"<?php }?>><?php echo $make['maker_name'];?></option>
                                                <?php }?>
                                            </select>
                                        </div>
						                <span style="color:#F00;"><?php echo form_error('maker_id'); ?></span>
                                    </div>
                                  
                                  
	                                    <div class="control-group <?php if( strpos($defaultselectedfileds,"model_id")<=0) { echo 'displaynon';}?>" id="model_id">
                                        <label class="control-label">Vehicle Model Name:</label>
                                        <div class="controls">
                                        <select name="model_id" id="model_id" class="focustip span12" >
											<?php foreach($product_models as $model){?>
                                                <option value="<?php echo $model['id'];?>" <?php if($model['id'] == $edit_data['model_id']){?> selected="selected"<?php }?>><?php echo $model['model_name'];?></option>
                                            <?php }?>
                                        </select>
                                        </div>
						                <span style="color:#F00;"><?php echo form_error('model_id'); ?></span>
                                    </div>
                                    
				
				
				<div class="control-group <?php if( strpos($defaultselectedfileds,"drawing_photo")<=0) { echo 'displaynon';}?>" id="drawing_photo">
                                        <label class="control-label">Product Type Drawing Photo:</label>
                                        <div class="controls">
                                        	<input id="drawing_photo_img" name="drawing_photo" class="focustip span12" type="file">
                                            
                                            <?php 
											if($edit_data['drawing_photo']!="") {
												$src='./assets/uploads/product_images/'.$edit_data['drawing_photo']; ?>
												<img id="modelimg_prvw1" src="<?php echo $src; ?>" alt=" image preview" style="width: 115px;height: 90px;margin-top: 12px;"/>
                                                <div id="modelimg_prvw1_delete" style="margin-top: 10px;">
                                                    <input type="button" class="focustip" value="Delete Image" style="padding:0px;" onclick="removeimg('modelimg_prvw1');">
                                                </div>    
											<?php }
											else
											{
												$src='./assets/admin/previewimage.jpg'; ?>
												<img id="modelimg_prvw1" src="<?php echo $src; ?>" alt=" image preview" style="width: 115px;height: 90px;margin-top: 12px;"/>
                                                <div id="modelimg_prvw1_delete" style="margin-top: 10px;"></div>
												
											<?php }
											
                                             ?>
                                        </div>
						                <span style="color:#F00;"><?php echo form_error('drawing_photo'); ?></span>
                                    </div>
                                    
	                                     <div class="control-group <?php if( strpos($defaultselectedfileds,"product_photo")<=0) { echo 'displaynon';}?>" id="product_photo">
                                        <label class="control-label">Product Type Photo:</label>
                                        <div class="controls">
                                            <input id="product_photo_img" name="product_photo" class="focustip span12" type="file" >
                                            <?php if($edit_data['product_photo']!="") {
												$src='./assets/uploads/product_images/'.$edit_data['product_photo']; ?>
												<img id="modelimg_prvw2" src="<?php echo $src; ?>" alt=" image preview" style="width: 115px;height: 90px;margin-top: 12px;"/>
                                                <div id="modelimg_prvw2_delete" style="margin-top: 10px;">
                                                    <input type="button" class="focustip" value="Delete Image" style="padding:0px;" onclick="removeimg('modelimg_prvw2');">
                                                </div>    
											<?php }
											else
											{
												$src='./assets/admin/previewimage.jpg'; ?>
												<img id="modelimg_prvw2" src="<?php echo $src; ?>" alt=" image preview" style="width: 115px;height: 90px;margin-top: 12px;"/>
                                                <div id="modelimg_prvw2_delete" style="margin-top: 10px;"></div>
												
											<?php } ?>
                                        </div>
						                <span style="color:#F00;"><?php echo form_error('product_photo'); ?></span>
                                    </div>
                                  
	                                    <div class="control-group <?php if( strpos($defaultselectedfileds,"vehicle_photo")<=0) { echo 'displaynon';}?>" id="vehicle_photo">
                                  
                               
                                        <label class="control-label">Vehicle Model Photo:</label>
                                        <div class="controls">
                                            <input id="vehicle_photo_img" name="vehicle_photo" class="focustip span12" type="file" >
                                            <?php if($edit_data['vehicle_photo']!="") {
												$src='./assets/uploads/product_images/'.$edit_data['vehicle_photo']; ?>
												<img id="modelimg_prvw3" src="<?php echo $src; ?>" alt=" image preview" style="width: 115px;height: 90px;margin-top: 12px;"/>
                                                <div id="modelimg_prvw3_delete" style="margin-top: 10px;">
                                                    <input type="button" class="focustip" value="Delete Image" style="padding:0px;" onclick="removeimg('modelimg_prvw3');">
                                                </div>    
											<?php }
											else
											{
												$src='./assets/admin/previewimage.jpg'; ?>
												<img id="modelimg_prvw3" src="<?php echo $src; ?>" alt=" image preview" style="width: 115px;height: 90px;margin-top: 12px;"/>
                                                <div id="modelimg_prvw3_delete" style="margin-top: 10px;"></div>
												
											<?php } ?>
                                        </div>
						                <span style="color:#F00;"><?php echo form_error('product_photo'); ?></span>
                                    </div>
                                  
	                                    <div class="control-group <?php if( strpos($defaultselectedfileds,"knect")<=0) { echo 'displaynon';}?>" id="knect">
                                  
                                   
                                        <label class="control-label">Knecht:</label>
                                        <div class="controls"><input id="knect" name="knect" class="focustip span12" type="text" value="<?php echo $edit_data['knect']; ?>" ></div>
						                <span style="color:#F00;"><?php echo form_error('knect'); ?></span>
                                    </div>
                                    
	                                    <div class="control-group <?php if( strpos($defaultselectedfileds,"filtron")<=0) { echo 'displaynon';}?>" id="filtron">
                                        <label class="control-label">Filtron:</label>
                                        <div class="controls"><input id="filtron" name="filtron" class="focustip span12" type="text" value="<?php echo $edit_data['filtron']; ?>" ></div>
						                <span style="color:#F00;"><?php echo form_error('filtron'); ?></span>
                                    </div>
                                    
	                                    <div class="control-group <?php if( strpos($defaultselectedfileds,"purflux")<=0) { echo 'displaynon';}?>" id="purflux">
                                        <label class="control-label">Purflux:</label>
                                        <div class="controls"><input id="purflux" name="purflux" class="focustip span12" type="text" value="<?php echo $edit_data['purflux']; ?>" ></div>
						                <span style="color:#F00;"><?php echo form_error('purflux'); ?></span>
                                    </div>
                                    
	                                    <div class="control-group <?php if( strpos($defaultselectedfileds,"mann")<=0) { echo 'displaynon';}?>" id="mann">
                                        <label class="control-label">Mann:</label>
                                        <div class="controls"><input id="mann" name="mann" class="focustip span12" type="text" value="<?php echo $edit_data['mann']; ?>" ></div>
						                <span style="color:#F00;"><?php echo form_error('mann'); ?></span>
                                    </div>
                                    
	                                    <div class="control-group <?php if( strpos($defaultselectedfileds,"mecafilter")<=0) { echo 'displaynon';}?>" id="mecafilter">
                                        <label class="control-label">Mecafilter:</label>
                                        <div class="controls">
                                            <input id="mecafilter" name="mecafilter" class="focustip span12" type="text" value="<?php echo $edit_data['mecafilter']; ?>" >
                                        </div>
						                <span style="color:#F00;"><?php echo form_error('mecafilter'); ?></span>
                                    </div>
                                  
                                  
	                                    <div class="control-group <?php if( strpos($defaultselectedfileds,"oem_part_number")<=0) { echo 'displaynon';}?>" id="oem_part_number">
                                        <label class="control-label">OEM Part Number:</label>
                                        <div class="controls"><input id="oem_part_number" name="oem_part_number" class="focustip span12" type="text" value="<?php echo $edit_data['oem_part_number']; ?>" ></div>
						                <span style="color:#F00;"><?php echo form_error('oem_part_number'); ?></span>
                                    </div>
                                    
	                                     <div class="control-group <?php if( strpos($defaultselectedfileds,"application")<=0) { echo 'displaynon';}?>" id="application">
                                        <label class="control-label">Application:</label>
                                        <div class="controls"><input id="application" name="application" class="focustip span12" type="text" value="<?php echo $edit_data['application']; ?>" ></div>
						                <span style="color:#F00;"><?php echo form_error('application'); ?></span>
                                    </div>
                                    
	                                     <div class="control-group <?php if( strpos($defaultselectedfileds,"fleet")<=0) { echo 'displaynon';}?>" id="fleet">
                                        <label class="control-label">Fleetguard:</label>
                                        <div class="controls"><input id="fleet" name="fleet" class="focustip span12" type="text" value="<?php echo $edit_data['fleet']; ?>" ></div>
						                <span style="color:#F00;"><?php echo form_error('fleet'); ?></span>
                                    </div>
                                    
	                                     <div class="control-group <?php if( strpos($defaultselectedfileds,"baldwin")<=0) { echo 'displaynon';}?>" id="baldwin">
                                        <label class="control-label">Baldwin:</label>
                                        <div class="controls"><input id="baldwin" name="baldwin" class="focustip span12" type="text" value="<?php echo $edit_data['baldwin']; ?>" ></div>
						                <span style="color:#F00;"><?php echo form_error('baldwin'); ?></span>
                                    </div>
                                    
	                                    <div class="control-group <?php if( strpos($defaultselectedfileds,"others")<=0) { echo 'displaynon';}?>" id="others">
                                        <label class="control-label">Others:</label>
                                        <div class="controls">
                                            <input id="others" name="others" class="focustip span12" type="text" value="<?php echo $edit_data['others']; ?>" >
                                        </div>
						                <span style="color:#F00;"><?php echo form_error('others'); ?></span>
                                    </div>
                                  
                                  
	                                    <div class="control-group <?php if( strpos($defaultselectedfileds,"fmsi_ref_number")<=0) { echo 'displaynon';}?>" id="fmsi_ref_number">
                                        <label class="control-label">FMSI Ref:</label>
                                        <div class="controls"><input id="fmsi_ref_number" name="fmsi_ref_number" class="focustip span12" type="text" value="<?php echo $edit_data['fmsi_ref_number']; ?>" ></div>
						                <span style="color:#F00;"><?php echo form_error('fmsi_ref_number'); ?></span>
                                    </div>
                                    
	                                    <div class="control-group <?php if( strpos($defaultselectedfileds,"year")<=0) { echo 'displaynon';}?>" id="year">
                                        <label class="control-label">Model manufacturing year:</label>
                                        <div class="controls"><input id="year" name="year" class="focustip span12" type="text" value="<?php echo $edit_data['year'];  ?>" ></div>
						                <span style="color:#F00;"><?php echo form_error('year'); ?></span>
                                    </div>
                                    
	                                    <div class="control-group <?php if( strpos($defaultselectedfileds,"front_rear")<=0) { echo 'displaynon';}?>" id="front_rear">
                                        <label class="control-label">Front/Rear(wheel):</label>
                                        <div class="controls">
                                            <input id="front_rear" name="front_rear" class="focustip span12" type="text" value="<?php echo $edit_data['front_rear'];  ?>" >
                                        </div>
						                <span style="color:#F00;"><?php echo form_error('front_rear'); ?></span>
                                    </div>

                                  
                                  
	                                    <div class="control-group <?php if( strpos($defaultselectedfileds,"designation")<=0) { echo 'displaynon';}?>" id="designation">
                                        <label class="control-label">Designation:</label>
                                        <div class="controls"><input id="designation" name="designation" class="focustip span12" type="text" value="<?php echo $edit_data['designation'];  ?>" ></div>
						                <span style="color:#F00;"><?php echo form_error('designation'); ?></span>
                                    </div>
                                    
	                                    <div class="control-group <?php if( strpos($defaultselectedfileds,"wva")<=0) { echo 'displaynon';}?>" id="wva">
                                        <label class="control-label">WVA:</label>
                                        <div class="controls"><input id="wva" name="wva" class="focustip span12" type="text" value="<?php echo $edit_data['wva'];  ?>" ></div>
						                <span style="color:#F00;"><?php echo form_error('wva'); ?></span>
                                    </div>
                                    
                                 
	                                    <div class="control-group <?php if( strpos($defaultselectedfileds,"qty")<=0) { echo 'displaynon';}?>" id="qty">
                                        <label class="control-label">Quantity:</label>
                                        <div class="controls"><input id="qty" name="qty" class="focustip span12" type="text" value="<?php echo $edit_data['qty'];  ?>" ></div>
						                <span style="color:#F00;"><?php echo form_error('qty'); ?></span>
                                    </div>
                                    
                                        <div class="control-group <?php if( strpos($defaultselectedfileds,"diameter")<=0) { echo 'displaynon';}?>" id="diameter">
                                        <label class="control-label">Diameter:</label>
                                        <div class="controls"><input id="diameter" name="diameter" class="focustip span12" type="text" value="<?php echo $edit_data['diameter'];  ?>" ></div>
						                <span style="color:#F00;"><?php echo form_error('diameter'); ?></span>
                                    </div>
                                    
                                        <div class="control-group <?php if( strpos($defaultselectedfileds,"width")<=0) { echo 'displaynon';}?>" id="width">
                                        <label class="control-label">Width:</label>
                                        <div class="controls"><input id="width" name="width" class="focustip span12" type="text" value="<?php echo $edit_data['width'];  ?>" ></div>
						                <span style="color:#F00;"><?php echo form_error('width'); ?></span>
                                    </div>
                                    
                                        <div class="control-group <?php if( strpos($defaultselectedfileds,"holes_no")<=0) { echo 'displaynon';}?>" id="holes_no">
                                        <label class="control-label">Holes No:</label>
                                        <div class="controls"><input id="holes_no" name="holes_no" class="focustip span12" type="text" value="<?php echo $edit_data['holes_no'];  ?>" ></div>
						                <span style="color:#F00;"><?php echo form_error('holes_no'); ?></span>
                                    </div>
                                    
                                    </div>
                                    
                                    
                                     </div>
                                        
                                    </div>
                                    <!-- /time pickers -->


                                    
                                </div>
                                
                            		<div class="form-actions align-right">
                                        <input class="btn btn-primary" value="Update" id="send" type="submit">
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