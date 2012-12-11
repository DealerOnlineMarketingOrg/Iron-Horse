$(document).ready(function() {
	$('.validate').validationEngine();
	//x button that closes popup
	$('div.close a').click(function() {remove_popup_form('#generic_popup','fast');});
	//prepends an astericks to any labels that are marked required
	$('label.required').prepend('<span>&#42; </span>');
	$('div.popup').find('h2').append('<span>Items marked with &#42; are required.</span>');
	$('#blackout').dblclick(function() {remove_popup_form('#generic_popup','fast');})
});