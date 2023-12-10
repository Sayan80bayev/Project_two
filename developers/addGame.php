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
    $new_price = ($_POST['new_price'] == '0.00') ? $new_price : $old_price;
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
    $photo = '';
    $screenshot_1 = '';
    $screenshot_2 = '';
    $screenshot_3 = '';
    $poster = '';
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
                        $poster = $result[1];
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
            $poster,
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
