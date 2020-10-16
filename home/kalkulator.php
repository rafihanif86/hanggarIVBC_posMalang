<?php
    $page = "kalkulator";
    include('header.php');

    $jenisBarang = "";
    $biayaAngkut = 0;
    $hargaBarang = 0;
    $asuransi = 0;
    $npwp = "";
    $hiddenHasil = "hidden";
    $hiddenInput = "";

    $nilaiPajak = 0;
    $nilaiPabean = 0;
    $beaMasuk = 0;
    $nilaiImpor = 0;
    $ppn = 0;
    $pph = 0;
    $total = 0;

    if(isset($_POST["btnHitung"])){
        $jenisBarang=$_POST["jenisBarang"];
        $biayaAngkut=$_POST["biayaAngkut"];
        $hargaBarang=$_POST["hargaBarang"];
        $asuransi=$_POST["asuransi"];
        $npwp=$_POST["npwp"];

        
        if($jenisBarang == "Tas"){
            $nilaiPajak = 0.2;
        }else if($jenisBarang == "Sepatu"){
            $nilaiPajak = 0.3;
        }else if($jenisBarang == "Produk Tekstil"){
            $nilaiPajak = 0.25;
        }else if($jenisBarang == "Lainnya"){
            $nilaiPajak = 0.075;
        }

        if($hargaBarang <= 45000){
            $beaMasuk = 0;
            $nilaiPabean = $hargaBarang + $biayaAngkut + $asuransi;
            $nilaiImpor = $nilaiPabean + $beaMasuk;
            $ppn = 0.1 * $nilaiImpor;
            $phh = 0;
            
        }else{
            $nilaiPabean = $hargaBarang + $biayaAngkut + $asuransi;
            $beaMasuk = $nilaipajak * $nilaiPabean;
            $nilaiImpor = $nilaiPabean + $beaMasuk;
            $ppn = 0.1 * $nilaiImpor;
            if($npwp == "true"){
                $phh = 0;
            }else{
                $phh = 0.1 * $nilaiImpor;
            }
        }

        $total = $beaMasuk + $ppn +$pph;
        
        $hiddenInput = "hidden";
        $hiddenHasil = "";
    }

?>

<div style="background-image: url(img/tax.gif);" class="bradcam_area ">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="bradcam_text text-center">
                    <h3>Kalkulator</h3>
                    <p>Perkiraan Perhitungan Pajak Barang Impor</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!--/ bradcam_area  -->
<br />
<!-- Content Wrapper. Contains page content -->

<div class="content-wrapper" style="width: 90%; margin: auto;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">

            <div class="row" <?php echo $hiddenInput; ?>>
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Kalkulator Pajak</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="kalkulator.php" method="post" merk="frm" enctype="multipart/form-data"
                            class="form-horizontal">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Jenis Barang</label>
                                    <select class="form-control" name="jenisBarang" id="exampleFormControlSelect1">
                                        <option value="" selected>Pilih Jenis Barang</option>
                                        <option value="Tas">Tas</option>
                                        <option value="Sepatu">Sepatu</option>
                                        <option value="Produk Tekstil">Produk Tekstil</option>
                                        <option value="Lainnya">Lainnya</option>
                                    </select>
                                    <small class="help-block form-text">Pilihlah jenis barang sesuai barang
                                        anda.</small>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Harga Barang</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Rp.</span>
                                        </div>
                                        <input type="number" name="hargaBarang" class="form-control"
                                            placeholder="Masukkan Harga Barang" value="" required>
                                        <div class="input-group-append">
                                            <span class="input-group-text">,00</span>
                                        </div>
                                    </div>
                                    <small class="help-block form-text">Masukkan harga barang yang telah dikonversi ke
                                        rupiah. Harga barang dapat dilihat difaktur pembelian.</small>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Biaya Angkut</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Rp.</span>
                                        </div>
                                        <input type="number" name="biayaAngkut" class="form-control"
                                            placeholder="Masukkan Biaya Angkut" value="" required>
                                        <div class="input-group-append">
                                            <span class="input-group-text">,00</span>
                                        </div>
                                    </div>
                                    <small class="help-block form-text">Masukkan biaya angkut yang telah dikonversi ke
                                        rupiah. biaya angkut dapat dilihat difaktur pembelian.</small>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Asuransi</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Rp.</span>
                                        </div>
                                        <input type="number" name="asuransi" class="form-control"
                                            placeholder="Masukkan Asuransi" value="" required>
                                        <div class="input-group-append">
                                            <span class="input-group-text">,00</span>
                                        </div>
                                    </div>
                                    <small class="help-block form-text">Masukkan biaya ansuransi yang telah dikonversi
                                        ke rupiah. Harga barang dapat dilihat difaktur pembelian.</small>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="npwp" type="checkbox" value="true"
                                        id="defaultCheck1">
                                    <label class="form-check-label" for="defaultCheck1">
                                        Saya memiliki Nomor NPWP
                                    </label>
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer" style="text-align: right;">
                                <button type="submit" class="btn btn-primary" name="btnHitung">Hitung</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
                <!--/.col (right) -->
            </div>
            <!-- /.row -->
            <br />

            <div class="row" <?php echo $hiddenHasil;?>>
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Kalkulator Pajak</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <div class="card-body">
                            <table border="0" align="center" style="width: 80%;">
                                <tr>
                                    <td style="width: 80%">Harga Barang</td>
                                    <td style="width: 20%">: <?php echo "Rp. ".$hargaBarang; ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 80%">Biaya Angkut</td>
                                    <td style="width: 20%">: <?php echo "Rp. ".$biayaAngkut; ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 80%">Asuransi</td>
                                    <td style="width: 20%">: <?php echo "Rp. ".$asuransi; ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 80%">Memiliki NPWP</td>
                                    <td style="width: 20%">: <?php if($npwp == "true"){echo "Ya";}else{echo "Tidak";} ?>
                                    </td>
                                </tr>
                            </table>
                            <hr/>
                            <table border="0" align="center" style="width: 80%;">
                                <tr>
                                    <td style="width: 80%">Nilai Pabean(NP) (Harga Barang + Biaya Angkut + Asuransi) =
                                        <?php echo $hargaBarang?> + <?php echo $biayaAngkut?> + <?php echo $asuransi?>
                                    </td>
                                    <td style="width: 20%">: <?php echo "Rp. ".$nilaiPabean; ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 80%">Bea Masuk(BM) (Nilai Pajak Barang x NP) =
                                        <?php echo $nilaiPajak?> x <?php echo $nilaiPabean?></td>
                                    <td style="width: 20%">: <?php echo "Rp. ".$beaMasuk; ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 80%">Nilai Impor(NI) (NP + BM) = <?php echo $nilaiPabean?> +
                                        <?php echo $nilaiPajak?></td>
                                    <td style="width: 20%">: <?php echo "Rp. ".$nilaiImpor; ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 80%">PPN (10% x NI) = 10% x <?php echo $nilaiImpor?></td>
                                    <td style="width: 20%">: <?php echo "Rp. ".$ppn; ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 80%">PPH (10% x NI) = 10% x <?php echo $nilaiImpor?></td>
                                    <td style="width: 20%">: <?php echo "Rp. ".$pph; ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 80%"><b>Total (Bea Masuk + PPN + PPH)</b></td>
                                    <td style="width: 20%"><b>: <?php echo "Rp. ".$total; ?></b></td>
                                </tr>
                            </table>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <b>
                                <?php
                                    if($beaMasuk == 0 && $pph == 0){
                                        echo "Karena harga barang tidak melebihi USD $3, maka Bea Masuk dan PPH tidak dikenakan";
                                    }else if($beaMasuk != 0 && $pph == 0){
                                        echo "Karena anda memiliki NPWP, maka PPH tidak dikenakan";
                                    }
                                ?>
                            </b>
                            <a href="kalkulator.php" class="btn btn-primary btn-md active" style="float: right;"role="button"
                                aria-pressed="true">Ulangi</a>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
                <!--/.col (right) -->
            </div>
            <!-- /.row -->
            <br />



        </div><!-- /.container-fluid -->
    </section>
</div><!-- content-wrapper -->

<script>
$('.Syarat dan Ketentuan').popover({
    trigger: 'focus'
})

var camera = document.getElementById('camera');
var frame = document.getElementById('frame');

camera.addEventListener('change', function(e) {
    var file = e.target.files[0];
    // Do something with the image file.
    frame.src = URL.createObjectURL(file);
});

function reset() {
    frame.src = "";
}
</script>


<?php include 'footer.php'; ?>