// JavaScript Document

$(document).ready(function() {
		
    $("#polyglotLanguageSwitcher1 dl dd ul li a ").click(function()
    {
        setTimeout(function()
        {
            var language_selected 	= $.trim($("#polyglotLanguageSwitcher1 dl dt a span").find('img').attr('alt'));
	
            if(language_selected != 'English')
            {
				
                $("#language_popup").modal('show');
				
                $("#polyglotLanguageSwitcher1 dl dt a span").html($("#polyglotLanguageSwitcher1 dl dd ul li:first-child a").html());
                return false
            }
        },200);
    });
	
    $('#polyglotLanguageSwitcher').polyglotLanguageSwitcher({
        effect: 'fade',
        testMode: true,
        onChange: function(evt){
            /*
           	var pathname = window.location;
			pathname = pathname.toString();
			var langarr 	= '';
			var langsearch_fr = pathname.indexOf('/fr');
			var langsearch_ar = pathname.indexOf('/ar');
			
			if(langsearch_fr >= 0)
			{
				langarr = pathname.split('/fr');
				langarr = langarr[0];
			}
			else if(langsearch_ar >= 0)
			{
				langarr = pathname.split('/ar');
				langarr = langarr[0];
			}
			else
			{
				langarr = pathname.split('home');
				langarr = langarr[0];
			}
			
			if(evt.selectedItem != 'en')
			{
				window.location.href = langarr+evt.selectedItem+'/home';
			}
			else
			{
				window.location.href = langarr+'/home';
			}	
			*/
            return false;	
        }
    });
    $('.selectpicker').selectpicker();
    $('.example2').wmuSlider({
        touch: true,
        animation: 'slide'
    });

    $('.login_pop').click(function(){
        var name = $(this).attr('value');
        $('.client_name').html(name);
        $('#client_section').modal('show');
        return false;
    });
    $('.popuplogin').click(function(){
        //	alert('sss');
        var login_username = $.trim($('#login_username').val());
        var login_password = $.trim($('#login_password').val());
        var error_flag = 0;
        if(login_username=='')
        {
            $('#login_username').addClass('boarder_red');
            error_flag=1;
        }
        else
        {
            $('#login_username').removeClass('boarder_red');
        }
        if(login_password=='')
        {
            $('#login_password').addClass('boarder_red');
            error_flag=1;
        }
        else
        {
            $('#login_username').removeClass('boarder_red');
        }
        if(error_flag == 0)
        {
            $('#client_section').modal('hide');
            $('#login_redirect').modal('show');
        }
    });
});
function lang_redirct()
{
    $('#polyglotLanguageSwitcher .current').html("English <span class='trigger'>�</span>");
    $('#polyglotLanguageSwitcher .current').attr('id','en');
	
}
function get_content1(name){
    //alert(name);
    $.ajax({
        type: "POST",
        url: "front/get_content1", /* The country id will be sent to this file */
        data: "id="+name,
        beforeSend: function () {
            $("#content1").html("Loading ...");
        },
        success: function(msg){
            $("#content1").html(msg);
        }
    });
} 

function get_content2(name){
    //alert(name);
    $.ajax({
        type: "POST",
        url: "front/get_content2", /* The country id will be sent to this file */
        data: "id="+name,
        beforeSend: function () {
            $("#content2").html("Loading ...");
        },
        success: function(msg){
            $("#content2").html(msg);
        }
    });
} 

function get_content3(name){
    //alert(name);
    $.ajax({
        type: "POST",
        url: "front/get_content3", /* The country id will be sent to this file */
        data: "id="+name,
        beforeSend: function () {
            $("#content2").html("Loading ...");
        },
        success: function(msg){
            $("#content2").html(msg);
        }
    });
} 

function get_content4(name){
    //alert(name);
    $.ajax({
        type: "POST",
        url: "front/get_content4", /* The country id will be sent to this file */
        data: "id="+name,
        beforeSend: function () {
            $("#content4").html("Loading ...");
        },
        success: function(msg){
            $("#content4").html(msg);
        }
    });
} 

function get_content5(name){
    //alert(name);
    $.ajax({
        type: "POST",
        url: "front/get_content5", /* The country id will be sent to this file */
        data: "id="+name+'&page=vehicle_id',
        beforeSend: function () {
            $("#content3").html("Loading ...");
        },
        success: function(msg){
            $("#content3").html(msg);
        }
    });
} 

function get_content6(name){
    //alert(name);
    $.ajax({
        type: "POST",
        url: "front/get_content5", /* The country id will be sent to this file */
        data: "id="+name+'&page=category',
        beforeSend: function () {
            $("#content3").html("Loading ...");
        },
        success: function(msg){
            $("#content3").html(msg);
        }
    });
} 

function get_model(name){
    //alert(name);
    $.ajax({
        type: "POST",
        url: "admin/get_model", /* The country id will be sent to this file */
        data: "id="+name,
        beforeSend: function () {
            $("#Show_model").html("Loading ...");
        },
        success: function(msg){
            $("#Show_model").html(msg);
        }
    });
} 
$(document).ready(function() {  
    $('.login_pop').click(function(){
        var name = $(this).attr('value');
        $('.client_name').html(name);
        $('#client_section').modal('show');
        return false;
    });
    if(document.getElementById("carousel"))
        testAjax(itemSize);
})
function startTime(){
    var monthNames	= [ "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December" ];
    var dayNames 	= ["Sunday","Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];

    var today	= new Date();
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

    var d = new Date();
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
        startTime()
        },500);
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

function read_more(num){
    var text = $("#read_more"+num).html();
    if(text == 'Less Information')
    {
        $("#read_more"+num).html('Read More>>');
        $("#read_data"+num).show();
        $("#hide_data"+num).toggle(200);
    }
    else
    {
        $(".hide_data").hide();
        $(".read_data").show();
        $("#read_data"+num).hide();
        $("#hide_data"+num).toggle(200);
        $(".read_more").html('Read More>>');
        $("#read_more"+num).html('Less Information');
    }
}
