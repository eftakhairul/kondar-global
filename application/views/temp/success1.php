<script type="text/javascript">
$(document).ready(function(){
	$('#modal_success').modal('show');	
	$('#ok_bttn').click(function(){
		window.location.href = "front/promotion";
		return false;
	});
})
</script>
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

    	
<div class="modal fade" id="modal_success">
				  <div class="modal-dialog">
				    <div class="modal-content">
				      <!-- <div class="modal-header">
				        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				        <h4 class="modal-title">Modal title</h4>
				      </div> -->
				      <div class="modal-body">
				      		<div class="box-content-modal">
				      			<h2 class="title-modal"><?php echo lang('THANK YOU') ?></h2>
				      			<p>
<?php
if($this->session->flashdata('success')) {
	$msg = $this->session->flashdata('success');
	echo $msg;
}
else{
	redirect('career/index');
}
?>    
                                
                                </p>
				      			<div class="clearfix"></div>
				      			<div class="btn-modal">
				      				
			        				<a style="float:right" href="javascript:void(0)" id="ok_bttn" onClick="$('#modal_success').modal('hide')" class="btn btn-primary btn-sm"><?php echo lang('OK') ?> <i class="glyphicon glyphicon-chevron-right"></i></a>	
				      			</div>
				      		</div>
				      </div>
				      <!-- <div class="modal-footer">
				        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				        <button type="button" class="btn btn-primary">Save changes</button>
				      </div> -->
				    </div><!-- /.modal-content -->
				  </div><!-- /.modal-dialog -->
				</div>
