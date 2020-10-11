<?php
// mengaktifkan session php
session_start();
 
// menghubungkan dengan koneksi
include 'connection.php';
 
// menangkap data yang dikirim dari form
$email = $_POST['email'];
$password = md5($_POST['password']);
$status ="";
$login_status = "";

    $query1 = "SELECT * FROM akun_admin WHERE email = '$email' and password = '$password';";
    $result1=mysqli_query($conn,$query1);
    while ($row1=mysqli_fetch_array($result1)){
        $status = $row1["posisi"];
        $login_status = $row1["login_status"];
    }

if($status != "" && $login_status != ""){
    $query2 = "UPDATE akun_admin set login_status = 'login' WHERE email = '$email';";
    $result2=mysqli_query($conn,$query2);
    $_SESSION['email'] = $email;
    $_SESSION['status'] = $status;
    $_SESSION['last_login_timestamp'] = time();
    if($_SESSION['redirect_to'] == "" || $_SESSION['redirect_to'] == null){
        $_SESSION['redirect_to'] = "dashboard_admin.php";
    }
    header("location:".$_SESSION['redirect_to']);
    // header("location: dashboard_admin.php");
}else{
	header("location:login_page.php?pesan=gagal");
}
?>