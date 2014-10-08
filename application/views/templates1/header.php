<!doctype html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>
<?php
if(isset($title)){
	   echo $title; 
}
?>
</title>
<base href="<?php echo base_url();?>">
<link rel="stylesheet" type="text/css" href="assets/template/css/bootstrap.css" media="screen">
<link rel="stylesheet" type="text/css" href="assets/template/css/font-awesome.css">
<link rel="stylesheet" type="text/css" href="assets/template/css/bootstrap-select.css">
<link rel="stylesheet" type="text/css" href="assets/template/css/style.css">
<link rel="stylesheet" type="text/css" href="assets/template/css/style_repos.css" media="screen">
<script type="text/javascript" src="assets/template/js/jquery.js"></script>
<script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script type="text/javascript" src="assets/template/js/bootstrap.js"></script>
<script type="text/javascript" src="assets/template/js/lang_select.js"></script>
<script type="text/javascript" src="assets/template/js/bootstrap-select.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    $('#polyglotLanguageSwitcher').polyglotLanguageSwitcher({
        effect: 'fade',
        testMode: true,
        onChange: function(evt){
            alert("The selected language is: "+evt.selectedItem);
        }
    });
    $('.selectpicker').selectpicker();
});
</script>



</head>
<body>
	<div class="bodywrapper">
        <div class="container">
            
        	<div class="header">
                
                <div>
                    <div class="row" style="min-height:130px;">
                        <div class="col-md-3">
            	           <a class="logo" href="front/home"><img src="assets/template/images/logo.png" alt="logo" style="float:left;" /></a>
                        </div>
                        <div class="col-md-6 col-xs-5 block-bg-header hidden-xs">
                           <a href="<?=base_url()?>products"> <img src="assets/template/images/logo-pic.png" alt=""> </a>   
                        </div>
                        <div class="col-md-3">
                            <div class="ddl">
                               <div class="language_container">
                                    <div id="polyglotLanguageSwitcher">
                                        <form action="#">
                                            <select id="polyglot-language-options">
                                                <option id="en" value="en" selected>English</option>
                                                <option id="fr" value="fr">Fran&ccedil;ais</option>
                                                <option id="de" value="de">Deutsch</option>
                                                <option id="it" value="it">Italiano</option>
                                                <option id="es" value="es">Espa&ntilde;ol</option>
                                            </select>
                                        </form>
                                    </div>
                                </div>

                                <div class="box">
                     		        <label   style="font-family: arial; font-size: 12px; font-weight: bold; padding-left: -1px;">Wednesday. February 12, 2014</label> <hr  style="margin-top: 1px; margin-bottom:0px;" />
                                    <label    style="font-family: arial; font-size: 12px; font-weight: bold; letter-spacing: 3px; padding-left: 1px;">11&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;&nbsp;34&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;&nbsp;PM</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                
                <div class="row">
                    <div class="text-header">
                        <div class="col-md-3 col-md-offset-2 text-right text-1">
                            <h3 style="margin-top:0px"><a href="<?=base_url()?>promotion/view_promotion/41">We Export Around the Globe</a></h3>
                        </div>
                        <div class="col-md-3 col-md-offset-1 text-right text-2">
                            <h4>
                            <a href="front/home/distribution">Apply for A Distribution Agrement </a> 
                        </h4>
                        </div>
                        <div class="col-md-3">
                            <div class="searchdiv">
                                <input id="Search" type="text" name="Articles" placeholder="Search For Articles"/> 
                            </div>
                        </div>
                    
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div>
                            <nav class="navbar navbar-default menu" role="navigation">
                              <div class="container-fluid">
                                <!-- Brand and toggle get grouped for better mobile display -->
                                <div class="navbar-header">
                                  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                                    <span class="sr-only">Toggle navigation</span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                  </button>
                                  <!-- <a class="navbar-brand" href="#">Navigation</a> -->
                                </div>

                                <!-- Collect the nav links, forms, and other content for toggling -->
                                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                                      <ul class="nav navbar-nav parent">
                                            <li class="dropdown">
                                              <a href="front/home" class="dropdown-toggle" data-toggle="dropdown">Home <b class="caret"></b></a>
                                                  <ul class="dropdown-menu">
                                                    <li><a href="front/home/career">Career</a></li>
                                                    <li><a href="front/home/contact_us">Contact Us</a></li>
                                                  </ul>
                                            </li>
                                            
                                            <li class="dropdown">
                                                <a href="front/home/product" class="dropdown-toggle" data-toggle="dropdown">
                                                    Products <b class="caret"></b>
                                                </a>
                                                <ul class="dropdown-menu">
                                                    <!-- <li><a href="product.php" class="cars" style="background:none"><b>PRODUCT</b></a></li>
                                                    <li class="divider"></li> -->
                                                    <li><a href="front/home/car" class="cars">Cars</a></li>
                                                    <li><a href="front/home/car" class="van">Van & Pickup</a></li>
                                                    <li><a href="front/home/truck" class="truck">Truck & Bus</a></li>
                                                    <li><a href="front/home/truck" class="others">Others</a></li>
                                                </ul>
                                            </li>
                                            <li>
                                                <a href="front/home/promotion">Promotion Section</a>
                                            </li>
                                            <li class="dropdown">
                                                <a href="front/home/Login" class="dropdown-toggle" data-toggle="dropdown">
                                                    Client Section <b class="caret"></b>
                                                </a>
                                                <ul class="dropdown-menu">
                                                    <li><a href="front/home/Login" >Follow Up Order</a></li>
                                                    <li><a href="front/home/Login" >Warranty Claim</a></li>
                                                    <li><a href="front/home/Login" >Instant RFQ</a></li>
                                                </ul>
                                            </li>
                                            <li class="dropdown"><a href="front/home/Login" class="dropdown-toggle" data-toggle="dropdown">Supplier & Investor Section <b class="caret"></b></a>
                                                <ul class="dropdown-menu">
                                                    <li><a href="front/home/Login" >Supplier</a></li>
                                                    <li><a href="front/home/Login">Investor</a></li>
                                                </ul>
                                            </li>
                                            <li>
                                            <a href="front/home/cart_brakepad_final_empty"><img src="assets/template/images/cart.png" alt="cart" /> Cart</a>
                                            </li>
                                      </ul>
                                  
                                </div><!-- /.navbar-collapse -->
                              </div><!-- /.container-fluid -->
                            </nav>
                        </div>
                    </div>
                </div>
                

                <div class="slider">
                    <img src="assets/template/images/slider-1.jpg" alt="" class="img-responsive" style="width:100%">   
                </div>
            </div>
        </div>

        <div class="container">
        <div class="main-content" style="padding-bottom:20px; background-color: #ebebeb;">
            <div class="container" style="margin-top: -63px;">
                <div class="row">
                    <div class="col-md-12" style="display:inline-block; width:100%">
                        
                        <div class="row">
                            <div class="adv_srch"  style="margin-top:10px;">
                                <div class="col-md-2"><h4 style="padding-top: 0px"> Advance Search </h4></div>
                                <div class="col-md-9">
                                    <!-- <div class="ad_srch1" style="width:126px;">
                                        <select>
                                            <option value="eng" class="opt1">Products 1</option>
                                            <option value="eng" class="opt1">Products 2</option>
                                        </select>
                                    </div> -->
                                    <div class="box-list-select" style="display:inline-block; width:100%; margin-top:-3px">
                                        <div class="col-md-3">

                                            <select class="form-control selectpicker">
                                                <option value="eng" class="opt1">Products 1</option>
                                                <option value="eng" class="opt1">Products 2</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <select class="form-control selectpicker">
                                              <option value="eng" class="opt1">Ceramic Brake Pads</option>
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <select class="form-control selectpicker">
                                              <option value="eng" class="opt1">Car</option>
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <select class="form-control selectpicker">
                                              <option value="eng" class="opt1">Toyota</option>
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <select class="form-control selectpicker">
                                              <option value="eng" class="opt1">Land Crusier</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-1 fix-btn-search-ad">
                                    <button  type="button" class="btn btn-primary btn-search-ad">search</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!--End Adv-search-->


                <a href="#"><img src="assets/template/images/chat.png" alt="chat" style="margin-top: -65px; margin-left: -331px; display:none" /></a>
                <div class="clearfix"></div>
                <div class="row" style="margin-top:30px;">

                    <div class="col-md-3 container_left" style="position:relative">
                    	<div class="box-sp">
                            <img src="assets/template/images/call_center_women.png" alt="girl" style="float:left; height:88px;" />
                            <div class="support_24_7">

                                <h1 class="in_support_24_7">24/7</h1>
                                <div style="margin-top:-10px">
                                    <span  style="font-family: arial; font-weight: bold; font-size: 18px;">Support</span>
                                    <img src="assets/template/images/Email_icon.png" alt="email"  style="margin-bottom: 9px; " />
                                </div>
                            </div>
                        </div>
                            
                        <div class="left_side">
                        
                           <a href="#">
                           
                         <h1 style="color: white; font-family: arial; font-size: 17px; padding-top: 4px; padding-left: 34px;">GET FREE QUOTE NOW</h1>
                            <div style="margin-top: -13px; padding-left: 3px;">
                            <div style="padding-top: 12px; padding-left: 4px; width: 25px;">
                                <img src="assets/template/images/flag_1.png" alt="" />
                            </div>
                            <div style="padding-left: 44px; margin-top: -20px;">
                                <!-- <span style="color: white; font-family: arial; font-size: 10px; font-weight: bold; padding-top: 21px; text-align: start;">VANCOUVER <br /> 23:59:00, Monday<span> -->
                                <span  style="color: white; font-family: arial; font-weight: bold; padding-top: 21px; text-align: start; font-size: 12px;">VANCOUVER <br /></span>
                                <span style="color: white; font-family: arial; padding-top: 21px; text-align: start; font-size: 9px;">23:59:00, Monday</span>
                            </div>
                            <div style="width: 7px; padding-left: 138px; margin-top: -19px;">
                                <img src="assets/template/images/horizental_seperator.png" />
                            </div>
                            <div  style="padding-left: 152px; margin-top: -40px;">
                                 <!-- <span style="color: white; font-family: arial; font-size: 10px; font-weight: bold; padding-top: 21px; text-align: start;">&nbsp; &nbsp; &nbsp;+1-604-360-8805 <br /> DECEMBER 15, 2013</span></div> -->
                                    <span  style="color: white; font-family: arial; padding-top: 21px; font-size: 11px; font-weight: bold;">+1-604-360-8805 <br> </span>
                                    <span  style="color: white; font-family: arial; font-weight: bold; padding-top: 21px; font-size: 8px; letter-spacing: 0.5px;"> DECEMBER 15, 2013</span>
                              </div>
                            <div style="margin-top: 3px; margin-left: 66px;"><img src="assets/template/images/left_seperator.png" alt="" /></div>
                            
                            
                            <div style="padding-top: 12px; padding-left: 4px; width: 25px;"><img src="assets/template/images/flag_2.png" alt="" /></div>
                            <div style="padding-left: 42px; margin-top: -40px;">
                                <span  style="color: white; font-family: arial; font-weight: bold; padding-top: 21px; text-align: start; font-size: 12px;">LONDON <br /></span>
                                <span style="color: white; font-family: arial; padding-top: 21px; text-align: start; font-size: 9px;">23:59:00, Monday</span>
                            </div>
                            <div style="width: 7px; padding-left: 138px; margin-top: -19px;"><img src="assets/template/images/horizental_seperator.png" /></div>
                            <div  style="padding-left: 152px;  margin-top: -41px;">
                                   <span  style="color: white; font-family: arial; padding-top: 21px; font-size: 11px; font-weight: bold;">+1-604-360-8805 <br> </span>
                                    <span  style="color: white; font-family: arial; font-weight: bold; padding-top: 21px; font-size: 8px; letter-spacing: 0.5px;"> DECEMBER 15, 2013</span>
                            </div>
                            <div style="margin-top: 6px; margin-left: 66px;"><img src="assets/template/images/left_seperator.png" alt="" /></div>
                            
                            <div style="padding-top: 12px; padding-left: 4px; width: 25px;"><img src="assets/template/images/flag_3.png" alt="" /></div>
                            <div style=" padding-left: 41px; margin-top: -40px;">
                                <span  style="color: white; font-family: arial; font-weight: bold; padding-top: 21px; text-align: start; font-size: 12px;">DUBAI <br /></span>
                                <span style="color: white; font-family: arial; padding-top: 21px; text-align: start; font-size: 9px;">23:59:00, Monday</span>
                           </div>
                            </div>
                            <div style="width: 7px; padding-left: 138px; margin-top: -19px;"><img src="assets/template/images/horizental_seperator.png" /></div>
                            <div  style="padding-left: 152px;  margin-top: -41px;">
                                   <span  style="color: white; font-family: arial; padding-top: 21px; font-size: 11px; font-weight: bold;">+1-604-360-8805 <br> </span>
                                    <span  style="color: white; font-family: arial; font-weight: bold; padding-top: 21px; font-size: 8px; letter-spacing: 0.5px;"> DECEMBER 15, 2013</span>
                            </div>
                            <div style="margin-top: 6px; margin-left: 66px;"><img src="assets/template/images/left_seperator.png" alt="" /></div>
                            
                            <div style="padding-top: 12px; padding-left: 4px; width: 25px;"><img src="assets/template/images/flag_4.png" alt="" /></div>
                            <div style=" padding-left: 41px; margin-top: -41px;">
                                <span  style="color: white; font-family: arial; font-weight: bold; padding-top: 21px; text-align: start; font-size: 12px;">TUNIS <br /></span>
                                <span style="color: white; font-family: arial; padding-top: 21px; text-align: start; font-size: 9px;">23:59:00, Monday</span>
                            </div>
                            <div style="width: 7px; padding-left: 138px; margin-top: -19px;"><img src="assets/template/images/horizental_seperator.png" /></div>
                            <div  style="padding-left: 152px; ; margin-top: -41px; padding-bottom:5px;">
                                   <span  style="color: white; font-family: arial; padding-top: 21px; font-size: 11px; font-weight: bold;">+1-604-360-8805 <br> </span>
                                    <span  style="color: white; font-family: arial; font-weight: bold; padding-top: 21px; font-size: 8px; letter-spacing: 0.5px;"> DECEMBER 15, 2013</span>
                            </div>
                            
                            
                           
                                
                            
                           
                            </a>
                                <span style="color: white; font-family: arial; font-size: 10px; font-weight: bold; padding-top: 21px; text-align: start;"></span>
                            
                            </div>
                       </div>
                    <div class="col-md-6">
                        <div class="container_center">
                        	<div class="about">
            	               <h2 style="font-family: arial; color: #de0200; height: 8px; font-size: 18px; font-weight: bold;">ABOUT KGT</h2>
                            	<p>  
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, 
                                
                                </p>
                            </div>
                            <div class="mission">
            	               <h2 style="font-family: arial; height: 8px; color: #de0200; font-size: 18px; font-weight: bold; text-transform: uppercase;  margin-top: -14px;">Mission</h2>
            					<p>  
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, 
                                
                                </p>
            				</div>
                            <div class="vision">
            	               <h2 style="font-family: arial; color: #de0200; font-size: 18px; font-weight: bold; text-transform: uppercase;  margin-top: -14px; height:8px;">Vision</h2>
                            	<p>  
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, 
                                
                                </p>
                            </div>
                        	
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="container_right">
                        <!-- <img src="assets/template/images/bussiness_women.png" alt=" " style="float: right; margin-top: -154px; margin-right: -2px;" /> -->
                              <a href="#">  <div class="box1">
                                <img src="assets/template/images/warranty_icon.png" alt="" />
                                	<h6> Get Free Shipping Now </h6>
                                </div>  </a>
                                
                                
                             <a href="#" >  <div class="box2">
                                <img src="assets/template/images/Laptop_icon.png" alt="" />
                                <h6> Win a Laptop </h6>
                                </div></a>
                        
                        
                            <a href="#"><div class="box3">
                                <img src="assets/template/images/Free_shipping_icon.png" alt="" />
                            <h6> Discover our Warranty </h6>
                            </div></a>
                        
                        
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="slider2">
                                <img src="assets/template/images/button1.png" alt="" style=" box-shadow: -3px -4px 3px gray;  margin-left: 14px; margin-top: -8px;" />
                            
                            </div>
                        </div>
                    </div>
            </div>
        </div><!--End content-->
        </div>

        <div class="footer">
            <div class="container">
                
                <div class="footer_wrap">
                    <div class="row">
                        <div class="col-md-2">
                            <div class="fb1">
                                <div>
                                    <ul style="list-style: none outside none; float: left; line-height: 25px; font-size: 12px; padding: 0px 6px; color: white; font-family: arial;">
                                        <li><span style="font-size: 18px;  font-weight: bold;">Client</span></li>
                                        <li><a href="#">Follow Up Orders</a></li>
                                        <li><a href="#">Get Instant Quote</a></li>
                                        <li><a href="#">Claim Warranty</a></li>
                                        <li><a href="front/home/claim_award">Claim Award</a></li>
                                        <li><img src="assets/template/images/white_bottom_line.png" alt="" /></li>
                                        <li><span style="font-size: 18px; font-weight: bold;">Media and Press</span></li>
                                        <li><a href="#">Press Release</a></li>
                                        <li><a href="#">Client Testimonial</a></li>
                                    </ul>
                                   
                                </div>
                            </div>
                        </div>
                        <div class="fb2 col-md-7">
                            <div class="row">
                                <div class="col-md-6 col-xs-6">
                                    <div class="fb2_inside1">
                                        <h2 style="font-family: arial; color: #de0200; font-size: 18px; font-weight: bold;">Knowledge Center</h2>
                                     
                                        <a href="front/home/promotion_knowledge_center"><span style="color: #575757; font-family: arial; font-size: 13px; line-height: 2em;">Friction Material</span></a> <br />
                                        <a href="front/home/promotion_knowledge_center"><span style="color: #575757; font-family: arial; font-size: 13px; line-height: 3em;">Filtration System</a>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xs-6">
                                    <div class="fb2_inside2">
                                        <h2 style="font-family: arial; color: #de0200; font-size: 18px; font-weight: bold; ">Downloads</h2>
                                        <a href="#"><span style="color: #575757; font-family: arial; font-size: 13px; line-height: 2em;">Reading Materials</span></a><br />
                                        <a href="#"><span style="color: #575757; font-family: arial; font-size: 13px; line-height: 2em;">Videos</a>
                                   </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="row">
                                <div class="col-md-6 col-xs-6">
                                    <div class="fb2_inside3">
                                        <h2 style="font-family: arial; color: #de0200; font-size: 18px; font-weight: bold;">Legal Notices</h2>
                                        <a href="#"><span style="color: #575757; font-family: arial; font-size: 13px; line-height: 2em;">Privacy Policy</span></a><br />
                                        <a href="#"><span style="color: #575757; font-family: arial; font-size: 13px; line-height: 2em;">Disclaimer</span></a>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xs-6">
                                    <div class="fb2_inside4 col-md-6 col-xs-6">
                                        <h2 style="font-family: arial; color: #de0200; font-size: 18px; font-weight: bold; ">Work With KGT</h2>
                                        <a href="front/home/career"><span style="color: #575757; font-family: arial; font-size: 13px; line-height: 2em;">Careers</span></a><br />
                                        <a href="#"><span style="color: #575757; font-family: arial; font-size: 13px; line-height: 2em;">Intership Program</span></a><br />
                                        <a href="#"><span style="color: #575757; font-family: arial; font-size: 13px; line-height: 2em;">Part Time Job</span></a><br />
                                        <a href="#"><span style="color: #575757; font-family: arial; font-size: 13px; line-height: 2em;">Contractors</span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="fb3 col-md-3">
                            <div style="background-image:url(assets/template/images/img01.png); background-repeat: no-repeat; height: 122px;">
                                <img src="assets/template/images/new.png" alt=""  style="margin-left: 10px; margin-top: -7px;" />
                            </div>
                            <div style="background-image:url(assets/template/images/img02.png); background-repeat: no-repeat; height: 122px; margin-top: 23px">
                                <img src="assets/template/images/button2.png" alt="" style=" height: 56px; width: 128px; margin-top: 24px; margin-left: 5px;" />
                            </div>
                            
                        </div>
                                            
                    </div>
                </div> 
            </div>
            <div class="container">
                <div class="fb4">
                    <div class="row" style="margin:0px;">
                        
                        <div class="col-md-6 copyright-area" style="float: left; margin-top: 10px;">
                            <span style="font-family: arial; font-weight: bold; font-size: 12px;">Copy Right &copy 2014 Kondar Global. All rights Reserved</span>
                        </div>
                        <div class="col-md-6 social text-right">
                            <div style="display:inline-block; margin-top: 10px;">
                                <span style="padding-right: 13px; font-family: arial; font-weight: bold; font-size: 12px;">Keep in Touch with us</span>
                               
                            </div>
                            <div  style="display:inline-block;  margin-top: 10px;">
                               <a href="#"> <img src="assets/template/images/facebook_icon.png" alt="" /> </a>
                                <a href="#"> <img src="assets/template/images/icon2.png" alt="" /> </a>
                               <a href="#"> <img src="assets/template/images/youtube_icon.png" alt="" /> </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>   
        </div><!--End footer-->
        
    </div>
</body>
</html>
