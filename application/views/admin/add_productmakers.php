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
<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
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

 <script>
	 function readURL(input) {
			if (input.files && input.files[0]) {
				var reader = new FileReader();
				
				reader.onload = function (e) {
					$('#makerimg_prvw').attr('src', e.target.result);
				}
				
				reader.readAsDataURL(input.files[0]);
			}
		}
		$(document).ready(function(e) {	
			$("#pro_makerlogo").change(function(){
				readURL(this);
				 showdelbtn();
			});
			});
			function showdelbtn()
			{
			$("#delimagebtn").html("<input type='button' class='focustip' value='Delete Image' style='padding:2px;' onclick='removeimg();'>");
			//	$("#delimagebtn").show();
			}
			function removeimg()
			{
				$("#makerimg_prvw").attr("src", "./assets/admin/previewimage.jpg");
			}
 </script>  
 
   
    
        <div class="outer">
            <div class="inner">
                <div class="page-header">
		<!-- page title -->
                    <h5><i class="font-user"></i><?php echo $this->lang->line('').'Product Makers';?></h5>
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
                                        <div class="navbar"><div class="navbar-inner"><h5> <?php echo $this->lang->line('').'Add Product Makers';?></h5></div></div>
                                  
                                    <div class="control-group">
                                        <label class="control-label">Product Maker Name:</label>
                                        <div class="controls"><input id="pro_makername" name="pro_makername" class="focustip span12" type="text" value="" ></div>
						                <span style="color:#F00;"><?php echo form_error('pro_makername'); ?></span>
                                    </div>
                                    
                                    
                                    <div class="control-group">
                                        <label class="control-label">Logo:</label>
                                        <div class="controls">
                                            <input id="pro_makerlogo" name="pro_makerlogo" class="focustip span12" type="file" value="" >
                                            <img id="makerimg_prvw" src="./assets/admin/previewimage.jpg" alt="" style="width: 115px;height: 90px;margin-top: 12px;"/>
                                            <div id="delimagebtn" style="margin-top: 10px;"></div>
                                        </div>
						                <span style="color:#F00;"><?php echo form_error('pro_makerlogo'); ?></span>
                                    </div>
                                    
                                    <div class="control-group">
                                        <label class="control-label">Status:</label>
                                        <div class="controls">
                                            <input type="checkbox" name="status" value="1" /> 
                                        </div>
						                <span style="color:#F00;"><?php echo form_error('status'); ?></span>
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