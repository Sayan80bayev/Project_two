<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Include Bootstrap CSS and custom CSS file -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="http://localhost/project_two/css/profile.css">
</head>

<body>
    <main>
        <?php
        // Start the session and check if the user is authenticated
        session_start();
        include '../db/checkAuth.php';

        // Get the user's avatar URL, set a default if not available
        $avatar = $_SESSION['avatar_url'] ?? 'no-avatar.jpg';
        ?>

        <div>
            <div class="profile">
                <!-- Display user's mini-profile -->
                <div class="mini-profile">
                    <img src='../images/user/<?= $avatar ?>' alt="Avatar" class="avatar">
                    <h1><?= $name ?></h1>
                </div>
                <!-- Display user's information and links -->
                <div class="info">
                    <a href="accounteditform.php" class="btn btn-primary">Change Password</a>
                    <a href="../logout.php" class="btn btn-danger">Logout</a>
                </div>
            </div>
        </div>
    </main>
</body>

</html>
