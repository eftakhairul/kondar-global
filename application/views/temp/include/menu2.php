<style>
.date-sec .sep {
  border-top: 1px solid #FFFFFF;
  height: 0;
  margin: 0 0 0 8px;
  padding: 0;
  width: 150px;
}
.date-sec .date-time {
  font-size: 13px;
  font-weight:bold;
  height: 30px;
  line-height: 30px;
  margin: 0;
  padding: 0;
  text-align: center;
  width: 170px;
}


.searchdiv ul{ 
background:#FFFFFF; 
list-style:none;
position: absolute;
z-index: 9999;
width: 150px;
max-height:80px; 
overflow:auto; 
margin-left:20px;
-webkit-margin-before: 0;
-webkit-margin-after: 0em;
-webkit-margin-end: 0px;
-webkit-padding-start: 0px;}
.searchdiv ul a{color: #000000;}
.searchdiv ul a li:hover{background:#CCCCCC;}
	
</style>

<!--<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script>
$(document).ready(function(){
        $("#addrecord").hover(function(){
            $(".notify").fadeIn("500");
        },function(){
            $(".notify").fadeOut("500");
        });
        
        $("#addrecord").click(function(){
            $("#addtopic").slideDown("500");
        });
        
        $("#add").keydown(function(e){
        var keycode = (e.keyCode ? e.keyCode : e.which);
        if(keycode == 13){
                    $("#add").hide();
                    var value = $("#add").val();
                    $.post("save.php",{value:value}, function(data){
                        $("#addtopic").html(data);
                        setTimeout("location.reload(true);",5);
                    });
                }
            });   
    });

$(function() {
function log( message ) {
	$( "#result" ).html(data);
	$( "body" ).scrollTop( 0 );
}
var url = "front/autosuggest_searchpartnumber/"+$( "#Search" ).val();-->

<!--$( "#Search" ).autocomplete({
		source: function (request, response) {
			jQuery.get("front/autosuggest_searchpartnumber/"+$( "#Search" ).val(), {
				query: request.term
			}, function (data) {
				// assuming data is a JavaScript array such as
				// ["one@abc.de", "onf@abc.de","ong@abc.de"]
				// and not a string
				alert(data);
			   //response(data);
			});
		},
		minlength: 1,
		select: function( event, ui ) {
			log( ui.item ?
			"Selected Topic: " + ui.item.value :
			"Nothing selected, input was " + this.value );
		}
	});
	
});-->
<script>
/*function getsearchAutsuggestvalue()
{*/
$('#searchresult').hide();
$(document).ready(function(){
        $("#Search").keyup(function(){
		$.ajax({
			url:"front/autosuggest_searchpartnumber/"+$('#Search').val(),
			type:'POST',
			success:function(msg)
			{
			
			   $('#searchresult').html(msg);
			   $('#searchresult').show();	
			}
		});
	});
	
	$('body').click(function(e){
	
        if( e.target.id != 'Search' )
       { $('#searchresult').hide(); }     
    });
	
});

function testsearch(ele)
{
	$('#Search').val($(ele).attr('rel'));
	$('#searchresult').hide();
}
	
</script>	
<div class="container">
    <div class="header">
        <div>
            <div class="row" style="min-height:130px;">
                <div class="col-md-3">
                   <a class="logo" href="home"><img src="assets/template/images/logo.png" alt="logo" style="float:left;" /></a>
                </div>
                <div class="col-md-6 col-xs-5 block-bg-header hidden-xs">
                   <a href="<?=base_url()?>products"> <img src="assets/template/images/logo-pic.png" alt="">    </a>
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
                             <div class="date-sec">
                                    <div class="date-time color-white" id="dateActive" style="width:auto"> </div>
                                    <div class="sep"></div>
                                    <div class="date-time color-white" id="timeActive"></div>
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
                <div class="col-md-3 col-md-offset-1 text-right text-2" >
                    <h4>
                    <a href="home/distribution" style="margin-left:-26px">Apply for A Distribution Agrement </a> 
                </h4>
                </div>
                <div class="col-md-3">
                    <div class="searchdiv">
                        <input id="Search" type="text" name="Articles" placeholder="Search For Articles"/> 
       					<ul id="searchresult" class="">
                        </ul>
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
        

        <div class="slider" style="height:auto">
<?php
if(isset($slider_data)&&!empty($slider_data)){
?>
            <div class="wmuSlider example2">
                    <div class="wmuSliderWrapper">
<?php
	foreach($slider_data as $set_data){
?>
			<article><h2 class="hide">slider</h2>
                            <img src="<?php echo 'assets/uploads/slider/full/'.$set_data['image'];?>" style="height:320px;width:1200px" />
                        </article>
<?php		
	}
?>
                    </div>
                </div>
<?php
}
?>

    <!--<div class="wmuSlider example2">
        
        <div class="wmuSliderWrapper">
            <article>
                <img src="assets/template/image1.jpg" style="height:320px;width:1200px"/>
            </article>
    
            <article>
                <img src="assets/template/image4.jpg" />
            </article>

            <article>
                <img src="assets/template/image5.jpg" />
            </article>
    
            <article>
                <img src="assets/template/image3.jpg" />
            </article>

            <article>
                <img src="assets/template/image2.jpg" />
            </article>
        </div>
    </div>-->
        
            
        </div>
    </div>
</div>

<link rel="stylesheet" href="assets/template/css/demo.css" type="text/css" media="screen" />
<script type="text/javascript" src="assets/template/js/modernizr.custom.min.js"></script>    
<script src="assets/template/js/jquery.wmuslider.js"></script>
<script>	 
	$('.example2').wmuSlider({
		touch: true,
		animation: 'slide'
	});   	
</script>
