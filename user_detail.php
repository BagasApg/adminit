<?php
require 'config.php';
require 'ui.php';

$id = $_GET["id"];

$result = mysqli_query($conn, "SELECT * FROM murid WHERE id = '$id'");
$data = mysqli_fetch_object($result);

$name = $data->name;
$username = $data->username;
$password = $data->password;
$image = $data->image;

if (!isset($_SESSION["user"])) {
    header("Location: login.php");
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

    <title>Adminit | User Details</title>
</head>

<body>
    <?= $navbar ?>
    <?= $sidebar ?>
    <div class="wrapper">
        <div class="add-container">
            <div class="user-detail-container">

                <div class="user-detail-header">
                    <h2><?= $name ?>'s Details</h2>
                </div>
                <div class="user-detail-body">
                    <div class="user-detail-left">
                        <img width="200px" src="images/<?= $image ?>" alt="">
                    </div>
                    <div class="user-detail-right">
                        <p class="bold user-detail-label">ID</p>
                        <p><?= $id ?></p>
                        <p class="bold user-detail-label">Name</p>
                        <p><?= $name ?></p>
                        <p class="bold user-detail-label">Username</p>
                        <p><?= $username ?></p>
                        <?php if ($_SESSION["access"] == "true") : ?>

                            <p class="bold user-detail-label">Password</p>
                            <p><?= $password ?></p>
                        <?php endif; ?>
                    </div>

                </div>
                <div class="add-buttons">

                    <a class="btn btn-secondary" href="main.php">Back</a>
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