<?php

require 'config.php';

$id = $_GET["id"];

// dd($_GET["id"]);

$result = mysqli_query($conn, "DELETE FROM murid WHERE id='$id'");

// dd($result);
header("Location: main.php");
