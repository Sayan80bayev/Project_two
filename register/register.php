<?php
// Start the session
session_start();   

// Check if the form is submitted using POST method
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $username = $_POST['name'] ?? "";
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';
    $errors = [];

    // Include the database connection file
    require_once('../db/connection.php');

    // Validate username
    if (empty($username)) {
        $errors['name'] = 'Name is empty';
    }elseif(!preg_match("/^[a-zA-Z0-9]+$/",$username)){
        $errors['name'] = 'Incorrect isername use only latin letters and numbers';
    }

    // Validate password
    if ($password != $confirm_password) {
        $errors['password'] = 'Passwords do not match! ';
    }

    if (empty($password)) {
        $errors["password"] = "Password is empty!";
    } elseif (strlen($password) < 6) {
        $errors["password"] = "Min size is 6!";
    } else {
        // Check for password strength
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

    // Validate email
    if (empty($email)) {
        $errors['login'] = 'Email is empty!';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['login'] = "Invalid login!";
    }

    // Try to register the user
    $result = registerUser(htmlspecialchars($username), htmlspecialchars($email), htmlspecialchars($password));
    $errors['login'] = isset($result['errors']) ? $result['errors'] : '';

    // Check the result of the registration attempt
    if ($result && !empty($errors)) {
        $_SESSION['message'] = "Successfully registered!";
        $_SESSION['status'] = 'success';
        header('Location: ../login/LoginForm.php');
        exit();
    } else {
        $_SESSION['status'] = 'error';
        $_SESSION['errors'] = $errors;
        header("Location: RegisterForm.php");
        exit();
    }
}
?>
