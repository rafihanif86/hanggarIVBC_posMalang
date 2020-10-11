<?php
    include('connection.php');
    session_start();
    $_SESSION['redirect_to'] = "";
?>
<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Hanggar IV BC | Pos Malang</title>
    <link rel="shortcut icon" href="../administrator/gambar/logo_BC.png">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- <link rel="manifest" href="site.webmanifest"> -->
    <!-- Place favicon.ico in the root directory -->

    <!-- CSS here -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/themify-icons.css">
    <link rel="stylesheet" href="css/nice-select.css">
    <link rel="stylesheet" href="css/flaticon.css">
    <link rel="stylesheet" href="css/gijgo.css">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/slick.css">
    <link rel="stylesheet" href="css/slicknav.css">
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css">

    <link rel="stylesheet" href="css/style.css">
    <!-- <link rel="stylesheet" href="css/responsive.css"> -->

    <script src="https://kit.fontawesome.com/7a0f45a9b4.js" crossorigin="anonymous"></script>

</head>

<body>
    <header>
        <div class="header-area ">
            <div id="sticky-header" class="main-header-area">
                <div class="container-fluid">
                    <div class="header_bottom_border">
                        <div class="row align-items-center">
                            <div class="col-xl-3 col-lg-3">
                                <div class="logo">
                                    <a href="#"><img src="img/header/logo_BC_POS.png" style="width: 290px;"></a><br />

                                </div>
                            </div>
                            <div class="col-xl-5 col-lg-5">
                                <nav class="navbar navbar-expand-lg navbar-light">
                                    <div class="collapse navbar-collapse" id="navbarNav">
                                        <ul class="navbar-nav" id="navigation">
                                            <li class="nav-item <?php if($page == "beranda"){echo "active";}?>">
                                                <a class="nav-link" href="homepage.php">Beranda</a>
                                            </li>
                                            <li class="nav-item <?php if($page == "tatacara"){echo "active";}?>">
                                                <a class="nav-link" href="about.php">Tata Cara</a>
                                            </li>
                                            <li class="nav-item <?php if($page == "konfirmasi"){echo "active";}?>">
                                                <a class="nav-link" href="konfirmasi.php">Konfirmasi</a>
                                            </li>
                                            <li class="nav-item <?php if($page == "tentang"){echo "active";}?>">
                                                <a class="nav-link" href="contact.php">Tentang</a>
                                            </li>
                                        </ul>
                                    </div>
                                </nav>
                            </div>
                            <div class="col-xl-4 col-lg-4 d-none d-lg-block">
                                <div class="social_wrap d-flex align-items-center justify-content-end">
                                    <div class="number">
                                        <?php 
                                            $no_hp = "081916983958";
                                            $noPottong = substr($no_hp,1);
                                        ?>
                                        <p>
                                            <a href="https://api.whatsapp.com/send?phone=<?php echo "+62" .$noPottong; ?>&text=Halo"
                                                target="_blank">
                                                <i class="fa fa-phone"></i><?php echo $no_hp;?>
                                            </a>
                                        </p>
                                    </div>
                                    <div class="social_links d-none d-xl-block">
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="seach_icon">
                                <a data-toggle="modal" data-target="#exampleModalCenter" href="#">
                                    <i class="fa fa-search"></i>
                                </a>
                            </div> -->
                            <!-- <div class="col-12">
                                <div class="mobile_menu d-block d-lg-none"></div>
                            </div> -->
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </header>
    <!-- header-end -->