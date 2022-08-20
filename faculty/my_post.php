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
    <title>My Post</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
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
                <h1><i class="fa-solid fa-pen-to-square"></i>My Post</h1>
            </div>
        </div>
    </div>
    </header>
    <!-- main section -->
    <section class="container py-2 mb-4">
    <div class="row">
        <div class="col-lg-12">
            <table class="table table-striped table-hover">
                <thead class="thead-dark">
                <tr>
                    <th col-md-2>Serial No:</th>
                    <th py-2>Your ID</th>
                    <th>Topic</th>
                    <th>Section</th>
                    <th>Post</th>
                    <th scope="col">Action</th>
                    
                </tr>
                </thead>
                <?php
                global $connectDB;
                $facultyId =  Session::get('id');
                $sql = "SELECT * FROM post WHERE faculty_id=$facultyId";
                // $result = $this->db->select($sql);
                // return $result;
                $result = mysqli_query($connectDB, $sql);
                while($DataRows = mysqli_fetch_assoc ($result ))
                {


                    $array[]=$DataRows;
                    // $Id = $DatRows["id"];
                    // $dateTime = $DataRows["datetime"];
                    // $PostTitle =$DateRows["title"];
                    // $Category = $DateRows["category"];
                    // $Admin = $DateRows["author"];
                    // $Image =$DateRows["image"];
                    // $PostText=$DateRows["post"];
                

                }
                if(!empty($array)){
                foreach($array as $i){
                ?>
                
                <tr>
                    
                    <td><?php echo $i["id"]; ?></td>
                    <td><?php echo $i["faculty_id"]; ?></td>
                    <td><?php echo $i["topic"]; ?></td>
                    <td><?php echo $i["section"]; ?></td>
                    <td><?php echo $i["post"]; ?></td> 
                    <td><a href="DeletePost.php?id=<?php echo $i["id"] ?>"><span class="btn btn-danger">delete</span></a></td>
                   <br>
                  
                   

                </tr>
            <?php } }?>
            

            </table>
        </div>

    </div>


</section>


    







    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>