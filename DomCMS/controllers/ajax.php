<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    class Ajax extends DOM_Controller {
        var $user;
        public function __construct() {
            parent::__construct();	
            //loading the member model here makes it 
            //available for any member of the dashboard controller.
            $this->load->model('members');
            $this->load->helper('form');
            $this->load->helper('url');
            $this->load->helper('pass');
            $this->user = $this->session->userdata('valid_user');
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
        
    }
