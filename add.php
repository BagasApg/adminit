<?php
require 'config.php';
require 'ui.php';

if (isset($_POST["submit"])) {
    // dd($_FILES);
    $filename = $_FILES["image"]["name"];
    $allow = array("png", "jpg", "jpeg");
    $file_exploded = explode(".", $filename);
    $extension = end($file_exploded);

    $continue = true;
    $name = $_POST["name"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $confirmPassword = $_POST["confirmpassword"];

    if ($password != $confirmPassword) {
        $continue = false;
    }


    if (!empty($name) && !empty($username) && !empty($password) && !empty($confirmPassword) && !empty($filename) && $continue) {
        if (in_array($extension, $allow)) {
            $password = hash('haval192,4', $password);
            $temp = $_FILES["image"]["tmp_name"];
            $directory = "./images/";

            $new_directory = move_uploaded_file($temp, $directory . $filename);
            $result = mysqli_query($conn, "INSERT INTO murid(name,username,password,image) VALUES('$name','$username','$password','$filename')");
            header("Location: main.php");
        } else {
            $_POST["alert"] = "Extension not supported!";
        }
    } else if (!$continue) {
        $_POST["alert"] = "Password doesn't match!";
    } else {
        $_POST["alert"] = "Fill all the form!";
    }
}

if (!isset($_SESSION["user"])) {
    header("Location: login.php");
}

$randoms = [
    0 => [
        "name" => "Alexander Christie",
        "username" => "alexhris",
        "image" => "alexander.jpg"
    ],
    1 => [
        "name" => "Brian Sam",
        "username" => "sambrian",
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

$random = $randoms[rand(1, 3)];

if ($_SESSION["page"] != "Add User") {
    $_SESSION["page"] = "Add User";
    header("Location: add.php");
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

    <title>Adminit | Add User</title>
</head>

<body>
    <?= $navbar ?>
    <?= $sidebar ?>
    <div class="wrapper">
        <div class="add-container">
            <div class="header">
                <h2>Add User</h2>

            </div>
            <div class="add-form">
                <form action="add.php" method="POST" enctype="multipart/form-data">
                    <div class="label-input">
                        <label for="name">Name</label>
                        <input type="text" placeholder="<?= $random["name"] ?>" name="name" id="name" class="form-input">
                    </div>
                    <div class="label-input">
                        <label for="username">Username</label>
                        <input type="text" placeholder="<?= $random["username"] ?>" name="username" id="username" class="form-input">
                    </div>
                    <div class="label-input">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" class="form-input">
                    </div>
                    <div class="label-input">
                        <label for="confirmpassword">Confirm Password</label>
                        <input type="password" name="confirmpassword" id="confirmpassword" class="form-input">
                    </div>
                    <div class="label-input">
                        <label for="image">Image</label>
                        <input type="file" onchange="previewImage()" name="image" id="image" class="form-input">
                    </div>
                    <div class="label-input-img">

                        <img style="width: 256px" class="image-preview" name="image" alt="">
                    </div>
                    <div>
                        <p><?php if (isset($_POST['alert'])) {
                                echo $_POST['alert'];
                            } ?></p>
                    </div>
                    <div class="add-buttons">
                        <a class="btn btn-secondary" href="main.php">Back</a>

                        <button type="input" name="submit" class="btn btn-main" style="margin: 0 0 0 auto; display: block">Add</button>
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

        function previewImage() {
            const image = document.querySelector('#image');
            const imagePreview = document.querySelector('.image-preview');

            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);
            oFReader.onload = function(oFREvent) {
                imagePreview.src = oFREvent.target.result;
            }
        }

        function openSidebar() {
            $('.shadow-bg').toggleClass('d-none')
            // $('.sidebar').toggle('.sidebar-close')
            $('.sidebar').toggleClass('open')
            // $('.sidebar').css('right', '0')
        }
    </script>
</body>

</html>