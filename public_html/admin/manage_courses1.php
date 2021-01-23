<?php

session_start();

if ($_SESSION['admin'] == 'user') {
	header('Location: ../common/home.php');
	exit;
}


//set up connection
include '../db/_con.php';

$sql = 'SELECT title, description, course_cat, course_type, start_date, end_date, spaces, price, deposit 
FROM courses';
$result = $con->query($sql);

if ($result->num_rows > 0) {
    echo "<table><tr><th>Title</th><th>Description</th><th>Category</th><th>Type</th><th>Start</th><th>End</th><th>Spaces</th><th>Price</th><th>Deposit</th></tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
      echo "<tr><td>".$row["title"]."</td><td>".$row["description"]."</td><td>".$row["course_cat"]."</td><td>".$row["course_type"]."</td><td>".$row["start_date"]."</td><td>".$row["end_date"]."</td><td>".$row["spaces"]."</td><td>".$row["price"]."</td><td>".$row["deposit"]."</td></tr>";
    }
    echo "</table>";
  } else {
    echo "0 results";
  }
  $con->close();
  ?>
