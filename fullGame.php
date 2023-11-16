<!DOCTYPE html>
<html lang="en">
<head>
    <title>Document</title>
    <link href="http://localhost/project_two/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="http://localhost/project_two/css/fullPage.css">
</head>
<body>
<style>
  /* here is php code */
  <?php
        include 'db/games.php';
          for($i =0 ; $i<count($games); $i++){
            if(isset($_GET['id']) && !empty($_GET['id'])){
              if($games[$i]['game_id']==$_GET['id']){
        ?>
      body {
          height: 100vh;
          background-color: black;
          background-image: url('<?=$games[$i]['poster']?>');
          background-repeat: no-repeat;
          background-size: cover;
          margin: 0;
          padding: 0;
      }
</style>
      <main>
        <!-- container-start -->
        <div class="container">
          <!-- little-container start -->
          <div class="little-container">

            <button onclick="goBack()"><</button>

            <div class="game-card">
              <img src="<?=$games[$i]['photo']?>" alt="">

              <div class="min-info">
                <h2><?= $games[$i]['game_name']?></h2>
                <p><?= $games[$i]['genre']?></p>

                <?php if($games[$i]['new_price']!=$games[$i]['old_price']){ ?>
                      <p style = "text-decoration: line-through; color: gray;"><?= $games[$i]['old_price']?></p>
                      <p style = " font-weight: bold; color: green; font-size: 30px"><?= $games[$i]['new_price']?></p>
                <?php
                  }
                  else{
                ?>
                      <p ><?= $games[$i]['new_price']?></p>
                <?php } ?>
                
              </div>
            </div>

          </div>
          <!-- little-container end -->

            <div class="about">
  
    <?php           echo "<h2>" . $games[$i]['game_name'] . "</h2>";
                    echo "<div class ='info'><p> Date: </p> <p>" . $games[$i]['release_date'] . "</p> </div>";
                    echo "<div class ='info'><p> Developers:</p> <p>" . $games[$i]['developers'] . "</p></div>";
                    echo "<div class ='info'><p>Genre: </p> <p>"  . $games[$i]['genre'] . "</p> </div>";
                    echo "<div class ='info'><p>Price: </p> <p>" . $games[$i]['new_price'] . "</p> </div>";
                    echo "<p>About game:<br>" . $games[$i]['description'] . "</p>";
    ?>
            </div>
                <div class="genre-container">
                  <h2>Screenshots</h2>
                </div>
                <div class="carousel">
                    <div class="carousel-line">
                            <img src="<?=$games[$i]['screenshot_1']?>" alt="">
                            <img src="<?=$games[$i]['screenshot_2']?>" alt="">
                            <img src="<?=$games[$i]['screenshot_3']?>" alt="">
                    </div>
                    <div class="btn-container">
                        <button class="slider-prev"><</button>
                        <button class="slider-next">></button>
                    </div>
                </div>
    <?php
                }
            }
        }
    ?>    </div> 
          <!-- container end -->
      </main>

      <script>
      //button-back
        function goBack() {
          window.history.back();
        }

        //carousel-moving
          let offset = 0;
          const sliderLine = document.querySelector('.carousel-line');
          const width = 1003;
          console.log(width);

          document.querySelector('.slider-next').addEventListener('click', function(){
              offset = offset + width;
              if (offset > width*2) {
                  offset = 0;
              }
              sliderLine.style.left = -offset + 'px';
          });

          document.querySelector('.slider-prev').addEventListener('click', function () {
              offset = offset - width;
              if (offset < 0) {
                  offset = width*2;
              }
              sliderLine.style.left = -offset + 'px';
          });
      </script>
</body>
</html>