<?php
// Database connection parameters
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

// Function to register a new user
function registerUser($username, $email, $password, $avatar_name)
{
    global $pdo;
    $password = md5($password); // Using MD5 for password hashing
    $errors = []; // Define $errors
    $query = "INSERT INTO user (user_name, password, user_email, registration_date, avatar_url)
            VALUES(:name, :password, :email , :registration_date, :avatar)";
    $stmt = $pdo->prepare($query);
    date_default_timezone_set('Asia/Almaty');
    try {
        // Execute the prepared statement with parameters
        $stmt->execute([
            'email' => $email,
            'name' => $username,
            'password' => $password,
            'registration_date' => date("Y-m-d H:i:s", time()),
            'avatar' => $avatar_name
        ]);
    } catch (PDOException $e) {
        // Handle any exception during user registration
        $errors['login'] = "{$e->getMessage()}";
        return ['result' => false, 'errors' => $errors['login']];
    }

    return true;
}

// Function to log in a user
function loginUser($email, $password)
{
    global $pdo;
    $query = "SELECT * FROM user WHERE user_email = '$email'";
    $stmt = $pdo->query($query);
    $user = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $user;
}

// Function to change user password
function changePassword($email, $password)
{
    global $pdo;
    $query = "UPDATE user SET password = :password WHERE user_email = :email";
    $stmt = $pdo->prepare($query);

    try {
        // Execute the prepared statement with parameters
        $stmt->execute([
            'password' => $password,
            'email' => $email
        ]);

        return true;
    } catch (PDOException $e) {
        // Handle any exception during password change
        echo "Error: " . $e->getMessage();
        return false;
    }
}

// Function to get reviews for a specific game
function getReviews($game_id)
{
    global $pdo;
    $query = "SELECT u.user_name, u.avatar_url, u.user_id, rev.review_date, rev.rating, rev.comment , rev.review_id
            FROM review as rev JOIN user as u on rev.user_id = u.user_id 
            WHERE rev.game_id = $game_id";
    $stmt = $pdo->query($query);
    $reviews = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $reviews;
}

// Function to add a new review
function addReview($game_id, $user_id, $rating, $review)
{
    global $pdo;
    $query = "INSERT INTO `review` (`game_id`, `user_id`, `rating`, `comment`, `review_date`) 
            VALUES (:game_id, :user_id, :rating, :comment, :review_date)";
    $stmt = $pdo->prepare($query);

    date_default_timezone_set('Asia/Almaty');

    try {
        // Execute the prepared statement with parameters
        $stmt->execute([
            "game_id" => $game_id,
            "user_id" => $user_id,
            "rating" => $rating,
            "comment" => $review,
            "review_date" => date("Y-m-d H:i:s", time()),
        ]);
    } catch (PDOException $e) {
        // Handle any exception during review addition
        return false;
    }

    return true;
}

// Function to get a user's review for a specific game
function getUsersReview($user_id, $game_id)
{
    global $pdo;
    $query = "SELECT u.user_name, u.avatar_url, u.user_id, rev.review_date, rev.rating, rev.comment, rev.review_id
            FROM review as rev JOIN user as u on rev.user_id = u.user_id 
            WHERE rev.game_id = $game_id AND u.user_id = $user_id";
    try{
    $stmt = $pdo->query($query);
    }catch(PDOException $e){
        return [];
    }
    $review = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $review;
}

// Function to change a review
function changeReview($game_id, $user_id, $review_id, $rating, $comment)
{
    global $pdo;
    $query = "UPDATE review SET comment = :comment , rating= :rating
            WHERE game_id = :game_id AND user_id = :user_id
            AND  review_id = :review_id";
    $stmt = $pdo->prepare($query);

    try {
        // Execute the prepared statement with parameters
        $stmt->execute([
            "game_id" => $game_id,
            "user_id" => $user_id,
            "review_id" => $review_id,
            "comment" => $comment,
            "rating" => $rating
        ]);
    } catch (PDOException $e) {
        // Handle any exception during review change
        return false;
    }

    return true;
}

// Function to get game categories
function getCategory()
{
    global $pdo;
    $query = "SELECT genre FROM game group by genre";
    $stmt = $pdo->query($query);
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}

function updateUser($user_id, $user_name, $avatar ){
    global $pdo;
    $query = "UPDATE user SET avatar_url = :avatar, user_name = :user_name WHERE user_id = $user_id";
    $stmt = $pdo->prepare($query);
    try{
    $stmt->execute([
        "avatar" => $avatar,
        "user_name" => $user_name
    ]);
    } catch(PDOException $e){
        return $e->getMessage();
    }
    return true;
}
function deleteReview($review_id){   
    global $pdo;
    $query = "DELETE FROM review WHERE review_id = :review_id";
    $stmt = $pdo->prepare($query);
    try{
        $stmt->execute([
            "review_id" => $review_id
        ]);
    }catch(PDOException $e){
        return $e->getMessage();
    }
    return true;
}
function searchGame($search){
    global $pdo;
    $query = "SELECT*FROM game WHERE game_name like :search or genre like :search";
    $stmt = $pdo->prepare($query);
    $stmt->execute([
        "search" => '%'.$search.'%'
    ]);
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}