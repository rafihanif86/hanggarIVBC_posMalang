<?php 
	session_start();
	$email = "";
	
	if($_SESSION['status']=="checker" or $_SESSION['status']=="admin"){
		$email = $_SESSION['email'];
		//waktu unactive
		if((time() - $_SESSION['last_login_timestamp']) > 600){  
			header("location:logout.php");  
		} 
	}else{
		header("location:login_page.php?pesan=belum_login");
	}
?>