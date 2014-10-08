// JavaScript Document


$(document).ready(function(e) { 
						   
    get_product_type();			   
    $("#Search").keyup(function(){
        $.ajax({
            url:"ajax/autosuggest_searchpartnumber/"+$.trim($('#Search').val().toUpperCase()),
            type:'POST',
            success:function(msg)
            {
			   
                $('#searchresult').html(msg);
                $('#searchresult').show(); 
            }
        });
    });
 
    $('body').click(function(e){		 
        if( e.target.id != 'Search' && e.target.id != 'SearchBtn' )
        {
            $('#searchresult').hide();
        }     
    });
    $(".headersearchbutton").click(function(){
        var searchstring=$.trim($('#Search').val()); 
        if(searchstring=='')
        {
            $('#searchresult').html("Please enter a valid part number");
            $('#searchresult').show();				
        }
        else
        {
            var resultlist=	$('#searchresult').find('a');
            var resultempty=	$('#searchresult').find('a.noresult');				
            if(resultempty.length>0 || resultlist.length==0)
            {
                noresultsearch($('#Search').val());	
            }
            else //if(resultlist.length>0)
            {
                testsearch(resultlist[0]);	
            }
					
        }
    });
						   
    /*$('#vehicle_category_id').change(function(e){
		e.preventDefault();
		get_product_type();
	});*/
	
    //onchange_product_category();
	
    $('#vehicle_category_id').change(function(e){
        get_product_type();
    });
	
    // onchange_vehicle_category();
    //onchange_product_maker();
    //get_product_type();
    //get_product_maker();
    //get_product_model();
	
    $('#quicker_search').click(function(e){
        $('#quick_search_form').submit();
    });
    $("#searchtype").change(function(){
        var typevalue=$(this).val();
        //alert(typevalue);
        if(typevalue==1)
        {
            $("#leftblock").removeClass("pull-left").addClass("pull-right");
            $("#rightblock").removeClass("pull-right").addClass("pull-left");
            get_product_type();
        }
        if(typevalue==0)
        {
            $("#leftblock").removeClass("pull-right").addClass("pull-left");
            $("#rightblock").removeClass("pull-left").addClass("pull-right");
            get_vehicle_category();
			
			
        }	
    });
    /*$('#product_type_id').change(function(e){
		alert('ssssss');
		get_product_maker();
		e.preventDefault();
	});*/
	
    /*$('#vehicle_category_id').change(function(){
		var selectedcategoryid=$(this).val();
		var selclass="#product_type_id option."+selectedcategoryid;
		alert(selclass);
		$("#product_type_id option").removeClass('selected');
		$(selclass).addClass('selected');
		$("#product_type_id option.selected:first").attr('selected', true);
		AutosetfiledBoxesSelection();
	});
	
	$("#product_type_id").change(function(){
		AutosetfiledBoxesSelection();
	 
	});*/
    $('#enquirysubmit').click(function() {
        $.ajax({
            type: "POST",
            url: "ajax/sendenquiry", 
            data:  $('#sendenquiry').serialize(),
            beforeSend: function () {
            //	   alert('asa');
            // $("#show_class").show();
            // $("#show_class").html("Loading ...");
            },
            success: function(msg){
                $("#enquiry_partnumber_details").modal('hide');
				
            }
        });
    });
    $('#enquirysubmit_contctredirect').click(function() {
        $('#searchresult').hide();
        $("#senditemenquiry").submit();
    //window.location.href=
    });
});
function noresultsearch(ele)
{
	
    //$search = $(ele).attr('rel');
    $search = $('#Search').val();
    //$("#enquirypart_number").val($search);
    $("#spnsearchedpartnumber").val($search);
    $("#enquiry_partnumber_details").modal('show');
}
function testsearch(ele)
{
    $('#Search').val($(ele).attr('rel'));
    $('#searchresult').hide();
    window.location.href="products/product_list/"+ $('#Search').val();
}
function onchange_vehicle_category()
{ 
    $("#product_type_id").change(function(){		 	
        get_vehicle_category();
    });
}
function onchange_product_category()
{	
    $('#vehicle_category_id').change(function(e){
        var searchmode=$("#searchtype").val();	
        if(searchmode==1)
            get_product_maker();	
        else
            get_product_type();
    });
}
function onchange_product_type()
{
    $('#product_type_id').change(function(e){
        var searchmode=$("#searchtype").val();		
        if(searchmode==1)
            get_vehicle_category();
        else
            get_product_maker();	
    });
}
function onchange_product_maker()
{
    $('#maker_id').change(function(e){
        get_product_model();
    });
}
function get_product_type()
{
    var searchmode=$("#searchtype").val();
    var vehicle_category_id =$("#vehicle_category_id").val();
	
    if(searchmode==1)
        vehicle_category_id='';
            
    if(vehicle_category_id != undefined){
        $(".quick-search-loading").show();
        $.ajax({
            type: "POST",
            data:  '',
            url: "ajax/product_type_details/"+vehicle_category_id, 
            success: function(msg)
            {
                $('#product_type_span').html(msg);
				
                $('.selectpicker').selectpicker();
				
                if(searchmode==1)
                {
                    get_vehicle_category();					
                }
                else
                    get_product_maker();
                onchange_product_type();
                
                $(".quick-search-loading").hide();
            }
        });
    }
}
function get_product_maker()
{
    var product_type_id =$("#product_type_id").val();
    var vehicle_category_id =$("#vehicle_category_id").val();
    $(".quick-search-loading").show();
    $.ajax({
        type: "POST",
        data:  {
            category:vehicle_category_id
        },
        url: "ajax/product_maker_details/"+product_type_id, 
        success: function(msg)
        {
            $('#product_maker_span').html(msg);				
            $('.selectpicker').selectpicker();
        //get_product_model();
        //onchange_product_maker();
        $(".quick-search-loading").hide();
        }
    });
}


function get_vehicle_category()
{
    var product_type_id =$("#product_type_id").val();
    var searchmode=$("#searchtype").val();
    if(searchmode==0)
        product_type_id='';
	
        $(".quick-search-loading").show();
    $.ajax({
        type: "POST",
        data:  '',
        url: "ajax/product_category_details/"+product_type_id, 
        success: function(msg)
        {
            $('#vehicle_type_span').html(msg);
				
            $('.selectpicker').selectpicker();
            if($("#searchtype").val()==0)
            {
                get_product_type();
                get_product_maker();
                onchange_product_maker();
                onchange_product_category();
            }
            else
            {
                get_product_maker();
                onchange_product_category();
            }
            $(".quick-search-loading").hide();
        }
    });
}

function get_product_model()
{
    var maker_id =$("#maker_id").val();
    $.ajax({
        type: "POST",
        data:  '',
        url: "ajax/product_model_details/"+maker_id, 
        success: function(msg)
        {
            $('#product_model_span').html(msg);
            $('.selectpicker').selectpicker();
        }
    });
}
