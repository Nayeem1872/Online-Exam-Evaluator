<?php

include '../lib/Session.php';

if (!isset($_SESSION)) {
    Session::init();
} else {
   // Session::destroy();
    Session::init();
}


include '../lib/Database.php';
include '../class/Format.php';

Session::checkSession();

if (isset($_GET['action']) && isset($_GET['action']) == 'logout') {
    Session::destroy();
    header("Location:index.php");
    exit();
}


include '../class/Exam.php';

$exam = new Exam();

$facultyId =  Session::get('id');

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>

    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>
    <!--Navigation part starts-->
 
  <?php include 'navbar.php'; ?>

    <!--Navigation part ends-->


    <!-- Exam list part Starts -->


    <div class="container">
        <div class="card">

            <div class="card-header">
                <div class="row">
                    <div class="col-md-12">
                        <h3 class="panel-title">Enrolled Student Results</h3>
                    </div>
                </div>
            </div>


            <div class="card-body">

                <?php
                if (isset($result)) {
                    echo $result;
                    unset($result);
                }
                ?>

                <div class="table-responsive">
                    <table id="exam_data_table" class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>Exam Title</th>
                                <th>Student Name</th>
                                <th>Student Roll</th>
                                <th>Institute Name</th>
                                <th>Marks</th>
                            </tr> 
                        </thead>
                        <tbody>
                            <?php
                            $results_max = $exam->getEnrolledStudentsResult_max($facultyId);
                            $i = 0;
                            if ($results_max) {
                                foreach ($results_max as $value_max) {
                                    $i++;
                            ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $value_max['exam_title']; ?></td>
                                        <td>
                                            <a class="text-success" style="text-decoration: none;" href="student_profile.php?studentId=<?php echo $value_max['id']; ?>">
                                                <?php echo $value_max['name']; ?> (Details)
                                            </a>
                                        </td>
                                        <td><?php echo $value_max['uni_roll_no']; ?></td>
                                        <td><?php echo $value_max['uni_name']; ?></td>
                                        <td><?php echo $value_max['got_marks']; ?></td>
                                    </tr>
                            <?php
                                }
                            }
                            ?>
                        <tbody>
                            <?php
                            $results = $exam->getEnrolledStudentsResult($facultyId);
                            //$i = 0;
                            if ($results) {
                                foreach ($results as $value) {
                                    $i++;
                            ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $value['exam_title']; ?></td>
                                        <td>
                                            <a class="text-success" style="text-decoration: none;" href="student_profile.php?studentId=<?php echo $value['id']; ?>">
                                                <?php echo $value['name']; ?> (Details)
                                            </a>
                                        </td>
                                        <td><?php echo $value['uni_roll_no']; ?></td>
                                        <td><?php echo $value['uni_name']; ?></td>
                                        <td><?php echo $value['got_marks']; ?></td>
                                    </tr>
                            <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>


        </div>
    </div>

    <!-- Exam list part Ends -->


</body>

</html>