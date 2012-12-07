<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	class DropdownGen {
		
		var $validUser;
		var $DropdownDefault;
		var $ci;

		public function __construct($params) {
			//DO NOTHING
			$this->ci =& get_instance();
			$this->ci->load->model('dropdown');	
			$this->ci->load->helper('string_parser');
			$this->ci->validUser = $this->session->userdata('valid_user');
			$this->ci->DropdownDefault = $this->session->userdata('DropdownDefault');

		}
		
		public function DriveDrop(){
			$PermType = $this->ci->DropdownDefault['PermType'];
			$LevelID = $this->ci->DropdownDefault['LevelID'];
			$LevelType = $this->ci->DropdownDefault['LevelType'];
			$SelectedID = $this->ci->DropdownDefault['SelectedID'];
			if($SelectedID!='null'):
				$type = $SelectedID[0];
				$id = substr($SelectedID,-1);
			else:
			//set defaults
				$type = $LevelType;
				$id = $LevelID;
			endif;
			//set based on PermType
			$this->call_user_func($PermType,$type,$id);
		}
		
		public function SuperAdmin($type, $id) {
			$DropString = '';
			$selected = 0;
			$aQuery = $this->ci->dropdown->AgenciesQuery();
			foreach ($aQuery as $aRow){
				// And no-indent and  agency style
				$agentstyle = 'no-indent agency break';
				//check for default agency
				$selected = 0;
				if($aRow->AGENCY_ID == $id && $type == 'a'):
					$selected = 1;
				else:
					$selected = 0;
				endif;
				
				$DropString .= 'a:' . $aRow->AGENCY_ID . ';' . $aRow->AGENCY_Name . '^' . $agentstyle . ',' . $selected . '|';
				$gQuery = $this->ci->dropdown->GroupsQuery(false, $aRow->AGENCY_ID);
				
				foreach ($gQuery as $gRow){
					$cQuery = $this->dropdown->ClientQuery(false, $gRow->GROUP_ID);
					if(count($cQuery) > 1) :
						//Put Group
						//And single-indent group style
						$groupstyle  = 'single-indent group';
						$clientstyle = 'double-indent client';
						//And style client as double if more than one.
						$selected = 0;
						if($gRow->GROUP_ID == $id && $type == 'g'):
							$selected = 1;
						else:
							$selected = 0;
						endif;
						$DropString .= 'g:' . $gRow->GROUP_ID . ';' . $gRow->GROUP_Name . '^' . $groupstyle . ',' . $selected .'|';
					else:
						$clientstyle = 'single-indent';
						//use this style for single client groups
					endif;
					//counting for last client 
					$i = 0;
					$n = count($cQuery);
					
					foreach ($cQuery as $cRow){
						$selected = 0;
						$i++;
						if($cRow->CLIENT_ID == $id && $type == 'c'):
							$selected = 1;
						else:
							$selected = 0;
						endif;
						if ($i == $n):
							$clientstyle .= ' break';
						endif;
						$DropString .= 'c:' . $cRow->CLIENT_ID . ';' . $cRow->CLIENT_Name . '^' . $clientstyle . ',' . $selected . '|';
					}
				}
					
			} 
			return $DropString;
		}
		
		public function GroupAdmin($type,$id) {
			$DropString = '';
			$selected = 0;
			$gQuery = $this->ci->dropdown->GroupsQuery($this->DropdownDefault['LevelID']);
			foreach ($gQuery as $gRow){
				$cQuery = $this->ci->dropdown->ClientQuery(false,$gRow->GROUP_ID);
				if($cQuery > 1) :
					//Put Group
					//And single-indent group style
					$groupstyle   = 'no-indent group';
					$clientstyle  = 'single-indent client';
					//And style client as double if more than one.
					$selected 	  = 0;
					
					if($gRow->GROUP_ID == $id && $type == 'g'):
						$selected = 1;
					else:
						$selected = 0;
					endif;
					$DropString .= 'g:' . $gRow->GROUP_ID . ';' . $gRow->GROUP_Name . '^' . $groupstyle . ',' . $selected . '|';
				else:
					$clientstyle  = 'no-indent';
					//use this style for single client groups
				endif;
				//counting for last client 
				$i = 0;
				$n = count($cQuery);
				foreach ($cQuery->result() as $cRow){
					$selected = 0;
					$i++;
					if($cRow->CLIENT_ID == $id && $type == 'c'):
						$selected = 1;
					else:
						$selected = 0;
					endif;
					if ($i == $n):
						$clientstyle .= ' break';
					endif;
					$DropString .= 'c:' . $cRow->CLIENT_ID . ';' . $cRow->CLIENT_Name . '^' . $clientstyle . ',' . $selected . '|';
				}
					
			} 
			return $DropString;
		}
		
		public function Client($type,$id){
			$DropString = '';
			$selected = 0;
			$cQuery = $this->ci->dropdown->ClientQuery($this->DropdownDefault['LevelID']);
			$clientstyle = 'no-indent client' . ' break';
			$selected = 1;
			foreach ($cQuery as $cRow){
				$DropString .= 'c:' . $cRow->CLIENT_ID . ';' . $cRow->CLIENT_Name . '^' .$clientstyle . ',' . $selected . '|';
			}
			return $DropString;
		}
		
	}