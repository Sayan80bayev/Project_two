<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Set the title of the page -->
    <title>Change Password</title>
    <!-- Include custom CSS files -->
    <link rel="stylesheet" href="http://localhost/project_two/css/profile.css">
    <link rel="stylesheet" href="http://localhost/project_two/css/style.css">
</head>

<style>
    .passwordForm {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        width: 590px;
        max-width: 100%;
    }

    .passwordForm h3 {
        margin: 0;
    }

    .passwordForm input {
        width: 50%;
        height: 40px;
        border-radius: 10px;
    }

    .form-group {
        margin-bottom: 10px;
    }

    .buttons {
        width: 50%;
        height: 40px;
        display: flex;
    }

    .buttons a {
        width: 50%;
        text-align: center;
        padding: 10px 0 10px 0;
    }

    .buttons input {
        font-weight: 700;
        width: 50%;
        color: #f8e6de;
    }
</style>

<body>
    <?php
    // Start the session and check if the user is authenticated
    session_start();
    include '../db/checkAuth.php';
    include '../header.php';

    // Token generation
    $csrfToken = bin2hex(random_bytes(32));
    $_SESSION['csrf_token'] = $csrfToken;
    ?>
    <main>
        <div class="message">
            <?php
            // Check for any session message and display it
            $errors = $_SESSION['errors'] ?? [];
            if (isset($_SESSION['message'])) {
                echo '<h1 style="color:green;">' . $_SESSION['message'] . '</h1>';
                unset($_SESSION['message']);
            }
            ?>
        </div>
        <div class="container">
            <!-- Password change form -->
            <form action="changePassword.php" method="post" class="passwordForm">
                <h2 class="offset-md-4">Password changing</h2>
                <!-- Password input -->
                <label for="password"><h3>Password:</h3></label>
                <input type="password" class="form-control" name="password" id="password">
                <!-- New password input -->
                <label for="new_password"><h3>New-password:</h3></label>
                <input type="password" class="form-control" name="new_password" id="new_password">
                <!-- Confirm password input -->
                <label for="confirm_password"><h3>Confirm-password:</h3></label>
                <input type="password" class="form-control" name="confirm_password" id="confirm_password">
                <!-- Token input -->
                <input type="hidden" name="csrf_token" value="<?php echo $csrfToken; ?>">
                <?php
                // Display password-related errors
                if (isset($errors["password"]))
                    echo "<p style='color:red;'>{$errors["password"]}</p>";
                ?>
                <!-- Confirm and Back buttons -->
                <div class="buttons">
                    <input type="submit" class="btn" value="Confirm">
                    <a href="Profile.php" class="btn ">Back</a>
                </div>
            </form>
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
    <?php
    include '../footer.php';
    // Unset errors session variable
    unset($_SESSION['errors']);
    unset($_SESSION['csrf-token']);
    ?>
</body>

</html>
