<?php
    /*
     * This helper writes out forms for you with codeigniters framework. 
     * Just load the helper in your function and echo the helper function in your view.
     */

    function LoginForm() {


        $form_attr = array(
            'name' => 'login_form',
            'class' => 'validate',
            'id' => 'login_form',
            'autocomplete' => 'off'
        );

        $email_address = array(
            'name' => 'email',
            'id' => 'emailInput',
            'class' => 'validate[required, custom[email]] input',
            'value' => '',
            'autocomplete' => 'off'
        );

        $password = array(
            'name' => 'password',
            'id' => 'password',
            'class' => 'validate[required,onlyLetterNumber] input',
            'value' => '',
            'autocomplete' => 'off'
        );
        
        $submit = array(
          'class' => 'button green',
          'value' => 'Login',
          'id'    => 'login_button'
        );
		
        $form_array = array(
            form_open('authenticate',$form_attr),
                '<fieldset>',
                    '<ul>',
                        '<li id="usr-field">',
                            form_input($email_address),
                            '<span style="color:red;" class="login_error">' . form_error('email') . '</span>',
                            '<span id="usr-field-icon"></span>',
                        '</li>',
                        '<li id="psw-field">',
                            form_password($password),
                            '<span style="color:red;" class="login_error">' . form_error('password') . '</span>',
                            '<span id="psw-field-icon"></span>',
                        '</li>',
                        '<li>', form_submit($submit), '</li>',
                    '</ul>',
                 '</fieldset>',
            form_close(),
            '<span id="lost-psw"><a href="' . base_url() . 'reset_password">Forgot Password?</a></span>'
        );

        $form = '';

        foreach($form_array as $item) {
            $form .= $item . "\n";
        }

        return $form;
        
    }
	
	function AgencyAddForm() {
		
		$ci =& get_instance();
		$ci->load->helper('form');
		
		$form_attr = array(
			'name' => 'add_agency_form',
			'class' => 'validate',
			'id' => 'add_agency_form'
		);	
		
		$name = array(
			'name' => 'AGENCY_Name',
			'class' => 'validate[required,onlyLetterSp] required input',
			'id' => 'agency_name'
		);
		
		$desc = array(
			'name' => 'AGENCY_Notes',
			'class' => 'input',
			'id' => 'agency_desc'
		);
		
		$active = array(
			'name' => 'AGENCY_Active',
			'value' => 1
		);
		
		$created = array(
			'name' => 'AGENCY_Created',
			'value' => date(FULL_MILITARY_DATETIME)
		);
		
		$submit_button = array(
            'id' => 'submit',
            'class' => 'button green',
            'value' => 'Add'
        );
		
		$clear_button = array(
			'id' => 'reset',
			'class' => 'button blue',
			'value' => 'Clear Form'
		);
		
		$required = array(
			'class' => 'required'
		);

		$form_array = array(
			'<div class="form_group">',
				form_open('admin/form_processor/agency/add', $form_attr),
				'<fieldset>',
					'<div>' . 
						form_label('Agency Name','agency_name',$required) . '<em>The Agency name</em>' .
						form_input($name) . 
						'<div class="error">' . form_error('name') . '</div>' .
					'</div>',
					'<div>' . 
						form_label('Agency Description', 'agency_desc') .
						form_textarea($desc)  .
						'<div class="error">' . form_error('desc') . '</div>' .
						'<div class="error">' . form_error('query_error') . '</div>' .
						form_hidden($created) . form_hidden($active) .
					'</div>',
					'<div class="buttons" style="text-align:right">' . form_reset($clear_button) . form_submit($submit_button) . '&nbsp;&nbsp;' . '</div>',
				'</fieldset>',
				form_close(),
			'</div>'
		);
		
		$form = '';
		
		foreach($form_array as $item) {
			$form .= $item . "\n";	
		}
		return $form;
	}
     
    function ForgotPassForm() {
         
        $form_attr = array(
            'name' => 'reset_pass_form',
            'class' => 'validate',
            'id' => 'reset_pass_form'
        );

        $email_input = array(
            'name' => 'email',
            'id' => 'emailInput',
            'class' => 'validate[required,custom[email]] input'
        );
        
        $submit_button = array(
            'id' => 'submit',
            'class' => 'button green',
            'value' => 'Reset Password'
        );
		
		$form_array = array(
            form_open('generate_password',$form_attr),
                '<fieldset>',
                    '<ul>',
                        '<li id="usr-field">',
                            form_input($email_input),
                            '<span class="login_error" style="color:red;">' . form_error('email') . '</span>',
                            '<span id="usr-field-icon"></span>',
                        '</li>',
                        '<li>', form_submit($submit_button), '</li>',
                    '</ul>',
                 '</fieldset>',
            form_close(),
        );

        $form = '';

        foreach($form_array as $item) {
            $form .= $item . "\n";
        }

        return $form;

    }
    
    function ChangePasswordAfterLoginForm($email) {
        //Attributes for the form
        $form_attr = array(
            'name' => 'reset_password',
            'class' => 'validate_init',
            'id' => 'change_password_form'
        );
        
        //Attributes for the new password field
        $new_pass = array(
            'id' => 'new_pass',
            'class' => 'validate[required,minSize[6],maxSize[15],onlyLetterNumber] input required',
            'name' => 'new_pass'
        );
        
        //Attributes for the confirm password field
        $confirm_pass = array(
          'id' => 'confirm_pass',
          'class' => 'validate[required,equals[new_pass],minSize[6],maxSize[15],onlyLetterNumber] input required',
          'name' => 'confirm_pass'
        );
        
        //Attributes for the submit button
        $submit_button = array(
            'id' => 'submit',
            'class' => 'button green',
            'value' => 'Change Password'
        );        
        
                
        /*
         * We build an array of the entire form
         */
	$form_array = array(
            form_open('process_change_password',$form_attr),
                form_hidden('email',$email),
                '<fieldset>',
                    '<ul>',
                        '<li id="usr-field">',
                            form_password($new_pass),
                            '<span style="color:red;">' . form_error('new_pass') . '</span>',
                            '<span id="usr-field-icon"></span>',
                        '</li>',
                        '<li id="psw-field">',
                            form_password($confirm_pass),
                            '<span style="color:red;">' . form_error('confirm_pass') . '</span>',
                            '<span id="psw-field-icon"></span>',
                        '</li>',
                        '<li>', form_submit($submit_button), '</li>',
                    '</ul>',
                 '</fieldset>',
            form_close(),
        );
        
        //Build a string for the view
        $form = '';
        
        //iterate through the form_array and create a string of html to return.
        foreach($form_array as $item) {
            $form .= $item . "\n";
        }
        
        //return the form string, this is what we echo to the view to show the form.
        //we do this so we can use this form wherever we want.
        return $form;
        
    }