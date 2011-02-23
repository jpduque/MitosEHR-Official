<?php
//--------------------------------------------------------------------------------------------------------------------------
// data_create.ejs.php / List Options
// v0.0.2
// Under GPLv3 License
//
// Integrated by: GI Technologies Inc. in 2011
//
// Remember, this file is called via the Framework Store, this is the AJAX thing.
//--------------------------------------------------------------------------------------------------------------------------

session_name ( "MitosEHR" );
session_start();

include_once("library/adoHelper/adoHelper.inc.php");
include_once("library/I18n/I18n.inc.php");
require_once("repository/dataExchange/dataExchange.inc.php");

// *************************************************************************************
// Parce the data generated by EXTJS witch is JSON
// *************************************************************************************
$data = json_decode ( $_POST['row'] );

// *************************************************************************************
// Validate and pass the POST variables to an array
// This is the moment to validate the entered values from the user
// although Sencha EXTJS make good validation, we could check again 
// just in case 
// *************************************************************************************
$row['list_id'] = dataEncode($data[0]->list_id);
$row['option_id'] = dataEncode($data[0]->option_id);
$row['title'] = dataEncode($data[0]->title);
$row['is_default'] = (trim($data[0]->is_default) == 'on' ? 1 : 0);
$row['option_value'] = dataEncode($data[0]->option_value);
$row['mapping'] = dataEncode($data[0]->mapping);
$row['notes'] = dataEncode($data[0]->notes);

// *************************************************************************************
// Finally that validated POST variables is inserted to the database
// This one make the JOB of two, if it has an ID key run the UPDATE statement
// if not run the INSERT stament
// *************************************************************************************
sqlStatement("INSERT INTO 
				list_options 
			SET
				list_id = '" . $row['list_id'] . "', " . "
				option_id = '" . $row['option_id'] . "', " . "
				title = '" . $row['title'] . "', " . "
				is_default = '" . $row['is_default'] . "', " . "
				option_value = '" . $row['option_value'] . "', " . "
				mapping = '" . $row['mapping'] . "', " . "
				notes = '" . $row['notes'] . "'");

?>