
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ระบบลงทะเบียนเรียน</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"> 
    <link rel="stylesheet" href="/Style/Style.css">
</head>
<style>
    
</style>
<body>
    <?php if (isset($_SESSION['alert'])): 
        echo $_SESSION['alert']; 
        unset($_SESSION['alert']); // ลบข้อความแจ้งเตือนหลังจากแสดงแล้ว 
        ?>
    <?php endif; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script> 
    <nav class="navbar navbar-expand-lg  bg-dark " data-bs-theme="dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">ActiveZone</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/main">HOME</a>
                    </li>
                    <li class="nav-item">
                        <?php
                        if (isset($_SESSION['timestamp'])) {
                        ?>
                            <a class="nav-link active" aria-current="page" href="/profile">profile</a>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/activity">Activity</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/logout">ออกจากระบบ</a>
                    </li>
                <?php
                        } else {
                ?>
                    <a class="nav-link active" aria-current="page" href="/login">Sing in</a>
                    <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/singup">Sing up</a>
                    </li>
                <?php
                        }
                ?>
                </li>
                </ul>
            </div>
        </div>
    </nav>
</body>

</html>
