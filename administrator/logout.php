<?php 
    // mengaktifkan session
    session_start();
    include 'connection.php';

    $email = $_SESSION['email'];
    $query2 = "UPDATE akun_admin set login_status = 'logout' WHERE email = '$email'";
    $result2=mysqli_query($conn,$query2);
    $redirect_to = $_SESSION['redirect_to'];
    if($result2){
        // menghapus semua session
        session_destroy();
        // mengalihkan halaman sambil mengirim pesan logout
        session_start();
        $_SESSION['redirect_to'] = $redirect_to;
        header("location:login_page.php?pesan=logout");
    }else{
        echo "<script>alert('Gagal Logout')
            location.replace('dashboard_admin.php')</script>";
    }
?>