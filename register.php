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
<meta charset="utf-8">
<link href="css/style_register.css" rel='stylesheet' type='text/css' />
<meta name="viewport" content="width=device-width, initial-scale=1">
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!--webfonts-->
<link href='http://fonts.googleapis.com/css?family=Oxygen:400,300,700' rel='stylesheet' type='text/css'>
<!--//webfonts-->
</head>
<body>
<div class="main">
	<h3 style="font-size: 36px">REGISTER</h3>
		<form method="post" action="">
		   <div class="lable-2">
		   		<input type="text" class="text" value="Name" onfocus="this.value = '';"onblur="if (this.value == '') {this.value = 'nama';}" required>
		        <input type="text" class="text" value="your@email.com " onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'your@email.com ';}">
		        <input type="password" class="text" value="Password " onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Password ';}">
		   </div>
		   
		   <div class="submit">
			  <input type="submit" onclick="myFunction()" value="Create account" >
		   </div>
		   <div class="clear"> </div>
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
		</div>
</body>
</html>