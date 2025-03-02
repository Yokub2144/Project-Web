<?php

$result = getUserById($_SESSION['UserID']);
$registration = getUserEnrollmentByUserId($_SESSION['UserID']);
// heekuyted
renderView('profile_get',['result' => $result, 'registration' => $registration]);