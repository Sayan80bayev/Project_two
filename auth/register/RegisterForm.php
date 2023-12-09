<!DOCTYPE html>
<html lang="en">
<head>
    <title>Registration</title>
</head>
<link rel="icon" type="image/svg+xml" href="http://localhost/project_two/images/gamepad-solid.svg">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link rel="stylesheet" href="http://localhost/project_two/css/styleOfLogin.css">
<body>
    <?php 
        session_start();
        $status = $_SESSION['status'] ?? '';
        $errors = $_SESSION['errors'] ?? [];
    ?>
    <div class="container mt-5">
        <div class="col-md-6 offset-md-3">
            <form action="register.php" method="post" enctype="multipart/form-data">
                <?php
                    if (isset($_SESSION['message'])) {
                        echo "<h2 style='color:succes;'>".$_SESSION['message']."</h2>";
                    }
                ?>
                <h2>Registration</h2>
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" class="form-control" name="name" id="name" >
                </div>
                <?php
                    if ($status == 'error' && isset($errors['name']))
                    echo "<p class='text-danger'>{$errors['name']}</p>";
                ?>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="text" class="form-control" name="email" id="email" >
                </div>
                <?php
                    if ($status == 'error' && isset($errors['login']))
                    echo "<p class='text-danger'>{$errors['login']}</p>";
                ?>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" class="form-control" name="password" id="password">
                </div>
                <div class="form-group">
                    <label for="confirm_password">Confirm-password:</label>
                    <input type="password" class="form-control" name="confirm_password" id="confirm_password">
                </div>
                <div class="form-group">
                    <label for="avatar">Input your avatar:</label>
                    <input type="file" class="form-control" name="avatar_input" id="avatar_input">
                </div>
                <?php
                    if ($status == 'error' && isset($errors['avatar']))
                    echo "<p class='text-danger'>{$errors['avatar']}</p>";
                ?>
                <?php
                    if ($status == 'error' && isset($errors['password']))
                    echo "<p class='text-danger'>{$errors['password']}</p>";
                ?>
                <button type="submit" class="button">Registration</button>
                <p class = "offset-md-2">Already have registered ? click <a href="../login/LoginForm.php">here</a></p>

                <?php
                    unset($_SESSION['status']);
                    unset($_SESSION['errors']);
                    unset($_SESSION['message']);
                ?>
            </form>
        </div>
    </div>
</body>
</html>