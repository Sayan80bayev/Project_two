<?php 
    session_start();
    if($_SERVER['REQUEST_METHOD']=='POST'){
        if(isset($_POST['category_name']) && !empty($_POST['category_name'])){
            require_once 'adminConnection.php';
            $result = addCat($_POST['category_name']);
            if($result){
                $_SESSION['status'] = 'success';
                $_SESSION['message'] = 'Successfully added a category';
                header('Location: http://localhost/project_two/admin/admin.php');
                exit;
            }else{
                $_SESSION['status'] = 'error';
                $_SESSION['message'] = 'Couldnt add a category';
                header('Location: http://localhost/project_two/admin/admin.php');
                exit;
            }
        }else{
            $_SESSION['status'] = 'error';
            $_SESSION['message'] = 'Category name is empty';
            header('Location: http://localhost/project_two/admin/admin.php');
            exit;
        }
    }
?>