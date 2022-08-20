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


include '../class/Exam.php';

$exam = new Exam();

$facultyId =  Session::get('id');

if (isset($_GET['delExam'])) {
    $examId = $_GET['delExam'];
    $result = $exam->delExam($examId);
}

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
                    <div class="col-md-9">
                        <h3 class="panel-title">Exam List</h3>
                    </div>
                    <div class="col-md-3 text-end">
                        <a class="btn btn-outline-info" href="add_exam.php" role="button">Add Exam</a>
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
                            $results = $exam->getExamList($facultyId);
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
                                        <td><?php echo $value['total_marks']; ?></td>
                                        <!-- <td><?php //echo $value['total_qsns']; 
                                                    ?></td> -->
                                        <td><?php echo $value['exam_declaration_datetime']; ?></td>
                                        <td>
                                            <?php
                                            $status = $value['exam_status'];

                                            if ($status == 0) {
                                                echo "<span class='text-success'>Enable</span>";
                                            } else {
                                                echo "<span class='text-danger'>Disable</span>";
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <a class="btn btn-outline-danger btn-sm" onclick="return confirm('Are you sure to Delete')" href="?delExam=<?php echo $value['exam_id']; ?>">Delete</a>
                                            <a class="btn btn-outline-info btn-sm" href="update_exam.php?udpateExam=<?php echo $value['exam_id']; ?>">Edit</a>
                                            <a class="btn btn-outline-success btn-sm" href="view_exam.php?viewExam=<?php echo $value['exam_id']; ?>">View</a>
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