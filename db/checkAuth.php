<?php
    //A php.code that checks for status
    if(isset($_SESSION['user_name']))
        $name = $_SESSION['user_name'];
    else {
        $_SESSION['message'] = 'First you need to login!';
        $_SESSION['status'] = 'error';
        header("Location: http://localhost/project_two/login/LoginForm.php");
        exit;
    }
?>