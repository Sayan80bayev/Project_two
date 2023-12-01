<?php
    $host = 'localhost';
    $dbname = 'gameStore';
    $port = 3306;
    $user = 'root';
    $passwordSQL = '';
    
    try {
        // Create a new PDO 
        $pdo = new PDO("mysql:host=$host;dbname=$dbname;port=$port;", $user, $passwordSQL);
    } catch (PDOException $exception) {
        // Handle database connection exception
        echo $exception->getMessage();
    }

    function getUsers(){
        global $pdo;
        $query = "SELECT*FROM user";
        $stmt = $pdo->query($query);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    function getReviews(){
        global $pdo;
        $query = "SELECT*FROM review";
        $stmt = $pdo->query($query);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    function getGames(){
        global $pdo;
        $query = "SELECT*FROM game";
        $stmt = $pdo->query($query);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    function deleteUser($user_id){
        global $pdo;
        $query = "
        DELETE FROM `review` WHERE `user_id` =:user_id;
        DELETE FROM `user` WHERE `user_id` =:user_id;";
        $stmt = $pdo->prepare($query);
        try{
            $stmt->execute([
                "user_id" => $user_id
            ]);
        }catch(PDOException $e){
            return false;
        }
        return true;
    }
    function deleteReview($review_id){
        global $pdo;
        $query = "DELETE FROM `review` WHERE `review_id` =:review_id;";
        $stmt = $pdo->prepare($query);
        try{
            $stmt->execute([
                "review_id" => $review_id
            ]);
        }catch(PDOException $e){
            return false;
        }
        return true;
    }
    function deleteGame($game_id){
        global $pdo;
        $query = "
        DELETE FROM `review` WHERE `game_id` =:game_id;
        DELETE FROM `game` WHERE `game_id` =:game_id;";
        $stmt = $pdo->prepare($query);
        try{
            $stmt->execute([
                "game_id" => $game_id
            ]);
        }catch(PDOException $e){
            return false;
        }
        return true;
    }
    function updateUser($user_id, $user_name, $user_email, $avatar_url, $password, $role) {
        global $pdo;
        $query = "
            UPDATE user 
            SET user_name = :user_name,
                user_email = :user_email,
                avatar_url = :avatar_url,
                password = :password,
                role = :role
            WHERE user_id = :user_id
        ";
        $stmt = $pdo->prepare($query);
        try {
            $stmt->execute([
                "user_id" => $user_id,
                "user_name" => $user_name,
                "user_email" => $user_email,
                "avatar_url" => $avatar_url,
                "password" => $password,
                "role" => $role
            ]);
        } catch (PDOException $e) {
            return false;
        }
        return true;
    }
    function updateGame($game_id, $game_name, $developers, $old_price, $new_price, $release_date, $photo, $screenshot_1, $screenshot_2, $screenshot_3, $description, $poster, $genre) {
        global $pdo;
        $query = "
            UPDATE game
            SET game_name = :game_name,
                developers = :developers,
                old_price = :old_price,
                new_price = :new_price,
                release_date = :release_date,
                photo = :photo,
                screenshot_1 = :screenshot_1,
                screenshot_2 = :screenshot_2,
                screenshot_3 = :screenshot_3,
                description = :description,
                poster = :poster,
                genre = :genre
            WHERE game_id = :game_id
        ";
        $stmt = $pdo->prepare($query);
        try {
            $stmt->execute([
                "game_id" => $game_id,
                "game_name" => $game_name,
                "developers" => $developers,
                "old_price" => $old_price,
                "new_price" => $new_price,
                "release_date" => $release_date,
                "photo" => $photo,
                "screenshot_1" => $screenshot_1,
                "screenshot_2" => $screenshot_2,
                "screenshot_3" => $screenshot_3,
                "description" => $description,
                "poster" => $poster,
                "genre" => $genre
            ]);
        } catch (PDOException $e) {
            return false;
        }
        return true;
    }
    function updateReview($review_id, $game_id, $user_id, $rating, $comment) {
        global $pdo;
        $query = "
            UPDATE review
            SET game_id = :game_id,
                user_id = :user_id,
                rating = :rating,
                comment = :comment
            WHERE review_id = :review_id
        ";
        $stmt = $pdo->prepare($query);
        try {
            $stmt->execute([
                "review_id" => $review_id,
                "game_id" => $game_id,
                "user_id" => $user_id,
                "rating" => $rating,
                "comment" => $comment
            ]);
        } catch (PDOException $e) {
            return false;
        }
        return true;
    }
    
    
?>