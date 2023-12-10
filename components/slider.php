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