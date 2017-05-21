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
      <?php 
          include "connect.php";
          $query = "CALL sp_tambah_tugas('$_SESSION[id]','$_GET[tugas]','$_GET[cara]');";
          $sql = mysqli_query($db,$query) or die("Query fail : ".mysqli_error());
          $row = mysqli_fetch_array($sql);
          if ($row[0]==-100){
            echo "$row[1]<br>"; 
            echo "Energi: $row[energi]<br>";
          }
          else {
            echo "Energi: $row[energi_s0]<br>";
            echo "Tugas baik: $row[tugas_baik_count]<br>";
            echo "Tugas buruk: $row[tugas_buruk_count]<br>";
          }
          #var_dump($row);
          mysqli_close($db);
        
      ?>
      <br>
      <a href="kerjakantugas.php?tugas=<?php echo "$_GET[tugas]";?>">Back</a>
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