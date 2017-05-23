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

<meta charset="utf-8">
<link href="css/style_register.css" rel='stylesheet' type='text/css' />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.2/css/materialize.min.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!--webfonts-->
<link href='http://fonts.googleapis.com/css?family=Oxygen:400,300,700' rel='stylesheet' type='text/css'>
<!--//webfonts-->
</head>
<body>
<div class="main">
	<div style="display: inline">
		<h3 style="font-size: 24px"><a class="waves-effect waves-teal btn-flat" style="background: #40a46f; border-radius: 100px; color: white" href="login.php">< Login</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<!--GOD WHY..--><span style="font-size: 36px; text-align:center;">REGISTER</span></h3>
		<!-- <h3 style="font-size: 36px">REGISTER</h3> -->
	</div>
		<form method="post" action="">
		   <div class="lable-2">
				 <input type="text" id="nama" name="nama" class="text" value="Name" onfocus="this.value = '';"onblur="if (this.value == '') {this.value = 'nama';}" required>
		     <input type="text" id="email" name="email" class="text" value="your@email.com " onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'your@email.com ';}" required>
		     <input type="password" id="password" name="password" class="text" value="Password " onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Password ';}" required>
		   </div>
		   <div class="submit">
			  <input type="submit" id="submit" name="submit" onclick="myFunction()" value="Create account" >
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
				$_SESSION['email']=$_POST['email'];
				$_SESSION['id']=$row[2];
				$_SESSION['loggedIn']=true;
				header("Location: index.php");
			}else{
				echo "<br><h2 style='font-size: 24px'>$row[1]</h2>";
			}
			mysqli_close($db);
		}
	?>
		</div>
		<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.2/js/materialize.min.js"></script>

</body>
</html>
