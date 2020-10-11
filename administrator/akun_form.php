<?php
    $nav_active = "akun";
    $act = "form";
    $nip ="";

    if(isset($_POST["nip"]) || isset($_GET["nip"])){
        if(isset($_POST["nip"])){
            $nip=$_POST["nip"];
        }else if(isset($_GET["nip"])){
            $nip=$_GET["nip"];
        }  
    }

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
    $hidden_proses = "hidden";
    
    $nama = "";
    $posisi = "";
    $telp = "";
    $email_akun = "";
    $foto_profil = "";
    $jabatan = "";
    $tgl_register = "";

    $password_title1 = "";
    $password_title2 = "";

    $namaFile="";
    $keteranganFoto="";
    $hiddenButtonFoto = "hidden";
    $hidenDataFoto="hidden";
    $hiddenFormFoto = "";

    $actionBoxText="";

    

    if($nip != ""){
        $query = "SELECT count(id) as jumlahData FROM akun_admin where id like '%$nip%';";
        $result = mysqli_query($conn,$query);
        while ($row=mysqli_fetch_array($result)){
        $jumlahData = $row["jumlahData"]; 
        }

        if($jumlahData == 0){
            $hidden_data = "";
            $disabeledTracking = "disabled";
            $hiddenTracking = "hidden";
            $editStatus="no";
            $password_title1 = "Masukkan Password";
            $password_title2 = "Ulangi Password";
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
            $password_title1 = "Masukkan Password Lama";
            $password_title2 = "Masukkan Password Baru";

            $query = "SELECT * FROM akun_admin where id like '%$nip%';";
            $result = mysqli_query($conn,$query);
            while ($row=mysqli_fetch_array($result)){
                $nama = $row["nama"];
                $posisi = $row["posisi"];
                $telp = $row["telp"];
                $email_akun = $row["email"];
                $foto_profil = $row["foto_profil"];
                $jabatan = $row["jabatan"];
                $tgl_register = $row["tgl_register"];
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
        $nip=$_POST["nip"];
        $nama = $_POST["nama"];
        $posisi = $_POST["posisi"];
        $telp = $_POST["telp"];
        $email_akun = $_POST["email_akun"];
        $foto_profil=$_POST["foto_profil"];
        $jabatan=$_POST["jabatan"];
        $tgl_register=$_POST["tgl_register"];
        $editStatus = $_POST["editStatus"];
        $password1 = md5($_POST["password1"]);
        $password2 = md5($_POST["password2"]);
        $final_password = "";

        $sql_insert1 = null;
        $note ="";

        $file_name = $_FILES['namaFile']['name'];
        if($file_name != "" || $file_name != null){
            //menghapus foto lama
            $target = "images/" .$foto_profil;
            if(file_exists($target)){
                unlink($target);
            }
            //menambahkan foto baru
            $tmp_name = $_FILES['namaFile']['tmp_name'];				
            move_uploaded_file($tmp_name, "images/".$file_name);
        }else{
            $file_name = $foto_profil;
        }

        if($editStatus == "no"){
            $tgl_input = date('yy-m-d H:i:s');
            if($password1 == $password2){
                $final_password = $password1;
            }

            $query="INSERT INTO akun_admin set id = '$nip', nama = '$nama', 
                        posisi = '$posisi', telp = '$telp', email = '$email_akun', 
                        password = '$final_password', login_status = 'logout', foto_profil = '$file_name', 
                        jabatan ='$jabatan', tgl_register = '$tgl_input';";
            $sql_insert1 = mysqli_query($conn,$query);
            $note = "Tambahkan";
        }else if($editStatus == "yes"){
            $password = "";
            $query5 = "SELECT password FROM akun_admin where id like '%$nip%';";
            $result5 = mysqli_query($conn,$query5);
            while ($row=mysqli_fetch_array($result5)){
                $password = $row["password"]; 
            }

            if($password == $password1 && $password1 != "" && $password1 != null && $password2 != "" && $password2 != null){
                $query="UPDATE akun_admin set nama = '$nama', posisi = '$posisi', telp = '$telp', 
                        email = '$email_akun', password = '$password2', foto_profil = '$file_name', jabatan ='$jabatan' 
                        where id = '$nip';";
                $sql_insert1 = mysqli_query($conn,$query);
                $note = "Diubah dan Pasword Berhasil Diubah";
            }else{
                $query="UPDATE akun_admin set nama = '$nama', posisi = '$posisi', telp = '$telp', 
                        email = '$email_akun', foto_profil = '$file_name', jabatan ='$jabatan' 
                        where id = '$nip';";
                $sql_insert1 = mysqli_query($conn,$query);
                $note = "Diubah dan Pasword Tidak Diubah";
            }
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



?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Form Akun Admin</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Data Akun Admin</a></li>
                        <li class="breadcrumb-item active">Form</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Tracking NIP</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="akun_form.php" method="post" merk="frm" enctype="multipart/form-data"
                            class="form-horizontal">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Masukkan NIP Anda</label>
                                    <input type="text" class="form-control" name="nip" placeholder="NIP anda"
                                        value="<?php echo $nip; ?>" <?php echo $disabeledTracking; ?>>
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

    <!-- Main content -->
    <section class="content" <?php echo $hidden_data; ?>>
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Data Pribadi Anda</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="akun_form.php" method="post" merk="frm" enctype="multipart/form-data"
                            class="form-horizontal">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-7">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Nama</label>
                                            <input type="text" name="nama" class="form-control" placeholder="Nama Anda"
                                                value="<?php echo $nama; ?>" <?php echo $disabeled_data; ?>>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Email</label>
                                            <input type="email" name="email_akun" class="form-control"
                                                placeholder="Email Anda" value="<?php echo $email_akun; ?>"
                                                <?php echo $disabeled_data; ?>>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Nomor Telephone / Whatsapp</label>
                                            <div class="input-group">
                                                <input type="number" name="telp" class="form-control"
                                                    placeholder=" Nomor Telephone / Whatsapp"
                                                    value="<?php echo $telp; ?>" <?php echo $disabeled_data; ?>>
                                                <div class="input-group-append">
                                                    <div class="btn btn-outline-primary btn-sm"
                                                        <?php echo $hidden_edit_button; ?>>
                                                        <?php $noPottong = substr($telp,1);?>
                                                        <a href="https://api.whatsapp.com/send?phone=<?php echo "+62" .$noPottong; ?>&text=Halo"
                                                            target="_blank">
                                                            <i class="fab fa-whatsapp fa-2x"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Jabatan</label>
                                            <input type="text" name="jabatan" class="form-control"
                                                placeholder="Nama Pengirim" value="<?php echo $jabatan; ?>"
                                                <?php echo $disabeled_data; ?>>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Posisi Diaplikasi ini</label>
                                            <select name="posisi" class="form-control" <?php echo $disabeled_data; ?>>
                                                <option <?php if($posisi == 'checker'){echo 'selected';} ?>
                                                    value="checker">Checker</option>
                                                <option <?php if($posisi == 'admin'){echo 'selected';} ?> value="admin">
                                                    Admin</option>
                                            </select>
                                        </div>
                                        <div class="form-group" <?php echo $hidden_tgl_input; ?>>
                                            <label for="exampleInputPassword1">Tanggal Register</label>
                                            <input type="datetime" name="tgl_register" class="form-control"
                                                placeholder="Tanggal Register Akun" value="<?php echo $tgl_register; ?>"
                                                <?php echo $disabeled_data; ?>>
                                        </div>
                                        <div class="form-group" <?php echo $hidden_input_button; ?>>
                                            <label for="exampleInputPassword1">Ubah Foto Profil</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="exampleInputFile"
                                                        name="namaFile" value="<?php echo $foto_profil; ?>">
                                                    <label class="custom-file-label"
                                                        for="exampleInputFile"><?php if($foto_profil == ""){echo 'Choose File';}else{echo $foto_profil;} ?></label>
                                                </div>
                                            </div>
                                            <small class="help-block form-text">Pilih file untuk mengubah foto profil.
                                                Kosongkan bila tidak ingin mengubah foto profil.</small>
                                        </div>
                                        <div class="form-group" <?php echo $hidden_input_button; ?>>
                                            <label for="exampleInputPassword1"><?php echo $password_title1; ?></label>
                                            <input type="password" name="password1" class="form-control"
                                                placeholder="Password" value="" <?php echo $disabeled_data; ?>>
                                        </div>
                                        <div class="form-group" <?php echo $hidden_input_button; ?>>
                                            <label for="exampleInputPassword1"><?php echo $password_title2; ?></label>
                                            <input type="password" name="password2" class="form-control"
                                                placeholder="Password" value="" <?php echo $disabeled_data; ?>>
                                        </div>
                                    </div>
                                    <div class="col-5">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Foto Profil</label>
                                            <br />
                                            <img src="images/<?php if($foto_profil != ""){echo $foto_profil;}else{echo 'guest.png';}  ?>" class="rounded float-left"
                                                alt="..." style="max-width: 400px;">
                                            <br />
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="foto_profil" class="form-control"
                                    value="<?php echo $foto_profil; ?>">
                                <input type="hidden" name="nip" class="form-control" value="<?php echo $nip; ?>">
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
                        <form action="akun_form.php" method="post" merk="frm" enctype="multipart/form-data"
                            class="form-horizontal">
                            <input type="hidden" name="nip" class="form-control" value="<?php echo $nip; ?>">
                            <button type="submit" class="btn btn-primary" name="btnEdit"
                                <?php echo $hidden_edit_button; ?>>Ubah</button>
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

<?php 
    $quei = "SELECT * FROM data_barang_npd d, akun_admin a WHERE d.`petugas_pemeriksa` = a.`id` and a.`id` = '$nip'; ";
    $hasil = mysqli_query($conn,$quei);
?>

<section class="content" <?php echo $hidden_foto; ?>>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">List pemeriksaan barang NPD Oleh <?php echo $nama; ?></h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body" style="overflow-x: scroll;">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Pemerikasaan</th>
                                    <th>Nomer CN</th>
                                    <th>Nama Penerima</th>
                                    <th>Alamat Penerima</th>
                                    <th>Alamat Pengirim</th>
                                    <th>Kategori Barang</th>
                                    <th width="50px"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                        while ($row1=mysqli_fetch_array($hasil)){
                        ?>
                                <tr>
                                    <td><?php echo $row1["tgl_pengecekan_barang"]; ?></td>
                                    <td><?php echo $row1["no_cn"]; ?></td>
                                    <td><?php echo $row1["nama_penerima"]; ?></td>
                                    <td><?php echo $row1["alamat_penerima"]; ?></td>
                                    <td><?php echo $row1["alamat_pengirim"]; ?></td>
                                    <td><?php echo $row1["kategori_barang"]; ?></td>
                                    <td>
                                        <a href="barang_form.php?noTracking=<?php echo $row1["no_cn"];?>"
                                            class="btn btn-primary btn-sm" role="button" aria-pressed="true">
                                            <i class='fas fa-book-open fa-1x'> </i>
                                        </a>
                                        <a href="delete_konfirmasi.php?no_cn=<?php echo $row1["no_cn"];?>&act=<?php echo $act;?>"
                                            class="btn btn-primary btn-sm" role="button" aria-pressed="true">
                                            <i class='fa fa-trash-o fa-1x'> </i>
                                        </a>
                                    </td>
                                </tr>
                                <?php } ?>

                                </tfoot>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
</section>

<?php
    $que = "SELECT * FROM penerima_npd d, akun_admin a WHERE d.`petugas_pemeriksa` = a.`id` and a.`id` = '$nip';";
$result1 = mysqli_query($conn,$que);
?>

<section class="content" <?php echo $hidden_foto; ?>>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">List Memproses Konfirmasi Penerima NPD Oleh <?php echo $nama; ?></h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body" style="overflow-x: scroll;">
                        <table id="example3" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Tanggal Input</th>
                                    <th>Nomer CN</th>
                                    <th>Nama Penerima</th>
                                    <th>Nomer HP</th>
                                    <th>Total invoice</th>
                                    <th width="50px"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    while ($row1=mysqli_fetch_array($result1)){
                                ?>
                                <tr>
                                    <td><?php echo $row1["tgl_input"]; ?></td>
                                    <td><?php echo $row1["no_cn"]; ?></td>
                                    <td><?php echo $row1["nama_penerima"]; ?></td>
                                    <td><?php echo $row1["no_hp"]; ?></td>
                                    <td><?php echo $row1["total_invoice"]; ?></td>
                                    <td>
                                        <a href="konfirmasi_form.php?noTracking=<?php echo $row1["no_cn"];?>"
                                            class="btn btn-primary btn-sm" role="button" aria-pressed="true">
                                            <i class='fas fa-book-open fa-1x'> </i>
                                        </a>
                                        <a href="delete_konfirmasi.php?no_cn=<?php echo $row1["no_cn"];?>&act=<?php echo $act;?>"
                                            class="btn btn-primary btn-sm" role="button" aria-pressed="true">
                                            <i class='fa fa-trash-o fa-1x'> </i>
                                        </a>
                                    </td>
                                </tr>
                                <?php } ?>
                                </tfoot>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
</section>

</div>
<!-- /.content-wrapper -->
<?php include('footer.php');?>