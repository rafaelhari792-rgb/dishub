# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.5.5-10.1.38-MariaDB)
# Database: bb_dishub
# Generation Time: 2025-01-21 14:03:27 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table _faqs
# ------------------------------------------------------------

DROP TABLE IF EXISTS `_faqs`;

CREATE TABLE `_faqs` (
  `Uniq` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `Question` text,
  `Answer` text,
  `Name` varchar(200) DEFAULT '',
  `Timestamp` datetime NOT NULL,
  PRIMARY KEY (`Uniq`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `_faqs` WRITE;
/*!40000 ALTER TABLE `_faqs` DISABLE KEYS */;

INSERT INTO `_faqs` (`Uniq`, `Question`, `Answer`, `Name`, `Timestamp`)
VALUES
	(2,'Apakah pendaftaran izin dapat dilakukan secara online?','Ya, anda dapat melakukan pendaftaran secara online melalui Aplikasi SiCantik untuk lebih jelas anda dapat mengunduh panduan aplikasi sicantik melalui link ini.','','2023-05-01 12:00:00'),
	(3,'Bagaimana pemohon mengetahui status proses perizinan yang dimohonkan?','Anda dapat melakukan tracking permohonan izin melalui akun yang telah didaftarkan melalui Aplikasi SiCantik Cloud atau anda juga dapat melakukan tracking permohonan melalui Tracking Permohonan dengan menginput nomor pendaftaran anda.','','2023-05-01 12:00:00'),
	(4,'Bagaimana melakukan pendaftaran perizinan berusaha?','Anda dapat melakukan pendaftaran melalui OSS RBA dengan terlebih dahulu mengetahui kode KBLI kegiatan usaha anda.','','2023-05-01 12:00:00'),
	(5,'Bagaimana mengetahui kode KBLI kegiatan usaha?','Anda dapat mengakses Informasi Kode KBLI melalui link https://oss.go.id/informasi/kbli-berbasis-risiko.','','2023-05-01 12:00:00');

/*!40000 ALTER TABLE `_faqs` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table _homepage
# ------------------------------------------------------------

DROP TABLE IF EXISTS `_homepage`;

CREATE TABLE `_homepage` (
  `Uniq` bigint(10) unsigned NOT NULL AUTO_INCREMENT,
  `ContentID` varchar(20) DEFAULT NULL,
  `ContentTitle` varchar(200) DEFAULT NULL,
  `ContentType` varchar(50) NOT NULL,
  `ContentDesc1` text,
  `ContentDesc2` text,
  `ContentDesc3` text,
  `ContentDesc4` text,
  PRIMARY KEY (`Uniq`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `_homepage` WRITE;
/*!40000 ALTER TABLE `_homepage` DISABLE KEYS */;

INSERT INTO `_homepage` (`Uniq`, `ContentID`, `ContentTitle`, `ContentType`, `ContentDesc1`, `ContentDesc2`, `ContentDesc3`, `ContentDesc4`)
VALUES
	(41,'NumProfile','NUMBER 1','NUMBER',NULL,NULL,NULL,NULL),
	(42,'NumProfile','NUMBER 2','NUMBER',NULL,NULL,NULL,NULL),
	(43,'NumProfile','NUMBER 3','NUMBER',NULL,NULL,NULL,NULL),
	(44,'NumProfile','NUMBER 4','NUMBER',NULL,NULL,NULL,NULL),
	(48,'TxtPopup1','Pengumuman','TEXT',NULL,NULL,NULL,NULL),
	(49,'TxtPopup2','Sambutan','TEXT','<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n',NULL,NULL,NULL),
	(55,'Carousel','Carousel 1','IMG',NULL,'DISHUB_MAKLUMAT.png',NULL,NULL),
	(56,'Carousel','Carousel 2','IMG',NULL,'2.png',NULL,NULL),
	(57,'Carousel','Carousel 3','IMG',NULL,'3.png',NULL,NULL),
	(58,'Media1','Kepala Daerah','IMG','H. HERI WAHYUDI MARPAUNG, S.STP, M.AP','DISHUB_BANNER_BUPATI1.png','Pj. Bupati Batu Bara',NULL),
	(59,'Media1','Kepala OPD','IMG','RUBI ANTO SARI SIBORO, S.T., M.Si','DISHUB_BANNER_KADIS2.png','Kepala Dinas',NULL);

/*!40000 ALTER TABLE `_homepage` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table _logs
# ------------------------------------------------------------

DROP TABLE IF EXISTS `_logs`;

CREATE TABLE `_logs` (
  `Uniq` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `Timestamp` datetime DEFAULT NULL,
  `URL` text,
  `ClientInfo` text,
  PRIMARY KEY (`Uniq`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table _postcategories
# ------------------------------------------------------------

DROP TABLE IF EXISTS `_postcategories`;

CREATE TABLE `_postcategories` (
  `PostCategoryID` int(10) unsigned NOT NULL,
  `PostCategoryName` varchar(50) NOT NULL,
  `PostCategoryLabel` varchar(50) DEFAULT NULL,
  `IsShowEditor` tinyint(1) NOT NULL DEFAULT '1',
  `IsAllowExternalURL` tinyint(1) NOT NULL DEFAULT '0',
  `IsDocumentOnly` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

LOCK TABLES `_postcategories` WRITE;
/*!40000 ALTER TABLE `_postcategories` DISABLE KEYS */;

INSERT INTO `_postcategories` (`PostCategoryID`, `PostCategoryName`, `PostCategoryLabel`, `IsShowEditor`, `IsAllowExternalURL`, `IsDocumentOnly`)
VALUES
	(2,'Berita','Berita & artikel terkini seputar Dinas Perhubungan',1,0,0),
	(3,'Galeri','Dokumentasi Kegiatan',1,0,0),
	(5,'Lainnya',NULL,1,0,0);

/*!40000 ALTER TABLE `_postcategories` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table _postimages
# ------------------------------------------------------------

DROP TABLE IF EXISTS `_postimages`;

CREATE TABLE `_postimages` (
  `PostImageID` bigint(20) NOT NULL AUTO_INCREMENT,
  `PostID` bigint(20) NOT NULL,
  `ImgPath` text NOT NULL,
  `ImgDesc` varchar(250) NOT NULL,
  `ImgShortcode` varchar(50) NOT NULL,
  `IsHeader` tinyint(1) NOT NULL DEFAULT '1',
  `IsThumbnail` tinyint(1) NOT NULL DEFAULT '1',
  `Description` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`PostImageID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;



# Dump of table _posts
# ------------------------------------------------------------

DROP TABLE IF EXISTS `_posts`;

CREATE TABLE `_posts` (
  `PostID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `PostCategoryID` int(11) NOT NULL,
  `PostUnitID` int(11) DEFAULT NULL,
  `PostDate` date NOT NULL,
  `PostTitle` varchar(200) NOT NULL,
  `PostSlug` varchar(200) NOT NULL,
  `PostContent` longtext,
  `PostExpiredDate` date DEFAULT NULL,
  `PostMetaTags` text,
  `IsRunningText` tinyint(1) NOT NULL DEFAULT '0',
  `TotalView` int(11) NOT NULL DEFAULT '0',
  `LastViewDate` datetime DEFAULT NULL,
  `IsSuspend` tinyint(1) NOT NULL DEFAULT '1',
  `FileName` varchar(250) DEFAULT NULL,
  `CreatedBy` varchar(50) NOT NULL,
  `CreatedOn` datetime NOT NULL,
  `UpdatedBy` varchar(50) NOT NULL,
  `UpdatedOn` datetime NOT NULL,
  PRIMARY KEY (`PostID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

LOCK TABLES `_posts` WRITE;
/*!40000 ALTER TABLE `_posts` DISABLE KEYS */;

INSERT INTO `_posts` (`PostID`, `PostCategoryID`, `PostUnitID`, `PostDate`, `PostTitle`, `PostSlug`, `PostContent`, `PostExpiredDate`, `PostMetaTags`, `IsRunningText`, `TotalView`, `LastViewDate`, `IsSuspend`, `FileName`, `CreatedBy`, `CreatedOn`, `UpdatedBy`, `UpdatedOn`)
VALUES
	(21,5,NULL,'2023-05-01','Struktur Organisasi','struktur-organisasi','<div class=\"row\">\r\n<div class=\"col-lg-12 col-12 mt-3 mt-lg-0\">\r\n<div class=\"job-thumb job-thumb-detail-box bg-white shadow-lg\" style=\"padding: 0 !important; max-width: 100%\"><img src=\"https://kesbangpol.tebingtinggikota.go.id/assets/media/image/img-struktur.png\" style=\"width:100%\" /></div>\r\n</div>\r\n</div>\r\n',NULL,NULL,0,30,NULL,0,NULL,'admin','2023-06-15 09:36:51','admin','2023-09-27 17:16:32'),
	(23,5,NULL,'2023-05-01','Maklumat Pelayanan','maklumat-pelayanan','<div class=\"row\">\r\n<div class=\"col-lg-6 col-12\">\r\n<p>Maklumat pelayanan, adalah salah satu poin penilaian kepatuhan standar pelayanan publik sebagaimana UU No. 25 Tahun 2009 tentang Pelayanan Publik yang dilakukan Ombudsman RI. Jika merujuk pada Pasal 22 Ayat (1) UU Pelayanan Publik, mengamanahkan penyelenggara untuk menyusun dan menetapkan maklumat pelayanan, yang merupakan pernyataan kesanggupan penyelenggara dalam melaksanakan pelayanan sesuai dengan standar pelayanan&quot;. Lebih lanjut dalam ayat (2) ditegaskan bahwa Maklumat Pelayanan wajib dipublikasikan secara jelas dan luas.</p>\r\n\r\n<p>Dalam Peraturan Pemerintah No.96 Tahun 2012 tentang Pelaksanaan Undang-Undang Nomor 25 Tahun 2009 Tentang Pelayanan Publik, maklumat pelayanan diartikan sebagai pernyataan tertulis yang berisi keseluruhan rincian kewajiban dan janji yang terdapat dalam standar pelayanan. Maklumat pelayanan dapat diartikan sebagai bentuk kewajiban dan janji penyelenggara layanan, kepada masyarakat sebagai pengguna layanan, untuk melaksanakan standar pelayanan yang telah ditetapkan penyelenggara layanan.</p>\r\n</div>\r\n\r\n<div class=\"col-lg-6 col-12 mt-3 mt-lg-0\">\r\n<div class=\"job-thumb job-thumb-detail-box bg-white shadow-lg\" style=\"padding: 0 !important; max-width: 100%\"><img src=\"http://eperizinan.tebingtinggikota.go.id/v2/assets/media/image/maklumat-pelayanan.png\" style=\"width:100%\" /></div>\r\n</div>\r\n</div>\r\n',NULL,NULL,0,42,NULL,0,NULL,'admin','2023-06-15 09:54:01','admin','2023-06-15 10:15:27'),
	(31,5,NULL,'2023-05-01','Tupoksi','tupoksi','<object data=\"https://kesbangpol.tebingtinggikota.go.id/assets/media/image/sk-tupoksi.pdf#navpanes=0\" type=\"application/pdf\" width=\"100%\" height=\"800px\">\r\n      <p>Unable to display PDF file.</p>\r\n    </object>',NULL,NULL,0,10,NULL,0,NULL,'admin','2023-09-27 15:55:29','admin','2023-09-27 15:59:20'),
	(32,5,NULL,'2023-05-01','Standar Pelayanan','standar-pelayanan','<object data=\"https://kesbangpol.tebingtinggikota.go.id/assets/media/image/sk-standar-pelayanan-publik.pdf#navpanes=0\" type=\"application/pdf\" width=\"100%\" height=\"800px\">\r\n      <p>Unable to display PDF file.</p>\r\n    </object>',NULL,NULL,0,8,NULL,0,NULL,'admin','2023-09-27 17:12:21','admin','2023-09-27 17:13:13');

/*!40000 ALTER TABLE `_posts` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table _roles
# ------------------------------------------------------------

DROP TABLE IF EXISTS `_roles`;

CREATE TABLE `_roles` (
  `RoleID` int(10) unsigned NOT NULL,
  `RoleName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

LOCK TABLES `_roles` WRITE;
/*!40000 ALTER TABLE `_roles` DISABLE KEYS */;

INSERT INTO `_roles` (`RoleID`, `RoleName`)
VALUES
	(1,'Administrator'),
	(2,'Operator'),
	(3,'Publik');

/*!40000 ALTER TABLE `_roles` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table _settings
# ------------------------------------------------------------

DROP TABLE IF EXISTS `_settings`;

CREATE TABLE `_settings` (
  `Uniq` bigint(20) NOT NULL AUTO_INCREMENT,
  `SettingID` int(10) unsigned NOT NULL,
  `SettingLabel` varchar(50) NOT NULL,
  `SettingName` varchar(50) NOT NULL,
  `SettingValue` text NOT NULL,
  PRIMARY KEY (`Uniq`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

LOCK TABLES `_settings` WRITE;
/*!40000 ALTER TABLE `_settings` DISABLE KEYS */;

INSERT INTO `_settings` (`Uniq`, `SettingID`, `SettingLabel`, `SettingName`, `SettingValue`)
VALUES
	(1,1,'SETTING_WEB_NAME','SETTING_WEB_NAME','DINAS PERHUBUNGAN'),
	(2,2,'SETTING_WEB_DESC','SETTING_WEB_DESC','Website Resmi\r\nDinas Perhubungan\nPemerintah Kabupaten Batu Bara'),
	(3,3,'SETTING_WEB_DISQUS_URL','SETTING_WEB_DISQUS_URL','https://general-9.disqus.com/embed.js'),
	(4,4,'SETTING_ORG_NAME','SETTING_ORG_NAME','Dinas Perhubungan'),
	(5,5,'SETTING_ORG_ADDRESS','SETTING_ORG_ADDRESS','Jl. Lintas Sumatera Desa Karang Baru Dusun 1 Kec. Datuk Tanah Datar 21254'),
	(6,6,'SETTING_ORG_LAT','SETTING_ORG_LAT',''),
	(7,7,'SETTING_ORG_LONG','SETTING_ORG_LONG',''),
	(8,8,'SETTING_ORG_PHONE','SETTING_ORG_PHONE','-'),
	(9,9,'SETTING_ORG_FAX','SETTING_ORG_FAX','-'),
	(10,10,'SETTING_ORG_MAIL','SETTING_ORG_MAIL','dinasperhubungan.batubara@gmail.com'),
	(11,11,'SETTING_WEB_API_FOOTERLINK','SETTING_WEB_API_FOOTERLINK','-'),
	(12,12,'SETTING_WEB_LOGO','SETTING_WEB_LOGO','logo.png'),
	(14,14,'SETTING_WEB_PRELOADER','SETTING_WEB_PRELOADER','main.gif'),
	(15,15,'SETTING_WEB_VERSION','SETTING_WEB_VERSION','1.01'),
	(16,16,'SETTING_ORG_REGION','SETTING_ORG_REGION','PEMERINTAH KABUPATEN BATU BARA'),
	(18,18,'SETTING_LINK_INSTAGRAM','SETTING_LINK_INSTAGRAM','https://www.instagram.com/dishub_pemkabbatubara/'),
	(19,19,'SETTING_LINK_FACEBOOK','SETTING_LINK_FACEBOOK',''),
	(20,20,'SETTING_LINK_YOUTUBE','SETTING_LINK_YOUTUBE',''),
	(21,21,'SETTING_LINK_GOOGLEMAP','SETTING_LINK_GOOGLEMAP','<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3983.8772273349946!2d99.50536187460044!3d3.1271459532882897!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3033ca2ef686bcf3%3A0x4b570d0983ac1462!2sDINAS%20PERHUBUNGAN%20Kab.%20Batubara!5e0!3m2!1sen!2sid!4v1736840046015!5m2!1sen!2sid\" width=\"100%\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>'),
	(22,22,'SETTING_LINK_WHATSAPP','SETTING_LINK_WHATSAPP','6285359867032'),
	(23,23,'SETTING_LINK_INSTAGRAM_ACC','SETTING_LINK_INSTAGRAM_ACC','@dishub_pemkabbatubara');

/*!40000 ALTER TABLE `_settings` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table _userinformation
# ------------------------------------------------------------

DROP TABLE IF EXISTS `_userinformation`;

CREATE TABLE `_userinformation` (
  `Uniq` bigint(20) NOT NULL AUTO_INCREMENT,
  `UserName` varchar(50) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Name` varchar(250) DEFAULT NULL,
  `IdentityNo` varchar(50) DEFAULT NULL,
  `BirthDate` date DEFAULT NULL,
  `Gender` tinyint(1) DEFAULT NULL,
  `Address` text,
  `PhoneNo` varchar(50) DEFAULT NULL,
  `ImgFile` varchar(250) DEFAULT NULL,
  `RegDate` date DEFAULT NULL,
  PRIMARY KEY (`Uniq`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

LOCK TABLES `_userinformation` WRITE;
/*!40000 ALTER TABLE `_userinformation` DISABLE KEYS */;

INSERT INTO `_userinformation` (`Uniq`, `UserName`, `Email`, `Name`, `IdentityNo`, `BirthDate`, `Gender`, `Address`, `PhoneNo`, `ImgFile`, `RegDate`)
VALUES
	(1,'admin','administrator@dishub.batubarakab.go.id','Administrator',NULL,NULL,NULL,NULL,NULL,NULL,'2018-08-17');

/*!40000 ALTER TABLE `_userinformation` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table _users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `_users`;

CREATE TABLE `_users` (
  `Uniq` bigint(20) NOT NULL AUTO_INCREMENT,
  `UserName` varchar(50) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `RoleID` int(10) unsigned NOT NULL,
  `IsSuspend` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `LastLogin` datetime DEFAULT NULL,
  `LastLoginIP` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`Uniq`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

LOCK TABLES `_users` WRITE;
/*!40000 ALTER TABLE `_users` DISABLE KEYS */;

INSERT INTO `_users` (`Uniq`, `UserName`, `Password`, `RoleID`, `IsSuspend`, `LastLogin`, `LastLoginIP`)
VALUES
	(1,'admin','3798e989b41b858040b8b69aa6f2ce90',1,0,'2023-05-09 08:15:14','::1');

/*!40000 ALTER TABLE `_users` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table mcert
# ------------------------------------------------------------

DROP TABLE IF EXISTS `mcert`;

CREATE TABLE `mcert` (
  `Uniq` bigint(10) unsigned NOT NULL AUTO_INCREMENT,
  `IzinNama` varchar(50) DEFAULT NULL,
  `IzinRemarks1` text COMMENT 'Persyaratan',
  `IzinRemarks2` text COMMENT 'Lain-lain',
  `CreatedBy` varchar(50) NOT NULL DEFAULT '',
  `CreatedOn` datetime NOT NULL,
  `UpdatedBy` varchar(50) DEFAULT NULL,
  `UpdatedOn` datetime DEFAULT NULL,
  PRIMARY KEY (`Uniq`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table mcontact
# ------------------------------------------------------------

DROP TABLE IF EXISTS `mcontact`;

CREATE TABLE `mcontact` (
  `Uniq` bigint(10) unsigned NOT NULL AUTO_INCREMENT,
  `ContactLabel` varchar(50) DEFAULT NULL,
  `ContactIcon` varchar(50) DEFAULT NULL,
  `ContactURL` varchar(100) DEFAULT NULL,
  `ContactText` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`Uniq`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `mcontact` WRITE;
/*!40000 ALTER TABLE `mcontact` DISABLE KEYS */;

INSERT INTO `mcontact` (`Uniq`, `ContactLabel`, `ContactIcon`, `ContactURL`, `ContactText`)
VALUES
	(1,'Instagram','bi-instagram','https://www.instagram.com/dishub_pemkabbatubara/','@dishub_pemkabbatubara'),
	(2,'Facebook','bi-facebook','https://www.facebook.com/profile.php?id=100067523444015&_rdr','Dishub Batu Bara'),
	(3,'Twitter','bi-twitter',NULL,NULL),
	(4,'YouTube','bi-youtube',NULL,NULL);

/*!40000 ALTER TABLE `mcontact` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table morganisasi
# ------------------------------------------------------------

DROP TABLE IF EXISTS `morganisasi`;

CREATE TABLE `morganisasi` (
  `Uniq` bigint(10) unsigned NOT NULL AUTO_INCREMENT,
  `OrgNama` varchar(200) DEFAULT NULL,
  `OrgAlamat` text,
  `OrgPeriodeFrom` int(11) DEFAULT NULL,
  `OrgPeriodeTo` int(11) DEFAULT NULL,
  `OrgKategori` varchar(50) DEFAULT NULL,
  `OrgKetua` varchar(50) DEFAULT NULL,
  `OrgSekretaris` varchar(50) DEFAULT NULL,
  `OrgBendahara` varchar(50) DEFAULT NULL,
  `OrgNoSK1` varchar(200) DEFAULT NULL COMMENT 'SK Kementerian / Pusat',
  `OrgNoSK2` varchar(200) DEFAULT NULL COMMENT 'SK Pemerintah Daerah',
  PRIMARY KEY (`Uniq`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table mpegawai
# ------------------------------------------------------------

DROP TABLE IF EXISTS `mpegawai`;

CREATE TABLE `mpegawai` (
  `Uniq` bigint(10) unsigned NOT NULL AUTO_INCREMENT,
  `PegNoUrut` int(11) DEFAULT NULL,
  `PegNama` varchar(50) DEFAULT NULL,
  `PegNIP` varchar(50) DEFAULT NULL,
  `PegJabatan` varchar(200) DEFAULT NULL,
  `PegKategori` varchar(50) DEFAULT NULL,
  `PegIsAktif` tinyint(1) DEFAULT '1',
  `PegImgPath` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`Uniq`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table tformulir
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tformulir`;

CREATE TABLE `tformulir` (
  `Uniq` bigint(10) unsigned NOT NULL AUTO_INCREMENT,
  `FormNama` varchar(200) DEFAULT '',
  `FormKeterangan` varchar(200) NOT NULL DEFAULT '',
  `FormAttachment` varchar(200) DEFAULT '',
  `CreatedOn` datetime DEFAULT NULL,
  `CreatedBy` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`Uniq`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table tlapor
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tlapor`;

CREATE TABLE `tlapor` (
  `Uniq` bigint(10) unsigned NOT NULL AUTO_INCREMENT,
  `LaporNama` varchar(200) NOT NULL DEFAULT '',
  `LaporNIK` varchar(200) DEFAULT NULL,
  `LaporHP` varchar(50) NOT NULL DEFAULT '',
  `LaporEmail` varchar(50) NOT NULL DEFAULT '',
  `LaporKategori` varchar(200) NOT NULL DEFAULT '',
  `LaporIsi` text NOT NULL,
  `LaporStatus` enum('DITERIMA','PROSES','SELESAI') NOT NULL DEFAULT 'DITERIMA',
  `LaporKeterangan` text,
  `CreatedOn` datetime NOT NULL,
  `UpdatedOn` datetime DEFAULT NULL,
  `UpdateBy` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`Uniq`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table trequest
# ------------------------------------------------------------

DROP TABLE IF EXISTS `trequest`;

CREATE TABLE `trequest` (
  `Uniq` bigint(10) unsigned NOT NULL AUTO_INCREMENT,
  `UserName` varchar(50) NOT NULL DEFAULT '',
  `IzinID` bigint(10) unsigned NOT NULL,
  `ReqRemarks` text,
  `ReqStatus` enum('DITERIMA','PROSES','SELESAI') NOT NULL DEFAULT 'DITERIMA',
  `ReqFile1` varchar(200) DEFAULT NULL,
  `ReqFile2` varchar(200) DEFAULT NULL,
  `ReqFile3` varchar(200) DEFAULT NULL,
  `CreatedBy` varchar(50) NOT NULL DEFAULT '',
  `CreatedOn` datetime NOT NULL,
  `UpdatedBy` varchar(50) DEFAULT NULL,
  `UpdatedOn` datetime DEFAULT NULL,
  PRIMARY KEY (`Uniq`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table trequest_log
# ------------------------------------------------------------

DROP TABLE IF EXISTS `trequest_log`;

CREATE TABLE `trequest_log` (
  `Uniq` bigint(10) unsigned NOT NULL AUTO_INCREMENT,
  `ReqID` bigint(10) unsigned NOT NULL,
  `ReqStatus` varchar(50) NOT NULL DEFAULT '',
  `ReqRemarks` text,
  `CreatedBy` varchar(50) NOT NULL DEFAULT '',
  `CreatedOn` datetime NOT NULL,
  PRIMARY KEY (`Uniq`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
