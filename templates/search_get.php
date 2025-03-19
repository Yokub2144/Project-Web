<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ค้นหากิจกรรม</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/style_search.css">
</head>
<body>
    <div class="container">
        <!-- ส่วนหัวหน้าเว็บ -->
        <div style="text-align: center; margin-bottom: 30px;">
            <img src="img/logo.png" alt="Logo" style="width: 30%; height: auto; animation: logoAnimation 2s ease-in-out infinite;">
            <h1 style="color: rgb(255, 255, 255);">ค้นหากิจกรรม</h1>
            <p style="color: #777; font-size: 1.2em; text-align: center; width: 80%; margin: 10px auto;">
                ค้นหากิจกรรมที่คุณสนใจและเข้าร่วมได้ทันที!
            </p>
        </div>

        <!-- แสดงผลกิจกรรม -->
        <?php if (isset($data['result']) && is_array($data['result']) && isset($data['result']['activity'])): ?>
            <?php if (empty($data['result']['activity'])): ?>
                <p class="no-activity">ไม่พบกิจกรรมที่ตรงกับคำค้นหา</p>
            <?php else: ?>
                <div class="activity-grid">
                    <?php foreach ($data['result']['activity'] as $row): ?>
                        <div class="activity-card">
                            <!-- แสดงรูปภาพกิจกรรม -->
                            <a href="#">
                                <?php if (!empty($row['ImageURL'])): ?>
                                    <img src="<?= $row['ImageURL'] ?>" alt="<?= $row['Title'] ?>"
                                        style="width: 100%; height: auto; border-radius: 8px; margin-bottom: 10px; transition: opacity 0.3s ease;"
                                        onmouseover="this.style.opacity=0.8" onmouseout="this.style.opacity=1">
                                <?php else: ?>
                                    <!-- หากไม่มีรูปภาพ ให้แสดงพื้นหลังสีขาว -->
                                    <div class="image-placeholder"
                                        style="width: 100%; height: 200px; background-color: white; border-radius: 8px; margin-bottom: 10px; display: flex; align-items: center; justify-content: center; color: #aaa;">
                                        ไม่มีรูปภาพ
                                    </div>
                                <?php endif; ?>
                            </a>

                            <!-- แสดงรายละเอียดกิจกรรม -->
                            <h2 class="activity-card-title"><?= $row['Title'] ?></h2>
                            <p class="activity-card-details"><strong>รายละเอียด:</strong> <?= $row['Description'] ?></p>
                            <p class="activity-card-details"><strong>สถานที่:</strong> <?= $row['Location'] ?></p>
                            <p class="activity-card-details"><strong>วันที่เริ่ม:</strong> <?= $row['StartDate'] ?></p>
                            <p class="activity-card-details"><strong>วันที่สิ้นสุด:</strong> <?= $row['EndDate'] ?></p>
                            <p class="activity-card-details"><strong>จำนวนสูงสุด:</strong> <?= $row['Max'] ?></p>
                            <p class="activity-card-details"><strong>ผู้สร้าง:</strong> <?= $row['CreateByName'] ?></p>

                            <!-- ตรวจสอบการลงทะเบียน -->
                            <?php if (isset($_SESSION['UserID'])): ?>
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
                                        <input type="submit" name="register" value="ลงทะเบียน" class="register-button" onclick="return confirm('คุณต้องการลงทะเบียนกิจกรรมนี้ใช่หรือไม่?')">
                                    </form>
                                <?php endif; ?>
                            <?php else: ?>
                                <p class="text-center text-danger"><strong>กรุณาล็อกอินก่อน</strong></p>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        <?php else: ?>
            <p class="no-activity">ไม่พบกิจกรรมที่ค้นหา</p>
        <?php endif; ?>
    </div>
</body>

</html>