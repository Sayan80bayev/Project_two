<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Set the title of the page -->
    <title>Registration</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Include custom CSS file -->
    <link rel='stylesheet' href="http://localhost/project_two/css/styleOfLogin.css">
</head>

<body>
    <?php
    // Start the session and check if the user is authenticated
    session_start();
    include '../db/checkAuth.php';
    //Token generation
    $csrfToken = bin2hex(random_bytes(32));
    $_SESSION['csrf_token'] = $csrfToken;
    // echo''. $_SESSION['csrf_token'] .'';
    ?>

    <div class="container mt-5">
        <?php
        // Check for any session message and display it
        $errors = $_SESSION['errors'] ?? [];
        if (isset($_SESSION['message'])) {
            echo '<h2 class="offset-md-4 text-success">' . $_SESSION['message'] . '</h2>';
            unset($_SESSION['message']);
        }
        ?>
        <!-- Display the header for the password changing section -->
        <h2 class="offset-md-4">Password changing</h2>

        <div class="col-md-6 offset-md-3">
            <!-- Password change form -->
            <form action="changePassword.php" method="post">
                <!-- Password input -->
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" class="form-control" name="password" id="password">
                </div>
                <!-- New password input -->
                <div class="form-group">
                    <label for="new_password">New-password:</label>
                    <input type="password" class="form-control" name="new_password" id="new_password">
                </div>
                <!-- Confirm password input -->
                <div class="form-group">
                    <label for="confirm_password">Confirm-password:</label>
                    <input type="password" class="form-control" name="confirm_password" id="confirm_password">
                </div>
                <!-- Token input -->
                <input type="hidden" name="csrf_token" value="<?php echo $csrfToken; ?>">
                <?php
                // Display password-related errors
                if (isset($errors["password"]))
                    echo "<p class='text-danger'>{$errors["password"]}</p>";
                ?>
                <!-- Confirm and Back buttons -->
                <button type="submit" class="btn btn-primary">Confirm</button>
                <a href="Profile.php" class="btn btn-primary">Back</a>
            </form>
        </div>
    </div>

    <?php
    // Unset errors session variable
    unset($_SESSION['errors']);
    unset($_SESSION['csrf-token']);
    ?>
</body>

</html>
