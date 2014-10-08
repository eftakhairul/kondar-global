


        <div class="container">
	        <div class="main-page">
	        	
        		<div class="car-lists">
        			<div class="form-fill-cart">
	        			<div class="row">
	        				<div class="col-md-6">
<?php /*?>	        					<h3>Verify Form</h3>
							We have just sent a verification code to <?php echo $user_email;?><br />
							Please validate it now<br>
<br>
<br>

                            <a data-toggle="modal" data-target="#notify_submit" href="" class="btn btn-primary btn-sm">Verify</a><?php */?>
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
		      			<h2 class="title-modal">WE SENT A VERIFICATION CODE TO : <?php echo $user_email;?></h2>
		      			<p style="float:left"><label>Please enter the code: <input type="text" name="code" required autofacus></label></p>
                        <div id="countdownplace" style="float: right;margin-right: 20px;"></div>
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
				      			<p>Your Email ID is verified successfully. We will send you links for download as soon as possible.</p>
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
			