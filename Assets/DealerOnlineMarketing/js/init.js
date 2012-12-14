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
	
	$('#error_notification div.close').click(function() {
		$(this).parent().slideUp('fast');
	});
	
});

function remove_popup_form(div,speed) {
	jQuery(div).find('div.popup').fadeOut(speed,function() {
		jQuery(div).find('#blackout').fadeOut(speed,function() {
			jQuery(div).empty();	
		});
	});
}

function fade_in_popup(div,speed) {
	center_popup(div);	
	jQuery(div).find('#blackout').fadeIn(speed,function() {
		jQuery(div).find('.popup').fadeIn(speed);
	});
}

function center_popup(div) {
	var margin_left = (jQuery(div).find('div.popup').width()  + 10) / 2;
	var margin_top  = (jQuery(div).find('div.popup').height() + 10) / 2;
	$(div).find('div.popup').css({
		'margin-top': '-' + margin_top + 'px',
		'margin-left': '-' + margin_left + 'px'
	});
}