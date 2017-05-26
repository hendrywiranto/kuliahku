<div style="color: white">
  <ul id="slide-out" class="side-nav fixed z-depth-3" style="background-color: #3498db;">

    <li><h3 style="text-align: center; text-transform: uppercase;"><?php echo $_SESSION['name'] ?></h3></li>
    <br>
    <?php include 'stats_nav.php' ?>
    <li><h5 style="padding-left: 5%;">Energi</h5></li>
    <div class="progress" style="left: 4%;width: 90%;">
      <div class="determinate" id="progressbar" style="width: <?php echo "$stats[energi]"; ?>%"></div>
    </div>
    <li><a style="color: white" href="matakuliah.php">Mata Kuliah</a></li>
    <li><a style="color: white" href="leaderboardknowledge.php">Leaderboard</a></li>
    <li><a style="color: white" href="tugas.php">Tugas</a></li>


    <div class="" style="bottom: 10%;position: absolute">
      <li><a style="color: white" href="statistik.php"><?php echo $_SESSION['email'] ?></a></li>
      <li><a style="color: white" href="developer.php">About Us</a></li>
      <li><a style="color: white" href="logout.php">Logout</a></li>
    </div>
  </ul>
</div>
<main>
