/*
SQLyog Ultimate v12.4.1 (32 bit)
MySQL - 10.1.29-MariaDB : Database - linkup
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`linkup` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `linkup`;

/*Table structure for table `author` */

DROP TABLE IF EXISTS `author`;

CREATE TABLE `author` (
  `authid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(80) DEFAULT NULL,
  `firstname` varchar(60) DEFAULT NULL,
  `lastname` varchar(60) DEFAULT NULL,
  `password` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`authid`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `author` */

insert  into `author`(`authid`,`email`,`firstname`,`lastname`,`password`) values 
(1,'hardman@gmail.com','Bill','Bones','12345'),
(2,'dolapo@gmail.com','Dolapo','Shambo','22222');

/*Table structure for table `blog` */

DROP TABLE IF EXISTS `blog`;

CREATE TABLE `blog` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `headline` varchar(200) DEFAULT NULL,
  `sub_heading` varchar(200) DEFAULT NULL,
  `body` text,
  `author` varchar(50) DEFAULT NULL,
  `date_written` datetime DEFAULT NULL,
  `date_edited` datetime DEFAULT NULL,
  `published` varchar(5) DEFAULT NULL,
  `date_published` datetime DEFAULT NULL,
  `headline_pix` varchar(80) DEFAULT NULL,
  `body_pix` varchar(80) DEFAULT NULL,
  `image_caption` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `blog` */

/*Table structure for table `department` */

DROP TABLE IF EXISTS `department`;

CREATE TABLE `department` (
  `sn` int(20) unsigned NOT NULL AUTO_INCREMENT,
  `faculty` varchar(40) DEFAULT NULL,
  `facultyid` int(10) DEFAULT NULL,
  `dept` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`sn`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=latin1;

/*Data for the table `department` */

insert  into `department`(`sn`,`faculty`,`facultyid`,`dept`) values 
(1,'Agricultural Sciences',1,'Agricultural Extension and Management '),
(2,'Agricultural Sciences',1,'Agricultural Extension and Rural Develop'),
(3,'Agricultural Sciences',1,'Crop Production and Protection Science'),
(4,'Agricultural Sciences',1,'Soil and Land Resources Management'),
(5,'Agricultural Sciences',1,'Agricultural Economics and Agro Business'),
(6,'Agricultural Sciences',1,'Acquaculture and Fisheries Management'),
(7,'Agricultural Sciences',1,'Animal Science'),
(8,'Agricultural Sciences',1,'Hotel and Catering Management'),
(9,'Arts',2,'Christian Religious Studies'),
(10,'Arts',2,'Islamic Studies'),
(11,'Arts',2,'French'),
(12,'Arts',2,'English'),
(13,'Education',3,'Guidance and Counselling'),
(14,'Education',3,'(ED) Business Education'),
(15,'Education',3,'(ED) Primary Education'),
(16,'Education',3,'(ED) French'),
(17,'Education',3,'(ED) English'),
(18,'Education',3,'(ED) Early Childhood Education'),
(19,'Education',3,'(ED) Physics'),
(20,'Education',3,'(ED) Mathematics'),
(21,'Education',3,'(ED) Computer Science'),
(22,'Education',3,'(ED) Integrated Science'),
(23,'Education',3,'(ED) Chemistry'),
(24,'Education',3,'(ED) Biology'),
(25,'Education',3,'(ED) Agricultural Science'),
(26,'Health Sciences',4,'Public Health'),
(27,'Health Sciences',4,'Nursing Science'),
(28,'Law',5,'Law'),
(29,'Management Sciences',6,'Banking and Finance'),
(30,'Management Sciences',6,'Marketing'),
(31,'Management Sciences',6,'Public Administration'),
(32,'Management Sciences',6,'Business Administration'),
(33,'Management Sciences',6,'Accounting'),
(34,'Management Sciences',6,'Entrepreneurship'),
(35,'Management Sciences',6,'Cooperative and Rural Development'),
(36,'Sciences',7,'Data Management'),
(37,'Sciences',7,'Physics'),
(38,'Sciences',7,'Biology'),
(39,'Sciences',7,'Chemistry'),
(40,'Sciences',7,'Information Technology'),
(41,'Sciences',7,'Mathematics/Computer Science'),
(42,'Sciences',7,'Mathematics'),
(43,'Sciences',7,'Environmental Management and Toxicology'),
(44,'Sciences',7,'Computer Science'),
(45,'Social Sciences',8,'International and Diplomatic Studies'),
(46,'Social Sciences',8,'Tourism Studies'),
(47,'Social Sciences',8,'Economics'),
(48,'Social Sciences',8,'Political Science'),
(49,'Social Sciences',8,'Mass Communication'),
(50,'Social Sciences',8,'Peace Studies and Conflict Resolution'),
(51,'Social Sciences',8,'Criminology and Security Studies');

/*Table structure for table `friends` */

DROP TABLE IF EXISTS `friends`;

CREATE TABLE `friends` (
  `sn` int(30) unsigned NOT NULL AUTO_INCREMENT,
  `user1` varchar(50) NOT NULL,
  `user2` varchar(50) NOT NULL,
  `date_initiated` datetime DEFAULT NULL,
  `status` int(5) DEFAULT NULL,
  `date_accepted` datetime DEFAULT NULL,
  `date_unfriend` datetime DEFAULT NULL,
  PRIMARY KEY (`sn`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `friends` */

/*Table structure for table `group_members` */

DROP TABLE IF EXISTS `group_members`;

CREATE TABLE `group_members` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `groupid` int(11) DEFAULT NULL,
  `member` varchar(30) DEFAULT NULL,
  `datejoined` datetime DEFAULT NULL,
  `statuss` varchar(3) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `group_members` */

/*Table structure for table `group_messages` */

DROP TABLE IF EXISTS `group_messages`;

CREATE TABLE `group_messages` (
  `sn` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `poster` varchar(30) DEFAULT NULL,
  `recipient` varchar(30) DEFAULT NULL,
  `ingroup` int(11) DEFAULT NULL,
  `content` text,
  `dateposted` datetime DEFAULT NULL,
  `mread` varchar(2) DEFAULT NULL,
  PRIMARY KEY (`sn`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `group_messages` */

/*Table structure for table `groups` */

DROP TABLE IF EXISTS `groups`;

CREATE TABLE `groups` (
  `groupid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `groupname` varchar(50) DEFAULT NULL,
  `purpose` varchar(100) DEFAULT NULL,
  `visibility` varchar(20) DEFAULT NULL,
  `creator` varchar(20) DEFAULT NULL,
  `datecreated` datetime DEFAULT NULL,
  `groupimage` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`groupid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `groups` */

/*Table structure for table `login_details` */

DROP TABLE IF EXISTS `login_details`;

CREATE TABLE `login_details` (
  `login_id` int(50) unsigned NOT NULL AUTO_INCREMENT,
  `matricno` varchar(50) DEFAULT NULL,
  `last_activity` datetime DEFAULT NULL,
  PRIMARY KEY (`login_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `login_details` */

/*Table structure for table `messages` */

DROP TABLE IF EXISTS `messages`;

CREATE TABLE `messages` (
  `sn` int(40) unsigned NOT NULL AUTO_INCREMENT,
  `sender` varchar(40) DEFAULT NULL,
  `recipient` varchar(40) DEFAULT NULL,
  `content` varchar(300) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `mread` int(5) DEFAULT NULL,
  PRIMARY KEY (`sn`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `messages` */

/*Table structure for table `notifications` */

DROP TABLE IF EXISTS `notifications`;

CREATE TABLE `notifications` (
  `notf_id` int(20) unsigned NOT NULL AUTO_INCREMENT,
  `notf_type` int(10) DEFAULT NULL,
  `notify` varchar(50) DEFAULT NULL,
  `case_point` varchar(50) DEFAULT NULL,
  `person_point` varchar(50) DEFAULT NULL,
  `message` varchar(100) DEFAULT NULL,
  `date_log` datetime DEFAULT NULL,
  `mread` int(2) DEFAULT NULL,
  PRIMARY KEY (`notf_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `notifications` */

/*Table structure for table `status_comments` */

DROP TABLE IF EXISTS `status_comments`;

CREATE TABLE `status_comments` (
  `sn` int(20) unsigned NOT NULL AUTO_INCREMENT,
  `status` varchar(250) DEFAULT NULL,
  `commenter` varchar(30) DEFAULT NULL,
  `comment` text,
  `time` datetime DEFAULT NULL,
  PRIMARY KEY (`sn`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `status_comments` */

/*Table structure for table `status_likes` */

DROP TABLE IF EXISTS `status_likes`;

CREATE TABLE `status_likes` (
  `sn` int(20) unsigned NOT NULL AUTO_INCREMENT,
  `storyid` int(20) DEFAULT NULL,
  `liker` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`sn`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `status_likes` */

/*Table structure for table `statuss` */

DROP TABLE IF EXISTS `statuss`;

CREATE TABLE `statuss` (
  `status_sn` int(20) unsigned NOT NULL AUTO_INCREMENT,
  `poster` varchar(20) DEFAULT NULL,
  `text` text,
  `time` datetime DEFAULT NULL,
  `status_picture` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`status_sn`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `statuss` */

/*Table structure for table `study_centre` */

DROP TABLE IF EXISTS `study_centre`;

CREATE TABLE `study_centre` (
  `sn` int(30) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`sn`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=latin1;

/*Data for the table `study_centre` */

insert  into `study_centre`(`sn`,`name`) values 
(1,'Abeokuta Study Centre'),
(2,'Abuja Study Centre'),
(3,'Ado-Ekiti Study Centre'),
(4,'Akure Study Centre'),
(5,'Asaba Study Centre'),
(6,'Akwa Study Centre'),
(7,'Bauchi Study Centre'),
(8,'Benin Study Centre'),
(9,'Calabar Study Centre'),
(10,'Community Study Centre Emevor'),
(11,'Community Study Centre Awa-Ijebu'),
(12,'Community Study Centre Gulak'),
(13,'Community Study Centre Iyara'),
(14,'Community Study Centre Ogori'),
(15,'Damaturu Study Centre'),
(16,'Dutse Study Centre'),
(17,'Enugu Study Centre'),
(18,'Gombe Study Centre'),
(19,'Gusau Study Centre'),
(20,'Ibadan Study Centre'),
(21,'Ilorin Study Centre'),
(22,'Jalingo Study Centre'),
(23,'Jos Study Centre'),
(24,'Kaduna Study Centre'),
(25,'Kano Study Centre'),
(26,'Katsina Study Centre'),
(27,'Kebbi Study Centre'),
(28,'Lafia Study Centre'),
(29,'Lagos Study Centre'),
(30,'Lokoja Study Centre'),
(31,'Macarthy Study Centre'),
(32,'Maiduguri Study Centre'),
(33,'Makurdi Study Centre'),
(34,'Minna Study Centre'),
(35,'NOUN Special Study Centre'),
(36,'Osogbo Study Centre'),
(37,'Otukpo Study Centre'),
(38,'Owerri Study Centre'),
(39,'Portharcourt Study Centre'),
(40,'Sokoto Study Centre'),
(41,'Umudike Study Centre'),
(42,'Uyo Study Centre'),
(43,'Yenagoa Study Centre'),
(44,'Yola Study Centre');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `sn` int(25) unsigned NOT NULL AUTO_INCREMENT,
  `matricno` varchar(50) DEFAULT NULL,
  `fullname` varchar(50) DEFAULT NULL,
  `password` varchar(25) DEFAULT NULL,
  `faculty` varchar(50) DEFAULT NULL,
  `department` varchar(50) DEFAULT NULL,
  `level` varchar(10) DEFAULT NULL,
  `year` varchar(15) DEFAULT NULL,
  `study_centre` varchar(50) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `phone_no` varchar(20) DEFAULT NULL,
  `about` varchar(200) DEFAULT NULL,
  `picture` varchar(100) DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`sn`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `users` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
