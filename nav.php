<nav class="light-blue lighten-1" role="navigation">
    <div class="nav-wrapper container">
      <a href="index.php" class="brand-logo">Kuliahku</a>
      <ul class="right hide-on-med-and-down">
        <li><a href="statistik.php"><?php echo $_SESSION['email'] ?></a></li>
        <li><a href="logout.php">Logout</a></li>
      </ul>

      <ul id="nav-mobile" class="side-nav">
        <li><a href="statistik.php"><?php echo $_SESSION['email'] ?></a></li>
        <li><a href="logout.php">Logout</a></li>
      </ul>
      <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
    </div>
  </nav>