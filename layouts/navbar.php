<?php

if (isset($_SESSION["user"])) {
    $user = $_SESSION["user"];
}

$navbar = <<<EOD
        <div class="navbar">
        <header>
            <a class="logo" href="main.php">Adminit</a>
            <div class="menu-button">
                <p>Welcome, $user!</p>

                <img onclick="openSidebar()" src="assets/menu.svg" alt="">
            </div>
        </header>
    </div>
    EOD;

$navbar_js = <<<EOD

        let titleChange = 0
        var titleawal = $('title').html();
        setInterval(() => {
            if (titleChange == 2) {
                titleChange = 0;
            }
            if (titleChange === 0) {
                $('title').html('Adminit | $user');
            } else {
                $('title').html(titleawal);
            }
            titleChange++;

        }, 2000);
        
        EOD;
