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
            $tgl_input = $_POST["tgl_input"];
            $statusIn=$_POST["proses"];
            $tgl_proses = $_POST["tgl_proses"];

            if($statusIn == "telah_diproses" && $tgl_proses == null){
                $tgl_proses = date('yy-m-d H:i:s'); 
            }else if($statusIn == "belum_diproses"){
                $tgl_proses = "";
                $id_petugas = "";
            }

            $query="UPDATE penerima_npd set nama_penerima = '$nama', nik = '$nik', npwp = '$npwp', no_hp = '$no_hp', proses = '$statusIn', 
            keterangan ='$keterangan', total_invoice = '$total_invoice', tgl_proses = '$tgl_proses', petugas_pemeriksa = '$nip_akun' where no_cn = '$no_tracking';";
            $sql_insert1 = mysqli_query($conn,$query);
            $note = "Diubah";
        }

        if($sql_insert1){
            $data_alert="Data berhasil" .$note;
            $disabeled_data="disabled";
            $hidden_input_button = "hidden";
            $hidden_edit_button = "";
            $hidden_foto = "";
            echo "<META HTTP-EQUIV='Refresh' Content='0; URL=konfirmasi_form.php?noTracking=$no_tracking'>";
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

    if(isset($_POST["btnProses"])){

        $statusIn=$_POST["proses"];
        $tgl_proses="";

        if($statusIn == "telah_diproses" && $tgl_proses == null){
            $tgl_proses = date('yy-m-d H:i:s');
        }else if($statusIn == "belum_diproses"){
            $tgl_proses = "";
            $id_petugas = "";
        }

        $query="UPDATE penerima_npd set proses = '$statusIn', tgl_proses = '$tgl_proses', petugas_pemeriksa = '$nip_akun' where no_cn = '$no_tracking';";
        $sql_insert1 = mysqli_query($conn,$query);
        // header("Location:konfirmasi_form.php?noTracking=$no_tracking");
        echo "<META HTTP-EQUIV='Refresh' Content='0; URL=konfirmasi_form.php?noTracking=$no_tracking'>";
    }

    if(isset($_POST["btnFoto"])){
        $no_tracking=$_POST["noTracking"];
        $keteranganFoto=$_POST["keteranganFoto"];
        
        $file_name = $_FILES['namaFile']['name'];
        $tmp_name = $_FILES['namaFile']['tmp_name'];				
        move_uploaded_file($tmp_name, "images/".$file_name);
        
        $query="INSERT INTO konfirmasi_foto_invoice set no_cn = '$no_tracking', nama_foto = '$file_name', keterangan_invoice = '$keteranganFoto';";
        $sql_insert1 = mysqli_query($conn,$query);
        if($sql_insert1){
            $foto_alert="Data berhasil disimpan";
            $namaFile="";
            $keteranganFoto="";
            echo "<META HTTP-EQUIV='Refresh' Content='0; URL=konfirmasi_form.php?noTracking=$no_tracking'>";
        }else{
            $foto_alert="Data gagal disimpan";
        }
    }



?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Form Konfirmasi Barang</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Konfirmasi Barang NPD</a></li>
                        <li class="breadcrumb-item active">Form</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid" >
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
                        <form action="konfirmasi_form.php" method="post" merk="frm" enctype="multipart/form-data"class="form-horizontal">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Masukkan Nomor CN</label>
                                    <input type="text" class="form-control" name="noTracking"
                                        placeholder="Nomor Tracking" value="<?php echo $no_tracking; ?>" <?php echo $disabeledTracking; ?>>
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer" style="text-align: right;" <?php  echo $hiddenTracking;?> >
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

    <!-- Main content -->
    <section class="content" <?php echo $hidden_data; ?>>
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Data Invoice dan Keterangan lain</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="konfirmasi_form.php" method="post" merk="frm" enctype="multipart/form-data"class="form-horizontal">
                            <div class="card-body" >
                                <div class="row">
                                    <div class="col-sm">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Nama Penerima</label>
                                            <input type="text" name="nama" class="form-control"
                                                placeholder="Nama Penerima Barang" value="<?php echo $nama; ?>" <?php echo $disabeled_data; ?>>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">NIK</label>
                                            <input type="number" name="nik" class="form-control"
                                                placeholder="NIK Penerima" value="<?php echo $nik; ?>" <?php echo $disabeled_data; ?>>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Nomor Whatsapp</label>
                                            <div class="input-group">
                                            <input type="number" name="no_hp" class="form-control"
                                                placeholder=" Nomor Whatsapp Penerima" value="<?php echo $no_hp; ?>" <?php echo $disabeled_data; ?>>
                                                <div class="input-group-append" <?php echo $hidden_edit_button; ?>>
                                                    <?php $noPottong = substr($no_hp,1);?>
                                                    <a href="https://api.whatsapp.com/send?phone=<?php echo "+62" .$noPottong; ?>&text=Halo" target="_blank" class="btn btn-primary btn-sm">
                                                        <i class="fab fa-whatsapp fa-2x"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">NPWP</label>
                                            <input type="number" name="npwp" class="form-control"
                                                placeholder="NPWP Penerima" value="<?php echo $npwp; ?>" <?php echo $disabeled_data; ?>>
                                            <small class="help-block form-text">Masukkan NPWP Jika Memiliki</small>
                                        </div>
                                    </div>
                                    <div class="col-sm">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Status </label>
                                            <select name="proses" class="form-control" <?php echo $disabled_status; ?>>
                                                <option <?php if($status == 'belum_diproses' || $status == ''){echo 'selected';} ?> 
                                                value="belum_diproses">Belum Diproses</option>
                                                <option <?php if($status == 'telah_diproses'){echo 'selected';} ?> 
                                                value="telah_diproses">Telah Diproses</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Total Invoice</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Rp.</span>
                                                </div>
                                                <input type="number" name="total_invoice" class="form-control"
                                                    placeholder="total invoice pembelian" value="<?php echo $total_invoice; ?>" <?php echo $disabeled_data; ?>>
                                                <div class="input-group-append">
                                                    <span class="input-group-text">,00</span>
                                                </div>
                                            </div>
                                                    <small class="help-block form-text">Dalam satuan Rupiah (Rp)</small>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Keterangan</label>
                                            <input type="text" name="keterangan" class="form-control"
                                                placeholder="keterangan invoice barang" value="<?php echo $keterangan; ?>" <?php echo $disabeled_data; ?>>
                                        </div>
                                        <div class="form-group" <?php echo $hidden_tgl_input;?>>
                                            <label for="exampleInputPassword1">Tanggal pengisian</label>
                                            <input type="datetime" name="tgl_input" class="form-control" value="<?php echo $tgl_input; ?>" <?php echo $disabeled_data; ?>>
                                        </div>
                                        <div class="form-group" <?php if($tgl_proses == null){echo "hidden";}?>>
                                            <label for="exampleInputPassword1">Tanggal pengisian</label>
                                            <input type="datetime" name="tgl_proses" class="form-control" value="<?php echo $tgl_proses; ?>" <?php echo $disabeled_data; ?>>
                                        </div>
                                        <div class="form-group" <?php if($petugas == ""){echo "hidden";}?>>
                                            <label for="exampleInputPassword1">Petugas</label>
                                            <select name="petugas" class="form-control" disabled>
                                                <?php 
                                                    $quer4 = "SELECT * FROM akun_admin;";
                                                    $resu4=mysqli_query($conn,$quer4);
                                                    while ($row4=mysqli_fetch_array($resu4)){
                                                ?>
                                                <option <?php if($petugas == $row4['id']){echo 'selected';} ?> 
                                                value="<?php echo $row4['id']; ?>"><?php echo $row4["nama"]; ?></option>
                                                <?php
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="noTracking" class="form-control" value="<?php echo $no_tracking; ?>">
                                <input type="hidden" name="editStatus" class="form-control" value="<?php echo $editStatus; ?>">
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer" style="text-align: right;">
                                <label for="exampleInputPassword1" style="float: left;"><?php echo $data_alert; ?></label>
                                <button type="submit" class="btn btn-primary" name="btnData" <?php echo $hidden_input_button; ?>>Simpan</button>
                        </form>
                                <form action="konfirmasi_form.php" method="post" merk="frm" enctype="multipart/form-data"class="form-horizontal">
                                    <input type="hidden" name="noTracking" class="form-control" value="<?php echo $no_tracking; ?>">
                                    <button type="submit" class="btn btn-primary" name="btnEdit" <?php echo $hidden_edit_button; ?>>Ubah</button>
                                </form>                        
                            </div>
                    </div>
                    <!-- /.card -->
                </div>
                <!--/.col (right) -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

    <!-- Main content -->
    <section class="content" <?php echo $hidden_foto; ?>>
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Lampirkan Bukti Invoice dan Keterangan</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="konfirmasi_form.php" method="post" merk="frm" enctype="multipart/form-data"class="form-horizontal">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm" <?php echo $hiddenFormFoto; ?>>
                                        <div class="form-group">
                                            <label for="exampleInputFile">Upload Invoice</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="exampleInputFile" name="namaFile" value="<?php echo $namaFile; ?>">
                                                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm" <?php echo $hiddenFormFoto; ?>>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Keterangan foto</label>
                                            <input type="text" class="form-control" id="exampleInputEmail1"
                                                placeholder="berikan keterangan foto invoice" name="keteranganFoto" value="<?php echo $keteranganFoto; ?>">
                                        </div>
                                    </div>
                                </div>
                                <input type="text" name="noTracking" class="form-control" value="<?php echo $no_tracking; ?>" hidden> 
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer" style="text-align: right;">
                                <label for="exampleInputPassword1" style="float: left;"><?php echo $foto_alert; ?></label>
                                    <button type="submit" class="btn btn-primary" name="btnFoto" <?php echo $hiddenFormFoto;?>>Submit</button>
                                </form>
                                <form action="konfirmasi_form.php" method="post" merk="frm" enctype="multipart/form-data"class="form-horizontal">
                                    <input type="hidden" name="noTracking" class="form-control" value="<?php echo $no_tracking; ?>">
                                    <button type="submit" class="btn btn-primary" name="btnTambahFoto" <?php echo $hiddenButtonFoto; ?>>Tambahkan Foto</button>
                                </form>
                            </div>
                        
                        <div class="card-body" <?php echo $hidenDataFoto;?>>
                        <!-- <div <div class="card-footer" style="overflow-x: scroll;"> -->
                            <table id="example1" class="table table-bordered table-striped" >
                                <thead>
                                    <tr>
                                        <th class="w-50 p-3">Foto</th>
                                        <th>Keterangan</th>
                                        <th <?php echo $hidden_input_button;?> width="30px">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($row1=mysqli_fetch_array($result1)){ ?>
                                        <tr>
                                            <td><img src="../administrator/images/<?php echo $row1["nama_foto"]; ?>" class="img-fluid" alt="images/<?php echo $row1["nama_foto"]; ?>" ></td>
                                            <td> <?php echo $row1["keterangan_invoice"]; ?></td>
                                            <td <?php echo $hidden_input_button;?>><a  href="delete_foto_invoice.php?no_cn=<?php echo $row1["no_cn"];?>&id=<?php echo $row1["id"];?>" class="btn btn-primary btn-sm"><i class='fa fa-trash-o fa-1x'></i></a></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
                <!--/.col (right) -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>

    <section class="content float-right" <?php if($status == "telah_diproses" || $hidden_proses == "hidden"){echo "hidden";} ?>>
        <div class="container-fluid fixed-bottom w-50 p-3 " >
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputPassword1" style="float: left;">Click Untuk telah diproses</label>
                                <form action="konfirmasi_form.php" method="post" merk="frm" enctype="multipart/form-data"class="form-horizontal">
                                    <input type="hidden" name="noTracking" class="form-control" value="<?php echo $no_tracking; ?>">
                                    <input type="hidden" name="proses" class="form-control" value="telah_diproses">
                                    <button type="submit" class="btn btn-primary" name="btnProses" style="float: right;">Telah diprooses</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/.col (right) -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>                          

    <?php
        $jumlah_data_konfirmasi = 0;
        $proses_akun = "";
        $query2 = "SELECT count(no_cn) as jumlahData FROM data_barang_npd where no_cn = '$no_tracking';";
        $result2 = mysqli_query($conn,$query2);
        while ($row=mysqli_fetch_array($result2)){
            $jumlah_data_konfirmasi = $row["jumlahData"]; 
        }
    ?>
    <section class="content"
        <?php 
            if($hidden_foto == "hidden" || $jumlah_data_konfirmasi == 0 ){
                echo "hidden";
            }else{ 
                echo "";
            }
        ?>>
        <div class="container-fluid" >
            <a  href="barang_form.php?noTracking=<?php echo $no_tracking;?>" class="btn btn-primary" role="button" aria-pressed="true" style="float: right;"> Data Barang <i class='fas fa-chevron-right fa-1x'></i> </a>
        </div>
    </section>
   

    <br/>
    <br/>
    <br/>

</div>
<!-- /.content-wrapper -->
<?php include('footer.php');?>
    

