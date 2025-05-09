<?php

function login(String $username, String $password): array|bool
{
    $conn = getConnection();
    $sql = 'select * from user where email = ?';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    if($result->num_rows == 0)
    {
        return false;
    }
    $row = $result->fetch_assoc();

    if(password_verify($password, $row['Password']))
    {
        return $row;
    }else
    {
        return false;
    }
}



function logout():void
{
    unset($_SESSION['timestamp']);
    unset($_SESSION['UserID']);
}
