-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 10 mai 2022 à 19:27
-- Version du serveur :  5.7.31
-- Version de PHP : 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `ddmn_bdgestionentreprise`
--
CREATE DATABASE IF NOT EXISTS `ddmn_bdgestionentreprise` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `ddmn_bdgestionentreprise`;

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

DROP TABLE IF EXISTS `doctrine_migration_versions`;
CREATE TABLE IF NOT EXISTS `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20220505094546', '2022-05-10 07:48:58', 198),
('DoctrineMigrations\\Version20220505094820', '2022-05-10 07:48:58', 51);

-- --------------------------------------------------------

--
-- Structure de la table `entreprise`
--

DROP TABLE IF EXISTS `entreprise`;
CREATE TABLE IF NOT EXISTS `entreprise` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ent_raison_sociale` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ent_pays` varchar(38) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ent_ville` varchar(38) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ent_cp` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ent_rue` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ent_complement_adresse` longtext COLLATE utf8mb4_unicode_ci,
  `ent_num1` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ent_num2` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ent_site_web` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `entreprise`
--

INSERT INTO `entreprise` (`id`, `ent_raison_sociale`, `ent_pays`, `ent_ville`, `ent_cp`, `ent_rue`, `ent_complement_adresse`, `ent_num1`, `ent_num2`, `ent_site_web`) VALUES
(1, 'ABC INFORMATIQUE', 'France', 'Friville', '80130', 'Allée des marettes', 'Zac Le Parc', NULL, NULL, 'https://www.abcinformatique.fr/nos-magasins/materiel-informatique-depannage-friville/'),
(2, 'Agence Digiworks', 'France', 'Mont-Saint-Aignan', '76130', '85 Chemin de Clères', NULL, NULL, NULL, 'https://www.digiworks.fr/'),
(3, 'AGEVOL Développement', 'France', 'Bihorel', '76420', '10 rue Maréchal de Lattre de Tassigny', NULL, NULL, NULL, NULL),
(4, 'Centre Henri-Becquerel', 'France', 'Rouen Cedex 1', '76038', 'Rue d\'Amiens', 'CS11516', NULL, NULL, 'www.centre-henri-becquerel.fr');

-- --------------------------------------------------------

--
-- Structure de la table `fonction`
--

DROP TABLE IF EXISTS `fonction`;
CREATE TABLE IF NOT EXISTS `fonction` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fon_libelle` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `fonction`
--

INSERT INTO `fonction` (`id`, `fon_libelle`) VALUES
(1, 'Directeur de production'),
(2, 'RH'),
(3, 'DSI'),
(4, 'Développeur');

-- --------------------------------------------------------

--
-- Structure de la table `fonction_personne`
--

DROP TABLE IF EXISTS `fonction_personne`;
CREATE TABLE IF NOT EXISTS `fonction_personne` (
  `fonction_id` int(11) NOT NULL,
  `personne_id` int(11) NOT NULL,
  PRIMARY KEY (`fonction_id`,`personne_id`),
  KEY `IDX_F1D782F557889920` (`fonction_id`),
  KEY `IDX_F1D782F5A21BD112` (`personne_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `fonction_personne`
--

INSERT INTO `fonction_personne` (`fonction_id`, `personne_id`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4);

-- --------------------------------------------------------

--
-- Structure de la table `personne`
--

DROP TABLE IF EXISTS `personne`;
CREATE TABLE IF NOT EXISTS `personne` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `entreprise_id` int(11) NOT NULL,
  `per_nom` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `per_prenom` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `per_tel` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `per_mail` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_FCEC9EFA4AEAFEA` (`entreprise_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `personne`
--

INSERT INTO `personne` (`id`, `entreprise_id`, `per_nom`, `per_prenom`, `per_tel`, `per_mail`) VALUES
(1, 1, 'CARBONNIER', 'Alexandre', NULL, 'alex@abcinformatique.fr'),
(2, 1, 'Franck', 'Sébastien', NULL, 'sebastien@abcinformatique.fr'),
(3, 2, 'Seité', 'Alexandre', NULL, 'aseite@digiworks.fr'),
(4, 4, 'LE DENMAT', 'Jean-Marc', '02.32.08.22.09', 'jean-marc.le-denmat@chb.unicancer.fr');

-- --------------------------------------------------------

--
-- Structure de la table `personneprofil`
--

DROP TABLE IF EXISTS `personneprofil`;
CREATE TABLE IF NOT EXISTS `personneprofil` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `per_id_id` int(11) NOT NULL,
  `pro_id_id` int(11) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_780F4F62B1E86BCE` (`per_id_id`),
  KEY `IDX_780F4F62C19FAEF2` (`pro_id_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `personneprofil`
--

INSERT INTO `personneprofil` (`id`, `per_id_id`, `pro_id_id`, `date`) VALUES
(7, 1, 3, '2021-08-30'),
(8, 2, 4, '2021-05-07'),
(9, 3, 2, '2021-09-27'),
(10, 3, 4, '2021-06-02'),
(11, 4, 1, '2022-01-13'),
(12, 4, 3, '2021-04-18');

-- --------------------------------------------------------

--
-- Structure de la table `profil`
--

DROP TABLE IF EXISTS `profil`;
CREATE TABLE IF NOT EXISTS `profil` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pro_libelle` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `profil`
--

INSERT INTO `profil` (`id`, `pro_libelle`) VALUES
(1, 'Responsable'),
(2, 'Tuteur'),
(3, 'Jury'),
(4, 'Envoi de CV');

-- --------------------------------------------------------

--
-- Structure de la table `specialite`
--

DROP TABLE IF EXISTS `specialite`;
CREATE TABLE IF NOT EXISTS `specialite` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `spe_libelle` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `specialite`
--

INSERT INTO `specialite` (`id`, `spe_libelle`) VALUES
(1, 'SLAM'),
(2, 'SISR'),
(3, 'Licences');

-- --------------------------------------------------------

--
-- Structure de la table `specialite_entreprise`
--

DROP TABLE IF EXISTS `specialite_entreprise`;
CREATE TABLE IF NOT EXISTS `specialite_entreprise` (
  `specialite_id` int(11) NOT NULL,
  `entreprise_id` int(11) NOT NULL,
  PRIMARY KEY (`specialite_id`,`entreprise_id`),
  KEY `IDX_EA0D81742195E0F0` (`specialite_id`),
  KEY `IDX_EA0D8174A4AEAFEA` (`entreprise_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `specialite_entreprise`
--

INSERT INTO `specialite_entreprise` (`specialite_id`, `entreprise_id`) VALUES
(1, 1),
(1, 2),
(1, 4),
(2, 1),
(2, 3),
(2, 4),
(3, 4);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uti_login` varchar(38) COLLATE utf8mb4_unicode_ci NOT NULL,
  `uti_mdp` varchar(38) COLLATE utf8mb4_unicode_ci NOT NULL,
  `uti_role` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `uti_login`, `uti_mdp`, `uti_role`) VALUES
(1, 'ADMIN', 'ecf482a600e363689703fe9f1bb1e80c', 1),
(2, 'Enseignant', 'ffa30b58137ef56ec4415a64f7d5d919', 0);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `fonction_personne`
--
ALTER TABLE `fonction_personne`
  ADD CONSTRAINT `FK_F1D782F557889920` FOREIGN KEY (`fonction_id`) REFERENCES `fonction` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_F1D782F5A21BD112` FOREIGN KEY (`personne_id`) REFERENCES `personne` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `personne`
--
ALTER TABLE `personne`
  ADD CONSTRAINT `FK_FCEC9EFA4AEAFEA` FOREIGN KEY (`entreprise_id`) REFERENCES `entreprise` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `personneprofil`
--
ALTER TABLE `personneprofil`
  ADD CONSTRAINT `FK_780F4F62B1E86BCE` FOREIGN KEY (`per_id_id`) REFERENCES `personne` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_780F4F62C19FAEF2` FOREIGN KEY (`pro_id_id`) REFERENCES `profil` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `specialite_entreprise`
--
ALTER TABLE `specialite_entreprise`
  ADD CONSTRAINT `FK_EA0D81742195E0F0` FOREIGN KEY (`specialite_id`) REFERENCES `specialite` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_EA0D8174A4AEAFEA` FOREIGN KEY (`entreprise_id`) REFERENCES `entreprise` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
