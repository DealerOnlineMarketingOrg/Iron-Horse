<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	function get_welcome_message() {
		$ci =& get_instance();
		return 'Welcome, ' . $ci->session->userdata['valid_user']['FirstName'] . ' ' . $ci->session->userdata['valid_user']['LastName'];
	}
	
	function dealer_selector() {
		$ci =& get_instance();
		$ci->load->library('dropdowngen');
		return dropdown_parser($ci->dropdowngen->drivedrop());
	}
	
<<<<<<< HEAD
	
	function tag_selector() {
		$ci =& get_instance();
		$ci->load->library('tagdropgen');
		//print_r(client_tag_parser($ci->tagdropgen->drivetagdrop()));
		$ValidUser = $ci->session->userdata('valid_user');
		$DropdownDefault = $ValidUser['DropdownDefault'];
		$tag_id = $DropdownDefault->SelectedTag;
		return client_tag_parser($ci->tagdropgen->drivetagdrop(), $tag_id);
		
	}
	
	
=======
>>>>>>> master
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