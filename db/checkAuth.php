<?php
    //A php.code that checks for status
    if(isset($_SESSION['user_name']) && preg_match("/^[a-zA-Z0-9]+$/", $_SESSION['user_name']) && $_SESSION['userStatus']) 
        $name = $_SESSION['user_name'];
    elseif(isset($_SESSION['user_name']) && !preg_match("/^[a-zA-Z0-9]+$/", $_SESSION['user_name']) ){
        $_SESSION['message'] = 'Warning: Incorrect user name';
        $_SESSION['status'] = 'error';
        header("Location: http://localhost/project_two/auth/login/LoginForm.php");
        exit;
    }elseif(!isset($_SESSION['user_name'])){
        $_SESSION['message'] = 'First you need to login!';
        $_SESSION['status'] = 'error';
        header("Location: http://localhost/project_two/auth/login/LoginForm.php");
        exit;
    }
    elseif(!$_SESSION['userStatus']){
        $_SESSION['message'] = 'You have banned';
        $_SESSION['status'] = 'error';
        header("Location: http://localhost/project_two/auth/login/LoginForm.php");
        exit;
    }
    else {
        $_SESSION['message'] = 'First you need to login!';
        $_SESSION['status'] = 'error';
        header("Location: http://localhost/project_two/auth/login/LoginForm.php");
        exit;
    }
?>