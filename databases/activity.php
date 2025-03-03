<?php

function getactivity(): array
{
    $conn = getConnection();
    $sql = "SELECT a.*, u.name as CreateByName 
    FROM activity a 
    JOIN user u ON a.CreateBy = u.UserID";
    $result = $conn->query($sql);
    $result = $conn->query($sql);
    $activity = $result->fetch_all(MYSQLI_ASSOC);
    if (isset($_SESSION['UserId'])) {
        $data = [
            'activity' => $activity,
            'UserID' => $_SESSION['UserID'] // Assuming you store UserID in session
        ];
        
    }else{
        $data = [
            'activity' => $activity,
            'UserID' => null
        ];
    }
    return $data;
}
function getactivityByActID($ActID) {
    $conn = getConnection();
    $sql = "SELECT * FROM activity WHERE ActID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $ActID);
    $stmt->execute();
    $result = $stmt->get_result();
    $activity = $result->fetch_assoc();
    $stmt->close();
    $conn->close();
    return $activity;
}

function insertActivity($Title, $Description, $Location, $ImageURL, $StartDate, $EndDate, $Max, $CreateBy, $Status): bool
{
    $conn = getConnection();
    $sql = 'INSERT INTO activity (Title, Description, Location, ImageURL, StartDate, EndDate, Max, CreateBy, Status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ssssssiis', $Title, $Description, $Location, $ImageURL, $StartDate, $EndDate, $Max, $CreateBy, $Status);
    if ($stmt->execute()) {
        $stmt->close();
        $conn->close();
        return true;
    } else {
        error_log("Error inserting course: " . $stmt->error);
        $stmt->close();
        $conn->close();
        return false;
    }
}
function getCreatedActivitiesByUserId($UserID) {
    $conn = getConnection();
    $sql = "SELECT * FROM activity WHERE CreateBy = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $UserID);
    $stmt->execute();
    $result = $stmt->get_result();
    $activities = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
    $conn->close();
    return $activities;
}

function dropAvtivity($ActID, $CreateBy): bool
{
    $conn = getConnection();
    $sql = 'DELETE FROM activity WHERE ActID = ? and CreateBy = ?';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ii', $ActID, $CreateBy);
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

<<<<<<< HEAD
function updateActivity($ActID, $Title, $Description, $Location, $ImageURL, $StartDate, $EndDate, $Max, $Status, $CreateBy) {
    $conn = getConnection();
    $sql = "UPDATE activity SET 
            Title = ?, 
            Description = ?, 
            Location = ?, 
            ImageURL = ?, 
            StartDate = ?, 
            EndDate = ?, 
            Max = ?, 
            Status = ? 
            WHERE ActID = ? AND CreateBy = ?";
    $stmt = $conn->prepare($sql);
    
    if (!$stmt) {
        error_log("SQL Error: " . $conn->error); // บันทึกข้อผิดพลาด SQL
        return false;
    }
    
    $stmt->bind_param('ssssssiisi', $Title, $Description, $Location, $ImageURL, $StartDate, $EndDate, $Max, $Status, $ActID, $CreateBy);
    $stmt->execute();
    
    // ตรวจสอบว่ามีแถวที่ถูกอัปเดตหรือไม่
    $affectedRows = $stmt->affected_rows;
    $stmt->close();
    $conn->close();
    
    return $affectedRows > 0; // คืนค่า true ถ้ามีแถวที่ถูกอัปเดต
=======
function getactivityByKeyword(string $keyword): array
{
    $conn = getConnection();
    $sql = "SELECT a.*, u.name as CreateByName 
            FROM activity a 
            JOIN user u ON a.CreateBy = u.UserID
            WHERE a.Title LIKE ?";
    $stmt = $conn->prepare($sql);
    $keyword = '%' . $keyword . '%';
    $stmt->bind_param('s', $keyword);
    $stmt->execute();
    $result = $stmt->get_result();
    $activity = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
    $conn->close();

    if (isset($_SESSION['UserId'])) {
        return [
            'activity' => $activity,
            'UserID' => $_SESSION['UserID']
        ];
    } else {
        return [
            'activity' => $activity,
            'UserID' => null
        ];
    }
>>>>>>> a0a2ff13dc0c499e40315c76763de2712406c228
}