<?php
// Start the session
session_start();
require_once('../db/connection.php');

// Check if the form is submitted using POST method
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $game_name = $_POST['game_name'] ?? '';
    $developers = $_POST['developers'] ?? '';
    $old_price = $_POST['old_price'] ?? '';
    $new_price = $_POST['new_price'] ?? $_POST['old_price'];
    $release_date = $_POST['release_date'] ?? '';
    $description = $_POST['description'] ?? '';
    $genre = $_POST['genre'] ?? '';

    // Assigning from FILES
    $filesArray = array(
        'photo' => $_FILES['photo'],
        'screenshot_1' => $_FILES['screenshot_1'],
        'screenshot_2' => $_FILES['screenshot_2'],
        'screenshot_3' => $_FILES['screenshot_3'],
        'poster' => $_FILES['poster']
    );    
    $errors = [];
    
    //Checking images
    function processImage($file, $destination){
            $time = time();
            $maxSize = 5 * 1024 * 1024; // 5MB in bytes
            $allowed_format = ['image/png', 'image/jpg', 'image/jpeg'];
            $file_name = $time . $file['name'];
            $file_tmp_name = $file['tmp_name'];
            $file_destination = '../images/'.$destination.'/' . $file_name;
            // Check if the file size is within the allowed limit
            if(in_array($file['type'], $allowed_format)){
                if ($file['size'] > $maxSize) {
                    return 'Max size is 5mb';
                }else{
                    move_uploaded_file($file_tmp_name, $file_destination);
                }
            }
            else{
                return "Incorrect file ext, only png, jpeg, jpg";
            }
            return [true, $file_destination];
        }
    foreach ($filesArray as $key => $file) {
        if(!empty($file['name'])){

            $destination = ($key == 'photo' || $key == 'poster') ? 'images' : 'screenshots';
            $result = processImage($file, $destination);
            if ($result[0] !== true) {
                $errors[$key] = $result;
            }else{
                $file = $result[1];
            }
        }
    }
    $result = '';
    if(empty($errors)){
        // Try to register the game
        $result = registerGame(
            htmlspecialchars($game_name),
            htmlspecialchars($developers),
            htmlspecialchars($old_price),
            htmlspecialchars($new_price),
            htmlspecialchars($release_date),
            $filesArray['photo'],
            $filesArray['screenshot_1'],
            $filesArray['screenshot_2'],
            $filesArray['screenshot_3'],
            htmlspecialchars($description),
            $filesArray['poster'],
            htmlspecialchars($genre)
        );
    }
    if ($result == true && empty($errors)) {
        $_SESSION['message'] = 'Game successfully registered!';
        $_SESSION['status'] = 'success';
        header('Location: addgameform.php');
        exit();
    } else {
        $_SESSION['status'] = 'error';
        $_SESSION['errors'] = $errors;
        $_SESSION['errors']['result'] = $result['errors'];
        header('Location: addgameform.php');
        exit();
    }
}
?>
