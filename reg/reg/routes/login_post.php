<?php
$email = $_POST['email']; // รับค่า email จาก form
$password = $_POST['password'];// รับค่า password จาก form
$result = login( $email, $password);// เรียกใช้ฟังก์ชัน login จากไฟล์ authen.php
if($result){// ถ้ามีผลลัพธ์
    $unix_timestamp = time();// กำหนดค่าเวลาปัจจุบัน
    $_SESSION['timestamp'] = $unix_timestamp; // กำหนดค่าเวลาใน session
    $_SESSION['student_id'] = $result['student_id']; // กำหนดค่า student_id ใน session
    renderView('main_get', $result); // ส่งข้อมูลไปยัง view main_get
}else{ // ถ้าไม่มีผลลัพธ์
    $_SESSION['message'] = 'Email or Password invalid'; // กำหนดข้อความ
    renderView('login_get');    // ส่งข้อมูลไปยัง view login_get
    unset($_SESSION['message']); // ลบข้อความ
    unset($_SESSION['timestamp']); // ลบเวลา
}
// การทำงาน:
// รับค่า email และ password จาก $_POST
// เรียกใช้ฟังก์ชัน login($email, $password) เพื่อตรวจสอบข้อมูลกับฐานข้อมูล
// ถ้า login() return ข้อมูลผู้ใช้ (login สำเร็จ):
// กำหนด timestamp และ student_id ใน session
// เรียกใช้ renderView('main_get', $result) เพื่อแสดงหน้าหลัก
// ถ้า login() return false (login ไม่สำเร็จ):
// กำหนดข้อความผิดพลาดใน session
// เรียกใช้ renderView('login_get') เพื่อแสดงหน้า login อีกครั้ง
// ลบข้อความผิดพลาดและ timestamp ออกจาก session