
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap">
    <link rel="stylesheet" href="CSS\style_profile.css">
</head>

<body>
    <div class="container">
        <div class="profile-header">     

            <img src="<?php echo $User['ImageProfileURL']; ?>" alt="" width="200" height="200" style="border-radius: 50%; object-fit: cover; margin: 20px;">

            <div class="profile-info">
                <div class="profile-username"><strong><?= $data['User']['Name'] ?></strong></div>
                <div class="profile-bio">
                    <div class="bio-item">
                        <strong>Email:</strong>
                        <strong>
                            <div><?= $data['User']['Email'] ?></div>
                        </strong>
                    </div>
                    <div class="bio-item">
                        <strong>Phone:</strong>
                        <strong>
                            <div><?= $data['User']['Phone'] ?></div>
                        </strong>
                    </div>
                    <div class="bio-item">
                        <strong>Gender:</strong>
                        <strong>
                            <div><?= $data['User']['Gender'] ?></div>
                        </strong>
                    </div>
                    <div class="bio-item">
                        <strong>Age:</strong>
                        <strong>
                            <div><?= $data['User']['Age'] ?></div>
                        </strong>
                    </div>
                    <div class="bio-item">
                        <strong>UID</strong>
                        <strong>
                            <div><?= $data['User']['UserID'] ?></div>
                        </strong>
                    </div>
                </div>
            </div>
        </div>

        <h2 class="text-left mt-5 mb-4" style="color: #f2f2f2;">Now</h2>
        <div class="table">
            <div class="row">
                <?php foreach ($data['registration'] as $registration): ?>
                    <div class="col-md-10 mb-4">
                        <div class="card" style="background-color: rgba(52, 58, 64, 0.0); color: #f2f2f2;">
                            <div class="row ">
                                <div class="col-md-4">
                                    <img src="img/poster.png" alt="" style="width: 100%; height: auto; max-height: 250px; object-fit: cover; border-radius: 8px;
                                        margin-bottom: 10px; transition: opacity 0.3s ease;">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title"><?= $registration['Title'] ?></h5>
                                        <p class="card-text"><strong>วันเริ่มกิจกรรม :</strong> <?= $registration['StartDate'] ?>
                                        </p>
                                        <p class="card-text"><strong>วันสิ้นสุดกิจกรรม :</strong> <?= $registration['EndDate'] ?>
                                        </p>
                                        <p class="card-text"><strong>ผู้สร้างกิจกรรม :</strong> <?= $registration['CreatorName'] ?>
                                        </p>
                                        <p class="card-text"><strong>สถานะ:</strong> <?= $registration['RegistrationStatus'] ?></p>
                                        <form action="/profile" method="post" class="text-center">
                                            <input type="hidden" name="UserID" value="<?= $data['User']['UserID'] ?>">
                                            <input type="hidden" name="ActID" value="<?= $registration['ActID'] ?>">
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirmSubmission()">
                                                ยกเลิกการเข้าร่วม
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <h2 class="text-left mt-5 mb-4" style="color: #f2f2f2;">Creator</h2>
        <div class="table">
            <div class="row">

                <?php $data['createdActivities'];
                foreach ($data['createdActivities'] as $activity): ?>
                    <div class="col-md-11 mb-4">
                        <div class="card" style="background-color: rgba(60, 73, 85, 0); color: #f2f2f2;">
                            <div class="row ">
                                <div class="col-md-4 mr-auto">
                                    <img src="img/MSU-book-fair-2.png" alt=""
                                        style="width: 100%; height: auto; max-height: 250px; object-fit: cover; border-radius: 8px;
                                        margin-bottom: 10px; transition: opacity 0.3s ease;">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body ">
                                        <h5 class="card-title"><?= $activity['Title'] ?></h5>
                                        <p class="card-text"><strong>วันเริ่มกิจกรรม :</strong> <?= $activity['StartDate'] ?></p>
                                        <p class="card-text"><strong>วันสิ้นสุดกิจกรรม :</strong> <?= $activity['EndDate'] ?></p>
                                        <p class="card-text"><strong>สถานะ:</strong> <?= $activity['Status'] ?></p>
                                        <div class="d-flex justify-content-end mt-3">
                                            <form action="/request" method="get" class="d-flex justify-content-end">
                                                <input type="hidden" name="ActID" value="<?= $activity['ActID'] ?>">
                                                <button type="submit" class="btn btn-primary btn-sm mx-1">
                                                    Info
                                                </button>
                                            </form>
                                            <form action="/editActivity" method="get" class="d-flex justify-content-end">
                                                <input type="hidden" name="ActID" value="<?= $activity['ActID'] ?>">
                                                <button type="submit" class="btn btn-primary btn-sm mx-1" onclick="return confirmSubmission_edit()">
                                                    Edit
                                                </button>
                                            </form>
                                            <form action="/deleteActivity" method="post" class="d-flex justify-content-end">
                                                <input type="hidden" name="ActID" value="<?= $activity['ActID'] ?>">
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirmSubmission_delete()">
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <script>
            function confirmSubmission_delete() {
                return confirm("คุณต้องการลบกิจกรรมนี้ใช่หรือไม่?");
            }

            function confirmSubmission() {
                return confirm("คุณต้องการยกเลิกการเข้าร่วมกิจกรรมนี้ใช่หรือไม่?");
            }
        </script>
</body>

</html>


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