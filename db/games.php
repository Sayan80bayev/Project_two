<?php
        $host = 'localhost';
        $dbname = 'DB_test';
        $port = 3306;
        $user = 'root';
        $passwordSQL = '';
    
        try {
                    $pdo = new PDO("mysql:host=$host;dbname=$dbname;port=$port;", $user, $passwordSQL);
            } catch(PDOException $exception){
                    echo $exception->getMessage();
            }
        $query = "SELECT * FROM games";
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        $games = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // echo '<pre>';
        // print_r($games);
        // echo '</pre>';
?>