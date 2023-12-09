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
    function searchUser($arr, $target) {
        $left = 0;
        $right = count($arr,  COUNT_NORMAL) - 1;
    
        while ($left <= $right) {
            $mid = floor(($left + $right) / 2);
            // Check if the target is present at the middle
            if ($arr[$mid]['user_id'] == $target) {
                return $mid;
            }
    
            // If the target is greater, ignore the left half
            if ($arr[$mid]['user_id']< $target) {
                $left = $mid + 1;
            }
            // If the target is smaller, ignore the right half
            else {
                $right = $mid - 1;
            }
        }
        // If we reach here, then the target is not present in the array
        return -1;
    }
    function getUsers(){
        global $pdo;
        $query = "SELECT u.user_id, u.user_name, u.password,u.registration_date, u.user_email, u.avatar_url, r.role_name as role, r.role_id FROM users as u JOIN roles as r on u.role = r.role_id";
        $stmt = $pdo->query($query);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    function getUsersForCheck(){
        global $pdo;
        $query = "SELECT * FROM users ";
        $stmt = $pdo->query($query);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    function getReviews(){
        global $pdo;
        $query = "SELECT*FROM reviews";
        $stmt = $pdo->query($query);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    function getGames(){
        global $pdo;
        $query = "SELECT g.`game_id`, g.`game_name`, g.`developers`, g.`old_price`, g.`new_price`, g.`release_date`, g.`photo`, g.`screenshot_1`, g.`screenshot_2`, g.`screenshot_3`, g.`description`, g.`poster`, gr.`genre_name` as genre
        FROM games AS g
        JOIN genres AS gr ON g.`genre` = gr.`genre_id`;" ;
        $stmt = $pdo->query($query);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    function deleteUser($user_id){
        global $pdo;
        $query = "
        DELETE FROM `reviews` WHERE `user_id` =:user_id;
        DELETE FROM `users` WHERE `user_id` =:user_id;";
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
        $query = "DELETE FROM `reviews` WHERE `review_id` =:review_id;";
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
        SET FOREIGN_KEY_CHECKS=0;
        DELETE FROM `reviews` WHERE `game_id` =:game_id;
        DELETE FROM `games` WHERE `game_id` =:game_id;
        SET FOREIGN_KEY_CHECKS=1;";
        $stmt = $pdo->prepare($query);
        try{
            $stmt->execute([
                "game_id" => $game_id
            ]);
        }catch(PDOException $e){
            return [false, $e];
        }
        return true;
    }
    function updateUser($user_id, $user_name, $user_email, $avatar_url, $password, $role) {
        global $pdo;
        $query = "
            UPDATE users
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
            UPDATE games
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
            UPDATE reviews
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
    function getRoles(){
        global $pdo;
        $query = "SELECT*FROM roles";
        $stmt =$pdo->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    function getGenres(){
        global $pdo;
        $query = "SELECT*FROM genres";
        $stmt =$pdo->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
?>