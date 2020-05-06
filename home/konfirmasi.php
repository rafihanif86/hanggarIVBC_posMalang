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
    
    $no_tracking ="";
    $tgl_input = "";
    $nama="";
    $nik="";
    $npwp="";
    $no_hp="";
    $status="";
    $statusIn="";
    $keterangan="";
    $total_invoice="";
    $tgl_proses = "";
    $petugas = "";

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
        $query = "SELECT count(no_cn) as jumlahData FROM penerima_npd where no_cn = '$no_tracking';";
        $result = mysqli_query($conn,$query);
        while ($row=mysqli_fetch_array($result)){
        $jumlahData = $row["jumlahData"]; 
        }

        if($jumlahData == 0){
            $hidden_data = "";
            $disabeledTracking = "disabled";
            $hiddenTracking = "hidden";
            $editStatus="no";
        }else if($jumlahData == 1){
            $hidden_data = "";
            $hidden_foto = "";
            $disabeledTracking = "disabled";
            $hiddenTracking = "hidden";
            $hidden_tgl_input = "";
            $disabeled_data="disabled";
            $hidden_input_button = "hidden";
            $hidden_edit_button = "";
            $data_alert="Click Untuk Mengubah Data ";
            $editStatus="no";
            $hidden_proses = "";

            $query = "SELECT * FROM penerima_npd where no_cn = '$no_tracking';";
            $result = mysqli_query($conn,$query);
            while ($row=mysqli_fetch_array($result)){
                $nama = $row["nama_penerima"];
                $nik = $row["nik"];
                $npwp = $row["npwp"];
                $no_hp = $row["no_hp"];
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

            $jumlahFoto = -1;
            $query = "SELECT count(no_cn) as jumlahData FROM konfirmasi_foto_invoice where no_cn = '$no_tracking';";
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
    if(isset($_POST["btnTambahFoto"])){
        $hiddenFormFoto = "";
        $hiddenButtonFoto = "hidden";
    }

    if(isset($_POST["btnData"])){
        $no_tracking=$_POST["noTracking"];
        $nama=$_POST["nama"];
        $nik=$_POST["nik"];
        $npwp=$_POST["npwp"];
        $no_hp=$_POST["no_hp"];
        $keterangan=$_POST["keterangan"];
        $total_invoice=$_POST["total_invoice"];
        $editStatus = $_POST["editStatus"];
        $sql_insert1=null;
        $note ="";
        if($editStatus == "no"){
            $tgl_input = date('yy-m-d H:i:s');
            $statusIn = "belum_diproses";
            $query="INSERT INTO penerima_npd set no_cn = '$no_tracking', nama_penerima = '$nama', nik = '$nik', npwp = '$npwp', no_hp = '$no_hp', proses = '$statusIn', 
            keterangan ='$keterangan', total_invoice = '$total_invoice', tgl_input = '$tgl_input'";
            $sql_insert1 = mysqli_query($conn,$query);
            $note = "Tambahkan";
        }else if($editStatus == "yes"){

            $query="UPDATE penerima_npd set nama_penerima = '$nama', nik = '$nik', npwp = '$npwp', no_hp = '$no_hp',
            keterangan ='$keterangan', total_invoice = '$total_invoice' where no_cn = '$no_tracking';";
            $sql_insert1 = mysqli_query($conn,$query);
            $note = "Diubah";
        }

        if($sql_insert1){
            $data_alert="Data berhasil" .$note;
            $disabeled_data="disabled";
            $hidden_input_button = "hidden";
            $hidden_edit_button = "";
            $hidden_foto = "";
        }else{
            $data_alert="Data gagal" .$note;
        }
    }

    if(isset($_POST["btnEdit"])){
        $disabeled_data="";
        $hidden_input_button = "";
        $hidden_edit_button = "hidden";
        $editStatus="yes";
        $disabled_status = "";
        $data_alert = "Click Untuk Menyimpan Data";
        $hidden_tgl_input = "hidden";
    }

    if(isset($_POST["btnFoto"])){
        $no_tracking=$_POST["noTracking"];
        $keteranganFoto=$_POST["keteranganFoto"];
        
        $file_name = $_FILES['namaFile']['name'];
        $tmp_name = $_FILES['namaFile']['tmp_name'];				
        $alert_move = move_uploaded_file($tmp_name, "../administrator/images/".$file_name);
        
        if($alert_move){
            $query="INSERT INTO konfirmasi_foto_invoice set no_cn = '$no_tracking', nama_foto = '$file_name', keterangan_invoice = '$keteranganFoto';";
            $sql_insert1 = mysqli_query($conn,$query);
            if($sql_insert1){
                $foto_alert="Data berhasil disimpan";
                $namaFile="";
                $keteranganFoto="";
                $hiddenButtonFoto = "";
            }else{
                $foto_alert="Data gagal disimpan";
            }
        }else{
            $foto_alert="Data gagal diupload";
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
        </div><!-- /.container-fluid -->
    </section>

    <br />
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
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
                                        <?php echo $disabeledTracking; ?>>
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
        </div><!-- /.container-fluid -->
    </section>

    <br />
    <!-- Main content -->
    <section class="content" <?php echo $hidden_data; ?>>
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Data Penerima Barang Impor dan Keterangan lain</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="konfirmasi.php" method="post" merk="frm" enctype="multipart/form-data"
                            class="form-horizontal">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Nama Penerima</label>
                                            <input type="text" name="nama" class="form-control"
                                                placeholder="Nama Penerima Barang" value="<?php echo $nama; ?>"
                                                <?php echo $disabeled_data; ?>>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">NIK</label>
                                            <input type="number" name="nik" class="form-control"
                                                placeholder="NIK Penerima" value="<?php echo $nik; ?>"
                                                <?php echo $disabeled_data; ?>>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Nomor Whatsapp / Telepon</label>
                                            <div class="input-group">
                                                <input type="number" name="no_hp" class="form-control"
                                                    placeholder=" Nomor Whatsapp Penerima" value="<?php echo $no_hp; ?>"
                                                    <?php echo $disabeled_data; ?>>
                                            </div>
                                            <small class="help-block form-text">Masukkan nomor Whatsapp anda agar
                                                    kami lebih mudah untuk konfirmasi kepada anda.</small>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">NPWP</label>
                                            <input type="number" name="npwp" class="form-control"
                                                placeholder="NPWP Penerima" value="<?php echo $npwp; ?>"
                                                <?php echo $disabeled_data; ?>>
                                            <small class="help-block form-text">Masukkan NPWP Jika Memiliki</small>
                                        </div>
                                    </div>
                                    <div class="col-sm">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Total Invoice</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Rp.</span>
                                                </div>
                                                <input type="number" name="total_invoice" class="form-control"
                                                    placeholder="total invoice pembelian"
                                                    value="<?php echo $total_invoice; ?>"
                                                    <?php echo $disabeled_data; ?>>
                                                <div class="input-group-append">
                                                    <span class="input-group-text">,00</span>
                                                </div>
                                            </div>
                                            <small class="help-block form-text">Dalam satuan Rupiah (Rp)</small>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Keterangan dan Deskribsi Barang
                                                Anda</label>
                                            <input type="text" name="keterangan" class="form-control"
                                                placeholder="keterangan invoice barang"
                                                value="<?php echo $keterangan; ?>" <?php echo $disabeled_data; ?>>
                                        </div>
                                        <div class="form-group" <?php echo $hidden_tgl_input;?>>
                                            <label for="exampleInputPassword1">Tanggal pengisian</label>
                                            <input type="datetime" name="tgl_input" class="form-control"
                                                value="<?php echo $tgl_input; ?>" <?php echo $disabeled_data; ?>>
                                        </div>
                                        <div class="form-group" <?php if($tgl_proses == null){echo "hidden";}?>>
                                            <label for="exampleInputPassword1">Tanggal Diproses</label>
                                            <input type="datetime" name="tgl_proses" class="form-control"
                                                value="<?php echo $tgl_proses; ?>" <?php echo $disabeled_data; ?>>
                                        </div>

                                    </div>
                                </div>
                                <input type="hidden" name="noTracking" class="form-control"
                                    value="<?php echo $no_tracking; ?>">
                                <input type="hidden" name="editStatus" class="form-control"
                                    value="<?php echo $editStatus; ?>">
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer" style="text-align: right;">
                                <label for="exampleInputPassword1"
                                    style="float: left;"><?php echo $data_alert; ?></label>
                                <button type="submit" class="btn btn-primary" name="btnData"
                                    <?php echo $hidden_input_button; ?>>Simpan</button>
                        </form>
                        <form action="konfirmasi.php" method="post" merk="frm" enctype="multipart/form-data"
                            class="form-horizontal">
                            <input type="hidden" name="noTracking" class="form-control"
                                value="<?php echo $no_tracking; ?>">
                            <button type="submit" class="btn btn-primary" name="btnEdit"
                                <?php echo $hidden_edit_button; ?>>Ubah</button>
                        </form>
                    </div><!-- /.card -->
                </div>
                <!--/.col (right) -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </section><!-- /.content -->


    <br />
    <!-- Main content -->
    <section class="content" <?php echo $hidden_foto; ?>>
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Lampirkan Bukti Faktur Barang Anda Serta Berikan Keterangan</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="konfirmasi.php" method="post" merk="frm" enctype="multipart/form-data"
                            class="form-horizontal">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm" <?php echo $hiddenFormFoto; ?>>
                                        <div class="form-group">
                                            <label for="exampleInputFile">Unggah Bukti Faktur</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="exampleInputFile"
                                                        name="namaFile" value="<?php echo $namaFile; ?>">
                                                    <label class="custom-file-label" for="exampleInputFile">Choose
                                                        file</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm" <?php echo $hiddenFormFoto; ?>>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Keterangan Keterangan Bukti Faktur</label>
                                            <input type="text" class="form-control" id="exampleInputEmail1"
                                                placeholder="berikan keterangan foto invoice" name="keteranganFoto"
                                                value="<?php echo $keteranganFoto; ?>">
                                        </div>
                                    </div>
                                </div>
                                <input type="text" name="noTracking" class="form-control"
                                    value="<?php echo $no_tracking; ?>" hidden>
                                <button type="submit"  class="btn btn-primary float-right" name="btnFoto"
                                    <?php echo $hiddenFormFoto;?>>Simpan</button>
                        </form>
                        <form action="konfirmasi.php" method="post" merk="frm" enctype="multipart/form-data"
                            class="form-horizontal">
                            <input type="hidden" name="noTracking" class="form-control"
                                value="<?php echo $no_tracking; ?>">
                            <button type="submit" class="btn btn-primary float-right" name="btnTambahFoto"
                                <?php echo $hiddenButtonFoto; ?>>Tambahkan Bukti faktur</button>
                        </form>
                        <div class="alert alert-warning" role="alert"
                            <?php if($foto_alert == "" || $hiddenButtonFoto = "hidden"){echo 'hidden';}?>>
                            <label for="exampleInputPassword1" class="float-left"><?php echo $foto_alert; ?></label>
                            <form action="konfirmasi.php" method="post" merk="frm" enctype="multipart/form-data"
                                class="form-horizontal">
                                <input type="hidden" name="noTracking" class="form-control"
                                    value="<?php echo $no_tracking; ?>">
                                <button type="submit" class="btn btn-primary float-right" name="btnTracking">Reload</button>
                            </form>
                        </div>
                        <br/>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">

                        <div class="card-body" <?php echo $hidenDataFoto;?>>
                            <!-- <div <div class="card-footer" style="overflow-x: scroll;"> -->
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th width="60%">Foto</th>
                                        <th>Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($row1=mysqli_fetch_array($result1)){ ?>
                                    <tr>
                                        <td><img src="../administrator/images/<?php echo $row1["nama_foto"]; ?>"
                                                class="img-fluid"
                                                alt="../administrator/images/<?php echo $row1["nama_foto"]; ?>"></td>
                                        <td><?php echo $row1["keterangan_invoice"]; ?></td>
                                        <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div><!-- /.card -->
                </div>
                <!--/.col (right) -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>

    <br />
    <section class="content" <?php echo $hidden_foto; ?>>
        <div class="container-fluid">
            <a href="konfirmasi.php" class="btn btn-primary" role="button" aria-pressed="true" style="float: center;">
                Selesai </a>
        </div>
    </section>
    <br />

</div><!-- content-wrapper -->

<?php
    include 'footer.php';
?>