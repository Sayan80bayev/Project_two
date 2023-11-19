<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link rel="stylesheet" href="http://localhost/project_two/css/profile.css">
</head>
<body>
  <main>
  <?php
      session_start();
      include '../db/checkAuth.php';
      $avatar = $_SESSION['avatar_url'] ?? 'no-avatar.jpg';
      ?>
      <div> 
          <div class="profile">
            <div class="mini-profile">
              <img src='../images/user/<?=$avatar?>' alt="Avatar" class="avatar">
              <h1><?=$name?></h1>
            </div>
              <div class="info">
                <a href="accounteditform.php" class = "btn btn-primary">Change Password</a>
                <a href="../logout.php" class = "btn btn-danger">Logout</a>
              </div>
          </div>
        </div>
  </main>
</body>
</html>
