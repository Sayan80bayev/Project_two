<?php
    session_start();   
    
    if($_SERVER['REQUEST_METHOD']=='POST'){

        $name = $_POST['name'] ?? "";
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        $confirm_password = $_POST['confirm_password'] ?? '';
        $errors = [];

        require_once('../db/connection.php');
        if(empty($name)){
            $errors['name'] = 'Name is empty';
        }
        // pass_check
        if($password!=$confirm_password){
            $errors['password'] = 'Passwords do not match! ';
        }
        if (empty($password)) {
            $errors["password"] = "Password is empty!";
        }
        elseif(strlen($password)<6){
            $errors["password"] = "Min size is 6!";
        }
        else {
            $hasLowercase = false;
            $hasUppercase = false;
            $hasDigit = false;
            
            for ($i = 0; $i < strlen($password); $i++) {
                $char = $password[$i];
                
                if ($char >= 'a' && $char <= 'z') {
                    $hasLowercase = true;
                } elseif ($char >= 'A' && $char <= 'Z') {
                    $hasUppercase = true;
                } elseif ($char >= '0' && $char <= '9') {
                    $hasDigit = true;
                }
            }
            
            if (!$hasLowercase) {
                $errors['password'] .= 'Add 1 lowercase<br>';
            }
            if (!$hasUppercase) {
                $errors['password'] .= 'Add 1 uppercase<br>';
            }
            if (!$hasDigit) {
                $errors['password'] .= 'Add 1 digit<br>';
            }
        }
        // email check
        if (empty($email)) {
            $errors['login'] = 'Email is empty!';
        }
        elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['login'] = "Invalid login!";
        }

        $password = md5($password);

        $query = "INSERT INTO user (user_name, password, user_email)
                  VALUES(:name, :password, :email)";
        $stmt = $pdo->prepare($query);

        if(empty($errors)) {
            try{
                $stmt->execute([
                    'email' => $email,
                    'name'=> $name,
                    'password' => $password
                ]);
            }catch(PDOException $e){
                $errors['login'] = "{$e->getMessage()}";
                $_SESSION['status'] = 'error';
            }
        }
        if(empty($errors)) {
            $_SESSION['registered'] = 'sucsess';
            header('Location: ../index.php');
            exit();
        }
        else{
            $_SESSION['status'] = 'error';
            $_SESSION['errors'] = $errors;
            header("Location: RegisterForm.php");
            exit();
        }
    }

?>