<?php

//set up connection
include '../db/_con.php';


// Now we check if the data was submitted, isset() function will check if the data exists.
if (!isset(
	$_POST['c_title'],
	$_POST['course_cat'],
	$_POST['course_type'], 
	$_POST['start_date'], 
	$_POST['end_date'],
	$_POST['description'],
	$_POST['spaces'],
	$_POST['price'],
	$_POST['deposit'])) {
	// Could not get the data that should have been sent.
	exit('Please complete the registration form!');
}

if ($stmt = $con->prepare('INSERT INTO courses (title, description, course_cat, course_type, start_date, end_date, spaces, price, deposit) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)')) {
	// We do not want to expose passwords in our database, so hash the password and use password_verify when a user logs in.
	$stmt->bind_param('ssssssiii',
	$_POST['c_title'],
	$_POST['description'],
	$_POST['course_cat'],
	$_POST['course_type'], 
	$_POST['start_date'], 
	$_POST['end_date'],
	$_POST['spaces'],
	$_POST['price'],
	$_POST['deposit']
	);
	$stmt->execute();
	$stmt->close();

	echo 'Your course have been created';
} else {
	// Something is wrong with the sql statement, check to make sure accounts table exists with all 3 fields.
	echo 'Could not create course right now!';
}		

$con->close();
?>