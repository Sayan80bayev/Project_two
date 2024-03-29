<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Include Bootstrap CSS and custom CSS file -->
    <link rel="stylesheet" href="http://localhost/project_two/css/profile.css">
    <link rel="stylesheet" href="http://localhost/project_two/css/style.css">
</head>

<body>
    <main>
        <?php
        // Start the session and check if the user is authenticated
        session_start();
        include '../components/header.php';
        include '../db/checkAuth.php';
        // Get the user's avatar URL, set a default if not available
        $avatar = $_SESSION['avatar_url'] ?? 'no-avatar.jpg';
        ?>
        <div class="container">
            <div class="profile">
                <!-- Display user's mini-profile -->
                <div class="mini-profile">
                    <img src='../images/user/<?= $avatar ?>' alt="Avatar" class="avatar">
                    <h1><?= $name ?></h1>
                </div>
                <!-- Display user's information and links -->
            </div>
            <?php include 'activity.php';?>
        </div>
    </main>
    <?php include '../components/footer.php';?>
</body>

</html>
