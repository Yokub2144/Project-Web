<?php
if (!isset($_SESSION['UserID'])) {
    $_SESSION['alert'] = 'กรุณาเข้าสู่ระบบก่อน';
    header('Location: /homeactivity');
    exit;
} else {
    $UserID = (int)$_POST['UserID'];
    $ActID = (int)$_POST['ActID'];
    $status = $_POST['Actstatus'];
    $regstatus = $_POST['regstatus'];

    if (isset($_POST['register'])) {
        if ($status === 'Active') {
            if (enrollActivity($UserID, $ActID, $regstatus)) {
                $data = ['alert' => 'ลงทะเบียนสำเร็จ'];
            } else {
                $data = ['alert' => 'มีอยู่ในรายการลงทะเบียนแล้ว'];
            }
        } else {
            $data = ['alert' => 'กิจกรรมนี้ยังไม่เปิดรับการลงทะเบียน'];
        }
    }

    header('Location: /profile');
    exit;
}

