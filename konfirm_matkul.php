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
          
          echo "Tugas persyaratan :";
          $query = "CALL sp_matkul_konfirm('$_GET[matkul]')";
          $sql = mysqli_query($db,$query) or die("Query fail : ".mysqli_error());
          ?><ul class="collection"><?php
          if (mysqli_num_rows($sql)!=0){
            while ($row = mysqli_fetch_assoc($sql)){
              ?>
                  <li class="collection-item"><?php echo $row['nama_tugas'] ?></li>
              <?php
            }
          }
          else {
            echo "<p>Tidak ada syarat</p>";
          }
          mysqli_close($db);
        }
        
        ?>
        </ul>
        <br><br>
      <?php include 'back_button.php' ?>
      <a class="btn waves-effect waves-light" href=<?php echo "hasilmatkul.php?matkul=$_GET[matkul]" ?>>
         Ambil
      </a>

    </div>
  </div>
 <?php include 'footer.php'; ?>


  <!--  Scripts-->
  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="js/materialize.js"></script>
  <script src="js/init.js"></script>

  </body>
</html>