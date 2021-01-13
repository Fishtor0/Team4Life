<?php


// Change this to your connection info.

//test DB
$DATABASE_HOST = 'db5001443767.hosting-data.io';
$DATABASE_USER = 'dbu708833';
$DATABASE_PASS = 'r@ndomPassword2384!';
$DATABASE_NAME = 'dbs1216474';


/*
$DATABASE_HOST = 'db5001437133.hosting-data.io';
$DATABASE_USER = 'dbu187820';
$DATABASE_PASS = 'Team4F1f3@_Wajawaja';
$DATABASE_NAME = 'dbs1211464';

*/
// Try and connect using the info above.
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);

if (mysqli_connect_errno()) {
	// If there is an error with the connection, stop the script and display the error.
	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}

?>