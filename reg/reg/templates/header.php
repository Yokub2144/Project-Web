<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ระบบลงทะเบียนเรียน</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* กำหนดพื้นฐานของหน้าเว็บ */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #121212;
            color: white;
            text-align: center;
        }

        /* ส่วนหัว */
        header {
            background: #1e88e5;
            padding: 20px;
            font-size: 24px;
            font-weight: bold;
            color: white;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }

        /* เมนูนำทาง */
        nav {
            background: #222;
            padding: 10px 0;
            display: flex;
            justify-content: center;
            gap: 15px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }

        nav a {
            color: white;
            text-decoration: none;
            padding: 10px 15px;
            border-radius: 5px;
            transition: background 0.3s;
        }

        nav a:hover {
            background: #1e88e5;
        }
    </style>
</head>
<script>
    function confirmRegis() {
        return confirm('ยืนยันการลงทะเบียนรายวิชานี้?');
    }
    function confirmdelete() {
        return confirm('ยืนยันการลบ?');
    }
</script>
<body>
    <header>
        <h1>ระบบลงทะเบียนเรียน</h1>
    </header>
    <nav>
        <a href="/">หน้าแรก</a>
        <?php if (isset($_SESSION['timestamp'])) { ?>
            <a href="/profile">ข้อมูลนักเรียน</a>
            <a href="/courses">รายวิชา</a>
            <a href="/logout">ออกจากระบบ</a>
        <?php } else { ?>
            <a href="/login">เข้าสู่ระบบ</a>
        <?php } ?>
    </nav>
</body>

</html>
