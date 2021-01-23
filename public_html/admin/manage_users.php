<?php

session_start();

if ($_SESSION['admin'] == 'user') {
	header('Location: ../common/home.php');
	exit;
}

//set up connection
include '../db/_con.php';

$sql = 'SELECT a.id, a.username, a.email, u.given_name, u.surname, u.dob, u.mobile, ad.street, ad.house, ad.city, ad.postcode FROM accounts a
JOIN userdetails u
on u.user_id = a.id
JOIN addresses ad
on ad.user_id = a.id
';
$result = $con->query($sql);

if ($result->num_rows > 0) {
    echo "<table><tr><th>ID</th><th>Username</th><th>Email</th><th>Name</th><th>D.O.B</th><th>Mobile</th><th>Address</th><th>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
      echo "<tr><td>".$row["id"]."</td><td>".$row["username"]."</td><td>".$row["email"]."</td><td>".$row["given_name"]." " .$row["surname"]."</td><td>".$row["dob"]."</td><td>".$row["mobile"]."</td><td>".$row["house"]. " ".$row["street"]." ".$row["postcode"]." " .$row["city"]."</td></tr>";
    }
    echo "</table>";
  } else {
    echo "0 results";
  }
  $con->close();
  ?>
