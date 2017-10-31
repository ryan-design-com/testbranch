<?php

//defined('APP_DEBUG_OPTION') ? null : define('APP_DEBUG_OPTION', true);
defined('APP_DEBUG_OPTION') ? null : define('APP_DEBUG_OPTION', false);

error_reporting(0);
//error_reporting(E_ALL);

// DIRECTORY_SEPARATOR is a PHP pre-defined constant
// (\ for Windows, / for Unix)
defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);

defined('SITE_ROOT') ? null : define('SITE_ROOT', $_SERVER['DOCUMENT_ROOT']);
defined('JOB_TYPE') ? null : define('JOB_TYPE', "WEB");


$subscriptionDir = dirname(dirname(dirname(__FILE__)));
//echo $subscriptionDir . "<br>";

defined('LIB_PATH') ? null : define('LIB_PATH', 'includes');
defined('SITE_CONFIG_PATH') ? null : define('SITE_CONFIG_PATH', $subscriptionDir);

//echo "==++=<br>" . $_SERVER['PHP_SELF'] . "<br>"; 

$phpSelfPath = $_SERVER['PHP_SELF'];
$phpSelfArray = explode("/", $phpSelfPath);

//echo "**<br>toatl = " . $phpSelfArray[count($phpSelfArray) - 2] . "<br>";

//defined('ADMIN_PANEL_NAME') ? null : define('ADMIN_PANEL_NAME', 'AppointmentsRyan');
defined('ADMIN_PANEL_NAME') ? null : define('ADMIN_PANEL_NAME', $phpSelfArray[count($phpSelfArray) - 2]);

date_default_timezone_set('America/New_York');

//echo "==++=<br>LIB_PATH " . LIB_PATH . "<br>"; 
// load config file first
require_once(SITE_CONFIG_PATH.DS.'config.php');

require_once(LIB_PATH.DS.'class.phpmailer.php');
require_once(LIB_PATH.DS.'class.smtp.php');

// load basic functions next so that everything after can use them
require_once(LIB_PATH.DS.'functions.php');

// load core objects
require_once(LIB_PATH.DS.'session.php');
require_once(LIB_PATH.DS.'database.php');
require_once(LIB_PATH.DS.'database_object.php');
//recaptchalib
require_once(LIB_PATH.DS.'recaptchalib.php');

// load database-related classes
require_once(LIB_PATH.DS.'user.php');
require_once(LIB_PATH.DS.'user_types.php');
require_once(LIB_PATH.DS.'register_forms.php');

require_once(LIB_PATH.DS.'email.php');

//require_once(LIB_PATH.DS.'dataServices.php');




?>