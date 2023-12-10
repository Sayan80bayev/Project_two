<!DOCTYPE html>
<html lang="en">
<head>
    <title>Library</title>
    <link rel="icon" type="image/svg+xml" href="http://localhost/project_two/images/gamepad-solid.svg">
    <link rel="stylesheet" href="http://localhost/project_two/css/style.css">
    <style>
        .library-game{
            flex-direction: row;
            height: max-content;
            width: 100%;
            text-align: start;
        }
        .library-game img{
            width: 180px;
            object-fit: cover;
        }
        .min-info{
            margin: 20px 0 0 20px;
        }
        .library-game h2{
            font-size: 30px;
        }
        .library-game p{
            font-size: 25px;
        }
        .font-15 p{
            min-width: 50%;
            max-width: 60%;
            font-size: 15px;
        }
        .button{
            background-color: #B87333;
            padding: 5px;
            border-radius: 5px;
            transition: .5s;
        }
        .button:hover{
            transition: .5s;
            background-color: #ED500A ;
        }
    </style>
</head>
<body>
    <?php
    session_start();
    include '../components/header.php';
    require_once '../db/checkAuth.php';
    ?>
    <main style = "margin-top:70px" >
    <h1>Library</h1>
        <?php 
            require_once '../db/connection.php'; 
            $user_id = $_SESSION['user_id'] ?? '';
            $games = getLibraryGames($user_id);
            foreach($games as $game):
        ?>
        <div class="game-card library-game">
            <img src="<?= $game['photo'] ?>" alt="">
                <div class="min-info">
                    <h2><?= $game['game_name'] ?></h2>
                    <br>
                    <p><?= $game['genre'] ?></p>
                    <div class="font-15">
                        <p><?= $game['release_date'] ?></p>
                        <p><?= $game['description'] ?></p>
                        <br>
                        <a class = "button" href="http://localhost/project_two/fullgame.php?id=<?=$game['game_id']?>">See in market page</a>
                    </div>
                </div>
        </div>
        <?php endforeach;?>
    </main>
    <?php require_once '../components/footer.php';?>
</body>
</html>