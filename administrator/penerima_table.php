
<?php 
  $nav_active = "penerima";
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
        echo "<script> window.open('export_penerima.php?tgl_awal=$tgl_awal&tgl_akhir=$tgl_akhir', '_blank');</script>";
    }
  }

  $que = "select * from penerima order by input_date desc, nama asc;";
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
              <h1>Data Penerima </h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Data Penerima </li>
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
                <h3 class="card-title">List Data Penerima</h3>
                  <a href="" class="btn btn-primary btn-sm float-right" data-toggle="modal"
                      data-target="#exampleModalCenter" ><i class="fas fa-print fa-1x"></i> Laporan </button>
                </a>
              </div>
              <!-- /.card-header -->
              <div class="card-body" style="overflow-x: scroll;">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>KTP</th>
                      <th>Nama</th>
                      <th>NIK</th>
                      <th>Telepon</th>
                      <th>Bergabung</th>
                      <th width="50px"></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                      $n = 0;
                      while ($row1=mysqli_fetch_array($result1)){
                        $n++;
                    ?>
                    <tr>
                     <td><?php echo $n; ?></td>
                     <td><img src="images/<?php if($row1['foto_ktp'] != ""){echo $row1['foto_ktp'];}else{echo 'guest.png';} ?>" alt="foto profil <?php echo $row1["foto_ktp"]; ?>" class="mr-2" style="max-height: 80px"></td>
                      <td><a  href="penerima_detail.php?q=<?php echo base64_encode($row1["nik"]);?>" class="text-dark" role="button" aria-pressed="true" > 
                            <?php echo $row1["nama"]; ?> </a></td>
                      <td><?php echo $row1["nik"]; ?></td>
                      <td><?php echo $row1["no_hp"]; ?></td>
                      <td><?php echo $row1["input_date"]; ?></td>
                      <td>
                          <a  href="penerima_detail.php?q=<?php echo base64_encode($row1["nik"]);?>" class="btn btn-primary btn-sm" role="button" aria-pressed="true" > 
                            <i class='fas fa-book-open fa-1x'> </i> 
                          </a>
                          <a  href="delete_penerima.php?nik=<?php echo $row1["nik"];?>" class="btn btn-primary btn-sm" role="button" aria-pressed="true"> 
                            <i class='fa fa-trash-o fa-1x'> </i> 
                          </a>
                      </td>
                    </tr>
                    <?php } ?>
                
              </tfoot>
            </table>
          </div>
          <!-- /.card-body -->
          <div class="card-footer" <?php echo $hidden_status; ?>>
              <i class='fas fa-spinner fa-1x'> </i> Belum diproses | <i class='fas fa-check fa-1x'> </i> Telah diproses
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

 