<?php

require 'config.php';
if (isset($_SESSION["access"]) && $_SESSION["access"] != "true") {
    // dd($_SESSION["access"]);
    redirect('main.php');
    die;
}

$id = $_GET["id"];

// dd($_GET["id"]);

$result = mysqli_query($conn, "DELETE FROM murid WHERE id='$id'");

// dd($result);
header("Location: main.php");
