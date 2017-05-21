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
      <div class="row">
      <?php
        if(isset($_SESSION['email'])){
          include "connect.php";
          $query = "CALL sp_tugas_available";
          $sql = mysqli_query($db,$query) or die("Query fail : ".mysqli_error());
         if (mysqli_num_rows($sql)!=0){
            while ($row = mysqli_fetch_assoc($sql)){
              /*
              echo "<a href='kerjakantugas.php?varname=$row[nama_tugas]'>";
              echo "$row[nama_tugas]</a><br>";
              */

              ?>
                
                  <div class="col s4">
                    <div class="card">
                      <span class="card-title" style="font-size: 20px; text-align: center;"><?php echo "$row[nama_tugas]</a><br>"; ?></span>
                      <div class="card-content">
                      </div>

                      <div class="card-action">
                        <?php echo "<a href='kerjakantugas.php?tugas=$row[id]'>"; ?>
                        <?php echo "ambil</a><br>"; ?>
                      </div>
                    </div>
                  </div>

              <?php
            }
          }
          else {
            echo "<p>Tidak ada tugas</p>";
          }
          mysqli_close($db);
        }
        
        ?>
        </div>
<?php include 'back_button.php' ?>

    </div>
  </div>
<?php include 'footer.php'; ?>


  <!--  Scripts-->
  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="js/materialize.js"></script>
  <script src="js/init.js"></script>

  </body>
</html>