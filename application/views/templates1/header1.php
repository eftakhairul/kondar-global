<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>
<?php
if(isset($title)){
	   echo $title; 
}
?>
<base href="<?php echo base_url();?>">
</title>
    <link rel="stylesheet" href="assets/templates/css/style1.css" type="text/css">
    <link rel="stylesheet" href="assets/templates/css/responsive.css" type="text/css">   
    
    <script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
	<script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script type="text/javascript" src="assets/templates/js/jskgt.js"></script>
    <script type="text/javascript" src="assets/templates/js/jquery-ui.min.js"></script>    
    <script type="text/javascript" src="assets/templates/js/jquery.earth-3d.js"></script>
    
    
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
<!-- begin JS -->
    <script type="text/javascript">
        $(document).ready(function() {
            $('#polyglotLanguageSwitcher').polyglotLanguageSwitcher({
				effect: 'fade',
                testMode: true,
                onChange: function(evt){
                    alert("The selected language is: "+evt.selectedItem);
                }
			});
        });
    </script>
	<!-- end JS -->
</head>
<body onLoad="itemSize();" onresize="onResizeWindow();" id="mainBG" style="background: url('assets/templates/images/bg.jpg') no-repeat scroll center center #000000;background-size:cover">
    <div id="header">
    	<div class="logo"><img src="assets/templates/images/logo.png" alt="logo"></div>
    	<div class="date-sec date-sec-bottom-right">
        	<div class="date-time color-white" id="dateActive"></div>
            <div class="sep"></div>
            <div class="date-time color-white" id="timeActive"></div>
        </div>

<!--        <div class="date-sec2">
        	<div class="date-time color-white" id="dateActive"></div>
            <div class="sep"></div>
            <div class="date-time color-white" id="timeActive"></div>
        </div>
        <div class="date-sec3">
        	<div class="date-time color-white" id="dateActive"></div>
            <div class="sep"></div>
            <div class="date-time color-white" id="timeActive"></div>
        </div>
        <div class="date-sec4">
        	<div class="date-time color-white" id="dateActive"></div>
            <div class="sep"></div>
            <div class="date-time color-white" id="timeActive"></div>
        </div>     
-->    	       
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
        	<input type="button" class="button" value="ENTER">
        	<div class="clear"></div>
       </div>
    </div>
   	<div id="content">
        <div id="container">
          <canvas id="sphere" width="400" height="400"></canvas>
          <div id="glow-shadows" class="earth"></div>
          <div id="carousel"></div>
        </div>
    </div>
    <div id="footer">
		<div style="height:91%"></div>
		<div style="height:9%">
			<div id="copyright">Copyright 2014. Kondar Global Trading. All Rights Reserved</div>
		</div>
     </div>
</body>
</html>