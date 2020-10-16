<?php
$page = "beranda";
include 'header.php';
?>
<!DOCTYPE html>
<html>

<head>
    <title>Membuat Kalkulator Sederhana Dengan PHP | www.malasngoding.com</title>
    <link rel="stylesheet" type="text/css" href="css/kalkulator.css">
</head>

<body>
    <?php
    if (isset($_POST['hitung'])) {
        $bil1 = $_POST['bil1'];
        $bil2 = $_POST['bil2'];
        $operasi = $_POST['operasi'];
        switch ($operasi) {
            case 'tambah':
                $hasil = $bil1 + $bil2;
                break;
            case 'kurang':
                $hasil = $bil1 - $bil2;
                break;
            case 'kali':
                $hasil = $bil1 * $bil2;
                break;
            case 'bagi':
                $hasil = $bil1 / $bil2;
                break;
        }
    }
    ?>

    <!-- slider_area_start -->
    <div class="slider_area">
        <div class="slider_active owl-carousel">
            <div style="background-image: url(img/logistic.png);" class="single_slider  d-flex align-items-center  overlay">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-xl-12 col-md-12">
                            <div class="slider_text text-center">
                                <h3>EXPORT | IMPORT </h3>
                                <p>Tentang Import Export</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>


        <div class="recent_trip_area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12" style="background-color: white;  width: auto; border: 2px solid black; padding: 50px; margin: 20px;">
                        <div class="story_heading">
                            <h3>IMPOR BARANG KIRIMAN</h3>
                        </div>
                        <div class="row">
                            <div class="col-lg-11 offset-lg-1">
                                <div class="story_info">
                                    <div class="row">
                                        <div class="col-lg-9">
                                            <br>
                                            <ul>
                                                <li><strong>1. Apakah Barang Kiriman itu?</strong><br>
                                                    Barang kiriman adalah barang yang dikirim melalui Penyelenggara Pos sesuai dengan peraturan perundang undangan di bidang pos.</li>
                                                <br>
                                                <li><strong>2. Apakah perusahaan jasa titipan itu?</strong><br>
                                                    Perusahaan Jasa Titipan (PJT) adalah Penyelenggara Pos yang memperoleh ijin usaha dari instansi terkait untuk melaksanakan layanan surat,dokumen, dan paket sesuai perundang undangan di bidang pos.</li>
                                                <br>
                                                <li><strong>3. Saya mendapat paket kiriman dari teman saya di luar negeri, apakah saya wajib membayar bea masuk atas barang kiriman tersebut?</strong></li>
                                            </ul>
                                            <ul>
                                                <li>Barang kiriman dengan nilai pabean ≤ FOB USD 3.00 (Tiga US Dollar) untuk setiap orang per kiriman, diberikan pembebasan bea masuk dan dipungut PPN, atau PPN dan PPnBM; dikecualikan dari pemungutan PPh.</li>
                                                <li>Dalam hal nilai pabean melebihi batas pembebasan bea masuk, maka barang kiriman dipungut bea masuk dan dipungut PPN, atau PPN dan PPnBM dengan dasar seluruh nilai pabean barang kiriman; dikecualikan dari pemungutan PPh.</li>
                                            </ul>
                                            <br>
                                            <ul start="4">
                                                <li><strong>4. Bagaimana tatacara pengeluaran barang kiriman melalui pos atau perusahaan jasa titipan?</strong></li>
                                            </ul>
                                            <ul>
                                                <li>Atas barang kiriman wajib diberitahukan kepada Pejabat Bea dan Cukai dikantor Pabean dan hanya dapat dikeluarkan dengan persetujuan Pejabat Bea dan Cukai;</li>
                                                <li>Impor barang kiriman dilakukan melalui Penyelenggara Pos dan dilakukan pemeriksaan pabean yang meliputi penelitian dokumen dan pemeriksaan fisik barang oleh Pejabat Bea dan Cukai;</li>
                                                <li>Pemeriksaan fisik barang disaksikan oleh petugas Penyelenggara Pos;</li>
                                                <li>Pejabat Bea dan Cukai menetapkan tarif dan nilai pabean serta menghitung bea masuk dan pajak dalam rangka impor yang wajib dilunasi atas barang kiriman melalui penyelenggara pos;</li>
                                                <li>Barang kiriman melalui penyelenggara pos yang telah ditetapkan tarif dan nilai pabeannya diserahkan kepada penerima barang kiriman melalui penyelenggara pos bersangkutan setelah bea masuk dan pajak dalam rangka impor dilunasi;</li>
                                            </ul>
                                            <p>&nbsp;</p>
                                            <ul start="5">
                                                <li><strong>5. Bagaimana prosedur pengiriman barang untuk perorangan?</strong><br>
                                                    Prosedur pengiriman barang impor untuk perorangan dapat dilakukan melalui penyelenggara Pos. Ketentuan mengenai impor barang kiriman diatur dalam Peraturan Menteri Keuangan Nomor 199/PMK.010/2019 Tentang Ketentuan Kepabeanan ,Cukai, dan Pajak Atas Impor Barang Kiriman.</li>
                                                <br>
                                                <li><strong>6. Bagaimana penetapan bea masuk dan pajak dalam rangka impor atas barang kiriman melalui pos?</strong><br>
                                                    Sesuai&nbsp;Peraturan Menteri Keuangan No 112/PMK.04/2018 tentang Perubahan Atas Peraturan Menteri Keuangan Nomor 182/PMK.04/2016 tentang Ketentuan Impor Barang Kiriman berlaku ketentuan:</li>
                                            </ul>
                                            <ul>
                                                <li>Pejabat Bea dan Cukai menetapkan tarif dan nilai pabean serta menghitung bea masuk dan pajak dalam rangka impor yang wajib dilunasi atas barang kiriman melalui Penyelenggara Pos;</li>
                                                <li>Barang Kiriman yang diimpor untuk dipakai dapat diberikan pembebasan bea masuk dengan nilai pabean paling banyak FOB USD 3.00</li>
                                                <li>Pembebasan bea masuk dimaksud diberikan untuk setiap penerima barang per kiriman sepanjang nilai pabean atas keseluruhan barang tidak melebihi FOB USD 3.00</li>
                                            </ul>
                                            <br>
                                            <ul start="7">
                                                <li><strong>7. Bagaimana cara <em>tracking</em> barang kiriman saya ?</strong></li>
                                            </ul>
                                            <ul>
                                                <li>Silakan buka laman <a href="http://www.beacukai.go.id/barangkiriman"> <strong style="color: blue;">http://www.beacukai.go.id/barangkiriman </strong></a></li>
                                            </ul>
                                            <br>
                                            <ul start="8">
                                                <li><strong>8. Dapatkah secara rinci dipaparkan perihal barang kiriman ?</strong></li>
                                            </ul>
                                            <li>
                                                Secara rinci perihal BARANG KIRIMAN ATAU PAKET YANG DIKIRIM MELALUI PERUSAHAAN PENYELENGGARA POS adalah sbb:
                                                <strong>Barang Kiriman > USD 1500</strong> dikenakan ketentuan umum di bidang impor (impor umum) dan penyelesaiannya dilakukan dengan dokumen PIB atau PIBK.
                                                Sifat Pemeriksaan : OFFICIAL ASSESSMENT (Pemeriksaan oleh Pejabat Bea dan Cukai).
                                            </li>

                                            <br>


                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12" style="background-color: white;  width: auto; border: 2px solid black; padding: 50px; margin: 20px;">
                        <div class="story_heading">
                            <h3>Fasilitas dan Ketentuan Perpajakan</h3>
                        </div>
                        <div class="row">
                            <div class="col-lg-11 offset-lg-1">
                                <div class="story_info">
                                    <div class="row">
                                        <div class="col-lg-9">
                                            <br>
                                            <ul>
                                                <li><i class="fa fa-circle-thin" aria-hidden="true"></i> Barang Kiriman yang nilainya kurang dari FOB USD 3.00 (Tiga United States Dollar) per orang per kiriman, dibebaskan dari kewajiban pembayaran Bea Masuk (BM), sedangkan jika lebih FOB USD 3.00 (Tiga United States Dollar) dipungut Bea Masuk ;</li><br>
                                                <li><i class="fa fa-circle-thin" aria-hidden="true"></i> Barang Kiriman yang nilainya sampai dengan FOB USD 1500 (seribu lima ratus United States Dollar) dipungut PPN dan &nbsp;tidak dipungut PPh, sedangkan jika lebih dari FOB USD 1500 (seribu lima ratus United States Dollar) dikenakan pembebanan tarif Bea Masuk Umum atau MFN <em>(Most Favourable Nations)</em></li><br>
                                                <li><i class="fa fa-circle-thin" aria-hidden="true"></i> Barang Kiriman dengan nilai pabean lebih dari USD 1500.00 (seribu lima ratus United States Dollar) diberitahukan dengan dokumen PIB dalam hal Penerima Barang merupakan badan usaha atau PIBK dalam hal Penerima Barang bukan merupakan badan usaha</li><br>
                                                <li><i class="fa fa-circle-thin" aria-hidden="true"></i> Barang kiriman sampel/hadiah/gift diperlakukan ketentuan kepabeanan, yakni ditetapkan nilai pabeannya oleh Petugas Bea dan Cukai berdasarkan data harga pembanding, jika data harga pembanding sama dengan atau lebih rendah dari FOB USD 3.00 maka terhadap barang kiriman sampel/hadiah/gift tersebut tidak akan dikenakan bea masuk, namun jika data harga pembanding lebih tinggi dari FOB USD 3.00 maka terhadap barang kiriman sampel/hadiah/gift tersebut akan dikenakan bea masuk;</li><br>
                                                <li><i class="fa fa-circle-thin" aria-hidden="true"></i> PPh dikecualikan dari pemungutan dengan pertimbangan impor barang kiriman pada umumnya merupakan barang konsumsi akhir</li><br>
                                                <li><i class="fa fa-circle-thin" aria-hidden="true"></i> Barang impor yang dikategorikan sebagai barang mewah (seperti tas branded, berlian dll) berdasarkan peraturan di bidang perpajakan, dikenakan Pajak Penjualan Barang Mewah (PPnBM) yang kriteria dan besaran tarifnya telah ditentukan;</li><br>
                                                <li><i class="fa fa-circle-thin" aria-hidden="true"></i> Tarif BM barang kiriman sebesar 7.5% dikecualikan barang barang dibawah ini yang mengikuti tarif MFN yaitu:</li>
                                            </ul><br>
                                            <ul>
                                                <li><i class="fa fa-circle-thin" aria-hidden="true"></i> Tas Kode Hs: 4204</li>
                                            </ul>
                                            <li>dikenakan BM 15% – 20%</li>
                                            <ul><br>
                                                <li><i class="fa fa-circle-thin" aria-hidden="true"></i> Sepatu Kode Hs: 64</li>
                                            </ul>
                                            <li> dikenakan BM 25% – 30%</li>
                                            <ul><br>
                                                <li><i class="fa fa-circle-thin" aria-hidden="true"></i> Produk Tekstil Kode Hs: 61,62,63</li>
                                            </ul>
                                            <li>dikenakan BM 15%-25%</li>
                                            <ul><br>
                                                <li><i class="fa fa-circle-thin" aria-hidden="true"></i> Tarif PPN Impor sebesar 10%</li>
                                                <li><i class="fa fa-circle-thin" aria-hidden="true"></i> Tarif PPh Pasal 22 Impor : 7.5% – 10 % (mengikuti tarif MFN)</li>
                                                <li><i class="fa fa-circle-thin" aria-hidden="true"></i> Barang Kena Cukai (BKC) hanya di izinkan per penerima barang per kiriman, paling banyak :</li>
                                                <li><i class="fa fa-circle-thin" aria-hidden="true"></i> 40 batang sigaret; atau</li>
                                                <li><i class="fa fa-circle-thin" aria-hidden="true"></i> 5 batang cerutu; atau</li>
                                                <li><i class="fa fa-circle-thin" aria-hidden="true"></i> 40 gram tembakau iris atau hasil tembakau lainnya berupa :
                                                    <ul>
                                                        <li>&nbsp; &nbsp; &nbsp; <i class="fa fa-circle-thin" aria-hidden="true"></i> 20 batang apabila dalam bentuk batang;</li>
                                                        <li>&nbsp; &nbsp; &nbsp; <i class="fa fa-circle-thin" aria-hidden="true"></i> 5 kapsul apabila dalam bentuk kapsul;</li>
                                                        <li>&nbsp; &nbsp; &nbsp; <i class="fa fa-circle-thin" aria-hidden="true"></i> 30 ml apabila dalam bentuk cair;</li>
                                                        <li>&nbsp; &nbsp; &nbsp; <i class="fa fa-circle-thin" aria-hidden="true"></i> 4 catridge apabila dalam bentuk catridge;</li>
                                                        <li>&nbsp; &nbsp; &nbsp; <i class="fa fa-circle-thin" aria-hidden="true"></i> 50 ml atau gram apabila dalam bentuk lainnya;</li>
                                                    </ul>
                                                </li>
                                                <li><i class="fa fa-circle-thin" aria-hidden="true"></i> 350 ml minuman mengandung etil alkohol;</li>
                                                <li><strong> Terhadap kelebihannya akan dimusnahkan secara langsung</strong>.</li>
                                            </ul>
                                            <p>&nbsp;</p>


                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12" style="background-color: white;  width: auto; border: 2px solid black; padding: 50px; margin: 20px;">
                        <div class="story_heading">
                            <h3>Penanganan oleh Pejabat Bea dan Cukai</h3>
                        </div><br>
                        <div class="row">
                            <div class="col-lg-11 offset-lg-1">
                                <div class="story_info">
                                    <div class="row">
                                        <div class="col-lg-9">
                                            <ul>
                                                <li>1. Pejabat Bea dan Cukai berwenang melakukan pemeriksaan pabean yang meliputi penelitian dokumen dan pemeriksaan fisik barang (official assestment);</li><br>
                                                <li>2. Pemeriksaan fisik dilakukan secara selektif dan disaksikan oleh Petugas Penyelenggara Pos guna: </li><br>
                                            </ul>
                                            <ul>
                                                <li><i class="fa fa-circle-thin" aria-hidden="true"></i> menetapkan klasifikasi dan nilai pabean atas barang kiriman;</li>
                                                <li><i class="fa fa-circle-thin" aria-hidden="true"></i> memastikan apakah terhadap barang kiriman terkena ketentuan perijinan dari instansi teknis terkait, seperti :<br>
                                                    &nbsp; – Produk makanan, minuman, obat-obatan harus memperoleh persetujuan dari BPOM; dalam hal kiriman adalah untuk tujuan penelitian termasuk uji klinik, pengembangan produk, sampel registrasi, bantuan/hibah/donasi, tujuan pameran dan penggunaan sendiri/pribadi, dapat melalui mekanisme<br>
                                                    jalur khusus yakni dengan mengajukan Ijin SAS (Special Access Scheme) ke BPOM;<br>
                                                    &nbsp; – Produk Kosmetika harus memperoleh persetujuan dari BPOM berupa SKI (Surat Keterangan Impor);<br>
                                                    &nbsp; – Impor Kiriman Telepon Seluler, Komputer Genggam (Handheld) dan Komputer Tablet hanya diperbolehkan maksimal 2 (dua) buah sebagaimana diatur di Peraturan Menteri Perdagangan;<br>
                                                    &nbsp; – Impor Kiriman Pakaian jadi hanya diperbolehkan maksimal 10 (sepuluh) buah sebagaimana diatur di Peraturan Menteri Perdagangan;<br>
                                                    &nbsp; – Impor Kiriman Produk Elektronik hanya diperbolehkan maksimal 2 (dua) buah sebagaimana diatur di Peraturan Menteri Perdagangan;<br>
                                                    &nbsp; – Produk hewan, tumbuhan dan ikan harus memperoleh ijin pemasukan dari Badan Karantina;<br>
                                                    &nbsp; – Produk senjata api, air softgun dan peralatan sejenis harus mendapatkan ijin dari Kepolisian;</li>
                                            </ul>
                                            <br>
                                            <ul start="3">
                                                <li>3. Untuk memastikan apakah barang impor terkena ketentuan larangan dan pembatasan (perijinan), dapat dilihat di http://eservice.insw.go.id/ menu “Lartas Information”, adapun untuk Pengecualian Lartas Barang Kiriman dapat dilihat “Aturan Pengecualian Lartas Barang Kiriman” di Peraturan ;</li>
                                                <br>
                                                <li>4. Pejabat Bea dan Cukai menetapkan tarif (pembebanan bea masuk) dan nilai pabean serta menghitung BM dan PDRI yang wajib dilunasi atas barang kiriman;</li>
                                                <br>
                                                <li>5. Pejabat Bea dan Cukai menetapkan tarif bea masuk tertinggi jika barang lebih dari 3 jenis;</li>
                                                <br>
                                                <li>6. Dalam rangka penetapan nilai pabean, Pejabat Bea dan Cukai dapat meminta informasi (Notifikasi) bukti pendukung transaksi jual beli yang obyektif dan terukur kepada Penerima Barang melalui Penyelenggara Pos, sebagai data pendukung untuk penetapan nilai barang, yaitu bukti bayar;</li>
                                                <br>
                                                <li>7. Pemberitahuan barang kiriman diajukan oleh penyelenggara Pos dengan dokumen daftar barang kiriman, Consigment Note, PIBK (Pemberitahuan Impor Barang Khusus);</li>
                                                <br>
                                                <li>8. Pembayaran BM dan PDRI ke Kas Negara oleh Penyelenggara Pos dilakukan melalui Bank Devisa Persepsi dengan menggunakan Surat Penetapan Pembayaran Bea Masuk,Cukai dan/atau Pajak (SPPBMCP) paling lama 3 (tiga) hari kerja setelah diterbitkan.</li>
                                                <br>
                                                <li>9. Surat Penetapan Pembayaran Bea Masuk,Cukai dan/atau Pajak (SPPBMCP) jugi berfungsi sebagai persetujuan pengeluaran barang (SPPB).</li>
                                            </ul>
                                            <p>&nbsp;</p>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12" style="background-color: white;  width: auto; border: 2px solid black; padding: 50px; margin: 20px;">
                        <div class="story_heading">
                            <h3>Penyelesaian Barang Kiriman</h3>
                        </div><br>
                        <div class="row">
                            <div class="col-lg-11 offset-lg-1">
                                <div class="story_info">
                                    <div class="row">
                                        <div class="col-lg-9">
                                            <ul>
                                                <li><i class="fa fa-circle-thin" aria-hidden="true"></i> Pengeluaran barang kiriman hanya dapat dilakukan dengan persetujuan Pejabat Bea dan Cukai dengan penerbitan SPPB (Surat Persetujuan Pengeluaran Barang) setelah dipenuhi kewajiban pabean, yaitu :<br>
                                                    – Penyelenggara Pos memberitahukan secara tertulis dengan dokumen PIBK atau Consigment Note;<br>
                                                    – Penerima Barang telah melengkapi Perijinan dari Instansi Teknis Terkait dan menyerahkan kepada Penyelenggara Pos.(jika dibutuhkan)</li>
                                               <br> <li><i class="fa fa-circle-thin" aria-hidden="true"></i> BM dan PDRI atas barang kiriman yang telah dibayar oleh Penyelenggara Pos dianggap telah disetujui;</li>
                                                <br><li><i class="fa fa-circle-thin" aria-hidden="true"></i> Penerima Barang dapat mengajukan keberatan secara tertulis kepada Kepala Kantor Pengawasan dan Pelayanan Bea dan Cukai ( Dalam hal ini Kepala KPPBC TMP Tanjung Emas) atas penetapan yang diterbitkan oleh Pejabat Bea dan Cukai berdasarkan <a href="http://bctemas.beacukai.go.id/peraturan/?s=keberatan&amp;a=&amp;b=&amp;c=&amp;d=">PER-15/BC/2017 tentang Tata Cara Pengajuan dan Penyelesaian Keberatan di Bidang Kepabeanan dan Cukai</a> pasal 2.</li>
                                               <br> <li><i class="fa fa-circle-thin" aria-hidden="true"></i> Barang kiriman yang telah berstatus SPPB akan dikirimkan oleh Penyelenggara Pos terkait ke Penerima Barang;</li>
                                               <br> <li><i class="fa fa-circle-thin" aria-hidden="true"></i> Terhadap barang kiriman yang tidak bisa diterbitkan perijinannya oleh Instansi Terkait, Penerima Barang dapat mengirim kembali ke negara pengirim (RTO/Return To Origin/Re-ekspor) dengan mengajukan permohonan ke Kepala Kantor dan berkoordinasi dengan Penyelenggara Pos terkait;</li>
                                               <br> <li><i class="fa fa-circle-thin" aria-hidden="true"></i> Barang kiriman yang tidak diselesaikan oleh Penerima Barang lebih dari 30 (tiga puluh) hari sejak kedatangannya akan dianggap sebagai barang yang tidak dikuasai (BCF 1.5) dan dialihkan ke Gudang TPP (Gudang Pabean)</li>
                                            </ul>
                                            <br>
                                            <p><strong>Saudara A</strong> mendapat barang kiriman impor berupa speaker bluetooth yang dikirim melalui sebuah PJT dengan harga barang sesuai invoice dan transfer payment sebesar FOB USD 4, biaya pengangkutan udara sesuai Airwaybill (AWB) USD 18, Asuransi yang dibayarkan USD 2 Saudara A tidak memiliki API namun mempunyai NPWP.</p>
                                            <p>Kurs pajak yang berlaku pada saat pembayaran</p>
                                            <ul>
                                                <li>USD 1&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; = Rp 15,000</li>
                                                <li>tarif BM&nbsp;&nbsp;&nbsp;&nbsp; = 7.5%</li>
                                                <li>PPN&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; = 10%</li>
                                                <li>PPh&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; = 0% (Tidak Dipungut)</li>
                                            </ul>
                                            <p><strong>Bea Masuk dan Pajak Dalam Rangka Impor yang harus dibayar&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong></p>
                                            <p><a href="http://bctemas.beacukai.go.id/faq/impor-barang-kiriman/x-3/" rel="attachment wp-att-13733"><img class="aligncenter wp-image-14702 size-full" src="./IMPOR BARANG KIRIMAN - BEA CUKAI TANJUNG EMAS_files/x.png" alt="" width="616" height="434" srcset="http://bctemas.beacukai.go.id/wp-content/uploads/2019/07/x.png 616w, http://bctemas.beacukai.go.id/wp-content/uploads/2019/07/x-300x211.png 300w, http://bctemas.beacukai.go.id/wp-content/uploads/2019/07/x-78x55.png 78w, http://bctemas.beacukai.go.id/wp-content/uploads/2019/07/x-470x331.png 470w" sizes="(max-width: 616px) 100vw, 616px"></a></p>
                                            <p><strong>CONTOH SOAL MENDAPAT PEMBEBASAN BEA MASUK</strong></p>
                                            <p><strong>Saudara B </strong>mendapat barang kiriman impor berupa USB flashdisk yang dikirim melalui sebuah PJT dengan harga barang sesuai invoice dan transfer payment sebesar USD 2 , biaya pengangkutan udara sesuai Airwaybill (AWB) USD 10,dan asuransi yang dibayarkan USD 2 .</p>
                                            <p>Kurs pajak yang berlaku pada saat pembayaran</p>
                                            <ul>
                                                <li>USD 1&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; = Rp 15,000</li>
                                                <li>tarif BM&nbsp; = 0% (Mendapat pembebasan Bea masuk)</li>
                                                <li>PPN &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; =&nbsp; 10%</li>
                                                <li>PPh&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; = 0% (Tidak di pungut)</li>
                                            </ul>
                                            <p><strong>Bea Masuk dan Pajak Dalam Rangka Impor yang harus dibayar</strong></p>
                                            <p><a href="http://bctemas.beacukai.go.id/faq/impor-barang-kiriman/x-5/" rel="attachment wp-att-14703"><img class="aligncenter wp-image-14704 size-full" src="./IMPOR BARANG KIRIMAN - BEA CUKAI TANJUNG EMAS_files/x-2.png" alt="" width="612" height="376" srcset="http://bctemas.beacukai.go.id/wp-content/uploads/2019/07/x-2.png 612w, http://bctemas.beacukai.go.id/wp-content/uploads/2019/07/x-2-300x184.png 300w, http://bctemas.beacukai.go.id/wp-content/uploads/2019/07/x-2-90x55.png 90w, http://bctemas.beacukai.go.id/wp-content/uploads/2019/07/x-2-470x289.png 470w" sizes="(max-width: 612px) 100vw, 612px"></a></p>
                                            <p>Pada <strong>Saudara B </strong>mendapat Pembebasan Bea Masuk karena Harga Barang/<em>cost</em> dibawah USD 3.</p>
                                            <p><strong>Saudara C</strong> belanja online sebuah sepatu bowling dari Luar Negeri seharga USD 230 . biaya pengangkutan udara sesuai Airwaybill (AWB) USD 15, dan asuransi sebesar USD 10</p>
                                            <p>Kurs pajak yang berlaku pada saat pembayaran</p>
                                            <ul>
                                                <li>USD 1 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; = Rp 15,000</li>
                                                <li>tarif BM&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; = 25% (Tarif MFN HS Code 6403.99.20)</li>
                                                <li>PPN &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; = 10%</li>
                                                <li>PPh&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; = 10%</li>
                                            </ul>
                                            <p><strong><a href="http://bctemas.beacukai.go.id/faq/impor-barang-kiriman/x-6/" rel="attachment wp-att-12381"><img class="aligncenter wp-image-14705 size-full" src="./IMPOR BARANG KIRIMAN - BEA CUKAI TANJUNG EMAS_files/x-3.png" alt="" width="613" height="502" srcset="http://bctemas.beacukai.go.id/wp-content/uploads/2019/07/x-3.png 613w, http://bctemas.beacukai.go.id/wp-content/uploads/2019/07/x-3-300x246.png 300w, http://bctemas.beacukai.go.id/wp-content/uploads/2019/07/x-3-67x55.png 67w, http://bctemas.beacukai.go.id/wp-content/uploads/2019/07/x-3-470x385.png 470w" sizes="(max-width: 613px) 100vw, 613px"></a> </strong></p>
                                            <p>Perhitungan dapat menggunakan Aplikasi CEISA Mobile, download <a href="https://play.google.com/store/apps/details?id=id.go.beacukai.customer&amp;hl=in">disini</a></p>
                                            <p>Aturan terbaru mulai berlaku 30 Januari 2020 sesuai Peraturan Menteri Keuangan Nomor 199/PMK.010/2019 Tentang Ketentuan Kepabeanan ,Cukai, dan Pajak Atas Impor Barang Kiriman.</p>
                                            <p><img id="hzDownscaled" style="position: absolute; top: -10000px;"></p>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</body>

</html>


<?php
include 'footer.php';
?>