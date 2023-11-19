<!-- Logout section -->
<?php
    session_start();
    session_destroy();
    header("Location: login/LoginForm.php");
?>