<section>
    <h2 style="margin: 1%;">Profile</h2>
    <div class="profile">
    <div class="card">
    <table border="1">
        <tr>
            <th>ชื่อ</th>
            <td><?= $data['result']['Name'] ?></td>
        </tr>
        <tr>
            <th>อีเมล</th>
            <td><?= $data['result']['Email'] ?></td>
        </tr>
        <tr>
            <th>เบอร์โทรศัพท์</th>
            <td><?= $data['result']['Phone'] ?></td>
        </tr>
        <tr>
            <th>เพศ</th>
            <td><?= $data['result']['Gender'] ?></td>
        </tr>
        <tr>
            <th>อายุ</th>
            <td><?= $data['result']['Age'] ?></td>
        </tr>
    </table>
    </div>
    </div>
    <h2 style="margin: 1%;">กิจกรรมที่เข้าร่วม</h2>
    <table border="1">
        <thead>
            <tr>
                <th>ชื่อกิจกรรม</th>
                <th>วันเริ่มกิจกรรม</th>
                <th>วันสิ้นสุดกิจกรรม</th>
                <th>ผู้สร้างกิจกรรม</th>
                <th>สถานะ</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data['registration'] as $registration): ?>
                <tr>
                    <td><?= $registration['Title'] ?></td>
                    <td><?= $registration['StartDate'] ?></td>
                    <td><?= $registration['EndDate'] ?></td>
                    <td><?= $registration['CreatorName'] ?></td>
                    <td><?= $registration['RegistrationStatus'] ?></td>
                    <td><form action="/profile" method="post">
                    <input type="hidden" name="UserID" value="<?= $data['result']['UserID'] ?>">
                    <input type="hidden" name="ActID" value="<?= $registration['ActID'] ?>">
                            <input type="submit" class="btn btn-danger" onclick="return confirmSubmission()" value="ยกเลิกการเข้าร่วมกิจกรรม">
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</section>
<script>
    function confirmSubmission() {
        return confirm("คุณต้องการถอนรายวิชานี้ใช่หรือไม่?");
    }
</script>