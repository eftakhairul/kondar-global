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
    $(document).ready(function() {
        blink(1);
        data_show_from_session();

    });

    function data_show_from_session() {
        var name = '<?php if ($block_email_info[0]->name != "") echo $block_email_info[0]->name;
else echo ""; ?>';
        if (name != "") {
            var split_name = name.split(".");
            $('#salutation option[value="' + split_name[0] + '"]').prop('selected', true);
            var split_name_space = name.split(" ");
            $("#name").val(split_name_space[1]);

        }
        var email = '<?php if ($block_email_info[0]->email != "") echo $block_email_info[0]->email;
else echo ""; ?>';
        if (email != "") {
            $("#email").val(email);
            contact_timer("edit");
        }
        var company = '<?php if ($block_email_info[0]->company != "") echo $block_email_info[0]->company;
else echo ""; ?>';
        if (company != "") {
            $("#company").val(company);
        }
        var branch = '<?php if ($block_email_info[0]->branch != "") echo $block_email_info[0]->branch;
else echo ""; ?>';
        if (branch != "") {
            $('#branch option[value="' + branch + '"]').prop('selected', true);
        }
        var designation = '<?php if ($block_email_info[0]->designation != "") echo $block_email_info[0]->designation;
else echo ""; ?>';
        if (designation != "") {
            $("#designation").val(designation);
        }
        var country = '<?php if ($block_email_info[0]->country != "") echo $block_email_info[0]->country;
else echo ""; ?>';
        if (country != "") {
            $('#country option[value="' + country + '"]').prop('selected', true);
        }
        var contact = '<?php if ($block_email_info[0]->contact != "") echo $block_email_info[0]->contact;
else echo ""; ?>';
        if (contact != "") {
            $("#contact_num").val(contact);
        }
        var message = '<?php if ($block_email_info[0]->message != "") echo $block_email_info[0]->message;
else echo ""; ?>';
        if (message != "") {
            $("#message").val(message);
        }


    }
  
</script> 

<div class="container">
    <div class="main-page contact-us-page">
        <div class="car-lists">
            <div class="form-fill-cart dis-form" style="margin-top:30px">
                <div class="row">
                    <div class="col-md-5">
                        <div class="contact-opacity">
                            <h5 style="margin:0px;">Head Office:</h5>
                            <div style="margin-left:50px">
                                <p>7339 Macpherson Avenue, Office 405 </p>
                                <p>Burnaby, British Columbia </p> V5J0B1, Canada 
                                <p>TEL/FAX: <b>+16043608805</b></p>
                            </div>	
                        </div>
                        <div style="color: white;font-size: 15px;font-weight: bold;" id="contact_msg"></div>
                        <div id="countdownplace" style="margin-left: 2%;text-align: right;"></div>
                        <div class="contact-opacity">
                            <form class="form-horizontal" id="myForm" role="form" method="post" >
                                <input type="hidden" id="operation" name="operation" value="set">
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Branch</label>
                                    <div class="col-md-8 controls">
                                        <select  name="branch" id="branch" style="width:100%;">                                              
                                            <option value='Canada-Vancouver' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag ca" data-title="Andorra">Canada, Vancouver</option>
                                            <option value='UK-London' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag gb" data-title="United Arab Emirates">UK, London</option>
                                            <option value='UAE-Dubai' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag ae" data-title="Afghanistan">UAE, Dubai</option>
                                            <option value='Tunisia-Tunis' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag tn" data-title="Antigua and Barbuda">Tunisia, Tunis</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Title</label>
                                    <div class="col-md-8 controls">
                                        <select class="col-md-12" name="salutation" id="salutation" style="width:100%;padding: 0;">                                              
                                            <option value='Mr'  data-title="Mr">Mr.</option>
                                            <option value='Ms'  data-title="Ms">Ms.</option>
                                        </select>
                                    </div>
                                </div>                    

                                <div class="form-group">
                                    <label class="col-md-4 control-label" style="padding:0px 0px 0px 15px">Name and Surname</label>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" name="name" id="name" placeholder="Name and Surname"  required >
                                        <span style="color:#F00;"><?php echo form_error('name'); ?></span>

                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Company</label>
                                    <div class="col-md-8">
                                        <input type="text" name="company" id="company" class="form-control" placeholder="Company" required>
                                        <span style="color:#F00;"><?php echo form_error('company'); ?></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Designation</label>
                                    <div class="col-md-8">
                                        <input type="text" name="designation" id="designation" class="form-control" placeholder="Designation" required>
                                        <span style="color:#F00;"><?php echo form_error('designation'); ?></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Country</label>
                                    <div class="col-md-8 country_content">
                                      <!--<input type="text" class="form-control" id="inputPassword3" name="country" placeholder="Country">-->
                                        <select name="country" id="countries" style="width:100%; display:none;" >
                                            <option value='Andorra' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag ad" data-title="Andorra">Andorra</option>
                                            <option value='United Arab Emirates' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag ae" data-title="United Arab Emirates">United Arab Emirates</option>
                                            <option value='Afghanistan' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag af" data-title="Afghanistan">Afghanistan</option>
                                            <option value='Antigua and Barbuda' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag ag" data-title="Antigua and Barbuda">Antigua and Barbuda</option>
                                            <option value='Anguilla' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag ai" data-title="Anguilla">Anguilla</option>
                                            <option value='Albania' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag al" data-title="Albania">Albania</option>
                                            <option value='Armenia' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag am" data-title="Armenia">Armenia</option>
                                            <option value='Netherlands Antilles' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag an" data-title="Netherlands Antilles">Netherlands Antilles</option>
                                            <option value='Angola' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag ao" data-title="Angola">Angola</option>
                                            <option value='Antarctica' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag aq" data-title="Antarctica">Antarctica</option>
                                            <option value='Argentina' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag ar" data-title="Argentina">Argentina</option>
                                            <option value='American Samoa' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag as" data-title="American Samoa">American Samoa</option>
                                            <option value='Austria' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag at" data-title="Austria">Austria</option>
                                            <option value='Australia' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag au" data-title="Australia">Australia</option>
                                            <option value='Aruba' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag aw" data-title="Aruba">Aruba</option>
                                            <option value='Aland Islands' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag ax" data-title="Aland Islands">Aland Islands</option>
                                            <option value='Azerbaijan' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag az" data-title="Azerbaijan">Azerbaijan</option>
                                            <option value='Bosnia and Herzegovina' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag ba" data-title="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                                            <option value='Barbados' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag bb" data-title="Barbados">Barbados</option>
                                            <option value='Bangladesh' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag bd" data-title="Bangladesh">Bangladesh</option>
                                            <option value='Belgium' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag be" data-title="Belgium">Belgium</option>
                                            <option value='Burkina Faso' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag bf" data-title="Burkina Faso">Burkina Faso</option>
                                            <option value='Bulgaria' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag bg" data-title="Bulgaria">Bulgaria</option>
                                            <option value='Bahrain' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag bh" data-title="Bahrain">Bahrain</option>
                                            <option value='Burundi' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag bi" data-title="Burundi">Burundi</option>
                                            <option value='Benin' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag bj" data-title="Benin">Benin</option>
                                            <option value='Bermuda' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag bm" data-title="Bermuda">Bermuda</option>
                                            <option value='Brunei Darussalam' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag bn" data-title="Brunei Darussalam">Brunei Darussalam</option>
                                            <option value='Bolivia' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag bo" data-title="Bolivia">Bolivia</option>
                                            <option value='Brazil' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag br" data-title="Brazil">Brazil</option>
                                            <option value='Bahamas' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag bs" data-title="Bahamas">Bahamas</option>
                                            <option value='Bhutan' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag bt" data-title="Bhutan">Bhutan</option>
                                            <option value='Bouvet Island' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag bv" data-title="Bouvet Island">Bouvet Island</option>
                                            <option value='Botswana' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag bw" data-title="Botswana">Botswana</option>
                                            <option value='Belarus' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag by" data-title="Belarus">Belarus</option>
                                            <option value='Belize' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag bz" data-title="Belize">Belize</option>
                                            <option value='Canada' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag ca" data-title="Canada" selected="selected">Canada</option>
                                            <option value='Cocos (Keeling) Islands' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag cc" data-title="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>
                                            <option value='Democratic Republic of the Congo' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag cd" data-title="Democratic Republic of the Congo">Democratic Republic of the Congo</option>
                                            <option value='Central African Republic' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag cf" data-title="Central African Republic">Central African Republic</option>
                                            <option value='Congo' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag cg" data-title="Congo">Congo</option>
                                            <option value='Switzerland' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag ch" data-title="Switzerland">Switzerland</option>
                                            <option value='Cote D Ivoire (Ivory Coast)' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag ci" data-title="Cote D'Ivoire (Ivory Coast)">Cote D'Ivoire (Ivory Coast)</option>
                                            <option value='Cook Islands' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag ck" data-title="Cook Islands">Cook Islands</option>
                                            <option value='Chile' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag cl" data-title="Chile">Chile</option>
                                            <option value='Cameroon' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag cm" data-title="Cameroon">Cameroon</option>
                                            <option value='China' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag cn" data-title="China">China</option>
                                            <option value='Colombia' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag co" data-title="Colombia">Colombia</option>
                                            <option value='Costa Rica' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag cr" data-title="Costa Rica">Costa Rica</option>
                                            <option value='Serbia and Montenegro' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag cs" data-title="Serbia and Montenegro">Serbia and Montenegro</option>
                                            <option value='Cuba' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag cu" data-title="Cuba">Cuba</option>
                                            <option value='Cape Verde' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag cv" data-title="Cape Verde">Cape Verde</option>
                                            <option value='Christmas Island' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag cx" data-title="Christmas Island">Christmas Island</option>
                                            <option value='Cyprus' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag cy" data-title="Cyprus">Cyprus</option>
                                            <option value='Czech Republic' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag cz" data-title="Czech Republic">Czech Republic</option>
                                            <option value='Germany' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag de" data-title="Germany">Germany</option>
                                            <option value='Djibouti' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag dj" data-title="Djibouti">Djibouti</option>
                                            <option value='Denmark' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag dk" data-title="Denmark">Denmark</option>
                                            <option value='Dominica' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag dm" data-title="Dominica">Dominica</option>
                                            <option value='Dominican Republic' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag do" data-title="Dominican Republic">Dominican Republic</option>
                                            <option value='Algeria' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag dz" data-title="Algeria">Algeria</option>
                                            <option value='Ecuador' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag ec" data-title="Ecuador">Ecuador</option>
                                            <option value='Estonia' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag ee" data-title="Estonia">Estonia</option>
                                            <option value='Egypt' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag eg" data-title="Egypt">Egypt</option>
                                            <option value='Western Sahara' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag eh" data-title="Western Sahara">Western Sahara</option>
                                            <option value='Eritrea' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag er" data-title="Eritrea">Eritrea</option>
                                            <option value='Spain' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag es" data-title="Spain">Spain</option>
                                            <option value='Ethiopia' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag et" data-title="Ethiopia">Ethiopia</option>
                                            <option value='Finland' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag fi" data-title="Finland">Finland</option>
                                            <option value='Fiji' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag fj" data-title="Fiji">Fiji</option>
                                            <option value='Falkland Islands (Malvinas)' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag fk" data-title="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option>
                                            <option value='Federated States of Micronesia' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag fm" data-title="Federated States of Micronesia">Federated States of Micronesia</option>
                                            <option value='Faroe Islands' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag fo" data-title="Faroe Islands">Faroe Islands</option>
                                            <option value='France' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag fr" data-title="France">France</option>
                                            <option value='France, Metropolitan' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag fx" data-title="France, Metropolitan">France, Metropolitan</option>
                                            <option value='Gabon' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag ga" data-title="Gabon">Gabon</option>
                                            <option value='Great Britain (UK)' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag gb" data-title="Great Britain (UK)">Great Britain (UK)</option>
                                            <option value='Grenada' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag gd" data-title="Grenada">Grenada</option>
                                            <option value='Georgia' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag ge" data-title="Georgia">Georgia</option>
                                            <option value='French Guiana' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag gf" data-title="French Guiana">French Guiana</option>
                                            <option value='Ghana' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag gh" data-title="Ghana">Ghana</option>
                                            <option value='Gibraltar' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag gi" data-title="Gibraltar">Gibraltar</option>
                                            <option value='Greenland' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag gl" data-title="Greenland">Greenland</option>
                                            <option value='Gambia' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag gm" data-title="Gambia">Gambia</option>
                                            <option value='Guinea' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag gn" data-title="Guinea">Guinea</option>
                                            <option value='Guadeloupe' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag gp" data-title="Guadeloupe">Guadeloupe</option>
                                            <option value='Equatorial Guinea' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag gq" data-title="Equatorial Guinea">Equatorial Guinea</option>
                                            <option value='Greece' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag gr" data-title="Greece">Greece</option>
                                            <option value='S. Georgia and S. Sandwich Islands' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag gs" data-title="S. Georgia and S. Sandwich Islands">S. Georgia and S. Sandwich Islands</option>
                                            <option value='Guatemala' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag gt" data-title="Guatemala">Guatemala</option>
                                            <option value='Guam' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag gu" data-title="Guam">Guam</option>
                                            <option value='Guinea-Bissau' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag gw" data-title="Guinea-Bissau">Guinea-Bissau</option>
                                            <option value='Guyana' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag gy" data-title="Guyana">Guyana</option>
                                            <option value='Hong Kong' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag hk" data-title="Hong Kong">Hong Kong</option>
                                            <option value='Heard Island and McDonald Islands' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag hm" data-title="Heard Island and McDonald Islands">Heard Island and McDonald Islands</option>
                                            <option value='Honduras' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag hn" data-title="Honduras">Honduras</option>
                                            <option value='Croatia (Hrvatska)' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag hr" data-title="Croatia (Hrvatska)">Croatia (Hrvatska)</option>
                                            <option value='Haiti' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag ht" data-title="Haiti">Haiti</option>
                                            <option value='Hungary' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag hu" data-title="Hungary">Hungary</option>
                                            <option value='Indonesia' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag id" data-title="Indonesia">Indonesia</option>
                                            <option value='Ireland' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag ie" data-title="Ireland">Ireland</option>
                                            <option value='Israel' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag il" data-title="Israel">Israel</option>
                                            <option value='India' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag in" data-title="India" >India</option>
                                            <option value='British Indian Ocean Territory' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag io" data-title="British Indian Ocean Territory">British Indian Ocean Territory</option>
                                            <option value='Iraq' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag iq" data-title="Iraq">Iraq</option>
                                            <option value='Iran' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag ir" data-title="Iran">Iran</option>
                                            <option value='Iceland' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag is" data-title="Iceland">Iceland</option>
                                            <option value='Italy' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag it" data-title="Italy">Italy</option>
                                            <option value='Jamaica' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag jm" data-title="Jamaica">Jamaica</option>
                                            <option value='Jordan' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag jo" data-title="Jordan">Jordan</option>
                                            <option value='Japan' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag jp" data-title="Japan">Japan</option>
                                            <option value='Kenya' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag ke" data-title="Kenya">Kenya</option>
                                            <option value='Kyrgyzstan' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag kg" data-title="Kyrgyzstan">Kyrgyzstan</option>
                                            <option value='Cambodia' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag kh" data-title="Cambodia">Cambodia</option>
                                            <option value='Kiribati' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag ki" data-title="Kiribati">Kiribati</option>
                                            <option value='Comoros' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag km" data-title="Comoros">Comoros</option>
                                            <option value='Saint Kitts and Nevis' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag kn" data-title="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                                            <option value='Korea (North)' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag kp" data-title="Korea (North)">Korea (North)</option>
                                            <option value='Korea (South)' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag kr" data-title="Korea (South)">Korea (South)</option>
                                            <option value='Kuwait' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag kw" data-title="Kuwait">Kuwait</option>
                                            <option value='Cayman Islands' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag ky" data-title="Cayman Islands">Cayman Islands</option>
                                            <option value='Kazakhstan' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag kz" data-title="Kazakhstan">Kazakhstan</option>
                                            <option value='Laos' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag la" data-title="Laos">Laos</option>
                                            <option value='Lebanon' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag lb" data-title="Lebanon">Lebanon</option>
                                            <option value='Saint Lucia' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag lc" data-title="Saint Lucia">Saint Lucia</option>
                                            <option value='Liechtenstein' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag li" data-title="Liechtenstein">Liechtenstein</option>
                                            <option value='Sri Lanka' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag lk" data-title="Sri Lanka">Sri Lanka</option>
                                            <option value='Liberia' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag lr" data-title="Liberia">Liberia</option>
                                            <option value='Lesotho' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag ls" data-title="Lesotho">Lesotho</option>
                                            <option value='Lithuania' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag lt" data-title="Lithuania">Lithuania</option>
                                            <option value='Luxembourg' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag lu" data-title="Luxembourg">Luxembourg</option>
                                            <option value='Latvia' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag lv" data-title="Latvia">Latvia</option>
                                            <option value='Libya' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag ly" data-title="Libya">Libya</option>
                                            <option value='Morocco' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag ma" data-title="Morocco">Morocco</option>
                                            <option value='Monaco' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag mc" data-title="Monaco">Monaco</option>
                                            <option value='Moldova' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag md" data-title="Moldova">Moldova</option>
                                            <option value='Madagascar' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag mg" data-title="Madagascar">Madagascar</option>
                                            <option value='Marshall Islands' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag mh" data-title="Marshall Islands">Marshall Islands</option>
                                            <option value='Macedonia' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag mk" data-title="Macedonia">Macedonia</option>
                                            <option value='Mali' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag ml" data-title="Mali">Mali</option>
                                            <option value='Myanmar' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag mm" data-title="Myanmar">Myanmar</option>
                                            <option value='Mongolia' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag mn" data-title="Mongolia">Mongolia</option>
                                            <option value='Macao' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag mo" data-title="Macao">Macao</option>
                                            <option value='Northern Mariana Islands' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag mp" data-title="Northern Mariana Islands">Northern Mariana Islands</option>
                                            <option value='Martinique' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag mq" data-title="Martinique">Martinique</option>
                                            <option value='Mauritania' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag mr" data-title="Mauritania">Mauritania</option>
                                            <option value='Montserrat' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag ms" data-title="Montserrat">Montserrat</option>
                                            <option value='Malta' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag mt" data-title="Malta">Malta</option>
                                            <option value='Mauritius' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag mu" data-title="Mauritius">Mauritius</option>
                                            <option value='Maldives' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag mv" data-title="Maldives">Maldives</option>
                                            <option value='Malawi' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag mw" data-title="Malawi">Malawi</option>
                                            <option value='Mexico' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag mx" data-title="Mexico">Mexico</option>
                                            <option value='Malaysia' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag my" data-title="Malaysia">Malaysia</option>
                                            <option value='Mozambique' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag mz" data-title="Mozambique">Mozambique</option>
                                            <option value='Namibia' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag na" data-title="Namibia">Namibia</option>
                                            <option value='New Caledonia' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag nc" data-title="New Caledonia">New Caledonia</option>
                                            <option value='Niger' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag ne" data-title="Niger">Niger</option>
                                            <option value='Norfolk Island' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag nf" data-title="Norfolk Island">Norfolk Island</option>
                                            <option value='Nigeria' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag ng" data-title="Nigeria">Nigeria</option>
                                            <option value='Nicaragua' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag ni" data-title="Nicaragua">Nicaragua</option>
                                            <option value='Netherlands' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag nl" data-title="Netherlands">Netherlands</option>
                                            <option value='Norway' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag no" data-title="Norway">Norway</option>
                                            <option value='Nepal' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag np" data-title="Nepal">Nepal</option>
                                            <option value='Nauru' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag nr" data-title="Nauru">Nauru</option>
                                            <option value='Niue' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag nu" data-title="Niue">Niue</option>
                                            <option value='New Zealand (Aotearoa)' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag nz" data-title="New Zealand (Aotearoa)">New Zealand (Aotearoa)</option>
                                            <option value='Oman' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag om" data-title="Oman">Oman</option>
                                            <option value='Panama' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag pa" data-title="Panama">Panama</option>
                                            <option value='Peru' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag pe" data-title="Peru">Peru</option>
                                            <option value='French Polynesia' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag pf" data-title="French Polynesia">French Polynesia</option>
                                            <option value='Papua New Guinea' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag pg" data-title="Papua New Guinea">Papua New Guinea</option>
                                            <option value='Philippines' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag ph" data-title="Philippines">Philippines</option>
                                            <option value='Pakistan' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag pk" data-title="Pakistan">Pakistan</option>
                                            <option value='Poland' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag pl" data-title="Poland">Poland</option>
                                            <option value='Saint Pierre and Miquelon' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag pm" data-title="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
                                            <option value='Pitcairn' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag pn" data-title="Pitcairn">Pitcairn</option>
                                            <option value='Puerto Rico' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag pr" data-title="Puerto Rico">Puerto Rico</option>
                                            <option value='Palestinian Territory' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag ps" data-title="Palestinian Territory">Palestinian Territory</option>
                                            <option value='Portugal' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag pt" data-title="Portugal">Portugal</option>
                                            <option value='Palau' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag pw" data-title="Palau">Palau</option>
                                            <option value='Paraguay' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag py" data-title="Paraguay">Paraguay</option>
                                            <option value='Qatar' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag qa" data-title="Qatar">Qatar</option>
                                            <option value='Reunion' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag re" data-title="Reunion">Reunion</option>
                                            <option value='Romania' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag ro" data-title="Romania">Romania</option>
                                            <option value='Russian Federation' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag ru" data-title="Russian Federation">Russian Federation</option>
                                            <option value='Rwanda' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag rw" data-title="Rwanda">Rwanda</option>
                                            <option value='Saudi Arabia' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag sa" data-title="Saudi Arabia">Saudi Arabia</option>
                                            <option value='Solomon Islands' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag sb" data-title="Solomon Islands">Solomon Islands</option>
                                            <option value='Seychelles' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag sc" data-title="Seychelles">Seychelles</option>
                                            <option value='Sudan' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag sd" data-title="Sudan">Sudan</option>
                                            <option value='Sweden' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag se" data-title="Sweden">Sweden</option>
                                            <option value='Singapore' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag sg" data-title="Singapore">Singapore</option>
                                            <option value='Saint Helena' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag sh" data-title="Saint Helena">Saint Helena</option>
                                            <option value='Slovenia' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag si" data-title="Slovenia">Slovenia</option>
                                            <option value='Svalbard and Jan Mayen' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag sj" data-title="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option>
                                            <option value='Slovakia' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag sk" data-title="Slovakia">Slovakia</option>
                                            <option value='Sierra Leone' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag sl" data-title="Sierra Leone">Sierra Leone</option>
                                            <option value='San Marino' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag sm" data-title="San Marino">San Marino</option>
                                            <option value='Senegal' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag sn" data-title="Senegal">Senegal</option>
                                            <option value='Somalia' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag so" data-title="Somalia">Somalia</option>
                                            <option value='Suriname' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag sr" data-title="Suriname">Suriname</option>
                                            <option value='Sao Tome and Principe' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag st" data-title="Sao Tome and Principe">Sao Tome and Principe</option>
                                            <option value='USSR (former)' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag su" data-title="USSR (former)">USSR (former)</option>
                                            <option value='El Salvador' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag sv" data-title="El Salvador">El Salvador</option>
                                            <option value='Syria' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag sy" data-title="Syria">Syria</option>
                                            <option value='Swaziland' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag sz" data-title="Swaziland">Swaziland</option>
                                            <option value='Turks and Caicos Islands' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag tc" data-title="Turks and Caicos Islands">Turks and Caicos Islands</option>
                                            <option value='Chad' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag td" data-title="Chad">Chad</option>
                                            <option value='French Southern Territories' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag tf" data-title="French Southern Territories">French Southern Territories</option>
                                            <option value='Togo' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag tg" data-title="Togo">Togo</option>
                                            <option value='Thailand' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag th" data-title="Thailand">Thailand</option>
                                            <option value='Tajikistan' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag tj" data-title="Tajikistan">Tajikistan</option>
                                            <option value='Tokelau' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag tk" data-title="Tokelau">Tokelau</option>
                                            <option value='Timor-Leste' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag tl" data-title="Timor-Leste">Timor-Leste</option>
                                            <option value='Turkmenistan' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag tm" data-title="Turkmenistan">Turkmenistan</option>
                                            <option value='Tunisia' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag tn" data-title="Tunisia">Tunisia</option>
                                            <option value='Tonga' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag to" data-title="Tonga">Tonga</option>
                                            <option value='East Timor' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag tp" data-title="East Timor">East Timor</option>
                                            <option value='Turkey' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag tr" data-title="Turkey">Turkey</option>
                                            <option value='Trinidad and Tobago' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag tt" data-title="Trinidad and Tobago">Trinidad and Tobago</option>
                                            <option value='Tuvalu' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag tv" data-title="Tuvalu">Tuvalu</option>
                                            <option value='Taiwan' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag tw" data-title="Taiwan">Taiwan</option>
                                            <option value='Tanzania' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag tz" data-title="Tanzania">Tanzania</option>
                                            <option value='Ukraine' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag ua" data-title="Ukraine">Ukraine</option>
                                            <option value='Uganda' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag ug" data-title="Uganda">Uganda</option>
                                            <option value='United Kingdom' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag uk" data-title="United Kingdom">United Kingdom</option>
                                            <option value='United States Minor Outlying Islands' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag um" data-title="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
                                            <option value='United States' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag us" data-title="United States">United States</option>
                                            <option value='Uruguay' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag uy" data-title="Uruguay">Uruguay</option>
                                            <option value='Uzbekistan' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag uz" data-title="Uzbekistan">Uzbekistan</option>
                                            <option value='Vatican City State (Holy See)' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag va" data-title="Vatican City State (Holy See)">Vatican City State (Holy See)</option>
                                            <option value='Saint Vincent and the Grenadines' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag vc" data-title="Saint Vincent and the Grenadines">Saint Vincent and the Grenadines</option>
                                            <option value='Venezuela' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag ve" data-title="Venezuela">Venezuela</option>
                                            <option value='Virgin Islands (British)' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag vg" data-title="Virgin Islands (British)">Virgin Islands (British)</option>
                                            <option value='Virgin Islands (U.S.)' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag vi" data-title="Virgin Islands (U.S.)">Virgin Islands (U.S.)</option>
                                            <option value='Viet Nam' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag vn" data-title="Viet Nam">Viet Nam</option>
                                            <option value='Vanuatu' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag vu" data-title="Vanuatu">Vanuatu</option>
                                            <option value='Wallis and Futuna' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag wf" data-title="Wallis and Futuna">Wallis and Futuna</option>
                                            <option value='Samoa' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag ws" data-title="Samoa">Samoa</option>
                                            <option value='Yemen' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag ye" data-title="Yemen">Yemen</option>
                                            <option value='Mayotte' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag yt" data-title="Mayotte">Mayotte</option>
                                            <option value='Yugoslavia (former' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag yu" data-title="Yugoslavia (former)">Yugoslavia (former)</option>
                                            <option value='South Africa' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag za" data-title="South Africa">South Africa</option>
                                            <option value='Zambia' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag zm" data-title="Zambia">Zambia</option>
                                            <option value='Zaire (former)' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag zr" data-title="Zaire (former)">Zaire (former)</option>
                                            <option value='Zimbabwe' data-image="<?= global_img_link('blank.gif', 'template/images/msdropdown/icons/') ?>" data-imagecss="flag zw" data-title="Zimbabwe">Zimbabwe</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Telephone</label>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" name="contact" id="contact_num" placeholder="Telephone" required>
                                        <span style="color:#F00;"><?php echo form_error('contact'); ?></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Email</label>
                                    <div class="col-md-8">
                                        <input type="email" class="form-control" placeholder="Email" name="email" id="email" required onblur="block_email_check();">
                                        <span style="color:#F00;"><?php echo form_error('email'); ?></span>                                              
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Message</label>
                                    <div class="col-md-8">
                                        <textarea class="form-control" name="message" id="message" placeholder="Message" required></textarea>
                                    </div>
                                </div>
                                <div class="form-group btn_rightalign">&nbsp;
                                    <div class="col-md-12">
                                        <input type="submit" value="Submit" class="btn btn-primary btn-sm"/>
                                    </div>
                                </div>
                                <div class="clear"></div>
                            </form>            
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="div-map">
                            <img src="<?= global_img_link('bg-map.png', 'template/images/') ?>" alt="map" class="img-responsive" />
                            <img src="<?= global_img_link('0.gif', 'template/') ?>" alt="" width="20" height="20"  style="position:relative;top:-294px;left:75px;"  title="Canada, Vancouver Tel: +1-604-360-8805">  
                            <img src="<?= global_img_link('0.gif', 'template/') ?>" alt="" width="20" height="20"  style="position:relative;top:-294px;left:251px;"  title="UK, London Tel: +44-7455-224987"> 
                            <img src="<?= global_img_link('0.gif', 'template/') ?>" alt="" width="20" height="20"  style="position:relative;top:-259px;left:246px;"  title="Tunisia, Tunis Tel: +216-20-999-851"> 
                            <img src="<?= global_img_link('0.gif', 'template/') ?>" alt="" width="20" height="20"  style="position:relative;top:-233px;left:305px;"  title="UAE, Dubai Tel: +971-56-297-2148"> 
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
                    <h2 class="title-modal" style="float:left">Contact Us Form Preview</h2>
                    <div style="color: black;float: right; margin-right: 5%;font-size: 15px;font-weight: bold;" id="contact_preview__msg"></div>
                    <div id="contact_view_timer" style="float:right;margin-left: 0 !important;width:34%; margin-top: 2%;"></div>
                    <div style="clear:both"></div>
                    <div class="show_data"></div>
                    <div class="clearfix"></div>
                    <div class="btn-modal">				      				
                        <br />
                        <div class="row">
                            <div class="col-xs-4 col-md-4 text-center">
                                <a href="#" class="btn btn-primary btn-sm" id="send_form">Send <i class="glyphicon glyphicon-chevron-right"></i></a>
                            </div>
                            <div class="col-xs-4 col-md-4 text-center">
                                <a style="float:right" href="javascript:void(0)" id="edit_bttn" class="btn btn-primary btn-sm">EDIT <i class="glyphicon glyphicon-chevron-right"></i></a>	
                            </div>
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

<div class="modal fade" id="modal_success">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title">Modal title</h4>
            </div> -->
            <div class="modal-body">
                <div class="box-content-modal">
                    <h2 class="title-modal">Success</h2>
                    <p id="success_msge"></p>
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
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<div class="modal fade" id="modal_error">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title">Modal title</h4>
            </div> -->
            <div class="modal-body">
                <div class="box-content-modal">
                    <h2 class="title-modal blink">Warning: </h2>
                    <p id="contact_form_error_msge"></p>
                    <div class="clearfix"></div>
                    <div class="btn-modal">
                        <a style="float:right" href="javascript:void(0)" id="error_bttn" onClick="$('#modal_error').modal('hide')" class="btn btn-primary btn-sm">OK <i class="glyphicon glyphicon-chevron-right"></i></a>	
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
<!--block msge-->                
<div class="modal fade" id="modal_block1">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title">Modal title</h4>
            </div> -->
            <div class="modal-body">
                <div class="box-content-modal">
                    <h2 class="title-modal blink">Warning: </h2>
<?php
$email = $this->session->flashdata("email_address");
?>
                    <p><?php echo preg_replace('/\bPHRASE\b/', $user_data['email'], $contact_msg[0]['refreshed_msg']); ?></p>
                    <div class="clearfix"></div>
                    <div class="btn-modal">
                        <a style="float:right" href="javascript:void(0)" onClick="$('#modal_block1').modal('hide');" class="block_bttn1 btn btn-primary btn-sm">OK <i class="glyphicon glyphicon-chevron-right"></i></a>	
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


<div class="modal fade" id="timeout_modal_block">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title">Modal title</h4>
            </div> -->
            <div class="modal-body">
                <div class="box-content-modal">
                    <h2 class="title-modal blink">Warning: </h2>

                        <?php
                        $user_data = $this->session->userdata('new_session');

                        $msg = preg_replace('/\bPHRASE\b/', $user_data['email'], $contact_msg[0]['preview_timeout']);//"Unfortunately, you did not accomplish the required task within the given lead-time.  Therefore, you will be welcome to use an alternative email or wait for 120 minutes to use the current email " . $user_data['email'] . " within our website. ";
                        ?>
                    <p><?php echo $msg; ?></p>
                    <div class="clearfix"></div>
                    <div class="btn-modal">
                        <a style="float:right" href="javascript:void(0)"  onClick="$('.modal').modal('hide');
                                if (typeof clock !== 'undefined') {
                                    clock.reset();
                                }
                                $('#countdownplace').html('');
                                contact_timer('edit');" class="block_bttn1 btn btn-primary btn-sm">OK <i class="glyphicon glyphicon-chevron-right"></i></a>	
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


<div class="modal fade" id="block_email_check_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title">Modal title</h4>
            </div> -->
            <div class="modal-body">
                <div class="box-content-modal">
                    <h2 class="title-modal blink">Warning: </h2>


                    <p id="block_message"></p>
                    <div class="clearfix"></div>
                    <div class="btn-modal">
                        <a style="float:right" href="javascript:void(0)"  onClick="$('.modal').modal('hide');
                                if (typeof clock !== 'undefined') {
                                    clock.reset();
                                }
                                contact_timer('edit');" class="block_bttn1 btn btn-primary btn-sm">OK <i class="glyphicon glyphicon-chevron-right"></i></a>	
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


<div class="modal fade" id="block_email_timeout_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title">Modal title</h4>
            </div> -->
            <div class="modal-body">
                <div class="box-content-modal">
                    <h2 class="title-modal blink">Warning: </h2>


                    <p id="timeout_msg"></p>
                    <div class="clearfix"></div>
                    <div class="btn-modal">
                        
                        <a style="float:right" href="javascript:void(0)"  onClick="$('.modal').modal('hide');
                                if (typeof clock !== 'undefined') {
                                    clock.reset();
                                }
                                document.location.href = '<?php echo site_url("contact")?>';" class="block_bttn1 btn btn-primary btn-sm">OK <i class="glyphicon glyphicon-chevron-right"></i></a>	
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
