<?php
require 'config.php';



if (isset($_POST["submit"])) {
    var_dump($_POST["submit"]);
    $continue = true;
    $username = $_POST["username"];
    $password = hash('haval192,4', $_POST["password"]);
    // dd($password);

    if (!empty($username) && !empty($password)) {
        $result = mysqli_query($conn, "SELECT * FROM admin WHERE username = '$username' AND password = '$password'");
        if ($result->num_rows == 1) {
            $_SESSION["user"] = $username;
            $_SESSION["password"] = $password;
            $_SESSION["access"] = mysqli_fetch_assoc($result)["access"];
            $_SESSION["firstMessage"] = "true";
            header("Location: main.php");
        } else {
            $_SESSION["alert"] = "No account found!";
            redirect("login.php");
        }
    } else {
        $_SESSION["alert"] = "Fill the blank form!";
        redirect("login.php");
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
    <div class="auth-wrapper">
        <div class="login-container <?php if (isset($_SESSION["request"]) && $_SESSION["request"] != "allow") {

                                        echo "login-register-container";
                                    } ?>" style="margin:0;">
            <div class="add-header">
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
                        <div style="position: relative; " class="inputsakkarepmu">
                            <input type="password" name="password" id="password" class="form-input">
                            <img class="showpass" src="assets\eye-off.svg" alt="">

                        </div>

                        </input>
                    </div>

                    <div>
                        <p><?php if (isset($_SESSION['alert'])) {
                                echo $_SESSION['alert'];
                            } ?></p>
                    </div>
                    <div class="login-buttons">

                        <button style="width: 100%; height: 36px;" value="slebew" type="input" name="submit" class="btn btn-main">Login</button>
                        <p style="color: black; font-size:16px; padding: 0" class="register-instead">Don't have account? <a href="register.php">Register now!</a></p>
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

        $('.sidebar').attr("style", "margin-top: 55px;");

        function openSidebar() {
            $('.shadow-bg').toggleClass('d-none')
            // $('.sidebar').toggle('.sidebar-close')
            $('.sidebar').toggleClass('open')
            // $('.sidebar').css('right', '0')
        }
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