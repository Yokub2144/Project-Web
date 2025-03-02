<section style="display: flex; justify-content: center; align-items: center; min-height: 100vh;">
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
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
                height: 100vh;
            }
            
            .container_singup {
                background-color: #fff;
                border-radius: 30px;
                box-shadow: 0 5px 15px rgba(0, 0, 0, 0.35);
                position: relative;
                overflow: hidden;
                width: 768px;
                max-width: 100%;
                min-height: 480px;
                align-items: center;
                margin-right: 0px;
            }
            
            .container_singup p {
                font-size: 14px;
                line-height: 20px;
                letter-spacing: 0.3px;
                margin: 20px 0;
                align-items: center;
            }
            
            .container_singup span {
                font-size: 12px;
            }
            
            .container_singup a {
                color: #333;
                font-size: 13px;
                text-decoration: none;
                margin: 15px 0 10px;
                align-items: center;
            }
            
            .container_singup button {
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
                transition: background-color 0.3s ease, transform 0.3s ease;
            }
            
            .container_singup button:hover {
                background-color: #3d1e68;
                transform: scale(1.05);
            }
            
            .container_singup button.hidden {
                background-color: transparent;
                border-color: #fff;
            }
            
            .container_singup form {
                background-color: #fff;
                display: flex;
                align-items: center;
                justify-content: center;
                flex-direction: column;
                padding: 0 40px;
                height: 100%;
                align-items: center;
            }
            
            .container_singup input {
                background-color: #eee;
                border: none;
                margin: 8px 0;
                padding: 10px 15px;
                font-size: 13px;
                border-radius: 8px;
                width: 100%;
                outline: none;
            }
            
            .container_singup input:focus {
                border-color: #512da8;
                box-shadow: 0 0 5px rgba(81, 45, 168, 0.5);
            }
            
            .form-container_singup {
                position: absolute;
                top: 0;
                height: 100%;
                transition: all 0.6s ease-in-out;
                opacity: 0;
                animation: fadeIn 0.5s ease-in-out forwards;
            }
            
            @keyframes fadeIn {
                from {
                    opacity: 0;
                    transform: translateY(-20px);
                }
                
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }
            
            .container_singup form h1 {
                margin-bottom: 20px;
                align-items: center;
            }
            
            
            .sign-in {
                left: 0;
                width: 50%;
                z-index: 2;
            }
            
            
            .container_singup.active .sign-in {
                transform: translateX(100%);
            }
            
            .sign-up {
                left: 0;
                width: 50%;
                opacity: 0;
                z-index: 1;
            }
            
            .container_singup.active .sign-up {
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
            
            .toggle-container_singup {
                position: absolute;
                top: 0;
                left: 50%;
                width: 50%;
                height: 100%;
                overflow: hidden;
                transition: all 0.6s cubic-bezier(0.68, -0.55, 0.27, 1.55);
                border-radius: 150px 0 0 100px;
                z-index: 1000;
                box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            }
            
            .container_singup.active .toggle-container_singup {
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
            
            .container_singup.active .toggle {
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
            
            .container_singup.active .toggle-left {
                transform: translateX(0);
            }
            
            .toggle-right {
                right: 0;
                transform: translateX(0);
            }
            
            .container_singup.active .toggle-right {
                transform: translateX(200%);
            }
            </style>
    </head>
    
    <body>
        <div class="container_singup" id="container_singup">
            <div class="form-container_singup sign-in">
                <form  action="/singup" method="post">
                    <input type="text" name="name" placeholder="Name">
                    <input type="email" id="email" name="email" placeholder="Email">
                    <input type="password" id="password" name="password" placeholder="Password">
                    <input type="text" name="phone" placeholder="Phone">
                    <input type="text" name="gender" placeholder="Gender">
                    <input type="number" name="age" placeholder="Age">
                    <input type="file" name="imageProfileURL" placeholder="ImageProfileURL">
                    <input style="background-color: #512da8; color:white" type="submit" value="Signup">
                </form>
                <?php
                if (isset($_SESSION['message'])) {
                    echo $_SESSION['message'];
                }
                ?>
            </div>
            <div class="toggle-container_singup">
                <div class="toggle">
                    <div class="toggle-panel toggle-right">
                        <h1>Sing up</h1>
                        <p>Register with your personal details to use all of site features</p>
                    </div>
                </div>
            </div>
        </div>
    </body>

    </html>
</section>























<!-- <section>
        <div class="form-container ">
            <form action="/singup" method="post">
                <h1>Sign In</h1>
                <input type="text" name="name" placeholder="Name">
                <input type="email" name="email" placeholder="Email">
                <input type="password" name="password" placeholder="Password">
                <input type="text" name="phone" placeholder="Phone">
                <input type="text" name="gender" placeholder="Gender">
                <input type="number" name="age" placeholder="Age">
                <input type="text" name="imageProfileURL"  placeholder="ImageProfileURL">
                <a href="/updatepassword">Forget Your Password?</a>
                <input type="submit" value="Signup">s\
            </form>
        </div>
    <script src="script.js"></script>

</section> -->