<?php

include '../lib/Session.php';
include 'session.php'; 

include '../lib/Database.php';
include '../class/Format.php';

Session::checkSession();

if (isset($_GET['action']) && isset($_GET['action']) == 'logout') {
    Session::destroy();
    header("Location:index.php");
    exit();
}


include '../class/Faculty.php';

$faculty = new Faculty();

$facultyId = $_GET['facultyId'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $uni_name = $_POST['uni_name'];
    $password = $_POST['password'];
    $image=$_FILES['fimage'];
        $image_name=$image['name'];
        $image_temp_path=$image['tmp_name'];
        if ($image_name!=NULL) {
            $to="faculty_image/$image_name";
            
        }else{
            $to=NULL;

        }
        move_uploaded_file($image_temp_path,$to);

    $message = $faculty->udpateFacultyProfile($facultyId, $name, $email, $uni_name,$to,$password);
}

if (isset($_GET['facultyId'])) {
    $result = $faculty->getFacultyById($facultyId);
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Exam</title>

    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>
    <!--Navigation part starts-->
    <?php include 'navbar.php'; ?>
    <!--Navigation part ends-->

    <div class="container">
        <div class="card">

            <div class="card-header">
                <div class="row">
                    <div class="col-md-10 offset-md-1">
                        <h3 class="panel-title">Faculty Profile Info.</h3>
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
                                        <label for="password" class="form-label">Update Password</label>
                                        <input type="password" name="password" value="nochangepassword" class="form-control" id="email">
                                    </div>
                                    <div class="col-md-12">
                                        <label for="uni_name" class="form-label">Institute Name</label>
                                        <input type="text" name="uni_name" value="<?php echo $value['uni_name']; ?>" class="form-control" id="uni_name">
                                    </div>  
                            <div class="col-md-12">
                        <label for="fimage">Image</label>:
                    <input class="form-control" type="file" id="fimage" name="fimage">
                    <br>
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