<!DOCTYPE html>
<html lang="en">
<head>
    <title>Review Changing</title>
    <link href="http://localhost/project_two/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="http://localhost/project_two/css/fullPage.css">
    <style>
        body {
            color: white;
            background-color: #2b2b2b;
        }

        .review, .review_form {
            margin: 20px auto;
            width: 40%;
        }
        .green { background-color: green; }
        .yellow { background-color: yellow; }
        .red { background-color: red; }
    </style>
</head>
<body>
    <?php
        session_start();

        // Display error or success message
        if (isset($_SESSION["message"])) {
            $messageColor = ($_SESSION['status'] == 'error') ? 'red' : 'green';
            echo '<h1 style="color:' . $messageColor . ';width:40%; margin:auto;">' . $_SESSION['message'] . '</h1>';
        }

        // Include necessary files
        require_once '../db/connection.php';
        require_once '../db/checkAuth.php';

        // Get user, game, and review information
        $user_id = $_SESSION['user_id'];
        $game_id = $_GET['game_id'];
        $review_id = $_GET['review_id'];
        $reviews = getUsersReview($user_id, $game_id);

        // Display user review
        echo '<div class="review">';
        echo '<div class="review-title">';
        echo '<div class="review-prof">';
        echo '<img class="avatar" src="http://localhost/project_two/images/user/' . $reviews[0]['avatar_url'] . '">';
        echo '<h1>' . $reviews[0]['user_name'] . '</h1>';
        echo '</div>';

        // Determine rating color based on the rating value
        if ($reviews[0]['rating'] <= 10 && $reviews[0]['rating'] > 6) {
            $rating_color = 'green';
        } elseif ($reviews[0]['rating'] <= 6 && $reviews[0]['rating'] > 4) {
            $rating_color = 'yellow';
        } else {
            $rating_color = 'red';
        }

        echo '<div class="rating ' . $rating_color . '"><h1>' . $reviews[0]['rating'] . '</h1></div>';
        echo '</div>';
        echo '<p>' . $reviews[0]['comment'] . '</p>';
        echo '<p class="date">Date: ' . $reviews[0]['review_date'] . '</p>';
        echo '</div>';
    ?>
    <form method="post" action="http://localhost/project_two/review/reviewChange.php" class="review_form">
        <label for="rating" style="font-size: 30px">Rating:</label>
        <select name="rating" style="height: 30px; color: azure; border: 2px solid #FBBB43;
            border-radius: 10px; background: #2B2B2B;" required>
            <?php
                // Generate rating options dynamically
                for ($i = 10; $i >= 1; $i--) {
                    echo '<option value="' . $i . '">' . $i . '</option>';
                }
            ?>
        </select><br>
        <label for="review" style="font-size: 30px">Review:</label><br>
        <textarea name="review" rows="4" cols="50" class="review_content"></textarea><br>
        <input type="hidden" value="<?= $game_id ?>" name='game_id'>
        <input type="hidden" value="<?= $review_id ?>" name='review_id'>
        <input type="submit" value="Submit Review" class="button">
    </form>

    <?php
        // Unset session variables
        unset($_SESSION['message']);
        unset($_SESSION['status']);
    ?>
</body>
</html>
