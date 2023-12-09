<?php 
session_start();
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if($_POST['status']==1){
        $_SESSION['status'] = 'error';
        $_SESSION['message'] = 'User is alredy unbanned';
        header('Location: admin.php');
        exit;
    }else{
        require_once 'adminConnection.php';
        $result = unbanUser($_POST['user_id']);
        if($result){
            $_SESSION['status'] = 'success';
            $_SESSION['message'] = 'Successfully unbanned!';
            header('Location: admin.php');
            exit;
        }else{
            $_SESSION['status'] = 'error';
            $_SESSION['message'] = 'Not unbanned!';
            header('Location: admin.php');
            exit;
        }
    }
}
?>