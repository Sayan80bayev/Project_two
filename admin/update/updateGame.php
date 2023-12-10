<?php
    session_start();
    require_once '../../db/checkAdmin.php';
    // require_once '../../db/connection.php';
    require_once '../adminConnection.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $filesArray = array(
            'photo' => $_FILES['photo'] ?? '',
            'screenshot_1' => $_FILES['screenshot_1'] ?? '',
            'screenshot_2' => $_FILES['screenshot_2'] ?? '',
            'screenshot_3' => $_FILES['screenshot_3'] ?? '',
            'posters' => $_FILES['poster'] ?? ''
        );
        $game_id = $_POST['game_id'];
        //finding the game in Session arr
        $game_id_inSES = searchGameById($_SESSION['games'], $game_id);
        $game_name = $_POST['game_name'];
        $developers = $_POST['developers'];
        $old_price = $_POST['old_price'];
        $new_price = $_POST['new_price'];
        $release_date = $_POST['release_date'];
        $description = $_POST['description'];
        $genre = $_POST['genre'];

        //alighning variables because in case they didn't upload
        $photo = $_SESSION['games'][$game_id_inSES]['photo'];
        $screenshot_1 = $_SESSION['games'][$game_id_inSES]['screenshot_1'];
        $screenshot_2 = $_SESSION['games'][$game_id_inSES]['screenshot_2'];
        $screenshot_3 = $_SESSION['games'][$game_id_inSES]['screenshot_3'];
        $poster = $_SESSION['games'][$game_id_inSES]['poster'];
        //checking for images
        foreach($filesArray as $key => $file){
            if(isset($file) && !empty($file) && $file['size']>0){
                $destination = '';
                if ($key == 'photo' || $key == 'posters') {
                    $destination = $key;
                } elseif (strpos($key, 'screenshot_') === 0) {
                    $destination = 'screenshots';
                }
                $result = processImage($file, $destination);
                if ($result[0] !== true) {
                    $_SESSION['status'] = 'error';
                    $_SESSION['message'] = $result;
                    header('Location: http://localhost/project_two/admin/admin.php');
                    exit;
                } else {
                    // Update variables based on file type
                    switch ($key) {
                        case 'photo':
                            $photo = $result[1]; // Assuming $result[1] contains the updated file path
                            break;
                        case 'screenshot_1':
                            $screenshot_1 = $result[1];
                            break;
                        case 'screenshot_2':
                            $screenshot_2 = $result[1];
                            break;
                        case 'screenshot_3':
                            $screenshot_3 = $result[1];
                            break;
                        case 'posters':
                            $poster = $result[1];
                            break;
                    }
                }
            }
        }
        //arr to compare are there updates or not 
        $arr_to_check = $_POST;
        $arr_to_check['screenshot_1'] = $screenshot_1;
        $arr_to_check['screenshot_2'] = $screenshot_2;
        $arr_to_check['screenshot_3'] = $screenshot_3;
        $arr_to_check['photo'] = $photo;
        $arr_to_check['poster'] = $poster;
        $updt = false;
        foreach ($arr_to_check as $key => $value) {
            if ($_SESSION['games'][$game_id_inSES][$key]!=$value) {
                $updt = true;
            }
        }
        if($updt){
            $result = updateGame($game_id, $game_name, $developers, $old_price, $new_price, $release_date, $photo, 
            $screenshot_1, $screenshot_2, $screenshot_3, $description, $poster, $genre);
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
        }else{
            $_SESSION['status'] = "error";
            $_SESSION['message'] = 'You have nothing updated!';
            header("Location: http://localhost/project_two/admin/admin.php");
            exit;
        }
    }
?>
