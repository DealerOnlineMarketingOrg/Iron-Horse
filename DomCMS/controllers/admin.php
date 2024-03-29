<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Admin extends DOM_Controller {
	
		public function __construct() {
			parent::__construct();	
			//loading the member model here makes it available for any member of the dashboard controller.
			$this->load->model('administration');
			$this->DisplaySettings();
		}
	
		public function index() {
			
			/*
			| Load the template in anyway you like, my personal preference with an indexed array to be able to label what which template peice is
			|	- All you have to do is call the template otherwise
			|	- Once template is loaded the code has already ran so always load the template last.
			|   - The second paramater of the template load is the data you want to pass to the template peice.
			*/
			$this->LoadTemplate('pages/dashboard');
		}
		
		public function Agency($page = false, $msg = false) {
			
			$this->load->helper('form');
			$this->load->helper('formwriter');
			$this->load->library('table');
			$this->load->helper('html');
			
			switch($page) :			
				/* THE ADD AGENCY PAGE */
				case 'add' :
					//MODULE PERMISSIONS
					$permissions = $this->CheckModule('name','Agency_Add');					
					if(!$permission) {
						$this->AccessDenied();	
					}else {
						//PREPARE THE DATA FOR PAGE
						$data = array(
							'form' => AgencyAddForm(),
							'page_id' => 'add_agency',
							'formName' => 'Add New Agency',
							//THE VIEW LOOKS FOR A MESSAGE, IF THE MESSAGE EXISTS THIS IS THE MESSAGE THE PAGE EXPECTS TO SEE
							'msg' => (($msg) ? 'There was an error adding your agency to the system. Please try again' : '')
						);
						//THIS IS THE DEFAULT VIEW FOR ANY BASIC FORM.
						$this->LoadTemplate('forms/generic_form',$data);
					}
				break;
				/* THE EDIT AGENCY PAGE */
				case 'edit':
					$permissions = $this->CheckModule('name','Agency_Edit');
					if(!$permissions) {
						$this->AccessDenied();	
					}else {
						//WE POST WHAT AGENCY WERE EDITING, THIS IS THE ID IN THE DB.
						$agency_id = $this->input->post('agency_id');
						//PREPARE THE VIEW FOR THE FORM
						$data = array(
							'form' => AgencyEditForm($agency_id),
							'page_id' => 'edit_agency',
							'formName' => 'Edit Agency',
							'msg' => (($msg) ? 'There was an error editing your agencies information. Please try again' : '')
						);
						
						//THIS IS THE DEFAULT VIEW FOR ANY BASIC FORM.
						$this->LoadTemplate('forms/generic_form',$data);
					}
				break;		
				/* THE DEFAULT LISTING PAGE */
				default:
					$permissions = $this->CheckModule('name','Agency_List');
					if(!$permissions) {
						$this->AccessDenied();
					}else {
						//Get the agencies into an array/
						$agencies = (($this->CheckModule('name','Agency_List')) ? $this->administration->getAgencies(false) : $this->administration->getAgencies($this->user['AgencyID']));
						//create html table with codeigniter library. This is awesome btw.
						$this->table->set_heading('Name','Description','Status','');
						//LOOP THROUGH EACH AGENCY AND CREATE A FORM BUTTON "EDIT" AND ROW FOR IT.
						foreach($agencies as $agency) :
							//EACH FORM IS NAMED BY THE EDIT_{AGENCY_ID}, SAME CONCEPT WITH THE ID
							$form_attr = array(
								'name' => 'edit_' . $agency->Id,
								'id' => 'edit_form_' . $agency->Id,
							);					
							//EACH FORM HAS THE SAME NAME BUT DIFFERENT ID
							$button = array(
								'name' => 'submit',
								'id' => 'agency_id_' . $agency->Id,
								'class' => 'button blue',
								'value' => 'Edit'
							);
							//BUILD THE FORM ROW IN THE TABLE WITH NAME,DESCRIPTION,STATUS, and EDIT BUTTON, THE FORM ALSO HAS A HIDDEN ELEMENT WITH THE AGENCY ID, THIS IS WHAT WE
							//USE TO POST TO THE EDIT PAGE TO GRAB THE CORRECT AGENCY FROM THE DB.
							$this->table->add_row(
								$agency->Name,$agency->Description,
								(($agency->Status) ? 'Active' : 'Disabled'),
								//IF THE USER HAS TO HAVE THE CORRECT PERMISSIONS TO VIEW A FEATURE
								(($this->CheckModule('name','Agency_Edit')) ? form_open('/admin/agency/edit',$form_attr) . form_hidden('agency_id', $agency->Id) . form_submit($button) . form_close() : ''));
						endforeach;
						//THE ADD AGENCY BUTTON
						$add_button = array(
							'class' => 'button green float_right',
							'id'    => 'add_agency_btn',
							'href'  => 'javascript:void(0)',
						);
						//BUILD THE HTML FOR THE PAGE HERE IN A STRING. THE VIEW JUST ECHOS THIS OUT.
						$page_html = heading('Agencies',2) . (($this->CheckModule('name','Agency_Add')) ? anchor(base_url() . 'admin/agency/add','+','class="button green float_right" id="add_agency_btn"') : '') . $this->table->generate();
						
						$data = array(
							'page_id'  => 'agency',
							'page_html' => $page_html,
							'msg' => $msg
						);
						
						$this->LoadTemplate('pages/listings',$data);
					}
				break;
			//END THE SWITCH		
			endswitch;
		}
		
		public function Groups($page = false, $msg = false) {
			$this->load->helper('form');
			$this->load->helper('formwriter');
			$this->load->library('table');
			$this->load->helper('html');
			
			$agency_id = $this->user['AgencyID'];
			
			switch($page) :
				case 'add' :
				
				break;
				case 'edit' :
				
				break;
				default:
					$permissions = $this->CheckModule('name','Group_List');
					if(!$permissions) {
						$this->AccessDenied();
					}else {
						//Get the agencies into an array/
						$groups = $this->administration->getGroups($agency_id);
						//create html table with codeigniter library. This is awesome btw.
						$this->table->set_heading('Name','Member Of','Status','');
						//LOOP THROUGH EACH AGENCY AND CREATE A FORM BUTTON "EDIT" AND ROW FOR IT.
						foreach($groups as $group) :
							//EACH FORM IS NAMED BY THE EDIT_{AGENCY_ID}, SAME CONCEPT WITH THE ID
							$form_attr = array(
								'name' => 'edit_' . $group->GroupId,
								'id' => 'edit_form_' . $group->GroupId,
							);					
							//EACH FORM HAS THE SAME NAME BUT DIFFERENT ID
							$button = array(
								'name' => 'submit',
								'id' => 'group_id_' . $group->GroupId,
								'class' => 'button blue',
								'value' => 'Edit'
							);
							//BUILD THE FORM ROW IN THE TABLE WITH NAME,DESCRIPTION,STATUS, and EDIT BUTTON, THE FORM ALSO HAS A HIDDEN ELEMENT WITH THE AGENCY ID, THIS IS WHAT WE
							//USE TO POST TO THE EDIT PAGE TO GRAB THE CORRECT AGENCY FROM THE DB.
							$this->table->add_row(
								$group->Name,$group->AgencyName,
								(($group->Status) ? 'Active' : 'Disabled'),
								//IF THE USER HAS TO HAVE THE CORRECT PERMISSIONS TO VIEW A FEATURE
								(($this->CheckModule('name','Group_Edit')) ? form_open('/admin/groups/edit',$form_attr) . form_hidden('group_id', $group->GroupId) . form_submit($button) . form_close() : ''));
						endforeach;
						//THE ADD AGENCY BUTTON
						$add_button = array(
							'class' => 'button green float_right',
							'id'    => 'add_group_btn',
							'href'  => 'javascript:void(0)',
						);
						//BUILD THE HTML FOR THE PAGE HERE IN A STRING. THE VIEW JUST ECHOS THIS OUT.
						$page_html = heading('Groups',2) . (($this->CheckModule('name','Group_Add')) ? anchor(base_url() . 'admin/groups/add','+','class="button green float_right" id="add_group_btn"') : '') . $this->table->generate();
						
						$data = array(
							'page_id'  => 'groups',
							'page_html' => $page_html,
							'msg' => $msg
						);
						
						$this->LoadTemplate('pages/listings',$data);
					}
				break;
			endswitch;
		}
		
		public function Clients($page = false, $msg = false) {
			$this->load->helper('form');
			$this->load->helper('formwriter');
			$this->load->library('table');
			$this->load->helper('html');
			
			print_object($this->user['DropdownDefault']);
			
			$agency_id = $this->user['AgencyID'];
			$group_id  = $this->user['ClientID'];
			
			switch($page) :
				case 'add' :
					
				break;
				
				case 'edit' :
					
				break;
				
				default:
					$permissions = $this->CheckModule('name','Group_List');
					if(!$permissions) {
						$this->AccessDenied();
					}else {
						//Get the agencies into an array/
						$groups = $this->administration->getGroups($agency_id);
						//create html table with codeigniter library. This is awesome btw.
						$this->table->set_heading('Name','Member Of','Status','');
						//LOOP THROUGH EACH AGENCY AND CREATE A FORM BUTTON "EDIT" AND ROW FOR IT.
						foreach($groups as $group) :
							//EACH FORM IS NAMED BY THE EDIT_{AGENCY_ID}, SAME CONCEPT WITH THE ID
							$form_attr = array(
								'name' => 'edit_' . $group->GroupId,
								'id' => 'edit_form_' . $group->GroupId,
							);					
							//EACH FORM HAS THE SAME NAME BUT DIFFERENT ID
							$button = array(
								'name' => 'submit',
								'id' => 'group_id_' . $group->GroupId,
								'class' => 'button blue',
								'value' => 'Edit'
							);
							//BUILD THE FORM ROW IN THE TABLE WITH NAME,DESCRIPTION,STATUS, and EDIT BUTTON, THE FORM ALSO HAS A HIDDEN ELEMENT WITH THE AGENCY ID, THIS IS WHAT WE
							//USE TO POST TO THE EDIT PAGE TO GRAB THE CORRECT AGENCY FROM THE DB.
							$this->table->add_row(
								$group->Name,$group->AgencyName,
								(($group->Status) ? 'Active' : 'Disabled'),
								//IF THE USER HAS TO HAVE THE CORRECT PERMISSIONS TO VIEW A FEATURE
								(($this->CheckModule('name','Group_Edit')) ? form_open('/admin/groups/edit',$form_attr) . form_hidden('group_id', $group->GroupId) . form_submit($button) . form_close() : ''));
						endforeach;
						//THE ADD AGENCY BUTTON
						$add_button = array(
							'class' => 'button green float_right',
							'id'    => 'add_group_btn',
							'href'  => 'javascript:void(0)',
						);
						//BUILD THE HTML FOR THE PAGE HERE IN A STRING. THE VIEW JUST ECHOS THIS OUT.
						$page_html = heading('Groups',2) . (($this->CheckModule('name','Group_Add')) ? anchor(base_url() . 'admin/groups/add','+','class="button green float_right" id="add_group_btn"') : '') . $this->table->generate();
						
						$data = array(
							'page_id'  => 'groups',
							'page_html' => $page_html,
							'msg' => $msg
						);
						
						$this->LoadTemplate('pages/listings',$data);
					}
				break;
			endswitch;
		}
		
	}