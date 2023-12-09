<?php
session_start();
require_once '../db/connection.php';
//Checking for CSRF token
if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['csrf_token']) && $_POST['csrf_token'] === $_SESSION['csrf_token']){
    $email = $_SESSION['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $new_password = $_POST['new_password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';

    // Take the hashed password from the session
    $passwordCheck = $_SESSION['password'];

    if (empty($password) || empty($new_password) || empty($confirm_password)) {
        $_SESSION['errors']['password'] = "Fill in all the gaps!";
    } elseif ($passwordCheck != md5($password)) {
        $_SESSION['errors']['password'] = 'Invalid old password!';
    } elseif ($confirm_password !== $new_password) {
        $_SESSION['errors']['password'] = 'Passwords do not match!';
    } elseif (strlen($new_password) < 6) {
        $_SESSION['errors']['password'] = "Minimum password length is 6!";
    } elseif ($password == $new_password) {
        $_SESSION["errors"]["password"] = "New password cannot be the same as the old one!";
    } else {
        // Check for password strength
        $hasLowercase = false;
        $hasUppercase = false;
        $hasDigit = false;

        for ($i = 0; $i < strlen($new_password); $i++) {
            $char = $new_password[$i];

            if ($char >= 'a' && $char <= 'z') {
                $hasLowercase = true;
            } elseif ($char >= 'A' && $char <= 'Z') {
                $hasUppercase = true;
            } elseif ($char >= '0' && $char <= '9') {
                $hasDigit = true;
            }
        }

        if (!$hasLowercase || !$hasUppercase || !$hasDigit) {
            $_SESSION['errors']['password'] = 'Password must contain at least one lowercase letter, one uppercase letter, and one digit.';
        } else {
            // Hash the new password and update it in the database
            $hashed_password = md5($new_password);
            $result = changePassword($email, $hashed_password);

            if ($result) {
                // Update the password in the session and set success message
                $_SESSION['password'] = $hashed_password;
                $_SESSION['message'] = "Password successfully changed!";
                unset($_SESSION['csrf-token']);
                header('Location: changePasswordForm.php');
                exit;
            }
        }
    }

    // Redirect back to the account edit form in case of errors or unsuccessful password change
    header('Location: changePasswordForm.php');
}else { 
    echo "Invalid CSRF token!";
}
?>