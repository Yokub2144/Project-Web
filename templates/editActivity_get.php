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
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Montserrat', sans-serif;
        }

        body {
            background-image: url('img/bg_green.png');
            background-size: cover;
            height: 100vh;
        }

        .container {
            border-radius: 30px;
            width: 900px;
            max-width: 100%;
            min-height: 300px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .card {
            background-color: rgba(106, 99, 99, 0.2);
            border-radius: 15px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 900px;
            overflow-y: auto;
        }

        .card-body {
            border-radius: 15px;
            padding: 20px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: 100%;
        }

        .card-title,
        .form-label {
            font-family: 'Comic Sans MS', cursive, sans-serif;
            color: white;
            font-weight: bold;
        }

        .form-control {
            border-radius: 20px;
            margin-bottom: 10px;
        }

        .btn {
            border-radius: 20px;
        }

        .btn-success {
            font-size: 1rem;
            padding: 10px 20px;
            background-color: #28a745;
            border: none;
            color: white;
            font-weight: bold;
            width: 200px;
        }

        .btn-danger {
            font-size: 1rem;
            padding: 10px 20px;
            background-color: #dc3545;
            border: none;
            color: white;
            font-weight: bold;
            width: 150px;
        }

        .left-box {
            background-color: rgba(199, 190, 190, 0.1);
            padding: 20px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .right-box {
            background-color: rgba(222, 214, 214, 0.);
            padding: 20px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            color: white;
        }

        .button-group {
            display: flex;
            justify-content: center;
            margin-top: 20px;
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
                        <img src="img/5.png" class="img-fluid rounded-start mb-3" alt="Event Image">
                        <div class="form-group mt-3">
                            <input type="file" class="form-control" name="ImageURL" placeholder="ImageURL">
                        </div>
                        <div class="button-group">
                            <button class="btn btn-danger">CANCEL</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-8 d-flex align-items-center right-box">
                    <div class="card-body border-2">
                        <form action="/editActivity" method="post">
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