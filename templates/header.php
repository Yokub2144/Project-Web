<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Active Zone</title>
    <link rel="icon" href="img/logo.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<<<<<<< HEAD
    <!-- <link rel="stylesheet" href="/Style/Style.css"> -->
    <style>
        .navbar {
            padding: 15px 20px;
            background-color: rgba(0, 0, 0, 0);
            /* โปร่งใส */
        }

        .navbar-brand {
            font-size: 1.5rem;
            font-weight: bold;
            color: white;
        }

        .nav-link {
            color: white !important;
        }

        .custom-input {
            width: 250px;
            padding: 8px 12px;
            border-radius: 20px;
            border: 2px solid white;
            background-color: transparent;
            color: white;
            transition: background-color 0.3s, color 0.3s, border-color 0.3s;
        }

        .custom-input::placeholder {
            color: rgba(255, 255, 255, 0.7);
        }

        .custom-input:hover,
        .custom-input:focus {
            background-color: rgba(255, 255, 255, 0.2);
            color: white;
            outline: none;
        }

        .custom-btn {
            padding: 8px 20px;
            border-radius: 25px;
            border: 2px solid white;
            background-color: transparent;
            color: white;
            font-size: 16px;
            cursor: pointer;
            transition: all 0.3s ease-in-out;
        }

        .custom-btn:hover {
            background-color: rgba(255, 255, 255, 0.2);
            color: white;
        }

        .custom-btn:active {
            transform: scale(0.95);
        }

        .dropdown-menu {
            left: -100px;
            /* ปรับค่าตามที่ต้องการ */
        }
    </style>
=======
    <link rel="stylesheet" href="/CSS/style_header.css">
 
>>>>>>> 6205b9d8a41ff70004237d6a82911859190231d0
</head>

<body>
    <!-- แสดง Alert ถ้ามีข้อความแจ้งเตือน -->
    <?php if (isset($_SESSION['alert'])): ?>
        <div class="alert alert-warning alert-dismissible fade show text-center" role="alert">
            <?= $_SESSION['alert']; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        <?php unset($_SESSION['alert']); ?>
    <?php endif; ?>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="/homeactivity">ActiveZone</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="/homeactivity">Home</a>
                    </li>
                    <?php if (isset($_SESSION['timestamp'])): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="/profile">Profile</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/addActivity">Add Activity</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="/logout">Logout</a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link" href="/login">Sign In</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/singup">Sign Up</a>
                        </li>
                    <?php endif; ?>
                </ul>

                </form>
                <formclass="d-flex" action="/searchBydate" method="post">
                    
                </form>
                <!-- Search Bar -->
                <form class="d-flex" action="/search" method="post">
                    <input class="custom-input me-2" type="text" name="keyword" placeholder="Enter keyword" value="<?= isset($_GET['keyword']) ? htmlspecialchars($_GET['keyword']) : '' ?>">
                    <div class="dropdown">
                        <button class="custom-btn dropdown-toggle" type="button" id="filterDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-filter"></i> Filter
                        </button>
                        <ul class="dropdown-menu p-1" aria-labelledby="filterDropdown">
                            <li>
                                <label for="startDate" class="form-label">Start Date</label>
                                <input type="date" class="form-control" id="startDate" name="startDate">
                            </li>
                            <li>
                                <label for="endDate" class="form-label">End Date</label>
                                <input type="date" class="form-control" id="endDate" name="endDate">
                            </li>
                        </ul>
                    </div>
                    <button class="custom-btn " type="submit" value="Search">Search</button>

            </div>
        </div>
    </nav>

    <!-- Bootstrap Script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>