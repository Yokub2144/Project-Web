<?php
    if( $_SERVER['REQUEST_METHOD'] == 'POST') {
       if(isset($_POST['student_id']) && isset($_POST['course_id'])) {
        $student_id = $_POST['student_id'];
        $course_id = $_POST['course_id'];
           if(dropcourse($student_id, $course_id)) {
               echo "ลบรายวิชาสำเร็จ";
           } else {
               echo "มีข้อผิดพลาดเกิดขึ้น";
           }
           header('Location: /profile');
        } else {
            echo "ข้อมูลไม่ครบถ้วน";
        }
    }