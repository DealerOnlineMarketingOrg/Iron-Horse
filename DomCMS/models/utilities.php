<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Utilities extends CI_Model {
		
		public function __construct() {
			// Call the Model constructor
			parent::__construct();
			$this->load->helper('query');
		}
		
		public function getStates() {
			$sql = "SELECT STATE_NAME as Name, STATE_Abbrev as Abbrev FROM xStates ORDER BY STATE_NAME ASC";
			return query_results($this,$sql);
		}
	}
