<?php
include '../lib/Session.php';
include '../lib/Database.php';
include '../class/Format.php';

Session::checkLogin();

include '../class/Faculty.php';

$faculty = new Faculty();


if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$email = $_POST['email'];
	$password = md5($_POST['password']);
 
	  $message = $faculty->facultyLogin($email, $password);

// echo "HELLO";
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Faculty Login</title>

	<link rel="stylesheet" href="../assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>
	<div class="containter ">
		<div class="row mt-5 ">
			<div class="card col-5 offset-lg-4 hero-card">
				<h2 class="text-dark display-4 d-flex justify-content-center">Faculty Login</h2>
				<hr>

				<?php
				if (isset($message)) {
					echo $message;
					unset($message);
				}
				?>
				<form action="" method="POST" class="form-group">
					<label for="email">Email</label>:
					<input class="form-control" type="Email" id="email" name="email" placeholder="Email" required><br>
					<label for="password">Password</label>:
					<input class="form-control" type="Password" id="password" name="password" placeholder="Password" required><br>
					<input class="btn btn-success col-2 " type="submit" value="Login"><br><br>
					<p><a href="faculty_registration.php" class="btn-outline-secondary">Haven't registered yet? Click here to proceed.  </a></p>

				</form>

			</div>
		</div>
	</div>

</body>

</html>