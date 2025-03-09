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
    } else {
        $data = [
            'activity' => $activity,
            'UserID' => null
        ];
    }
    return $data;
}

function getactivityByActID($ActID)
{
    $conn = getConnection();
    $sql = "SELECT a.*, u.name FROM activity a 
    JOIN user u ON a.CreateBy = u.UserID 
    WHERE ActID = ?";
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

function getCreatedActivitiesByUserId($UserID)
{
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

function dropActivity($ActID, $CreateBy): bool
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

function updateActivity($ActID, $Title, $Description, $Location, $ImageURL, $StartDate, $EndDate, $Max, $Status, $CreateBy): bool
{
    $conn = getConnection();
    $sql = 'UPDATE activity SET Title = ?, Description = ?, Location = ?, ImageURL = ?, StartDate = ?, EndDate = ?, Max = ?, Status = ? WHERE ActID = ? AND CreateBy = ?';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ssssssiisi', $Title, $Description, $Location, $ImageURL, $StartDate, $EndDate, $Max, $Status, $ActID, $CreateBy);
    if ($stmt->execute()) {
        $stmt->close();
        $conn->close();
        return true;
    } else {
        error_log("Error updating activity: " . $stmt->error);
        $stmt->close();
        $conn->close();
        return false;
    }
}

function SearchBykeyword()
{
    if (!isset($_POST['keyword']) || $_POST['keyword'] == '') {
        return getactivity();
    } else {
        return getactivityByKeyword($_POST['keyword']);
    }
}
function SearchBydate()
{
    if (!isset($_POST['startDate']) || $_POST['startDate'] == '' || !isset($_POST['endDate']) || $_POST['endDate'] == '') {
        return getactivity();
    } elseif ($_POST['startDate'] > $_POST['endDate']) {
        return []; // คืนค่าเป็นอาร์เรย์ว่างถ้าช่วงวันที่ผิด
    } else {
        return getactivityByDate($_POST['startDate'], $_POST['endDate']);
    }
}

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
}
function getactivityByDate(string $startDate, string $endDate): array
{
    $conn = getConnection();
    $sql = "SELECT a.*, u.name as CreateByName 
            FROM activity a 
            JOIN user u ON a.CreateBy = u.UserID
            WHERE (a.startDate BETWEEN ? AND ?)";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ss', $startDate, $endDate);
    $stmt->execute();
    $result = $stmt->get_result();
    $activity = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
    $conn->close();

    return [
        'activity' => $activity,
        'UserID' => $_SESSION['UserID'] ?? null
    ];
}

function searchActivity(string $search, $startDate = null, $endDate = null): array
{
    $conn = getConnection();
    $sql = "SELECT a.*, u.name as CreateByName 
    FROM activity a 
    JOIN user u ON a.CreateBy = u.UserID
    WHERE a.Title LIKE ?";
    $params = [];
    $types = "s";
    
    // เพิ่ม wildcard (%) เพื่อให้ค้นหาได้ถูกต้อง
    $search = "%" . $search . "%";
    $params[] = $search;

    if (!empty($startDate) && !empty($endDate)) {
        $sql .= " AND date BETWEEN ? AND ?";
        $params[] = $startDate;
        $params[] = $endDate;
        $types .= "ss";
    }

    $stmt = $conn->prepare($sql);
    $stmt->bind_param($types, ...$params);
    $stmt->execute();
    $result = $stmt->get_result();

    return $result->fetch_all(MYSQLI_ASSOC);
}