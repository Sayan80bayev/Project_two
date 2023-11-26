<?php
    // Start a session and retrieve the avatar URL from the session or use a default if not set
    $avatar = $_SESSION['avatar_url'] ?? 'no_avatar.jpg';
?>

<!-- Header Section -->
<div class="header" id="header">
    <!-- PC Games Store Logo -->
    <svg xmlns="http://www.w3.org/2000/svg" height="2em" viewBox="0 0 576 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M0 24C0 10.7 10.7 0 24 0H69.5c22 0 41.5 12.8 50.6 32h411c26.3 0 45.5 25 38.6 50.4l-41 152.3c-8.5 31.4-37 53.3-69.5 53.3H170.7l5.4 28.5c2.2 11.3 12.1 19.5 23.6 19.5H488c13.3 0 24 10.7 24 24s-10.7 24-24 24H199.7c-34.6 0-64.3-24.6-70.7-58.5L77.4 54.5c-.7-3.8-4-6.5-7.9-6.5H24C10.7 48 0 37.3 0 24zM128 464a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm336-48a48 48 0 1 1 0 96 48 48 0 1 1 0-96z" fill="#f8e6de"/></svg>
    <!-- Left Side of the Header -->
    <div class="left-side" id="left-side">
        <!-- Search Bar -->
        <form action="http://localhost/project_two/CategoryGames.php" class="searchBar" method="post">
            <input id="search" type="search" placeholder="Search..." name="search"/>
            <button type="submit">Go</button>
        </form>

        <!-- User Profile Link -->
        <?php 
            if(isset($_SESSION['user_name'])){
        ?>
        <a class="profileLink" href="http://localhost/project_two/profile/profile.php">
            <img src="http://localhost/project_two/images/user/<?=$avatar?>" alt="">
        </a>
        <?php 
            }
            else{
        ?>
            <div class="login">
                <a href="http://localhost/project_two/login/LoginForm.php/">Log in</a>
            </div>
        <?php }
        ?>
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
                    <li><a href="http://localhost/project_two/index.php">Home</a></li>
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
