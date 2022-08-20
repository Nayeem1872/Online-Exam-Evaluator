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
    $success= false;
// Session::checkSession();
if(isset($_POST["submitbt"]))
    {
        $facultyId =  Session::get('id');
        $topic  =   $_POST["topic"];
        $section =  $_POST["section"];
        $post =  $_POST["postdescription"];
        // $sql= SELECT * FROM faculty_tbl;
        
        $sql_Post_In= "INSERT INTO post ( faculty_id, topic, section, post) VALUES ('$facultyId', '$topic', '$section', '$post' )";
        $Execute = mysqli_query($connectDB, $sql_Post_In);
        if($Execute){
            //   $_SESSION["SuccesssMessage"]="Category Added ";
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
    <title>Dashboard</title>

    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="style.css" class="">
</head>

<body>
    <!--Navigation part starts-->
<?php include 'navbar.php'; ?>
    <!--Navigation part ends-->

    <!-- header -->
    <header class="bg-light text-dark py-3">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1><i class="fa-solid fa-pen-to-square"></i>Create New Post</h1>
            </div>
        </div>
    </div>
    </header>
    <?php
    if($success)
    {
       
       ?>
       <div class="alert alert-success" role="alert">
     successfully added!
    </div>
       <?php
       
        
    }
    else{
        echo '';
    }
?>


    <div class="container py-2 b-8">
        <div class="card ">

            <div class="card-header">
            <?php
                $facultyName =  Session::get('name');
                echo "Your Faculty Name:";
                echo $facultyName;

            ?>    
            <form method="POST" action="">
                <div class="form-group ">
                    <label for="">Topic</label>
                    <input type="text" class="form-control mb-2" id="topicname" name="topic" placeholder="Topic Name" >
                </div>
            <div class="form-group ">
                <label for="exampleFormControlSelect1">
                    <span class="fieldinfo">Choose forum Section:</span>
                </label>
                <select class="form-control-file py-2" id="section" name="section" >
                    <option value="Buy & Sell">Buy & Sell</option>
                     <option value="Anime">Anime</option>
                    <option value="Games">Games</option>
                    <option value="Action">Action</option>
                     <option value="Si-Fi">Si-Fi</option>
                </select>
            </div>
          

        
            <div class="form-group">
                <!-- <div id="editor" name="postdescription"></div> -->
                <label for="">Post:</label>
                 <textarea class="form-control" id="post" name="postdescription" rows="3" ></textarea>
            </div>
            
            <div class="col-lg-7 mb-2 py-3">
                <button type="submit" name="submitbt" class="btn btn-success btn block"><i class="fa-solid fa-check"></i>Publish</button>
            </div>
            </form>
   

            </div>
        </div>    
    </div>


    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	<!-- <script src="app.js"></script> -->
    <script src="ckeditor/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('post');
    </script>
    



</body>

</html>