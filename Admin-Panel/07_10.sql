/*
SQLyog Ultimate v12.09 (64 bit)
MySQL - 10.1.37-MariaDB : Database - admintest
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Data for the table `account` */

insert  into `account`(`id`,`name`,`price`,`status`) values (1,'START',0.01,1),(2,'BASIC',9.99,1),(3,'PRO',49.95,1),(4,'PREMIUM',89.95,1);

/*Data for the table `admin_groups` */

insert  into `admin_groups`(`id`,`name`) values (1,'Administrator');

/*Data for the table `orders` */

/*Data for the table `users` */

insert  into `users`(`user_id`,`user_email`,`user_name`,`user_password`,`status`,`is_delete`,`created_at`,`updated_at`,`verification_key`,`ip`) values (1,'Successluxurylife@gmail.com','Successluxurylife','da83cb97dc9e711034b0edadb2d40c3c',1,'0','2019-06-09 00:00:00','2019-07-15 21:44:45','dfasdfa3a33a','192.168.200.212'),(2,'gabriel@googleninja.co.uk','googleninja','da83cb97dc9e711034b0edadb2d40c3c',1,'0','2019-06-10 00:00:00','2019-07-15 10:19:05','dfasdfa3a33a','192.168.200.212'),(3,'lololol@gmail.com','mikeygee','da83cb97dc9e711034b0edadb2d40c3c',0,'0','2019-06-04 00:00:00','2019-06-04 00:00:00','dfasdfa3a33a',''),(4,'asdasdad@gmail.com','eaaadd','da83cb97dc9e711034b0edadb2d40c3c',1,'0','2019-06-05 00:00:00','2019-06-05 00:00:00','dfasdfa3a33a',''),(5,'ibrahim1@greengrapez.com','ibrahim','da83cb97dc9e711034b0edadb2d40c3c',2,'0','2019-07-04 09:20:21','2019-07-09 05:36:41','dfasdfa3a33a',''),(6,'joelyanez123@yahoo.com','Joelyunez','da83cb97dc9e711034b0edadb2d40c3c',1,'0','2019-07-04 23:29:47','2019-07-09 05:36:57','dfasdfa3a33a',''),(8,'test@email.com','test','da83cb97dc9e711034b0edadb2d40c3c',0,'0','0000-00-00 00:00:00','2019-07-13 23:19:46','50nAY9LOox','::1');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
