<?php


$activityData = getactivity();
$UserID = $_SESSION['UserID']; 

renderView('activity_get', [
    'activity' => $activityData['activity'],
    'UserID' => $UserID
]);