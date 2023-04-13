<?php
require 'config.php';
require 'ui.php';
session_start();

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

    if (!empty($name) && !empty($username) && !empty($password) && !empty($confirmPassword) && !empty($image) && $continue) {
        $result = mysqli_query($conn, "INSERT INTO murid(name,username,password,image) VALUES('$name','$username','$password','$image')");
        header("Location: main.php");
    } else {
        $_POST["alert"] = "Fill all the form!";

    }
}

$randoms = [
    0 => [
        "name" => "Alexander Christie",
        "username" => "alexhris",
        "image" => "alexander.jpg"
    ],
    1 => [
        "name" => "Brian Rich",
        "username" => "richbrian",
        "image" => "brian.jpg"
    ],
    2 => [
        "name" => "Clair Ristyan",
        "username" =>
        "clairtoexplain",
        "image" => "clair.jpg"
    ],
    3 => [
        "name" => "Dan Augh",
        "username" =>
        "danausir",
        "image" => "dan.jpg"
    ],
    4 => [
        "name" => "Evan Anodd",
        "username" =>
        "literaldice",
        "image" => "evan.jpg"
    ],
];

$random = $randoms[rand(1, 3)]

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <script src="jquery-3.6.4.js"></script>

    <title>Add</title>
</head>

<body>
    <?= $navbar ?>
    <?= $sidebar?>
    <div class="wrapper">
        <div class="add-container">
            <div class="header">
                <h2>Add User</h2>

            </div>
            <div class="add-form">
                <form action="add.php" method="POST">
                    <div class="label-input">
                        <label for="name">Name</label>
                        <input type="text" placeholder="<?= $random["name"] ?>" name="name" id="name" >
                    </div>
                    <div class="label-input">
                        <label for="username">Username</label>
                        <input type="text" placeholder="<?= $random["username"] ?>" name="username" id="username" >
                    </div>
                    <div class="label-input">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" >
                    </div>
                    <div class="label-input">
                        <label for="confirmpassword">Confirm Password</label>
                        <input type="password" name="confirmpassword" id="confirmpassword" >
                    </div>
                    <div class="label-input">
                        <label for="image">Image</label>
                        <input type="text" placeholder="<?= $random["image"] ?>" name="image" id="image" >
                    </div>
                    <div>
                        <p><?php if (isset($_POST['alert'])) {
                                echo $_POST['alert'];
                            } ?></p>
                    </div>
                    <div class="add-buttons">
                        <a class="btn" href="main.php">Back</a>

                        <button type="input" name="submit" class="btn" style="margin: 0 0 0 auto; display: block">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        const colors = [
            "red",
            "green",
            "blue",
            "#264653",
            "#2a9d8f",
            "#e9c46a",
            "#f4a261",
            "#e76f51"
        ];
        id = 0
        setInterval(() => {
            if (id === colors.length) {
                id = 0
            }

            $('.navbar a.user').css('color', colors[Math.floor(Math.random() * colors.length) + 1])
            id++
        }, 1000);

        $('.shadow-bg').click(function() {
            $('.shadow-bg').hide()
            $('.sidebar').toggleClass('open')

        });

        function openSidebar() {
            $('.shadow-bg').show()
            // $('.sidebar').toggle('.sidebar-close')
            $('.sidebar').toggleClass('open')
            // $('.sidebar').css('right', '0')
        }
    </script>
</body>

</html>