<?php

function getCourses(): mysqli_result|bool
{
    $conn = getConnection();
    $sql = 'select * from activity';
    $result = $conn->query($sql);
    return $result;
}
function enrollActivity(int $UserID, int $ActID, String $Status, bool $Checkedin): bool
{
    $conn = getConnection();
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $check_sql = 'SELECT * FROM registration WHERE $UserID = ? AND $ActID = ?';
    $check_stmt = $conn->prepare($check_sql);
    $check_stmt->bind_param('ii', $UserID, $ActID);
    $check_stmt->execute();
    $check_result = $check_stmt->get_result();

    if ($check_result->num_rows > 0) {
        // มีการลงทะเบียนวิชานี้อยู่แล้ว
        $_SESSION['alert'] = 'มีวิชานี้อยู่ในรายการลงทะเบียนแล้ว';
        $check_stmt->close();
        $conn->close();
      
        return false;
    }

    $sql = 'INSERT INTO registration (UserID, AvtID, Status, Checckedin) VALUES (?, ?, ?, ?)';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ii', $UserID, $ActID, $Status, $Checkedin);

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
function dropcourse($UserID, $ActID):bool
{
      
        $conn = getConnection();
        $sql = 'DELETE FROM enrollment WHERE student_id = ? AND course_id = ?';
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ii', $student_id, $course_id);
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