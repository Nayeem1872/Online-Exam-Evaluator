

<?php
   include '../lib/Database.php';
    $success= false;
    
        global $connectDB;
       $id=$_GET['id'];
       $sql= "DELETE FROM post WHERE id='$id'";
       $Execute = mysqli_query($connectDB, $sql);
           

            if($Execute){
                //   $_SESSION["SuccesssMessage"]="Category Added ";
                // echo 'added';
                $success= true;
                header("location:my_post.php");
                

                // -- Redirect_to("categories.php");
            }
            else
            {
                // $_SESSION["ErrorMessage"]="Something is wrong";
                // Redirect_to("categories.php");
                echo 'fail';
            }


        
    


?>

