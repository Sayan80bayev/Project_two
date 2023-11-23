<!-- Selecting games from DB -->
<?php
        require_once 'connection.php';
        $query = "SELECT * FROM game";
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        $games = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>