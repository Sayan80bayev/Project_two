<?php 
    if($_SESSION['role']=='developer' || $_SESSION['role']=='admin'){
        $name = $_SESSION['user_name'];
    }else {
        $_SESSION['message'] == 'You cannot enter there!';
        $_SESSION['staus'] = 'error' ;
        header('Location: http://localhost/project_two/auth/login/loginform.php');
    }
?>