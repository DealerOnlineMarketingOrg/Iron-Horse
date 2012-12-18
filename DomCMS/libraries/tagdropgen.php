<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	if (!session_id()) session_start();
	class TagdropGen {
		
		var $ValidUser;
		var $ci;
		public $str1;
		
		public function __construct() {
			//DO NOTHING
		}
		
		public function drivetagdrop() {
			$this->ci =& get_instance();
			$this->ValidUser = $this->ci->session->userdata('valid_user');
			$this->DropdownDefault = $this->ValidUser['DropdownDefault'];
			$tag_id = $this->DropdownDefault->SelectedTag;
			
			(($tag_id == '0') ? $tagdropstr = '1' : $tagdropstr = '0' ) ;

			$tQuery = $this->ci->dropdown->TagQuery();
			
			$str1 ='';
			foreach ($tQuery as $row)
			{
			    $tag_name=$row->TAG_Name;
				$tag_ids=$row->TAG_ID;	
				$tag_color=$row->TAG_Color;	
				(($tag_ids == $tag_id) ? $tagfix = '1' : $tagfix = '0');
				 
			    $str1 .=$tag_name.','.$tag_ids.','.$tag_color.','.$tagfix.'|';
			}
			return $str1;
		}
	}
?>