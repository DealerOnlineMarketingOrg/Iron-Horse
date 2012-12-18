<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

	//USE THIS HELPER TO CHECK AND COUNT ROWS
	function query_results($context,$sql) {
		$query = $context->db->query($sql);
		
		if(!$query) :
			return FALSE;	
		else :
			if($query->num_rows() > 1) {
				return $query->result();
			}else {
				return $query->row();	
			}
		endif;
	}
	
	function query_row($context,$sql) {
		$query = $context->db->query($sql);
		if(!$query) :
			return FALSE;
		else :
			return $query->row();
		endif;	
	}
	
	