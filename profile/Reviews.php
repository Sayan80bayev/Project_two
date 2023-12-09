<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/svg+xml" href="http://localhost/project_two/images/gamepad-solid.svg">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Include your CSS links here -->
    <link rel="stylesheet" href="http://localhost/project_two/css/style.css">
    <link rel="stylesheet" href="http://localhost/project_two/css/fullpage.css">
    <title>Document</title>
</head>
<body>
    <?php
        session_start();
        require_once '../db/connection.php';
        require_once '../db/checkAuth.php';
        include '../components/header.php';
        $user_id = $_SESSION['user_id'] ?? '';
        $reviews = getUsersAllReviews($user_id);
    ?>
    <div class="review_container" style="margin-top: 70px;">
        <div class="reviews-block">
            <?php
                // Display reviews
                $rating_color = '';                
                $index = 0;

                if (count($reviews) == 0){
                    echo '<h1 style="margin-left:20px">There is no review yet</h1>';
                } else {
                    foreach ($reviews as $i => $review) :
                        include '../components/reviews.php';
                    endforeach;
                }
            ?>
        </div>
    </div>

    <!-- Your existing footer include -->
    <?php require_once '../components/footer.php';?>
    <!-- Your existing script block -->
    <script src="http://localhost/project_two/scripts/review_modal.js" defer></script></body>
</body>
</html>
