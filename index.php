<!DOCTYPE html>
<html lang="en">
<head>
    <title>Game Store</title>
    <link rel="stylesheet" href="style.css">
    <script src="script.js" defer></script>
</head>
<body>

    <!-- header -->
    <div class="header">
        <img src="images/logo.png" alt="PC Games Store">
            <ul>
                <li><a href="login/login.php">Logout</a></li>
                <li><a href="#">Cart</a></li>
            </ul>
    </div>
    <!-- main -->
    <main>
            <div class="genre-container">      
                <h2>All games</h2>
                <ul>
                    <li <?php if (!isset($_GET['cat']) || empty($_GET['cat'])) { echo 'class="genre-active"'; } ?> ><a href="index.php?cat=">All</a></li>
                    <li <?php if (isset($_GET['cat']) && $_GET['cat'] === 'Action') { echo 'class="genre-active"'; } ?> ><a href="index.php?cat=Action">Action</a></li>
                    <li <?php if (isset($_GET['cat']) && $_GET['cat'] === 'Survival horror') { echo 'class="genre-active"'; } ?> ><a href="index.php?cat=Survival horror">Survival horror</a></li>
                    <li <?php if (isset($_GET['cat']) && $_GET['cat'] === 'RPG') { echo 'class="genre-active"'; } ?> ><a href="index.php?cat=RPG">RPG</a></li>
                    <li <?php if (isset($_GET['cat']) && $_GET['cat'] === 'Sandbox') { echo 'class="genre-active"'; } ?> ><a href="index.php?cat=Sandbox">Sandbox</a></li>
                </ul>

            </div>
            <div class="game-container">
                
            <?php
                include 'db/games.php';

                for($i = 0 ; $i < count($games) ; $i++){
                    if( isset($_GET['cat']) && !empty($_GET['cat'])){
                        if($_GET['cat'] == $games[$i]['Genre']) {
            ?>  
                            <div class="game-card">
                                <img src="<?=$games[$i]['Photo']?>" alt="">
                                <div class="min-info">
                                    <a href="fullGame.php?id=<?=$games[$i]['id'] ?>">
                                        <h2> <?= $games[$i]['Name']?></h2>
                                    </a>    
                                    <p><?= $games[$i]['Genre']?></p>
                        <?php
                            if($games[$i]['New-price']!=$games[$i]['Old-price']){
                        ?>
                                <p style = "text-decoration: line-through; color: gray;"> <?= $games[$i]['Old-price']?></p>
                                <p style="font-weight: bold; color: green; font-size: 20px;"> <?= $games[$i]['New-price']?></p>
                        <?php
                            }
                            else{
                        ?>
                                <p><?= $games[$i]['New-price']?></p>
                        <?php
                                }
                                
                        ?>
                                </div>
                            </div>

                    <?php
                        }
                    }
                    else{
                    ?>

                            <div class="game-card">
                                <img src="<?=$games[$i]['Photo']?>" alt="">
                                <div class="min-info">
                                    <a href="fullGame.php?id=<?=$games[$i]['id'] ?>">
                                        <h2> <?= $games[$i]['Name']?></h2>
                                    </a>    
                                    <p><?= $games[$i]['Genre']?></p>
                        <?php
                            if($games[$i]['New-price']!=$games[$i]['Old-price']){
                        ?>
                                <p style = "text-decoration: line-through; color: gray;"> <?= $games[$i]['Old-price']?></p>
                                <p style="font-weight: bold; color: green; font-size: 20px;"> <?= $games[$i]['New-price']?></p>
                
                            <?php
                            }
                            else{
                            ?>

                                <p><?= $games[$i]['New-price']?></p>

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
        <!-- </div> -->
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
</body>
</html>