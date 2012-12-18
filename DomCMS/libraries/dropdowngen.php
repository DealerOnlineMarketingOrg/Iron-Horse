<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	if (!session_id()) session_start();
	class DropdownGen {
		
		var $ValidUser;
		var $DropdownDefault;
		var $ci;
		public $str;
		
		public function __construct() {
			
		}
		
		public function drivedrop() {
			//DO NOTHING
			$this->ci =& get_instance();
			$this->ci->load->model('dropdown');
			$this->ci->load->model('tagdrop');	
			$this->ValidUser = $this->ci->session->userdata('valid_user');
			$this->DropdownDefault = $this->ValidUser['DropdownDefault'];
			
			//var_dump($this->DropdownDefault);
			
			$PermType = $this->DropdownDefault->PermType;
			$LevelID = $this->DropdownDefault->LevelID;
			$LevelType = $this->DropdownDefault->LevelType;
			$SelectedID = $this->DropdownDefault->SelectedID;
			$SelectedTag = $this->DropdownDefault->SelectedTag;
			//set var defualt
			$TagView=false;
			//see if tag is selected
			(($SelectedTag=='0' || $SelectedTag=='noshow' ) ? $TagView=false : $TagView = $this->ci->tagdrop->TagsQuery( $SelectedTag )) ;
			//set defaults for selected id if not set
			if($SelectedID != 'null'):
				$type = $SelectedID[0];
				$id = substr($SelectedID,-1);
			else:
			//set defaults
				$type = $LevelType;
				$id = $LevelID;
			endif;
			
			//set specialtagsid into array for later use below.
			if(!empty($TagView)) {$specialtagids = client_id_parser($TagView->CLIENT_IDS);}
			
			//check to see if current selection is in tag if not reset to highest level
			if( ($type == 'c' || $type == 'g') && isset($specialtagids)&&$specialtagids!=false&&!empty($specialtagids) ){
				if($type == 'c'&&!in_array($id,$specialtagids)){
					$type = $LevelType;
				    $id = $LevelID;
					$selected_id = $type.$id;
					$this->ci->session->userdata['valid_user']['DropdownDefault']->SelectedID = $selected_id;
					$this->ci->session->sess_write();
				}
				if($type == 'g'){
					$type = $LevelType;
				    $id = $LevelID;
					$selected_id = $type.$id;
					$this->ci->session->userdata['valid_user']['DropdownDefault']->SelectedID = $selected_id;
					$this->ci->session->sess_write();
				}
				
			}
			
			//print_r('this '.$type.' '.$id.' '.$SelectedID);
			
			
			
			//set based on PermType
		    $str = '';
			if($PermType == 'SuperAdmin') {
				if($TagView){
				$str .= $this->SuperAdmin($type,$id,$specialtagids);
				}
				else{
				$str .= $this->SuperAdmin($type,$id,false);	
				}
			}else if($PermType == 'GroupAdmin') {
				$str .= $this->GroupAdmin($type,$id);	
			}else if($PermType == 'ClientAdmin') {
				$str .= $this->Client($type,$id);	
			}
			//var_dump($str);
			//print_r($str);
			return $str;
			
		}
		
		public function SuperAdmin($type, $id, $tag_c_ids) {
			
			//print_object($tag_c_ids);
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
					$selected = 0;
					if($gRow->GROUP_ID == $id && $type == 'g'):
						$selected = 1;
					else:
						$selected = 0;
					endif;
					
					$groupstyle  = 'single-indent group';
					
					$DropString .= 'g:' . $gRow->GROUP_ID . ';' . $gRow->GROUP_Name . '^' . $groupstyle . ',' . $selected .'|';
					
					$cQuery =  $this->ci->dropdown->ClientQuery(false, $gRow->GROUP_ID);
					
					/*if($tag_c_ids){
						$arr = $tag_c_ids;
						foreach ($arr as $value) {
							if($value!=$cQuery[0]->CLIENT_ID){
								unset($cQuery);
								$buildstuff = (object) array('0' => (object) array('Client_ID' => '0'));
								$cQuery = array();
								$cQuery = array_push($items, $buildstuff);
							}
						}
					}*/
					
					$clientstyle = 'double-indent client';
					//And style client as double if more than one.
					
					//counting for last client 
					foreach ($cQuery as $cRow){
							$selected = 0;
							
							if($cRow->CLIENT_ID == $id && $type == 'c'):
								$selected = 1;
							else:
								$selected = 0;
							endif;
							
							
							
							if (!isset($tag_c_ids)||$tag_c_ids==false) {
								$DropString .= 'c:' . $cRow->CLIENT_ID . ';' . $cRow->CLIENT_Name . '^' . $clientstyle . ',' . $selected . '|';
							}
							else if(isset($tag_c_ids)&&in_array($cRow->CLIENT_ID, $tag_c_ids)){
								$DropString .= 'c:' . $cRow->CLIENT_ID . ';' . $cRow->CLIENT_Name . '^' . $clientstyle . ',' . $selected . '|';
							}
							
							
						}
					}
				}
					
			//}
			
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