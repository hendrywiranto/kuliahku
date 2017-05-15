<?php
      session_start();
      if(isset($_SESSION['email'])){
            header("Location: index.php");
            die;
      }
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Login</title>
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
  <link rel='stylesheet prefetch' href='http://fonts.googleapis.com/css?family=Roboto+Slab'>
  <style>
      /* NOTE: The styles were added inline because Prefixfree needs access to your styles and they must be inlined if they are on local disk! */
    a{
      color: #1abc9c;
      transition-duration: 0.5s;
    }
    a:hover{
      transition-duration: 0.5s;
      color: #16a085;
    }
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
}

  html, body {
  height: 100%;
  background-color: #34495e;
  font-family: "Roboto Slab", serif;
  color: white;
}

.preload * {
  transition: none !important;
}

label {
  display: block;
  font-weight: bold;
  font-size: small;
  text-transform: uppercase;
  font-size: 0.7em;
  margin-bottom: 0.35em;
}

input[type="text"], input[type="password"] {
  width: 100%;
  border: none;
  padding: 0.5em;
  border-radius: 2px;
  margin-bottom: 0.5em;
  color: #333;
}
input[type="text"]:focus, input[type="password"]:focus {
  outline: none;
  box-shadow: inset -1px -1px 3px rgba(0, 0, 0, 0.3);
}

button {
  padding-left: 1.5em;
  padding-right: 1.5em;
  padding-bottom: 0.5em;
  padding-top: 0.5em;
  border: none;
  border-radius: 2px;
  background-color: #7f8c8d;
  text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.25);
  color: white;
  box-shadow: 1px 1px 3px rgba(0, 0, 0, 0.45);
}

small {
  font-size: 1em;
}

.login--login-submit {
  float: right;
}

.login--container {
  width: 600px;
  background-color: #34495e;
  margin: 0 auto;
  position: relative;
  top: 25%;
}

.login--toggle-container {
  position: absolute;
  background-color: #34495e;
  right: 0;
  line-height: 2.5em;
  width: 50%;
  height: 120px;
  text-align: right;
  cursor: pointer;
  transform: perspective(1000px) translateZ(1px);
  transform-origin: 0% 0%;
  transition: all 1s cubic-bezier(0.06, 0.63, 0, 1);
  backface-visibility: hidden;
}
.login--toggle-container .js-toggle-login {
  font-size: 4em;
  text-decoration: underline;
}
.login--active .login--toggle-container {
  transform: perspective(1000px) rotateY(180deg);
  background-color: #2c3e50;
}

.login--username-container, .login--password-container {
  float: left;
  background-color: #34495e;
  width: 50%;
  height: 120px;
  padding: 0.5em;
}

.login--username-container {
  transform-origin: 100% 0%;
  transform: perspective(1000px) rotateY(180deg);
  transition: all 1s cubic-bezier(0.06, 0.63, 0, 1);
  background-color: #2c3e50;
  backface-visibility: hidden;
}
.login--active .login--username-container {
  transform: perspective(1000px) rotateY(0deg);
  background-color: #34495e;
}

footer {
  position: absolute;
  bottom: 12px;
  left: 20px;
}

    </style>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js"></script>

</head>

<body>
  <div class='preload login--container'>
  <form method="POST" action="">
    <div class='login--form'>
      <div class='login--username-container'>
        <label>Email</label>
        <input autofocus id="email" name="email" placeholder="Email" type='text'>
        <small>Belum punya akun? <a href="register.php">Daftar disini</a></small>
      </div>
      
      <div class='login--password-container'>
        <label>Password</label>
        <input placeholder='Password' id="password" name="password" type='password'>
        <input class='js-toggle-login login--login-submit' type="submit" name="submit" id="submit" value="Login">
      </div>
    </div>
    </form>
    <?php
      if(isset($_POST['submit'])){
        include "connect.php";

        $query = "CALL sp_login('$_POST[email]','$_POST[password]')";
        $sql = mysqli_query($db, $query) or die("Query fail : ".mysqli_error($db));

        $row = mysqli_fetch_array($sql);
            if($row[0] == 0){
              $_SESSION['email']=$_POST['email'];
              $_SESSION['id']=$row[2];
              $_SESSION['loggedIn']=true;
              echo $row[1];
              header("Location: index.php");
            }
            else{
              ?>
                <script type="text/javascript">
                  alert('<?php echo $row[1]; ?>');
                </script>
              <?php
            }
            echo $row[1]; 
            mysqli_close($db);
      }
    ?>
    <div class='login--toggle-container'>
      <small>Hey you,</small>
      <div class='js-toggle-login'>Login</div>
      <small>already</small>
    </div>
  </div>
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src="js/index.js"></script>

</body>
</html>
