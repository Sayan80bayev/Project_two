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
        margin-left: 50px ;
    }
</style>

<body>
    <?php
    // Include header and games data
    session_start();
    include 'header.php';
    require_once 'db/connection.php';
    $games = getGames();
    ?>
    <div class="big-container">
        <div class="category">
            <?php include 'category.php'; 
                if($_SERVER['REQUEST_METHOD']=='POST'){
                    $games = searchGame($_POST['search']);
                }
            ?>
            <a href="http://localhost/project_two/index.php"><h2>Home</h2></a>
        </div>
        <main>
            <?php   if(!empty($games)){ ?>
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
        <?php
            }else{
        ?>
        <h1 style="margin-left: 37.5%">Haven't found</h1>
        <?php }?>
        </main>
    </div>
    <?php include 'footer.php';?>
</body>

</html>
