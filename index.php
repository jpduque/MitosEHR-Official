<?php

/* MitosEHR Starter
 * 
 * Description: This will start the application, if no sites are found
 * in the sites directory run the setup wizard, if a directory is found
 * run the login screen. When the logon is submitted it will validate
 * the user and start the main application
 * 
 * Author: Gino Rivera Falú
 * Ver: 0.0.2
 * 
 */

//----------------------------------------------------------------
// Startup the SESSION
// This will change in the future. 
// Maybe implement a SESSION Manager against the database.
//---------------------------------------------------------------- 
session_name ( "MitosEHR" );
session_start();
session_cache_limiter('private');
define('_MitosEXEC', 1);
//----------------------------------------------------------------
// Startup the registry
// This containts SESSION Variables to use in the application
//----------------------------------------------------------------
include_once("registry.php");
//----------------------------------------------------------------
// Make the auth process
//----------------------------------------------------------------
if ($_SESSION['user']['auth']){
	if ($_SESSION['user']['auth'] == true){
		//----------------------------------------------------------------
		// Load the i18n Library
		// Load the main screen
		//----------------------------------------------------------------
		include_once("library/I18n/I18n.inc.php");
		include_once("interface/main/main_screen.ejs.php");
	}
//----------------------------------------------------------------
// Make the logon process or Setup process
//----------------------------------------------------------------
} else {
	//----------------------------------------------------------------
	// Browse the site dir first
	//----------------------------------------------------------------
	$count = 0;
	$d = dir("sites/");
	while (false !== ($entry = $d->read())) { if ( $entry != "." && $entry != ".."){ $count++; } }
	//----------------------------------------------------------------
	// If no directory is found inside sites dir run the setup wizard,
	// if a directory is found inside sites dir run the logon screen
	//----------------------------------------------------------------
	if( $count <= 0){
		include_once("install/install.ejs.php");
	} else {
		include_once("interface/login/login.ejs.php");
	}	
}
?>