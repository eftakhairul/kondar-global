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