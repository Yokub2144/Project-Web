<?php
$search = isset($_Post['search']) ? $_Post['search'] : '';
$startDate = isset($_Post['startDate']) ? $_Post['startDate'] : '';
$endDate = isset($_Post['endDate']) ? $_Post['endDate'] : '';
$registrations = getUserEnrollmentByUserId($_SESSION['UserID']);
if (!isset($_SESSION['UserID'])) {
    if (!empty($search) || (!empty($startDate) && !empty($endDate))) {
        $result = searchActivity($search, $startDate, $endDate);
    } else {
        $result = getactivity();
        renderView('search_get', ['result' => $result]);
    }
}else{
    if (!empty($search) || (!empty($startDate) && !empty($endDate))) {
        $result = searchActivity($search, $startDate, $endDate);
    } else {
        $result = getactivity();
        renderView('search_get', ['result' => $result, 'registrations' => $registrations]);
    }
}



