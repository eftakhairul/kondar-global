<!DOCTYPE html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]> <html class="no-js" lang="en"> <![endif]-->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?php
        if (isset($title)) {
            echo $title;
        }
        ?>
    </title>
    <base href="<?php echo base_url(); ?>">
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
        $(document).ready(function(){
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

    <script type="text/javascript">
        function startTime(time){
            var monthNames	= [ "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December" ];
            var dayNames 	= ["Sunday","Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];

            var today	=  new Date(parseInt(time*1000));
            var day 	= today.getDate();
            var month	= today.getMonth();
            var year 	= today.getFullYear();
            var h		= today.getHours();
            var m		= today.getMinutes();
            var s		= today.getSeconds();
            var week	= today.getDay();

            /*(h < 12) ? time_t = "AM" : time_t = "PM";
                    (h== 0) ?  h= 12 : h = h;
                    (h > 12) ? h= h- 12 : h= h;*/
            // add a zero in front of numbers<10
            m=checkTime(m);
            s=checkTime(s);
            day=checkTime(day);
            //		month=checkTime(month);
            $('#dateActive').html(dayNames[week]+'. '+monthNames[month]+' '+day+', '+year);
            $('#timeActive').html(h+'&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;'+m+'&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;'+s);

            var d = new Date(parseInt(time*1000));
            var utc = d.getTime() + (d.getTimezoneOffset() * 60000);
		
            //set VANCOUVER time
            var dubai	= new Date(utc + (3600000*'-7'));
            var day		= dubai.getDate();
            var month 	= dubai.getMonth();
            var year 	= dubai.getFullYear();
            var h		= dubai.getHours();
            var m		= dubai.getMinutes();
            var s		= dubai.getSeconds();
            var week	= dubai.getDay();
            // add a zero in front of numbers<10
            m = checkTime(m);
            s = checkTime(s);
            day = checkTime(day);
            //month=checkTime(month);
            //$('#dateActive2').html(month+' '+day+', '+year);
            //$('#timeActive2').html(h+':'+m+':'+s);
            $('#dateActive2').html(monthNames[month]+' '+day+', '+year);
            $('#timeActive2').html(h+':'+m+':'+s+', '+dayNames[week]);

            //set londan time
            var dubai	= new Date(utc + (3600000*'+0'));
            var day		= dubai.getDate();
            var month 	= dubai.getMonth();
            var year 	= dubai.getFullYear();
            var h		= dubai.getHours();
            var m		= dubai.getMinutes();
            var s		= dubai.getSeconds();
            var week	= dubai.getDay();
            // add a zero in front of numbers<10
            m=checkTime(m);
            s=checkTime(s);
            day=checkTime(day);
            //month=checkTime(month);
            //$('#dateActive1').html(month+' '+day+', '+year);
            //$('#timeActive1').html(h+':'+m+':'+s);
            $('#dateActive1').html(monthNames[month]+' '+day+', '+year);
            $('#timeActive1').html(h+':'+m+':'+s+', '+dayNames[week]);

            //set tunic time
            var dubai 	= new Date(utc + (3600000*'+1'));
            var day 	= dubai.getDate();
            var month	= dubai.getMonth();
            var year 	= dubai.getFullYear();
            var h		= dubai.getHours();
            var m		= dubai.getMinutes();
            var s		= dubai.getSeconds();
            var week	= dubai.getDay();
            // add a zero in front of numbers<10
            m=checkTime(m);
            s=checkTime(s);
            day=checkTime(day);
            //month=checkTime(month);
            $('#dateActive4').html(monthNames[month]+' '+day+', '+year);
            $('#timeActive4').html(h+':'+m+':'+s+', '+dayNames[week]);
            //$('#dateActive4').html(month+' '+day+', '+year);
            //$('#timeActive4').html(h+':'+m+':'+s);


            //set dubai time
            var dubai 	= new Date(utc + (3600000*'+4'));
            var day 	= dubai.getDate();
            var month 	= dubai.getMonth();
            var year 	= dubai.getFullYear();
            var h		= dubai.getHours();
            var m		= dubai.getMinutes();
            var s		= dubai.getSeconds();
            var week	= dubai.getDay();
            // add a zero in front of numbers<10
            m=checkTime(m);
            s=checkTime(s);
            day=checkTime(day);
            //month=checkTime(month);
            //$('#dateActive3').html(month+' '+day+', '+year);
            //$('#timeActive3').html(h+':'+m+':'+s);
            $('#dateActive3').html(monthNames[month]+' '+day+', '+year);
            $('#timeActive3').html(h+':'+m+':'+s+', '+dayNames[week]);


            setTimeout(function(){
                startTime(parseInt(time)+1);   
                /*
                $.ajaxSetup({
                    async:false
                })
                $.ajax({
                    type: "POST",
                    url: base_url+"front/get_current_time",
                    success: function(msg){
                        startTime(msg); 
                    }
                });
                $.ajaxSetup({
                    async:true
                })*/
            },500);
        }
        function checkTime(i){
            if (i<10){
                i = "0" + i;
            }
            return i;
        }
        $(function(){
            $.ajaxSetup({
                async:false
            })
            $.ajax({
                type: "POST",
                url: base_url+"front/get_current_time",
                success: function(msg){
                    startTime(msg); 
                }
            });
            $.ajaxSetup({
                async:true
            })
        });
    </script>

    <style>
        img.background{
            width:100%;
            height:100%;
        }


        #carousel {
            margin-left: -360px;
            margin-top: -200px;
            position: absolute;
            top: 50%;
            left:50%;
        }
    </style>
</head>
