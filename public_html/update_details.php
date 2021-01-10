<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();

// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.html');
	exit;
}

//set up connection
include 'db/_con.php';


// Get email from accounts
$stmt = $con->prepare('SELECT email, ud.given_name, ud.surname, ud.mobile, a.street, a.house, a.city, a.postcode FROM accounts as ac
JOIN userdetails as ud
ON ac.id = ud.user_id
JOIN addresses as a
on ac.id = ud.user_id
WHERE id = ?');
$stmt->bind_param('i', $_SESSION['id']);
$stmt->execute();
$stmt->bind_result($email, $given_name, $surname, $mobile, $street,$house,$city,$postcode );
$stmt->fetch();
$stmt->close();

?>


<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Profile Page</title>
		<link href="style.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	</head>
	<body class="loggedin">
		<?php
                include 'navBar/top';
                ?>

		<div class="content">
			<h2>Update Details</h2>
			<div>
				<p>Your account details are below:</p>
				<table>
					<tr>
						<td>Username:</td>
						<td><?=$_SESSION['name']?></td>
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
			<form action="db/update_details_engine.php" method="post" autocomplete="off">
			   
			<label for="given_name">
					<i class="fas fa-user"></i>
				</label>
				<input type="text" name="given_name" placeholder="Name" id="given_name">

				<label class="no_bcg" for="surname">
					<i class="fas"></i>
				</label>
				<input type="text" name="surname" placeholder="Surname" id="surname" >

				<br>

				<label for="mobile">
					<i class="fas fa-mobile"></i>
				</label>
				<input type="text" name="mobile" placeholder="Tel/Mobile" id="mobile">

				<br>

				<label for="house">
					<i class="fas fa-building "></i>
				</label>
				<input type="text" name="house" value="<?=$house?>" placeholder="Numer" id="house">

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
