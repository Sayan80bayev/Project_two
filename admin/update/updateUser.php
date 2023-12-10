<?php
    session_start();
    require_once '../../db/checkAdmin.php';
    require_once '../adminConnection.php';
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $user_id = searchUser( $_SESSION['users'], $_POST['user_id']);
        $avatar = $_FILES['avatar_url'] ?? [];
        $avatar_url = $_SESSION['users'][$user_id]['avatar_url'] ?? '';
        if(isset($avatar) && !empty($avatar) && $avatar['size']>0){
            $time = time();
            $avatar_name = $time.$avatar['name'];
            $avatar_tmp_name = $avatar['tmp_name'];
            $avatar_destination = '../../images/user/' . $avatar_name;
            $allowed_format = ['image/png', 'image/jpg', 'image/jpeg'];
            if(in_array($avatar['type'], $allowed_format)){
                if($avatar['size'] < 5*1024*1024){
                    $avatar_url = $avatar_name;
                    move_uploaded_file($avatar_tmp_name, $avatar_destination);
                }
                else{
                    $errors['avatar'] = 'Incorrect file, max size is 5mb';
                }
            }
            else{
                $errors['avatar'] = 'Incorrect file ext, only png, jpeg, jpg';
            }
        }
        $arr_to_check = $_POST;
        $arr_to_check['avatar_url'] = $avatar_url;
        $updated = false;
        foreach ($arr_to_check as $key => $value) {
            if ($_SESSION['users'][$user_id][$key]!=$value) {
                $updated = true;
            }
        }
        $passwordCheck = false;
        if($_SESSION['users'][$user_id]['password_check'] != $arr_to_check['password'])
        $passwordCheck = true;
    if($updated){
        if($passwordCheck){
                $result = updateUser($arr_to_check['user_id'],
                $arr_to_check['user_name'],
                $arr_to_check['user_email'], 
                $arr_to_check['avatar_url'], 
                md5($arr_to_check['password']), 
                $arr_to_check['role']);
            }
            else{
                $result = updateUser($arr_to_check['user_id'],
                $arr_to_check['user_name'],
                $arr_to_check['user_email'], 
                $arr_to_check['avatar_url'], 
                $_SESSION['users'][$user_id]['password_check'], 
                $arr_to_check['role']);
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