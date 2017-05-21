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
  <title>Kuliahku - The Game</title>
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
      <h1 class="header center orange-text">KULIAHKU THE GAME</h1>

      <?php include 'stats_nav.php' ?>
      <br><br>
      <div class="row" style="text-align: center;">
	      <div class="col s4"><a href="statistik.php" class=" waves-effect waves-light btn-large">Statistik saya</a><br></div>
	      <div class="col s4">
	      	<a href="matakuliah.php" class=" waves-effect waves-light btn-large">Mata kuliah</a>
	      	<br><br><br><br><br><br>
	      	<a href="leaderboardknowledge.php" class=" waves-effect waves-light btn-large">Leaderboard</a>
	      </div>
	      <div class="col s4"><a href="tugas.php" class=" waves-effect waves-light btn-large">Tugas</a></div>
	      
      </div>
      <br><br>
      
    </div>
  </div>
    <?php include 'footer.php'; ?>

  <!--  Scripts-->
  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="js/materialize.js"></script>
  <script src="js/init.js"></script>

  </body>
</html>