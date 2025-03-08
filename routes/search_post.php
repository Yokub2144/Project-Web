<?php
if (!isset($_SESSION['UserID'])) {
   if (isset($_POST['keyword'])) {
    $result = SearchBykeyword();
    renderView('search_get', ['result' => $result]);
   } else if (isset($_POST['startDate']) && isset($_POST['endDate'])) {
    $result = SearchBydate();
    renderView('search_get', ['result' => $result]);
   } else {
    $result = getactivity();
    renderView('search_get', ['result' => $result]);
   }
} else {
    if (isset($_POST['keyword'])) {
        $result = SearchBykeyword();
        $registrations = getUserEnrollmentByUserId($_SESSION['UserID']);
        renderView('search_get', ['result' => $result, 'registrations' => $registrations]);
       } else if (isset($_POST['startDate']) && isset($_POST['endDate'])) {
        $result = SearchBydate();
        $registrations = getUserEnrollmentByUserId($_SESSION['UserID']);
        renderView('search_get', ['result' => $result, 'registrations' => $registrations]);
       } else {
        $result = getactivity();
        $registrations = getUserEnrollmentByUserId($_SESSION['UserID']);
        renderView('search_get', ['result' => $result, 'registrations' => $registrations]);
       }
}