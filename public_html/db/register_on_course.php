<?php

session_start();

if (!isset($_SESSION['loggedin'])) {
	header('Location: ../index.html');
	exit;
}

//set up connection
include '../db/_con.php';
include '../navBar/top.php';


$today = date("Y-m-d");
// Now we check if the data was submitted, isset() function will check if the data exists.
if (!isset(
	$_POST['course_id'],
	$_SESSION['id'])){
	// Could not get the data that should have been sent.
	header('Location: ../common/home.php');
}



if ($stmt = $con->prepare('INSERT INTO userCourses (course_id, user_id, booking_date) VALUES (?, ?, ?)')) {
	
	$stmt->bind_param('iis',
	$_POST['course_id'],
	$_SESSION['id'],
	$today
	);
	$stmt->execute();
	$stmt->close();

	header('Location: ../user/my_courses.php');
} else {
	// Something is wrong with the sql statement, check to make sure accounts table exists with all 3 fields.
	echo 'Could not create course right now!';
}		

$con->close();
?>