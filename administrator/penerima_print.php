<!DOCTYPE html>
<?php
    include('session.php');
    include('connection.php');

    $nama = "";
    $nik = "";
    $email = "";
    $npwp = "";
    $no_hp = "";
    $foto_ktp = "";
    $input_date = "";

    if(isset($_GET["q"])){
        $nik=base64_decode($_GET["q"]);
    }  
    
    if($nik != ""){
        $query = "select * from penerima where nik = '$nik';";
        $result = mysqli_query($conn,$query);
        while ($row=mysqli_fetch_array($result)){
            $nama = $row["nama"];
            $nik = $row["nik"];
            $email = $row["email"];
            $npwp = $row["no_npwp"];
            $no_hp = $row["no_hp"];
            $foto_ktp = $row["foto_ktp"];
            $input_date = $row["input_date"];
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

        <?php
            $que = "select d.*, p.nama from data_barang_faktur d, penerima p where d.nik = p.nik and p.`nik` = '$nik' order by d.tgl_input desc, p.nama asc;";
            $result1 = mysqli_query($conn,$que);
        ?>
        <br/>
        <table border="1" align="center" style="border-collapse:collapse; width: 90%;" >
            <tr>
                <td colspan="2" ><h3 style="margin-left: 10px;">Data Konfirmasi Barang Impor oleh <?php echo $nama; ?></h3></td>
            </tr>
            <tr>
                <td>
                    <table border="1" style="border-collapse:collapse; width: 100%;">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal Input</th>
                                <th>Nomer CN</th>
                                <th>Keterangan</th>
                                <th>Total Harga Barang</th>
                                <th>Status</th>
                                <th>Diproses oleh</th>
                                <th>Tanggal diproses</th>
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
                                <td><?php echo $row1["no_cn"]; ?></td>
                                <td><?php echo $row1["keterangan"]; ?></td>
                                <td><?php echo "Rp. ".$row1["total_invoice"]; ?></td>
                                <td>
                                    <?php 
                                        if($row1["proses"] == "belum_diproses"){
                                            echo "Belum diproses";
                                        }else if($row1["proses"] == "telah_diproses"){
                                            echo "Telah diproses";
                                        }
                                    ?>
                                </td>
                                <td>
                                    <?php 
                                        $id_petugas = $row1["petugas_pemeriksa"];
                                        if($id_petugas != ""){
                                            $nama_petugas = "";
                                            $que6 = "select * from akun_admin where id = $id_petugas;";
                                            $res5=mysqli_query($conn,$que6);
                                            while ($row3=mysqli_fetch_array($res5)){
                                            $nama_petugas = $row3["nama"];
                                            }
                                            echo $nama_petugas;
                                        }else{
                                            echo "-";
                                        } 
                                    ?>
                                </td>
                                <td><?php echo $row1["tgl_proses"]; ?></td>
                            </tr>
                        <?php } ?>
                        </tfoot>
                    </table>
                </td>
            </tr>
        </table>

        <script>
            window.print();
        </script>
        
    </body>
</html>