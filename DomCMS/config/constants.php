<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/

define('FOPEN_READ','rb');
define('FOPEN_READ_WRITE','r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE','wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE','w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE','ab');
define('FOPEN_READ_WRITE_CREATE','a+b');
define('FOPEN_WRITE_CREATE_STRICT','xb');
define('FOPEN_READ_WRITE_CREATE_STRICT','x+b');

define('SITETITLE','Dealer Online Marketing | Content Manager');
define('THEMEDIR','ReActive');
define('DOMDIR','Global');
define('DROPDOWNS',true);
define('CLIENTFILTER',true);
define('TAGFILTER',true);
define('SEARCH',false);
define('BREADCRUMBS',true);
define('USERNAVIGATION',false);
define('BOOKMARKS',true);
define('ACCOUNT',true);
define('SETTINGS',true);
define('PRIVACY',true);
define('APPROVALS',true);
define('MESSAGES',true);

define('COPYRIGHT', '&copy; Copyright ' . date('Y') . ' DealerOnlineMarketing.com. All Rights Reserved.');

//Some date display templates
define('FULL_MILITARY_DATETIME','Y-m-d H:i:s'); //DISPLAYS IN 24 HOUR FORMAT
define('FULL_NORMAL_DATETIME', 'Y-m-d h:i:s a'); //DISPLAYS IN 12 HOUR FORMAT WITH AM OR PM, ALL NUMBERS
define('FULL_TEXT_DATETIME','l F NS, Y \a\t g:i a'); //DISPLAYS TEXT DATETIME like Sunday January 1st 2012 at 1:00 am



/* End of file constants.php */
/* Location: ./application/config/constants.php */