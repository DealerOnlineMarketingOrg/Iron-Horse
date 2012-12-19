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
            $name = $this->input->get('Agency');
            echo $name;
        }
		
		public function selected_dealer() {
			$selected_id = $this->input->post('selected_id');
			$this->session->userdata['valid_user']['DropdownDefault']->SelectedID = $selected_id;
			$this->session->sess_write();
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
