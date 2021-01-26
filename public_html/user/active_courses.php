<?php

session_start();

// load helpers
include '../helpers/_engine.php';

if (!isset($_SESSION['loggedin'])) {
	header('Location: ../index.html');
	exit;
}

$results_per_page = 10; // number of results per page

//set up connection
include '../db/_con.php';

// set pages
if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; }; 
$start_from = ($page-1) * $results_per_page;

$sql = 'SELECT c.course_id, c.title, c.description, c.course_cat, c.course_type, c.start_date, c.end_date, c.price
FROM courses as c WHERE c.status = "active"';
$rs_result = $con->query($sql);
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title><?=$active_courses_title?></title>
		<link href="../style.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	</head>
	<body class="loggedin">
			<?php
				
				include '../navBar/top';
				
      ?>

		
		<div class="">
			<h2><?=$text_book_course?></h2>
			
		</div>


<table><tr><th><?=$label_courseID?></th>
<th><?=$label_courseTitle?></th>
<th><?=$label_courseDesc?></th>
<th><?=$label_courseCat?></th>
<th><?=$label_courseType?></th>
<th><?=$label_courseStart?></th>
<th><?=$label_courseEnd?></th>

<th><?=$label_coursePrice?></th></tr>

 
<?php 
 while($row = $rs_result->fetch_assoc()) {


  echo '
  <tr>
  
  <td>#'.$row['course_id'].'</td>
  <td>'.$row['title'].'</td>
  <td>'.$row['description'].'</td>
  <td>'.$row['course_cat'].'</td>
  <td>'.$row['course_type'].'</td>
  <td>'.$row['start_date'].'</td>
  <td>'.$row['end_date'].'</td>
  <td>'.$row['price'].'</td>

  <td><form action="course_register.php" method="post" autocomplete="off">
			<input type="hidden" name="course_id" id="course_id" value="'.$row['course_id'].'" />
   <input type="submit" value="'.$active_course_registerBtn.'" /></form></td>
   </tr>';
    }
  ?>
   </table>
<?php 
$sql = 'SELECT COUNT(course_id) AS total FROM courses where status = "active"';
$result = $con->query($sql);
$row = $result->fetch_assoc();
$total_pages = ceil($row["total"] / $results_per_page); // calculate total pages with results
  
for ($i=1; $i<=$total_pages; $i++) {  // print links for all pages
            echo "<a href='active_courses.php?page=".$i."'";
            if ($i==$page)  echo " class='curPage'";
            echo ">".$i."</a> "; 
}; 
?>
	</body>
</html>
