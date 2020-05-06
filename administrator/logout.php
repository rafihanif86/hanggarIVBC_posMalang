<?php 
// mengaktifkan session
session_start();
include 'connection.php';

$email = $_SESSION['email'];
$query2 = "UPDATE akun_admin set login_status = 'logout' WHERE email = '$email'";
$result2=mysqli_query($conn,$query2);
if($result2){
    // menghapus semua session
    session_destroy();

    // mengalihkan halaman sambil mengirim pesan logout
    header("location:login_page.php?pesan=logout");
}else{
    echo "<script>alert('Gagal Logout')
         location.replace('dashboard_admin.php')</script>";
                    
}
 

?>