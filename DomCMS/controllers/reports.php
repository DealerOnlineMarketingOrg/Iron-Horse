<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Reports extends DOM_Controller {
		
		public function __construct() {
			parent::__construct();	
			//loading the member model here makes it available for any member of the dashboard controller.
		}
		
		public function Index() {
			$this->Dashboard();	
		}
		
		
		public function Analytics() {
			/*
			$this->load->library('gapi');
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
		}
	
		public function Dashboard() {
			$this->load->helper('pass');
			
			/** WIDGETS **/
				$dash_css = array();
				$dash_js  = array();
				
				$widget_css = new stdClass();
				$widget_css->href = 'Assets/' . THEMEDIR . 'css/widgets.css';
				
				array_push($dash_css,$widget_css);
				
				$widget_js = new stdClass();
				$widget_js->src = 'Assets/' . THEMEDIR . 'js/widgets.js';			
				
				array_push($dash_js,$widget_js);
			/** END WIDGETS **/
			
			$data = array(
				//'widgets' => $this->user['UserModules'],
			);
			
			$header_data = array(
				'extra_css' => $dash_css,
				'extra_js' => $dash_js
			);
			
			$this->LoadTemplate('pages/dashboard',$data,$header_data);
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