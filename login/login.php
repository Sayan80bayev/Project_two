<?php
// Start a session to store user data and status
session_start();

// Check if the form is submitted using POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve POST variables
    $email = $_POST["email"];
    $password = $_POST["password"];
    $errors = []; // Array to store validation errors
    $_SESSION['status'] = ''; // Initialize session status

    // Include database connection file
    require_once('../db/connection.php');

    // Validate password
    if (empty($password)) {
        $errors["password"] = "Password is empty!";
    } elseif (strlen($password) < 6) {
        $errors["password"] = "Minimum size is 6!";
    } else {
        // Check if password contains at least one lowercase, one uppercase, and one digit
        $hasLowercase = false;
        $hasUppercase = false;
        $hasDigit = false;

        for ($i = 0; $i < strlen($password); $i++) {
            $char = $password[$i];

            if ($char >= 'a' && $char <= 'z') {
                $hasLowercase = true;
            } elseif ($char >= 'A' && $char <= 'Z') {
                $hasUppercase = true;
            } elseif ($char >= '0' && $char <= '9') {
                $hasDigit = true;
            }
        }

        // Provide specific error messages for missing character types
        if (!$hasLowercase) {
            $errors['password'] .= 'Add 1 lowercase<br>';
        }
        if (!$hasUppercase) {
            $errors['password'] .= 'Add 1 uppercase<br>';
        }
        if (!$hasDigit) {
            $errors['password'] .= 'Add 1 digit<br>';
        }
    }

    // Hash the password using MD5
    $password = md5($password);

    // Attempt to login user and retrieve user data
    $user = loginUser($email, $password) ?? [];

    // Validate email and check if user exists
    if (empty($email)) {
        $errors['login'] = 'Email is empty!';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['login'] = "Invalid login!";
    } elseif ($user[0]["user_email"] != $email) {
        $errors['login'] = "No such email!";
    }

    // Process login results
    if (empty($errors)) {
        // Check if user credentials are valid
        if (count($user) > 0 && $user[0]["password"] == $password) {
            // Set user session data
            if (isset($_POST["remember"])) {
                setcookie("user_email", $email, time() + 30 * 24 * 60 * 60); // Remember user email for 30 days
            }

            $_SESSION["user_id"] = $user[0]['user_id'];
            $_SESSION["name"] = $user[0]['user_name'];
            $_SESSION['password'] = $user[0]['password'];
            $_SESSION['email'] = $user[0]['user_email'];
            $_SESSION['avatar_url'] = $user[0]['avatar_url'];
            $_SESSION['role'] = $user[0]['role'];
            $_SESSION['status'] = 'success';

            // Redirect to the index page upon successful login
            header("Location: ../index.php");
            exit();
        } else {
            // Invalid password
            $errors["password"] = 'Invalid password';
            $_SESSION['status'] = 'error';
            $_SESSION['errors'] = $errors;
            header("Location: LoginForm.php");
            exit();
        }
    } else {
        // Validation errors occurred
        $_SESSION['status'] = 'error';
        $_SESSION['errors'] = $errors;
        header("Location: LoginForm.php");
        exit();
    }
}
?>
