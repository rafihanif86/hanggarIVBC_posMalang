/*
SQLyog Ultimate v11.11 (64 bit)
MySQL - 5.5.5-10.4.6-MariaDB : Database - db_bc_pos
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`db_bc_pos` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `db_bc_pos`;

/*Table structure for table `akun_admin` */

DROP TABLE IF EXISTS `akun_admin`;

CREATE TABLE `akun_admin` (
  `id` varchar(25) NOT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `posisi` varchar(100) DEFAULT NULL,
  `telp` varchar(15) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(20) DEFAULT NULL,
  `login_status` varchar(10) DEFAULT NULL,
  `foto_profil` varchar(20) DEFAULT NULL,
  `jabatan` varchar(20) DEFAULT NULL,
  `tgl_register` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `akun_admin` */

insert  into `akun_admin`(`id`,`nama`,`posisi`,`telp`,`email`,`password`,`login_status`,`foto_profil`,`jabatan`,`tgl_register`) values ('0001234568','egy','checker','08192837229','egy@gmail.com','1234','login','','tester','2020-04-22 12:11:19'),('000895645455','Rafi Hanif R','admin','085896404314','rafizmujahid86@gmail.com','glacier86','logout','1731710135.jpg','Creator','2020-04-01 13:47:03');

/*Table structure for table `data_barang_npd` */

DROP TABLE IF EXISTS `data_barang_npd`;

CREATE TABLE `data_barang_npd` (
  `no_cn` varchar(50) NOT NULL,
  `nama_penerima` varchar(100) DEFAULT NULL,
  `alamat_penerima` varchar(150) DEFAULT NULL,
  `nama_pengirim` varchar(100) DEFAULT NULL,
  `alamat_pengirim` varchar(150) DEFAULT NULL,
  `kategori_barang` varchar(200) DEFAULT NULL,
  `tgl_pengecekan_barang` datetime DEFAULT NULL,
  `no_telp_penerima` varchar(15) DEFAULT NULL,
  `keterangan_barang` varchar(200) DEFAULT NULL,
  `petugas_pemeriksa` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`no_cn`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `data_barang_npd` */

insert  into `data_barang_npd`(`no_cn`,`nama_penerima`,`alamat_penerima`,`nama_pengirim`,`alamat_pengirim`,`kategori_barang`,`tgl_pengecekan_barang`,`no_telp_penerima`,`keterangan_barang`,`petugas_pemeriksa`) values ('aw9374734cn','rafi','jl. asteroid malang','sni','thailand','makanan','2020-04-02 18:05:43','085643467775','invoice tidak sesuai','000895645455'),('sd213000dk','icel','pagak','boy','amerika','doll','2020-04-30 14:56:32','081293892881','tidak ada invoice','0001234568');

/*Table structure for table `konfirmasi_foto_barang` */

DROP TABLE IF EXISTS `konfirmasi_foto_barang`;

CREATE TABLE `konfirmasi_foto_barang` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `no_cn` varchar(50) DEFAULT NULL,
  `nama_foto` varchar(100) DEFAULT NULL,
  `keterangan_barang` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `konfirmasi_foto_barang` */

insert  into `konfirmasi_foto_barang`(`id`,`no_cn`,`nama_foto`,`keterangan_barang`) values (1,'aw9374734cn','java-60-1174953.png','kopi');

/*Table structure for table `konfirmasi_foto_invoice` */

DROP TABLE IF EXISTS `konfirmasi_foto_invoice`;

CREATE TABLE `konfirmasi_foto_invoice` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `no_cn` varchar(50) DEFAULT NULL,
  `nama_foto` varchar(100) DEFAULT NULL,
  `keterangan_invoice` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

/*Data for the table `konfirmasi_foto_invoice` */

insert  into `konfirmasi_foto_invoice`(`id`,`no_cn`,`nama_foto`,`keterangan_invoice`) values (6,'1233242324','1492038164666.jpg','asdadsdas'),(12,'000001','photo.jpg','asdadvfdvdfsdada'),(13,'aw9374734cn','IMG-20180211-WA0000.jpg','rdtdrjjj'),(14,'aw9374734cn','DSC_0769.JPG','sdfghjkl'),(15,'aw9374734cn','Component_111__1-512.webp','balon'),(19,'OP0932842CN','Inkedinvoice_shopee_LI.jpg','Pembelian 1 kipas angin miyako seharga Rp, 247000 dan portable dvd aiwa Rp. 870000');

/*Table structure for table `penerima_npd` */

DROP TABLE IF EXISTS `penerima_npd`;

CREATE TABLE `penerima_npd` (
  `no_cn` varchar(50) NOT NULL,
  `nama_penerima` varchar(50) DEFAULT NULL,
  `nik` varchar(50) DEFAULT NULL,
  `npwp` varchar(50) DEFAULT NULL,
  `no_hp` varchar(15) DEFAULT NULL,
  `proses` varchar(25) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `total_invoice` varchar(100) DEFAULT NULL,
  `tgl_input` datetime DEFAULT NULL,
  `tgl_proses` datetime DEFAULT NULL,
  `petugas_pemeriksa` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`no_cn`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `penerima_npd` */

insert  into `penerima_npd`(`no_cn`,`nama_penerima`,`nik`,`npwp`,`no_hp`,`proses`,`keterangan`,`total_invoice`,`tgl_input`,`tgl_proses`,`petugas_pemeriksa`) values ('000001','fricel','21231231456656','66678674353','0812322443832','telah_diproses','accsories','1200000','2020-04-07 16:19:52','2020-04-21 10:43:20','000895645455'),('0828313','asdada','32423','32432','897987','belum_diproses','zczcx','43534','2020-04-07 08:45:53',NULL,NULL),('1231312312','esfsefsef','3423432423','234234','3453453','belum_diproses','erwrdsf','2','2020-03-09 06:44:05',NULL,NULL),('12323453465','ertert','5465654645','43534535','345345345','belum_diproses','fgdgd','5000000','2020-03-09 06:36:24',NULL,NULL),('1233242324','sada','3525141306990001','234234325','564634234234','telah_diproses','hp','2500000','2020-03-09 00:00:00','2020-04-21 06:13:36','000895645455'),('12634564456','fgdfhg','234234534','345345345','435365467547','telah_diproses','seeet','3000000','2020-03-09 00:00:00','2020-04-20 10:05:39','000895645455'),('23234535654','thfghfgh','453465445','564564545','345345345','belum_diproses','345346346','3453453','2020-03-09 00:00:00',NULL,NULL),('324234234','uuuuuu','34534554645','3423424234','324234234234','belum_diproses','mainan','323445643','2020-03-09 06:53:30',NULL,NULL),('3242434456','lala','565675675643','345565756876','081345567645','telah_diproses','sepeda','6000000','2020-03-09 06:39:30','2020-04-22 13:05:30','0001234568'),('56754767543','wersfsdd','456457657856','454645654','3453464757','belum_diproses','sfsdf','10000000','2020-03-09 00:00:00',NULL,NULL),('aw9374734cn','rafi','3525141306990001','786876868','081938734916','telah_diproses','mainan','1500000','2020-03-15 06:01:16','2020-03-15 11:00:19','0001234568'),('OP0932842CN','Rafi Hanif Rahmadhani','3525141306990001','','085896404314','belum_diproses','Kipas angin dan dvd player','962624','2020-05-04 11:56:46',NULL,NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
