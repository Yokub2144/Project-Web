<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Event</title>
    <link rel="stylesheet" href="/CSS/style_addActivity.css">
    
</head>

<body>
    <div class="container">
        <div class="card shadow-sm border-2">
            <div class="row g-0">
                <div class="col-md-4 left-box">
                    <div class="card-body text-center">
                        <h2 class="card-title mb-4" style="font-size: 20px;">CREATE EVENT</h2>
                        <img src="img/5.png" class="img-fluid rounded-start mb-3" alt="Event Image">
                        <div class="form-group mt-3">
                            <input type="file" class="form-control" name="ImageURL" placeholder="ImageURL">
                        </div>
                        <div class="button-group">
                            <a href="/homeactivity" class="btn btn-danger">CANCEL</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-8 d-flex align-items-center right-box">
                    <div class="card-body border-2">
                        <form action="/addactivity" method="post">
                            <div class="form-group mb-3">
                                <label for="Title" class="form-label">Name</label>
                                <input type="text" class="form-control" name="Title" placeholder="Name">
                            </div>
                            <div class="form-group mb-3">
                                <label for="Description" class="form-label">Details</label>
                                <textarea class="form-control" name="Description" placeholder="Details"></textarea>
                            </div>
                            <div class="form-group mb-3">
                                <label for="Location" class="form-label">Location</label>
                                <input type="text" class="form-control" name="Location" placeholder="Location">
                            </div>
                            <div class="form-group mb-3 ">
                                <div class="col-md-6">
                                    <label for="Max" class="form-label">Maximum</label>
                                    <input type="number" class="form-control" name="Max" placeholder="Maximum">
                                </div>
                            </div>
                            <div class="form-group mb-3 row">
                                <div class="col-md-6">
                                    <label for="StartDate" class="form-label">Start Date</label>
                                    <input type="date" class="form-control" name="StartDate" placeholder="Start Date">
                                </div>
                                <div class="col-md-6">
                                    <label for="EndDate" class="form-label">End Date</label>
                                    <input type="date" class="form-control" name="EndDate" placeholder="End Date">
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="Status" class="form-label">Status</label>
                                <select class="form-control" name="Status">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                            <input type="hidden" name="UserID" value="<?= $UserID ?>">
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