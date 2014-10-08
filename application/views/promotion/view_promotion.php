<div class="container">
    <div class="main-page">

        <div class="car-lists">
            <div class="form-fill-cart dis-form">
                <div class="row">
                    <div class="col-md-7">
                        <?php
                        if (isset($page_data) && !empty($page_data)) {
                            ?>
                            <h4><?php echo $page_data['name']; ?></h4>
                            <?php echo $page_data['description']; ?>
                            <?php
                        }
                        ?>
                        
                        <!-- Unless using the CDN hosted version, update the URL to the Flash SWF -->
                        <script>
                            videojs.options.flash.swf = "video-js.swf";
                        </script>
                        <?php
                        if (isset($page_data['video']) && !empty($page_data['video'])) {
                            ?>

                            <video id="example_video_1" class="video-js vjs-default-skin" controls preload="none" width="640" height="264" poster="http://video-js.zencoder.com/oceans-clip.png"data-setup="{}">
                                <source src="assets/uploads/promotion_section/video/<?php echo $page_data['video']; ?>" type='video/mp4' />
                            </video>

                            <?php
                        }
                        ?>
                    </div>
                    <div class="col-md-5">
                        <?php
                        if (isset($page_data['image']) && !empty($page_data['image'])) {
                            $image = 'assets/uploads/promotion_section/thumbnails/' . $page_data['image'];
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
