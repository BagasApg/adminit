<?php
require 'config.php';
require 'ui.php';

$result = mysqli_query($conn, "SELECT * FROM murid");
$murid = [];
while ($row = mysqli_fetch_assoc($result)) {
    $murid[] = $row;
}

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
    <title>Adminit | Dashboard</title>
</head>

<body>

    <?= $navbar ?>
    <?= $sidebar ?>
    <div class="container">

        <?php

        if ($_SESSION["access"] == "true") : ?>
            <div class="header">
                <a class="btn" href="add.php">Add</a>
            </div>
        <?php

        endif;

        ?>
        <div class="table">
            <table class="style-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <?php if ($_SESSION["access"] == "true") : ?>
                            <th>Username</th>
                            <th>Password</th>
                        <?php endif; ?>


                        <th>Image</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($murid as $row) : ?>
                        <tr>
                            <td class="text-center"><?= $row["id"] ?></td>
                            <td><?= $row["name"] ?></td>

                            <?php if ($_SESSION["access"] == "true") : ?>

                                <td><?= $row["username"] ?></td>
                                <td><?= $row["password"] ?></td>

                            <?php endif; ?>

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
                            <a onclick="closeModal()" class="btn btn-secondary">Cancel</a>
                            <a href="delete.php?id=" class="btn">Delete</a>
                        </div>

                    </div>
                </div>
                <div class="shadow-bg d-none">
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

        function closeModal() {
            $('.modal').hide();
            $(".buttons a.btn").attr('href', `delete.php?id=`);
        }
        $('.modal-bg').click(closeModal);

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