<!DOCTYPE html>
<html lang="en">
<head>
  <style>
    html, body {
    height: 100%;
    margin: 0;
    padding: 0;
}

    body {
      font-family: Arial, sans-serif;
      background-color: #282c35;
      /* background-image: url('../images/user/landscape-illustration-digital-art-sunset-minimalism-sky-118015-wallhere.com.png'); */
      background-repeat: no-repeat;
      background-size: cover;
      color: #fff;
      margin: 0;
    }
    main{
      /* background: linear-gradient(to bottom, rgba(0, 0, 0, 0.2), rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 1 ) ); */
      width: 100%;
      height: 100%;
      margin: 0;
      padding: 0;
    }
    .profile {
      max-width: 600px;
      margin: 50px auto; 
      background-color: #2c2f3e;
      border: 2px solid #FBBB43;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
    }

    .avatar {
      max-width: 100px;
      border-radius: 50%;
    }

    .info {
      margin-top: 20px;
    }

    .info h1, .info h2 {
      margin-bottom: 5px;
    }

    .info p {
      margin: 5px 0;
    }
    .mini-profile{
      width: 40%;
      display: flex;
      justify-content: space-between;
    }
    .mini-profile > h1{
      margin: auto;
      padding: 0;
    }
  </style>
</head>
<body>
  <main>
  <?php
      session_start();
      if(isset($_SESSION["status"]) && $_SESSION['status'] == 'success'){

  echo '<div> 
          <div class="profile">
            <div class="mini-profile">
              <img src="../images/user/no_avatar.jpg" alt="Avatar" class="avatar">
              <h1>'.$_SESSION["name"].'</h1>
            </div>
              <div class="info">
              <h2>Steam ID: 123456789</h2>
              <p>Games Played: 100</p>
              <p>Achievements Unlocked: 50</p>
              <!-- Add more information as needed -->
              </div>
          </div>
        </div>';
      }else{
          header("Location: ../login/LoginForm.php");
      }
  ?>
  </main>
</body>
</html>
