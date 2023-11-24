<?php
    //A php.code that checks for status
    if(isset($_SESSION['user_name']) && preg_match("/^[a-zA-Z0-9]+$/", $_SESSION['user_name']))
        $name = $_SESSION['user_name'];
    elseif(isset($_SERVER['user_name']) && !preg_match("/^[a-zA-Z0-9]+$/", $_SESSION['user_name']) ){
        $_SESSION['message'] = 'Warning: Incorrect user name';
        $_SESSION['status'] = 'error';
        header("Location: http://localhost/project_two/login/LoginForm.php");
        exit;
    }
    else {
        $_SESSION['message'] = 'First you need to login!';
        $_SESSION['status'] = 'error';
        header("Location: http://localhost/project_two/login/LoginForm.php");
        exit;
    }

    // Exposed one
    // if(isset($_SESSION['user_name']))
    //     $name = $_SESSION['user_name'];
    // else {
    //     $_SESSION['message'] = 'First you need to login!';
    //     $_SESSION['status'] = 'error';
    //     header("Location: http://localhost/project_two/login/LoginForm.php");
    //     exit;
    // }
?>