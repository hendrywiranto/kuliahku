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
  <title>Knowledge Leaderboard</title>

  <!-- CSS  -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="css/style_index.css" type="text/css" rel="stylesheet" media="screen,projection"/>
</head>
<body>
   <?php include 'nav.php'; ?>
   <div class="fixed-action-btn horizontal click-to-toggle">
    <a class="btn-floating btn-large red">
      <i class="material-icons">menu</i>
    </a>
    <ul>
      <li><a class="btn-floating red"><i class="material-icons">insert_chart</i></a></li>
      <li><a class="btn-floating yellow darken-1"><i class="material-icons">format_quote</i></a></li>
      <li><a class="btn-floating green"><i class="material-icons">publish</i></a></li>
      <li><a class="btn-floating blue"><i class="material-icons">attach_file</i></a></li>
    </ul>
  </div>
  <div class="section no-pad-bot" id="index-banner">
    <div class="container">
      <br><br>
      <h1 class="header center orange-text">KULIAHKU THE GAME</h1>
      <?php
        if(isset($_SESSION['email'])){
          include "connect.php";
          $query = "CALL sp_leaderboard_knowledge";
          $sql = mysqli_query($db,$query) or die("Query fail : ".mysqli_error());
          if (mysqli_num_rows($sql)!=0){
            ?>
    <?php include 'leadby.php'; ?>
              <table class="centered striped">
                <thead>
                  <tr>
                      <th>Username</th>
                      <th>Knowledge</th>
                      <th>Moral</th>
                      <th>SKS</th>
                      <th>Tugas Dikerjakan</th>
                      <th>Cara Baik</th>
                      <th>Cara Jelek</th>
                  </tr>
                </thead>

                <tbody>
                  <?php while ($row = mysqli_fetch_assoc($sql)){
                        $total=$row["tugas_baik_count"]+$row["tugas_buruk_count"];
                      ?>
                        <tr>
                          <td><?php echo "$row[u_name]<br>";?></td>
                          <td><?php echo "$row[knowledge_stat]<br>";?></td>
                          <td><?php echo "$row[moral_stat]<br>";?></td>
                          <td><?php echo "$row[sks_stat]<br>";?></td>
                          <td><?php echo "$total";?></td>
                          <td><?php echo "$row[tugas_baik_count]<br>";?></td>
                          <td><?php echo "$row[tugas_buruk_count]<br>";?></td>
                        </tr>
                      <?php
                    }
                  ?>
                </tbody>
              </table>
            <?php
          }
          else {
            echo "<p>Tidak ada user yang terdaftar</p>";
          }
          mysqli_close($db);
        }

        ?>
        <br>
      <?php include 'back_button.php';?>

    </div>
  </div>
<?php include 'footer.php'; ?>



  <!--  Scripts-->
  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="js/materialize.js"></script>
  <script src="js/init.js"></script>

  </body>
</html>
