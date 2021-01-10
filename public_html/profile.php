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
$stmt = $con->prepare('SELECT email, ud.given_name, ud.surname, ad.street, ad.house, ad.city, ad.postcode FROM accounts as ac
JOIN userdetails as ud
ON ac.id = ud.user_id
JOIN addresses as ad
on ac.id = ad.user_id
WHERE ac.id = ?');
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
		<title>Profile Page</title>
		<link href="style.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	</head>
	<body class="loggedin">
		<?php
                include 'navBar/top';
                ?>
		<div class="content">
			<h2>Profile Page</h2>
			<div>
				<p>Your account details are below:</p>
				<table>
					<tr>
						<td>Username:</td>
						<td><?=$_SESSION['name']?></td>
					</tr>
					<tr>
						<td>Name:</td>
						<td><?=$given_name?></td>
					</tr>
					<tr>
						<td>Surname:</td>
						<td><?=$surname?></td>
					</tr>
					<tr>
						<td>Email:</td>
						<td><?=$email?></td>
					</tr>
				</table>
			</div>
			<div>
				<p>Address:</p>
				<table>
					<tr>
						<td>House number:</td>
						<td><?=$house?></td>
					</tr>
					<tr>
						<td>Street:</td>
						<td><?=$street?></td>
					</tr>
					<tr>
						<td>City:</td>
						<td><?=$city?></td>
					</tr>
					<tr>
						<td>Postcode:</td>
						<td><?=$postcode?></td>
					</tr>
				</table>
				<form action="update_details.php">
					<input type="submit" value="Change Address" />
				</form>
				
	</body>
</html>
