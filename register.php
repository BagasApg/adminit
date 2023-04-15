<?php
require 'config.php';

if (isset($_POST["submit"])) {
    $continue = true;
    $username = $_POST["username"];
    $password = $_POST["password"];
    $confirmPassword = $_POST["confirmpassword"];
    $access = $_POST["access"];

    if ($confirmPassword !== $password) {
        $continue = false;
    }

    if (!empty($username) && !empty($password) && !empty($confirmPassword) && !empty($access) && $continue) {
        $result = mysqli_query($conn, "INSERT INTO admin(username,password,access) VALUES('$username','$password','$access')");
        // $_POST["alert"] = "Created!"
        header("Location: login.php");
    } else if (!$continue) {
        $_POST["alert"] = "Password doesn't match!";
    } else {
        $_POST["alert"] = "Fill the blank form!";
    }
} else {
    session_destroy();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <script src="jquery-3.6.4.js"></script>

    <title>Register</title>
</head>

<body>
    <div class="wrapper" style="display:flex; width: 100%; height: 100%; position:absolute; margin:0;">
        <div class="login-container" style="margin:0;">
            <div class="header">
                <h2>Register to Adminit</h2>
                <p>Start your organized life, now!</p>
            </div>
            <div class="add-form">
                <form action="register.php" method="POST">

                    <div class="label-input">
                        <label for="username">Username</label>
                        <input type="text" name="username" id="username" class="form-input">
                    </div>
                    <div class="label-input">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" class="form-input">
                    </div>
                    <div class="label-input">
                        <label for="confirmpassword">Confirm Password</label>
                        <input type="password" name="confirmpassword" id="confirmpassword" class="form-input">
                    </div>
                    <div class="label-radio">
                        <label for="access" style="display:block">Has access?</label>
                        <input type="radio" name="access" id="yes" value="true">
                        <label for="yes">Yes</label>
                        <input type="radio" name="access" id="no" value="false">
                        <label for="no">No</label>
                    </div>

                    <div>
                        <p><?php if (isset($_POST['alert'])) {
                                echo $_POST['alert'];
                            } ?></p>
                    </div>
                    <div class="add-buttons">

                        <a class="btn" href="login.php">Login</a>

                        <button type="input" name="submit" class="btn">Register</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        <?= $navbar_js ?>


        $('.shadow-bg').click(function() {
            $('.shadow-bg').toggleClass('d-none')
            $('.sidebar').toggleClass('open')

        });

        function openSidebar() {
            $('.shadow-bg').toggleClass('d-none')
            // $('.sidebar').toggle('.sidebar-close')
            $('.sidebar').toggleClass('open')
            // $('.sidebar').css('right', '0')
        }
    </script>
</body>

</html>