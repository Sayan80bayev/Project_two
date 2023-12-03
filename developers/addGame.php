<?php
// Start the session
session_start();
require_once('../db/checkDev.php');
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

    $errors = [];
    if (empty($old_price)) {
        $errors['old_price'] = ' Price cannot be empty';
    }
    if (empty($game_name)) {
        $errors['Name'] = ' Name cannot be empty';
    }
    if (empty($release_date)) {
        $errors['Date'] = ' Date cannot be empty';
    }
    if (empty($description)) {
        $errors['Description'] = ' Description cannot be empty';
    }
    if (empty($genre)) {
        $errors['Genre'] = ' Genre cannot be empty';
    }
    // Assigning from FILES
    $filesArray = array(
        'photo' => $_FILES['photo'],
        'screenshot_1' => $_FILES['screenshot_1'],
        'screenshot_2' => $_FILES['screenshot_2'],
        'screenshot_3' => $_FILES['screenshot_3'],
        'posters' => $_FILES['poster']
    );    
    
    //Checking images
    function processImage($file, $destination){
            $time = time();
            $maxSize = 20 * 1024 * 1024; // 20MB in bytes
            $allowed_format = ['image/png', 'image/jpg', 'image/jpeg'];
            $file_name = $time . $file['name'];
            $file_tmp_name = $file['tmp_name'];
            $file_destination = '../images/'.$destination.'/' . $file_name;
            $file_destination_base = 'images/'.$destination.'/' . $file_name;
            // Check if the file size is within the allowed limit
            if(in_array($file['type'], $allowed_format)){
                if ($file['size'] > $maxSize) {
                    return 'Max size is 20mb';
                }else{
                    move_uploaded_file($file_tmp_name, $file_destination);
                }
            }
            else{
                return "Incorrect file ext, only png, jpeg, jpg";
            }
            return [true, $file_destination_base];
    }
    $photo = '';
    $screenshot_1 = '';
    $screenshot_2 = '';
    $screenshot_3 = '';
    $posters = '';
    foreach ($filesArray as $key => $file) {
        if (!empty($file['name'])) {
            // Include the file type in the destination path
            $destination = '';
            
            if ($key == 'photo' || $key == 'posters') {
                $destination = $key;
            } elseif (strpos($key, 'screenshot_') === 0) {
                $destination = 'screenshots';
            }

            $result = processImage($file, $destination);

            if ($result[0] !== true) {
                $errors[$key] = $result;
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
                        $posters = $result[1];
                        break;
                    default:
                        // Handle any other cases if needed
                        break;
                }
            }
        }
    }

//update
    $result = '';
    if(empty($errors)){
        // Try to register the game
        $result = registerGame(
            htmlspecialchars($game_name),
            htmlspecialchars($developers),
            htmlspecialchars($old_price),
            htmlspecialchars($new_price),
            htmlspecialchars($release_date),
            $photo,
            $screenshot_1,
            $screenshot_2,
            $screenshot_3,
            htmlspecialchars($description),
            $posters,
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
        $_SESSION['errors']['result'] = $result ?? '';
        header('Location: addgameform.php');
        exit();
    }
}
?>
