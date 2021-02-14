<?php

session_start();

if ($_SESSION['admin'] == 'user') {
	header('Location: ../common/home.php');
	exit;
}

//set up connection
include '../db/_con.php';


if ($stmt = $con->prepare('UPDATE addresses SET city = ?, house = ?, street = ?, postcode = ? WHERE user_id = ?')) {
   
    $stmt->bind_param('ssssi', $_POST['city'], $_POST['house'], $_POST['street'], $_POST['postcode'], $_POST['user_id']);
    $stmt->execute();
    $stmt->close();

    if ($stmt = $con->prepare('UPDATE userdetails SET given_name = ?, surname = ?, mobile = ?, dob = ? WHERE user_id = ?')) {
   
        $stmt->bind_param('ssssi', $_POST['given_name'], $_POST['surname'], $_POST['mobile'],$_POST['dob'], $_POST['user_id']);
        $stmt->execute();
        $stmt->close();


        //echo 'your details have been updated';
        header('Location: ../admin/manage_users.php');
    }
} else {
    // Something is wrong with the sql statement, check to make sure accounts table exists with all 3 fields.
    echo 'Could not update your account right now! Please contact Admin or try again later';
}		

$con->close();


?>