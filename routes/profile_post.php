<?php

$UserID = (int)$_POST['UserID'];
$ActID = (int)$_POST['ActID'];

if (isset($_POST['cancel'])) {
    if (dropregistration($UserID, $ActID)) {
        $_SESSION['alert'] = 'ยกเลิกการเข้าร่วมกิจกรรมสำเร็จ';
    } else {
        $_SESSION['alert'] = 'เกิดข้อผิดพลาดในการยกเลิกการเข้าร่วมกิจกรรม';
    }
    header('Location: /profile');
exit;
}
if(isset($_POST['check']))
{
    $status = $_POST['Actstatus'];
    $regstatus = $_POST['regstatus'];
    if ($status === 'Active') {
        if (updateCheckInStatus($UserID, $ActID, $regstatus)) { 
            $_SESSION['alert'] = 'เช็คอินสำเร็จ';
        } else {
            $_SESSION['alert'] = 'เช็คอินไม่สำเร็จ';
        }
    } else {
        $_SESSION['alert'] = 'กิจกรรมนี้ยังไม่เปิดรับการลงทะเบียน';
    }
    header('Location: /profile');
    exit;
}
