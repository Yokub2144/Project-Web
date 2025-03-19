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
</head>

<body>
    <div class="container">
        <div class="card shadow-sm border-2">
            <div class="row g-0">
                <div class="col-md-4 left-box">
                    <div class="card-body text-center">
                        <h2 class="card-title mb-4" style="font-size: 20px;">EDIT EVENT</h2>
                        <img src="img/5.png" class="img-fluid rounded-start mb-3" alt="Event Image">
                        <form action="/editactivity" method="post" enctype="multipart/form-data">
                            <input type="file" class="form-control" name="ImageURL" placeholder="ImageURL" accept="image/*" required>
                            <div class="button-group">
                                <button class="btn btn-danger">CANCEL</button>
                            </div>
                    </div>
                </div>
                <div class="col-md-8 d-flex align-items-center right-box">
                    <div class="card-body border-2">
<<<<<<< HEAD

                        <input type="hidden" name="ActID" value="<?= htmlspecialchars($ActID) ?>">
                        <div class="form-group mb-3">
                            <label for="Title" class="form-label">Name</label>
                            <input type="text" class="form-control" name="Title" value="<?= htmlspecialchars($Title) ?>" placeholder="Name">
                        </div>
                        <div class="form-group mb-3">
                            <label for="Description" class="form-label">Details</label>
                            <textarea class="form-control" name="Description" placeholder="Details"><?= htmlspecialchars($Description) ?></textarea>
                        </div>
                        <div class="form-group mb-3">
                            <label for="Location" class="form-label">Location</label>
                            <input type="text" class="form-control" name="Location" value="<?= htmlspecialchars($Location) ?>" placeholder="Location">
                        </div>
                        <div class="form-group mb-3 ">
                            <div class="col-md-6">
                                <label for="Max" class="form-label">Maximum</label>
                                <input type="number" class="form-control" name="Max" value="<?= htmlspecialchars($Max) ?>" placeholder="Maximum">
=======
                        <form action="/editactivity" method="post">
                            <input type="hidden" name="ActID" value="<?= htmlspecialchars($ActID) ?>">
                            <div class="form-group mb-3">
                                <label for="Title" class="form-label">Name</label>
                                <input type="text" class="form-control" name="Title" value="<?= htmlspecialchars($Title) ?>" placeholder="Name">
>>>>>>> 25cd666434e8fba6eeb4b605533afecb229411fa
                            </div>
                        </div>
                        <div class="form-group mb-3 row">
                            <div class="col-md-6">
                                <label for="StartDate" class="form-label">Start Date</label>
                                <input type="date" class="form-control" name="StartDate" value="<?= htmlspecialchars($StartDate) ?>" placeholder="Start Date">
                            </div>
                            <div class="col-md-6">
                                <label for="EndDate" class="form-label">End Date</label>
                                <input type="date" class="form-control" name="EndDate" value="<?= htmlspecialchars($EndDate) ?>" placeholder="End Date">
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="Status" class="form-label">Status</label>
                            <select class="form-control" name="Status">
                                <option value="Active" <?= $Status == 'Active' ? 'selected' : '' ?>>Active</option>
                                <option value="Inactive" <?= $Status == 'Inactive' ? 'selected' : '' ?>>Inactive</option>
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
</body>

</html>
