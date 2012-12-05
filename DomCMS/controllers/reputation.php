<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reputation extends CI_Controller {
	
    var $active_button;

    public function __construct() {
        parent::__construct();	

        //loading the member model here makes it available for any member of the dashboard controller.
        $this->load->model('members');
        $this->active_button = 'reputations';
    }

    public function index() {
        /*
        | Load the template in anyway you like, my personal preference with an indexed array to be able to label what which template peice is
        |	- All you have to do is call the template otherwise
        |	- Once template is loaded the code has already ran so always load the template last.
        |       - The second paramater of the template load is the data you want to pass to the template peice.
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
	
}
