<?php 
      session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
</head>
<body>
	<form method="post" action="">
	  	<input type="email" name="email" placeholder="Email" required>
	  	<input type="password" name="password" placeholder="password" required="">
	  	<input type="submit" name="submit" value="Log In">
	</form>

      <p>Belum punya akun? </p><a href="register.php">Daftar disini</a>
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
</body>
</html>