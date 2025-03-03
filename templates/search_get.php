<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url('img/bg_green.png');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            min-height: 100vh;
        }

        .activity-card {
            background-color: rgba(10, 8, 21, 0.8);
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            margin-bottom: 20px;
            padding: 20px;
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
            animation: fadeInUp 0.5s ease-out;
        }

        .activity-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
        }

        .activity-card img {
            width: 100%;
            height: auto;
            border-radius: 8px;
            margin-bottom: 10px;
            transition: opacity 0.3s ease;
        }

        .activity-card img:hover {
            opacity: 0.8;
        }

        .activity-card-title {
            font-family: 'Comic Sans MS', cursive, sans-serif;
            color: #FF3636;
            font-weight: bold;
            text-align: center;
            margin-bottom: 10px;
        }

        .activity-card-details {
            color: #FFFFFF;
            margin-bottom: 10px;
            padding: 0 10px;
        }

        .register-button {
            border-radius: 20px;
            font-size: 1rem;
            padding: 10px 20px;
            background-color: #28a745;
            border: none;
            color: white;
            font-weight: bold;
            width: 100%;
            transition: background-color 0.2s ease-in-out, transform 0.1s ease;
        }

        .register-button:hover {
            background-color: #219653;
        }

        .register-button:active {
            transform: scale(0.95);
        }

        .registered-status {
            color: #dc3545;
            font-weight: bold;
            text-align: center;
            margin-top: 10px;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
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
                                        <form action="/routes/register_activity.php" method="post">
                                            <input type="hidden" name="UserID" value="<?= isset($data['UserID']) ? $data['UserID'] : '' ?>">
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