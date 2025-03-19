<?php
if (isset($_SESSION['UserID']) === false) {
    $_SESSION['alert'] = 'กรุณาเข้าสู่ระบบก่อน';
    header('Location: /login');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $Actid = $_POST['ActID'];
    $Title = $_POST['Title'];
    $Description = $_POST['Description'];
    $Location = $_POST['Location'];
    $StartDate = $_POST['StartDate'];
    $EndDate = $_POST['EndDate'];
    $Max = $_POST['Max'];
    $Status = $_POST['Status'];
    $CreateBy = $_SESSION['UserID'];

    // ตรวจสอบว่ามีไฟล์รูปภาพใหม่อัปโหลดมาหรือไม่
    $ImageURL = $_POST['ImageURL']; 
    if (isset($_FILES['ImageURL']) && $_FILES['ImageURL']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = 'uploadsactivity/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true); // สร้างโฟลเดอร์ถ้ายังไม่มี
        }

        // ตั้งชื่อไฟล์ใหม่เพื่อป้องกันชื่อซ้ำ
        $filename = uniqid() . '_' . basename($_FILES['ImageURL']['name']);
        $filepath = $uploadDir . $filename;

        // ตรวจสอบประเภทไฟล์
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        if (in_array($_FILES['ImageURL']['type'], $allowedTypes)) {
            // ย้ายไฟล์ไปยังโฟลเดอร์
            if (move_uploaded_file($_FILES['ImageURL']['tmp_name'], $filepath)) {
                // ลบไฟล์เก่าออกจากโฟลเดอร์ (ถ้ามี)
                if (!empty($ImageURL) && file_exists($ImageURL)) {
                    unlink($ImageURL); // ลบไฟล์เก่า
                }
                $ImageURL = $filepath; // อัปเดตค่า ImageURL เป็นไฟล์ใหม่
            } else {
                $_SESSION['alert'] = 'เกิดข้อผิดพลาดในการอัปโหลดไฟล์';
                header('Location: /editactivity?id=' . $Actid);
                exit();
            }
        } else {
            $_SESSION['alert'] = 'ประเภทไฟล์ไม่ถูกต้อง';
            header('Location: /editactivity?id=' . $Actid);
            exit();
        }
    }

    // อัปเดตข้อมูลกิจกรรม
    $result = updateActivity($Actid, $Title, $Description, $Location, $ImageURL, $StartDate, $EndDate, $Max, $Status, $CreateBy);
    if ($result) {
        $_SESSION['alert'] = 'แก้ไขกิจกรรมสำเร็จ';
    } else {
        $_SESSION['alert'] = 'เกิดข้อผิดพลาดในการแก้ไขกิจกรรม';
    }

    header('Location: /profile');
    exit();
}
?>