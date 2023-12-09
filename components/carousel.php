
            <div class="carousel">
                <div class="carousel-line">
                    <?php
                    // Display posters in the carousel
                    for ($i = 11; $i > 5; $i--) {
                    ?>
                        <!-- Poster Card -->
                        <div class="poster">
                            <img src="<?= $game[$i]['poster'] ?>" alt="">
                            <div class="title">
                                <div class="content">
                                    <!-- Link to full game details -->
                                    <a href="fullGame.php?id=<?= $game[$i]['game_id'] ?>">
                                        <?= $game[$i]['game_name'] ?>
                                    </a>
                                    <p><?= $game[$i]['genre'] ?></p>
                                    <?php
                                    // Display prices with appropriate styles
                                    if ($game[$i]['new_price'] != $game[$i]['old_price']) {
                                    ?>
                                        <p class="price" style="text-decoration: line-through; color: gray;">
                                            <?= $game[$i]['old_price'] ?>
                                        </p>
                                        <p class="price" style="font-weight: bold; color: green;">
                                            <?= $game[$i]['new_price'] ?>
                                        </p>
                                    <?php
                                    } elseif ($game[$i]['new_price'] == 0.00) {
                                        $game[$i]['new_price'] = 'Free';
                                        echo '<p class="price" style="font-weight: bold; color: green; font-size: 20px;">' . $game[$i]['new_price'] . '</p>';
                                    } else {
                                    ?>
                                        <p class="price"><?= $game[$i]['new_price'] ?></p>
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