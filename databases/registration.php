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

function updatestatic($ActID)
{
    $conn = getConnection();

    // Count genders
    $sqlGender = "SELECT
                SUM(CASE WHEN u.Gender = 'Male' THEN 1 ELSE 0 END) AS MaleCount,
                SUM(CASE WHEN u.Gender = 'Female' THEN 1 ELSE 0 END) AS FemaleCount
            FROM registration r
            JOIN user u ON r.UserID = u.UserID
            WHERE r.ActID = ?";

    // Count age groups
    $sqlAge = "SELECT
                SUM(CASE WHEN u.Age < 18 THEN 1 ELSE 0 END) AS Under18Count,
                SUM(CASE WHEN u.Age >= 18 THEN 1 ELSE 0 END) AS Over18Count
            FROM registration r
            JOIN user u ON r.UserID = u.UserID
            WHERE r.ActID = ?";

    // Count total participants
    $sqlTotal = "SELECT COUNT(*) AS TotalParticipants FROM registration WHERE ActID = ?";

    // Prepare and execute gender query
    $stmtGender = $conn->prepare($sqlGender);
    if ($stmtGender === false) {
        error_log("Prepare gender failed: " . $conn->error);
        return false;
    }
    $stmtGender->bind_param('i', $ActID);
    if ($stmtGender->execute() === false) {
        error_log("Execute gender failed: " . $stmtGender->error);
        return false;
    }
    $resultGender = $stmtGender->get_result();
    if ($resultGender === false) {
        error_log("Get result gender failed: " . $stmtGender->error);
        return false;
    }
    $genderCounts = $resultGender->fetch_assoc();
    $stmtGender->close();

    // Prepare and execute age query
    $stmtAge = $conn->prepare($sqlAge);
    if ($stmtAge === false) {
        error_log("Prepare age failed: " . $conn->error);
        return false;
    }
    $stmtAge->bind_param('i', $ActID);
    if ($stmtAge->execute() === false) {
        error_log("Execute age failed: " . $stmtAge->error);
        return false;
    }
    $resultAge = $stmtAge->get_result();
    if ($resultAge === false) {
        error_log("Get result age failed: " . $stmtAge->error);
        return false;
    }
    $ageCounts = $resultAge->fetch_assoc();
    $stmtAge->close();

    // Prepare and execute total query
    $stmtTotal = $conn->prepare($sqlTotal);
    if ($stmtTotal === false) {
        error_log("Prepare total failed: " . $conn->error);
        return false;
    }
    $stmtTotal->bind_param('i', $ActID);
    if ($stmtTotal->execute() === false) {
        error_log("Execute total failed: " . $stmtTotal->error);
        return false;
    }
    $resultTotal = $stmtTotal->get_result();
    if ($resultTotal === false) {
        error_log("Get result total failed: " . $stmtTotal->error);
        return false;
    }
    $totalCounts = $resultTotal->fetch_assoc();
    $stmtTotal->close();

    // Check if a record exists for this ActID in the static table
    $sqlCheck = "SELECT COUNT(*) AS count FROM activity_static WHERE ActID = ?";
    $stmtCheck = $conn->prepare($sqlCheck);
    if ($stmtCheck === false) {
        error_log("Prepare check failed: " . $conn->error);
        return false;
    }
    $stmtCheck->bind_param('i', $ActID);
    if ($stmtCheck->execute() === false) {
        error_log("Execute check failed: " . $stmtCheck->error);
        return false;
    }
    $resultCheck = $stmtCheck->get_result();
    if ($resultCheck === false) {
        error_log("Get result check failed: " . $stmtCheck->error);
        return false;
    }
    $checkResult = $resultCheck->fetch_assoc();
    $stmtCheck->close();

    // Prepare the SQL query for inserting or updating data
    if ($checkResult['count'] > 0) {
        // Update existing record
        $sql = "UPDATE statistics SET TotalMale = ?, TotalFeMale = ?, Under18 = ?, Over18 = ?, Total = ? WHERE ActID = ?";
        $stmt = $conn->prepare($sql);
        if ($stmt === false) {
            error_log("Prepare update failed: " . $conn->error);
            return false;
        }
        $stmt->bind_param('iiiiii', $genderCounts['MaleCount'], $genderCounts['FemaleCount'], $ageCounts['Under18Count'], $ageCounts['Over18Count'], $totalCounts['TotalParticipants'], $ActID);
    } else {
        // Insert new record
        $sql = "INSERT INTO activity_static (ActID, MaleCount, FemaleCount, Under18Count, Over18Count, TotalParticipants) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        if ($stmt === false) {
            error_log("Prepare insert failed: " . $conn->error);
            return false;
        }
        $stmt->bind_param('iiiiii', $ActID, $genderCounts['MaleCount'], $genderCounts['FemaleCount'], $ageCounts['Under18Count'], $ageCounts['Over18Count'], $totalCounts['TotalParticipants']);
    }

    // Execute the insert or update query
    if ($stmt->execute() === false) {
        error_log("Execute failed: " . $stmt->error);
        $stmt->close();
        $conn->close();
        return false;
    }

    $stmt->close();
    $conn->close();
    return true;
}
