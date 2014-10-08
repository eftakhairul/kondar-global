<link rel="stylesheet" type="text/css" href="assets/template/css/msdropdown/flags.css" />
<link rel="stylesheet" type="text/css" href="assets/template/css/msdropdown/dd.css" />
<script src="http://www.marghoobsuleman.com/misc/jquery.js"></script>
<script src="assets/template/js/msdropdown/jquery.dd.min.js"></script>
<script>
$(document).ready(function() {
	$("#countries").msDropdown();
})
</script>

	<div class="bodywrapper">
        <?php //include('include/menu1.php');
			include('/../temp/include/header_child.php'); ?>
        <?php include('include/address.php');?>


        <div class="container">
	        <div class="main-page">
	        	
        		<div class="car-lists">
        			<div class="form-fill-cart">
	        			<div class="row">
	        				<div class="col-md-6">
	        					<h3>Apply For <?php echo $apply_form['name'];?></h3>
	        					
	        					<form class="form-horizontal" role="form" method="post">
                                	<input type="hidden" name="operation" value="set">
                                          <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-6 control-label">Name and Surname</label>
                                            <div class="col-sm-6">
                                              <input type="text" class="form-control" name="name" id="inputEmail3" placeholder="Name and Surname" value="<?php echo set_value('name'); ?>">
                                            <span style="color:#F00;"><?php echo form_error('name'); ?></span>

                                            </div>
                                          </div>
                                          <div class="form-group">
                                            <label for="inputPassword3" class="col-sm-6 control-label">Country</label>
                                            <div class="col-sm-6">
                                              <!--<input type="text" class="form-control" id="inputPassword3" name="country" placeholder="Country">-->
                                              <select name="country" id="countries" style="width:255px;">
  <option value='Andorra' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag ad" data-title="Andorra">Andorra</option>
  <option value='United Arab Emirates' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag ae" data-title="United Arab Emirates">United Arab Emirates</option>
  <option value='Afghanistan' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag af" data-title="Afghanistan">Afghanistan</option>
  <option value='Antigua and Barbuda' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag ag" data-title="Antigua and Barbuda">Antigua and Barbuda</option>
  <option value='Anguilla' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag ai" data-title="Anguilla">Anguilla</option>
  <option value='Albania' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag al" data-title="Albania">Albania</option>
  <option value='Armenia' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag am" data-title="Armenia">Armenia</option>
  <option value='Netherlands Antilles' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag an" data-title="Netherlands Antilles">Netherlands Antilles</option>
  <option value='Angola' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag ao" data-title="Angola">Angola</option>
  <option value='Antarctica' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag aq" data-title="Antarctica">Antarctica</option>
  <option value='Argentina' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag ar" data-title="Argentina">Argentina</option>
  <option value='American Samoa' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag as" data-title="American Samoa">American Samoa</option>
  <option value='Austria' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag at" data-title="Austria">Austria</option>
  <option value='Australia' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag au" data-title="Australia">Australia</option>
  <option value='Aruba' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag aw" data-title="Aruba">Aruba</option>
  <option value='Aland Islands' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag ax" data-title="Aland Islands">Aland Islands</option>
  <option value='Azerbaijan' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag az" data-title="Azerbaijan">Azerbaijan</option>
  <option value='Bosnia and Herzegovina' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag ba" data-title="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
  <option value='Barbados' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag bb" data-title="Barbados">Barbados</option>
  <option value='Bangladesh' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag bd" data-title="Bangladesh">Bangladesh</option>
  <option value='Belgium' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag be" data-title="Belgium">Belgium</option>
  <option value='Burkina Faso' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag bf" data-title="Burkina Faso">Burkina Faso</option>
  <option value='Bulgaria' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag bg" data-title="Bulgaria">Bulgaria</option>
  <option value='Bahrain' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag bh" data-title="Bahrain">Bahrain</option>
  <option value='Burundi' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag bi" data-title="Burundi">Burundi</option>
  <option value='Benin' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag bj" data-title="Benin">Benin</option>
  <option value='Bermuda' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag bm" data-title="Bermuda">Bermuda</option>
  <option value='Brunei Darussalam' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag bn" data-title="Brunei Darussalam">Brunei Darussalam</option>
  <option value='Bolivia' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag bo" data-title="Bolivia">Bolivia</option>
  <option value='Brazil' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag br" data-title="Brazil">Brazil</option>
  <option value='Bahamas' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag bs" data-title="Bahamas">Bahamas</option>
  <option value='Bhutan' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag bt" data-title="Bhutan">Bhutan</option>
  <option value='Bouvet Island' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag bv" data-title="Bouvet Island">Bouvet Island</option>
  <option value='Botswana' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag bw" data-title="Botswana">Botswana</option>
  <option value='Belarus' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag by" data-title="Belarus">Belarus</option>
  <option value='Belize' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag bz" data-title="Belize">Belize</option>
  <option value='Canada' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag ca" data-title="Canada">Canada</option>
  <option value='Cocos (Keeling) Islands' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag cc" data-title="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>
  <option value='Democratic Republic of the Congo' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag cd" data-title="Democratic Republic of the Congo">Democratic Republic of the Congo</option>
  <option value='Central African Republic' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag cf" data-title="Central African Republic">Central African Republic</option>
  <option value='Congo' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag cg" data-title="Congo">Congo</option>
  <option value='Switzerland' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag ch" data-title="Switzerland">Switzerland</option>
  <option value='Cote D Ivoire (Ivory Coast)' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag ci" data-title="Cote D'Ivoire (Ivory Coast)">Cote D'Ivoire (Ivory Coast)</option>
  <option value='Cook Islands' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag ck" data-title="Cook Islands">Cook Islands</option>
  <option value='Chile' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag cl" data-title="Chile">Chile</option>
  <option value='Cameroon' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag cm" data-title="Cameroon">Cameroon</option>
  <option value='China' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag cn" data-title="China">China</option>
  <option value='Colombia' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag co" data-title="Colombia">Colombia</option>
  <option value='Costa Rica' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag cr" data-title="Costa Rica">Costa Rica</option>
  <option value='Serbia and Montenegro' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag cs" data-title="Serbia and Montenegro">Serbia and Montenegro</option>
  <option value='Cuba' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag cu" data-title="Cuba">Cuba</option>
  <option value='Cape Verde' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag cv" data-title="Cape Verde">Cape Verde</option>
  <option value='Christmas Island' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag cx" data-title="Christmas Island">Christmas Island</option>
  <option value='Cyprus' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag cy" data-title="Cyprus">Cyprus</option>
  <option value='Czech Republic' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag cz" data-title="Czech Republic">Czech Republic</option>
  <option value='Germany' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag de" data-title="Germany">Germany</option>
  <option value='Djibouti' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag dj" data-title="Djibouti">Djibouti</option>
  <option value='Denmark' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag dk" data-title="Denmark">Denmark</option>
  <option value='Dominica' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag dm" data-title="Dominica">Dominica</option>
  <option value='Dominican Republic' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag do" data-title="Dominican Republic">Dominican Republic</option>
  <option value='Algeria' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag dz" data-title="Algeria">Algeria</option>
  <option value='Ecuador' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag ec" data-title="Ecuador">Ecuador</option>
  <option value='Estonia' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag ee" data-title="Estonia">Estonia</option>
  <option value='Egypt' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag eg" data-title="Egypt">Egypt</option>
  <option value='Western Sahara' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag eh" data-title="Western Sahara">Western Sahara</option>
  <option value='Eritrea' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag er" data-title="Eritrea">Eritrea</option>
  <option value='Spain' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag es" data-title="Spain">Spain</option>
  <option value='Ethiopia' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag et" data-title="Ethiopia">Ethiopia</option>
  <option value='Finland' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag fi" data-title="Finland">Finland</option>
  <option value='Fiji' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag fj" data-title="Fiji">Fiji</option>
  <option value='Falkland Islands (Malvinas)' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag fk" data-title="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option>
  <option value='Federated States of Micronesia' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag fm" data-title="Federated States of Micronesia">Federated States of Micronesia</option>
  <option value='Faroe Islands' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag fo" data-title="Faroe Islands">Faroe Islands</option>
  <option value='France' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag fr" data-title="France">France</option>
  <option value='France, Metropolitan' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag fx" data-title="France, Metropolitan">France, Metropolitan</option>
  <option value='Gabon' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag ga" data-title="Gabon">Gabon</option>
  <option value='Great Britain (UK)' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag gb" data-title="Great Britain (UK)">Great Britain (UK)</option>
  <option value='Grenada' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag gd" data-title="Grenada">Grenada</option>
  <option value='Georgia' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag ge" data-title="Georgia">Georgia</option>
  <option value='French Guiana' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag gf" data-title="French Guiana">French Guiana</option>
  <option value='Ghana' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag gh" data-title="Ghana">Ghana</option>
  <option value='Gibraltar' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag gi" data-title="Gibraltar">Gibraltar</option>
  <option value='Greenland' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag gl" data-title="Greenland">Greenland</option>
  <option value='Gambia' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag gm" data-title="Gambia">Gambia</option>
  <option value='Guinea' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag gn" data-title="Guinea">Guinea</option>
  <option value='Guadeloupe' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag gp" data-title="Guadeloupe">Guadeloupe</option>
  <option value='Equatorial Guinea' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag gq" data-title="Equatorial Guinea">Equatorial Guinea</option>
  <option value='Greece' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag gr" data-title="Greece">Greece</option>
  <option value='S. Georgia and S. Sandwich Islands' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag gs" data-title="S. Georgia and S. Sandwich Islands">S. Georgia and S. Sandwich Islands</option>
  <option value='Guatemala' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag gt" data-title="Guatemala">Guatemala</option>
  <option value='Guam' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag gu" data-title="Guam">Guam</option>
  <option value='Guinea-Bissau' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag gw" data-title="Guinea-Bissau">Guinea-Bissau</option>
  <option value='Guyana' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag gy" data-title="Guyana">Guyana</option>
  <option value='Hong Kong' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag hk" data-title="Hong Kong">Hong Kong</option>
  <option value='Heard Island and McDonald Islands' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag hm" data-title="Heard Island and McDonald Islands">Heard Island and McDonald Islands</option>
  <option value='Honduras' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag hn" data-title="Honduras">Honduras</option>
  <option value='Croatia (Hrvatska)' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag hr" data-title="Croatia (Hrvatska)">Croatia (Hrvatska)</option>
  <option value='Haiti' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag ht" data-title="Haiti">Haiti</option>
  <option value='Hungary' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag hu" data-title="Hungary">Hungary</option>
  <option value='Indonesia' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag id" data-title="Indonesia">Indonesia</option>
  <option value='Ireland' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag ie" data-title="Ireland">Ireland</option>
  <option value='Israel' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag il" data-title="Israel">Israel</option>
  <option value='India' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag in" data-title="India" selected="selected">India</option>
  <option value='British Indian Ocean Territory' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag io" data-title="British Indian Ocean Territory">British Indian Ocean Territory</option>
  <option value='Iraq' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag iq" data-title="Iraq">Iraq</option>
  <option value='Iran' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag ir" data-title="Iran">Iran</option>
  <option value='Iceland' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag is" data-title="Iceland">Iceland</option>
  <option value='Italy' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag it" data-title="Italy">Italy</option>
  <option value='Jamaica' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag jm" data-title="Jamaica">Jamaica</option>
  <option value='Jordan' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag jo" data-title="Jordan">Jordan</option>
  <option value='Japan' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag jp" data-title="Japan">Japan</option>
  <option value='Kenya' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag ke" data-title="Kenya">Kenya</option>
  <option value='Kyrgyzstan' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag kg" data-title="Kyrgyzstan">Kyrgyzstan</option>
  <option value='Cambodia' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag kh" data-title="Cambodia">Cambodia</option>
  <option value='Kiribati' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag ki" data-title="Kiribati">Kiribati</option>
  <option value='Comoros' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag km" data-title="Comoros">Comoros</option>
  <option value='Saint Kitts and Nevis' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag kn" data-title="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
  <option value='Korea (North)' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag kp" data-title="Korea (North)">Korea (North)</option>
  <option value='Korea (South)' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag kr" data-title="Korea (South)">Korea (South)</option>
  <option value='Kuwait' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag kw" data-title="Kuwait">Kuwait</option>
  <option value='Cayman Islands' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag ky" data-title="Cayman Islands">Cayman Islands</option>
  <option value='Kazakhstan' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag kz" data-title="Kazakhstan">Kazakhstan</option>
  <option value='Laos' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag la" data-title="Laos">Laos</option>
  <option value='Lebanon' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag lb" data-title="Lebanon">Lebanon</option>
  <option value='Saint Lucia' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag lc" data-title="Saint Lucia">Saint Lucia</option>
  <option value='Liechtenstein' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag li" data-title="Liechtenstein">Liechtenstein</option>
  <option value='Sri Lanka' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag lk" data-title="Sri Lanka">Sri Lanka</option>
  <option value='Liberia' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag lr" data-title="Liberia">Liberia</option>
  <option value='Lesotho' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag ls" data-title="Lesotho">Lesotho</option>
  <option value='Lithuania' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag lt" data-title="Lithuania">Lithuania</option>
  <option value='Luxembourg' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag lu" data-title="Luxembourg">Luxembourg</option>
  <option value='Latvia' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag lv" data-title="Latvia">Latvia</option>
  <option value='Libya' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag ly" data-title="Libya">Libya</option>
  <option value='Morocco' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag ma" data-title="Morocco">Morocco</option>
  <option value='Monaco' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag mc" data-title="Monaco">Monaco</option>
  <option value='Moldova' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag md" data-title="Moldova">Moldova</option>
  <option value='Madagascar' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag mg" data-title="Madagascar">Madagascar</option>
  <option value='Marshall Islands' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag mh" data-title="Marshall Islands">Marshall Islands</option>
  <option value='Macedonia' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag mk" data-title="Macedonia">Macedonia</option>
  <option value='Mali' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag ml" data-title="Mali">Mali</option>
  <option value='Myanmar' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag mm" data-title="Myanmar">Myanmar</option>
  <option value='Mongolia' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag mn" data-title="Mongolia">Mongolia</option>
  <option value='Macao' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag mo" data-title="Macao">Macao</option>
  <option value='Northern Mariana Islands' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag mp" data-title="Northern Mariana Islands">Northern Mariana Islands</option>
  <option value='Martinique' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag mq" data-title="Martinique">Martinique</option>
  <option value='Mauritania' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag mr" data-title="Mauritania">Mauritania</option>
  <option value='Montserrat' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag ms" data-title="Montserrat">Montserrat</option>
  <option value='Malta' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag mt" data-title="Malta">Malta</option>
  <option value='Mauritius' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag mu" data-title="Mauritius">Mauritius</option>
  <option value='Maldives' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag mv" data-title="Maldives">Maldives</option>
  <option value='Malawi' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag mw" data-title="Malawi">Malawi</option>
  <option value='Mexico' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag mx" data-title="Mexico">Mexico</option>
  <option value='Malaysia' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag my" data-title="Malaysia">Malaysia</option>
  <option value='Mozambique' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag mz" data-title="Mozambique">Mozambique</option>
  <option value='Namibia' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag na" data-title="Namibia">Namibia</option>
  <option value='New Caledonia' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag nc" data-title="New Caledonia">New Caledonia</option>
  <option value='Niger' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag ne" data-title="Niger">Niger</option>
  <option value='Norfolk Island' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag nf" data-title="Norfolk Island">Norfolk Island</option>
  <option value='Nigeria' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag ng" data-title="Nigeria">Nigeria</option>
  <option value='Nicaragua' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag ni" data-title="Nicaragua">Nicaragua</option>
  <option value='Netherlands' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag nl" data-title="Netherlands">Netherlands</option>
  <option value='Norway' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag no" data-title="Norway">Norway</option>
  <option value='Nepal' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag np" data-title="Nepal">Nepal</option>
  <option value='Nauru' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag nr" data-title="Nauru">Nauru</option>
  <option value='Niue' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag nu" data-title="Niue">Niue</option>
  <option value='New Zealand (Aotearoa)' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag nz" data-title="New Zealand (Aotearoa)">New Zealand (Aotearoa)</option>
  <option value='Oman' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag om" data-title="Oman">Oman</option>
  <option value='Panama' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag pa" data-title="Panama">Panama</option>
  <option value='Peru' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag pe" data-title="Peru">Peru</option>
  <option value='French Polynesia' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag pf" data-title="French Polynesia">French Polynesia</option>
  <option value='Papua New Guinea' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag pg" data-title="Papua New Guinea">Papua New Guinea</option>
  <option value='Philippines' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag ph" data-title="Philippines">Philippines</option>
  <option value='Pakistan' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag pk" data-title="Pakistan">Pakistan</option>
  <option value='Poland' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag pl" data-title="Poland">Poland</option>
  <option value='Saint Pierre and Miquelon' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag pm" data-title="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
  <option value='Pitcairn' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag pn" data-title="Pitcairn">Pitcairn</option>
  <option value='Puerto Rico' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag pr" data-title="Puerto Rico">Puerto Rico</option>
  <option value='Palestinian Territory' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag ps" data-title="Palestinian Territory">Palestinian Territory</option>
  <option value='Portugal' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag pt" data-title="Portugal">Portugal</option>
  <option value='Palau' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag pw" data-title="Palau">Palau</option>
  <option value='Paraguay' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag py" data-title="Paraguay">Paraguay</option>
  <option value='Qatar' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag qa" data-title="Qatar">Qatar</option>
  <option value='Reunion' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag re" data-title="Reunion">Reunion</option>
  <option value='Romania' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag ro" data-title="Romania">Romania</option>
  <option value='Russian Federation' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag ru" data-title="Russian Federation">Russian Federation</option>
  <option value='Rwanda' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag rw" data-title="Rwanda">Rwanda</option>
  <option value='Saudi Arabia' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag sa" data-title="Saudi Arabia">Saudi Arabia</option>
  <option value='Solomon Islands' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag sb" data-title="Solomon Islands">Solomon Islands</option>
  <option value='Seychelles' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag sc" data-title="Seychelles">Seychelles</option>
  <option value='Sudan' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag sd" data-title="Sudan">Sudan</option>
  <option value='Sweden' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag se" data-title="Sweden">Sweden</option>
  <option value='Singapore' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag sg" data-title="Singapore">Singapore</option>
  <option value='Saint Helena' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag sh" data-title="Saint Helena">Saint Helena</option>
  <option value='Slovenia' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag si" data-title="Slovenia">Slovenia</option>
  <option value='Svalbard and Jan Mayen' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag sj" data-title="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option>
  <option value='Slovakia' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag sk" data-title="Slovakia">Slovakia</option>
  <option value='Sierra Leone' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag sl" data-title="Sierra Leone">Sierra Leone</option>
  <option value='San Marino' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag sm" data-title="San Marino">San Marino</option>
  <option value='Senegal' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag sn" data-title="Senegal">Senegal</option>
  <option value='Somalia' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag so" data-title="Somalia">Somalia</option>
  <option value='Suriname' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag sr" data-title="Suriname">Suriname</option>
  <option value='Sao Tome and Principe' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag st" data-title="Sao Tome and Principe">Sao Tome and Principe</option>
  <option value='USSR (former)' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag su" data-title="USSR (former)">USSR (former)</option>
  <option value='El Salvador' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag sv" data-title="El Salvador">El Salvador</option>
  <option value='Syria' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag sy" data-title="Syria">Syria</option>
  <option value='Swaziland' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag sz" data-title="Swaziland">Swaziland</option>
  <option value='Turks and Caicos Islands' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag tc" data-title="Turks and Caicos Islands">Turks and Caicos Islands</option>
  <option value='Chad' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag td" data-title="Chad">Chad</option>
  <option value='French Southern Territories' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag tf" data-title="French Southern Territories">French Southern Territories</option>
  <option value='Togo' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag tg" data-title="Togo">Togo</option>
  <option value='Thailand' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag th" data-title="Thailand">Thailand</option>
  <option value='Tajikistan' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag tj" data-title="Tajikistan">Tajikistan</option>
  <option value='Tokelau' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag tk" data-title="Tokelau">Tokelau</option>
  <option value='Timor-Leste' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag tl" data-title="Timor-Leste">Timor-Leste</option>
  <option value='Turkmenistan' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag tm" data-title="Turkmenistan">Turkmenistan</option>
  <option value='Tunisia' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag tn" data-title="Tunisia">Tunisia</option>
  <option value='Tonga' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag to" data-title="Tonga">Tonga</option>
  <option value='East Timor' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag tp" data-title="East Timor">East Timor</option>
  <option value='Turkey' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag tr" data-title="Turkey">Turkey</option>
  <option value='Trinidad and Tobago' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag tt" data-title="Trinidad and Tobago">Trinidad and Tobago</option>
  <option value='Tuvalu' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag tv" data-title="Tuvalu">Tuvalu</option>
  <option value='Taiwan' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag tw" data-title="Taiwan">Taiwan</option>
  <option value='Tanzania' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag tz" data-title="Tanzania">Tanzania</option>
  <option value='Ukraine' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag ua" data-title="Ukraine">Ukraine</option>
  <option value='Uganda' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag ug" data-title="Uganda">Uganda</option>
  <option value='United Kingdom' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag uk" data-title="United Kingdom">United Kingdom</option>
  <option value='United States Minor Outlying Islands' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag um" data-title="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
  <option value='United States' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag us" data-title="United States">United States</option>
  <option value='Uruguay' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag uy" data-title="Uruguay">Uruguay</option>
  <option value='Uzbekistan' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag uz" data-title="Uzbekistan">Uzbekistan</option>
  <option value='Vatican City State (Holy See)' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag va" data-title="Vatican City State (Holy See)">Vatican City State (Holy See)</option>
  <option value='Saint Vincent and the Grenadines' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag vc" data-title="Saint Vincent and the Grenadines">Saint Vincent and the Grenadines</option>
  <option value='Venezuela' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag ve" data-title="Venezuela">Venezuela</option>
  <option value='Virgin Islands (British)' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag vg" data-title="Virgin Islands (British)">Virgin Islands (British)</option>
  <option value='Virgin Islands (U.S.)' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag vi" data-title="Virgin Islands (U.S.)">Virgin Islands (U.S.)</option>
  <option value='Viet Nam' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag vn" data-title="Viet Nam">Viet Nam</option>
  <option value='Vanuatu' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag vu" data-title="Vanuatu">Vanuatu</option>
  <option value='Wallis and Futuna' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag wf" data-title="Wallis and Futuna">Wallis and Futuna</option>
  <option value='Samoa' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag ws" data-title="Samoa">Samoa</option>
  <option value='Yemen' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag ye" data-title="Yemen">Yemen</option>
  <option value='Mayotte' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag yt" data-title="Mayotte">Mayotte</option>
  <option value='Yugoslavia (former' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag yu" data-title="Yugoslavia (former)">Yugoslavia (former)</option>
  <option value='South Africa' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag za" data-title="South Africa">South Africa</option>
  <option value='Zambia' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag zm" data-title="Zambia">Zambia</option>
  <option value='Zaire (former)' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag zr" data-title="Zaire (former)">Zaire (former)</option>
  <option value='Zimbabwe' data-image="assets/template/images/msdropdown/icons/blank.gif" data-imagecss="flag zw" data-title="Zimbabwe">Zimbabwe</option>
</select>
                                            </div>
                                          </div>
                                          
                                          <!--<div class="form-group">
                                            <label for="inputPassword3" class="col-sm-6 control-label">Country</label>
                                            <div class="col-sm-6">
                                                  <select name="country" class="form-control" style="height:35px">
                                                      <option value="">Select a country</option>
                                                  </select>
                                            </div>
                                          </div>-->
                                          <div class="form-group">
                                            <label for="inputPassword3" class="col-sm-6 control-label">Telephone</label>
                                            <div class="col-sm-6">
                                              <input type="text" class="form-control" name="contact" id="inputPassword3" placeholder="Telephone" value="<?php echo set_value('contact');?>">
                                              <span style="color:#F00;"><?php echo form_error('contact'); ?></span>

                                            </div>
                                          </div>
                                          
                                          <div class="form-group">
                                            <label for="inputPassword3" class="col-sm-6 control-label">Email</label>
                                            <div class="col-sm-6">
                                              <input type="text" class="form-control" id="inputPassword3" placeholder="Email" name="email" value="<?php echo set_value('email'); ?>">
                                              <span style="color:#F00;"><?php echo form_error('email'); ?></span>                                              
                                            </div>
                                        </div>
                                          <div class="form-group">&nbsp;
                                            <div class="col-sm-6">
                                          <input type="submit" value="Apply" class="btn btn-primary btn-sm"/>
                                            </div>
                                        </div>
                                </form>
<?php
if($this->session->flashdata('success')) {
    $msg = $this->session->flashdata('success');
?>
    <div class="notice outer">
      <div class="note"><?php echo $msg;?>
      </div>
    </div>
<?php
}
?>    
<?php
if($this->session->flashdata('error')) {
    $msg = $this->session->flashdata('error');
?>
    <div class="notice outer">
      <div class="error"><?php echo $msg;?>
      </div>
    </div>
<?php
}
?>    

	        				</div>
	        				
	        			</div>
        			</div>	        		
	        	</div>
	        </div><!--End content-->
    	</div>

    	

