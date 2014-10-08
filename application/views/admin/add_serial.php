<style>
.error{
  background: url("../images/elements/ui/progress_overlay.png") repeat scroll 0 0%, -moz-linear-gradient(center top , #CD4900 0%, #CD0200 100%) repeat scroll 0 0 rgba(0, 0, 0, 0);
  border-radius: 3px;
  box-shadow: 0 1px 0 rgba(255, 255, 255, 0.3) inset, 0 1px 1px #333333;
  color: #FFFFFF;
  font-size: 12px;
  padding: 9px 35px 8px;
  text-align: center;
}
</style>
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
<?php
if($this->session->flashdata('error')) {
    $msg = $this->session->flashdata('error');
?>
    <div class="notice outer">
      <div class="error"><?php echo $msg;?>
      </div>
    </div>
<?php
}
?>    

    
    
        <div class="outer">
            <div class="inner">
                <div class="page-header">
		<!-- page title -->
                    <h5><i class="font-user"></i><?php echo $this->lang->line('').'Serial';?></h5>
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
                                        <div class="navbar"><div class="navbar-inner"><h5> <?php echo $this->lang->line('').'Add Serial';?></h5></div></div>
                                  
                                    <div class="control-group">
                                        <label class="control-label">Serial Number:</label>
                                        <div class="controls"><input id="code" name="code" class="focustip span12" type="text" value="<?php echo set_value('code'); ?>" ></div>
						                <span style="color:#F00;"><?php echo form_error('code'); ?></span>
                                    </div>
                                    
                                    <div class="control-group">
                                        <label class="control-label">Part Number:</label>
                                        <div class="controls"><input id="part_number" name="part_number" class="focustip span12" type="text" value="<?php echo set_value('part_number'); ?>" ></div>
						                <span style="color:#F00;"><?php echo form_error('part_number'); ?></span>
                                    </div>
                                    
                                    <div class="control-group">
                                        <label class="control-label">Winning Status:</label>
                                        <div class="controls">
                                            <input type="checkbox" name="status" value="1" /> 
                                        </div>
						                <span style="color:#F00;"><?php echo form_error('status'); ?></span>
                                    </div>
                                  
                                  
                                    <div class="control-group">
                                        <label class="control-label">Remark:</label>
                                        <div class="controls"><input id="title2" name="title" class="focustip span12" type="text" value="<?php echo set_value('title'); ?>" ></div>
						                <span style="color:#F00;"><?php echo form_error('title'); ?></span>
                                    </div>
                                    
                                    
                            		<div class="form-actions align-right">
                                        <input class="btn btn-primary" value="Add" id="send" type="submit">
                                        <input class="btn btn-danger" type="reset">
									</div>
		


                                            </div>
                                        
                                    </div>
                                    <!-- /time pickers -->


                                    
                                </div>
                                <!-- /column -->
                                
                            </form></div>
                        
                        <!-- /pickers -->

                    </div>
                    <!-- /content container -->
                
                </div>
            </div>
        </div>
    </div>