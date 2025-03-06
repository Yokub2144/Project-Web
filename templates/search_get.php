<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style_search.css">
   
</head>
<body>
    <div class="container mt-5">

        <?php if (isset($data['result']) && is_array($data['result']) && isset($data['result']['activity'])): ?>
            <?php if (empty($data['result']['activity'])): ?>
                <p class="text-center text-danger">ไม่พบกิจกรรมที่ตรงกับคำค้นหา</p>
            <?php else: ?>
                <div class="row">
                    <?php foreach ($data['result']['activity'] as $row): ?>
                        <div class="col-md-4 mb-4">
                            <div class="activity-card">
                                <img src="img/poster.png" class="card-img-top" alt="<?= $row['Title'] ?>">
                                <div class="card-body">
                                    <h5 class="activity-card-title"><?= $row['Title'] ?></h5>
                                    <p class="activity-card-details"><strong>รายละเอียด:</strong> <?= $row['Description'] ?></p>
                                    <p class="activity-card-details"><strong>สถานที่:</strong> <?= $row['Location'] ?></p>
                                    <p class="activity-card-details"><strong>วันที่เริ่ม:</strong> <?= $row['StartDate'] ?></p>
                                    <p class="activity-card-details"><strong>วันที่สิ้นสุด:</strong> <?= $row['EndDate'] ?></p>
                                    <p class="activity-card-details"><strong>จำนวนสูงสุด:</strong> <?= $row['Max'] ?></p>
                                    <p class="activity-card-details"><strong>ผู้สร้าง:</strong> <?= $row['CreateByName'] ?></p>
                                    <?php
                                    $isRegistered = false;
                                    if (isset($data['registrations'])) {
                                        foreach ($data['registrations'] as $registration) {
                                            if ($registration['ActID'] == $row['ActID']) {
                                                $isRegistered = true;
                                                break;
                                            }
                                        }
                                    }
                                    ?>
                                    <?php if ($isRegistered): ?>
                                        <p class="registered-status"><strong>คุณได้ลงทะเบียนแล้ว</strong></p>
                                    <?php else: ?>
                                        <form action="/homeactivity" method="post">
                                            <input type="hidden" name="UserID" value="<?= $_SESSION['UserID'] ?>">
                                            <input type="hidden" name="ActID" value="<?= $row['ActID'] ?>">
                                            <input type="hidden" name="Actstatus" value="<?= $row['Status'] ?>">
                                            <input type="hidden" name="regstatus" value="Pending">
                                            <input type="submit" name="register" value="ลงทะเบียน" class="register-button" onclick="return confirm('คุณต้องการลงทะเบียนวิชานี้ใช่หรือไม่?')">
                                        </form>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        <?php else: ?>
            <p class="text-center text-danger">ไม่พบกิจกรรมที่ค้นหา</p>
        <?php endif; ?>
    </div>
</body>
</html>