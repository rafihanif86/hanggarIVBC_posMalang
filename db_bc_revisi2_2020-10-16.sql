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
  `password` varchar(255) DEFAULT NULL,
  `login_status` varchar(10) DEFAULT NULL,
  `foto_profil` varchar(20) DEFAULT NULL,
  `jabatan` varchar(20) DEFAULT NULL,
  `tgl_register` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `akun_admin` */

insert  into `akun_admin`(`id`,`nama`,`posisi`,`telp`,`email`,`password`,`login_status`,`foto_profil`,`jabatan`,`tgl_register`) values ('0001234568','egy','checker','08192837229','egy@gmail.com','81dc9bdb52d04dc20036dbd8313ed055','logout','','tester','2020-04-22 12:11:19'),('000895645455','Rafi Hanif R','admin','085896404314','rafizmujahid86@gmail.com','3439a6804da782a52c8802d0982a6872','logout','1731710135.jpg','Creator','2020-04-01 13:47:03');

/*Table structure for table `data_barang_faktur` */

DROP TABLE IF EXISTS `data_barang_faktur`;

CREATE TABLE `data_barang_faktur` (
  `no_cn` varchar(50) NOT NULL,
  `nik` varchar(50) DEFAULT NULL,
  `proses` varchar(25) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `total_invoice` varchar(100) DEFAULT NULL,
  `tgl_input` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `tgl_proses` datetime DEFAULT NULL,
  `petugas_pemeriksa` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`no_cn`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `data_barang_faktur` */

insert  into `data_barang_faktur`(`no_cn`,`nik`,`proses`,`keterangan`,`total_invoice`,`tgl_input`,`tgl_proses`,`petugas_pemeriksa`) values ('000001','21231231456656','telah_diproses','accsories','1200000','2020-04-07 16:19:52','2020-04-21 10:43:20','000895645455'),('0828313','32423','belum_diproses','zczcx','43534','2020-04-07 08:45:53',NULL,NULL),('1231312312','3423432423','belum_diproses','erwrdsf','2','2020-03-09 06:44:05',NULL,NULL),('12323453465','5465654645','belum_diproses','fgdgd','5000000','2020-03-09 06:36:24',NULL,NULL),('1233242324','3525141306990001','telah_diproses','hp','2500000','2020-03-09 00:00:00','2020-04-21 06:13:36','000895645455'),('12634564456','234234534','telah_diproses','seeet','3000000','2020-03-09 00:00:00','2020-04-20 10:05:39','000895645455'),('23234535654','453465445','belum_diproses','345346346','3453453','2020-03-09 00:00:00',NULL,NULL),('324234234','34534554645','belum_diproses','mainan','323445643','2020-03-09 06:53:30',NULL,NULL),('3242434456','565675675643','telah_diproses','sepeda','6000000','2020-03-09 06:39:30','2020-04-22 13:05:30','0001234568'),('3242bgf','1234567890','belum_diproses','mainan','200000','2020-09-16 15:30:23',NULL,NULL),('56754767543','456457657856','belum_diproses','sfsdf','10000000','2020-03-09 00:00:00',NULL,NULL),('aw9374734cn','3525141306990001','telah_diproses','mainan','1500000','2020-03-15 06:01:16','2020-03-15 11:00:19','0001234568'),('OP0932842CN','3525141306990001','belum_diproses','Kipas angin dan dvd player','962624','2020-05-04 11:56:46',NULL,NULL);

/*Table structure for table `konfirmasi_foto_invoice` */

DROP TABLE IF EXISTS `konfirmasi_foto_invoice`;

CREATE TABLE `konfirmasi_foto_invoice` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `no_cn` varchar(50) DEFAULT NULL,
  `nama_foto` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

/*Data for the table `konfirmasi_foto_invoice` */

insert  into `konfirmasi_foto_invoice`(`id`,`no_cn`,`nama_foto`) values (6,'1233242324','1492038164666.jpg'),(12,'000001','photo.jpg'),(13,'aw9374734cn','IMG-20180211-WA0000.jpg'),(14,'aw9374734cn','DSC_0769.JPG'),(15,'aw9374734cn','Component_111__1-512.webp'),(19,'OP0932842CN','Inkedinvoice_shopee_LI.jpg'),(20,'3242bgf','bahasa2.jpg'),(21,'3242bgf','bahasa1.png');

/*Table structure for table `penerima` */

DROP TABLE IF EXISTS `penerima`;

CREATE TABLE `penerima` (
  `nik` varchar(25) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `no_hp` decimal(15,0) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `no_npwp` varchar(50) DEFAULT NULL,
  `foto_ktp` varchar(255) DEFAULT NULL,
  `input_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`nik`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `penerima` */

insert  into `penerima`(`nik`,`nama`,`no_hp`,`email`,`no_npwp`,`foto_ktp`,`input_date`) values ('1234567890','egy',34535,'egy@gmail.com','563453','arts8d1dzc86r0zthhb2.jpg','2020-10-12 14:22:51'),('3525141306990001','Rafi Hanif',85896404314,'rafizmujahid86@gmail.com',NULL,'RafiHanifRahmadhani_ktp.jpeg','2020-10-12 14:14:28');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
