
<?php 
  $nav_active = "akun";
  $act = "tabel_akun";
  include('header.php');
  include('connection.php');

  $query1 = "";
  $act = "";
  $hidden_status="";

  $query1 = "select * from akun_admin order by nama desc";
  $result1 = mysqli_query($conn,$query1);
  
?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Data Akun Admin</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Data Akun Admin</li>
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
                <h3 class="card-title">List Data Akun Admin</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body" style="overflow-x: scroll;">
                <table id="example1" class="table table-bordered table-striped text-center">
                  <thead>
                    <tr>
                      <th>Profile</th>
                      <th>Nama</th>
                      <th>NIP</th>
                      <th>No. Telp</th>
                      <th>Email</th>
                      <th>Jabatan</th>
                      <th width="60px"></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                      while ($row1=mysqli_fetch_array($result1)){
                    ?>
                    <tr>
                      <td><img src="images/<?php if($row1['foto_profil'] != ""){echo $row1['foto_profil'];}else{echo 'guest.png';} ?>" alt="foto profil <?php echo $row1["nama"]; ?>" class="img-circle mr-2" style="max-height: 80px"></td>
                      <td><?php echo $row1["nama"]; ?></td>
                      <td><?php echo $row1["id"]; ?></td>
                      <td><?php echo $row1["telp"]; ?></td>
                      <td><?php echo $row1["email"]; ?></td>
                      <td><?php echo $row1["jabatan"]; ?></td>
                      <td>
                          <a  href="akun_form.php?p=<?php echo base64_encode($row1["id"]);?>" class="btn btn-primary btn-sm" role="button" aria-pressed="true" > 
                            <i class='fas fa-book-open fa-1x'> </i> 
                          </a>
                          <a  href="akun_delete.php?nip=<?php echo $row1["id"];?>&act=<?php echo $act;?>" class="btn btn-primary btn-sm" role="button" aria-pressed="true"> 
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
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php include('footer.php');?>

 