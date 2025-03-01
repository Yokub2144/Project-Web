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

    $data = [
        'activity' => $activity,
        'UserID' => $_SESSION['UserID'] // Assuming you store UserID in session
    ];
    return $data;
}


function dropActivity($UserID, $ActID): bool
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
