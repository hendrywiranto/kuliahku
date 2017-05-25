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
  <title>Ambil Mata Kuliah</title>

  <!-- CSS  -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="css/style_index.css" type="text/css" rel="stylesheet" media="screen,projection"/>

  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="js/materialize.js"></script>
  <script src="js/init.js"></script>
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
          $query = "CALL sp_matkul_available";
          $sql = mysqli_query($db,$query) or die("Query fail : ".mysqli_error());
          if (mysqli_num_rows($sql)!=0){
            $i=0; $save;
            ?>
              <div class="row">
            <?php
            while ($row = mysqli_fetch_assoc($sql)){
              ?>
                  <div class="col s12 m6">
                    <div class="card">
                      <div class="card-image">
                        <?php echo'<img width="50" height="300" alt="" src="data:image/jpeg;base64,'.base64_encode($row['img']).'">';?>
                        <span class="card-title"><?php echo $row['nama_matkul']; ?></span>
                        <a class="btn-floating halfway-fab waves-effect waves-light red" href=<?php echo "#modal$row[id]"; ?>><i class="material-icons">add</i></a>
                      </div>
                      <div class="card-content">
                        <p><?php echo $row['deskripsi'];?></p>
                      </div>
                    </div>
                  </div>
              <?php
              //echo "<a href='#modal$row[id]' class=''>$row[nama_matkul]</a><br>";
              $save[] = $row['id']; 
              $i++; 
              }
              ?>
              </div>
              <?php
            }
          }
          else {
            echo "<p>Tidak ada tugas</p>";
          }
          mysqli_close($db);
        ?>

        <?php
            for ($i=0; $i < count($save); $i++) { 
                include "connect.php";
                $query = "CALL sp_matkul_konfirm($save[$i])";
                //echo $query;
                $sql = mysqli_query($db,$query) or die("Query fail : ".mysqli_error());
                ?>
                  <div id=<?php echo "modal$save[$i]" ?> class="modal">
                  <div class="modal-content">
                            <h4>Sudah mengerjakan tugas berikut?</h4><br>
                <?php
                if (mysqli_num_rows($sql)!=0){
                  while ($row = mysqli_fetch_assoc($sql)){
                    ?>
                      <?php echo $row['nama_tugas'] ?><br>
                    <?php
                  }
                  ?>
                    </div>
                        <div class="modal-footer">
                            <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Belum
                            <a href=<?php echo "hasilmatkul.php?matkul=$save[$i]" ?> class="modal-action modal-close waves-effect waves-green btn-flat">Ya
                            </a>
                        </div>
                    </div>
                  <?php
                  mysqli_close($db);
                }
                else {
                  echo "<p>Tidak ada syarat</p>";
                }
            }
        ?>

  <script type="text/javascript">
     $(document).ready(function(){
    // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
    $('.modal').modal();
  });
  </script>
      <?php include 'back_button.php' ?>
    </div>
  </div>
 <?php include 'footer.php'; ?>


  <!--  Scripts-->
  

  </body>
</html>