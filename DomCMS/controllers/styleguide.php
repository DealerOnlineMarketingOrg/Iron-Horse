<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Styleguide extends DOM_Controller {
		
		public function __construct() {
			parent::__construct();	
		}
		
		public function index() {
			
			/* THEME BLOCK */
			$this->load->view(DOMDIR 	. 'incl/header');
			$this->load->view(THEMEDIR 	. 'incl/dom.header.php');
			$this->load->view(DOMDIR 	. 'incl/nav');
			$this->load->view(THEMEDIR 	. 'pages/styleguide.php');
			$this->load->view(THEMEDIR 	. 'incl/dom.footer.php');
			$this->load->view(DOMDIR 	. 'incl/footer.php');
	
		}
	}
