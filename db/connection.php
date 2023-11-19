<?php
    $host = 'localhost';
    $dbname = 'gameStore';
    $port = 3306;
    $user = 'root';
    $passwordSQL = '';

    try {
                $pdo = new PDO("mysql:host=$host;dbname=$dbname;port=$port;", $user, $passwordSQL);
        } catch(PDOException $exception){
                echo $exception->getMessage();
        } 
    function registerUser($username, $email, $password) {
        global $pdo;
                $password = md5($password);
                $errors = []; // Define $errors
                $query = "INSERT INTO user (user_name, password, user_email)
                        VALUES(:name, :password, :email)";
                $stmt = $pdo->prepare($query);
                try{
                        $stmt->execute([
                        'email' => $email,
                        'name'=> $username,
                        'password' => $password
                        ]);
                }catch(PDOException $e){
                        $errors['login'] = "{$e->getMessage()}";
                        return ['result' => false, 'errors' => $errors['login']];
                }
                return true;
        }
        function loginUser($email, $password) {
                global $pdo;
                $query = "SELECT * FROM user WHERE user_email = '$email'";
                $stmt = $pdo->query($query);
                $user = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $user;
        }
        function changePassword($email, $password) {
                global $pdo;
                $query = "UPDATE user SET password = :password WHERE user_email = :email";
                $stmt = $pdo->prepare($query);
                try {
                    $stmt->execute([
                        'password' => $password,
                        'email' => $email
                    ]);
                    return true;
                } catch (PDOException $e) {
                    echo "Error: " . $e->getMessage();
                    return false;
                }
        }
        function getReviews($game_id) {
                global $pdo;
                $query = "SELECT u.user_name, u.avatar_url, u.user_id, rev.review_date, rev.rating, rev.comment , rev.review_id
                        FROM review as rev JOIN user as u on rev.user_id = u.user_id 
                        WHERE rev.game_id = $game_id" ;
                $stmt = $pdo->query($query);
                $reviews = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $reviews;
        }
        function addReview($game_id, $user_id, $rating, $review){
                global $pdo;
                $query = "INSERT INTO `review` (`game_id`, `user_id`, `rating`, `comment`, `review_date`) 
                        VALUES (:game_id, :user_id, :rating, :comment, :review_date)";
                $stmt = $pdo->prepare($query);
                date_default_timezone_set('Asia/Almaty');
                try{
                        $stmt->execute([
                                "game_id" => $game_id,
                                "user_id" => $user_id,
                                "rating" => $rating,
                                "comment" => $review,
                                "review_date" => date("Y-m-d H:i:s", time()),
                            ]);
                            
                }
                catch (PDOException $e) {
                        return false;
                }
                return true;
        }
        function getUsersReview($user_id, $game_id){
                global $pdo;
                $query = "SELECT u.user_name, u.avatar_url, u.user_id, rev.review_date, rev.rating, rev.comment, rev.review_id
                        FROM review as rev JOIN user as u on rev.user_id = u.user_id 
                        WHERE rev.game_id = $game_id AND u.user_id = $user_id";
                $stmt = $pdo->query($query);
                $review = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $review;
        }
        function changeReview($game_id, $user_id, $review_id, $rating, $comment){
                global $pdo;
                $query = "UPDATE review SET comment = :comment , rating= :rating
                        WHERE game_id = :game_id AND user_id = :user_id
                        AND  review_id = :review_id";
                $stmt = $pdo->prepare($query);
                try{
                        $stmt->execute([
                                "game_id"=> $game_id,
                                "user_id"=> $user_id,
                                "review_id"=> $review_id,
                                "comment"=> $comment,
                                "rating" => $rating
                        ]);
                }
                catch (PDOException $e) {
                        return false;
                }
                return true;
        };
        function getCategory(){
                global $pdo;
                $query = "SELECT genre FROM game group by genre";
                $stmt = $pdo->query($query);
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $result;
        }
              
?>