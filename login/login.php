<?php
// require 'DB.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // POST variables
    $email = $_POST["email"];
    $password = $_POST["password"];
    $errors = [];
    $_SESSION['status'] = '';

    require_once('../db/connection.php');


    // pass_check
    if (empty($password)) {
        $errors["password"] = "Password is empty!";
    }
    elseif(strlen($password)<6){
        $errors["password"] = "Min size is 6!";
    }
    else {
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

    // querry
    
    $password = md5($password);
    $query = "SELECT * FROM user WHERE user_email = '$email'";
    $stmt = $pdo->query($query);
    $user = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // login_check
    if (empty($email)) {
        $errors['login'] = 'Email is empty!';
    }
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['login'] = "Invalid login!";
    }
    elseif ($user[0]["user_email"] != $email) {
        $errors['login'] = "No such email!";
    }

    // $query = "SELECT * FROM users WHERE email = '$email ' AND password = '$password'";
    // $stmt = $pdo->query($query);
    // $user = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (empty($errors)) {
        if (count($user) > 0 && $user[0]["password"] == $password) {
            if (isset($_POST["remember"])) {
                setcookie("user_email", $email, time() + 30 * 24 * 60 * 60); 
            }
            $_SESSION["name"] = $user[0]['user_name'];
            $_SESSION['status'] = 'success';
            header("Location: ../index.php");
            exit();
        } else {
            $errors["password"] = 'Invalid password';
            $_SESSION['status'] = 'error';
            $_SESSION['errors'] = $errors;
            header("Location: LoginForm.php");
            exit();
        }
    } else {
        $_SESSION['status'] = 'error';
        $_SESSION['errors'] = $errors;
        header("Location: LoginForm.php");
        exit();
    }
}
?>
