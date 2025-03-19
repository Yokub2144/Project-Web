<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แก้ไขโปรไฟล์</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@400;600&display=swap" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        body {
            font-family: 'Kanit', sans-serif;
            background-color: #f8f9fa;
        }

        .profile-container {
            max-width: 800px;
            margin: 50px auto;
            padding: 30px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .profile-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .profile-header img {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid #007bff;
        }

        .profile-header h2 {
            margin-top: 15px;
            font-size: 2rem;
            color: #333;
        }

        .form-group label {
            font-weight: 600;
            color: #555;
        }

        .form-control {
            border-radius: 8px;
            padding: 10px;
            font-size: 1rem;
        }

        .btn-save {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            font-size: 1rem;
            transition: background-color 0.3s ease;
        }

        .btn-save:hover {
            background-color: #0056b3;
        }

        .btn-upload {
            background-color: #28a745;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            font-size: 1rem;
            transition: background-color 0.3s ease;
        }

        .btn-upload:hover {
            background-color: #218838;
        }
    </style>
</head>

<body>
    <div class="profile-container">
        <!-- ส่วนหัวโปรไฟล์ -->
        <div class="profile-header">
            <img src="<?= $data['User']['ImageProfileURL'] ?? 'https://via.placeholder.com/150' ?>" alt="Profile Image">
            <h2>แก้ไขโปรไฟล์</h2>
        </div>

        <!-- ฟอร์มแก้ไขโปรไฟล์ -->
        <form action="/editprofile" method="post" enctype="multipart/form-data">
            <!-- ชื่อ -->
            <div class="form-group">
                <label for="name">ชื่อ</label>
                <input type="text" class="form-control" id="name" name="name" value="<?= $data['User']['Name'] ?>" required>
            </div>

            <!-- อีเมล -->
            <div class="form-group">
                <label for="email">อีเมล</label>
                <input type="email" class="form-control" id="email" name="email" value="<?= $data['User']['Email'] ?>" required>
            </div>

            <!-- เบอร์โทรศัพท์ -->
            <div class="form-group">
                <label for="phone">เบอร์โทรศัพท์</label>
                <input type="tel" class="form-control" id="phone" name="phone" value="<?= $data['User']['Phone'] ?>" required>
            </div>

            <!-- เพศ -->
            <div class="form-group">
                <label for="gender">เพศ</label>
                <select class="form-control" id="gender" name="gender" required>
                    <option value="Male" <?= $data['User']['Gender'] === 'Male' ? 'selected' : '' ?>>ชาย</option>
                    <option value="Female" <?= $data['User']['Gender'] === 'Female' ? 'selected' : '' ?>>หญิง</option>
                    <option value="Other" <?= $data['User']['Gender'] === 'Other' ? 'selected' : '' ?>>อื่นๆ</option>
                </select>
            </div>

            <!-- อายุ -->
            <div class="form-group">
                <label for="age">อายุ</label>
                <input type="number" class="form-control" id="age" name="age" value="<?= $data['User']['Age'] ?>" required>
            </div>

            <!-- รูปโปรไฟล์ -->
            <div class="form-group">
                <label for="profileImage">รูปโปรไฟล์</label>
                <input type="file" class="form-control-file" id="profileImage" name="profileImage">
                <small class="form-text text-muted">อัปโหลดรูปภาพใหม่ (ถ้าต้องการ)</small>
            </div>

            <!-- ปุ่มอัปโหลดรูปภาพ -->
            <button type="button" class="btn btn-upload mb-3" onclick="document.getElementById('profileImage').click()">
                อัปโหลดรูปภาพ
            </button>

            <!-- ปุ่มบันทึกการเปลี่ยนแปลง -->
            <button type="submit" class="btn btn-save btn-block">
                บันทึกการเปลี่ยนแปลง
            </button>
        </form>
    </div>

    <!-- Bootstrap JS และ dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>