
$(document).ready(function() {
    $('#cancel').click(function() {
        remove_popup();
    })

    $('#blackout').dblclick(function() {
        remove_popup();
    })

    $('#backToLogin').click(function() {
        remove_popup();
    })

    $('#reset_pass_form').submit(function(e) {
        e.preventDefault();
        var email = ($('#email_addy').val() != '') ? $('#email_addy').val() : alert('The email field cannot be left blank');
        reset_password(email);
    })
})
