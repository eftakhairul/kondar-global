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
                <h5><i class="font-user"></i>Career message section</h5>
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
                                        <div class="navbar"><div class="navbar-inner"><h5>Confirm validity popup</h5></div></div>

                                        <div class="control-group">
                                            <label class="control-label">Body Content:</label>
                                            <div class="controls"><textarea id="title2" name="validate_confirm" class="focustip span12"><?php if (isset($career_message[0]->validate_confirm)) echo $career_message[0]->validate_confirm; ?></textarea></div>
                                        </div>
                                    </div>
                                     <div class="block well">
                                        <div class="navbar"><div class="navbar-inner"><h5>Already Applied popup</h5></div></div>

                                        <div class="control-group">
                                            <label class="control-label">Body Content:</label>
                                            <div class="controls"><textarea id="title2" name="already_applied" class="focustip span12"><?php if (isset($career_message[0]->already_applied)) echo $career_message[0]->already_applied; ?></textarea></div>
                                        </div>
                                    </div>


                                    <div class="block well">
                                        <div class="navbar"><div class="navbar-inner"><h5>Time out popup</h5></div></div>

                                        <div class="control-group">
                                            <label class="control-label">Body Content:</label>
                                            <div class="controls"><textarea id="title2" name="verification_timeout" class="focustip span12"><?php if (isset($career_message[0]->verification_timeout)) echo $career_message[0]->verification_timeout; ?></textarea></div>
                                            <span style="color:#F00;"><?php echo form_error('verification_timeout'); ?></span>
                                            <span style="color:black;">NB : In this message please use PHRASE for 'email' <br>So example is :Unfortunately, you did not take any action on the contact us form during the given lead time. Therefore, you will be welcome to use an alternative email or wait for 120 minutes to use the current email test@mail.com within our website..</span>
                                        </div>
                                    </div>
                                    <div class="block well">
                                        <div class="navbar"><div class="navbar-inner"><h5>Career Section enter 3 time's wrong code popup</h5></div></div>

                                        <div class="control-group">
                                            <label class="control-label">Body Content:</label>
                                            <div class="controls"><textarea id="title2" name="error_code_block_msg" class="focustip span12"><?php if (isset($career_message[0]->error_code_block_msg)) echo $career_message[0]->error_code_block_msg; ?></textarea></div>
                                            <span style="color:#F00;"><?php echo form_error('error_code_block_msg'); ?></span>
                                            <span style="color:black;">NB : In this message please use PHRASE for 'email' <br>So example is : Unfortunately, you entered wrong verification code during the 3 attempts. Therefore, you will be welcome to use an alternative email or wait for 120 minutes to use the current email test@mail.com within our website. </span>
                                        </div>
                                    </div>
                                    <div class="block well">
                                        <div class="navbar"><div class="navbar-inner"><h5>Career Section did not enter code within the lead time</h5></div></div>

                                        <div class="control-group">
                                            <label class="control-label">Body Content:</label>
                                            <div class="controls"><textarea id="title2" name="code_timeout_block_msg" class="focustip span12"><?php if (isset($career_message[0]->code_timeout_block_msg)) echo $career_message[0]->code_timeout_block_msg; ?></textarea></div>
                                            <span style="color:#F00;"><?php echo form_error('code_timeout_block_msg'); ?></span>
                                            <span style="color:black;">NB : In this message please use PHRASE for 'email' <br>So example is : Unfortunately, you did not enter the correct code within the given lead-time. Therefore, you will be welcome to use an alternative email or wait for 120 minutes to use the current email test@mail.com within our website. </span>
                                        </div>
                                    </div>

                                    <div class="block well">
                                        <div class="navbar"><div class="navbar-inner"><h5>Career Section 3 time's resend blocked popup</h5></div></div>

                                        <div class="control-group">
                                            <label class="control-label">Body Content:</label>
                                            <div class="controls"><textarea id="title2" name="resend_block_msg" class="focustip span12"><?php if (isset($career_message[0]->resend_block_msg)) echo $career_message[0]->resend_block_msg; ?></textarea></div>
                                            <span style="color:#F00;"><?php echo form_error('resend_block_msg'); ?></span>
                                            <span style="color:black;">NB : In this message please use PHRASE for 'email' <br>So example is :Unfortunately, after we resent you 3 verification code you did not enter the right code yet. Therefore, you will be welcome to use an alternative email or wait for 120 minutes to use the current email test@mail.com within our website.</span>
                                        </div>
                                    </div>
                                    
                                    <div class="block well">
                                        <div class="navbar"><div class="navbar-inner"><h5>Career Section already blocked popup</h5></div></div>

                                        <div class="control-group">
                                            <label class="control-label">Body Content:</label>
                                            <div class="controls"><textarea id="title2" name="blocked_email_msg" class="focustip span12"><?php if (isset($career_message[0]->blocked_email_msg)) echo $career_message[0]->blocked_email_msg; ?></textarea></div>
                                            <span style="color:#F00;"><?php echo form_error('blocked_email_msg'); ?></span>
                                            <span style="color:black;">NB : In this message please use PHRASE for 'email',SECTION for 'Section' <br>So example is :The email test@mail.com  is blocked in the section Career. Therefore, please use an alternative email or wait 120 minutes to use this email again within our website. Thank you.</span>
                                        </div>
                                    </div>
                                    
                                    <div class="block well">
                                        <div class="navbar"><div class="navbar-inner"><h5>Thank you for answering Message</h5></div></div>

                                        <div class="control-group">
                                            <label class="control-label">Body Content:</label>
                                            <div class="controls"><textarea id="title2" name="thank_you_for_answering" class="focustip span12"><?php if (isset($career_message[0]->thank_you_for_answering)) echo $career_message[0]->thank_you_for_answering; ?></textarea></div>
                                            <span style="color:#F00;"><?php echo form_error('thank_you_for_answering'); ?></span>
                                            
                                        </div>
                                    </div>
                                    
                                    
                                     <div class="block well">
                                        <div class="navbar"><div class="navbar-inner"><h5>Resume upload warning</h5></div></div>

                                        <div class="control-group">
                                            <label class="control-label">Body Content:</label>
                                            <div class="controls"><textarea id="title2" name="resume_upload_warning" class="focustip span12"><?php if (isset($career_message[0]->resume_upload_warning)) echo $career_message[0]->resume_upload_warning; ?></textarea></div>
                                            <span style="color:#F00;"><?php echo form_error('resume_upload_warning'); ?></span>
                                            
                                        </div>
                                    </div>
                                    
                                    <div class="block well">
                                        <div class="navbar"><div class="navbar-inner"><h5>Career Section didn't upload resume</h5></div></div>

                                        <div class="control-group">
                                            <label class="control-label">Body Content:</label>
                                            <div class="controls"><textarea id="title2" name="upload_resume" class="focustip span12"><?php if (isset($career_message[0]->upload_resume)) echo $career_message[0]->upload_resume; ?></textarea></div>
                                            <span style="color:#F00;"><?php echo form_error('upload_resume'); ?></span>
                                            <span style="color:black;">NB : In this message please use PHRASE for 'email' <br>So example is :Unfortunately, you did not upload your resume within the given lead-time. Therefore, you will be welcome to use an alternative email or wait for 120 minutes to use the current email test@mail.com within our website.</span>
                                        </div>
                                    </div>
                                    
                                    <div class="block well">
                                        <div class="navbar"><div class="navbar-inner"><h5>Warning Min Character For Question 1</h5></div></div>

                                        <div class="control-group">
                                            <label class="control-label">Body Content:</label>
                                            <div class="controls"><textarea id="title2" name="warning_qus1_min_chr" class="focustip span12"><?php if (isset($career_message[0]->warning_qus1_min_chr)) echo $career_message[0]->warning_qus1_min_chr; ?></textarea></div>
                                            <span style="color:#F00;"><?php echo form_error('warning_qus1_min_chr'); ?></span>
                                            
                                        </div>
                                    </div>
                                    
                                        <div class="block well">
                                        <div class="navbar"><div class="navbar-inner"><h5>Career Section success popup</h5></div></div>


                                        <div class="control-group">
                                            <label class="control-label">Header Content:</label>
                                            <div class="controls"><input id="title2" name="modal_success_header" class="focustip span12" type="text" value="<?php if (isset($career_message[0]->modal_success_header)) echo $career_message[0]->modal_success_header; ?>" /></div>
                                            <span style="color:#F00;"><?php echo form_error('modal_success_header'); ?></span>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Body Content:</label>
                                            <div class="controls"><textarea id="title2" name="modal_success_body" class="focustip span12"><?php if (isset($career_message[0]->modal_success_body)) echo $career_message[0]->modal_success_body; ?></textarea></div>
                                            <span style="color:#F00;"><?php echo form_error('modal_success_body'); ?></span>
                                            <span style="color:black;">NB : In this message please use PHRASE for 'email' <br>So example is :<span style="color:black;">NB : In this message please use PHRASE for 'email' <br>So example is :Thank you for your interest to work with KGT. Your job application is well received and a copy is already sent to your email : test@mail.com. We should contact you in case your job application is shortlisted. </span>.</span>
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