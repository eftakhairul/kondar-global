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
                <h5><i class="font-user"></i>Distribution Timer</h5>
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
                                        <div class="navbar"><div class="navbar-inner"><h5>Main Distribution Timer</h5></div></div>

                                        <div class="control-group">
                                            <label class="control-label">Time:</label>
                                            <div class="controls">
                                                <select name="main_distribution_timer">
                                                    <?php 
                                                        for($i = 1; $i<=1440;$i=$i+20){
                                                            $selected = "";
                                                            if(isset($distribution_timer[0]->main_distribution_timer)){
                                                                if($distribution_timer[0]->main_distribution_timer==$i){
                                                                    $selected = "selected='selected'";
                                                                }
                                                                
                                                            }
                                                                
                                                    ?>
                                                    <option value="<?php echo $i?>" <?php echo $selected?>><?php echo $i?></option>
                                                        <?php }?>
                                                    
                                                </select>
                                            </div>
                                            <span style="color:#F00;"><?php echo form_error('main_distribution_timer'); ?></span>
                                        </div>
                                        <div style="display: none;" class="control-group">
                                            <label class="control-label">Message:</label>
                                            <div class="controls"><input id="title2" name="main_distribution_msg" class="focustip span12" type="text" value="<?php echo $distribution_timer[0]->main_distribution_msg;?>"></div>
                                            <span style="color:#F00;"><?php echo form_error('main_distribution_msg'); ?></span>
                                        </div>
                                    </div>
                                    <div class="block well">
                                        <div class="navbar"><div class="navbar-inner"><h5>Distribution Preview Timer</h5></div></div>

                                        <div class="control-group">
                                            <label class="control-label">Time:</label>
                                            <div class="controls">
                                                
                                                <select name="distribution_preview_timer">
                                                    <?php 
                                                        for($i = 1; $i<=1440;$i=$i+20){
                                                            $selected = "";
                                                            if(isset($distribution_timer[0]->distribution_preview_timer)){
                                                                if($distribution_timer[0]->distribution_preview_timer==$i)
                                                                $selected = "selected='selected'";
                                                            }
                                                                
                                                    ?>
                                                    <option value="<?php echo $i?>" <?php echo $selected?>><?php echo $i?></option>
                                                        <?php }?>
                                                    
                                                </select>
                                            </div>
                                            <span style="color:#F00;"><?php echo form_error('new_password'); ?></span>
                                        </div>
                                        <div style="display: none;" class="control-group">
                                            <label class="control-label">Message:</label>
                                            <div class="controls"><input id="title2" name="distribution_preview_msg" class="focustip span12" type="text" value="<?php if (isset($distribution_timer[0]->distribution_preview_msg)) echo $distribution_timer[0]->distribution_preview_msg;?>" ></div>
                                            <span style="color:#F00;"><?php echo form_error('new_password'); ?></span>
                                        </div>

                                    </div>
                                    <div class="block well">
                                        <div class="navbar"><div class="navbar-inner"><h5>Distribution verification code popup Timer</h5></div></div>

                                        <div class="control-group">
                                            <label class="control-label">Time:</label>
                                            <div class="controls">
                                                
                                                <select name="distribution_popup_timer">
                                                    <?php 
                                                        for($i = 1; $i<=1440;$i=$i+20){
                                                            $selected = "";
                                                            if(isset($distribution_timer[0]->distribution_popup_timer)){
                                                                if($distribution_timer[0]->distribution_popup_timer==$i)
                                                                $selected = "selected='selected'";
                                                            }
                                                                
                                                    ?>
                                                    <option value="<?php echo $i?>" <?php echo $selected?>><?php echo $i?></option>
                                                        <?php }?>
                                                    
                                                </select>
                                            </div>
                                            <span style="color:#F00;"><?php echo form_error('new_password'); ?></span>
                                        </div>
                                        <div style="display: none;" class="control-group">
                                            <label class="control-label">Message:</label>
                                            <div class="controls"><input id="title2" name="distribution_popup_msg" class="focustip span12" type="text" value="<?php if (isset($distribution_timer[0]->distribution_popup_msg)) echo $distribution_timer[0]->distribution_popup_msg;?>" ></div>
                                            <span style="color:#F00;"><?php echo form_error('new_password'); ?></span>
                                        </div>
                                    </div>
                                    <div class="block well">
                                        <div class="navbar"><div class="navbar-inner"><h5>Edit Distribution Timer</h5></div></div>

                                        <div class="control-group">
                                            <label class="control-label">Time:</label>
                                            <div class="controls">
                                                
                                                <select name="distribution_edit_timer">
                                                    <?php 
                                                        for($i = 1; $i<=1440;$i=$i+20){
                                                            $selected = "";
                                                            if(isset($distribution_timer[0]->distribution_edit_timer)){
                                                                if($distribution_timer[0]->distribution_edit_timer==$i)
                                                                $selected = "selected='selected'";
                                                            }
                                                                
                                                    ?>
                                                    <option value="<?php echo $i?>" <?php echo $selected?>><?php echo $i?></option>
                                                        <?php }?>
                                                    
                                                </select>
                                            </div>
                                            <span style="color:#F00;"><?php echo form_error('new_password'); ?></span>
                                        </div>
                                        <div style="display: none;" class="control-group">
                                            <label class="control-label">Message:</label>
                                            <div class="controls"><input id="title2" name="distribution_edit_msg" class="focustip span12" type="text" value="<?php if (isset($distribution_timer[0]->distribution_edit_msg)) echo $distribution_timer[0]->distribution_edit_msg;?>" ></div>
                                            <span style="color:#F00;"><?php echo form_error('new_password'); ?></span>
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