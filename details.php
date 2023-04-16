<?php
require 'config.php';
require 'ui.php';

if (isset($_POST["submit"])) {
    $continue = true;
    $name = $_POST["name"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $confirmPassword = $_POST["confirmpassword"];
    $image = $_POST["image"];

    if ($password != $confirmPassword) {
        $_POST["alert"] = "Password doesn't match!";
        $continue = false;
    }

    if (isset($name) && isset($username) && isset($password) && isset($confirmPassword) && isset($image) && $continue) {
        $result = mysqli_query($conn, "INSERT INTO murid(name,username,password,image) VALUES('$name','$username','$password','$image')");
        header("Location: main.php");
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

    <title>Adminit | Details</title>
</head>

<body>

    <?= $navbar ?>
    <?= $sidebar ?>
    <div class="wrapper">
        <div class="add-container">
            <div class="details-container">
                <div class="header">
                    <h2>Details</h2>
                </div>
                <div class="details-content">
                    <div class="details-point">
                        <p>Username</p>
                        <p><?= $_SESSION["user"] ?></p>
                    </div>
                    <div class="details-point">

                        <p>Password</p>
                        <p><?= $_SESSION["password"] ?></p>
                    </div>

                    <div class="details-point">

                        <p>Access</p>
                        <p><?= $_SESSION["access"] ?></p>
                    </div>

                </div>
                <div class="details-buttons">
                    <a class="btn" href="main.php">Back</a>
                </div>
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