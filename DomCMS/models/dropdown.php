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
	
	
	public function DriveDrop(){
		$PermType = $this->DropdownDefault['PermType'];
		$LevelID = $this->DropdownDefault['LevelID'];
		$LevelType = $this->DropdownDefault['LevelType'];
		$SelectedID = $this->DropdownDefault['SelectedID'];
		if($SelectedID!='null'):
		$type = $SelectedID[0];
		$id = substr($SelectedID,1);
		else:
		//set defaults
		$type = $LevelType;
		$id = $LevelID;
		endif;
		//set based on PermType
		$this->call_user_func ($PermType,$type,$id);
		
	}
	
	
	//SUPER ADMIN DROPDOWN FUNCTION 
	public function SuperAdmin($type,$id){
		$DropString = '';
		$selected = 0;
		$aSql ="SELECT a.* FROM Agencies a ORDER BY a.AGENCY_Name WHERE a.AGENCY_Active = 1";
		$aQuery = $this->db->query($aSql);
		foreach ($aQuery->result() as $aRow){
			// And no-indent and  agency style
			$agentstyle = 'no-indent agency break';
			//check for default agency
			$selected = 0;
			if($aRow->AGENCY_ID==$id && $type == 'a'):
			$selected = 1;
			else:
			$selected = 0;
			endif;
			$DropString .= 'a:'.$aRow->AGENCY_ID.';'.$aRow->AGENCY_Name.'^'.$agentstyle.','.$selected.'|';
			$gSql ="SELECT g.* FROM Groups g WHERE g.AGENCY_ID =".$aRow->AGENCY_ID." AND g.GROUP_Active = 1 ORDER BY g.GROUP_Name";
			$gQuery = $this->db->query($gSql);
			foreach ($gQuery->result() as $gRow){
				$cSql ="SELECT c.* FROM Clients c WHERE c.GROUP_ID =".$gRow->GROUP_ID." AND c.CLIENT_Active = 1 ORDER BY c.CLIENT_Name";
				$cQuery = $this->db->query($cSql);
				if($cQuery->num_rows() > 1):
					//Put Group
					//And single-indent group style
					$groupstyle = 'single-indent group';
					$clientstyle = 'double-indent client';
					//And style client as double if more than one.
					$selected = 0;
					if($gRow->GROUP_ID==$id && $type == 'g'):
					$selected = 1;
					else:
					$selected = 0;
					endif;
					$DropString .= 'g:'.$gRow->GROUP_ID.';'.$gRow->GROUP_Name.'^'.$groupstyle.','.$selected.'|';
				else:
           			$clientstyle = 'single-indent';
					//use this style for single client groups
				endif;
				//counting for last client 
				$i=0;
				$n=$cQuery->num_rows();
				foreach ($cQuery->result() as $cRow){
					$selected = 0;
					$i++;
					if($cRow->CLIENT_ID==$id && $type == 'c'):
					$selected = 1;
					else:
					$selected = 0;
					endif;
					if ($i == $n):
					$clientstyle .= ' break';
					endif;
					$DropString .= 'c:'.$cRow->CLIENT_ID.';'.$cRow->CLIENT_Name.'^'.$clientstyle.','.$selected.'|';
				}
			}
				
		} 
		return $DropString;
	}
			
	//ADMIN DROPDOWN FUNCTION 	
	public function AgencyAdmin($type,$id){
		$DropString = '';
		$selected = 0;
		$aSql ="SELECT a.* FROM Agencies a ORDER BY a.AGENCY_Name WHERE a.AGENCY_Active = 1 AND a.AGENCY_ID=".$this->DropdownDefault['LevelID'];
		$aQuery = $this->db->query($aSql);
		foreach ($aQuery->result() as $aRow){
			// And no-indent and  agency style
			$agentstyle = 'no-indent agency break';
			//check for default agency
			$selected = 0;
			if($aRow->AGENCY_ID==$id && $type == 'a'):
			$selected = 1;
			else:
			$selected = 0;
			endif;
			$DropString .= 'a:'.$aRow->AGENCY_ID.';'.$aRow->AGENCY_Name.'^'.$agentstyle.','.$selected.'|';
			$gSql ="SELECT g.* FROM Groups g WHERE g.AGENCY_ID =".$aRow->AGENCY_ID." AND g.GROUP_Active = 1 ORDER BY g.GROUP_Name";
			$gQuery = $this->db->query($gSql);
			foreach ($gQuery->result() as $gRow){
				$cSql ="SELECT c.* FROM Clients c WHERE c.GROUP_ID =".$gRow->GROUP_ID." AND c.CLIENT_Active = 1 ORDER BY c.CLIENT_Name";
				$cQuery = $this->db->query($cSql);
				if($cQuery->num_rows() > 1):
					//Put Group
					//And single-indent group style
					$groupstyle = 'single-indent group';
					$clientstyle = 'double-indent client';
					//And style client as double if more than one.
					$selected = 0;
					if($gRow->GROUP_ID==$id && $type == 'g'):
					$selected = 1;
					else:
					$selected = 0;
					endif;
					$DropString .= 'g:'.$gRow->GROUP_ID.';'.$gRow->GROUP_Name.'^'.$groupstyle.','.$selected.'|';
				else:
           			$clientstyle = 'single-indent';
					//use this style for single client groups
				endif;
				//counting for last client 
				$i=0;
				$n=$cQuery->num_rows();
				foreach ($cQuery->result() as $cRow){
					$selected = 0;
					$i++;
					if($cRow->CLIENT_ID==$id && $type == 'c'):
					$selected = 1;
					else:
					$selected = 0;
					endif;
					if ($i == $n):
					$clientstyle .= ' break';
					endif;
					$DropString .= 'c:'.$cRow->CLIENT_ID.';'.$cRow->CLIENT_Name.'^'.$clientstyle.','.$selected.'|';
				}
			}
				
		} 
		return $DropString;
	}
	
	//GROUP DROPDOWN FUNCTION
	public function GroupAdmin($type,$id){
		$DropString = '';
		$selected = 0;
		$gSql ="SELECT g.* FROM Groups g WHERE g.GROUP_ID =".$this->DropdownDefault['LevelID'];
		$gQuery = $this->db->query($gSql);
		foreach ($gQuery->result() as $gRow){
			$cSql ="SELECT c.* FROM Clients c WHERE c.GROUP_ID =".$gRow->GROUP_ID." AND c.CLIENT_Active = 1 ORDER BY c.CLIENT_Name";
			$cQuery = $this->db->query($cSql);
			if($cQuery->num_rows() > 1):
				//Put Group
				//And single-indent group style
				$groupstyle = 'no-indent group';
				$clientstyle = 'single-indent client';
				//And style client as double if more than one.
				$selected = 0;
				if($gRow->GROUP_ID==$id && $type == 'g'):
				$selected = 1;
				else:
				$selected = 0;
				endif;
				$DropString .= 'g:'.$gRow->GROUP_ID.';'.$gRow->GROUP_Name.'^'.$groupstyle.','.$selected.'|';
			else:
           		$clientstyle = 'no-indent';
			//use this style for single client groups
			endif;
			//counting for last client 
			$i=0;
			$n=$cQuery->num_rows();
			foreach ($cQuery->result() as $cRow){
				$selected = 0;
				$i++;
				if($cRow->CLIENT_ID==$id && $type == 'c'):
					$selected = 1;
				else:
					$selected = 0;
				endif;
				if ($i == $n):
					$clientstyle .= ' break';
				endif;
					$DropString .= 'c:'.$cRow->CLIENT_ID.';'.$cRow->CLIENT_Name.'^'.$clientstyle.','.$selected.'|';
				
			}
				
		} 
		return $DropString;
	}
	//GROUP DROPDOWN FUNCTION
	public function Client($type,$id){
		$DropString = '';
		$selected = 0;
		$cSql ="SELECT c.* FROM Clients c WHERE c.CLIENT_ID =".$this->DropdownDefault['LevelID'];
		$cQuery = $this->db->query($cSql);
		$clientstyle = 'no-indent client'.' break';
		$selected = 1;
		foreach ($cQuery->result() as $cRow){
			$DropString .= 'c:'.$cRow->CLIENT_ID.';'.$cRow->CLIENT_Name.'^'.$clientstyle.','.$selected.'|';
		}
		return $DropString;
	}
}
?>