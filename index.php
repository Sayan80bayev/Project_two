<!DOCTYPE html>
<html lang="en">
<head>
    <title>Game Store</title>
    <link rel="stylesheet" href="style.css">
    <script src="script.js" defer></script>
</head>
<body>

    <!-- header -->
    <div class="header" id="header">
        <img src="images/logo.png" alt="PC Games Store">
            <!-- <ul>
                <li><a href="login/login.php">Logout</a></li>
                <li><a href="#">Cart</a></li>
            </ul> -->
            <div class="left-side" id="left-side">
                <div class="searchBar">
                    <input id="search" type="search" placeholder="Search..." />
                    <button>Go</button>
                </div>    
                <input type="button" value="" id="openButton">
            </div>
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
                <div class="genre-container">
                    <h2>Special offers</h2>
                </div>


                <!-- SLIDER -->
                    <div class="slider">

                            <?php 
                            $counter = 0;
                            $flag = 0;
                            for($i = 0; $i < count($games); $i++) { 
                                if($games[$i]['New-price'] != $games[$i]['Old-price']){
                                    if($counter==0){
                            ?>
                                        <div class="card active">
                                            <img src="<?=$games[$i]['Photo']?>" alt="">
                                            <div class="title">
                                                <a href="fullGame.php?id=<?=$games[$i]['id'] ?>">
                                                    <h2><?= $games[$i]['Name']?></h2>
                                                </a>
                                                <p><?= $games[$i]['Genre']?></p>
                                                    <p style = 
                                                        "text-decoration: line-through;
                                                        color: gray;">
                                                        <?= $games[$i]['Old-price']?>
                                                    </p>
                                                    <p style = "
                                                        font-weight: bold;
                                                        color: green;">
                                                        <?= $games[$i]['New-price']?>
                                                    </p>
                                            </div>
                                        </div>
                            <?php 
                                        $counter=1;
                                    }
                                    else{
                            ?>
                                        <div class="card">
                                            <img src="<?=$games[$i]['Photo']?>" alt="">
                                            <div class="title">
                                                <a href="fullGame.php?id=<?=$games[$i]['id'] ?>">
                                                    <h2><?= $games[$i]['Name']?></h2>
                                                </a>
                                                <p><?= $games[$i]['Genre']?></p>
                                                    <p style = 
                                                        "text-decoration: line-through;
                                                        color: gray;">
                                                        <?= $games[$i]['Old-price']?>
                                                    </p>
                                                    <p style = "
                                                        font-weight: bold;
                                                        color: green;">
                                                        <?= $games[$i]['New-price']?>
                                                    </p>
                                            </div>
                                        </div>
                            <?php
                                } 
                            }
                        }
                            ?>
                <?php
                ?>
                </div>
    </main>
    <script>
        const parentElement = document.getElementById('left-side');
        const oldElemnet = document.getElementById('openButton');

        oldElemnet.addEventListener('click' , menuButton);

        
        // const newElement = document.createElement('div');
        // newElement.innerHTML = `
        //     <div class='wrapper'>
        //     <input type="button" onclick="closeButton()" id='closeButton'>
        //     <ul>
        //         <li><a href="#">Home</a></li>
        //         <li><a href="#">About</a></li>
        //         <li><a href="#">Support</a></li>
        //         <li><a href="login/login.php">Logout</a></li>
        //         <li><a href="#">Feedback</a></li>
        //     </ul>
        //     </div>
        // `;
        // newElement.addEventListener('click', closeButton)

        function menuButton(){
            parentElement.className = 'height left-side';
            parentElement.removeChild(oldElemnet);
            parentElement.appendChild(newElement);
        }
        function closeButton(){
            parentElement.className = 'left-side';
            parentElement.removeChild(newElement);
            parentElement.appendChild(oldElemnet);
        }

        const cards = document.querySelectorAll('.card');

        cards.forEach(card => {
            card.addEventListener('click', () => {
                cards.forEach(c => {
                    if(c !== card){
                        c.classList.remove('active');
                    }
                });

                card.classList.add('active');
            });
        });
    </script>
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