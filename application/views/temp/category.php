<script>
$(document).ready(function(){
	$('.openPop').click(function(){
		var id = $(this).attr('id');
		var name = $(this).attr('value');
		$('#promotion_id').attr('value',id);
		$('#show_msge').html('Thank you for your interest to deal with KGT, please fill in the contact form and ask for a download code for the "'+name+'".');
		$('#modal_success').modal('show');
		return false;
	});
	$('#ok_bttn').click(function(){
		var pro_id = $('#promotion_id').attr('value');
		window.location.href = "front/promotion_form/"+pro_id;
		return false;
	});
	
});
</script>
	<div class="bodywrapper">
        <?php //include('include/menu1.php');?>
        <?php include('/../temp/include/header_child.php');?>
        <?php include('include/address.php');?>

        <div class="container">
	        <div class="main-page">
	        	
	        	<div class="car-lists">
	        		<div class="row">
<?php
if(isset($all_data)&&!empty($all_data)){
	foreach($all_data as $set_data1){
		if(isset($set_data1['image'])&&$set_data1['image']!=''){
			$image1 = 'assets/uploads/promotion_section/thumbnails/'.$set_data1['image'];
		}
		else{
			$image1 = 'assets/uploads/profile.jpg';
		}
?>
										<div class="col-md-6">
                                            <div class="media">
                                            	<div style="float:left" >
                                                    <img class="media-object" src="<?php echo $image1;?>" alt="..." width="169" height="180">
                                                    <p style="color:#000" class="visible-xs media-heading"><?php echo $set_data1['name'];?></p>
                                                <a class="btn btn-primary" href="front/view_promotion/<?php echo $set_data1['id'];?>" ><?php echo lang('Read More') ?></a>  

<?php
if(!empty($set_data1['file'])){
?>
<br />

                                                <a class="openPop btn btn-primary" href="#" id="<?php echo $set_data1['id'];?>" value="<?php echo $set_data1['name'];?>" ><?php echo lang('Download') ?></a>  
<?php
}
?>
                                                </div>                                              
                                                <div class="media-body hidden-xs">
                                                    <h4 class="media-heading"><?php echo $set_data1['name'];?></h4>
                                                    <p><?php echo $set_data1['sort'];?></p>
                                                </div>
                                            </div>
                                        </div>
                                        
                                
<?php	
	}
}
else{
	echo '<h3 style="margin-left:10px">'.lang('There is no data.').'</h3>';		
}

?>
									  			</div>
	        	</div>

	        	<div class="clearfix"></div>
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
                                	<input type="hidden" name="id" id="promotion_id" value="" />
				      			<p id="show_msge"></p>
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