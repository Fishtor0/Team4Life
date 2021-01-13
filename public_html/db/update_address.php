<?php
session_start();
//set up connection
include '../db/_con.php';


// Now we check if the data was submitted, isset() function will check if the data exists.
if (!isset( $_POST['city'], $_POST['house'], $_POST['street'], $_POST['postcode'])) {
	// Could not get the data that should have been sent.
	exit('Please complete the registration form!');
}

// Make sure the submitted registration values are not empty.
if (empty( $_POST['city'] || $_POST['house'] || $_POST['street'] || $_POST['postcode'])) {

	exit('Some Information is missing form your Update Form.');
}

if ($stmt = $con->prepare('UPDATE addresses SET city = ?, house = ?, street = ?, postcode = ? WHERE user_id = ?')) {
   
    $stmt->bind_param('ssssi', $_POST['city'], $_POST['house'], $_POST['street'], $_POST['postcode'], $_SESSION['id']);
    $stmt->execute();
    $stmt->close();

    //echo 'your details have been updated';
    header('Location: ../user/profile.php');
} else {
    // Something is wrong with the sql statement, check to make sure accounts table exists with all 3 fields.
    echo 'Could not update your account right now! Please contact Admin or try again later';
}		

$con->close();


?>