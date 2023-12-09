<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Game Form</title>
  <link rel="stylesheet" href="http://localhost/project_two/css/style.css">
  <style>
    body {
      background-color: #0b0e14;
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100vh;
      color: #f8e6de;

    }

    .game_add {
      background-color: #1D2128;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      width: 80%;
      max-width: 800px;
      display: grid;
      grid-template-columns: repeat(2, 1fr);
      grid-gap: 20px;
      margin: auto;
      margin-top: 70px;
      height: 100%;
    }

    label {
      display: block;
      margin-bottom: 8px;
    }

    input, select, textarea {
      width: 100%;
      padding: 8px;
      box-sizing: border-box;
    }

    .game_add button {
      grid-column: span 2; /* Make the button span both columns */
      background-color: #B87333;
      color: #fff;
      padding: 10px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }

    .game_add button:hover {
      background-color: #ED500A;
    }
  </style>
</head>
<body>
  <?php 
    session_start();
    require_once('../db/checkDev.php');
    require_once('../db/connection.php');
    include '../components/header.php';
  ?>
  <form action="addGame.php" method="post" enctype="multipart/form-data" class ="game_add">
    
    <label for="game_name">Game Name:</label>
    <input type="text" id="game_name" name="game_name" >

    <input type="hidden" id="developers" name="developers" value = "<?=$_SESSION['user_name'] ?? '' ?>">

    <label for="old_price">Price:</label>
    <input type="text" id="old_price" name="old_price" >

    <label for="new_price">Sale Price:</label>
    <input type="text" id="new_price" name="new_price" value="">

    <label for="release_date">Release Date:</label>
    <input type="date" id="release_date" name="release_date" >

    <label for="photo">Photo:</label>
    <input type="file" id="photo" name="photo" >

    <label for="screenshot_1">Screenshot 1 URL:</label>
    <input type="file" id="screenshot_1" name="screenshot_1">

    <label for="screenshot_2">Screenshot 2 URL:</label>
    <input type="file" id="screenshot_2" name="screenshot_2">

    <label for="screenshot_3">Screenshot 3 URL:</label>
    <input type="file" id="screenshot_3" name="screenshot_3">
    
    <label for="poster">Poster URL:</label>
    <input type="file" id="poster" name="poster">
    <label for="description">Description:</label>
    <textarea id="description" name="description" rows="4" ></textarea>


    <label for="genre">Genre:</label>
    <select name="genre">
                    <?php
                    $genres = getGernres();
                    foreach($genres as $genre )  {
                        echo '<option value="' . $genre['genre_id'] . '">' . $genre['genre_name'] . '</option>';
                    }
                    ?>
    </select>
    <button type="submit">Add Game</button>
    <?php
  $status = $_SESSION['status']?? '';
  $errors = $_SESSION['errors'] ?? '';
  if ( $status === 'error' && isset($errors) && !empty($errors) ){
      foreach ($errors as $error) {
          echo '<p style="color:red; margin: auto">' . $error . '</p>';
      }
  }elseif($status=== 'success' && isset($_SESSION['message'])){
      echo '<p style="color:green; margin: auto">'.$_SESSION['message'].'</p>';
  }
  unset($_SESSION['status']);
  unset($_SESSION['errors']);
  unset($_SESSION['message']);
  ?>
  </form>

</body>
</html>
