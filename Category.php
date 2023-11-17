<!DOCTYPE html>
<html lang="en">
<head>
    <title>Category</title>
</head>
<link rel="stylesheet" href="http://localhost/project_two/css/style.css">

<body>
    <?php include 'header.php';?>
    <main>
        <div class="genre-container">
            <h2><?php 
                require 'db/games.php';
                if (!empty($_GET['cat'])) {
                    $cat = $_GET['cat'];
                    echo "$cat";
                } else echo 'All'; ?> games</h2>
            <ul>
                <li <?php if (!isset($_GET['cat']) || empty($_GET['cat'])) {
                        echo 'class="genre-active"';
                    } ?>><a href="Category.php?cat=">All</a></li>
                <li <?php if (isset($_GET['cat']) && $_GET['cat'] === 'Action') {
                        echo 'class="genre-active"';
                    } ?>><a href="Category.php?cat=Action">Action</a></li>
                <li <?php if (isset($_GET['cat']) && $_GET['cat'] === 'Survival horror') {
                        echo 'class="genre-active"';
                    } ?>><a href="Category.php?cat=Survival horror">Survival horror</a></li>
                <li <?php if (isset($_GET['cat']) && $_GET['cat'] === 'RPG') {
                        echo 'class="genre-active"';
                    } ?>><a href="Category.php?cat=RPG">RPG</a></li>
                <li <?php if (isset($_GET['cat']) && $_GET['cat'] === 'Sandbox') {
                        echo 'class="genre-active"';
                    } ?>><a href="Category.php?cat=Sandbox">Sandbox</a></li>
            </ul>
        </div>
<div class="game-container">
            <?php
            require 'db/games.php';
            for ($i = 0; $i < count($games); $i++) {
                if (isset($_GET['cat']) && !empty($_GET['cat'])) {
                    if ($_GET['cat'] == $games[$i]['genre']) {
            ?>
                        <div class="game-card">
                            <img src="<?= $games[$i]['photo'] ?>" alt="">
                            <div class="min-info">
                                <a href="fullGame.php?id=<?= $games[$i]['game_id'] ?>">
                                    <h2> <?= $games[$i]['game_name'] ?></h2>
                                </a>
                                <p><?= $games[$i]['genre'] ?></p>
                                <?php
                                if ($games[$i]['new_price'] != $games[$i]['old_price']) {
                                ?>
                                    <p style="text-decoration: line-through; color: gray;"> <?= $games[$i]['old_price'] ?></p>
                                    <p style="font-weight: bold; color: green; font-size: 20px;"> <?= $games[$i]['new_price'] ?></p>
                                <?php
                                }elseif($games[$i]['new_price']==0.00){
                                    $games[$i]['new_price']='Free';
                                    echo'<p style="font-weight: bold; color: green; font-size: 20px;">'. $games[$i]['new_price'] .'</p>';
                                } else {
                                ?>
                                    <p><?= $games[$i]['new_price'] ?></p>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    <?php
                    }
                }else {
                    ?>
                    <div class="game-card">
                        <img src="<?= $games[$i]['photo'] ?>" alt="">
                        <div class="min-info">
                            <a href="fullGame.php?id=<?= $games[$i]['game_id'] ?>">
                                <h2> <?= $games[$i]['game_name'] ?></h2>
                            </a>
                            <p><?= $games[$i]['genre'] ?></p>
                            <?php
                            if ($games[$i]['new_price'] != $games[$i]['old_price']) {
                            ?>
                                <p style="text-decoration: line-through; color: gray;"> <?= $games[$i]['old_price'] ?></p>
                                <p style="font-weight: bold; color: green; font-size: 20px;"> <?= $games[$i]['new_price'] ?></p>
                            <?php
                            }elseif($games[$i]['new_price']==0.00){
                                $games[$i]['new_price']='Free';
                                echo'<p style="font-weight: bold; color: green; font-size: 20px;">'. $games[$i]['new_price'] .'</p>';
                            } else {
                            ?>
                                <p><?= $games[$i]['new_price'] ?></p>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
            <?php
                }
            }
            ?>
        </div>
        </main>
</body>
</html>