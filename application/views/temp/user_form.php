<script type="text/javascript">
$(document).ready(function(){
	$('#ok_bttn').click(function(){
		window.location.href = "career/interview";
		return false;
	});

	$('#block_bttn').click(function(){
		window.location.href = "career/index";
		return false;
	});

	$('#cancel_form').click(function(){
		$('#notify_submit').modal('hide');	
		return false;
	});

	$('#resend_mail').click(function(){
		$.ajax({
		   type: "POST",
		   url: "front/get_send_mail",  
		   data: "code=1",
		   beforeSend: function () {
			  $(".show_class").html("Loading ...");
			},
		   success: function(msg){
			//  alert(msg);
				$(".show_class").html('');
				if(msg=='success'){
					//alert('We sent a varification code.Please Check Your mail.');
				$(".show_class").html('We sent a verification code. Please Check Your mail.');			
				}
		   }
	   });
		return false;
	});
});
function show(form){
	var view = form.code.value;
    $.ajax({
       type: "POST",
       url: "front/get_verify",  
       data: "code="+view,
       beforeSend: function () {
	      $(".show_class").html("Loading ...");
        },
       success: function(msg){
		//  alert(msg);
			$(".show_class").html('');
			if(msg=='success'){
				$('#notify_submit').modal('hide');	
				$('#modal_success').modal('show');	
				//alert('Thank you for proving that you are human. Now you can proceed to the screening interview. Good luck!');				
			}
			else if(msg=='redirect'){
				$('#notify_submit').modal('hide');	
				$('#modal_block').modal('show');	
				//alert('Sorry your email ID has been blocked for 120 minutes.');
			}
        	$(".show_error").html(msg);			
       }
   });
   return false;
}
</script>
<style type="text/css">
	@media screen and (max-width: 320px) {
		.toyota-page .col-xs-4{margin-bottom: 10px; text-align: center; width: 100%}
		.toyota-page .col-xs-4 a{width: 100%}
	}
</style>


        <?php //include('include/menu1.php');?>
        <?php include('include/address.php');?>


        <div class="container">
	        <div class="main-page">
	        	
        		<div class="car-lists">
        			<div class="form-fill-cart">
	        			<div class="row">
	        				<div class="col-md-6">
	        					<h3>Download Form</h3>
                            Thank you for your interest to deal with KGT,<br />
                            please enter a code to download this file
	        					<form class="form-horizontal" role="form" method="post">
                                	<input type="hidden" name="operation" value="set">
                                          <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-5 control-label">Your Product Download Code</label>
                                            <div class="col-sm-6">
                                              <input type="text" class="form-control" name="code" id="inputEmail3" placeholder="Code" value="<?php echo set_value('code'); ?>" autofocus>
                                            <span style="color:#F00;"><?php echo form_error('code'); ?></span>

                                            </div>
                                          </div>
                                          
                                          
                                          <div class="form-group">&nbsp;
                                            <div class="col-sm-6">
                                          <input type="submit" value="Apply" class="btn btn-primary btn-sm"/>
                                            </div>
                                        </div>
                                </form>
								<?php
                                if($this->session->flashdata('success')) {
                                    $msg = $this->session->flashdata('success');
                                ?>
                                      <div style="color:#0F0"><?php echo $msg;?>
                                    </div>
                                <?php
                                }
                                ?>    
                                <?php
                                if($this->session->flashdata('error')) {
                                    $msg = $this->session->flashdata('error');
                                ?>
                                      <div style="color:#F00"><?php echo $msg;?>
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

    	<div class="modal fade" id="notify_submit">
		  <div class="modal-dialog">
		    <div class="modal-content">
		      <!-- <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		        <h4 class="modal-title">Modal title</h4>
		      </div> -->
		      <div class="modal-body">
		      		<div class="box-content-modal">
                    	<form action="" method="post" id="target" onsubmit="return show(this)">
		      			<h2 class="title-modal">WE SENT A VERIFICATION CODE TO : <?php echo $user_data['email'];?></h2>
		      			<p><label>Please enter the code: </label></p>
		      			<div class="clearfix"></div>
                        <div class="show_class" style="margin-left:160px"></div>
                        <div class="show_error" style="color:#F00;margin-left:160px"></div>
		      			<div class="btn-modal toyota-page">
		      				<div class="row">
		      					<div class="col-xs-4 col-md-4 text-center">
		      						<input type="submit" class="btn btn-primary btn-sm" value="Confirm"> 
		      					</div>
		      					<div class="col-xs-4 col-md-4 text-center">
		      						<a href="#" id="resend_mail" class="btn btn-primary btn-sm">resend <i class="glyphicon glyphicon-chevron-right"></i></a>
		      					</div>
		      					<div class="col-xs-4 col-md-4 text-center">
		      						<a href="#" id="cancel_form" class="btn btn-primary btn-sm">cancel <i class="glyphicon glyphicon-chevron-right"></i></a>	
		      					</div>
		      				</div>	        				
		      			</div>
                        </form>
		      		</div>
		      </div>
		      <!-- <div class="modal-footer">
		        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		        <button type="button" class="btn btn-primary">Save changes</button>
		      </div> -->
		    </div><!-- /.modal-content -->
		  </div><!-- /.modal-dialog -->
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
				      			<h2 class="title-modal">THANK YOU</h2>
				      			<p>Thank you for proving that you are human. Now you can proceed to the screening interview. Good luck!</p>
				      			<div class="clearfix"></div>
				      			<div class="btn-modal">
				      				
			        				<a style="float:right" href="javascript:void(0)" id="ok_bttn" onClick="$('#modal_success').modal('hide')" class="btn btn-primary btn-sm">OK <i class="glyphicon glyphicon-chevron-right"></i></a>	
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
		<div class="modal fade" id="modal_block">
				  <div class="modal-dialog">
				    <div class="modal-content">
				      <!-- <div class="modal-header">
				        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				        <h4 class="modal-title">Modal title</h4>
				      </div> -->
				      <div class="modal-body">
				      		<div class="box-content-modal">
				      			<h2 class="title-modal">Invalid Code</h2>
				      			<p>Sorry your email ID has been blocked for 120 minutes.</p>
				      			<div class="clearfix"></div>
				      			<div class="btn-modal">
				      				
			        				<a style="float:right" href="javascript:void(0)" id="block_bttn" onClick="$('#modal_block').modal('hide')" class="btn btn-primary btn-sm">OK <i class="glyphicon glyphicon-chevron-right"></i></a>	
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