<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Event</title>
    <link rel="stylesheet" href="/css/style_addactivity.css">
</head>

<body>
    <div class="container">
        <div class="card shadow-sm border-2">
            <div class="row g-0">
                <div class="col-md-4 left-box">
                    <div class="card-body text-center">
                        <h2 class="card-title mb-4" style="font-size: 20px;">CREATE EVENT</h2>
                        <img src="img/5.png" class="img-fluid rounded-start mb-3" alt="Event Image">
                        <form action="/addactivity" method="post" enctype="multipart/form-data">
                            <input type="file" name="ImageURL" accept="image/*" required>
                     
                        <div class="button-group">
                            <a href="/homeactivity" class="btn btn-danger">CANCEL</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-8 d-flex align-items-center right-box">
                    <div class="card-body border-2">
<<<<<<< HEAD
                     
=======
                        <form action="/addactivity" method="post">
>>>>>>> 25cd666434e8fba6eeb4b605533afecb229411fa
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
                            <div class="button-group">
                                <input type="submit" class="btn btn-success" value="CREATE">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>