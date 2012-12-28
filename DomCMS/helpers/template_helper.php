<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	function get_welcome_message() {
		$ci =& get_instance();
		return 'Welcome, ' . $ci->session->userdata['valid_user']['FirstName'] . ' ' . $ci->session->userdata['valid_user']['LastName'];
	}
	
	function breadcrumb(){
		$ci = &get_instance();
		$i=1;
		$uri = $ci->uri->segment($i);
		$link = '<ul class="crumbs">';
		while($uri != ''){
			$prep_link = '';
			for($j=1; $j<=$i;$j++){
				$prep_link .= $ci->uri->segment($j).'/';
			}
			if($ci->uri->segment($i+1) == ''){
				$link.='<li><a class="current" href="'.site_url($prep_link).'">';
				$link.=$ci->uri->segment($i).'</a></li> ';
			}else{
				$link.='<li><a href="'.site_url($prep_link).'">';
				$link.=$ci->uri->segment($i).'</a></li> ';
			}
			$i++;
			$uri = $ci->uri->segment($i);
		}
		$link .= '</ul>';
		return $link;
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
		return dropdown_parser($ci->dropdowngen->drivedrop());
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
		//get client type from session
		$level_type = get_level_type();
		if($level_type == 'a') :
			$name = 'Agency Name:';
		elseif($level_type == 'g') :
			$name = 'Group Name:';
		elseif($level_type == 'c') :
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
		$level_type = get_level_type();
		$level_id = get_level_id();
		
		if($level_type == 'a') :
			$results = $ci->dropdown->AgenciesQuery($level_id,true);
			$name = $results->AGENCY_Name;
		elseif($level_type == 'g') :
			$results = $ci->dropdown->GroupsQuery($level_id,false,true);
			$name = $results->GROUP_Name;
		elseif($level_type == 'c') :
			$results = $ci->dropdown->ClientQuery($level_id,false,true);
			$name = $results->CLIENT_Name;
		else :
			$results = NULL;
			$name = '';
		endif;
		
		return $name;
		
	}