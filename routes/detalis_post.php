<?php
if (isset($_POST['detalis'])) {

    if (isset($_POST['ActID'])) {
        $ActID = $_POST['ActID'];
        $activityData = getactivityByActID($ActID);


        
        if (isset($_SESSION['UserID'])) {
            $UserID = $_SESSION['UserID'];
            renderView('detalis_get', ['activity' => $activityData, 'UserID' => $UserID]);
        } else {
            renderView('detalis_get', ['activity' => $activityData]);
        }
    } else {
        // Handle the case where ActID is not provided
        echo "Activity ID is missing.";
    }
}

if(isset($_POST['reg']))
{
    $UserID = $_SESSION['UserID'];
    $ActID = $_POST['ActID'];
    $actstatus = $_POST['Status'];
   
    if ($actstatus === 'Active') {
        if (enrollActivity($UserID, $ActID, $actstatus)) {
            $_SESSION['alert'] = 'ลงทะเบียนสำเร็จ';
        } else {
            $_SESSION['alert'] = 'มีอยู่ในรายการลงทะเบียนแล้ว';
        }
    } else {
        $_SESSION['alert'] = 'กิจกรรมนี้ยังไม่เปิดรับการลงทะเบียน';
    }
    header('Location: /homeactivity');
    exit;
}