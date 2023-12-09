<!-- Logout section -->
<?php
    session_start();
    session_destroy();
    header("Location: http://localhost/project_two/auth/login/LoginForm.php");
?>