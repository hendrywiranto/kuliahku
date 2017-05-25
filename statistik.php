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
  <title>Kuliahku - My Stats</title>

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
        if(isset($_SESSION['email'])){
          include "connect.php";
          $query = "CALL sp_user_statistik('$_SESSION[email]')";
          $sql = mysqli_query($db,$query) or die("Query fail : ".mysqli_error());
          $row = mysqli_fetch_array($sql);
          if($row[0]==1){

            ?>
              <table class="highlight centered">
                <thead>
                  <tr>
                      <th>Attributes</th>
                      <th>Value</th>
                  </tr>
                </thead>
                <tbody style="text-align: center">
                    <tr>
                      <td>Username</td>
                      <td><?php echo "$row[1]"; ?></td>
                    </tr>
                    <tr>
                      <td>Email</td>
                      <td><?php echo "$row[2]"; ?></td>
                    </tr>
                    <tr>
                      <td>Knowledge</td>
                      <td><?php echo "$row[3]"; ?></td>
                    </tr>
                    <tr>
                      <td>Moral</td>
                      <td><?php echo "$row[4]"; ?></td>
                    </tr>
                    <tr>
                      <td>SKS</td>
                      <td><?php echo "$row[5]"; ?></td>
                    </tr>
                    <tr>
                      <td>Cara Jujur</td>
                      <td><?php echo "$row[6]"; ?></td>
                    </tr>
                    <tr>
                      <td>Cara Nyontek</td>
                      <td><?php echo "$row[7]"; ?></td>
                    </tr>
                </tbody>
              </table>
            <?php

             
          }else{
             echo "<p>$row[1]</p>";
          }
          mysqli_close($db);
        }
        
        ?>
      
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