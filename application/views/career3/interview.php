<script>var size =<?php echo $all_data[0]['min_words']; ?></script>
<script src="assets/template/js/countdown.js" type="text/javascript"></script>
<script src="assets/master/js/flipclock.js" type="text/javascript"></script>
<script src="assets/user/career/js/interview.js" type="text/javascript"></script>


<script type="text/javascript">
    var clock;
    function blink(n) {
        var blinks = document.getElementsByTagName("blink");
        var visibility = n % 2 === 0 ? "visible" : "hidden";
        for (var i = 0; i < blinks.length; i++) {
            blinks[i].style.visibility = visibility;
        }
        setTimeout(function () {
            blink(n + 1);
        }, 500);
    }
    $(document).ready(function () {
        blink(1);
    });
</script>


<div class="bodywrapper">

    <div class="container">

        <div class="main-page">

            <div class="car-lists">

                <div class="form-fill-cart dis-form">

                    <div class="row">

                        <div class="col-md-12">


                        </div>


                    </div>

                </div>


            </div>


        </div>
        <!--End content-->

    </div>
</div>


<div class="modal fade" id="modal_success">

<div class="modal-dialog">

    <div class="modal-content">

        <form method="post" onsubmit="return show(this)">


            <div class="modal-body">

                <div class="box-content-modal">

                    <div class="promotion-page" style="margin-bottom: 11px;">

                        <div class="download-material">

                            <div class="row">

                                <div class="col-md-12" style="float:left">

                                    <?php
                                    if (isset($all_data) && !empty($all_data)) {

                                        $check = $this->session->userdata('question_detail');

                                        if (isset($check) && !empty($check)) {

                                            $check = $this->session->userdata('question_detail');

                                            array_push($check, array('question_id' => $all_data[0]['id']));

                                            $this->session->set_userdata('question_detail', $check);
                                        } else {

                                            $ar = array('question_id' => $all_data[0]['id']);

                                            $this->session->set_userdata('question_detail', array($ar));
                                        }
                                        ?>



                                        <div class="media">

                                            <div class="media-body">

                                                <h4 class="media-heading">&nbsp;</h4>

                                                <input type="hidden" name="operation" value="set"/>

                                                <input type="hidden" name="question_id" id="question_id"
                                                       value="<?php echo $all_data[0]['id']; ?>"/>


                                                <div class="questions_history">

                                                    <?php
                                                    $i = 0;

                                                    foreach ($all_answers as $answer): $i++;
                                                        ?>

                                                        <div class="one_ques_hist">

                                                            <div class="ques_text">

                                                                <?php echo lang('Question') ?> <?php echo $i; ?>
                                                                : <?php echo $answer['name'] ?>

                                                            </div>

                                                            <div class="ques_answer">

                                                                <?php echo $answer['answer'] ?>

                                                            </div>

                                                        </div>

                                                    <?php endforeach; ?>

                                                </div>


                                                <table style="position: relative; border: 0;">
                                                    <tr>
                                                        <td colspan="2">
                                                            <div style="float:right">

                                                                <div id="timer22" style="float:right;">


                                                                </div>

                                                                <div style="float:right"></div>

                                                                <div style="clear:both"></div>

                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>

                                                        <td>

                                                                    <span>

    <?php echo lang('Question') ?> <?php echo $question_number; ?>
                                                                        of <?php echo(count($all_data) + $question_number - 1) ?>
                                                                        :

                                                                    </span></td>

                                                        <td><?php echo $all_data[0]['name']; ?></td>

                                                    </tr>


                                                    <tr>

                                                        <td><label style="margin-bottom:111px">Answer:</label></td>

                                                        <td><textarea name="answer"
                                                                      style="height: 130px;width: 100%;color: #DE0200;"
                                                                      cols="157"
                                                                      onkeyup="countChar(this)"></textarea>
                                                        </td>

                                                    </tr>

                                                    <tr>

                                                        <td>&nbsp;</td>

                                                        <td>
                                                            <div
                                                                id="charNum"><?php echo $all_data[0]['min_words'] ?> <?php echo lang('characters remaining') ?></div>

                                                        </td>

                                                    </tr>

                                                    <tr>

                                                        <td>&nbsp;</td>

                                                        <td></td>

                                                    </tr>

                                                </table>

                                                <span style="color:#F00"><b><?php echo lang('Note') ?>
                                                        : </b><?php echo lang('Please dont refresh the page.') ?></span>

                                            </div>

                                        </div>

                                        <div style="clear:both"></div>





                                    <?php
                                    }
                                    ?>

                                </div>

                            </div>

                        </div>

                    </div>
                    <!--End download-material-->


                    <div class="clearfix"></div>

                    <div class="btn-modal">


                        <input style="float:right;display: block;margin-top: 10px;" type="submit"
                               class="btn btn-primary btn-sm" value="<?php echo lang('Next') ?>"/>

                    </div>


                </div>


            </div>

        </form>

    </div>
    <!-- /.modal-content -->

</div>
</div>


<div class="modal fade modal_block">

    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-body">

                <div class="box-content-modal">

                    <h2 class="title-modal"><?php echo lang('Time Over') ?></h2>

                    <!--	      			<p><?php //echo lang('Sorry your email ID has been blocked for 120 minutes.')  ?></p>-->

                    <?php
                    //$user_data = $this->session->userdata('user_interview_data');
                    ?>
                    <!--                                <p>Unfortunately, you did not finish answer during the given lead-time. Therefore, you will be welcome to use an alternative email or wait for  120 minutes to use the current email <?php echo $user_data['email'] ?> within our website.</p>-->
                    <div id="modal_alert"></div>
                    <div class="clearfix"></div>

                    <div class="btn-modal">


                        <a style="float:right" href="javascript:void(0)"
                           onClick="$('.modal_block').modal('hide');document.location='<?php echo site_url("/career/index"); ?>'"
                           class="block_bttn btn btn-primary btn-sm"><?php echo lang('OK') ?> <i
                                class="glyphicon glyphicon-chevron-right"></i></a>

                    </div>

                </div>

            </div>

        </div>
        <!-- /.modal-content -->

    </div>
    <!-- /.modal-dialog -->

</div>


<div class="modal fade" id="modal_text">

    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-body">

                <div class="box-content-modal">

                    <h2 class="title-modal blink">Warning</h2>

                    <p id="text_msge"></p>

                    <div class="clearfix"></div>

                    <div class="btn-modal">


                        <a style="float:right" href="javascript:void(0)" id="check_bttn"
                           onClick="$('#modal_text').modal('hide')"
                           class="btn btn-primary btn-sm"><?php echo lang('OK') ?> <i
                                class="glyphicon glyphicon-chevron-right"></i></a>

                    </div>

                </div>

            </div>

        </div>
        <!-- /.modal-content -->

    </div>
    <!-- /.modal-dialog -->

</div>
</div>


<script type="text/javascript">
    clock = $('#timer22').FlipClock('<?php echo 60 * $all_data[0]['duration']; ?>', {
        clockFace: 'HourCounter',
        countdown: true,
        callbacks: {
            stop: function () {
                blockHandler(true);
            }
        }
    });
</script>