<?php
require 'config.php';
require 'ui.php';
$page = "Details";

if (isset($_POST["update"])) {
    $continue = true;

    $id = $_POST["id"];
    $name = $_POST["name"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $confirmPassword = $_POST["confirmpassword"];

    if ($password != $confirmPassword) {
        $_POST["alert"] = "Password doesn't match!";
        $continue = false;
    }

    if (isset($name) && isset($username) && isset($password) && isset($confirmPassword) && $continue) {
        $result = mysqli_query($conn, "UPDATE murid SET name='$name',username='$username',password='$password' WHERE id='$id'");
        header("Location: main.php");
    }
}
if (isset($_GET["id"])) {
    $id = $_GET["id"];

    $result = mysqli_query($conn, "SELECT * FROM murid WHERE id='$id'");

    $user_data = mysqli_fetch_assoc($result);

    $name = $user_data["name"];
    $username = $user_data["username"];
    $password = $user_data["password"];
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

    <title>Adminit | Edit User</title>
</head>

<body>
    <?= $navbar ?>

    <?= $sidebar ?>
    <div class="wrapper">

        <div class="add-container">
            <div class="header">
                <h2>Edit User</h2>

            </div>
            <div class="add-form">
                <form action="edit.php" method="POST">
                    <div class="label-input">
                        <label for="name">Name</label>
                        <input type="text" value="<?= $name ?>" name="name" id="name" required>
                    </div>
                    <div class="label-input">
                        <label for="username">Username</label>
                        <input type="text" value="<?= $username ?>" name="username" id="username" required>
                    </div>
                    <div class="label-input">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" required>
                    </div>
                    <div class="label-input">
                        <label for="confirmpassword">Confirm Password</label>
                        <input type="password" name="confirmpassword" id="confirmpassword" required>
                    </div>
                    <div>
                        <p><?php if (isset($_POST['alert'])) {
                                echo $_POST['alert'];
                            } ?></p>
                    </div>
                    <div class="add-buttons">
                        <input type="hidden" name="id" value=<?= $id ?>>
                        <a class="btn" href="main.php">Back</a>
                        <button type="input" name="update" class="btn">Add</button>
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