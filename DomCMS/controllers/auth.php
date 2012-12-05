<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

session_start();

class Auth extends CI_Controller {
    
    var $user_session;
    var $attemps;
	
    public function __construct() {
        parent::__construct();	
        //loading the member model here makes it 
        //available for any member of the dashboard controller.
        $this->load->model('members');
        $this->load->helper('form');
        $this->load->helper('formwriter');
		$this->load->helper('pass');
    }
    
	//login form
    public function Login() {
        $this->load->view(THEMEDIR . 'forms/auth/login');
    }
    
    //logout function
    public function Logout() {
        $this->session->unset_userdata('valid_user');
        $this->load->view(THEMEDIR . 'forms/auth/login');
    }
    //this is the page to change your password if your password is a computer generated pass.
    public function Change_password() {
        $user = (object)$this->session->userdata['valid_user'];
        $data = array(
            'form' => ChangePasswordForm($user->USER_Name)
        );
        $this->load->view(THEMEDIR . 'forms/auth/changepass',$data);
    }
	
	//This is the page generated to reset the password by email address.
	public function Reset_password() {
		$this->load->helper('formwriter');
		$data = array(
			'form' => ForgotPassForm()
		);
		$this->load->view(THEMEDIR . 'forms/auth/forgotpass',$data);
	}
	
	//Process forgot password form
	public function Process_forgot_pass() {
		$this->load->library('form_validation');
		$this->load->model('members');
		//validation rules
		$this->form_validation->set_rules('email','Email Address','trim|required|valid_email|xss_clean');
		$this->form_validation->set_error_delimiters('<div class="error">','</div>');
		if($this->form_validation->run() != FALSE) {
			$email 		= $this->input->post('email');
			$password 	= createRandomString(8,'ALPHANUM');
			$change 	= $this->members->password_reset($email,$password);
			if(!$change) {
				$this->form_validation->set_message('email','This email address could not be found in our system. Please make sure you have the correct account and try again.');
				$data = array(
					'form' => ForgotPassForm()
				);
				$this->load->view(THEMEDIR . 'forms/auth/forgotpass',$data);
			}else {
				
			}
		}else {
			$this->form_validation->set_message('email','The email address is required to reset the password');
			$data = array(
				'form' => ForgotPassForm()
			);
			$this->load->view(THEMEDIR . 'forms/auth/forgotpass',$data);	
		}
	}
        
    //Process the login
    public function Login_user() { 
        $this->load->library('form_validation');
		$this->load->model('login_attempts');		
		$this->load->helper('formwriter');
		
        //validation rules
        $this->form_validation->set_rules('email','Email','trim|required|valid_email|xss_clean');
        $this->form_validation->set_rules('password','Password','trim|required|alpha_numeric|xss_clean');
        $this->form_validation->set_error_delimiters('<div class="error">','</div>');
		
		//form elements posted to controller function
		$email 		= 	$this->input->post('email');
		$password 	= 	$this->input->post('password');
		$ip_address = 	$this->input->ip_address();
		
		
		//If its not a valid IP Address, kill the app.
		if(!$this->input->valid_ip($ip_address)) {
			die('Your system does not have a valid ip address associated with it. We require that you do.');
		};
		
		//check how many times this email address from this IP address has attempted to login unsuccessfully.
		$check_login_attempts = $this->login_attempts->get_attempts_count($ip_address,$email);
		
		//if the login attempts go above 5 times, we show the reset password page instead.
		if(!$check_login_attempts >= 6) {
			//run the form validation
			if($this->form_validation->run() == FALSE) {
				//set some custom error messages
				$this->form_validation->set_message('valid_email','The email address provided is the incorrect format. Please try again.');
				$this->form_validation->set_message('required','Some required elements were left unfilled. Please try again.');
				$this->form_validation->set_message('alpha_numeric','The password only allows alpha and numeric values. Please Try again.');
				
				//load the login view and show error messages
				$this->load->view(THEMEDIR . 'forms/auth/login');
				
				//add a failed login attempt
				$this->login_attempts->increase_attempt($ip_address, $email);
			}else {	
				
			
				$user = $this->members->validate();
				$user = (object)$user;
				
				//print_object($user);
				
				//if the user failed to authenticate.
				//set some error messages and increment our login attempts var.
				//show the login form.
				if(!$user) {
					
					$this->form_validation->set_rules('email',	  'Your email address or password is incorrect.');
					$this->form_validation->set_rules('password', 'Your email address or password is incorrect.');
					
					//increment failed login
					$this->login_attempts->increase_attempt($ip_address, $user->Username);
					
					//load form
					$this->load->view(THEMEDIR . 'forms/auth/login');	
						
				}else {
					
				    //clear any failed login attempts
				    $this->login_attempts->clear_attempts($ip_address, $email);
					
				    //check to see if the users password has been generated by our system
					if($user->isGenerated != 0) {
					   $data = array(
						   'form' => ChangePasswordAfterLoginForm($user->Username)
					   );
					   
					   //load the change password form after a user logs in
					   $this->load->view(THEMEDIR . 'forms/auth/changepass', $data);
					}else {
					   redirect('dashboard','refresh');
					}
					
				}  
			}
			
		}else {
			//after the 5th failed login, send the user to reset password page. 
			$this->form_validation->set_message('login_attemps','You have exceeded 5 login attempts for this username with your current session. This Email address will be locked out of our system for 24 hrs unless you call support. You may reset the password for the user and try to log in with the generated password. Sorry for the inconvienience.');
			$this->load->view(THEMEDIR . 'forms/auth/forgotpass');
		}
    } 
	
    
    public function Password_change() {
        $this->load->library('form_validation');
        //validation rules
        $this->form_validation->set_rules('new_pass','New Password','trim|required|min_length[6]|max_length[30]|alpha_numeric');
        $this->form_validation->set_rules('confirm_pass','Password Confirmation', 'trim|required|matches[new_pass]|min_length[6]|max_length[30]|alpha_numeric');
        $this->form_validation->set_rules('email','Email Address','trim');
        
        $this->form_validation->set_error_delimiters('<div class="error">','</div>');
        
        if($this->form_validation->run() == FALSE) {
            $this->form_validation->set_message('required',         'Fields marked with * are required.');
            $this->form_validation->set_message('min_length',       'Your new password must be a minimum of 6 characters. Please try again.');
            $this->form_validation->set_message('max_length',       'Your new password cannot be more than 30 characters. Please try again.');
            $this->form_validation->set_message('alpha_numeric',    'Your new password can only contain alpha and numeric characters. Please try again.');
            $this->form_validation->set_message('matches',          'Both New Password and Confirm Password must be the same. Please try again.');
        }else {
            $email = $this->input->post('email');
            $password = $this->input->post('new_pass');
            $change = $this->members->change_pass($email,$password);
			
			if($change) {
				redirect('dashboard','refresh');	
			}else {
				$data = array(
					'form' => ChangePasswordAfterLoginForm($email)
				);
				$this->load->view(THEMEDIR . 'forms/auth/changepass',$data);
			}
        }
    }


}