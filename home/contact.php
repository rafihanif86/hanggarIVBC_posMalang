<?php 
    $page = "tentang";
    include 'header.php';
?>
<!-- header-end -->

<!-- bradcam_area  -->
<div style="background-image: url(img/contact/login_bg.jpg);" class="bradcam_area ">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="bradcam_text text-center">
                    <h3>TENTANG</h3>
                    <p>Hanggar Pabean dan Cukai VI | Kantor Pos Malang</p><br />
                    <a href="http://www.beacukaimalang.com/" class="boxed-btn3" style="border-radius: 30px;">Informasi
                        Bea Cukai Malang</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!--/ bradcam_area  -->

<!-- ================ contact section start ================= -->
<section class="contact-section">
    <div class="container">

        <div class="row">
            <div class="col-lg-12">
                <div class="story_heading">
                    <h3>Hanggar Pabean dan Cukai VI Kantor Pos Malang</h3>
                </div>
                <div class="row">
                    <div class="col-lg-11 offset-lg-1">
                        <div class="story_info">
                            <div class="row">
                                <div class="col-lg-9">
                                    <p>
                                        Aplikasi ini dibuat untuk mempermudah importir yang menggunakan jasa POS Malang
                                        melakukan konfirmasi barang impornya kepada petugas Hanggar Pabean dan Cukai VI
                                        Bea Cukai.
                                    </p>
                                    <p>
                                        Hanggar Pabean dan Cukai VI melakukan pengecekan barang import serta menerima
                                        export yang menggunakan jasa POS dikota Malang.
                                    </p>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <br />
                <hr />
                <br />
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="story_heading">
                    <h3>Kontak dan Alamat</h3>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-8">
                <div class="d-none d-sm-block mb-5 pb-4">
                    <div style="background-image: url(img/contact/maps.png); cursor: pointer;" class="bradcam_area"
                        onmouseover=""
                        onclick="location.href='https://www.google.com/maps/dir/-7.952639,112.6079458/Pos+Bea+Dan+Cukai+Kantor+Pos+Malang,+Jl.+Merdeka+Selatan+No.5,+Kauman,+Kec.+Klojen,+Kota+Malang,+Jawa+Timur+65119/@-7.9673854,112.602285,14z/data=!3m1!4b1!4m9!4m8!1m1!4e1!1m5!1m1!1s0x2dd62818473f66bf:0x1bd19598ac365460!2m2!1d112.6301991!2d-7.9835724'">
                        <div class="container">
                            <div class="row">
                                <div class="col-xl-12">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 border-left">
                <div class="col-lg-12 offset-lg-12">
                    <div class="media contact-info">
                        <span class="contact-info__icon"><i class="ti-home"></i></span>
                        <div class="media-body">
                            <h3>Hanggar Pabean dan Cukai VI | Kantor Pos Malang</h3>
                            <a target="_blank()"
                                href="https://www.google.com/maps/dir/-7.952639,112.6079458/Pos+Bea+Dan+Cukai+Kantor+Pos+Malang,+Jl.+Merdeka+Selatan+No.5,+Kauman,+Kec.+Klojen,+Kota+Malang,+Jawa+Timur+65119/@-7.9673854,112.602285,14z/data=!3m1!4b1!4m9!4m8!1m1!4e1!1m5!1m1!1s0x2dd62818473f66bf:0x1bd19598ac365460!2m2!1d112.6301991!2d-7.9835724'">
                                <p>Alamat: Jl. Merdeka Selatan No.5, Kauman, Kec. Klojen, Kota Malang, Jawa Timur 65119
                                </p>
                            </a>
                        </div>
                    </div>
                    <div class="media contact-info">
                        <span class="contact-info__icon"><i class="ti-tablet"></i></span>
                        <div class="media-body">
                            <h3>
                                <a href="https://api.whatsapp.com/send?phone=<?php echo "+62" .$noPottong; ?>&text=Halo"
                                    target="_blank">
                                    <?php echo $no_hp;?>
                                </a>
                            </h3>
                            <p>Senin sampai Sabtu 8am to 5pm</p>
                        </div>
                    </div>
                    <div class="media contact-info">
                        <span class="contact-info__icon"><i class="ti-email"></i></span>
                        <div class="media-body">
                            <h3>informasi_kppbcmalang@ymail.com</h3>
                            <p>Send us your query anytime!</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
    </div>
</section>
<!-- ================ contact section end ================= -->

<!-- footer start -->
<?php 
    include 'footer.php';
?>