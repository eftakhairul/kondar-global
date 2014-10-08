<script src="assets/user/js/ckeditor.js"></script>

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
                    <h5><i class="font-user"></i><?php echo $this->lang->line('').'Promotion Section';?></h5>
            <!-- End page title -->
                <div class="body">
                    <!-- Content container -->
                    <div class="container">
				<form class="form-horizontal" method="post" enctype="multipart/form-data">
                        	<input type="hidden" name="operation" value="set" />
                            <div class="row-fluid">                                
                                <!-- Column -->
                                <div class="span12">
                                    <!-- Time pickers -->
                                    <div class="block well">
                                        <div class="navbar"><div class="navbar-inner"><h5> <?php echo $this->lang->line('').'add Promotion Section';?></h5></div></div>
                                    <div class="control-group">
                                    <label class="control-label">Promotion Tab Name:</label>
                                    <div class="controls">
                                        <select name="type" required>
                                            <option value="">Select</option>
                                            <option value="download_materials">Download Materials</option>
                                            <option value="knowledge_center">Knowledge Center</option>
                                            <option value="press_release">Press Release</option>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="control-group">
<?php
$category = $this->comman_model->all_data('promotion_category');
?>                                    
                                        <label class="control-label">Category:</label>
                                        <div class="controls">
	                                        <select name="category" required>
                                            <option value="">Select</option>
<?php
if(isset($category)){
	foreach($category as $set_data){
	echo '<option value="'.$set_data['id'].'">'.$set_data['name'].'</option>';
	}
}
?>                                            	
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="control-group">
                                        <label class="control-label">Title:</label>
                                        <div class="controls"><input id="title2" name="title" class="focustip span12" type="text" requiredd></div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label">Code:</label>
                                        <div class="controls"><input id="title2" name="code" class="focustip span12" type="text" value="<?php echo $dynamic_code; ?>" readonly="readonly" ></div>
                                    </div>
                                    
                                    
                                    <div class="control-group">
                                        <label class="control-label">Download File:</label>
                                        <div class="controls"><input type="file" name="file" /></div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label">Photo:</label>
                                        <div class="controls"><input type="file" name="photo" /></div>
                                    </div>
                                    
                                    <div class="control-group">
                                        <label class="control-label">video:</label>
                                        <div class="controls"><input type="file" id="video" name="video" ></div>
                                    </div>
                                    
									<div class="control-group">
                                        <label class="control-label">Sort Description:</label>
                                        <div class="controls"><textarea id="content" name="sort" class="focustip span12" rows="10"></textarea>
                                        </div>
                                    </div>                                    
                                    
                                    <div class="control-group">
                                        <label class="control-label">Description:</label>
                                        <div class="controls"><textarea id="content" name="description" class="focustip span12" rows="10"></textarea>                                        <script>
											CKEDITOR.replace( 'description', {
												uiColor: '#F5F5F5',
												toolbar: [
													[ 'Bold', 'Italic','Underline', '-', 'NumberedList', 'BulletedList', '-'],
													['Strike','Subscript','Superscript'],
													[ 'TextColor', 'BGColor', 'FontFamily' ],
													['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
													['Styles','Format','FontSize'],
													['Table','Maximize','Image']
												]
											});								
										</script>

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
                       <!-- Pickers -->
    				</div>
                        
                        <!-- /pickers -->

                    </div>
                    <!-- /content container -->
                
                </div>
            </div>
        </div>
    </div>