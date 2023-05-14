<?php

require 'config.php';
if (isset($_SESSION["access"]) && $_SESSION["access"] != "true") {
    // dd($_SESSION["access"]);
    redirect('main.php');
    die;
}

$id = $_GET["id"];
$query = mysqli_query($conn, "SELECT image FROM murid WHERE id= '$id'");
$directory = "./images/";
unlink($directory . mysqli_fetch_object($query)->image);


$result = mysqli_query($conn, "DELETE FROM murid WHERE id='$id'");

// dd($result);
header("Location: main.php");
