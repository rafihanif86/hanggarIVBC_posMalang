<?php
    include "connection.php";

    $noTracking=$_GET["no_cn"];
    $id=$_GET["id"];
    
    if($id != null){
        $nama_file="";
        $query = "select * from konfirmasi_foto_barang where id = $id;";
        $result = mysqli_query($conn,$query);
        while ($row=mysqli_fetch_array($result)){
            $nama_file = $row["nama_foto"];
        }
        $target = "images/" .$nama_file;
        if(file_exists($target)){
            unlink($target);
        }
        if(file_exists($target)){
            echo "<script>alert('File Gagal Dihapus')
            location.replace('barang_form.php?noTracking=$noTracking')</script>";
        }else{
            $query="delete from konfirmasi_foto_barang where id = $id;";
            $delete=mysqli_query($conn,$query);
            if($delete){
                echo "<script>alert('Data Berhasil Dihapus')
                location.replace('barang_form.php?noTracking=$noTracking')</script>";
            }else{
                echo "<script>alert('Data Gagal Dihapus')
                location.replace('barang_form.php?noTracking=$noTracking')</script>";
            }
        }
    }else{
        echo "<script>alert('id foto kosong')
        location.replace('barang_form.php?noTracking=$noTracking')</script>";
    }
?>