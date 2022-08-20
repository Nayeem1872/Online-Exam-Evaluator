<?php
include 'lib/Session.php';
include 'studentsession.php';

include 'lib/Database.php';
include 'class/Format.php';

Session::stdCheckSession();

if (isset($_GET['action']) && isset($_GET['action']) == 'logout') {
    Session::destroy();
    header("Location:index.php");
    exit();
}



include 'class/Student.php';

$student = new Student();
$studentId = $_GET['studentId'];

if (isset($_GET['studentId'])) {
    $result = $student->getStudentById($studentId);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$name = $_POST['name'];
	$uni_name = $_POST['uni_name'];
	$uni_roll_no = $_POST['uni_roll_no'];
	$password = md5($_POST['password']);
	$email = $_POST['email'];


	$message = $student->udpateStudentProfile($studentId,$name, $uni_name, $uni_roll_no, $password, $email);
    Session::set('name', $name);

}

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Exam</title>

    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <!--Navigation part starts-->
    <?php include 'navbarstudent.php' ; ?>
    <!--Navigation part ends-->

    <div class="container">
        <div class="card">

            <div class="card-header">
                <div class="row">
                    <div class="col-md-10 offset-md-1">
                        <h3 class="panel-title">Student Profile Info.</h3>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-md-10 offset-md-1">


                        <?php
                        if (isset($message)) {
                            echo $message;
                            unset($message);
                        }
                        ?>

                        <form class="row g-3 form-group" action="" method="POST" enctype="multipart/form-data">
                            <?php
                            if ($result) {
                                foreach ($result as $value) {
                            ?>

                                    <div class="col-md-12">
                                        <label for="name" class="form-label">Name</label>
                                        <input type="text" name="name" value="<?php echo $value['name']; ?>" class="form-control" id="name">
                                    </div>
                                    <div class="col-md-12">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="text" name="email" value="<?php echo $value['email']; ?>" class="form-control" id="email">
                                    </div>
                                    <div class="col-md-12">
                                        <label for="uni_name" class="form-label">Institute Name</label>
                                        <input type="text" name="uni_name" value="<?php echo $value['uni_name']; ?>" class="form-control" id="uni_name">
                                    </div>  

                                    <div class="col-md-12">
                                        <label for="uni_name" class="form-label">University ID</label>
                                        <input type="text" name="uni_roll_no" value="<?php echo $value['uni_roll_no']; ?>" class="form-control" id="uni_name">
                                    </div>  
                                    <div class="col-md-12">
                                        <label for="password" class="form-label">Password</label>
                                        <input type="text" name="password"  class="form-control" id="password">
                                    </div> 
                            <div class="col-md-12">
                    <input class="btn btn-danger col-2" type="submit" value="Update">
                   
                    </div>
                            <?php
                                }
                            }
                            ?>
                        </form>
                    </div>
                </div>
            </div>


        </div>
    </div>

</body>

</html>