<?php
// ตรวจสอบเมื่อฟอร์มถูกส่ง
// ตรวจสอบเมื่อฟอร์มถูกส่ง
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['Status'])) {
    // รับค่าจากฟอร์ม
    $statusData = $_POST['Status'];
    $ActID = $_POST['ActID'];

    // สามารถใช้งานกับทุกกิจกรรมที่ส่งมาจากฟอร์ม
    foreach ($statusData as $UserID => $status) {
        updateUserStatus($UserID, $status, $ActID);  // ส่ง event_id ที่ได้รับจากฟอร์มไปด้วย
    }
}

?>