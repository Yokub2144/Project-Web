<section class="login-container" style="display: flex; justify-content: center; align-items: center; min-height: 100vh;">
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="/css/style_login.css">
    <title>Modern Login Page | AsmrProg</title>


</head>


<body>
<div class="container_login" id="container_login">
        <div class="form-container_login sign-in">
                <form action="/login" method="post">
                <h1>Sign In</h1>
                <input type="email" id="email" name="email" placeholder="Email"><br>
                <input type="password" id="password" name="password" placeholder="Password"><br><br>
                <a href="#">Forget Your Password?</a>
                <!-- <button>Sign In</button> -->
                <input style="background-color: #55065c; color :white " type="submit" value="Sign in">
            </form>
            <?php
    if (isset($_SESSION['message'])) {
        echo $_SESSION['message'];
    }
    ?>
        </div>
        <div class="toggle-container_login">
            <div class="toggle">
                
                <div class="toggle-panel toggle-right">
                    <h1>Hello, Friend!</h1>
                    <p>Wellcome to Active Zone</p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
</section>





<!-- <section class="login-container"> -->
  
    <!-- <h1>เข้าสู่ระบบ</h1>
    <form action="/login" method="post">
        <label for="email">อีเมล:</label><br>
        <input type="email" id="email" name="email"><br>
        <label for="password">รหัสผ่าน:</label><br>
        <input type="password" id="password" name="password"><br><br>
        <input type="submit" value="เข้าสู่ระบบ">
    </form>
    <?php
    // if (isset($_SESSION['message'])) {
    //     echo $_SESSION['message'];
    // }
    // ?> -->
    
<!-- </section> -->