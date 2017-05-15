/*
SQLyog Ultimate v12.4.1 (64 bit)
MySQL - 10.1.21-MariaDB : Database - yzjvincb_kuliahku
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`yzjvincb_kuliahku` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `yzjvincb_kuliahku`;

/*Table structure for table `caras` */

DROP TABLE IF EXISTS `caras`;

CREATE TABLE `caras` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_tugas` int(10) unsigned NOT NULL,
  `knowledge_juml` int(11) NOT NULL,
  `moral_juml` int(11) NOT NULL,
  `energi_req` int(11) NOT NULL,
  `completion_time` int(11) NOT NULL,
  `nama_cara` tinyint(2) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `caras_id_tugas_foreign` (`id_tugas`),
  CONSTRAINT `caras_id_tugas_foreign` FOREIGN KEY (`id_tugas`) REFERENCES `tugas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `caras` */

insert  into `caras`(`id`,`id_tugas`,`knowledge_juml`,`moral_juml`,`energi_req`,`completion_time`,`nama_cara`) values 
(1,1,30,30,20,10,1),
(2,1,10,10,5,5,2),
(3,2,50,40,30,10,1),
(4,2,20,10,10,5,2);

/*Table structure for table `mata_kuliahs` */

DROP TABLE IF EXISTS `mata_kuliahs`;

CREATE TABLE `mata_kuliahs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nama_matkul` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sks_juml` int(11) NOT NULL,
  `knowledge_juml` int(11) NOT NULL,
  `energi_req` int(11) NOT NULL,
  `tugas_count_req` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `mata_kuliahs` */

insert  into `mata_kuliahs`(`id`,`nama_matkul`,`sks_juml`,`knowledge_juml`,`energi_req`,`tugas_count_req`) values 
(1,'PBO',3,100,20,2);

/*Table structure for table `matkul_tugas` */

DROP TABLE IF EXISTS `matkul_tugas`;

CREATE TABLE `matkul_tugas` (
  `matkul_id` int(10) unsigned NOT NULL,
  `tugas_id` int(10) unsigned NOT NULL,
  KEY `matkul_id` (`matkul_id`),
  KEY `tugas_id` (`tugas_id`),
  CONSTRAINT `matkul_tugas_ibfk_1` FOREIGN KEY (`matkul_id`) REFERENCES `mata_kuliahs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `matkul_tugas_ibfk_2` FOREIGN KEY (`tugas_id`) REFERENCES `tugas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `matkul_tugas` */

insert  into `matkul_tugas`(`matkul_id`,`tugas_id`) values 
(1,1);

/*Table structure for table `statistiks` */

DROP TABLE IF EXISTS `statistiks`;

CREATE TABLE `statistiks` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `knowledge_stat` int(11) NOT NULL,
  `moral_stat` int(11) NOT NULL,
  `sks_stat` int(11) NOT NULL,
  `tugas_ambil_count` int(11) NOT NULL,
  `energi_stat` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `statistiks_user_id_foreign` (`user_id`),
  CONSTRAINT `statistiks_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `statistiks` */

insert  into `statistiks`(`id`,`user_id`,`knowledge_stat`,`moral_stat`,`sks_stat`,`tugas_ambil_count`,`energi_stat`) values 
(1,5,100,100,12,3,100);

/*Table structure for table `tugas` */

DROP TABLE IF EXISTS `tugas`;

CREATE TABLE `tugas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nama_tugas` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `tugas` */

insert  into `tugas`(`id`,`nama_tugas`) values 
(1,'Pemrogaman C'),
(2,'Pemrogaman Objek');

/*Table structure for table `user_matkul` */

DROP TABLE IF EXISTS `user_matkul`;

CREATE TABLE `user_matkul` (
  `user_id` int(10) unsigned NOT NULL,
  `matkul_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`user_id`,`matkul_id`),
  KEY `matkul_user` (`matkul_id`),
  CONSTRAINT `matkul_user` FOREIGN KEY (`matkul_id`) REFERENCES `mata_kuliahs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `user_matkul` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `user_matkul` */

insert  into `user_matkul`(`user_id`,`matkul_id`) values 
(5,1);

/*Table structure for table `user_tugas` */

DROP TABLE IF EXISTS `user_tugas`;

CREATE TABLE `user_tugas` (
  `user_id` int(10) unsigned NOT NULL,
  `id_tugas` int(10) unsigned NOT NULL,
  PRIMARY KEY (`user_id`,`id_tugas`),
  KEY `tugas_user` (`id_tugas`),
  CONSTRAINT `tugas_user` FOREIGN KEY (`id_tugas`) REFERENCES `tugas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `user_tugas` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `user_tugas` */

insert  into `user_tugas`(`user_id`,`id_tugas`) values 
(5,1),
(5,2);

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `u_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `u_email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `u_password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`u_email`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`u_name`,`u_email`,`u_password`,`remember_token`) values 
(1,'pentol','a@a.com','5f4dcc3b5aa765d61d8327deb882cf99',NULL),
(2,'rogo','rogo@mail.com','5f4dcc3b5aa765d61d8327deb882cf99',NULL),
(3,'hendry','hendry@mail.com','5f4dcc3b5aa765d61d8327deb882cf99',NULL),
(5,'Hendry Wiranto','hendrywiranto24@gmail.com','88fa749d83d09c8bb76e2bc2b2665b96',NULL);

/* Procedure structure for procedure `sp_cara_tugas` */

/*!50003 DROP PROCEDURE IF EXISTS  `sp_cara_tugas` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_cara_tugas`(
	p_nama_tugas varchar(191)
)
BEGIN
	IF EXISTS(SELECT 1 FROM tugas WHERE nama_tugas = p_nama_tugas) THEN
		SELECT
		    `tugas`.`nama_tugas`
		    ,`caras`.`knowledge_juml`
		    , `caras`.`moral_juml`
		    , `caras`.`completion_time`
		    , `caras`.`energi_req`
		    , `caras`.`nama_cara`
		FROM
		    `yzjvincb_kuliahku`.`caras`
		    INNER JOIN `yzjvincb_kuliahku`.`tugas` 
			ON (`caras`.`id_tugas` = `tugas`.`id`)
		where nama_tugas=p_nama_tugas;
	ELSE
		SELECT -1, 'Tugas tidak ada';
	END IF;
    END */$$
DELIMITER ;

/* Procedure structure for procedure `sp_daftar` */

/*!50003 DROP PROCEDURE IF EXISTS  `sp_daftar` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_daftar`(`p_nama` VARCHAR(32), `p_email` VARCHAR(32), `p_password` VARCHAR(32))
BEGIN
	IF NOT EXISTS(SELECT 1 FROM users WHERE u_email = p_email) THEN
		IF NOT EXISTS(SELECT 1 FROM users WHERE p_nama = u_name) THEN
			INSERT INTO users(u_name, u_email, u_password)
			VALUES	(p_nama, p_email, MD5(p_password));
			SELECT 0, 'pendaftaran sukses!';
		ELSE
			SELECT -2, 'username sudah ada';
		END IF;
	ELSE
		SELECT -1, 'pendaftaran gagal! email sudah digunakan';
	END IF;
    END */$$
DELIMITER ;

/* Procedure structure for procedure `sp_login` */

/*!50003 DROP PROCEDURE IF EXISTS  `sp_login` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_login`(`p_email` VARCHAR(32), `p_password` VARCHAR(32))
BEGIN
	IF EXISTS(SELECT 1 FROM users WHERE p_email = u_email) THEN
		IF EXISTS(SELECT 2 FROM users WHERE MD5(p_password) = u_password AND p_email = u_email) THEN
			SELECT 0,'Login sukes', (SELECT id FROM users WHERE p_email = u_email) AS user_id;
		ELSE
			SELECT -2,'Password salah';
		END IF;
	ELSE
		SELECT -1,'Username tidak ada';
	END IF;
    END */$$
DELIMITER ;

/* Procedure structure for procedure `sp_masuk_tugas` */

/*!50003 DROP PROCEDURE IF EXISTS  `sp_masuk_tugas` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_masuk_tugas`(
	p_email VARCHAR(191), p_id_tugas int (10)
)
BEGIN
	IF EXISTS(SELECT 1 FROM users WHERE u_email = p_email) and (select 1 from tugas where id = p_id_tugas) THEN
		set @userid = (SELECT id FROM users WHERE u_email = p_email);
		insert into user_tugas (
			user_id, id_tugas
		) values ( @userid, p_id_tugas );
		select 1, 'Berhasil';
	ELSE
		SELECT -1, 'email tidak ada';
	END IF;
    END */$$
DELIMITER ;

/* Procedure structure for procedure `sp_matkul_list` */

/*!50003 DROP PROCEDURE IF EXISTS  `sp_matkul_list` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_matkul_list`(
	p_email VARCHAR(191)
)
BEGIN
	IF EXISTS(SELECT 1 FROM users WHERE u_email = p_email) THEN
		SELECT
		    `mata_kuliahs`.`nama_matkul`
		FROM
		    `yzjvincb_kuliahku`.`user_matkul`
		    INNER JOIN `yzjvincb_kuliahku`.`users` 
			ON (`user_matkul`.`user_id` = `users`.`id`)
		    INNER JOIN `yzjvincb_kuliahku`.`mata_kuliahs` 
			ON (`user_matkul`.`matkul_id` = `mata_kuliahs`.`id`)
		WHERE u_email=p_email;
	ELSE
		SELECT -1, 'Email tidak terdaftar';
	END IF;
    END */$$
DELIMITER ;

/* Procedure structure for procedure `sp_tugas_available` */

/*!50003 DROP PROCEDURE IF EXISTS  `sp_tugas_available` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_tugas_available`(
)
BEGIN
	SELECT
	    `nama_tugas`
	FROM
	    `yzjvincb_kuliahku`.`tugas`;
    END */$$
DELIMITER ;

/* Procedure structure for procedure `sp_tugas_list` */

/*!50003 DROP PROCEDURE IF EXISTS  `sp_tugas_list` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_tugas_list`(
	p_email VARCHAR(191)
)
BEGIN
	IF EXISTS(SELECT 1 FROM users WHERE u_email = p_email) THEN
		SELECT
		   `tugas`.`nama_tugas`
		FROM
		    `yzjvincb_kuliahku`.`user_tugas`
		    INNER JOIN `yzjvincb_kuliahku`.`users` 
			ON (`user_tugas`.`user_id` = `users`.`id`)
		    INNER JOIN `yzjvincb_kuliahku`.`tugas` 
			ON (`user_tugas`.`id_tugas` = `tugas`.`id`)
		WHERE u_email=p_email;
	ELSE
		SELECT -1, 'Email tidak terdaftar';
	END IF;
    END */$$
DELIMITER ;

/* Procedure structure for procedure `sp_user_statistik` */

/*!50003 DROP PROCEDURE IF EXISTS  `sp_user_statistik` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_user_statistik`(
	p_email VARCHAR(191)
)
BEGIN
	IF EXISTS(SELECT 1 FROM users WHERE u_email = p_email) THEN
		SELECT
		    1 as ind
		    , `users`.`u_name`
		    , `users`.`u_email`
		    , `statistiks`.`knowledge_stat`
		    , `statistiks`.`moral_stat`
		    , `statistiks`.`sks_stat`
		    , `statistiks`.`tugas_ambil_count`
		FROM
		    `yzjvincb_kuliahku`.`statistiks`
		    INNER JOIN `yzjvincb_kuliahku`.`users` 
			ON (`statistiks`.`user_id` = `users`.`id`)
		WHERE u_email=p_email;
	ELSE
		SELECT -1, 'Email tidak terdaftar';
	END IF;
    END */$$
DELIMITER ;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
