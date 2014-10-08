<?php foreach ($vehicle_type as $type) { ?>
    <div class="col-md-3">
        <div class="pro-item product_type_image_wrap product_type_image_wrap1 singlestep <?php
    if (in_array($type['id'], $vehicle_type_ids)) {
        echo 'boarder_2_red';
    }
    ?>">
            <div class="" style="height: 180px;">
                <a href="javascript:void(0);" class="product_image_wrap" data-rel="<?php echo $type['id']; ?>"><img src="assets/uploads/product_type_images/<?php echo $type['Product_Type_Photo']; ?>" alt="" class=""/></a>
                <input type="hidden"  name="vehicle_type_id[]" value="<?php
            if (in_array($type['id'], $vehicle_type_ids)) {
                echo $type['id'];
            }
            ?>" class="vehicle_type_id">
            </div>
            <div class="clearfix"></div>
            <a href="javascript:void(0);" class="btn btn-primary btn-resize"><?php echo $type['product_type_name'] . '-' . $type['category_name']; ?></a>
        </div>
    </div>
<?php } ?>