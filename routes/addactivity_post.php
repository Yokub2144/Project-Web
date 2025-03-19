<?php
if (isset($_SESSION['UserID']) === false) {
    $_SESSION['alert'] = 'กรุณาเข้าสู่ระบบก่อน';
    header('Location: /login');
    exit;
} else {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $ImageURL = null; // กำหนดค่าเริ่มต้น

        if (isset($_FILES['ImageURL']) && $_FILES['ImageURL']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = 'uploadsactivity/'; 
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true); // สร้างโฟลเดอร์ถ้ายังไม่มี
            }

            $filename = uniqid() . '_' . basename($_FILES['ImageURL']['name']); // ตั้งชื่อไฟล์ใหม่เพื่อป้องกันชื่อซ้ำ
            $filepath = $uploadDir . $filename;

            $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
            if (in_array($_FILES['ImageURL']['type'], $allowedTypes)) {
                // ย้ายไฟล์ไปยังโฟลเดอร์
                if (move_uploaded_file($_FILES['ImageURL']['tmp_name'], $filepath)) {
                    $ImageURL = $filepath; 
                } else {
                    $_SESSION['alert'] = 'เกิดข้อผิดพลาดในการอัปโหลดไฟล์';
                    header('Location: /addactivity');
                    exit();
                }
            } else {
                $_SESSION['alert'] = 'ประเภทไฟล์ไม่ถูกต้อง';
                header('Location: /addactivity');
                exit();
            }
        } else {
            $_SESSION['alert'] = 'กรุณาเลือกไฟล์รูปภาพ';
            header('Location: /addactivity');
            exit();
        }

        // บันทึกข้อมูลกิจกรรม
        $result = insertActivity(
            $_POST['Title'],
            $_POST['Description'],
            $_POST['Location'],
            $ImageURL, 
            $_POST['StartDate'],
            $_POST['EndDate'],
            $_POST['Max'],
            $_SESSION['UserID'], 
            $_POST['Status']
        );

        if ($result) {
            $_SESSION['alert'] = 'เพิ่มกิจกรรมสำเร็จ';
        } else {
            $_SESSION['alert'] = 'เกิดข้อผิดพลาดในการเพิ่มกิจกรรม';
        }

        header('Location: /homeactivity');
        exit();
    }
}
