	<div class="bodywrapper">
        <?php //include('include/menu1.php');?>
        <?php include('/../temp/include/header_child.php');?>
        <?php include('include/address.php');?>


        <div class="container">
	        <div class="main-page">
	        	
        		<div class="car-lists">
        			<div class="form-fill-cart">
	        			<div class="row">
	        				<div class="col-md-6">
	        					<h3>Resume Form</h3>
                                	<h4>Please Submit your resume</h4>
	        					
	        					<form class="form-horizontal" role="form" method="post" enctype="multipart/form-data">
                                	<input type="hidden" name="operation" value="set">
                                          <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-6 control-label">Document</label>
                                            <div class="col-sm-6">
                                              <input type="file"  name="file" >
                                            </div>
                                          </div>
                                          
                                          
                                          
                                          <div class="form-group">&nbsp;
                                            <div class="col-sm-6">
                                          <input type="submit" value="Submit" class="btn btn-primary btn-sm"/>
                                            </div>
                                        </div>
                                </form>
            <span style="color:#F00"><b>Note: </b>Maximum 1 MB, document type acceptable is only .pdf, .doc, .jpg.</span> 
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

                                

	        				</div>
	        				
	        			</div>
        			</div>	        		
	        	</div>
	        </div><!--End content-->
    	</div>

    	

