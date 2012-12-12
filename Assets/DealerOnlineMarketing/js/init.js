// JavaScript Document
$(document).ready(function() {
    $('.select').select2({minimumResultsForSearch:'10'});
    $('.required').prepend('<span class="red">&#42;</span> ');
        
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
		
	$('#tags').change(function(evt) {
		$.ajax({
			url:'/ajax/selected_tag',
			data:{selected_tag:$('#tags').val()},
			type:'POST',
			success:function(data) {
				location.reload();
			}
		});
	});
		
	$('#add_agency_btn').click(function() {
		$.ajax({
			url:'/ajax/add_agency_popup',
			type:'POST',
			success:function(data) {
				if(data) {
					$('#generic_popup').html(data);	
					fade_in_popup('#generic_popup','fast');
				}
			}
		});
	});
	
});

function fade_in_popup(div,speed) {
	jQuery(div).find('#blackout').fadeIn(speed,function() {
		jQuery(div).find('.popup').fadeIn(speed);
	});
}