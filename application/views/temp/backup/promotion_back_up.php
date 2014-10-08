	<div class="bodywrapper">
        <?php //include('include/menu1.php');?>
        <?php include('/../temp/include/header_child.php');?>
        <?php include('include/address.php');?>

        <div class="container">
	        <div class="main-page">
	        	
	        	<div class="car-lists">
        			<div class="form-fill-cart dis-form">
	        			<div class="row">
	        				<div class="col-md-12">
	        					<div class="promotion-page">
	        						<!-- Nav tabs -->
									<ul class="nav nav-tabs">
									  <li class="active"><a href="#download-material" data-toggle="tab">DOWNLOAD MATERIALS</a></li>
									  <li><a href="#profile" data-toggle="tab">PRESS RELEASE<?php echo count($press_release)?> </a></li>
									  <li><a href="#messages" data-toggle="tab">CLIENT TESTIMONIAL <?php echo count($client_testimontial);?></a></li>
									  <li><a href="#knowledge_center" data-toggle="tab">KNOWLEDGE CENTER<?php echo count($knowledge_center);?></a></li>
									  <li><a href="#awards" data-toggle="tab">AWARDS</a></li>
									</ul>

									<!-- Tab panes -->
									<div class="tab-content">
									  	<div class="tab-pane active" id="download-material">
									  		<div class="download-material">
									  			<div class="row">
<?php
if(isset($download_materials)&&!empty($download_materials)){
	foreach($download_materials as $set_data1){
		if(isset($set_data1['image'])&&$set_data1['image']!=''){
			$image1 = 'assets/uploads/job_section/thumbnails/'.$set_data1['image'];
		}
		else{
			$image1 = 'assets/uploads/profile.JPG';
		}
?>
										<div class="col-md-6">
                                            <div class="media">
                                                <a class="pull-left" href="front/view_promotion/<?php echo $set_data1['id'];?>">
                                                    <img class="media-object" src="<?php echo $image1;?>" alt="..." width="169" height="180">
                                                    <p style="color:#000" class="visible-xs media-heading"><?php echo $set_data1['name'];?></p>
                                                    <button class="btn btn-primary">Read More</button>
                                                </a>                                                
                                                <div class="media-body hidden-xs">
															    <h4 class="media-heading"><?php echo $set_data1['name'];?></h4>
															    <p><?php echo $set_data1['sort'];?></p>
															 </div>
                                            </div>
                                        </div>
                                        
                                
<?php	
	}
}
?>
									  			</div>
									  		</div>	
									  	</div><!--End download-material-->
										  <div class="tab-pane" id="profile">
	                                          	<div class="row">
<?php
if(isset($press_release)&&!empty($press_release)){
	foreach($press_release as $set_data2){
		if(isset($set_data2['image'])&&$set_data2['image']!=''){
			$image2 = 'assets/uploads/job_section/thumbnails/'.$set_data2['image'];
		}
		else{
			$image2 = 'assets/uploads/profile.JPG';
		}
?>
										<div class="col-md-6">
                                            <div class="media">
                                                <a class="pull-left" href="front/view_promotion/<?php echo $set_data2['id'];?>">
                                                    <img class="media-object" src="<?php echo $image2;?>" alt="..." width="169" height="180">
                                                    <p style="color:#000" class="visible-xs media-heading"><?php echo $set_data2['name'];?></p>
                                                    <button class="btn btn-primary">Read More</button>
                                                </a>                                                
                                                <div class="media-body hidden-xs">
															    <h4 class="media-heading"><?php echo $set_data2['name'];?></h4>
															    <p><?php echo $set_data2['sort'];?></p>
															 </div>
                                            </div>
                                        </div>
                                        
                                
<?php	
	}
}
?>
									  			</div>
                                          </div>
										  <div class="tab-pane" id="messages">
		                                        <div class="row">
<?php
if(isset($client_testimontial)&&!empty($client_testimontial)){
	foreach($client_testimontial as $set_data3){
		if(isset($set_data3['image'])&&$set_data3['image']!=''){
			$image3 = 'assets/uploads/job_section/thumbnails/'.$set_data3['image'];
		}
		else{
			$image3 = 'assets/uploads/profile.JPG';
		}
?>
										<div class="col-md-6">
                                            <div class="media">
                                                <a class="pull-left" href="front/view_promotion/<?php echo $set_data3['id'];?>">
                                                    <img class="media-object" src="<?php echo $image3;?>" alt="..." width="169" height="180">
                                                    <p style="color:#000" class="visible-xs media-heading"><?php echo $set_data3['name'];?></p>
                                                    <button class="btn btn-primary">Read More</button>
                                                </a>                                                
                                                <div class="media-body hidden-xs">
															    <h4 class="media-heading"><?php echo $set_data3['name'];?></h4>
															    <p><?php echo $set_data3['sort'];?></p>
															 </div>
                                            </div>
                                        </div>
                                        
                                
<?php	
	}
}
?>
									  			</div>
                                          </div>
										  <div class="tab-pane" id="knowledge_center">
												<div class="row">
<?php
if(isset($knowledge_center)&&!empty($knowledge_center)){
	foreach($knowledge_center as $set_data4){
		if(isset($set_data4['image'])&&$set_data4['image']!=''){
			$image4 = 'assets/uploads/job_section/thumbnails/'.$set_data4['image'];
		}
		else{
			$image4 = 'assets/uploads/profile.JPG';
		}
?>
										<div class="col-md-6">
                                            <div class="media">
                                                <a class="pull-left" href="front/view_promotion/<?php echo $set_data4['id'];?>">
                                                    <img class="media-object" src="<?php echo $image4;?>" alt="..." width="169" height="180">
                                                    <p style="color:#000" class="visible-xs media-heading"><?php echo $set_data4['name'];?></p>
                                                    <button class="btn btn-primary">Read More</button>
                                                </a>                                                
                                                <div class="media-body hidden-xs">
															    <h4 class="media-heading"><?php echo $set_data4['name'];?></h4>
															    <p><?php echo $set_data4['sort'];?></p>
															 </div>
                                            </div>
                                        </div>
                                        
                                
<?php	
	}
}
?>
									  			</div>
										</div><!--End knowledge center-->
										  
									</div>

	        					</div>
	        				</div>
	        				
	        			</div>
        			</div>

	        	</div>

	        </div><!--End content-->
    	</div>

