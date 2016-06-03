# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Hôte: 127.0.0.1 (MySQL 5.5.42)
# Base de données: mobile-camp
# Temps de génération: 2016-05-07 16:13:10 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Affichage de la table Skills
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Skills`;

CREATE TABLE `Skills` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(200) NOT NULL DEFAULT '',
  `type_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `type_id` (`type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `Skills` WRITE;
/*!40000 ALTER TABLE `Skills` DISABLE KEYS */;

INSERT INTO `Skills` (`id`, `nom`, `type_id`)
VALUES
	(1,'HTML',1),
	(2,'CSS',1),
	(3,'BOOTSTRAP',1),
	(4,'JavaScript',1),
	(5,'AJAX',1),
	(6,'JQuery',1),
	(7,'NodeJS',1),
	(8,'AngularJS',1),
	(9,'PHP',1),
	(10,'MySQL',1),
	(11,'Symfony',1),
	(12,'RubyOnRails',1),
	(13,'Ruby',2),
	(14,'Shell',2),
	(15,'Python',2),
	(16,'Django',1),
	(17,'MongoDB',1),
	(18,'C',2),
	(19,'C++',2),
	(20,'C#',3),
	(21,'JAVA',3),
	(22,'Objective-C',3),
	(23,'Swift',3),
	(24,'Xcode',3),
	(25,'AndroidStudio',3),
	(26,'Ionic',3),
	(27,'Git',4),
	(28,'Subversion',4);

/*!40000 ALTER TABLE `Skills` ENABLE KEYS */;
UNLOCK TABLES;


# Affichage de la table SkillsUsers
# ------------------------------------------------------------

DROP TABLE IF EXISTS `SkillsUsers`;

CREATE TABLE `SkillsUsers` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `skill_id` int(11) unsigned NOT NULL,
  `amelioration` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `skill_id` (`skill_id`),
  CONSTRAINT `skillsusers_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `Users` (`id`),
  CONSTRAINT `skillsusers_ibfk_2` FOREIGN KEY (`skill_id`) REFERENCES `Skills` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `SkillsUsers` WRITE;
/*!40000 ALTER TABLE `SkillsUsers` DISABLE KEYS */;

INSERT INTO `SkillsUsers` (`id`, `user_id`, `skill_id`, `amelioration`)
VALUES
	(91,27,3,0),
	(92,27,4,0),
	(93,27,5,0),
	(94,27,8,0),
	(95,27,7,0),
	(96,27,6,0),
	(97,27,17,0),
	(98,27,18,0),
	(99,27,19,0),
	(100,27,25,0),
	(101,27,26,0),
	(102,27,27,0),
	(103,27,28,0),
	(104,28,4,0),
	(105,28,7,0),
	(106,28,6,0),
	(107,28,5,0),
	(108,28,10,0),
	(109,28,9,0),
	(110,28,12,0),
	(111,28,11,0),
	(112,29,28,0),
	(113,29,27,0),
	(114,30,1,0),
	(115,30,2,0),
	(116,30,5,0),
	(117,33,1,0),
	(118,33,2,0),
	(119,33,3,0),
	(120,33,7,0),
	(121,33,8,0),
	(122,33,10,0),
	(123,34,1,0),
	(124,34,5,0),
	(125,35,1,0),
	(126,35,5,0),
	(127,35,7,0),
	(128,36,1,0),
	(129,32,23,0),
	(130,32,25,0),
	(131,32,1,1),
	(132,32,2,1),
	(133,32,3,1),
	(134,32,4,1),
	(135,32,6,1),
	(136,37,1,0),
	(137,37,2,0),
	(138,37,3,0),
	(139,37,4,0),
	(140,37,5,0),
	(141,37,6,0),
	(142,37,1,0),
	(143,37,2,0),
	(144,37,3,0),
	(145,37,1,0),
	(146,37,2,0),
	(147,37,4,0),
	(148,37,1,0),
	(149,37,2,0),
	(150,37,4,0),
	(151,37,5,0),
	(152,37,1,0),
	(153,37,2,0),
	(154,37,4,0),
	(155,37,5,0),
	(156,38,1,0),
	(157,38,1,0),
	(158,38,2,0),
	(159,38,3,0),
	(160,38,4,0),
	(161,38,5,0),
	(162,38,1,0),
	(163,38,2,0),
	(164,38,3,0),
	(165,39,1,0),
	(166,39,2,0),
	(167,39,3,0),
	(168,39,4,0),
	(169,39,1,0),
	(170,39,2,0),
	(171,39,3,0),
	(172,40,1,0),
	(173,41,1,0),
	(174,41,2,0),
	(175,41,3,0),
	(176,41,4,0),
	(177,41,1,0),
	(178,41,2,0),
	(179,41,1,1),
	(180,41,3,1),
	(181,41,2,1),
	(182,41,1,1),
	(183,41,3,1),
	(184,41,2,1),
	(185,41,28,1),
	(186,42,1,0),
	(187,42,2,0),
	(188,42,22,1),
	(189,42,23,1),
	(190,42,24,1),
	(191,43,1,0),
	(192,43,2,1),
	(193,43,1,1),
	(194,44,5,0),
	(195,44,6,0),
	(196,44,7,0),
	(197,44,1,1),
	(198,44,2,1),
	(199,44,3,1),
	(200,44,1,1),
	(201,44,2,1);

/*!40000 ALTER TABLE `SkillsUsers` ENABLE KEYS */;
UNLOCK TABLES;


# Affichage de la table Users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Users`;

CREATE TABLE `Users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(150) NOT NULL DEFAULT '',
  `prenom` varchar(150) NOT NULL DEFAULT '',
  `login` varchar(150) NOT NULL DEFAULT '',
  `mdp` varchar(200) NOT NULL DEFAULT '',
  `promo` int(4) NOT NULL,
  `date_inscription` date NOT NULL,
  `telephone` varchar(10) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `Users` WRITE;
/*!40000 ALTER TABLE `Users` DISABLE KEYS */;

INSERT INTO `Users` (`id`, `nom`, `prenom`, `login`, `mdp`, `promo`, `date_inscription`, `telephone`)
VALUES
	(27,'kridagh','faouzi','kridag_f','$2a$10$Rnm2fBfTx3zquLPHkkFVB.zVpRzC5.KvBsFxP3O0t6i9KWHez822.',2019,'2016-05-06',''),
	(28,'cadet','anthony','cadet_a','$2a$10$df8ORmUTk2SXMUcQ4ktGeOQ7KPa19eRcQ2G1cOcSiGBr4qcWvXTbq',2019,'2016-05-06',''),
	(29,'dung','kevin','dung_k','$2a$10$FI6Abvf2Km3e6m6VsMX0veY3Q5BpjKC097WDh2xa2XAyQhZxsSWXS',2019,'2016-05-06',''),
	(30,'nom','prenom','login','$2a$10$b1kc/qkMjs4Tr33zSMPOie/whdlIDoGpQsypkQoFlzQd5KfnuWO.u',2017,'2016-05-07',''),
	(31,'nom2','prenom2','login2','$2a$10$urs7B9.kY9K7kwwM4dpEEOdDPzeqRJd0B2J.RWoXC1Lu9ir1IIRN2',2017,'2016-05-07',''),
	(32,'nom3','prenom3','login3','$2a$10$bhs0apjmOiBLVpqGvxvFEudUv8Jo7sHV/tUmvPnklulPb3sMKlBnK',2017,'2016-05-07',''),
	(33,'nom5','prenom5','login5','$2a$10$z4TGNprUOsZcjiVtq8ljMOJY2Agb2yEBkWgGE86EqpLBhlk/nkhxq',2018,'2016-05-07',''),
	(34,'nom6','prenom6','login6','$2a$10$4ewhjgTkmtyW2nX4Mpi0TO34R0MS/2SAlbIepLP4nRhQ4OkfugMBS',2017,'2016-05-07',''),
	(35,'nom7','prenom7','login7','$2a$10$prBZLsZms2QDhYj1rQeka.UOK5zeiA.8cR8LLX4eaMLCSgHmGsIOK',2018,'2016-05-07',''),
	(36,'nom8','prenom8','login8','$2a$10$XuS7LOovAjZxvZPGxT.NDuv5uk319V1z4UAWOtUx5bfya2z0THJoa',2018,'2016-05-07',''),
	(37,'login9','prenom9','login9','$2a$10$c6evAqO6MeWl7atRbrDa8.N/wfIA6cAs6MZAp7vaPOg5uHbLJC7pm',2018,'2016-05-07',''),
	(38,'prenom10','prenom10','login10','$2a$10$qA8.hzBQmrf.Bt.5kcdMlO.6fnoMFW/5/BybsL24XnBpCYXNbBls6',2018,'2016-05-07',''),
	(39,'nom11','prenom11','login11','$2a$10$v7wPTTNcOm526sl.NMcuOe9oDfpc1ZqIvCWsQ/NJG5UUG4xUNxt4y',2019,'2016-05-07',''),
	(40,'nom12','prenom12','login12','$2a$10$/.JSY2unN3.J.oMbLcSvrOz79QQ/CNajW6NqNRXg7f9haqxtAVGoC',2017,'2016-05-07',''),
	(41,'nom13','prenom13','login13','$2a$10$9FPuflvWnVxV0lL/C39ZcelWKR4wRcFK5ftffwNQdafCnWYAG3tje',2018,'2016-05-07',''),
	(42,'nom14','prenom14','login14','$2a$10$Z9h2omSVtf26l4hUVUkhFuWsRapKyTxK2mTEtxl0bldLMbTPC1uYi',2017,'2016-05-07',''),
	(43,'nom15','prenom15','login15','$2a$10$YRO3qstJgLW68tgWQZ2bkeAjdSBcPuDtTo4XW3nnWbkwizNVVJAy.',2017,'2016-05-07',''),
	(44,'nom16','prenom16','login16','$2a$10$etgAGtf.jAAlZR.DTaiav.DDGAvOWKc0UU/gtVcR6VA0koY0sNue2',2018,'2016-05-07',''),
	(49,'dzdzzddz','deeeded','marcho_i','$2a$10$0nf.JL2worjdTHaajvaObuJTwzHcCkno.UvEZCg2Mmr4GYJ3h1Sbi',2018,'2016-05-07','23456778');

/*!40000 ALTER TABLE `Users` ENABLE KEYS */;
UNLOCK TABLES;


# Affichage de la table WishList
# ------------------------------------------------------------

DROP TABLE IF EXISTS `WishList`;

CREATE TABLE `WishList` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned DEFAULT NULL,
  `user_like_id` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `user_like_id` (`user_like_id`),
  CONSTRAINT `wishlist_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `Users` (`id`),
  CONSTRAINT `wishlist_ibfk_2` FOREIGN KEY (`user_like_id`) REFERENCES `Users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `WishList` WRITE;
/*!40000 ALTER TABLE `WishList` DISABLE KEYS */;

INSERT INTO `WishList` (`id`, `user_id`, `user_like_id`)
VALUES
	(124,49,27),
	(125,49,28),
	(126,49,29),
	(127,49,30),
	(128,49,31),
	(129,49,32);

/*!40000 ALTER TABLE `WishList` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
