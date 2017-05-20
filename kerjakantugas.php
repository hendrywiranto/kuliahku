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
          $query = "CALL sp_cara_tugas('$_GET[varname]')";
          
          $sql = mysqli_query($db,$query) or die("Query fail : ".mysqli_error());
          if (mysqli_num_rows($sql)!=0){
              
              while ($row = mysqli_fetch_assoc($sql)){
              
              /*
              echo "<p>Knowledge Jumlah: $row[knowledge_juml]</p>";
              echo "<p>Moral Jumlah: $row[moral_juml]</p>";
              echo "<p>Completion time:$row[completion_time]</p>";
              echo "<p>Energi Requirement: $row[energi_req]</p>";
              echo "<a href=''>Pakai cara</a><br><br>";
              */

              ?>
                <div class="col s12 m7">
                <div class="card horizontal">
                  <div class="card-stacked">
                    <div class="card-content">
                      <?php
                          if ($row['nama_cara']==1){
                            //echo "<p>Kerjakan Sendiri</p>";
                            ?>
                              <p style="color: #2196f3">Kerjakan Sendiri</p>
                            <?php
                          }
                          else if ($row['nama_cara']==2){
                            ?>
                              <p style="color: #f44336">Nyontek Punya Teman</p>
                            <?php
                          }

                          echo "<p>Knowledge: $row[knowledge_juml]</p>";
                          echo "<p>Moral: $row[moral_juml]</p>";
                          echo "<p>Completion time:$row[completion_time]</p>";
                          echo "<p>Energi Requirement: $row[energi_req]</p>";
                          
                      ?>
                    </div>
                    <div class="card-action"><?php
                      echo "<a href=''>Pakai cara</a><br><br>";
                      ?>
                    </div>
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
      <br>
      <a href="tambahtugas.php">Back</a>
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