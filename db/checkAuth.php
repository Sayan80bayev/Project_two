<?php
    if(isset($_SESSION['name']))
        $name = $_SESSION['name'];
    else {
        $_SESSION['status'] = 'error';
        $_SESSION['message'] = 'First you need to login';
        header("Location: ../login/loginForm.php");
    }

?>