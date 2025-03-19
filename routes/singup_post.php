<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // รับข้อมูลจากฟอร์ม
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // เข้ารหัสรหัสผ่าน
    $phone = $_POST['phone'];
    $gender = $_POST['gender'];
    $age = $_POST['age'];
    $imageProfileURL = null; 

    // อัปโหลดรูปภาพก่อน
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = 'uploadsprofile/';
        $filename = basename($_FILES['image']['name']);
        $filepath = $uploadDir . $filename;

        // ตรวจสอบประเภทไฟล์
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        if (in_array($_FILES['image']['type'], $allowedTypes)) {
            // ย้ายไฟล์ไปยังโฟลเดอร์ uploadsprofile
            if (move_uploaded_file($_FILES['image']['tmp_name'], $filepath)) {
                $imageProfileURL = $filepath; // กำหนด URL ของรูป
            } else {
                echo "เกิดข้อผิดพลาดในการอัปโหลดไฟล์";
                exit();
            }
        } else {
            echo "ประเภทไฟล์ไม่ถูกต้อง";
            exit();
        }
    }

    // บันทึกข้อมูลผู้ใช้ พร้อม URL รูปภาพ
    $result = insertUser($name, $email, $password, $phone, $gender, $age, $imageProfileURL);
    if ($result) {
        $_SESSION['alert'] = 'สมัครสมาชิกสำเร็จ';
        header('Location: /login');
        exit();
    } else {
        echo "เกิดข้อผิดพลาดในการสมัครสมาชิก";
        header('Location: /signup');
        exit();
    }
}
?>

