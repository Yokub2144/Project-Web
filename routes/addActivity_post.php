<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $Title = $_POST['Title'];
    $Description = $_POST['Description'];
    $Location = $_POST['Location'];
    $ImageURL = $_POST['ImageURL'];
    $StartDate = $_POST['StartDate'];
    $EndDate = $_POST['EndDate'];
    $Max = (int)$_POST['Max'];
    $CreateBy = $_SESSION['UserID']; // Assuming you store UserID in session
    $Status = $_POST['Status'];
    $result = insertActivity($Title, $Description, $Location, $ImageURL, $StartDate, $EndDate, $Max, $CreateBy, $Status);
    if ($result) {
        $_SESSION['alert'] = 'เพิ่มกิจกรรมสำเร็จ';
    } else {
        $_SESSION['alert'] = 'เกิดข้อผิดพลาดในการเพิ่มกิจกรรม';
    }

    header('Location: /homeactivity');
    exit;
}
