<?php
    if(isset($_SESSION['name']))
        $name = $_SESSION['name'];
    else {
        $_SESSION['message'] = 'First you need to login!';
        $_SESSION['status'] = 'error';
        header("Location: http://localhost/project_two/login/LoginForm.php");
        exit;
    }
?>