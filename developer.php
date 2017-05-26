<?php
  session_start();
  if(!isset($_SESSION['email'])){
    header("Location: login.php");
    die;
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
  <title>Kuliahku - The Team</title>
  <!-- CSS  -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="css/style_index.css" type="text/css" rel="stylesheet" media="screen,projection"/>
</head>
<body>
 	<?php include 'nav.php'; ?>
  <div class="section no-pad-bot" id="index-banner">
    <div class="container">
      <br><br>
      <h1 class="header center orange-text">KULIAHKU THE TEAM</h1>
      <h5 class="center blue-text">Made real by</h5>
    </div>
  </div>

    <br>
    <div class="row">
      <div class="col s4">
        <div class="card medium">
          <div class="card-image">
            <img src="https://scontent-sin6-1.xx.fbcdn.net/v/t1.0-9/1010264_573277219362227_1037195923_n.jpg?oh=73bc88b01e55ed789c3bf55b6103b14f&oe=59BCD5B5">
            <span class="card-title" style="color: white;background-color: rgba(44, 62, 80,0.5);">Hendry Wiranto <small>- Database Developer</small></span>
          </div>
          <div class="card-content">
            <p>5115100102</p><br>
            <p>hendrywiranto24@gmail.com</p><br>
          </div>
          <div class="card-action">
            <a href="https://www.facebook.com/hendry.wiranto"  target="blank">Visit</a>
          </div>
        </div>
      </div>
        <div class="col s4">
          <div class="card medium">
            <div class="card-image" style=" position: relative;">
              <img src="https://scontent-sin6-1.xx.fbcdn.net/v/t1.0-9/14265089_1179936545362421_5780189738549283698_n.jpg?oh=164152ced7a98065dd4d8730143d0ba5&oe=59A1D21E" style="top: -160px; bottom: 145">
              <span class="card-title" style="color: white; background-color: rgba(44, 62, 80,0.5); width: 100%;">Arya Wiranata <small>- UI Designer</small></span>
            </div>
            <div class="card-content">
              <p>5115100163</p><br>
              <p>wiranata.arya.wiranata@gmail.com</p><br>
            </div>
            <div class="card-action">
              <a href="https://www.facebook.com/aryarinoo" target="blank">Visit</a>
            </div>
          </div>
        </div>
        <div class="col s4">
          <div class="card medium">
            <div class="card-image">
              <img src="https://image.ibb.co/jRrmXa/DSC_0125.jpg">
              <span class="card-title" style="color: white; background-color: rgba(44, 62, 80,0.5);">Rogo Jagad Alit <small>- Backend Developer</small></span>
            </div>
            <div class="card-content">
              <p>5115100168</p><br>
              <p>rogojagadalit@gmail.com</p><br>
            </div>
            <div class="card-action">
              <a href="https://www.facebook.com/rogo.alit" target="blank">Visit</a>
            </div>
          </div>
        </div>
      </div>

    <?php include 'footer.php'; ?>

  <!--  Scripts-->
  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="js/materialize.js"></script>
  <script src="js/init.js"></script>

  </body>
</html>
