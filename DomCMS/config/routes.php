<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

//login page form
$route['login'] 						= 'auth/login';
//reset password form
$route['reset_password'] 				= 'auth/reset_password';
//change password form
$route['change_password'] 				= 'auth/change_password';
//used to process the password_reset form
$route['generate_password']				= 'auth/process_forgot_pass';
//process change password
$route['process_change_password']       = 'auth/password_change';
//used to process the login
$route['authenticate'] 					= 'auth/login_user';
//logout
$route['logout']						= 'auth/logout';
//system routes
$route['default_controller']            = "reports/dashboard";
$route['404_override'] 					= 'errors/file_not_found';
/* End of file routes.php */
/* Location: ./application/config/routes.php */