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
  <title>Kuliahku</title>

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

      <a class="btn waves-effect waves-light" href="ambilmatkul.php">
        Ambil mata kuliah <i class="material-icons right">input</i>
      </a>
      <?php
        if(isset($_SESSION['email'])){
          include "connect.php";
          $query = "CALL sp_matkul_list('$_SESSION[email]')";
          $sql = mysqli_query($db,$query) or die("Query fail : ".mysqli_error());
          if (mysqli_num_rows($sql)!=0){
            ?>
              <ul class="collection">
                <?php
                while ($row = mysqli_fetch_assoc($sql)){
                 // echo "<p>$row[nama_tugas]</p>";
                  ?><li class="collection-item"><?php echo "<p>$row[nama_matkul]</p>"; ?></li><?php
                }
            ?></ul><?php
          }
          else {
            echo "<p>Tidak ada mata kuliah yang sudah diambil</p>";
          }
          mysqli_close($db);
        }

        ?>
      <?php include 'back_button.php' ?>


    </div>
  </div>
<?php include 'nav.php'; ?>
<?php include 'footer.php'; ?>
  <!--  Scripts-->
  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="js/materialize.js"></script>
  <script src="js/init.js"></script>

  </body>
</html>
