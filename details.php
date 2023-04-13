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

    if (isset($name) && isset($username) && isset($password) && isset($confirmPassword) && isset($image) && $continue) {
        $result = mysqli_query($conn, "INSERT INTO murid(name,username,password,image) VALUES('$name','$username','$password','$image')");
        header("Location: main.php");
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
                <h2>Details</h2>
            </div>
            <div class="detail-content">
                <h5>user</h5>
                <h5>******</h5>

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