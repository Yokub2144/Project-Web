<?php

function getConnection():mysqli
{
    $hostname = 'localhost';
    $dbName = 'eventmanagement';
    $username = 'admin';
    $password = 'admin';
    $conn = new mysqli($hostname, $username, $password, $dbName);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    return $conn;
}

require_once DATABASE_DIR . '/user.php';
require_once DATABASE_DIR . '/authen.php';
require_once DATABASE_DIR . '/activity.php';
require_once DATABASE_DIR . '/registration.php';