<script src="assets/user/js/ckeditor.js"></script>
<script type="text/javascript" src="assets/user/js/jquery-1.10.1.min.js"></script>
<script type="text/javascript"> 
$(function(){
    var counter = 1;
 	$("#addButton").click(function () {
	for(i=0;i<1;i++){
		var newTextBoxDiv = $(document.createElement('div'))
	    	 .attr("id", 'TextBoxDiv' + counter)
			 .attr("class" ,'control-group');
           newTextBoxDiv.html('<label class="control-label">Question '+ counter + ' :</label><div class="controls"><input id="title2" name="question[]" class="focustip span10" type="text" value="" required ></div><br /><label class="control-label">Duration :</label><div class="controls"><select name="duration[]" required><option  value="">Select</option><option value="1">1</option><option value="5">5</option><option value="10">10</option><option value="20">20</option><option value="30">30</option><option value="40">40</option><option value="50">50</option><option value="60">60</option></select></div><br /><label class="control-label">Minimum Word:</label><div class="controls"><input type="text" name="minword[]" value=""></div>');

 var removeLink = $('<span style="float:right;margin:-70px 56px;cursor:pointer"/>').html("Remove").click(function(){
	 	$(newTextBoxDiv).remove();
        $(this).remove();
    });
         
 
 	$("#TextBoxesGroup").append(newTextBoxDiv).append(removeLink);
//	newTextBoxDiv.appendTo("#TextBoxesGroup");
       counter++; 
 }
 $('#cont').val(counter);
//alert(counter);	
     });
});
</script>

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
                    <h5><i class="font-user"></i><?php echo $this->lang->line('').$product_name;?></h5>
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
                                        <div class="navbar">
                                        	<div class="navbar-inner"><h5> <?php echo $this->lang->line('').'Add '.$product_name;?></h5></div>
                                        </div>
                                    <div class="control-group">
                                        <label class="control-label">Category:</label>
                                        <div class="controls">
                                        	<select name="category" required>
                                            	<option value="">Select</option>
                                            	<option value="Permanent Job">Permanent Job</option>
                                            	<option value="Internship Program">Internship Program</option>
                                            	<option value="Part Time Job">Part Time Job</option>
                                            	<option value="Projects Contractors">Projects Contractors</option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="control-group">
                                        <label class="control-label">Job Title:</label>
                                        <div class="controls"><input id="title2" name="title" class="focustip span12" type="text" value="<?php echo set_value('title'); ?>" ></div>
						                <span style="color:#F00;"><?php echo form_error('title'); ?></span>
                                    </div>
                                    
                                    <div class="control-group">
                                        <label class="control-label">Scope:</label>
                                        <div class="controls"><textarea id="content" name="scope" class="focustip span12" rows="10"></textarea>
											<script>
												CKEDITOR.replace( 'scope', {
													uiColor: '#F5F5F5',
													toolbar: [
														[ 'Bold', 'Italic','Underline', '-', 'NumberedList', 'BulletedList', '-'],
														['Strike','Subscript','Superscript'],
														[ 'TextColor', 'BGColor', 'FontFamily' ],
														['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
														['Styles','Format','FontSize'],
													]
												});								
											</script>
                                        </div>
                                    </div>
                                    
                                    <div class="control-group">
                                        <label class="control-label">Qualification:</label>
                                        <div class="controls"><textarea id="content" name="qualification" class="focustip span12" rows="10"></textarea>
                                        <script>
												CKEDITOR.replace( 'qualification', {
													uiColor: '#F5F5F5',
													toolbar: [
														[ 'Bold', 'Italic','Underline', '-', 'NumberedList', 'BulletedList', '-'],
														['Strike','Subscript','Superscript'],
														[ 'TextColor', 'BGColor', 'FontFamily' ],
														['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
														['Styles','Format','FontSize'],
													]
												});								
											</script>
                                        </div>
                                    </div>                                                                
                                                                                                           
                                    <div class="control-group">
                                        <label class="control-label">Photo:</label>
                                        <div class="controls"><input type="file" name="file"  />
                                        <p style="color:#F00">Please file must be : jpg, png, gif. maximum 800KB and maximum 1024X768</p>
                                        
                                        </div>
                                    </div>
                                    <div id='TextBoxesGroup'></div>
                                            <input type='button'  value='Add Question' id="addButton" class="btn" >
                                    
                                    
                            		<div class="form-actions align-right">
                                        <input class="btn btn-primary" value="Add" id="send" type="submit">
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