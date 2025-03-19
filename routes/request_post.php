<?php
$UserID = (int)$_POST['UserID'];
$ActID = (int)$_POST['ActID'];
$Status = $_POST['Status'];
$result = updateRegistrationStatus($UserID, $ActID, $Status);
if ($result) {
    $_SESSION['alert'] = 'อัพเดทสถานะการลงทะเบียนสำเร็จ';
} else {
    $_SESSION['alert'] = 'อัพเดทสถานะการลงทะเบียนไม่สำเร็จ';
}
renderView('request_get', ['ActID' => $ActID]);