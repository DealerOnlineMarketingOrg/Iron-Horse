<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Rep extends CI_Model {
		
		function __construct() {
			// Call the Model constructor
			parent::__construct();
			$this->load->helper('query');
		}
		
		public function getProviders() {
			$sql = 'SELECT PROVIDER_ID as ID,PROVIDER_Name as Name,PROVIDER_URL as URL FROM DPRProviders ORDER BY PROVIDER_Name ASC;';
			return query_results($this,$sql);
		}
		
		public function getService() {
			$sql = 'SELECT SERVICE_ID as ID,SERVICE_Name as Name FROM DPRReportServices ORDER BY SERVICE_Name ASC;';
			return query_results($this,$sql);
		}
		
		public function getReport($provider_id, $service_id, $client_id) {
			$sql = 'SELECT REPORT_Date as ReportDate,REPORT_Value as ReportData FROM DPRReports WHERE CLIENT_ID = "' . $client_id . '" AND REPORT_Provider = "' . $provider_id . '" AND REPORT_Service = "' . $service_id . '" ORDER BY REPORT_Provider,REPORT_Service,REPORT_Date;';
			return query_results($this,$sql);
		}
		
		public function getDPR($client_id) {
			$report = array();
			$providers = $this->getProviders();
			
			foreach($providers as $provider) {
				$provider->Services = $this->getService();
				foreach($provider->Services as $service) {
					$service->Reports = $this->getReport($provider->ID,$service->ID,$client_id);
				}
				
				array_push($report,$provider);
			}
			
			return $report;
		}
		
		
	}
