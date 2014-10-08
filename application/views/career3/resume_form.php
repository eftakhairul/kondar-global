<script src="assets/master/js/flipclock.js" type="text/javascript"></script>
<div class="bodywrapper">

    <div class="container">

        <div class="main-page">

            <div class="car-lists">

                <div class="form-fill-cart">

                    <div class="row">

                    </div>

                </div>

            </div>

        </div><!--End content-->

    </div>
</div>




<div class="modal fade" id="modal_success">

    <div class="modal-dialog">

        <form class="form-horizontal" role="form" method="post" enctype="multipart/form-data">

            <div class="modal-content">

                <div class="modal-body">

                    <div class="box-content-modal">

                        <div class="questions_history">

                            <?php
                            $i = 0;

                            foreach ($all_answers as $answer): $i++;
                                ?>

                                <div class="one_ques_hist">

                                    <div class="ques_text">

                                        <?php echo lang('Question') ?> <?php echo $i; ?>: <?php echo $answer['name'] ?>

                                    </div>

                                    <div class="ques_answer">

                                        <?php echo $answer['answer'] ?>

                                    </div>

                                </div>

                            <?php endforeach; ?>

                        </div>

                        <div>

                            <br/>

                            <?php echo lang('Thank you for answering the screening question. Please upload you resume now.') ?>

                            <br/>

                            <br/>

                        </div>

                        <div class="container">

                            <h1 class="modal-title">&nbsp;</h1>



                            <div style="float:right">

                                <div id="timer33" style="float:right; width: 100%; margin: 0px;">



                                </div>

                                <div style="float:right">



                                </div>

                                <div style="clear:both"></div>

                            </div>



                            <input type="hidden" name="operation" value="set">

                            <div class="form-group col-sm-6 col-xs-12">

                                <div class="col-sm-6">

                                    <div class="file-upload-container">

                                        <div class="file-upload-override-button left">

                                            <?php echo lang('Upload Resume') ?>



                                            <input name="file" type="file" class="file-upload-button" id="file-upload-button"/>

                                        </div>

                                        <div class="both"></div>

                                    </div>

                                </div>

                            </div>



                            <div class="form-group col-sm-6 col-xs-12">

                                 &nbsp;

                                 <div class="">



                                </div>

                            </div>



                            <span><b><?php echo lang('Note') ?>: </b><?php echo lang('the maximum resume size should be 1 MB. Acceptable document types are: *.doc / *.docx / *.pdf  / *.jpg  / *.png and *.gif') ?></span>



                            <?php
                            if ($this->session->flashdata('success')) {

                                $msg = $this->session->flashdata('success');
                                ?>

                                <div class="notice outer">

                                    <div class="note">

                                        <?php echo $msg; ?>

                                    </div>

                                </div>

                                <?php
                            }
                            ?>

                            <?php
                            if ($this->session->flashdata('error')) {

                                $msg = $this->session->flashdata('error');
                                ?>

                                <div class="notice outer">

                                    <div class="error">

                                        <?php echo $msg; ?>

                                    </div>

                                </div>

                                <?php
                            }
                            ?>

                        </div>


                        <div style="visibility: hidden;" id="please_wait">Welcome to my website! </div>

                        <div class="filepreview">



                        </div>



                        <div class="clearfix"></div>

                        <div class="btn-modal">

                            <input id="submit" style="float: right;display: block;margin-top: 10px;"  type="submit" value="Submit" class="btn btn-primary btn-sm"/>

                        </div>

                    </div>

                </div>

            </div><!-- /.modal-content -->

        </form>

    </div><!-- /.modal-dialog -->

</div>





<div class="modal fade modal_block">

    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-body">

                <div class="box-content-modal">

                    <h2 class="title-modal"><?php echo lang('Time Over') ?></h2>

<!--	      			<p><?php echo lang('Sorry your email ID has been blocked for 120 minutes.') ?></p>-->
                    <div id="modal_alert"></div>

                    <div class="clearfix"></div>

                    <div class="btn-modal">



                        <a style="float:right" href="javascript:void(0)" onClick="$('.modal_block').modal('hide');document.location='<?php echo site_url('/career/index') ?>'" class="block_bttn btn btn-primary btn-sm">OK <i class="glyphicon glyphicon-chevron-right"></i></a>	

                    </div>

                </div>

            </div>

        </div><!-- /.modal-content -->

    </div><!-- /.modal-dialog -->

</div>

<script type="text/javascript">
    var url =  "career/get_timer";
    var postData = {
        value:'edit'
    };
    $.post(url, postData, function(data) {
        // $('#promotion_preview_msg').html(data[0]['career_preview_msg']);
        //  $('#promotion_preview_msg').hide();
        var time = data[0]['career_edit_timer']*60;
        clock = $('#timer33').FlipClock(time, {
            clockFace: 'HourCounter',
            countdown: true,
            callbacks: {
                stop: function() {
                    blockHandler(true);
                }
            }
        });
    },'JSON');
    
    $('#submit').click(function(){
        clock.reset();
    })

</script>