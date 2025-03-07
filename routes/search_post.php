<?php
if (!isset($_SESSION['UserID'])) {
   
    $result = handleSearch();
    renderView('search_get', ['result' => $result]);
} else {
    
    $result = handleSearch();
    $registrations = getUserEnrollmentByUserId($_SESSION['UserID']);
    renderView('search_get', ['result' => $result, 'registrations' => $registrations]);
}