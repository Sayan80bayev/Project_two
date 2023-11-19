<!DOCTYPE html>
<html lang="en">
<head>
    <title>Document</title>
    <link href="http://localhost/project_two/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="http://localhost/project_two/css/fullPage.css">
    <style>
        <?php
        // Start session and include games data
        session_start();
        include 'db/games.php';

        // Iterate through games data
        for ($i = 0; $i < count($games); $i++) {
            if (isset($_GET['id']) && !empty($_GET['id'])) {
                if ($games[$i]['game_id'] == $_GET['id']) {
                    ?>
                    body {
                        height: 100vh;
                        background-color: black;
                        background-image: url('<?=$games[$i]['poster']?>');
                        background-repeat: no-repeat;
                        background-size: cover;
                        margin: 0;
                        padding: 0;
                    }
        </style>
                <main>
                    <!-- container-start -->
                    <div class="container">
                        <!-- little-container start -->
                        <div class="little-container">
                            <button onclick="goBack()"><</button>
                            <div class="game-card">
                                <img src="<?=$games[$i]['photo']?>" alt="">
                                <div class="min-info">
                                    <h2><?= $games[$i]['game_name']?></h2>
                                    <p><?= $games[$i]['genre']?></p>
                                    <?php if($games[$i]['new_price'] != $games[$i]['old_price']){ ?>
                                        <p style="text-decoration: line-through; color: gray;"><?= $games[$i]['old_price']?></p>
                                        <p style="font-weight: bold; color: green; font-size: 30px"><?= $games[$i]['new_price']?></p>
                                    <?php } else { ?>
                                        <p ><?= $games[$i]['new_price']?></p>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <!-- little-container end -->
                        <div class="about">
                            <?php
                            echo "<h2>" . $games[$i]['game_name'] . "</h2>";
                            echo "<div class ='info'><p> Date: </p> <p>" . $games[$i]['release_date'] . "</p> </div>";
                            echo "<div class ='info'><p> Developers:</p> <p>" . $games[$i]['developers'] . "</p></div>";
                            echo "<div class ='info'><p>Genre: </p> <p>"  . $games[$i]['genre'] . "</p> </div>";
                            echo "<div class ='info'><p>Price: </p> <p>" . $games[$i]['new_price'] . "</p> </div>";
                            echo "<p>About game:<br>" . $games[$i]['description'] . "</p>";
                            ?>
                        </div>
                        <div class="genre-container">
                            <h2>Screenshots</h2>
                        </div>
                        <div class="carousel">
                            <div class="carousel-line">
                                <img src="<?=$games[$i]['screenshot_1']?>" alt="">
                                <img src="<?=$games[$i]['screenshot_2']?>" alt="">
                                <img src="<?=$games[$i]['screenshot_3']?>" alt="">
                            </div>
                            <div class="btn-container">
                                <button class="slider-prev"><</button>
                                <button class="slider-next">></button>
                            </div>
                        </div>
                        <?php
                    }
                }
            }
            ?>
                    </div> 
                    <h2 style="width: 65%; margin: 15px auto 15px">Reviews</h2>
                    <div class="review_container">
                        <div class="reviews-block">
                            <?php
                            $user_id = $_SESSION['user_id'] ?? '';
                            $rating_color = '';                
                            $reviews = getReviews($_GET['id']); //here is the game id
                            $index = 0;
                            if (count($reviews) == 0){
                                echo '<h1 style="margin-left:20px">There is no review yet</h1>';
                            } else {
                                for ($i = count($reviews)-1; $i >= 0; $i--) {
                                    echo '<div class="review">';
                                    echo '<div class="review-title">';
                                    echo '<div class="review-prof">';
                                    echo '<img class="avatar" src="http://localhost/project_two/images/user/'.$reviews[$i]['avatar_url'].'">';
                                    echo'<h1>'. $reviews[$i]['user_name'] .'</h1>';
                                    if ($reviews[$i]['user_id'] == $user_id){
                                        echo '<a href="http://localhost/project_two/review/EditReviewFrom.php?review_id='.$reviews[$i]['review_id'].'& game_id='.$_GET['id'].'" class="button" style="height:25px; font-size:20px; margin:auto 15px">Edit</a>';
                                        $reviews[$i]['status'] = 'review has';
                                        $index = $i;
                                    }
                                    echo '</div>';
                                    if ($reviews[$i]['rating'] <= 10 && $reviews[$i]['rating'] > 6){
                                        $rating_color = 'green';
                                    } elseif ($reviews[$i]['rating'] <= 6 && $reviews[$i]['rating'] > 4){
                                        $rating_color = 'yellow';
                                    } else {
                                        $rating_color = 'red';
                                    }
                                    echo '<div class = "rating '.$rating_color.'"><h1>'. $reviews[$i]['rating'] .'</h1></div>';
                                    echo '</div>';
                                    echo '<p>'. $reviews[$i]['comment'] .'</p>';
                                    echo '<p class="date">Date: '. $reviews[$i]['review_date'] .'</p>';
                                    echo '</div>';
                                }
                            }
                            ?>
                        </div>
                        <?php
                        if (isset($_SESSION['message'])){
                            echo '<h1 style="margin:auto 20px; color:red;">'. $_SESSION['message'] .'</h1>';
                        }
                        $uses_id = $_SESSION['user_id'] ?? '';
                        $result =array_column($reviews, "user_id");
                        if (!in_array($user_id, $result))://hide the form if individual has a review
                        ?>
                        <form method="post" action="review.php" class="review_form"> 
                            <h1>Write a review</h1>
                            <label for="rating" style="font-size:30px">Rating:</label>
                            <select name="rating" style="height:30px; color: azure; border: 2px solid #FBBB43;
                                border-radius: 10px; background: #2B2B2B;" required>
                                <?php
                                // Generate rating options dynamically
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
                    unset($_SESSION['message']);
                    ?>
                </main>
                <script>
                    //button-back
                    function goBack() {
                        window.history.back();
                    }

                    //carousel-moving
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
                </script>
</body>
</html>
