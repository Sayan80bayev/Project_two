<?php
    session_start();
    require_once '../adminConnection.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $game_id = $_POST['game_id'];
        $game_name = $_POST['game_name'];
        $developers = $_POST['developers'];
        $old_price = $_POST['old_price'];
        $new_price = $_POST['new_price'];
        $release_date = $_POST['release_date'];
        $photo = $_POST['photo'];
        $screenshot_1 = $_POST['screenshot_1'];
        $screenshot_2 = $_POST['screenshot_2'];
        $screenshot_3 = $_POST['screenshot_3'];
        $description = $_POST['description'];
        $poster = $_POST['poster'];
        $genre = $_POST['genre'];

        $result = updateGame($game_id, $game_name, $developers, $old_price, $new_price, $release_date, $photo, $screenshot_1, $screenshot_2, $screenshot_3, $description, $poster, $genre);

        if ($result) {
            $_SESSION['status'] = "success";
            $_SESSION['message'] = 'Successfully updated!';
            header("Location: http://localhost/project_two/admin/admin.php");
            exit;
        } else {
            $_SESSION['status'] = "error";
            $_SESSION['message'] = 'Not updated!';
            header("Location: http://localhost/project_two/admin/admin.php");
            exit;
        }
    }
?>
