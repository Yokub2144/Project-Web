<?php
    
$UserID = (int)$_POST['UserID'];
$ActID = (int)$_POST['ActID'];

if (dropActivity($UserID, $ActID)) {
    $_SESSION['alert'] = 'ยกเลิกการเข้าร่วมกิจกรรมสำเร็จ';
} else {
    $_SESSION['alert'] = 'เกิดข้อผิดพลาดในการยกเลิกการเข้าร่วมกิจกรรม';
}

header('Location: /profile');
exit;