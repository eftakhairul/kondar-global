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
                <h5><i class="font-user"></i>Dynamic messages for distribution section</h5>
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
                                        <div class="navbar"><div class="navbar-inner"><h5>Block related message in Distribution Section </h5></div></div>

                                        <div class="control-group">
                                            <label class="control-label">Time out message:</label>
                                            <div class="controls"><textarea id="title2" name="timeout_msg" class="focustip span12"><?php if (isset($distribution_message[0]->timeout_msg)) echo $distribution_message[0]->timeout_msg;?></textarea></div>
                                            <span style="color:black;">NB : In this message please use EMAILVAR for email address<br>So example is : Unfortunately, you did not take necessary action within the given lead-time.  Therefore, you will be welcome to use an alternative email or wait for 120 minutes to use the current email EMAILVAR within our website.</span>
                                            <span style="color:#F00;"><?php echo form_error('timeout_msg'); ?></span>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Wrong Code message:</label>
                                            <div class="controls"><textarea id="title2" name="wrong_code_msg" class="focustip span12"><?php if (isset($distribution_message[0]->wrong_code_msg)) echo $distribution_message[0]->wrong_code_msg;?></textarea></div>
                                            <span style="color:black;">NB : In this message please use EMAILVAR for email address<br>So example is : Unfortunately, you entered wrong verification code during the 3 attempts. Therefore, you will be welcome to use an alternative email or wait for 120  minutes to use the current email EMAILVAR within our website.</span>
                                            <span style="color:#F00;"><?php echo form_error('wrong_code_msg'); ?></span>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label">3 times resent block message:</label>
                                            <div class="controls"><textarea id="title2" name="resent_msg" class="focustip span12"><?php if (isset($distribution_message[0]->resent_msg)) echo $distribution_message[0]->resent_msg;?></textarea></div>
                                            
                                            <span style="color:black;">NB : In this message please use EMAILVAR for email address<br>So example is : Unfortunately you did not take any action during the given lead-time.  Therefore, you will be welcome to use an alternative email or wait for 120 minutes to use the current email EMAILVAR within our website.</span>
                                            <span style="color:#F00;"><?php echo form_error('resent_msg'); ?></span>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Already blocked message:</label>
                                            <div class="controls"><textarea id="title2" name="blocked_email_msg" class="focustip span12"><?php if (isset($distribution_message[0]->blocked_email_msg)) echo $distribution_message[0]->blocked_email_msg;?></textarea></div>
                                            <span style="color:black;">NB : In this message please use EMAILVAR for email address, SECTIONVAR for section, TIMEVAR for minute<br>So example is : The email EMAILVAR is blocked in the section SECTIONVAR. Therefore, please use an alternative email or wait TIMEVAR minutes to use this email again within our website. Thank you</span>
                                            <span style="color:#F00;"><?php echo form_error('blocked_email_msg'); ?></span>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Application receipt message:</label>
                                            <div class="controls"><textarea id="title2" name="application_receipt_msg" class="focustip span12"><?php if (isset($distribution_message[0]->application_receipt_msg)) echo $distribution_message[0]->application_receipt_msg;?></textarea></div>
                                            
                                            <span style="color:#F00;"><?php echo form_error('application_receipt_msg'); ?></span>
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