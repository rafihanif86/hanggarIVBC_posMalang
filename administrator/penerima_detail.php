<?php
    $nav_active = "penerima";
    $act = "form";
    include('header.php');
    include('connection.php');
    
    $hidden_data = "hidden";
    $hidden_input_button = "";
    $hidden_nik = "hidden";
    $hidden_proses_button = "hidden";
    $status_ubah = "";
    
    $tgl_input = "";
    $nama="";
    $nik="";
    $npwp="";
    $no_hp="";
    $status="";
    $email = "";
    $statusIn="";
    $foto_ktp = "";

    if(isset($_POST["nik"]) || isset($_GET["q"])){
        if(isset($_POST["nik"])){
            $nik=$_POST["nik"];
        }else if(isset($_GET["q"])){
            $nik=base64_decode($_GET["q"]);
        }  
    }

    if(isset($_POST["btnCari"])){
        $nik=$_POST["nik1"];
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
            $disabeled_data="disabled";
            $hidden_data = "";
            $hidden_nik = "hidden";
            $hidden_input_button = "hidden";
        }else{
            $hidden_nik = "hidden";
            $hidden_data = "";
            $disabeled_data="";
            $hidden_input_button = "";
            $hidden_proses_button = "";
        }
    }else{
        $hidden_nik = "";
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
            $disabeled_data="disabled";
            $hidden_data = "";
            $hidden_nik = "hidden";
            $hidden_input_button = "hidden";
            $hidden_proses_button = "";
        }else{
            $hidden_nik = "hidden";
            $hidden_data = "";
            $disabeled_data="";
        }
    }

    if(isset($_POST["btnData"])){
        $nama=$_POST["nama"];
        $nik=$_POST["nik"];
        $npwp=$_POST["npwp"];
        $email=$_POST["email"];
        $no_hp=$_POST["no_hp"];
        $sql_insert1 = null;
        $sql_insert2 = null;
        
        if(($nama && $nik && $email && $no_hp) != ""){
            
            if($status_ubah == "true"){
                $statusIn = "belum_diproses";
                $query="insert into penerima set nama = '$nama', nik = '$nik',email = '$email', no_npwp = '$npwp', no_hp = '$no_hp';";
                $sql_insert1 = mysqli_query($conn,$query);
            }else{
                $query="update penerima set nama = '$nama', email = '$email', no_npwp = '$npwp', no_hp = '$no_hp' where nik = '$nik';";
                $sql_insert1 = mysqli_query($conn,$query);
            }
            
            if ($_FILES['namaFile_ktp']['name'] != "") { 
                $file_name = $_FILES['namaFile_ktp']['name'];
                $tmp_name = $_FILES['namaFile_ktp']['tmp_name'];
                $file_size = $_FILES['namaFile_ktp']['size'];
                $jenis_gambar = $_FILES['namaFile_ktp']['type'];
                if($file_name != ""){
                    if($file_size <= 1048576){
                        if($jenis_gambar=="image/jpeg" || $jenis_gambar=="image/jpg" || $jenis_gambar=="image/gif" || $jenis_gambar=="image/x-png"){
                            // hapus foto sebelumnnya
                            $foto_ktp_lama = "";
                            $query = "select * from penerima where nik = '$nik';";
                            $result = mysqli_query($conn,$query);
                            while ($row=mysqli_fetch_array($result)){
                                $foto_ktp_lama = $row["foto_ktp"];
                            }
                            if($foto_ktp_lama !=""){
                                unlink("../administrator/images/".$foto_ktp_lama);
                            }

                            // upload foto baru
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

    if(isset($_POST["btnUpdate"])){
        $status_ubah = "true";
        $disabeled_data = "";
        $hidden_input_button = "";
    }

?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">

            <div class="row">
                <div class="col-md-6">
                    <h1>Data Penerima Barang</h1>
                </div>
                <div class="col-md-6">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item ">Penerima Barang</li>
                            <li class="breadcrumb-item active">Form</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <br/>

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
                        <form action="penerima_detail.php" method="post" merk="frm" enctype="multipart/form-data"
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
                        <form action="penerima_detail.php" method="post" merk="frm" enctype="multipart/form-data"
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
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer" style="text-align: right;" <?php echo $hidden_input_button; ?>>
                                <input type="hidden" name="status_ubah" class="form-control" value="<?php echo $status_ubah; ?>">
                                <button type="submit" class="btn btn-primary" name="btnData">Simpan</button>
                            </div>
                        </form>
                    </div><!-- /.card -->
                </div>
            </div><!-- /.row -->

            

            <div class="row" <?php echo $hidden_proses_button;?>>
                <div class="col-md-12 ">
                    <div class="btn-group ">
                        <button type="button" class="btn btn-secondary dropdown-toggle btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class='fa fa-cog fa-1x'></i> Setting
                        </button>
                        <div class="dropdown-menu dropdown-menu-left">
                            <a  href="penerima_print.php?q=<?php echo base64_encode($nik);?>" class="dropdown-item" target="_BLANK" role="button" aria-pressed="true"> 
                                <i class='fa fa-print fa-1x'> </i> Cetak
                            </a>
                            <div class="dropdown-divider"></div>
                            <form action="penerima_detail.php" method="post" merk="frm" enctype="multipart/form-data"
                                class="form-horizontal">
                                <input type="hidden" name="nik" class="form-control" value="<?php echo $nik; ?>">
                                <button type="submit" class="dropdown-item" name="btnUpdate"> <i class='fa fa-pencil fa-1x'></i> Ubah</button>
                            </form>
                            <a  href="delete_penerima.php?q=<?php echo base64_encode($row1["nik"]);?>" class="dropdown-item" role="button" aria-pressed="true"> 
                                <i class='fa fa-trash-o fa-1x'> </i> Hapus
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <hr/>
            <?php
                $que = "select d.*, p.nama from data_barang_faktur d, penerima p where d.nik = p.nik and p.`nik` = '$nik' order by d.tgl_input desc, p.nama asc;";
                $result1 = mysqli_query($conn,$que);
            ?>
            <div class="row">
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">List Memproses Konfirmasi Penerima NPD Oleh <?php echo $nama; ?></h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body" style="overflow-x: scroll;">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal Input</th>
                                        <th>Nomer CN</th>
                                        <th>Keterangan</th>
                                        <th>Total Harga Barang</th>
                                        <th>Diproses oleh</th>
                                        <th width="50px"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $i = 0;
                                        while ($row1=mysqli_fetch_array($result1)){
                                            $i++;
                                    ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $row1["tgl_input"]; ?></td>
                                        <td><?php echo $row1["no_cn"]; ?></td>
                                        <td><?php echo $row1["keterangan"]; ?></td>
                                        <td><?php echo $row1["total_invoice"]; ?></td>
                                        <td>
                                            <?php 
                                                $id_petugas = $row1["petugas_pemeriksa"];
                                                if($id_petugas != ""){
                                                    $nama_petugas = "";
                                                    $que6 = "select * from akun_admin where id = $id_petugas;";
                                                    $res5=mysqli_query($conn,$que6);
                                                    while ($row3=mysqli_fetch_array($res5)){
                                                    $nama_petugas = $row3["nama"];
                                                    }
                                                    echo "<i class='fas fa-check fa-1x'> </i>";
                                                    echo " \t <a  href='akun_form.php?p=".base64_encode($id_petugas)."' class='text-dark' role='button' aria-pressed='true' >".$nama_petugas."</a>";
                                                }else{
                                                    echo "<i class='fas fa-spinner fa-1x'> </i>";
                                                } 
                                            ?>
                                        </td>
                                        <td>
                                            <a href="konfirmasi_form.php?n=<?php echo base64_encode($row1["no_cn"]);?>"
                                                class="btn btn-primary btn-sm" role="button" aria-pressed="true">
                                                <i class='fas fa-book-open fa-1x'> </i>
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

        </div><!-- /.container-fluid -->
    </section>
</div>
<!-- /.content-wrapper -->
<?php include('footer.php');?>