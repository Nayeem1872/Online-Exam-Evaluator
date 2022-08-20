<?php

require_once('../lib/Database.php');
require_once('../class/Format.php');

class Exam
{

    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    // New Exam Registration
    public function examRegistration($exam_title, $facultyId, $exam_duration, $total_marks, $exam_declaration_datetime, $exam_status,$qsn1, $sol1 ,$qsn2, $qsn3, $sol2, $sol3,$qsn4, $qsn5, $sol4, $sol5)
    {
        $exam_title = $this->fm->validation($exam_title);
        $qsn1 = $this->fm->validation($qsn1);
        $exam_duration = $this->fm->validation($exam_duration);
        $total_marks = $this->fm->validation($total_marks);
        $exam_declaration_datetime = $this->fm->validation($exam_declaration_datetime);
        $exam_status = $this->fm->validation($exam_status);
        $sol1 = $this->fm->validation($sol1);

        $exam_title = mysqli_real_escape_string($this->db->link, $exam_title);
        $qsn1 = mysqli_real_escape_string($this->db->link, $qsn1);
        $exam_duration = mysqli_real_escape_string($this->db->link, $exam_duration);
        $total_marks = mysqli_real_escape_string($this->db->link, $total_marks);
        $exam_declaration_datetime = mysqli_real_escape_string($this->db->link, $exam_declaration_datetime);
        $exam_status = mysqli_real_escape_string($this->db->link, $exam_status);
        $sol1 = mysqli_real_escape_string($this->db->link, $sol1);


        if ($exam_title == '' || $qsn1 == '' || $exam_duration == '' || $total_marks == '' || $exam_declaration_datetime == '' || $exam_status == '' || $sol1 == '') {
            $result = "<span class='text-danger'>Field Must Not Be Empty....!</span>";
            return $result;
            exit();
        } else {
            $query = "INSERT INTO exam_tbl (exam_title, faculty_id, exam_duration, total_marks, exam_declaration_datetime, exam_status,qsn1, sol1, qsn2, qsn3, sol2, sol3,qsn4, qsn5, sol4, sol5)VALUES('$exam_title','$facultyId','$exam_duration','$total_marks','$exam_declaration_datetime','$exam_status','$qsn1','$sol1', '$qsn2', '$qsn3', '$sol2', '$sol3','$qsn4', '$qsn5', '$sol4', '$sol5')";
            $result = $this->db->insert($query);
            if ($result) {
                $result = "<span class='text-success'>Exam Registration Successfully..!</span>";
                return $result;
                exit();
            } else {
                $result =  "<span class='text-danger'>Fail To Exam Registration..!</span>";
                return $result;
                exit();
            }
        }
    }

    //Get all exam lsit 
    public function getExamList($facultyId)
    {
        $query = "SELECT * FROM exam_tbl WHERE faculty_id='$facultyId' ORDER BY exam_id DESC";
        $result = $this->db->select($query);
        return $result;
    }

    // Delete single Exam
    public function delExam($examId)
    {
        $query = "DELETE FROM exam_tbl WHERE exam_id = '$examId'";
        $result = $this->db->delete($query);
        if ($result) {
            $msg = "<span class='text-success'>Exam Delete Successfully.....!</span>";
            return $msg;
        } else {
            $msg = "<span class='text-danger'>Fail to Delete Exam.....!</span>";
            return $msg;
        }
    }

    //Single Exam  Show
    public function getExamById($examId)
    {
        $query = "SELECT * FROM exam_tbl WHERE exam_id = '$examId'";
        $result = $this->db->select($query);
        return $result;
    }



    // Update Single Exam
    public function udpateExam($examId, $exam_title, $exam_duration, $total_marks, $exam_declaration_datetime, $exam_status,$qsn1, $sol1,$qsn2, $qsn3, $sol2, $sol3,$qsn4, $qsn5, $sol4, $sol5)
    {
        $exam_title = $this->fm->validation($exam_title);
        $qsn1 = $this->fm->validation($qsn1);
        $exam_duration = $this->fm->validation($exam_duration);
        $total_marks = $this->fm->validation($total_marks);
        $exam_declaration_datetime = $this->fm->validation($exam_declaration_datetime);
        $exam_status = $this->fm->validation($exam_status);
        $sol1 = $this->fm->validation($sol1);


        $exam_title = mysqli_real_escape_string($this->db->link, $exam_title);
        $qsn1 = mysqli_real_escape_string($this->db->link, $qsn1);
        $exam_duration = mysqli_real_escape_string($this->db->link, $exam_duration);
        $total_marks = mysqli_real_escape_string($this->db->link, $total_marks);
        $exam_declaration_datetime = mysqli_real_escape_string($this->db->link, $exam_declaration_datetime);
        $exam_status = mysqli_real_escape_string($this->db->link, $exam_status);
        $sol1 = mysqli_real_escape_string($this->db->link, $sol1);


        if ($exam_title == '' || $qsn1 == '' || $exam_duration == '' || $total_marks == '' || $exam_declaration_datetime == '' || $exam_status == '' || $sol1 == '') {
            $result = "<span class='text-danger'>Field Must Not Be Empty....!</span>";
            return $result;
            exit();
        } else {

            $query = "UPDATE exam_tbl SET exam_title='$exam_title', qsn1='$qsn1', exam_duration='$exam_duration', total_marks='$total_marks', exam_declaration_datetime='$exam_declaration_datetime', exam_status='$exam_status', sol1='$sol1',qsn2='$qsn2' , sol2='$sol2',qsn3='$qsn3' , sol3='$sol3',qsn4='$qsn4' , sol4='$sol4',qsn5='$qsn5' , sol5='$sol5' WHERE exam_id='$examId'";
            $result = $this->db->update($query);
            if ($result) {
                $msg = "<span class='text-success'>Exam Updated Successfully.....!</span>";
                return $msg;
            } else {
                $msg = "<span class='text-danger'>Fail to Update the Exam.....!</span>";
                return $msg;
            }
        }
    }
 

    //Student Enroll Exam List
    public function getEnrollExamList($facultyId)
    {
        $query = "SELECT std_exam_enrolled.id, std_exam_enrolled.enrolled_exam_status as enrolled_status, faculty_tbl.name as faculty_name, exam_tbl.exam_title, std_tbl.name as student_name, std_tbl.id as student_id
        FROM std_exam_enrolled
        JOIN faculty_tbl ON std_exam_enrolled.faculty_id = faculty_tbl.id
        JOIN exam_tbl ON std_exam_enrolled.exam_id = exam_tbl.exam_id
        JOIN std_tbl ON std_exam_enrolled.std_tbl_std_id = std_tbl.id
        WHERE std_exam_enrolled.faculty_id = $facultyId";

        $result = $this->db->select($query);
        return $result;
    }

    // Enroll Student Results
    // public function getEnrollStudentResults($facultyId)
    // {
    //     $query = "SELECT exam_remark.*, exam_tbl.exam_title, faculty_tbl.name as faculty_name, std_tbl.name as student_name, std_tbl.uni_name, std_tbl.uni_roll_no
    //     FROM exam_remark
    //     JOIN exam_tbl ON exam_remark.exam_id = exam_tbl.exam_id
    //     JOIN faculty_tbl ON exam_remark.faculty_id = faculty_tbl.id
    //     JOIN std_tbl ON exam_remark.student_id = std_tbl.id
    //     WHERE exam_remark.faculty_id = $facultyId";

    //     $result = $this->db->select($query);
    //     return $result;
    // }



    public function getEnrolledStudentsResult($std_id)
    {
        $query = "SELECT * FROM std_solution INNER JOIN std_exam_enrolled on std_exam_enrolled.exam_id = std_solution.qsn_id AND std_solution.std_id = std_exam_enrolled.std_tbl_std_id AND std_exam_enrolled.enrolled_exam_status = 1 INNER JOIN exam_tbl on std_solution.qsn_id = exam_tbl.exam_id INNER JOIN std_tbl ON std_solution.std_id = std_tbl.id WHERE (std_solution.timeover= 1 OR std_solution.submitted =1) AND std_exam_enrolled.faculty_id = '$std_id'
            AND std_solution.got_marks!=(SELECT MAX(std_solution.got_marks) FROM std_solution) ";
        $result = $this->db->select($query);
        return $result;
    }
    public function getEnrolledStudentsResult_max($std_id)
    {
        $query = "SELECT * FROM std_solution INNER JOIN std_exam_enrolled on std_exam_enrolled.exam_id = std_solution.qsn_id AND std_solution.std_id = std_exam_enrolled.std_tbl_std_id AND std_exam_enrolled.enrolled_exam_status = 1 INNER JOIN exam_tbl on std_solution.qsn_id = exam_tbl.exam_id INNER JOIN std_tbl ON std_solution.std_id = std_tbl.id WHERE (std_solution.timeover= 1 OR std_solution.submitted =1) AND std_exam_enrolled.faculty_id = '$std_id'
                    AND std_solution.got_marks=(SELECT MAX(std_solution.got_marks) FROM std_solution)";
        $result = $this->db->select($query);
        return $result;
    }

    public function rejectedFromEnrollExam($id)
    {
        $query = "UPDATE `std_exam_enrolled` SET `enrolled_exam_status`= 2 WHERE  `id` = '$id'";
        $result = $this->db->update($query);
        return $result;
    }
    
}
