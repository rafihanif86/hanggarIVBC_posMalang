<?php
    include "connection.php";

    $noTracking=$_GET["no_cn"];
    $act=$_GET["act"]; 

    if($noTracking != null){
        $jumlahData = ""; 

        $query = "SELECT count(no_cn) as jumlahData FROM data_barang_npd where no_cn = $no_tracking;";
        $result = mysqli_query($conn,$query);
        while ($row=mysqli_fetch_array($result)){
        $jumlahData = $row["jumlahData"]; 
        }

        if($jumlahData > 0){
            $query = "SELECT * FROM konfirmasi_foto_barang where no_cn = $noTracking;";
            $result = mysqli_query($conn,$query);
            while ($row=mysqli_fetch_array($result)){
                $nama_file="";
                $nama_file = $row["nama_foto"];
                $target = "images/" .$nama_file;
                if(file_exists($target)){
                    unlink($target);
                }
            }

            $query="DELETE FROM konfirmasi_foto_barang where no_cn = $noTracking;";
            $delete=mysqli_query($conn,$query);
            if(!$delete){
                echo "<script>alert('Data lampiran Gagal Dihapus')
                location.replace('barang_table.php?status=$act')</script>";
            }

        }
    
        $query="DELETE FROM data_barang_npd where no_cn = $noTracking;";
        $delete=mysqli_query($conn,$query);
        if($delete){
            echo "<script>alert('Data Berhasil Dihapus')
            location.replace('barang_table.php?status=$act')</script>";
        }else{
            echo "<script>alert('Data Gagal Dihapus')
            location.replace('barang_table.php?status=$act')</script>";
        }
        
           
    }else{
        echo "<script>alert('Nomor Tracking kosong')
        location.replace('barang_table.php?status=$act')</script>";
    }
?>