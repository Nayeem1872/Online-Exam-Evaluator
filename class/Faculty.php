<?php

require_once('../lib/Database.php');
require_once('Format.php');

class Faculty
{

    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    // New Faculty Registration
    public function facultyRegistration($name, $uni_name, $password, $email, $image)
    {
        $name = $this->fm->validation($name);
        $uni_name = $this->fm->validation($uni_name);
        $password = $this->fm->validation($password);
        $email = $this->fm->validation($email);
        
        $name = mysqli_real_escape_string($this->db->link, $name);
        $uni_name = mysqli_real_escape_string($this->db->link, $uni_name);
        $password = mysqli_real_escape_string($this->db->link, $password);
        $email = mysqli_real_escape_string($this->db->link, $email);

        if ($name == '' || $uni_name == '' || $password == '' || $email == '') {
            $result = "<span class='text-danger'>Field Must Not Be Empty....!</span>";
            return $result;
            exit();
        } elseif (filter_var($email, FILTER_VALIDATE_EMAIL) === FALSE) {
            $result = "<span class='text-danger'>Invalid Email Address.....</span>";
            return $result;
            exit();
        } else {
            $chkquery = "SELECT * FROM faculty_tbl WHERE email = '$email'";
            $chkresult = $this->db->select($chkquery);
            if ($chkresult != false) {
                $result = "<span class='text-danger'>This email address already exists. Try to log in with the existing mail or register with the new email address. </span>";
                return $result;
                exit();
            } else {
                $query = "INSERT INTO faculty_tbl (name,uni_name,password,email,img)VALUES('$name','$uni_name','$password','$email','$image')";
                $result = $this->db->insert($query);
                if ($result) {
                    $result = "<span class='text-success'> Congratulations! You've completed your registration successfully. </span>";
                    return $result;
                    exit();
                } else {
                    $result =  "<span class='text-danger'>Ooops! There's an error to complete your registration. Contact with the support team. </span>";
                    return $result;
                    exit();
                }
            }
        }
    }



    //Faculty Login
    public function facultyLogin($email, $password)
    {
        $email = $this->fm->validation($email);
        $password = $this->fm->validation($password);

        $email = mysqli_real_escape_string($this->db->link, $email);
        $password = mysqli_real_escape_string($this->db->link, $password);

        if ($email == '' || $password == '') {
            $result =  "<span class='text-danger'> The field must not be empty. Try again. </span>";
            return $result;
            exit();
        } else {
            $query = "SELECT * FROM faculty_tbl WHERE email = '$email' AND password = '$password'";
            $result = $this->db->select($query);
            if ($result != FALSE) {
                $value = $result->fetch_assoc();
                if ($value['status'] == '1') {
                    $result =  "<span class='text-danger'>Account Disable....!</span>";
                    return $result;
                   
                    exit();
                } else {
                 
                    Session::init();
                    
                    Session::set("login", TRUE);
                    Session::set("id", $value['id']);
                    Session::set("name", $value['name']);
                    Session::set("email", $value['email']);
                    Session::set("uni_name", $value['uni_name']);
                    header("Location:dashboard.php");
                }
            } else {
                $result =  "<span class='text-danger'>Login information doesn't match!!  Try again. </span>";
                return $result;
                exit();
            }
        }
    }


    //Single Faculty Info
    public function getFacultyById($facultyId)
    {
        $query = "SELECT * FROM faculty_tbl WHERE id = '$facultyId'";
        $result = $this->db->select($query);
        return $result;
    }


    // Update Faculty Profile
    public function udpateFacultyProfile($facultyId, $name, $email, $uni_name, $image, $password)
    {
        $name = $this->fm->validation($name);
        $email = $this->fm->validation($email);
        $uni_name = $this->fm->validation($uni_name);

        $name = mysqli_real_escape_string($this->db->link, $name);
        $uni_name = mysqli_real_escape_string($this->db->link, $uni_name);
        $email = mysqli_real_escape_string($this->db->link, $email);
        if($password == 'nochangepassword'){
            $query = "UPDATE faculty_tbl SET name = '$name',uni_name = '$uni_name',email='$email', img='$image' WHERE id = '$facultyId'";
         }else{
             $password = md5($password);
            $query = "UPDATE faculty_tbl SET name = '$name',uni_name = '$uni_name',email='$email', password ='$password',  img='$image'  WHERE id = '$facultyId'";
         }

         $result = $this->db->update($query);
        if ($result) {
            $msg = "<span class='text-success'>Profile information updated.</span>";
            return $msg;
        } else {
            $msg = "<span class='text-danger'>Fail to Update Profile Information!!</span>";
            return $msg;
        }
    }

    public function studentDetails($studentId)
    {
        $query = "SELECT * FROM std_tbl WHERE id = '$studentId'";
        $result = $this->db->select($query);
        return $result;
    }

    // Accept Students Enrolemnet
    public function examEnrollRequestAccept($examId )
    {
         $query = "UPDATE `std_exam_enrolled` SET  `enrolled_exam_status`= '1' WHERE `id` =  '$examId'";
         $result = $this->db->update($query);
           if($result==true){
               return true;
           }else{
               return false;
           }
  }
}
