<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Admin extends DOM_Controller {
	
		public function __construct() {
			parent::__construct();	
			//loading the member model here makes it available for any member of the dashboard controller.
			$this->load->model('administration');
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
		
		public function Agency($page = false,$id = false) {
			//Load the required models, librarys and helpers for the agency section. These are all available to the entire section.
			$this->load->model('administration');
			$this->load->library(array('form_validation','security','table'));
			$this->load->helper(array('formwriter','html','date'));
			//Switch between what page type we need.
			switch($page) {
				case 'add':
					//form validation
					$this->form_validation->set_rules('agency_name','Agency Name','trim|required|xss_clean|alpha_numeric');
					$this->form_validation->set_rules('agency_desc','Agency Description', 'trim|xss_clean|alpha_numeric');
					//set form delemeters
					$this->form_validation->set_error_delimiters('<div class="error">','</div>');
					if($this->form_validation->run() != FALSE) {
						$this->form_validation->set_message('agency_name','The agency name is required.');
						$this->form_validation->set_message('agency_desc','The description only allows alpha numeric characters');
						$data = array(
							'formName' => 'Add New Agency',
							'form' => AddAgencyForm()
						);
						$this->LoadTemplate('forms/generic_form', $data);	
					}else {
						
						$name = $this->secuirty->xss_clean($this->input->post('agency_name'));
						$desc = $this->secuirty->xss_clean($this->input->post('agency_desc'));
						$active = 1;
						
						$now = time();
						
						$gmt = local_to_gmt($now);
						
						$created = $gmt;
						$data = array(
							'AGENCY_Name' => $name,
							'AGENCY_Notes' => $desc,
							'AGENCY_Active' => $active,
							'AGENCY_Created' => $created
						);		
						
						$result = $this->administration->addAgency($data);
						
						if($result) :
							$this->Agency();
						else :
							$this->form_validation->set_message('query_error','There was a problem submitting your agency, please try again.');
							$data = array(
								'formName' => 'Add New Agency',
								'form' => AddAgencyForm()
							);
							$this->LoadTemplate('forms/generic_form',$data);
						endif;
						
					}
				break;
				
				case 'edit':
					//This is the edit agency page
					
					$agency = (($this->session->userdata['valid_user']['AccesssLevel'] >= 100000) ? $this->administration->getAgencies($id) : NULL);
					
					if($agency) {
							
					}
					
					$data = array(
						'agencies' => (($this->session->userdata['valid_user']['AccessLevel'] >= 100000) ? $this->administration->getAgencies() : $this->administration->getAgencies($this->session->userdata['valid_user']['AgencyID'])),
						'userLvl'  => $this->session->userdata['valid_user']['AccessLevel']
					);
					$this->LoadTemplate('pages/admin/agency',$data);
				break;
				default:
					/*This is the agency listing page */
					
					//Get the agencies into an array
					$agencies = (($this->session->userdata['valid_user']['AccessLevel'] >= 100000) ? $this->administration->getAgencies(false) : $this->administration->getAgencies($this->session->userdata['valid_user']['AgencyID']));
					
					//create html table with codeigniter library. This is awesome btw.
					$this->table->set_heading('Name','Description','Status','Edit');
					
					foreach($agencies as $agency) :
						$this->table->add_row($agency->Name, $agency->Description, (($agency->Status) ? 'Active' : 'Disabled'), (($this->session->userdata['valid_user']['AccessLevel'] >= 100000) ? anchor(base_url() . 'admin/agency/edit/' . $agency->Id,'Edit','class="button blue"') : ''));
					endforeach;
					
					$add_button = array(
						'class' => 'button green float_right',
						'id'    => 'add_agency_btn',
						'href'  => 'javascript:void(0)'
					);
					
					$page_html = heading('Agencies',2) . anchor(base_url() . 'admin/agency/add','+','class="button green float_right" id="add_agency_btn"') . $this->table->generate();
					
					/**
					  * Agency list based on permission level.
					  */
					$data = array(
						'page_id'  => 'agency',
						'page_html' => $page_html
					);
					
					$this->LoadTemplate('pages/listings',$data);
				break;
			}
		}
		
	}
