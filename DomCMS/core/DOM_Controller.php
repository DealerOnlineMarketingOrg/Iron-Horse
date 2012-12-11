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
			//loading the member model here makes it available for any member of the dashboard controller.
			$this->active_button = $this->router->fetch_class();
			define('ACTIVE_BUTTON',$this->active_button);
			$this->validUser = ($this->session->userdata('valid_user')) ? TRUE : FALSE;
			if(!$this->validUser) redirect('login','refresh');
		}
	}
