<script>
function startTime(){
		var today=new Date();
		var day = today.getDate();
		var month = today.getMonth()+1;
		var year = today.getFullYear();
		var h=today.getHours();
		var m=today.getMinutes();
		var s=today.getSeconds();
		// add a zero in front of numbers<10
		m=checkTime(m);
		s=checkTime(s);
		day=checkTime(day);
		month=checkTime(month);
		$('#dateActive').html(day+' . '+month+' . '+year);
		$('#timeActive').html(h+' : '+m+' : '+s);
		setTimeout(function(){startTime()},500);
	}
	function checkTime(i){
		if (i<10){
		  i = "0" + i;
		}
		return i;
	}
	$(function(){
		startTime(); 
	});
</script>

<style>
.date-sec{
	margin-left:20px;
}
.date-sec .date-time {
  font-family: 'ds-digitalnormal';
  font-size: 24px;
  font-weight: bold;
  height: 30px;
  line-height: 30px;
  margin: 0;
  padding: 0;
  text-align: center;
  width: 150px;
}
.date-sec .sep {
  border-top: 1px solid #FFFFFF;
  height: 0;
  margin: 0 0 0 15px;
  padding: 0;
  width: 120px;
}
.date-sec .date-time {
  font-family: 'ds-digitalnormal';
  font-size: 24px;
  font-weight: bold;
  height: 30px;
  line-height: 30px;
  margin: 0;
  padding: 0;
  text-align: center;
  width: 150px;
}
</style>

<div class="container">
    <div class="header">
        <div>
            <div class="row" style="min-height:130px;">
                <div class="col-md-3">
                   <a class="logo" href="home"><img src="assets/template/images/logo.png" alt="logo" style="float:left;" /></a>
                </div>
                <div class="col-md-6 col-xs-5 block-bg-header hidden-xs">
                    <a href="<?=base_url()?>products"><img src="assets/template/images/logo-pic.png" alt="">    </a>
                </div>
                <div class="col-md-3">
                    <div class="ddl">
                       <div class="language_container">
                            <label for="polyglot-language-options" class="hide">Select Language</label>
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
                            <div class="date-sec">
                                <div class="date-time color-white" id="dateActive">27 . 01 . 2014</div>
                                <div class="sep"></div>
                                <div class="date-time color-white" id="timeActive">09 : 00 : 02</div>
                            </div> 
                            
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
                    <a href="home/distribution" style="margin-left:-26px">Apply for A Distribution Agrement </a> 
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
                                      <a href="home" class="dropdown-toggle" data-toggle="dropdown">Home <b class="caret"></b></a>
                                          <ul class="dropdown-menu">
                                            <li><a href="front/career">Career</a></li>
                                            <li><a href="front/contact_us">Contact Us</a></li>
                                          </ul>
                                    </li>
                                    
                                    <li class="dropdown">
                                        <a href="home/product" class="dropdown-toggle" data-toggle="dropdown">
                                            Products <b class="caret"></b>
                                        </a>
                                        <ul class="dropdown-menu">
                                            <!-- <li><a href="product.php" class="cars" style="background:none"><b>PRODUCT</b></a></li>
                                            <li class="divider"></li> -->
                                            <li><a href="home/car" class="cars">Cars</a></li>
                                            <li><a href="home/car" class="van">Van & Pickup</a></li>
                                            <li><a href="home/truck" class="truck">Truck & Bus</a></li>
                                            <li><a href="home/truck" class="others">Others</a></li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="front/promotion">Promotion Section</a>
                                    </li>
                                    <li class="dropdown">
                                        <a href="home/Login" class="dropdown-toggle" data-toggle="dropdown">
                                            Client Section <b class="caret"></b>
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li><a href="home/Login" >Follow Up Order</a></li>
                                            <li><a href="home/Login" >Warranty Claim</a></li>
                                            <li><a href="home/Login" >Instant RFQ</a></li>
                                        </ul>
                                    </li>
                                    <li class="dropdown"><a href="home/Login" class="dropdown-toggle" data-toggle="dropdown">Supplier & Investor Section <b class="caret"></b></a>
                                        <ul class="dropdown-menu">
                                            <li><a href="home/Login" >Supplier</a></li>
                                            <li><a href="home/Login">Investor</a></li>
                                        </ul>
                                    </li>
                                    <li>

                                                                <a href="https://kondarglobal.frappecloud.com/#login" style="float: left; padding: 15px 0px 16px 10px; width: 95px;">Staff Login</a>
																<a href="cart" style="float: left; width: 137px; padding: 14px 0px 16px 3px;"><img src="<?= img_url('cart.png', 'master/') ?>" alt="cart" /> <span id="menu_cart_id">Cart [<?php echo $cartcount; ?>]</span></a>
                                                            </li>
                              </ul>
                          
                        </div><!-- /.navbar-collapse -->
                      </div><!-- /.container-fluid -->
                    </nav>
                </div>
            </div>
        </div>
        

        
    </div>
</div>

