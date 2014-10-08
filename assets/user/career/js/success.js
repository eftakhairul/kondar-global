$(document).ready(function() {
	$('#modal_success').modal('show');
	$('#ok_bttn').click(function() {
		window.location.href = "career";
		return false;
	});
})