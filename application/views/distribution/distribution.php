<!--added for distributionby jluna-->

<!--Modal shopping decision cart-->
<div class="modal fade" id="notify_panel">
    <div class="modal-dialog">modal_dist_preview_popup
        <div class="modal-content">
            <div class="modal-body">
                <div class="box-content-modal">
                    <div id="div_id_notifications_panel">
                        <h1 class="title-modal"><?php echo $this->lang->line('notify_panel_title'); ?></h1>
                        <div class="clearfix"></div>
                        <div class="btn-modal toyota-page">
                            <div class="row">
                                <div class="col-xs-4 col-md-4 text-center">
                                    <a id="notify_panel_close_button" class="btn btn-primary btn-sm"><?php echo $this->lang->line('close_button'); ?> <i class="glyphicon glyphicon-chevron-right"></i></a>    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<!--Modal shopping decision cart-->
<div class="modal fade" id="code_verification">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="box-content-modal">

                    <div style="color:red;text-decoration: underline;" class="div_id_verification_warning"></div>

                    <div class="div_id_verification_error" ></div>
                    <div id="div_id_verification_panel">
                        <h2 class="title-modal" style="text-transform: inherit; text-decoration: none;">We sent a verification code to :<span id="user_email"><?php echo isset($_POST['email']) ? $_POST['email'] : ""; ?></span></h2>
                        <div id="div_id_verification_message" style="color: gray"></div>
                        <div class="send-verification-code-1">
                            <div class="clock-timer" style="float:right; text-align: right; margin: 0px;" id="timer3"></div>                         
                        </div>
                        <p><label for="txt_verification_code"><?php echo $this->lang->line('code_verification_please_enter_code'); ?></label><input id="txt_verification_code" type="text" name="code" required></div>
                    <div class="clearfix"></div>
                    <div id="all_button" class="btn-modal toyota-page">
                        <div class="row">
                            <div class="col-xs-4 col-md-4 text-center">
                                <a id="code_verification_ok_verify_button" class="btn btn-primary btn-sm"><?php echo $this->lang->line('confirm_button'); ?> <i class="glyphicon glyphicon-chevron-right"></i></a>
                            </div>
                            <div style="margin-left: 27%; margin-top: 0px;" class="loading" ></div>
                            <div class="col-xs-4 col-md-4 text-center">
                                <a id="code_verification_resend_code_button" class="btn btn-primary btn-sm"><?php echo $this->lang->line('resend_button'); ?> <i class="glyphicon glyphicon-chevron-right"></i></a>
                            </div>
                            <div class="col-xs-4 col-md-4 text-center">
                                <a id="code_verification_cancel_button" class="btn btn-primary btn-sm"><?php echo $this->lang->line('cancel_button'); ?> <i class="glyphicon glyphicon-chevron-right"></i></a> 
                            </div>
                        </div>
                    </div>
                    <div class="div_id_verification_block">
                        <div class="clearfix"></div>
                        <div class="btn-modal toyota-page">
                            <div class="row">
                                <div style="padding: 10px;" id="div_id_verification_message1"></div>
                                <div class="col-xs-4 pull-right col-md-4 text-center">

                                    <a class="code_verification_block_close_button btn btn-primary btn-sm"><?php echo $this->lang->line('close_button'); ?> <i class="glyphicon glyphicon-chevron-right"></i></a>   
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" id="code_verification1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="box-content-modal">
                    <div class="div_id_verification_block">
                        <div class="clearfix"></div>
                        <div class="btn-modal toyota-page">
                            <div class="row" style="padding: 5px;">
                                <div style="color:red;text-decoration: underline;" class="div_id_verification_warning"></div>

                                <div class="div_id_verification_error"></div>

                                <a class="code_verification_block_close_button btn pull-right btn-primary btn-sm"><?php echo $this->lang->line('close_button'); ?> <i class="glyphicon glyphicon-chevron-right"></i></a>   
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<!--Modal shopping decision cart-->
<div class="modal fade <?php echo (isset($email_message)) ? 'in' : ""; ?>" id="modal_success" <?php echo (isset($email_message)) ? 'style="display:block;"' : ""; ?>>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="box-content-modal">
                    <h1 class="title-modal"><?php echo $this->lang->line('modal_success_title'); ?></h1>
                    <div id="modal_success_message"><?php echo (isset($email_message)) ? $email_message : ""; ?></div>
                    <div id="modal_success_error"><?php echo (isset($email_error)) ? $email_error : ""; ?></div>
                    <div class="clearfix"></div>
                    <div class="btn-modal">
                        <a class="modal-success-1 btn btn-primary btn-sm" href="distribution/index"><?php echo $this->lang->line('ok_button'); ?> <i class="glyphicon glyphicon-chevron-right"></i></a>    
                    </div>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<!--Modal shopping decision cart-->
<div class="modal fade" id="block_box">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="box-content-modal">
                    <div class="blockElementWrap">
                        <div class="blockMsg" id="blckMsg"></div>
                    </div>
                    <br><br>
                    <input id="hidden" value="" type="hidden"/>
                    <div class="clearfix"></div>
<!--                    <h2 class="title-modal" id="blckMsg1"><?php echo $this->lang->line('block_box_message'); ?></h2>-->
                    <div class="clearfix"></div>
                    <div class="btn-modal">
                        <div class="row">
                            <div class="col-md-12 col-xs-12 text-right">
                                <a class="btn btn-primary btn-sm" id="blck_confirm_msg"><?php echo $this->lang->line('ok_button'); ?> <i class="glyphicon glyphicon-chevron-right"></i></a>   
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!--Modal shopping decision cart-->
<div class="modal fade" id="block_box1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="box-content-modal">
                    <div class="blockElementWrap">
                        <div class="blockMsg" id="blckMsg1"></div>
                    </div>
                    <br><br>
                    <input id="hidden2" value="" type="hidden"/>
                    <div class="clearfix"></div>
<!--                    <h2 class="title-modal" id="blckMsg1"><?php echo $this->lang->line('block_box_message'); ?></h2>-->
                    <div class="clearfix"></div>
                    <div class="btn-modal">
                        <div class="row">
                            <div class="col-md-12 col-xs-12 text-right">
                                <a class="btn btn-primary btn-sm" id="blck_confirm_msg1"><?php echo $this->lang->line('ok_button'); ?> <i class="glyphicon glyphicon-chevron-right"></i></a>   
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!--Modal shopping decision cart-->
<div class="modal fade" id="modal_dist_popup">
    <div class="modal-dialog modal-dist-popup-width">
        <div class="modal-content modal-dist-popup-width-2">
            <div class="modal-body modal-dist-popup-width-3">
                <div class="box-content-modal modal-dist-popup-width-4">
                    <div class="container modal-dist-popup-width-5">
                        <div class="index-page">
                            <div >
                                <div class="form-fill-cart dis-form">
                                    <h2 class="title-modal text-align-center"><?php echo $this->lang->line('modal_dist_popup_title'); ?></h2>
                                    <div class="modal-dist-popup-counter-styles">
                                        <div style="margin: 0px; float: right;" class="clock-timer" id="timer1"></div>                         
                                    </div>
                                    <div class="modal-dist-popup-counter-styles">
                                        <div id="timer4"></div>                         
                                    </div>
                                    <p><?php echo $this->lang->line('modal_dist_popup_header'); ?></div>
                                <div >
                                    <div class="modal-dist-popup">
                                        <form enctype="multipart/form-data" name="frm_distribution_application" id="frm_id_distribution_application" action="distribution/index/do_upload" method="post" class="form-horizontal" role="form">
                                            <div class="form-group">
                                                <label for="company" class="col-md-4 col-sm-4  col-xs-12 "><strong><?php echo $this->lang->line('modal_dist_popup_company_name'); ?></strong></label>

                                                <input type="text" required  class="col-md-8 col-sm-8  col-xs-12  " name="company" id="company" value="<?php echo isset($_POST["company"]) ? $_POST["company"] : ""; ?>" placeholder="<?php echo $this->lang->line('modal_dist_popup_company_name'); ?>" maxlength="64">
                                                <?php echo form_error('company'); ?>

                                            </div>

                                            <div class="form-group">
                                                <label class="col-md-4 col-sm-4  col-xs-12 "><strong>Title</strong></label>
                                                <select name="salutation" class="promotion_salutation col-md-8 col-sm-8   col-xs-12  ">

                                                    <option value='Mr'>Mr.</option>
                                                    <option value='Ms'>Ms.</option>
                                                </select>

                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-4 col-sm-4  col-xs-12 "><strong><?php echo $this->lang->line('modal_dist_popup_applicant_name'); ?></strong></label>
                                                <input type="text"  class="applicant col-md-8 col-sm-8   col-xs-12" required  name="applicant" value="<?php echo isset($_POST["applicant"]) ? $_POST["applicant"] : ""; ?>" placeholder="<?php echo $this->lang->line('modal_dist_popup_applicant_name'); ?>" maxlength="64">
                                                <?php echo form_error('applicant'); ?>

                                            </div>

                                            <div class="form-group">
                                                <label for="country" class="col-md-4 col-sm-4  col-xs-12 "><strong><?php echo $this->lang->line('modal_dist_popup_country'); ?></strong></label>
                                                <div  class="col-md-8 col-sm-8 col-xs-12  ">
                                                    <select name="country" id="country" style="width: 100%;">
                                                        <option value='1' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag af" data-title="Afghanistan">Afghanistan</option>
                                                        <option value='2' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag ax" data-title="Aland Islands">Aland Islands</option>
                                                        <option value='3' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag al" data-title="Albania">Albania</option>
                                                        <option value='4' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag dz" data-title="Algeria">Algeria</option>
                                                        <option value='5' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag as" data-title="American Samoa">American Samoa</option>
                                                        <option value='6' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag ad" data-title="Andorra">Andorra</option>
                                                        <option value='7' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag ao" data-title="Angola">Angola</option>
                                                        <option value='8' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag ai" data-title="Anguilla">Anguilla</option>
                                                        <option value='9' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag aq" data-title="Antarctica">Antarctica</option>
                                                        <option value='10' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag ag" data-title="Antigua and Barbuda">Antigua and Barbuda</option>
                                                        <option value='11' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag ar" data-title="Argentina">Argentina</option>
                                                        <option value='12' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag am" data-title="Armenia">Armenia</option>
                                                        <option value='13' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag aw" data-title="Aruba">Aruba</option>
                                                        <option value='14' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag au" data-title="Australia">Australia</option>
                                                        <option value='15' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag at" data-title="Austria">Austria</option>
                                                        <option value='16' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag az" data-title="Azerbaijan">Azerbaijan</option>
                                                        <option value='17' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag bs" data-title="Bahamas">Bahamas</option>
                                                        <option value='18' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag bh" data-title="Bahrain">Bahrain</option>
                                                        <option value='19' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag bd" data-title="Bangladesh">Bangladesh</option>
                                                        <option value='20' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag bb" data-title="Barbados">Barbados</option>
                                                        <option value='21' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag by" data-title="Belarus">Belarus</option>
                                                        <option value='22' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag be" data-title="Belgium">Belgium</option>
                                                        <option value='23' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag bz" data-title="Belize">Belize</option>
                                                        <option value='24' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag bj" data-title="Benin">Benin</option>
                                                        <option value='25' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag bm" data-title="Bermuda">Bermuda</option>
                                                        <option value='26' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag bt" data-title="Bhutan">Bhutan</option>
                                                        <option value='27' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag bo" data-title="Bolivia, Plurinational State of">Bolivia, Plurinational State of</option>
                                                        <option value='28' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag bq" data-title="Bonaire, Sint Eustatius and Saba">Bonaire, Sint Eustatius and Saba</option>
                                                        <option value='29' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag ba" data-title="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                                                        <option value='30' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag bw" data-title="Botswana">Botswana</option>
                                                        <option value='31' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag bv" data-title="Bouvet Island">Bouvet Island</option>
                                                        <option value='32' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag br" data-title="Brazil">Brazil</option>
                                                        <option value='33' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag io" data-title="British Indian Ocean Territory">British Indian Ocean Territory</option>
                                                        <option value='34' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag bn" data-title="Brunei Darussalam">Brunei Darussalam</option>
                                                        <option value='35' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag bg" data-title="Bulgaria">Bulgaria</option>
                                                        <option value='36' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag bf" data-title="Burkina Faso">Burkina Faso</option>
                                                        <option value='37' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag bi" data-title="Burundi">Burundi</option>
                                                        <option value='38' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag kh" data-title="Cambodia">Cambodia</option>
                                                        <option value='39' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag cm" data-title="Cameroon">Cameroon</option>
                                                        <option value='40' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag ca" data-title="Canada" selected="selected">Canada</option>
                                                        <option value='41' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag cv" data-title="Cape Verde">Cape Verde</option>
                                                        <option value='42' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag ky" data-title="Cayman Islands">Cayman Islands</option>
                                                        <option value='43' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag cf" data-title="Central African Republic">Central African Republic</option>
                                                        <option value='44' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag td" data-title="Chad">Chad</option>
                                                        <option value='45' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag cl" data-title="Chile">Chile</option>
                                                        <option value='46' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag cn" data-title="China">China</option>
                                                        <option value='47' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag cx" data-title="Christmas Island">Christmas Island</option>
                                                        <option value='48' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag cc" data-title="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>
                                                        <option value='49' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag co" data-title="Colombia">Colombia</option>
                                                        <option value='50' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag km" data-title="Comoros">Comoros</option>
                                                        <option value='51' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag cg" data-title="Congo">Congo</option>
                                                        <option value='52' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag cd" data-title="Congo, The Democratic Republic of the">Congo, The Democratic Republic of the</option>
                                                        <option value='53' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag ck" data-title="Cook Islands">Cook Islands</option>
                                                        <option value='54' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag cr" data-title="Costa Rica">Costa Rica</option>
                                                        <option value='55' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag ci" data-title="Cote d'Ivoire">Cote d'Ivoire</option>
                                                        <option value='56' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag hr" data-title="Croatia">Croatia</option>
                                                        <option value='57' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag cu" data-title="Cuba">Cuba</option>
                                                        <option value='58' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag cw" data-title="Curacao">Curacao</option>
                                                        <option value='59' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag cy" data-title="Cyprus">Cyprus</option>
                                                        <option value='60' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag cz" data-title="Czech Republic">Czech Republic</option>
                                                        <option value='61' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag dk" data-title="Denmark">Denmark</option>
                                                        <option value='62' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag dj" data-title="Djibouti">Djibouti</option>
                                                        <option value='63' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag dm" data-title="Dominica">Dominica</option>
                                                        <option value='64' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag do" data-title="Dominican Republic">Dominican Republic</option>
                                                        <option value='65' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag ec" data-title="Ecuador">Ecuador</option>
                                                        <option value='66' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag eg" data-title="Egypt">Egypt</option>
                                                        <option value='67' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag sv" data-title="El Salvador">El Salvador</option>
                                                        <option value='68' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag gq" data-title="Equatorial Guinea">Equatorial Guinea</option>
                                                        <option value='69' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag er" data-title="Eritrea">Eritrea</option>
                                                        <option value='70' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag ee" data-title="Estonia">Estonia</option>
                                                        <option value='71' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag et" data-title="Ethiopia">Ethiopia</option>
                                                        <option value='72' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag fk" data-title="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option>
                                                        <option value='73' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag fo" data-title="Faroe Islands">Faroe Islands</option>
                                                        <option value='74' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag fj" data-title="Fiji">Fiji</option>
                                                        <option value='75' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag fi" data-title="Finland">Finland</option>
                                                        <option value='76' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag fr" data-title="France">France</option>
                                                        <option value='77' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag gf" data-title="French Guiana">French Guiana</option>
                                                        <option value='78' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag pf" data-title="French Polynesia">French Polynesia</option>
                                                        <option value='79' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag tf" data-title="French Southern Territories">French Southern Territories</option>
                                                        <option value='80' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag ga" data-title="Gabon">Gabon</option>
                                                        <option value='81' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag gm" data-title="Gambia">Gambia</option>
                                                        <option value='82' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag ge" data-title="Georgia">Georgia</option>
                                                        <option value='83' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag de" data-title="Germany">Germany</option>
                                                        <option value='84' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag gh" data-title="Ghana">Ghana</option>
                                                        <option value='85' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag gi" data-title="Gibraltar">Gibraltar</option>
                                                        <option value='86' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag gr" data-title="Greece">Greece</option>
                                                        <option value='87' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag gl" data-title="Greenland">Greenland</option>
                                                        <option value='88' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag gd" data-title="Grenada">Grenada</option>
                                                        <option value='89' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag gp" data-title="Guadeloupe">Guadeloupe</option>
                                                        <option value='90' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag gu" data-title="Guam">Guam</option>
                                                        <option value='91' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag gt" data-title="Guatemala">Guatemala</option>
                                                        <option value='92' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag gg" data-title="Guernsey">Guernsey</option>
                                                        <option value='93' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag gn" data-title="Guinea">Guinea</option>
                                                        <option value='94' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag gw" data-title="Guinea-Bissau">Guinea-Bissau</option>
                                                        <option value='95' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag gy" data-title="Guyana">Guyana</option>
                                                        <option value='96' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag ht" data-title="Haiti">Haiti</option>
                                                        <option value='97' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag hm" data-title="Heard Island and McDonald Islands">Heard Island and McDonald Islands</option>
                                                        <option value='98' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag va" data-title="Holy See (Vatican City State)">Holy See (Vatican City State)</option>
                                                        <option value='99' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag hn" data-title="Honduras">Honduras</option>
                                                        <option value='100' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag hk" data-title="Hong Kong">Hong Kong</option>
                                                        <option value='101' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag hu" data-title="Hungary">Hungary</option>
                                                        <option value='102' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag is" data-title="Iceland">Iceland</option>
                                                        <option value='103' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag in" data-title="India">India</option>
                                                        <option value='104' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag id" data-title="Indonesia">Indonesia</option>
                                                        <option value='105' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag ir" data-title="Iran, Islamic Republic of">Iran, Islamic Republic of</option>
                                                        <option value='106' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag iq" data-title="Iraq">Iraq</option>
                                                        <option value='107' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag ie" data-title="Ireland">Ireland</option>
                                                        <option value='108' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag im" data-title="Isle of Man">Isle of Man</option>
                                                        <option value='109' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag il" data-title="Israel">Israel</option>
                                                        <option value='110' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag it" data-title="Italy">Italy</option>
                                                        <option value='111' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag jm" data-title="Jamaica">Jamaica</option>
                                                        <option value='112' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag jp" data-title="Japan">Japan</option>
                                                        <option value='113' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag je" data-title="Jersey">Jersey</option>
                                                        <option value='114' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag jo" data-title="Jordan">Jordan</option>
                                                        <option value='115' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag kz" data-title="Kazakhstan">Kazakhstan</option>
                                                        <option value='116' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag ke" data-title="Kenya">Kenya</option>
                                                        <option value='117' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag ki" data-title="Kiribati">Kiribati</option>
                                                        <option value='118' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag kp" data-title="Korea, Democratic People's Republic of">Korea, Democratic People's Republic of</option>
                                                        <option value='119' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag kr" data-title="Korea, Republic of">Korea, Republic of</option>
                                                        <option value='120' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag kw" data-title="Kuwait">Kuwait</option>
                                                        <option value='121' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag kg" data-title="Kyrgyzstan">Kyrgyzstan</option>
                                                        <option value='122' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag la" data-title="Lao People's Democratic Republic">Lao People's Democratic Republic</option>
                                                        <option value='123' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag lv" data-title="Latvia">Latvia</option>
                                                        <option value='124' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag lb" data-title="Lebanon">Lebanon</option>
                                                        <option value='125' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag ls" data-title="Lesotho">Lesotho</option>
                                                        <option value='126' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag lr" data-title="Liberia">Liberia</option>
                                                        <option value='127' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag ly" data-title="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>
                                                        <option value='128' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag li" data-title="Liechtenstein">Liechtenstein</option>
                                                        <option value='129' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag lt" data-title="Lithuania">Lithuania</option>
                                                        <option value='130' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag lu" data-title="Luxembourg">Luxembourg</option>
                                                        <option value='131' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag mo" data-title="Macao">Macao</option>
                                                        <option value='132' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag mk" data-title="Macedonia, The former Yugoslav Republic of">Macedonia, The former Yugoslav Republic of</option>
                                                        <option value='133' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag mg" data-title="Madagascar">Madagascar</option>
                                                        <option value='134' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag mw" data-title="Malawi">Malawi</option>
                                                        <option value='135' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag my" data-title="Malaysia">Malaysia</option>
                                                        <option value='136' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag mv" data-title="Maldives">Maldives</option>
                                                        <option value='137' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag ml" data-title="Mali">Mali</option>
                                                        <option value='138' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag mt" data-title="Malta">Malta</option>
                                                        <option value='139' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag mh" data-title="Marshall Islands">Marshall Islands</option>
                                                        <option value='140' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag mq" data-title="Martinique">Martinique</option>
                                                        <option value='141' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag mr" data-title="Mauritania">Mauritania</option>
                                                        <option value='142' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag mu" data-title="Mauritius">Mauritius</option>
                                                        <option value='143' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag yt" data-title="Mayotte">Mayotte</option>
                                                        <option value='144' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag mx" data-title="Mexico">Mexico</option>
                                                        <option value='145' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag fm" data-title="Micronesia, Federated States of">Micronesia, Federated States of</option>
                                                        <option value='146' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag md" data-title="Moldova, Republic of">Moldova, Republic of</option>
                                                        <option value='147' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag mc" data-title="Monaco">Monaco</option>
                                                        <option value='148' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag mn" data-title="Mongolia">Mongolia</option>
                                                        <option value='149' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag me" data-title="Montenegro">Montenegro</option>
                                                        <option value='150' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag ms" data-title="Montserrat">Montserrat</option>
                                                        <option value='151' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag ma" data-title="Morocco">Morocco</option>
                                                        <option value='152' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag mz" data-title="Mozambique">Mozambique</option>
                                                        <option value='153' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag mm" data-title="Myanmar">Myanmar</option>
                                                        <option value='154' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag na" data-title="Namibia">Namibia</option>
                                                        <option value='155' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag nr" data-title="Nauru">Nauru</option>
                                                        <option value='156' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag np" data-title="Nepal">Nepal</option>
                                                        <option value='157' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag nl" data-title="Netherlands">Netherlands</option>
                                                        <option value='158' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag nc" data-title="New Caledonia">New Caledonia</option>
                                                        <option value='159' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag nz" data-title="New Zealand">New Zealand</option>
                                                        <option value='160' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag ni" data-title="Nicaragua">Nicaragua</option>
                                                        <option value='161' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag ne" data-title="Niger">Niger</option>
                                                        <option value='162' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag ng" data-title="Nigeria">Nigeria</option>
                                                        <option value='163' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag nu" data-title="Niue">Niue</option>
                                                        <option value='164' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag nf" data-title="Norfolk Island">Norfolk Island</option>
                                                        <option value='165' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag mp" data-title="Northern Mariana Islands">Northern Mariana Islands</option>
                                                        <option value='166' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag no" data-title="Norway">Norway</option>
                                                        <option value='167' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag om" data-title="Oman">Oman</option>
                                                        <option value='168' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag pk" data-title="Pakistan">Pakistan</option>
                                                        <option value='169' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag pw" data-title="Palau">Palau</option>
                                                        <option value='170' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag ps" data-title="Palestinian Territory, Occupied">Palestinian Territory, Occupied</option>
                                                        <option value='171' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag pa" data-title="Panama">Panama</option>
                                                        <option value='172' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag pg" data-title="Papua New Guinea">Papua New Guinea</option>
                                                        <option value='173' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag py" data-title="Paraguay">Paraguay</option>
                                                        <option value='174' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag pe" data-title="Peru">Peru</option>
                                                        <option value='175' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag ph" data-title="Philippines">Philippines</option>
                                                        <option value='176' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag pn" data-title="Pitcairn">Pitcairn</option>
                                                        <option value='177' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag pl" data-title="Poland">Poland</option>
                                                        <option value='178' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag pt" data-title="Portugal">Portugal</option>
                                                        <option value='179' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag pr" data-title="Puerto Rico">Puerto Rico</option>
                                                        <option value='180' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag qa" data-title="Qatar">Qatar</option>
                                                        <option value='181' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag re" data-title="Reunion">Reunion</option>
                                                        <option value='182' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag ro" data-title="Romania">Romania</option>
                                                        <option value='183' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag ru" data-title="Russian Federation">Russian Federation</option>
                                                        <option value='184' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag rw" data-title="Rwanda">Rwanda</option>
                                                        <option value='185' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag bl" data-title="Saint Barthelemy">Saint Barthelemy</option>
                                                        <option value='186' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag sh" data-title="Saint Helena, Ascension and Tristan Da Cunha">Saint Helena, Ascension and Tristan Da Cunha</option>
                                                        <option value='187' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag kn" data-title="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                                                        <option value='188' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag lc" data-title="Saint Lucia">Saint Lucia</option>
                                                        <option value='189' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag mf" data-title="Saint Martin (French Part)">Saint Martin (French Part)</option>
                                                        <option value='190' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag pm" data-title="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
                                                        <option value='191' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag vc" data-title="Saint Vincent and The Grenadines">Saint Vincent and The Grenadines</option>
                                                        <option value='192' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag ws" data-title="Samoa">Samoa</option>
                                                        <option value='193' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag sm" data-title="San Marino">San Marino</option>
                                                        <option value='194' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag st" data-title="Sao Tome and Principe">Sao Tome and Principe</option>
                                                        <option value='195' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag sa" data-title="Saudi Arabia">Saudi Arabia</option>
                                                        <option value='196' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag sn" data-title="Senegal">Senegal</option>
                                                        <option value='197' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag rs" data-title="Serbia">Serbia</option>
                                                        <option value='198' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag sc" data-title="Seychelles">Seychelles</option>
                                                        <option value='199' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag sl" data-title="Sierra Leone">Sierra Leone</option>
                                                        <option value='200' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag sg" data-title="Singapore">Singapore</option>
                                                        <option value='201' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag sx" data-title="Sint Maarten (Dutch Part)">Sint Maarten (Dutch Part)</option>
                                                        <option value='202' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag sk" data-title="Slovakia">Slovakia</option>
                                                        <option value='203' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag si" data-title="Slovenia">Slovenia</option>
                                                        <option value='204' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag sb" data-title="Solomon Islands">Solomon Islands</option>
                                                        <option value='205' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag so" data-title="Somalia">Somalia</option>
                                                        <option value='206' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag za" data-title="South Africa">South Africa</option>
                                                        <option value='207' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag gs" data-title="South Georgia and The South Sandwich Islands">South Georgia and The South Sandwich Islands</option>
                                                        <option value='208' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag ss" data-title="South Sudan">South Sudan</option>
                                                        <option value='209' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag es" data-title="Spain">Spain</option>
                                                        <option value='210' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag lk" data-title="Sri Lanka">Sri Lanka</option>
                                                        <option value='211' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag sd" data-title="Sudan">Sudan</option>
                                                        <option value='212' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag sr" data-title="Suriname">Suriname</option>
                                                        <option value='213' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag sj" data-title="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option>
                                                        <option value='214' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag sz" data-title="Swaziland">Swaziland</option>
                                                        <option value='215' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag se" data-title="Sweden">Sweden</option>
                                                        <option value='216' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag ch" data-title="Switzerland">Switzerland</option>
                                                        <option value='217' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag sy" data-title="Syrian Arab Republic">Syrian Arab Republic</option>
                                                        <option value='218' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag tw" data-title="Taiwan, Province of China">Taiwan, Province of China</option>
                                                        <option value='219' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag tj" data-title="Tajikistan">Tajikistan</option>
                                                        <option value='220' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag tz" data-title="Tanzania, United Republic of">Tanzania, United Republic of</option>
                                                        <option value='221' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag th" data-title="Thailand">Thailand</option>
                                                        <option value='222' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag tl" data-title="Timor-Leste">Timor-Leste</option>
                                                        <option value='223' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag tg" data-title="Togo">Togo</option>
                                                        <option value='224' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag tk" data-title="Tokelau">Tokelau</option>
                                                        <option value='225' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag to" data-title="Tonga">Tonga</option>
                                                        <option value='226' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag tt" data-title="Trinidad and Tobago">Trinidad and Tobago</option>
                                                        <option value='227' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag tn" data-title="Tunisia">Tunisia</option>
                                                        <option value='228' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag tr" data-title="Turkey">Turkey</option>
                                                        <option value='229' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag tm" data-title="Turkmenistan">Turkmenistan</option>
                                                        <option value='230' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag tc" data-title="Turks and Caicos Islands">Turks and Caicos Islands</option>
                                                        <option value='231' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag tv" data-title="Tuvalu">Tuvalu</option>
                                                        <option value='232' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag ug" data-title="Uganda">Uganda</option>
                                                        <option value='233' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag ua" data-title="Ukraine">Ukraine</option>
                                                        <option value='234' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag ae" data-title="United Arab Emirates">United Arab Emirates</option>
                                                        <option value='235' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag gb" data-title="United Kingdom">United Kingdom</option>
                                                        <option value='236' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag us" data-title="United States">United States</option>
                                                        <option value='237' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag um" data-title="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
                                                        <option value='238' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag uy" data-title="Uruguay">Uruguay</option>
                                                        <option value='239' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag uz" data-title="Uzbekistan">Uzbekistan</option>
                                                        <option value='240' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag vu" data-title="Vanuatu">Vanuatu</option>
                                                        <option value='241' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag ve" data-title="Venezuela, Bolivarian Republic of">Venezuela, Bolivarian Republic of</option>
                                                        <option value='242' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag vn" data-title="Viet Nam">Viet Nam</option>
                                                        <option value='243' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag vg" data-title="Virgin Islands, British">Virgin Islands, British</option>
                                                        <option value='244' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag vi" data-title="Virgin Islands, U.S.">Virgin Islands, U.S.</option>
                                                        <option value='245' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag wf" data-title="Wallis and Futuna">Wallis and Futuna</option>
                                                        <option value='246' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag eh" data-title="Western Sahara">Western Sahara</option>
                                                        <option value='247' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag ye" data-title="Yemen">Yemen</option>
                                                        <option value='248' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag zm" data-title="Zambia">Zambia</option>
                                                        <option value='249' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag zw" data-title="Zimbabwe">Zimbabwe</option>
                                                    </select><br>
                                                    <input type="hidden" name="hdn_country_label" class="hdn_country_label">
                                                    <input type="hidden" name="hdn_country_name" class="hdn_country_name">
                                                    <?php echo form_error('country'); ?>
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="form-group">
                                                <label class="col-md-4 col-sm-4  col-xs-12 "><strong><?php echo $this->lang->line('modal_dist_popup_complete_address'); ?></strong></label>
                                                <input  class="col-md-8 col-sm-8  col-xs-12  input-address address" required type="text" name="address" value="<?php echo isset($_POST["address"]) ? $_POST["address"] : ""; ?>" placeholder="<?php echo $this->lang->line('modal_dist_popup_complete_address'); ?>" maxlength="128">
                                                <?php echo form_error('address'); ?>

                                            </div>

                                            <div class="clearfix"></div>

                                            <div class="form-group">
                                                <label class="col-md-4 col-sm-4  col-xs-12 "><strong><?php echo $this->lang->line('modal_dist_popup_designation'); ?></strong></label>
                                                <input required type="text"  class="col-md-8 col-sm-8   col-xs-12  designation" name="designation" value="<?php echo isset($_POST["designation"]) ? $_POST["designation"] : ""; ?>" placeholder="<?php echo $this->lang->line('modal_dist_popup_designation'); ?>" maxlength="32">
                                                <?php echo form_error('designation'); ?>

                                            </div>

                                            <div class="form-group">
                                                <label class="col-md-4 col-sm-4  col-xs-12 "><strong><?php echo $this->lang->line('modal_dist_popup_telephone'); ?></strong></label>
                                                <input required type="text" class="col-md-8 col-sm-8  col-xs-12  telephone" name="telephone"  value="<?php echo isset($_POST["telephone"]) ? $_POST["telephone"] : ""; ?>" placeholder="<?php echo $this->lang->line('modal_dist_popup_telephone'); ?>" maxlength="32">
                                                <?php echo form_error('telephone'); ?>

                                            </div>

                                            <div class="clearfix"></div>

                                            <div class="form-group">
                                                <label class="col-md-4 col-sm-4  col-xs-12 "><strong><?php echo $this->lang->line('modal_dist_popup_email'); ?></strong></label>
                                                <input required type="text" class="col-md-8 col-sm-8  col-xs-12 email " name="email"  value="<?php echo isset($_POST["email"]) ? $_POST["email"] : ""; ?>" placeholder="<?php echo $this->lang->line('modal_dist_popup_email'); ?>" maxlength="128">
                                                <?php echo form_error('email'); ?>

                                            </div>

                                            <div class="form-group">
                                                <label class="col-md-4 col-sm-4  col-xs-12 "><strong><?php echo $this->lang->line('modal_dist_popup_upload_corporate_trade_licence_copy'); ?></strong></label>
                                                <div class="col-md-8 col-sm-8  col-xs-12  license">
                                                    <input required type="file" name="license" class="license">
                                                    <span class="help modal-dist-popup-upload-help">
                                                        <?php echo $this->lang->line('modal_dist_popup_license_formats'); ?>
                                                    </span>
                                                </div>

                                            </div>

                                            <div class="form-group">
                                                <div style="width:100%;margin-left: 2%;" class="filepreview">                                                            
                                                    <input type="hidden" name="hdn_license_preview" class="hdn_license_preview" value="<?php echo $license_picture_name; ?>">
                                                    <?php echo $preview; ?>
                                                </div>
                                            </div>


                                            <div class="clearfix"></div>
                                            <fieldset class="modal-dist-popup-fieldset-width">
                                                <legend><strong><?php echo $this->lang->line('modal_dist_popup_fieldset_1'); ?></strong></legend>
                                                <div><input type="radio" name="companysize"  value="medium" <?php echo (isset($_POST["companysize"]) && $_POST["companysize"] == "medium") ? " checked " : ""; ?> class="modal-dist-popup-radio companysize_medium"><span class="companysize_html"><?php echo $this->lang->line('modal_dist_popup_fieldset_1_1'); ?></span></div>
                                                <div><input type="radio" name="companysize"  value="big" <?php echo (isset($_POST["companysize"]) && $_POST["companysize"] == "big") ? " checked " : ""; ?>  class="modal-dist-popup-radio companysize_big"><span class="companysize_html"><?php echo $this->lang->line('modal_dist_popup_fieldset_1_2'); ?></span></div>
                                                <?php echo form_error('companysize'); ?>
                                            </fieldset>
                                            <br>
                                            <fieldset class="modal-dist-popup-fieldset-width">
                                                <legend><strong><?php echo $this->lang->line('modal_dist_popup_fieldset_2'); ?></strong></legend>
                                                <div><input type="radio" name="companystart"  value="Brake Pads" <?php echo (isset($_POST["companystart"]) && $_POST["companystart"] == "Brake Pads") ? " checked " : ""; ?> class="modal-dist-popup-radio companystart_brake_pads"> <?php echo $this->lang->line('modal_dist_popup_fieldset_2_1'); ?></div>
                                                <div><input type="radio" name="companystart"  value="Filters" <?php echo (isset($_POST["companystart"]) && $_POST["companystart"] == "Filters") ? " checked " : ""; ?> class="modal-dist-popup-radio companystart_filters"><span class="companysize_html"> <?php echo $this->lang->line('modal_dist_popup_fieldset_2_2'); ?></span></div>
                                                <div><input type="radio" name="companystart"  value="Brake Lining" <?php echo (isset($_POST["companystart"]) && $_POST["companystart"] == "Brake Lining") ? " checked " : ""; ?> class="modal-dist-popup-radio companystart_brake_lining"> <span class="companysize_html"><?php echo $this->lang->line('modal_dist_popup_fieldset_2_3'); ?></span></div>
                                                <?php echo form_error('companystart'); ?>
                                            </fieldset>
                                            <div class="loading" ></div>
                                            <h2 class="modal-dist-popup-kgt-support"><?php echo $this->lang->line('modal_dist_popup_kgt_support_1'); ?>(<span id="spn_id_Company_1"><?php echo isset($_POST['company']) ? $_POST['company'] : ""; ?></span>) <?php echo $this->lang->line('modal_dist_popup_kgt_support_2'); ?>(<span id="spn_id_Company_2"><?php echo isset($_POST['company']) ? $_POST['company'] : ""; ?></span>) <?php echo $this->lang->line('modal_dist_popup_kgt_support_3'); ?></h2>

                                            <div>
                                                <input required type="checkbox" name="chk_agree" <?php echo (isset($_POST["chk_agree"])) ? " checked " : ""; ?> class="modal-dist-popup-checkbox chk_id_agree"> <strong><?php echo $this->lang->line('modal_dist_popup_i_understand_1'); ?></strong>
                                                <?php echo form_error('chk_agree'); ?>
                                            </div>
                                            <div class="modal-dist-popup-fieldset-width">
                                                <div >
                                                    <strong><?php echo $this->lang->line('modal_dist_popup_sales_force_1'); ?></strong><br>
                                                    <label class="col-md-8"><strong><?php echo $this->lang->line('modal_dist_popup_sales_force_2'); ?></strong></label>
                                                    <select class="col-md-4 sel_id_indoor_sales" required name="sel_indoor_sales" >
                                                        <option value="">----</option>
                                                        <?php for ($i = 1; $i <= 100; $i++) { ?>
                                                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div >
                                                    <label  class="col-md-8"><strong><?php echo $this->lang->line('modal_dist_popup_sales_force_3'); ?></strong></label>
                                                    <select  class="col-md-4 sel_id_outdoor_sales" name="sel_outdoor_sales">
                                                        <option value="">----</option>
                                                        <?php for ($i = 1; $i <= 100; $i++) { ?>
                                                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <?php echo form_error('sel_indoor_sales'); ?><br>
                                                <?php echo form_error('sel_outdoor_sales'); ?>
                                            </div>
                                            <div class="modal-dist-popup-fieldset-width">
                                                <label><strong><?php echo $this->lang->line('modal_dist_popup_sales_brief'); ?></strong></label><br>
                                                <textarea required name="salesbrief" class="modal-dist-popup-fieldset-width col-md-12 col-sm-12  col-xs-12 txt_id_salesbrief "><?php echo (isset($_POST['salesbrief'])) ? $_POST['salesbrief'] : ""; ?></textarea>
                                                <?php echo form_error('salesbrief'); ?>
                                            </div>
                                            <div class="modal-dist-popup-kgt-support">
                                                <input type="checkbox" name="chk_signup" <?php echo (isset($_POST["chk_signup"])) ? " checked " : ""; ?>  class="modal-dist-popup-checkbox chk_id_signup"> <strong><?php echo $this->lang->line('modal_dist_popup_i_am_1'); ?>(<span id="spn_id_Applicant_1"><?php echo isset($_POST['applicant']) ? $_POST['applicant'] : ""; ?></span>) <?php echo $this->lang->line('modal_dist_popup_i_am_2'); ?>(<span id="spn_id_Company_3"><?php echo isset($_POST['company']) ? $_POST['company'] : ""; ?></span>) <?php echo $this->lang->line('modal_dist_popup_i_am_3'); ?></strong> 
                                                <?php echo form_error('chk_signup'); ?>
                                            </div>

                                            <div class="clearfix"></div>
                                            <div class="nav-prex-next text-right">
                                                <div class="row">
                                                    <div class="col-md-12">                                                        
                                                        <a id="cancel" class="btn btn-primary btn-sm"><?php echo $this->lang->line('cancel_button'); ?></a>    
                                                        <a id="modal_dist_popup_submit_button" class="btn btn-primary btn-sm"><?php echo $this->lang->line('submit_button'); ?></a>                                                          
                                                    </div>
                                                </div>
                                            </div>
                                        </form>

                                    </div>
                                </div>



                            </div>
                        </div>
                    </div>
                </div>

            </div><!--End content-->
        </div>
    </div>
</div>

<span style="display: none;" id="timeout_msg"><?php echo $distribution_message[0]->timeout_msg; ?></span>
<span style="display: none;" id="resent_msg"><?php echo $distribution_message[0]->resent_msg; ?></span>
<span style="display: none;" id="wrong_code_msg"><?php echo $distribution_message[0]->wrong_code_msg; ?></span>
<span style="display: none;" id="application_receipt_msg"><?php echo $distribution_message[0]->application_receipt_msg; ?></span>
<span style="display: none;" id="blocked_email_msg"><?php echo $distribution_message[0]->blocked_email_msg; ?></span>


<!--Modal shopping decision cart-->
<div class="modal fade" id="modal_dist_preview_popup">
    <div class="modal-dialog modal-dist-popup-width">
        <div class="modal-content modal-dist-popup-width-2">
            <div class="modal-body modal-dist-popup-width-3">
                <div class="box-content-modal modal-dist-popup-width-4">
                    <div class="container modal-dist-popup-width-5">
                        <div class="main-page">
                            <div >
                                <div class="form-fill-cart dis-form">
                                    <h2 class="title-modal text-align-center"><?php echo $this->lang->line('modal_dist_preview_popup_title'); ?></h2>
                                    <div class="modal-dist-popup-counter-styles">
                                        <div   class="clock-timer"  id="timer2"></div>                         
                                    </div>
                                    <p><?php echo $this->lang->line('modal_dist_preview_popup_header'); ?></div>
                                <div >
                                    <div class="modal-dist-popup">

                                        <form name="frm_distribution_application_preview" id="frm_id_distribution_application_preview" action="distribution/index/do_send_email" method="post" class="form-horizontal" role="form">
                                            <input type="hidden" name="edit_distribution_popup" value="true">
                                            <div class="form-group">
                                                <div class="col-md-4 col-sm-4  col-xs-12 "><strong><?php echo $this->lang->line('modal_dist_popup_company_name'); ?></strong></div>
                                                <div class="col-md-8 col-sm-8  col-xs-12 company_preview"><?php echo isset($_POST['company']) ? $_POST['company'] : ""; ?></div>
                                                <input type="hidden" class="company_preview" name="company" value="<?php echo isset($_POST['company']) ? $_POST['company'] : ""; ?>">

                                            </div>
                                            <div class="form-group">
                                                <div class="col-md-4 col-sm-4  col-xs-12 "><strong>Title</strong></div>

                                                <div class="salutation col-md-8 col-sm-8  col-xs-12"> <?php echo isset($_POST['salutation']) ? $_POST['salutation'] : ""; ?></div>
                                                <input type="hidden" class="salutation" name="salutation" value="<?php echo isset($_POST['salutation']) ? $_POST['salutation'] : ""; ?>">

                                            </div>
                                            <div class="form-group">
                                                <div class="col-md-4 col-sm-4  col-xs-12 "><strong><?php echo $this->lang->line('modal_dist_popup_applicant_name'); ?></strong></div>
                                                <div  class="applicant col-md-8 col-sm-8  col-xs-12"><?php echo isset($_POST['applicant']) ? $_POST['applicant'] : ""; ?></div>
                                                <input type="hidden" name="applicant" class="applicant" value="<?php echo isset($_POST['applicant']) ? $_POST['applicant'] : ""; ?>">

                                            </div>

                                            <div class="form-group">
                                                <div class="col-md-4 col-sm-4  col-xs-12 "><strong><?php echo $this->lang->line('modal_dist_popup_country'); ?></strong></div>
                                                <div class="col-md-8 col-sm-8  col-xs-12">
                                                    <img id="country_img" src="assets/template/images/msdropdown/icons/blank.gif" alt="Country" /><span class="hdn_country_name"><?php echo isset($_POST['hdn_country_label']) ? urldecode($_POST['hdn_country_label']) : ""; ?></span>
                                                    <input type="hidden" name="country" value="<?php echo isset($_POST['country']) ? $_POST['country'] : ""; ?>">
                                                    <input type="hidden" name="hdn_country_label" class="hdn_country_label" value="<?php echo isset($_POST['hdn_country_label']) ? $_POST['hdn_country_label'] : ""; ?>">
                                                    <input type="hidden" name="hdn_country_name" class="hdn_country_name" value="<?php echo isset($_POST['hdn_country_name']) ? $_POST['hdn_country_name'] : ""; ?>">
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="form-group">
                                                <div class="col-md-4 col-sm-4  col-xs-12 "><strong><?php echo $this->lang->line('modal_dist_popup_complete_address'); ?></strong></div>

                                                <div  class="address col-md-8 col-sm-8  col-xs-12">  <?php echo isset($_POST['address']) ? $_POST['address'] : ""; ?></div>
                                                <input type="hidden" name="address" class="address" value="<?php echo isset($_POST['address']) ? str_replace('\r', '', str_replace('\n', '', $_POST['address'])) : ""; ?>">

                                            </div>

                                            <div class="clearfix"></div>
                                            <a href="distribution.php"></a>
                                            <div class="form-group">
                                                <div class="col-md-4 col-sm-4  col-xs-12 "><strong><?php echo $this->lang->line('modal_dist_popup_designation'); ?></strong></div>
                                                <div  class="designation col-md-8 col-sm-8  col-xs-12">    
                                                    <?php echo isset($_POST['designation']) ? $_POST['designation'] : ""; ?>
                                                </div>
                                                <input type="hidden" class="designation" name="designation" value="<?php echo isset($_POST['designation']) ? $_POST['designation'] : ""; ?>">                                                    
                                            </div>

                                            <div class="form-group">
                                                <div class="col-md-4 col-sm-4   col-xs-12 "><strong><?php echo $this->lang->line('modal_dist_popup_telephone'); ?></strong></div>

                                                <div  class="telephone col-md-8 col-sm-8  col-xs-12"> <?php echo isset($_POST['telephone']) ? $_POST['telephone'] : ""; ?></div>
                                                <input type="hidden" name="telephone" class="telephone" value="<?php echo isset($_POST['telephone']) ? $_POST['telephone'] : ""; ?>">

                                            </div>

                                            <div class="clearfix"></div>
                                            <div class="form-group">
                                                <div class="col-md-4 col-sm-4  col-xs-12 "><strong><?php echo $this->lang->line('modal_dist_popup_email'); ?></strong></div>

                                                <div  class="email col-md-8 col-sm-8  col-xs-12">    <?php echo isset($_POST['email']) ? $_POST['email'] : ""; ?></div>
                                                <input type="hidden" name="email" class="email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : ""; ?>">

                                            </div>

                                            <div class="modal-dist-preview-popup-license-styles"><strong><?php echo $this->lang->line('modal_dist_preview_popup_corporate_trade_licence_copy'); ?></strong></div>
                                            <div class="form-group">
                                                <div style="width:100%;margin-left: 2%;" class="filepreview">                                                            
                                                    <input type="hidden" name="hdn_license_preview" class="hdn_license_preview" value="<?php echo $license_picture_name; ?>">
                                                    <?php echo $preview; ?>
                                                </div>
                                            </div>

                                            <div class="clearfix"></div>
                                            <fieldset class="modal-dist-popup-fieldset-width">
                                                <legend><strong><?php echo $this->lang->line('modal_dist_popup_fieldset_1'); ?></strong></legend>

                                                <div class="companysize"><?php echo isset($_POST["companysize"]) && ($_POST["companysize"] == "medium") ? $this->lang->line('modal_dist_popup_fieldset_1_1') : $this->lang->line('modal_dist_popup_fieldset_1_2'); ?></div>
                                                <?php echo form_error('companysize'); ?>
                                            </fieldset>
                                            <input type="hidden" name="companysize" class="companysize" value="<?php echo isset($_POST["companysize"]) ? $_POST["companysize"] : ""; ?>">
                                            <br>    

                                            <fieldset class="modal-dist-popup-fieldset-width">
                                                <legend><strong><?php echo $this->lang->line('modal_dist_popup_fieldset_2'); ?></strong></legend>
                                                <div class="companystart"><?php echo isset($_POST["companystart"]) ? $_POST["companystart"] : ""; ?></div>
                                            </fieldset>
                                            <br>

                                            <input type="hidden" name="companystart" class="companystart" value="<?php echo isset($_POST["companystart"]) ? $_POST["companystart"] : ""; ?>">
                                            <div class="modal-dist-popup-kgt-support"><?php echo $this->lang->line('modal_dist_popup_kgt_support_1'); ?>(<span class="company_preview"><?php echo (isset($_POST["company"]) ? $_POST["company"] : ""); ?></span>) <?php echo $this->lang->line('modal_dist_popup_kgt_support_2'); ?>(<span class="company_preview"><?php echo (isset($_POST["company"]) ? $_POST["company"] : ""); ?></span>) <?php echo $this->lang->line('modal_dist_popup_kgt_support_3'); ?></div>
                                            <div>
                                                <strong><?php echo $this->lang->line('modal_dist_popup_i_understand_1'); ?></strong>
                                            </div>
                                            <div class="loading" ></div>
                                            <div class="modal-dist-popup-fieldset-width">
                                                <strong><?php echo $this->lang->line('modal_dist_popup_sales_force_1'); ?></strong>
                                                <br><strong><?php echo $this->lang->line('modal_dist_popup_sales_force_2'); ?></strong><span class="sel_indoor_sales"><?php echo isset($_POST['sel_indoor_sales']) ? $_POST['sel_indoor_sales'] : ""; ?></span><br>
                                                <input type="hidden" name="sel_indoor_sales" class="sel_indoor_sales" value="<?php echo isset($_POST["sel_indoor_sales"]) ? $_POST["sel_indoor_sales"] : ""; ?>">
                                                <strong><?php echo $this->lang->line('modal_dist_popup_sales_force_3'); ?></strong><span class="sel_outdoor_sales"><?php echo isset($_POST['sel_outdoor_sales']) ? $_POST['sel_outdoor_sales'] : ""; ?></span><br>
                                                <input type="hidden" name="sel_outdoor_sales" class="sel_outdoor_sales" value="<?php echo isset($_POST["sel_outdoor_sales"]) ? $_POST["sel_outdoor_sales"] : ""; ?>">
                                            </div>

                                            <div class="modal-dist-popup-fieldset-width">
                                                <strong><?php echo $this->lang->line('modal_dist_popup_sales_brief'); ?></strong><br>
                                                <div class="salesbrief"> <?php echo (isset($_POST["salesbrief"]) ? $_POST["salesbrief"] : ""); ?></div>
                                                <input type="hidden" name="salesbrief" class="salesbrief" value="<?php echo (isset($_POST["salesbrief"]) ? $_POST["salesbrief"] : ""); ?>">
                                            </div>
                                            <div class="modal-dist-popup-kgt-support">
                                                <strong><?php echo $this->lang->line('modal_dist_popup_i_am_1'); ?>(<span class="applicant"><?php echo (isset($_POST["applicant"]) ? $_POST["applicant"] : ""); ?></span>) <?php echo $this->lang->line('modal_dist_popup_i_am_2'); ?>(<span class="company_preview"><?php echo (isset($_POST["company"]) ? $_POST["company"] : ""); ?></span>) <?php echo $this->lang->line('modal_dist_popup_i_am_3'); ?></strong>
                                            </div>
                                        </form> 

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="clearfix"></div>
                        <div class="nav-prex-next text-right">
                            <div class="row">
                                <div class="col-md-12">
                                    <a id="modal_dist_preview_popup_back_button" class="btn btn-primary btn-sm"><?php echo $this->lang->line('back_button'); ?></a>
                                    <a id="modal_dist_preview_popup_submit_button" class="btn btn-primary btn-sm"><?php echo $this->lang->line('submit_button'); ?></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div><!--End content-->
</div>
<script>


    $(document).ready(function() {
       
        $(document).on('change','.license', function(event) {
        
            $(".filepreview").html("");
            $(".filepreview").append("<blink><span style='margin-left:10%; color:red;'>Please wait we are generating preview ...</span>.<blink>");
       
                 
            blink(1);
        
            $.ajax("distribution/license_form_upload", {
                files: $(":file",this),
                iframe: true,
            }).success(function(data) {                            
                if(data != '')
                {
                    $("blink").remove();
                    blink(0);
                    $(".filepreview").addClass("notempty").html(data);
                }
            });

        });  

    })

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


    (function($, undefined) {
        "use strict";
        //alert("fdhd");
        // Register a prefilter that checks whether the `iframe` option is set, and
        // switches to the "iframe" data type if it is `true`.
        $.ajaxPrefilter(function(options, origOptions, jqXHR) {
            if (options.iframe) {
                options.originalURL = options.url;
                return "iframe";
            }
        });

        // Register a transport for the "iframe" data type. It will only activate
        // when the "files" option has been set to a non-empty list of enabled file
        // inputs.
        $.ajaxTransport("iframe", function(options, origOptions, jqXHR) {
            var form = null,
            iframe = null,
            name = "iframe-" + $.now(),
            files = $(options.files).filter(":file:enabled"),
            markers = null,
            accepts = null;

            // This function gets called after a successful submission or an abortion
            // and should revert all changes made to the page to enable the
            // submission via this transport.
            function cleanUp() {
                markers.prop("disabled", false);
                form.remove();
                iframe.one("load", function() { iframe.remove(); });
                iframe.attr("src", "javascript:false;");
            }

            // Remove "iframe" from the data types list so that further processing is
            // based on the content type returned by the server, without attempting an
            // (unsupported) conversion from "iframe" to the actual type.
            options.dataTypes.shift();

            // Use the data from the original AJAX options, as it doesn't seem to be 
            // copied over since jQuery 1.7.
            // See https://github.com/cmlenz/jquery-iframe-transport/issues/6
            options.data = origOptions.data;
    
            //alert(files.length);
    
            if (files.length) {
                form = $("<form enctype='multipart/form-data' method='post'></form>").
                    hide().attr({action: options.originalURL, target: name});

                // If there is any additional data specified via the `data` option,
                // we add it as hidden fields to the form. This (currently) requires
                // the `processData` option to be set to false so that the data doesn't
                // get serialized to a string.
                if (typeof(options.data) === "string" && options.data.length > 0) {
                    $.error("data must not be serialized");
                }
                $.each(options.data || {}, function(name, value) {
                    if ($.isPlainObject(value)) {
                        name = value.name;
                        value = value.value;
                    }
                    $("<input type='hidden' />").attr({name:  name, value: value}).
                        appendTo(form);
                });

                // Add a hidden `X-Requested-With` field with the value `IFrame` to the
                // field, to help server-side code to determine that the upload happened
                // through this transport.
                $("<input type='hidden' value='IFrame' name='X-Requested-With' />").
                    appendTo(form);

                // Borrowed straight from the JQuery source.
                // Provides a way of specifying the accepted data type similar to the
                // HTTP "Accept" header
                if (options.dataTypes[0] && options.accepts[options.dataTypes[0]]) {
                    accepts = options.accepts[options.dataTypes[0]] +
                        (options.dataTypes[0] !== "*" ? ", */*; q=0.01" : "");
                } else {
                    accepts = options.accepts["*"];
                }
                $("<input type='hidden' name='X-HTTP-Accept'>").
                    attr("value", accepts).appendTo(form);

                // Move the file fields into the hidden form, but first remember their
                // original locations in the document by replacing them with disabled
                // clones. This should also avoid introducing unwanted changes to the
                // page layout during submission.
                markers = files.after(function(idx) {
                    return $(this).clone();
                }).next();
                files.appendTo(form);

                return {

                    // The `send` function is called by jQuery when the request should be
                    // sent.
                    send: function(headers, completeCallback) {
                        iframe = $("<iframe src='javascript:false;' name='" + name +
                            "' id='" + name + "' style='display:none'></iframe>");

                        // The first load event gets fired after the iframe has been injected
                        // into the DOM, and is used to prepare the actual submission.
                        iframe.one("load", function() {

                            // The second load event gets fired when the response to the form
                            // submission is received. The implementation detects whether the
                            // actual payload is embedded in a `<textarea>` element, and
                            // prepares the required conversions to be made in that case.
                            iframe.one("load", function() {
                                var doc = this.contentWindow ? this.contentWindow.document :
                                    (this.contentDocument ? this.contentDocument : this.document),
                                root = doc.documentElement ? doc.documentElement : doc.body,
                                textarea = root.getElementsByTagName("textarea")[0],
                                type = textarea && textarea.getAttribute("data-type") || null,
                                status = textarea && textarea.getAttribute("data-status") || 200,
                                statusText = textarea && textarea.getAttribute("data-statusText") || "OK",
                                content = {
                                    html: root.innerHTML,
                                    text: type ?
                                        textarea.value :
                                        root ? (root.textContent || root.innerText) : null
                                };
                                cleanUp();
                                completeCallback(status, statusText, content, type ?
                                    ("Content-Type: " + type) :
                                    null);
                            });

                            // Now that the load handler has been set up, submit the form.
                            form[0].submit();
                        });

                        // After everything has been set up correctly, the form and iframe
                        // get injected into the DOM so that the submission can be
                        // initiated.
                        $("body").append(form, iframe);
                    },

                    // The `abort` function is called by jQuery when the request should be
                    // aborted.
                    abort: function() {
                        if (iframe !== null) {
                            iframe.unbind("load").attr("src", "javascript:false;");
                            cleanUp();
                        }
                    }

                };
            }
        });

    })(jQuery);

</script>

