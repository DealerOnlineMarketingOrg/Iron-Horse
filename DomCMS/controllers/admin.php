<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Admin extends DOM_Controller {
	
		var $header_data;
		
		public function __construct() {
			parent::__construct();	
			//loading the member model here makes it available for any member of the dashboard controller.
			$this->load->model('administration');
		}
	
		public function index() {
			
			/*
			| Load the template in anyway you like, my personal preference with an indexed array to be able to label what which template peice is
			|	- All you have to do is call the template otherwise
			|	- Once template is loaded the code has already ran so always load the template last.
			|   - The second paramater of the template load is the data you want to pass to the template peice.
			*/
			
			/* THEME BLOCK */
			$this->load->view(DOMDIR 	. 'incl/header');
			$this->load->view(THEMEDIR 	. 'incl/dom.header.php');
			$this->load->view(DOMDIR 	. 'incl/nav');
			$this->load->view(THEMEDIR 	. 'pages/dashboard');
			$this->load->view(THEMEDIR 	. 'incl/dom.footer.php');
			$this->load->view(DOMDIR 	. 'incl/footer');
		}
		
		public function Agency() {
			/**
			  * Agency list based on permission level.
			  */
			$data = array(
				'agencies' => (($this->session->userdata['valid_user']['AccessLevel'] >= 100000) ? $this->administration->getAgencies(false) : $this->administration->getAgencies($this->session->userdata['valid_user']['AgencyID'])),
				'userLvl'  => $this->session->userdata['valid_user']['AccessLevel']
			);
			
			/* THEME BLOCK */
			$this->load->view(DOMDIR 	. 'incl/header');
			$this->load->view(THEMEDIR 	. 'incl/dom.header.php');
			$this->load->view(DOMDIR 	. 'incl/nav');
			$this->load->view(THEMEDIR 	. 'pages/admin/agency',$data);
			$this->load->view(THEMEDIR 	. 'incl/dom.footer.php');
			$this->load->view(DOMDIR 	. 'incl/footer');
		}
		
		public function Edit_agency($agency_id) {
			$data = array(
				'agencies' => (($this->session->userdata['valid_user']['AccessLevel'] >= 100000) ? $this->administration->getAgencies(false) : $this->administration->getAgencies($this->session->userdata['valid_user']['AgencyID'])),
				'userLvl'  => $this->session->userdata['valid_user']['AccessLevel']
			);
			
			/* THEME BLOCK */
			$this->load->view(DOMDIR 	. 'incl/header');
			$this->load->view(THEMEDIR 	. 'incl/dom.header.php');
			$this->load->view(DOMDIR 	. 'incl/nav');
			$this->load->view(THEMEDIR 	. 'pages/admin/agency',$data);
			$this->load->view(THEMEDIR 	. 'incl/dom.footer.php');
			$this->load->view(DOMDIR 	. 'incl/footer');
		}
	
	}
