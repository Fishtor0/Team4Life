<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();

// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: ../index.html');
	exit;
}

//set up connection
include '../db/_con.php';

include '../helpers/_engine.php';

// Get email from accounts
$sql = 'SELECT uc.payed_ammount, uc.paymentStatus, c.status, c.start_date, c.end_date, c.title, c.course_type, c.course_cat
FROM userCourses as uc
JOIN courses as c
ON uc.course_id = c.course_id
WHERE uc.user_id ='.$_SESSION['id'].'';

$rs_result = $con->query($sql);
?>


<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title><?=$my_courses?></title>
		<link href="../style.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	</head>
	<body class="loggedin">
		<?php
                include '../navBar/top';
                ?>
		<div class="content">
			<h2><?=$my_courses?></h2>
			<div>
				<table>
				<tr>
                <th><?=$label_courseTitle?></th>
                <th><?=$label_courseStatus?></th>
                <th><?=$label_courseCat?></th>
                <th><?=$label_courseType?></th>
                <th><?=$label_courseStart?></th>
                <th><?=$label_courseEnd?></th>
                <th><?=$label_paymentStatus?></th>
                <th><?=$label_payed_ammount?></th>
                </tr>

                <?php 
                while($row = $rs_result->fetch_assoc()) {


                    echo '
                    <tr>
                    
                    <td>'.$row['title'].'</td>
                    <td>'.$row['status'].'</td>
                    <td>'.$row['course_cat'].'</td>
                    <td>'.$row['course_type'].'</td>
                    <td>'.$row['start_date'].'</td>
                    <td>'.$row['end_date'].'</td>
                    <td>'.$row['paymentStatus'].'</td>
                    <td>'.$row['payed_ammount'].'</td>
                    </td>
                     </tr>';
                      }
                    ?>
                     </table>
                
	</body>
</html>
