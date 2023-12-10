<!DOCTYPE html>
<html lang="en">
<head>
    <title>Review Changing</title>
    <link rel="icon" type="image/svg+xml" href="http://localhost/project_two/images/gamepad-solid.svg">
    <link href="http://localhost/project_two/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="http://localhost/project_two/css/fullPage.css">
    <style>
        body {
            color: white;
        }
        .review, .review_form {
            margin: 20px auto;
            width: 95%;
        }
        .green { background-color: green; }
        .yellow { background-color: yellow; }
        .red { background-color: red; }
    </style>
</head>
<body>
    <?php session_start(); ?>

    <?php if (isset($_SESSION["message"])): ?>
        <?php $messageColor = ($_SESSION['status'] == 'error') ? 'red' : 'green'; ?>
        <h1 style="color: <?= $messageColor ?>; width: 40%; margin: auto;">
            <?= $_SESSION['message'] ?>
        </h1>
    <?php endif; ?>

    <?php require_once '../db/connection.php'; ?>
    <?php require_once '../db/checkAuth.php'; ?>

    <?php
        $user_id = $_SESSION['user_id'];
        $game_id = $_GET['game_id'] ?? '';
        $review_id = $_GET['review_id'] ?? '';
        $reviews = getUsersReview($user_id, $game_id, $review_id) ;
        if(!empty($reviews)){
    ?>
<div class="review_container">
    <div class="review">
        <div class="review-title">
            <div class="review-prof">
                <img class="avatar" src="http://localhost/project_two/images/user/<?= $reviews[0]['avatar_url'] ?>">
                <h1><?= $reviews[0]['user_name'] ?></h1>
            </div>

            <?php
                if ($reviews[0]['rating'] <= 10 && $reviews[0]['rating'] > 6) {
                    $rating_color = 'green';
                } elseif ($reviews[0]['rating'] <= 6 && $reviews[0]['rating'] > 4) {
                    $rating_color = 'yellow';
                } else {
                    $rating_color = 'red';
                }
            ?>

            <div class="rating <?= $rating_color ?>">
                <h1><?= $reviews[0]['rating'] ?></h1>
            </div>
        </div>
        <p><?= $reviews[0]['comment'] ?></p>
        <p class="date">Date: <?= $reviews[0]['review_date'] ?></p>
    </div>

    <form method="post" action="http://localhost/project_two/review/reviewChange.php" class="review_form">
        <label for="rating" style="font-size: 30px">Rating:</label>
        <select name="rating" style="height: 30px; color: azure; border: 2px solid #ED500A;
            border-radius: 10px; background: #2B2B2B;" required>
            <?php for ($i = 10; $i >= 1; $i--): ?>
                <?php if ($i == $reviews[0]['rating']): ?>
                    <option value="<?= $i ?>" selected><?= $i ?></option>
                <?php else: ?>
                    <option value="<?= $i ?>"><?= $i ?></option>
                <?php endif; ?>
            <?php endfor; ?>
        </select><br>

        <label for="review" style="font-size: 30px">Review:</label><br>
        <textarea name="review" rows="4" cols="50" class="review_content"><?= $reviews[0]['comment'] ?></textarea><br>
        <input type="hidden" value="<?= $game_id ?>" name='game_id'>
        <input type="hidden" value="<?= $review_id ?>" name='review_id'>
        <input type="submit" value="Submit Review" class="button" style="display:inline">
        <a href="<?=$_SESSION['lastPage']?>">Back</a>
    </form>
</div>
    <?php }else{
        echo "<h1>Review haven't found</h1>";
        }?>
    <?php unset($_SESSION['message']); ?>
    <?php unset($_SESSION['status']); ?>
</body>
</html>
