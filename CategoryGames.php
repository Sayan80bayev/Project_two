<!DOCTYPE html>
<html lang="en">

<head>
    <title>Category</title>
    <!-- Include CSS files -->
    <link rel="stylesheet" href="http://localhost/project_two/css/style.css">
</head>
<style>
    .big-container {
        margin-right: 100px;
    }

    main {
        width: 1200px;
        margin: auto;
    }
</style>

<body>
    <?php
    // Include header and games data
    include 'header.php';
    require 'db/games.php';
    ?>
    <div class="big-container">
        <div class="category">
            <?php include 'category.php'; ?>
            <a href="http://localhost/project_two/index.php"><h2>Home</h2></a>
        </div>
        <main>
            <!-- Display category -->
            <div class="genre-container">
                <h1>
                    <?php
                    if (!empty($_GET['cat'])) {
                        $cat = $_GET['cat'];
                        echo "$cat";
                    } else echo 'All';
                    ?> games
                </h1>
            </div>

            <!-- Display games based on the selected category -->
            <div class="game-container">
                <?php
                for ($i = 0; $i < count($games); $i++) {
                    if (isset($_GET['cat']) && !empty($_GET['cat'])) {
                        if ($_GET['cat'] == $games[$i]['genre']) {
                            ?>
                            <div class="game-card">
                                <img src="<?= $games[$i]['photo'] ?>" alt="">
                                <div class="min-info">
                                    <a href="fullGame.php?id=<?= $games[$i]['game_id'] ?>">
                                        <h2><?= $games[$i]['game_name'] ?></h2>
                                    </a>
                                    <p><?= $games[$i]['genre'] ?></p>
                                    <?php
                                    // Display prices with formatting
                                    if ($games[$i]['new_price'] != $games[$i]['old_price']) {
                                    ?>
                                        <p style="text-decoration: line-through; color: gray;"><?= $games[$i]['old_price'] ?></p>
                                        <p style="font-weight: bold; color: green; font-size: 20px;"><?= $games[$i]['new_price'] ?></p>
                                    <?php
                                    } elseif ($games[$i]['new_price'] == 0.00) {
                                        $games[$i]['new_price'] = 'Free';
                                        echo '<p style="font-weight: bold; color: green; font-size: 20px;">' . $games[$i]['new_price'] . '</p>';
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
                    } else {
                        // Display games for 'All' category
                        ?>
                        <div class="game-card">
                            <img src="<?= $games[$i]['photo'] ?>" alt="">
                            <div class="min-info">
                                <a href="fullGame.php?id=<?= $games[$i]['game_id'] ?>">
                                    <h2><?= $games[$i]['game_name'] ?></h2>
                                </a>
                                <p><?= $games[$i]['genre'] ?></p>
                                <?php
                                // Display prices with formatting
                                if ($games[$i]['new_price'] != $games[$i]['old_price']) {
                                ?>
                                    <p style="text-decoration: line-through; color: gray;"><?= $games[$i]['old_price'] ?></p>
                                    <p style="font-weight: bold; color: green; font-size: 20px;"><?= $games[$i]['new_price'] ?></p>
                                <?php
                                } elseif ($games[$i]['new_price'] == 0.00) {
                                    $games[$i]['new_price'] = 'Free';
                                    echo '<p style="font-weight: bold; color: green; font-size: 20px;">' . $games[$i]['new_price'] . '</p>';
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
    </div>
</body>

</html>
