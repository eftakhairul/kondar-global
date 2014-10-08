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
<div class="bodywrapper">
    <div class="modal fade" id="modal_success_applyform">
        <div class="modal-dialog">
            <div class="modal-content">
                <!--coded by Arun -->
                <!--  <div style="position:absolute; top:0px; right:0px; z-index:99999; color:#F00;" onclick="closepopup();">Close</div>-->
                <a style="position:absolute; top:0px; right:0px; z-index:99999; color:#F00;" href="javascript:" onClick="$('.modal_block').modal('hide');window.location.href = 'career/index';" >Close<i class="block_bttn glyphicon glyphicon-chevron-right"></i></a>	
                <!-- end-->
                <form class="form-horizontal" role="form" method="post">
                    <div class="modal-body">
                        <div class="box-content-modal">
                            <h2 class="title-modal"><?php echo lang('Apply For') ?> <?php echo $apply_form['name']; ?></h2>
                            <input type="hidden" name="operation" value="set">
                            <div class="form-group">
                                <label for="salutation" class="col-sm-5 control-label"><?php echo lang('Title') ?></label>
                                <div class="col-sm-6">
                                    <select name="salutation" id="salutation" style="height:35px" class="form-control selectpicker1">
                                        <option value='Mr.' data-title="Mr">Mr.</option>
                                        <option value='Ms.'  data-title="Ms">Ms.</option>
                                    </select>
                                </div>
                            </div> 


                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-5 control-label"><?php echo lang('Name and Surname') ?></label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="name" id="inputEmail3" placeholder="<?php echo lang('Name and Surname') ?>" value="<?php echo set_value('name'); ?>">
                                    <span style="color:#F00;"><?php echo form_error('name'); ?></span> </div>
                            </div>
                            <div class="form-group">
                                <label for="countries" class="col-sm-5 control-label"><?php echo lang('Country') ?></label>
                                <div class="col-sm-6">
                                    <?php $this->load->view('temp/include/countrylist'); ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputContact" class="col-sm-5 control-label"><?php echo lang('Telephone') ?></label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="contact" id="inputContact" placeholder="<?php echo lang('Telephone') ?>" value="<?php echo set_value('contact'); ?>">
                                    <span style="color:#F00;"><?php echo form_error('contact'); ?></span> </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPassword3" class="col-sm-5 control-label"><?php echo lang('Email') ?></label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" id="inputPassword3" placeholder="<?php echo lang('Email') ?>" name="email" value="<?php echo set_value('email'); ?>">
                                    <span style="color:#F00;"><?php echo form_error('email'); ?></span> </div>
                            </div>
                            <?php
                            if ($this->session->flashdata('success')):
                                $msg = $this->session->flashdata('success');
                                ?>
                                <div class="notice outer">
                                    <div class="note"><script type="text/javascript">$(document).ready(function(){$('#modal_success_applyform').modal('hide');$('.modal_block').modal('show');}); </script><?php //echo $msg;   ?> </div>
                                </div>


                                <?php
                            endif;
                            ?>
                            <?php
                            if ($this->session->flashdata('error')) :

                                $msg = $this->session->flashdata('error');
                                ?>
                                <div class="notice outer">
                                    <div class="error"><?php echo $msg; ?> </div>
                                </div>
                                <?php
                            endif;
                            ?>
                            <div class="clearfix"></div>
                            <div class="btn-modal">
                                <input style="float: right;display: block;margin-top: 10px;" type="submit" value="Apply" class="btn btn-primary btn-sm"/>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <div class="modal fade modal_block" style="overflow: auto;">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                  <h4 class="modal-title">Modal title</h4>
                </div> -->
                <div class="modal-body">
                    <div class="box-content-modal">
                        <h2 class="title-modal blink">Warning</h2>
                        <p><?php echo $msg; ?></p>
                        <div class="clearfix"></div>
                        <div class="btn-modal">
                            <a style="float:right" href="javascript:" onClick="$('.modal_block').modal('hide');window.location.href = 'career/index'" class="block_bttn btn btn-primary btn-sm"><?php echo lang('OK') ?> <i class="glyphicon glyphicon-chevron-right"></i></a>	
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
</div>