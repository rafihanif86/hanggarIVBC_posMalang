<?php
    include "connection.php";

    $noTracking=base64_decode($_GET["n"]);
    $id=base64_decode($_GET["i"]);
    
    if($id != null){
        $nama_file="";
        $query = "select * from konfirmasi_foto_invoice where id = $id;";
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
            location.replace('konfirmasi_form.php?n=".base64_encode($noTracking)."')</script>";
        }else{
            $query="delete from konfirmasi_foto_invoice where id = $id;";
            $delete=mysqli_query($conn,$query);
            if($delete){
                echo "<script>alert('Data Berhasil Dihapus')
                location.replace('konfirmasi_form.php?n=".base64_encode($noTracking)."')</script>";
            }else{
                echo "<script>alert('Data Gagal Dihapus')
                location.replace('konfirmasi_form.php?n=".base64_encode($noTracking)."')</script>";
            }
        }
    }else{
        echo "<script>alert('id foto kosong')
        location.replace('konfirmasi_form.php?n=".base64_encode($noTracking)."')</script>";
    }
?>