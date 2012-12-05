// JavaScript Document

function dropdownLoad() {
            
	$("#firstSelection").hide();
			
	$(".dropdown dt a").click(function() {
    	$(".dropdown dd ul").toggle();
    });
                        
    $(".dropdown dd ul li a").click(function() {
    	var text = $(this).html();
        $(".dropdown dt a span").html(text);
		if (!($("#firstSelection").is(":visible"))){
			$("#firstSelection").show();
		}
		$.post('./includes/header/dropdown/change.php', {'selection': getSelectedValue("dealerDropdown_Value")}, function(data){
			console.log('sending ' + getSelectedValue("dealerDropdown_Value") + ' to dashboard.');
			widget();
			//console.log('sidebar - call');
			sidebar();
			setTimeout(function(){dashboard()},250);
			
						
			
		});
        $(".dropdown dd ul").hide();
		//Commented by JM - Use Later//
        //$("#result").html("Selected value is: " + getSelectedValue("dealerDropdown_Value"));//
	});
                        
    function getSelectedValue(id) {
    	return $("#" + id).find("dt a span.value").html();
    }

    $(document).bind('click', function(e) {
    	var $clicked = $(e.target);
        if (! $clicked.parents().hasClass("dropdown"))
        	$(".dropdown dd ul").hide();
    });

};
