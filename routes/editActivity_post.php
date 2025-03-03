<?php
$Actid = $_POST['ActID'];
$Title = $_POST['Title'];
$Description = $_POST['Description'];
$Location = $_POST['Location'];
$ImageURL = $_POST['ImageURL'];
$StartDate = $_POST['StartDate'];
$EndDate = $_POST['EndDate'];
$Max = $_POST['Max'];
$Status = $_POST['Status'];
$CreateBy = $_SESSION['UserID'];

$result = updateActivity($Actid, $Title, $Description, $Location, $ImageURL, $StartDate, $EndDate, $Max, $Status, $CreateBy);
if ($result) {
    $_SESSION['alert'] = 'แก้ไขกิจกรรมสำเร็จ' ;
} else {
    $_SESSION['alert'] = 'เกิดข้อผิดพลาดในการแก้ไขกิจกรรม';
}

header('Location: /profile');
exit;