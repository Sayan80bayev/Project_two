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
?>