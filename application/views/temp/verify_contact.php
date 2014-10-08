<?php
if($this->session->flashdata('error')) {
    $msg = $this->session->flashdata('error');
?>
<script>
$(document).ready(function(){
	//$('#modal_block').modal('show');
});
</script>
<?php
}
?>    

<script src="assets/template/js/countdown.js" type="text/javascript"></script>
<script type="text/javascript">
function doneHandler(result){
	//alert('sdf');
    $.ajax({
       type: "POST",
       url: "contact/set_block_user",  
       data: "form=contact",
       beforeSend: function () {
//	      $(".show_class").html("Loading ...");
        },
       success: function(msg){
//		  alert(msg);
			if(msg=='success'){
				$('#notify_submit').modal('hide');
				$('#modal_block').modal('show');
				//alert('Sorry Time is over.You have been blocked for 120 minutes.');
				//window.location.href = "front/career";
			}
       }
   });	
   return false;
   	//alert('hello');
}

$(document).ready(function(){
	$('#notify_submit').modal('show');	
	$('#ok_bttn').click(function(){
		window.location.href = "contact";
		return false;
	});

	$('#block_bttn').click(function(){
		window.location.href = "contact";
		return false;
	});

	$('#cancel_form').click(function(){
		$.ajax({
		   type: "POST",
		   url: "contact/get_cancel_form1",  
		   data: "form=contact",
		   beforeSend: function () {
			  $(".show_class").html("Loading ...");
			},
		   success: function(msg){
			//  alert(msg);
				$(".show_class").html('');
				if(msg=='success'){
					//alert('We sent a varification code.Please Check Your mail.');
					window.location.href = "front/contact_us";				
				}
				//$(".show_error").html(msg);			
		   }
	   });
		return false;
	});

	$('#resend_mail').click(function(){
		$.ajax({
		   type: "POST",
		   url: "contact/get_send_mail1",  
		   data: "form=contact",
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
       url: "contact/get_verify1",  
       data: "form=contact&code="+view,
       beforeSend: function () {
	      $(".show_class").html("Loading ...");
        },
       success: function(msg){
		//  alert(msg);
			//$(".show_class").html('');
			if(msg=='success'){
				$('#notify_submit').modal('hide');	
				$('#modal_success').modal('show');	
				//alert('Thank you for proving that you are human. Now you can proceed to the screening interview. Good luck!');				
			}
			else if(msg=='redirect'){
				alert('test');
				$('#notify_submit').modal('hide');	
				$('#modal_block').modal('show');	
				//alert('Sorry your email ID has been blocked for 120 minutes.');
			}
        	//$(".show_error").html(msg);			
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


	<div class="bodywrapper">
        <?php //include('include/menu1.php');?>
        <?php include('include/address.php');?>


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
                        <div style="float:right;margin-right:25px"> 
                        <script type="application/javascript">
var myCountdown2 = new Countdown({
						time: 600, 
						width:100, 
						height:40, 
						rangeHi:"minute",	// <- no comma on last item!
						style:"flip",
						onComplete : doneHandler// <- no comma on last item!
						});
</script>
						</div>
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
				      			<p>Your Email ID is verified successfully. We got your mail. We will get back to you soon.</p>
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