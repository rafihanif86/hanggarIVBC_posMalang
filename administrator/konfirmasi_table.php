<?php 
  $nav_active = "konfirmasi";
  include('connection.php');

  $que = "";
  $judul = "";
  $act = "";
  $hidden_status = "hidden";
  $tgl_hari_ini = date('Y-m-d');

  if(isset($_POST["tgl_awal"]) and isset($_POST["tgl_akhir"])){
    $tgl_awal = $_POST["tgl_awal"];
    $tgl_akhir = $_POST["tgl_akhir"];
    $act = $_POST["action"];
    if(isset($_POST["cetakxls"])){
        echo "<script> window.open('export_konfirmasi.php?status=$act&tgl_awal=$tgl_awal&tgl_akhir=$tgl_akhir', '_blank');</script>";
    }
    if(isset($_POST["print"])){
        echo "<script> var win = window.open('konfirmasi_report_date.php?status=$act&tgl_awal=$tgl_awal&tgl_akhir=$tgl_akhir', '_blank'); win.focus();</script>";
    }
  }

  if(isset($_GET["status"])){
    $act = $_GET["status"];
    if($act == "belum_diproses"){
      $judul = "Belum Diproses";
      $que = "SELECT d.*, p.nama FROM data_barang_faktur d, penerima p where d.nik = p.nik and d.proses like '%belum_diproses%' order by d.tgl_input desc, p.nama asc;";
    }else if($act == "telah_diproses"){
      $judul = "Telah Diproses";
      $hidden_status = "";
      $que = "SELECT d.*, p.nama FROM data_barang_faktur d, penerima p where d.nik = p.nik and d.proses like '%telah_diproses%' order by d.tgl_input desc, p.nama asc;";
    }
  }else{
    $act="seluruh";
    $judul = "Seluruh";
    $hidden_status = "";
    $que = "SELECT d.*, p.nama FROM data_barang_faktur d, penerima p where d.nik = p.nik order by d.tgl_input desc, p.nama asc;";
  }
  include('header.php');
  $result1 = mysqli_query($conn,$que);
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Data Penerima Barang NPD</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Data Penerima NPD</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">List Data Konfirmasi Penerima NPD - <?php echo $judul; ?></h3>
                        <button type="button" class="btn btn-primary btn-sm float-right" data-toggle="modal"
                            data-target="#exampleModalCenter" <?php 
                        if($_SESSION['status'] == "checker"){
                          if($act == "belum_diproses" || $act == "seluruh"){
                            echo "hidden";
                          }
                        }
                      ?>><i class="fas fa-print fa-1x"></i> Laporan </button>
                        </a>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body" style="overflow-x: scroll;">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal Input</th>
                                    <th>Nama Penerima</th>
                                    <th>Nomer CN</th>
                                    <th>Keterangan</th>
                                    <th>Total Harga Barang</th>
                                    <th <?php echo $hidden_status; ?>>Diproses oleh</th>
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
                                    <td><a href="konfirmasi_form.php?n=<?php echo base64_encode($row1["nik"]);?>"
                                            class="text-dark" role="button" aria-pressed="true">
                                            <?php echo $row1["nama"]; ?> </a></td>
                                    <td><?php echo $row1["no_cn"]; ?></td>
                                    <td><?php echo $row1["keterangan"]; ?></td>
                                    <td><?php echo $row1["total_invoice"]; ?></td>
                                    <td <?php echo $hidden_status; ?>>
                                        <?php 
                                          $id_petugas = $row1["petugas_pemeriksa"];
                                          if($id_petugas != ""){
                                            $nama_petugas = "";
                                            $que6 = "SELECT * FROM akun_admin where id = $id_petugas;";
                                            $res5=mysqli_query($conn,$que6);
                                            while ($row3=mysqli_fetch_array($res5)){
                                              $nama_petugas = $row3["nama"];
                                            }
                                            echo "<i class='fas fa-check fa-1x'> </i>";
                                            echo " \t".$nama_petugas;
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
                    <div class="card-footer" <?php echo $hidden_status; ?>>
                        <i class='fas fa-spinner fa-1x'> </i> Belum diproses | <i class='fas fa-check fa-1x'> </i> Telah
                        diproses
                    </div>
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Atur Rentang Tanggal</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="konfirmasi_table.php" method="post" name="frm" enctype="multipart/form-data"
                class="form-horizontal">
                <div class="modal-body">
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="text-input" class=" form-control-label">Tanggal Awal</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="date" id="tgl_awal" name="tgl_awal" placeholder="Tanggal Awal"
                                class="form-control" value="" max="<?php echo $tgl_hari_ini;?>"
                                onchange="change_kembali()">
                            <small class="help-block form-text">Maksimal hari ini</small>
                        </div>
                    </div>
                    <div class="row form-group" id="kembali">
                        <div class="col col-md-3">
                            <label for="text-input" class=" form-control-label">Tanggal Akhir</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="date" id="tgl_kembali" name="tgl_akhir" placeholder="Tanggal Akhir"
                                class="form-control" value="" max="<?php echo $tgl_hari_ini;?>">
                            <!-- <small class="help-block form-text">Masukkan Tanggal Kembali</small> -->
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-12">
                            Kosongkan jika akan mencetak seluruh data.
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="action" value="<?php echo $act;?>">
                    <button type="submit" class="btn btn-success" name="cetakxls"><i
                            class='fa fa-file-download fa-1x'></i> Download file.xls</button>
                    <button type="submit" class="btn btn-primary" name="print"><i class='fa fa-print fa-1x'></i>
                        Print</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include('footer.php');?>

<script>
if (document.getElementById("tgl_awal").value == '') {
    document.getElementById('kembali').style.display = 'none';
} else {
    document.getElementById('kembali').style.display = '';
}

function change_kembali() {
    document.getElementById('kembali').style.display = '';
    var tgl_ambil = document.getElementById("tgl_awal").value;
    document.getElementById("tgl_kembali").min = tgl_ambil;
}
</script>