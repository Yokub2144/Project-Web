<?php

$UserID = $_SESSION['UserID'];
$result = getUserById($UserID);
$registration = getUserEnrollmentByUserId($UserID);
$createdActivities = getCreatedActivitiesByUserId($UserID);

renderView('profile_get', ['result' => $result, 'registration' => $registration, 'createdActivities' => $createdActivities]);
?>