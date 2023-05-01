<!DOCTYPE html>
<html lang="en">
<head>
    <title>Document</title>
    <link href="style.css" rel="stylesheet">
</head>
<body>
<style>
    <?php
    include 'db/games.php';
      for($i =0 ; $i<count($games); $i++){
        if(isset($_GET['id']) && !empty($_GET['id'])){
          if($games[$i]['id']==$_GET['id']){
    ?>
      body {
          background-image: url('<?=$games[$i]['Poster']?>');
          background-repeat: no-repeat;
          background-size: cover;
          margin: 0;
          padding: 0;
      }
      main{
        background-color: rgba(0, 0, 0, 0.7);
      }
      .container {
          display: flex;
          width: 100%;
          height: 100vh;
          justify-content: space-evenly;
          align-items:center;
      }
      .info{
        display: flex;
        justify-content: space-between;
      }
      .about {
          width: 30%;
          display: flex;
          flex-direction: column;
      }
      .game-card{
          height: 700px;
      }
      .game-card img{
          height: 500px;
      }

</style>
      <main>
        <div class="container">

            <div class="game-card">
              <img src="<?=$games[$i]['Photo']?>" alt="">
              <div class="min-info">
                <h2><?= $games[$i]['Name']?></h2>
                <p><?= $games[$i]['Genre']?></p>

                <?php
                    if($games[$i]['New-price']!=$games[$i]['Old-price']){
                ?>
                      <p style = "text-decoration: line-through; color: gray;"><?= $games[$i]['Old-price']?></p>
                      <p style = " font-weight: bold; color: green; font-size: 30px"><?= $games[$i]['New-price']?></p>
                <?php
                      }
                      else{
                ?>
                      <p ><?= $games[$i]['New-price']?></p>
                <?php
                      }
                ?>
              </div>

            </div>

            <div class="about">
  
    <?php           echo "<h2>" . $games[$i]['Name'] . "</h2>";
                    echo "<div class ='info'><p> Date: </p> <p>" . $games[$i]['Date'] . "</p> </div>";
                    echo "<div class ='info'><p> Developers:</p> <p>" . $games[$i]['Developers'] . "</p></div>";
                    echo "<div class ='info'><p>Genre: </p> <p>"  . $games[$i]['Genre'] . "</p> </div>";
                    echo "<div class ='info'><p>Price: </p> <p>" . $games[$i]['New-price'] . "</p> </div>";
                    echo "<p>About game:<br>" . $games[$i]['Description'] . "</p>";

                }
            }
        }
    ?>    </div>

        </div>
      </main>
</body>
</html>