<?php
    include "connection.php";

    $noTracking=base64_decode($_GET["n"]);
    $act=base64_decode($_GET["a"]);    

    if($noTracking != null){
        $jumlahData = ""; 

        $query = "select count(no_cn) as jumlahData from data_barang_faktur where no_cn = $no_tracking;";
        $result = mysqli_query($conn,$query);
        while ($row=mysqli_fetch_array($result)){
        $jumlahData = $row["jumlahData"]; 
        }

        if($jumlahData > 0){
            $query = "select * from konfirmasi_foto_invoice where no_cn = $noTracking;";
            $result = mysqli_query($conn,$query);
            while ($row=mysqli_fetch_array($result)){
                $nama_file="";
                $nama_file = $row["nama_foto"];
                $target = "images/" .$nama_file;
                if(file_exists($target)){
                    unlink($target);
                }
            }

            $query="delete from konfirmasi_foto_invoice where no_cn = $noTracking;";
            $delete=mysqli_query($conn,$query);
            if(!$delete){
                echo "<script>alert('Data lampiran Gagal Dihapus')
                location.replace('konfirmasi_table.php?status=$act')</script>";
            }

        }
    
        $query="delete from data_barang_faktur where no_cn = $noTracking;";
        $delete=mysqli_query($conn,$query);
        if($delete){
            echo "<script>alert('Data Berhasil Dihapus')
            location.replace('konfirmasi_table.php?status=$act')</script>";
        }else{
            echo "<script>alert('Data Gagal Dihapus')
            location.replace('konfirmasi_table.php?status=$act')</script>";
        }
        
           
    }else{
        echo "<script>alert('Nomor Tracking kosong')
        location.replace('konfirmasi_table.php?status=$act')</script>";
    }
?>