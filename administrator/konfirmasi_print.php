<!DOCTYPE html>
<?php
    include('session.php');
    include('connection.php');

    $no_tracking="";
    $nama = "";
    $nik = "";
    $email = "";
    $npwp = "";
    $no_hp = "";
    $foto_ktp = "";
    $input_date = "";

    $status = "";
    $keterangan = "";
    $total_invoice = "";
    $tgl_input = "";
    $tgl_proses = "";
    $petugas = "";
    
    if(isset($_GET["n"])){
        $no_tracking=base64_decode($_GET["n"]);
    }
    
    if($no_tracking != ""){
        $query = "select d.*, p.nama, p.no_npwp, p.no_hp, p.email, p.foto_ktp, p.input_date from data_barang_faktur d, penerima p where d.no_cn = '$no_tracking' and p.nik = d.nik;";
            $result = mysqli_query($conn,$query);
            while ($row=mysqli_fetch_array($result)){
                $nama = $row["nama"];
                $nik = $row["nik"];
                $email = $row["email"];
                $npwp = $row["no_npwp"];
                $no_hp = $row["no_hp"];
                $foto_ktp = $row["foto_ktp"];
                $input_date = $row["input_date"];
                $status = $row["proses"];
                $keterangan = $row["keterangan"];
                $total_invoice = $row["total_invoice"];
                $tgl_input = $row["tgl_input"];
                $tgl_proses = $row["tgl_proses"];
                $petugas = $row["petugas_pemeriksa"];
            }
    }
?>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Hanggar IV BC | Pos Malang</title>
        <link rel="shortcut icon" href="gambar/logo_BC.png">
        
    </head>
    <body>
    
        <table border="1" align="center" style="border-collapse:collapse; width: 90%;" >
            <tr style="max-height: 250px;">
                <td style="width: 20%;"><img style="max-width: 150px; margin: 10px;" src="../administrator/gambar/logo_BC.png" alt="Logo BC"></td>
                <td style="margin: 10px;">
                    <h1 style="margin-left: 10px;">Bea Cukai Malang</h1>
                    <h2 style="margin-left: 10px;">Kantor Pos</h2>
                </td>
            </tr>
        </table>

        <br/>
        <table border="1" align="center" style="border-collapse:collapse; width: 90%;" >
            <tr>
                <td colspan="2" ><h3 style="margin-left: 10px;">Data Penerima Barang Impor</h3></td>
            </tr>
            <tr>
                <td style="width: 60%;">
                    <table border="0" style="width: 100%; margin: 5px; float: left;">
                        <tr>
                            <td style="width: 40%;"><b>NIK</b></td>
                            <td style="width: 2%;">:</td>
                            <td style="width: 58%;"><?php echo $nik; ?></td>
                        </tr>
                        <tr>
                            <td style="width: 40%;"><b>Nama</b></td>
                            <td style="width: 2%;">:</td>
                            <td style="width: 58%;"><?php echo $nama; ?></td>
                        </tr>
                        <tr>
                            <td style="width: 40%;"><b>Nomor Telepon</b></td>
                            <td style="width: 2%;">:</td>
                            <td style="width: 58%;"><?php echo $no_hp; ?></td>
                        </tr>
                        <tr>
                            <td style="width: 40%;"><b>Alamat Surel</b></td>
                            <td style="width: 2%;">:</td>
                            <td style="width: 58%;"><?php echo $email; ?></td>
                        </tr>
                        <tr>
                            <td style="width: 40%;"><b>Nomor NPWP</b></td>
                            <td style="width: 2%;">:</td>
                            <td style="width: 58%;"><?php echo $npwp; ?></td>
                        </tr>
                        <tr>
                            <td style="width: 40%;"><b>Tanggal Bergabung</b></td>
                            <td style="width: 2%;">:</td>
                            <td style="width: 58%;"><?php echo $input_date; ?></td>
                        </tr>
                        
                    </table>
                </td>
                <td style="width: 40%;"><img style="max-width: 300px; margin: 10px;" src="../administrator/images/<?php echo $foto_ktp; ?>" alt="Foto KTP"></td>
            </tr>
        </table>
    
        <br/>
        <table border="1" align="center" style="border-collapse:collapse; width: 90%;" >
            <tr>
                <td colspan="2" ><h3 style="margin-left: 10px;">Data Konfirmasi Barang Impor</h3></td>
            </tr>
            <tr>
                <td style="width: 50%;">
                    <table border="0" style="width: 100%; margin: 5px; float: left;">
                        <tr>
                            <td style="width: 40%;"><b>Nomor Tracking</b></td>
                            <td style="width: 2%;">:</td>
                            <td style="width: 58%;"><?php echo $no_tracking; ?></td>
                        </tr>
                        <tr>
                            <td style="width: 40%;"><b>Keterangan</b></td>
                            <td style="width: 2%;">:</td>
                            <td style="width: 58%;"><?php echo $keterangan; ?></td>
                        </tr>
                        <tr>
                            <td style="width: 40%;"><b>Total Faktur + Expedisi</b></td>
                            <td style="width: 2%;">:</td>
                            <td style="width: 58%;"><?php echo "Rp. ".$total_invoice; ?></td>
                        </tr>
                        <tr>
                            <td style="width: 40%;"><b>Tanggal ditambahkan</b></td>
                            <td style="width: 2%;">:</td>
                            <td style="width: 58%;"><?php echo $input_date; ?></td>
                        </tr>
                    </table>
                </td>
                <td style="width: 50%;">
                    <table border="0" style="width: 100%; margin: 5px; float: left;">
                        <tr>
                            <td style="width: 40%;"><b>Status</b></td>
                            <td style="width: 2%;">:</td>
                            <td style="width: 58%;">
                                <?php 
                                    if($status == "belum_diproses"){
                                        echo "Belum diproses";
                                    }else if($status == "telah_diproses"){
                                        echo "Telah diproses";
                                    } 
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 40%;"><b>Diproses oleh</b></td>
                            <td style="width: 2%;">:</td>
                            <td style="width: 58%;">
                                <?php 
                                    if($petugas != ""){
                                        $nama_petugas = "";
                                        $query = "select nama from akun_admin where id = '$petugas';";
                                        $result = mysqli_query($conn,$query);
                                        while ($row=mysqli_fetch_array($result)){
                                            $nama_petugas = $row["nama"]; 
                                        }
                                        echo $nama_petugas;
                                    }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 40%;"><b>Tanggal diproses</b></td>
                            <td style="width: 2%;">:</td>
                            <td style="width: 58%;"><?php echo $tgl_proses; ?></td>
                        </tr>
                        <tr>
                            <td style="width: 40%;"><b></b></td>
                            <td style="width: 2%;"></td>
                            <td style="width: 58%;"></td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>

        <?php
            $query1 = "select * from konfirmasi_foto_invoice where no_cn = '$no_tracking';";
            $result1 = mysqli_query($conn,$query1);
        ?>
        <br/>
        <table border="1" align="center" style="border-collapse:collapse; width: 90%;" >
            <tr>
                <td colspan="2" ><h3 style="margin-left: 10px;">Lampiran Data Konfirmasi Barang Impor</h3></td>
            </tr>
            <?php 
                $i = 0;
                while ($row1=mysqli_fetch_array($result1)){ 
                $i++;
            ?>
            <tr>
                <td>
                    <img style="max-width: 500px; max-height: 350px; margin: 10px;" src="../administrator/images/<?php echo $row1["nama_foto"]; ?>" alt="Lampiran">
                </td>
            </tr>
            <?php } ?>
        </table>

        <script>
            window.print();
        </script>
        
    </body>
</html>