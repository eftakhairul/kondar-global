<script type="text/javascript">
    function blink(n) {
        var blinks = document.getElementsByTagName("blink");
        var visibility = n % 2 === 0 ? "visible" : "hidden";
        for (var i = 0; i < blinks.length; i++) {
            blinks[i].style.visibility = visibility;
        }
        setTimeout(function() {
            blink(n + 1);
        }, 500);
    }
    $(document).ready(function(){
        blink(1);
    });
</script>    

<div class="container">
      <div class="main-page">
        <div class="car-lists">
          <div class="form-fill-cart dis-form">
            <div class="row">
              <div class="col-md-12">
                <div class="promotion-page">
                  <!-- Nav tabs -->
                  <ul class="nav nav-tabs">
                    <li class="active"><a href="#download-material" data-toggle="tab">DOWNLOAD MATERIALS (<?php echo count($download_material);?>)</a></li>
                    <li><a href="#profile" data-toggle="tab">PRESS RELEASE (<?php echo count($press_release);?>)</a></li>
                    <li><a href="#messages" data-toggle="tab">CLIENT TESTIMONIAL (0) </a></li>
                    <li><a href="#knowledge_center" data-toggle="tab">KNOWLEDGE CENTER (<?php echo count($knowledge_center);?>)</a></li>
                    <li><a href="#awards" data-toggle="tab">AWARDS (0)</a></li>
                  </ul>
                  <!-- Tab panes -->
                  <div class="tab-content">
                    <div class="tab-pane active" id="download-material">
                      <div class="download-material">
                        <div class="row">
                          <?php
                          if(isset($download_material)&&!empty($download_material)){
                            foreach($download_material as $set_data1){
                              if(isset($set_data1['image'])&&$set_data1['image']!=''){
                                $image1 = global_img_link($set_data1['image'],'uploads/promotion_section/thumbnails/');
                              }
                              else{
                                $image1 = img_url('profile.jpg','master/');
                              }
                          ?>
                          <div class="col-md-6" style="margin-right:50px">
                            <div class="media">
                              <div style="float:left;margin-right:10px" >
                                <img class="media-object" src="<?=$image1?>" alt="..." width="169" height="180" >
                                <p style="color:#000" class="visible-xs media-heading"><?php echo $set_data1['name'];?></p>
                                <?php
                                if(!empty($set_data1['file'])){
                                ?>
                                <a class="openPop btn btn-primary" href="#" id="<?=$set_data1['id']?>" ><span style="display:none"><?php echo $set_data1['name'];?></span>Download</a>  
                                <?php
                                }
                                ?>
                              </div>                                              
                              <div class="media-body hidden-xs" style="height:187px">
                                <h4 class="media-heading"><?php echo $set_data1['name'];?></h4>
                                <p><?php echo $set_data1['sort'];?></p>
                              </div>
                              <a style="color:#F00;margin-left:10px" href="<?=base_url()?>promotion/view_promotion/<?php echo $set_data1['id'];?>" target="_blank" >Read More</a>  

                            </div>
                          </div>
                          <?php 
                            }
                          }
                          else{
                            echo '<h3 style="margin-left:10px">There is no data.</h3>';
                          }

                          ?>
                        </div>
                      </div>  
                    </div>
                    <!--End download-material-->
                    <div class="tab-pane" id="profile">
                      <div class="row">
                        <?php
                        if(isset($press_release)&&!empty($press_release)){
                          foreach($press_release as $set_data1){
                            if(isset($set_data1['image'])&&$set_data1['image']!=''){
                              $image1 = global_img_link($set_data1['image'],'uploads/promotion_section/thumbnails/');
                            }
                            else{
                              $image1 = img_url('profile.jpg','master/');
                            }
                        ?>
                        <div class="col-md-6" style="margin-right:50px;margin-bottom:20px">
                          <div class="media">
                            <div style="float:left;margin-right:10px" >
                              <img class="media-object" src="<?=$image1?>" alt="..." width="169" height="180">
                              <p style="color:#000" class="visible-xs media-heading"><?php echo $set_data1['name'];?></p>
                              <?php
                              if(!empty($set_data1['file'])){
                              ?>
                              <a class="openPop btn btn-primary" href="#" id="<?php echo $set_data1['id'];?>"  ><span style="display:none"><?php echo $set_data1['name'];?></span>Download</a>  
                              <?php
                              }
                              ?>
                            </div>                                              
                            <div class="media-body hidden-xs" style="height:187px">
                                <h4 class="media-heading"><?php echo $set_data1['name'];?></h4>
                                <p><?php echo $set_data1['sort'];?></p>
                            </div>
                            <a style="color:#F00;margin-left:10px" href="<?=base_url()?>promotion/view_promotion/<?php echo $set_data1['id'];?>" target="_blank" >Read More</a>  
                          </div>
                        </div>
                        <?php 
                          }
                        }
                        else{
                          echo '<h3 style="margin-left:10px">There is no data.</h3>';
                        }

                        ?>
                      </div>
                    </div>
                    <div class="tab-pane" id="messages"></div>
                    <div class="tab-pane" id="awards"></div>
                    <div class="tab-pane" id="knowledge_center">
                      <div class="knowledge_center">
                        <div class="row">
                          <div class="col-md-3" style="margin-top:0px">                                                                             
                            <ul class="nav nav-pills nav-stacked">
                              <?php
                              if(isset($knowledge_center)&&!empty($knowledge_center)){
                                foreach($knowledge_center as $set_data1){
                                  $know = $set_data1['know'];
                                  echo '<li><h3><a href="#know_'.$set_data1['id'].'" style="font-weight:bold;font-size:20px" data-toggle="tab">'.$set_data1['name'].'</a></h3></li>';
                                  foreach($know as $set_data2){
                                    echo '<li><a href="#know_'.$set_data2['id'].'" data-toggle="tab">'.$set_data2['name'].'</a></li>';
                                  }
                                }
                              }
                              ?>
                            </ul>
                          </div>
                          <div class="col-md-9">
                            <div class="tab-content" style="box-shadow:none;padding:0px">
                              <?php
                              if(isset($knowledge_center)&&!empty($knowledge_center)){
                                $i=1;

                                foreach($knowledge_center as $set_data1){
                                  $know_desc = $set_data1['know'];
                                  if(isset($set_data1['image'])&&$set_data1['image']!=''){
                                    $image1 = global_img_link($set_data1['image'],'uploads/promotion_section/thumbnails/');
                                  }

                                  else{
                                    $image1 = img_url('profile.jpg','master/');
                                  }
                              ?>
                              <div id="know_<?php echo $set_data1['id'];?>" <?php echo $i==1?'class="tab-pane active"':'class="tab-pane"';?> >
                                <div>
                                    <h3><?php echo $set_data1['name'];?>&nbsp;</h3>
                                  <p><?php echo $set_data1['sort'];?></p>
                                  <img src="<?=$image1?>" style="margin:0 auto" class="img-responsive" alt="image11"/>
                                  <p><?php echo $set_data1['description'];?></p>
                                  <?php
                                  $i++;
                                  if(isset($set_data1['video'])&&!empty($set_data1['video'])){
                                  ?>

                                  <video id="example_video_1" class="video-js vjs-default-skin" controls preload="none" width="640" height="264" poster="http://video-js.zencoder.com/oceans-clip.png"data-setup="{}">
                                    <source src="<?=base_url()?>assets/uploads/promotion_section/video/<?php echo $set_data1['video'];?>" type='video/mp4' />
                                  </video>

                                  <?php
                                  }
                                  if(isset($set_data1['file'])&&!empty($set_data1['file'])){
                                    echo '<a href="#" id="'.$set_data1['id'].'" style="color:red" class="openPop" ><span style="display:none">'.$set_data1['name'].'</span>Download</a>';
                                  }
                                  ?>
                                </div>
                              </div>
                              <?php
                                  foreach($know_desc as $set_data2){
                                    if(isset($set_data2['image'])&&$set_data2['image']!=''){
                                      $image2 = base_url().'assets/uploads/promotion_section/thumbnails/'.$set_data2['image'];
                                    }
                                    else{
                                      $image2 = base_url().'assets/uploads/profile.jpg';
                                    }
                              ?>
                              <div id="know_<?php echo $set_data2['id'];?>" class="tab-pane">
                                <div>
                                  <h3><?php echo $set_data2['name'];?>&nbsp;</h3>
                                  <p><?php echo $set_data2['sort'];?></p>
                                  <img src="<?=$image2?>" style="margin:0 auto" class="img-responsive" alt="image21"/>
                                  <p><?php echo $set_data2['description'];?></p>
                                  <?php
                                  if(isset($set_data2['video'])&&!empty($set_data2['video'])){
                                  ?>

                                  <video id="example_video_1" class="video-js vjs-default-skin" controls preload="none" width="640" height="264" poster="http://video-js.zencoder.com/oceans-clip.png"data-setup="{}">
                                    <source src="<?=base_url()?>assets/uploads/promotion_section/video/<?php echo $set_data2['video'];?>" type='video/mp4' />
                                  </video>

                                  <?php
                                  }
                                  if(isset($set_data2['file'])&&!empty($set_data2['file'])){
                                    echo '<a href="#" id="'.$set_data2['id'].'" style="color:red" class="openPop"><span style="display:none">'.$set_data1['name'].'</span>Download</a>';
                                  }

                                  ?>
                                </div>
                              </div>
                              <?php
                                    
                                  }
                                }
                              }

                              ?>
                            </div>
                          </div>                          
                        </div>
                      </div>
                      <div class="row">
                      </div>
                    </div>
                    <!--End knowledge center-->    
                  </div>

                </div>
              </div>
                  
            </div>
          </div>

        </div>

      </div>
      <!--End content-->
    </div>
    <!--click show msge-->
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
              <input type="hidden" name="id" id="promotion_id" value="" />
              <div id="countdownplace"></div>
              <p id="show_msge"></p>
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
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>

    <!--block msge-->                
    <div class="modal fade" id="modal_block">
      <div class="modal-dialog">
        <div class="modal-content">
          <!-- <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Modal title</h4>
          </div> -->
          <div class="modal-body">
            <div class="box-content-modal">
              <h2 class="title-modal blink">Warning<</h2>
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
