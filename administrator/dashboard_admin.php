<?php 
  include('header.php');
  $tahun = date('Y');
  $bulan = date('m');  
  $tanggal = date('yy-m-d');

  $jumlah_konfirmasi = "";
  $jumlah_barang = "";
  for($i = 1; $i <= 12; $i++){
    $que16 = "SELECT COUNT(no_cn) AS jumlah FROM penerima_npd WHERE MONTH(`tgl_input`) = '$i' and YEAR(`tgl_input`) = '$tahun';";
    $res16=mysqli_query($conn,$que16);
    while ($row2=mysqli_fetch_array($res16)){
      $jumlah ="";
      if($i == 12){
        $jumlah = $row2["jumlah"];
      }else{
        $jumlah = $row2["jumlah"].",";
      }
      $jumlah_konfirmasi .= $jumlah;
      
    }

    $que17 = "SELECT COUNT(tgl_pengecekan_barang) AS jumlah FROM data_barang_npd WHERE MONTH(`tgl_pengecekan_barang`) = '$i' AND YEAR(`tgl_pengecekan_barang`) = '$tahun';";
    $res17=mysqli_query($conn,$que17);
    while ($row2=mysqli_fetch_array($res17)){
      $jumlah ="";
      if($i == 12){
        $jumlah = $row2["jumlah"];
      }else{
        $jumlah = $row2["jumlah"].",";
      }
      $jumlah_barang .= $jumlah;
    }
  }
  
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard Konfirmasi Barang NPD <?php echo $tahun; ?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Info boxes -->
        <div class="row">
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-file-invoice"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total Konfirmasi</span>
                <span class="info-box-number">
                  <?php 
                    $que1 = "SELECT COUNT(no_cn) AS jumlah_total FROM penerima_npd;";
                    $res1=mysqli_query($conn,$que1);
                    while ($row1=mysqli_fetch_array($res1)){
                        echo $row1["jumlah_total"];
                    }
                  ?>  
                  <small>Data</small>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-file-invoice"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Konfirmasi Tahun Ini</span>
                <span class="info-box-number">
                  <?php
                    $que2 = "SELECT COUNT(no_cn) AS jumlah_total FROM penerima_npd WHERE YEAR(tgl_input) = '$tahun';";
                    $res2=mysqli_query($conn,$que2);
                    while ($row1=mysqli_fetch_array($res2)){
                        echo $row1["jumlah_total"];
                    }
                  ?>
                  <small>Data</small>
               </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

          <!-- fix for small devices only -->
          <!-- <div class="clearfix hidden-md-up"></div> -->

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-file-invoice"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Konfirmasi Bulan ini</span>
                <span class="info-box-number">
                  <?php
                    $que3 = "SELECT COUNT(no_cn) AS jumlah_total FROM penerima_npd WHERE YEAR(tgl_input) = '$tahun' AND MONTH(tgl_input) = '$bulan';";
                    $res3=mysqli_query($conn,$que3);
                    while ($row1=mysqli_fetch_array($res3)){
                        echo $row1["jumlah_total"];
                    }
                  ?>
                  <small>Data</small>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-file-invoice"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Konfirmasi Hari Ini</span>
                <span class="info-box-number">
                  <?php
                    $que4 = "SELECT COUNT(no_cn) AS jumlah_total FROM penerima_npd WHERE DATE(tgl_input) = '$tanggal';";
                    $res4=mysqli_query($conn,$que4);
                    while ($row1=mysqli_fetch_array($res4)){
                        echo $row1["jumlah_total"];
                    }
                  ?>
                  <small>Data</small>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

        </div>
        <!-- /.row -->

        <div class="row">
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-box-open"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total Barang NPD</span>
                <span class="info-box-number">
                <?php 
                    $que5 = "SELECT COUNT(no_cn) AS jumlah_total FROM data_barang_npd;";
                    $res5=mysqli_query($conn,$que5);
                    while ($row1=mysqli_fetch_array($res5)){
                        echo $row1["jumlah_total"];
                    }
                  ?>  
                  <small>Data</small>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-box-open"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Barang NPD Tahun Ini</span>
                <span class="info-box-number">
                <?php
                    $que6 = "SELECT COUNT(no_cn) AS jumlah_total FROM data_barang_npd WHERE YEAR(tgl_pengecekan_barang) = '$tahun';";
                    $res6=mysqli_query($conn,$que6);
                    while ($row1=mysqli_fetch_array($res6)){
                        echo $row1["jumlah_total"];
                    }
                  ?>
                  <small>Data</small>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

          <!-- fix for small devices only -->
          <!-- <div class="clearfix hidden-md-up"></div> -->

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-box-open"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Barang NPD Bulan ini</span>
                <span class="info-box-number">
                <?php
                    $que7 = "SELECT COUNT(no_cn) AS jumlah_total FROM data_barang_npd WHERE YEAR(tgl_pengecekan_barang) = '$tahun' AND MONTH(tgl_pengecekan_barang) = '$bulan';";
                    $res7=mysqli_query($conn,$que7);
                    while ($row1=mysqli_fetch_array($res7)){
                        echo $row1["jumlah_total"];
                    }
                  ?>
                  <small>Data</small>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-box-open"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Barang NPD Hari Ini</span>
                <span class="info-box-number">
                  <?php
                    $que8 = "SELECT COUNT(no_cn) AS jumlah_total FROM data_barang_npd WHERE DATE(tgl_pengecekan_barang) = '$tanggal';";
                    $res8=mysqli_query($conn,$que8);
                    while ($row1=mysqli_fetch_array($res8)){
                        echo $row1["jumlah_total"];
                    }
                  ?>
                  <small>Data</small>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          
        </div>
        <!-- /.row -->

      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header border-0">
              <div class="d-flex justify-content-between">
                <h3 class="card-title">Grafik Konfirmasi Barang NPD <?php echo $tahun; ?> </h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
            </div>
            <div class="card-body">

              <div class="position-relative mb-4">
                <canvas id="bulanan-chart" height="200"></canvas>
              </div>

              <div class="d-flex flex-row justify-content-end">
                <span class="mr-2">
                  <i class="fas fa-square text-primary"></i> Data konfirmasi
                </span>

                <span>
                  <i class="fas fa-square text-gray"></i> Data Barang NPD
                </span>
              </div>
            </div>
          </div>
          <!-- /.card -->
        </div><!-- col  -->
      </div><!-- row -->

      <div class ="row">
          <!-- /.row -->
          <div class="col-md-<?php if($_SESSION['status'] == "checker"){echo "12";}else{echo "6";}?>">
            <div class="card">
              <div class="card-header border-transparent">
                <h3 class="card-title">Pengimpor Tersering</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <div class="table-responsive card-body" style="overflow-x: scroll;">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th>Nama</th>
                      <th>NIK</th>
                      <th>Telepon</th>
                      <th width ="3"></th>
                      <th width ="3"><i class="fas fa-box-open fa-1x"></i></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                      $que13 = "SELECT COUNT(nik) AS jumlah_transaksi, `nama_penerima`, `nik`, `no_hp`  FROM penerima_npd GROUP BY nik, no_hp, nama_penerima ORDER BY jumlah_transaksi, nama_penerima DESC;";
                      $res13=mysqli_query($conn,$que13);
                      while ($row1=mysqli_fetch_array($res13)){
                    ?>
                    <tr>
                      <td><?php echo $row1["nama_penerima"];?></td>
                      <td><?php echo $row1["nik"];?></td>
                      <td><?php echo $row1["no_hp"];?></td>
                      <td>
                        <?php $noPottong = substr($row1["no_hp"],1);?>
                        <a href="https://api.whatsapp.com/send?phone=<?php echo "+62" .$noPottong; ?>&text=Halo" target="_blank" class="btn btn-primary btn-sm">
                            <i class="fab fa-whatsapp fa-1x"></i>
                        </a>
                      </td>
                      <td><?php echo $row1["jumlah_transaksi"];?></td>
                    </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                </div>
                <!-- /.table-responsive -->
              </div>
              <!-- /.card-body -->
              <div class="card-footer clearfix">
                <div class="text-secondary">Tabel ini berisikian nama yang sering melakukan import</div>
              </div>
              <!-- /.card-footer -->
            </div>
            <!-- /.card -->
          </div><!-- col -->

          <div class="col-md-6" <?php if($_SESSION['status'] == "checker"){echo "hidden";}?>>
            <div class="card">
              <div class="card-header border-transparent">
                <h3 class="card-title">Pengimpor Tersering</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <div class="table-responsive card-body" style="overflow-x: scroll;">
                  <table id="example3" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th>Nama</th>
                      <th>NIP</th>
                      <th width = "3"><i class="fas fa-file-invoice fa-1x"></i></th>
                      <th width = "3"><i class="fas fa-box-open fa-1x"></i></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                      $que14 = "SELECT *  FROM akun_admin;";
                      $res14=mysqli_query($conn,$que14);
                      while ($row1=mysqli_fetch_array($res14)){
                    ?>
                    <tr>
                      <td>
                        <a  href="akun_form.php?nip=<?php echo $row1["id"];?>" role="button" aria-pressed="true" >
                        <?php echo $row1["nama"];?>
                        </a>
                      </td>
                      <td><?php $id = $row1["id"]; echo $id;?></td>
                      <td>
                        <?php
                          $que15 = "SELECT COUNT(p.`petugas_pemeriksa`) AS jumlah_dikonfirmasi 
                            FROM akun_admin a, `penerima_npd` p WHERE p.`petugas_pemeriksa` = a.`id` and a.`id` = '$id' 
                            GROUP BY p.`petugas_pemeriksa`;";
                          $res15=mysqli_query($conn,$que15);
                          while ($row2=mysqli_fetch_array($res15)){
                            echo $row2["jumlah_dikonfirmasi"];
                          }
                        ?>
                      </td>
                      <td>
                        <?php 
                          $que16 = "SELECT COUNT(d.`petugas_pemeriksa`) AS jumlah_pemeriksaan 
                          FROM akun_admin a, `data_barang_npd` d WHERE d.`petugas_pemeriksa` = a.`id` and a.`id` = '$id' 
                          GROUP BY d.`petugas_pemeriksa`;";
                          $res16=mysqli_query($conn,$que16);
                          while ($row2=mysqli_fetch_array($res16)){
                            echo $row2["jumlah_pemeriksaan"];
                          }
                        ?>
                      </td>
                    </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                </div>
                <!-- /.table-responsive -->
              </div>
              <!-- /.card-body -->
              <div class="card-footer clearfix">
                <div class="text-secondary">
                  <i class="fas fa-file-invoice fa-1x"></i> Jumlah konfirmasi yang telah diproses <br/>
                  <i class="fas fa-box-open fa-1x"></i> Jumlah barang import yang diperiksa
              </div>
              </div>
              <!-- /.card-footer -->
            </div>
            <!-- /.card -->
          </div><!-- col -->

        </div> <!-- row -->

        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
          <div class="col-md-4">
            <!-- USERS LIST -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Petugas Aktif</h3>
                
                <div class="card-tools">
                  <span class="badge badge-warning">
                  <?php
                    $que9 = "SELECT COUNT(login_status) AS jumlah_login FROM akun_admin WHERE login_status = 'login';";
                    $res9=mysqli_query($conn,$que9);
                    while ($row1=mysqli_fetch_array($res9)){
                        echo $row1["jumlah_login"];
                    }
                  ?>  
                   Online Members</span>
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <ul class="users-list clearfix">
                  <?php
                    $foto_profil = "guest.png";
                    $que10 = "SELECT * FROM akun_admin WHERE login_status = 'login';";
                    $res10=mysqli_query($conn,$que10);
                    while ($row1=mysqli_fetch_array($res10)){
                      if($row1["foto_profil"] != ""){
                        $foto_profil = $row1["foto_profil"];
                      }
                  ?>  
                  <li>
                    <img src="images/<?php echo $foto_profil;?>" alt="User Image">
                    <div class="users-list-name" ><?php echo $row1["nama"];?></div>
                    <span class="users-list-date">NIP. <?php echo $row1["id"];?></span>
                  </li>
                  <?php } ?>
                </ul>
                <!-- /.users-list -->
              </div>
              <!-- /.card-body -->
              <!-- /.card-footer -->
            </div>
            <!--/.card -->
          </div>
          <!-- /.col -->

          <div class="col-md-4">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Konfirmasi Terbaru</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <ul class="products-list product-list-in-card pl-2 pr-2">
                  <?php
                    
                    $que11 = "SELECT * FROM penerima_npd WHERE proses = 'belum_diproses' ORDER BY tgl_input DESC LIMIT 5;";
                    $res11=mysqli_query($conn,$que11);
                    while ($row1=mysqli_fetch_array($res11)){
                  ?>
                  <li class="item">
                    <div class="product-img">
                      <div  class="btn btn-primary btn-md"><i class="fas fa-file-invoice fa-2x"></i> </div>
                    </div>
                    <div class="product-info">
                      <a href="konfirmasi_form.php?noTracking=<?php echo $row1["no_cn"];?>" class="product-title"><?php echo $row1["no_cn"];?>
                        <span class="badge badge-warning float-right">Rp. <?php echo $row1["total_invoice"];?></span></a>
                      <span class="product-description">
                        <?php echo $row1["nama_penerima"] ." | ". $row1["keterangan"];?>
                      </span>
                    </div>
                  </li>
                    <?php } ?>
                  <!-- /.item -->
                </ul>
              </div>
              <!-- /.card-body -->
              <div class="card-footer text-center">
                <a href="konfirmasi_table.php?status=belum_diproses" class="uppercase">Lihat Seluruh</a>
              </div>
              <!-- /.card-footer -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /. col -->

          <div class="col-md-4">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Barang NPD Belum Konfirmasi</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <ul class="products-list product-list-in-card pl-2 pr-2">
                  <?php
                    $que12 = "SELECT d.* FROM data_barang_npd D LEFT OUTER JOIN penerima_npd P ON d.`no_cn` = p.`no_cn` WHERE p.`no_cn` IS NULL ORDER BY d.`tgl_pengecekan_barang` DESC LIMIT 5;";
                    $res12=mysqli_query($conn,$que12);
                    while ($row1=mysqli_fetch_array($res12)){
                  ?>
                  <li class="item">
                    <div class="product-img">
                      <div  class="btn btn-primary btn-md"><i class="fas fa-file-invoice fa-2x"></i> </div>
                    </div>
                    <div class="product-info">
                      <a href="barang_form.php?noTracking=<?php echo $row1["no_cn"];?>" class="product-title"><?php echo $row1["no_cn"];?>
                        <span class="badge badge-warning float-right"><?php echo $row1["kategori_barang"];?></span></a>
                      <span class="product-description">
                        <?php echo $row1["nama_penerima"] ." | ". $row1["keterangan_barang"];?>
                      </span>
                    </div>
                  </li>
                    <?php } ?>
                  <!-- /.item -->
                </ul>
              </div>
              <!-- /.card-body -->
              <div class="card-footer text-center">
                <a href="barang_table.php?status=belum_konfirmasi" class="uppercase">Lihat Seluruh</a>
              </div>
              <!-- /.card-footer -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /. col -->
        </div><!-- row -->

        
      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE -->
<script src="dist/js/adminlte.js"></script>

<!-- OPTIONAL SCRIPTS -->
<script src="plugins/chart.js/Chart.min.js"></script>
<script src="dist/js/demo.js"></script>

<script>
  $(function () {
    'use strict'
  
    var ticksStyle = {
      fontColor: '#495057',
      fontStyle: 'bold'
    }
  
    var mode      = 'index'
    var intersect = true

    var jumlah_konfirmasi = "<?php echo $jumlah_konfirmasi;?>"
    var jumlah_barang = "<?php echo $jumlah_barang;?>"
    var konfirmasi = jumlah_konfirmasi.split(',')
    var barang = jumlah_barang.split(',')
  
    var $salesChart = $('#bulanan-chart')
    var salesChart  = new Chart($salesChart, {
      type   : 'bar',
      data   : {
        labels  : ['JAN','FEB','MAR','APR','MEI','JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DES'],
        datasets: [
          {
            backgroundColor: '#007bff',
            borderColor    : '#007bff',
            data           : [konfirmasi[0],konfirmasi[1],konfirmasi[2],konfirmasi[3],konfirmasi[4],konfirmasi[5],konfirmasi[6],konfirmasi[7],konfirmasi[8],konfirmasi[9],konfirmasi[10],konfirmasi[11]]
          },
          {
            backgroundColor: '#ced4da',
            borderColor    : '#ced4da',
            data           : [barang[0],barang[1],barang[2],barang[3],barang[4],barang[5],barang[6],barang[7],barang[8],barang[9],barang[10],barang[11]]
          }
        ]
      },
      options: {
        maintainAspectRatio: false,
        tooltips           : {
          mode     : mode,
          intersect: intersect
        },
        hover              : {
          mode     : mode,
          intersect: intersect
        },
        legend             : {
          display: false
        },
        scales             : {
          yAxes: [{
            // display: false,
            gridLines: {
              display      : true,
              lineWidth    : '4px',
              color        : 'rgba(0, 0, 0, .2)',
              zeroLineColor: 'transparent'
            },
            ticks    : $.extend({
              beginAtZero: true,
  
              // Include a dollar sign in the ticks
              callback: function (value, index, values) {
                if (value >= 1000) {
                  value /= 1000
                  value += 'k'
                }
                return value
              }
            }, ticksStyle)
          }],
          xAxes: [{
            display  : true,
            gridLines: {
              display: false
            },
            ticks    : ticksStyle
          }]
        }
      }
    })

  })
</script>
<?php include('footer.php');?>