<?php
$ActID = (int)$_GET['ActID'];
?>
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
                    <form action="/request" method="get" class="d-flex justify-content-end">
                        <input type="hidden" name="ActID" value="<?php echo htmlspecialchars($ActID); ?>">
                        <button type="submit" class="nav-link">Request</button>
                    </form>
                </li>
                <li class="nav-item">
                    <form action="/namecheck" method="get">
                        <input type="hidden" name="ActID" value="<?php echo htmlspecialchars($ActID); ?>">
                        <button type="submit" class="nav-link">Name</button>
                    </form>
                </li>
            </ul>
            <h1 class="text-center mb-4">รายชื่อที่เช็คอินแล้ว</h1>
            <?php
            $users = joinActivity($ActID);
            $checkedInUsers = array_filter($users, function ($user) {
                return $user['CheckedIn'] === 1;
            });
            ?>


            <?php if (!empty($checkedInUsers)): ?>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>UserID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Age</th>
                                <th>Phone</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($checkedInUsers as $user): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($user['UserID']); ?></td>
                                    <td><?php echo htmlspecialchars($user['Name']); ?></td>
                                    <td><?php echo htmlspecialchars($user['Email']); ?></td>
                                    <td><?php echo htmlspecialchars($user['Age']); ?></td>
                                    <td><?php echo htmlspecialchars($user['Phone']); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <div class="alert alert-info text-center">ยังไม่มีผู้เช็คอินเข้าร่วมกิจกรรมนี้</div>
            <?php endif; ?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>