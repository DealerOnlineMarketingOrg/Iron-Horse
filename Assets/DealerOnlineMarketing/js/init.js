// JavaScript Document
$(document).ready(function() {
    $('.select').select2({minimumResultsForSearch:'10'});
    $('.required').prepend('<span class="red">&#42;</span> ');
    
    $('#reset_pass_form,.validate_init').validationEngine();
    
    $('table tr:even').addClass('even');
	$('table tr:odd').addClass('odd');
	
	$('#client').change(function(evt) {
		$.ajax({
			url:'/ajax/selected_dealer',
			data:{selected_id:$('#client').val()},
			type:'POST',
			success:function(data) {
				location.reload();
			}
		});
	});
});