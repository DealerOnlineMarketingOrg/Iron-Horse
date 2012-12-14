<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Reports extends DOM_Controller {
		
		public function __construct() {
			parent::__construct();	
			//loading the member model here makes it available for any member of the dashboard controller.
		}
	
		public function Dashboard() {
			$this->load->helper('pass');
			/*
				$ga = $this->gapi;
				$ga->requestReportData(54919407,array('browser','browserVersion'),array('pageviews','visits'));
				$google = '';
				foreach($ga->getResults() as $result) {
					$google = '<strong>'.$result.'</strong><br />';
					$google .= 'Pageviews: ' . $result->getPageviews() . ' ';
					$google .= 'Visits: ' . $result->getVisits() . '<br />'; 
				}
				$google .= '<p>Total pageviews: ' . $ga->getPageviews() . ' total visits: ' . $ga->getVisits() . '</p>';
			*/
			$this->ValidUser = $this->session->userdata('valid_user');
			$this->DropdownDefault = $this->ValidUser['DropdownDefault'];
			//var_dump($this->DropdownDefault);    
			$google = '';
			
			$data = array(
				'google' => $google
			);
			
			$this->LoadTemplate('pages/dashboard',$data);
		}
		
		public function DPR() {
			$this->LoadTemplate('pages/dashboard');
		}
		
		public function Reports_query() {
			$this->LoadTemplate('pages/dashboard');
		}
		
		public function Gameday() {
			$this->LoadTemplate('pages/dashboard');
		}
		
		public function Dms_database() {
			$this->LoadTemplate('pages/dashboard');
		}
		
		public function Web() {
			$this->LoadTemplate('pages/dashboard');
		}
		
		public function Leads() {
			$this->LoadTemplate('pages/dashboard');	
		}
		
	}