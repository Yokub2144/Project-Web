<?php

function getuser(): mysqli_result|bool
{
    $conn = getConnection();
    $sql = 'select * from user';
    $result = $conn->query($sql);
    return $result;
}

function getUserById(int $id): array|bool
{
    $conn = getConnection();
    $sql = 'select * from user where UserId = ?';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows == 0) {
        return false;
    }
    return $result->fetch_assoc();
}

function updatePassword($new_password, $UserId): void
{

    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
    $sql = "UPDATE user SET password = ? WHERE UserId = ?";
    try {
        $conn = getConnection();
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('si', $hashed_password, $UserId);

        $stmt->execute();

        echo "<script>alert('อัพเดทรหัสผ่านสำเร็จ');</script>";
        header("Location: /login");
    } catch (PDOException $e) {
        echo "เกิดข้อผิดพลาด: " . $e->getMessage();
    }
}
function insertUser($name, $email, $password, $phone, $gender, $age, $imageProfileURL): bool
{
    $conn = getConnection();
    $conn->query("alter table user AUTO_INCREMENT = 1");
    $sql = 'INSERT INTO user (name, email, password, phone, gender, age, imageProfileURL) VALUES (?, ?, ?, ?, ?, ?, ?)';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sssssis', $name, $email, $password, $phone, $gender, $age, $imageProfileURL);

    if ($stmt->execute()) {
        $stmt->close();
        $conn->close();
        return true;
    } else {
        error_log("Error inserting user: " . $stmt->error);
        $stmt->close();
        $conn->close();
        return false;
    }
}
function updateUser(int $userId, string $name, string $email, string $phone, string $gender, int $age, ?string $imageProfileURL = null): bool
{
    $conn = getConnection();
    
    // เตรียมคำสั่ง SQL
    if ($imageProfileURL !== null) {
        $sql = 'UPDATE user SET name = ?, email = ?, phone = ?, gender = ?, age = ?, imageProfileURL = ? WHERE UserId = ?';
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ssssisi', $name, $email, $phone, $gender, $age, $imageProfileURL, $userId);
    } else {
        $sql = 'UPDATE user SET name = ?, email = ?, phone = ?, gender = ?, age = ? WHERE UserId = ?';
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ssssii', $name, $email, $phone, $gender, $age, $userId);
    }

    if ($stmt->execute()) {
        $stmt->close();
        $conn->close();
        return true;
    } else {
        error_log("Error updating user: " . $stmt->error);
        $stmt->close();
        $conn->close();
        return false;
    }
}
