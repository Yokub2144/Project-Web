<?php
declare(strict_types=1);

if (!isset($_GET['keyword'])) {
    $result = getactivity();
    $registrations = getUserEnrollmentByUserId($_SESSION['UserID']);
    renderView('search_get', array('result' => $result, 'registrations' => $registrations));
} elseif ($_GET['keyword'] == '') {
    $result = getactivity();
    $registrations = getUserEnrollmentByUserId($_SESSION['UserID']);
    renderView('search_get', array('result' => $result, 'registrations' => $registrations));
} else {
    $result = getactivityByKeyword($_GET['keyword']);
    $registrations = getUserEnrollmentByUserId($_SESSION['UserID']);
    renderView('search_get', array('result' => $result, 'registrations' => $registrations));
}