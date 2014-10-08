$(document).ready(function(){
	$('input, textarea').placeholder();

	// Slider
	$('.bxslider').bxSlider({
        mode: 'fade',
        captions: true,
        auto: true,
        pager: false,
        controls:false,
    });
})