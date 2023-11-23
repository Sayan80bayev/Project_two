<!DOCTYPE html>
<html lang="en">
<head>
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel='stylesheet' href="http://localhost/project_two/css/styleOfLogin.css">
</head>
<body>
    <?php
        session_start();
        if($_SESSION['role']=='developer'):
    ?>

    <form action="process_add_game.php" method="post">
        <h2>Add a New Game</h2>
        <div class="form-group">
            <label for="game_name">Game Name:</label>
            <input type="text" name="game_name" class="form-control"  required>
        </div>
        <input type="hidden" name="developers" value=<?=$_SESSION['user_name'] ?? '' ;?> >
        <div class="form-group">
            <label for="old_price">Old Price:</label>
            <input type="number" name="old_price" class="form-control"  step="0.01" required>
        </div>
        <div class="form-group">
            <label for="new_price">Sale Price:</label>
            <input type="number" name="new_price" class="form-control"  step="0.01">
        </div>
        <div class="form-group">
            <label for="genre">Genre:</label>
            <input type="text" name="genre" class="form-control"  required>
        </div>
        <input type="submit" value="Add Game" class='btn btn-primary'>
    </form>
    <?php
        endif;
    ?>
</body>
</html>