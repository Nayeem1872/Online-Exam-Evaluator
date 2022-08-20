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

include '../class/Faculty.php';
$exam = new Exam();

$faculty = new Faculty();

$facultyId =  Session::get('id');
if(isset($_GET['allowExam'])){
    $examId=   $_GET['allowExam'];
    $result = $faculty->examEnrollRequestAccept($examId);
}else if(isset($_GET['reject'])){
    $id = $_GET['reject'];
    $exam->rejectedFromEnrollExam($id);
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
                    <div class="col-md-12">
                        <h3 class="panel-title">Enrolled Exam List</h3>
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
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $results = $exam->getEnrollExamList($facultyId);
                            $i = 0;
                            if ($results) {
                                foreach ($results as $value) {
                                    $i++;
                            ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $value['exam_title']; ?></td>
                                        <td>
                                            <a class="text-success" style="text-decoration: none;" href="student_profile.php?studentId=<?php echo $value['student_id']; ?>">
                                                <?php echo $value['student_name']; ?> (Details)
                                            </a>
                                        </td>
                                        <td>
                                        <?php if($value['enrolled_status']==0){
?>
<a class="btn btn-success btn-sm" href="?allowExam=<?php echo $value['id']; ?>">Approve</a>
<a class="btn btn-danger btn-sm" href="?reject=<?php echo $value['id']; ?>">Decline</a>
<?php  }else if($value['enrolled_status']==1){

echo '<button class="btn btn-success btn-sm"  disabled>Approved</button>';    
}else{
    echo '<button class="btn btn-danger btn-sm"  disabled>Declined</button>';
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