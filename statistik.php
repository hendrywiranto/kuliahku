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
      <?php
        if(isset($_SESSION['email'])){
          include "connect.php";
          $query = "CALL sp_user_statistik('$_SESSION[email]')";
          $sql = mysqli_query($db,$query) or die("Query fail : ".mysqli_error());
          $row = mysqli_fetch_array($sql);
          if($row[0]==1){
             echo "<p>User name: $row[1]</p>";
             echo "<p>User email: $row[2]</p>";
             echo "<p>Knowledge: $row[3]</p>";
             echo "<p>Moral: $row[4]</p>";
             echo "<p>SKS: $row[5]</p>";
             echo "<p>Tugas jujur count: $row[6]</p>";
             echo "<p>Tugas nyontek count: $row[7]</p>";
          }else{
             echo "<p>$row[1]</p>";
          }
          mysqli_close($db);
        }
        
        ?>
      <a href="index.php">Back</a>
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