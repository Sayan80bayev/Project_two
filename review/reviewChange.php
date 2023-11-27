<?php
// Start the session to access session variables
session_start();

// Include necessary files for authentication and database connection
require_once '../db/checkAuth.php';
require_once '../db/connection.php';

// Check if the form is submitted using POST method
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the user's existing review for the specified game
    $reviews = getUsersReview($_SESSION['user_id'], $_POST['game_id'], $_POST['review_id']);

    // Check if the submitted data is the same as the existing review
    if ($reviews[0]['rating'] == $_POST['rating'] && $reviews[0]['comment'] == $_POST['review']) {
        // If no changes are made, set an error message and redirect
        $_SESSION['message'] = "You haven't changed anything!";
        $_SESSION['status'] = 'error';
        header('Location: http://localhost/project_two/review/EditReviewFrom.php?review_id='.$_GET['review_id'].'&game_id='.$_POST['game_id'].'');
        exit;
    } else {
        // Attempt to change the review in the database
        $result = changeReview($_POST['game_id'], $_SESSION['user_id'], $_POST['review_id'], $_POST['rating'], $_POST['review']);

        // Check the result of the review change operation
        if ($result) {
            // If successful, set a success message and redirect
            $_SESSION['message'] = 'Successfully have changed a review';
            $_SESSION['status'] = 'success';
            header('Location: http://localhost/project_two/review/EditReviewFrom.php?review_id='.$_POST['review_id'].'&game_id='.$_POST['game_id'].'');
            exit;
        } else {
            // If there is an error, set an error message and redirect
            $_SESSION['message'] = 'Error';
            $_SESSION['status'] = 'error';
            header('Location: http://localhost/project_two/review/EditReviewFrom.php?review_id='.$_POST['review_id'].'&game_id='.$_POST['game_id'].'');
            exit;
        }
    }
}
?>
