<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

session_start();

class Styleguide extends CI_Controller {
	
    var $active_button;
    var $session_data;
    var $validUser;
	
    public function __construct() {
        parent::__construct();	

        //loading the member model here makes it available for any member of the dashboard controller.
        $this->load->model('members');
        $this->active_button = 'admin'; 
        $this->validUser = ($this->session->userdata('valid_user')) ? TRUE : FALSE;
        if(!$this->validUser) redirect('auth/login','refresh');
    }
    
    public function index() {
        
        $header_data = array(
            'name' => $this->session->userdata['valid_user']['FirstName'] . ' ' . $this->session->userdata['valid_user']['LastName'],
        );
        
        $nav = array(
            'active_button' => $this->active_button
        );

        $this->load->view(DOMDIR 	. 'incl/header.php');
        $this->load->view(THEMEDIR 	. 'incl/dom.header.php', $header_data);
        $this->load->view(DOMDIR 	. 'incl/nav.php', $nav);
        
        $this->load->view(THEMEDIR 	. 'pages/styleguide.php');
        $this->load->view(THEMEDIR 	. 'incl/dom.footer.php');
        $this->load->view(DOMDIR 	. 'incl/footer.php');

    }
}
