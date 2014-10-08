<div style="margin-right: 0px;" class="content">
<?php
if($this->session->flashdata('success')) {
    $msg = $this->session->flashdata('success');
?>
    <div class="notice outer">
      <div class="note"><?php echo $msg;?>
      </div>
    </div>
<?php
}
?>    
    
    
        <div class="outer">
            <div class="inner">
                <div class="page-header">
		<!-- page title -->
                    <h5><i class="font-user"></i>Password</h5>
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
                                        <div class="navbar"><div class="navbar-inner"><h5>Edit Password</h5></div></div>
                                    	<div class="control-group">
                                        <label class="control-label">Old Password:</label>
                                        <div class="controls"><input id="title2" name="old_password" class="focustip span12" type="password"  ></div>
						                <span style="color:#F00;"><?php echo form_error('old_password'); ?></span>
                                    </div>
                                    
                                    	<div class="control-group">
                                            <label class="control-label">New Password:</label>
                                            <div class="controls"><input id="title2" name="new_password" class="focustip span12" type="password"  ></div>
                                            <span style="color:#F00;"><?php echo form_error('new_password'); ?></span>
	                                    </div>
                                        
                                        <div class="control-group">
                                            <label class="control-label">Confirm:</label>
                                            <div class="controls"><input id="title2" name="rpassword" class="focustip span12" type="password"  ></div>
                                            <span style="color:#F00;"><?php echo form_error('rpassword'); ?></span>
                                        </div>
                                    
                                    
                                    
                                      <div class="form-actions align-right">
                                                <input class="btn btn-primary" value="Update" id="send" type="submit">
					</div>



                                            </div>
                                        
                                    </div>
                                    <!-- /time pickers -->


                                    
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