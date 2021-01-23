<?php

session_start();

if ($_SESSION['admin'] == 'user') {
	header('Location: ../common/home.php');
	exit;
}
$datatable = "courses"; // MySQL table name
$results_per_page = 10; // number of results per page

//set up connection
include '../db/_con.php';

// set pages
if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; }; 
$start_from = ($page-1) * $results_per_page;

$sql = "SELECT course_id, title, description, course_cat, course_type, start_date, end_date, spaces, price, deposit 
FROM ".$datatable." ORDER BY course_id ASC LIMIT $start_from, ".$results_per_page;
$rs_result = $con->query($sql);
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>T4L - Courses</title>
		<link href="../style.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	</head>
	<body class="loggedin">
			<?php
				
				include '../navBar/top';
				
      ?>

		
		<div class="">
			<h2>Manage courses</h2>
			Courses table:
		</div>


<table><tr><th>Title</th><th>Description</th><th>Category</th><th>Type</th><th>Start</th><th>End</th><th>Spaces</th><th>Price</th><th>Deposit</th></tr>
 
<?php 
 while($row = $rs_result->fetch_assoc()) {


  echo "<tr><td>".$row["title"]."</td><td>".$row["description"]."</td><td>".$row["course_cat"]."</td><td>".$row["course_type"]."</td><td>".$row["start_date"]."</td><td>".$row["end_date"]."</td><td>".$row["spaces"]."</td><td>".$row["price"]."</td><td>".$row["deposit"]."</td></tr>";
    }
  ?>
   </table>
<?php 
$sql = "SELECT COUNT(course_id) AS total FROM ".$datatable;
$result = $con->query($sql);
$row = $result->fetch_assoc();
$total_pages = ceil($row["total"] / $results_per_page); // calculate total pages with results
  
for ($i=1; $i<=$total_pages; $i++) {  // print links for all pages
            echo "<a href='manage_courses.php?page=".$i."'";
            if ($i==$page)  echo " class='curPage'";
            echo ">".$i."</a> "; 
}; 
?>
	</body>
</html>
