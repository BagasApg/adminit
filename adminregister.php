<?php
session_start();
$_SESSION["request"] = "allow";
header("Location: register.php");
