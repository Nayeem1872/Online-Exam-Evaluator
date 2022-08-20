<?php

include 'lib/Session.php';

 include 'session.php'; 



include 'lib/Database.php';
include 'class/Format.php';
if (isset($_GET['action']) && isset($_GET['action']) == 'logout') {
    Session::destroy();
    header("Location:index.php");
    exit();
}


Session::checkSession();
// if(isset($_POST["submit"]))
//     {
//         $facultyId = $_POST["id"];
//         $topic  = $_POST["topic"];
//         $section = $_POST["section"];
//         $post = $_POST["postdescription"];
//         sql="INSERT INTO post ( faculty_id, topic, section, post) VALUES ('$facultyId', '$topic', '$section', '$post' )";
//         $Execute = mysqli_query($connectDB, $sql);

//     }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Other Post</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>
<body>
      <!--Navigation part starts-->
<?php include 'navbarstudent.php'; ?>
    <!--Navigation part ends-->

    <div style="height:10px; background:#27aae1;"></div>
<!-- header -->
<div class="container">
    <div class="row mt-4">


        <div class="col-sm-8">
            <h1>Blog Posts </h1>
            <h1 class="lead">using PHP </h1>
        </div>
        <div class="col-sm-4" style="min-height:40px;" background=green></div>

        <?php 
        global $connectDB;
        $sql = "SELECT * FROM post";
        $result = mysqli_query($connectDB, $sql);
        while($DataRows = mysqli_fetch_assoc ($result )){
            // $PostId=
            // $DateTime=
            // $Post
            $array[]=$DataRows;

        }
        if(!empty($array)){
        
        foreach($array as $i){
        
        
        
        ?>
        <div class="card">
            
            <div class="card-body">
                <h4 class="card-title"><?php echo $i["topic"]; ?></h4>
                <small class="text-muted ">Written by:<?php
                $stdId =  Session::get('name');
                
                echo $stdId;

            ?>   On <?php echo $i["datetime"]; ?></small>
                <!-- <span style="float:right;" class="badge badge-light text-dark">Comments 20</span> -->
                <hr>
                <p class="card-text text-truncate">
                    <?php  echo $i["post"]; ?> </p>
                    <a href="Full_Post.php?id=<?php echo $i["id"] ?>"style="float:right;">
                    <span class="btn btn-info">Read More >> </span>
            </a>
                
            

            </div>
        </div>
        
        




             



        <?php } } ?>
        
    </div>   




</div>




    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	<script>
        (function()){
            var v= document.createElement("script");v.
        }

    </script>


</body>
</html>