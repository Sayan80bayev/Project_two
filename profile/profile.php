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
        include '../header.php';
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
                <h1>There's nothing yet!</h1>
            </div>
            <div class="activity">
                <ul>
                    <li class="btn"><a href="accounteditform.php">Edit profile</a></li>
                    <li class="btn"><a href="">Screenshots</a></li>
                    <li class="btn"><a href="">Reviews</a></li>
                    <li class="btn"><a href="">Illustrations</a></li>
                    <li class="btn"><a href="changepasswordform.php">Change Password</a></li>
                    <li class="btn"><a href="../logout.php">Logout</a></li>
                </ul>
            </div>
        </div>
    </main>
    <?php include '../footer.php';?>
</body>

</html>
