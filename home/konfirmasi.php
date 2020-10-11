<?php
    $page = "konfirmasi";
    include('header.php');

    $hidden_data = "hidden";
    $hidden_foto = "hidden";
    $disabeledTracking = "";
    $hiddenTracking = "";
    $hiddenStarus = "hidden";
    $disabled_status = "disabled";
    $keterangan ="";
    $result1 = "";
    $jumlahData = -1;
    $data_alert="";
    $disabeled_data="";
    $hidden_input_button = "";
    $hidden_edit_button = "hidden";
    $hidden_tgl_input ="hidden";
    $editStatus="no";
    $foto_alert="";
    $hidden_proses = "hidden";
    $hidden_input_cari = "hidden";
    $hidden_nik = "hidden";
    $hidden_selesai = "hidden";
    $disabeled_data2 = "";
    $jumlahFoto = 0;
    
    $no_tracking ="";
    $tgl_input = "";
    $nama="";
    $nik="";
    $npwp="";
    $no_hp="";
    $status="";
    $email = "";
    $statusIn="";
    $foto_ktp = "";
    $keterangan="";
    $total_invoice="";
    $tgl_proses = "";
    $petugas = "";
    $hidden_penerima = "";

    $namaFile="";
    $keteranganFoto="";
    $hiddenButtonFoto = "hidden";
    $hidenDataFoto="hidden";
    $hiddenFormFoto = "";

    $actionBoxText="";

    if(isset($_POST["noTracking"]) || isset($_GET["noTracking"])){
        if(isset($_POST["noTracking"])){
            $no_tracking=$_POST["noTracking"];
        }else if(isset($_GET["noTracking"])){
            $no_tracking=$_GET["noTracking"];
        }  
    }

    if($no_tracking != ""){
        $query = "SELECT count(no_cn) as jumlahData FROM data_barang_faktur where no_cn = '$no_tracking';";
        $result = mysqli_query($conn,$query);
        while ($row=mysqli_fetch_array($result)){
        $jumlahData = $row["jumlahData"]; 
        }

        if($jumlahData == 0){
            $hidden_data = "hidden";
            $disabeledTracking = "disabled";
            $hiddenTracking = "hidden";
            $hidden_nik = ""; 
            $hidden_selesai = "hidden";
        }else if($jumlahData == 1){
            $hidden_penerima = "";
            $hidden_data = "";
            $hidden_foto = "";
            $disabeledTracking = "disabled";
            $hiddenTracking = "hidden";
            $hidden_tgl_input = "";
            $disabeled_data="disabled";
            $hidden_input_button = "hidden";
            $hidden_proses = "";
            $hidden_input_cari = "hidden";
            $disabeled_data2 ="disabled";
            $hidden_selesai = "";

            $query = "SELECT d.*, p.nama, p.no_npwp, p.no_hp, p.email, p.foto_ktp FROM data_barang_faktur d, penerima p where d.no_cn = '$no_tracking' and p.nik = d.nik;";
            $result = mysqli_query($conn,$query);
            while ($row=mysqli_fetch_array($result)){
                $nama = $row["nama"];
                $nik = $row["nik"];
                $email = $row["email"];
                $npwp = $row["no_npwp"];
                $no_hp = $row["no_hp"];
                $foto_ktp = $row["foto_ktp"];
                $status = $row["proses"];
                $keterangan = $row["keterangan"];
                $total_invoice = $row["total_invoice"];
                $tgl_input = $row["tgl_input"];
                $tgl_proses = $row["tgl_proses"];
                $petugas = $row["petugas_pemeriksa"];
            }

            if($status == "belum_diproses"){
                $actionBoxText = "Click untuk mengubah data";
            }

            if($status == "telah_diproses"){
                $hidden_proses = "hiddenS";
            }

            $query = "SELECT count(id) as jumlahData FROM konfirmasi_foto_invoice where no_cn = '$no_tracking';";
            $result = mysqli_query($conn,$query);
            while ($row=mysqli_fetch_array($result)){
                $jumlahFoto = $row["jumlahData"]; 
            }

            if($jumlahFoto > 0){
                $query1 = "SELECT * FROM konfirmasi_foto_invoice where no_cn = '$no_tracking';";
                $result1 = mysqli_query($conn,$query1);
                $hiddenButtonFoto = "";
                $hidenDataFoto="";
                $hiddenFormFoto = "hidden";
            }else{            
                $hiddenFormFoto = "";
                $hidenDataFoto = "hidden";
                $hiddenButtonFoto = "hidden";
            }
            
        }else{
            $hidden_data = "hidden";
        }

    }

    if(isset($_POST["btnCari"])){
        $nik=$_POST["nik1"];
    }

    if(isset($_POST["btnTambahFoto"])){
        $hiddenFormFoto = "";
        $hiddenButtonFoto = "hidden";
    }

    if(isset($_POST["btnData"])){
        $no_tracking=$_POST["noTracking"];
        $nama=$_POST["nama"];
        $nik=$_POST["nik"];
        $npwp=$_POST["npwp"];
        $email=$_POST["email"];
        $no_hp=$_POST["no_hp"];
        $sql_insert1 = null;
        $sql_insert2 = null;
        
        if(($nama && $nik && $email && $no_hp) != ""){
            $tgl_input = date('yy-m-d H:i:s');
            $statusIn = "belum_diproses";
            $query="INSERT INTO penerima set nama = '$nama', nik = '$nik',email = '$email', no_npwp = '$npwp', no_hp = '$no_hp';";
            $sql_insert1 = mysqli_query($conn,$query);

            if ($_FILES['namaFile_ktp']['name'] != "") { 
                $file_name = $_FILES['namaFile_ktp']['name'];
                $tmp_name = $_FILES['namaFile_ktp']['tmp_name'];
                $file_size = $_FILES['namaFile_ktp']['size'];
                $jenis_gambar = $_FILES['namaFile_ktp']['type'];
                if($file_name != ""){
                    if($file_size <= 1048576){
                        if($jenis_gambar=="image/jpeg" || $jenis_gambar=="image/jpg" || $jenis_gambar=="image/gif" || $jenis_gambar=="image/x-png"){
                            move_uploaded_file($tmp_name, "../administrator/images/".$file_name);
                            $query2="UPDATE penerima set foto_ktp = '$file_name' where nik = '$nik';";
                            $sql_insert2 = mysqli_query($conn,$query2);
                            $foto_ktp = $file_name;
                        }else{
                            $file_name =  "";
                            $status = "filetype";
                        }
                    }else{
                        $file_name =  "";
                        $status = "bigsize";
                    }
                }
            }
        }else{
            echo "<script type='text/javascript'> window.onload = function(){ alert('Ada data yang kosong'); } </script>";
        }

        if($sql_insert1 && $sql_insert2){
            $disabeled_data="disabled";
            $hidden_input_button = "hidden";
            $hidden_foto = "";
            echo "<script type='text/javascript'> window.onload = function(){ alert('Data Berhasil Ditambahkan'); } </script>";
        }else if(!$sql_insert2){
            if ($status == "bigsize") {
                echo "<script type='text/javascript'> window.onload = function(){  alert('File gambar memiliki ukuran terlalu besar '); } </script>";
            } else if ($status == "filetype") {
                echo "<script type='text/javascript'> window.onload = function(){  alert('File gambar memiliki tipe file tidak diijinkan'); } </script>";
            }
        }else{
            echo "<script type='text/javascript'> window.onload = function(){ alert('Data Gagal Ditambahkan'); } </script>";
        }
    }

    if(isset($_POST["btnFoto"])){
        $no_tracking=$_POST["noTracking"];
        $keterangan=$_POST["keterangan"];
        $nik=$_POST["nik"];
        $total_invoice=$_POST["total_invoice"];
        
        $jumlahFile = count($_FILES['namaFile']['name']);
        if($jumlahFile > 0){
            $query="INSERT INTO data_barang_faktur set no_cn = '$no_tracking', nik= '$nik', proses = 'belum_diproses', total_invoice = '$total_invoice', keterangan = '$keterangan';";
            $sql_insert1 = mysqli_query($conn,$query);
        }else{
            echo "<script type='text/javascript'> window.onload = function(){ alert('Anda Harus Melampirkan Foto Invoice Barang Import Anda'); } </script>";
        }

        if($sql_insert1){
            $limit = 1 * 1024 * 1024; //1MB. Bisa diubah2
            
            $sql_insert3 = true;
            $file_status = true;
            for($i=0; $i<$jumlahFile; $i++){
                $namafile = $_FILES['namaFile']['name'][$i];
                $tmp = $_FILES['namaFile']['tmp_name'][$i];
                $type = $_FILES['namaFile']['type'][$i];
                $error = $_FILES['namaFile']['error'][$i];
                $size = $_FILES['namaFile']['size'][$i];

                //lakukan pengecekan disini
                if($size <= $limit && $error <= 0){
                    //kalau pengecekan sudah selesai, langsung proses
                    move_uploaded_file($tmp, '../administrator/images/'.$namafile);
                    $query="INSERT INTO konfirmasi_foto_invoice set no_cn = '$no_tracking', nama_foto = '$namafile';";
                    $sql_insert2 = mysqli_query($conn,$query);
                    if($sql_insert2 == true && $sql_insert3 == true){
                        $sql_insert3 = true;
                    }else if($sql_insert2 == false || $sql_insert3 == false){
                        $sql_insert3 = false;
                    }
                }else{
                    $file_status = false;
                }
            }
            
            $namaFile="";
            $keteranganFoto="";
            $hiddenButtonFoto = "";
            $disabeled_data2 = "disabled";
            if($sql_insert3 == false){
                echo "<script type='text/javascript'> window.onload = function(){ alert('Lampiran anda tidak terunggah'); } </script>";
            }else if($file_status == false){
                echo "<script type='text/javascript'> window.onload = function(){ alert('Lampiran anda file terlalu besar / file anda error untuk di upload'); } </script>";
            }else{
                echo "<script type='text/javascript'> window.onload = function(){ alert('Data Berhasil Ditambahkan'); } </script>";
            }
            $query1 = "SELECT * FROM konfirmasi_foto_invoice where no_cn = '$no_tracking';";
            $result1 = mysqli_query($conn,$query1);
        }else{
            echo "<script type='text/javascript'> window.onload = function(){ alert('Data Gagal Ditambahkan'); } </script>";
        }
        
    }

    if($nik != ""){
        $query = "SELECT * FROM penerima where nik = '$nik';";
        $result = mysqli_query($conn,$query);
        while ($row=mysqli_fetch_array($result)){
            $nama = $row["nama"];
            $nik = $row["nik"];
            $email = $row["email"];
            $npwp = $row["no_npwp"];
            $no_hp = $row["no_hp"];
            $foto_ktp = $row["foto_ktp"];
        }
        if($nama != "" && $email != "" && $no_hp != ""){
            $hidden_foto = "";
            $disabeled_data="disabled";
            $hidden_data = "";
            $hidden_nik = "hidden";
            $hidden_input_button = "hidden";
        }else{
            $hidden_nik = "hidden";
            $hidden_data = "";
            $disabeled_data="";
            $hidden_input_button = "";
        }
    }
?>

<div style="background-image: url(img/luggage.gif);" class="bradcam_area ">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="bradcam_text text-center">
                    <h3>Konfirmasi</h3>
                    <p>Faktur Barang Impor</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!--/ bradcam_area  -->
<br />
<!-- Content Wrapper. Contains page content -->

<div class="content-wrapper" style="width: 90%; margin: auto;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Form Konfirmasi Barang Impor</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Konfirmasi Barang Impor</a></li>
                        <li class="breadcrumb-item active">Form</li>
                    </ol>
                </div>
            </div>

            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Tracking Nomor CN</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="konfirmasi.php" method="post" merk="frm" enctype="multipart/form-data"
                            class="form-horizontal">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Masukkan Nomor CN</label>
                                    <input type="text" class="form-control" name="noTracking"
                                        placeholder="Nomor Tracking" value="<?php echo $no_tracking; ?>"
                                        <?php echo $disabeledTracking; ?> required>
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer" style="text-align: right;" <?php  echo $hiddenTracking;?>>
                                <button type="submit" class="btn btn-primary" name="btnTracking">Submit</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
                <!--/.col (right) -->
            </div>
            <!-- /.row -->
            <br />

            <div class="row" <?php echo $hidden_nik; ?>>
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Data Penerima Barang Impor</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="konfirmasi.php" method="post" merk="frm" enctype="multipart/form-data"
                            class="form-horizontal">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Nomor Tanda Pengenal</label>
                                    <input type="number" name="nik1" class="form-control"
                                        placeholder="Nomor Tanda Pengenal (KTP / SIM / Passport)"
                                        value="<?php echo $nik; ?>" required>
                                    <small class="help-block form-text">Anda bisa menggunakan nomor KTP / SIM /
                                        Passport</small>
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer" style="text-align: right;">
                                <input type="hidden" name="noTracking" class="form-control"
                                    value="<?php echo $no_tracking; ?>">
                                <button type="submit" class="btn btn-primary" name="btnCari">Cari</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
                <!--/.col (right) -->
            </div>
            <!-- /.row -->
            <br />

            <div class="row" <?php echo $hidden_data; ?>>
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Data Penerima Barang Impor</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="konfirmasi.php" method="post" merk="frm" enctype="multipart/form-data"
                            class="form-horizontal">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Nomor Tanda Pengenal</label>
                                            <input type="number" name="" class="form-control"
                                                placeholder="Nomor Tanda Pengenal (KTP / SIM / Passport)"
                                                value="<?php echo $nik; ?>" disabled>
                                            <input type="hidden" name="nik" class="form-control" placeholder=""
                                                value="<?php echo $nik; ?>">
                                            <small class="help-block form-text">Anda bisa menggunakan nomor KTP / SIM /
                                                Passport</small>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Nama Penerima</label>
                                            <input type="text" name="nama" class="form-control"
                                                placeholder="Nama Penerima" value="<?php echo $nama; ?>"
                                                <?php echo $disabeled_data; ?> required>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Email Penerima</label>
                                            <input type="email" name="email" class="form-control"
                                                placeholder="Email Penerima" value="<?php echo $email; ?>"
                                                <?php echo $disabeled_data; ?> required>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Nomor Whatsapp / Telepon</label>
                                            <div class="input-group">
                                                <input type="number" name="no_hp" class="form-control"
                                                    placeholder=" Nomor Whatsapp Penerima" value="<?php echo $no_hp; ?>"
                                                    <?php echo $disabeled_data; ?> required>
                                            </div>
                                            <small class="help-block form-text">Masukkan nomor Whatsapp anda agar
                                                kami lebih mudah untuk konfirmasi kepada anda.</small>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">NPWP</label>
                                            <input type="number" name="npwp" class="form-control"
                                                placeholder="NPWP Penerima" value="<?php echo $npwp; ?>"
                                                <?php echo $disabeled_data; ?>>
                                            <small class="help-block form-text">Masukkan NPWP Jika Memiliki. Nama
                                                pemilik NPWP harus sama dengan penerima barang impor</small>
                                        </div>
                                    </div>
                                    <div class="col-sm">
                                        <div class="form-group">
                                            <label for="exampleInputFile">Unggah Tanda Pengenal</label>
                                            <img id="frame" src="../administrator/images/<?php if ($foto_ktp != "" || !empty($foto_ktp) || $foto_ktp != null) {
                                                            echo $foto_ktp;
                                                        } else {
                                                            echo "no_images_ktp.png";
                                                        } ?>" class="rounded mx-auto d-block" alt="Id Card"
                                                style="max-height: 20rem;">
                                            <br />
                                            <input type="file" name="namaFile_ktp"
                                                placeholder="Choose file" class="form-control" value="" accept="image/*"
                                                capture="camera" id="camera" <?php if($disabeled_data == "disabled"){echo "hidden";} ?> required>
                                            <small class="help-block form-text">Lampirkan foto tanda pengenal anda
                                                sesuai nomor tanda pengenal</small>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="noTracking" class="form-control"
                                    value="<?php echo $no_tracking; ?>">
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer" style="text-align: right;" <?php echo $hidden_input_button; ?>>
                                <button type="submit" class="btn btn-primary" name="btnData">Simpan</button>
                            </div>
                        </form>
                    </div><!-- /.card -->
                </div>
            </div><!-- /.row -->
            <br />

            <div class="row" <?php echo $hidden_foto; ?>>
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Keterangan dan Lampiran Bukti Faktur Barang Impor</h3>
                        </div><!-- /.card-header -->
                        <!-- form start -->
                        <form action="konfirmasi.php" method="post" merk="frm" enctype="multipart/form-data"
                            class="form-horizontal">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Nomor Tracking</label>
                                            <input type="text" class="form-control" value="<?php echo $no_tracking; ?>"
                                                disabled>
                                            <input type="hidden" name="noTracking" class="form-control"
                                                value="<?php echo $no_tracking; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Total Invoice</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Rp.</span>
                                                </div>
                                                <input type="number" name="total_invoice" class="form-control"
                                                    placeholder="total invoice pembelian"
                                                    value="<?php echo $total_invoice; ?>"
                                                    <?php echo $disabeled_data2; ?> required>
                                                <div class="input-group-append">
                                                    <span class="input-group-text">,00</span>
                                                </div>
                                            </div>
                                            <small class="help-block form-text">Masukkan total nominal harga barang
                                                sesuai dengan invoice dijumlah dengan biaya pengiriman, Dalam satuan
                                                Rupiah (Rp)</small>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Keterangan dan Deskripsi Barang
                                                Anda</label>
                                            <textarea name="keterangan" class="form-control"
                                                placeholder="keterangan invoice barang" <?php echo $disabeled_data2; ?>
                                                required><?php echo $keterangan; ?></textarea>
                                            <small class="help-block form-text">Masukkan keterangan barang dalam peket
                                                pengiriman, serta harga barang tersebut</small>
                                        </div>
                                        <div class="form-group" <?php if($tgl_proses == null){echo "hidden";}?>>
                                            <label for="exampleInputPassword1">Tanggal Diproses</label>
                                            <input type="datetime" name="tgl_proses" class="form-control"
                                                value="<?php echo $tgl_proses; ?>" <?php echo $disabeled_data2; ?>>
                                        </div>
                                    </div>
                                    <div class="col-sm">
                                        <div class="form-group">
                                            <label for="exampleInputFile">Unggah Bukti Faktur</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="exampleInputFile"
                                                        name="namaFile[]" value="<?php echo $namaFile; ?>" required multiple <?php echo $disabeled_data2; ?>>
                                                    <label class="custom-file-label" for="exampleInputFile">Choose
                                                        file</label>
                                                </div>
                                            </div>
                                        </div>
                                        <?php if($jumlahFoto > 0){ ?>
                                        <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
                                            <ol class="carousel-indicators">
                                                <?php 
                                                    for($i = 0; $i < $jumlahFoto; $i++){
                                                        if($i == 0){
                                                            echo '<li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>';
                                                        }else{
                                                            echo '<li data-target="#carouselExampleCaptions" data-slide-to="'.$i.'"></li>';
                                                        }
                                                    }
                                                ?>
                                            </ol>
                                            <div class="carousel-inner">
                                                <?php 
                                                    $i = 0;
                                                    while ($row1=mysqli_fetch_array($result1)){ 
                                                    $i++;
                                                ?>
                                                <div class="carousel-item <?php if($i == 1){echo 'active';} ?>">
                                                    <img class="d-block w-100" style="max-height: 45rem;"
                                                        src="../administrator/images/<?php echo $row1["nama_foto"]; ?>"
                                                        alt="Lampiran Faktur">
                                                    <div class="carousel-caption d-none d-md-block text-white"
                                                        style="background-color: rgba(69, 59, 59, 0.5)">
                                                        <p class="text-white"><?php echo $row1["nama_foto"]; ?></p>
                                                    </div>
                                                </div>
                                                <?php } ?>
                                            </div>
                                            <a class="carousel-control-prev" href="#carouselExampleCaptions"
                                                role="button" data-slide="prev">
                                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                <span class="sr-only">Previous</span>
                                            </a>
                                            <a class="carousel-control-next" href="#carouselExampleCaptions"
                                                role="button" data-slide="next">
                                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                <span class="sr-only">Next</span>
                                            </a>
                                        </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div><!-- /.card-body -->
                            <div class="card-footer" style="text-align: right;" <?php if($disabeled_data2 == "disabled"){echo "hidden";} ?>>
                                <input type="hidden" name="nik" value="<?php echo $nik; ?>">
                                <button type="submit" class="btn btn-primary" name="btnFoto">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div><!-- /.row -->
            <br />

            <div class="row" <?php echo $hidden_selesai; ?>>
                <!-- left column -->
                <div class="col-md-12">
                    <a href="konfirmasi.php" class="btn btn-primary" role="button" aria-pressed="true"
                        style="float: center;"> Selesai </a>
                </div>
            </div>
            <br />

        </div><!-- /.container-fluid -->
    </section>
</div><!-- content-wrapper -->

<script>
var camera = document.getElementById('camera');
var frame = document.getElementById('frame');

camera.addEventListener('change', function(e) {
    var file = e.target.files[0];
    // Do something with the image file.
    frame.src = URL.createObjectURL(file);
});

function reset() {
    frame.src = "";
}
</script>

<?php include 'footer.php'; ?>