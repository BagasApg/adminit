<?php

$navbar = <<<EOD
  <div class="navbar">
        <header>
            <a class="logo" href="main.php">Adminit</a>
            <p>Welcome, <a class="user" onclick="openSidebar()">user</a> !</p>
        </header>
    </div> 
EOD;

$navbar_js = <<<EOD
        const colors = [
            "red",
            "green",
            "blue",
            "#264653",
            "#2a9d8f",
            "#e9c46a",
            "#f4a261",
            "#e76f51"
        ];


        id = 0
        let afterNum = null
        let num = null
        setInterval(() => {
            if (id === colors.length) {
                id = 0
            }
            while (true) {
                num = Math.floor(Math.random() * colors.length)
                if (num != afterNum) {
                    break
                }
            }
            console.log(num)
            $('.navbar a.user').css('color', colors[num])

            afterNum = num
            id++
        }, 1000);
        EOD;
