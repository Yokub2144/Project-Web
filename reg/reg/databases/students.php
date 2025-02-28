<?php

function getStudents(): mysqli_result|bool
{
    $conn = getConnection(); // เรียกใช้ฟังก์ชัน getConnection จากไฟล์ db.php
    $sql = 'select * from students'; // กำหนดคำสั่ง sql
    $result = $conn->query($sql); // ประมวลผลคำสั่ง sql
    return $result;// ส่งค่ากลับ
}

function getStudentById(int $id): array|bool // ประกาศฟังก์ชัน getStudentById รับค่า id เป็น int และส่งค่ากลับเป็น array หรือ bool
{
    $conn = getConnection(); // เรียกใช้ฟังก์ชัน getConnection จากไฟล์ db.php
    $sql = 'select * from students where student_id = ?'; // สร้าง SQL query เพื่อดึงข้อมูลนักเรียนจากตาราง students
    $stmt = $conn->prepare($sql);// เตรียม prepared statement จาก SQL query 
    $stmt->bind_param("i", $id);//  กำหนดค่าให้กับตัวแปร
    $stmt->execute(); // ประมวลผลคำสั่ง sql
    $result = $stmt->get_result(); // รับผลลัพธ์
    if ($result->num_rows == 0) { // ถ้าไม่มีผลลัพธ์
        return false; // ส่งค่ากลับ
    }
    return $result->fetch_assoc(); // ส่งค่ากลับ
}
function updatePassword($new_password, $student_id): void {

    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);// กำหนดค่าให้กับตัวแปร
    $sql = "UPDATE students SET password = ? WHERE student_id = ?"; // ใช้ ? แทนพารามิเตอร์
    try { // ลองทำ
        $conn = getConnection(); // เรียกใช้ฟังก์ชัน getConnection จากไฟล์ db.php
        $stmt = $conn->prepare($sql);// กำหนดคำสั่ง sql
        $stmt->bind_param('si', $hashed_password,$student_id); // กำหนดค่าให้กับตัวแปร 

        $stmt->execute();

        echo "<script>alert('อัพเดทรหัสผ่านสำเร็จ');</script>";
        header("Location: /login");

    } catch(PDOException $e) {
        echo "เกิดข้อผิดพลาด: " . $e->getMessage();
    }
}

