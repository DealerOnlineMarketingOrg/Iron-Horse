$(document).ready(function() {
    $('#login_form').validationEngine();
    $('a#forgot_password').click(function() {
        show_popup('ajax/forgot_pass_dialog');
    })
    
	
	
    //$('#login_form').get(0).reset();
    //$('#email').attr('value','');
})

function serialize_form(form,sendTo) {
    var fp = $(form).serialize();
    send_data_to_controller(fp,sendTo);
}

function remove_element_cache(form_ele) {
    jQuery(document).ready(function() {
        jQuery('#' + form_ele).get(0).reset();
    })
}