<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	function get_welcome_message() {
		$ci =& get_instance();
		return 'Welcome, ' . $ci->session->userdata['valid_user']['FirstName'] . ' ' . $ci->session->userdata['valid_user']['LastName'];
	}
	
	function breadcrumb(){
		$ci = &get_instance();
		$i=1;
		$uri = $ci->uri->segment($i);
		$link = '<div class="container' . ((FLUIDLAYOUT) ? '-fluid' : '') . '">';
		$link .= "\t" . '<ul class="breadcrumbs">';
		$link .= "\t\t" . '<li><a href="' . base_url() . '"><i class="icon-home"></i></a></li>';
		while($uri != ''){
			$prep_link = '';
			for($j=1; $j<=$i;$j++){
				$prep_link .= $ci->uri->segment($j).'/';
			}
			if($ci->uri->segment($i+1) == ''){
				$link .= "\t\t" . '<li><a href="' . site_url($prep_link) . '">' . $ci->uri->segment($i) . '</a></li>';
			}else{
				$link .= "\t\t" . '<li><a href="' . site_url($prep_link) . '">' . $ci->uri->segment($i) . '</a></li>';
			}
			$i++;
			$uri = $ci->uri->segment($i);
		}
		$link .= "\t" . '</ul>';
		$link .= '</div>';
		return $link;
	}
	
	function showStates() {
		$ci = $get_instance();
		$ci->load->model('utilities');
		$states = $ci->utilities->getStates();
		$options = '';
		foreach($states as $state) {
			$option .= '<option value="' . $state->Abbrev . '">' . $state->Name . '</option>';
		}
		return $options;
	}
	
	function load_default_css() {
		$css_files = array(
			'Assets/' . THEMEDIR . 'css/plugins/jquery.visualize.css',
			'Assets/' . THEMEDIR . 'css/plugins/jquery.fullcalendar.css',
			'Assets/' . DOMDIR . 	'css/global.css',
			'Assets/' . THEMEDIR . 'css/template.css',
			'Assets/' . DOMDIR . 	'css/select2.css',
			'Assets/' . DOMDIR . 	'css/validationEngine.jquery.css'
		);
		
		$css = '';
		foreach($css_files as $file) { 
        	if(file_exists(FCPATH . $file)) { 
				$css .= '<link rel="stylesheet" type="text/css" href="' . base_url() . $file . '" />' . "\n";
			}
	    }
		
		return $css;
	}
	
	function load_default_js() {
		$js = '<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>' . "\n";
	
		$scripts = array(
			'Assets/' . THEMEDIR . 'js/libs/modernizr.js',
			'Assets/' . THEMEDIR . 'js/libs/selectivizr.js',
			'Assets/' . DOMDIR . 'js/select2.min.js',
			'Assets/' . DOMDIR . 'js/plugin.iconNav.js',
			'Assets/' . DOMDIR . 'js/jquery.formvalidation-en.js',
			'Assets/' . DOMDIR . 'js/jquery.formvalidation.js'
		);
	
		foreach($scripts as $script) :
			if(file_exists(FCPATH . $script)) :
				$js .= '<script type="text/javascript" src="' . base_url() . $script . '" charset="utf-8"></script>' . "\n";
			endif;
		endforeach;
		
		return $js;
	}
	
	function dealer_selector() {
		$ci =& get_instance();
		$ci->load->library('dropdowngen');
		$ci->load->helper('string_parser');
		//grap the string to build the options from
		$dropdown = $ci->dropdowngen->drivedrop();
		
		//create the select box
		$options  = '<select id="client_dd" data-placeholder="Dealer Dropdown" class="chzn-select" style="width:100%">' . dropdown_parser($dropdown) . '</select>';
		$options .= '<script type="text/javascript">
						$(document).ready(function() {
							$("#client_dd").change(function() {
								var name = $(this).find("option:selected").text();
								var level = $(this).find("option:selected").val();
								$.ajax({
									url:"/ajax/name_changer",
									data:({Agency:name,Level:level}),
									method:"post",
									success:function(data) {
									   location.reload();
									}
								});
							});
						})
					 </script>';
		return $options;
	}
	
	function permission_selector() {
		$ci =& get_instance();
		$ci->load->model('administration');
		$permissions = $ci->administration->getPermissionsList($ci->user['AccessLevel']);
		
		$options = '';
		$options .= '<select id="perms" placeholder="User Permissions" class="chzn-select validate[required]" style="width:30%;" name="user_level" tabindex="10">';
		foreach($permissions as $permission) {
			$options .= '<option value="' . $permission->ID . '" data-access-level="' . $permission->Level . '" data-modules="' . $permission->Modules . '">' . $permission->Name . '</option>';
		}
		$options .= '</select>';
		return $options;
	}
	
	function member_of_selector() {
		$ci =& get_instance();
		$ci->load->library('dropdowngen');
		$ci->load->helper('string_parser');
		$dropdown = $ci->dropdowngen->drivedrop();
		
		$options = '<select id="member_of" data-placeholder="Member Of Dropdown" class="chzn-select" style="width:30%" name="member_of">' . dropdown_parser($dropdown) . '</select>';
		return $options;
	}
	
	function tag_selector() {
		$ci =& get_instance();
		$ci->load->library('tagdropgen');
		//print_r(client_tag_parser($ci->tagdropgen->drivetagdrop()));
		$ValidUser = $ci->session->userdata('valid_user');
		$DropdownDefault = $ValidUser['DropdownDefault'];
		$tag_id = $DropdownDefault->SelectedTag;
		return client_tag_parser($ci->tagdropgen->drivetagdrop(), $tag_id);
	}
	
	function get_client_type() {
		$ci =& get_instance();
		$level_type = $ci->session->userdata['valid_user']['DropdownDefault']->LevelType;
		//get client type from session
		if($level_type == 'a' OR $level_type == 1) :
			$name = 'Agency Name:';
		elseif($level_type == 'g' OR $level_type == 2) :
			$name = 'Group Name:';
		elseif($level_type == 'c' OR $level_type == 3) :
			$name = 'Client Name:';
		else :
			$name = '';
		endif;
		
		return $name;
	}
	
	function get_client_name() {
		$ci =& get_instance();
		$ci->load->model('dropdown');
		$dropdown = $ci->session->userdata['valid_user']['DropdownDefault'];
		//print_object($dropdown);
		$level_type = $dropdown->LevelType;
		$level_id = $dropdown->LevelID;
		if($level_type == 1 OR $level_type == 'a') :
			$results = $ci->dropdown->AgenciesQuery($level_id,true);
			$name = $results->AGENCY_Name;
		elseif($level_type == 2 OR $level_type == 'g') :
			$results = $ci->dropdown->GroupsQuery($level_id,false,true);
			$name = $results->GROUP_Name;
		elseif($level_type == 3 OR $level_type == 'c') :
			$results = $ci->dropdown->ClientQuery($level_id,false,true);
			$name = $results->CLIENT_Name;
		else :
			$results = NULL;
			$name = '';
		endif;
		return $name;
	}