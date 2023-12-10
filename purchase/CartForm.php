<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Steam-like Shopping Cart</title>
    <link rel="stylesheet" href="http://localhost/project_two/css/style.css">
    <style>
        .library-game{
            flex-direction: row;
            height: max-content;
            width: 100%;
            text-align: start;
        }
        .library-game img{
            height: auto;
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
            color: #f8e6de;
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
    // require_once '../components/header.php';
    require_once '../db/checkAuth.php';
    // require_once '../db/connection.php';
    // $uptInfUsr = updateUserInfo($_SESSION['user_id']);
    // $_SESSION['wallet'] = $uptInfUsr['wallet']; 
    // $_SESSION['userStatus'] = $uptInfUsr['status']; 
    ?>
    <main style="margin-top:70px">
        <?php 
            if($_SERVER['REQUEST_METHOD']== 'POST'){ 
            $game_id = $_POST['game_id'] ?? '';
            require_once '../db/connection.php'; 
            $user_id = $_SESSION['user_id'] ?? '';
            $games = getGameById($game_id);
            $total = $_SESSION['wallet'] - $games['new_price'];
            if($total > 0){
        ?>
            <div class="game-card library-game">
                <img src="<?= $games['photo'] ?>" alt="">
                    <div class="min-info">
                        <h2><?= $games['game_name'] ?></h2>
                        <br>
                            <?php if($games['old_price'] == $games['new_price']) {?>
                            <p><?= $games['old_price'] ?></p>
                            <?php } else {?>
                                <p><?= $games['old_price'] ?></p>
                                <p><?= $games['new_price'] ?></p>
                                <?php }?>
                                <p>Total: <?=$total?></p>
                            <form action="purchaseHandler.php" method="POST">
                                <input type="hidden" value="<?=$game_id?>" name="game_id">
                                <input type="hidden" value="<?=$user_id?>" name ="user_id">
                                <button class="button" type="submit">Submit purchase</button>
                            </form>
                        </div>
                    </div>
                    </form>
        <?php 
            }else{
                $_SESSION['message'] = "Your balance isn't enough!";
                $_SESSION['status'] = "error";
                header('Location: http://localhost/project_two/fullGame.php?id='.$game_id);
                exit;
            }
        }
        ?>
    </main>
</body>
</html>
