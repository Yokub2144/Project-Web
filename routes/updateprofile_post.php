<?php
// ตรวจสอบการล็อกอินก่อน
if (!isset($_SESSION['UserID'])) {
    $_SESSION['alert'] = 'กรุณาเข้าสู่ระบบก่อน';
    header('Location: /login');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // รับข้อมูลจากฟอร์ม
    $userId = $_SESSION['UserID'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $gender = $_POST['gender'];
    $age = $_POST['age'];
    $currentImage = $_POST['current_image'] ?? null; 
    
    // จัดการอัพโหลดรูปภาพใหม่
    $imageProfileURL = $currentImage; 
    
    if (isset($_FILES['profileImage']) && $_FILES['profileImage']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = 'uploads/profile/';
        
        // สร้างโฟลเดอร์ถ้ายังไม่มี
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }
        
        // สร้างชื่อไฟล์ใหม่ไม่ให้ซ้ำ
        $filename = uniqid() . '_' . basename($_FILES['profileImage']['name']);
        $filepath = $uploadDir . $filename;
        
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        $fileType = mime_content_type($_FILES['profileImage']['tmp_name']);
        
        if (in_array($fileType, $allowedTypes)) {
            // ย้ายไฟล์ไปยังโฟลเดอร์
            if (move_uploaded_file($_FILES['profileImage']['tmp_name'], $filepath)) {
                // ลบรูปภาพเก่าถ้ามีและไม่ใช่รูป default
                if ($currentImage && file_exists($currentImage) && strpos($currentImage, 'default_profile.jpg') === false) {
                    unlink($currentImage);
                }
                $imageProfileURL = $filepath;
            } else {
                $_SESSION['error'] = 'เกิดข้อผิดพลาดในการอัปโหลดไฟล์';
                header('Location: /editprofile');
                exit();
            }
        } else {
            $_SESSION['error'] = 'อนุญาตเฉพาะไฟล์รูปภาพ (JPEG, PNG, GIF)';
            header('Location: /editprofile');
            exit();
        }
    }

  
    $result = updateUser($userId, $name, $email, $phone, $gender, $age, $imageProfileURL);
    
    if ($result) {
        // อัพเดทข้อมูลใน session
        $_SESSION['User'] = [
            'Name' => $name,
            'Email' => $email,
            'Phone' => $phone,
            'Gender' => $gender,
            'Age' => $age,
            'ImageProfileURL' => $imageProfileURL
        ];
        
        $_SESSION['success'] = 'อัพเดทโปรไฟล์สำเร็จแล้ว';
        header('Location: /profile');
        exit();
    } else {
        // ลบรูปที่เพิ่งอัปโหลดถ้าอัพเดทไม่สำเร็จ
        if ($imageProfileURL !== $currentImage && file_exists($imageProfileURL)) {
            unlink($imageProfileURL);
        }
        
        $_SESSION['error'] = 'เกิดข้อผิดพลาดในการอัพเดทโปรไฟล์';
        header('Location: /editprofile');
        exit();
    }
}