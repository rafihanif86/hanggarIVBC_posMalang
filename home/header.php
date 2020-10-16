<?php
    include('connection.php');
    session_start();
    $_SESSION['redirect_to'] = "";
    $no_hp = "081916983958";
?>
<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>BEA CUKAI | Kantor Pos Malang</title>
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
        <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
            <div class="container"> 
            <a class="navbar-brand" href="#"><img src="img/header/logo_BC_POS.png" style="width: 290px;"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav ml-auto">
                <a class="nav-item nav-link <?php if($page == "beranda"){echo "active";}?>" href="homepage.php">Beranda</a>
                <a class="nav-item nav-link <?php if($page == "tatacara"){echo "active";}?>" href="about.php">Tata Cara</a>
                <a class="nav-item nav-link <?php if($page == "konfirmasi"){echo "active";}?>" href="konfirmasi.php">Konfirmasi</a>
                <a class="nav-item nav-link <?php if($page == "kalkulator"){echo "active";}?>" href="kalkulator.php">Kalkulator Pajak</a>
                <a class="nav-item nav-link <?php if($page == "tentang"){echo "active";}?>" href="contact.php">Tentang</a>
            </div>
            </div>
            </div>
        </nav>
    </header>
    <br/>
    <!-- header-end -->