<?php

// function getCourses(): mysqli_result|bool
// {
//     $conn = getConnection();
//     $sql = 'select * from courses';
//     $result = $conn->query($sql);
//     return $result;
// }

function getUserEnrollmentByUserId(int $UserID): mysqli_result|bool
{
    $conn = getConnection();
    $sql = 'SELECT
    a.Title,
    a.CreateBy,
    a.Max,
    a.StartDate,
    a.EndDate,
    a.Status AS ActivityStatus,
    u.UserId,
    u.Name AS UserName,
    u.Email,
    u.Phone,
    u.Gender,
    u.Age,
    r.ActID,
    r.Status AS RegistrationStatus,
    r.CheckedIn,
    creator.Name AS CreatorName
    FROM
    eventmanagement.activity a
    INNER JOIN eventmanagement.registration r ON
    a.ActID = r.ActID 
    INNER JOIN eventmanagement.user u ON
    r.UserID = u.UserID
    INNER JOIN eventmanagement.user creator ON
    a.CreateBy = creator.UserID
    WHERE u.UserID = ?';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $UserID);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result;
}

function enrollActivity(int $UserID, int $ActID, string $Status): bool
{
    $conn = getConnection();
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $check_sql = 'SELECT * FROM registration WHERE UserID = ? AND ActID = ?';
    $check_stmt = $conn->prepare($check_sql);
    $check_stmt->bind_param('ii', $UserID, $ActID);
    $check_stmt->execute();
    $check_result = $check_stmt->get_result();

    if ($check_result->num_rows > 0) {
        // มีการลงทะเบียนกิจกรรมนี้อยู่แล้ว
        $_SESSION['alert'] = 'มีการลงทะเบียนกิจกรรมนี้อยู่แล้ว';
        $check_stmt->close();
        $conn->close();

        return false;
    }

    $sql = 'INSERT INTO registration (UserID, ActID, Status) VALUES (?, ?, ?)';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('iis', $UserID, $ActID, $Status);

    if ($stmt->execute()) {
        $stmt->close();
        $conn->close();
        return true;
    } else {
        error_log("Error enrolling course: " . $stmt->error);
        $stmt->close();
        $conn->close();
        return false;
    }
}
function dropregistration($UserID, $ActID): bool
{
    $conn = getConnection();
    $sql = 'DELETE FROM registration WHERE UserID = ? AND ActID = ?';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ii', $UserID, $ActID);
    if ($stmt->execute()) {
        $stmt->close();
        $conn->close();
        return true;
    } else {
        error_log("Error dropping course: " . $stmt->error);
        $stmt->close();
        $conn->close();
        return false;
    }
}
function joinActivity($ActID) {
    $conn = getConnection();
    $sql = "SELECT u.UserID, u.Name, u.Email, u.Age, r.Status, r.ActID
            FROM user u 
            JOIN registration r ON u.UserID = r.UserID 
            WHERE r.ActID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $ActID);
    $stmt->execute();
    $result = $stmt->get_result();
    $users = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
    $conn->close();
    return $users;
}
function updateRegistrationStatus($UserID, $ActID, $Status): bool
{
    $conn = getConnection();
    $sql = 'UPDATE registration SET Status = ? WHERE UserID = ? AND ActID = ?';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sii', $Status, $UserID, $ActID);
    if ($stmt->execute()) {
        $stmt->close();
        $conn->close();
        return true;
    } else {
        error_log("Error updating registration status: " . $stmt->error);
        $stmt->close();
        $conn->close();
        return false;
    }
}
function updateCheckInStatus($UserID, $ActID, $CheckedIn): bool
{
    $conn = getConnection();
    $sql = 'UPDATE registration SET CheckedIn = ? WHERE UserID = ? AND ActID = ?';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('iii', $CheckedIn, $UserID, $ActID);
    if ($stmt->execute()) {
        $stmt->close();
        $conn->close();
        return true;
    } else {
        error_log("Error updating check-in status: " . $stmt->error);
        $stmt->close();
        $conn->close();
        return false;
    }
}