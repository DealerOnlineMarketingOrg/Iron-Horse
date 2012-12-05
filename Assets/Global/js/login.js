$(document).ready(function() {
    $('#login_form').validationEngine();
    $('a#forgot_password').click(function() {
        show_popup('ajax/forgot_pass_dialog');
    })
    
    //$('#login_form').get(0).reset();
    //$('#email').attr('value','');
})

function reset_password(emailTo) {
    $.ajax({
        url:'/ajax/reset_pass_warning',
        data:({email:emailTo}),
        success:function(data){
            $('#warning_message').html(data);
            //$('#w')
        }
    })
}

function send_data_to_controller(data,ctrlr) {
    $.ajax({
        url:'/' + ctrlr,
        data:data,
        method:'get',
        success:function(data) {
            $('#warning_message').html(data);
            $('#warning_message').fadeIn('fast',function() {
                $('#warning_message .popup').fadeIn('slow');
            })

        }
    })
}

function show_popup(func) {
    //first we need to call the controller to 
    //load the html in its container
    $.ajax({
       url: '/'+func,
       method:'get',
       success:function(data){
           $('#popup').html(data);
           fade_in_popup();
       }
    })
}

function fade_in_warning() {
   $('.warning').fadeIn('fast',function() {
       center_popup('.warning');
       $('.warning').fadeIn('slow');
   })
}

function fade_in_popup() {
    $('#popup #blackout').fadeIn('fast',function() {
     center_popup('.popup');
     $('#popup .popup').fadeIn('slow')
    })
}

function remove_popup() {
   $('#popup .popup').fadeOut('fast',function() {
       $('#popup #blackout').fadeOut('fast',function() {
           $('#popup').empty();
       })
   })
}

function center_popup(popupid) {
   var popuptopmargin =  '-' + ($(popupid).height() + 10) / 2;
   var popupleftmargin = '-' + ($(popupid).width()+ 10) / 2;
   
   $(popupid).css({
       'top':'20%',
       'left':'48.5%',
       'margin-left': popupleftmargin + 'px'
   })
}

function serialize_form(form,sendTo) {
    var fp = $(form).serialize();
    send_data_to_controller(fp,sendTo);
}

function remove_element_cache(form_ele) {
    jQuery(document).ready(function() {
        jQuery('#' + form_ele).get(0).reset();
    })
}