<?php

if (isset($_SESSION["access"]) && $_SESSION["access"] == "true") {
    $access = <<<EOD
                <a onclick="closeNavbar()" href="adminregister.php">
                    <li>Add Admin</li>
                </a>
    EOD;
} else {
    $access = "";
}

$sidebar = <<<EOD
    <div class="sidebar-container">
        <div class="shadow-container">

            <div class="sidebar sidebar-close">
                <ul>
                    <a href="details.php">
                        <li>Details</li>
                    </a>
                    $access
                    <a onclick="closeNavbar()" href="logout.php">
                        <li>Logout</li>
                    </a>
                </ul>
            </div>
            <div class="shadow-bg d-none">
            </div>
        </div>
    </div>
    
EOD;
