<?php
$email = $_POST['email'];
$password = $_POST['password'];
$result = login( $email, $password);

if($result){
    $student = getUserById($result['UserID']);
    $unix_timestamp = time();
    $_SESSION['timestamp'] = $unix_timestamp;
    $_SESSION['UserID'] = $result['UserID'];
    renderView('homeactivity_get', ['result' => $student]);
}else{
    $_SESSION['message'] = 'Email or Password invalid';
    renderView('login_get');
    unset($_SESSION['message']);
    unset($_SESSION['timestamp']);
}
