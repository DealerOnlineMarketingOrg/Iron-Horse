<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Administration extends CI_Model {
		
		function __construct() {
			// Call the Model constructor
			parent::__construct();
			$this->load->helper('query');
		}
		
		public function getAgencies() {
			$sql = "SELECT AGENCY_ID as Id, AGENCY_Name as Name,AGENCY_Notes as Description, AGENCY_Active as Status FROM Agencies ORDER BY AGENCY_Name; ";
			return query_results($this,$sql);
		}
		
		public function getGroups($id) {
			$sql = "SELECT 
					g.GROUP_ID as GroupId, 
					g.AGENCY_ID as AgencyId, 
					g.GROUP_Name as Name, 
					g.GROUP_Notes as Description, 
					g.GROUP_Active as Status, 
					g.GROUP_Created as CreateDate ,
					a.AGENCY_Name as AgencyName,
					a.AGENCY_ID as AgencyId
					FROM Groups g 
					INNER JOIN Agencies a
						ON g.AGENCY_ID = a.AGENCY_ID
					WHERE g.AGENCY_ID = '" . $id . "';";
			return query_results($this,$sql);
			
		}
		
		public function getTypeList() {
			$sql = "SELECT TITLE_ID as Id, TITLE_Name as Name FROM xTitles ORDER BY TITLE_Name;";
			return query_results($this,$sql);	
		}
		
		public function addAgencies($data) {
			if($this->db->insert('Agencies', $data))
				return TRUE;
			else
				return FALSE;
		}
		
		public function getAgencyByID($id) {
			$sql = "SELECT 
					AGENCY_ID as Id, 
					AGENCY_Name as Name, 
					AGENCY_Notes as Description, 
					AGENCY_Active as Status, 
					AGENCY_Created as Created 
					FROM Agencies WHERE AGENCY_ID = '" . $id . "';";
					
			return query_results($this,$sql);
		}
		
		public function updateAgencyInformation($data) {
			if($this->db->update('Agencies',$data))
				return TRUE;
			else
				return FALSE;	
		}
			
	}