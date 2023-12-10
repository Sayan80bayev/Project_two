<?php
session_start();
require_once '../../db/checkAdmin.php';
require_once '../adminConnection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $game_id = $_POST['game_id'];
    $user_id = $_POST['user_id'];
    $rating = $_POST['rating'];
    $comment = $_POST['comment'];
    $review_id = searchReview($_SESSION['reviews'], $_POST['review_id']);
    $updated = false;
    foreach (array_map(null, $_SESSION['reviews'][$review_id], $_POST) as list($check, $posted)) {
        if ($check != $posted) {
            $updated = true;
        }
    }
    if($updated){
        $result = updateReview($review_id, $game_id, $user_id, $rating, $comment);
    
        if ($result) {
            $_SESSION['status'] = "success";
            $_SESSION['message'] = 'Review successfully updated!';
            header("Location: http://localhost/project_two/admin/admin.php#reviews");
            exit;
        } else {
            $_SESSION['status'] = "error";
            $_SESSION['message'] = 'Review not updated!';
            header("Location: http://localhost/project_two/admin/admin.php#reviews");
            exit;
        }
    }else{
        $_SESSION['status'] = "error";
        $_SESSION['message'] = 'You havent updated anything!';
        header("Location: http://localhost/project_two/admin/admin.php#reviews");
        exit;
    }

}
?>
