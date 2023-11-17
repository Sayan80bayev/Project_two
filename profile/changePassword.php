<?php
session_start();
require_once '../db/connection.php';

$email = $_SESSION['email'] ?? '';
$password = $_POST['password'] ?? '';
$new_password = $_POST['new_password'] ?? '';
$confirm_password = $_POST['confirm_password'] ?? '';

$passwordCheck = $_SESSION['password'];

if (empty($password) || empty($new_password) ||empty($confirm_password) ) {
    $_SESSION['errors']['password'] = "Fill all the gaps!";
} elseif ($passwordCheck != md5($password)) {
    $_SESSION['errors']['password'] = 'Invalid old password!';
} elseif ($confirm_password !== $new_password) {
    $_SESSION['errors']['password'] = 'Passwords do not match!';
} elseif (strlen($new_password) < 6) {
    $_SESSION['errors']['password'] = "Min size is 6!";
}elseif($password == $new_password){
    $_SESSION["errors"]["password"] = "New password can not be the old one!";
}
 else {
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

        $hashed_password = md5($new_password);
        $result = changePassword($email, $hashed_password);
        if($result){
        $_SESSION['password'] = $hashed_password;
        $_SESSION['message'] = "Password succecfully has changed!";
        header('Location: accounteditform.php');
        exit;
        }
    }
}
header('Location: AccountEditForm.php');
?>
