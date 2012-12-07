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
			
			$aSql ="SELECT a.* FROM Agencies a ORDER BY a.AGENCY_Name WHERE a.AGENCY.Active = 1";
			$aQuery = $this->db->query($aSql);
			foreach ($aQuery->result() as $aRow){
				// And default to SELECTED if $LevelID = AGENCY_ID 
				// And no-indent and  agency style
				$agentstyle = 'no-indent';
				//check for default agency
				if($aRow['AGENCY_ID']==$LevelID):
				$selected = 'selected="selected"';
				else:
				$selected = '';
				endif;
				
				//Put Agency in Array HERE! CAN BE MORE THAN ONE!!    <<<---- PLEASE  ---->>>
								
  			 	$gSql ="SELECT g.* FROM Groups g WHERE g.AGENCY_ID =".$aRow[0]." AND g.GROUP_Active = 1 ORDER BY g.GROUP_Name";
				$gQuery = $this->db->query($gSql);
				foreach ($gQuery->result() as $gRow){
					
					
					$cSql ="SELECT c.* FROM Clients c WHERE c.GROUP_ID =".$gRow[0]." AND c.CLIENT_Active = 1 ORDER BY c.CLIENT_Name";
					$cQuery = $this->db->query($cSql);
					
					if($cQuery->num_rows > 1):
            			//Put Group in Array HERE! CAN BE MORE THAN ONE!!    <<<---- PLEASE  ---->>>
						//And single-indent group style
						$groupstyle = 'single-indent';
						$clientstyle = 'double-indent';
						//And style client as double if more than one.
			        else:
            			//only one client no group displayed.
						$clientstyle = 'single-indent';
						//use this style for single client groups
					endif;
					
					foreach ($query1->result() as $cRow){
					
						//Client stuff here
						//use style above for indention -->>  $clientstyle  <<--
						
						
					}
				}
			 } 
			
			break;
			//end of Super-Admin
			
			
			
			//start of Admin
			case 'A':
				$aSql ="SELECT a.* FROM Agencies a ORDER BY a.AGENCY_Name WHERE a.AGENCY_ID =". $LevelID ." AND a.AGENCY.Active = 1";
				$aQuery = $this->db->query($aSql);
			foreach ($aQuery->result() as $aRow){
				// And default to SELECTED if $LevelID = AGENCY_ID 
				// And no-indent and  agency style
				$agentstyle = 'no-indent';
				//check for default agency
				if($aRow['AGENCY_ID']==$LevelID):
				$selected = 'selected="selected"';
				else:
				$selected = '';
				endif;
				
				//Put Agency in Array HERE! CAN BE MORE THAN ONE!!    <<<---- PLEASE  ---->>>
								
  			 	$gSql ="SELECT g.* FROM Groups g WHERE g.AGENCY_ID =".$aRow[0]." AND g.GROUP_Active = 1 ORDER BY g.GROUP_Name";
				$gQuery = $this->db->query($gSql);
				foreach ($gQuery->result() as $gRow){
					
					
					$cSql ="SELECT c.* FROM Clients c WHERE c.GROUP_ID =".$gRow[0]." AND c.CLIENT_Active = 1 ORDER BY c.CLIENT_Name";
					$cQuery = $this->db->query($cSql);
					
					if($cQuery->num_rows > 1):
            			//Put Group in Array HERE! CAN BE MORE THAN ONE!!    <<<---- PLEASE  ---->>>
						//And single-indent group style
						$groupstyle = 'single-indent';
						$clientstyle = 'double-indent';
						//And style client as double if more than one.
			        else:
            			//only one client no group displayed.
						$clientstyle = 'single-indent';
						//use this style for single client groups
					endif;
					
					foreach ($query1->result() as $cRow){
					
						//Client stuff here
						//use style above for indention -->>  $clientstyle  <<--
						
						
					}
				}
			 } 
			
			break;
			//end of Admin
			
			
			
			//start of Group-Admin
			case 'G':
			
				$gSql ="SELECT g.* FROM Groups g WHERE g.GROUP_ID =".$LevelID." AND g.GROUP_Active = 1";
				$gQuery = $this->db->query($gSql);
				foreach ($gQuery->result() as $gRow){
					
					$cSql ="SELECT c.* FROM Clients c WHERE c.GROUP_ID =".$gRow[0]." AND c.CLIENT_Active = 1 ORDER BY c.CLIENT_Name";
					$cQuery = $this->db->query($cSql);
					
					if($cQuery->num_rows > 1):
            			//Put Group in Array HERE! CAN BE MORE THAN ONE!!    <<<---- PLEASE  ---->>>
						//And single-indent group style
						$groupstyle = 'no-indent';
						$clientstyle = 'single-indent';
						//if more than one client which is what there is suppost to be for a group admin
						//set group as default
						if($gRow['GROUP_ID']==$LevelID):
						$selected = 'selected="selected"';
						else:
						$selected = '';
						endif;
						//And style client as double if more than one.
			        else:
            			//only one client no group displayed.
						$clientstyle = 'no-indent';
						$selected = 'selected="selected"';
						//use this style for single client groups
					endif;
					
					foreach ($query1->result() as $cRow){
					
						//Client stuff here
						//use style above for indention -->>  $clientstyle  <<--
						
						
					}
				}
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
			   $selected = 'selected="selected"';
			   //Build array here		
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