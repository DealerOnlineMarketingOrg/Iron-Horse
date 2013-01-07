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
		
		public function Users($page = false, $msg = false) {
			$this->load->model('administration');
			$this->load->helper('html');
			$this->load->helper('template');
			$this->load->library('table');
			$this->load->model('utilities');
			
			switch($page) {
				
				case 'add':
					$this->LoadTemplate('forms/form_addusers');
				break;
				case 'edit':
					$user_id = $this->input->post('user_id');
					$user = $this->administration->getUsers($user_id);
					$data = array(
						'user' => $user,
						'states' => $this->utilities->getStates()
					);
					$this->LoadTemplate('forms/form_editusers', $data);
				break;
				default:
				
					//Default listing table
				
					$users = $this->administration->getUsers();
					//Creating the table headings (th)
					$this->table->set_heading('Email Address','Name','Status','Member Since', '');
					foreach($users as $user) {
						$form_cred = array(
							'name' => 'edit_user',
							'id' => 'user_' . $user->ID
						);
						$form_submit = array(
							'name' => 'submit',
							'id' => 'usr_id_' . $user->ID,
							'class' => 'button blue',
							'value' => 'Edit'
						);
						
						//edit button
						$edit_form = form_open('/admin/users/edit', $form_cred) . form_hidden('user_id',$user->ID) . form_submit($form_submit) . form_close();

						$this->table->add_row($user->EmailAddress,$user->LastName . ', ' . $user->FirstName, (($user->Status == 1) ? 'Active' : 'Disabled'), date('n-j-Y',strtotime($user->JoinDate)), $edit_form);
					}
					$page_html = heading('Users',2) . $this->table->generate();
					
					$data = array(
						'page_id'  => 'users',
						'page_html' => $page_html,
						'msg' => $msg
					);
					
					$this->LoadTemplate('pages/listings',$data);
				break;
			}

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
					if(!$permissions) {
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
						$this->LoadTemplate('forms/form_addagency',$data);
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
						$this->load->model('administration');
						$agency = $this->administration->getAgencyByID($agency_id);
						//PREPARE THE VIEW FOR THE FORM
						$data = array(
							'agency' => $agency,
							'msg' => (($msg) ? 'There was an error editing your agencies information. Please try again' : '')
						);
						//THIS IS THE DEFAULT VIEW FOR ANY BASIC FORM.
						$this->LoadTemplate('forms/form_editagency',$data);
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
						$page_html = '<div class="three-fourths">' . heading('Agencies',2) . '</div>' . (($this->CheckModule('name','Agency_Add')) ? '<div class="one-fourth right">' . anchor(base_url() . 'admin/agency/add','Add New Agency','class="button green float_right" id="add_agency_btn"') . '</div>' : '') . $this->table->generate();
						
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
					$this->LoadTemplate('forms/form_addgroups');
				break;
				case 'edit' :
					$this->LoadTemplate('forms/form_editgroups');
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
						$page_html = heading('Groups',2) . (($this->CheckModule('name','Group_Add')) ? anchor(base_url() . 'admin/groups/add','Add New Group','class="button green float_right" id="add_group_btn"') : '') . $this->table->generate();
						
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
		
		public function Contacts($page = false, $msg = false) {
			$this->load->helper('form');
			$this->load->helper('formwriter');
			$this->load->library('table');
			$this->load->helper('html');
			
			switch($page) {
				case 'add':
					$this->LoadTemplate('forms/form_addcontacts');
				break;
				case 'edit':
					$this->LoadTemplate('forms/form_editcontacts');
				break;
				default:
					
				break;	
			}
		}
		
		public function Clients($page = false, $msg = false) {
			$this->load->helper('form');
			$this->load->helper('formwriter');
			$this->load->library('table');
			$this->load->helper('html');
			
			$agency_id = $this->user['AgencyID'];
			$group_id  = $this->user['ClientID'];
			
			switch($page) :
				case 'add' :
					$this->LoadTEmplate('forms/form_addclients');
				break;
				
				case 'edit' :
					$this->LoadTemplate('forms/form_editclients');
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
								'id' => 'client_id_' . $group->GroupId,
								'class' => 'button blue',
								'value' => 'Edit'
							);
							//BUILD THE FORM ROW IN THE TABLE WITH NAME,DESCRIPTION,STATUS, and EDIT BUTTON, THE FORM ALSO HAS A HIDDEN ELEMENT WITH THE AGENCY ID, THIS IS WHAT WE
							//USE TO POST TO THE EDIT PAGE TO GRAB THE CORRECT AGENCY FROM THE DB.
							$this->table->add_row(
								$group->Name,$group->AgencyName,
								(($group->Status) ? 'Active' : 'Disabled'),
								//IF THE USER HAS TO HAVE THE CORRECT PERMISSIONS TO VIEW A FEATURE
								(($this->CheckModule('name','Client_Edit')) ? form_open('/admin/clients/edit',$form_attr) . form_hidden('group_id', $group->GroupId) . form_submit($button) . form_close() : ''));
						endforeach;
						//THE ADD AGENCY BUTTON
						$add_button = array(
							'class' => 'button green float_right',
							'id'    => 'add_group_btn',
							'href'  => 'javascript:void(0)',
						);
						//BUILD THE HTML FOR THE PAGE HERE IN A STRING. THE VIEW JUST ECHOS THIS OUT.
						$page_html = heading('Clients',2) . (($this->CheckModule('name','Client_Add')) ? anchor(base_url() . 'admin/clients/add','+','class="button green float_right" id="add_group_btn"') : '') . $this->table->generate();
						
						$data = array(
							'page_id'  => 'groups',
							'page_html' => $page_html,
							'msg' => $msg
						);
						//LOAD THE TEMPLATE
						$this->LoadTemplate('pages/listings',$data);
					}
				break;
			endswitch;
		}
		
		public function Websites($page = false, $msg = false) {
			$this->load->helper('form');
			$this->load->helper('formwriter');
			$this->load->library('table');
			$this->load->helper('html');
			
			switch($page) :
			
				case 'add':
					$this->LoadTemplate('forms/form_addwebsites');
				break;
				
				case 'edit':
					$this->LoadTemplate('forms/form_editwebsites');
				break;
				default:
				
				break;
			endswitch;
		}
		
	}