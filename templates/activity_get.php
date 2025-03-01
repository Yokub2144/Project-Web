<?php
$activity = $data['activity']; // รับค่า activities จาก controller
$UserID = $data['UserID']; // รับค่า student_id จาก controller
?>

<h2>รายการกิจกรรม</h2>
<table border="1">
    <thead>
        <tr>
            <th>ชื่อกิจกรรม</th>
            <th>รายละเอียด</th>
            <th>สถานที่</th>
            <th>วันที่เริ่ม</th>
            <th>วันที่สิ้นสุด</th>
            <th>จำนวนสูงสุด</th>
            <th>ผู้สร้าง</th>
        </tr>
    </thead>
    <tbody>
        <?php if (empty($activity)): ?>
            <tr>
                <td colspan="4">ไม่พบข้อมูลกิจกรรม</td>
            </tr>
        <?php else: ?>
            <?php foreach ($activity as $activity): ?>
                <tr>
                    <td><?= $activity['Title'] ?></td>
                    <td><?= $activity['Description'] ?></td>
                    <td><?= $activity['Location'] ?></td>
                    <td><?= $activity['StartDate'] ?></td>
                    <td><?= $activity['EndDate'] ?></td>
                    <td><?= $activity['Max'] ?></td>
                    <td><?= $activity['CreateByName'] ?></td>
                    <td>
                        <form action="/activity" method="post">
                            <input type="hidden" name="UserID" value="<?= $UserID ?> ?>">
                            <input type="hidden" name="ActID" value="<?= $activity['ActID'] ?>">
                            <input type="hidden" name="Actstatus" value="<?= $activity['Status'] ?>">
                            <input type="hidden" name="regstatus" value="<?= 'Pending'?>">
                            <input type="submit" name="register" value="ลงทะเบียน" onclick="return confirmSubmission()">
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </tbody>
</table>
<script>
    function confirmSubmission() {
        return confirm("คุณต้องการลงทะเบียนวิชานี้ใช่หรือไม่?");
    }
</script>