<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

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

