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
            ?>
                    <div class="review">
                        <!-- Name, avatar, rate printing -->
                        <div class="review-title">
                            <div class="review-prof">
                                <div class="profileLink" style="margin-right:5px">
                                    <img src="http://localhost/project_two/images/user/<?= $review['avatar_url'] ?>">
                                </div>
                                <h1><?= $review['user_name'] ?></h1>   
                            </div>
                            <!-- Coloring the rate -->
                            <?php
                                if ($review['rating'] <= 10 && $review['rating'] > 6) {
                                    $rating_color = 'green';
                                } elseif ($review['rating'] <= 6 && $review['rating'] > 4) {
                                    $rating_color = 'yellow';
                                } else {
                                    $rating_color = 'red';
                                }
                            ?>
                            <div>
                                <div class="rating <?= $rating_color ?>"><h1><?= $review['rating'] ?></h1></div>
                                <?php if ($review['user_id'] == $user_id): ?>
                                    <!-- Modal of edit and delete -->
                                    <button class='three-dots-button openModalBtn'>
                                        <div class="dot"></div>
                                        <div class="dot"></div>
                                        <div class="dot"></div>
                                    </button>
                                    <div class="modal">
                                        <div class="modal-content">
                                            <!-- Close button with onclick attribute -->
                                            <span class="close" onclick="closeModal(event)">&times;</span>
                                            <!-- Edit and delete options -->
                                            <ul>
                                                <li><a href="http://localhost/project_two/review/EditReviewFrom.php?review_id=<?= $review['review_id'] ?>&game_id=<?= $review['game_id'] ?>">Edit</a></li>
                                                <li><button onclick="confirmDelete(<?= $review['review_id'] ?>, <?= $review['game_id'] ?>)">Delete</button></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <?php $reviews[$i]['status'] = 'review has'; $index = $i; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                        <p><?= $review['comment'] ?></p>
                        <p class="date">Date: <?= $review['review_date'] ?></p>
                    </div>
            <?php
                    endforeach;
                }
            ?>
        </div>
    </div>

    <!-- Your existing footer include -->
    <?php require_once '../components/footer.php';?>

    <!-- Your existing script block -->
    <script> 
        // Event listener for opening modals
        document.querySelectorAll('.three-dots-button.openModalBtn').forEach(function(button) {
            button.addEventListener('click', openModal);
        });

        // Function to open modals
        function openModal(event) {
            const button = event.currentTarget;
            const modal = button.nextElementSibling; // Assuming the modal is the next sibling
            modal.style.display = 'flex';
            modal.style.zIndex = '1';
        }

        // Function to close modals
        function closeModal(event) {
            const closeBtn = event.currentTarget;
            const modal = closeBtn.closest('.modal');
            modal.style.display = 'none';
        }

        // Function for delete confirmation
        function confirmDelete(reviewId, gameId) {
            const isConfirmed = window.confirm("Are you sure you want to delete this review?");
            if (isConfirmed) {
                window.location.href = `http://localhost/project_two/review/DeleteReview.php?review_id=${reviewId}&user_id=<?= $_SESSION['user_id']?>&game_id=${gameId}`;
            }
        }
    </script>
</body>
</html>
