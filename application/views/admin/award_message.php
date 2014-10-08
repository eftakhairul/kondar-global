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
                <h5><i class="font-user"></i>Award message section</h5>
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
                                        <div class="navbar"><div class="navbar-inner"><h5>Award Section thank you popup</h5></div></div>


                                        <div class="control-group">
                                            <label class="control-label">Header Content:</label>
                                            <div class="controls"><input id="title2" name="Thank_you_header" class="focustip span12" type="text" value="<?php if (isset($award_message[0]->Thank_you_header)) echo $award_message[0]->Thank_you_header; ?>" /></div>
                                            <span style="color:#F00;"><?php echo form_error('Thank_you_header'); ?></span>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Body Content:</label>
                                            <div class="controls"><textarea id="title2" name="Thank_you_msg" class="focustip span12"><?php if (isset($award_message[0]->Thank_you_msg)) echo $award_message[0]->Thank_you_msg; ?></textarea></div>
                                            <span style="color:#F00;"><?php echo form_error('Thank_you_msg'); ?></span>
                                        </div>
                                    </div>
                                    
                                    <div class="block well">
                                        <div class="navbar"><div class="navbar-inner"><h5>Dealing with KGT Popup</h5></div></div>

                                        <div class="control-group">
                                            <label class="control-label">Body Content:</label>
                                            <div class="controls"><textarea id="title2" name="dealing_msg" class="focustip span12"><?php if (isset($award_message[0]->dealing_msg)) echo $award_message[0]->dealing_msg; ?></textarea></div>
                                            <span style="color:#F00;"><?php echo form_error('dealing_msg'); ?></span>
                                            
                                        </div>
                                    </div>
                                    
                                    <div class="block well">
                                        <div class="navbar"><div class="navbar-inner"><h5>NOT A WINNING NUMBER </h5></div></div>

                                        <div class="control-group">
                                            <label class="control-label">Body Content:</label>
                                            <div class="controls"><textarea id="title2" name="not_winning_no" class="focustip span12"><?php if (isset($award_message[0]->not_winning_no)) echo $award_message[0]->not_winning_no; ?></textarea></div>
                                            <span style="color:#F00;"><?php echo form_error('not_winning_no'); ?></span>
                                            
                                        </div>
                                    </div>
                                    
                                    <div class="block well">
                                        <div class="navbar"><div class="navbar-inner"><h5>Won message in popup</h5></div></div>

                                        <div class="control-group">
                                            <label class="control-label">Body Content:</label>
                                            <div class="controls"><textarea id="title2" name="congratulation" class="focustip span12"><?php if (isset($award_message[0]->congratulation)) echo $award_message[0]->congratulation; ?></textarea></div>
                                            <span style="color:#F00;"><?php echo form_error('congratulation'); ?></span>
                                            <span style="color:black;">NB : In this message please use PRIZE_TITLE for replacing prize title. Example: Congratulation! You just won laptop</span>
                                        </div>
                                    </div>
                                    
                                    <div class="block well">
                                        <div class="navbar"><div class="navbar-inner"><h5>Email verification process</h5></div></div>

                                        <div class="control-group">
                                            <label class="control-label">Body Content:</label>
                                            <div class="controls"><textarea id="title2" name="email_verification_message" class="focustip span12"><?php if (isset($award_message[0]->email_verification_message)) echo $award_message[0]->email_verification_message; ?></textarea></div>
                                            <span style="color:#F00;"><?php echo form_error('email_verification_message'); ?></span>
                                            <span style="color:black;">NB : In this message please use REPLACE_EMAIL for 'email address'. So Example is: Email verification process Thank you for assisting us validate your email: address. We just sent a verification code to your email: test@mail.com. Please enter the correct verification code in three attempts and within 20 minutes. In addition, we request you to avoid refresh the page, as it will block your email for 120 minutes.</span>
                                        </div>
                                    </div>
                                    
                                    <div class="block well">
                                        <div class="navbar"><div class="navbar-inner"><h5>Award Section already submitted popup</h5></div></div>

                                        <div class="control-group">
                                            <label class="control-label">Body Content:</label>
                                            <div class="controls"><textarea id="title2" name="already_submitted" class="focustip span12"><?php if (isset($award_message[0]->already_submitted)) echo $award_message[0]->already_submitted; ?></textarea></div>
                                            <span style="color:#F00;"><?php echo form_error('already_submitted'); ?></span>
                                        </div>
                                    </div>

                                    <div class="block well">
                                        <div class="navbar"><div class="navbar-inner"><h5>Time out popup</h5></div></div>

                                        <div class="control-group">
                                            <label class="control-label">Body Content:</label>
                                            <div class="controls"><textarea id="title2" name="verification_timeout" class="focustip span12"><?php if (isset($award_message[0]->verification_timeout)) echo $award_message[0]->verification_timeout; ?></textarea></div>
                                            <span style="color:#F00;"><?php echo form_error('verification_timeout'); ?></span>
                                            <span style="color:black;">NB : In this message please use PHRASE for 'email' <br>So example is :Unfortunately, you did not take any action within the given lead time. Therefore, you will be welcome to use an alternative email or wait for 120 minutes to use the current email test@mail.com within our website.</span>
                                        </div>
                                    </div>
                                    <div class="block well">
                                        <div class="navbar"><div class="navbar-inner"><h5>Award Section enter 3 time's wrong code popup</h5></div></div>

                                        <div class="control-group">
                                            <label class="control-label">Body Content:</label>
                                            <div class="controls"><textarea id="title2" name="error_code_block_msg" class="focustip span12"><?php if (isset($award_message[0]->error_code_block_msg)) echo $award_message[0]->error_code_block_msg; ?></textarea></div>
                                            <span style="color:#F00;"><?php echo form_error('error_code_block_msg'); ?></span>
                                            <span style="color:black;">NB : In this message please use PHRASE for 'email' <br>So example is : Unfortunately, you entered wrong verification code during the 3 attempts. Therefore, you will be welcome to use an alternative email or wait for 120 minutes to use the current email test@mail.com within our website. </span>
                                        </div>
                                    </div>


                                    <div class="block well">
                                        <div class="navbar"><div class="navbar-inner"><h5>Award Section already blocked popup</h5></div></div>

                                        <div class="control-group">
                                            <label class="control-label">Body Content:</label>
                                            <div class="controls"><textarea id="title2" name="blocked_email_msg" class="focustip span12"><?php if (isset($award_message[0]->blocked_email_msg)) echo $award_message[0]->blocked_email_msg; ?></textarea></div>
                                            <span style="color:#F00;"><?php echo form_error('blocked_email_msg'); ?></span>
                                            <span style="color:black;">NB : In this message please use PHRASE for 'email',SECTION for 'Section' <br>So example is :The email test@mail.com  is blocked in the section award. Therefore, please use an alternative email or wait 120 minutes to use this email again within our website. Thank you.</span>
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