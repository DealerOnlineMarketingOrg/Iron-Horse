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
		
		public function getAccessLevels() {
			$sql = "SELECT ACCESS_Name as Name, ACCESS_Level as Level FROM xSystemAccess ORDER BY ACCESS_LEVEL DESC";
			return query_results($this,$sql);	
		}
	}
