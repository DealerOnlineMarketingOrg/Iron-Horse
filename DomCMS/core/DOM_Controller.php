<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	/**
		This is our main controller
		This controller checks the user credentials.
		If the users credentials do not pass it sends them to the login page.
	 */
	session_start();
	class DOM_Controller extends CI_Controller {
		//All we need is the construct and all controllers will pass through this on every page.
		public function __construct() {
			parent::__construct();
			//Active button sets the highlighted icon on the view
			$this->active_button = $this->router->fetch_class();
			define('ACTIVE_BUTTON',$this->active_button);
			
			//This checks the user validation
			$this->validUser = ($this->session->userdata('valid_user')) ? TRUE : FALSE;
			if(!$this->validUser) redirect('login','refresh');
		}
		
		public function LoadTemplate($filepath,$data = false) {
			/* THEME BLOCK */
			$this->load->view(DOMDIR 	. 'incl/header');
			$this->load->view(THEMEDIR 	. 'incl/dom.header.php');
			$this->load->view(DOMDIR 	. 'incl/nav');
			$this->load->view(THEMEDIR 	. $filepath, (($data) ? $data : array()));
			$this->load->view(THEMEDIR 	. 'incl/dom.footer.php');
			$this->load->view(DOMDIR 	. 'incl/footer');
		}
		
		public function Page_Not_Found() {
			
		}
		
		public function Access_Denied() {
			
		}
	}
