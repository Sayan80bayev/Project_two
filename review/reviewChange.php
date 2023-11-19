<?php
    session_start();
    require_once '../db/checkAuth.php';
    require_once '../db/connection.php';
    if($_SERVER['REQUEST_METHOD']=='POST'){
        $reviews = getUsersReview($_SESSION['user_id'], $_POST['game_id']);
        if($reviews[0]['rating']==$_POST['rating'] && $reviews[0]['comment']== $_POST['review'] ){
            $_SESSION['message'] = "You haven't changed anything!";
            $_SESSION['status'] = 'error';
            header('Location: http://localhost/project_two/review/EditReviewFrom.php?review_id='.$reviews[0]['review_id'].'& game_id='.$_POST['game_id'].'');
            exit;
        }
        else{
        $result = changeReview($_POST['game_id'],$_SESSION['user_id'],
                                $_POST['review_id'],$_POST['rating'], $_POST['review']);
            if($result){
                $_SESSION['message'] = 'Successfully have changed a review';
                $_SESSION['status'] = 'success';
                header('Location: http://localhost/project_two/review/EditReviewFrom.php?review_id='.$reviews[0]['review_id'].'& game_id='.$_POST['game_id'].'');
                exit;
            }
            else{
                $_SESSION['message'] = 'Error';
                $_SESSION['status'] = 'error';
                header('Location: http://localhost/project_two/review/EditReviewFrom.php?review_id='.$reviews[0]['review_id'].'& game_id='.$_POST['game_id'].'');
                exit;
            }
        }
    }
?>