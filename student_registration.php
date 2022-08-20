<?php

include 'lib/Database.php';
include 'class/Format.php';


include 'class/Student.php';

$student = new Student();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$name = $_POST['name'];
	$uni_name = $_POST['uni_name'];
	$uni_roll_no = $_POST['uni_roll_no'];
	$password = md5($_POST['password']);
	$email = $_POST['email'];

	$message = $student->studentRegistration($name, $uni_name, $uni_roll_no, $password, $email);
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Student Registration</title>

	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
	<div class="containter ">
		<div class="row mt-5 ">
			<div class="card col-5 offset-lg-4 hero-card">
				<h2 class="text-dark display-4 d-flex justify-content-center">Student Reg:</h2>
				<hr>

				<?php
				if (isset($message)) {
					echo $message;
					unset($message);
				}
				?>

				<form action="" method="POST" enctype="multipart/form-data" class="form-group">
					<label for="name">Your Name</label>:
					<input class="form-control" type="text" id="name" name="name" placeholder="Your Name">
					<br>
					<label for="uni_name">Institute Name</label>:
					<input class="form-control" type="text" id="uni_name" name="uni_name" placeholder="Institute Name">
					<br>
					<label for="uni_roll_no">Institute Roll No.</label>:
					<input class="form-control" type="text" id="uni_roll_no" name="uni_roll_no" placeholder="Institute Roll No.">
					<br>
					<label for="email">Email</label>:
					<input class="form-control" type="Email" id="email" name="email" placeholder="Email">
					<br>
					<label for="password">Password</label>:
					<input class="form-control" type="Password" id="password" name="password" placeholder="Password">
					<br>
					<input class="btn btn-danger col-2" type="submit" value="Submit">
					<br><br>
					<p><a href="student_login.php" class="btn-outline-danger">Want to go back login page?</a></p>
				</form>

			</div>
		</div>
	</div>

</body>

</html>