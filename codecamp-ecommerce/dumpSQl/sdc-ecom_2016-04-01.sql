# ************************************************************
# Sequel Pro SQL dump
# Version 4529
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# H�te: 127.0.0.1 (MySQL 5.5.42)
# Base de donn�es: sdc-ecom
# Temps de g�n�ration: 2016-04-01 08:22:41 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Affichage de la table categories
# ------------------------------------------------------------

DROP TABLE IF EXISTS `categories`;

CREATE TABLE `categories` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `category_parent_id` int(11) DEFAULT NULL,
  `name` varchar(250) DEFAULT NULL,
  `code` varchar(250) DEFAULT NULL,
  `sexe_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;

INSERT INTO `categories` (`id`, `category_parent_id`, `name`, `code`, `sexe_id`)
VALUES
	(1,1,'Petite Maroquinerie','small-leather-goods',1),
	(2,1,'Sacs et Besaces','bags-and-ragbags',1),
	(3,1,'Etui Carte Bancaire','Business-card-case',1),
	(4,1,'Marques Pages','bookmarks',1),
	(5,1,'Petite Maroquinerie','small-leather-goods',2),
	(6,1,'Sacs et Besaces','bags-and-ragbags',2),
	(7,1,'Etui Carte Bancaire','Business-card-case',2),
	(8,1,'Boucle d\'Oreille','earring',2),
	(9,1,'Parures','ornament',2),
	(10,1,'Marques Pages','bookmarks',2),
	(11,1,'Doudous Peluches','soft-toys',3),
	(12,1,'Jouets 1er Age','Toys-for-early-learners',3),
	(13,1,'Voitures en Bois','car-from-wood',3),
	(14,1,'Cordes à sauter','skipping-rope',3),
	(15,1,'Yoyo et toupies','yoyo-and-spinning-top',3),
	(16,1,'Jeux d\'adresse','games-of-skills',3),
	(17,1,'Jeux Educatifs','educational-games',3),
	(18,1,'Jeux de Construction','construction-toys',3),
	(19,1,'Chambre','room',3),
	(20,1,'Accessoires','accessories',3),
	(21,2,'Soins Bébés','baby-care',NULL),
	(22,2,'Soins pour Femme','skin-care-for-women',NULL),
	(23,2,'Soins peau normale','skin-care-for-normal-skin',NULL),
	(24,2,'Soins peau mature','skin-care-for-mature-skin',NULL),
	(25,2,'Soins peau sèche','skin-care-for-dry-skin',NULL),
	(26,2,'Soins peau grasse','skin-care-for-oily-skin',NULL),
	(27,2,'Soins peau sensible','skin-care-for-sensitive-skin',NULL),
	(28,2,'Soins pour Homme','skin-care-for-men',NULL),
	(29,2,'Savon Bio','bio-soaps',NULL),
	(33,4,'Doudous Peluches','soft-toys',NULL),
	(34,4,'Jouets 1er Age','Toys-for-early-learners',NULL),
	(35,4,'Voitures en Bois','car-from-wood',NULL),
	(36,4,'Cordes à sauter','skipping-rope',NULL),
	(37,4,'Yoyo et toupies','yoyo-and-spinning-top',NULL),
	(38,4,'Jeux d\'adresse','games-of-skills',NULL),
	(39,4,'Jeux Educatifs','educational-games',NULL),
	(40,4,'Jeux de Construction','construction-toys',NULL),
	(41,4,'Chambre','room',NULL),
	(42,4,'Accessoires','accessories',NULL),
	(43,3,'Couverts en Bois','wooden-cultery',NULL),
	(44,3,'Ustensiles en Bois','wooden-utensils',NULL),
	(45,3,'Moulins à Epices','spices-mill',NULL),
	(46,3,'Poterie d\'Alsace','alsace-potery',NULL),
	(47,3,'Art et Décoration','art-decoration',NULL),
	(48,3,'Bougie parfumée','scented candle',NULL),
	(49,3,'Diffuseur de parfum','fragrance-diffuser',NULL),
	(50,3,'Extrait de parfum','perfum-extract',NULL),
	(51,3,'Encens','incense',NULL),
	(52,3,'Pot Pourri','pot-pourri',NULL);

/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;


# Affichage de la table category_parent
# ------------------------------------------------------------

DROP TABLE IF EXISTS `category_parent`;

CREATE TABLE `category_parent` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(250) DEFAULT NULL,
  `code` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `category_parent` WRITE;
/*!40000 ALTER TABLE `category_parent` DISABLE KEYS */;

INSERT INTO `category_parent` (`id`, `name`, `code`)
VALUES
	(1,'Maroquinerie','leather-shop'),
	(2,'Cosmétique Bio','cosmetic-bio'),
	(3,'Maison','house'),
	(4,'Jouets','games');

/*!40000 ALTER TABLE `category_parent` ENABLE KEYS */;
UNLOCK TABLES;


# Affichage de la table sexe
# ------------------------------------------------------------

DROP TABLE IF EXISTS `sexe`;

CREATE TABLE `sexe` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(250) DEFAULT NULL,
  `code` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `sexe` WRITE;
/*!40000 ALTER TABLE `sexe` DISABLE KEYS */;

INSERT INTO `sexe` (`id`, `name`, `code`)
VALUES
	(1,'Homme','men'),
	(2,'Femme','women'),
	(3,'Enfant','children'),
	(4,NULL,NULL);

/*!40000 ALTER TABLE `sexe` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
