<section class="login-container">
    <h1>เข้าสู่ระบบ</h1>
    <form action="/login" method="post">
        <label for="email">อีเมล:</label><br>
        <input type="email" id="email" name="email"><br>
        <label for="password">รหัสผ่าน:</label><br>
        <input type="password" id="password" name="password"><br><br>
        <input type="submit" value="เข้าสู่ระบบ">
    </form>
    <?php
    if (isset($_SESSION['message'])) {
        echo $_SESSION['message'];
    }
    ?>
</section>