<?php
session_start();

if ($_SESSION['admin'] == 'user') {
	header('Location: ../common/home.php');
	exit;
}

//set up connection
include '../db/_con.php';


// check if the data was submitted, isset() function will check if the data exists.
if (!isset(
	$_POST['status'],
	$_POST['course_id'],
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

if ($stmt = $con->prepare('UPDATE courses SET
	status =?,
	title = ?,
	description = ?,
	course_cat = ?,
	course_type = ?, 
	start_date = ?, 
	end_date = ?, 
	spaces = ?, 
	price = ?, 
	deposit = ? where course_id = ?'))
	{
	$stmt->bind_param('sssssssiiii',
	$_POST['status'],
	$_POST['c_title'],
	$_POST['description'],
	$_POST['course_cat'],
	$_POST['course_type'], 
	$_POST['start_date'],  
	$_POST['end_date'], 
	$_POST['spaces'], 
	$_POST['price'], 
	$_POST['deposit'], 
	$_POST['course_id']);
	$stmt->execute();
	$stmt->close();

	header('Location: ../admin/manage_courses.php');
} else {
	// Something is wrong with the sql statement, check to make sure accounts table exists with all 3 fields.
	echo 'Could not update course right now!';
}		

$con->close();
?>
