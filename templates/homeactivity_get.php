<?php
// filepath: /C:/xampp/htdocs/Project-Web/templates/homeactivity_get.php
?>
<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รายการกิจกรรม</title>
    <style>
        body {
            font-family: 'Kanit', sans-serif;
            background-image: url('img/2.png');
            background-size: cover;
            margin: 0;
            padding: 0;
            color: #333;
        }

        .container {
            width: 90%;
            max-width: 1200px;
            margin: auto;
            overflow: hidden;
            padding: 20px;
            border-radius: 10px;
        }

        .activity-list-wrapper {
            position: relative;
            overflow: hidden;
            padding: 20px;
        }

        .activity-list {
            display: flex;
            scroll-behavior: smooth;
            margin-bottom: 20px;
            overflow-x: auto;
            scrollbar-width: none;
            -ms-overflow-style: none;
            padding: 10px 0;
        }

        .activity-list::-webkit-scrollbar {
            display: none;
        }

        .activity-card {
            width: 320px;
            flex: 0 0 auto;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            margin-bottom: 20px;
            padding: 20px;
            box-sizing: border-box;
            margin-right: 20px;
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
            background-color: #0A0815;
            /* Added a semi-transparent white background */
            animation: fadeInUp 0.5s ease-out;
            /* เพิ่ม animation ตอนโหลด */
        }

        .activity-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
            /* เพิ่มเงาเมื่อ hover */
        }

        .activity-card:last-child {
            margin-right: 0;
        }

        .activity-card-title {
            font-size: 1.3em;
            margin-bottom: 10px;
            color: #FF3636;
            font-weight: 600;
        }

        .activity-card-details {
            font-size: 1em;
            color: #FFFFFF;
            line-height: 1.6;
        }

        .no-activity {
            text-align: center;
            font-style: italic;
            color: #777;
        }

        .register-button {
            background-color: #3D8989;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 1em;
            transition: background-color 0.2s ease-in-out, transform 0.1s ease;
            /* เพิ่ม transition */
        }

        .register-button:hover {
            background-color: #219653;
        }

        .register-button:active {
            transform: scale(0.95);
            /* กดแล้วหดลงเล็กน้อย */
        }

        .Explore-button {
            background-color: #CEC6C6;
            background-color: rgba(255, 255, 255, 0.5);
            /* Made buttons more visible */
            color: black;
            border-radius: 15px;
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 1em;
            transition: background-color 0.3s ease;
        }

        .Explore-button:hover {
            background-color: rgb(33, 150, 83);

        }

        .nav-button {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background-color: rgba(255, 255, 255, 0.5);
            /* Made buttons more visible */
            border: none;
            padding: 12px;
            cursor: pointer;
            font-size: 1.5em;
            border-radius: 50%;
            width: 45px;
            height: 45px;
            text-align: center;
            line-height: 1;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
            /* Increased shadow for better visibility */
            transition: background-color 0.2s ease-in-out, transform 0.2s ease-in-out;
            z-index: 10;
        }

        .nav-button:hover {
            background-color: rgba(236, 240, 241, 0.7);
            /* Made hover more prominent */
            transform: translateY(-50%) scale(1.1);
        }

        .nav-button:active {
            transform: translateY(-50%) scale(0.95);
            /* กดแล้วหดลงเล็กน้อย */
        }

        .nav-button.prev {
            left: 10px;
        }

        .nav-button.next {
            right: 10px;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .activity-card {
                width: 100%;
                margin-right: 0;
            }
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

        @keyframes logoAnimation {
            0% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-10px);
            }

            100% {
                transform: translateY(0);
            }
        }
    </style>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@400;600&display=swap" rel="stylesheet">
</head>

<body>
    <div class="container">
        <?php
        $activity = $data['activity']; // รับค่า activities จาก controller
        $UserID = $data['UserID']; // รับค่า student_id จาก controller
        ?>
        <div style="text-align: center;">
            <img src="img/logo.png" alt="" style="width: 30%; height: auto; animation: logoAnimation 2s ease-in-out infinite;">
            <h1 style="color:rgb(255, 255, 255);">Welcome to Active Zone</h1>
            <p style="color: #777; font-size: 1.2em; text-align: center; width: 80%; margin: 10px auto;">
                ActiveZone is the platform that meets all your needs.<br>
                Easily create events and discover amazing activities <br>
                at your fingertips!
            </p>
            <br>
            <a href="#"><button class="Explore-button">Explore</button></a>
        </div>

        <div class="activity-list-wrapper">
            <button class="nav-button prev" onclick="scrollActivities(-1)">&#9664;</button>
            <div class="activity-list">
                <?php if (empty($activity)): ?>
                    <p class="no-activity">ไม่พบข้อมูลกิจกรรม</p>
                <?php else: ?>
                    <?php foreach ($activity as $activityItem): ?>
                        <div class="activity-card">
                            <!-- กดคลิกที่รูปแล้วเพื่อดูรายละเอียด -->
                            <!-- <a href="/activity_detail.php?id=<?= $activityItem['ActID'] ?>"> -->
                            <a href="#"> <!-- เวลาใช้ลบอันนี้ -->
                                <!-- ฟิกค่ารูปจากโฟลเดอร์ img ที่ชื่อ poster.png  -->
                                <img src="img/poster.png" style="width: 100%; height: auto; border-radius: 8px; margin-bottom: 10px; transition: opacity 0.3s ease;" alt="<?= $activityItem['Title'] ?>"
                                    onmouseover="this.style.opacity=0.8" onmouseout="this.style.opacity=1">

                                <!-- รับค่าจาก controller -->
                                <!-- <img src="<?= $activityItem['ImageUrl'] ?>" style="width: 100%; height: auto; border-radius: 8px; margin-bottom: 10px;" alt="<?= $activityItem['Title'] ?>"> -->
                                 
                            </a>
                            <h2 class="activity-card-title"><?= $activityItem['Title'] ?></h2>
                            <p class="activity-card-details"><strong>รายละเอียด:</strong> <?= $activityItem['Description'] ?></p>
                            <p class="activity-card-details"><strong>สถานที่:</strong> <?= $activityItem['Location'] ?></p>
                            <p class="activity-card-details"><strong>วันที่เริ่ม:</strong> <?= $activityItem['StartDate'] ?></p>
                            <p class="activity-card-details"><strong>วันที่สิ้นสุด:</strong> <?= $activityItem['EndDate'] ?></p>
                            <p class="activity-card-details"><strong>จำนวนสูงสุด:</strong> <?= $activityItem['Max'] ?></p>
                            <p class="activity-card-details"><strong>ผู้สร้าง:</strong> <?= $activityItem['CreateByName'] ?></p>
                            <form action="/homeactivity" method="post">
                                <input type="hidden" name="UserID" value="<?= $UserID ?>">
                                <input type="hidden" name="ActID" value="<?= $activityItem['ActID'] ?>">
                                <input type="hidden" name="Actstatus" value="<?= $activityItem['Status'] ?>">
                                <input type="hidden" name="regstatus" value="<?= 'Pending' ?>">
                                <input type="submit" name="register" value="ลงทะเบียน" class="register-button" onclick="return confirmSubmission()">
                            </form>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
            <button class="nav-button next" onclick="scrollActivities(1)">&#9654;</button>
        </div>
    </div>

    <script>
        function confirmSubmission() {
            return confirm("คุณต้องการลงทะเบียนวิชานี้ใช่หรือไม่?");
        }

        function scrollActivities(direction) {
            const activityList = document.querySelector('.activity-list');
            const cardWidth = 320; // Width of card + margin
            const scrollAmount = direction * cardWidth;

            console.log('Direction:', direction);
            console.log('Scroll Amount:', scrollAmount);
            console.log('Current ScrollLeft:', activityList.scrollLeft);

            activityList.scrollLeft += scrollAmount; // ใช้ scrollLeft โดยตรง

            console.log('New ScrollLeft:', activityList.scrollLeft);

            // ป้องกันไม่ให้เลื่อนเกินขอบ
            if (activityList.scrollLeft < 0) {
                activityList.scrollLeft = 0;
            }

            const maxScrollLeft = activityList.scrollWidth - activityList.clientWidth;
            console.log('Max ScrollLeft:', maxScrollLeft);
            if (activityList.scrollLeft > maxScrollLeft) {
                activityList.scrollLeft = maxScrollLeft;
            }
        }
    </script>
</body>

</html>



<!-- OLD CODE -->
<!-- <?php
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
                        <form action="/homeactivity" method="post">
                            <input type="hidden" name="UserID" value="<?= $UserID ?> ?>">
                            <input type="hidden" name="ActID" value="<?= $activity['ActID'] ?>">
                            <input type="hidden" name="Actstatus" value="<?= $activity['Status'] ?>">
                            <input type="hidden" name="regstatus" value="<?= 'Pending' ?>">
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
</script> -->