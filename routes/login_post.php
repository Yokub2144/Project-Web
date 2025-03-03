<?php
$email = $_POST['email'];
$password = $_POST['password'];
$result = login( $email, $password);

if($result){
    $User = getUserById($result['UserID']);
    $unix_timestamp = time();
    $_SESSION['timestamp'] = $unix_timestamp;
    $_SESSION['UserID'] = $result['UserID'];
    $activityData = getactivity();
    renderView('homeactivity_get', ['UserID' => $result['UserID'], 'activity' => $activityData['activity']]);
}else{
    $_SESSION['message'] = 'Email or Password invalid';
    renderView('login_get');
    unset($_SESSION['message']);
    unset($_SESSION['timestamp']);
}
