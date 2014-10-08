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
                <h5><i class="font-user"></i>Contact message section</h5>
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
                                    <div class="block well">
                                        <div class="navbar"><div class="navbar-inner"><h5>Time out from preview popup</h5></div></div>

                                        <div class="control-group">
                                            <label class="control-label">Body Content:</label>
                                            <div class="controls"><textarea id="title2" name="preview_timeout" class="focustip span12"><?php if (isset($contact_message[0]->preview_timeout)) echo $contact_message[0]->preview_timeout; ?></textarea></div>
                                        </div>
                                    </div>


                                    <div class="block well">
                                        <div class="navbar"><div class="navbar-inner"><h5>Time out popup</h5></div></div>

                                        <div class="control-group">
                                            <label class="control-label">Body Content:</label>
                                            <div class="controls"><textarea id="title2" name="verification_timeout" class="focustip span12"><?php if (isset($contact_message[0]->verification_timeout)) echo $contact_message[0]->verification_timeout; ?></textarea></div>
                                            <span style="color:#F00;"><?php echo form_error('verification_timeout'); ?></span>
                                            <span style="color:black;">NB : In this message please use PHRASE for 'email' <br>So example is :Unfortunately, you did not take any action on the contact us form during the given lead time. Therefore, you will be welcome to use an alternative email or wait for 120 minutes to use the current email test@mail.com within our website..</span>
                                        </div>
                                    </div>
                                    <div class="block well">
                                        <div class="navbar"><div class="navbar-inner"><h5>Contact Section enter 3 time's wrong code popup</h5></div></div>

                                        <div class="control-group">
                                            <label class="control-label">Body Content:</label>
                                            <div class="controls"><textarea id="title2" name="error_code_block_msg" class="focustip span12"><?php if (isset($contact_message[0]->error_code_block_msg)) echo $contact_message[0]->error_code_block_msg; ?></textarea></div>
                                            <span style="color:#F00;"><?php echo form_error('error_code_block_msg'); ?></span>
                                            <span style="color:black;">NB : In this message please use PHRASE for 'email' <br>So example is : Unfortunately, you entered wrong verification code during the 3 attempts. Therefore, you will be welcome to use an alternative email or wait for 120 minutes to use the current email test@mail.com within our website.. </span>
                                        </div>
                                    </div>
                                    <div class="block well">
                                        <div class="navbar"><div class="navbar-inner"><h5>Contact Section did not enter code within the lead time</h5></div></div>

                                        <div class="control-group">
                                            <label class="control-label">Body Content:</label>
                                            <div class="controls"><textarea id="title2" name="code_timeout_block_msg" class="focustip span12"><?php if (isset($contact_message[0]->code_timeout_block_msg)) echo $contact_message[0]->code_timeout_block_msg; ?></textarea></div>
                                            <span style="color:#F00;"><?php echo form_error('code_timeout_block_msg'); ?></span>
                                            <span style="color:black;">NB : In this message please use PHRASE for 'email' <br>So example is : Unfortunately, you did not enter the correct verification code within the given lead-time. Therefore, you are welcome to use an alternative email or wait 120 minutes to be able to use your current email address test@mail.com within our website. Thank you.. </span>
                                        </div>
                                    </div>

                                    <div class="block well">
                                        <div class="navbar"><div class="navbar-inner"><h5>Contact Section 3 time's resend blocked popup</h5></div></div>

                                        <div class="control-group">
                                            <label class="control-label">Body Content:</label>
                                            <div class="controls"><textarea id="title2" name="resend_block_msg" class="focustip span12"><?php if (isset($contact_message[0]->resend_block_msg)) echo $contact_message[0]->resend_block_msg; ?></textarea></div>
                                            <span style="color:#F00;"><?php echo form_error('resend_block_msg'); ?></span>
                                            <span style="color:black;">NB : In this message please use PHRASE for 'email' <br>So example is :Unfortunately, you did not enter the correct verification code even after we resend it to you for consecutive 3 times. Therefore, you are welcome to use an alternative email or wait 120 minutes to be able to use your current email address test@mail.com within our website. Thank you.</span>
                                        </div>
                                    </div>
                                    <div class="block well">
                                        <div class="navbar"><div class="navbar-inner"><h5>Contact Section already blocked popup</h5></div></div>

                                        <div class="control-group">
                                            <label class="control-label">Body Content:</label>
                                            <div class="controls"><textarea id="title2" name="blocked_email_msg" class="focustip span12"><?php if (isset($contact_message[0]->blocked_email_msg)) echo $contact_message[0]->blocked_email_msg; ?></textarea></div>
                                            <span style="color:#F00;"><?php echo form_error('blocked_email_msg'); ?></span>
                                            <span style="color:black;">NB : In this message please use PHRASE for 'email',SECTION for 'Section' <br>So example is :The email test@mail.com  is blocked in the section Contact. Therefore, please use an alternative email or wait 120 minutes to use this email again within our website. Thank you.</span>
                                        </div>
                                    </div>
                                    <div class="block well">
                                        <div class="navbar"><div class="navbar-inner"><h5>Contact Section refreshed page</h5></div></div>

                                        <div class="control-group">
                                            <label class="control-label">Body Content:</label>
                                            <div class="controls"><textarea id="title2" name="refreshed_msg" class="focustip span12"><?php if (isset($contact_message[0]->refreshed_msg)) echo $contact_message[0]->refreshed_msg; ?></textarea></div>
                                            <span style="color:#F00;"><?php echo form_error('refreshed_msg'); ?></span>
                                            <span style="color:black;">NB : In this message please use PHRASE for 'email' <br>So example is :Unfortunately, you refreshed the page except doing verification code submission. Therefore, you will be welcome to use an alternative email or wait for 120 minutes to use the current email test@mail.com within our website.</span>
                                        </div>
                                    </div>
                                    
                                        <div class="block well">
                                        <div class="navbar"><div class="navbar-inner"><h5>Contact Section success popup</h5></div></div>


                                        <div class="control-group">
                                            <label class="control-label">Header Content:</label>
                                            <div class="controls"><input id="title2" name="modal_success_header" class="focustip span12" type="text" value="<?php if (isset($contact_message[0]->modal_success_header)) echo $contact_message[0]->modal_success_header; ?>" /></div>
                                            <span style="color:#F00;"><?php echo form_error('modal_success_header'); ?></span>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Body Content:</label>
                                            <div class="controls"><textarea id="title2" name="modal_success_body" class="focustip span12"><?php if (isset($contact_message[0]->modal_success_body)) echo $contact_message[0]->modal_success_body; ?></textarea></div>
                                            <span style="color:#F00;"><?php echo form_error('modal_success_body'); ?></span>
                                            <span style="color:black;">NB : In this message please use PHRASE for 'email' <br>So example is :<span style="color:black;">NB : In this message please use PHRASE for 'email' <br>So example is :KGT appreciate your valuable time and we thank you for contacting us. Your email is successfully received and a copy is already sent to: test@mail.com. We should review and act accordingly. If it is urgent, then please feel free to contact us by phone, as we are available 24/7. Thank you again for your valuable time.</span>.</span>
                                        </div>
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