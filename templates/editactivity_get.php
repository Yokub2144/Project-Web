<?php
if (isset($_GET['ActID'])) {
    $ActID = $_GET['ActID'];
    $activity = getactivityByActID($ActID);

    if ($activity) {
        $Title = $activity['Title'];
        $Description = $activity['Description'];
        $Location = $activity['Location'];
        $Max = $activity['Max'];
        $StartDate = $activity['StartDate'];
        $EndDate = $activity['EndDate'];
        $Status = $activity['Status'];
        $ImageURL = $activity['ImageURL'];
    } else {
        echo "ไม่พบกิจกรรม";
        $Title = $Description = $Location = $Max = $StartDate = $EndDate = $Status = "";
    }
} else {
    echo "ไม่ได้รับ ActID";
    $Title = $Description = $Location = $Max = $StartDate = $EndDate = $Status = "";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Event</title>
    <link rel="stylesheet" href="/css/style_editactivity.css">
    <style>
        .image-preview-container {
            position: relative;
            margin-bottom: 15px;
        }

        .current-image {
            max-width: 100%;
            max-height: 200px;
            border-radius: 8px;
        }

        .delete-image-btn {
            position: absolute;
            top: 5px;
            right: 5px;
            background: rgba(255, 0, 0, 0.7);
            color: white;
            border: none;
            border-radius: 50%;
            width: 25px;
            height: 25px;
            cursor: pointer;
        }

        .delete-image-btn:hover {
            background: rgba(255, 0, 0, 0.9);
        }

        #imagePreview {
            max-width: 100%;
            max-height: 200px;
            margin-top: 10px;
            display: none;
            border-radius: 8px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="card shadow-sm border-2">
            <div class="row g-0">
                <div class="col-md-4 left-box">
                    <div class="card-body text-center">
                        <h2 class="card-title mb-4" style="font-size: 20px;">EDIT EVENT</h2>

                        <!-- ส่วนแสดงรูปภาพปัจจุบันและปุ่มลบ -->
                        <div class="image-preview-container">
                            <?php if (!empty($ImageURL)): ?>
                                <img src="<?= htmlspecialchars($ImageURL) ?>" class="current-image" id="currentImage">
                                <button type="button" class="delete-image-btn" onclick="confirmDeleteImage()">×</button>
                            <?php else: ?>
                                <img src="img/5.png" class="current-image" id="currentImage">
                            <?php endif; ?>
                        </div>

                        <!-- Preview รูปภาพใหม่ -->
                        <img id="imagePreview" src="#" alt="Preview" style="display: none;">

                        <!-- ฟอร์มแก้ไขกิจกรรม -->
                        <form action="/editactivity" method="post" enctype="multipart/form-data" id="editForm">
                            <input type="hidden" name="ActID" value="<?= htmlspecialchars($ActID) ?>">
                            <input type="hidden" name="current_image" id="currentImageInput" value="<?= htmlspecialchars($ImageURL) ?>">
                            <input type="hidden" name="delete_image" id="deleteImageFlag" value="0">

                            <!-- ฟิลด์สำหรับอัปโหลดรูปภาพใหม่ -->
                            <div class="form-group mb-3">
                                <label for="imageUpload" class="form-label">Upload New Image</label>
                                <input type="file" class="form-control" name="ImageURL" id="imageUpload" accept="image/*">
                            </div>

                            <!-- ปุ่มยกเลิกการอัปโหลด -->
                            <div class="image-actions">
                                <button type="button" class="btn btn-secondary btn-sm" id="cancelUpload" style="display: none;">Cancel Upload</button>
                            </div>
                            <div class="button-group">
                                <a href="/homeactivity" class="btn btn-danger">CANCEL</a>
                            </div>
                    </div>
                </div>

                <div class="col-md-8 d-flex align-items-center right-box">
                    <div class="card-body border-2">
                            <input type="hidden" name="ActID" value="<?= htmlspecialchars($ActID) ?>">
                            <div class="form-group mb-3">
                                <label for="Title" class="form-label">Name</label>
                                <input type="text" class="form-control" name="Title" value="<?= htmlspecialchars($Title) ?>" placeholder="Name" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="Description" class="form-label">Details</label>
                                <textarea class="form-control" name="Description" placeholder="Details" required><?= htmlspecialchars($Description) ?></textarea>
                            </div>
                            <div class="form-group mb-3">
                                <label for="Location" class="form-label">Location</label>
                                <<<<<<< HEAD
                                    <input type="text" class="form-control" name="Location" value="<?= htmlspecialchars($Location) ?>" placeholder="Location" required>
                                    =======
                                    <input type="text" class="form-control" name="Location" value="<?= htmlspecialchars($Location) ?>" placeholder="Location">
                            </div>
                            <div class="form-group mb-3 ">
                                <div class="col-md-6">
                                    <label for="Max" class="form-label">Maximum</label>
                                    <input type="number" class="form-control" name="Max" value="<?= htmlspecialchars($Max) ?>" placeholder="Maximum">
                                </div>
                                >>>>>>> 027d2f296e4bb797841c8c4ab485d963d942049c
                            </div>
                            <div class="form-group mb-3 row">
                                <div class="col-md-6">
                                    <label for="StartDate" class="form-label">Start Date</label>

                                    <input type="date" class="form-control" name="StartDate"
                                        value="<?= date('Y-m-d', strtotime($StartDate)) ?>" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="EndDate" class="form-label">End Date</label>

                                    <input type="date" class="form-control" name="EndDate"
                                        value="<?= date('Y-m-d', strtotime($EndDate)) ?>" required>
                                </div>
                            </div>
                            <div class="form-group mb-3 row">
                                <div class="col-md-6">
                                    <label for="Max" class="form-label">Maximum</label>
                                    <input type="number" class="form-control" name="Max" value="<?= htmlspecialchars($Max) ?>" placeholder="Maximum" required>
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="Status" class="form-label">Status</label>
                                <select class="form-control" name="Status" required>
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                            <input type="hidden" name="UserID" value="<?= htmlspecialchars($CreateBy) ?>">
                            <div class="button-group">
                                <input type="submit" class="btn btn-success" value="UPDATE">
                            </div>
                            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // แสดงตัวอย่างรูปภาพเมื่อเลือกไฟล์
        document.getElementById('imageUpload').addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const preview = document.getElementById('imagePreview');
                    preview.src = e.target.result;
                    preview.style.display = 'block';

                    // ซ่อนรูปภาพปัจจุบันถ้ามี
                    const currentImage = document.getElementById('currentImage');
                    if (currentImage) {
                        currentImage.style.opacity = '0.5'; // ลดความชัดของรูปเดิม
                    }

                    // แสดงปุ่มยกเลิก
                    document.getElementById('cancelUpload').style.display = 'inline-block';
                }
                reader.readAsDataURL(file);
            }
        });

        // ฟังก์ชันยกเลิกการอัปโหลดรูปภาพใหม่
        document.getElementById('cancelUpload').addEventListener('click', function() {
            const preview = document.getElementById('imagePreview');
            preview.src = '';
            preview.style.display = 'none';

            const currentImage = document.getElementById('currentImage');
            if (currentImage) {
                currentImage.style.opacity = '1'; // คืนค่าความชัด
            }

            this.style.display = 'none';
            document.getElementById('imageUpload').value = '';
        });

        // ฟังก์ชันยืนยันการลบรูปภาพ
        function confirmDeleteImage() {
            if (confirm('คุณต้องการลบรูปภาพนี้ใช่หรือไม่?')) {
                document.getElementById('deleteImageFlag').value = '1';
                document.getElementById('currentImage').style.display = 'none';
                document.getElementById('currentImageInput').value = '';

                const defaultImage = 'img/5.png';
                const currentImage = document.getElementById('currentImage');
                currentImage.src = defaultImage;
                currentImage.style.display = 'block';
            }
        }
    </script>
</body>

</html>