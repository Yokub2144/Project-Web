<?php
$CreateBy = $_SESSION['UserID'];
$ActID = (int)$_POST['ActID'];
if (dropActivity($ActID, $CreateBy)) {
    $_SESSION['alert'] = 'ลบกิจกรรมสำเร็จ';
} else {
    $_SESSION['alert'] = 'เกิดข้อผิดพลาดในการลบกิจกรรมสำเร็จ';
}

header('Location: /profile');
exit;
