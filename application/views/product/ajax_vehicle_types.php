<?php

foreach ($vehicle_categories as $vehicle) {
    ?>
    <div class="col-md-3">
        <div class="pro-item product_type_image_wrap singlestep <?php
    if (in_array($vehicle->id, $vehicle_category_ids)) {
        echo 'boarder_2_red';
    }
    ?>">
            <div class=""  style="height:180px;">
                <a href="javascript:void(0);" class="product_image_wrap" data-rel="<?php echo $vehicle->id; ?>"><img src="assets/uploads/vehicle_categories/<?php echo $vehicle->VehicleType_Photo; ?>"  alt="" width="165" id="image1" class="" /></a>
                <input type="hidden" name="vehicle_cat_id[]" value="<?php
         if (in_array($vehicle->id, $vehicle_category_ids)) {
             echo $vehicle->id;
         }
    ?>" class="vehicle_category_id">
            </div>
            <div class="clearfix"></div>
            <a href="javascript:void(0);" class="btn btn-primary btn-sm" ><?php echo $vehicle->category_name; ?></a>
        </div>
    </div>
    <?php
}
?>

