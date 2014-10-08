<div style="margin-right: 0px;" class="content">
    <?php
    if ($this->session->flashdata('success')) {
        $msg = $this->session->flashdata('success');
        ?>
        <div class="notice outer">
            <div class="note"><?php echo $msg; ?>
            </div>
        </div>
        <?php
    }
    ?>    


    <div class="outer">
        <div class="inner">
            <div class="page-header">
                <!-- page title -->
                <h5><i class="font-user"></i>Selection instructions for product section</h5>
                <!-- End page title -->
                <div class="body">


                    <!-- Content container -->
                    <div class="container">
                        <!-- Pickers -->
                        <form class="form-horizontal" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="operation" value="set" />
                            <div class="row-fluid">

                                <!-- Column -->
                                <div class="span12">
                                    <!-- Time pickers -->
                                    <div class="block well">
                                        <div class="navbar"><div class="navbar-inner"><h5>Product page</h5></div></div>
                                        <div class="control-group">
                                            <label class="control-label">Message:</label>
<!--                                            <div class="controls"><input id="title2" name="product_msg" class="focustip span12" type="text" value="<?php echo $selection_instruction[0]->product_msg;?>"></div>-->
                                            <div class="controls"><textarea id="title2" name="product_msg" class="focustip span12"><?php echo $selection_instruction[0]->product_msg;?></textarea></div>
                                            <span style="color:#F00;"><?php echo form_error('product_msg'); ?></span>
                                        </div>
                                    </div>
                                    <div class="block well">
                                        <div class="navbar"><div class="navbar-inner"><h5>Product type page</h5></div></div>

                                        
                                        <div class="control-group">
                                            <label class="control-label">Message:</label>
                                            <div class="controls"><textarea id="title2" name="product_type_msg" class="focustip span12"><?php if (isset($selection_instruction[0]->product_type_msg)) echo $selection_instruction[0]->product_type_msg;?></textarea></div>
                                            <span style="color:#F00;"><?php echo form_error('product_type_msg'); ?></span>
                                        </div>

                                    </div>
                                    <div class="block well">
                                        <div class="navbar"><div class="navbar-inner"><h5>Vehicle type page</h5></div></div>

                                        
                                        <div class="control-group">
                                            <label class="control-label">Message:</label>
                                            <div class="controls"><textarea id="title2" name="vehicle_type_msg" class="focustip span12"><?php if (isset($selection_instruction[0]->vehicle_type_msg)) echo $selection_instruction[0]->vehicle_type_msg;?></textarea></div>
                                            <span style="color:#F00;"><?php echo form_error('vehicle_type_msg'); ?></span>
                                        </div>
                                    </div>
                                    <div class="block well">
                                        <div class="navbar"><div class="navbar-inner"><h5>Product brand page</h5></div></div>

                                        
                                        <div class="control-group">
                                            <label class="control-label">Message:</label>
                                            <div class="controls"><textarea id="title2" name="product_brand_msg" class="focustip span12"><?php if (isset($selection_instruction[0]->product_brand_msg)) echo $selection_instruction[0]->product_brand_msg;?></textarea></div>
                                            <span style="color:#F00;"><?php echo form_error('product_brand_msg'); ?></span>
                                        </div>
                                    </div>
                                    <div class="block well">
                                        <div class="navbar"><div class="navbar-inner"><h5>Product list page</h5></div></div>

                                        
                                        <div class="control-group">
                                            <label class="control-label">Message:</label>
                                            <div class="controls"><textarea id="title2" name="product_list_msg" class="focustip span12"><?php if (isset($selection_instruction[0]->product_list_msg)) echo $selection_instruction[0]->product_list_msg;?></textarea></div>
                                            <span style="color:#F00;"><?php echo form_error('product_list_msg'); ?></span>
                                        </div>
                                    </div>
                                    <div class="block well">
                                        <div class="navbar"><div class="navbar-inner"><h5>Product Section selection popup</h5></div></div>

                                        
                                        <div class="control-group">
                                            <label class="control-label">Header Content:</label>
                                            <div class="controls"><input id="title2" name="selection_popup_header" class="focustip span12" type="text" value="<?php if (isset($selection_instruction[0]->selection_popup_header)) echo $selection_instruction[0]->selection_popup_header;?>" /></div>
                                            <span style="color:#F00;"><?php echo form_error('selection_popup_header'); ?></span>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Body Content:</label>
                                            <div class="controls"><textarea id="title2" name="selection_popup_body" class="focustip span12"><?php if (isset($selection_instruction[0]->selection_popup_body)) echo $selection_instruction[0]->selection_popup_body;?></textarea></div>
                                            <span style="color:#F00;"><?php echo form_error('selection_popup_body'); ?></span>
                                        </div>
                                    </div>
                                    
                                    <div class="block well">
                                        <div class="navbar"><div class="navbar-inner"><h5>Item add to cart related message in Product Section </h5></div></div>

                                        <div class="control-group">
                                            <label class="control-label">Pop up Header:</label>
                                            <div class="controls"><textarea id="title2" name="addtocart_popup_header" class="focustip span12"><?php if (isset($selection_instruction[0]->addtocart_popup_header)) echo $selection_instruction[0]->addtocart_popup_header;?></textarea></div>
                                            <span style="color:#F00;"><?php echo form_error('already_exist_msg'); ?></span>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Already in Cart Message:</label>
                                            <div class="controls"><textarea id="title2" name="already_exist_msg" class="focustip span12"><?php if (isset($selection_instruction[0]->already_exist_msg)) echo $selection_instruction[0]->already_exist_msg;?></textarea></div>
                                            <span style="color:black;">NB : In this message please use PHRASE for 'are/is', PHRASEITEM for 'items/item', PHRASETHIS for 'this/these',PHRASEIT for 'it/them' and REFNAME to show the reference names of the items. <br>So example is : You added PHRASETHIS PHRASEITEM which PHRASE added to your cart. Reference : REFNAME </span>
                                            <span style="color:#F00;"><?php echo form_error('already_exist_msg'); ?></span>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label">Add to Cart Message:</label>
                                            <div class="controls"><textarea id="title2" name="addtocart_msg" class="focustip span12"><?php if (isset($selection_instruction[0]->addtocart_msg)) echo $selection_instruction[0]->addtocart_msg;?></textarea></div>
                                            <span style="color:black;">NB : In this message please use PHRASE for 'are/is', PHRASEITEM for 'items/item', PHRASETHIS for 'this/these',PHRASEIT for 'it/them', ITEMNUMBER for showing number of item and REFNAME to show the reference names of the items. <br>So example is : You added PHRASETHIS PHRASEITEM which PHRASE added to your cart. Reference : REFNAME </span>
                                            <span style="color:#F00;"><?php echo form_error('selection_popup_body'); ?></span>
                                        </div>
                                    </div>
                                    <div class="block well">
                                        <div class="navbar"><div class="navbar-inner"><h5>Block related message in Cart and Product Section </h5></div></div>

                                        <div class="control-group">
                                            <label class="control-label">Main cart block message:</label>
                                            <div class="controls"><textarea id="title2" name="maincart_block_msg" class="focustip span12"><?php if (isset($selection_instruction[0]->maincart_block_msg)) echo $selection_instruction[0]->maincart_block_msg;?></textarea></div>
                                            <span style="color:black;">NB : In this message please use EMAILVAR for email address<br>So example is : Unfortunately, you did not finish shopping during the given lead-time.  Therefore, you will be welcome to use an alternative email or wait for 120 minutes to use the current email EMAILVAR within our website.</span>
                                            <span style="color:#F00;"><?php echo form_error('maincart_block_msg'); ?></span>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Edit cart block message:</label>
                                            <div class="controls"><textarea id="title2" name="editcart_block_msg" class="focustip span12"><?php if (isset($selection_instruction[0]->editcart_block_msg)) echo $selection_instruction[0]->editcart_block_msg;?></textarea></div>
                                            <span style="color:black;">NB : In this message please use EMAILVAR for email address<br>So example is : Unfortunately, you did not finish editing the cart during the given lead-time.  Therefore, you will be welcome to use an alternative email or wait for 120 minutes to use the current email EMAILVAR within our website.</span>
                                            <span style="color:#F00;"><?php echo form_error('editcart_block_msg'); ?></span>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label">Cart preview block message:</label>
                                            <div class="controls"><textarea id="title2" name="cartpreview_block_msg" class="focustip span12"><?php if (isset($selection_instruction[0]->cartpreview_block_msg)) echo $selection_instruction[0]->cartpreview_block_msg;?></textarea></div>
                                            
                                            <span style="color:black;">NB : In this message please use EMAILVAR for email address<br>So example is : Unfortunately you did not take any action during the given lead-time.  Therefore, you will be welcome to use an alternative email or wait for 120 minutes to use the current email EMAILVAR within our website.</span>
                                            <span style="color:#F00;"><?php echo form_error('cartpreview_block_msg'); ?></span>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Cart verification block message:</label>
                                            <div class="controls"><textarea id="title2" name="cartverification_block_msg" class="focustip span12"><?php if (isset($selection_instruction[0]->cartverification_block_msg)) echo $selection_instruction[0]->cartverification_block_msg;?></textarea></div>
                                            <span style="color:black;">NB : In this message please use EMAILVAR for email address<br>So example is : Unfortunately, you did not enter the correct code within the given lead-time.  Therefore, you will be welcome to use an alternative email or wait for 120 minutes to use the current email EMAILVAR within our website.</span>
                                            <span style="color:#F00;"><?php echo form_error('cartverification_block_msg'); ?></span>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Cart verification resend email block message:</label>
                                            <div class="controls"><textarea id="title2" name="cartverification_resent_block_msg" class="focustip span12"><?php if (isset($selection_instruction[0]->cartverification_resent_block_msg)) echo $selection_instruction[0]->cartverification_resent_block_msg;?></textarea></div>
                                            <span style="color:black;">NB : In this message please use EMAILVAR for email address<br>So example is : unfortunately, after we resent you 3 verification code you did not enter the right code yet.  Therefore, you will be welcome to use an alternative email or wait for 120 minutes to use the current email EMAILVAR within our website.</span>
                                            <span style="color:#F00;"><?php echo form_error('cartverification_resent_block_msg'); ?></span>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Cart verification 3 times wrong block message:</label>
                                            <div class="controls"><textarea id="title2" name="cartverification_wrong_block_msg" class="focustip span12"><?php if (isset($selection_instruction[0]->cartverification_wrong_block_msg)) echo $selection_instruction[0]->cartverification_wrong_block_msg;?></textarea></div>
                                            <span style="color:black;">NB : In this message please use EMAILVAR for email address<br>So example is : Unfortunately, you entered wrong verification code during the 3 attempts.  Therefore, you will be welcome to use an alternative email or wait for 120 minutes to use the current email EMAILVAR within our website.</span>
                                            <span style="color:#F00;"><?php echo form_error('cartverification_wrong_block_msg'); ?></span>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Email blocked notification message:</label>
                                            <div class="controls"><textarea id="title2" name="block_notification_msg" class="focustip span12"><?php if (isset($selection_instruction[0]->block_notification_msg)) echo $selection_instruction[0]->block_notification_msg;?></textarea></div>
                                            <span style="color:black;">NB : In this message please use EMAILVAR for email address and TIMEVAR for the number of minutes and SECTIONVAR for the section<br>So example is : The email EMAILVAR is blocked in the section SECTIONVAR. Therefore, please use an alternative email or wait TIMEVAR minutes to use this email again within our website. Thank you</span>
                                            <span style="color:#F00;"><?php echo form_error('block_notification_msg'); ?></span>
                                        </div>
                                    </div>
                                    
                                    
                                    <div class="form-actions align-right">
                                        <input class="btn btn-primary" value="Update" id="send" type="submit">
                                    </div>
                                </div>






                            </div>
                            <!-- /column -->

                        </form>
                    </div>

                    <!-- /pickers -->

                </div>
                <!-- /content container -->

            </div>
        </div>
    </div>
</div>