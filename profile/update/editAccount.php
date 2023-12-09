<?php
session_start();

// Include necessary files
include '../db/checkAuth.php';
require_once '../db/connection.php';

$errors = array();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newName = $_POST['new_name'] ?? $_SESSION['user_name'];
    $currentName = $_SESSION['user_name'] ?? '';
    $user_id = $_POST['user_id'];
    $avatar = $_FILES['new_avatar'] ?? [];
    $avatar_name = $_SESSION['avatar_url'];
    
    // Validate and update user information
    if($currentName === $newName && empty($_FILES['new_avatar']['name'])){
        $errors['message'] = 'You havent changed anything';
        $_SESSION['status'] = 'error';
        $_SESSION['errors'] = $errors;
        header('Location: accounteditform.php');
        exit();
    }
    if (isset($_POST['new_name'])) {
        if (empty($newName)) {
            $errors['name'] = 'Name cannot be empty.';
        } elseif ($newName !== $currentName) {
                $_SESSION['user_name'] = $newName;
                $currentName = $newName;
                // Add your database update logic here if needed
            } 
    }

    // Handle avatar upload
    if(isset($avatar) && !empty($avatar) && $avatar['size'] > 0){
		$time = time();
		$avatar_name = $time.$avatar['name'];
		$avatar_tmp_name = $avatar['tmp_name'];
		$avatar_destination = '../images/user/' . $avatar_name;
		$allowed_format = ['image/png', 'image/jpg', 'image/jpeg'];
		if(in_array($avatar['type'], $allowed_format)){
			if($avatar['size'] < 5*1024*1024){
				move_uploaded_file($avatar_tmp_name, $avatar_destination);
                $_SESSION['avatar_url'] = $avatar_name;
			}
			else{
				$errors['avatar'] = 'Incorrect file, max size is 5mb';
			}
		}
		else{
				$errors['avatar'] = 'Incorrect file ext, only png, jpeg, jpg';
		}
	}

    // Check if there are errors
    if (!empty($errors)) {
        $_SESSION['status'] = 'error';
        $_SESSION['errors'] = $errors;
        header('Location: accounteditform.php');
        exit;
    }else{
        updateUser($user_id, $currentName, $avatar_name);
        $_SESSION['status'] = 'succes';
        $_SESSION['success']['message'] = 'Update!' ;
        // Redirect to the profile page after updating
        header('Location: accounteditform.php');
        exit();
    }
} else {
    // Redirect to the profile page if accessed directly without form submission
    header('Location: accounteditform.php');
    exit();
}
?>
