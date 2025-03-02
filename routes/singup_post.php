<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // แฮชรหัสผ่าน
    $phone = $_POST['phone'];
    $gender = $_POST['gender'];
    $age = (int)$_POST['age'];
    $imageProfileURL = $_POST['imageProfileURL'];
    $result = insertUser($name, $email, $password, $phone, $gender, $age, $imageProfileURL);
    if ($result) {
        $_SESSION['alert'] = 'สมัครสมาชิกสำเร็จ';
        header('Location: /login');
    } else {
        $_SESSION['alert'] = 'เกิดข้อผิดพลาดในการสมัครสมาชิก';
        header('Location: /singup');
    }
}
