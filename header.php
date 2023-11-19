<?php
    // Start a session and retrieve the avatar URL from the session or use a default if not set
    session_start();
    $avatar = $_SESSION['avatar_url'] ?? 'no_avatar.jpg';
?>

<!-- Header Section -->
<div class="header" id="header">
    <!-- PC Games Store Logo -->
    <img src="images/logo.png" alt="PC Games Store">

    <!-- Left Side of the Header -->
    <div class="left-side" id="left-side">
        <!-- Search Bar -->
        <div class="searchBar">
            <input id="search" type="search" placeholder="Search..." />
            <button>Go</button>
        </div>

        <!-- User Profile Link -->
        <a class="profileLink" href="profile/profile.php">
            <img src="images/user/<?=$avatar?>" alt="">
        </a>

        <!-- Menu Container -->
        <div class="menu-container">
            <!-- Menu Icon -->
            <button class="menu-btn">
                <span class="menu-icon"></span>
            </button>

            <!-- Navigation Menu -->
            <div class="menu">
                <!-- Social Media Icons -->
                <div class="social-media">
                    <img src="images/Facebook.png" alt="">
                    <img src="images/Twitter.png" alt="">
                    <img src="images/Instagramm.png" alt="">
                </div>

                <!-- Navigation Links -->
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
        </div>
    </div>
</div>

<!-- JavaScript for Menu Toggle -->
<script>
    // Get references to the menu button and menu
    const menuBtn = document.querySelector('.menu-btn');
    const menu = document.querySelector('.menu');

    // Add event listener to toggle the menu on button click
    menuBtn.addEventListener('click', () => {
        menuBtn.classList.toggle('active');
        menu.classList.toggle('active');
    });
</script>
