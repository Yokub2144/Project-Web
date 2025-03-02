<?php

$result = getUserById($_SESSION['UserID']);
$registration = getUserEnrollmentByUserId($_SESSION['UserID']);

renderView('profile_get',['result' => $result, 'registration' => $registration]);