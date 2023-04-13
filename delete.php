<?php

require 'config.php';

$id = $_GET["id"];

$result = mysqli_query($conn, "DELETE FROM murid WHERE id = '$id'");

header("Location: main.php");
