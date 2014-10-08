<?php
if ($this->session->flashdata('error')) {
    $msg = $this->session->flashdata('error');
    ?>
    <script>
        $(document).ready(function(){
            $('#modal_block').modal('show');
            $('#block_bttn').click(function(){
                return false;	
            });
            blink(1);
        });

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
     

    </script>
    <?php
}
?>    

<script>
    $(document).ready(function(){
        $('.show_page').click(function() {
            var album_id = $(this).attr('value');
            $('.show_page_'+album_id).toggle();
            //			alert(album_id);	
            return false;
        });

    });
</script>
<div class="bodywrapper">
    <?php //include('include/menu1.php');?>
    <?php include('/../temp/include/header_child.php'); ?>
    <?php include('include/address.php'); ?>
    <?php
    $permanent_job = $this->comman_model->get_all_data_by_id('job_section', array('category' => 'Permanent Job', 'status' => 1));
    $internship_program = $this->comman_model->get_all_data_by_id('job_section', array('category' => 'Internship Program', 'status' => 1));
    $part_time = $this->comman_model->get_all_data_by_id('job_section', array('category' => 'Part Time Job', 'status' => 1));
    $projects_contractors = $this->comman_model->get_all_data_by_id('job_section', array('category' => 'Projects Contractors', 'status' => 1));
    ?>        

    <div class="container">
        <div class="main-page">	        	
            <div class="car-lists">
                <div class="form-fill-cart dis-form">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="promotion-page">
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs">
                                    <li class="active"><a href="#permanent_job" data-toggle="tab">Permanent Job (<?php echo count($permanent_job); ?>)</a></li>
                                    <li><a href="#internship_program" data-toggle="tab">Internship Program (<?php echo count($internship_program); ?>)</a></li>
                                    <li><a href="#part_time_job" data-toggle="tab">Part Time Job (<?php echo count($part_time); ?>)</a></li>
                                    <li><a href="#projects_contractors" data-toggle="tab">Projects Contractors (<?php echo count($projects_contractors); ?>)</a></li>
                                </ul>

                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <div class="tab-pane active" id="permanent_job">
                                        <div class="download-material">
                                            <div class="row">


                                                <?php
                                                if (isset($permanent_job) && !empty($permanent_job)) {
                                                    foreach ($permanent_job as $set_data1) {
                                                        if (isset($set_data1['image']) && $set_data1['image'] != '') {
                                                            $image1 = 'assets/uploads/job_section/thumbnails/' . $set_data1['image'];
                                                        } else {
                                                            $image1 = 'assets/uploads/profile.jpg';
                                                        }
                                                        ?>
                                                        <div class="col-md-6">
                                                            <div class="media">
                                                                <a class="pull-left" href="front/apply_form/<?php echo $set_data1['id']; ?>">
                                                                    <img class="media-object" src="<?php echo $image1; ?>" alt="..." width="169" height="180">
                                                                    <p style="color:#000" class="visible-xs media-heading"><?php echo $set_data1['name']; ?></p>
                                                                    <button class="btn btn-primary">Apply</button>
                                                                </a>

                                                                <div class="media-body hidden-xs">
                                                                    <h4 class="media-heading" style="">Title: </h4><span><?php echo $set_data1['name']; ?></span>
                                                                    <div style="clear:both;"></div>
                                                                    <a class="show_page" id="page_<?php echo $set_data1['id']; ?>" value="<?php echo $set_data1['id']; ?>" href="#" style="color:#F00">Read More</a>
                                                                    <br />
                                                                    <div style="display:none" class="show_page_<?php echo $set_data1['id']; ?>"> 
                                                                        <h4 class="media-heading" style="">Scope: </h4><p><?php echo $set_data1['scope']; ?></p>
                                                                        <br />
                                                                        <div style="clear:both"></div>
                                                                        <h4 class="media-heading" style="">Qualification: </h4><p><?php echo $set_data1['qualification']; ?></p>
                                                                        <div style="clear:both"></div>
                                                                    </div>   
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
                                    <div class="tab-pane" id="internship_program">
                                        <div class="download-material">
                                            <div class="row">
                                                <?php
                                                if (isset($internship_program) && !empty($internship_program)) {
                                                    foreach ($internship_program as $set_data2) {
                                                        if (isset($set_data2['image']) && $set_data2['image'] != '') {
                                                            $image2 = 'assets/uploads/job_section/thumbnails/' . $set_data2['image'];
                                                        } else {
                                                            $image2 = 'assets/uploads/profile.JPG';
                                                        }
                                                        ?>
                                                        <div class="col-md-6">
                                                            <div class="media">
                                                                <a class="pull-left" href="front/apply_form/<?php echo $set_data2['id']; ?>">
                                                                    <img class="media-object" src="<?php echo $image2; ?>" alt="..." width="169" height="180">
                                                                    <p style="color:#000" class="visible-xs media-heading"><?php echo $set_data2['name']; ?></p>
                                                                    <button class="btn btn-primary">Apply</button>
                                                                </a>

                                                                <div class="media-body hidden-xs">
                                                                    <h4 class="media-heading" style="">Title: </h4><span><?php echo $set_data2['name']; ?></span>
                                                                    <div style="clear:both"></div>
                                                                    <a class="show_page" id="page_<?php echo $set_data2['id']; ?>" value="<?php echo $set_data2['id']; ?>" href="#" style="color:#F00">Read More</a>
                                                                    <br />
                                                                    <div style="display:none" class="show_page_<?php echo $set_data2['id']; ?>">
                                                                        <h4 class="media-heading" style="">Scope: </h4><p><?php echo $set_data2['scope']; ?></p>
                                                                        <br />
                                                                        <div style="clear:both"></div>
                                                                        <h4 class="media-heading" style="">Qualification: </h4><p><?php echo $set_data2['qualification']; ?></p>
                                                                        <div style="clear:both"></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
        <?php
    }
}
?>									  				
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="part_time_job">
                                        <div class="download-material">
                                            <div class="row">
<?php
if (isset($part_time) && !empty($part_time)) {
    foreach ($part_time as $set_data3) {
        if (isset($set_data3['image']) && $set_data3['image'] != '') {
            $image3 = 'assets/uploads/job_section/thumbnails/' . $set_data3['image'];
        } else {
            $image3 = 'assets/uploads/profile.JPG';
        }
        ?>
                                                        <div class="col-md-6">
                                                            <div class="media">
                                                                <a class="pull-left" href="front/apply_form/<?php echo $set_data3['id']; ?>">
                                                                    <img class="media-object" src="<?php echo $image3; ?>" alt="..." width="169" height="180">
                                                                    <p style="color:#000" class="visible-xs media-heading"><?php echo $set_data3['name']; ?></p>
                                                                    <button class="btn btn-primary">Apply</button>
                                                                </a>

                                                                <div class="media-body hidden-xs">
                                                                    <h4 class="media-heading" style="">Title: </h4><span><?php echo $set_data3['name']; ?></span>
                                                                    <div style="clear:both"></div>
                                                                    <a class="show_page" id="page_<?php echo $set_data3['id']; ?>" value="<?php echo $set_data3['id']; ?>" href="#" style="color:#F00">Read More</a>
                                                                    <br />
                                                                    <div style="display:none" class="show_page_<?php echo $set_data3['id']; ?>"> 
                                                                        <h4 class="media-heading" style="">Scope: </h4><p><?php echo $set_data3['scope']; ?></p>
                                                                        <br />
                                                                        <div style="clear:both"></div>
                                                                        <h4 class="media-heading" style="">Qualification: </h4><p><?php echo $set_data3['qualification']; ?></p>
                                                                        <div style="clear:both"></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
        <?php
    }
}
?>									  				
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="projects_contractors">
                                        <div class="download-material">
                                            <div class="row">
<?php
if (isset($projects_contractors) && !empty($projects_contractors)) {
    foreach ($projects_contractors as $set_data4) {
        if (isset($set_data4['image']) && $set_data4['image'] != '') {
            $image4 = 'assets/uploads/job_section/thumbnails/' . $set_data4['image'];
        } else {
            $image4 = 'assets/uploads/profile.JPG';
        }
        ?>
                                                        <div class="col-md-6">
                                                            <div class="media">
                                                                <a class="pull-left" href="front/apply_form/<?php echo $set_data4['id']; ?>">
                                                                    <img class="media-object" src="<?php echo $image4; ?>" alt="..." width="169" height="180">
                                                                    <p style="color:#000" class="visible-xs media-heading"><?php echo $set_data4['name']; ?></p>
                                                                    <button class="btn btn-primary">Apply</button>
                                                                </a>

                                                                <div class="media-body hidden-xs">
                                                                    <h4 class="media-heading" style="">Title: </h4><span><?php echo $set_data4['name']; ?></span>
                                                                    <div style="clear:both"></div>
                                                                    <a class="show_page" id="page_<?php echo $set_data4['id']; ?>" value="<?php echo $set_data4['id']; ?>" href="#" style="color:#F00">Read More</a>
                                                                    <br />
                                                                    <div style="display:none" class="show_page_<?php echo $set_data4['id']; ?>"> 
                                                                        <h4 class="media-heading" style="">Scope: </h4><p><?php echo $set_data4['scope']; ?></p>
                                                                        <br />
                                                                        <div style="clear:both"></div>
                                                                        <h4 class="media-heading" style="">Qualification: </h4><p><?php echo $set_data4['qualification']; ?></p>
                                                                        <div style="clear:both"></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
        <?php
    }
}
?>									  				
                                            </div>
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

    <div class="modal fade" id="modal_block">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                  <h4 class="modal-title">Modal title</h4>
                </div> -->
                <div class="modal-body">
                    <div class="box-content-modal">
                        <h2 class="title-modal"><blink>Warning</blink></h2>
                        <p>Sorry your email ID has been blocked for 120 minutes.</p>
                        <div class="clearfix"></div>
                        <div class="btn-modal">

                            <a style="float:right" href="javascript:" id="block_bttn" onClick="$('#modal_block').modal('hide')" class="btn btn-primary btn-sm">OK <i class="glyphicon glyphicon-chevron-right"></i></a>	
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