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
		
		public function Agency() {
			/**
			  * Agency list based on permission level.
			  */
			$data = array(
				'agencies' => (($this->session->userdata['valid_user']['AccessLevel'] >= 100000) ? $this->administration->getAgencies(false) : $this->administration->getAgencies($this->session->userdata['valid_user']['AgencyID'])),
				'userLvl'  => $this->session->userdata['valid_user']['AccessLevel']
			);
			
			$this->LoadTemplate('pages/admin/agency',$data);
		}
		
		public function Edit_agency($agency_id) {
			$data = array(
				'agencies' => (($this->session->userdata['valid_user']['AccessLevel'] >= 100000) ? $this->administration->getAgencies(false) : $this->administration->getAgencies($this->session->userdata['valid_user']['AgencyID'])),
				'userLvl'  => $this->session->userdata['valid_user']['AccessLevel']
			);
			$this->LoadTemplate('pages/admin/agency',$data);
		}
		
		public function Add_agency() {
			$this->load->model('administration');
			$this->load->library('form_validation');
			$this->load->helper('formwriter');
			$this->load->library('security');
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
	
		}
	
	}
