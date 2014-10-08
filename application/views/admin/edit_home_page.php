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
                    <h5><i class="font-user"></i><?php echo $this->lang->line('').'Edit Page';?></h5>
            <!-- End page title -->
                <div class="body">


                    <!-- Content container -->
                    <div class="container">

                       <!-- Pickers -->
<?php
if($edit_page=='time'){
?>
                        <form class="form-horizontal" method="post" enctype="multipart/form-data">
                        	<input type="hidden" name="time" value="set" />
                            <div class="row-fluid">
                                
                                <!-- Column -->
                                <div class="span12">
                                    <!-- Time pickers -->
                                    <div class="block well">
                                        <div class="navbar"><div class="navbar-inner"><h5> <?php echo $this->lang->line('').'Time Position';?></h5></div></div>
                                    <div class="control-group">
                                        <label class="control-label">Position:</label>
                                        <div class="controls">
                                        	<select name="time_position" id="rom_pay" required>
                                        	    <option value="">Select</option>
	                                            <option value="top_left">Top Left</option>
                                                <option value="top_right">Top Right</option>
                                                <option value="bottom_left">Bottom Left</option>
                                                <option value="bottom_right">Bottom Right</option>
                                            </select>
                                            </div>
                                    </div>
                                    
                                    <div class="form-actions align-right">
                                        <input class="btn btn-primary" value="Upload" id="send" type="submit">
									</div>
                                            </div>
                                    </div>
                                    <!-- /time pickers -->


                                    
                                </div>
                                <!-- /column -->
                                
                            </form>
<?php	
}
else if($edit_page=='globe_position'){
?>
                        <form class="form-horizontal" method="post" enctype="multipart/form-data">
                        	<input type="hidden" name="globe_position" value="set" />
                            <div class="row-fluid">                                
                                <!-- Column -->
                                <div class="span12">
                                    <!-- Time pickers -->
                                    <div class="block well">
                                        <div class="navbar"><div class="navbar-inner"><h5> <?php echo $this->lang->line('').'Globe Position';?></h5></div></div>
                                    <div class="control-group">
                                        <label class="control-label">Position:</label>
                                        <div class="controls">
                                        	<select name="globe_position" id="rom_pay" required>
                                        	    <option value="">Select</option>
	                                            <option value="left">Left</option>
                                                <option value="right">Right</option>
                                                <option value="center">Center</option>
                                            </select>
                                            </div>
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
<?php	
}
else if($edit_page=='product_position'){
?>
                        <form class="form-horizontal" method="post" enctype="multipart/form-data">
                        	<input type="hidden" name="product_position" value="set" />
                            <div class="row-fluid">
                                
                                <!-- Column -->
                                <div class="span12">
                                    <!-- Time pickers -->
                                    <div class="block well">
                                        <div class="navbar"><div class="navbar-inner"><h5> <?php echo $this->lang->line('').'Product Position';?></h5></div></div>
                                    <div class="control-group">
                                        <label class="control-label">Position:</label>
                                        <div class="controls">
                                        	<select name="product_position" id="rom_pay" required>
                                        	    <option value="">Select</option>
	                                            <option value="left">Left</option>
                                                <option value="right">Right</option>
                                                <option value="center">Center</option>
                                            </select>
                                            </div>
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
<?php	
}
else if($edit_page=='globe_size'){
?>
                        <form class="form-horizontal" method="post" enctype="multipart/form-data">
                        	<input type="hidden" name="globe_size" value="set" />
                            <div class="row-fluid">
                                
                                <!-- Column -->
                                <div class="span12">
                                    <!-- Time pickers -->
                                    <div class="block well">
                                        <div class="navbar"><div class="navbar-inner"><h5> <?php echo $this->lang->line('').'Globe Size';?></h5></div></div>
                                    <div class="control-group">
                                        <label class="control-label">Position:</label>
                                        <div class="controls">
                                        	<select name="globe_size_data" id="rom_pay" required>
                                        	    <option value="">Select</option>
	                                            <option value="small">Small</option>
                                                <option value="meduim">Meduim</option>
                                                <option value="large">Large</option>
                                            </select>
                                            </div>
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
<?php	
}
else if($edit_page=='background'){
?>
                        <form class="form-horizontal" method="post" enctype="multipart/form-data">
                        	<input type="hidden" name="background" value="set" />
                            <div class="row-fluid">
                                
                                <!-- Column -->
                                <div class="span12">
                                    <!-- Time pickers -->
                                    <div class="block well">
                                        <div class="navbar"><div class="navbar-inner"><h5> <?php echo $this->lang->line('').'Background';?></h5></div></div>
	                                    <div class="control-group">
                                            <label class="control-label">Photo:</label>
                                            <div class="controls"><input type="file" name="file"  /></div>
                                        </div>
                                        
                                    <div class="form-actions align-right">
                                        <input class="btn btn-primary" value="Upload" id="send" type="submit">
									</div>



                                            </div>
                                        
                                    </div>
                                    <!-- /time pickers -->


                                    
                                </div>
                                <!-- /column -->
                                
                            </form>
<?php	
}
else if($edit_page=='library'){
?>
                        <form class="form-horizontal" method="post" enctype="multipart/form-data">
                        	<input type="hidden" name="library" value="set" />
                            <div class="row-fluid">
                                
                                <!-- Column -->
                                <div class="span12">
                                    <!-- Time pickers -->
                                    <div class="block well">
                                        <div class="navbar"><div class="navbar-inner"><h5> <?php echo $this->lang->line('').'Library Background';?></h5></div></div>
	                                    <div class="control-group">
                                            <label class="control-label">Photo:</label>
                                            <div class="controls"><input type="file" name="file"  /></div>
                                        </div>
                                        
                                    <div class="form-actions align-right">
                                        <input class="btn btn-primary" value="Upload" id="send" type="submit">
									</div>



                                            </div>
                                        
                                    </div>
                                    <!-- /time pickers -->


                                    
                                </div>
                                <!-- /column -->
                                
                            </form>
<?php	
}
else if($edit_page=='globe'){
?>
                        <form class="form-horizontal" method="post" enctype="multipart/form-data">
                        	<input type="hidden" name="globe" value="set" />
                            <div class="row-fluid">
                                
                                <!-- Column -->
                                <div class="span12">
                                    <!-- Time pickers -->
                                    <div class="block well">
                                        <div class="navbar"><div class="navbar-inner"><h5> <?php echo $this->lang->line('').'Globe';?></h5></div></div>
	                                    <div class="control-group">
                                            <label class="control-label">Photo:</label>
                                            <div class="controls"><input type="file" name="file"  /></div>
                                        </div>
                                        
                                    <div class="form-actions align-right">
                                        <input class="btn btn-primary" value="Upload" id="send" type="submit">
									</div>



                                            </div>
                                        
                                    </div>
                                    <!-- /time pickers -->


                                    
                                </div>
                                <!-- /column -->
                                
                            </form>

<?php	
}
else if($edit_page=='logo'){
?>
                        <form class="form-horizontal" method="post" enctype="multipart/form-data">
                        	<input type="hidden" name="logo" value="set" />
                            <div class="row-fluid">
                                
                                <!-- Column -->
                                <div class="span12">
                                    <!-- Time pickers -->
                                    <div class="block well">
                                        <div class="navbar"><div class="navbar-inner"><h5> <?php echo $this->lang->line('').'Logo';?></h5></div></div>
                                    <div class="control-group">
                                        <label class="control-label">Name:</label>
                                        <div class="controls"><input id="title2" name="title" class="focustip span12" type="text" value="<?php echo $edit_data['name']; ?>" ></div>
						                <span style="color:#F00;"><?php echo form_error('title'); ?></span>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">Photo:</label>
                                        <div class="controls"><input type="file" name="file"  /></div>
						                <span style="color:#F00;"><?php echo 'Attech image with 450X133 resolution' ?></span>
                                    </div>
                                    
                                    <div class="form-actions align-right">
                                            <input class="btn btn-primary" value="Upload" id="send" type="submit">
                                    </div>



                                            </div>
                                        
                                    </div>
                                    <!-- /time pickers -->


                                    
                                </div>
                                <!-- /column -->
                                
                            </form>

<?php	

}
else if($edit_page=='footer_name'){
?>
                        <form class="form-horizontal" method="post" enctype="multipart/form-data">
                        	<input type="hidden" name="footer_name" value="set" />
                            <div class="row-fluid">
                                
                                <!-- Column -->
                                <div class="span12">
                                    <!-- Time pickers -->
                                    <div class="block well">
                                        <div class="navbar"><div class="navbar-inner"><h5> <?php echo $this->lang->line('').'Footer';?></h5></div></div>
                                    <div class="control-group">
                                        <label class="control-label">Name:</label>
                                        <div class="controls"><input id="title2" name="title" class="focustip span12" type="text" value="<?php echo $edit_data['footer_name']; ?>" ></div>
						                <span style="color:#F00;"><?php echo form_error('title'); ?></span>
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

<?php	

}
else if($edit_page=='admin_mail'){
?>
                        <form class="form-horizontal" method="post" enctype="multipart/form-data">
                        	<input type="hidden" name="admin_mail" value="set" />
                            <div class="row-fluid">
                                
                                <!-- Column -->
                                <div class="span12">
                                    <!-- Time pickers -->
                                    <div class="block well">
                                        <div class="navbar"><div class="navbar-inner"><h5> <?php echo $this->lang->line('').'Admin Mail ID';?></h5></div></div>
                                    <div class="control-group">
                                        <label class="control-label">Mail ID:</label>
                                        <div class="controls"><input id="title2" name="title" class="focustip span12" type="text" value="<?php echo $edit_data['admin_mail']; ?>" ></div>
						                <span style="color:#F00;"><?php echo form_error('title'); ?></span>
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

<?php	

}
else if($edit_page=='footer'){
?>
                        <form class="form-horizontal" method="post" enctype="multipart/form-data">
                        	<input type="hidden" name="footer" value="set" />
                            <div class="row-fluid">
                                
                                <!-- Column -->
                                <div class="span12">
                                    <!-- Time pickers -->
                                    <div class="block well">
                                        <div class="navbar"><div class="navbar-inner"><h5> <?php echo $this->lang->line('').'Footer';?></h5></div></div>
                                    <div class="control-group">
                                        <label class="control-label">Photo:</label>
                                        <div class="controls"><input type="file" name="file" required /></div>
						                <span style="color:#F00;"><?php echo 'Attech image with 760X190 resolution' ?></span>
                                    </div>
                                    
                                    <div class="form-actions align-right">
                                            <input class="btn btn-primary" value="Upload" id="send" type="submit">
                                    </div>



                                            </div>
                                        
                                    </div>
                                    <!-- /time pickers -->


                                    
                                </div>
                                <!-- /column -->
                                
                            </form>

<?php	

}
else if($edit_page=='cart_photo'){
?>
            <form class="form-horizontal" method="post" enctype="multipart/form-data">
              <input type="hidden" name="cart_photo" value="set" />
              <div class="row-fluid">
                <!-- Column -->
                <div class="span12">
                  <!-- Time pickers -->
                  <div class="block well">
                    <div class="navbar">
                      <div class="navbar-inner">
                        <h5> <?php echo $this->lang->line('').'Cart Image';?></h5>
                      </div>
                    </div>
                    <div class="control-group">
                      <label class="control-label">Photo:</label>
                      <div class="controls">
                        <input type="file" name="file" required />
                      </div>
                     <?php /*?> <span style="color:#F00;"><?php echo 'Attech image with 760X190 resolution' ?></span><?php */?> </div>
                    <div class="form-actions align-right">
                      <input class="btn btn-primary" value="Upload" id="send" type="submit">
                    </div>
                  </div>
                </div>
                <!-- /time pickers -->
              </div>
              <!-- /column -->
            </form>
            <?php	

}

?>
                    
                            
                            
                            </div>
                        
                        <!-- /pickers -->

                    </div>
                    <!-- /content container -->
                
                </div>
            </div>
        </div>
    </div>