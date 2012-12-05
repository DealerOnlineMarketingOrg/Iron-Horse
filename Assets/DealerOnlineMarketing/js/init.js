// JavaScript Document
$(document).ready(function() {
    $('.select').select2({minimumResultsForSearch:'10'});
    $('.required').prepend('<span class="red">&#42;</span> ');
    
    $('#reset_pass_form,.validate_init').validationEngine();
    
});