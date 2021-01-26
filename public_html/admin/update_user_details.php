<?php

session_start();

if ($_SESSION['admin'] == 'user') {
	header('Location: ../common/home.php');
	exit;
}

//set up connection
include '../db/_con.php';
echo 'user id:'.$_POST['user_id'];

// Get email from accounts
$stmt = $con->prepare('SELECT ac.username, ac.email, ud.given_name, ud.surname, ud.mobile, ud.dob, ad.street, ad.house, ad.city, ad.postcode FROM accounts as ac
JOIN userdetails as ud
ON ac.id = ud.user_id
JOIN addresses as ad
on ac.id = ad.user_id
WHERE ac.id = ?');
$stmt->bind_param('i', $_POST['user_id']);
$stmt->execute();
$stmt->bind_result($username, $email, $given_name, $surname, $mobile, $dob, $street,$house,$city,$postcode );
$stmt->fetch();
$stmt->close();
echo $mobile;
?>


<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>T4L - Update User</title>
		<link href="../style.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	</head>
	<body class="loggedin">
		<?php
                include '../navBar/top';
                ?>

		<div class="content">
			<h2>Update User</h2>
			<div>
				<p>You are changing details for: <?=$given_name?> <?=$surname?></p>
				<table>
					<tr>
						<td>Username:</td>
						<td><?=$username?></td>
					</tr>
					<tr>
						<td>Email:</td>
						<td><?=$email?></td>
					</tr>
				</table>
			</div>
			<div>
            <div class="register">
			<h1>Update Details</h1>
			<form action="../db/admin_update_user_details_engine.php" method="post" autocomplete="off">
			<input type="hidden" name="user_id" id="user_id" value="<?php echo $_POST['user_id'] ?>" />
			<label for="email">
			
					<i class="fas fa-envelope"></i>
				</label>
				<input type="email" name="email" placeholder="example@domain.com" value="<?=$email?>" id="email" required>

			<label for="given_name">
			
					<i class="fas fa-user"></i>
				</label>
				<input type="text" name="given_name" placeholder="Name" value="<?=$given_name?>" id="given_name" required>

				<label class="no_bcg" for="surname">
					<i class="fas"></i>
				</label>
				<input type="text" name="surname" placeholder="Surname" value="<?=$surname?>" id="surname" required>

				<label  for="dob">
					<i class="fas fa-calendar"></i>
				</label>
				<input type="text" name="dob" value="<?=$dob?>" id="dob" required>

				<label for="mobile">
					<i class="fas fa-mobile"></i>
				</label>
				<input type="number" name="mobile" placeholder="Tel/Mobile" id="mobile" value="<?=$mobile?>">

				<label for="house">
					<i class="fas fa-building "></i>
				</label>
				<input type="text" name="house" value="<?=$house?>" placeholder="Number" id="house">

                <label class="no_bcg"  for="street">
					<i class="fas "></i>
				</label>
                <input type="text" name="street" value="<?=$street?>" placeholder="Ulica" id="street">
                
				<label class="no_bcg" for="city">
					<i class="fas "></i>
				</label>
				<input type="text" name="city" value="<?=$city?>" placeholder="City" id="city">

				<label class="no_bcg" for="postcode">
					<i class="fas fa-building"></i>
				</label>
				<input type="text" name="postcode" value="<?=$postcode?>" placeholder="Postcode" id="postcode">
				
                <input type="submit" value="Update">
                </form>
	</body>
</html>
