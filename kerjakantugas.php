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
      <?php
        if(isset($_SESSION['email'])){
          #var_dump($_SESSION['id']);
          include "connect.php";

          $query = "CALL sp_cara_tugas('$_GET[tugas]')";
          $sql = mysqli_query($db,$query) or die("Query fail : ".mysqli_error());
          if (mysqli_num_rows($sql)!=0){
              while ($row = mysqli_fetch_assoc($sql)){
              echo "$row[nama_tugas]";
              echo "<p>Nama cara: $row[nama_cara]</p>";
              echo "<p>Knowledge Jumlah: $row[knowledge_juml]</p>";
              echo "<p>Moral Jumlah: $row[moral_juml]</p>";
              echo "<p>Completion time:$row[completion_time]</p>";
              echo "<p>Energi Requirement: $row[energi_req]</p>";
              echo "<a href='kerja.php?tugas=$row[id]&cara=$row[id_nama_cara]'>Pakai cara</a><br><br>";
            }
          }
          else {
            echo "<p>Tidak ada cara</p>";
          }
          mysqli_close($db);
        }
        
        ?>
      <br>
      <a href="tambahtugas.php">Back</a>
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