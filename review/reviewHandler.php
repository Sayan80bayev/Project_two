<?php
// Start the session to access session variables
session_start();
// Include the authentication check file
require_once("../db/checkAuth.php");

// Check if the form is submitted using POST method
if(isset($_SERVER["REQUEST_METHOD"]) && $_SERVER["REQUEST_METHOD"] == "POST"){
    // Include necessary files
    require_once("../db/connection.php");
    // Add a review and store the result in $result
    $result = addReview(
        $_POST["game_id"], $_SESSION["user_id"],
        $_POST["rating"], $_POST['review']
    ) ?? '';
    // Check if the review addition was successful
    if(!$result){
        // If the user already has a review, show a message and redirect
        $_SESSION['message'] = 'You already have a review, rewrite via edit!';
        header('Location: http://localhost/project_two/fullGame.php?id='.$_POST["game_id"].'');
        exit();
    }
    // Redirect to the fullGame page after adding the review
    $_SESSION['message'] = 'Review added successfully!';
    $_SESSION['status'] = 'success';
    header('Location: http://localhost/project_two/fullGame.php?id='.$_POST["game_id"].'');
    exit();
    }

?>
