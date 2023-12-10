<?php
    session_start();
    if( $_SERVER['REQUEST_METHOD']=='POST'){
        if($_POST['user_id']==$_SESSION['user_id'] ){
            require_once '../db/connection.php';
            $user_id = $_POST['user_id'];
            $game_id = $_POST['game_id'];
            $total = getTotal($user_id, $game_id);
            if($total > 0){
                $result = purchase($user_id, $game_id);
                if($result){
                    $_SESSION['message'] = 'Successfully bought!';
                    $_SESSION['status'] = 'success';
                    header('Location: http://localhost/project_two/fullGame.php?id='.$game_id);
                    exit;
                }else{
                    $_SESSION['message'] = 'Couldnt bought!';
                    $_SESSION['status'] = 'error';
                    header('Location: http://localhost/project_two/fullGame.php?id='.$game_id);
                    exit;
                }
            }else{
                $_SESSION['message'] = 'Couldnt bought, not enough summ!';
                $_SESSION['status'] = 'error';
                header('Location: http://localhost/project_two/fullGame.php?id='.$game_id);
                exit;
            }
        }
    }
?>