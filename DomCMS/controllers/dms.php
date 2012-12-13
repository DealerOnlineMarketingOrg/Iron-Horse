<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Dms extends DOM_Controller {
		
		public function __construct() {
			parent::__construct();	
		}
	
		public function index() {
			
			/*
			| Load the template in anyway you like, my personal preference with an indexed array to be able to label what which template peice is
			|	- All you have to do is call the template otherwise
			|	- Once template is loaded the code has already ran so always load the template last.
			|   - The second paramater of the template load is the data you want to pass to the template peice.
			*/
			
			$this->LoadTemplate('pages/dashboard');
		}
		
	}
