-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : dim. 02 avr. 2023 à 10:07
-- Version du serveur : 8.0.31
-- Version de PHP : 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `cafoma`
--

-- --------------------------------------------------------

--
-- Structure de la table `createur`
--

DROP TABLE IF EXISTS `createur`;
CREATE TABLE IF NOT EXISTS `createur` (
  `idCreateur` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(80) NOT NULL,
  `videographie` text,
  PRIMARY KEY (`idCreateur`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `createur`
--

INSERT INTO `createur` (`idCreateur`, `nom`, `videographie`) VALUES
(1, 'test', 'test.mp4');

-- --------------------------------------------------------

--
-- Structure de la table `formations`
--

DROP TABLE IF EXISTS `formations`;
CREATE TABLE IF NOT EXISTS `formations` (
  `id` int NOT NULL AUTO_INCREMENT,
  `titre` varchar(150) NOT NULL,
  `image` varchar(150) NOT NULL,
  `description` text NOT NULL,
  `idCreateur` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `formation_auteur_FK` (`idCreateur`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `formations`
--

INSERT INTO `formations` (`id`, `titre`, `image`, `description`, `idCreateur`) VALUES
(1, 'test formation', 'test.png', 'test', 1);


-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `login` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `mail` varchar(100) NOT NULL,
  `role` varchar(50) NOT NULL,
  `image` varchar(100) DEFAULT NULL,
  `est_valide` tinyint(1) NOT NULL,

  PRIMARY KEY (`login`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `utilisateur`
--


INSERT INTO `utilisateur` (`login`, `password`, `mail`, `role`, `image`, `est_valide`) VALUES
('admin', 'admin', 'admin@test.fr', 'administrateur', 'test.png', 1, '4151582586');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `formations`
--
ALTER TABLE `formations`
  ADD CONSTRAINT `formation_auteur_FK` FOREIGN KEY (`idCreateur`) REFERENCES `createur` (`idCreateur`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
