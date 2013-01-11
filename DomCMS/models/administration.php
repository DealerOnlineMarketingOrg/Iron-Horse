<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Administration extends CI_Model {
		
		function __construct() {
			// Call the Model constructor
			parent::__construct();
			$this->load->helper('query');
			$this->load->helper('string_parser');
		}
		
		public function getUsers($id = false) { 
			//query to show users info on listing and edit pages.
			$sql = "SELECT 
					u.USER_ID as ID, 
					u.USER_Name as EmailAddress,
					ui.USER_Active as Status,
					ui.USER_Created as JoinDate,
					ui.USER_ActiveTS as LastUpdate,
					ui.USER_Modules as Modules,
					d.DIRECTORY_Type as UserType,
					d.DIRECTORY_FirstName as FirstName,
					d.DIRECTORY_LastName as LastName,
					d.DIRECTORY_Address as Address,
					d.DIRECTORY_EMAIL as Emails,
					d.DIRECTORY_Phone as Phones,
					d.DIRECTORY_Notes as Notes,
					a.ACCESS_NAME as AccessName,
					a.ACCESS_Level as AccessLevel
					FROM Users u
					INNER JOIN Users_Info ui ON ui.USER_ID = u.USER_ID
					INNER JOIN xSystemAccess a ON ui.ACCESS_ID = a.ACCESS_ID
					INNER JOIN Directories d ON ui.DIRECTORY_ID = d.DIRECTORY_ID " . (($id) ? "WHERE u.USER_ID = '" . $id . "' " : "") . "
					ORDER BY d.DIRECTORY_LastName ASC LIMIT 10";
			$users = query_results($this,$sql);
			
			if($id) {
				$users->Address = group_parser($users->Address);
				$users->Emails = mod_parser($users->Emails);
				$users->Phones = mod_parser($users->Phones);
			}
			
			return $users;
		}
		
		public function getPermissionsList($userLevel) {
			$sql = "SELECT ACCESS_ID as ID, ACCESS_Name as Name,ACCESS_Level as Level,ACCESS_Perm as Modules FROM xSystemAccess WHERE ACCESS_Level <= '" . $userLevel . "' ORDER BY ACCESS_LEVEL DESC;";
			return query_results($this,$sql);
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
		
		public function getClient($id) {
			$sql = "SELECT CLIENT_ID as ID, CLIENT_Name as Name, GROUP_ID as GroupdID FROM Clients WHERE CLIENT_ID = '" . $id . "';";
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