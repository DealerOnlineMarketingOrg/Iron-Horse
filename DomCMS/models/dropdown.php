<? 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class DealerSelector extends CI_Model {
	
	var $validUser;
	var $DropdownDefault;
	
	function __construct(){
		// Call the Model constructor
        parent::__construct();
		$this->load->helper('string_parser');
		$this->validUser=$this->session->userdata('valid_user');
		$this->DropdownDefault=$this->session->userdata('DropdownDefault');
    }
	
	
	
	public function DealerSelector(){
		//Set vars for dropdown
		$LevelType = $this->DropdownDefault['LevelType'];
		$LevelID = $this->DropdownDefault['LevelID'];
		$DDData = array();
		//set case switches
		switch($LevelType){
			//start of Super-Admin
			case 'SA':
			
			$aSql ="SELECT a.* FROM Agencies a ORDER BY a.AGENCY_Name";
			$aQuery = $this->db->query($aSql);
			foreach ($aQuery->result() as $aRow){
				//Put Agency in Array HERE! CAN BE MORE THAN ONE!!    <<<---- PLEASE
				// And default to SELECTED if $LevelID = AGENCY_ID 
				// And no-indent and  agency style
				
  			 	$gSql ="SELECT g.* FROM Groups g WHERE g.AGENCY_ID =".$aRow[0]." ORDER BY g.GROUP_Name";
				$gQuery = $this->db->query($gSql);
				foreach ($gQuery->result() as $gRow){
					
					
					$cSql ="SELECT c.* FROM Clients c WHERE c.GROUP_ID =".$gRow[0]." ORDER BY c.CLIENT_Name";
					$cQuery = $this->db->query($cSql);
					
					if($cQuery->num_rows > 1):
            			//Show Group Name before Clients Returns. 
						//And single-indent group style
						$clientstyle = 'double-indent';
			        else:
            			//only one client no group displayed.
						$clientstyle = 'single-indent';
						//use this style for single client groups
					endif;
					
					foreach ($query1->result() as $gRow){
					
						//Client stuff here
						//use style above for indention -->>  $clientstyle  <<--
						// style client
						
					}
				}
			 } 
			
			break;
			//end of Super-Admin
			
			//start of Admin
			case 'A':
			break;
			//end of Admin
			
			//start of Group-Admin
			case 'G':
			break;
			//end of Group-Admin
			
			//start Client-Admin or less
			case 'C':
			$sql = "SELECT * FROM Clients c WHERE c.CLIENT_ID=".$LevelID;
			$query = $this->db->query($sql);
			if ($query->num_rows() == 1):
			   $DDData['SelectorID'] = $row['CLIENTID'];
			   $DDData['SelectorName'] = $row['CLIENT_Name'];
			  $DDData['SelectorClass'] = 'no-indent client';			
			endif;
			break;
			//end of Client-Admin or less
			
			
			default:
			//if case fails
			$DDData="oops";
			
			break;
		}
	}
}

			
//if($query->num_rows() == 1) {
//   $row = $query->row();
?>