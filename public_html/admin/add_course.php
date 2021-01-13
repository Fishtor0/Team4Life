<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: ../index.html');
	exit;
}
?>


<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Add Course</title>
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
        <link href="../style.css" rel="stylesheet" type="text/css">
	</head>
	<body>
		<div class="register">
			<h1>Add course</h1>
			<form action="../admin/add_course_engine.php" method="post" autocomplete="off">
				<label for="c_title">
					<i class="fas"></i>
				</label>
				<input type="text" name="c_title" placeholder="Title" id="c_title" required>
				
				<label for="course_cat">
					<i class="fas"></i>
				</label>
				<input type="text" name="course_cat" placeholder="Category" id="course_cat" required>
				
				<label for="course_type">
					<i class="fas"></i>
				</label>
				<input type="text" name="course_type" placeholder="Type" id="course_type" required>
				
				<label for="start_date">
					<i class="fas"></i>
				</label>
				<input type="text" name="start_date" placeholder="dd/mm/yyyy" id="start_date" required>

				<label for="end_date">
					<i class="fas"></i>
				</label>
				<input type="text" name="end_date" placeholder="dd/mm/yyyy" id="end_date" required >

				<label for="description">
					<i class="fas"></i>
				</label>
				<textarea name="description" rows="10" col="30" id="description" required>Description text here</textarea>

				<label for="spaces">
					<i class="fas"></i>
				</label><br>
				<input type="number" name="spaces" placeholder="0" id="spaces" required>

				<label for="price">
					<i class="fas"></i>
				</label><br>
				<input type="number" name="prices" placeholder="0" id="price" required>

				<label for="deposit">
					<i class="fas"></i>
				</label><br>
				<input type="number" name="deposit" placeholder="0" id="deposit" required>


				<input type="submit" value="Add Course">
			</form>
			
		</div>
	</body>
</html>