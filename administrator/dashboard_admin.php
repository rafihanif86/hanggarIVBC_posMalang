<?php 
  include('header.php');
  $tahun = date('Y');
  $bulan = date('m');  
  $tanggal = date('yy-m-d');

  $jumlah_konfirmasi = "";
  $jumlah_barang = "";
  for($i = 1; $i <= 12; $i++){
    $que16 = "select count(no_cn) as jumlah from data_barang_faktur where month(`tgl_input`) = '$i' and year(`tgl_input`) = '$tahun';";
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
                                  $que1 = "select count(no_cn) as jumlah_total from data_barang_faktur;";
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
                                    $que2 = "select count(no_cn) as jumlah_total from data_barang_faktur where year(tgl_input) = '$tahun';";
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
                                  $que3 = "select count(no_cn) as jumlah_total from data_barang_faktur where year(tgl_input) = '$tahun' and month(tgl_input) = '$bulan';";
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
                                    $que4 = "select count(no_cn) as jumlah_total from data_barang_faktur where date(tgl_input) = '$tanggal';";
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
                <div class="col-md-4">
                    <!-- USERS LIST -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Petugas Aktif</h3>

                            <div class="card-tools">
                                <span class="badge badge-warning">
                                    <?php
                                        $que9 = "select count(login_status) as jumlah_login from akun_admin where login_status = 'login';";
                                        $res9=mysqli_query($conn,$que9);
                                        while ($row1=mysqli_fetch_array($res9)){
                                            echo $row1["jumlah_login"];
                                        }
                                    ?>
                                    Online Members</span>
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                        class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove"><i
                                        class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0">
                            <ul class="users-list clearfix">
                                <?php
                                    $foto_profil = "guest.png";
                                    $que10 = "select * from akun_admin where login_status = 'login';";
                                    $res10=mysqli_query($conn,$que10);
                                    while ($row1=mysqli_fetch_array($res10)){
                                    if($row1["foto_profil"] != ""){
                                        $foto_profil = $row1["foto_profil"];
                                    }
                                ?>
                                <li>
                                    <img src="images/<?php echo $foto_profil;?>" alt="User Image">
                                    <div class="users-list-name"><?php echo $row1["nama"];?></div>
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
                <div class="col-lg-8">
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

            <div class="row">
                <!-- /.row -->
                <div class="col-md-6">
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
                                            <th style="width: 5px;">No</th>
                                            <th>Nama</th>
                                            <th>Telepon</th>
                                            <th width="3"><i class="fas fa-box-open fa-1x"></i></th>
                                            <th width="3"></th>
                                            <th width="3"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                          $que13 = "select count(d.no_cn) as jumlah_transaksi, p.`nama`, d.`nik`, p.`no_hp`  from data_barang_faktur d, penerima p where d.nik = p.nik group by d.nik order by jumlah_transaksi desc;";
                                          $res13=mysqli_query($conn,$que13);
                                          $a=0;
                                          while ($row1=mysqli_fetch_array($res13)){
                                              $a++;
                                        ?>
                                        <tr>
                                            <td><?php echo $a;?></td>
                                            <td><?php echo $row1["nama"];?></td>
                                            <td><?php echo $row1["no_hp"];?></td>
                                            <td><?php echo $row1["jumlah_transaksi"];?></td>
                                            <td>
                                                <?php $noPottong = substr($row1["no_hp"],1);?>
                                                <a href="https://api.whatsapp.com/send?phone=<?php echo "+62" .$noPottong; ?>&text=Halo"
                                                    target="_blank" class="btn btn-primary btn-sm">
                                                    <i class="fab fa-whatsapp fa-1x"></i>
                                                </a>
                                            </td>
                                            <td>
                                                <a href="penerima_detail.php?q=<?php echo  base64_encode($row1["nik"]); ?>" class="btn btn-primary btn-sm">
                                                    <i class="fas fa-external-link-alt fa-1x"></i>
                                                </a>
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
                            <div class="text-secondary">Tabel ini berisikian nama yang sering melakukan import</div>
                        </div>
                        <!-- /.card-footer -->
                    </div>
                    <!-- /.card -->
                </div><!-- col -->

                <div class="col-md-6">
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
                                    $que11 = "select d.*, p.`nama` from data_barang_faktur d, penerima p where p.`nik` = d.`nik` and d.proses = 'belum_diproses' order by tgl_input desc LIMIT 5;";
                                    $res11=mysqli_query($conn,$que11);
                                    while ($row1=mysqli_fetch_array($res11)){
                                ?>
                                <li class="item">
                                    <div class="product-img">
                                        <div class="btn btn-primary btn-md"><i class="fas fa-file-invoice fa-2x"></i>
                                        </div>
                                    </div>
                                    <div class="product-info">
                                        <a href="konfirmasi_form.php?noTracking=<?php echo $row1["no_cn"];?>"
                                            class="product-title"><?php echo $row1["no_cn"];?>
                                            <span class="badge badge-warning float-right">Rp.
                                                <?php echo $row1["total_invoice"];?></span></a>
                                        <span class="product-description">
                                            <?php echo $row1["nama"] ." | ". $row1["keterangan"];?>
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

                
            </div> <!-- row -->


        </div> <!--/. container-fluid -->
    </section><!-- /.content -->

    </div><!-- /.content-wrapper -->

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
$(function() {
    'use strict'

    var ticksStyle = {
        fontColor: '#495057',
        fontStyle: 'bold'
    }

    var mode = 'index'
    var intersect = true

    var jumlah_konfirmasi = "<?php echo $jumlah_konfirmasi;?>"
    var jumlah_barang = "<?php echo $jumlah_barang;?>"
    var konfirmasi = jumlah_konfirmasi.split(',')
    var barang = jumlah_barang.split(',')

    var $salesChart = $('#bulanan-chart')
    var salesChart = new Chart($salesChart, {
        type: 'bar',
        data: {
            labels: ['JAN', 'FEB', 'MAR', 'APR', 'MEI', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV',
                'DES'
            ],
            datasets: [{
                    backgroundColor: '#007bff',
                    borderColor: '#007bff',
                    data: [konfirmasi[0], konfirmasi[1], konfirmasi[2], konfirmasi[3], konfirmasi[
                            4], konfirmasi[5], konfirmasi[6], konfirmasi[7], konfirmasi[8],
                        konfirmasi[9], konfirmasi[10], konfirmasi[11]
                    ]
                },
                {
                    backgroundColor: '#ced4da',
                    borderColor: '#ced4da',
                    data: [barang[0], barang[1], barang[2], barang[3], barang[4], barang[5], barang[
                        6], barang[7], barang[8], barang[9], barang[10], barang[11]]
                }
            ]
        },
        options: {
            maintainAspectRatio: false,
            tooltips: {
                mode: mode,
                intersect: intersect
            },
            hover: {
                mode: mode,
                intersect: intersect
            },
            legend: {
                display: false
            },
            scales: {
                yAxes: [{
                    // display: false,
                    gridLines: {
                        display: true,
                        lineWidth: '4px',
                        color: 'rgba(0, 0, 0, .2)',
                        zeroLineColor: 'transparent'
                    },
                    ticks: $.extend({
                        beginAtZero: true,

                        // Include a dollar sign in the ticks
                        callback: function(value, index, values) {
                            if (value >= 1000) {
                                value /= 1000
                                value += 'k'
                            }
                            return value
                        }
                    }, ticksStyle)
                }],
                xAxes: [{
                    display: true,
                    gridLines: {
                        display: false
                    },
                    ticks: ticksStyle
                }]
            }
        }
    })

})
</script>
<?php include('footer.php');?>