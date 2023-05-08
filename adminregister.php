<?php
include "config.php";
if (isset($_SESSION["access"]) && $_SESSION["access"] == "true") {
    $_SESSION["request"] = "allow";
    header("Location: register.php");
} else {
    $_SESSION["request"] = "false";
    header("Location: register.php");
}
