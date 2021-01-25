<?php
session_start();

// load helpers
include '../helpers/_engine.php';

if ($_SESSION['admin'] == 'user') {
	header('Location: ../common/home.php');
	exit;
}
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title><?=$add_course_title?></title>
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
        <link href="../style.css" rel="stylesheet" type="text/css">
	</head>
	<body>
		<div class="admin">
			<h1><?=$add_course_title?></h1>
            <form action="../db/admin_add_course_engine.php" method="post" autocomplete="off">

				<label for="c_title">
					<?=$upd_course_label_title?>
				</label>
				<input type="text" name="c_title" value="" placeholder="Title" id="c_title" required>
				

				<label for="course_cat">
					<?=$upd_course_label_cat?>
				</label>

					<input type="radio" id="kpp" name="course_cat" value="kpp"  required>
					<label for="kpp">KPP</label>
					<input type="radio" id="pp" name="course_cat" value="pp" >
					<label for="pp">PP</label><br>

				
				<label for="course_type">
					<?=$upd_course_label_type?>
				</label>
				<input list="list2" type="text" value="" name="course_type" id="course_type" required>
				<datalist id="list2">
					<option value="normal">
					<option value="refresher">
				</datalist>

				<label for="start_date">
					<?=$upd_course_label_start?>
				</label>
				<input type="text" name="start_date" value="" placeholder="dd/mm/yyyy" id="start_date" required>

				<label for="end_date">
					<?=$upd_course_label_end?>
				</label>
				<input type="text" name="end_date" value="" placeholder="dd/mm/yyyy" id="end_date" required >

				<label for="description">
					<?=$upd_course_label_desc?>
				</label>
				<textarea name="description" rows="10" col="30" id="description" required></textarea>

				<label for="spaces">
					<?=$upd_course_label_spaces?>
				</label><br>
				<input type="number" name="spaces" value="" placeholder="0" id="spaces" required>

				<label for="price">
					<?=$upd_course_label_price?>
				</label><br>
				<input type="number" name="price" value="" placeholder="0" id="price" required>

				<label for="deposit">
					<?=$upd_course_label_deposit?>
				</label><br>
				<input type="number" name="deposit" value="" placeholder="0" id="deposit" required>


				<input type="submit" value="<?=$add_course_label_submitBtn?>">
			</form>
			
		</div>
	</body>
</html>