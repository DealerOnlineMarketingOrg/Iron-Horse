<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    class Ajax extends CI_Controller {
        
        public function __construct() {
            parent::__construct();	
            //loading the member model here makes it 
            //available for any member of the dashboard controller.
            $this->load->model('members');
            $this->load->helper('form');
            $this->load->helper('url');
            $this->load->helper('pass');
        }

        
        public function reset_pass_warning() {
            $email = $this->input->get('email');
            $msg = 'Are you sure you want to reset your password?';
            $data = array(
                'email' => $email,
                'msg' => $msg
            );
            $this->load->view(THEMEDIR . 'forms/warning_popups/forgotpass_warning', $data);
        }
        
        //called by ajax to display the popup
        public function forgot_pass_dialog() {
            $this->load->helper('formwriter');
            $data = array(
              'form' => ForgotPassForm()  
            );
            $this->load->view(THEMEDIR . 'forms/auth/forgotpass', $data);
        }
        
        public function reset_pass() {
            $email = $this->input->get('email');
            $password = createRandomString(8,'ALPHANUM');
            
            $reset = $this->members->reset_password($email, $password);
            
            if($reset) {
                echo '1';
            }else {
                echo '2';
            }
        }
        
        public function change_password() {
            //users email address will post to this controller method.
            //we need to get it from the post
            $email        = $this->input->get('email');
            $old_pass     = $this->input->get('old_pass');  
            $new_pass     = $this->input->get('new_pass');
            $confirm_pass = $this->input->get('confirm_pass');
            
            $salted1 = pass_salt($new_pass);
            $salted2 = pass_salt($confirm_pass);
            
            if($salted1 == $salted2) {
                              
                //We need to validate the old password first, if the old password is valid, the model returns TRUE ELSE FALSE;
                $valid_user = $this->members->check_user($email,$old_pass)->row();
               
                if($valid_user) {
                    $change_password = $this->members->password_change($valid_user->USER_ID, $salted1);
                    echo $change_password;
                }  
          
            }else {
                echo '1';
            }            
            
        }

    }
