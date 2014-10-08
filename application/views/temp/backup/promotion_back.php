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
									  <li><a href="#profile" data-toggle="tab">PRESS RELEASE </a></li>
									  <li><a href="#messages" data-toggle="tab">CLIENT TESTIMONIAL </a></li>
									  <li><a href="#knowledge_center" data-toggle="tab">KNOWLEDGE CENTER</a></li>
									  <li><a href="#awards" data-toggle="tab">AWARDS</a></li>
									</ul>

									<!-- Tab panes -->
									<div class="tab-content">
									  	<div class="tab-pane active" id="download-material">
									  		<div class="download-material">
                                            
									  			<div class="row">
<?php
if(isset($all_data)&&!empty($all_data)){
	foreach($all_data as $set_data1){
		if(isset($set_data1['image'])&&$set_data1['image']!=''){
			$image1 = 'assets/uploads/promotion_section/thumbnails/'.$set_data1['image'];
		}
		else{
			$image1 = 'assets/uploads/profile.JPG';
		}
?>
										<div class="col-md-3">
                                            <div class="pro-item">
                                                <img src="<?php echo $image1;?>" width="169" height="180"/>
                                                <div class="clearfix"></div>
                                                <a href="front/promotion/download_materials/<?php echo $set_data1['id'];?>" class="btn btn-primary btn-sm"><?php echo $set_data1['name'];?></a>
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
if(isset($all_data)&&!empty($all_data)){
	foreach($all_data as $set_data2){
		if(isset($set_data2['image'])&&$set_data2['image']!=''){
			$image1 = 'assets/uploads/promotion_section/thumbnails/'.$set_data2['image'];
		}
		else{
			$image1 = 'assets/uploads/profile.JPG';
		}
?>
										<div class="col-md-3">
                                            <div class="pro-item">
                                                <img src="<?php echo $image1;?>" width="169" height="180"/>
                                                <div class="clearfix"></div>
                                                <a href="front/promotion/press_release/<?php echo $set_data2['id'];?>" class="btn btn-primary btn-sm"><?php echo $set_data2['name'];?></a>
                                            </div>
                                        </div>
										
                                        
                                
<?php	
	}
}
?>
									  			</div>
                                          </div>
										  <div class="tab-pane" id="messages"></div>
										  <div class="tab-pane" id="knowledge_center">
												<div class="row">
<?php
if(isset($all_data)&&!empty($all_data)){
	foreach($all_data as $set_data3){
		if(isset($set_data3['image'])&&$set_data3['image']!=''){
			$image1 = 'assets/uploads/promotion_section/thumbnails/'.$set_data3['image'];
		}
		else{
			$image1 = 'assets/uploads/profile.JPG';
		}
?>
										<div class="col-md-3">
                                            <div class="pro-item">
                                                <img src="<?php echo $image1;?>" width="169" height="180"/>
                                                <div class="clearfix"></div>
                                                <a href="front/promotion/knowledge_center/<?php echo $set_data3['id'];?>" class="btn btn-primary btn-sm"><?php echo $set_data3['name'];?></a>
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

