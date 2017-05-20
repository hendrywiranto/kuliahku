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
  <nav class="light-blue lighten-1" role="navigation">
    <div class="nav-wrapper container">
      <ul class="right hide-on-med-and-down">
        <li><a href="logout.php">Logout</a></li>
      </ul>

      <ul id="nav-mobile" class="side-nav">
        <li><a href="logout.php">Logout</a></li>
      </ul>
      <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
    </div>
  </nav>
  <div class="section no-pad-bot" id="index-banner">
    <div class="container">
      <br><br>
      <h1 class="header center orange-text">KULIAHKU THE GAME</h1>
      <a href="ambilmatkul.php">Tambah mata kuliah</a>
      <?php
        if(isset($_SESSION['email'])){
          include "connect.php";
          $query = "CALL sp_matkul_list('$_SESSION[email]')";
          $sql = mysqli_query($db,$query) or die("Query fail : ".mysqli_error());
          if (mysqli_num_rows($sql)!=0){
            while ($row = mysqli_fetch_assoc($sql)){
              echo "<p>$row[nama_matkul]</p>";
            }
          }
          else {
            echo "<p>Tidak ada mata kuliah yang sudah diambil</p>";
          }
          mysqli_close($db);
        }
        
        ?>
      <a href="index.php">Back</a>
      <br><br>

    </div>
  </div>


  

  <footer class="page-footer orange" style="position: relative;margin-top: 228px; /* negative value of footer height */;clear: both;">
    
    <div class="footer-copyright">
      <div class="container">
      Made by <span class="orange-text text-lighten-3">Kuliahku - MBD E</span> 
      </div>
    </div>
  </footer>


  <!--  Scripts-->
  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="js/materialize.js"></script>
  <script src="js/init.js"></script>

  </body>
</html>