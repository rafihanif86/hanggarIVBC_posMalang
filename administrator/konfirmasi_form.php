<?php
    $nav_active = "konfirmasi";
    $act = "form";
    include('header.php');
    include('connection.php');
    
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
    $hidden_proses_button = "hidden";
    $status_ubah = "";
    $nama_petugas = "";
    
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

    if(isset($_POST["noTracking"]) || isset($_GET["n"])){
        if(isset($_POST["noTracking"])){
            $no_tracking=$_POST["noTracking"];
        }else if(isset($_GET["n"])){
            $no_tracking=base64_decode($_GET["n"]);
        }
    }

    if($no_tracking != ""){
        $query = "select count(no_cn) as jumlahData from data_barang_faktur where no_cn = '$no_tracking';";
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
            $hidden_proses_button = "";

            $query = "select d.*, p.nama, p.no_npwp, p.no_hp, p.email, p.foto_ktp from data_barang_faktur d, penerima p where d.no_cn = '$no_tracking' and p.nik = d.nik;";
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

            $query = "select count(id) as jumlahData from konfirmasi_foto_invoice where no_cn = '$no_tracking';";
            $result = mysqli_query($conn,$query);
            while ($row=mysqli_fetch_array($result)){
                $jumlahFoto = $row["jumlahData"]; 
            }

            if($jumlahFoto > 0){
                $query1 = "select * from konfirmasi_foto_invoice where no_cn = '$no_tracking';";
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
            $query="insert into penerima set nama = '$nama', nik = '$nik',email = '$email', no_npwp = '$npwp', no_hp = '$no_hp';";
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
                            $query2="update penerima set foto_ktp = '$file_name' where nik = '$nik';";
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
        $status_ubah=$_POST["status_ubah"];
        
        $jumlahFile = count($_FILES['namaFile']['name']);
        if($jumlahFile > 0){
            if($status_ubah != "true"){
                $query="insert into data_barang_faktur set no_cn = '$no_tracking', nik= '$nik', proses = 'belum_diproses', total_invoice = '$total_invoice', keterangan = '$keterangan';";
                $sql_insert1 = mysqli_query($conn,$query);
            }else if($status_ubah == "true"){
                $query="update data_barang_faktur set  total_invoice = '$total_invoice', keterangan = '$keterangan' where no_cn = $no_tracking;";
                $sql_insert1 = mysqli_query($conn,$query);
            }
        }else{
            echo "<script type='text/javascript'> window.onload = function(){ alert('Anda Harus Melampirkan Foto Invoice Barang Import Anda'); } </script>";
        }

        if($sql_insert1 || $status_ubah == "true" || $jumlahFile > 0){
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
                    $query="insert into konfirmasi_foto_invoice set no_cn = '$no_tracking', nama_foto = '$namafile';";
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
            $query1 = "select * from konfirmasi_foto_invoice where no_cn = '$no_tracking';";
            $result1 = mysqli_query($conn,$query1);
        }else{
            echo "<script type='text/javascript'> window.onload = function(){ alert('Data Gagal Ditambahkan'); } </script>";
        }
        
    }

    if($nik != ""){
        $query = "select * from penerima where nik = '$nik';";
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

    if(isset($_POST["btnProses"])){
        include_once 'send_notifikasi_sender.php';

        $email_petugas = $_SESSION['email'];
        $res1=mysqli_query($conn,"select * from akun_admin where email = $email_petugas;");
        while ($row1=mysqli_fetch_array($res1)){
            $id_petugas      =   $row1["id"];
        }

        $timestamp = 1234567890;
        $stringDate = date('d-m-Y H:i', $timestamp);

        $status_proses = "";
        if($status == "telah_diproses"){
            $status_proses = "belum_diproses";
            $id_petugas = "";
            $stringDate = "";
        }else if($status == "belum_diproses"){
            $status_proses = "telah_diproses";
        }

        $query="update data_barang_faktur set proses = '$status_proses', petugas_pemeriksa = '$id_petugas', tgl_proses = '$stringDate'  where no_cn = $no_tracking;";
        $sql_insert1 = mysqli_query($conn,$query);
        echo "<script>alert('Data Berhasil Diubah')
            location.replace('tampil_alat.php?id_alat=$id_alat')</script>";
        
        $res1=mysqli_query($conn,"select p.`nama`, p.`email` from `data_barang_faktur` d, `penerima` p where p.`nik` = d.`nik` and d.`no_cn` = $no_tracking;");
        while ($row1=mysqli_fetch_array($res1)){
            $nama_penerima      =   $row1["nama"];
            $email_penerima      =   $row1["email"];
        }
        $sapa = "";
        date_default_timezone_set('Asia/Jakarta');
        $jam=date("H:i:s");
        $a = date ("H");
        if (($a>=6) && ($a<=11)){
            $sapa = "Selamat Pagi ".$nama_penerima."/n";
        } else if(($a>11) && ($a<=15)) {
            $sapa = "Selamat Siang ".$nama_penerima."/n";
        } else if (($a>15) && ($a<=18)){
            $sapa = "Selamat Sore ".$nama_penerima."/n";
        } else { 
            $sapa = "Selamat Malam ".$nama_penerima."/n";
        }

        $message = $sapa."Barang impor anda dengan nomor tracking ".$$no_tracking." telah diproses perpajakan oleh petugas kami. Anda bisa mengambil barang import anda diloket kantor pos dengan membawa ktp anda./n Terima kasih.";
        $subject = "Bea Cukai Kantor Pos Malang";
        send_mail($nama_penerima,$email_penerima,$subject,$message);
        
        
    }

    if(isset($_POST["btnUpdate"])){
        $status_ubah = "true";
        $disabeled_data2 = "";
    }

?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">

            <div class="row">
                <div class="col-md-6">
                    <h1>Form Konfirmasi Barang</h1>
                </div>
                <div class="col-md-6">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item ">Konfirmasi Barang NPD</li>
                            <li class="breadcrumb-item active">Form</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <br/>

            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card">
                        <div class="card-header">
                            <h3 class="card-title">Tracking Nomor CN</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="konfirmasi_form.php" method="post" merk="frm" enctype="multipart/form-data"
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
                        <form action="konfirmasi_form.php" method="post" merk="frm" enctype="multipart/form-data"
                            class="form-horizontal">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Nomor Tanda Pengenal</label>
                                    <?php 
                                        if($nik == ""){
                                    ?>
                                    <input type="number" name="nik1" class="form-control"
                                        placeholder="Nomor Tanda Pengenal (KTP / SIM / Passport)"
                                        value="<?php echo $nik; ?>" required>
                                    <small class="help-block form-text">Anda bisa menggunakan nomor KTP / SIM /
                                        Passport</small>
                                    <?php
                                        }else{echo $nik;}
                                    ?>
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

            <div class="row" <?php echo $hidden_data; ?>>
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card">
                        <div class="card-header">
                            <h3 class="card-title">Data Penerima Barang Impor</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="konfirmasi_form.php" method="post" merk="frm" enctype="multipart/form-data"
                            class="form-horizontal">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Nomor Tanda Pengenal</label>
                                            <div class="input-group">
                                                <input type="number" name="" class="form-control"
                                                    placeholder="Nomor Tanda Pengenal (KTP / SIM / Passport)" value="<?php echo $nik; ?>" disabled>
                                                <div class="input-group-append">
                                                    <span class="input-group-text">
                                                        <a href="penerima_detail.php?q=<?php echo base64_encode($nik); ?>">
                                                            <i class="fa fa-external-link-alt fa-1x"></i>
                                                        </a>
                                                    </span>
                                                </div>
                                            </div>
                                            <input type="hidden" name="nik" class="form-control" placeholder=""
                                                value="<?php echo $nik; ?>">
                                            <?php if($disabeled_data != "disabled"){?>
                                                <small class="help-block form-text">Anda bisa menggunakan nomor KTP / SIM /
                                                    Passport</small>
                                            <?php } ?>
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
                                                <?php if($no_hp != ""){ ?>
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">
                                                        <?php $noPottong = substr($no_hp,1);?>
                                                        <a href="https://api.whatsapp.com/send?phone=<?php echo "+62" .$noPottong; ?>&text=Halo"
                                                            target="_blank" class="">
                                                            <i class="fa fa-whatsapp fa-1x"></i>
                                                        </a>
                                                        
                                                        </span>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                            <?php if($disabeled_data != "disabled"){?>
                                            <small class="help-block form-text">Masukkan nomor Whatsapp anda agar
                                                kami lebih mudah untuk konfirmasi kepada anda.</small>
                                            <?php } ?>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">NPWP</label>
                                            <input type="number" name="npwp" class="form-control"
                                                placeholder="NPWP Penerima" value="<?php echo $npwp; ?>"
                                                <?php echo $disabeled_data; ?>>
                                            <?php if($disabeled_data != "disabled"){?>
                                            <small class="help-block form-text">Masukkan NPWP Jika Memiliki. Nama
                                                pemilik NPWP harus sama dengan penerima barang impor</small>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <div class="col-sm">
                                        <div class="form-group">
                                            <label for="exampleInputFile">Unggah Tanda Pengenal</label>
                                            <img id="frame" src="../administrator/images/<?php if ($foto_ktp != "" || !empty($foto_ktp) || $foto_ktp != null) {
                                                            echo $foto_ktp;
                                                        } else {
                                                            echo "no_images_ktp.png";
                                                        } ?>" class="rounded mx-auto d-block img-fluid" alt="Id Card">
                                            <br />
                                            <input type="file" name="namaFile_ktp" placeholder="Choose file"
                                                class="form-control" value="" accept="image/*" capture="camera"
                                                id="camera" <?php if($disabeled_data == "disabled"){echo "hidden";} ?>
                                                required>
                                            <?php if($disabeled_data != "disabled"){?>                                            
                                            <small class="help-block form-text">Lampirkan foto tanda pengenal anda
                                                sesuai nomor tanda pengenal</small>
                                            <?php } ?>
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

            <div class="row" <?php echo $hidden_foto; ?>>
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Keterangan dan Lampiran Bukti Faktur Barang Impor</h3>
                        </div><!-- /.card-header -->
                        <!-- form start -->
                        <form action="konfirmasi_form.php" method="post" merk="frm" enctype="multipart/form-data"
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
                                            <?php if($disabeled_data != "disabled"){?>
                                            <small class="help-block form-text">Masukkan total nominal harga barang
                                                sesuai dengan invoice dijumlah dengan biaya pengiriman, Dalam satuan
                                                Rupiah (Rp)</small>
                                            <?php } ?>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Keterangan dan Deskripsi Barang
                                                Anda</label>
                                            <textarea name="keterangan" class="form-control"
                                                placeholder="keterangan invoice barang" <?php echo $disabeled_data2; ?>
                                                required><?php echo $keterangan; ?></textarea>
                                            <?php if($disabeled_data != "disabled"){?>
                                            <small class="help-block form-text">Masukkan keterangan barang dalam peket
                                                pengiriman, serta harga barang tersebut</small>
                                            <?php } ?>
                                        </div>
                                        <div class="form-group" <?php if($tgl_proses == ""){echo "hidden";}?>>
                                            <label for="exampleInputPassword1">Tanggal Diproses</label>
                                            <input type="datetime" name="tgl_proses" class="form-control"
                                                value="<?php echo $tgl_proses; ?>" <?php echo $disabeled_data2; ?>>
                                        </div>
                                        <?php 
                                            if($petugas != ""){
                                                $query = "select nama from akun_admin where id = '$petugas';";
                                                $result = mysqli_query($conn,$query);
                                                while ($row=mysqli_fetch_array($result)){
                                                    $nama_petugas = $row["nama"]; 
                                                }
                                        ?>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Petugas</label>
                                            <input type="text" class="form-control" value="<?php echo $nama_petugas; ?>" disabled >
                                        </div>
                                        <?php } ?>
                                    </div>
                                    <div class="col-sm">
                                        <div class="form-group">
                                            <label for="exampleInputFile">Unggah Bukti Faktur</label>
                                            <input type="file" name="namaFile[]" placeholder="Choose file"
                                                class="form-control" value="" accept="image/*" capture="camera" required
                                                multiple <?php if($disabeled_data2 == "disabled"){echo "hidden";} ?>>
                                            <?php if($disabeled_data2 != "disabled"){?>
                                            <small class="help-block form-text">Lampiran bukti faktur pembelian barang
                                                impor. Maksimal 1Mb.</small>
                                            <?php } ?>
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
                                                        <?php if($disabeled_data2 !="disabled"){?>
                                                            <a href="delete_foto_invoice.php?no_cn=<?php echo $no_tracking;?>" class="btn btn-primary btn-sm"><i class='fa fa-trash-o fa-1x'> </i></a>
                                                        <?php } ?>
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
                            <div class="card-footer" style="text-align: right;"
                                <?php if($disabeled_data2 == "disabled"){echo "hidden";} ?>>
                                <input type="hidden" name="nik" value="<?php echo $nik; ?>">
                                <input type="hidden" name="status_ubah" value="<?php echo $status_ubah; ?>">
                                <button type="submit" class="btn btn-primary" name="btnFoto">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div><!-- /.row -->

            <div class="row" <?php echo $hidden_proses_button;?>>
                <div class="col-md-12 ">
                    <div class="btn-group ">
                        <form action="konfirmasi_form.php" method="post" merk="frm" enctype="multipart/form-data"
                            class="form-horizontal">
                            <input type="hidden" name="noTracking" class="form-control" value="<?php echo $no_tracking; ?>">
                            <button type="submit" class="btn btn-primary" name="btnProses" ><?php if($status == "telah_diproses"){echo "Batalkan Diproses";}else if($status == "belum_diproses"){echo "Proses Konfirmasi Ini";} ?></button>
                        </form>
                        <button type="button"
                            class="btn btn-primary btn-sm dropdown-toggle dropdown-toggle-split"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <div class="dropdown-menu">
                            <a href="konfirmasi_print.php?n=<?php echo base64_encode($no_tracking);?>"
                                class="dropdown-item" role="button" target="_BLANK" aria-pressed="true">
                                <i class='fas fa-print fa-1x'></i> Print
                            </a>
                            <div class="dropdown-divider"></div>
                            <form action="konfirmasi_form.php" method="post" merk="frm" enctype="multipart/form-data"
                                class="form-horizontal">
                                <input type="hidden" name="noTracking" class="form-control" value="<?php echo $no_tracking; ?>">
                                <button type="submit" class="dropdown-item" name="btnUpdate"><i class='fa fa-pencil fa-1x'></i> Ubah</button>
                            </form>
                            <a href="delete_konfirmasi.php?n=<?php echo base64_encode($no_tracking);?>&a=<?php echo base64_encode($act);?>"
                                class="dropdown-item" role="button" aria-pressed="true">
                                <i class='fa fa-trash-o fa-1x'></i> Hapus
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div><!-- /.container-fluid -->
    </section>
</div>
<!-- /.content-wrapper -->
<?php include('footer.php');?>