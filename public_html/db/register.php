<?php

//set up connection
include '../db/_con.php';


// Now we check if the data was submitted, isset() function will check if the data exists.
if (!isset($_POST['username'], $_POST['password'], $_POST['email'], $_POST['given_name'], $_POST['surname'])) {
	// Could not get the data that should have been sent.
	exit('Please complete the registration form!');
}

// Make sure the submitted registration values are not empty.
if (empty($_POST['username']) || empty($_POST['password']) || empty($_POST['email'])) {
	// One or more values are empty.
	exit('Please complete the registration form');
}

// email validation

if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
	exit('Email is not valid!');
}

// invalid character validation 

if (preg_match('/^[a-zA-Z0-9]+$/', $_POST['username']) == 0) {
    exit('Username is not valid!');
}

if (preg_match('/^[a-zA-Z]+$/', $_POST['given_name']) == 0) {
    exit('Name can only contain alphabet characters!');
}

if (preg_match('/^[a-zA-Z]+$/', $_POST['surname']) == 0) {
    exit('Surname can only contain alphabet characters!');
}

// character long validation 

if (strlen($_POST['password']) > 20 || strlen($_POST['password']) < 5) {
	exit('Password must be between 5 and 20 characters long!');
}


// We need to check if the account with that username exists.
if ($stmt = $con->prepare('SELECT id, password FROM accounts WHERE username = ?')) {
	// Bind parameters (s = string, i = int, b = blob, etc), hash the password using the PHP password_hash function.
	$stmt->bind_param('s', $_POST['username']);
	$stmt->execute();
	$stmt->store_result();
	// Store the result so we can check if the account exists in the database.
	if ($stmt->num_rows > 0) {
		// Username already exists
		echo 'Username exists, please choose another!';
	} else {
		// Username doesnt exists, insert new account
		if ($stmt = $con->prepare('INSERT INTO accounts (username, password, email, activation_code) VALUES (?, ?, ?, ?)')) {
			// We do not want to expose passwords in our database, so hash the password and use password_verify when a user logs in.
			$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
			$uniqid = uniqid();
			$stmt->bind_param('ssss', $_POST['username'], $password, $_POST['email'], $uniqid);
			$stmt->execute();
			$stmt->close();

			// get created user ID 
			if ($stmt = $con->prepare('SELECT id FROM accounts WHERE username = ?')) {
				$stmt->bind_param('s', $_POST['username']);
				$stmt->execute();
				$stmt->bind_result($userid);
				$stmt->fetch();
				$stmt->close();
				
				// prepare insert to user_details table
				if ($stmt = $con->prepare('INSERT INTO userdetails (user_id, given_name, surname, mobile) VALUES (?, ?, ?, ?)')) {
					$stmt->bind_param('isss', $userid, $_POST['given_name'], $_POST['surname'], $_POST['mobile']);
					$stmt->execute();
					$stmt->close();

					// prepare address insert
					if ($stmt = $con->prepare('INSERT INTO addresses (user_id) VALUES (?)')) {
						$stmt->bind_param('i',$userid);
						$stmt->execute();
						$stmt->close();

						// send activation code
						$from    = 'noreply@yourdomain.com';
						$subject = 'Account Activation Required';
						$headers = 'From: ' . $from . "\r\n" . 'Reply-To: ' . $from . "\r\n" . 'X-Mailer: PHP/' . phpversion() . "\r\n" . 'MIME-Version: 1.0' . "\r\n" . 'Content-Type: text/html; charset=UTF-8' . "\r\n";
						// Update the activation variable below
						$activate_link = 'https://www.thellama.co.uk/activate.php?email=' . $_POST['email'] . '&code=' . $uniqid;
						$message = '<p>Please click the following link to activate your account: <a href="' . $activate_link . '">' . $activate_link . '</a></p>';
						mail($_POST['email'], $subject, $message, $headers);
						echo 'Please check your email to activate your account!';
					} else {
						// Something is wrong with the sql statement, check to make sure accounts table exists with all 3 fields.
						echo 'Could not create address! Please contact Admin';
					}
				} else {
					// Something is wrong with the sql statement, check to make sure accounts table exists with all 3 fields.
					echo 'Could not create user details for! Please contact Admin';
					echo $userid;
				}	
			} else {
				// Something is wrong with the sql statement, check to make sure accounts table exists with all 3 fields.
				echo 'Could not find valid user! Please contact Admin';
			}
		} else {
			// Something is wrong with the sql statement, check to make sure accounts table exists with all 3 fields.
			echo 'Could not create account right now! Please contact Admin';
		}		
	}
	
} else {
	// Something is wrong with the sql statement, check to make sure accounts table exists with all 3 fields.
	echo 'There is something wrong with your request! Please contact Admin.' ;
}
$con->close();
?>