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
		
		public function Agency($page = false, $msg = false) {
			$this->load->helper('form');
			$this->load->helper('formwriter');
			
			if($page && $page != 'success') :
				if($page == 'add') :
					$data = array(
						'form' => AgencyAddForm(),
						'page_id' => 'add_agency',
						'formName' => 'Add New Agency',
						'msg' => (($msg) ? 'There was an error adding your agency to the system. Please try again' : '')
					);
					$this->LoadTemplate('forms/generic_form',$data);
				endif;
			else :
				
				if($page && $page != 'error') :
					$msg = 'Your form processed successfully. You should see the results below';
				else :
					$msg = false;
				endif;
				
				$this->load->library('table');
				$this->load->helper('html');
				
				//Get the agencies into an array/
				$agencies = (($this->user['AccessLevel'] >= 100000) ? $this->administration->getAgencies(false) : $this->administration->getAgencies($this->user['AgencyID']));
				
				//create html table with codeigniter library. This is awesome btw.
				$this->table->set_heading('Name','Description','Status','Edit');
				
				foreach($agencies as $agency) :
					$this->table->add_row(
						$agency->Name,$agency->Description,
						(($agency->Status) ? 'Active' : 'Disabled'),
						(($this->user['AccessLevel'] >= 100000) ? anchor(base_url() . 'admin/agency/edit/' . $agency->Id, 'Edit', 'class="button blue"') : ''));
				endforeach;
				
				$add_button = array(
					'class' => 'button green float_right',
					'id'    => 'add_agency_btn',
					'href'  => 'javascript:void(0)',
				);
				
				$page_html = heading('Agencies',2) . anchor(base_url() . 'admin/agency/add','+','class="button green float_right" id="add_agency_btn"') . $this->table->generate();
				
				/**
				  * Agency list based on permission level.
				*/  
				$data = array(
					'page_id'  => 'agency',
					'page_html' => $page_html,
					'msg' => $msg
				);
				
				$this->LoadTemplate('pages/listings',$data);
			endif;
		}
		
	}
