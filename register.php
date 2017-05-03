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
	<title>Register</title>
</head>
<body>
	<h1>Register Yourself</h1>
	<form method="post" action="">
		<input type="nama" name="nama" placeholder="Nama" required>
	  	<input type="email" name="email" placeholder="Email" required>
	  	<input type="password" name="password" placeholder="password" required="">
	  	<input type="submit" name="submit" value="Log In">
	</form>

	<?php
		if(isset($_POST['submit'])){
			include "connect.php";

			$query = "CALL sp_daftar('$_POST[nama]','$_POST[email]','$_POST[password]')";
			$sql = mysqli_query($db,$query) or die("Query fail : ".mysqli_error());

			$row = mysqli_fetch_array($sql);

			if($row[0]==0){
				echo "<p>$row[1] anda sudah bisa login</p>";
				echo "<a href='login.php'>Login</a>";
			}else{
				echo "<p>$row[1]</p>";
			}
			mysqli_close($db);
		}
	?>
</body>
</html>