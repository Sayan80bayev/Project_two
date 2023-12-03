<?php
    session_start();
    require_once '../../db/checkAdmin.php';
    require_once '../adminConnection.php';
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $result = deleteGame($_POST['game_id']);
        if($result){
            $_SESSION['status'] = "success";
            $_SESSION['message'] = 'Successfully deleted!';
            header("Location: http://localhost/project_two/admin/admin.php");
            exit;
        }else{
            $_SESSION['status'] = "error";
            $_SESSION['message'] = 'Not deleted!';
            header("Location: http://localhost/project_two/admin/admin.php");
            exit;
        }
    }
?>