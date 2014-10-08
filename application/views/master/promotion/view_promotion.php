<div class="container">
	        <div class="main-page">
	        	
	        	<div class="car-lists">
        			<div class="form-fill-cart dis-form">
        				<div class="row">
        					<div class="col-md-7">
<?php
if(isset($page_data)&&!empty($page_data)){
?>
        						<h4><?php echo $page_data['name'];?></h4>
		                        <p><?php echo $page_data['description'];?></p>
<?php	
}
?>
  <link href="<?=base_url()?>assets/template/css/video-js.css" rel="stylesheet" type="text/css">
  <!-- video.js must be in the <head> for older IEs to work. -->
  <script src="<?=base_url()?>assets/template/js/video.js"></script>

  <!-- Unless using the CDN hosted version, update the URL to the Flash SWF -->
  <script>
    videojs.options.flash.swf = "video-js.swf";
  </script>
<?php
if(isset($page_data['video'])&&!empty($page_data['video'])){
?>
<video width="640" height="264" controls>
  <source src="<?=base_url()?>assets/uploads/promotion_section/video/<?=$page_data['video']?>" type='video/mp4; codecs="avc1.42E01E, mp4a.40.2"'>
</video>
            

<?php
}
?>
        					</div>
        					<div class="col-md-5">
<?php
if(isset($page_data['image'])&&!empty($page_data['image'])){
	$image = base_url().'assets/uploads/promotion_section/thumbnails/'.$page_data['image'];
	
?>                            
        						<img src="<?php echo $image; ?>" alt="img" class="img-responsive pull-right"/>
<?php
}
?>
        					</div>
        				</div>        				
        			</div>

	        	</div>

	        </div><!--End content-->
    	</div>
