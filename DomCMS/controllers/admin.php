<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start();
class Admin extends CI_Controller {
	
	var $active_button;
	var $header_data;
	
	public function __construct() {
		parent::__construct();	
		
		//loading the member model here makes it available for any member of the dashboard controller.
		$this->load->model('members');
		$this->active_button = 'admin';
		$this->load->model('administration');
		$this->validUser = ($this->session->userdata('valid_user')) ? TRUE : FALSE;
        if(!$this->validUser) redirect('login','refresh');

	}

	public function index() {
		
		/*
		| Load the template in anyway you like, my personal preference with an indexed array to be able to label what which template peice is
		|	- All you have to do is call the template otherwise
		|	- Once template is loaded the code has already ran so always load the template last.
		|   - The second paramater of the template load is the data you want to pass to the template peice.
		*/
		
		$nav = array(
			'active_button' => $this->active_button
		);
		
		$template = array(
			'global_header' 		=> $this->load->view(DOMDIR 	. 'incl/header'),
			'header' 				=> $this->load->view(THEMEDIR 	. 'incl/dom.header.php'),
			'nav'					=> $this->load->view(DOMDIR 	. 'incl/nav', $nav),
			'content' 				=> $this->load->view(THEMEDIR 	. 'pages/dashboard.php'),
			'footer'				=> $this->load->view(THEMEDIR 	. 'incl/dom.footer.php'),
			'global_footer' 		=> $this->load->view(DOMDIR 	. 'incl/footer.php')
		);
	}
	
	public function Agency() {
		/**
		  * Agency list based on permission level.
		  */
		$header_data = array(
            'name' => $this->session->userdata['valid_user']['FirstName'] . ' ' . $this->session->userdata['valid_user']['LastName'],
            'user' => $this->session->userdata('valid_user') 
        );
		
		$nav = array(
			'active_button' => $this->active_button
		);
		
		$agencies = (($this->session->userdata['valid_user']['AccessLevel'] >= 100000) ? $this->administration->getAgencies(false) : $this->administration->getAgencies($this->session->userdata['valid_user']['AgencyID']));
		$data = array(
			'agencies' => $agencies,
			'userLvl'  => $this->session->userdata['valid_user']['AccessLevel']
		);
		
		$template = array(
			'global_header' 		=> $this->load->view(DOMDIR 	. 'incl/header'),
			'header' 				=> $this->load->view(THEMEDIR 	. 'incl/dom.header.php',$header_data),
			'nav'					=> $this->load->view(DOMDIR 	. 'incl/nav', $nav),
			'content' 				=> $this->load->view(THEMEDIR 	. 'pages/admin/agency', $data),
			'footer'				=> $this->load->view(THEMEDIR 	. 'incl/dom.footer.php'),
			'global_footer' 		=> $this->load->view(DOMDIR 	. 'incl/footer.php')
		);
	}
	
	public function Edit_agency($agency_id) {
		$header_data = array(
			'name' => $this->session->userdata['valid_user']['FirstName'] . ' ' . $this->session->userdata['valid_user']['LastName'],
			'user' => $this->session->userdata('valid_user') 
		);
		
		$nav = array(
			'active_button' => $this->active_button
		);
		
		$agencies = (($this->session->userdata['valid_user']['AccessLevel'] >= 100000) ? $this->administration->getAgencies(false) : $this->administration->getAgencies($this->session->userdata['valid_user']['AgencyID']));
		$data = array(
			'agencies' => $agencies,
			'userLvl'  => $this->session->userdata['valid_user']['AccessLevel']
		);
		
		$template = array(
			'global_header' 		=> $this->load->view(DOMDIR 	. 'incl/header'),
			'header' 				=> $this->load->view(THEMEDIR 	. 'incl/dom.header.php',$header_data),
			'nav'					=> $this->load->view(DOMDIR 	. 'incl/nav', $nav),
			'content' 				=> $this->load->view(THEMEDIR 	. 'pages/admin/agency', $data),
			'footer'				=> $this->load->view(THEMEDIR 	. 'incl/dom.footer.php'),
			'global_footer' 		=> $this->load->view(DOMDIR 	. 'incl/footer.php')
		);
	}
	
}
