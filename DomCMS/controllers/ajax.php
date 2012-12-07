<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    session_start();
    class Ajax extends CI_Controller {
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
        
    }
