
<?php 
  $nav_active = "barang";
  
  include('connection.php');

  $quei = "";
  $judul = "";
  $act = "";
  $hidden_status="";
  if(isset($_GET["status"])){
    $act = $_GET["status"];
    if($act == "belum_diproses"){
      $judul = "Belum Diproses";
      $hidden_status="hidden";
      $quei = "SELECT d.`tgl_pengecekan_barang`, d.`no_cn`, d.`petugas_pemeriksa`, d.`nama_penerima`, d.`alamat_penerima`, d.`alamat_pengirim`, d.`kategori_barang`, p.`total_invoice`, p.`proses` 
                   FROM data_barang_npd d, penerima_npd p WHERE d.`no_cn` = p.`no_cn` AND p.`proses` = 'belum_diproses' ORDER BY d.`tgl_pengecekan_barang` ASC, d.`no_cn` ASC;";
    }else if($act == "telah_diproses"){
      $judul = "Telah Diproses";
      $hidden_status="hidden";
      $quei = "SELECT d.`tgl_pengecekan_barang`, d.`no_cn`, d.`petugas_pemeriksa`, d.`nama_penerima`, d.`alamat_penerima`, d.`alamat_pengirim`, d.`kategori_barang`, p.`total_invoice`, p.`proses`
                   FROM data_barang_npd d, penerima_npd p WHERE d.`no_cn` = p.`no_cn` AND p.`proses` = 'telah_diproses' ORDER BY d.`tgl_pengecekan_barang` ASC, d.`no_cn` ASC;";
    }else if($act == "telah_konfirmasi"){
      $judul = "Telah Konfirmasi";
      $hidden_status="hidden";
      $quei = "SELECT d.`tgl_pengecekan_barang`, d.`no_cn`, d.`petugas_pemeriksa`, d.`nama_penerima`, d.`alamat_penerima`, d.`alamat_pengirim`, d.`kategori_barang`, p.`total_invoice`, p.`proses` FROM data_barang_npd d, penerima_npd p WHERE d.`no_cn` = p.`no_cn` ORDER BY d.`tgl_pengecekan_barang` DESC, d.`no_cn` ASC;";
    }else if($act == "belum_konfirmasi"){
      $judul = "Belum Konfirmasi";
      $hidden_status="hidden";
      $quei = "SELECT d.`tgl_pengecekan_barang`, d.`no_cn`, d.`petugas_pemeriksa`, d.`nama_penerima`, d.`alamat_penerima`, d.`alamat_pengirim`, d.`kategori_barang` FROM data_barang_npd d LEFT OUTER JOIN penerima_npd p on d.`no_cn` = p.`no_cn` where p.`no_cn` IS NULL ORDER BY d.`tgl_pengecekan_barang` DESC, d.`no_cn` ASC;";
    }
  }else{
    $judul = "Seluruh Barang";
    $hidden_status="";
    $quei = "SELECT d.`tgl_pengecekan_barang`, d.`no_cn`, d.`nama_penerima`, d.`alamat_penerima`, d.`alamat_pengirim`, d.`kategori_barang`, d.`petugas_pemeriksa`, p.`total_invoice`, p.`proses` FROM data_barang_npd d LEFT JOIN penerima_npd p ON d.`no_cn` = p.`no_cn` ORDER BY d.`tgl_pengecekan_barang` DESC, d.`no_cn` ASC; ";
  }
  $hasil = mysqli_query($conn,$quei);
  include('header.php');
  
?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Data Barang NPD</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Data Barang NPD</li>
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
                <h3 class="card-title">List Data barang NPD - <?php echo $judul; ?></h3>
                <a  href="barang_report_date.php?status=<?php echo $act;?>" class="btn btn-primary btn-sm float-right" role="button" aria-pressed="true"
                  <?php 
                    if($_SESSION['status'] == "checker"){
                      if($act == ""){
                        echo "";
                      }else{
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
                      <th>Tanggal Masuk</th>
                      <th>Nomer CN</th>
                      <th>Petugas</th>
                      <th>Nama Penerima</th>
                      <th>Alamat Penerima</th>
                      <th>Alamat Pengirim</th>
                      <th>Kategori Barang</th>
                      <th <?php echo $hidden_status; ?>>Total Harga Barang</th>
                      <th <?php echo $hidden_status; ?> width="3px" ></th>
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
                      <td><?php 
                        $nip_pemeriksa = $row1["petugas_pemeriksa"];
                        $que11 = "SELECT * FROM akun_admin WHERE id = '$nip_pemeriksa';";
                        $res11=mysqli_query($conn,$que11);
                        while ($row2=mysqli_fetch_array($res11)){
                          echo $row2["nama"];
                        } ?></td>
                      <td><?php echo $row1["nama_penerima"]; ?></td>
                      <td><?php echo $row1["alamat_penerima"]; ?></td>
                      <td><?php echo $row1["alamat_pengirim"]; ?></td>
                      <td><?php echo $row1["kategori_barang"]; ?></td>
                      <td <?php echo $hidden_status; ?>><?php if($hidden_status == ""){echo $row1["total_invoice"];} ?></td>
                      <td <?php echo $hidden_status; ?>>
                        <?php 
                          if($hidden_status == ""){
                            if ($row1["proses"] == "belum_diproses"){
                              echo "<i class='fas fa-spinner fa-1x'> </i>";
                            }else if ($row1["proses"] == "telah_diproses"){
                              echo "<i class='fas fa-check fa-1x'> </i>";
                            }else if ($row1["proses"] == ""){
                              echo "<i class='fas fa-times fa-1x'> </i>";
                            }
                          } 
                        ?>
                      </td>
                      <td>
                          <a  href="barang_form.php?noTracking=<?php echo $row1["no_cn"];?>" class="btn btn-primary btn-sm" role="button" aria-pressed="true"> 
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
            <div class="card-footer" <?php echo $hidden_status; ?>>
              <i class='fas fa-times fa-1x'> </i> Belum dikonfirmasi | <i class='fas fa-spinner fa-1x'> </i> Belum diproses | <i class='fas fa-check fa-1x'> </i> Telah diproses
            </div>
          </div>
          <!-- /.card-body -->
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

 