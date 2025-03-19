<?php
$UserID = $_SESSION['UserID'];

renderView('addactivity_get', ['UserID' => $UserID]);
?>