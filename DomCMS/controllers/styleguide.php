<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Styleguide extends DOM_Controller {
		
		public function __construct() {
			parent::__construct();	
		}
		
		public function index() {
			$this->LoadTemplate('pages/styleguide');
		}
		public function addgroups() {
			$this->LoadTemplate('forms/form_addgroups');
		}
		public function addclients() {
			$this->LoadTemplate('forms/form_addclients');
		}
		public function addusers() {
			$this->LoadTemplate('forms/form_addusers');
		}
		public function addcontacts() {
			$this->LoadTemplate('forms/form_addcontacts');
		}
		public function addwebsites() {
			$this->LoadTemplate('forms/form_addwebsites');
		}
		public function editgroups() {
			$this->LoadTemplate('forms/form_editgroups');
		}
		public function editclients() {
			$this->LoadTemplate('forms/form_editclients');
		}
		public function editusers() {
			$this->LoadTemplate('forms/form_editusers');
		}
		public function editcontacts() {
			$this->LoadTemplate('forms/form_editcontacts');
		}
		public function editwebsites() {
			$this->LoadTemplate('forms/form_editwebsites');
		}
	}
