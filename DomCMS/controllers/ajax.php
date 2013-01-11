<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    class Ajax extends DOM_Controller {
        var $user;
        public function __construct() {
            parent::__construct();	
            //loading the member model here makes it 
            //available for any member of the dashboard controller.
            $this->load->helper('url');
            $this->user = $this->session->userdata('valid_user');
			$this->load->library('security');
        }

        public function name_changer() {
            $name = '<h3>' . $this->input->get('Agency') . '</h3>';
			$level = substr($this->input->get('Level'),0,1);
			$selected = substr($this->input->get('Level'),-1);			
			$levelName = $this->generateLevelName($level);
			
			//rewrite session vars
			$this->user['DropdownDefault']->LevelType = $level;
			$this->user['DropdownDefault']->LevelID = $selected;
			$this->user['DropdownDefault']->SelectedID = $selected;
			$this->user['DropdownDefault']->PermLevel = $this->generateLevelNumber($level);
			
			print($this->input->get('Level'));
			
			/*$this->generateSessionVars($this->input->get('Level'));*/
			
			$this->session->sess_write();
			
            print($levelName . $name);
        }
		
		function generateSessionVars($sess) {
			$this->load->model('administration');
			$client = substr($sess,-1);
			$group  =  $this->administration->getClient($client)->GroupID;
			$agency = $this->administration->getGroups($group)->AgencyId;
			
			$this->user['DropdownDefault']->SelectedAgency = $agency;
			$this->user['DropdownDefault']->SelectedGroup = $group;
			$this->user['Dropdowndefault']->SelectedClient = $client;
			
			$this->session->sess_write();
		}
		
		
		public function selected_dealer($selected_id) {
			
			$this->session->set_userdata['valid_user']['DropdownDefault']->SelectedID = $selected_id;
			
			//$this->session->userdata['valid_user']['DropdownDefault']->SelectedID = $selected_id;
			//$this->session->sess_write();
		}
		

		public function selected_tag() {
			$selected_tag = $this->input->post('selected_tag');
			$this->session->userdata['valid_user']['DropdownDefault']->SelectedTag= $selected_tag;
			$this->session->sess_write();			
		}		
		
		

		/*
			ADMIN CONTROLLERS
		*/
		
		public function add_agency_popup() {
			$this->load->helper('formwriter');
			$data = array(
				'formName' => 'Add New Agency',
				'form' => AddAgencyForm()
			);
			$this->load->view(THEMEDIR . 'popups/basic_form', $data);	
		}
		
        
    }
