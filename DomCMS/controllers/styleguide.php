<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Styleguide extends DOM_Controller {
		
		public function __construct() {
			parent::__construct();	
		}
		
		public function index() {
			$this->LoadTemplate('pages/styleguide');
		}
	}
