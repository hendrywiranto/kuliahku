<?php
	session_start();
	if(!isset($_SESSION['email'])){
		header("Location: login.php");
		die;
	}

	echo "Halaman ini muncul jika anda sudah berhasil login";
	?><a href="logout.php">Keluar</a><?php
?>