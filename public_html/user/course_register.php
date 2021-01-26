<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();


// load helpers
include '../helpers/_engine.php';

// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: ../index.html');
	exit;
}

//set up connection
include '../db/_con.php';


// Get email from accounts
$stmt = $con->prepare('SELECT email, ud.given_name, ud.surname, a.street, a.house, a.city, a.postcode FROM accounts as ac
JOIN userdetails as ud
ON ac.id = ud.user_id
JOIN addresses as a
on ac.id = ud.user_id
WHERE id = ?');
$stmt->bind_param('i', $_SESSION['id']);
$stmt->execute();
$stmt->bind_result($email, $given_name, $surname, $street, $house, $city, $postcode );
$stmt->fetch();
$stmt->close();

?>


<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Register on Course</title>
		<link href="../style.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	</head>
	<body class="loggedin">
		<?php
                include '../navBar/top';
                ?>

		<div class="content">
			<h2><?=$course_reg_userDetails?></h2>

			<div>
				<table>
					<tr>
						<td><?=$label_username?></td>
						<td><?=$_SESSION['name']?></td>
					</tr>
					<tr>
						<td><?=$label_name?></td>
						<td><?=$given_name?></td>
					</tr>
					<tr>
						<td><?=$label_surname?></td>
						<td><?=$surname?></td>
					</tr>
					<tr>
						<td><?=$label_email?></td>
						<td><?=$email?></td>
					</tr>
				</table>
			</div>
			<div>
            <div class="register">
			<h1><?=$label_address?></h1>
			<form action="../db/register_on_course.php" method="post" autocomplete="off">
               
				<label for="house">
					<i class="fas fa-building "></i>
				</label>
				<input type="text" name="house" value="<?=$house?>" id="house" required>

                <label class="no_bcg"  for="street">
					<i class="fas "></i>
				</label>
                <input type="text" name="street" value="<?=$street?>" id="street" required>
                
				<label class="no_bcg" for="city">
					<i class="fas "></i>
				</label>
				<input type="text" name="city" value="<?=$city?>" id="city" required>

				<label class="no_bcg" for="postcode">
					<i class="fas fa-building"></i>
				</label>
				<input type="text" name="postcode" value="<?=$postcode?>" id="postcode" required>
				<input type="hidden" name="course_id" value="<?=$_POST['course_id']?>" id="course_id">
				<input type="submit" value="<?=$label_btn_update?>">
				
                </form>
	</body>
</html>
