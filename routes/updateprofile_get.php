<?php
$UserID = $_SESSION['UserID'];
$User = getUserById($UserID);
renderView('updateprofile_get', ['User' => $User]);
