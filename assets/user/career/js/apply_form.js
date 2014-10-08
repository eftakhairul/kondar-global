

$(function(){

	var j = jQuery.noConflict();



	j("#countries").msDropdown();



		$('#modal_success_applyform').modal('show');

		$('#ok_bttn').click(function() {

			window.location.href = "career/index";

			return false;

	});

})





function showErrorMessage() {

	$(document).ready(function() {

		$('.modal_block').modal('show');

		$('.block_bttn').click(function() {
		
			return false;

		});



	});

}

