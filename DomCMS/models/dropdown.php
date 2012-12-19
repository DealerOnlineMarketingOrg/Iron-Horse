<? if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dropdown extends CI_Model {
	
	public function __construct(){
		// Call the Model constructor
        parent::__construct();
		$this->load->helper('query');
    }
		
	public function AgenciesQuery($a_id = false, $expect_row = false) {
		$sql ="SELECT * FROM Agencies WHERE AGENCY_Active = 1 " . (($a_id) ? "AND AGENCY_ID = '" . $a_id . "'" : '') . " ORDER BY AGENCY_Name";
		if(!$expect_row) :
			return query_results($this,$sql);
		else :
			return query_row($this,$sql);
		endif;
	}
	
	public function GroupsQuery($g_id = false, $a_id = false, $expect_row = false) {
		$sql = "SELECT * FROM Groups WHERE " . (($g_id) ? "GROUP_ID = '" . $g_id . "' " : " AGENCY_ID = '" . $a_id . "' ") . "AND GROUP_Active = '1' ORDER BY GROUP_Name;";
		if(!$expect_row) :
			return query_results($this,$sql);
		else :
			return query_row($this,$sql);
		endif;
	}
	
	public function ClientQuery($c_id = false ,$g_id = false, $expect_row = false) {
		$sql = "SELECT * FROM Clients WHERE " . (($c_id) ? " CLIENT_ID = '" . $c_id . "' " : " GROUP_ID = '" . $g_id . "' ") . "AND CLIENT_Active = '1' ORDER BY CLIENT_Name";
		if(!$expect_row) :
			return query_results($this,$sql);
		else:
			return query_row($this,$sql);
		endif;
	}
	
	public function TagQuery(){
		$sql = "SELECT * FROM xTags WHERE TAG_Active= 1";
		return query_results($this,$sql);
	}
	
	public function Group_Selected_Check($id){
		$sql = "SELECT CLIENT_ID FROM Clients WHERE GROUP_ID='".$id."'";
		$query = $this->db->query($sql);
		return $query->result();
	}
}

