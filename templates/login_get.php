<section class="login-container" style="display: flex; justify-content: center; align-items: center; min-height: 100vh;">
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <!-- <link rel="stylesheet" href="style.css"> -->
    <title>Modern Login Page | AsmrProg</title>

    <style>
       @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap');

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Montserrat', sans-serif;
}

body {
    background-color: #c9d6ff;
    background-image: url('img/3.png');
    background-size: cover;
    /*align-items: center;
    justify-content: center;
    flex-direction: column;*/
    height: 100vh;
}

.container_login {
    background-color: #fff;
    border-radius: 30px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.35);
    position: relative;
    overflow: hidden;
    width: 768px;
    max-width: 100%;
    min-height: 480px;
    align-items: center;
}

.container_login p {
    font-size: 14px;
    line-height: 20px;
    letter-spacing: 0.3px;
    margin: 20px 0;
    align-items: center;
}

.container_login span {
    font-size: 12px;
}

.container_login a {
    color: #333;
    font-size: 13px;
    text-decoration: none;
    margin: 15px 0 10px;
    align-items: center;
}

.container_login button {
    background-color: #512da8;
    color: #fff;
    font-size: 12px;
    padding: 10px 45px;
    border: 1px solid transparent;
    border-radius: 8px;
    font-weight: 600;
    letter-spacing: 0.5px;
    text-transform: uppercase;
    margin-top: 10px;
    cursor: pointer;
}


.container_login button.hidden {
    background-color: transparent;
    border-color: #fff;
}

.container_login form {
    background-color: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
    padding: 0 40px;
    height: 100%;
    align-items: center;
}

.container_login input {
    background-color: #eee;
    border: none;
    margin: 8px 0;
    padding: 10px 15px;
    font-size: 13px;
    border-radius: 8px;
    width: 100%;
    outline: none;
}

.form-container_login {
    position: absolute;
    top: 0;
    height: 100%;
    transition: all 0.6s ease-in-out;
}
.container_login form h1 {
    margin-bottom: 40px;
    align-items: center;
}


.sign-in {
    left: 0;
    width: 50%;
    z-index: 2;
}


.container_login.active .sign-in {
    transform: translateX(100%);
}

.sign-up {
    left: 0;
    width: 50%;
    opacity: 0;
    z-index: 1;
}

.container_login.active .sign-up {
    transform: translateX(100%);
    opacity: 1;
    z-index: 5;
    animation: move 0.6s;
}

@keyframes move {

    0%,
    49.99% {
        opacity: 0;
        z-index: 1;
    }

    50%,
    100% {
        opacity: 1;
        z-index: 5;
    }
}

.social-icons {
    margin: 20px 0;
}

.social-icons a {
    border: 1px solid #ccc;
    border-radius: 20%;
    display: inline-flex;
    justify-content: center;
    align-items: center;
    margin: 0 3px;
    width: 40px;
    height: 40px;
}

.toggle-container_login {
    position: absolute;
    top: 0;
    left: 50%;
    width: 50%;
    height: 100%;
    overflow: hidden;
    transition: all 0.6s ease-in-out;
    border-radius: 150px 0 0 100px;
    z-index: 1000;
}

.container_login.active .toggle-container_login {
    transform: translateX(-100%);
    border-radius: 0 150px 100px 0;
}

.toggle {
    background-color: #512da8;
    height: 100%;
    background: linear-gradient(to right, #040613, #21105e);
    color: #fff;
    position: relative;
    left: -100%;
    height: 100%;
    width: 200%;
    transform: translateX(0);
    transition: all 0.6s ease-in-out;
}

.container_login.active .toggle {
    transform: translateX(50%);
}

.toggle-panel {
    position: absolute;
    width: 50%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
    padding: 0 30px;
    text-align: center;
    top: 0;
    transform: translateX(0);
    transition: all 0.6s ease-in-out;
}

.toggle-left {
    transform: translateX(-200%);
}

.container_login.active .toggle-left {
    transform: translateX(0);
}

.toggle-right {
    right: 0;
    transform: translateX(0);
}

.container_login.active .toggle-right {
    transform: translateX(200%);
} 
    </style>
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
                <input style="background-color: #512da8; color :white " type="submit" value="Sign in">
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