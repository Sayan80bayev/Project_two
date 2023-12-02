<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Админ-панель</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        h2 {
            color: #333;
        }

        .tabs {
            display: flex;
            margin-top: 20px;
        }

        .tab {
            padding: 10px;
            background-color: #f2f2f2;
            margin-right: 10px;
            cursor: pointer;
        }

        .tab:hover {
            background-color: #ddd;
        }

        .content {
            margin-top: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            overflow: auto; 
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }
        table {
            overflow: auto;
      border-collapse: collapse;
      width: 100%;
    }
    th, td {
      border: 1px solid #ddd;
      padding: 8px;
      text-align: left;
    }
    th {
      background-color: #f2f2f2;
    }
    </style>
    <?php include 'adminConnection.php';?>
</head>
<body>

<h2>Админ-панель</h2>

<div class="tabs">
    <div class="tab" onclick="openTab('users')">Пользователи</div>
    <div class="tab" onclick="openTab('reviews')">Отзывы</div>
    <div class="tab" onclick="openTab('games')">Игры</div>
</div>
<?php           session_start();
                if (isset($_SESSION['message']) && $_SESSION['status']=='error'){
                    echo '<h1 style="margin:auto 20px; color:red;">'. $_SESSION['message'] .'</h1>';
                }
                elseif(isset($_SESSION['message']) && $_SESSION['status']=='success'){
                    echo '<h1 style="margin:auto 20px; color:green;">'. $_SESSION['message'] .'</h1>';
                }
            ?>
<div id="users" class="content">
    <h3>Список пользователей</h3>
    <table>
        <thead>
            <tr>
                <th>User ID</th>
                <th>User Name</th>
                <th>User Email</th>
                <th>Registration Date</th>
                <th>Avatar URL</th>
                <th>Password</th>
                <th>Role</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $users = getUsers();
            foreach ($users as $user) {
                ?>
                <tr>
                    <form method="post" action="update/updateUser.php">
                        <td><?=$user['user_id']?></td>
                        <td><input type="text" name="user_name" value="<?=$user['user_name']?>"></td>
                        <td><input type="email" name="user_email" value="<?=$user['user_email']?>"></td>
                        <td><?=$user['registration_date']?></td>
                        <td><input type="text" name="avatar_url" value="<?=$user['avatar_url']?>"></td>
                        <td><input type="text" name="password" value="<?=$user['password']?>"></td>
                        <input type="hidden" name="passwordCheck" value="<?=$user['password']?>">
                        <td><input type="text" name="role" value="<?=$user['role']?>"></td>
                        <input type="hidden" name="user_id" value="<?=$user['user_id']?>">
                        <td><input type="submit" value="Update"></td>
                    </form>
                    <td>
                        <form action="delete/deleteUser.php" method ="post">
                            <input type="hidden" name="user_id" value="<?=$user['user_id']?>">
                            <input type="submit" value="Delete">
                        </form>
                    </td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
</div>

<div id="reviews" class="content" style="display:none;">
    <h3>Список отзывов</h3>
    <table>
        <thead>
            <tr>
                <th>Review ID</th>
                <th>Game ID</th>
                <th>User ID</th>
                <th>Rating</th>
                <th>Comment</th>
                <th>Review Date</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $reviews = getReviews();
            foreach ($reviews as $review) {
                ?>
                <tr>
                    <form method="post" action="update/updateReview.php">
                        <td><?=$review['review_id']?></td>
                        <td><input type="text" name="game_id" value="<?=$review['game_id']?>"></td>
                        <td><input type="text" name="user_id" value="<?=$review['user_id']?>"></td>
                        <td><input type="text" name="rating" value="<?=$review['rating']?>"></td>
                        <td><input type="text" name="comment" value="<?=$review['comment']?>"></td>
                        <td><?=$review['review_date']?></td>
                        <input type="hidden" name="review_id" value="<?=$review['review_id']?>">
                        <td>
                            <input type="submit" value="Update">
                        </td>
                    </form>
                    <td>
                        <form action="delete/deleteReview.php" method ="post">
                            <input type="hidden" name="review_id" value="<?=$review['review_id']?>">
                            <input type="submit" value="Delete">
                        </form>
                    </td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
</div>
<div id="games" class="content" style="display:none;">
    <h3>Список игр</h3>
    <table>
        <thead>
            <tr>
                <th>Game ID</th>
                <th>Game Name</th>
                <th>Developers</th>
                <th>Old Price</th>
                <th>New Price</th>
                <th>Release Date</th>
                <th>Photo</th>
                <th>Screenshot 1</th>
                <th>Screenshot 2</th>
                <th>Screenshot 3</th>
                <th>Description</th>
                <th>Poster</th>
                <th>Genre</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $games = getGames();
            foreach ($games as $game) {
                ?>
                <tr>
                    <form method="post" action="update/updateGame.php">
                        <td><?=$game['game_id']?></td>
                        <td><input type="text" name="game_name" value="<?=$game['game_name']?>"></td>
                        <td><input type="text" name="developers" value="<?=$game['developers']?>"></td>
                        <td><input type="text" name="old_price" value="<?=$game['old_price']?>"></td>
                        <td><input type="text" name="new_price" value="<?=$game['new_price']?>"></td>
                        <td><input type="date" name="release_date" value="<?=$game['release_date']?>"></td>
                        <td><input type="text" name="photo" value="<?=$game['photo']?>"></td>
                        <td><input type="text" name="screenshot_1" value="<?=$game['screenshot_1']?>"></td>
                        <td><input type="text" name="screenshot_2" value="<?=$game['screenshot_2']?>"></td>
                        <td><input type="text" name="screenshot_3" value="<?=$game['screenshot_3']?>"></td>
                        <td><input type="text" name="description" value="<?=$game['description']?>"></td>
                        <td><input type="text" name="poster" value="<?=$game['poster']?>"></td>
                        <td><input type="text" name="genre" value="<?=$game['genre']?>"></td>
                        <input type="hidden" name="game_id" value="<?=$game['game_id']?>">
                        <td>
                            <input type="submit" value="Update">
                        </td>
                    </form>
                    <td>
                        <form action="delete/deleteGame.php" method="post">
                            <input type="hidden" name="game_id" value="<?=$game['game_id']?>">
                            <input type="submit" value="Delete">
                        </form>
                    </td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
</div>
<div id="games" class="content" style="display:none;">
    <?php include 'delete_game.php'; ?>
</div>
<?php 
    unset($_SESSION['message']);
    unset($_SESSION['status']);
?>
<script>
    function openTab(tabName) {
        var i;
        var x = document.getElementsByClassName("content");
        for (i = 0; i < x.length; i++) {
            x[i].style.display = "none";
        }
        document.getElementById(tabName).style.display = "block";
    }
</script>

</body>
</html>
