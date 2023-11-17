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
              
?>