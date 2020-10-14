<?php 
    include('session.php');
    include('connection.php');
?>

<!DOCTYPE html>
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
    
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
    <script src="https://kit.fontawesome.com/7a0f45a9b4.js" crossorigin="anonymous"></script>
    <!-- <meta http-equiv="refresh" content="60" /> -->

    <script type="text/javascript" src="/plugins/chart.js/Chart.js"></script>

</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="dashboard_admin.php" class="nav-link">Home</a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <!-- <ul class="navbar-nav ml-auto">
                </li>
                <!-- Notifications Dropdown Menu -->
                <!-- <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-bell"></i>
                        <span class="badge badge-warning navbar-badge">15</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <span class="dropdown-item dropdown-header">15 Notifications</span>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-envelope mr-2"></i> 4 new messages
                            <span class="float-right text-muted text-sm">3 mins</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-users mr-2"></i> 8 friend requests
                            <span class="float-right text-muted text-sm">12 hours</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-file mr-2"></i> 3 new reports
                            <span class="float-right text-muted text-sm">2 days</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                    </div>
                </li>
                </li>
            </ul>  -->

            <ul class="navbar-nav ml-auto float-right">
                <a href="logout.php" class="text-secondary"><i class="fas fa-sign-out-alt"></i></a>
            </ul>

        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="index.php" class="brand-link">
                <img src="gambar/logo_BC.png" alt="Hanggar POS BC Malang" class="brand-image "
                    style="opacity: 1 ;" width="30px">
                <span class="brand-text font-weight-light">Hanggar POS Malang</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user (optional) -->
                    <?php
                        $nama_akun = "";
                        $nip_akun = "";
                        $foto_profil = "guest.png";
                        $query1 = "select * from akun_admin WHERE email like '%$email%'";
                        $result1=mysqli_query($conn,$query1);
                        while ($row1=mysqli_fetch_array($result1)){
                            $nama_akun = $row1["nama"];
                            $nip_akun = $row1["id"];
                            if($row1["foto_profil"] != ""){
                                $foto_profil = $row1["foto_profil"];    
                            }
                            
                        }
                    ?>
                <div class="user-panel mt-3 pb-3 mb-3 d-flex active">
                    <div class="image">
                        <img src="images/<?php echo "$foto_profil"; ?>" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="akun_form.php?p=<?php echo base64_encode($nip_akun);?>" class="d-block"><?php echo $nama_akun; ?></a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
           with font-awesome or any other icon font library -->
                        <li class="nav-item has-treeview">
                            <a href="dashboard_admin.php" class="nav-link">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li>
                        <li class="nav-item has-treeview ">
                            <a href="#" class="nav-link <?php if($nav_active == 'konfirmasi'){echo'active';}?>">
                                <i class="nav-icon fas fa-file-invoice"></i>
                                <p>
                                    Konfirmasi Barang NPD
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                              <li class="nav-item ">
                                  <a href="konfirmasi_table.php?status=belum_diproses" class="nav-link <?php if($nav_active == 'konfirmasi' && $act == 'belum_diproses'){echo'active';}?>">
                                      <i class="far fa-circle nav-icon"></i>
                                      <p>Data Belum Diperoses</p>
                                  </a>
                              </li>
                              <li class="nav-item ">
                                  <a href="konfirmasi_table.php?status=telah_diproses" class="nav-link <?php if($nav_active == 'konfirmasi' && $act == 'telah_diproses'){echo'active';}?>">
                                      <i class="far fa-circle nav-icon"></i>
                                      <p>Data Telah Diperoses</p>
                                  </a>
                              </li>
                              <li class="nav-item ">
                                  <a href="konfirmasi_table.php" class="nav-link <?php if($nav_active == 'konfirmasi' && $act == 'seluruh'){echo'active';}?>">
                                      <i class="far fa-circle nav-icon"></i>
                                      <p>Seluruh Data Konfirmasi</p>
                                  </a>
                              </li>
                              <li class="nav-item ">
                                  <a href="konfirmasi_form.php" class="nav-link <?php if($nav_active == 'konfirmasi' && $act == 'form'){echo'active';}?>">
                                      <i class="far fa-circle nav-icon"></i>
                                      <p>Kelola Data / Data Baru</p>
                                  </a>
                              </li>
                            </ul>
                        </li>
                        <li class="nav-item has-treeview ">
                            <a href="#" class="nav-link <?php if($nav_active == 'penerima'){echo'active';}?>">
                                <i class="nav-icon fas fa-user "></i>
                                <p>
                                    Penerima
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                              <li class="nav-item">
                                  <a href="penerima_table.php" class="nav-link <?php if($nav_active == 'penerima' && $act == 'telah_diproses'){echo'active';}?>">
                                      <i class="far fa-circle nav-icon"></i>
                                      <p>Data Penerima</p>
                                  </a>
                              </li>
                              <li class="nav-item">
                                  <a href="penerima_detail.php" class="nav-link <?php if($nav_active == 'penerima' && $act == 'form'){echo'active';}?>">
                                      <i class="far fa-circle nav-icon"></i>
                                      <p>Kelola Data / Data Baru</p>
                                  </a>
                              </li>
                            </ul>
                        </li>
                        <li class="nav-item has-treeview" <?php if($_SESSION['status'] == "checker"){ echo "hidden"; } ?> >
                            <a href="#" class="nav-link <?php if($nav_active == 'akun'){echo'active';}?>">
                                <i class="nav-icon fas fa-users"></i>
                                <p>
                                    Kelola Akun
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                              <li class="nav-item">
                                  <a href="akun_table.php" class="nav-link <?php if($nav_active == 'akun' && $act == 'tabel_akun'){echo'active';}?>">
                                      <i class="far fa-circle nav-icon"></i>
                                      <p>Data Akun</p>
                                  </a>
                              </li>
                              <li class="nav-item">
                                  <a href="akun_form.php" class="nav-link <?php if($nav_active == 'akun' && $act == 'form'){echo'active';}?>">
                                      <i class="far fa-circle nav-icon"></i>
                                      <p>Tambah Akun</p>
                                  </a>
                              </li>
                            </ul>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>