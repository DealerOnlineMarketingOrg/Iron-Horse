<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');


// Query Helper should be only be used in Models with such syntax:
// class Examples_model extends CI_Model {
//     public function __construct() {
//         parent::__construct();
//         // Loading QueryHelper
//         get_instance()->load->helper('query');
//     }
// }

// This is a flag to prevent infinite loops of crashes.
$hasCrashed = false;

// Executes a query, checks if there's results and returns them or NULL
function GetResultsFromQuery($context, $sql) {
    $query = $context->db->query($sql);

    // if it's an object (SELECT)
    if (is_object($query)) {
        $results = $query->result();

        if (count($results) > 0) {
            return $results;
        } else {
            // if there's no result, return an empty array to prevent errors
            return array();
        }

    // if it's a bool (INSERT/UPDATE)
    } else if ($query) {
        return TRUE;        

    // else it's a SQL error
    } else {
        // If the query is null, then there's something wrong with field names or something
        return 'There was an error with the query';
        //return FALSE;
    }
}

// Executes a query, checks if there's results and returns the one of them or NULL
function GetFirstResultFromQuery($context, $sql) {
    $results = GetResultsFromQuery($context, $sql);

    if (count($results) > 0) {
        return $results[0];
    } else {
        return NULL;
    }    
}

// Uses GetResultsFromQuery to check if the query returns data, returns TRUE or FALSE
function QueryReturnsData($context, $sql) {
    $results = GetResultsFromQuery($context, $sql);

     if (count($results) > 0) {
        return TRUE;
    } else {
        return FALSE;
    }
}