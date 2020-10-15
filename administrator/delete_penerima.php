<?php
    include "connection.php";

    $nik=base64_decode($_GET["q"]);
    
    if($nik != null){
        $nama_file="";
        $query = "select * from penerima where nik = $nik;";
        $result = mysqli_query($conn,$query);
        while ($row=mysqli_fetch_array($result)){
            $nama_file = $row["foto_ktp"];
        }
        $target = "images/" .$nama_file;
        if(file_exists($target)){
            unlink($target);
        }
        if(file_exists($target)){
            echo "<script>alert('File Gagal Dihapus')
            location.replace('penerima_detail.php?q=".base64_encode($nik)."')</script>";
        }else{
            $query="delete from penerima where nik = $nik;";
            $delete=mysqli_query($conn,$query);
            if($delete){
                echo "<script>alert('Data Berhasil Dihapus')
                location.replace('penerima_detail.php?q=".base64_encode($nik)."')</script>";
            }else{
                echo "<script>alert('Data Gagal Dihapus')
                location.replace('penerima_detail.php?q=".base64_encode($nik)."')</script>";
            }
        }
    }else{
        echo "<script>alert('NIK tidak ada')
        location.replace('penerima_detail.php?q=".base64_encode($nik)."')</script>";
    }
?>