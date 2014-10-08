<body>
	<div class="bodywrapper">
        <?php //include('include/menu1.php');?>
        <?php include('/../temp/include/header_child.php');?>
        <?php include('include/address.php');?>

        

        <div class="container">
	        <div class="main-page">
	        	
	        	<div class="car-lists">
        			<div class="form-fill-cart dis-form">
        				<div class="row">
        					<div class="col-md-7">
<?php
if(isset($page_data)&&!empty($page_data)){
?>
        						<h4><?php echo $page_data['title'];?></h4>
		                        <p><?php echo $page_data['description'];?></p>
<?php	
}
?>
  <link href="assets/template/css/video-js.css" rel="stylesheet" type="text/css">
  <!-- video.js must be in the <head> for older IEs to work. -->
  <script src="assets/template/js/video.js"></script>

  <!-- Unless using the CDN hosted version, update the URL to the Flash SWF -->
  <script>
    videojs.options.flash.swf = "video-js.swf";
  </script>
<?php
if(isset($page_data['video'])&&!empty($page_data['video'])){
?>

<video id="example_video_1" class="video-js vjs-default-skin" controls preload="none" width="640" height="264" poster="http://video-js.zencoder.com/oceans-clip.png"data-setup="{}">
                <source src="assets/uploads/content/video/<?php echo $page_data['video'];?>" type='video/mp4' />
              </video>

<?php
}
?>
        					</div>
        					<div class="col-md-5">
<?php
if(isset($page_data['image'])&&!empty($page_data['image'])){
	$image = 'assets/uploads/content/thumbnails/'.$page_data['image'];
	
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
