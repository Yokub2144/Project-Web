<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แก้ไขโปรไฟล์</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="/css/style_updateprofile.css">

</head>

<body>
    <div class="container">
        <div class="profile-container">
            <div class="profile-header text-center mb-4">
                <div class="profile-img-container">
                    <img src="<?= $User['ImageProfileURL'] ?? '/images/default-profile.jpg' ?>"
                        class="profile-img"
                        id="profileImagePreview">
                    <label for="profileImage" class="profile-img-upload">
                        <i class="fas fa-camera"></i>
                    </label>
                </div>
                <h2>แก้ไขโปรไฟล์</h2>
            </div>

            <form action="/updateprofile" method="post" enctype="multipart/form-data">
                <input type="file" class="d-none" id="profileImage" name="profileImage" accept="image/*">
                <input type="hidden" name="current_image" value="<?= $User['ImageProfileURL'] ?? '' ?>">

                <!-- ชื่อ -->
                <div class="form-group mb-3">
                    <label for="name" class="form-label">ชื่อ</label>
                    <input type="text" class="form-control" id="name" name="name"
                        value="<?= htmlspecialchars($User['Name'] ?? '') ?>" required>
                </div>

                <!-- อีเมล -->
                <div class="form-group mb-3">
                    <label for="email" class="form-label">อีเมล</label>
                    <input type="email" class="form-control" id="email" name="email"
                        value="<?= htmlspecialchars($User['Email'] ?? '') ?>" required>
                </div>

                <!-- เบอร์โทรศัพท์ -->
                <div class="form-group mb-3">
                    <label for="phone" class="form-label">เบอร์โทรศัพท์</label>
                    <input type="tel" class="form-control" id="phone" name="phone"
                        value="<?= htmlspecialchars($User['Phone'] ?? '') ?>" required>
                </div>

                <!-- เพศ -->
                <div class="form-group mb-3">
                    <label for="gender" class="form-label">เพศ</label>
                    <select class="form-control" id="gender" name="gender" required>
                        <option value="Male" <?= ($User['Gender'] ?? '') === 'Male' ? 'selected' : '' ?>>ชาย</option>
                        <option value="Female" <?= ($User['Gender'] ?? '') === 'Female' ? 'selected' : '' ?>>หญิง</option>
                        <option value="Other" <?= ($User['Gender'] ?? '') === 'Other' ? 'selected' : '' ?>>อื่นๆ</option>
                    </select>
                </div>

                <!-- อายุ -->
                <div class="form-group mb-4">
                    <label for="age" class="form-label">อายุ</label>
                    <input type="number" class="form-control" id="age" name="age"
                        value="<?= htmlspecialchars($User['Age'] ?? '') ?>" min="1" max="120" required>
                </div>

                <!-- ปุ่มบันทึกการเปลี่ยนแปลง -->
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-save">
                        <i class="fas fa-save me-2"></i> บันทึกการเปลี่ยนแปลง
                    </button>
                    <a href="/profile" class="btn btn-outline-secondary">
                        <i class="fas fa-times me-2"></i> ยกเลิก
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // แสดงตัวอย่างรูปภาพเมื่อเลือกไฟล์
        document.getElementById('profileImage').addEventListener('change', function(e) {
            if (e.target.files.length > 0) {
                const file = e.target.files[0];
                const reader = new FileReader();

                // แสดง loading ก่อนโหลดรูปเสร็จ
                document.getElementById('profileImagePreview').style.opacity = '0.7';

                reader.onload = function(event) {
                    document.getElementById('profileImagePreview').src = event.target.result;
                    document.getElementById('profileImagePreview').style.opacity = '1';

                    // เพิ่มเอฟเฟกต์เมื่อเปลี่ยนรูปใหม่
                    document.getElementById('profileImagePreview').classList.add('profile-img-animate');
                    setTimeout(() => {
                        document.getElementById('profileImagePreview').classList.remove('profile-img-animate');
                    }, 500);
                };

                reader.readAsDataURL(file);
            }
        });
    </script>
</body>

</html>