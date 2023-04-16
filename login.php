<?php
require 'config.php';

if (isset($_SESSION["request"])) {
    dd($_SESSION["request"]);
}

if (isset($_POST["submit"])) {
    $continue = true;
    $username = $_POST["username"];
    $password = $_POST["password"];

    if (!empty($username) && !empty($password)) {
        $result = mysqli_query($conn, "SELECT * FROM admin WHERE username = '$username' AND password = '$password'");
        if ($result->num_rows == 1) {
            $_SESSION["user"] = $username;
            $_SESSION["password"] = $password;
            $_SESSION["access"] = mysqli_fetch_assoc($result)["access"];
            header("Location: main.php");
        } else {
            $_POST["alert"] = "No account found!";
        }
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

    <title>Login to Adminit</title>
</head>

<body>
    <div class="wrapper" style="display:flex; width: 100%; height: 100%; position:absolute; margin:0;">
        <div class="login-container" style="margin:0;">
            <div class="header">
                <h2>Login to Adminit</h2>
                <p>Organize your team with the best admin control panel!</p>
            </div>
            <div class="add-form">
                <form action="login.php" method="POST">

                    <div class="label-input">
                        <label for="username">Username</label>
                        <input type="text" name="username" id="username" class="form-input">
                    </div>
                    <div class="label-input">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" class="form-input">
                    </div>

                    <div>
                        <p><?php if (isset($_POST['alert'])) {
                                echo $_POST['alert'];
                            } ?></p>
                    </div>
                    <div class="add-buttons">
                        <a class="btn" href="register.php">Register</a>

                        <button type="input" name="submit" class="btn">Login</button>
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