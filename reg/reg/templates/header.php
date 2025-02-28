<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ระบบลงทะเบียนเรียน</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* นำเข้า Font "San Francisco" */
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap');

        /* กำหนดพื้นฐานของหน้าเว็บ */
        body {
            font-family: "San Francisco", "Inter", Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(180deg, #000, #1a1a1a);
            color: white;
            text-align: center;
        }

        /* ส่วนหัวแบบมี Gradient & Shadow */
        header {
            background: linear-gradient(90deg, rgba(0, 0, 0, 0.8), rgba(50, 50, 50, 0.8));
            padding: 20px;
            font-size: 28px;
            font-weight: bold;
            color: white;
            text-shadow: 2px 2px 5px rgba(255, 255, 255, 0.2);
            box-shadow: 0 4px 10px rgba(255, 255, 255, 0.1);
            border-bottom: 2px solid rgba(255, 255, 255, 0.2);
        }

        /* เมนูนำทางแบบ Floating Effect */
        nav {
            background: rgba(30, 30, 30, 0.9);
            padding: 12px 0;
            display: flex;
            justify-content: center;
            gap: 20px;
            box-shadow: 0 3px 8px rgba(255, 255, 255, 0.1);
            position: sticky;
            top: 0;
            z-index: 100;
            transition: all 0.3s ease-in-out;
        }

        /* ลิงก์ในเมนูนำทาง */
        nav a {
            color: white;
            text-decoration: none;
            padding: 12px 18px;
            font-size: 18px;
            font-weight: 500;
            transition: all 0.3s ease-in-out;
            border-radius: 8px;
        }

        /* Hover Effect ให้ดู Smooth */
        nav a:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: scale(1.08);
            box-shadow: 0px 5px 15px rgba(255, 255, 255, 0.15);
        }

        /* ปุ่ม Hover ให้มี Glow Effect */
        .glow-button {
            background: linear-gradient(45deg, #ff416c, #ff4b2b);
            padding: 12px 18px;
            font-size: 18px;
            font-weight: 600;
            border: none;
            border-radius: 8px;
            color: white;
            cursor: pointer;
            transition: all 0.3s ease-in-out;
            box-shadow: 0 4px 15px rgba(255, 0, 100, 0.5);
        }

        .glow-button:hover {
            background: linear-gradient(45deg, #ff4b2b, #ff416c);
            transform: scale(1.08);
            box-shadow: 0 6px 25px rgba(255, 0, 100, 0.7);
        }
    </style>
</head>

<body>
    <header>
        🚀 ระบบลงทะเบียนเรียน
    </header>

    <nav>
        <a href="/">🏠 หน้าแรก</a>
        <?php if (isset($_SESSION['timestamp'])) { ?>
            <a href="/profile">📄 ข้อมูลนักเรียน</a>
            <a href="/courses">📚 รายวิชา</a>
            <a href="/logout" class="glow-button">🚪 ออกจากระบบ</a>
        <?php } else { ?>
            <a href="/login" class="glow-button">🔑 เข้าสู่ระบบ</a>
        <?php } ?>
    </nav>
</body>

</html>
