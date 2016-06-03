-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Jeu 04 Février 2016 à 20:18
-- Version du serveur :  5.5.42
-- Version de PHP :  5.6.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `Ecommerce`
--

-- --------------------------------------------------------

--
-- Structure de la table `clients`
--

CREATE TABLE `clients` (
  `id` int(11) UNSIGNED NOT NULL,
  `fournisseur` tinyint(1) NOT NULL,
  `nom` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `prenom` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mail` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `motDePasse` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `adresse` text COLLATE utf8_unicode_ci,
  `telephone` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dateNaissance` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `produits`
--

CREATE TABLE `produits` (
  `id` int(11) UNSIGNED NOT NULL,
  `nomProduit` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `prix` varchar(6) COLLATE utf8_unicode_ci DEFAULT NULL,
  `categorie` int(4) DEFAULT NULL,
  `titreCategorie` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `active` tinyint(1) DEFAULT NULL,
  `image` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `produits`
--

INSERT INTO `produits` (`id`, `nomProduit`, `description`, `prix`, `categorie`, `titreCategorie`, `active`, `image`) VALUES
(1, 'PORTE MONNAIE NOIR', 'PORTE MONNAIE CUIR HAUT DE GAMME - NOIR', '19.00', 1, 'Maroquinerie', 0, 'images/porte-monnaie-noir.jpg'),
(2, 'Lait d\'ânesse bio corporel', 'Lait corporel hydratant peau douce femme à l\'argan et au lait d\'ânesse bio', '16,00', 2, 'Cosmetique', 0, 'images/lait-d-anesse-bio-corporel.jpg'),
(3, 'Marmite Alsace marine', 'MARMITE ALSACIENNE Points blancs / marine\r\n', '49.90', 3, 'Maison', 0, 'images/marmite-alsace-marine.jpg'),
(4, 'Compagnon rose violet', 'COMPAGNON TENDANCE CUIR HAUT DE GAMME - ROSE/VIOLET', '79,00', 1, 'Maroquinerie', 0, 'images/compagnon-rose-violet.jpg');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `produits`
--
ALTER TABLE `produits`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `produits`
--
ALTER TABLE `produits`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
