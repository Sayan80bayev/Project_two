<div class="slider">
                <?php
                $counter = 0;
                for ($i = 0; $i < count($game) && $counter < 7; $i++) {
                    // Display slider cards for special offers
                    if ($game[$i]['new_price'] != $game[$i]['old_price'] && $game[$i]['new_price'] != 'Free') {
                        if ($counter == 0) {
                ?>
                            <!-- Active slider card -->
                            <div class="slider-card active">
                                <img src="<?= $game[$i]['photo'] ?>" alt="">
                                <div class="title">
                                    <a href="fullGame.php?id=<?= $game[$i]['game_id'] ?>">
                                        <h2><?= $game[$i]['game_name'] ?></h2>
                                    </a>
                                    <p><?= $game[$i]['genre'] ?></p>
                                    <p class="price" style="text-decoration: line-through; color: gray;">
                                        <?= $game[$i]['old_price'] ?>
                                    </p>
                                    <p class="price" style="font-weight: bold; color: green;">
                                        <?= $game[$i]['new_price'] ?>
                                    </p>
                                </div>
                            </div>
                        <?php
                            $counter += 1;
                        } else {
                        ?>
                            <!-- Inactive slider card -->
                            <div class="slider-card">
                                <img src="<?= $game[$i]['photo'] ?>" alt="">
                                <div class="title">
                                    <a href="fullGame.php?id=<?= $game[$i]['game_id'] ?>">
                                        <h2><?= $game[$i]['game_name'] ?></h2>
                                    </a>
                                    <p><?= $game[$i]['genre'] ?></p>
                                    <p class="price" style="text-decoration: line-through; color: gray;">
                                        <?= $game[$i]['old_price'] ?>
                                    </p>
                                    <p class="price" style="font-weight: bold; color: green;">
                                        <?= $game[$i]['new_price'] ?>
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