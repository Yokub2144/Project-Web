<?php
echo "<script>";
if (isset($_SESSION['alert']) && !empty($_SESSION['alert'])) {
    if ($_SESSION['alert'] === 'ลงทะเบียนสำเร็จ') {
        echo "alert('" . $_SESSION['alert'] . "');";
    } elseif ($_SESSION['alert'] === 'มีวิชานี้อยู่ในรายการลงทะเบียนแล้ว') {
        echo "alert('" . $_SESSION['alert'] . "');";
    } elseif ($_SESSION['alert'] === 'ถอนรายวิชาสำเร็จ') {
        echo "alert('" . $_SESSION['alert'] . "');";
    } else {
        echo "alert('" . $_SESSION['alert'] . "');";
    }
    unset($_SESSION['alert']);
} 
echo "</script>";
?>


<section>
    <h2>ข้อมูลนักเรียน</h2>
    <table border="1">
        <tr>
            <th>ชื่อ</th>
            <td><?= htmlspecialchars($data['result']['first_name']) ?></td>
        </tr>
        <tr>
            <th>นามสกุล</th>
            <td><?= htmlspecialchars($data['result']['last_name']) ?></td>
        </tr>
        <tr>
            <th>วันเกิด</th>
            <td><?= htmlspecialchars($data['result']['date_of_birth']) ?></td>
        </tr>
        <tr>
            <th>เบอร์โทรศัพท์</th>
            <td><?= htmlspecialchars($data['result']['phone_number']) ?></td>
        </tr>
    </table>

    <h2>วิชาที่ลงทะเบียนเรียน</h2>
    <table border="1">
        <thead>
            <tr>
                <th>รหัสวิชา</th>
                <th>ชื่อวิชา</th>
                <th>อาจารย์ผู้สอน</th>
                <th>วันที่ลงทะเบียน</th>
                <th>ถอนรายวิชา</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data['enrollments'] as $enrollment): ?>
                <tr>
                    <td><?= htmlspecialchars($enrollment['course_code']) ?></td> 
                    <td><?= htmlspecialchars($enrollment['course_name']) ?></td>
                    <td><?= htmlspecialchars($enrollment['instructor']) ?></td>
                    <td><?= htmlspecialchars($enrollment['enrollment_date']) ?></td>
                    <td>
                        <form action="/profile" method="post">
                        
                              
                              <input type="hidden" name="student_id" value="<?= $data['result']['student_id'] ?>">
                             <input type="hidden" name="course_id" value="<?= htmlspecialchars($enrollment['course_id']) ?>">
                            
                            <button type="submit"onclick="return confirmdelete()">ถอนรายวิชา </button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</section>


