<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Music Festival Card</title>
</head>
<body>
<?php
        $activity = $data['activity'];
        if(!isset($_SESSION['UserID'])){
           $UserID = '';  
        } else {
            $UserID = $data['UserID']; 
        }
        ?>
    <div class="card">
        <div class="image-section">
            <img src="image.png" alt="Music Festival Poster">
        </div>
        <div class="info-section">
        <p class="activity-card-details"><strong>วันที่เริ่ม:</strong> <?= $activity['StartDate'] ?>-<?= $activity['EndDate'] ?></p>
        <h2 class="activity-card-title"><?= $activity['Title'] ?></h2>
        <p class="activity-card-details"><strong>รายละเอียด:</strong> <?= $activity['Description'] ?></p>
        <p class="activity-card-details"><strong>สร้างโดย:</strong> <?= $activity['name'] ?></p>
        <form action="/detalis" method="post">
        <input type="hidden" name="UserID" value="<?= $UserID ?>">
        <input type="hidden" name="ActID" value="<?= $activity['ActID'] ?>">
        <input type="hidden" name="Status" value=<?= $activity['Status'] ?>>
        <button class="register-btn" name="reg">Register</button>
        </div>
    </div>
</body>
</html>
