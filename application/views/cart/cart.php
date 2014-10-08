<script src="assets/master/js/flipclock.js" type="text/javascript"></script>
<div class="container">
    <div class="row bread">
        <div class="col-md-12">
            <div class="text-bread">
                
              </div>
          </div>
      </div>
  </div>
  <!--End bread-->
  <form class="form-horizontal" role="form" enctype="multipart/form-data" method="post" action="<?php echo base_url(); ?>cart/save_cart_data" id="cart_details_form">
    <input type="hidden" value="submit" name="button_checkings" id="button_checkings" style="width:50px">
    <div class="container">
        <div class="main-page">
            <div class="car-lists productlisting">
                <div class="form-fill-cart">
                    <div class="row">
                        <?php include('cart_timer.php'); ?>       
                        <div class="col-md-6">
                            <h3><?php echo lang('Fill in Cart and Contact Details') ?></h3> 


                            <div class="form-group">
                                <label for="salutation" class="col-sm-4 left control-label"><?php echo lang('Title') ?></label>
                                <?php
                                $title = $cart_users_data['user_name'];
                                $cart_users_data1['user_name'] = explode(" ", $title);
                                $cart_users_data1['user_name'] = $cart_users_data1['user_name'][0];
                                // 
                                ?>
                                <div class="col-sm-8">
                                    <select name="salutation" id="salutation" style="height:35px" class="form-control selectpicker1">
                                        <option value='Mr.' data-title="Mr" <?php if ($cart_users_data1['user_name'] == 'Mr.') { ?> selected="selected"<?php } ?>>Mr.</option>
                                        <option value='Ms.'  data-title="Ms" <?php if ($cart_users_data1['user_name'] == 'Ms.') { ?> selected="selected"<?php } ?>>Ms.</option>
                                    </select>
                                </div>
                            </div> 


                            <?php
                            $cart_users_data['user_name'] = substr($cart_users_data['user_name'], 4);
                            //var_dump($cart_users_data['user_name']);
                            ?> 
                            <div class="form-group">
                                <label for="cart_surname" class="col-sm-4 left control-label"><?php echo lang('Name and Surname') ?></label> 
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="cart_surname" placeholder="Name and Surname" name="surname" value="<?php echo isset($cart_users_data['user_name']) ? $cart_users_data['user_name'] : '' ?>"  required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="cart_company" class="col-sm-4 control-label"><?php echo lang('Company') ?></label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="cart_company" placeholder="Company" name="company" value="<?php echo isset($cart_users_data['company']) ? $cart_users_data['company'] : '' ?>" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="cart_address" class="col-sm-4 control-label"><?php echo lang('Address') ?></label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="cart_address" placeholder="Address" name="address" value="<?php echo isset($cart_users_data['address']) ? $cart_users_data['address'] : '' ?>" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="cart_designation" class="col-sm-4 control-label"><?php echo lang('Designation') ?></label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="cart_designation" placeholder="Designation" name="designation"  value="<?php echo isset($cart_users_data['designation']) ? $cart_users_data['designation'] : '' ?>" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="cart_country" class="col-sm-4 control-label"><?php echo lang('Country') ?></label>
                                <div class="col-sm-8" id="popupboxcountrywrap">
                                    <?php $cart_users_country = isset($cart_users_data['country']) ? $cart_users_data['country'] : ''; ?>
                                    <select name="country" id="cart_country" style="height:35px" class="form-control selectpicker1" >
                                        <?php foreach ($countries as $country) { ?>
                                        <option value='<?php echo htmlentities($country['countryName'],ENT_QUOTES); ?>' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag <?php echo htmlentities($country['alpha_2']); ?>" data-title="<?php echo htmlentities($country['countryName']); ?>" <?php if ($country['countryName'] == "Canada") { ?> selected="selected"<?php } ?>><?php echo $country['countryName']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <input type="hidden" name="country_flag" id="country_flag"/>
                            <div class="form-group">
                                <label for="cart_telephone" class="col-sm-4 control-label"><?php echo lang('Telephone') ?></label> 
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="cart_telephone" placeholder="Telephone" name="telephone" value="<?php echo isset($cart_users_data['telephone']) ? $cart_users_data['telephone'] : '' ?>" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="cart_email" class="col-sm-4 control-label"><?php echo lang('Email') ?></label> 
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="cart_email" placeholder="Email"  name="email" value="<?php if (count($cart_users_data)>0)echo isset($cart_users_data['email']) ? $cart_users_data['email'] : '' ?>" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="cart_deadline" class="col-sm-4 control-label"><?php echo lang('Deadline') ?></label> 
                                <div class="col-sm-8">
                                    <input type="text" class="form-control datetimepicker" id="cart_deadline" placeholder="Deadline" name="deadline" value="<?php echo isset($cart_users_data['deadline']) ? $cart_users_data['deadline'] : '' ?>" autocomplete="off" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="cart_rfq" class="col-sm-4 control-label"><?php echo lang('RFQ Number') ?></label> 
                                <div class="col-sm-8 " style="text-align:center; "  id="cart_rfq_number">
                                    <!--012012-54525485648-4590458345-45435-->
                                    <?php
                                    //$randomString = substr(str_shuffle("0123456789"),0,6).'-'.time().'-'.substr(str_shuffle("0123456789"),0,10);
                                    $randomString = substr(str_shuffle("0123456789"), 0, 6);
                                    echo isset($cart_users_data['rfq']) ? $cart_users_data['rfq'] : $randomString;
                                    ?>
                                    <input type="text" id="cart_rfq" value="" style="display:none;" />
                                    <input type="hidden"  name="rfq" value="<?php echo isset($cart_users_data['rfq']) ? $cart_users_data['rfq'] : $randomString; ?>" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="incoterms" class="col-sm-4 control-label"><?php echo lang('Incoterms') ?></label>
                                <div class="col-sm-8">
                                    <select name="incoterms" id="incoterms" class="form-control selectpicker1" style="height:35px">
                                        <option value="EXW">EXW</option>
                                        <option value="FCA">FCA</option>
                                        <option value="CPT">CPT</option>
                                        <option value="CIP">CIP</option>
                                        <option value="DAT">DAT</option>
                                        <option value="DAP">DAP</option>
                                        <option value="FAS">FAS</option>
                                        <option value="FOB">FOB</option>
                                        <option value="CFR">CFR</option>
                                        <option value="CIF">CIF</option>
                                        <option value="DAF">DAF</option>
                                        <option value="DES">DES</option>
                                        <option value="DEQ">DEQ</option>
                                        <option value="DDU">DDU</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div style="min-height:439px; padding-top:55px; text-align:center; padding-left:50px;"><img src="assets/uploads/cart/<?php echo isset($cart_image) ? $cart_image : ''; ?>" style="max-width: 542px; min-height: 471px;" alt="Cart"></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <?php if (!empty($cart_details)) {
                            ?>
                            <div class="table-responsive" id="not_empty_cart">
                                <input type="hidden" value="1" name="update" style="width:50px;">
                                <table  class="table table-bordered my-table productsbytype">
                                    <?php
                                    $i = 1;
                                    $currentproducttype_id = '';
                                    $currentproducttype = '';
                                    foreach ($cart_details as $cart) {
                                        $privilage = explode('#', $cart['menu_privilages']);                                        
                                        ?>
                                        <input type="hidden" value="<?php echo $cart['id']; ?>" name="product_id[]" style="width:50px">
                                        <?php
                                        if ($currentproducttype != $cart['type']) {
                                            if ($i > 1)
                                                echo '</tbody></table><table class="table table-bordered my-table productsbytype">';
                                            ?>
                                            <thead>
                                                <th colspan="11"><?php echo $cart['type']; ?>
                                                    <input type="button" id="minimize_block_<?php echo $cart['id']; ?>" class="minimize_block" name="minimize_block" value="-" style="float:right;"></th>
                                                </thead>

                                                <thead class="minimize_block_<?php echo $cart['id']; ?>">
                                                    <tr>
                                                        <th><?php echo lang('DELETE') ?></th>	
                                                        <th><?php echo lang('No.') ?></th>
                                                        <th><?php echo lang('QTY') ?></th>	
                                                        <th><?php echo lang('COMMENTS') ?></th>		
                                                        <th><?php echo lang('KGT REF#') ?></th>		
                                                        <th><?php echo lang('PRODUCT PHOTO') ?>	</th>		
                                                        <th><?php echo lang('VEHICLE PHOTO') ?></th>		
                                                        <?php if (in_array("drawing_photo", $privilage)) { ?>
                                                        <th><?php echo lang('DRAWING PHOTO') ?></th>		
                                                        <?php } ?>
                                                        <th>&nbsp;</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="minimize_block_<?php echo $cart['id']; ?>">
                                                    <?php } ?>
                                                    <tr class="cart_details_row cart_details_row_<?php echo $cart['id']; ?>">
                                                <td><span><a href="javascript:void(0);" style="color:#000" onClick="remove_cart(this,<?php echo $cart['id']; ?>);"><i class="fa fa-times"></i></a></span></td>
                                                <td style="color: #575757; font-family: arial; font-size: 12px; text-align: center;" class="cart_item_count"><span><?php echo $i; ?></span></td>
                                                <td><span style="color: #575757; font-family: arial; font-size: 12px; text-align: center;">
                                                        <input type="text" value="<?php echo $cart['quantity']; ?>" style="width:50px" name="quantity[<?php echo $cart['id'] ?>]" >
                                                    </span></td>
                                                <td style="color: #575757; font-family: arial; font-size: 12px; text-align: center;"><span>
                                                        <textarea name="comment[<?php echo $cart['id'] ?>]"><?php echo $cart['comment']; ?></textarea>
                                                    </span></td>
                                                <td style="color: #575757; font-family: arial; font-size: 12px; text-align: center;"><span><?php echo $cart['kgt_ref_number']; ?></span></td>
                                                <td style="color: #575757; font-family: arial; font-size: 12px; text-align: center;"><span>
												
												 <?php if($cart['product_photo'] !='' && file_exists("assets/uploads/product_images/".$cart['product_photo']) ){?>
												 <a class="example-image-link" data-lightbox="example-<?php echo $cart['id']; ?>" href="assets/uploads/product_images/<?php echo $cart['product_photo']; ?>"> 
												<img src="assets/uploads/product_images/<?php echo $cart['product_photo']; ?>" height="75" alt="<?php echo $cart['product_photo']; ?>" /></a>&nbsp;
												<?php }else{ ?>
												<a class="example-image-link" data-lightbox="example-<?php echo $cart['id']; ?>" href="images/coming_soon.jpg"> 
												<img src="images/coming_soon.jpg" width="100" height="80">
												</a>&nbsp;
												<?php } ?>
												 </a>&nbsp;</span></td>
                                                <td style="color: #575757; font-family: arial; font-size: 12px; text-align: center;"><span> 
												
												<?php if($cart['vehicle_photo'] !='' && file_exists("assets/uploads/product_images/".$cart['vehicle_photo']) ){?>
												<a class="example-image-link" data-lightbox="example-<?php echo $cart['id']; ?>" href="assets/uploads/product_images/<?php echo $cart['vehicle_photo']; ?>"> 
												<img src="assets/uploads/product_images/<?php echo $cart['vehicle_photo']; ?>" height="75" alt="<?php echo $cart['vehicle_photo']; ?>" /> </a>&nbsp;
												<?php }else{ ?>
												<a class="example-image-link" data-lightbox="example-<?php echo $cart['id']; ?>" href="images/coming_soon.jpg"> 
												<img src="images/coming_soon.jpg" width="100" height="80">
												</a>&nbsp;
												<?php } ?>
												</span></td>
       <?php  if (in_array("drawing_photo", $privilage)) { ?>
                                                        <td style="color: #575757; font-family: arial; font-size: 12px; text-align: center;"><span> 
														
														<?php  if($cart['drawing_photo'] !='' && file_exists("assets/uploads/product_images/".$cart['drawing_photo']) ){?>
														<a class="example-image-link" data-lightbox="example-<?php echo $cart['id']; ?>" href="assets/uploads/product_images/<?php echo $cart['drawing_photo']; ?>"> 
														<img src="assets/uploads/product_images/<?php echo $cart['drawing_photo']; ?>" alt="<?php echo $cart['drawing_photo']; ?>" height="75" /> </a>&nbsp;
														<?php }else{ ?>
														<a class="example-image-link" data-lightbox="example-<?php echo $cart['id']; ?>" href="images/coming_soon.jpg"> 
												<img src="images/coming_soon.jpg" width="100" height="80">
												</a>&nbsp;
												<?php } ?>
												</span></td>
												<?php } ?>
                                                <td style="color: #575757; font-family: arial; font-size: 12px; text-align: center;"><a href="javascript:void(0)" onClick="$(this).parent().parent().next('.less_info').toggle();$(this).find('.less_img').toggle();$(this).find('.more_img').toggle();"> 
                                                <!--<img class="less_img" src="assets/template/images/less_info.png" style="display:none" alt=""/> 
                                                <img class="more_img" src="assets/template/images/more_info.png" style="display:inline" alt=""/> </a> </td>-->

                                                        <img class="less_img" src="" style="display:inline; color: black;  background-color: whitesmoke;" alt=" - "/> 
                                                        <img class="more_img" src="" style="display:none; color: black;  background-color: whitesmoke;" alt=" + "/> </a> </td>

                                            </tr>
                                            <tr class="less_info cart_details_row_<?php echo $cart['id']; ?>" style="background-color: rgb(219, 219, 219);">
                                                <td colspan="11" style="color: #575757; font-family: arial; font-size: 12px;"><div class="single_product_wrapper">
                                                    <div class="detail_wrap" style="text-align:left">
                                                        <?php if ($cart['oem_part_number'] != '' && in_array("oem_part_number", $privilage)) { ?>
                                                        <div class="single_detail"> <span><?php echo lang('OEM PART NUMBER') ?> :</span> <span><?php echo $cart['oem_part_number']; ?></span> </div>
                                                        <?php } ?>	

                                                        <?php if ($cart['application'] != '' && in_array("application", $privilage)) { ?>
                                                        <div class="single_detail"> <span><?php echo lang('APPLICATION') ?> :</span> <span><?php echo $cart['application']; ?></span> </div>
                                                        <?php } ?>	

                                                        <?php if ($cart['others'] != '' && in_array("others", $privilage)) { ?>
                                                        <div class="single_detail"> <span><?php echo lang('OTHER') ?> :</span> <span><?php echo $cart['others']; ?></span> </div>
                                                        <?php } ?>	

                                                        <?php if ($cart['wva'] != '' && in_array("wva", $privilage)) { ?>
                                                        <div class="single_detail"> <span><?php echo lang('WVA') ?> :</span> <span><?php echo $cart['wva']; ?></span> </div>
                                                        <?php } ?>
                                                        
                                                        
                                                        

                                                        <?php if ($cart['make'] != '' && in_array("maker_id", $privilage)) { ?>
                                                        <div class="single_detail"> <span><?php echo lang('Vehicle Brand Name') ?> :</span> <span><?php echo $cart['make']; ?></span> </div>
                                                        <?php } ?>
                                                        
                                                        <?php if ($cart['mann'] != ''  && in_array("mann", $privilage)) { ?>
                                                        <div class="single_detail"> <span>Mann :</span> <span><?php echo $cart['mann']; ?></span> </div>
                                                        <?php } ?>

                                                    </div>
                                                    <div class="detail_wrap" style="text-align:center">
                                                        <?php if ($cart['fmsi_ref_number'] != '' && in_array("fmsi_ref_number", $privilage)) { ?>
                                                        <div class="single_detail"> <span><?php echo lang('FMSI Ref.') ?> :</span> <span><?php echo $cart['fmsi_ref_number']; ?></span> </div>
                                                        <?php } ?>	

                                                        <?php if ($cart['year'] != '' && in_array("year", $privilage)) { ?>
                                                        <div class="single_detail"> <span><?php echo lang('Model manufacturing year') ?> :</span> <span><?php echo $cart['year']; ?></span> </div>
                                                        <?php } ?>	

                                                        <?php if ($cart['front_rear'] != '' && in_array("front_rear", $privilage)) { ?>
                                                        <div class="single_detail"> <span><?php echo lang('front/rear (wheel)') ?> :</span> <span><?php echo $cart['front_rear']; ?></span> </div>
                                                        <?php } ?>	

                                                        <?php if ($cart['model'] != '' && in_array("model", $privilage)) { ?>
                                                        <?php echo lang('Vehicle Model Name') ?> :<?php echo $cart['drawing_photo']; ?>
                                                        <?php } ?>	

                                                    </div>
                                                    <div class="clear"></div>
                                                </div></td>
                                            </tr>
                                            <?php
                                            $i++;
                                            $currentproducttype = $cart['type'];
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="out-box-modal" id="empty_cart" style="display:none;">
                                <div class="box-content-modal">
                                    <h2 class="title-modal big"><?php echo lang('empty cart') ?></h2> 
                                </div>
                            </div>
                            <?php } else { ?>
                            <div class="out-box-modal" id="empty_cart">
                                <div class="box-content-modal">
                                    <h2 class="title-modal big"><?php echo lang('empty cart') ?></h2> 
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
                <?php if (!empty($cart_details)) { ?>
                <div class="nav-prex-next text-right" id="cart_buttons">
                    <div class="row">
                        <div class="col-md-12">
                            <!--<a href="front/continue_shopping_cart" class="btn btn-primary btn-sm">Back</a>
                            <a href="front/continue_shopping_cart" class="btn btn-primary btn-sm">CONTINUE SHOPPING</a>-->
                            <a href="javscript:void(0)" class="btn btn-primary btn-sm"  id="cart_back"><?php echo lang('Back') ?></a> <a href="javscript:void(0)" class="btn btn-primary btn-sm"  id="cart_continue_shopping"><?php echo lang('CONTINUE SHOPPING') ?></a> <a href="javascript:void(0)" class="btn btn-primary btn-sm" id="cart_checkout"><?php echo lang('SUBMIT') ?></a> </div> 

                        </div>
                    </div>
                    <?php } ?>
                </div>
                <!--End content-->
            </div>
        </form>
  <span style="display:none;" id="maincart_block_msg"><?php if (isset($selection_instruction[0]->maincart_block_msg)) echo $selection_instruction[0]->maincart_block_msg;?></span>
  <span style="display:none;" id="editcart_block_msg"><?php if (isset($selection_instruction[0]->editcart_block_msg)) echo $selection_instruction[0]->editcart_block_msg;?></span>
  <span style="display:none;" id="cartpreview_block_msg"><?php if (isset($selection_instruction[0]->cartpreview_block_msg)) echo $selection_instruction[0]->cartpreview_block_msg;?></span>
  <span style="display:none;" id="cartverification_block_msg"><?php if (isset($selection_instruction[0]->cartverification_block_msg)) echo $selection_instruction[0]->cartverification_block_msg;?></span>
  <span style="display:none;" id="cartverification_resent_block_msg"><?php if (isset($selection_instruction[0]->cartverification_resent_block_msg)) echo $selection_instruction[0]->cartverification_resent_block_msg;?></span>
  <span style="display:none;" id="cartverification_wrong_block_msg"><?php if (isset($selection_instruction[0]->cartverification_wrong_block_msg)) echo $selection_instruction[0]->cartverification_wrong_block_msg;?></span>
  <span style="display:none;" id="block_notification_msg"><?php if (isset($selection_instruction[0]->block_notification_msg)) echo $selection_instruction[0]->block_notification_msg;?></span>
  
        <!--Modal shopping decision cart-->
        <div class="modal fade" id="user_block_box">
            <div class="modal-dialog">
                <div class="modal-content">                          
                  <div class="modal-body">
                    <div class="box-content-modal">                                
                        <div class="blockElementWrap">
                            <div class="blockMsg" id="blockMsg">                            
                            </div> 
                            <h2 class="title-modal" id="blockMsg1"><?php echo lang('You Have Been Blocked. Please Try After 120 minutes.') ?></h2> 
                        </div>

                        <div class="clearfix"></div>
                        <div class="btn-modal">
                            <div class="row">
                                <div class="col-md-12 col-xs-12 text-right"> <a href="javascript:void(0)" onClick="$('#user_block_box').modal('hide');window.location.href =' <?php echo base_url(); ?>cart/index'" class="btn btn-primary btn-sm" id="block_confirm_msg"><?php echo lang('OK') ?> <i class="glyphicon glyphicon-chevron-right"></i></a> </div> 
                            </div>
                        </div>
                    </div>
                </div>           
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    <!--Modal shopping decision cart-->
        <div class="modal fade" id="main_cart_block_box">
            <div class="modal-dialog">
                <div class="modal-content">                          
                  <div class="modal-body">
                    <div class="box-content-modal">                                
                        <div class="blockElementWrap">
                            <div class="blockMsg" id="blockMsg_main_cart">                            
                            </div> 
                            
                        </div>

                        <div class="clearfix"></div>
                        <div class="btn-modal">
                            <div class="row">
                                <div class="col-md-12 col-xs-12 text-right"> <a href="javascript:void(0)" onClick="$('#main_cart_block_box').modal('hide');window.location.href =' <?php echo base_url(); ?>cart/clear_user_session'" class="btn btn-primary btn-sm" id="block_confirm_msg2"><?php echo lang('OK') ?> <i class="glyphicon glyphicon-chevron-right"></i></a> </div> 
                            </div>
                        </div>
                    </div>
                </div>           
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    
    <!--Modal shopping decision cart-->
    <div class="modal fade" id="modal_mssg">
        <div class="modal-dialog">
            <div class="modal-content">           
              <div class="modal-body">
                <div class="box-content-modal">
                    <h2 id="already_added_msg_title" class="title-modal"><?php echo lang('Check Date') ?></h2> 
                    <p id="already_added_msg"></p>
                    <div class="clearfix"></div>
                    <div class="btn-modal">

                        <a style="float:right" href="javascript:void(0)" onClick="$('#modal_mssg').modal('hide');" class="btn btn-primary btn-sm"><?php echo lang('OK') ?> <i class="glyphicon glyphicon-chevron-right"></i></a>	 
                    </div>
                </div>
            </div>           
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<!-- this might happen when user was in another page and then time has ended. then after that if he comes in cart then he will get this message. -->
<!--Modal shopping decision cart-->
<div class="modal fade" id="user_timeout_cart">
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
                    <?php
                    $session_data = $this->session->userdata('cart_users_data');
                    $email = $session_data['email'];
                    ?>
                    <div class="blockMsg" id="blockMsg2">Unfortunately, you did not finish shopping during the given lead-time. Therefore, you will be welcome to use an alternative email or wait for 120 minutes to use the current email <?php echo $email; ?> within our website.  </div>

                </div>

                <div class="clearfix"></div>
                <div class="btn-modal">
                    <div class="row">

                        <div class="col-md-12 col-xs-12 text-right">
                         <a href="javascript:void(0)" onClick="
                         window.location.href = ' <?php echo base_url(); ?>cart/make_user_block';" class="btn btn-primary btn-sm" id="block_confirm_msg1"><?php echo lang('OK') ?> <i class="glyphicon glyphicon-chevron-right"></i></a>	
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

