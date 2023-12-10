<?php
    session_start();
    require_once '../../db/checkAdmin.php';
    require_once '../adminConnection.php';
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $updated = false;
        $user_id = searchUser( $_SESSION['users'], $_POST['user_id']);
        foreach ($_POST as $key => $value) {
            if ($_SESSION['users'][$user_id][$key]!=$value) {
                $updated = true;
            }
        }
        $passwordCheck = false;
        if($_SESSION['users'][$user_id]['password_check'] != $_POST['password'])
            $passwordCheck = true;
        if($updated){
            if($passwordCheck){
                $result = updateUser($_POST['user_id'],
                $_POST['user_name'],
                $_POST['user_email'], 
                $_POST['avatar_url'], 
                md5($_POST['password']), 
                $_POST['role']);
            }
            else{
                $result = updateUser($_POST['user_id'], 
                $_POST['user_name'], 
                $_POST['user_email'], 
                $_POST['avatar_url'], 
                $_SESSION['users'][$user_id]['password_check'], 
                $_POST['role']);
            }
            if($result){
                $_SESSION['status'] = "success";
                $_SESSION['message'] = 'Successfully updated!';
                header("Location: http://localhost/project_two/admin/admin.php");
                exit;
            }else{
                $_SESSION['status'] = "error";
                $_SESSION['message'] = 'Not updated!';
                header("Location: http://localhost/project_two/admin/admin.php");
                exit;
            }
        }
        else{
            $_SESSION['status'] = "error";
            $_SESSION['message'] = 'You havent updated anything!';
            header("Location: http://localhost/project_two/admin/admin.php");
            exit;
        }
    }
?>