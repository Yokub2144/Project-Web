<?php


$activityData = getactivity();

if(isset($_SESSION['UserID'])){
    $UserID = $_SESSION['UserID']; 
    renderView('homeactivity_get', ['activity' => $activityData['activity'],'UserID' => $UserID]);
}else{
renderView('homeactivity_get', ['activity' => $activityData['activity']
]);
}
