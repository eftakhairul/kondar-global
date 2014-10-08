
<?php
$permanent_job = $this->comman_model->get_all_data_by_id('job_section', array('category' => 'Permanent Job', 'status' => 1));

$internship_program = $this->comman_model->get_all_data_by_id('job_section', array('category' => 'Internship Program', 'status' => 1));

$part_time = $this->comman_model->get_all_data_by_id('job_section', array('category' => 'Part Time Job', 'status' => 1));

$projects_contractors = $this->comman_model->get_all_data_by_id('job_section', array('category' => 'Projects Contractors', 'status' => 1));
?>
<div class="footer1" style="background-color:#F6F6F6">

    <div class="footer">

        <div class="container footer_wrap" style="padding-top: 10px;">
            <div class="col-md-2" style="margin-left: 0; padding: 0;">

                <div class="fb1">

                    <div>

                        <ul style="list-style: none outside none; float: left; line-height: 25px; font-size: 12px; padding: 0px 6px; color: white; font-family: arial;">

                            <li><span style="font-size: 18px;  font-weight: bold;"><?php echo lang('Client') ?></span></li>

                            <li><a href="javascript:" class="login_pop"><?php echo lang('Follow Up Orders') ?></a></li>

                            <li><a href="<?=base_url()?>products" class=""><?php echo lang('Get Instant Quote') ?></a></li>

                            <li><a href="javascript:" class="login_pop"><?php echo lang('Claim Warranty') ?></a></li>

                            <li><a href="<?=base_url()?>promotion/awards" class=""><?php echo lang('Claim Award') ?></a></li>

                            <li><img src="assets/template/images/white_bottom_line.png" alt="" /></li>

                            <li><span style="font-size: 18px; font-weight: bold;"><?php echo lang('Media and Press') ?></span></li>

                            <li><a href="promotion/#profile"><?php echo lang('Press Release') ?></a></li>

                            <li><a href="promotion/#messages"><?php echo lang('Client Testimonial') ?></a></li>

                        </ul>



                    </div>

                </div>

            </div>

            <div class="fb2 col-md-7">

                <div class="row">

                    <div class="col-md-6 col-xs-6">

                        <div class="fb2_inside1">

                            <h2 style="font-family: arial; color: #de0200; font-size: 18px; font-weight: bold;">Knowledge Center</h2>

                            <?php
                            if (!empty($download)) {

                                foreach ($download as $set_data) {
                                    ?>

                                    <a href="<?=base_url()?>promotion/index#knowledge_center">

                                        <span style="color: #575757; font-family: arial; font-size: 13px; line-height: 2em;"><?=$set_data['name']?></span></a> <br />

                                    <?php
                                }
                            }
                            ?>                                     

                        </div>

                    </div>

                    <div class="col-md-6 col-xs-6">

                        <div class="fb2_inside2">

                            <h2 style="font-family: arial; color: #de0200; font-size: 18px; font-weight: bold; "><?php echo lang('Downloads') ?></h2>

                            <a href="<?=base_url()?>promotion"><span style="color: #575757; font-family: arial; font-size: 13px; line-height: 2em;"><?php echo lang('Reading Materials') ?></span></a><br />

                            <a href="<?=base_url()?>promotion"><span style="color: #575757; font-family: arial; font-size: 13px; line-height: 2em;"><?php echo lang('Videos') ?></span></a>

                        </div>

                    </div>

                </div>

                <div class="clearfix"></div>

                <div class="row">

                    <div class="col-md-6 col-xs-6">

                        <div class="fb2_inside3">

                            <h2 style="font-family: arial; color: #de0200; font-size: 18px; font-weight: bold;"><?php echo lang('Legal Notices'); ?></h2>	

                            <a href="promotion/view_promotion/38"><span style="color: #575757; font-family: arial; font-size: 13px; line-height: 2em;"><?php echo lang('Privacy Policy'); ?></span></a><br />	

                            <a href="promotion/view_promotion/39"><span style="color: #575757; font-family: arial; font-size: 13px; line-height: 2em;"><?php echo lang('Disclaimer'); ?></span></a>
                            <a href="contact"><h2 style="font-family: arial; color: #de0200; font-size: 18px; font-weight: bold;" class="blink"><?php echo lang('Contact us'); ?></h2></a>	

                        </div>


                    </div>

                    <div class="col-md-6 col-xs-6">

                        <div class="fb2_inside4 col-md-6 col-xs-6">

                            <h2 style="font-family: arial; color: #de0200; font-size: 18px; font-weight: bold; "><?php echo lang('Work With KGT') ?></h2> 

                            <a href="<?=base_url()?>career" onClick="goUrl('<?=base_url()?>career')"><span style="color: #575757; font-family: arial; font-size: 13px; line-height: 2em;">Permanent Job &nbsp;(<?php echo count($permanent_job); ?>)</span></a><br />	

                            <a href="<?=base_url()?>career#internship_program" onClick="goUrl('<?=base_url()?>career#internship_program')"><span style="color: #575757; font-family: arial; font-size: 13px; line-height: 2em;"><?php echo lang('Intership Program') ?>  &nbsp;(<?php echo count($internship_program); ?>)</span></a><br /> 

                            <a href="<?=base_url()?>career#part_time_job" onClick="goUrl('<?=base_url()?>career#part_time_job')"><span style="color: #575757; font-family: arial; font-size: 13px; line-height: 2em;"><?php echo lang('Part Time Job') ?>  &nbsp;(<?php echo count($part_time); ?>)</span>(<?php echo count($part_time); ?>)</a><br />	

                            <a href="<?=base_url()?>career#projects_contractors"   onClick="goUrl('<?=base_url()?>career#projects_contractors')"><span style="color: #575757; font-family: arial; font-size: 13px; line-height: 2em;"><?php echo lang('Contractors') ?>  &nbsp;(<?php echo count($projects_contractors); ?>)</span> (<?php echo count($projects_contractors); ?>)</a> </div>	

                    </div>

                </div>



            </div>

            <div class="fb3 col-md-3 pull-right" style="margin-right: 0; padding: 0;">

                <a href="<?=base_url()?>promotion/view_promotion/17">

                    <div style="background-image:url(<?=global_img_link('img01.png','template/images/')?>); background-repeat: no-repeat; height: 122px;">

                        <img src="<?=global_img_link('new.png','template/images/')?>" alt=""  style="margin-left: 10px; margin-top: -7px;" />

                    </div>

                </a>

                <a href="<?=base_url()?>promotion/view_promotion/17" class="login_pop" ><span style="display :none" >Investor Section</span>

                    <div style="background-image:url(<?=global_img_link('img02.png','template/images/')?>); background-repeat: no-repeat; height: 122px; margin-top: 23px">

                        <img src="<?=global_img_link('button2.png','template/images/')?>" alt="" style=" height: 56px; width: 128px; margin-top: 24px; margin-left: 5px;" />

                    </div>

                </a>

            </div>

        </div> 



        <div class="container">

            <div class="fb4">

                <div class="row" style="margin:0px;">

                    <div class="col-md-6 copyright-area" style="float: left; margin-top: 10px;">

                        <span style="font-family: arial; font-weight: bold; font-size: 12px;"><?php echo lang('Copy Right &copy 2014 Kondar Global. All rights Reserved') ?></span>

                    </div>

                    <div class="col-md-6 social text-right">

                        <div style="display:inline-block; margin-top: 10px;">

                            <span style="padding-right: 13px; font-family: arial; font-weight: bold; font-size: 12px;"><?php echo lang('Keep in Touch with us') ?></span>

                        </div>

                        <div  style="display:inline-block;  margin-top: 10px;">

                            <a href="javascript:" onClick="$('#underconstruction_popup').modal('show');"> <img src="<?=global_img_link('facebook_icon.png','template/images/')?>" alt="" /> </a>

                            <a href="javascript:" onClick="$('#underconstruction_popup').modal('show');"> <img src="<?=global_img_link('icon2.png','template/images/')?>" alt="" /> </a>

                            <a href="javascript:" onClick="$('#underconstruction_popup').modal('show');"> <img src="<?=global_img_link('youtube_icon.png','template/images/')?>" alt="" /> </a>

                        </div>

                    </div>

                </div>

            </div>

        </div>   

    </div><!--End footer-->

</div><!--End footer-->

</div>

<div class="modal fade" id="client_section">

    <div class="modal-dialog">

        <div class="modal-content">

            <!-- <div class="modal-header">
    
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    
              <h4 class="modal-title">Modal title</h4>
    
            </div> -->

            <div class="modal-body">

                <div class="box-content-modal">

                    <h2 class="title-modal client_name" >&nbsp;</h2>

                    <p id="error_msge"></p>

                    <div>

                        <table style="margin-left:105px">

                            <tr>

                                <td><strong><?php echo lang('Username') ?></strong></td>	

                                <td><input type="text" placeholder="Username" class="form-control" id="login_username" /></td>

                            </tr>

                            <tr>

                                <td><strong><?php echo lang('Password') ?></strong></td>	

                                <td><input type="password" placeholder="Password" class="form-control" id="login_password" /></td>

                            </tr>

                            <tr>

                                <td>&nbsp;</td>

                <td><!--<a href="javascript:" style="color:#F00" ><?php //echo lang('Forget Password')    ?></a>--></td>	

                            </tr>

                        </table>

                    </div>

                    <div class="clearfix"></div>

                    <div class="btn-modal">                     

                        <br />

                        <div class="row" style="margin-left:65px">

                            <div class="col-xs-4 col-md-4 text-center"> <a href="javascript:" class="btn btn-primary btn-sm popuplogin"  ><?php echo lang('Login') ?> <i class="glyphicon glyphicon-chevron-right"></i></a> </div>	

                            <div class="col-xs-4 col-md-4 text-center"> <a style="float:right" href="javascript:" onClick="$('#client_section').modal('hide')" class="btn btn-primary btn-sm"><?php echo lang('Cancel') ?> <i class="glyphicon glyphicon-chevron-right"></i></a> </div>	

                        </div>

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



<div class="modal fade" id="login_redirect">

    <div class="modal-dialog" style="width:57%">

        <div class="modal-content">



            <!-- <div class="modal-header">
        
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        
                <h4 class="modal-title">Login </h4>
        
              </div> -->

            <div class="modal-body">

                <div class="box-content-modal">

                    <h2 class="title-modal client_name" >The user name or the password entered are not correct</h2>

                    <div class="clearfix"></div>

                    <div class="btn-modal"> <br />

                        <div class="row" style="margin: 0 10px;">

                            <div class="col-xs-3 col-md-3 text-center"> <a href="contact" class="btn btn-primary btn-sm popuplogin"  >Contact KGT <i class="glyphicon glyphicon-chevron-right"></i></a> </div>	

                            <div class="col-xs-3 col-md-3 text-center"> <a style="float:right" href="contact" onClick="$('#client_section').modal('hide')" class="btn btn-primary btn-sm">Forget password <i class="glyphicon glyphicon-chevron-right"></i></a> </div>	

                            <div class="col-xs-3 col-md-3 text-center"> <a href="contact" class="btn btn-primary btn-sm popuplogin"  >Forget user name <i class="glyphicon glyphicon-chevron-right"></i></a> </div>	

                            <div class="col-xs-3 col-md-2 text-center"> <a style="float:right" href="javascript:" onClick="$('#login_redirect').modal('hide')" class="btn btn-primary btn-sm"><?php echo lang('Cancel') ?> <i class="glyphicon glyphicon-chevron-right"></i></a> </div>	

                        </div>

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


<div class="modal fade" id="underconstruction_popup">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="box-content-modal">
                    <h2 class="title-modal client_name">This version is still under development. Thank you</h2>
                    <div class="clearfix"></div>
                    <div class="btn-modal"> <br />
                        <div class="row" style="float:right;">
                            <div class="col-xs-3 col-md-2 text-center"> <a style="float:right" href="javascript:void(0)" onClick="$('#underconstruction_popup').modal('hide');" class="btn btn-primary btn-sm">Ok <i class="glyphicon glyphicon-chevron-right"></i></a> </div>	
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




<div class="modal fade" id="language_popup">

    <div class="modal-dialog">

        <div class="modal-content">



            <!-- <div class="modal-header">
        
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        
                <h4 class="modal-title">Login </h4>
        
              </div> -->

            <div class="modal-body">

                <div class="box-content-modal">

                    <h2 class="title-modal client_name" >This version is still under development. Thank you</h2>

                    <div class="clearfix"></div>

                    <div class="btn-modal"> <br />

                        <div class="row" style="float:right;">

                            <div class="col-xs-3 col-md-2 text-center"> <a style="float:right" href="javascript:" onClick="$('#language_popup').modal('hide');lang_redirct();" class="btn btn-primary btn-sm">Ok <i class="glyphicon glyphicon-chevron-right"></i></a> </div>	

                        </div>

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

    <script type="text/javascript">
        
        function goUrl(url_link){
            var url = url_link.split("#"); 
            var id = url[1];
            $("#"+id+"1").click();           
        }
        
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
        window.onload=function(){
            blink(1);
        };
    </script>  

