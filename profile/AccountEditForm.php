<!DOCTYPE html>
<html lang="en">
<head>
    <title>Registration</title>
</head>
<!-- <link rel="stylesheet" href="../style.css"> -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link rel='stylesheet' href="http://localhost/project_two/css/styleOfLogin.css">
<body>
    <?php 
        session_start();
        include '../db/checkAuth.php';
        ?>
        <div class="container mt-5">
            <?php
            $errors = $_SESSION['errors'] ?? [];
            if (isset($_SESSION['message'])) {
                echo'<h2 class = "offset-md-4 text-success">'. $_SESSION['message'] .'</h2>';
                unset($_SESSION['message']);
            }
            ?>
            <h2 class = "offset-md-4">Password changing</h2>
            <div class="col-md-6 offset-md-3">
                <form action="changePassword.php" method="post">
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" class="form-control" name="password" id="password">
                    </div>
                    <div class="form-group">
                        <label for="new_password">New-password:</label>
                        <input type="password" class="form-control" name="new_password" id="new_password">
                    </div>
                    <div class="form-group">
                        <label for="confirm_password">Confirm-password:</label>
                        <input type="password" class="form-control" name="confirm_password" id="confirm_password">
                    </div>
                    <?php
                        if (isset($errors["password"]))
                        echo "<p class='text-danger'>{$errors["password"]}</p>";
                        ?>
                    <button type="submit" class="btn btn-primary">Confirm</button>
                    <a href = "Profile.php" class="btn btn-primary">Back</a>
                </form>   
            </div>
        </div>
        <?php
                    unset($_SESSION['errors']);
                ?>
</body>
</html>