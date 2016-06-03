# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Hôte: 127.0.0.1 (MySQL 5.5.42)
# Base de données: mobile-camp
# Temps de génération: 2016-05-09 16:46:28 +0000
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
	(1,2,1,0),
	(2,2,26,0),
	(3,2,3,1),
	(4,2,2,1),
	(5,3,8,0),
	(6,3,8,1);

/*!40000 ALTER TABLE `SkillsUsers` ENABLE KEYS */;
UNLOCK TABLES;


# Affichage de la table Terms
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Terms`;

CREATE TABLE `Terms` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `terms_id` int(8) NOT NULL,
  `nom_terms` varchar(200) NOT NULL DEFAULT '',
  `promo` int(4) NOT NULL,
  `spe` varchar(150) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `Terms` WRITE;
/*!40000 ALTER TABLE `Terms` DISABLE KEYS */;

INSERT INTO `Terms` (`id`, `terms_id`, `nom_terms`, `promo`, `spe`)
VALUES
	(1,128,'etna3r - IDV',2015,'IDV'),
	(2,129,'etna3r - ISR',2015,'ISR'),
	(3,134,'VAE -IDV',2016,'IDV'),
	(4,133,'VAE - ISR',2016,'ISR'),
	(5,83,'Master - Octobre - ISR',2016,'ISR'),
	(6,82,'Master - Octobre - IDV',2016,'IDV'),
	(7,100,'Master ED - Octobre - ISR',2016,'ISR'),
	(8,99,'Master ED - Octobre - IDV',2016,'IDV'),
	(9,78,'Master - Mars - ISR',2016,'ISR'),
	(10,77,'Master - Mars - IDV',2016,'IDV'),
	(11,98,'Master - Octobre - ISR',2017,'ISR'),
	(12,97,'Master - Octobre - IDV',2017,'IDV'),
	(13,93,'Master - Mars - ISR',2017,'ISR'),
	(14,92,'Master - Mars - IDV',2017,'IDV'),
	(15,110,'Master ED - Mars - ISR',2017,'ISR'),
	(16,109,'Master ED - Mars - IDV',2017,'IDV'),
	(17,191,'Master Basics - Mars',2018,''),
	(18,113,'Bachelor - Octobre',2018,''),
	(19,194,'ETNA Online',2018,''),
	(20,120,'Bachelor ED - Mars',2018,''),
	(21,106,'Bachelor - Mars',2018,''),
	(22,189,'Bachelor Basics - Mars',2019,''),
	(23,125,'Prep ETNA2',2019,''),
	(24,118,'Prep ETNA',2020,'');

/*!40000 ALTER TABLE `Terms` ENABLE KEYS */;
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
  `terms` int(11) NOT NULL,
  `date_inscription` date NOT NULL,
  `telephone` varchar(200) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `Users` WRITE;
/*!40000 ALTER TABLE `Users` DISABLE KEYS */;

INSERT INTO `Users` (`id`, `nom`, `prenom`, `login`, `mdp`, `terms`, `date_inscription`, `telephone`)
VALUES
	(2,'march','iliass','marcho_i','$2a$10$e1dgUi4IDfxhoeH3Q/pIW.lCpIMtsR/vPzJIVKEuBozAyRaNVu46y',133,'2016-05-09','10203'),
	(3,'KRIDAGH','Faouzi','kridag_f','$2a$10$GCahvraanWGtZ7ohNdwR5.TtKREe2ly1/v9BSpgW3lFumkshYTUCi',125,'2016-05-09','650168714');

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
	(1,3,2),
	(2,3,3);

/*!40000 ALTER TABLE `WishList` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
