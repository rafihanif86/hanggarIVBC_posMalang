<?php
    $nav_active = "barang";
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
    $petugas = "";
    
    $no_tracking ="";
    $nama_penerima = "";
    $alamat_penerima = "";
    $nama_pengirim = "";
    $no_telp_penerima = "";
    $alamat_pengirim = "";
    $kategori_barang = "";
    $total_invoice = "";
    $tgl_input = "";
    $keterangan_barang = "";

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
        $query = "SELECT count(no_cn) as jumlahData FROM data_barang_npd where no_cn = '$no_tracking';";
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

            $query = "SELECT * FROM data_barang_npd where no_cn = '$no_tracking';";
            $result = mysqli_query($conn,$query);
            while ($row=mysqli_fetch_array($result)){
                $nama_penerima = $row["nama_penerima"];
                $alamat_penerima = $row["alamat_penerima"];
                $nama_pengirim = $row["nama_pengirim"];
                $no_telp_penerima = $row["no_telp_penerima"];
                $alamat_pengirim = $row["alamat_pengirim"];
                $kategori_barang = $row["kategori_barang"];
                $keterangan_barang = $row["keterangan_barang"];
                $tgl_input = $row["tgl_pengecekan_barang"];
                $petugas = $row["petugas_pemeriksa"];
            }

            $jumlahFoto = -1;
            $query = "SELECT count(no_cn) as jumlahData FROM data_barang_npd where no_cn = '$no_tracking';";
            $result = mysqli_query($conn,$query);
            while ($row=mysqli_fetch_array($result)){
                $jumlahFoto = $row["jumlahData"]; 
            }

            if($jumlahFoto > 0){
                $query1 = "SELECT * FROM konfirmasi_foto_barang where no_cn = '$no_tracking';";
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
        $nama_penerima = $_POST["nama_penerima"];
        $nama_pengirim = $_POST["nama_pengirim"];
        $alamat_penerima = $_POST["alamat_penerima"];
        $alamat_pengirim = $_POST["alamat_pengirim"];
        $no_telp_penerima=$_POST["no_telp_penerima"];
        $kategori_barang=$_POST["kategori_barang"];
        $keterangan_barang=$_POST["keterangan_barang"];
        $editStatus = $_POST["editStatus"];
        $sql_insert1=null;
        $note ="";

        if($editStatus == "no"){
            $tgl_input = date('yy-m-d H:i:s');

            $query="INSERT INTO data_barang_npd set no_cn = '$no_tracking', nama_penerima = '$nama_penerima', nama_pengirim = '$nama_pengirim', alamat_pengirim = '$alamat_pengirim', alamat_penerima = '$alamat_penerima', no_telp_penerima = '$no_telp_penerima', kategori_barang = '$kategori_barang', keterangan_barang = '$keterangan_barang', 
            tgl_pengecekan_barang ='$tgl_input', petugas_pemeriksa = '$nip_akun';";
            $sql_insert1 = mysqli_query($conn,$query);
            $note = "Tambahkan";
        }else if($editStatus == "yes"){
            $tgl_input = $_POST["tgl_input"];
            $query="UPDATE data_barang_npd set data_barang_npd set nama_penerima = '$nama_penerima', nama_pengirim = '$nama_pengirim', alamat_pengirim = '$alamat_pengirim', alamat_penerima = '$alamat_penerima', no_telp_penerima = '$no_telp_penerima', kategori_barang = '$kategori_barang', keterangan_barang = '$keterangan_barang' where no_cn = '$no_tracking';";
            $sql_insert1 = mysqli_query($conn,$query);
            $note = "Diubah";
        }

        if($sql_insert1){
            $data_alert="Data berhasil " .$note;
            $disabeled_data="disabled";
            $hidden_input_button = "hidden";
            $hidden_edit_button = "";
            $hidden_foto = "";
        }else{
            $data_alert="Data gagal " .$note;
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
        if($file_name != "" || $file_name != null){
            $tmp_name = $_FILES['namaFile']['tmp_name'];				
            move_uploaded_file($tmp_name, "images/".$file_name);

            $query="INSERT INTO konfirmasi_foto_barang set no_cn = '$no_tracking', nama_foto = '$file_name', keterangan_barang = '$keteranganFoto';";
            $sql_insert1 = mysqli_query($conn,$query);
            if($sql_insert1){
                $foto_alert="Data berhasil disimpan";
                $namaFile="";
                $keteranganFoto="";
                echo "<META HTTP-EQUIV='Refresh' Content='0; URL=barang_form.php?noTracking=$no_tracking'>";
            }else{
                $foto_alert="Data gagal disimpan";
            }
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
                    <h1>Form Data Barang NPD</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Data Barang NPD</a></li>
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
                        <form action="barang_form.php" method="post" merk="frm" enctype="multipart/form-data"class="form-horizontal">
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
                            <h3 class="card-title">Data Barang NPD dan Keterangan lain</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="barang_form.php" method="post" merk="frm" enctype="multipart/form-data"class="form-horizontal">
                            <div class="card-body" >
                                <div class="row">
                                    <div class="col-sm">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Nama Penerima</label>
                                            <input type="text" name="nama_penerima" class="form-control"
                                                placeholder="Nama Penerima Barang" value="<?php echo $nama_penerima; ?>" <?php echo $disabeled_data; ?>>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Alamat Penerima</label>
                                            <input type="text" name="alamat_penerima" class="form-control"
                                                placeholder="Alamat Penerima" value="<?php echo $alamat_penerima; ?>" <?php echo $disabeled_data; ?>>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Nomor Whatsapp Penerima</label>
                                            <div class="input-group">
                                            <input type="number" name="no_telp_penerima" class="form-control"
                                                placeholder=" Nomor Whatsapp Penerima" value="<?php echo $no_telp_penerima; ?>" <?php echo $disabeled_data; ?>>
                                                <div class="input-group-append" <?php echo $hidden_edit_button; ?>>
                                                    <?php $noPottong = substr($no_telp_penerima,1);?>
                                                    <a href="https://api.whatsapp.com/send?phone=<?php echo "+62" .$noPottong; ?>&text=Halo" target="_blank" class="btn btn-primary btn-sm"> 
                                                        <i class="fab fa-whatsapp fa-2x"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Nama Pengirim</label>
                                            <input type="text" name="nama_pengirim" class="form-control"
                                                placeholder="Nama Pengirim" value="<?php echo $nama_pengirim; ?>" <?php echo $disabeled_data; ?>>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Alamat Pengirim</label>
                                            <input type="text" name="alamat_pengirim" class="form-control"
                                                placeholder="Alamat Pengirim" value="<?php echo $alamat_pengirim; ?>" <?php echo $disabeled_data; ?>>
                                        </div>
                                    </div>
                                    <div class="col-sm">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Kategori Barang</label>
                                            <input type="text" name="kategori_barang" class="form-control"
                                                placeholder="keterangan kategori barang" value="<?php echo $kategori_barang; ?>" <?php echo $disabeled_data; ?>>
                                            <small class="help-block form-text">Gunakan "," jika kategori lebih dari satu</small>    
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Keterangan Barang</label>
                                            <input type="text" name="keterangan_barang" class="form-control"
                                                placeholder="keterangan kategori barang" value="<?php echo $keterangan_barang; ?>" <?php echo $disabeled_data; ?>>
                                            <small class="help-block form-text">Masukkan keterangan dari barang NPD</small>                                                    
                                        </div>
                                        <div class="form-group" <?php echo $hidden_tgl_input;?>>
                                            <label for="exampleInputPassword1">Tanggal Pemeriksaan</label>
                                            <input type="datetime" name="tgl_input" class="form-control" value="<?php echo $tgl_input; ?>" <?php echo $disabeled_data; ?>>
                                        </div>
                                        <div class="form-group" <?php if($petugas == ""){echo "hidden";}?>>
                                            <label for="exampleInputPassword1">Petugas</label>
                                            <select name="petugas" class="form-control" disabled>
                                                <?php 
                                                    $quer4 = "SELECT * FROM akun_admin;";
                                                    $resu4=mysqli_query($conn,$quer4);
                                                    while ($row4=mysqli_fetch_array($resul4)){
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
                                <form action="barang_form.php" method="post" merk="frm" enctype="multipart/form-data"class="form-horizontal">
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
                            <h3 class="card-title">Lampirkan Foto Barang dan Keterangan</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="barang_form.php" method="post" merk="frm" enctype="multipart/form-data"class="form-horizontal">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm" <?php echo $hiddenFormFoto; ?>>
                                        <div class="form-group">
                                            <label for="exampleInputFile">Upload Lampiran Foto Barang</label>
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
                                <form action="barang_form.php" method="post" merk="frm" enctype="multipart/form-data"class="form-horizontal">
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
                                            <td><img src="images/<?php echo $row1["nama_foto"]; ?>" class="img-fluid" alt="images/<?php echo $row1["nama_foto"]; ?>"></td>
                                            <td><?php echo $row1["keterangan_barang"]; ?></td>
                                            <td <?php echo $hidden_input_button;?>><a  href="delete_foto_barang.php?no_cn=<?php echo $row1["no_cn"];?>&id=<?php echo $row1["id"];?>" class="btn btn-primary btn-sm"><i class='fa fa-trash-o fa-1x'></i></a></td>
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
    
    <?php
        $jumlah_data_konfirmasi = 0;
        $query2 = "SELECT count(no_cn) as jumlahData FROM penerima_npd where no_cn = '$no_tracking';";
        $result2 = mysqli_query($conn,$query2);
        while ($row=mysqli_fetch_array($result2)){
            $jumlah_data_konfirmasi = $row["jumlahData"]; 
        }
    ?>
    <section class="content" 
        <?php 
            if($hidden_foto == "hidden" || $jumlah_data_konfirmasi == 0){
                echo "hidden";
            }else { 
                echo "";
            }?>>
        <div class="container-fluid">
            <a  href="konfirmasi_form.php?noTracking=<?php echo $no_tracking;?>" class="btn btn-primary" role="button" aria-pressed="true"> <i class='fas fa-chevron-left fa-1x'></i> Data Konfirmasi </a>
        </div>
    </section>

    <br/>
    <br/>
    <br/>


</div>
<!-- /.content-wrapper -->
<?php include('footer.php');?>
    

