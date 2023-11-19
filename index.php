<!DOCTYPE html>
<html lang="en">

<head>
    <title>Game Store</title>
    <link rel="stylesheet" href="http://localhost/project_two/css/style.css">
    <link rel="stylesheet" href="http://localhost/project_two/css/carousel.css">
    <script src="script.js" defer></script>
</head>
<body>

    <!-- header -->
    <?php include 'header.php';
        include 'db/games.php';
    ?>

    <!-- main -->
    <main>

        <!-- carousel -->
<div class="carousel">
    <div class="carousel-line">
        <?php
        for ($i = 11; $i > 5; $i--) {
        ?>
            <div class="poster">
                <img src="<?= $games[$i]['poster'] ?>" alt="">
                <div class="title">
                    <div class="content">
                        <a href="fullGame.php?id=<?= $games[$i]['game_id'] ?>">
                            <?= $games[$i]['game_name'] ?>
                        </a>
                        <p><?= $games[$i]['genre'] ?></p>
                        <?php
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
    <!-- ... -->
    <div class="btn-container-carousel">
        <div class="slide-toggle-container">
            <button class="slider-prev">
                <svg class="slide-toggle" direction="prev" height="50" width="50">
                    <polyline class="chevron" points="0,50 25,38 50,50" />
                    Sorry, your browser does not support inline SVG.
                </svg>
            </button>
            <button class="slider-next">
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
<!-- SLIDER -->
<div class="slider">
    <?php
    $counter = 0;
    for ($i = 0; $i < count($games) && $counter < 7; $i++) {
        if ($games[$i]['new_price'] != $games[$i]['old_price'] && $games[$i]['new_price'] != 'Free') {
            if ($counter == 0) {
    ?>
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
    <footer>
        <ul>
            <li><a href="">About us</a></li>
            <li><a href="">Contact</a></li>
            <li><a href="">Privacy policy</a></li>
            <li><a href="">Terms and conditions</a></li>
            <li><a href="">FAQ</a></li>
        </ul>
    </footer>
    <script>
        const cards = document.querySelectorAll('.slider-card');

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
        //carousel-moving
        let offset = 0;
        const sliderLine = document.querySelector('.carousel-line');
        const width = 525;
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

        document.querySelector('.slider-next').addEventListener('click', function () {
            moveSliderNext();
        });

        document.querySelector('.slider-prev').addEventListener('click', function () {
            moveSliderPrev();
        });

        // Automatically move the slider every 2-3 seconds, but only if the user has not interacted
        setInterval(function () {
            if (!isUserInteracted) {
                moveSliderNext();
            }
            isUserInteracted = false; // Reset the flag after the automatic movement
        }, 7000);
    </script>

</body>

</html>
