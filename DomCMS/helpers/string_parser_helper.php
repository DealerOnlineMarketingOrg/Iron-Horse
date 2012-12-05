<?php
	/**
	 * simple string of elements passed from the database in var:int,var:int format
	 *
	 * @param	string
	 */
	 function mod_parser($str) {
		//expload string into array and split on comma
		$str = explode(',',$str);
		
		//empty array to return
		$simple = array();
		//iterate through array and assign var name (before colon) as the key and the int(after colon) as value
		foreach($str as $item) {
			//expload the array values and create an array with keys that make sense to the app
			$mod = explode(':',$item);
			$simple[trim($mod[0])] = trim($mod[1]);
		}
		
		return $simple;
	 }
	 
	 function group_parser($str) {
		 //these are the delimiters to seperate strings and groups of strings
		$string_separater = ',';
		$group_separater = '|';
		//this is the delimeter to seperate title from value
		$title_separater = ':';
		//expload the string into an array
		$str = explode($group_separater,$str);
		//create an empty array to store return data
		$emails = array();
		
		//loop through array and pull out data from the strings
		foreach($str as $item) {
			//create array from comma seperated string
			$parts = explode($string_separater,$item);
			//loop through each of these and pull data
			foreach($parts as $key => $value) {
				//separate the title from the value. 
				//we use the title as the key for the array
				$keys = explode($title_separater,$value);
				//fill the array
				$group[trim($keys[0])] = trim($keys[1]);
			}
			//push data to fill empty array with our cleaned version
			array_push($emails,$group);
		}
		//return this to the app
		return $emails;
	 }
?>
