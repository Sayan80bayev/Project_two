<?php
    session_start();
    require_once '../db/checkAuth.php';
    include '../db/connection.php';
    $user_id = $_GET['user_id'];
    $review_id = $_GET['review_id'];
    $game_id = $_GET['game_id'];
    $review = getUsersReview($user_id, $game_id);
    if($review[0]['user_id'] == $_SESSION['user_id']){
        if(deleteReview($review_id)){
        $_SESSION['message'] = 'Succefully deleted!';
        $_SESSION['status'] = 'succes';
        header ('Location: ../fullGame.php?id='.$game_id);
        exit;
        }
        else{
            $_SESSION['message'] = 'Deletion failed';
            $_SESSION['status'] = 'error';
        }
    }
    else{
        header ('Location: ../fullGame.php?id='.$game_id);
    }
?>