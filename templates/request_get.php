<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Activity Participants</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/style_request.css">

</head>

<body>
    <div class="container mt-5">
        <div class="card shadow-lg p-4">
        <ul class="nav nav-tabs">
  <li class="nav-item">
    <a class="nav-link" aria-current="page" href="#">Request</a>
  </li>
  <li class="nav-item">
    <form action="/namecheck" method="get">
        <input type="hidden" name="ActID" value="<?php echo htmlspecialchars($_GET['ActID']); ?>">
        
        <button type="submit" class="nav-link">Name</button>
    </form>
</li>
</ul>
            <h1 class="text-center mb-4">Activity Participants</h1>
            <?php
            if (isset($_GET['ActID']) || isset($_POST['ActID'])) {
                $ActID = $_GET['ActID'];
                $Activity = getactivityByActID($ActID);

                // ดึงรหัสกิจกรรมจากไฟล์ หรือสร้างใหม่ถ้ายังไม่มี
                $Activity['JoinCode'] = getActivityCode($ActID);
                if (!$Activity['JoinCode']) {
                    $Activity['JoinCode'] = generateAndSaveActivityCode($ActID);
                }
            } else {
                echo "<div class='alert alert-danger'>ไม่ได้รับ Activity ID</div>";
                exit();
            }
            $users = joinActivity($Activity['ActID']);
            ?>
            <div class="alert alert-info text-center">
                <strong>รหัสเข้าร่วมกิจกรรม:</strong> <?php echo htmlspecialchars($Activity['JoinCode']); ?>
            </div>
            <?php if ($ActID && !empty($users)): ?>
                <?php
                // ตรวจสอบว่ามีผู้ใช้ที่ Status ไม่ใช่ 'Approved' หรือ 'Rejected' หรือไม่
                $pendingUsers = array_filter($users, function ($user) {
                    return $user['Status'] !== 'Approved' && $user['Status'] !== 'Rejected';
                });
                ?>

                <?php if (!empty($pendingUsers)): ?>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>UserID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Age</th>
                                    <th> </th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($pendingUsers as $user): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($user['UserID']); ?></td>
                                        <td><?php echo htmlspecialchars($user['Name']); ?></td>
                                        <td><?php echo htmlspecialchars($user['Email']); ?></td>
                                        <td><?php echo htmlspecialchars($user['Age']); ?></td>
                                        <td>
                                            <form action="/request" method="post">
                                                <input type="hidden" name="UserID" value="<?php echo $user['UserID']; ?>">
                                                <input type="hidden" name="ActID" value="<?php echo $Activity['ActID']; ?>">
                                                <input type="hidden" name="Status" value="Approved">
                                                <button type="submit" class="btn btn-primary btn-sm mx-1">
                                                    Approved
                                                </button>
                                            </form>
                                        </td>
                                        <td>
                                            <form action="/request" method="post">
                                                <input type="hidden" name="UserID" value="<?php echo $user['UserID']; ?>">
                                                <input type="hidden" name="ActID" value="<?php echo $Activity['ActID']; ?>">
                                                <input type="hidden" name="Status" value="Rejected">
                                                <button type="submit" class="btn btn-danger btn-sm mx-1">
                                                    Rejected
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <div class="alert alert-info text-center">ไม่มีคำขอที่รออนุมัติ</div>
                <?php endif; ?>

            <?php else: ?>
                <div class="alert alert-warning text-center">No participants found for the given Activity ID.</div>
            <?php endif; ?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>