<?php
require 'config.php';
if (isset($_POST["submit"])) {
    // dd($_POST["access"]);
    $continue = true;
    $username = $_POST["username"];
    $password = $_POST["password"];
    $confirmPassword = $_POST["confirmpassword"];
    if (!isset($_POST["access"])) {
        $access = "false";
    } else if ($_POST['access'] == "true") {
        $access = "true";
    } else {
        $access = "false";
    }
    // dd($access);

    if ($confirmPassword !== $password) {
        $continue = false;
    }


    if (!empty($username) && !empty($password) && !empty($confirmPassword) && !empty($access) && $continue) {
        $result = mysqli_query($conn, "INSERT INTO admin(username,password,access) VALUES('$username','$password','$access')");
        // $_POST["alert"] = "Created!"
        if ($_SESSION["request"] == "allow") {
            redirect("main.php");
        } else {
            redirect("login.php");
        }
    } else if (!$continue) {
        // session_destroy();
        $_POST["alert"] = "Password doesn't match!";
    } else {
        // session_destroy();
        $_POST["alert"] = "Fill the blank form!";
    }
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

    <title>
        <?php if (isset($_SESSION["request"]) && $_SESSION["request"] == "allow") : ?>
            Adminit | Add Admin
        <?php else : ?>
            Register to Adminit
        <?php endif; ?>
    </title>
</head>

<body style="margin-top: 45px;">
    <?php

    if (isset($_SESSION["request"]) && $_SESSION["request"] == "allow") {
        require 'ui.php';
        echo $navbar;
        echo $sidebar;
    }

    ?>
    <div class="wrapper" style="display:flex; width: 100%; height: 100%; position:fixed; margin:0;">
        <div class="login-container" style="margin-top :-65px;">

            <div class="header">
                <?php

                if (isset($_SESSION["request"]) && $_SESSION["request"] == "allow") {

                    $registerPage = "Register New Admin";
                    $_SESSION["request"] = "allow";
                    // var_dump($_SESSION["request"]);
                } else {
                    $registerPage = "Register to Adminit";
                    $_SESSION["request"] = "no";
                    // var_dump($_SESSION["request"]);
                }

                ?>
                <h2><?= $registerPage ?></h2>
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
                        <div style="position: relative; " class="inputsakkarepmu">
                            <input type="password" name="password" id="password" class="form-input">
                            <img class="showpass" src="assets\eye-off.svg" alt="">

                        </div>
                    </div>
                    <div class="label-input">
                        <label for="confirmpassword">Confirm Password</label>
                        <input type="password" name="confirmpassword" id="confirmpassword" class="form-input">
                    </div>
                    <?php
                    if (isset($_SESSION["request"]) && $_SESSION["request"] == "allow") :
                    ?>
                        <div class="label-radio">
                            <label for="access" style="display:block">Grant access?</label>
                            <input type="checkbox" name="access" id="yes" value="true">
                            <label for="yes">Yes</label>
                            <p class="adminnote">*NOTE : Leaving this box blank will grants no admin privilege to the created account.</p>
                        </div>

                    <?php else : ?>

                        <input type="hidden" name="access" value="nonadmininput">
                    <?php endif; ?>
                    <div>
                        <p><?php if (isset($_POST['alert'])) {
                                echo $_POST['alert'];
                            } ?></p>
                    </div>
                    <div class="add-buttons">

                        <?php if (isset($_SESSION["request"]) && $_SESSION["request"] == "allow") : ?>
                            <a class="btn" href="main.php">Back</a>

                        <?php else : ?>
                            <a class="btn" href="login.php">Login</a>
                        <?php endif; ?>

                        <button type="input" name="submit" class="btn">Register</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>


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

        // show pass
        $(document).ready(function() {
            var passState = "password"
            $('.showpass').click(function() {
                // $('body').css('color', 'red')
                if (passState == "password") {
                    $('input#password').attr('type', 'text')
                    $('.showpass').attr("src", "assets/eye.svg")
                    passState = "text";
                } else if (passState == "text") {
                    $('input#password').attr('type', 'password')
                    $('.showpass').attr("src", "assets/eye-off.svg")
                    passState = "password";
                }
                // alert("hi")
            });
        });
    </script>
</body>

</html>