<?php
   if (isset($_POST['new_password']) && isset($_POST['student_id'])) { // ตรวจสอบว่ามีข้อมูล new_password และ student_id หรือไม่

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {// ตรวจสอบว่าเป็น method POST หรือไม่
        $new_password = $_POST['new_password']; // รับค่า new_password จาก form
        $student_id = $_POST['student_id']; // รับค่า student_id จาก form
        updatePassword($new_password, $student_id); // เรียกใช้ฟังก์ชัน updatePassword จากไฟล์ users.php
        echo "เปลี่ยนรหัสผ่านสำเร็จ"; // แสดงข้อความ เปลี่ยนรหัสผ่านสำเร็จ
    }
    // ดำเนินการต่อ
} else {
    echo "ข้อมูลที่จำเป็นไม่ครบถ้วน";// แสดงข้อความ ข้อมูลที่จำเป็นไม่ครบถ้วน
}
