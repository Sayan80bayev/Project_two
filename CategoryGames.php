<!DOCTYPE html>
<html lang="en">

<head>
    <title>Category</title>
    <!-- Include CSS files -->
    <link rel="icon" type="image/svg+xml" href="http://localhost/project_two/images/gamepad-solid.svg">

    <link rel="stylesheet" href="http://localhost/project_two/css/style.css">
</head>
<style>
    .big-container {
        margin-right: 100px;
    }

    main {
        width: 1200px;
        margin-left: 50px ;
    }
</style>

<body>
    <?php
    // Include header and games data
    session_start();
    require_once 'db/connection.php';
    $game = getGames();
    include 'components/header.php';
    ?>
    <div class="big-container">
        <div class="category">
            <?php include 'components/category.php'; 
                if($_SERVER['REQUEST_METHOD']=='POST'){
                    $game = searchGame($_POST['search']);
                }
            ?>
            <a href="http://localhost/project_two/index.php"><h2>Home</h2></a>
        </div>
        <main>
            <?php   if(!empty($game)){ ?>
            <!-- Display category -->
            <div class="genre-container">
                <h1>
                    <?php
                    if (!empty($_GET['cat'])) {
                        $cat = htmlspecialchars($_GET['cat']);
                        $_SESSION['lastPage'] = 'http://localhost/project_two/CategoryGames.php?cat='.$cat;
                        echo "$cat";
                    } else {
                        echo 'All';
                        $_SESSION['lastPage'] = 'http://localhost/project_two/CategoryGames.php?cat=';
                    }
                    ?> games
                </h1>
            </div>
            <!-- Display games based on the selected category -->
            <div class="game-container">
                <?php
                for ($i = 0; $i < count($game); $i++) {
                    if (isset($_GET['cat']) && !empty($_GET['cat'])) {
                        if ($_GET['cat'] == $game[$i]['genre']) {
                            ?>
                            <div class="game-card">
                                <img src="<?= $game[$i]['photo'] ?>" alt="">
                                <div class="min-info">
                                    <a href="fullGame.php?id=<?= $game[$i]['game_id'] ?>">
                                        <h2><?= $game[$i]['game_name'] ?></h2>
                                    </a>
                                    <p><?= $game[$i]['genre'] ?></p>
                                    <?php
                                    // Display prices with formatting
                                    if ($game[$i]['new_price'] != $game[$i]['old_price']) {
                                    ?>
                                        <p class="price" style="text-decoration: line-through; color: gray;"><?= $game[$i]['old_price'] ?></p>
                                        <p  class="price" style="font-weight: bold; color: green; font-size: 20px;"><?= $game[$i]['new_price'] ?></p>
                                    <?php
                                    } elseif ($game[$i]['new_price'] == 0.00) {
                                        $game[$i]['new_price'] = 'Free';
                                        echo '<p  style="font-weight: bold; color: green; font-size: 20px;">' . $game[$i]['new_price'] . '</p>';
                                    } else {
                                    ?>
                                        <p class="price"><?= $game[$i]['new_price'] ?></p>
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
                            <img src="<?= $game[$i]['photo'] ?>" alt="">
                            <div class="min-info">
                                <a href="fullGame.php?id=<?= $game[$i]['game_id'] ?>">
                                    <h2><?= $game[$i]['game_name'] ?></h2>
                                </a>
                                <p><?= $game[$i]['genre'] ?></p>
                                <?php
                                // Display prices with formatting
                                if ($game[$i]['new_price'] != $game[$i]['old_price']) {
                                ?>
                                    <p class="price" style="text-decoration: line-through; color: gray;"><?= $game[$i]['old_price'] ?></p>
                                    <p class="price" style="font-weight: bold; color: green; font-size: 20px;"><?= $game[$i]['new_price'] ?></p>
                                <?php
                                } elseif ($game[$i]['new_price'] == 0.00) {
                                    $game[$i]['new_price'] = 'Free';
                                    echo '<p style="font-weight: bold; color: green; font-size: 20px;">' . $game[$i]['new_price'] . '</p>';
                                } else {
                                ?>
                                    <p class="price"><?= $game[$i]['new_price'] ?></p>
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
        <?php
            }else{
        ?>
        <!-- <div class="container" style="align-items: center; gap: 15px"> -->
            <h1 style="margin-left: 37.5%">Haven't found</h1>
                <?php }?>
        <!-- </div> -->
        </main>
    </div>
</body>
<?php include 'components/footer.php';?>
</html>
