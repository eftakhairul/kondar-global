<style>
.searchdiv ul{ 
background:#FFFFFF; 
list-style:none;
position: absolute;
z-index: 9999;
width: 215px;
max-height:80px; 
overflow:auto; 
margin-left:-46px;
-webkit-margin-before: 0;
-webkit-margin-after: 0em;
-webkit-margin-end: 0px;
-webkit-padding-start: 0px;}
.searchdiv ul a{color: #000000;}
.searchdiv ul a li:hover{background:#CCCCCC;}
[7:27:02 PM] Remya Murali: $('#searchresult').hide();
</style>
<script type="text/javascript">
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
 window.location.href="products/product_list/"+ $('#Search').val();
}
</script>
<div class="col-md-2">
    <div class="searchdiv">
    	<label for="Search" style="display:none;">Search</label>        
        <input id="Search" type="text" name="Articles" placeholder="Search For Articles" />
        <ul id="searchresult" class="">
        </ul>
    </div>
</div>