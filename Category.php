
            <?php
                $result = getCategory();
                echo '<h1>Categories</h1>';
                echo '<a href="CategoryGames.php?cat="><h2>All games</h2></a>';
                for( $i = 0; $i < count($result); $i++ ) {
                    echo '<a href="CategoryGames.php?cat='.$result[$i]['genre'].'"><h2>'.$result[$i]['genre'].'</h2></a>';
                }
            ?>