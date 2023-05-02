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
        background-color: rgba(0, 0, 0, 0.8);
      }
      button{

          transition: 0.5s;
          font-weight: bold;
          font-size: 30px;
          border: 4px solid #FBBB43;
          background-color: transparent;
          color: white;
          border-radius: 30px;
          width: 60px;
          height: 60px;
          padding: 0;

      }
      button:hover{
        transition: 0.5s;
        background-color: #FBBB43;
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
          width: 35%;
          display: flex;
          flex-direction: column;
      }
      .game-card{
          height: 700px;
          width: 400px;
      }
      .game-card img{
          height: 500px;
      }
      .little-container{
        display: flex;
        justify-content: space-between;
        width: 500px;
      }

</style>
      <main>
      <script>
      function goBack() {
        window.history.back();
      }
      </script>
        <div class="container">
          <div class="little-container">
            <button onclick="goBack()"><</button>
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