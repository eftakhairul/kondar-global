<?php foreach ($menu_product_types as $pro_type) { ?>

<div class="col-md-6 VehicleBlockItems">
	<div class="pro-item product_type_image_wrap step1">
		<div class=""  style="height:180px;overflow:hidden;" >
			<?php /* ?>front/product_type/<?php echo $vehicle['id'];?><?php */ ?>
			<div class="product_image_wrap" data-rel="<?php echo strtolower(str_replace(' ', '_', $pro_type->product_type_name)); ?>"><img src="assets/uploads/product_type_images/<?php echo $pro_type->Product_Type_Photo; ?>"  width="165"   id="image_product_id_<?php echo $pro_type->id; ?>" alt="<?php echo $pro_type->product_type_name; ?>" /></div>
			<input type="hidden" name="product_type_id[]" value="" class="product_types_id">
		</div>
		<div class="clearfix"></div>
		<div class="btn btn-primary btn-sm Type_title" ><?php echo $pro_type->product_type_name; ?></div>
	</div>
</div>
<?php } ?>
                        