<input type="hidden" id="num_of_products" value="<?php echo count($products); ?>" />

<?php

$product_maker_id = '';

$currentproducttype_id = '';

$currentproducttype = '';



foreach ($products as $product_type) {



    if ($product_maker_id != $product_type->maker_id) {

        ?>

        <h1 style="margin-top:0px;">

            <input id="Checkbox_<?php echo $product_type->maker_id; ?>" name="Checkbox_<?php echo $product_type->maker_id; ?>" type="checkbox"  <?php echo $checkbox; ?> class="brandcheckbox brandcheckbox_<?php echo $product_type->maker_id; ?>" value="<?php echo $product_type->maker_id; ?>" />

            <span style="font-family: Arial; font-size: 22px;">

                <label for="Checkbox_<?php echo $product_type->maker_id; ?>">

                    <?php echo $product_type->make; //echo isset($session_data['product_maker_name'])?$session_data['product_maker_name']:$product_type->make; ?> 

                </label>

                <img class="brandmodeltitlelogo" src="assets/uploads/product_maker/<?php echo $product_type->maker_logo; ?>"   id="image_maker_id_<?php echo $product_type->maker_id; ?>" alt="<?php echo $product_type->maker_logo; ?>" />                

                <a onclick="showHide('.brand_complete_info_<?php echo $product_type->maker_id; ?>')" href="javascript:void(0)">

                    <img alt=" - " style="display:inline; color: black;  background-color: whitesmoke;" src="" class="brand_complete_info_<?php echo $product_type->maker_id; ?>_less_img">

                    <img alt=" + " style="display:none; color: black;  background-color: whitesmoke;" src="" class="brand_complete_info_<?php echo $product_type->maker_id; ?>_more_img">

                </a>

                <br/>

            </span>

        </h1>

        <div class="brand_complete_info brand_complete_info_<?php echo $product_type->maker_id; ?>" id="tbl-camry-<?php echo $product_type->id; ?>">



            <?php

            $product_model_id = 0;

            $show_product_model_id = '';



            foreach ($products as $product_model) {

                if (($product_model->model_id != $product_model_id) && ($product_type->maker_id == $product_model->maker_id)) {

                    $privilage = explode('#', $product_model->menu_privilages);



                    if ($show_product_model_id != $product_model->model) {

                        $chkbox_model_id = $product_model->model_id;

                        ?>



                        <h1 style="margin-top:0px;">

                            <input id="Checkbox_model_<?php echo $product_model->model_id; ?>" name="Checkbox_model_<?php echo $product_model->model_id; ?>" type="checkbox"  <?php echo $checkbox; ?> class="modelcheckbox modelcheckbox_<?php echo $chkbox_model_id; ?> productcheck_<?php echo $product_type->maker_id; ?>" value="<?php echo $chkbox_model_id; ?>" />

                            <span style="font-family: Arial; font-size: 22px;"> 

                                <label for="Checkbox_model_<?php echo $product_model->model_id; ?>"><?php echo $product_model->model; ?> </label>

                                <img class="brandmodeltitlelogo" src="assets/uploads/product_model/<?php echo $product_model->model_photo; ?>"   id="image_model_id_<?php echo $product_model->model_id; ?>" alt="<?php echo $product_model->model_photo; ?>" />

                                <a onclick="showHide('.model_table_<?php echo $chkbox_model_id; ?>')" href="javascript:void(0)">

                                    <img alt=" - " style="display:inline; color: black;  background-color: whitesmoke;" src="" class="model_table_<?php echo $chkbox_model_id; ?>_less_img">

                                    <img alt=" + " style="display:none; color: black;  background-color: whitesmoke;" src="" class="model_table_<?php echo $chkbox_model_id; ?>_more_img">

                                </a>

                                <br/>

                            </span>

                        </h1>

                    <?php } ?>

                    <div class="table-responsive model_table_<?php echo $chkbox_model_id; ?>">

                        <?php

                        if (!empty($products)) {

                            $i = ++$offset;



                            foreach ($products as $product) {

                                $privilage = explode('#', $product->menu_privilages);

                                if (($product_type->maker_id == $product->maker_id) && ($product->model_id == $product_model->model_id)) {

                                    ?>

                                    <!--done by arun-->													

                                    <table class="table table-bordered my-table model_table_<?php echo $show_product_model_id; ?>" style="margin:0px;">



                                        <?php

                                        if (($currentproducttype != $product->type) || ($show_product_model_id != $product_model->model)) {

                                            $currentproducttype = $product->type;

                                            $tbl_product_type_id = $product->id;

                                            $show_product_model_id = $product_model->model;

                                            ?>

                                            <thead>

                                                <tr>

                                                    <th colspan="11">

                                                        <input id="Checkbox_product_type_<?php echo $product->id; ?>" type="checkbox"  <?php echo $checkbox; ?> class="producttypecheckbox  producttypecheckbox_<?php echo $tbl_product_type_id; ?>  productcheck_<?php echo $product_type->maker_id; ?> modelcheckbox_<?php echo $product->model_id; ?> modelcheckbox_<?php echo $chkbox_model_id; ?>" value="<?php echo $tbl_product_type_id; ?>" name="chk_product_type[]"/>

                                                        <?php echo $product->type; ?>

                                                        <input type="button" id="minimize_block_<?php echo $tbl_product_type_id; ?>" class="minimize_block" name="minimize_block" value="-" style="float:right;">

                                                    </th>

                                                </tr>

                                            </thead>



                                            <thead class="minimize_block_<?php echo $tbl_product_type_id; ?>">

                                                <tr>	

                                                    <?php $colspan = 5; ?>

                                                    <th><?php echo lang('SELECT') ?></th> 

                                                    <th><?php echo lang('No.') ?></th> 

                                                    <th><?php echo lang('KGT REF.') ?></th> 

                                                    <th><?php echo lang('Product Type Title') ?></th> 

                                                    <?php if (in_array("drawing_photo", $privilage)) {

                                                        $colspan++;

                                                        ?><th>Drawing&nbsp;Type&nbsp;Photo</th><?php } ?>

                                                    <?php if (in_array("product_photo", $privilage)) {

                                                        $colspan++;

                                                        ?><th>Product&nbsp;Type&nbsp;Photo</th><?php } ?>

                                <?php if (in_array("vehicle_photo", $privilage)) {

                                    $colspan++;

                                    ?><th>Vehicle&nbsp;Model&nbsp;Photo</th><?php } ?>

                                                    <th>.</th>

                                                </tr>

                                            </thead>

                                <?php

                            }

                            ?>



                                        <tbody  class="minimize_block_<?php echo $tbl_product_type_id; ?>">

                                            <tr class="main_info" style="text-align: center; background-color: rgb(219, 219, 219);">

                                                <td style="width:60px;"><span><input id="Checkbox_product_<?php echo $product->id; ?>" type="checkbox"  <?php echo $checkbox; ?> class="productcheckbox product_type_<?php echo $tbl_product_type_id; ?> productcheck_<?php echo $product->maker_id; ?> modelcheckbox_<?php echo $product->model_id; ?> part_<?php echo $product->id; ?> modelcheckbox_<?php echo $chkbox_model_id; ?>" value="<?php echo $product->id; ?>" name="product_id[]" /></span></td>

                                                <td style="width:60px;color: #575757; font-family: arial; font-size: 12px; text-align: center;"><span><?php echo $i; ?></span></td>

                                                <td style="width:15%;color: #575757; font-family: arial; font-size: 12px; text-align: center;"><span><label for="Checkbox_product_<?php echo $product->id; ?>"><?php echo $product->kgt_ref_number; ?></label></span></td>

                                                <td style="color: #575757; font-family: arial; font-size: 12px; text-align: center;" <span><?php echo $product->type; ?></span></td>



                            <?php if (in_array("drawing_photo", $privilage)) { ?>

                                <?php if ($product->drawing_photo != '') { ?>

                                    <?php if (file_exists("assets/uploads/product_images/" . $product->drawing_photo)) { ?>

                                                            <td>

                                                                <a class="example-image-link" data-lightbox="example-<?php echo $product->id; ?>" href="assets/uploads/product_images/<?php echo $product->drawing_photo; ?>">

                                                                    <img src="assets/uploads/product_images/<?php echo $product->drawing_photo; ?>" height="75" alt="<?php echo $product->drawing_photo; ?>" />

                                                                </a>&nbsp;

                                                            </td>

                                    <?php } else { ?>

                                                            <td>

                                                                <a class="example-image-link" data-lightbox="example-<?php echo $product->id; ?>" href="images/coming_soon.jpg">

                                                                    <img src="images/coming_soon.jpg" width="120" height="80">

                                                                </a>&nbsp;

                                                            </td>

                                    <?php }

                                } else {

                                    ?>

                                                        <td>

                                                            <a class="example-image-link" data-lightbox="example-<?php echo $product->id; ?>" href="images/coming_soon.jpg">

                                                                <img src="images/coming_soon.jpg" width="120" height="80">

                                                            </a>&nbsp;

                                                        </td>



                                                    <?php }

                                                }

                                                ?>



                            <?php if (in_array("product_photo", $privilage)) { ?>

                                <?php if ($product->product_photo != '') { ?>

                                                        <?php if (file_exists("assets/uploads/product_images/" . $product->product_photo)) { ?>

                                                            <td>

                                                                <a class="example-image-link" data-lightbox="example-<?php echo $product->id; ?>" href="assets/uploads/product_images/<?php echo $product->product_photo; ?>">

                                                                    <img src="assets/uploads/product_images/<?php echo $product->product_photo; ?>" height="75" alt="<?php echo $product->product_photo; ?>" />

                                                                </a>&nbsp;

                                                            </td>

                                                        <?php } else { ?>

                                                            <td>

                                                                <a class="example-image-link" data-lightbox="example-<?php echo $product->id; ?>" href="images/coming_soon.jpg">

                                                                    <img src="images/coming_soon.jpg" width="120" height="80">

                                                                </a>&nbsp;

                                                            </td>

                                    <?php }

                                } else {

                                    ?>

                                                        <td>

                                                            <a class="example-image-link" data-lightbox="example-<?php echo $product->id; ?>" href="images/coming_soon.jpg">

                                                                <img src="images/coming_soon.jpg" width="120" height="80">

                                                            </a>&nbsp;

                                                        </td>



                                <?php }

                            }

                            ?>



                                                <?php if (in_array("vehicle_photo", $privilage)) { ?>

                                                    <?php if ($product->vehicle_photo != '') { ?>

                                    <?php if (file_exists("assets/uploads/product_images/" . $product->vehicle_photo)) { ?>

                                                            <td>

                                                                <a class="example-image-link" data-lightbox="example-<?php echo $product->id; ?>" href="assets/uploads/product_images/<?php echo $product->vehicle_photo; ?>">

                                                                    <img src="assets/uploads/product_images/<?php echo $product->vehicle_photo; ?>" height="75" alt="<?php echo $product->vehicle_photo; ?>" />

                                                                </a>&nbsp;

                                                            </td>

                                                        <?php } else { ?>

                                                            <td>

                                                                <a class="example-image-link" data-lightbox="example-<?php echo $product->id; ?>" href="images/coming_soon.jpg">

                                                                    <img src="images/coming_soon.jpg" width="120" height="80">

                                                                </a>&nbsp;

                                                            </td>

                                                        <?php }

                                                    } else {

                                                        ?>

                                                        <td>

                                                            <a class="example-image-link" data-lightbox="example-<?php echo $product->id; ?>" href="images/coming_soon.jpg">

                                                                <img src="images/coming_soon.jpg" width="120" height="80">

                                                            </a>&nbsp;

                                                        </td>



                                <?php }

                            }

                            ?>

                                                <td style="color: #575757; font-family: arial; font-size: 12px; text-align: center;">

                                                    <a href="javascript:void(0)" onClick="$(this).parent().parent().next('.less_info').toggle();$(this).find('.less_img').toggle();$(this).find('.more_img').toggle();">

                                                        <img class="less_img" src="" style="display:inline; color: black;  background-color: whitesmoke;" alt=" - "/>

                                                        <img class="more_img" src="" style="display:none; color: black;  background-color: whitesmoke;" alt=" + "/>

                                                    </a>

                                                </td>



                                            </tr>

                                            <tr class="less_info" style="background-color: rgb(219, 219, 219);display:table-row">

                                                <td colspan="<?php echo empty($product->drawing_photo) ? $colspan + 1 : $colspan; ?>" style="color: #575757; font-family: arial; font-size: 12px;;">





                                                    <div class="single_product_wrapper">

                                                        <div class="detail_wrap" style="text-align:left">

                            <?php if ($product->oem_part_number != '' && in_array("oem_part_number", $privilage)) { ?>

                                                                <div class="single_detail">

                                                                    <span><?php echo lang('OEM PART NUMBER') ?> :</span>

                                                                    <span><?php echo $product->oem_part_number; ?></span>

                                                                </div>

                            <?php } ?>

                            <?php if ($product->application != '' && in_array("application", $privilage)) { ?>

                                                                <div class="single_detail">

                                                                    <span><?php echo lang('APPLICATION') ?> :</span>

                                                                    <span><?php echo $product->application; ?></span>

                                                                </div>

                            <?php } ?>

                            <?php if ($product->others != '' && in_array("others", $privilage)) { ?>

                                                                <div class="single_detail">

                                                                    <span><?php echo lang('OTHER') ?> :</span>

                                                                    <span><?php echo $product->others; ?></span>

                                                                </div>

                            <?php } ?>

                            <?php if ($product->fmsi_ref_number != '' && in_array("fmsi_ref_number", $privilage)) { ?>

                                                                <div class="single_detail">

                                                                    <span><?php echo lang('FMSI Ref.') ?> :</span>

                                                                    <span><?php echo $product->fmsi_ref_number; ?></span>

                                                                </div>

                            <?php } ?>

                            <?php if ($product->wva != '' && in_array("wva", $privilage)) { ?>

                                                                <div class="single_detail">

                                                                    <span><?php echo lang('WVA') ?> :</span>

                                                                    <span><?php echo $product->wva; ?></span>

                                                                </div>

                            <?php } ?>

                            <?php if ($product->year != '' && in_array("year", $privilage)) { ?>

                                                                <div class="single_detail">

                                                                    <span><?php echo lang('Model manufacturing year') ?> :</span>

                                                                    <span><?php echo $product->year; ?></span>

                                                                </div>

                            <?php } ?>

                            <?php if ($product->qty != '' && in_array("qty", $privilage)) { ?>

                                                                <div class="single_detail">

                                                                    <span><?php echo lang('Quantity') ?> :</span>

                                                                    <span><?php echo $product->qty; ?></span>

                                                                </div>

                            <?php } ?>

                            <?php if ($product->diameter != '' && in_array("diameter", $privilage)) { ?>

                                                                <div class="single_detail">

                                                                    <span><?php echo lang('Diameter') ?> :</span>

                                                                    <span><?php echo $product->diameter; ?></span>

                                                                </div>

                            <?php } ?>

                            <?php if ($product->width != '' && in_array("width", $privilage)) { ?>

                                                                <div class="single_detail">

                                                                    <span><?php echo lang('Width') ?> :</span>

                                                                    <span><?php echo $product->width; ?></span>

                                                                </div>

                                                            <?php } ?>

                            <?php if ($product->holes_no != '' && in_array("holes_no", $privilage)) { ?>

                                                                <div class="single_detail">

                                                                    <span><?php echo lang('Holes no') ?> :</span>

                                                                    <span><?php echo $product->holes_no; ?></span>

                                                                </div>

                                                            <?php } ?>

                                                        </div>

                                                        <div class="detail_wrap" style="text-align:left">

                            <?php if ($product->front_rear != '' && in_array("front_rear", $privilage)) { ?>

                                                                <div class="single_detail">

                                                                    <span><?php echo lang('front/rear (wheel)') ?> :</span>

                                                                    <span><?php echo $product->front_rear; ?></span>

                                                                </div>

                            <?php } ?>

                            <?php if ($product->category != '' && in_array("maker_id", $privilage)) { ?>

                                                                <div class="single_detail">

                                                                    <span><?php echo lang('KGT Vehicle Category Title') ?> :</span>

                                                                    <span><?php echo $product->category; ?></span>

                                                                </div>

                            <?php } ?>

                            <?php if ($product->designation != '' && in_array("designation", $privilage)) { ?>

                                                                <div class="single_detail">

                                                                    <span><?php echo lang('Designation') ?> :</span>

                                                                    <span><?php echo $product->designation; ?></span>

                                                                </div>

                            <?php } ?>

                            <?php if ($product->fleet != '' && in_array("fleet", $privilage)) { ?>

                                                                <div class="single_detail">

                                                                    <span><?php echo lang('Fleetguide') ?> :</span>

                                                                    <span><?php echo $product->fleet; ?></span>

                                                                </div>

                            <?php } ?>

                            <?php if ($product->baldwin != '' && in_array("baldwin", $privilage)) { ?>

                                                                <div class="single_detail">

                                                                    <span><?php echo lang('Baldwin') ?> :</span>

                                                                    <span><?php echo $product->baldwin; ?></span>

                                                                </div>

                            <?php } ?>

                            <?php if ($product->knect != '' && in_array("knect", $privilage)) { ?>

                                                                <div class="single_detail">

                                                                    <span><?php echo lang('Knect') ?> :</span>

                                                                    <span><?php echo $product->knect; ?></span>

                                                                </div>

                            <?php } ?>

                            <?php if ($product->filtron != '' && in_array("filtron", $privilage)) { ?>

                                                                <div class="single_detail">

                                                                    <span><?php echo lang('Filtron') ?> :</span>

                                                                    <span><?php echo $product->filtron; ?></span>

                                                                </div>

                            <?php } ?>

                            <?php if ($product->purflux != '' && in_array("purflux", $privilage)) { ?>

                                                                <div class="single_detail">

                                                                    <span><?php echo lang('Purflux') ?> :</span>

                                                                    <span><?php echo $product->purflux; ?></span>

                                                                </div>

                            <?php } ?>

                            <?php if ($product->mann != '' && in_array("mann", $privilage)) { ?>

                                                                <div class="single_detail">

                                                                    <span><?php echo lang('Mann') ?> :</span>

                                                                    <span><?php echo $product->mann; ?></span>

                                                                </div>

                            <?php } ?>

                            <?php if ($product->mecafilter != '' && in_array("mecafilter", $privilage)) { ?>

                                                                <div class="single_detail">

                                                                    <span><?php echo lang('Mecafilter') ?> :</span>

                                                                    <span><?php echo $product->mecafilter; ?></span>

                                                                </div>

                            <?php } ?>

                                                        </div>

                                                        <div class="clear"></div>

                                                    </div>

                                                </td>

                                            </tr>



                                        </tbody>







                                    </table>

                                            <?php

                                            $i++;

                                        }

                                    }

                                } else {

                                    ?>

                            <table class="table table-bordered my-table">

                                <tr style="text-align: center; background-color: rgb(219, 219, 219);"><td <?php

                                    if ($session_data['vehicle_type_id'] == 7) {

                                        echo 'colspan="12"';

                                    } else if ($session_data['vehicle_type_id'] == 7) {

                                        echo 'colspan="15"';

                                    } else {

                                        echo 'colspan="11"';

                                    }

                                    ?>>No Data Avaliable</td></tr>

                                </tbody>

                            </table>

                <?php } ?>

                    </div>

                <?php

            }

            $product_model_id = $product_model->model_id;

        }

        ?> 



        </div>

        <?php

    }

    $product_maker_id = $product_type->maker_id;

}

?>

<div class="cleafix"></div>

<script type="text/javascript">

    $(document).ready(function() {

        var num_of_products = parseInt($("#num_of_products").val()) + parseInt($("#products_count").text());        

        $("#products_count").text(num_of_products);

        $("#num_of_products").remove();

    });

    

</script>