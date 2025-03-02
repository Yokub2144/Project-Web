<?php
$UserID = $_SESSION['UserID'];

renderView('addActivity_get', ['UserID' => $UserID]);
?>