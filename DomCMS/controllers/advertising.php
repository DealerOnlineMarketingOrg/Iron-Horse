<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Advertising extends DOM_Controller {
		
		var $active_button;
		
		public function __construct() {
			parent::__construct();	
		}
	
		public function index() {
			$this->LoadTemplate('pages/dashboard');
		}
		
	}
