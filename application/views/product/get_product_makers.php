
<?php 
foreach($vehicle_makers as $maker){?>
<div class="col-md-3">
	<div class="pro-item product_type_image_wrap product_type_image_wrap1 singlestep <?php if(in_array($maker['id'],$product_maker_id)){ echo "boarder_2_red";}?>">
		<div class="" style="height:180px;"><?php /*?>front/product_list/<?php echo $maker['id'];?><?php */?>
			<a href="javascript:void(0);" class="product_image_wrap" data-rel="<?php echo $maker['id'];?>"><img src="assets/uploads/product_maker/<?php echo $maker['maker_logo'];?>" alt="" /></a>
			 <input type="hidden" name="vehicle_brand_id[]" value="<?php if(in_array($maker['id'],$product_maker_id)){ echo $maker['id'];}?>" class="vehicle_type_id">
		</div>
		<div class="clearfix"></div>
		<a href="javascript:void(0);" class="btn btn-primary btn-sm"><?php echo $maker['maker_name'];?></a>
	</div>
</div>
<?php }?>