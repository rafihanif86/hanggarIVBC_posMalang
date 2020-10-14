<?php
    $nav_active = "konfirmasi";
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
    $hidden_status = "";
    $hidden_alert = "hidden";

    if($_SESSION['status'] == "checker"){
        $hidden_petugas = "hidden";
        $id_petugas = $nip_akun;
    }

    $status1 = $_GET["status"];

    if($status1 == "belum_diproses"){
        $hidden_status="hidden";
        $judul = "Data Belum Diproses ";
    }else if($status1 == "telah_diproses"){
        $hidden_status="hidden";
        $judul = "Data Telah Diproses ";
    }else if($status1 == ""){
        $hidden_status = "";
        $judul = "Seluruh Data ";
    }

    if(isset($_GET["tgl_awal"]) && isset($_GET["tgl_akhir"])){
        $tgl_awal=$_GET["tgl_awal"];
        $tgl_akhir=$_GET["tgl_akhir"];
    }

    if($tgl_awal != "" && $tgl_akhir != ""){
        if( $tgl_akhir < $tgl_awal){
            $hidden_alert = "";
        }else if($id_petugas != ""){
            $query="select d.*, p.nama, p.`no_hp`, p.`email`, p.`no_npwp`, p.`input_date` from data_barang_faktur d, penerima p where d.nik = p.nik and d.tgl_input between '$tgl_awal' and '$tgl_akhir' 
                and d.petugas_pemeriksa = '$id_petugas' and d.proses like '%telah_diproses%' order by d.tgl_input asc, p.nama desc;";
            $result=mysqli_query($conn,$query) ;
        }else{
            $query="select d.*, p.nama, p.`no_hp`, p.`email`, p.`no_npwp`, p.`input_date` from data_barang_faktur d, penerima p where d.nik = p.nik and d.tgl_input between '$tgl_awal' and '$tgl_akhir' order by d.tgl_input asc, p.nama desc;";
            $result=mysqli_query($conn,$query) ;
        }
    }else{
        if($id_petugas != ""){
            $query="select d.*, p.nama, p.`no_hp`, p.`email`, p.`no_npwp`, p.`input_date` from data_barang_faktur d, penerima p where d.nik = p.nik and d.petugas_pemeriksa = '$id_petugas' and  d.proses like '%telah_diproses%' order by d.tgl_input asc, p.nama desc;";
        }else{
            $query="select d.*, p.nama, p.`no_hp`, p.`email`, p.`no_npwp`, p.`input_date` from data_barang_faktur d, penerima p where d.nik = p.nik order by d.tgl_input asc, p.nama desc;";
        }
        $result=mysqli_query($conn,$query) ;
    }
    
    

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
                    <h1>Laporan Konfirmasi Barang NPD</h1> <h4>| <?php if($judul == ""){echo "Seluruh Data"; }else{echo $judul;} ?></h4>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="konfirmasi_table.php">Data Konfirmasi Barang NPD</a></li>
                        <li class="breadcrumb-item active">Report</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
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
                            <h3 class="card-title">Tampilan Laporan Konfirmasi Barang NPD | <?php if($judul == ""){echo "Seluruh Data"; }else{echo $judul;} ?></h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                            <div class="card-body" id="div1">
                                <div class="row">
                                    <div class="col-12">
                                        <center> 
                                            <h1>LAPORAN</h1>
                                            <h2>KONFIRMASI BARANG NPD</h2>
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
                                                    echo "\t Berikut ini adalah ".$judul."Laporan Konfirmasi Barang NPD tanggal ".$tgl_awal. " hingga tanggal " .$tgl_akhir." " .$inject_nama ." sebagai berikut:";
                                                }else{
                                                    echo "\t Berikut ini adalah ".$judul."seluruh Laporan Konfirmasi Barang NPD ".$inject_nama." sebagai berikut:";
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
                                                    <th widht="60px">Tanggal</th>
                                                    <th>Nomor CN</th>
                                                    <th>Nama Penerima</th>
                                                    <th>Nomor Telepon</th>
                                                    <th>Nomor NPWP</th>
                                                    <th>Keterangan Barang</th>
                                                    <th>Total Harga Barang</th>
                                                    <th width = "80px"><?php if($hidden_status == "hidden"){echo "Petugas";}else{echo "Status";}?></th>
                                                    <th>Tanggal Diproses</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    $i = 0;
                                                    while ($row2=mysqli_fetch_array($result)){
                                                        $i++;
                                                ?>
                                                <tr>
                                                    <td><?php echo $i; ?></td>
                                                    <td><?php echo $row2["tgl_input"]; ?></td>
                                                    <td><?php echo $row2["no_cn"]; ?></td>
                                                    <td><?php echo $row2["nama"]; ?></td>
                                                    <td><?php echo $row2["no_hp"]; ?></td>
                                                    <td><?php echo $row2["no_npwp"]; ?></td>
                                                    <td><?php echo $row2["keterangan"]; ?></td>
                                                    <td><?php echo $row2["total_invoice"]; ?></td>
                                                    <td><?php 
                                                        if ($row2["proses"] == "belum_diproses" && $hidden_status == "hidden"){
                                                            echo "<i class='fas fa-spinner fa-1x'> </i>";
                                                        }else if ($row2["proses"] == "belum_diproses" && $hidden_status == "hidden"){
                                                            echo "<i class='fas fa-check fa-1x'> </i>";
                                                        } 
                                                        if($hidden_petugas == ""){
                                                            $nama_petugas = "";
                                                            $id_petugas = $row2["petugas_pemeriksa"];
                                                            $quer4 = "SELECT * FROM akun_admin where id = '$id_petugas';";
                                                            $resu4=mysqli_query($conn,$quer4);
                                                            while ($row4=mysqli_fetch_array($resu4)){
                                                                echo " ".$row4["nama"];
                                                            }
                                                        }
                                                    ?></td>
                                                    <td><?php echo $row2["tgl_proses"]; ?></td>
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
                                <button class="btn btn-primary btn-sm" onclick="printContent('div1')"><i class="fas fa-print fa-1x"></i> Cetak </button>
                                
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