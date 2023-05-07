<?php
require 'config.php';
require 'ui.php';

$result = mysqli_query($conn, "SELECT * FROM murid");
$murid = [];

if (!isset($_SESSION["user"])) {
    header("Location: login.php");
}

if (isset($_POST["search-button"])) {
    $search = "%" . $_POST["search"] . "%";
    if ($_SESSION["access"] == "true") {

        $result = mysqli_query($conn, "SELECT * FROM murid WHERE id LIKE '$search' OR
                             name LIKE '$search' OR
                             username LIKE '$search' OR
                             password LIKE '$search'");
    } else {
        $result = mysqli_query($conn, "SELECT * FROM murid WHERE id LIKE '$search' OR 
                             name LIKE '$search'");
    }
}


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
        <div class="table">
            <h2 style="margin: 20px 0 24px 24px">Users</h2>

            <div class="header">
                <div class="header-add-user">
                    <div class="user-total" style="font-weight: bold;">
                        <?= $result->num_rows ?>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                            <circle cx="9" cy="7" r="4"></circle>
                            <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                            <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                        </svg>
                    </div>
                    <?php if ($_SESSION["access"] == "true") : ?>
                        <a style="font-weight: bold;" href="<?= BASE_URL . "add.php" ?>">
                            <div class="btn btn-secondary btn-add">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user-plus">
                                    <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="8.5" cy="7" r="4"></circle>
                                    <line x1="20" y1="8" x2="20" y2="14"></line>
                                    <line x1="23" y1="11" x2="17" y2="11"></line>
                                </svg>
                                Add User
                            </div>
                        </a>
                    <?php endif; ?>
                </div>
                <div class="header-search">
                    <form action="main.php" method="POST">
                        <div class="search-literal-button">
                            <input type="text" name="search" placeholder="Search..">

                            <button type="submit" name="search-button">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search">
                                    <circle cx="11" cy="11" r="8"></circle>
                                    <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                                </svg>
                            </button>
                        </div>
                    </form>
                </div>

            </div>
            <table class="style-table">
                <thead>
                    <tr>
                        <?php if ($_SESSION["access"] == "true") : ?>
                            <style>
                                #table-1 {
                                    width: 8%;
                                }

                                #table-2 {
                                    width: 28%;
                                }

                                #table-3 {
                                    width: 16%;
                                }

                                #table-4 {
                                    width: 18%;
                                }

                                #table-5 {
                                    width: 12%;
                                }

                                #table-6 {
                                    width: 14%;
                                }
                            </style>
                        <?php else : ?>
                            <style>
                                #table-1 {
                                    width: 10%;
                                }

                                #table-2 {
                                    width: 40%;
                                }

                                #table-5 {
                                    width: 31%;
                                }

                                #table-6 {
                                    width: 14%;
                                }
                            </style>
                        <?php endif; ?>
                        <th id="table-1">ID</th>
                        <th id="table-2">Name</th>
                        <?php if ($_SESSION["access"] == "true") : ?>
                            <th id="table-3">Username</th>
                            <th id="table-4">Password</th>
                        <?php endif; ?>


                        <th id="table-5">Image</th>
                        <th id="table-6">Action</th>
                    </tr>
                </thead>

                <tbody>
                    <?php if ($result->num_rows > 0) : ?>
                        <?php foreach ($murid as $row) : ?>
                            <tr>
                                <td class="text-center"><?= $row["id"] ?></td>
                                <td><?= $row["name"] ?></td>

                                <?php if ($_SESSION["access"] == "true") : ?>

                                    <td><?= $row["username"] ?></td>
                                    <td><?= $row["password"] ?></td>

                                <?php endif; ?>

                                <td class="text-center"><img style="max-width:100px" src="images/<?= $row["image"] ?>" alt=""></td>
                                <td class="text-center" id="td-action">
                                    <div class="actions">

                                        <a href="edit.php?id=<?= $row["id"] ?>">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit">
                                                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                            </svg>
                                        </a>
                                        <a href="user_detail.php?id=<?= $row["id"] ?>">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-info">
                                                <circle cx="12" cy="12" r="10"></circle>
                                                <line x1="12" y1="16" x2="12" y2="12"></line>
                                                <line x1="12" y1="8" x2="12.01" y2="8"></line>
                                            </svg>
                                        </a>
                                        <a onclick="openModal(<?= $row['id'] ?>)">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash">
                                                <polyline points="3 6 5 6 21 6"></polyline>
                                                <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                            </svg>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>

                    <?php else : ?>
                        <tr>
                            <td style="text-align: center;" colspan="6">No Data!</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <div class="modal d-none">
            <div class="modal-bg">
            </div>
            <div class="window">
                <div class="modal-content">
                    <h1>Are you sure?</h1>
                    <p>You are deleting user with id of <br><b>num</b>. <br>Wish to proceed?</p>
                    <div class="buttons">
                        <a id="delete-back" class="btn btn-secondary">Back</a>
                        <a href="delete.php?id=" class="btn btn-main">Delete</a>
                    </div>

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


        $('#delete-back').click(function(e) {
            e.preventDefault();
            $('.modal').hide();
            $(".buttons a.btn").attr('href', `delete.php?id=`);
            $('body').css('overflow-y', 'scroll');

        })

        $('.modal-bg').click(function(e) {
            e.preventDefault();
            $('.modal').hide();
            $(".buttons a.btn").attr('href', `delete.php?id=`);
            $('body').css('overflow-y', 'scroll');

        });

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