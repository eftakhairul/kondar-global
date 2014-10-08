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

</script>
<div class="container">
    <div class="row bread">
        <div class="col-md-12">
            <div class="text-bread">
                <?php echo '<a href="products">' . lang('PRODUCT GALLERY (APPLICATION)') . '</a>'; ?> / <?php echo $breadcrumb; ?>  
            </div>
        </div>

    </div>
</div><!--End bread-->

<div class="container">
    <div class="main-page">
        <div style="color: red;"><span><span style="font-weight:bold; color:black; text-decoration: underline;">Selection instruction</span></span><span style="color:black;">:</span> <?php echo $selection_instruction[0]->product_list_msg;?></div>
        <form action="<?php $base_url ?>cart/addtocart" method="post" id="product_listing">
            <input name="update" id="update" value="0" type="hidden">
            <div class="car-lists productlisting">
                <div class="row">
                    <?php include('product_timer.php'); ?> 
                    <div class="col-md-12">
                        <div id="cartitemmsgWrap" style="display:none; color:#FF0000;"><?php echo lang('The product is already in the cart, it is not possible to add it again') ?></div>
                        <div class="Productsearch_result">
                            Products Show: <span id="products_count"><?php echo count($products); ?></span> / <span id="total_products_count"><?php echo $products_counts; ?></span> <?php echo lang('Results found') ?>
                        </div>

                        <?php if ($this->comman_model->get_isactive_checkbox('settings', 'id', 1)) { ?>
                            <div>
                                <div id="check_all_btn" class="col-md-1 custom_btn">
                                    <input id="checkbox" type="checkbox" name="vehicle_option[]" value="all">    
                                    Select All
                                </div>

                            </div>
                        <?php } ?>
                        <div class="clearfix"></div>


                        <div id="productsearch_list_show" class="canload">
                            <?php
                            //$product_type_id = 0;
                            $product_maker_id = '';
                            $currentproducttype_id = '';
                            $currentproducttype = '';

                            foreach ($products as $product_type) {

                                if ($product_maker_id != $product_type->maker_id) {
                                    ?>
                                    <h1 style="margin-top:0px;">
                                        <input id="Checkbox_<?php echo $product_type->maker_id; ?>" name="Checkbox_<?php echo $product_type->maker_id; ?>" type="checkbox" class="brandcheckbox brandcheckbox_<?php echo $product_type->maker_id; ?>" value="<?php echo $product_type->maker_id; ?>" />
                                        <span style="font-family: Arial; font-size: 22px;">
                                            <label for="Checkbox_<?php echo $product_type->maker_id; ?>">
                                                <?php echo $product_type->make; //echo isset($session_data['product_maker_name'])?$session_data['product_maker_name']:$product_type->make; ?> 
                                            </label>
                                            <img class="brandmodeltitlelogo" src="assets/uploads/product_maker/<?php echo $product_type->maker_logo; ?>"   id="image_maker_id_<?php echo $product_type->maker_id; ?>" alt="<?php echo $product_type->maker_logo; ?>" />                
                                            <a onclick="showHide('.brand_complete_info_<?php echo $product_type->maker_id; ?>')" href="javascript:void(0)">
                                                <span style="display:inline; color: black;  background-color: whitesmoke;"  class="brand_complete_info_<?php echo $product_type->maker_id; ?>_less_img">-</span>
                                                <span style="display:none; color: black;  background-color: whitesmoke;" class="brand_complete_info_<?php echo $product_type->maker_id; ?>_more_img">+</span>
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
                                                        <input id="Checkbox_model_<?php echo $product_model->model_id; ?>" name="Checkbox_model_<?php echo $product_model->model_id; ?>" type="checkbox" class="modelcheckbox modelcheckbox_<?php echo $chkbox_model_id; ?> productcheck_<?php echo $product_type->maker_id; ?>" value="<?php echo $chkbox_model_id; ?>" />
                                                        <span style="font-family: Arial; font-size: 22px;"> 
                                                            <label for="Checkbox_model_<?php echo $product_model->model_id; ?>"><?php echo $product_model->model; ?> </label>
                                                            <img class="brandmodeltitlelogo" src="assets/uploads/product_model/<?php echo $product_model->model_photo; ?>"   id="image_model_id_<?php echo $product_model->model_id; ?>" alt="<?php echo $product_model->model_photo; ?>" />
                                                            <a onclick="showHide('.model_table_<?php echo $chkbox_model_id; ?>')" href="javascript:void(0)">
                                                                <span style="display:inline; color: black;  background-color: whitesmoke;"  class="model_table_<?php echo $chkbox_model_id; ?>_less_img">-</span>
                                                                <span style="display:none; color: black;  background-color: whitesmoke;"  class="model_table_<?php echo $chkbox_model_id; ?>_more_img">+</span>
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
                                                     
                                                                <!--done by 4axiz -->													
                                                                <table class="table table-bordered my-table model_table_<?php echo $show_product_model_id; ?>" style="margin:0px;">

                                                                    <?php
                                                                    if (($currentproducttype != $product->type) || ($show_product_model_id != $product_model->model)) {
                                                                        $currentproducttype = $product->type;
                                                                        $tbl_product_type_id = $product->id;
                                                                        $show_product_model_id = $product_model->model;
                                                                        ?>
                                                                    
                                                                        <thead>
                                                                            <tr>
                                                                                <th colspan="8">
                                                                                    <input id="Checkbox_product_type_<?php echo $product->id; ?>" type="checkbox" class="producttypecheckbox producttypecheckbox_<?php echo $tbl_product_type_id; ?>  productcheck_<?php echo $product_type->maker_id; ?> modelcheckbox_<?php echo $product->model_id; ?> modelcheckbox_<?php echo $chkbox_model_id; ?>" value="<?php echo $tbl_product_type_id; ?>" name="chk_product_type[]" />
                                                                                    <?php echo $product->type; ?>
                                                                                    <input type="button" id="minimize_block_<?php echo $tbl_product_type_id; ?>" class="minimize_block" name="minimize_block" value="-" style="float:right;">
                                                                                </th>
                                                                            </tr>
                                                                            <tr  class="minimize_block_<?php echo $tbl_product_type_id; ?>">	
                                                                               <?php $colspan = 5; ?>
                                                                                <th><?php echo lang('SELECT') ?></th> 
                                                                                <th><?php echo lang('No.') ?></th> 
                                                                                <th><?php echo lang('KGT REF.') ?></th> 
                                                                                <th><?php echo lang('Product Type Title') ?></th> 
                                                                                <?php
                                                                                if (in_array("drawing_photo", $privilage)) {
                                                                                    $colspan++;
                                                                                    ?><th>Drawing&nbsp;Type&nbsp;Photo</th><?php } ?>
                                                                                    <?php
                                                                                    if (in_array("product_photo", $privilage)) {
                                                                                        $colspan++;
                                                                                        ?><th>Product&nbsp;Type&nbsp;Photo</th><?php } ?>
                                                                                    <?php
                                                                                    if (in_array("vehicle_photo", $privilage)) {
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
                                                                            <td style="width:60px;"><span><input id="Checkbox_product_<?php echo $product->id; ?>" type="checkbox" class="productcheckbox product_type_<?php echo $tbl_product_type_id; ?> productcheck_<?php echo $product->maker_id; ?> modelcheckbox_<?php echo $product->model_id; ?> part_<?php echo $product->id; ?> modelcheckbox_<?php echo $chkbox_model_id; ?>" value="<?php echo $product->id; ?>" name="product_id[]" /></span></td>
                                                                            <td style="width:60px;color: #575757; font-family: arial; font-size: 12px; text-align: center;"><span><?php echo $i; ?></span></td>
                                                                            <td style="width:15%;color: #575757; font-family: arial; font-size: 12px; text-align: center;"><span><label for="Checkbox_product_<?php echo $product->id; ?>"><?php echo $product->kgt_ref_number; ?></label></span></td>
                                                                            <td style="color: #575757; font-family: arial; font-size: 12px; text-align: center;"> <span><?php echo $product->type; ?></span></td>

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
                                                                                                <img  alt="product_images"  src="images/coming_soon.jpg"  width="120" height="80">
                                                                                            </a>&nbsp;
                                                                                        </td>
                                    <?php
                                    }
                                } else {
                                    ?>
                                                                                    <td>
                                                                                        <a class="example-image-link" data-lightbox="example-<?php echo $product->id; ?>" href="images/coming_soon.jpg">
                                                                                            <img  alt="product_images"  src="images/coming_soon.jpg" width="120" height="80">
                                                                                        </a>&nbsp;
                                                                                    </td>

                                                                                <?php
                                                                                }
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
                                                                                                <img src="images/coming_soon.jpg" alt="coming soon" width="120" height="80">
                                                                                            </a>&nbsp;
                                                                                        </td>
                                    <?php
                                    }
                                } else {
                                    ?>
                                                                                    <td>
                                                                                        <a class="example-image-link" data-lightbox="example-<?php echo $product->id; ?>" href="images/coming_soon.jpg">
                                                                                            <img src="images/coming_soon.jpg" alt="coming soon"  width="120" height="80">
                                                                                        </a>&nbsp;
                                                                                    </td>

                                                                                <?php
                                                                                }
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
                                                                                                <img src="images/coming_soon.jpg"  alt="coming soon"  width="120" height="80">
                                                                                            </a>&nbsp;
                                                                                        </td>
                                    <?php
                                    }
                                } else {
                                    ?>
                                                                                    <td>
                                                                                        <a class="example-image-link" data-lightbox="example-<?php echo $product->id; ?>" href="images/coming_soon.jpg">
                                                                                            <img src="images/coming_soon.jpg"  alt="coming soon"  width="120" height="80">
                                                                                        </a>&nbsp;
                                                                                    </td>

                                <?php
                                }
                            }
                            ?>
                                                                            <td style="color: #575757; font-family: arial; font-size: 12px; text-align: center;">
                                                                                <a href="javascript:void(0)" onClick="$(this).parent().parent().next('.less_info').toggle();
                                                                                                                    $(this).find('.less_img').toggle();
                                                                                                                    $(this).find('.more_img').toggle();">
                                                                                    <span class="less_img"  style="display:inline; color: black;  background-color: whitesmoke;">-</span>
                                                                                    <span class="more_img"  style="display:none; color: black;  background-color: whitesmoke;">+</span>
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
                                                                                                   <!-- <tr style="text-align: center; background-color: rgb(219, 219, 219);">
                                                                                                        <td><span><input id="Checkbox3" type="checkbox" /></span></td>
                                                                                                        <td style="color: #575757; font-family: arial; font-size: 12px; text-align: center;"><span>1</span></td>
                                                                                                       
                                                                                                        <td style="color: #575757; font-family: arial; font-size: 12px; text-align: center;"><span><img src="assets/template/images/vehicle_truck_img02.png" /></span></td>
                                                                                                        <td style="color: #575757; font-family: arial; font-size: 12px; text-align: center;"><span>KG9641504</span></td>
                                                                                                        <td style="color: #575757; font-family: arial; font-size: 12px; text-align: center;"><span>MITSUBICHI CENTER NM</span></td>
                                                                                                        <td style="color: #575757; font-family: arial; font-size: 12px; text-align: center;"><span>MEO017242</span></td>
                                                                                                        <td style="color: #575757; font-family: arial; font-size: 12px; text-align: center;"><span><img src="assets/template/images/product_truck_img02.png" /></span></td>
                                                                                                      
                                                                                                        
                                                                                                    </tr>-->

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
                        </div>
<?php if (count($products) < $products_counts) { ?>
                            <div onclick="ajaxProductList('<?php echo $this->config->item('pagination_limit_product_list'); ?>');" id="loadmoreProducts" style="background-color: white; padding: 10px 20px; margin-top: 20px; text-align: center; cursor: pointer; width: 250px; margin-left: 45%; color: rgb(174, 26, 26); border: 1px solid rgb(174, 26, 26); box-shadow: 0px 1px 2px rgb(174, 26, 26);">
                                Load More Products
                            </div>
<?php } ?>
                    </div>
                </div>

            </div>

            <div class="clearfix"></div>
            <div class="nav-prex-next text-right">
                <div class="row">
                    <div class="col-md-12">
                        <div class="pull-right" style="float:right;">
                            <a href="products/product_brand/" class="btn btn-primary btn-sm"><?php echo lang('Back') ?></a>
                            <a  href="javascript:void(0);" id="addtocart" class="btn btn-primary btn-sm"><?php echo lang('ADD TO CART') ?></a>
                        </div>
                        <div id="display-num-of-products" class="pull-right" style="margin-right:10px;color:green;">
                            Products Show: <?php echo count($products); ?> of <?php echo $products_counts; ?>
                        </div>
                    </div>

                </div>
            </div>
        </form>
    </div><!--End content-->
</div>

<span style="display:none;" id="maincart_block_msg"><?php if (isset($selection_instruction[0]->maincart_block_msg)) echo $selection_instruction[0]->maincart_block_msg;?></span>
  <span style="display:none;" id="editcart_block_msg"><?php if (isset($selection_instruction[0]->editcart_block_msg)) echo $selection_instruction[0]->editcart_block_msg;?></span>
  <span style="display:none;" id="cartpreview_block_msg"><?php if (isset($selection_instruction[0]->cartpreview_block_msg)) echo $selection_instruction[0]->cartpreview_block_msg;?></span>
  <span style="display:none;" id="cartverification_block_msg"><?php if (isset($selection_instruction[0]->cartverification_block_msg)) echo $selection_instruction[0]->cartverification_block_msg;?></span>
  <span style="display:none;" id="block_notification_msg"><?php if (isset($selection_instruction[0]->block_notification_msg)) echo $selection_instruction[0]->block_notification_msg;?></span>
  <span style="display:none;" id="cartverification_resent_block_msg"><?php if (isset($selection_instruction[0]->cartverification_resent_block_msg)) echo $selection_instruction[0]->cartverification_resent_block_msg;?></span>
  <span style="display:none;" id="cartverification_wrong_block_msg"><?php if (isset($selection_instruction[0]->cartverification_wrong_block_msg)) echo $selection_instruction[0]->cartverification_wrong_block_msg;?></span>


<!--Modal shopping decision cart-->
<div class="modal fade" id="decision_cart">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title">Modal title</h4>
  </div> -->
            <div class="modal-body">
                <div class="box-content-modal">
                    <h2 class="title-modal"><?php echo $selection_instruction[0]->addtocart_popup_header;?></h2>
                    <p id="addtocart_success_msg"><?php echo lang('Your product has been added to the shopping cart') ?></p>
                    <div class="clearfix"></div>
                    <div class="btn-modal">
                        <a style="float:left" href="products/products" class="btn btn-primary btn-sm"><?php echo lang('continue shopping') ?><i class="glyphicon glyphicon-chevron-right"></i></a>
                        <a style="float:right" href="cart/cart" class="btn btn-primary btn-sm"><?php echo lang('edit cart') ?><i class="glyphicon glyphicon-chevron-right"></i></a>	
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
                        <div class="blockMsg" id="blockMsg"></div>
                    </div>
                    <div id="edit_cart_mode_on" style="display: none;"></div>
                    <h2 class="title-modal" id="blockMsg1">&nbsp; </h2>
                    <div class="clearfix"></div>
                    <div class="btn-modal">
                        <div class="row">

                            <div class="col-md-12 col-xs-12 text-right">
                                <a href="javascript:void(0)" onClick="redirect_edit_mode();" class="btn btn-primary btn-sm" id="block_confirm_msg1"><?php echo lang('OK') ?><i class="glyphicon glyphicon-chevron-right"></i></a>	
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




<!--Modal shopping decision cart-->
<div class="modal fade" id="modal_mssg">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title">Modal title</h4>
</div> -->
            <div class="modal-body">
                <div class="box-content-modal">
                    <h2 id="already_added_msg_title" class="title-modal"><?php echo lang('Already Added') ?></h2>
                    <p id="already_added_msg"></p>
                    <div class="clearfix"></div>
                    <div class="btn-modal">


                        <a style="float:right" href="javascript:void(0)" onClick="$('#modal_mssg').modal('hide');
                                addtocartinnotexistingproducts();" class="btn btn-primary btn-sm"><?php echo lang('OK') ?><i class="glyphicon glyphicon-chevron-right"></i></a>	

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


<!--Modal shopping decision cart-->
<div class="modal fade" id="modal_mssg1">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title">Modal title</h4>
</div> -->
            <div class="modal-body">
                <div class="box-content-modal">
                    <h2 id="already_added_msg_title1" class="title-modal">
                       <span class="blink"> <?php echo $selection_instruction[0]->selection_popup_header;?> </span>
                    </h2>
                    <p id="already_added_msg1"><?php echo $selection_instruction[0]->selection_popup_body; ?></p>
                    <div class="clearfix"></div>
                    <div class="btn-modal">


                        <a style="float:right" href="javascript:void(0)" onClick="$('#modal_mssg1').modal('hide');" class="btn btn-primary btn-sm"><?php echo lang('OK') ?><i class="glyphicon glyphicon-chevron-right"></i></a>	

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




<!--Modal shopping decision cart-->
<div class="modal fade" id="modal_mssg2">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title">Modal title</h4>
</div> -->
            <div class="modal-body">
                <div class="box-content-modal">
                    <h2 id="already_added_msg_title2" class="title-modal"><?php echo lang('Already Added') ?></h2>
                    <p id="already_added_msg2"></p>
                    <div class="clearfix"></div>
                    <div class="btn-modal">


                        <a style="float:right" href="javascript:void(0)" onClick="$('#modal_mssg2').modal('hide');" class="btn btn-primary btn-sm"><?php echo lang('OK') ?><i class="glyphicon glyphicon-chevron-right"></i></a>	

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
