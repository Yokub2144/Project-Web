<section style="display: flex; justify-content: center; align-items: center; min-height: 100vh;">
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
        <title>Modern Login Page | AsmrProg</title>
        <link rel="stylesheet" href="/CSS/style_singup.css">


    </head>

    <body>
        <div class="container_singup" id="container_singup">
            <div class="form-container_singup sign-in">
                <form action="/singup" method="post">
                    <input type="text" name="name" placeholder="Name"required>
                    <input type="email" id="email" name="email" placeholder="Email"required>
                    <input type="password" id="password" name="password" placeholder="Password"required>
                    <input type="text" name="phone" placeholder="Phone"required>
                    <select name="gender" required>
                        <option value="">Gender</option>
                        <option value="Male">ชาย</option>
                        <option value="Female">หญิง</option>
                        <option value="Other">อื่นๆ</option>
                    </select>
                    <input type="number" name="age" placeholder="Age"required>
                    <input type="file" name="imageProfileURL" placeholder="ImageProfileURL">
                    <input style="background-color: #55065c; color:white" type="submit" value="Signup">
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
                        <h1>Sign up</h1>
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