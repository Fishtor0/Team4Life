<?php

session_start();

// load helpers
include '../helpers/_engine.php';

if ($_SESSION['admin'] == 'user') {
	header('Location: ../common/home.php');
	exit;
}


//set up connection
include '../db/_con.php';



$sql = 'SELECT course_id, title, description, course_cat, course_type, start_date, end_date, spaces, price, deposit 
FROM  courses where course_id = '.$_GET['course_id'].'';
$rs_result = $con->query($sql);
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title><?=$view_course_title?></title>
		<link href="../style.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	</head>
	<body class="loggedin">
			<?php
				
				include '../navBar/top';
				
      ?>

		
		<div class="">
			<h2><?=$view_course_title?></h2>
			
		</div>


<table><tr><th>ID</th><th>Title</th><th>Description</th><th>Category</th><th>Type</th><th>Start</th><th>End</th><th>Spaces</th><th>Price</th><th>Deposit</th></tr>
 
<?php 
 while($row = $rs_result->fetch_assoc()) {


  echo '
  <tr>
  
  <td>'.$row['course_id'].'</td>
  <td>'.$row['title'].'</td>
  <td>'.$row['description'].'</td>
  <td>'.$row['course_cat'].'</td>
  <td>'.$row['course_type'].'</td>
  <td>'.$row['start_date'].'</td>
  <td>'.$row['end_date'].'</td>
  <td>'.$row['spaces'].'</td>
  <td>'.$row['price'].'</td>
  <td>'.$row['deposit'].'</td>
 
  <td><form action="update_course.php" method="post" autocomplete="off">
			<input type="hidden" name="course_id" id="course_id" value="'.$row['course_id'].'" />
   <input type="submit" value="'.$mng_course_label_submitBtn.'" /></form></td>
   </tr>';
    }
  ?>
   </table>
<?php 
$sql = 'SELECT ud.given_name, ud.surname , uc.paymentStatus, uc.payed_ammount
FROM userdetails as ud 
JOIN userCourses as uc
on ud.user_id = uc.user_id
where uc.course_id ='.$_GET['course_id'].'';
$result = $con->query($sql);

?>

<div>
<h2><?=$view_course_userList?></h2>
</div>
<table><tr><th><?=$label_surname?></th><th><?=$label_name?></th><th><?=$label_paymentStatus?></th><th><?=$label_payed_ammount?></th></tr>
 <?php
while($row = $result->fetch_assoc()){

    echo'
    <tr>
        <td>'.$row['surname'].'</td>
        <td>'.$row['given_name'].'</td>
        <td>'.$row['paymentStatus'].'</td>
        <td>'.$row['payed_ammount'].'</td>
       
    </tr>';
}

?>
	</body>
</html>
