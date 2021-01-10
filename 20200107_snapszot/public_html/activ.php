<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.html');
	exit;
}

//set up connection
include 'db/_con.php';


$stmt = $con->prepare('SELECT activation_code FROM accounts WHERE id = ?');
// In this case we can use the account ID to get the account info.
$stmt->bind_param('i', $_SESSION['id']);
$stmt->execute();
$stmt->bind_result($_SESSION['account']);
$stmt->fetch();
if ($_SESSION['account'] == 'activated') {
	// account is activated
	// Display home page etc
} else {
        header('Location: index.html');
	exit;
}
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>Activated User Content</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
<?php
                include 'navBar/top';
?>
        <div>You are in activated area</div>
    </body>
</html>

