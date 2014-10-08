// JavaScript Document

var user_session_delete = 0;
var clock;
var clock1;
var clock2;
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

function showHide(toggle_class){
    
    $(toggle_class).toggleClass('hide');
    $(toggle_class+'_less_img').toggle();
    $(toggle_class+'_more_img').toggle();    
}

function ajaxProductList(limit){
    
    var total_products_count = parseInt($("#total_products_count").text());
    var products_show = parseInt($("#products_count").text());    
    
    var chkbtn = $("#checkbox:checkbox");
        if(chkbtn.is(':checked')){
            var checkbox = 'checked';
        }else{
            var checkbox = '';
        }
    
    if(total_products_count>products_show){
        var loadinghtml = 'Please wait..Products Loading....';
        $("#loadmoreProducts").text(loadinghtml);
        $.ajax({
            type: "POST",
            url: "products/getProducts",                        
            data:{'limit':limit,'offset':products_show,'checkbox':checkbox},           
            success: function(producthtml) {
                $("#productsearch_list_show").append(producthtml).addClass('canload');
                var total_products_count = parseInt($("#total_products_count").text());
                var products_show = parseInt($("#products_count").text());
                var products_show_text = 'Products Show: '+ products_show +' of '+ total_products_count; 
                $("#display-num-of-products").text(products_show_text);
                
                if(total_products_count>products_show){
                $("#loadmoreProducts").text("Load More Products");
                }else{                    
                    $("#loadmoreProducts").text("No more to display");
                    $("#productsearch_list_show").removeClass('canload'); 
                    
                }
            }
        }); 
    }else {
        $("#loadmoreProducts").text("No more to display");
    }
}

$(document).ready(function() {
    /******** Product list scroll Start ************/   
    var limit = parseInt($("#products_count").text());
    $(window).scroll(function() {
        var height = $(window).scrollTop();
        var scroll_height = $("#productsearch_list_show").height();
        if(height  > (scroll_height-1000)) {
            if($("#productsearch_list_show").hasClass('canload')){
                $("#productsearch_list_show").removeClass('canload');
                //ajaxProductList(limit);                
            }                
        }
    });
    
    /******** Product list scroll End ************/
    
    
    
    
    
    
    
    //productlisting
    $("#check_all_btn,#check_all_btn #checkbox").click(function(){  
        var chkbtn = $(".productlisting input:checkbox");
        if(chkbtn.is(':checked')){
            chkbtn.prop('checked',false);
        }else{
            chkbtn.prop('checked',true);
        }          
            
    });

    $("#product_brand_next").click(function() {

        var itemselected = false;

        $('.pro-item input:hidden').each(function() {

            if ($(this).val() != "")
                itemselected = true;

        // do something with the value

        });

        if (itemselected == true)
            $("#products_brand_list_form").submit();

        else

        {

            $('#customwarning').modal('show');

            //$('#customwarning_msg_title').html('<blink>Warning<blink>');
            blink(1);

            //$('#customwarning_msg').html('Please select at least one item');

        }





    });

    $("#product_type_next").click(function() {



        var itemselected = false;

        $('.pro-item input:hidden').each(function() {

            if ($(this).val() != "")
                itemselected = true;

        // do something with the value

        });

        if (itemselected == true)
            $("#products_type_list_form").submit();

        else

        {

            $('#customwarning').modal('show');

            //$('#customwarning_msg_title').html('<blink>Warning</blink>');
            blink(1);
            //$('#customwarning_msg').html('Please select at least one item');

        }



    });



    $("#product_catagory_next").click(function() {
        var itemselected = false;



        $('.pro-item input:hidden').each(function() {

            if ($(this).val() != "")
                itemselected = true;

        // do something with the value

        });



        if (itemselected == true)

        {

            $("#products_catagory_list_form").submit();

        //$("#products_catagory_list_form").remove();

        }

        else

        {

            $('#customwarning').modal('show');

            //$('#customwarning_msg_title').html('<blink>Warning</blink>');
            blink(1);
            //$('#customwarning_msg').html('Please select at least one item');

        }

    });

    $(".product_type_image_wrap.step1").live('click',function() {

        $("#products_catagory_list_form").attr("action", "products/vehicle_type");

        $(".vehicle_category_image_wrap").removeClass('boarder_2_red');

        $(".vehicle_category_id").val('');

        if ($(this).hasClass('boarder_2_red'))

        {

            $(this).removeClass('boarder_2_red');

            $(this).find('.product_types_id').val('');
            $("#product_check_all_btn #checkbox_product_option").prop('checked',false);

        }

        else

        {

            $(this).addClass('boarder_2_red');
            $("#vehicle_check_all_btn #checkbox_vehicle").prop('checked',false);
            $(this).find('.product_types_id').val($(this).find('.product_image_wrap').attr('data-rel'));

        }

    });

    $(".vehicle_category_image_wrap.step1").click(function() {

        $("#products_catagory_list_form").attr("action", "products/product_type");

        $(".product_type_image_wrap").removeClass('boarder_2_red');

        $(".product_types_id").val('');

        if ($(this).hasClass('boarder_2_red'))

        {

            $(this).removeClass('boarder_2_red');

            $(this).find('.vehicle_category_id').val('');
            $("#vehicle_check_all_btn #checkbox_vehicle").prop('checked',false);

        }

        else

        {

            $(this).addClass('boarder_2_red');
            $("#product_check_all_btn #checkbox_product_option").prop('checked',false);
            $(this).find('.vehicle_category_id').val($(this).find('.product_image_wrap').attr('data-rel'));

        }

    });

    $(".product_type_image_wrap.singlestep").live('click',function() {

        if ($(this).hasClass('boarder_2_red'))

        {

            $(this).removeClass('boarder_2_red');
            
            $(this).find('.vehicle_type_id').val('');

            $(this).find('.vehicle_category_id').val('');
            $("#check_all_btn #checkbox").prop('checked',false);

        }

        else

        {

            $(this).addClass('boarder_2_red');

            $(this).find('.vehicle_type_id').val($(this).find('.product_image_wrap').attr('data-rel'));

            $(this).find('.vehicle_category_id').val($(this).find('.product_image_wrap').attr('data-rel'));

        }

    });





    //$(".brandcheckbox").on( "click", function() {
   $('#productsearch_list_show').on('click', '.brandcheckbox', function() {
        if ($(this).is(':checked'))

        {
            $(".brandcheckbox_"+$(this).val()).prop('checked', true);
            $('.productcheck_' + $(this).val()).prop('checked', true);

        }

        else

        {
            $(".brandcheckbox_"+$(this).val()).prop('checked', false);
            $('.productcheck_' + $(this).val()).prop('checked', false);

        }

    });

    //$(".modelcheckbox").on( "click", function() {
    $('#productsearch_list_show').on('click', '.modelcheckbox', function() {

        if ($(this).is(':checked'))

        {
            $(".modelcheckbox_"+$(this).val()).prop('checked', true);
            $('.modelcheckbox_' + $(this).val()).prop('checked', true);

        }

        else

        {
            $(".modelcheckbox_"+$(this).val()).prop('checked', false);
            $('.modelcheckbox_' + $(this).val()).prop('checked', false);

        }

    });
    
    
    //$(".producttypecheckbox").on( "click", function() {
    $('#productsearch_list_show').on('click', '.producttypecheckbox', function() {

        if ($(this).is(':checked'))

        {
            $(".producttypecheckbox_"+$(this).val()).prop('checked', true);
            $('.product_type_' + $(this).val()).prop('checked', true);

        }

        else

        {
            $(".producttypecheckbox_"+$(this).val()).prop('checked', false);
            $('.product_type_' + $(this).val()).prop('checked', false);

        }

    });
    
    
    $("#addtocart").click(function() {
        var checked_status = 0;

        $(".productcheckbox").each(function() {

            if ($(this).is(':checked'))

            {

                checked_status = 1;

            }

        });

        if (checked_status == 1)

        {

            var pdctid = $('#Checkbox2').val();

            $.ajax({
                type: "POST",
                data: $('#product_listing').serialize(),
                url: "products/checkItemInCartAjax",
                success: function(msg)

                {
                    

                    //alert(msg);//The items x,y and z are already added in the cart ,  you cannot add it again. So these items are unselected 

                    var obj = jQuery.parseJSON(msg);

                    //				if(obj.status==1)
                    //
                    //				{

                    //					$('#modal_mssg2').modal('show');
                    //
                    //					$('#already_added_msg2').html(obj.message);
                    //
                    //				//	$('#already_added_msg_title').html(obj.title);
                    //
                    //					$('#already_added_msg_title2').html('Warning');
                    //					
                    var pdctids = obj.product;

                    var pid = pdctids.split(",");



                    for (i = 0; i < pid.length; i++)

                    {

                        var currentcheckboxid = '.part_' + pid[i];

                        $(currentcheckboxid).removeAttr('checked');

                    }



                    //}

                    //else

                    //{	



                    $.ajax({
                        type: "POST",
                        url: "cart/addtocart",
                        data: $('#product_listing').serialize(),
                        beforeSend: function() {

                            //	   alert('asa');

                            // $("#show_class").show();

                            // $("#show_class").html("Loading ...");

                        },
                        success: function(msg) {

                            //alert(msg);
                            $('#addtocart_success_msg').html(msg)
                            $('#decision_cart').modal('show');

                        }

                    });

                    // }



                }

            });

        }

        else

        {

            $('#modal_mssg1').modal('show');

            //$('#already_added_msg_title1').html('<blink>Warning</blink>');
            blink(1);
            //$('#already_added_msg1').html('Please select at least one item');

        }

    });





});
function addtocartinnotexistingproducts()
{
    $.ajax({
        type: "POST",
        url: "cart/addtocart",
        data: $('#product_listing').serialize(),
        beforeSend: function() {

        //	   alert('asa');

        // $("#show_class").show();

        // $("#show_class").html("Loading ...");

        },
        success: function(msg) {

            //alert(msg);
            $('#addtocart_success_msg').html(msg)
            $('#decision_cart').modal('show');

        }

    });
}
function runPrdCountDownClock(targetdiv, new_time, user_delete)

{
    if (user_delete != "" && typeof user_delete != 'undefined') {
        user_session_delete = 1;
    }
    
    // this event will happen when continue shopping is clicked and in the product page timer is finished for the 1st time.
    if(user_delete == 2){
        user_session_delete = 0;
    }
    $('.alert-message').hide();

    if (new_time > 0) {

        $('.alert-message').show();

        $('#' + targetdiv).html('');

        clock = $('#' + targetdiv).FlipClock(new_time, {
            clockFace: 'HourCounter',
            countdown: true,
            callbacks: {
                stop: function() {
                    prdcountdownComplete(user_delete);
                }
            }
        });
    }

}

function prdcountdownComplete(user_delete)

{
    $.ajax({
        type: "POST",
        url: "cart/remove_all_items_from_cart/0/" + user_session_delete,
        data: '',
        beforeSend: function() {

        },
        success: function(msg) {

            $('#user_block_box').modal('show');

            $('.alert-message').hide();
            //			$('#blockMsg').html('Unfortunately you did not take any action during the given time therefore please go back to cart and use another email address to send us your request for quotation.  Thank you');
            if (user_delete == 0) {
                message = $("#cartpreview_block_msg").html();
                message = message.replace(/EMAILVAR/g, msg);
                //$('#blockMsg').html('Unfortunately you did not take any action during the given lead-time. Therefore, you will be welcome to use an alternative email or wait for 120 minutes to use the current email ' + msg + ' within our website.');
                $('#blockMsg').html(message);
                $('#blockMsg1').html("");
                $("#edit_cart_mode_on").html("edit_cart_mode_on");
            } 
            else if(user_delete == 2){
                message = $("#maincart_block_msg").html();
                message = message.replace(/EMAILVAR/g, msg);
                //$('#blockMsg').html('Unfortunately, you did not finish shopping during the given lead-time. Therefore, you will be welcome to use an alternative email or wait for 120 minutes to use the current email ' + msg + ' within our website.');
                $('#blockMsg').html(message);
                $('#blockMsg1').html("");
                $("#edit_cart_mode_on").html("edit_cart_mode_on");
            }
            else {
                message = $("#editcart_block_msg").html();
                message = message.replace(/EMAILVAR/g,msg);

                $('#blockMsg').html("");
                $('#blockMsg').html(message);
                //$('#blockMsg').html('Unfortunately, you did not finish editing the cart during the given lead-time. Therefore, you will be welcome to use an alternative email or wait for 120 minutes to use the current email ' + msg + ' within our website.');
                $('#blockMsg1').html("");
            }

        /*$('#user_block_box').modal('show');	*/





        }

    });

}

