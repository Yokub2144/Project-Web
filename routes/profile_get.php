<?php

$UserID = $_SESSION['UserID'];
$User = getUserById($UserID);
$registration = getUserEnrollmentByUserId($UserID);
$createdActivities = getCreatedActivitiesByUserId($UserID);

renderView('profile_get', ['User' => $User, 'registration' => $registration, 'createdActivities' => $createdActivities]);
?>