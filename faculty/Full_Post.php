<?php

include '../lib/Session.php';

 include 'session.php'; 



include '../lib/Database.php';
include '../class/Format.php';
if (isset($_GET['action']) && isset($_GET['action']) == 'logout') {
    Session::destroy();
    header("Location:index.php");
    exit();
}


Session::checkSession();

error_reporting(0);
$success= false;
if(isset($_POST["submit"]))
{
    $Name=$_POST["CommenterName"];
    $Email=$_POST["CommenterEmail"];
    $Comment=$_POST["CommenterThoughts"];
    $post_id=$_POST["post_id"];

    // $Admin="Nayeem";
    
   

   
    
       
        $sql="INSERT INTO comments ( post_id, name, email, comment) VALUES ( '$post_id', '$Name', '$Email', '$Comment')";
        
        $Execute = mysqli_query($connectDB, $sql);

        if($Execute){
            //  $_SESSION["SuccesssMessage"]="Category Added ";
            // echo 'added';
            $success= true;

            // -- Redirect_to("categories.php");
        }
        else
        {
            // $_SESSION["ErrorMessage"]="Something is wrong";
            // Redirect_to("categories.php");
            echo 'fail';
        }


    
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Other Post</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="css/style2.css" />
        <!-- Css for reaction system -->
        <link rel="stylesheet" type="text/css" href="css/reaction.css" />

       

</head>
<body>
      <!--Navigation part starts-->
<?php include 'navbar.php'; ?>
    <!--Navigation part ends-->

    <div style="height:10px; background:#27aae1;"></div>
    <?php
    if($success)
    {
       
       ?>
       <div class="alert alert-success" role="alert">
     Comment successfully added!
    </div>
       <?php
       
        
    }
    else{
        echo '';
    }
?>
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
        $i=$_GET["id"];
        $sql = "SELECT * FROM post WHERE id=$i";
        $result = mysqli_query($connectDB, $sql);
        while($DataRows = mysqli_fetch_assoc ($result )){
            // $PostId=
            // $DateTime=
            // $Post
            $array[]=$DataRows;

        }
        
        
        foreach($array as $i){
        
        
        
        ?>
        <div class="card">
            
            <div class="card-body">
                <h4 class="card-title"><?php echo $i["topic"]; ?></h4>
                <small class="text-muted ">Written by Faculty ID:<?php echo $i["faculty_id"]; ?> On <?php echo $i["datetime"]; ?></small>
                <!-- <span style="float:right;" class="badge badge-light text-dark">Comments 20</span> -->
                <hr>
                <p class="card-text ">
                    <?php  echo $i["post"]; ?> </p>
                    
            </a>
                
            

            </div>
        </div>
       
              
                <!-- Reaction system end -->
           




             



        <?php } ?>
        <div class="">
            <form class="" action="" method="POST">
            <div class="card py-0">
                <div class="card-header">
                    <h5 class="FieldInfo">Share Your Thoughts About this Post:</h5>
                </div>
                <div class="card-body ">
                    <div class="form-group">
                        <div class="input-group">
                            <!-- <div class="input-group-prepend">
                                <span class="input-group-text"></span>
                            </div> -->

                        <input type="text" class="form-control" name="CommenterName" placeholder="Name" value="<?php echo $Name; ?>" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <!-- <div class="input-group-prepend">
                                <span class="input-group-text"></span>
                            </div> -->

                        <input type="email" class="form-control" name="CommenterEmail" placeholder="Email" value="<?php echo $Email; ?>" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <textarea name="CommenterThoughts" class="form-control" id="" cols="40" rows="6" required><?php echo $Comment; ?></textarea>
                    </div>
                    <input type="hidden" id="" name="post_id" value="<?php echo $_GET['id']?>">
                    <div class="">
                        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                    </div>


                    
                </div>
            </div>
            </form>
            <b>Comments:</b>
            <div class="jumbotron">
            <?php
                $post_id=$_GET["id"];
                $sql = "SELECT * FROM comments WHERE post_id=$post_id";
                $Execute = mysqli_query($connectDB, $sql); 
              
                    while($row = mysqli_fetch_assoc($Execute)){
                        $array[]=$row;
                    }
                 
                    foreach($array as $i){
                ?>
               
                <h4><?php echo $i['name']; ?></h4>
                <a href="" class=""><?php echo $i['email']; ?></a>
                 
                <p><?php echo $i['comment']; ?></p>
                <hr class="my-4">
                <?php
                  }
                

               
               ?>
               
            </div>
        </div>
        
    </div>   




</div>




    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	<!-- <script>
        (function()){
            var v= document.createElement("script");v.
        }

    </script> -->
    <script type="text/javascript" src="js/jquery.min.js"></script>
        <!-- jQuery for Reaction system -->
        <script type="text/javascript" src="js/reaction.js"></script>


</body>
</html>