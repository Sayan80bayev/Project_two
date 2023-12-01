<?php 
    if($_SESSION['role']=='admin'){
        $name = $_SESSION['username'];
    }else {
        $_SESSION['message'] == 'You cannot enter there!';
        $_SESSION['staus'] = 'error' ;
        header('Location: http://localhost/project_two/login/loginform.php');
    }
?>