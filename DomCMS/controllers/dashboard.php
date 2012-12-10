<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

session_start();

class Dashboard extends CI_Controller {
	
    var $active_button;
    var $session_data;
    var $validUser;
	
    public function __construct() {
        parent::__construct();	
        //loading the member model here makes it available for any member of the dashboard controller.
        $this->load->model('members');
        $this->active_button = 'dashboard'; 
        $this->validUser = ($this->session->userdata('valid_user')) ? TRUE : FALSE;
        if(!$this->validUser) redirect('login','refresh');
    }

    public function index() {
        $this->load->helper('pass');
		$this->load->helper('string_parser');
		
		$dropdown = $this->load->library('DropdownGen');
		
		var_dump($dropdown);
		
        /*
        | Load the template in anyway you like, my personal preference with an indexed array to be able to label what which template peice is
        |	- All you have to do is call the template otherwise
        |	- Once template is loaded the code has already ran so always load the template last.
        |   - The second paramater of the template load is the data you want to pass to the template peice.
        */

        /*$ga = $this->gapi;
        $ga->requestReportData(54919407,array('browser','browserVersion'),array('pageviews','visits'));
        $google = '';
        foreach($ga->getResults() as $result) {
            $google = '<strong>'.$result.'</strong><br />';
            $google .= 'Pageviews: ' . $result->getPageviews() . ' ';
            $google .= 'Visits: ' . $result->getVisits() . '<br />'; 
        }

        $google .= '<p>Total pageviews: ' . $ga->getPageviews() . ' total visits: ' . $ga->getVisits() . '</p>';
        */
        
        $google = '';
        
        $header_data = array(
            'name' => $this->session->userdata['valid_user']['FirstName'] . ' ' . $this->session->userdata['valid_user']['LastName'],
            'user' => $this->session->userdata('valid_user') 
        );

        $data = array(
            'google' => $google,
			'dropdown' => $dropdown
            //'user' => $this->session->userdata('valid_user')
        );

        $nav = array(
            'active_button' => $this->active_button
        );
        
        $this->load->view(DOMDIR 	. 'incl/header.php');
        $this->load->view(THEMEDIR 	. 'incl/dom.header.php', $header_data);
        $this->load->view(DOMDIR 	. 'incl/nav.php', $nav);
        $this->load->view(THEMEDIR 	. 'pages/dashboard.php',$data);
        $this->load->view(THEMEDIR 	. 'incl/dom.footer.php');
        $this->load->view(DOMDIR 	. 'incl/footer.php');

    }	
}