<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Event</title>
    <link rel="stylesheet" href="/css/style_addactivity.css">
    <style>
        .image-upload-container {
            position: relative;
            margin-bottom: 15px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 250px;
            /* กำหนดความสูงให้ชัดเจน */
        }

        #currentImage,
        #imagePreview {
            max-width: 100%;
            max-height: 200px;
            border-radius: 8px;
            object-fit: contain;
            /* รักษาสัดส่วนรูปภาพ */
        }

        #currentImage {
            display: block;
            /* แสดงรูปเริ่มต้น */
        }

        #imagePreview {
            display: none;
            /* ซ่อนรูปตัวอย่างเริ่มต้น */
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .cancel-upload-btn {
            margin-top: 10px;
            display: none;
        }

        .form-footer {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .button-group {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 15px;
            margin-top: 20px;
        }

        .left-box {
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="card shadow-sm border-2">
            <form action="/addactivity" method="post" enctype="multipart/form-data">
                <div class="row g-0">
                    <div class="col-md-4 left-box">
                        <div class="card-body text-center">
                            <h2 class="card-title mb-4" style="font-size: 20px;">CREATE EVENT</h2>

                            <div class="image-upload-container">
                                <img src="img/5.png" class="img-fluid rounded-start mb-3" id="currentImage" alt="Event Image">
                                <img id="imagePreview" src="#" alt="Preview Image">
                            </div>

                            <div class="form-group mb-3">
                                <label for="imageUpload" class="form-label">Upload Image</label>
                                <input type="file" class="form-control" name="ImageURL" id="imageUpload" accept="image/*" required>
                            </div>
                            <button type="button" class="btn btn-secondary btn-sm cancel-upload-btn" id="cancelUpload">Cancel Upload</button>

                            <div class="button-group text-center mt-3">
                                <a href="/homeactivity" class="btn btn-danger">CANCEL</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-8 d-flex align-items-center right-box">
                        <div class="card-body border-2">
                            <div class="form-group mb-3">
                                <label for="Title" class="form-label">Name</label>
                                <input type="text" class="form-control" name="Title" placeholder="Name" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="Description" class="form-label">Details</label>
                                <textarea class="form-control" name="Description" placeholder="Details" required></textarea>
                            </div>
                            <div class="form-group mb-3">
                                <label for="Location" class="form-label">Location</label>
                                <input type="text" class="form-control" name="Location" placeholder="Location" required>
                            </div>
                            <div class="form-group mb-3">
                                <div class="col-md-6">
                                    <label for="Max" class="form-label">Maximum</label>
                                    <input type="number" class="form-control" name="Max" placeholder="Maximum" required>
                                </div>
                            </div>
                            <div class="form-group mb-3 row">
                                <div class="col-md-6">
                                    <label for="StartDate" class="form-label">Start Date</label>
                                    <input type="date" class="form-control" name="StartDate" placeholder="Start Date" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="EndDate" class="form-label">End Date</label>
                                    <input type="date" class="form-control" name="EndDate" placeholder="End Date" required>
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="Status" class="form-label">Status</label>
                                <select class="form-control" name="Status" required>
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                            <input type="hidden" name="CreateBy" value="<?= $_SESSION['UserID'] ?>">


                            <div class="form-footer">
                                <button type="submit" class="btn btn-success">CREATE</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
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
                    document.getElementById('currentImage').style.display = 'none';
                    document.getElementById('cancelUpload').style.display = 'block';
                }
                reader.readAsDataURL(file);
            }
        });

        // ฟังก์ชันยกเลิกการอัปโหลด
        document.getElementById('cancelUpload').addEventListener('click', function() {
            document.getElementById('imageUpload').value = '';
            document.getElementById('imagePreview').style.display = 'none';
            document.getElementById('currentImage').style.display = 'block';
            this.style.display = 'none';
        });
    </script>
</body>

</html>