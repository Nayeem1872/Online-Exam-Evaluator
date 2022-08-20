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

$question = "0"; 
$std_ans2 = ""; $std_ans3 = "";
$std_ans4 = ""; $std_ans5 = "";
if (isset($_GET['id'])) {
    $examId = $_GET['id'];
    if(isset($_POST['submit'])){
        $std_ans = $_POST['std_ans'];
        if(isset($_POST['std_ans2'])){
            $std_ans2 = $_POST['std_ans2'];
        }
        if(isset($_POST['std_ans3'])){
            $std_ans3 = $_POST['std_ans3'];
        }
        if(isset($_POST['std_ans4'])){
            $std_ans4 = $_POST['std_ans4'];
        }
        if(isset($_POST['std_ans5'])){
            $std_ans5 = $_POST['std_ans5'];
        }
        $student->preSubmitEnrolledExamCheck($studentId,$examId,1,$std_ans,$std_ans2,$std_ans3,$std_ans4,$std_ans5);
        //$student->preSubmitEnrolledExamCheck($studentId,$examId,1,$std_ans2);
        //$student->preSubmitEnrolledExamCheck($studentId,$examId,1,$std_ans3);
        //$student->preSubmitEnrolledExamCheck($studentId,$examId,1,$std_ans4);
        //$student->preSubmitEnrolledExamCheck($studentId,$examId,1,$std_ans5);
    }
     $results  = $student->getExamById($examId);
   $queryCount =   $student->startEnrolledExam($studentId,$examId);
   $preSubmitEnrolledExamCheck =   $student->preSubmitEnrolledExamCheck($studentId,$examId,0,0,0,0,0,0);
 
//    var_dump($preSubmitEnrolledExamCheck);
   foreach($results as $value){
      
       $question = $value['qsn1'];
       $question2 = $value['qsn2'];
       $question3 = $value['qsn3'];
       $question4 = $value['qsn4'];
       $question5 = $value['qsn5'];
   }
     

  $success =  $preSubmitEnrolledExamCheck['success'];
  if($success ==1){
    $got_marks =  $preSubmitEnrolledExamCheck['data']['got_marks'];
    $std_solution =  $preSubmitEnrolledExamCheck['data']['sol1'];
    $std_solution2 =  $preSubmitEnrolledExamCheck['data']['sol2'];
    $std_solution3 =  $preSubmitEnrolledExamCheck['data']['sol3'];
    $std_solution4 =  $preSubmitEnrolledExamCheck['data']['sol4'];
    $std_solution5 =  $preSubmitEnrolledExamCheck['data']['sol5'];
    $std_ans =  $preSubmitEnrolledExamCheck['data']['std_ans'];
    $std_ans2 =  $preSubmitEnrolledExamCheck['data']['std_ans2'];
    $std_ans3 =  $preSubmitEnrolledExamCheck['data']['std_ans3'];
    $std_ans4 =  $preSubmitEnrolledExamCheck['data']['std_ans4'];
    $std_ans5 =  $preSubmitEnrolledExamCheck['data']['std_ans5'];
    $message = "Your marks for this exam is: " .$got_marks;
  }
 
}



 

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Question</title>

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
                        <h3 class="panel-title">View Question</h3>
                    </div>                    
                </div>
            </div>


            <div class="card-body">

            <div class="alert alert-warning" role="alert">
   <p id="display"  style="color:#FF0000; text-align:center;font-size:20px">
   <?php
                        if (isset($message)) {
                            echo $message;
                            unset($message);
                        }
                        ?>

</p></div>

                
                <div class="row">
                    <div class="col-md-10 offset-md-1">

                <?php 
                
                if($success == 1){
?>
    <h2 class="text-center">For Question 1</h2>
    <h4 class="text-center">Your Answer Is : <?php echo  $std_ans; ?></h4>
    <h4 class="text-center mb-5">Correct Answer Is : <?php echo  $std_solution; ?></h4>

    <?php
     if (!$value['qsn2'] == "") {
    ?>
        <h2 class="text-center">For Question 2</h2>
        <h4 class="text-center">Your Answer Is : <?php echo  $std_ans2; ?></h4>
        <h4 class="text-center mb-5">Correct Answer Is : <?php echo  $std_solution2; ?></h4>
    <?php } ?>

    <?php
     if (!$value['qsn3'] == "") {
    ?>
        <h2 class="text-center">For Question 3</h2>
        <h4 class="text-center">Your Answer Is : <?php echo  $std_ans3; ?></h4>
        <h4 class="text-center mb-5">Correct Answer Is : <?php echo  $std_solution3; ?></h4>
    <?php } ?>

    <?php
     if (!$value['qsn4'] == "") {
    ?>
        <h2 class="text-center">For Question 4</h2>
        <h4 class="text-center">Your Answer Is : <?php echo  $std_ans4; ?></h4>
        <h4 class="text-center mb-5">Correct Answer Is : <?php echo  $std_solution4; ?></h4>
    <?php } ?>

    <?php
     if (!$value['qsn5'] == "") {
    ?>
        <h2 class="text-center">For Question 5</h2>
        <h4 class="text-center">Your Answer Is : <?php echo  $std_ans5; ?></h4>
        <h4 class="text-center">Correct Answer Is : <?php echo  $std_solution5; ?></h4>
    <?php } ?>
<?php 
                }else{
                ?>
                        <form class="row g-3 form-group" action="" method="POST" enctype="multipart/form-data">
                        <?php
                            if (!$value['qsn1'] == "") {
                            ?>
                           <div class="col-12">
                           <h3 class="text-center"><?php echo  $question; ?></h3>
                                <label for="sol1" class="form-label">Solution</label>
                                <textarea name="std_ans" id="" cols="30" rows="2" class="form-control" id="std_ans"></textarea>
                            </div>
                            <?php } ?>

                            <?php
                            if (!$value['qsn2'] == "") {
                            ?>
                           <div class="col-12">
                           <h3 class="text-center"><?php echo  $question2; ?></h3>
                                <label for="sol2" class="form-label">Solution</label>
                                <textarea name="std_ans2" id="" cols="30" rows="2" class="form-control" id="std_ans2"></textarea>
                            </div>
                            <?php } ?>

                            <?php
                            if (!$value['qsn3'] == "") {
                            ?>
                           <div class="col-12">
                           <h3 class="text-center"><?php echo  $question3; ?></h3>
                                <label for="sol3" class="form-label">Solution</label>
                                <textarea name="std_ans3" id="" cols="30" rows="2" class="form-control" id="std_ans3"></textarea>
                            </div>
                            <?php } ?>

                            <?php
                            if (!$value['qsn4'] == "") {
                            ?>
                           <div class="col-12">
                           <h3 class="text-center"><?php echo  $question4; ?></h3>
                                <label for="sol4" class="form-label">Solution</label>
                                <textarea name="std_ans4" id="" cols="30" rows="2" class="form-control" id="std_ans4"></textarea>
                            </div>
                            <?php } ?>

                            <?php
                            if (!$value['qsn5'] == "") {
                            ?>
                           <div class="col-12">
                           <h3 class="text-center"><?php echo  $question5; ?></h3>
                                <label for="sol5" class="form-label">Solution</label>
                                <textarea name="std_ans5" id="" cols="30" rows="2" class="form-control" id="std_ans5"></textarea>
                            </div>
                            <?php } ?>
                            <div class="col-12">
                                <button type="submit" id="button" name="submit" class="btn btn-primary">Submit</button>
                            </div>
                            
                        </form>

                        <?php 
}

?>
                    </div>
                </div>
                
    </div>


        </div>
    </div>

    <!-- Exam list part Ends -->


    <script>
 
             var div = document.getElementById('display');
              var check =   document.getElementById('test');
             var submitted = document.getElementById('submitted');
 
               function CountDown(duration, display,check) {
 
                         var timer = duration, minutes, seconds;
 
                       var interVal=  setInterval(function () {
                             minutes = parseInt(timer / 60, 10);
                             seconds = parseInt(timer % 60, 10);
//  Exucution  code 
                              minutes = minutes < 10 ? "0" + minutes : minutes;
                             seconds = seconds < 10 ? "0" + seconds : seconds;
                     display.innerHTML ="<b>" + minutes + "m : " + seconds + "s" + "</b>";
                     document.title = minutes + ":" + seconds;
                             if (timer > 0) {
                                --timer;
                             }else{
                        clearInterval(interVal)
                                 SubmitFunction();
                              }
 
                        },1000);
 
                 }
 
               function SubmitFunction(){
    
      document.getElementById("button").click();
 }
 

 var success = '<?php echo $preSubmitEnrolledExamCheck['success']; ?>';
 console.log(success);
 if(success == 0){
    CountDown( '<?php echo $preSubmitEnrolledExamCheck['lefttime']; ?>',div,check); 
 }else{
 
 }

 
 
  
             </script>
</body>

</html>