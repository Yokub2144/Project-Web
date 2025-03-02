<section class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="body">
                <div class="row">
                    <div class="col-md-4">
                    <img src="img/profile.png" alt="" class="profile-image" style="width: 150px; height: 150px; border-radius: 50%;">
                    </div>
                    <div class="col-md-8">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="text-center">ชื่อ</th>
                                    <th class="text-center">อีเมล</th>
                                    <th class="text-center">เบอร์โทรศัพท์</th>
                                    <th class="text-center">เพศ</th>
                                    <th class="text-center">อายุ</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-center"><?= $data['result']['Name'] ?></td>
                                    <td class="text-center"><?= $data['result']['Email'] ?></td>
                                    <td class="text-center"><?= $data['result']['Phone'] ?></td>
                                    <td class="text-center"><?= $data['result']['Gender'] ?></td>
                                    <td class="text-center"><?= $data['result']['Age'] ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <h2 class="text-center mt-5 mb-4" style="margin: 1%;">กิจกรรมที่เข้าร่วม</h2>
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="thead-light">
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
                                <td class="text-center">
                                    <form action="/profile" method="post">
                                        <input type="hidden" name="UserID" value="<?= $data['result']['UserID'] ?>">
                                        <input type="hidden" name="ActID" value="<?= $registration['ActID'] ?>">
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirmSubmission()">
                                            ยกเลิกการเข้าร่วม
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <h2 class="text-center mt-5 mb-4" style="margin: 1%;">กิจกรรมที่สร้าง</h2>
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th>ชื่อกิจกรรม</th>
                            <th>วันเริ่มกิจกรรม</th>
                            <th>วันสิ้นสุดกิจกรรม</th>
                            <th>สถานะ</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data['createdActivities'] as $activity): ?>
                            <tr>
                                <td><?= $activity['Title'] ?></td>
                                <td><?= $activity['StartDate'] ?></td>
                                <td><?= $activity['EndDate'] ?></td>
                                <td><?= $activity['Status'] ?></td>
                                <td class="text-center">
                                    <form action="/deleteActivity" method="post">
                                        <input type="hidden" name="ActID" value="<?= $activity['ActID'] ?>">
                                        <button type="submit" class="btn btn-warning btn-sm" onclick="return confirmSubmission_edit()">
                                            แก้ไขกิจกรรม
                                        </button>
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirmSubmission_delete()">
                                            ลบกิจกรรม
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

<script>
    function confirmSubmission_delete() {
        return confirm("คุณต้องการลบกิจกรรมนี้ใช่หรือไม่?");
    }
    function confirmSubmission() {
        return confirm("คุณต้องการยกเลิกการเข้าร่วมกิจกรรมนี้ใช่หรือไม่?");
    }
</script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">












<!-- OLD CODE -->
<!-- <section>
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
</script> -->