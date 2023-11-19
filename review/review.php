<?php
session_start();
require_once("db/checkAuth.php");
    if(isset($_SERVER["REQUEST_METHOD"]) && $_SERVER["REQUEST_METHOD"] == "POST"){
        require_once("db/connection.php");
        $result = addReview(
            $_POST["game_id"], $_SESSION["user_id"],
            $_POST["rating"], $_POST['review']) ?? '';
        if(!$result){
            $_SESSION['message'] = 'You already have a review, rewrite via edit!';
            header('Location: http://localhost/project_two/fullGame.php?id='.$_POST["game_id"].'');
            exit();
        }
        // $_SERVER['message'] = $result ?? '';
        header('Location: http://localhost/project_two/fullGame.php?id='.$_POST["game_id"].'');
        exit();
    }
?>