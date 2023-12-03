<!DOCTYPE html>
<html lang="en">

<head>
    <title>Game Store</title>
    <!-- Include CSS files -->
    <link rel="stylesheet" href="http://localhost/project_two/css/style.css">
    <link rel="stylesheet" href="http://localhost/project_two/css/carousel.css">
    <!-- Include JavaScript file with 'defer' attribute -->
    <script src="script.js" defer></script>
</head>

<body>
    <!-- Header Section -->
    <?php 
        // Include header, games, and database connection files
        session_start();
        $_SESSION['lastPage'] = 'http://localhost/project_two/index.php';
        include 'header.php';
        require_once 'db/connection.php';
        $games = getGames();
    ?>

    <!-- Main Content -->
    <div class="big-container">
        <div class="category">
            <?php
                // Include category file and display 'Add game' link for developers
                include 'category.php';
                $role = $_SESSION['role'] ?? '';
                if($role=='developer' || $role=='admin'){
                    echo'<a href="developers/AddGameForm.php"  style = "display:flex; align-items:center;"><h2>Add game</h2><svg xmlns="http://www.w3.org/2000/svg" height="16" width="14" viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2023 Fonticons, Inc.--><path d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32V224H48c-17.7 0-32 14.3-32 32s14.3 32 32 32H192V432c0 17.7 14.3 32 32 32s32-14.3 32-32V288H400c17.7 0 32-14.3 32-32s-14.3-32-32-32H256V80z" fill="#f8e6de"/></svg></a>';
                }
                if($role == 'admin')
                    echo'<a href="admin/Admin.php"><h2>AdminPage</h2></a>';
            ?>
        </div>
        <main>
            <!-- Carousel Section -->
            <div class="carousel">
                <div class="carousel-line">
                    <?php
                    // Display posters in the carousel
                    for ($i = 11; $i > 5; $i--) {
                    ?>
                        <!-- Poster Card -->
                        <div class="poster">
                            <img src="<?= $games[$i]['poster'] ?>" alt="">
                            <div class="title">
                                <div class="content">
                                    <!-- Link to full game details -->
                                    <a href="fullGame.php?id=<?= $games[$i]['game_id'] ?>">
                                        <?= $games[$i]['game_name'] ?>
                                    </a>
                                    <p><?= $games[$i]['genre'] ?></p>
                                    <?php
                                    // Display prices with appropriate styles
                                    if ($games[$i]['new_price'] != $games[$i]['old_price']) {
                                    ?>
                                        <p class="price" style="text-decoration: line-through; color: gray;">
                                            <?= $games[$i]['old_price'] ?>
                                        </p>
                                        <p class="price" style="font-weight: bold; color: green;">
                                            <?= $games[$i]['new_price'] ?>
                                        </p>
                                    <?php
                                    } elseif ($games[$i]['new_price'] == 0.00) {
                                        $games[$i]['new_price'] = 'Free';
                                        echo '<p class="price" style="font-weight: bold; color: green; font-size: 20px;">' . $games[$i]['new_price'] . '</p>';
                                    } else {
                                    ?>
                                        <p class="price"><?= $games[$i]['new_price'] ?></p>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                </div>
                <!-- Carousel navigation buttons -->
                <div class="btn-container-carousel">
                    <div class="slide-toggle-container">
                        <button class="slider-prev">
                            <!-- SVG for previous button -->
                            <svg class="slide-toggle" direction="prev" height="50" width="50">
                                <polyline class="chevron" points="0,50 25,38 50,50" />
                                Sorry, your browser does not support inline SVG.
                            </svg>
                        </button>
                        <button class="slider-next">
                            <!-- SVG for next button -->
                            <svg class="slide-toggle" direction="next" height="50" width="50">
                                <polyline class="chevron" points="0,0 25,12 50,0" />
                                Sorry, your browser does not support inline SVG.
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <div class="genre-container">
                <h2>Special offers</h2>
            </div>

            <!-- Slider Section -->
            <div class="slider">
                <?php
                $counter = 0;
                for ($i = 0; $i < count($games) && $counter < 7; $i++) {
                    // Display slider cards for special offers
                    if ($games[$i]['new_price'] != $games[$i]['old_price'] && $games[$i]['new_price'] != 'Free') {
                        if ($counter == 0) {
                ?>
                            <!-- Active slider card -->
                            <div class="slider-card active">
                                <img src="<?= $games[$i]['photo'] ?>" alt="">
                                <div class="title">
                                    <a href="fullGame.php?id=<?= $games[$i]['game_id'] ?>">
                                        <h2><?= $games[$i]['game_name'] ?></h2>
                                    </a>
                                    <p><?= $games[$i]['genre'] ?></p>
                                    <p class="price" style="text-decoration: line-through; color: gray;">
                                        <?= $games[$i]['old_price'] ?>
                                    </p>
                                    <p class="price" style="font-weight: bold; color: green;">
                                        <?= $games[$i]['new_price'] ?>
                                    </p>
                                </div>
                            </div>
                        <?php
                            $counter += 1;
                        } else {
                        ?>
                            <!-- Inactive slider card -->
                            <div class="slider-card">
                                <img src="<?= $games[$i]['photo'] ?>" alt="">
                                <div class="title">
                                    <a href="fullGame.php?id=<?= $games[$i]['game_id'] ?>">
                                        <h2><?= $games[$i]['game_name'] ?></h2>
                                    </a>
                                    <p><?= $games[$i]['genre'] ?></p>
                                    <p class="price" style="text-decoration: line-through; color: gray;">
                                        <?= $games[$i]['old_price'] ?>
                                    </p>
                                    <p class="price" style="font-weight: bold; color: green;">
                                        <?= $games[$i]['new_price'] ?>
                                    </p>
                                </div>
                            </div>
                <?php
                            $counter++;
                        }
                    }
                }
                ?>
            </div>
        </main>
    </div>
    <?php include 'footer.php';?>
    <!-- JavaScript for card selection and carousel movement -->
    <script>
        const cards = document.querySelectorAll('.slider-card');

        // Add click event listeners to slider cards for selection
        cards.forEach(card => {
            card.addEventListener('click', () => {
                cards.forEach(c => {
                    if (c !== card) {
                        c.classList.remove('active');
                    }
                });

                card.classList.add('active');
            });
        });

        // Carousel-moving script
        let offset = 0;
        const sliderLine = document.querySelector('.carousel-line');
        const width = 500;
        let isUserInteracted = false; // Flag to track user interaction

        // Set the initial position of the carousel line
        sliderLine.style.top = offset + 'px';

        function moveSliderNext() {
            offset = offset - width;
            if (offset < -width * (document.querySelectorAll('.poster').length - 1)) {
                offset = 0;
            }
            sliderLine.style.top = offset + 'px';
            isUserInteracted = true; // Set the flag to true
        }

        function moveSliderPrev() {
            offset = offset + width;
            if (offset > 0) {
                offset = -width * (document.querySelectorAll('.poster').length - 1);
            }
            sliderLine.style.top = offset + 'px';
            isUserInteracted = true; // Set the flag to true
        }

        // Add click event listeners to carousel navigation buttons
        document.querySelector('.slider-next').addEventListener('click', function () {
            moveSliderNext();
        });

        document.querySelector('.slider-prev').addEventListener('click', function () {
            moveSliderPrev();
        });

        // Automatically move the slider every 7 seconds, but only if the user has not interacted
        setInterval(function () {
            if (!isUserInteracted) {
                moveSliderNext();
            }
            isUserInteracted = false; // Reset the flag after the automatic movement
        }, 7000);
    </script>
</body>

</html>
