<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	function get_welcome_message() {
		$ci =& get_instance();
		return 'Welcome, ' . $ci->session->userdata['valid_user']['FirstName'] . ' ' . $ci->session->userdata['valid_user']['LastName'];
	}