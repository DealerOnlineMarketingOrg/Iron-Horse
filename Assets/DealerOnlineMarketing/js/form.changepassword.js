$(document).ready(function() {
    
    $('#change_password_form').submit(function($evt) {
        //Stop the form from submitting normally
        $evt.preventDefault();
        
        //send the form fields as a query string to the controller
        var dataString = $(this).serialize();
        
        //use ajax to call the controller to process the data.
        //return if the process was successfull or not.
        //if the process wasnt successful, show custom error messages.
        $.ajax({
            url:'/ajax/change_password',
            data:dataString,
            method:'post',
            success:function(data) {
                if(data == '2') {
                    //if everything pans out ok, we fire this.
                    $('#change_password_block').prepend('<div class="block success">Your password was changed successfully</div>');
                    $('#change_password_block').find('input[type=password]').val('');
                    $('form,p').hide('slow');
                }else if(data == '3') {
                    //This fires if there is a problem with the update query
                    $('#change_password_block').prepend('<div class="block error">There was an error with your submission. Please try again.</div>');
                    //If the passwords do not match, we fire this.
                }else if(data == '1') {
                    $('#change_password_block').prepend('<div class="block error">The passwords do not match. Please try again.</div>');
                }
            }
        })
    })
})