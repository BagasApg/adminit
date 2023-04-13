<?php
require 'config.php';
require 'ui.php';
session_start();

$result = mysqli_query($conn, "SELECT * FROM murid");
$murid = [];
while ($row = mysqli_fetch_assoc($result)) {
    $murid[] = $row;
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
    <title>Adminit | Dashboard</title>
</head>

<body>

    <?= $navbar ?>
    <?= $sidebar ?>
    <div class="container">


        <div class="header">
            <a class="btn" href="add.php">Add</a>
        </div>
        <div class="table">
            <table class="style-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Username</th>
                        <th>Password</th>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($murid as $row) : ?>
                        <tr>
                            <td class="text-center"><?= $row["id"] ?></td>
                            <td><?= $row["name"] ?></td>
                            <td><?= $row["username"] ?></td>
                            <td><?= $row["password"] ?></td>
                            <td class="text-center"><?= $row["image"] ?></td>
                            <td class="text-center">
                                <a class="btn" href="edit.php?id=<?= $row["id"] ?>">Edit</a><a class="btn" onclick="openModal(<?= $row['id'] ?>)">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="modal d-none">
            <div>
                <div class="window">
                    <div class="modal-content">
                        <h1>Are you sure?</h1>
                        <p>You are deleting user with id of <br><b>num</b>. <br>Wish to proceed?</p>
                        <div class="buttons">
                            <a onclick="closeModal()" class="btn btn-secondary">Back</a>
                            <a href="delete.php?id=" class="btn">Delete</a>
                        </div>

                    </div>
                </div>
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

            // $('link').attr("href", "style1.css")
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

        function closeModal() {
            $('.modal').hide();
            $(".buttons a.btn").attr('href', `delete.php?id=`);
        }

        function openModal(id) {
            $('.modal').show();
            $('body').css('overflow-y', 'hidden');
            $("a[href='delete.php?id=']").attr('href', `delete.php?id=${id}`)
            $('.modal-content b').html(id);
        }
    </script>
</body>
<?php

if (isset($_SESSION["alert"])) {
    echo "<h1>" . $_SESSION["alert"] . " successful!</h1>";
    session_unset();
}

?>

</html>