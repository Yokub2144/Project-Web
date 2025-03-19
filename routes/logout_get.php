<?php

logout(); // เรียกใช้ฟังก์ชัน logout จากไฟล์ authen.php
$activityData = getactivity();
renderView('homeactivity_get',['activity' => $activityData['activity']]); // ส่งข้อมูลไปยัง view home_get
