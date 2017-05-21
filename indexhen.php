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
  <title>COMING SOON</title>
  <script>
    var myVar = setInterval(myTimer, 5000);
    var energi = <?php
          include "connect.php";
          $query = "SELECT fn_EN(energi_s0,energi_t0) AS energi FROM statistiks WHERE user_id='$_SESSION[id]';";
          $sql = mysqli_query($db, $query) or die("Query fail : ".mysqli_error($db));
          $row = mysqli_fetch_assoc($sql);
          #echo var_dump($row);
          echo "$row[energi]";
          mysqli_close($db);
        ?>;
    function myTimer() {
        document.getElementById("energi").innerHTML = energi;
        if (energi <100){
          energi=energi+1;
        }
    }

    var myTime = setInterval(myDate, 1000);

    function myDate() {
        var d = new Date();
        document.getElementById("date").innerHTML = d.toLocaleTimeString();
    }
  </script>
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
      <a href="statistik.php">Statistik saya</a><br>
      <a href="matakuliah.php">Mata kuliah</a><br>
      <a href="tugas.php">Tugas</a>
      <div id="energi"><?php echo $row['energi']; ?></div>
      <div id="date"></div>
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