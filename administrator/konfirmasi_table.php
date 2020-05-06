
<?php 
  $nav_active = "konfirmasi";
  include('connection.php');

  $que = "";
  $judul = "";
  $act = "";
  $hidden_status = "hidden";

  if(isset($_GET["status"])){
    $act = $_GET["status"];
    if($act == "belum_diproses"){
      $judul = "Belum Diproses";
      $que = "SELECT * FROM penerima_npd where proses like '%belum_diproses%' order by tgl_input asc, nama_penerima asc;";
    }else if($act == "telah_diproses"){
      $judul = "Telah Diproses";
      $hidden_status = "";
      $que = "SELECT * FROM penerima_npd where proses like '%telah_diproses%' order by tgl_input asc, nama_penerima asc;";
    }
  }else{
    $act="seluruh";
    $judul = "Seluruh";
    $hidden_status = "";
    $que = "SELECT * FROM penerima_npd order by tgl_input asc, nama_penerima asc;";
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
                <a  href="konfirmasi_report_date.php?status=<?php echo $act;?>" class="btn btn-primary btn-sm float-right" role="button" aria-pressed="true"
                  <?php 
                    if($_SESSION['status'] == "checker"){
                      if($act == "belum_diproses" || $act == "seluruh"){
                        echo "hidden";
                      }
                    }
                  ?>
                > 
                  Cetak Laporan <i class='fa fa-print fa-1x'> </i> 
                </a>
              </div>
              <!-- /.card-header -->
              <div class="card-body" style="overflow-x: scroll;">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Tanggal Input</th>
                      <th>Nomer CN</th>
                      <th>Nama Penerima</th>
                      <th>Nomer HP</th>
                      <th>Total Harga Barang</th>
                      <th <?php echo $hidden_status; ?>>Diproses oleh</th>
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
                          <a  href="konfirmasi_form.php?noTracking=<?php echo $row1["no_cn"];?>" class="btn btn-primary btn-sm" role="button" aria-pressed="true" > 
                            <i class='fas fa-book-open fa-1x'> </i> 
                          </a>
                          <a  href="delete_konfirmasi.php?no_cn=<?php echo $row1["no_cn"];?>&act=<?php echo $act;?>" class="btn btn-primary btn-sm" role="button" aria-pressed="true"> 
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

<?php include('footer.php');?>

 