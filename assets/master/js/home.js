$(document).ready(function() {
	$('#sample').find('a').each(function(i,v)
	{
			if (!$(this).html().toString().length)
			{
				$(this).hide();
			}
	});
	
	$("#polyglotLanguageSwitcher1 dl dd ul li a ").click(function()
	{

        var language_selected 	= $.trim($("#polyglotLanguageSwitcher1 dl dt a span").find('img').attr('alt'));
			
        if(language_selected != 'English')
        {
				
            $("#language_popup").modal('show');
				
            $("#polyglotLanguageSwitcher1 dl dt a span").html($("#polyglotLanguageSwitcher1 dl dd ul li:first-child a").html());
            return false
        }
	});
	
    $('#polyglotLanguageSwitcher').polyglotLanguageSwitcher({
        effect: 'fade',
        testMode: true,
        
        onChange: function(evt){
            
            if(evt.selectedItem != "en")
            {
                $('#language_popup').modal('show');
                setTimeout(function(){
                $('#polyglot-language-options')[0].attr('selected','selected');
               
				},500);
                return false;
            }
            else
                return false;
        }
        
    });
    $('.selectpicker').selectpicker();
    $('.popuplogin').click(function(){
		
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

var server_time = 0
/*
function startTime(time){
	
	server_time = parseInt(time*1000);
	updateTime();
}
*/

function updateTime() {

	// increment clock by 1s
	server_time += 1000;
	
    var today=new Date(server_time);

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

    setTimeout(function(){updateTime()},1000);

}

function startTime(time){
    var monthNames  = [ "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December" ];
    var dayNames  = ["Sunday","Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
    var today = new Date(parseInt(time*1000));
    var day   = today.getDate();
    var month = today.getMonth();
    var year  = today.getFullYear();
    var h   = today.getHours();
    var m   = today.getMinutes();
    var s   = today.getSeconds();
    var week  = today.getDay();

    /*(h < 12) ? time_t = "AM" : time_t = "PM";
    (h== 0) ?  h= 12 : h = h;
    (h > 12) ? h= h- 12 : h= h;*/
    // add a zero in front of numbers<10
    m=checkTime(m);
    s=checkTime(s);
    day=checkTime(day);
    //    month=checkTime(month);
    $('#dateActive').html(dayNames[week]+'. '+monthNames[month]+' '+day+', '+year);
    $('#timeActive').html(h+'&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;'+m+'&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;'+s);

    var d = new Date(parseInt(time*1000));
    var utc = d.getTime() + (d.getTimezoneOffset() * 60000);
    //set VANCOUVER time
    var dubai = new Date(utc + (3600000*'-7'));
    var day   = dubai.getDate();
    var month   = dubai.getMonth();
    var year  = dubai.getFullYear();
    var h   = dubai.getHours();
    var m   = dubai.getMinutes();
    var s   = dubai.getSeconds();
    var week  = dubai.getDay();
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
    var dubai = new Date(utc + (3600000*'+0'));
    var day   = dubai.getDate();
    var month   = dubai.getMonth();
    var year  = dubai.getFullYear();
    var h   = dubai.getHours();
    var m   = dubai.getMinutes();
    var s   = dubai.getSeconds();
    var week  = dubai.getDay();
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
    var dubai   = new Date(utc + (3600000*'+1'));
    var day   = dubai.getDate();
    var month = dubai.getMonth();
    var year  = dubai.getFullYear();
    var h   = dubai.getHours();
    var m   = dubai.getMinutes();
    var s   = dubai.getSeconds();
    var week  = dubai.getDay();
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
    var dubai   = new Date(utc + (3600000*'+4'));
    var day   = dubai.getDate();
    var month   = dubai.getMonth();
    var year  = dubai.getFullYear();
    var h   = dubai.getHours();
    var m   = dubai.getMinutes();
    var s   = dubai.getSeconds();
    var week  = dubai.getDay();
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
        })
        */
    },1000);
    
    
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





function get_content1(name){
    //alert(name);
    $.ajax({
        type: "POST",
        url: base_url+"front/get_content1", /* The country id will be sent to this file */
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
        url: base_url+"front/get_content2", /* The country id will be sent to this file */
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
        url: base_url+"front/get_content3", /* The country id will be sent to this file */
        data: "id="+name,
        beforeSend: function () {
            $("#content3").html("Loading ...");
        },
        success: function(msg){
            $("#content3").html(msg);
        }
    });
} 

function get_content4(name){
    //alert(name);
    $.ajax({
        type: "POST",
        url: base_url+"front/get_content4", /* The country id will be sent to this file */
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
        url: base_url+"front/get_content4", /* The country id will be sent to this file */
        data: "id="+name+'&page=vehicle_id',
        beforeSend: function () {
            $("#content5").html("Loading ...");
        },
        success: function(msg){
            $("#content4").html(msg);
        }
    });
} 

function get_content6(name){
    //alert(name);
    $.ajax({
        type: "POST",
        url: base_url+"front/get_content4", /* The country id will be sent to this file */
        data: "id="+name+'&page=category',
        beforeSend: function () {
            $("#content6").html("Loading ...");
        },
        success: function(msg){
            $("#content4").html(msg);
        }
    });
} 

function get_model(name){
    //alert(name);
    $.ajax({
        type: "POST",
        url: base_url+"front/get_model", /* The country id will be sent to this file */
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
    testAjax(itemSize);
})
$('.example2').wmuSlider({
    touch: true,
    animation: 'slide'
});     
