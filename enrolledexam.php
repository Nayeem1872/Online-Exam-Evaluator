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

$studentId =  Session::get('id');

if (isset($_GET['examEnrollReq'])) {
    $examId = $_GET['examEnrollReq'];
    $result = $student->examEnrollRequest($examId,$studentId);
}


// include 'class/Student.php';
// $student = new Student();

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>

    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <!--Navigation part starts-->
    <?php include 'navbarstudent.php' ; ?>
    <!--Navigation part ends-->


    <!-- Exam list part Starts -->


    <div class="container">
        <div class="card">

            <div class="card-header">
                <div class="row">
                    <div class="col-md-12">
                        <h3 class="panel-title">All Exam List</h3>
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
                                <!-- <th>Question</th> -->
                                <th>Create Date</th>
                                <th>Duration(Min)</th>
                                <th>Marks</th>
                                <th>Submission Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $results = $student->getAllEnrolledExamList($studentId);
                           
                            $i = 0;
                            if ($results) {
                                foreach ($results as $value) {
                                    $i++;  
                            ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $value['exam_title']; ?></td>
                                        <td><?php echo $value['exam_datetime']; ?></td>
                                        <td><?php echo $value['exam_duration']; ?></td>
                                        <td><?php echo $value['got_marks']; ?></td>
                                        <td><?php echo $value['exam_declaration_datetime']; ?></td>
                                        <td>
                                            <?php
                                            $status = $value['exam_status'];

                                            if ($status == 0) {
                                                echo "<span class='text-success'>Enable</span>";
                                            } else {
                                                echo "<span class='text-warning'>Disable</span>";
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            $checkstatus = $value['enrolled_exam_status'];
                                           
                                                if ($checkstatus==1) {
                                                    ?>
                                                     <a class="btn btn-outline-success btn-sm disable" href="viewexam.php?id=<?php echo $value['exam_id']; ?>">View</a>
                                                      
                                                <?php 
                                                } else {
                                                    ?>
                                                    <button class="btn btn-danger btn-sm " disabled>Declined</button> 
                                                  <?php
                                                }
                                            
                                            
                                            ?>
                                          
                                        
                                        </td>
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