<?php

require_once('./lib/Database.php');
require_once('Format.php');

class Student
{

    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    // New Student Registration
    public function studentRegistration($name, $uni_name, $uni_roll_no, $password, $email)
    {
        $name = $this->fm->validation($name);
        $uni_name = $this->fm->validation($uni_name);
        $uni_roll_no = $this->fm->validation($uni_roll_no);
        $password = $this->fm->validation($password);
        $email = $this->fm->validation($email);

        $name = mysqli_real_escape_string($this->db->link, $name);
        $uni_name = mysqli_real_escape_string($this->db->link, $uni_name);
        $uni_roll_no = mysqli_real_escape_string($this->db->link, $uni_roll_no);
        $password = mysqli_real_escape_string($this->db->link, $password);
        $email = mysqli_real_escape_string($this->db->link, $email);

        if ($name == '' || $uni_name == '' || $uni_roll_no == '' || $password == '' || $email == '') {
            $result = "<span class='text-danger'>Field Must Not Be Empty....!</span>";
            return $result;
            exit();
        } elseif (filter_var($email, FILTER_VALIDATE_EMAIL) === FALSE) {
            $result = "<span class='text-danger'>Invalid Email Address.....</span>";
            return $result;
            exit();
        } else {
            $chkquery = "SELECT * FROM std_tbl WHERE email = '$email'";
            $chkresult = $this->db->select($chkquery);
            if ($chkresult != false) {
                $result = "<span class='text-danger'>Email Address Already Exist.....</span>";
                return $result;
                exit();
            } else {
                $query = "INSERT INTO std_tbl (name,uni_name,uni_roll_no,password,email)VALUES('$name','$uni_name','$uni_roll_no','$password','$email')";
                $result = $this->db->insert($query);
                if ($result) {
                    $result = "<span class='text-success'>Student Registration Successfully..!</span>";
                    return $result;
                    exit();
                } else {
                    $result =  "<span class='text-danger'>Fail To Student Registration..!</span>";
                    return $result;
                    exit();
                }
            }
        }
    }



    //Student Login
    public function studentLogin($email, $password)
    {
        $email = $this->fm->validation($email);
        $password = $this->fm->validation($password);

        $email = mysqli_real_escape_string($this->db->link, $email);
        $password = mysqli_real_escape_string($this->db->link, $password);

        if ($email == '' || $password == '') {
            $result =  "<span class='text-danger'>Field Must Not Be Empty....!</span>";
            return $result;
            exit();
        } else {
            $query = "SELECT * FROM std_tbl WHERE email = '$email' AND password = '$password'";
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
                    header("Location:student_dashboard.php");
                }
            } else {
                $result =  "<span class='text-danger'>Login Information Not Match....!</span>";
                return $result;
                exit();
            }
        }
    }

    //Get all exam lsit 
    public function getExamList($std_id)
    {
        $query = "SELECT exam_tbl.* ,std_exam_enrolled.enrolled_exam_status FROM `exam_tbl` LEFT JOIN std_exam_enrolled ON exam_tbl.exam_id = std_exam_enrolled.exam_id AND std_exam_enrolled.std_tbl_std_id = '$std_id'  ORDER BY exam_tbl.exam_id DESC";
        $result = $this->db->select($query);
        return $result;
    }


    public function getEnrolledExamList()
    {
        $query = "SELECT exam_tbl.* ,std_exam_enrolled.enrolled_exam_status FROM `exam_tbl` LEFT JOIN std_exam_enrolled ON exam_tbl.exam_id = std_exam_enrolled.exam_id WHERE  enrolled_exam_status=1 ORDER BY exam_tbl.exam_id DESC";
        $result = $this->db->select($query);
        return $result;
    }


    // Student Exam Enroll Request
    public function examEnrollRequest($examId, $studentId)
    {
        $chkquery = "SELECT * FROM std_exam_enrolled WHERE exam_id = '$examId' AND std_tbl_std_id = '$studentId'";
        $chkresult = $this->db->select($chkquery);
        if ($chkresult != false) {
            $result = "<span class='text-danger'>Already Enrolled This Exam.....</span>";
            return $result;
            exit();
        } else {
            $query = "SELECT * FROM exam_tbl WHERE exam_id = '$examId'";
            $result = $this->db->select($query);
            foreach ($result as $value) {
                $facultyId =  $value['faculty_id'];
            }

            $query = "INSERT INTO std_exam_enrolled (exam_id,faculty_id,enrolled_exam_status,std_tbl_std_id)VALUES('$examId','$facultyId','0','$studentId')";
            $result = $this->db->insert($query);

            if ($result) {
                $result = "<span class='text-success'>Exam Enroll Request Send Successfully..!</span>";
                return $result;
                exit();
            } else {
                $result =  "<span class='text-danger'>Fail to Send Exam Enroll Request..!</span>";
                return $result;
                exit();
            }
        }
    }


       //Single Exam  Show
       public function getExamById($examId)
       {
           $query = "SELECT * FROM exam_tbl WHERE exam_id = '$examId'";
           $result = $this->db->select($query);
           return $result;
       }


            //Start Enrolled Exam
            public function startEnrolledExam($std_id,$examId)
            {
                $query = "SELECT * FROM `std_solution` INNER JOIN exam_tbl On std_solution.qsn_id = exam_tbl.exam_id    WHERE  `std_id` = '$std_id' AND  `qsn_id`= '$examId' ";
                $result = $this->db->select($query);
                if(!$result){
                     $query = "INSERT INTO `std_solution`(`std_solution`, `std_ans`, `std_id`, `qsn_id`, `got_marks` ) VALUES (0,0, '$std_id','$examId',0 )";
                    $result = $this->db->insert($query);
                    return $result;
                } 
             }


            // Submit exam
            public function preSubmitEnrolledExamCheck($std_id,$examId, $submitexam , $std_ans,$std_ans2,$std_ans3,$std_ans4,$std_ans5)
            {
                // $querys = "SELECT TIMEDIFF(CURRENT_TIMESTAMP,solution_up_datetime) as difftime , std_solution.* , exam_tbl.* 
                // FROM std_solution INNER JOIN exam_tbl On std_solution.qsn_id = exam_tbl.exam_id  WHERE `std_id` = '$std_id' AND `qsn_id` = '$examId'";

                $querys = "SELECT TIMEDIFF(CURRENT_TIMESTAMP,solution_up_datetime) as difftime , std_solution.* , exam_tbl.* ,std_exam_enrolled.*
                FROM std_solution INNER JOIN exam_tbl On std_solution.qsn_id = exam_tbl.exam_id
                INNER JOIN std_exam_enrolled  On std_exam_enrolled.exam_id = std_solution.qsn_id AND std_solution.std_id = std_exam_enrolled.std_tbl_std_id 
                WHERE `std_id` = '$std_id' AND `qsn_id` = '$examId'";
                $result = $this->db->select($querys);
                $queryData = mysqli_fetch_assoc($result) ;
                $time =  $queryData['difftime'];
                $timeover =  $queryData['timeover'];
                $solution =  $queryData['sol1'];
                $solution2 =  $queryData['sol2'];
                $solution3 =  $queryData['sol3'];
                $solution4 =  $queryData['sol4'];
                $solution5 =  $queryData['sol5'];
                $total_marks =  $queryData['total_marks'];
                $submitted =  $queryData['submitted'];
                if($timeover == 1 || $submitted==1){
                    return array('lefttime'=>0,'data'=>$queryData, 'success'=>1);
                }else{
                    $seconds= strtotime($time) - strtotime('00:00:00');
                    $query = "SELECT * FROM `exam_tbl` WHERE  `exam_id` = '$examId'";
                    $results = $this->db->select($query);
                    $examduration = mysqli_fetch_assoc($results)['exam_duration'];
                    // return $examduration*60 . 'second  = '. $seconds;
                    $counter=1;
                    if($solution2==""){
                        $counter=1;
                    }
                    else if($solution3==""){
                        $counter=2;
                    }
                    else if($solution4==""){
                        $counter=3;
                    }
                    else if($solution5==""){
                        $counter=4;
                    }
                    else{
                        $counter=5;
                    }
                    
                    if($examduration*60 >= $seconds){
                        if($submitexam ==1){
                            $marks= 0;
                            if($solution == $std_ans){
                                $marks += $total_marks/$counter;
                            }if($counter>=2 && $solution2 == $std_ans2){
                                $marks += $total_marks/$counter;
                            }if($counter>=3 && $solution3 == $std_ans3){
                                $marks += $total_marks/$counter;
                            }if($counter>=4 && $solution4 == $std_ans4){
                                $marks += $total_marks/$counter;
                            }if($counter>=5 && $solution5 == $std_ans5){
                                $marks += $total_marks/$counter;
                            }

                            $updateQuery = "UPDATE `std_solution` SET  `std_ans`='$std_ans' ,`std_ans2`='$std_ans2' ,`std_ans3`='$std_ans3' ,`std_ans4`='$std_ans4' ,`std_ans5`='$std_ans5' ,submitted = 1, `got_marks`='$marks '  WHERE `std_id` = '$std_id' AND `qsn_id` = '$examId'";
                            $result = $this->db->update($updateQuery);
                           
                            return array('lefttime'=>0,'data'=>$queryData, 'success'=>1);
                        }
                        return array('lefttime'=>$examduration*60-$seconds, 'success'=>0);
                    }else{
                      
                        $updateQuery = "UPDATE `std_solution` SET  `timeover`=1 WHERE `std_id` = '$std_id' AND `qsn_id` = '$examId'";
                        $result = $this->db->update($updateQuery);
                        return array('lefttime'=>0,'data'=>$queryData, 'success'=>1);
                       }
                }
               
                
            }

            public function getAllEnrolledExamList($std_id)
            {
                $query = "SELECT * FROM `std_exam_enrolled` INNER JOIN exam_tbl on std_exam_enrolled.exam_id = exam_tbl.exam_id LEFT JOIN std_solution on std_solution.qsn_id = exam_tbl.exam_id  AND  std_solution.std_id = '$std_id'  INNER JOIN std_tbl on std_exam_enrolled.std_tbl_std_id = std_tbl.id   WHERE NOT std_exam_enrolled.enrolled_exam_status =0 AND `std_tbl_std_id`  = '$std_id'   ";
                $result = $this->db->select($query);
                return $result;
            }


            public function getStudentById($id)
            {
                $query = "SELECT * FROM `std_tbl` WHERE `id` =  '$id'";
                $result = $this->db->select($query);
                return $result;
            }


            public function udpateStudentProfile($studentId,$name, $uni_name, $uni_roll_no, $password, $email)
            {
                $name = $this->fm->validation($name);
                $uni_name = $this->fm->validation($uni_name);
                $uni_roll_no = $this->fm->validation($uni_roll_no);
                $password = $this->fm->validation($password);
                $email = $this->fm->validation($email);
        
                $name = mysqli_real_escape_string($this->db->link, $name);
                $uni_name = mysqli_real_escape_string($this->db->link, $uni_name);
                $uni_roll_no = mysqli_real_escape_string($this->db->link, $uni_roll_no);
                $password = mysqli_real_escape_string($this->db->link, $password);
                $email = mysqli_real_escape_string($this->db->link, $email);
        
                $query = "UPDATE std_tbl SET name = '$name',uni_name = '$uni_name',email='$email',password='$password', uni_roll_no='$uni_roll_no' WHERE id = '$studentId'";
                $result = $this->db->update($query);
                if ($result) {
                    $msg = "<span class='text-success'>Profile information updated.</span>";
                    return $msg;
                } else {
                    $msg = "<span class='text-danger'>Fail to Update Profile Information!!</span>";
                    return $msg;
                }
            }
       

}
