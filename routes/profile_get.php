<?php

$result = getUserById($_SESSION['student_id']);
$registration = getUserEnrollmentByUserId($_SESSION['student_id']);

renderView('profile_get',['result' => $result, 'registration' => $registration]);