<?php 
session_start();
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if($_POST['status']==0){
        $_SESSION['status'] = 'error';
        $_SESSION['message'] = 'User is alredy banned';
        header('Location: admin.php');
        exit;
    }else{
        require_once 'adminConnection.php';
        $result = banUser($_POST['user_id']);
        if($result){
            $_SESSION['status'] = 'success';
            $_SESSION['message'] = 'Successfully banned!';
            header('Location: admin.php');
            exit;
        }else{
            $_SESSION['status'] = 'error';
            $_SESSION['message'] = 'Not banned!';
            header('Location: admin.php');
            exit;
        }
    }
}
?>