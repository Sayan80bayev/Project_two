<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="icon" type="image/svg+xml" href="http://localhost/project_two/images/gamepad-solid.svg">
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
        $name = $_SESSION['user_name'] ?? ''; // Replace with your actual session variable for the user's name
        $errors = $_SESSION['errors'] ?? [];
        $status = $_SESSION['status'] ?? '';
        $succes = $_SESSION['success'] ?? [];
        ?>

        <div class="message">
            <?php if (!empty($errors['message'])): ?>
                <h1><?= $errors['message'] ?></h1>
            <?php endif; ?>
            <?php if (!empty($succes['message']) && $status == 'succes'): ?>
                <h1 style="color:green;"><?= $succes['message'] ?></h1>
            <?php endif; ?>
            <?php if (!empty($errors['avatar'])): ?>
                <h1 style="color: red;"><?= $errors['avatar'] ?></h1>
            <?php endif; ?>

            <?php if (!empty($errors['name'])): ?>
                <h1 style="color: red;"><?= $errors['name'] ?></h1>
            <?php endif; ?>
        </div>

        <div class="container">
            <div class="profile">
                <!-- Display user's mini-profile -->
                <form action="edit.php" method="post" enctype="multipart/form-data">
                    <img src='../images/user/<?= $avatar ?>' alt="Avatar" class="avatar">
                    <label for="editableNameInput"><h3>Name changing:</h3></label>
                    <input type="text" id="editableNameInput" name="new_name" class="form-control" value="<?= $name ?>">
                    <label for="avatar"><h3>Avatar changing</h3></label>
                    <input type="file" name="new_avatar">
                    <input type="hidden" name="user_id" value="<?=$_SESSION['user_id']?>">
                    <div class="submit-check btn">
                        <input type="submit" value="Save changes">
                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512">
                            <path d="M438.6 105.4c12.5 12.5 12.5 32.8 0 45.3l-256 256c-12.5 12.5-32.8 12.5-45.3 0l-128-128c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0L160 338.7 393.4 105.4c12.5-12.5 32.8-12.5 45.3 0z" fill="#f8e6de" />
                        </svg>
                    </div>
                </form>
                <!-- Display user's information and links -->
            </div>

            <div class="activity">
                <ul>
                    <!-- Add other links as needed -->
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

    <?php 
    include '../footer.php'; 
    unset($_SESSION['errors']);
    unset($_SESSION['status']);
    unset($_SESSION['success']);
    ?>
</body>

</html>
