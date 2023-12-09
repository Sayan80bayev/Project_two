<!DOCTYPE html>
<html lang="en">

<head>
    <title>Game Store</title>
    <link rel="icon" type="image/svg+xml" href="http://localhost/project_two/images/gamepad-solid.svg">
    <!-- Include CSS files -->
    <link rel="stylesheet" href="http://localhost/project_two/css/style.css">
    <link rel="stylesheet" href="http://localhost/project_two/css/carousel.css">
</head>
<body>
    <!-- Header Section -->
    <?php 
        // Include header, games, and database connection files
        session_start();
        $_SESSION['lastPage'] = 'http://localhost/project_two/index.php';
        require_once 'db/connection.php';
        require_once 'db/checkAuth.php';
        $game = getGames();        
        include 'components/header.php';
    ?>
    <!-- Main Content -->
    <div class="big-container">
        <div class="category">
            <?php
                // Include category file and display 'Add game' link for developers
                include 'components/category.php';
                $genre = $_SESSION['role'] ?? '';
                if($genre=='developer' || $genre=='admin'){
                    echo'<a href="developers/AddGameForm.php"  style = "display:flex; align-items:center;"><h2>Add game</h2><svg xmlns="http://www.w3.org/2000/svg" height="16" width="14" viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2023 Fonticons, Inc.--><path d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32V224H48c-17.7 0-32 14.3-32 32s14.3 32 32 32H192V432c0 17.7 14.3 32 32 32s32-14.3 32-32V288H400c17.7 0 32-14.3 32-32s-14.3-32-32-32H256V80z" fill="#f8e6de"/></svg></a>';
                }
                if($genre == 'admin')
                    echo'<a href="admin/Admin.php"><h2>AdminPage</h2></a>';
            ?>
        </div>
        <main>
            <!-- Carousel Section -->
            <?php include 'components/carousel.php';?>
            <div class="genre-container">
                <h2>Special offers</h2>
            </div>
            <!-- Slider Section -->
            <?php include "components/slider.php";?>
        </main>
    </div>
    <?php include 'components/footer.php';?>
    <!-- JavaScript for card selection and carousel movement -->
    <script src="http://localhost/project_two/scripts/index.js" defer></script>
</body>

</html>