<!DOCTYPE html>
<html lang="en">

<head>
    <title>Document</title>
    <!-- Include CSS files -->
    <link href="http://localhost/project_two/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="http://localhost/project_two/css/fullPage.css">
    <style>
        .slide-toggle {
            cursor: pointer;
        }
        .chevron {
            background-color: transparent;
            fill: none;
            stroke: #f8e6de;
            stroke-width: 3;
            transition: .2s all linear;
        }
        .slide-toggle {
            transform-origin: center;
            transition: transform 0.5s ease;
        }
        .slider-prev, .slider-next{
            background-color: transparent;
            border: none;
        }
        .slide-toggle {
            transform: rotate(-90deg);
        }
        button :hover>.chevron, a :hover svg{
            stroke: #ED500A;
        }
        svg:hover > path{
            fill: #ED500A;
            transition: .5s;
        }
        <?php
        // Start session and include games data
        session_start();
        // $_SESSION['lastPage'] = 'http://localhost/project_two/index.php';
            include 'db/games.php';
            $uses_id = $_SESSION['user_id'] ?? '';
            $lastPage = $_SESSION['lastPage'] ?? 'http://localhost/project_two/index.php';
            $reviews = getReviews($_GET['id']); //here is the game id
        ?>
        main{
            background: linear-gradient(to bottom, rgba(0, 0, 0, 0.3), rgba(0, 0, 0, .9), rgba(0, 0, 0, 1 ),rgba(0, 0, 0, 1 )
            <?php
            for($i = 1 ; $i <= count($reviews) ; $i++){
                echo ',rgba(0, 0, 0, 1) ';
            }
            ?>
            );
        }
        <?php
        // Iterate through games data
        for ($i = 0; $i < count($games); $i++) {
            if (isset($_GET['id']) && !empty($_GET['id'])) {
                if ($games[$i]['game_id'] == $_GET['id']) {
                    ?>
                    body {
                        height: 100vh;
                        /* background-color: black; */
                        background-image: url('<?=$games[$i]['poster']?>');
                        background-repeat: no-repeat;
                        background-size: cover;
                        margin: 0;
                        padding: 0;
                    }
        </style>
</head>



<body>
    <?php include 'header.php';?>
    <main>
        <div class="container">
            <div class="little-container">
                <!-- <button onclick="goBack()"><</button> -->
                <a href="<?=$lastPage?>">
                <svg xmlns="http://www.w3.org/2000/svg" height="3em" viewBox="0 0 320 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l192 192c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L77.3 256 246.6 86.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-192 192z" fill="#f8e6de"/></svg>
                </a>
                <div class="game-card">
                    <img src="<?=$games[$i]['photo']?>" alt="">
                    <div class="min-info">
                        <h2><?= $games[$i]['game_name']?></h2>
                        <p><?= $games[$i]['genre']?></p>
                        <?php if($games[$i]['new_price'] != $games[$i]['old_price']){ ?>
                            <p style="text-decoration: line-through; color: gray;"><?= $games[$i]['old_price']?></p>
                            <p style="font-weight: bold; color: green; font-size: 30px"><?= $games[$i]['new_price']?></p>
                        <?php } else { ?>
                            <p><?= $games[$i]['new_price']?></p>
                        <?php } ?>
                    </div>
                </div>
            </div>

            <div class="about">
                <h2><?= $games[$i]['game_name'] ?></h2>
                <div class="info"><p>Date:</p><p><?= $games[$i]['release_date'] ?></p></div>
                <div class="info"><p>Developers:</p><p><?= $games[$i]['developers'] ?></p></div>
                <div class="info"><p>Genre:</p><p><?= $games[$i]['genre'] ?></p></div>
                <div class="info"><p>Price:</p><p><?= $games[$i]['new_price'] ?></p></div>
                <p>About game:<br><?= $games[$i]['description'] ?></p>
            </div>

            <div class="genre-container">
                <h2>Screenshots</h2>
            </div>
            <div class="carousel-container">
                <button class="slider-prev">
                            <!-- SVG for previous button -->
                            <svg class="slide-toggle" direction="left" height="50" width="50">
                                <polyline class="chevron" points="0,50 25,38 50,50" />
                                Sorry, your browser does not support inline SVG.
                            </svg>
                </button>
                <div class="carousel">
                    <div class="carousel-line">
                        <img src="<?=$games[$i]['screenshot_1']?>" alt="">
                        <img src="<?=$games[$i]['screenshot_2']?>" alt="">
                        <img src="<?=$games[$i]['screenshot_3']?>" alt="">
                    </div>
                </div>
                <button class="slider-next">
                    <!-- SVG for next button -->
                    <svg class="slide-toggle" direction="next" height="50" width="50">
                        <polyline class="chevron" points="0,0 25,12 50,0" />
                        Sorry, your browser does not support inline SVG.
                    </svg>
                </button>
            </div>
        </div>
        <?php
                }
            }
        }   ?>
        <h2 style="width: 65%; margin: 15px auto 15px">Reviews</h2>
        <div class="review_container">
            <div class="reviews-block">
                <?php
                // Display reviews
                $user_id = $_SESSION['user_id'] ?? '';
                $rating_color = '';                
                $index = 0;
                if (count($reviews) == 0){
                    echo '<h1 style="margin-left:20px">There is no review yet</h1>';
                } else {
                    for ($i = count($reviews) - 1; $i >= 0; $i--) :
                    ?>
                    <div class="review">
                        <div class="review-title">
                            <div class="review-prof">
                                <div class="profileLink" style="margin-right:5px">
                                    <img src="http://localhost/project_two/images/user/<?= $reviews[$i]['avatar_url'] ?>">
                                </div>
                                <h1><?= $reviews[$i]['user_name'] ?></h1>
                
                                
                            </div>
                            <!-- Coloring the rate -->
                            <?php
                            if ($reviews[$i]['rating'] <= 10 && $reviews[$i]['rating'] > 6) {
                                $rating_color = 'green';
                            } elseif ($reviews[$i]['rating'] <= 6 && $reviews[$i]['rating'] > 4) {
                                $rating_color = 'yellow';
                            } else {
                                $rating_color = 'red';
                            }
                            ?>
                            <div>
                                <div class="rating <?= $rating_color ?>"><h1><?= $reviews[$i]['rating'] ?></h1></div>
                                <?php if ($reviews[$i]['user_id'] == $user_id): ?>
                                    <!-- modal of edit and delete -->
                                    <button class='three-dots-button' id="openModalBtn">
                                            <div class="dot"></div>
                                            <div class="dot"></div>
                                            <div class="dot"></div>
                                    </button>
                                    <div id="modal" class="modal">
                                        <div class="modal-content">
                                            <span class="close" onclick="closeModal()">&times;</span>
                                            <ul>
                                                <li><a href="http://localhost/project_two/review/EditReviewFrom.php?review_id=<?= $reviews[$i]['review_id'] ?>&game_id=<?= $_GET['id'] ?>">Edit</a></li>
                                                <li><button href="" onclick="confirmDelete(<?= $reviews[$i]['review_id'] ?>)">Delete</button></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <?php $reviews[$i]['status'] = 'review has'; $index = $i; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                        <p><?= $reviews[$i]['comment'] ?></p>
                        <p class="date">Date: <?= $reviews[$i]['review_date'] ?></p>
                    </div>
                    <?php
                endfor;
            }
                ?>
            </div>

            <!-- Review writing-->
            <?php
            if (isset($_SESSION['message']) && $_SESSION['status']=='error'){
                echo '<h1 style="margin:auto 20px; color:red;">'. $_SESSION['message'] .'</h1>';
            }
            elseif(isset($_SESSION['message']) && $_SESSION['status']=='succes'){
                echo '<h1 style="margin:auto 20px; color:green;">'. $_SESSION['message'] .'</h1>';
            }
            $result =array_column($reviews, "user_id");
            if (!in_array($user_id, $result)):
            ?>
            <form method="post" action="review/review.php" class="review_form"> 
                <h1>Write a review</h1>
                <label for="rating" style="font-size:30px">Rating:</label>
                <select name="rating" style="height:30px; color: azure; border: 2px solid #ED500A;
                    border-radius: 10px; background: #2B2B2B;" required>
                    <?php
                    for ($i = 10; $i >= 1; $i--) {
                        echo '<option value="' . $i . '">' . $i . '</option>';
                    }
                    ?>
                </select><br>
                <label for="review" style="font-size:30px">Review:</label><br>
                <textarea name="review" rows="4" cols="50" class="review_content"></textarea><br>
                <input type="text" style="visibility: hidden; height:0; width:0; margin:0; padding:0;" value="<?=$_GET['id']?>" name='game_id'> 
                <input type="submit" value="Submit Review" class="button">
            </form>
            <?php endif;?>
        </div>
        <?php
        unset($_SESSION['status']);
        unset($_SESSION['message']);
        ?>
    <?php include 'footer.php';?>
    </main>
    <script>

        let offset = 0;
        const sliderLine = document.querySelector('.carousel-line');
        const width = 1003;

        document.querySelector('.slider-next').addEventListener('click', function(){
            offset = offset + width;
            if (offset > width*2) {
                offset = 0;
            }
            sliderLine.style.left = -offset + 'px';
        });

        document.querySelector('.slider-prev').addEventListener('click', function () {
            offset = offset - width;
            if (offset < 0) {
                offset = width*2;
            }
            sliderLine.style.left = -offset + 'px';
        });
        document.getElementById('openModalBtn').addEventListener('click', openModal);
        function openModal() {
            const modal = document.getElementById('modal');
            modal.style.display = 'flex';
            modal.style.zIndex = '1';
        }
        function closeModal() {
            document.getElementById('modal').style.display = 'none';
        }
        function confirmDelete(reviewId) {
        // Use the window.confirm() method to show a confirmation dialog
        const isConfirmed = window.confirm("Are you sure you want to delete this review?");

        // If the user clicks "OK" in the confirmation dialog, proceed with the delete action
        if (isConfirmed) {
            // Redirect to the delete action, passing the review_id and game_id
            window.location.href = `http://localhost/project_two/review/DeleteReview.php?review_id=${reviewId}&user_id=<?= $_SESSION['user_id']?>&game_id=<?= $_GET['id'] ?>`;
        }
    }
    </script>
</body>
</html>
