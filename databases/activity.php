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
function generateRandomCode($length = 6) {
    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $charactersLength = strlen($characters);
    $randomCode = '';
    for ($i = 0; $i < $length; $i++) {
        $randomCode .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomCode;
}
function saveActivityCode($ActID, $code) {
    $filePath = __DIR__ . '/activity_codes.php';

    // อ่านข้อมูลจากไฟล์ PHP
    $data = include $filePath;

    // เพิ่มหรืออัปเดตรหัสสำหรับกิจกรรม
    $data[$ActID] = $code;

    // เขียนข้อมูลกลับไปยังไฟล์ PHP
    $content = "<?php\nreturn " . var_export($data, true) . ";\n";
    file_put_contents($filePath, $content);
}

function getActivityCode($ActID) {
    $filePath = __DIR__ . '/activity_codes.php';

    // อ่านข้อมูลจากไฟล์ PHP
    $data = include $filePath;

    // คืนค่ารหัสของกิจกรรม ถ้ามี
    return $data[$ActID] ?? null;
}

function generateAndSaveActivityCode($ActID, $length = 6) {
    $code = generateRandomCode($length);
    saveActivityCode($ActID, $code);
    return $code;
}

function updateActivityStatic($ActID) {
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
        $sql = "UPDATE activity_static SET MaleCount = ?, FemaleCount = ?, Under18Count = ?, Over18Count = ?, TotalParticipants = ? WHERE ActID = ?";
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