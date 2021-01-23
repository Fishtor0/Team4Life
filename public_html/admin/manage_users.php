<?php

session_start();

if ($_SESSION['admin'] == 'user') {
	header('Location: ../common/home.php');
	exit;
}

$results_per_page = 10; // number of results per page

//set up connection
include '../db/_con.php';

// set pages
if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; }; 
$start_from = ($page-1) * $results_per_page;

$sql = "SELECT a.id, a.username, a.email, u.given_name, u.surname, u.dob, u.mobile, ad.street, ad.house, ad.city, ad.postcode FROM accounts a
JOIN userdetails u
on u.user_id = a.id
JOIN addresses ad
on ad.user_id = a.id ORDER BY a.id ASC LIMIT $start_from, ".$results_per_page;
$rs_result = $con->query($sql);
?>


<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>T4L - Users</title>
		<link href="../style.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	</head>
	<body class="loggedin">
			<?php
				
				include '../navBar/top';
				
      ?>

		
		<div class="">
			<h2>Manage users</h2>
			Users Table:
		</div>



<table><tr><th>ID</th><th>Username</th><th>Email</th><th>Name</th><th>D.O.B</th><th>Mobile</th><th>Address</th><th>

<?php 
 while($row = $rs_result->fetch_assoc()) {
   echo "<tr><td>".$row["id"]."</td><td>".$row["username"]."</td><td>".$row["email"]."</td><td>".$row["given_name"]." " .$row["surname"]."</td><td>".$row["dob"]."</td><td>".$row["mobile"]."</td><td>".$row["house"]. " ".$row["street"]." ".$row["postcode"]." " .$row["city"]."</td></tr>";
    }
  ?>
   </table>
<?php 
$sql = "SELECT COUNT('id') AS total FROM accounts";
$result = $con->query($sql);
$row = $result->fetch_assoc();
$total_pages = ceil($row["total"] / $results_per_page); // calculate total pages with results
  
for ($i=1; $i<=$total_pages; $i++) {  // print links for all pages
            echo "<a href='manage_users.php?page=".$i."'";
            if ($i==$page)  echo " class='curPage'";
            echo ">".$i."</a> "; 
}; 
?>
	</body>
</html>