<?php 
	session_start();
	$email = "";
	
	if($_SESSION['status']=="checker" or $_SESSION['status']=="admin"){
		$email = $_SESSION['email'];
		//waktu unactive
		if((time() - $_SESSION['last_login_timestamp']) > 600){ 
			$_SESSION['redirect_to'] = $_SERVER['REQUEST_URI'];
			header("location:logout.php");
?>
			<!-- <script>
			var r = confirm('Your session is about to time out.\n Do you want to extend your current session?');
			if (r == true) {
				<?php //$_SESSION['last_login_timestamp'] = time();?>
			} else {
				<?php //header("location:logout.php");?>
			}	
			</script> -->
<?php
		}else{
			$_SESSION['last_login_timestamp'] = time(); 
		}
	}else{
		$_SESSION['redirect_to'] = $_SERVER['REQUEST_URI'];
		header("location:login_page.php?pesan=belum_login");
	}
?>