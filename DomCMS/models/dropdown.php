<? if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dropdown extends CI_Model {
	
	function __construct(){
		// Call the Model constructor
        parent::__construct();
    }
		
	public function AgenciesQuery($a_id = false, $expect_row = false) {
		$sql ="SELECT * FROM Agencies WHERE AGENCY_Active = 1 " . (($a_id) ? "AND AGENCY_ID = '" . $a_id . "'" : '') . " ORDER BY AGENCY_Name";
		$query = $this->db->query($sql);
		if(!$expect_row) {
			return $query->result();
		}else {
			return $query->row();	
		}
	}
	
	public function GroupsQuery($g_id = false, $a_id = false, $expect_row = false) {
		$sql = "SELECT * FROM Groups WHERE " . (($g_id) ? "GROUP_ID = '" . $g_id . "' " : " AGENCY_ID = '" . $a_id . "' ") . "AND GROUP_Active = '1' ORDER BY GROUP_Name;";
		$query = $this->db->query($sql);
		if(!$expect_row) {
			return $query->result();
		}else {
			return $query->row();	
		}
	}
	
	public function ClientQuery($c_id = false ,$g_id = false, $expect_row = false) {
		$sql = "SELECT * FROM Clients WHERE " . (($c_id) ? " CLIENT_ID = '" . $c_id . "' " : " GROUP_ID = '" . $g_id . "' ") . "AND CLIENT_Active = '1' ORDER BY CLIENT_Name";
		$query = $this->db->query($sql);
		if(!$expect_row) {
			return $query->result();
		}else {
			return $query->row();	
		}
	}
	
	public function TagQuery(){
		$sql = "SELECT * FROM xTags WHERE TAG_Active= 1";
		$query = $this->db->query($sql);
		return $query->result();
	}
}

