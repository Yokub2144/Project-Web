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
    $sql = "SELECT ActID, Title, StartDate, EndDate, Status FROM activity WHERE CreateBy = ?";
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
    $sql = 'DELETE FROM Activity WHERE ActID = ? and CreateBy = ?';
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