<?php
//start session
session_start();

// load helpers
include '../helpers/_engine.php';

if ($_SESSION['admin'] == 'user') {
	header('Location: ../common/home.php');
	exit;
}
//set up connection
include '../db/_con.php';


$stmt = $con->prepare('SELECT course_id, title, description, course_cat, course_type, start_date, end_date, spaces, price, deposit, status 
FROM courses where course_id = ?');
$stmt->bind_param('i', $_GET['course_id']);
$stmt->execute();
$stmt->bind_result(
    $course_id,
    $c_title,
	$description,
	$course_cat,
	$course_type, 
	$start_date, 
	$end_date,
	$spaces,
	$price,
	$deposit,
	$status
 );
$stmt->fetch();
$stmt->close(); 
?>


<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title><?=$view_course_title?></title>
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
        <link href="../style.css" rel="stylesheet" type="text/css">
	</head>
	<body>
        <?php	
			include '../navBar/top';		
      	?>
		<div class="admin">
			<h1><?=$view_course_title?></h1>
            <form action="../db/admin_update_course_engine.php" method="post" autocomplete="off">
			<input type="hidden" name="course_id" value="<?=$_POST['course_id']?>" id="course_id">
			<label for="status">
					<?=$upd_course_label_type?>
				</label>
				<input list="status_list" type="text" value="<?=$status?>" name="status" id="status" required>
				<datalist id="status_list">
					<option value="active">
					<option value="full">
					<option value="cancelled">
					<option value="finished">
				</datalist>
				
				<label for="c_title">
					<?=$upd_course_label_title?>
				</label>
				<input type="text" name="c_title" value="<?=$c_title?>" placeholder="Title" id="c_title" required>
				

				<label for="course_cat">
					<?=$upd_course_label_cat?>
				</label>

					<input type="radio" id="kpp" name="course_cat" value="kpp" <?php if ($course_cat == "kpp"){echo checked;} ?> required>
					<label for="kpp">KPP</label>
					<input type="radio" id="pp" name="course_cat" value="pp" <?php if ($course_cat == "pp"){echo checked;} ?>>
					<label for="pp">PP</label><br>

				
				<label for="course_type">
					<?=$upd_course_label_type?>
				</label>
				<input list="list2" type="text" value="<?=$course_type?>" name="course_type" id="course_type" required>
				<datalist id="list2">
					<option value="normal">
					<option value="refresher">
				</datalist>

				<label for="start_date">
					<?=$upd_course_label_start?>
				</label>
				<input type="text" name="start_date" value="<?=$start_date?>" placeholder="dd/mm/yyyy" id="start_date" required>

				<label for="end_date">
					<?=$upd_course_label_end?>
				</label>
				<input type="text" name="end_date" value="<?=$end_date?>" placeholder="dd/mm/yyyy" id="end_date" required >

				<label for="description">
					<?=$upd_course_label_desc?>
				</label>
				<textarea name="description" rows="10" col="30" id="description" required><?=$description?></textarea>

				<label for="spaces">
					<?=$upd_course_label_spaces?>
				</label><br>
				<input type="number" name="spaces" value="<?=$spaces?>" placeholder="0" id="spaces" required>

				<label for="price">
					<?=$upd_course_label_price?>
				</label><br>
				<input type="number" name="price" value="<?=$price?>" placeholder="0" id="price" required>

				<label for="deposit">
					<?=$upd_course_label_deposit?>
				</label><br>
				<input type="number" name="deposit" value="<?=$deposit?>" placeholder="0" id="deposit" required>


				<input type="submit" value="<?=$upd_course_label_submitBtn?>">
			</form>
			
		</div>
	</body>
</html>