<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Dashboard extends DOM_Controller {
		
		public function __construct() {
			parent::__construct();	
			//loading the member model here makes it available for any member of the dashboard controller.
		}
	
		public function index() {
			$this->load->helper('pass');
			
			/*
			| Load the template in anyway you like, my personal preference with an indexed array to be able to label what which template peice is
			|	- All you have to do is call the template otherwise
			|	- Once template is loaded the code has already ran so always load the template last.
			|   - The second paramater of the template load is the data you want to pass to the template peice.
			*/
	
			/*$ga = $this->gapi;
			$ga->requestReportData(54919407,array('browser','browserVersion'),array('pageviews','visits'));
			$google = '';
			foreach($ga->getResults() as $result) {
				$google = '<strong>'.$result.'</strong><br />';
				$google .= 'Pageviews: ' . $result->getPageviews() . ' ';
				$google .= 'Visits: ' . $result->getVisits() . '<br />'; 
			}
	
			$google .= '<p>Total pageviews: ' . $ga->getPageviews() . ' total visits: ' . $ga->getVisits() . '</p>';
			*/		        
			$google = '';
			
			$data = array(
				'google' => $google
				//'user' => $this->session->userdata('valid_user')
			);
			
			$this->LoadTemplate('pages/dashboard',$data);
		}	
	}