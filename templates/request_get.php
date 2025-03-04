<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Activity Participants</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="card shadow-lg p-4">
            <h1 class="text-center mb-4">Activity Participants</h1>
            <?php
            if (isset($_GET['ActID'])) {
                $ActID = $_GET['ActID'];
                $Activity = getactivityByActID($ActID);
            } else {
                echo "<div class='alert alert-danger'>ไม่ได้รับ Activity ID</div>";
                exit();
            }
            $users = joinActivity($Activity['ActID']);
            ?>
            <?php if ($ActID && !empty($users)): ?>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead class="table-dark">
                            <tr>
                                <th>UserID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Age</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($users as $user): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($user['UserID']); ?></td>
                                    <td><?php echo htmlspecialchars($user['Name']); ?></td>
                                    <td><?php echo htmlspecialchars($user['Email']); ?></td>
                                    <td><?php echo htmlspecialchars($user['Age']); ?></td>
                                    <td>
                                        <span class="badge bg-<?php echo ($user['Status'] == 'Active') ? 'success' : 'secondary'; ?>">
                                            <?php echo htmlspecialchars($user['Status']); ?>
                                        </span>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <div class="alert alert-warning text-center">No participants found for the given Activity ID.</div>
            <?php endif; ?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>