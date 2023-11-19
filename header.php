<?php
    session_start();
    $avatar = $_SESSION['avatar_url'] ?? 'no_avatar.jpg';
?>

<div class="header" id="header">
        <img src="images/logo.png" alt="PC Games Store">
        <div class="left-side" id="left-side">
            <div class="searchBar">
                <input id="search" type="search" placeholder="Search..." />
                <button>Go</button>
            </div>
            <a class="profileLink" href="profile/profile.php"><img src="images/user/<?=$avatar?>" alt=""></a>
            <div class="menu-container">
                <div class="menu">
                    <div class="social-media">
                        <img src="images/Facebook.png" alt="">
                        <img src="images/Twitter.png" alt="">
                        <img src="images/Instagramm.png" alt="">
                    </div>
                    <ul>
                        <span></span>
                        <li><a href="">About us</a></li>
                        <span></span>
                        <li><a href="">Contact</a></li>
                        <span></span>
                        <li><a href="">Privacy policy</a></li>
                        <span></span>
                        <li><a href="">Terms and conditions</a></li>
                        <span></span>
                        <li><a href="">FAQ</a></li>
                        <span></span>
                    </ul>
                </div>
                <button class="menu-btn">
                    <span class="menu-icon"></span>
                </button>
            </div>
        </div>
    </div>
    <script>
        const menuBtn = document.querySelector('.menu-btn');
        const menu = document.querySelector('.menu');

        menuBtn.addEventListener('click', () => {
            menuBtn.classList.toggle('active');
            menu.classList.toggle('active');
        });
    </script>