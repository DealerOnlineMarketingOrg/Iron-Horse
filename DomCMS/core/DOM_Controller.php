<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	/**
		This is our main controller
		This controller checks the user credentials.
		If the users credentials do not pass it sends them to the login page.
	 */
	session_start();
	class DOM_Controller extends CI_Controller {
		//All we need is the construct and all controllers will pass through this on every page.
		
		public $user;
		
		public function __construct() {
			parent::__construct();
			$this->load->helper('template');
			//Active button sets the highlighted icon on the view
			$active_button = $this->router->fetch_class();
			$current_subnav_button = $this->uri->rsegment(2); // The Function 
			
			define('ACTIVE_BUTTON',$active_button);
			define('SUBNAV_BUTTON','/' . $active_button  . '/' . $current_subnav_button);
			
			$this->user = $this->session->userdata('valid_user');
			
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
			$this->LoadTemplate('pages/404');
		}
		
		public function Access_Denied() {
			
		}
		
		public function Form_processor($page, $which) {
			if($which == 'add') :
				if($page == 'agency') :
					//create array from port post elements
					$form = $this->input->post();
					$add = $this->administration->addAgencies($form);
					if($add) {
						redirect('/admin/agency/success','location');
					}else {
						redirect('admin/agency/add/error', 'location');	
					}
				endif;
			elseif($which == 'edit') :
				
			elseif($which == 'delete') :
			
			endif;
		}
	}
