<?php 
    session_start();
    if(isset($_GET['pesan'])){
        if($_GET['pesan'] == "gagal"){
            echo "<script>alert('Login gagal! username dan password salah!')
                    location.replace('login_page.php')</script>";
        }else if($_GET['pesan'] == "logout"){
            echo "<script>alert('Anda telah berhasil logout')
                    location.replace('login_page.php')</script>";
        }else if($_GET['pesan'] == "belum_login"){
            echo "<script>alert('Anda harus login untuk mengakses halaman admin')
                    location.replace('login_page.php')</script>";
        }
    }
?>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Hanggar IV BC | Pos Malang</title>
    <link rel="shortcut icon" href="gambar/logo_BC.png">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- Ekko Lightbox -->
    <link rel="stylesheet" href="../plugins/ekko-lightbox/ekko-lightbox.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <link rel="shortcut icon" href="gambar/LOGO_BEA_CUKAI.png">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
    <script src="https://kit.fontawesome.com/7a0f45a9b4.js" crossorigin="anonymous"></script>
    <!-- <meta http-equiv="refresh" content="60" /> -->
</head>

<body class="hold-transition login-page" style="background:url(gambar/login_bg.jpg);background-repeat: no-repeat; background-position:  center fixed; 
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;">
    <div class="login-box" >
        <div class="login-logo">
            <img src="gambar/Logo_BC.png" alt="Hanggar POS BC Malang" class="rounded mx-auto d-block" alt="..."
                style="width:50%; height:20%">
            <a href="#"><b>Konfirmasi Barang </b><br />
                <h3>Hanggar POS BC Malang</h3>
            </a>
        </div>
        <!-- /.login-logo -->
        <div class="card" >
            <div class="card-body login-card-body" style="border-radius: 50px;">
                <p class="login-box-msg">Masuk menggunakan akun yang telah didaftarkan</p>

                <form action="check_login.php" method="post">
                    <div class="input-group mb-3">
                        <input type="email" name="email" class="form-control" placeholder="Email">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" name="password" class="form-control" placeholder="Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" id="remember">
                                <label for="remember">
                                    Remember Me
                                </label>
                            </div>
                        </div> -->
                        <!-- /.col -->
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-block">Masuk</button>
                        </div>
                        <!-- /.col -->
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <br/>
                            <a href="../home/homepage.php" class="btn btn-danger btn-block btn-sm" role="button" aria-pressed="true">
                                Kembali
                            </a>
                        </div>
                    </div>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="../plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../dist/js/adminlte.min.js"></script>

</body>

</html>