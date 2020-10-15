<?php
    include "connection.php";

    $tgl_awal = $tgl_akhir = $jum_kat = $jumlah = $status = $jumlah_belum = $jumlah_telah = "";
    $tgl_hari_ini = date('Y-m-d');

    $act = "";
    $judul = "";
    $filter_tgl = "";
    $tgl_awal = "";
    $tgl_akhir = "";
    $tgl_akhir_fix = "";
    $tgl_awal_fix = "";
    $keterangan = "";
    $keterangan_tanggal = "";
    $query = "";
    $hidden_petugas = "";
    $hidden_status = "";


    if(isset($_GET["tgl_awal"]) && isset($_GET["tgl_akhir"])){
        $tgl_awal=$_GET["tgl_awal"];
        $tgl_akhir=$_GET["tgl_akhir"];
    }

    if($tgl_awal != "" && $tgl_akhir != ""){
        if( $tgl_akhir < $tgl_awal){
            $hidden_alert = "";
        }else{
            $query="select * from penerima where input_date between '$tgl_awal' and '$tgl_akhir' order by input_date asc, nama desc;";
            $result=mysqli_query($conn,$query) ;
        }
    }else{
        $query="select * from penerima order by input_date asc, nama desc;";
        $result=mysqli_query($conn,$query) ;
    }
    
    
?>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Pabean POS Malang || Bea Cukai</title>
    <link rel="shortcut icon" href="images/ggIcon.png">
</head>

<body>
    <?php
        header("Content-type: application/vnd-ms-excel");
        header("Content-Disposition: attachment; filename=Laporan_PenerimaBarangImpor_$tgl_hari_ini.xls");
    ?>

    <h3>Data Penerima Barang Impor
        <?php echo " | ".$judul; if(($tgl_awal and $tgl_akhir) != ""){echo "Tanggal : ".$tgl_awal." s/d ".$tgl_akhir;}?>
    </h3>

    <b>Data Penerima:</b>
    <table style="border: 1">
        <table class="table table-striped table-bordered" style="zoom: 90%;">
            <thead>
                <tr>
                    <th>#</th>
                    <th widht="60px">Tanggal</th>
                    <th>Nama Penerima</th>
                    <th>NIK</th>
                    <th>Nomor Telepon</th>
                    <th>Email</th>
                    <th>Nomor NPWP</th>
                    <th>Jumlah Konfirmasi</th>
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
                    <td><?php echo $row2["nama"]; ?></td>
                    <td><?php echo $row2["nik"]; ?></td>
                    <td><?php echo $row2["no_hp"]; ?></td>
                    <td><?php echo $row2["npwp"]; ?></td>
                    <td><?php echo $row2["no_npwp"]; ?></td>
                    <td>
                        <?php 
                                $jumlah = "";
                                $quer4 = "select count(no_cn) as jumlah FROM data_barang_faktur where nik = '$nik';";
                                $resu4=mysqli_query($conn,$quer4);
                                while ($row4=mysqli_fetch_array($resu4)){
                                    $jumlah = $row4["jumlah"];
                                }
                                echo $jumlah;
                        ?>
                    </td>
                </tr>
                <?php }?>
            </tbody>
        </table>
        <br />

</body>

</html>