<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Music Festival Card</title>
    <link rel="stylesheet" href="/css/style_detalis.css">
</head>

<body>
    <?php
    $activity = $data['activity'];
    if (!isset($_SESSION['UserID'])) {
        $UserID = '';
    } else {
        $UserID = $data['UserID'];
    }
    ?>
    <div class="card">
        <div class="image-section">
            <?php if (!empty($activity['ImageURL'])): ?>
                <img src="<?= $activity['ImageURL'] ?>" alt="<?= $activity['Title'] ?>" class="activity-image">
            <?php else: ?>
                <div class="image-placeholder"
                    style="width: 100%; height: 200px; background-color: white; border-radius: 8px; margin-bottom: 10px; display: flex; align-items: center; justify-content: center; color: #aaa;">
                    ไม่มีรูปภาพ
                </div>
            <?php endif; ?>
        </div>

        <div class="info-section">
            <p class="activity-card-details-time"><strong>วันที่เริ่ม:</strong> <?= $activity['StartDate'] ?>-<?= $activity['EndDate'] ?></p>
            <h2 class="activity-card-title"><?= $activity['Title'] ?></h2>
            <p class="activity-card-details"><strong>รายละเอียด:</strong> <?= $activity['Description'] ?></p>
            <p class="activity-card-details"><strong>สร้างโดย:</strong> <?= $activity['name'] ?></p>
            <p class="activity-card-details"><strong>สถานะ:</strong> <?= $activity['Status'] ?></p>
            <form action="/homeactivity" method="post">
                <input type="hidden" name="UserID" value="<?= $_SESSION['UserID'] ?>">
                <input type="hidden" name="ActID" value="<?= $activity['ActID'] ?>">
                <input type="hidden" name="Actstatus" value="<?= $activity['Status'] ?>">
                <input type="hidden" name="regstatus" value="Pending">
                <input type="submit" name="register" value="ลงทะเบียน" class="register-button" onclick="return confirm('คุณต้องการลงทะเบียนกิจกรรมนี้ใช่หรือไม่?')">
            </form>
        </div>
    </div>
</body>

</html>