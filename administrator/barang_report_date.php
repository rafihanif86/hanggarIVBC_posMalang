<?php
    $nav_active = "barang";
    $act = "form";
    $nip ="";
    $datepicker = true;

    include('header.php');

    $tgl_awal = "";
    $tgl_akhir = "";
    $inject_query ="";
    $hidden_petugas = "";
    $id_petugas="";
    $query_status = "";
    $status1 = "";
    $judul ="";
    $inject_tanggal = "";
    $quei = "";
    $hidden_alert = "hidden";

    if($_SESSION['status'] == "checker"){
        $hidden_petugas = "hidden";
        $id_petugas = $nip_akun;
    }

    if(isset($_POST["btnTracking"]) && $_POST["tgl_awal"] !="" && $_POST["tgl_akhir"] != ""){
        $tgl_awal=$_POST["tgl_awal"];
        $tgl_akhir=$_POST["tgl_akhir"];
        if( $tgl_akhir < $tgl_awal){
            $hidden_alert = "";
        }else{
            $inject_tanggal="and tgl_pengecekan_barang between '$tgl_awal' and '$tgl_akhir' ";
        }
        
    }

    if($_GET["status"] != ""){
        $act = $_GET["status"];
        if($act == "belum_diproses"){
          $judul = "Belum Diproses";
          $hidden_status="hidden";
          $quei = "SELECT d.`tgl_pengecekan_barang`, d.`no_cn`, d.`petugas_pemeriksa`, d.`nama_penerima`, d.`alamat_penerima`, d.`alamat_pengirim`, d.`kategori_barang`, p.`total_invoice`, p.`proses` 
                       FROM data_barang_npd d, penerima_npd p WHERE d.`no_cn` = p.`no_cn` AND p.`proses` = 'belum_diproses' ".$inject_tanggal."ORDER BY d.`tgl_pengecekan_barang` ASC, d.`no_cn` ASC;";
        }else if($act == "telah_diproses"){
          $judul = "Telah Diproses";
          $hidden_status="hidden";
          $quei = "SELECT d.`tgl_pengecekan_barang`, d.`no_cn`, d.`petugas_pemeriksa`, d.`nama_penerima`, d.`alamat_penerima`, d.`alamat_pengirim`, d.`kategori_barang`, p.`total_invoice`, p.`proses`
                       FROM data_barang_npd d, penerima_npd p WHERE d.`no_cn` = p.`no_cn` AND p.`proses` = 'telah_diproses' ".$inject_tanggal."ORDER BY d.`tgl_pengecekan_barang` ASC, d.`no_cn` ASC;";
        }else if($act == "telah_konfirmasi"){
          $judul = "Telah Konfirmasi";
          $hidden_status="";
          $quei = "SELECT d.`tgl_pengecekan_barang`, d.`no_cn`, d.`petugas_pemeriksa`, d.`nama_penerima`, d.`alamat_penerima`, d.`alamat_pengirim`, d.`kategori_barang`, p.`total_invoice`, p.`proses` 
                    FROM data_barang_npd d, penerima_npd p WHERE d.`no_cn` = p.`no_cn` ".$inject_tanggal."ORDER BY d.`tgl_pengecekan_barang` DESC, d.`no_cn` ASC;";
        }else if($act == "belum_konfirmasi"){
          $judul = "Belum Konfirmasi";
          $hidden_status="hidden";
          $quei = "SELECT d.`tgl_pengecekan_barang`, d.`no_cn`, d.`petugas_pemeriksa`, d.`nama_penerima`, d.`alamat_penerima`, d.`alamat_pengirim`, d.`kategori_barang` 
                    FROM data_barang_npd d LEFT OUTER JOIN penerima_npd p on d.`no_cn` = p.`no_cn` where p.`no_cn` IS NULL ".$inject_tanggal."ORDER BY d.`tgl_pengecekan_barang` DESC, d.`no_cn` ASC;";
        }
      }else{
        $hidden_status="";
        if($id_petugas != ""){
            $quei = "SELECT d.`tgl_pengecekan_barang`, d.`no_cn`, d.`nama_penerima`, d.`alamat_penerima`, d.`alamat_pengirim`, d.`kategori_barang`, d.`petugas_pemeriksa`, p.`total_invoice`, p.`proses` 
                        FROM data_barang_npd d LEFT JOIN penerima_npd p ON d.`no_cn` = p.`no_cn` where p.`petugas_pemeriksa` = '$id_petugas' ".$inject_tanggal."ORDER BY d.`tgl_pengecekan_barang` DESC, d.`no_cn` ASC; ";
        }else{
            if($inject_tanggal != ""){
                $inject_tanggal = "where". substr($inject_tanggal, 3);
            }
            $quei = "SELECT d.`tgl_pengecekan_barang`, d.`no_cn`, d.`nama_penerima`, d.`alamat_penerima`, d.`alamat_pengirim`, d.`kategori_barang`, d.`petugas_pemeriksa`, p.`total_invoice`, p.`proses` FROM data_barang_npd d LEFT JOIN penerima_npd p ON d.`no_cn` = p.`no_cn` ".$inject_tanggal."ORDER BY d.`tgl_pengecekan_barang` DESC, d.`no_cn` ASC; ";
        }
      }
    
    $result=mysqli_query($conn,$quei) ;

?>

<script>
    function printContent(el) {
        var restorepage = document.body.innerHTML;
        var printcontent = document.getElementById(el).innerHTML;
        document.body.innerHTML = printcontent;
        window.print();
        document.body.innerHTML = restorepage;
    }
</script>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Laporan Data Barang NPD</h1> <h4>| <?php if($judul == ""){echo "Seluruh Data"; }else{echo $judul;} ?></h4>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="konfirmasi_table.php">Data Barang NPD</a></li>
                        <li class="breadcrumb-item active">Report</li>
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
                            <h3 class="card-title">Pilih Rentang Waktu Untuk Di buat Laporan</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="barang_report_date.php?status=<?php echo $status1;?>" method="post" merk="frm" enctype="multipart/form-data"
                            class="form-horizontal">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Tanggal Awal</label>
                                            <input type="date" class="form-control" name="tgl_awal" placeholder="Pilih tanggal awal" 
                                                value="<?php echo $tgl_akhir; ?>">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Tanggal Akhir</label>
                                            <input type="date" class="form-control" name="tgl_akhir" placeholder="Pilih tanggal akhir"
                                                value="<?php echo $tgl_akhir; ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer" style="text-align: right;">
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

    <section class="content" <?php echo $hidden_alert; ?>>
        <div class="container-fluid">
            <div class="alert alert-warning" role="alert">
                Anda Memasukkan Rentang Waktu Yang Salah
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content" <?php if ($hidden_alert == ""){echo "hidden";} ?>>
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Tampilan Laporan Data Barang NPD | <?php if($judul == ""){echo "Seluruh Data"; }else{echo $judul;} ?></h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                            <div class="card-body" id="div1">
                                <div class="row">
                                    <div class="col-12">
                                        <center> 
                                            <h1>LAPORAN</h1>
                                            <h2>Data BARANG NPD</h2>
                                            <h3><?php echo $judul;?></h3>
                                        </center>
                                        <hr/>
                                        <br/>
                                        <p>
                                            <?php 
                                                $inject_nama = "";
                                                if($nama_akun != ""){
                                                    $inject_nama .= "Oleh ".$nama_akun;
                                                }
                                                if($tgl_akhir != "" && $tgl_akhir != ""){
                                                    echo "\t Berikut ini adalah ".$judul."Laporan Data Barang NPD tanggal ".$tgl_awal. " hingga tanggal " .$tgl_akhir." " .$inject_nama ." sebagai berikut:";
                                                }else{
                                                    echo "\t Berikut ini adalah ".$judul."seluruh Laporan Data Barang NPD ".$inject_nama." sebagai berikut:";
                                                } 
                                            ?>
                                        </p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                    <table class="table table-striped table-bordered" style="zoom: 90%;">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Tanggal Masuk</th>
                                                    <th>Nomer CN</th>
                                                    <th>Petugas</th>
                                                    <th>Nama Penerima</th>
                                                    <th>Alamat Penerima</th>
                                                    <th>Alamat Pengirim</th>
                                                    <th>Kategori Barang</th>
                                                    <th <?php echo $hidden_status; ?>>Status</th>
                                                    <th <?php echo $hidden_status; ?>>Total Harga Barang</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    $i = 0;
                                                    while ($row1=mysqli_fetch_array($result)){
                                                        $i++;
                                                ?>
                                                <tr>
                                                    <td><?php echo $i; ?></td>
                                                    <td><?php echo $row1["tgl_pengecekan_barang"]; ?></td>
                                                    <td><?php echo $row1["no_cn"]; ?></td>
                                                    <td><?php echo $row1["petugas_pemeriksa"]; ?></td>
                                                    <td><?php echo $row1["nama_penerima"]; ?></td>
                                                    <td><?php echo $row1["alamat_penerima"]; ?></td>
                                                    <td><?php echo $row1["alamat_pengirim"]; ?></td>
                                                    <td><?php echo $row1["kategori_barang"]; ?></td>
                                                    <td <?php echo $hidden_status; ?>>
                                                        <?php 
                                                        if($hidden_status == ""){
                                                            if ($row1["proses"] == "belum_diproses"){
                                                                echo "<i class='fas fa-spinner fa-1x'> </i>";
                                                            }else{
                                                                echo "<i class='fas fa-check fa-1x'> </i>";
                                                            }
                                                        } 
                                                        ?>
                                                    </td>
                                                    <td <?php echo $hidden_status; ?>><?php if($hidden_status == ""){echo $row1["total_invoice"];} ?></td>
                                                    
                                                </tr>
                                                <?php
                                                        }
                                                    ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-9">
                                    </div>
                                    <div class="col-3">
                                            <br/>
                                            <p><?php echo date('d M Y');?></p>
                                            <br/>
                                            <br/>
                                            <p><?php echo $nama_akun; ?> <br/> NIP.<?php echo $id_petugas;?></p>
                                    </div>
                                </div>
                            </div>
                        <!-- /.card-body -->
                            <div class="card-footer" style="text-align: right;">
                                <label for="exampleInputPassword1" style="float: left;">Click Untuk Print Laporan</label>
                                <button class="btn btn-outline-primary btn-sm" onclick="printContent('div1')"><i class="fas fa-print fa-2x"></i></button>
                                
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

</div>
<!-- /.content-wrapper -->


<?php include('footer.php');?>