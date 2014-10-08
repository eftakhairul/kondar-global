/*$(document).ready(function() {
	$('.show_page').click(function() {
		var album_id = $(this).data('value');
				
		$(this).parent().find('.media-heading.short').toggle(200);
		$('.show_page_' + album_id).toggle(200);
		return false;
	});

});*/
$(document).ready(function() {
	$('.show_page').click(function() {
		var album_id = $(this).data('value');
				
		$('.show_page_' + album_id).parent().find('.short').toggle();                
               
		$(this).parent().find('p.scope_short').toggle(200);
		
		$('.show_page_' + album_id).toggle(200);
		$('#page_' + album_id).find('.moretext').toggle(200);                
		$('#page_' + album_id).find('.lesstext').toggle(200);                
		return false;
	});

});
 
 