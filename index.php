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
  <title>Kuliahku - The Game</title>
  <!-- CSS  -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="css/style_index.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <style media="screen">
    .vertical{
      -ms-transform: rotate(270deg); /* IE 9 */
      -webkit-transform: rotate(270deg); /* Chrome, Safari, Opera */
      transform: rotate(270deg);
    }
  </style>
</head>
<body>
 	<?php include 'nav.php'; ?>
  <div class="section no-pad-bot" id="index-banner">
    <div class="container">
      <br><br>
      <h1 class="header center orange-text">KULIAHKU THE GAME</h1>
      <br><br>



      <table class="centered responsive-table">
        <tbody>
          <tr>
            <td><h4 class="vertical">PRACTICE<br></h4></td>
            <td>Kerjakan tugas sesuai mata kuliah sebelum ambil mata kuliah</td>
          </tr>
          <tr>
            <td><h4 class="vertical">BE A PEEPING TOM ?<br><br><br></h4></td>
            <td>Mau kerjakan sendiri atau nyontek? Terserah kok</td>
          </tr>
          <tr>
            <td><h4 class="vertical">KILL OR BE KILLED<br></h4></td>
            <td>Mau nyontek? Pastikan ada yang bisa dicontek</td>
          </tr>
          <tr>
            <td><h4 class="vertical">COST-Y<br><br><br></h4></td>
            <td>Mau kerjakan sendiri? Pastikan punya energi</td>
          </tr>
          <tr>
            <td><h4 class="vertical">KING OF THE WORLD</h4></td>
            <td>Siapakah yang lebih niat kuliah? Siapa yang paling jujur? Siapa yang paling pintar? Anda? Atau teman anda? Buktikan semua di leaderboard</td>
          </tr>
        </tbody>
      </table>
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
