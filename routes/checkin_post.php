<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['checkin'])) {
    $userID = $_POST['UserID'];
    $actID = $_POST['ActID'];

    if (isset($_POST['JoinCode'])) {
        $joinCode = $_POST['JoinCode']; // รหัสที่ผู้ใช้กรอก

        // ดึงรหัสจากไฟล์ activity_codes.php
        $storedJoinCode = getActivityCode($actID);

        if ($storedJoinCode) {
            if ($joinCode === $storedJoinCode) {
                // รหัสตรงกัน อัปเดตสถานะการเช็คอิน
                $checkedIn = true;
                $result = updateCheckInStatus($userID, $actID, $checkedIn);

                if ($result) {
                    $_SESSION['alert'] = "เช็คอินสำเร็จ!";
                } else {
                    $_SESSION['alert'] = "เกิดข้อผิดพลาดในการเช็คอิน!";
                }
            } else {
                // รหัสไม่ตรงกัน
                $_SESSION['alert'] = "รหัสยืนยันไม่ถูกต้อง! รหัสที่กรอก: $joinCode / รหัสที่ถูกต้อง: $storedJoinCode";
            }
        } else {
            // ไม่พบรหัสในไฟล์ activity_codes.php
            $_SESSION['alert'] = "ไม่พบรหัสยืนยันสำหรับกิจกรรมนี้!";
        }
    } else {
        $_SESSION['alert'] = "ไม่มีการส่งค่ารหัสยืนยัน!";
    }

    // เปลี่ยนเส้นทางกลับไปยังหน้าโปรไฟล์
    header('Location: /profile');
    exit();
}

