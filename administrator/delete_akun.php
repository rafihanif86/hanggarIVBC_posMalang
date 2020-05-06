<?php
    include "connection.php";

    $nip=$_GET["nip"];

    if($noTracking != null){
        $jumlahData = ""; 
        $foto_profil = "";

        $query = "SELECT count(id) as jumlahData, foto_profil FROM akun_admin where id = $nip;";
        $result = mysqli_query($conn,$query);
        while ($row=mysqli_fetch_array($result)){
            $jumlahData = $row["jumlahData"]; 
            $foto_profil = $row["foto_profil"]; 
        }

        if($jumlahData > 0){
            if ($foto_profil != ""){
                $target = "images/" .$foto_profil;
                if(file_exists($target)){
                    unlink($target);
                }
            }

            $query="DELETE FROM akun_admin where id = $nip;";
            $delete=mysqli_query($conn,$query);
            if(!$delete){
                echo "<script>alert('Data lampiran Gagal Dihapus')
                location.replace('akun_table.php)</script>";
            }else{
                echo "<script>alert('Data Berhasil Dihapus')
                location.replace('akun_table.php)</script>";
            }

        }
           
    }else{
        echo "<script>alert('Nomor NIP kosong')
        location.replace('barang_table.php)</script>";
    }
?>