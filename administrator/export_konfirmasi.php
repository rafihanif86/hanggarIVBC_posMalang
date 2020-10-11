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
            $query="SELECT * FROM penerima_npd where tgl_input between '$tgl_awal' and '$tgl_akhir' 
                and petugas_pemeriksa = '$id_petugas' and proses like '%telah_diproses%' order by tgl_input asc, nama_penerima desc;";
            $result=mysqli_query($conn,$query) ;
        }else{
            $query="SELECT * FROM penerima_npd where tgl_input between '$tgl_awal' and '$tgl_akhir' order by tgl_input asc, nama_penerima desc;";
            $result=mysqli_query($conn,$query) ;
        }
    }else{
        if($id_petugas != ""){
            $query="SELECT * FROM penerima_npd where petugas_pemeriksa = '$id_petugas' and  proses like '%telah_diproses%' order by tgl_input asc, nama_penerima desc;";
        }else{
            $query="SELECT * FROM penerima_npd order by tgl_input asc, nama_penerima desc;";
        }
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
        header("Content-Disposition: attachment; filename=data_konfirmasiNPD_$tgl_hari_ini.xls");
    ?>

    <h3>Data Konfirmasi Barang NPD
        <?php echo " | ".$judul; if(($tgl_awal and $tgl_akhir) != ""){echo "Tanggal : ".$tgl_awal." s/d ".$tgl_akhir;}?>
    </h3>

    <b>Data peminjaman:</b>
    <table style="border: 1">
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
                    <th width="80px"><?php if($hidden_status == "hidden"){echo "Petugas";}else{echo "Status";}?></th>
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
                    <td><?php echo $row2["nama_penerima"]; ?></td>
                    <td><?php echo $row2["no_hp"]; ?></td>
                    <td><?php echo $row2["npwp"]; ?></td>
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
                <?php }?>
            </tbody>
        </table>
        <br />

</body>

</html>