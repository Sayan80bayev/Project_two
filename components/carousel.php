
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