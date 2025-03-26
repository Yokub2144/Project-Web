<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['ActID'])) {
        $ActID = $_POST['ActID'];
        $activityData = getactivityByActID($ActID);

        // ดึงข้อมูลกิจกรรมทั้งหมดเพื่อใช้รูปภาพ (ถ้าจำเป็น)
        $allActivities = getactivity();
        
        // หารูปภาพจากกิจกรรมทั้งหมดในกรณีที่ activityData ไม่มี ImageURL
        if (!isset($activityData['ImageURL']) || empty($activityData['ImageURL'])) {
            foreach ($allActivities['activity'] as $activity) {
                if ($activity['ActID'] == $ActID && isset($activity['ImageURL'])) {
                    $activityData['ImageURL'] = $activity['ImageURL'];
                    break;
                }
            }
        }

        if (isset($_SESSION['UserID'])) {
            $UserID = $_SESSION['UserID'];
            renderView('detalis_get', [
                'activity' => $activityData,
                'UserID' => $UserID
            ]);
        } else {
            renderView('detalis_get', [
                'activity' => $activityData
            ]);
        }
    } else {
        // Handle the case where ActID is not provided
        echo "Activity ID is missing.";
    }
}