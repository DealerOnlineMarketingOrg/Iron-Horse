<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	/**
		This is our main controller
		This controller checks the user credentials.
		If the users credentials do not pass it sends them to the login page.
	 */
	session_start();
	class DOM_Controller extends CI_Controller {
		//All we need is the construct and all controllers will pass through this on every page.
		
		public $user;
		public $LevelView;
		public $man_nav;
		public $user_nav;
		public $avatar;
		
		public function __construct() {
			parent::__construct();
			$this->load->helper('template');
			$this->load->library('gravatar');
			$this->load->helper('template');
			
			//Active button sets the highlighted icon on the view
			$active_button = $this->router->fetch_class();
			$current_subnav_button = $this->uri->rsegment(2); // The Function 
			
			define('ACTIVE_BUTTON',$active_button);
			define('SUBNAV_BUTTON','/' . $active_button  . '/' . $current_subnav_button);
			
			$this->user = $this->session->userdata('valid_user');
			$this->avatar = $this->gravatar->get_gravatar((($this->user['Gravatar']) ? $this->user['Gravatar'] : $this->user['Username']));
			
			//print_object($this->user);
						
			//This checks the user validation
			$this->validUser = ($this->session->userdata('valid_user')) ? TRUE : FALSE;
			if(!$this->validUser) redirect('login','refresh');
			
			$this->load->model('nav');
			$this->main_nav = $this->nav->main($this->user['AccessLevel']);
			
			$this->user_nav = $this->nav->user($this->user['AccessLevel']);
		}
		
		public function LoadTemplate($filepath,$data = false, $header_data = false, $nav_data = false, $footer_data = false) {
			
			$nav = array(
				'nav' => $this->main_nav
			);
			
			$user_nav = array(
				'nav' => $this->user_nav,
				'user' => $this->user,
				'avatar' => $this->avatar,
			);
			
			$this->load->view(THEMEDIR . '/incl/global/header');
			$this->load->view(THEMEDIR . '/incl/wrapper_top');
			$this->load->view(THEMEDIR . '/incl/header',($header_data) ? $header_data : array());
			$this->load->view(THEMEDIR . '/incl/global/sidebar', ($nav) ? $nav : array());
			$this->load->view(THEMEDIR . '/incl/section_wrapper_top');
			$this->load->view(THEMEDIR . '/incl/global/breadcrumb');
			$this->load->view(THEMEDIR . '/' . $filepath, ($data) ? $data : array());
			$this->load->view(THEMEDIR . '/incl/section_wrapper_bottom');
			$this->load->view(THEMEDIR . '/incl/wrapper_bottom');
			$this->load->view(THEMEDIR . '/incl/global/footer',($footer_data) ? $footer_data : array());
		}
		
		//This checks to see if the user has permissions to the specific module
		public function CheckModule($column_name = false,$module_name = false) {
			$this->load->model('mods');
			$user_level = $this->user['AccessLevel'];
			switch($column_name) :
				case 'name' :
					$permission = $this->mods->getModLevelByName($module_name);
					if(!$permission) {
						return FALSE;	
					}else {
						if($user_level >= $permission->Level OR $user_level <= $permission->Level) {
							return TRUE;
						}else {
							return FALSE;	
						}
					}
				break;
				case 'id' :
					$permission = $this->mods->getModLevelByID($module_name);
					if(!$permission) {
						return FALSE;	
					}else {
						if($user_level >= $permission->Level) {
							return TRUE;	
						}else {
							return FALSE;	
						}
					}
				break;
				default:
					$modules = $this->mods->getModulesByAccessLevel($user_level);
					return $modules;
				break;
			endswitch;	
		}
		
		//custom 404 page
		public function Page_Not_Found() {
			$this->LoadTemplate('pages/404');
		}
		
		//Access Denied
		public function AccessDenied() {
			$this->LoadTemplate('pages/access_denied');
		}
		
		//This tells me what level the user is currently logged in as.
		public function DisplaySettings() {
			$display_session = $this->user['DropdownDefault'];
			$level = substr($display_session->SelectedID, 0, 1);
			//Readable way to tell what level were on.
			if($level == 'a') {
				$this->LevelView = 'Agency';	
			}elseif($level == 'g') {
				$this->LevelView = 'Group';	
			}elseif($level == 'c') {
				$this->LevelView = 'Client';	
			}else {
				//if super admin
				$this->LevelView = 'Agency';
				//if group admin group level
			}
		}
		
		public function Form_processor($page, $which) {
			switch($page) :
				case "agency":
					switch($which):
						case "add":
							//create array from port post elements
							$form = $this->input->post();
							$add = $this->administration->addAgencies($form);
							if($add) {
								redirect('/admin/agency/listing/success','location');
							}else {
								redirect('/admin/agency/add/error', 'location');	
							}
						break;
						case "edit":
							//todo
						break;
						case "disable":
							//disable
						break;
					endswitch;
				break;
				case "users":
					switch($which) :
						case "add":
							//add users
							$form = $this->input->post();
							print_object($form); 
							/*
							$add = $this->administration->addAgencies($form);
							if($add) {
								redirect('/admin/users/listing/success','location');	
							}else {
								redirect('/admin/users/add/error','location');
							}*/
						break;
					endswitch;
				break;
			
			endswitch;
		}
	}
