$(function(){
	$.get('./includes/main/main.php', function(data){
		$('body').html(data);
		$('#mainContent_Loc_Bar_Add').hide();
		$('#mainNotification_Area').hide();
		dropdownLoad();
		
		$('#sidebar_Nav_Box').accordion({
		collapsible: true,
		navigation: true,
		active: false,
		autoheight: true 
	});
		
	});
});

