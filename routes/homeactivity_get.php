<?php


$activityData = getactivity();
$UserID = $_SESSION['UserID']; 

renderView('homeactivity_get', [
    'activity' => $activityData['activity'],
    'UserID' => $UserID
]);