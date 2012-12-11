<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Administration extends CI_Model {
		
		function __construct() {
			// Call the Model constructor
			parent::__construct();
		}
		
		public function getAgencies($id = false) {
			$sql = "SELECT AGENCY_Name as Name,AGENCY_Notes as Description, AGENCY_Active as Status FROM Agencies " . (($id) ? " WHERE AGENCY_ID = '" . $id . "'" : "") . " ORDER BY AGENCY_Name; ";
			$query = $this->db->query($sql);
			
			if($query) 
				if($query->num_rows() > 1) 
					return $query->result();
				else
					return $query->row();
			else
				return FALSE;
			
		}
		
		public function getGroups($id=false) {
			
		}
			
	}