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

    <?php include 'stats_nav.php' ?>
    <br>
    <div class="row">
        <div class="col s4">
          <div class="card medium">
            <div class="card-image">
              <img src="http://img.providr.com/all-images/mia-khalifa-photos-again1.jpg">
              <span class="card-title">Arya Wiranata <small>- UI Designer</small></span>
            </div>
            <div class="card-content">
              <p>5115100163</p><br>
              <p>rogojagadalit@gmail.com</p><br>
            </div>
            <div class="card-action">
              <a href="#" target="blank">Visit</a>
            </div>
          </div>
        </div>
        <div class="col s4">
          <div class="card medium">
            <div class="card-image">
              <img src="http://img.providr.com/all-images/mia-khalifa-photos-again1.jpg">
              <span class="card-title">Hendry Wiranto <small>- Database Developer</small></span>
            </div>
            <div class="card-content">
              <p>5115100168</p><br>
              <p>rogojagadalit@gmail.com</p><br>
            </div>
            <div class="card-action">
              <a href="#">Visit</a>
            </div>
          </div>
        </div>
        <div class="col s4">
          <div class="card medium">
            <div class="card-image">
              <img src="http://img.providr.com/all-images/mia-khalifa-photos-again1.jpg">
              <span class="card-title">Rogo Jagad Alit <small>- Backend Developer</small></span>
            </div>
            <div class="card-content">
              <p>5115100168</p><br>
              <p>rogojagadalit@gmail.com</p><br>
            </div>
            <div class="card-action">
              <a href="#">Visit</a>
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