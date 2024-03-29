<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="http://localhost/project_two/css/style.css">
    <title>Admin panel</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        .tabs {
            display: flex;
            margin-top: 20px;
        }

        .tab {
            padding: 10px;
            margin-right: 10px;
            cursor: pointer;
        }

        .tab:hover {
            color: #ED500A;
            transition: .6s;
        }

        .content {
            width: max-content;
            margin-top: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            overflow: auto; 
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        table {
            overflow: auto;
            border-collapse: collapse;
        }

        th, td {
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #B87333   ;
        }
        .content {
            background-color: #1D2128;
            color: #f8e6de;
            border-radius: 20px;
            padding: 5px;
        }
        .add_game_form{
            width: 30%;
            margin: auto;
            padding: 20px;
        }
    </style>
</head>
<body>
    <?php
    session_start();
    require_once '../db/checkAdmin.php';
    require_once 'adminconnection.php';
    require_once '../components/header.php';
    ?>
    <h2 style="margin-top:70px;">Admin-panel</h2>

    <div class="tabs">
        <div class="tab" onclick="openTab('users')">Users</div>
        <div class="tab" onclick="openTab('reviews')">Reviews</div>
        <div class="tab" onclick="openTab('games')">Games</div>
        <div class="tab" onclick="openTab('add_category')">Add category</div>
    </div>

    <?php
    if (isset($_SESSION['message']) && $_SESSION['status'] == 'error') {
        echo '<h1 style="margin:auto 20px; color:red;">' . $_SESSION['message'] . '</h1>';
    } elseif (isset($_SESSION['message']) && $_SESSION['status'] == 'success') {
        echo '<h1 style="margin:auto 20px; color:green;">' . $_SESSION['message'] . '</h1>';
    }
    ?>

    <div id="users" class="content">
        <h3>Users list</h3>
        <table>
            <thead>
                <tr>
                    <th>User ID</th>
                    <th>User Name</th>
                    <th>User Email</th>
                    <th>Registration Date</th>
                    <th>Avatar URL</th>
                    <th></th>
                    <th>Password</th>
                    <th>Role</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $users = getUsers();
                $_SESSION['users'] = getUsersForCheck();
                $counter = 0;
                foreach ($users as $user) {
                    ?>
                    <tr>
                        <form method="post" action="update/updateUser.php" enctype="multipart/form-data">
                            <?php $_SESSION['users'][$counter]['password_check'] = $user['password']; $counter++; ?>
                            <td><?= $user['user_id'] ?></td>
                            <input type="hidden" name="user_id" value="<?= $user['user_id'] ?>">
                            <td><input type="text" name="user_name" value="<?= $user['user_name'] ?>"></td>
                            <td><input type="email" name="user_email" value="<?= $user['user_email'] ?>"></td>
                            <td><?= $user['registration_date'] ?></td>
                            <input type="hidden" name = 'registration_date'  value = "<?= $user['registration_date'] ?>">
                            <td><?= $user['avatar_url'] ?></td><td><input type="file" name="avatar_url"></td>
                            <td><input type="text" name="password" value="<?= $user['password'] ?>"></td>
                            <td>
                                <select name="role">
                                    <?php
                                    $roles = getRoles();
                                    foreach ($roles as $role) {
                                        if($user['role'] == $role['role_name']){
                                            echo '<option value="' . $role['role_id'] . '" selected >' . $role['role_name'] . '</option>';
                                            continue;
                                        }
                                        echo '<option value="' . $role['role_id'] . '">' . $role['role_name'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </td>
                            <td><?=$user['status']?></td>
                            <td><input type="submit" value="Update"></td>
                        </form>
                        <td>
                            <form action="delete/deleteUser.php" method="post">
                                <input type="hidden" name="user_id" value="<?= $user['user_id'] ?>">
                                <input type="submit" value="Delete">
                            </form>
                        </td>
                        <td>
                            <?php if($user['status']){?>
                            <form action="banUser.php" method="post">
                                <input type="hidden" name="user_id" value="<?= $user['user_id'] ?>">
                                <input type="hidden" name="status" value="<?= $user['status'] ?>">
                                <input type="submit" value="Ban">
                            </form>
                            <?php }else{ ?>
                                <form action="unBan.php" method="post">
                                <input type="hidden" name="user_id" value="<?= $user['user_id'] ?>">
                                <input type="hidden" name="status" value="<?= $user['status'] ?>">
                                <input type="submit" value="Unban">
                            </form>
                            <?php } ?>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>

    <div id="reviews" class="content" style="display:none;">
        <h3>Reviews list</h3>
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
                $_SESSION['reviews'] = $reviews;
                foreach ($reviews as $review) {
                ?>
                    <tr>
                        <form method="post" action="update/updateReview.php">
                            <td><?= $review['review_id'] ?></td>
                            <input type="hidden" name="review_id" value="<?= $review['review_id'] ?>">
                            <td><?= $review['game_id'] ?><input type="hidden" name="game_id" value="<?= $review['game_id'] ?>"></td>
                            <td><?= $review['user_id'] ?><input type="hidden" name="user_id" value="<?= $review['user_id'] ?>"></td>
                            <td>
                                <select name="rating" >
                                <?php
                                for ($i = 10; $i >= 1; $i--) {
                                    echo '<option value="' . $i . '">' . $i . '</option>';
                                    if($i == $review['rating']){
                                        echo '<option value="' . $i . '" selected>' . $i . '</option>';
                                        continue;
                                    }
                                }
                                ?>
                                </select>
                            </td>
                            <td><input type="text" name="comment" value="<?= $review['comment'] ?>"></td>
                            <td><?= $review['review_date'] ?><input type="hidden" name="review_date" value="<?= $review['review_date'] ?>"></td>
                            <td>
                                <input type="submit" value="Update">
                            </td>
                        </form>
                        <td>
                            <form action="delete/deleteReview.php" method="post">
                                <input type="hidden" name="review_id" value="<?= $review['review_id'] ?>">
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
        <h3>Games list</h3>
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
                    <th></th>
                    <th>Screenshot 1</th>
                    <th></th>
                    <th>Screenshot 2</th>
                    <th></th>
                    <th>Screenshot 3</th>
                    <th></th>
                    <th>Description</th>
                    <th>Poster</th>
                    <th></th>
                    <th>Genre</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $games = getGames();
                $_SESSION['games'] = getGamesForCheck();
                foreach ($games as $games) {
                ?>
                    <tr>
                        <form method="post" action="update/updateGame.php" enctype="multipart/form-data">
                            <td><?= $games['game_id'] ?></td>
                            <td><input type="text" name="game_name" value="<?= $games['game_name'] ?>"></td>
                            <td><input type="text" name="developers" value="<?= $games['developers'] ?>"></td>
                            <td><input type="text" name="old_price" value="<?= $games['old_price'] ?>"></td>
                            <td><input type="text" name="new_price" value="<?= $games['new_price'] ?>"></td>
                            <td><input type="date" name="release_date" value="<?= $games['release_date'] ?>"></td>
                            <td><?= $games['photo'] ?></td>
                            <td><input type="file" name="photo"></td>
                            <td><?= $games['screenshot_1'] ?></td>
                            <td><input type="file" name="screenshot_1"></td>
                            <td><?= $games['screenshot_2'] ?></td>
                            <td><input type="file" name="screenshot_2"></td>
                            <td><?= $games['screenshot_3']?></td>
                            <td><input type="file" name="screenshot_3"></td>
                            <td><input type="text" name="description" value="<?= $games['description'] ?>"></td>
                            <td><?= $games['poster']?></td>
                            <td><input type="file" name="poster"></td>
                            <td>
                                <select name="genre">
                                    <?php
                                    $genres = getGenres();
                                    foreach ($genres as $genre) {
                                        echo '<option value="' . $genre['genre_id'] . '">' . $genre['genre_name'] . '</option>';
                                        if ($genre['genre_name'] == $games['genre']) {
                                            echo '<option value="' . $genre['genre_id'] . '" selected >' . $genre['genre_name'] . ' </option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </td>
                            <input type="hidden" name="game_id" value="<?= $games['game_id'] ?>">
                            <td>
                                <input type="submit" value="Update">
                            </td>
                        </form>
                        <td>
                            <form action="delete/deleteGame.php" method="post">
                                <input type="hidden" name="game_id" value="<?= $games['game_id'] ?>">
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
    <div id="add_category"  class="content add_game_form" style="display:none;">
        <h2>Add Category</h2>
        <form  method="post" action="addCat.php">
            <label for="category_name">Category Name:</label>
            <br>
            <br>
            <input type="text" name="category_name" >
            <br>
            <br>
            <input type="submit" value="Add Category">
        </form>
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
