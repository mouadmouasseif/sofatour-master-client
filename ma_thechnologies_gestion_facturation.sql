-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 09 jan. 2025 à 12:32
-- Version du serveur : 10.4.25-MariaDB
-- Version de PHP : 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `ma_thechnologies_gestion_facturation`
--

-- --------------------------------------------------------

--
-- Structure de la table `annulation_cause`
--

CREATE TABLE `annulation_cause` (
  `id_annulation_cause` int(11) NOT NULL,
  `libeller` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `annulation_cause`
--

INSERT INTO `annulation_cause` (`id_annulation_cause`, `libeller`) VALUES
(1, 'Report'),
(2, 'Changement de ville'),
(3, 'Changement de cite'),
(4, 'Prix élevé'),
(5, 'Autre');

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `categories_id` int(11) NOT NULL,
  `categories_name` varchar(255) NOT NULL,
  `categories_active` int(11) NOT NULL DEFAULT 0,
  `categories_status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`categories_id`, `categories_name`, `categories_active`, `categories_status`) VALUES
(9, 'Material', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `clients`
--

CREATE TABLE `clients` (
  `id_client` int(11) NOT NULL,
  `societe` varchar(255) DEFAULT NULL,
  `nom_complet` varchar(255) DEFAULT NULL,
  `ice` varchar(300) DEFAULT NULL,
  `rc` varchar(300) DEFAULT NULL,
  `adresse` varchar(1500) DEFAULT NULL,
  `date_d_entree` datetime DEFAULT NULL,
  `utilisateurs` int(11) DEFAULT NULL,
  `client_type` int(11) DEFAULT NULL,
  `avance` tinyint(1) DEFAULT NULL,
  `client_secteur` int(11) DEFAULT NULL,
  `Agence_evementiel` tinyint(1) DEFAULT NULL,
  `id_societe` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `clients`
--

INSERT INTO `clients` (`id_client`, `societe`, `nom_complet`, `ice`, `rc`, `adresse`, `date_d_entree`, `utilisateurs`, `client_type`, `avance`, `client_secteur`, `Agence_evementiel`, `id_societe`) VALUES
(1, 'Revolver Solutions', NULL, '123456789000057', '23456789000057', 'Sale', '2024-11-19 17:10:28', 1, 1, 0, 1, 0, 1),
(2, 'TARBOUCHA', NULL, '123456789000057', '1234567890', 'Marina, Sale', '2024-12-02 10:23:48', 1, 1, 0, 1, 0, 1),
(3, 'SAKAN', NULL, NULL, NULL, 'Rabat, Maroc', '2024-12-02 11:15:11', 1, 1, 0, 3, 0, 3),
(4, 'Salka', NULL, '28738623483263973', '37637862499383183628', 'rabat Maroc', '2024-12-02 15:58:05', 1, 1, 0, 1, 0, 2),
(14, 'kapi', NULL, '1234567890000233', '12345678099', 'rabat, Sale', '2023-12-02 10:23:48', 1, 1, 0, 1, 0, 3),
(15, NULL, 'mouad mok', NULL, NULL, '123', '2024-12-24 09:50:05', 2, 2, 0, NULL, 0, 2),
(16, 'Royome de maroc', NULL, NULL, NULL, 'maroc', '2025-01-03 15:00:19', 1, 1, 0, 3, 0, 7),
(17, NULL, 'mok mok', NULL, NULL, 'rabat rabat', '2025-01-06 08:48:48', 1, 2, 0, NULL, 0, 7),
(18, NULL, 'karima karim', NULL, NULL, 'rabat sale', '2025-01-07 14:39:47', 2, 2, 0, NULL, 0, 2),
(19, 'morrr', NULL, NULL, NULL, 'rabat maroc', '2025-01-07 14:41:01', 2, 1, 0, 3, 0, 1);

-- --------------------------------------------------------

--
-- Structure de la table `client_devis`
--

CREATE TABLE `client_devis` (
  `id_client_devis` int(11) NOT NULL,
  `le_devis` date DEFAULT NULL,
  `a_devis` varchar(255) DEFAULT NULL,
  `objet` varchar(400) DEFAULT NULL,
  `date_d_entree` datetime DEFAULT NULL,
  `du_date` date DEFAULT NULL,
  `a_tel_date` date DEFAULT NULL,
  `TVA` int(11) NOT NULL,
  `devis_objet` int(11) DEFAULT NULL,
  `Observation` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `client_devis`
--

INSERT INTO `client_devis` (`id_client_devis`, `le_devis`, `a_devis`, `objet`, `date_d_entree`, `du_date`, `a_tel_date`, `TVA`, `devis_objet`, `Observation`) VALUES
(4, '2024-11-26', 'Revolver Solutions', 'Diner de Gala', '2024-11-21 11:12:42', '2024-11-14', '2024-11-16', 12, 10, ''),
(6, '2024-11-26', 'Revolver Solutions LJADID', 'Diner de Gala', '2024-11-21 14:25:19', '2024-11-14', '2024-11-17', 1, 10, ''),
(7, '2024-12-08', 'Revolver Solutions Dep. lala', 'Location d\'espace avec déjeuner', '2024-11-21 14:27:28', '2024-11-19', '2024-11-21', 1, 7, ''),
(8, '2024-12-31', 'Revolver Solutions TEST', 'Diner de Gala', '2024-11-21 14:25:19', '2025-01-07', '2025-01-07', 1, 10, ''),
(9, '2024-12-08', 'Revolver Solutions Night', 'Location d\'espace avec diner', '2024-11-25 08:17:02', '2024-11-20', '2024-11-22', 1, 8, ''),
(10, '2024-11-28', 'Revolver Solutions LOCO', 'Location d\'espace avec pause café', '2024-11-25 09:02:59', '2024-11-26', '2024-11-27', 1, 6, ''),
(11, '2024-12-08', 'Revolver Solutions Dep. lala', 'Location d\'espace avec déjeuner', '2024-11-21 14:27:28', '2024-11-19', '2024-11-21', 1, 7, ''),
(12, '2024-12-08', 'Revolver Solutions Dep. Finance', 'Location d\'espace avec déjeuner', '2024-11-26 15:02:48', '2024-11-26', '2024-11-30', 1, 7, ''),
(13, '2024-11-30', 'Revolver Solutions Dep. Sociale', 'Location d\'espace', '2024-11-27 09:31:18', '2024-11-26', '2024-11-30', 1, 3, ''),
(14, '2024-11-27', 'Revolver Solutions Dep. Sociale', 'Diner de Gala', '2024-11-27 10:33:51', '2024-11-26', '2024-11-30', 1, 10, ''),
(15, '2024-11-27', 'Revolver Solutions Dep. Sociale', 'Diner de Gala', '2024-11-27 10:33:51', '2024-11-26', '2024-11-30', 1, 10, ''),
(16, '2024-11-30', 'Revolver Solutions Dep. Sociale', 'Location d\'espace', '2024-11-27 09:31:18', '2024-11-26', '2024-11-30', 1, 3, ''),
(17, '2024-12-08', 'Revolver Solutions Dep. Finance', 'Location d\'espace avec déjeuner', '2024-11-26 15:02:48', '2024-11-26', '2024-11-30', 1, 7, ''),
(18, '2024-11-26', 'Revolver Solutions', 'Diner de Gala', '2024-11-21 11:12:42', '2024-11-14', '2024-11-16', 12, 10, ''),
(19, '2024-11-26', 'Revolver Solutions', 'Diner de Gala', '2024-11-21 11:12:42', '2024-11-14', '2024-11-16', 12, 10, ''),
(20, '2024-12-03', '', 'Soirée', '2024-12-03 09:17:47', '2024-12-03', '2024-12-03', 1, 10, ''),
(21, '2024-12-03', '', 'Journée séminaire', '2024-12-03 09:17:47', '2024-12-03', '2024-12-03', 1, 1, ''),
(22, '2024-12-03', '', 'Demi-journée séminaire', '2024-12-03 09:22:44', '2024-12-03', '2024-12-05', 1, 2, ''),
(23, '2024-12-03', '', 'Soirée Mariage', '2024-12-03 09:17:47', '2024-12-05', '2024-12-05', 10, 9, ''),
(24, '2024-12-03', '', 'Diner de Gala', '2024-12-03 09:17:47', '2024-12-03', '2024-12-03', 1, 10, ''),
(25, '2024-12-03', '', 'Diner de Gala', '2024-12-03 09:17:47', '2024-12-03', '2024-12-03', 1, 10, ''),
(26, '2024-12-03', '', 'Diner de Gala', '2024-12-03 09:17:47', '2024-12-03', '2024-12-03', 1, 10, ''),
(27, '2024-12-03', '', 'Soirée', '2024-12-03 09:17:47', '2024-12-03', '2024-12-03', 1, 12, ''),
(28, '2024-12-03', '', 'Soirée', '2024-12-03 09:17:47', '2024-12-03', '2024-12-03', 1, 12, ''),
(29, '2024-12-03', '', 'Diner de Gala', '2024-12-03 09:17:47', '2024-12-03', '2024-12-03', 1, 10, ''),
(30, '2024-12-03', '', 'Diner de Gala', '2024-12-03 09:17:47', '2024-12-03', '2024-12-03', 1, 10, ''),
(31, '2024-12-03', '', 'Diner de Gala', '2024-12-03 09:17:47', '2024-12-03', '2024-12-03', 1, 10, ''),
(32, '2024-12-03', '', 'Diner de Gala', '2024-12-03 09:17:47', '2024-12-03', '2024-12-03', 1, 10, ''),
(33, '2024-12-03', '', 'Diner de Gala', '2024-12-03 09:17:47', '2024-12-03', '2024-12-03', 1, 10, ''),
(34, '2024-12-03', '', 'Diner de Gala', '2024-12-03 09:17:47', '2024-12-03', '2024-12-03', 1, 10, ''),
(36, '2024-12-09', '', 'Demi-journée séminaire', '2024-12-09 09:16:53', '2024-12-09', '2024-12-09', 10, 2, ''),
(37, '2024-12-03', '', 'Diner de Gala', '2024-12-03 09:17:47', '2024-12-03', '2024-12-03', 1, 10, ''),
(38, '2024-12-03', '', 'Diner de Gala', '2024-12-03 09:17:47', '2024-12-03', '2024-12-03', 1, 10, ''),
(39, '0000-00-00', '', 'Diner de Gala', '2024-12-03 09:17:47', '0000-00-00', '0000-00-00', 1, 10, ''),
(40, '2024-12-03', '', 'Diner de Gala', '2024-12-03 09:17:47', '2024-12-03', '2024-12-03', 1, 10, ''),
(41, '2024-12-10', 'TARBOUCHA ok', 'Soirée', '2024-12-10 21:44:35', '2024-12-10', '2024-12-10', 1, 12, ''),
(44, '2024-12-11', 'TARBOUCHA MAr', 'Soirée', '2024-12-11 08:55:29', '2024-12-11', '2024-12-11', 11, 12, ''),
(45, '2024-12-13', 'Salka js', 'Soirée Mariage', '2024-12-13 14:04:05', '2024-12-13', '2024-12-14', 1, 9, ''),
(46, '2024-12-13', 'Salka js', 'Soirée Mariage', '2024-12-13 14:04:05', '2024-12-15', '2024-12-17', 11, 9, ''),
(47, '2024-12-19', '', 'Traiteur Externe', '2024-12-19 10:26:27', '2025-01-01', '2025-01-03', 11, 11, ''),
(48, '0000-00-00', 'mok mok', NULL, '0000-00-00 00:00:00', NULL, NULL, 20, NULL, 'be good');

-- --------------------------------------------------------

--
-- Structure de la table `client_devis_client`
--

CREATE TABLE `client_devis_client` (
  `id_client_devis` int(11) NOT NULL,
  `id_client` int(11) NOT NULL,
  `utilisateurs` int(11) DEFAULT NULL,
  `version_devis` float DEFAULT NULL,
  `Numero_devis` varchar(255) DEFAULT NULL,
  `prix_total_ttc` double NOT NULL,
  `confirmer` tinyint(1) NOT NULL DEFAULT 0,
  `annuler` tinyint(1) NOT NULL DEFAULT 0,
  `id_annulation_cause` int(11) DEFAULT NULL,
  `anuulation_cause` varchar(700) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `client_devis_client`
--

INSERT INTO `client_devis_client` (`id_client_devis`, `id_client`, `utilisateurs`, `version_devis`, `Numero_devis`, `prix_total_ttc`, `confirmer`, `annuler`, `id_annulation_cause`, `anuulation_cause`) VALUES
(4, 1, 1, 1, 'DE-2024-00321', 1936.48, 1, 0, NULL, NULL),
(6, 1, 1, 1, 'DE-2024-00322', 9756.6, 1, 0, NULL, NULL),
(7, 1, 1, 1, 'DE-2024-00323', 24577.34, 1, 0, NULL, NULL),
(9, 1, 1, 1, 'DE-2024-00324', 3490.56, 1, 0, NULL, NULL),
(9, 4, 1, 1, 'DE-2025-00335', 111.11, 1, 0, NULL, NULL),
(10, 1, 1, 1, 'DE-2024-00325', 3490.56, 1, 0, NULL, NULL),
(12, 1, 1, 1, 'DE-2024-00326', 3490.56, 1, 0, NULL, NULL),
(13, 1, 1, 1, 'DE-2024-00327', 14033.95, 1, 0, NULL, NULL),
(14, 1, 1, 1, 'DE-2024-00328', 15906.49, 1, 0, NULL, NULL),
(18, 1, 1, 2, 'DE-2024-00321', 1949.92, 1, 0, NULL, NULL),
(19, 1, 1, 3, 'DE-2024-00321', 1949.92, 1, 0, NULL, NULL),
(20, 4, 1, 1, 'DE-2024-00329', 183363.48, 1, 0, NULL, NULL),
(22, 4, 1, 1, 'DE-2024-00330', 191.9, 1, 0, NULL, NULL),
(36, 4, 1, 1, 'DE-2024-00331', 119.9, 0, 0, NULL, NULL),
(41, 2, 1, 1, 'DE-2024-00332', 11.11, 1, 0, NULL, NULL),
(44, 2, 1, 1, 'DE-2024-00333', 1611.72, 1, 0, NULL, NULL),
(45, 4, 1, 1, 'DE-2024-00334', 1344.31, 1, 0, NULL, NULL),
(47, 1, 1, 1, 'DE-2024-00335', 19244.07, 1, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `client_facture_client`
--

CREATE TABLE `client_facture_client` (
  `id_client_Facture` int(11) NOT NULL,
  `id_client_devis` int(11) NOT NULL,
  `id_client` int(11) NOT NULL,
  `utilisateurs` int(11) DEFAULT NULL,
  `Numero_Facture` varchar(255) DEFAULT NULL,
  `prix_total_ttc` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `client_facture_client`
--

INSERT INTO `client_facture_client` (`id_client_Facture`, `id_client_devis`, `id_client`, `utilisateurs`, `Numero_Facture`, `prix_total_ttc`) VALUES
(8, 6, 1, 1, 'FA-2024-00137', 9756.6),
(11, 7, 1, 1, 'FA-2024-00138', 24577.34),
(17, 12, 1, 1, 'FA-2024-00141', 17524.51),
(16, 13, 1, 1, 'FA-2024-00140', 14033.95),
(15, 14, 1, 1, 'FA-2024-00139', 15906.49),
(21, 20, 4, 1, 'FA-2024-00142', 185108.76),
(23, 20, 4, 1, 'FA-2024-00143', 185108.76),
(24, 20, 4, 1, 'FA-2024-00144', 185108.76),
(25, 20, 4, 1, 'FA-2024-00145', 185108.76),
(26, 20, 4, 1, 'FA-2024-00146', 185108.76),
(27, 20, 4, 1, 'FA-2024-00147', 185108.76),
(28, 20, 4, 1, 'FA-2024-00148', 185108.76),
(29, 20, 4, 1, 'FA-2024-00149', 185108.76),
(30, 20, 4, 1, 'FA-2024-00150', 185108.76),
(31, 20, 4, 1, 'FA-2024-00151', 185108.76),
(32, 20, 4, 1, 'FA-2024-00152', 185108.76),
(33, 20, 4, 1, 'FA-2024-00153', 185108.76),
(34, 20, 4, 1, 'FA-2024-00154', 185108.76),
(37, 20, 4, 1, 'FA-2024-00155', 185108.76),
(38, 20, 4, 1, 'FA-2024-00156', 185108.76),
(39, 20, 4, 1, 'FA-2024-00157', 185108.76),
(40, 20, 4, 1, 'FA-2024-00158', 185108.76),
(46, 45, 4, 1, 'FA-2024-00159', 34407.78);

-- --------------------------------------------------------

--
-- Structure de la table `client_fournisseur`
--

CREATE TABLE `client_fournisseur` (
  `id` int(11) NOT NULL,
  `nom_fournisseur` varchar(100) NOT NULL,
  `adresse_ville` varchar(50) NOT NULL,
  `adresse_pays` varchar(50) NOT NULL,
  `adresse_code_postal` varchar(10) DEFAULT NULL,
  `contact_nom` varchar(100) NOT NULL,
  `contact_telephone` varchar(20) NOT NULL,
  `contact_email` varchar(100) NOT NULL,
  `site_web` varchar(255) DEFAULT NULL,
  `rib_iban` varchar(34) NOT NULL,
  `identifiant_fiscal` varchar(20) NOT NULL,
  `registre_commerce` varchar(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `client_ligne_devis`
--

CREATE TABLE `client_ligne_devis` (
  `id_client_ligne_devis` int(11) NOT NULL,
  `prestation` text DEFAULT NULL,
  `unite` float DEFAULT NULL,
  `nbr_jour` float DEFAULT NULL,
  `pu_ht` float DEFAULT NULL,
  `pt_ht` double DEFAULT NULL,
  `client_ligne_devis_type_prestation` int(11) DEFAULT NULL,
  `client_devis` int(11) DEFAULT NULL,
  `ligne_devis_prestation` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `client_ligne_devis`
--

INSERT INTO `client_ligne_devis` (`id_client_ligne_devis`, `prestation`, `unite`, `nbr_jour`, `pu_ht`, `pt_ht`, `client_ligne_devis_type_prestation`, `client_devis`, `ligne_devis_prestation`) VALUES
(5, 'Salle de Réunion  avec projection, pupitre, micros fixe, eau minérale, bloc note, crayons et décoration florale.<br/> Pause café Matin Améliorée : Thé, café, eau minérale, lait, jus d’orange, pâtisserie marocaine et française, variété de salé, viennoiserie.<br/> Déjeuner Servis à table ou Buffet  avec Boissons Soft Incluses.<br/> Pause Café après midi améliorée :Thé, café, eau minérale, lait, jus d’orange, pâtisserie marocaine et française, variété de salé et canapés froid.', 12, 12, 12, 1728, 1, 4, 81),
(6, 'jeux de lumière HALL / RIAD', 1, 1, 1, 1, 2, 4, 93),
(7, 'Salle de Réunion  avec projection, pupitre, micros fixe, eau minérale, bloc note, crayons et décoration florale.<br/> Pause café Matin Améliorée : Thé, café, eau minérale, lait, jus d’orange, pâtisserie marocaine et française, variété de salé, viennoiserie.<br/> Déjeuner Servis à table ou Buffet  avec Boissons Soft Incluses.<br/> Pause Café après midi améliorée :Thé, café, eau minérale, lait, jus d’orange, pâtisserie marocaine et française, variété de salé et canapés froid.', 23, 12, 23, 6348, 1, 6, 81),
(8, 'ECRAN LED LE RIAD 8*4', 23, 12, 12, 3312, 3, 6, 94),
(9, 'Salle de Réunion  avec projection, pupitre, micros fixe, eau minérale, bloc note, crayons et décoration florale.<br/> Pause café Matin Améliorée : Thé, café, eau minérale, lait, jus d’orange, pâtisserie marocaine et française, variété de salé, viennoiserie.<br/> Déjeuner Servis à table ou Buffet  avec Boissons Soft Incluses.<br/> Pause Café après midi améliorée :Thé, café, eau minérale, lait, jus d’orange, pâtisserie marocaine et française, variété de salé et canapés froid.', 23, 23, 23, 12167, 1, 7, 81),
(10, 'ECRAN LED LE RIAD 8*4', 23, 23, 23, 12167, 2, 7, 94),
(13, 'Salle de Réunion  avec projection, pupitre, micros fixe, eau minérale, bloc note, crayons et décoration florale.<br/> Pause café Matin Améliorée : Thé, café, eau minérale, lait, jus d’orange, pâtisserie marocaine et française, variété de salé, viennoiserie.<br/> Déjeuner Servis à table ou Buffet  avec Boissons Soft Incluses.<br/> Pause Café après midi améliorée :Thé, café, eau minérale, lait, jus d’orange, pâtisserie marocaine et française, variété de salé et canapés froid.', 12, 12, 12, 1728, 1, 9, 81),
(14, 'ECRAN LED LE RIAD 8*4', 12, 12, 12, 1728, 2, 9, 94),
(15, 'Salle de Réunion  avec projection, pupitre, micros fixe, eau minérale, bloc note, crayons et décoration florale.<br/> Ftour en Buffet ou Servis à table.<br/> Animation musicale traditionnel.', 12, 12, 12, 1728, 1, 10, 82),
(16, 'ECRAN LED LE RIAD 8*4', 12, 12, 12, 1728, 2, 10, 94),
(17, 'Salle de Réunion  avec projection, pupitre, micros fixe, eau minérale, bloc note, crayons et décoration florale.<br/> Pause café Matin Améliorée : Thé, café, eau minérale, lait, jus d’orange, pâtisserie marocaine et française, variété de salé, viennoiserie.<br/> Déjeuner Servis à table ou Buffet  avec Boissons Soft Incluses.<br/> Pause Café après midi améliorée :Thé, café, eau minérale, lait, jus d’orange, pâtisserie marocaine et française, variété de salé et canapés froid.', 23, 23, 23, 12167, 1, 11, 81),
(18, 'ECRAN LED LE RIAD 8*4', 23, 23, 23, 12167, 2, 11, 94),
(19, 'Salle de Réunion  avec projection, pupitre, micros fixe, eau minérale, bloc note, crayons et décoration florale.<br/> Ftour en Buffet ou Servis à table.<br/> Animation musicale traditionnel.', 12, 12, 12, 1728, 1, 12, 82),
(20, 'ECRAN LED LE RIAD 8*4', 12, 12, 12, 1728, 2, 12, 94),
(21, 'Salle de Réunion  avec projection, pupitre, micros fixe, eau minérale, bloc note, crayons et décoration florale.<br/> Ftour en Buffet ou Servis à table.<br/> Animation musicale traditionnel.', 23, 23, 23, 12167, 1, 13, 82),
(22, 'ECRAN LED LE WALILI 5*3', 12, 12, 12, 1728, 2, 13, 95),
(23, 'Salle de Réunion  avec projection, pupitre, micros fixe, eau minérale, bloc note, crayons et décoration florale.<br/> Café d\'accueil composé de thé,café et eau minérale.<br/> Pause Café après midi améliorée :Thé, café, eau minérale, lait, jus d’orange, pâtisserie marocaine et française, variété de salé et canapés froid.', 12, 12, 12, 1728, 1, 14, 80),
(24, 'Salle de Réunion  avec projection, pupitre, micros fixe, eau minérale, bloc note, crayons et décoration florale.<br/> Café d\'accueil composé de thé,café et eau minérale.<br/> Pause Café après midi améliorée :Thé, café, eau minérale, lait, jus d’orange, pâtisserie marocaine et française, variété de salé et canapés froid.', 9, 9, 9, 729, 1, 14, 80),
(25, 'Salle de Réunion  avec projection, pupitre, micros fixe, eau minérale, bloc note, crayons et décoration florale.<br/> Café d\'accueil composé de thé,café et eau minérale.<br/> Pause Café après midi améliorée :Thé, café, eau minérale, lait, jus d’orange, pâtisserie marocaine et française, variété de salé et canapés froid.', 10, 10, 10, 1000, 1, 14, 80),
(26, 'Salle de restauration avec Diner gastronomique servi à table', 5, 5, 5, 125, 1, 14, 83),
(27, 'ECRAN LED LE WALILI 5*3', 23, 23, 23, 12167, 2, 14, 95),
(28, 'Salle de Réunion  avec projection, pupitre, micros fixe, eau minérale, bloc note, crayons et décoration florale.<br/> Café d\'accueil composé de thé,café et eau minérale.<br/> Pause Café après midi améliorée :Thé, café, eau minérale, lait, jus d’orange, pâtisserie marocaine et française, variété de salé et canapés froid.', 12, 12, 12, 1728, 1, 15, 80),
(29, 'Salle de Réunion  avec projection, pupitre, micros fixe, eau minérale, bloc note, crayons et décoration florale.<br/> Café d\'accueil composé de thé,café et eau minérale.<br/> Pause Café après midi améliorée :Thé, café, eau minérale, lait, jus d’orange, pâtisserie marocaine et française, variété de salé et canapés froid.', 9, 9, 9, 729, 1, 15, 80),
(30, 'Salle de Réunion  avec projection, pupitre, micros fixe, eau minérale, bloc note, crayons et décoration florale.<br/> Café d\'accueil composé de thé,café et eau minérale.<br/> Pause Café après midi améliorée :Thé, café, eau minérale, lait, jus d’orange, pâtisserie marocaine et française, variété de salé et canapés froid.', 10, 10, 10, 1000, 1, 15, 80),
(31, 'Salle de restauration avec Diner gastronomique servi à table', 5, 5, 5, 125, 1, 15, 83),
(32, 'ECRAN LED LE WALILI 5*3', 23, 23, 23, 12167, 2, 15, 95),
(33, 'Salle de Réunion  avec projection, pupitre, micros fixe, eau minérale, bloc note, crayons et décoration florale.<br/> Ftour en Buffet ou Servis à table.<br/> Animation musicale traditionnel.', 23, 23, 23, 12167, 1, 16, 82),
(34, 'ECRAN LED LE WALILI 5*3', 12, 12, 12, 1728, 2, 16, 95),
(35, 'Salle de Réunion  avec projection, pupitre, micros fixe, eau minérale, bloc note, crayons et décoration florale.<br/> Ftour en Buffet ou Servis à table.<br/> Animation musicale traditionnel.', 12, 12, 12, 1728, 1, 17, 82),
(36, 'Salle de Réunion  avec projection, pupitre, micros fixe, eau minérale, bloc note, crayons et décoration florale.<br/> Ftour en Buffet ou Servis à table.<br/> Animation musicale traditionnel.', 23, 23, 23, 12167, 1, 17, 82),
(37, 'ECRAN LED LE RIAD 8*4', 12, 12, 12, 1728, 2, 17, 94),
(38, 'ECRAN LED LE RIAD 8*4', 12, 12, 12, 1728, 2, 17, 94),
(39, 'Salle de Réunion  avec projection, pupitre, micros fixe, eau minérale, bloc note, crayons et décoration florale.<br/> Pause café Matin Améliorée : Thé, café, eau minérale, lait, jus d’orange, pâtisserie marocaine et française, variété de salé, viennoiserie.<br/> Déjeuner Servis à table ou Buffet  avec Boissons Soft Incluses.<br/> Pause Café après midi améliorée :Thé, café, eau minérale, lait, jus d’orange, pâtisserie marocaine et française, variété de salé et canapés froid.', 12, 12, 12, 1728, 1, 18, 81),
(40, 'Salle de Réunion  avec projection, pupitre, micros fixe, eau minérale, bloc note, crayons et décoration florale.<br/> Café d\'accueil composé de thé,café et eau minérale.<br/> Pause Café après midi améliorée :Thé, café, eau minérale, lait, jus d’orange, pâtisserie marocaine et française, variété de salé et canapés froid.', 1, 1, 12, 12, 1, 18, 80),
(41, 'jeux de lumière HALL / RIAD', 1, 1, 1, 1, 2, 18, 93),
(42, 'Salle de Réunion  avec projection, pupitre, micros fixe, eau minérale, bloc note, crayons et décoration florale.<br/> Pause café Matin Améliorée : Thé, café, eau minérale, lait, jus d’orange, pâtisserie marocaine et française, variété de salé, viennoiserie.<br/> Déjeuner Servis à table ou Buffet  avec Boissons Soft Incluses.<br/> Pause Café après midi améliorée :Thé, café, eau minérale, lait, jus d’orange, pâtisserie marocaine et française, variété de salé et canapés froid.', 12, 12, 12, 1728, 1, 19, 81),
(43, 'Salle de Réunion  avec projection, pupitre, micros fixe, eau minérale, bloc note, crayons et décoration florale.<br/> Café d\'accueil composé de thé,café et eau minérale.<br/> Pause Café après midi améliorée :Thé, café, eau minérale, lait, jus d’orange, pâtisserie marocaine et française, variété de salé et canapés froid.', 1, 1, 12, 12, 1, 19, 80),
(44, 'jeux de lumière HALL / RIAD', 1, 1, 1, 1, 2, 19, 93),
(47, 'Thé, café, eau minérale, lait, jus d’orange, pâtisserie marocaine et française, variété de salé soupe, œuf brouillé, œuf khlie, viennoiserie', 123, 73, 12, 107748, 1, 21, 60),
(48, 'Thé, café capsule, eau minérale, lait, jus d’orange, patisserie marocaine et française, variété de salé, datte Majhoule, acajou, amande griller', 12, 123, 50, 73800, 2, 21, 65),
(49, 'Thé, café, eau minérale, lait, jus d’orange, pâtisserie marocaine et française, variété de salé soupe, œuf brouillé, œuf khlie, viennoiserie', 1, 12, 10, 120, 1, 22, 60),
(50, 'Thé, café capsule, eau minérale, lait, jus d’orange, patisserie marocaine et française, variété de salé, datte Majhoule, acajou, amande griller', 1, 1, 70, 70, 2, 22, 65),
(51, 'Thé, café, eau minérale, lait, jus d’orange, patisserie marocaine et française, variété de salé et canapés froid', 123, 73, 12, 107748, 1, 23, 63),
(52, 'Thé, café, eau minérale, lait, jus d’orange, pâtisserie marocaine et française, variété de salé, viennoiserie', 31, 73, 12, 27156, 1, 23, 61),
(53, 'Thé, café capsule, eau minérale, lait, jus d’orange, patisserie marocaine et française, variété de salé, datte Majhoule, acajou, amande griller', 12, 123, 50, 73800, 2, 23, 65),
(54, 'Thé, café, eau minérale, lait, jus d’orange, pâtisserie marocaine et française, variété de salé soupe, œuf brouillé, œuf khlie, viennoiserie', 123, 73, 12, 107748, 1, 24, 60),
(55, 'Thé, café capsule, eau minérale, lait, jus d’orange, patisserie marocaine et française, variété de salé, datte Majhoule, acajou, amande griller', 12, 123, 50, 73800, 2, 24, 65),
(56, 'Thé, café, eau minérale, lait, jus d’orange, pâtisserie marocaine et française, variété de salé soupe, œuf brouillé, œuf khlie, viennoiserie', 123, 73, 12, 107748, 1, 25, 60),
(57, 'Thé, café, eau minérale', 1, 2, 50, 100, 1, 25, 59),
(58, 'Thé, café capsule, eau minérale, lait, jus d’orange, patisserie marocaine et française, variété de salé, datte Majhoule, acajou, amande griller', 12, 123, 50, 73800, 2, 25, 65),
(59, 'Thé, café, eau minérale, lait, jus d’orange, pâtisserie marocaine et française, variété de salé soupe, œuf brouillé, œuf khlie, viennoiserie', 123, 73, 12, 107748, 1, 26, 60),
(60, 'Thé, café, eau minérale', 1, 2, 50, 100, 1, 26, 59),
(61, 'Thé, café capsule, eau minérale, lait, jus d’orange, patisserie marocaine et française, variété de salé, datte Majhoule, acajou, amande griller', 12, 123, 50, 73800, 2, 26, 65),
(62, 'Thé, café, eau minérale, lait, jus d’orange, pâtisserie marocaine et française, variété de salé soupe, œuf brouillé, œuf khlie, viennoiserie', 123, 73, 12, 107748, 1, 27, 60),
(63, 'Cocktail déjeunatoire avec Boissons Soft', 1, 2, 3, 6, 1, 27, 67),
(64, 'Thé, café capsule, eau minérale, lait, jus d’orange, patisserie marocaine et française, variété de salé, datte Majhoule, acajou, amande griller', 12, 123, 50, 73800, 2, 27, 65),
(65, 'Thé, café, eau minérale, lait, jus d’orange, pâtisserie marocaine et française, variété de salé soupe, œuf brouillé, œuf khlie, viennoiserie', 123, 73, 12, 107748, 1, 28, 60),
(66, 'Cocktail déjeunatoire avec Boissons Soft', 1, 2, 3, 6, 1, 28, 67),
(67, 'Thé, café capsule, eau minérale, lait, jus d’orange, patisserie marocaine et française, variété de salé, datte Majhoule, acajou, amande griller', 12, 123, 50, 73800, 2, 28, 65),
(68, 'Thé, café, eau minérale, lait, jus d’orange, pâtisserie marocaine et française, variété de salé soupe, œuf brouillé, œuf khlie, viennoiserie', 123, 73, 12, 107748, 1, 29, 60),
(69, 'Thé, café capsule, eau minérale, lait, jus d’orange, patisserie marocaine et française, variété de salé, datte Majhoule, acajou, amande griller', 12, 123, 50, 73800, 2, 29, 65),
(70, 'Thé, café, eau minérale, lait, jus d’orange, pâtisserie marocaine et française, variété de salé soupe, œuf brouillé, œuf khlie, viennoiserie', 123, 73, 12, 107748, 1, 30, 60),
(71, 'Thé, café capsule, eau minérale, lait, jus d’orange, patisserie marocaine et française, variété de salé, datte Majhoule, acajou, amande griller', 12, 123, 50, 73800, 2, 30, 65),
(72, 'Thé, café, eau minérale, lait, jus d’orange, pâtisserie marocaine et française, variété de salé soupe, œuf brouillé, œuf khlie, viennoiserie', 123, 73, 12, 107748, 1, 31, 60),
(73, 'Thé, café capsule, eau minérale, lait, jus d’orange, patisserie marocaine et française, variété de salé, datte Majhoule, acajou, amande griller', 12, 123, 50, 73800, 2, 31, 65),
(74, 'Thé, café, eau minérale, lait, jus d’orange, pâtisserie marocaine et française, variété de salé soupe, œuf brouillé, œuf khlie, viennoiserie', 123, 73, 12, 107748, 1, 32, 60),
(75, 'Thé, café capsule, eau minérale, lait, jus d’orange, patisserie marocaine et française, variété de salé, datte Majhoule, acajou, amande griller', 12, 123, 50, 73800, 2, 32, 65),
(76, 'Thé, café, eau minérale, lait, jus d’orange, pâtisserie marocaine et française, variété de salé soupe, œuf brouillé, œuf khlie, viennoiserie', 123, 73, 12, 107748, 1, 33, 60),
(77, 'Thé, café capsule, eau minérale, lait, jus d’orange, patisserie marocaine et française, variété de salé, datte Majhoule, acajou, amande griller', 12, 123, 50, 73800, 2, 33, 65),
(78, 'Thé, café, eau minérale, lait, jus d’orange, pâtisserie marocaine et française, variété de salé soupe, œuf brouillé, œuf khlie, viennoiserie', 123, 73, 12, 107748, 1, 34, 60),
(79, 'Thé, café capsule, eau minérale, lait, jus d’orange, patisserie marocaine et française, variété de salé, datte Majhoule, acajou, amande griller', 12, 123, 50, 73800, 2, 34, 65),
(83, 'Thé, café, eau minérale', 1, 2, 20, 40, 1, 36, 59),
(84, 'Thé, café capsule, eau minérale, lait, jus d’orange, patisserie marocaine et française, variété de salé, datte Majhoule, acajou, amande griller', 1, 1, 50, 50, 2, 36, 65),
(85, 'Thé, café, eau minérale, lait, jus d’orange, pâtisserie marocaine et française, variété de salé, viennoiserie', 1, 1, 19, 19, 3, 36, 61),
(86, 'Thé, café, eau minérale, lait, jus d’orange, pâtisserie marocaine et française, variété de salé soupe, œuf brouillé, œuf khlie, viennoiserie', 123, 73, 12, 107748, 1, 37, 60),
(87, 'Thé, café capsule, eau minérale, lait, jus d’orange, patisserie marocaine et française, variété de salé, datte Majhoule, acajou, amande griller', 12, 123, 50, 73800, 2, 37, 65),
(88, 'Thé, café, eau minérale, lait, jus d’orange, pâtisserie marocaine et française, variété de salé, viennoiserie', 1, 2, 13, 26, 3, 37, 61),
(89, 'Thé, café, eau minérale, lait, jus d’orange, pâtisserie marocaine et française, variété de salé soupe, œuf brouillé, œuf khlie, viennoiserie', 123, 73, 12, 107748, 1, 38, 60),
(90, 'Thé, café capsule, eau minérale, lait, jus d’orange, patisserie marocaine et française, variété de salé, datte Majhoule, acajou, amande griller', 12, 123, 50, 73800, 2, 38, 65),
(91, 'Thé, café, eau minérale, lait, jus d’orange, pâtisserie marocaine et française, variété de salé soupe, œuf brouillé, œuf khlie, viennoiserie', 123, 73, 12, 107748, 1, 39, 60),
(92, 'Thé, café capsule, eau minérale, lait, jus d’orange, patisserie marocaine et française, variété de salé, datte Majhoule, acajou, amande griller', 12, 123, 50, 73800, 2, 39, 65),
(93, 'Thé, café, eau minérale, lait, jus d’orange, pâtisserie marocaine et française, variété de salé, viennoiserie', 0, 0, 0, 0, 3, 39, 61),
(99, 'Salle de Réunion  avec projection, pupitre, micros fixe, eau minérale, bloc note, crayons et décoration florale.<br/> Café d\'accueil composé de thé,café et eau minérale.<br/> Pause Café après midi améliorée :Thé, café, eau minérale, lait, jus d’orange, pâtisserie marocaine et française, variété de salé et canapés froid.', 1, 1, 11, 11, 1, 41, 80),
(100, 'Salle de Réunion  avec projection, pupitre, micros fixe, eau minérale, bloc note, crayons et décoration florale.<br/> Café d\'accueil composé de thé,café et eau minérale.<br/> Pause Café après midi améliorée :Thé, café, eau minérale, lait, jus d’orange, pâtisserie marocaine et française, variété de salé et canapés froid.', 11, 11, 12, 1452, 1, 44, 80),
(107, 'Thé, café, eau minérale, lait, jus d’orange, pâtisserie marocaine et française, variété de salé soupe, œuf brouillé, œuf khlie, viennoiserie', 123, 73, 12, 107748, 1, 20, 60),
(108, 'Thé, café capsule, eau minérale, lait, jus d’orange, patisserie marocaine et française, variété de salé, datte Majhoule, acajou, amande griller', 12, 123, 50, 73800, 2, 20, 65),
(109, 'Thé, café, eau minérale, lait, jus d’orange, pâtisserie marocaine et française, variété de salé, viennoiserie', 12, 12, 12, 1728, 3, 20, 61),
(110, 'Thé, café, eau minérale, lait, jus d’orange, pâtisserie marocaine et française, variété de salé soupe, œuf brouillé, œuf khlie, viennoiserie', 123, 73, 12, 107748, 1, 40, 60),
(111, 'Thé, café capsule, eau minérale, lait, jus d’orange, patisserie marocaine et française, variété de salé, datte Majhoule, acajou, amande griller', 12, 123, 50, 73800, 2, 40, 65),
(112, 'Thé, café, eau minérale, lait, jus d’orange, pâtisserie marocaine et française, variété de salé, viennoiserie', 11, 11, 11, 1331, 3, 40, 61),
(113, 'Thé, café, eau minérale', 11, 11, 11, 1331, 1, 45, 59),
(145, 'Thé, café, eau minérale', 11, 11, 11, 1331, 1, 46, 59),
(146, 'Thé, café, eau minérale, lait, jus d’orange, pâtisserie marocaine et française, variété de salé soupe, œuf brouillé, œuf khlie, viennoiserie', 11, 11, 23, 2783, 1, 46, 60),
(147, 'Déjeuner servis à table avec Boissons Soft', 122, 11, 11, 14762, 1, 46, 66),
(148, 'Thé, café capsule, eau minérale, lait, jus d’orange, patisserie marocaine et française, variété de salé, datte Majhoule, acajou, amande griller', 11, 11, 11, 1331, 2, 46, 65),
(149, 'Cocktail dinatoire avec Boissons Soft', 11, 11, 1, 121, 2, 46, 70),
(150, 'Thé, café, eau minérale, lait, jus d’orange, pâtisserie marocaine et française, variété de salé, viennoiserie', 22, 22, 22, 10648, 3, 46, 61),
(151, 'Thé, café, eau minérale, lait, jus d’orange, pâtisserie marocaine et française, variété de salé, viennoiserie', 1, 1, 22, 22, 3, 46, 61),
(152, 'Salle de Réunion  avec projection, pupitre, micros fixe, eau minérale, bloc note, crayons et décoration florale.<br/> Café d\'accueil composé de thé,café et eau minérale.<br/> Pause Café après midi améliorée :Thé, café, eau minérale, lait, jus d’orange, pâtisserie marocaine et française, variété de salé et canapés froid.', 111, 12, 12, 15984, 1, 47, 80),
(153, 'ECRAN LED LE RIAD 8*4', 11, 123, 1, 1353, 2, 47, 94),
(154, 'Salle de Réunion  avec projection, pupitre, micros fixe, eau minérale, bloc note, crayons et décoration florale.<br/> Pause café Matin Améliorée : Thé, café, eau minérale, lait, jus d’orange, pâtisserie marocaine et française, variété de salé, viennoiserie.<br/> Déjeuner Servis à table ou Buffet  avec Boissons Soft Incluses.<br/> Pause Café après midi améliorée :Thé, café, eau minérale, lait, jus d’orange, pâtisserie marocaine et française, variété de salé et canapés froid.', 23, 12, 23, 6348, 1, 8, 81),
(155, 'ECRAN LED LE RIAD 8*4', 23, 12, 12, 3312, 2, 8, 94);

-- --------------------------------------------------------

--
-- Structure de la table `client_ligne_devis_type_prestation`
--

CREATE TABLE `client_ligne_devis_type_prestation` (
  `id_client_ligne_devis_type_prestation` int(11) NOT NULL,
  `ligne_devis_type_prestation` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `client_ligne_devis_type_prestation`
--

INSERT INTO `client_ligne_devis_type_prestation` (`id_client_ligne_devis_type_prestation`, `ligne_devis_type_prestation`) VALUES
(1, 'SALLES & ESPACES'),
(2, 'TECHNICIENS & RÉGISSEURS'),
(3, 'Prestations Supplémentaires'),
(4, 'Produit');

-- --------------------------------------------------------

--
-- Structure de la table `client_modalite_payement_avance`
--

CREATE TABLE `client_modalite_payement_avance` (
  `id_client_modalite_payement_avance` int(11) NOT NULL,
  `pourcentage` int(11) DEFAULT NULL,
  `etalonage` int(11) DEFAULT NULL,
  `semaine` tinyint(1) DEFAULT NULL,
  `mois` tinyint(1) DEFAULT NULL,
  `clients` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `client_modalite_payement_sans_avance`
--

CREATE TABLE `client_modalite_payement_sans_avance` (
  `id_client_modalite_payement_sans_avance` int(11) NOT NULL,
  `Totalite` tinyint(1) DEFAULT NULL,
  `etalonage` int(11) DEFAULT NULL,
  `semaine` tinyint(1) DEFAULT NULL,
  `mois` tinyint(1) DEFAULT NULL,
  `clients` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `client_modalite_payement_sans_avance`
--

INSERT INTO `client_modalite_payement_sans_avance` (`id_client_modalite_payement_sans_avance`, `Totalite`, `etalonage`, `semaine`, `mois`, `clients`) VALUES
(1, 1, 0, 0, 1, 1),
(2, 0, 2, 0, 1, 2),
(3, 1, 0, 0, 1, 3),
(4, 1, 0, 0, 1, 4),
(5, 1, 0, 0, 1, 15),
(6, 1, 0, 0, 1, 16),
(7, 1, 0, 0, 1, 17),
(8, 1, 0, 0, 1, 18),
(9, 1, 0, 0, 1, 19);

-- --------------------------------------------------------

--
-- Structure de la table `client_responsable_interlocuteur`
--

CREATE TABLE `client_responsable_interlocuteur` (
  `id_client_responsable_interlocuteur` int(11) NOT NULL,
  `nom_complet` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `numero_telephone` varchar(255) DEFAULT NULL,
  `c_responsable_interlocuteur` int(11) DEFAULT NULL,
  `clients` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `client_responsable_interlocuteur`
--

INSERT INTO `client_responsable_interlocuteur` (`id_client_responsable_interlocuteur`, `nom_complet`, `email`, `numero_telephone`, `c_responsable_interlocuteur`, `clients`) VALUES
(1, 'Yassine CHALH', 'yassinechalh9@gmail.com', '+212675858659', 2, 1),
(2, 'Rachid Taha', 'rachid.taha@gmail.com', '+212674151392', 4, 2),
(3, 'Samir Labas', 'samir.test@yahoo.fr', '+212684523392', 3, 3),
(4, 'Mouad Mouasseif', 'mouadmouassief@gmail.com', '+212664860246', 2, 4),
(5, 'mouad salka', 'otoutain@yahoo.fr', '+212678765467', 1, 15),
(6, 'mouad mouasseif', 'otoutain@yahoo.fr', '+212689642894', 2, 16),
(7, 'mouad der', 'otoutain@yahoo.fr', '+212689642894', 2, 17),
(8, 'karima karim', 'otoutain@yahoo.fr', '+212689754323', 8, 18),
(9, 'karim karimi', 'mouadmouassief@gmail.com', '+212601000456', 7, 19);

-- --------------------------------------------------------

--
-- Structure de la table `client_secteur`
--

CREATE TABLE `client_secteur` (
  `id_secteur` int(11) NOT NULL,
  `Secteur` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `client_secteur`
--

INSERT INTO `client_secteur` (`id_secteur`, `Secteur`) VALUES
(1, 'Privée'),
(2, 'Semi-Public'),
(3, 'Public');

-- --------------------------------------------------------

--
-- Structure de la table `client_type`
--

CREATE TABLE `client_type` (
  `id_client_type` int(11) NOT NULL,
  `client_type` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `client_type`
--

INSERT INTO `client_type` (`id_client_type`, `client_type`) VALUES
(1, 'Personne Morale'),
(2, 'Personne Physique');

-- --------------------------------------------------------

--
-- Structure de la table `c_responsable_interlocuteur`
--

CREATE TABLE `c_responsable_interlocuteur` (
  `id_c_responsable_interlocuteur` int(11) NOT NULL,
  `type_responsable_interlocuteur` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `c_responsable_interlocuteur`
--

INSERT INTO `c_responsable_interlocuteur` (`id_c_responsable_interlocuteur`, `type_responsable_interlocuteur`) VALUES
(1, 'Manager'),
(2, 'Président'),
(3, 'Vice président'),
(4, 'Directeur'),
(5, 'Directeur adjoint'),
(6, 'Chargé de communication'),
(7, 'Infographiste'),
(8, 'Financier'),
(9, 'Interlocuteur'),
(10, 'Service achats');

-- --------------------------------------------------------

--
-- Structure de la table `dernier_numero_devis_facture`
--

CREATE TABLE `dernier_numero_devis_facture` (
  `numero_devis_facture` int(11) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `annee` int(11) NOT NULL,
  `id_societe` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `dernier_numero_devis_facture`
--

INSERT INTO `dernier_numero_devis_facture` (`numero_devis_facture`, `type`, `annee`, `id_societe`) VALUES
(159, 'Facture', 2024, NULL),
(335, 'Devis', 2024, NULL),
(159, 'Facture', 2024, NULL),
(335, 'Devis', 2024, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `devis_mode_paiements`
--

CREATE TABLE `devis_mode_paiements` (
  `id_devis_mode_paiements` int(11) NOT NULL,
  `libeller` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `devis_mode_paiements`
--

INSERT INTO `devis_mode_paiements` (`id_devis_mode_paiements`, `libeller`) VALUES
(1, 'Espèces'),
(2, 'Chèque'),
(3, 'Virement'),
(4, 'Prise en charge');

-- --------------------------------------------------------

--
-- Structure de la table `devis_objet`
--

CREATE TABLE `devis_objet` (
  `id_devis_objet` int(11) NOT NULL,
  `nom_objet` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `devis_objet`
--

INSERT INTO `devis_objet` (`id_devis_objet`, `nom_objet`) VALUES
(1, 'Journée séminaire'),
(2, 'Demi-journée séminaire'),
(3, 'Location d\'espace'),
(4, 'Prestation technique'),
(5, 'Location d\'espace avec cocktail'),
(6, 'Location d\'espace avec pause café'),
(7, 'Location d\'espace avec déjeuner'),
(8, 'Location d\'espace avec diner'),
(9, 'Soirée Mariage'),
(10, 'Diner de Gala'),
(11, 'Traiteur Externe'),
(12, 'Soirée');

-- --------------------------------------------------------

--
-- Structure de la table `devis_paiements`
--

CREATE TABLE `devis_paiements` (
  `id_devis_paiements` int(11) NOT NULL,
  `statut` varchar(255) NOT NULL,
  `client_devis_client` int(11) DEFAULT NULL,
  `document` int(11) NOT NULL,
  `devis_mode_paiements` int(11) DEFAULT NULL,
  `Montant` double DEFAULT NULL,
  `avec_exoneration` tinyint(1) NOT NULL,
  `created` datetime NOT NULL,
  `commentaire` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `devis_paiements`
--

INSERT INTO `devis_paiements` (`id_devis_paiements`, `statut`, `client_devis_client`, `document`, `devis_mode_paiements`, `Montant`, `avec_exoneration`, `created`, `commentaire`) VALUES
(1, 'Payé', 6, 1, 3, 2000, 0, '2024-12-02 14:14:37', 'c validey');

-- --------------------------------------------------------

--
-- Structure de la table `document`
--

CREATE TABLE `document` (
  `document_id` int(11) NOT NULL,
  `file_name` varchar(255) DEFAULT NULL,
  `file_path` varchar(255) DEFAULT NULL,
  `file_type` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `document`
--

INSERT INTO `document` (`document_id`, `file_name`, `file_path`, `file_type`) VALUES
(1, 'CV_Yassine_CHALH_dev_backend.pdf', '../uploads/4f5e7cb1d3b3837f95313317182211d9.pdf', 'application/pdf');

-- --------------------------------------------------------

--
-- Structure de la table `ligne_devis_prestation`
--

CREATE TABLE `ligne_devis_prestation` (
  `id_ligne_devis_prestation` int(11) NOT NULL,
  `designation` text DEFAULT NULL,
  `prestation` text DEFAULT NULL,
  `client_ligne_devis_type_prestation` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `ligne_devis_prestation`
--

INSERT INTO `ligne_devis_prestation` (`id_ligne_devis_prestation`, `designation`, `prestation`, `client_ligne_devis_type_prestation`) VALUES
(59, 'Café D\'Accueil', 'Thé, café, eau minérale', 1),
(60, 'Petit Déjeuner', 'Thé, café, eau minérale, lait, jus d’orange, pâtisserie marocaine et française, variété de salé soupe, œuf brouillé, œuf khlie, viennoiserie', 1),
(61, 'Pause Café Matin', 'Thé, café, eau minérale, lait, jus d’orange, pâtisserie marocaine et française, variété de salé, viennoiserie', 3),
(62, 'REGIE DE CAPTATION (3 CAMERAS)', 'REGIE DE CAPTATION AVEC 3 CAMERAS ROBOTISEES', 2),
(63, 'Pause Café Après Midi', 'Thé, café, eau minérale, lait, jus d’orange, patisserie marocaine et française, variété de salé et canapés froid', 1),
(64, 'Pause Café Après Midi Améliorée', 'Thé, café, eau minérale, lait, jus d’orange, pâtisserie marocaine et française, variété de salé et canapés froid', 1),
(65, 'Pause Café V.I.P', 'Thé, café capsule, eau minérale, lait, jus d’orange, patisserie marocaine et française, variété de salé, datte Majhoule, acajou, amande griller', 2),
(66, 'Déjeuner servie à Table', 'Déjeuner servis à table avec Boissons Soft', 1),
(67, 'Cocktail Déjeunatoire', 'Cocktail déjeunatoire avec Boissons Soft', 1),
(68, 'Déjeuner Buffet', 'Déjeuner en Buffet international et Marocain avec Boisson soft', 1),
(69, 'Diner servie à Table', 'Diner servis à table avec Boissons Soft', 1),
(70, 'Cocktail Dinatoire', 'Cocktail dinatoire avec Boissons Soft', 2),
(71, 'Diner Buffet', 'Diner en Buffet international et Marocain avec Boisson soft', 1),
(72, 'Ftour Ramadan servis a table', 'Ftour Ramadan servis à table avec boissons soft', 1),
(73, 'Ftour Ramadan buffet', 'Ftour Ramadan en buffet avec boissons soft', 1),
(74, 'Location d\'espace', 'Salle de Réunion avec projection, pupitre, micros fixe, eau minérale, bloc note, crayons et décoration florale', 1),
(75, 'Location d\'espace avec cocktail', 'Espace de restauration avec Cocktail', 1),
(76, 'Location d\'espace avec pause café', 'Espace de restauration avec Pause Café', 1),
(77, 'Location d\'espace avec déjeuner', 'Espace de restauration avec Déjeuner', 1),
(78, 'Location d\'espace avec diner', 'Espace de restauration avec Diner', 1),
(79, 'Demi-journée séminaire 1', 'Salle de Réunion  avec projection, pupitre, micros fixe, eau minérale, bloc note, crayons et décoration florale.<br/> Café d\'accueil composé de thé,café et eau minérale.<br/> Pause café Matin Améliorée : Thé, café, eau minérale, lait, jus d’orange, pâtisserie marocaine et française, variété de salé, viennoiserie.<br/> Déjeuner Servis à table ou Buffet  avec Boissons Soft Incluses', 1),
(80, 'Demi-journée séminaire 2', 'Salle de Réunion  avec projection, pupitre, micros fixe, eau minérale, bloc note, crayons et décoration florale.<br/> Café d\'accueil composé de thé,café et eau minérale.<br/> Pause Café après midi améliorée :Thé, café, eau minérale, lait, jus d’orange, pâtisserie marocaine et française, variété de salé et canapés froid.', 1),
(81, 'Journée séminaire', 'Salle de Réunion  avec projection, pupitre, micros fixe, eau minérale, bloc note, crayons et décoration florale.<br/> Pause café Matin Améliorée : Thé, café, eau minérale, lait, jus d’orange, pâtisserie marocaine et française, variété de salé, viennoiserie.<br/> Déjeuner Servis à table ou Buffet  avec Boissons Soft Incluses.<br/> Pause Café après midi améliorée :Thé, café, eau minérale, lait, jus d’orange, pâtisserie marocaine et française, variété de salé et canapés froid.', 1),
(82, 'Pack Ftour Ramadan', 'Salle de Réunion  avec projection, pupitre, micros fixe, eau minérale, bloc note, crayons et décoration florale.<br/> Ftour en Buffet ou Servis à table.<br/> Animation musicale traditionnel.', 1),
(83, 'Diner de Gala', 'Salle de restauration avec Diner gastronomique servi à table', 1),
(84, 'Soirée Mariage', 'Salle de fête avec Diner gastronomique servi à table', 1),
(85, 'Soirée', 'Salle équipée pour soirée festive', 1),
(86, 'Traiteur Externe', '', 1),
(87, 'Gâteau personnaliser', 'Gâteau personnaliser', 1),
(88, 'Agent de securité', 'Agent de securité', 1),
(89, 'Hôtesse d\'accueil', 'Hôtesse d\'accueil', 1),
(90, 'Espace vip', 'Espace salon vip', 1),
(91, 'Espace Stands', 'Espace Stands', 1),
(92, 'Instalation des stands ', 'Instalation des stands ', 1),
(93, 'ECLAIRAGE D\'ANIMATION', 'jeux de lumière HALL / RIAD', 2),
(94, 'AFFICHAGE SALLE RIAD', 'ECRAN LED LE RIAD 8*4', 2),
(95, 'AFFICHAGE SALLE WALILI', 'ECRAN LED LE WALILI 5*3', 2),
(96, 'AFFICHAGE SALLE LIXUS', 'ECRAN LED LE LIXUS 5*2,5', 2),
(97, 'AFFICHAGE SALLE RABAT', 'ECRAN LED PAVILLON DE RABAT 6*3', 2),
(98, 'AFFICHAGE EXTERNE', 'ECRANS EXTERNES 8m2', 2),
(99, 'PROJECTION', 'PROJECTION EN DATA SHOW', 2),
(100, 'ZOOM', 'SYSTÈME DE VISEOCONFERENCE VIA ZOOM', 2),
(101, 'REGIE DE CAPTATION (2 CAMERAS)', 'REGIE DE CAPTATION AVEC 2 CAMERAS ROBOTISEES', 2),
(102, 'REGIE DE CAPTATION (3 CAMERAS)', 'REGIE DE CAPTATION AVEC 3 CAMERAS ROBOTISEES', 2),
(103, 'REGIE DE TRADUCTION', 'REGIE DE TRADUCTION', 2),
(104, 'CANAL D\'INTERPRETARIAT', 'CANAL D\'INTERPRETARIAT', 2),
(105, 'CASQUES DE TRADUCTION', 'CASQUE DE TRADUCTION', 2),
(106, 'PHOTOGRAPHE', 'PHOTOGRAPHE AVEC BEST OFF', 2),
(107, 'MICROS FIXE', 'MICROS FIXE', 2),
(108, 'MICROS BALADEUR', 'MICROS BALADEUR', 2),
(109, 'MICROS CRAVATE', 'MICROS CRAVATTE', 2),
(110, 'Lunch Box', 'Déjeuner Lunch Box', 1),
(111, 'ANIMATION MUSICAL', 'Animation Musical', 2),
(112, 'ANIMATION PORTABLE', 'Animation Portable', 2),
(113, 'Location Dalot', '', 1),
(114, 'Stand Press', '', 1),
(115, 'Hébergement Dalots', '', 1),
(116, 'Assistance technique', '', 2),
(117, 'test', 'test', 1),
(118, 'test1', 'test2', 1),
(123, 'SALAM', 'SALAM', 2),
(124, 'ajouter', 'une', 1),
(126, 'test uno', 'test uno', 1),
(129, 'REGIE DE TRADUCTION', 'REGIE DE TRADUCTION', 2),
(130, 'REGIE DE CAPTATION (3 CAMERAS)', 'REGIE DE CAPTATION AVEC 3 CAMERAS ROBOTISEES', 2),
(131, 'REGIE DE TRADUCTION', 'REGIE DE TRADUCTION', 2),
(132, 'REGIE DE TRADUCTION', 'REGIE DE TRADUCTION', 2),
(133, 'REGIE DE CAPTATION (3 CAMERAS)', 'REGIE DE CAPTATION AVEC 3 CAMERAS ROBOTISEES', 2),
(134, 'bureau test ', 'bureau tets pc hp gamer calavier sourie ecren i7 7eme generaion cart graphique gt3060', 4);

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2024_12_24_105702_create_annulation_cause_table', 0),
(2, '2024_12_24_105702_create_c_responsable_interlocuteur_table', 0),
(3, '2024_12_24_105702_create_categories_table', 0),
(4, '2024_12_24_105702_create_client_devis_table', 0),
(5, '2024_12_24_105702_create_client_devis_client_table', 0),
(6, '2024_12_24_105702_create_client_facture_client_table', 0),
(7, '2024_12_24_105702_create_client_ligne_devis_table', 0),
(8, '2024_12_24_105702_create_client_ligne_devis_type_prestation_table', 0),
(9, '2024_12_24_105702_create_client_modalite_payement_avance_table', 0),
(10, '2024_12_24_105702_create_client_modalite_payement_sans_avance_table', 0),
(11, '2024_12_24_105702_create_client_responsable_interlocuteur_table', 0),
(12, '2024_12_24_105702_create_client_secteur_table', 0),
(13, '2024_12_24_105702_create_client_type_table', 0),
(14, '2024_12_24_105702_create_clients_table', 0),
(15, '2024_12_24_105702_create_dernier_numero_devis_facture_table', 0),
(16, '2024_12_24_105702_create_devis_mode_paiements_table', 0),
(17, '2024_12_24_105702_create_devis_objet_table', 0),
(18, '2024_12_24_105702_create_devis_paiements_table', 0),
(19, '2024_12_24_105702_create_document_table', 0),
(20, '2024_12_24_105702_create_ligne_devis_prestation_table', 0),
(21, '2024_12_24_105702_create_product_table', 0),
(22, '2024_12_24_105702_create_profils_table', 0),
(23, '2024_12_24_105702_create_societe_prestations_table', 0),
(24, '2024_12_24_105702_create_societes_table', 0),
(25, '2024_12_24_105702_create_utilisateur_societes_table', 0),
(26, '2024_12_24_105702_create_utilisateurs_table', 0),
(27, '2024_12_24_105705_add_foreign_keys_to_client_devis_table', 0),
(28, '2024_12_24_105705_add_foreign_keys_to_client_devis_client_table', 0),
(29, '2024_12_24_105705_add_foreign_keys_to_client_facture_client_table', 0),
(30, '2024_12_24_105705_add_foreign_keys_to_client_ligne_devis_table', 0),
(31, '2024_12_24_105705_add_foreign_keys_to_client_modalite_payement_avance_table', 0),
(32, '2024_12_24_105705_add_foreign_keys_to_client_modalite_payement_sans_avance_table', 0),
(33, '2024_12_24_105705_add_foreign_keys_to_client_responsable_interlocuteur_table', 0),
(34, '2024_12_24_105705_add_foreign_keys_to_clients_table', 0),
(35, '2024_12_24_105705_add_foreign_keys_to_devis_paiements_table', 0),
(36, '2024_12_24_105705_add_foreign_keys_to_ligne_devis_prestation_table', 0),
(37, '2024_12_24_105705_add_foreign_keys_to_product_table', 0),
(38, '2024_12_24_105705_add_foreign_keys_to_societe_prestations_table', 0),
(39, '2024_12_24_105705_add_foreign_keys_to_utilisateur_societes_table', 0),
(40, '2024_12_24_105705_add_foreign_keys_to_utilisateurs_table', 0);

-- --------------------------------------------------------

--
-- Structure de la table `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `product_image` text NOT NULL,
  `categories_id` int(11) NOT NULL,
  `quantity_initiale` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `rate` varchar(255) NOT NULL,
  `active` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 0,
  `id_societe` int(11) DEFAULT NULL,
  `client_fournisseur_id` int(11) NOT NULL,
  `client_ligne_devis_type_prestation` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `product`
--

INSERT INTO `product` (`product_id`, `product_name`, `description`, `product_image`, `categories_id`, `quantity_initiale`, `quantity`, `rate`, `active`, `status`, `id_societe`, `client_fournisseur_id`, `client_ligne_devis_type_prestation`) VALUES
(1, 'Produit Test', '', '14711893086748578da9984.jpg', 9, '10', 23, '134.0', 1, 1, 2, 0, 4),
(2, 'Test 2', '', '54604360967485d60ed252.jpg', 9, '12', 12, '89', 2, 2, 1, 0, 4),
(3, 'test', '', '168298283067487f393f0d3.png', 9, '13', 25, '90', 1, 1, 2, 0, 4),
(4, 'bureau test', '', '122001923567729fe1a4392.png', 9, '111', 12, '133', 1, 1, 7, 0, 4),
(5, 'pc gamer ', '', '6360364336777c2f8670bc.png', 9, '11', 11, '5000', 1, 1, 7, 0, 4);

-- --------------------------------------------------------

--
-- Structure de la table `profils`
--

CREATE TABLE `profils` (
  `id_profil` int(11) NOT NULL,
  `nom_profil` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `profils`
--

INSERT INTO `profils` (`id_profil`, `nom_profil`) VALUES
(1, 'Administrateur system'),
(2, 'Gestionnaire client'),
(3, 'Responsable'),
(4, 'Responsable  Caisse'),
(5, 'Responsable stock');

-- --------------------------------------------------------

--
-- Structure de la table `societes`
--

CREATE TABLE `societes` (
  `id_societe` int(11) NOT NULL,
  `societe_name` varchar(255) DEFAULT NULL,
  `path_image` varchar(700) DEFAULT NULL,
  `all_name` varchar(700) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `societes`
--

INSERT INTO `societes` (`id_societe`, `societe_name`, `path_image`, `all_name`) VALUES
(1, 'Dar n’zaha', 'entreprise_logo/dar_nzaha.png', 'Dar n’zaha'),
(2, 'Palais des congrès', 'entreprise_logo/palais_de_congres.png', 'Palais des Congres Rabat Bouregreg\n'),
(3, 'Dar lakbira', 'entreprise_logo/dar_lakbira.png', 'Dar lakbira'),
(7, 'Burosys', 'entreprise_logo/Burosys.png', 'Burosys'),
(8, 'PAMAB', 'entreprise_logo/pamaba.png', 'PAMABA import-export');

-- --------------------------------------------------------

--
-- Structure de la table `societe_prestations`
--

CREATE TABLE `societe_prestations` (
  `id_societe` int(11) NOT NULL,
  `id_prestation` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `societe_prestations`
--

INSERT INTO `societe_prestations` (`id_societe`, `id_prestation`) VALUES
(1, 80),
(1, 81),
(1, 82),
(1, 83),
(1, 87),
(1, 93),
(1, 94),
(1, 95),
(1, 118),
(1, 126),
(2, 59),
(2, 60),
(2, 61),
(2, 63),
(2, 64),
(2, 65),
(2, 66),
(2, 67),
(2, 68),
(2, 69),
(2, 70),
(2, 71),
(2, 72),
(2, 73),
(2, 74),
(2, 75),
(2, 76),
(2, 77),
(2, 78),
(2, 79),
(2, 84),
(2, 85),
(2, 86),
(2, 88),
(2, 89),
(2, 90),
(2, 91),
(2, 92),
(2, 117),
(2, 124),
(3, 62),
(7, 123);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `id_user` int(11) NOT NULL,
  `nom_utilisateur` varchar(255) DEFAULT NULL,
  `mot_de_passe` varchar(255) DEFAULT NULL,
  `nom` varchar(255) DEFAULT NULL,
  `prenom` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `telephone` varchar(50) NOT NULL,
  `profils` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id_user`, `nom_utilisateur`, `mot_de_passe`, `nom`, `prenom`, `email`, `telephone`, `profils`) VALUES
(1, 'mouad@', 'mouad123', 'mousseif', 'mouad', 'mouadmouassief@gmail.com', '0689642894', 1),
(2, 'nanafigo@', 'nanafigo', 'nana', 'figo', 'nanafigo@gmail.com', '0673151399', 3);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur_societes`
--

CREATE TABLE `utilisateur_societes` (
  `id_societe` int(11) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `utilisateur_societes`
--

INSERT INTO `utilisateur_societes` (`id_societe`, `id_user`) VALUES
(1, 2),
(2, 2);

-- --------------------------------------------------------

--
-- Structure de la table `year`
--

CREATE TABLE `year` (
  `id` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `year`
--

INSERT INTO `year` (`id`, `year`, `created_at`) VALUES
(1, 2023, '2025-01-02 11:08:31'),
(2, 2024, '2025-01-02 11:08:31'),
(3, 2025, '2025-01-02 11:08:31');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `annulation_cause`
--
ALTER TABLE `annulation_cause`
  ADD PRIMARY KEY (`id_annulation_cause`);

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`categories_id`);

--
-- Index pour la table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id_client`),
  ADD UNIQUE KEY `societe` (`societe`),
  ADD UNIQUE KEY `nom_complet` (`nom_complet`),
  ADD KEY `utilisateurs` (`utilisateurs`),
  ADD KEY `client_type` (`client_type`),
  ADD KEY `client_secteur` (`client_secteur`),
  ADD KEY `id_societe` (`id_societe`);

--
-- Index pour la table `client_devis`
--
ALTER TABLE `client_devis`
  ADD PRIMARY KEY (`id_client_devis`),
  ADD KEY `fk_devis_objet` (`devis_objet`);

--
-- Index pour la table `client_devis_client`
--
ALTER TABLE `client_devis_client`
  ADD PRIMARY KEY (`id_client_devis`,`id_client`),
  ADD KEY `id_client` (`id_client`),
  ADD KEY `utilisateurs` (`utilisateurs`),
  ADD KEY `id_annulation_cause` (`id_annulation_cause`);

--
-- Index pour la table `client_facture_client`
--
ALTER TABLE `client_facture_client`
  ADD PRIMARY KEY (`id_client_devis`,`id_client`,`id_client_Facture`),
  ADD KEY `id_client` (`id_client`),
  ADD KEY `utilisateurs` (`utilisateurs`),
  ADD KEY `id_client_Facture` (`id_client_Facture`);

--
-- Index pour la table `client_fournisseur`
--
ALTER TABLE `client_fournisseur`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `client_ligne_devis`
--
ALTER TABLE `client_ligne_devis`
  ADD PRIMARY KEY (`id_client_ligne_devis`),
  ADD KEY `client_ligne_devis_type_prestation` (`client_ligne_devis_type_prestation`),
  ADD KEY `client_devis` (`client_devis`),
  ADD KEY `fk_client_ligne_devis_type_prestation` (`ligne_devis_prestation`);

--
-- Index pour la table `client_ligne_devis_type_prestation`
--
ALTER TABLE `client_ligne_devis_type_prestation`
  ADD PRIMARY KEY (`id_client_ligne_devis_type_prestation`);

--
-- Index pour la table `client_modalite_payement_avance`
--
ALTER TABLE `client_modalite_payement_avance`
  ADD PRIMARY KEY (`id_client_modalite_payement_avance`),
  ADD KEY `clients` (`clients`);

--
-- Index pour la table `client_modalite_payement_sans_avance`
--
ALTER TABLE `client_modalite_payement_sans_avance`
  ADD PRIMARY KEY (`id_client_modalite_payement_sans_avance`),
  ADD KEY `clients` (`clients`);

--
-- Index pour la table `client_responsable_interlocuteur`
--
ALTER TABLE `client_responsable_interlocuteur`
  ADD PRIMARY KEY (`id_client_responsable_interlocuteur`),
  ADD KEY `clients` (`clients`),
  ADD KEY `c_responsable_interlocuteur` (`c_responsable_interlocuteur`);

--
-- Index pour la table `client_secteur`
--
ALTER TABLE `client_secteur`
  ADD PRIMARY KEY (`id_secteur`);

--
-- Index pour la table `client_type`
--
ALTER TABLE `client_type`
  ADD PRIMARY KEY (`id_client_type`);

--
-- Index pour la table `c_responsable_interlocuteur`
--
ALTER TABLE `c_responsable_interlocuteur`
  ADD PRIMARY KEY (`id_c_responsable_interlocuteur`);

--
-- Index pour la table `dernier_numero_devis_facture`
--
ALTER TABLE `dernier_numero_devis_facture`
  ADD KEY `fk_id_societe` (`id_societe`);

--
-- Index pour la table `devis_mode_paiements`
--
ALTER TABLE `devis_mode_paiements`
  ADD PRIMARY KEY (`id_devis_mode_paiements`);

--
-- Index pour la table `devis_objet`
--
ALTER TABLE `devis_objet`
  ADD PRIMARY KEY (`id_devis_objet`);

--
-- Index pour la table `devis_paiements`
--
ALTER TABLE `devis_paiements`
  ADD PRIMARY KEY (`id_devis_paiements`),
  ADD KEY `devis_mode_paiements` (`devis_mode_paiements`),
  ADD KEY `client_devis_client` (`client_devis_client`),
  ADD KEY `document` (`document`);

--
-- Index pour la table `document`
--
ALTER TABLE `document`
  ADD PRIMARY KEY (`document_id`);

--
-- Index pour la table `ligne_devis_prestation`
--
ALTER TABLE `ligne_devis_prestation`
  ADD PRIMARY KEY (`id_ligne_devis_prestation`),
  ADD KEY `ligne_devis_prestation_ibfk_1` (`client_ligne_devis_type_prestation`);

--
-- Index pour la table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `categories_id` (`categories_id`),
  ADD KEY `id_societe` (`id_societe`),
  ADD KEY `client_fournisseur_id` (`client_fournisseur_id`),
  ADD KEY `client_ligne_devis_type_prestation` (`client_ligne_devis_type_prestation`);

--
-- Index pour la table `profils`
--
ALTER TABLE `profils`
  ADD PRIMARY KEY (`id_profil`);

--
-- Index pour la table `societes`
--
ALTER TABLE `societes`
  ADD PRIMARY KEY (`id_societe`);

--
-- Index pour la table `societe_prestations`
--
ALTER TABLE `societe_prestations`
  ADD PRIMARY KEY (`id_societe`,`id_prestation`),
  ADD KEY `id_prestation` (`id_prestation`);

--
-- Index pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `profils` (`profils`);

--
-- Index pour la table `utilisateur_societes`
--
ALTER TABLE `utilisateur_societes`
  ADD PRIMARY KEY (`id_societe`,`id_user`),
  ADD KEY `id_user` (`id_user`);

--
-- Index pour la table `year`
--
ALTER TABLE `year`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `annee` (`year`),
  ADD UNIQUE KEY `year` (`year`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `annulation_cause`
--
ALTER TABLE `annulation_cause`
  MODIFY `id_annulation_cause` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `categories_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `clients`
--
ALTER TABLE `clients`
  MODIFY `id_client` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT pour la table `client_devis`
--
ALTER TABLE `client_devis`
  MODIFY `id_client_devis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT pour la table `client_fournisseur`
--
ALTER TABLE `client_fournisseur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `client_ligne_devis`
--
ALTER TABLE `client_ligne_devis`
  MODIFY `id_client_ligne_devis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=156;

--
-- AUTO_INCREMENT pour la table `client_ligne_devis_type_prestation`
--
ALTER TABLE `client_ligne_devis_type_prestation`
  MODIFY `id_client_ligne_devis_type_prestation` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `client_modalite_payement_avance`
--
ALTER TABLE `client_modalite_payement_avance`
  MODIFY `id_client_modalite_payement_avance` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `client_modalite_payement_sans_avance`
--
ALTER TABLE `client_modalite_payement_sans_avance`
  MODIFY `id_client_modalite_payement_sans_avance` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `client_responsable_interlocuteur`
--
ALTER TABLE `client_responsable_interlocuteur`
  MODIFY `id_client_responsable_interlocuteur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `client_secteur`
--
ALTER TABLE `client_secteur`
  MODIFY `id_secteur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `client_type`
--
ALTER TABLE `client_type`
  MODIFY `id_client_type` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `c_responsable_interlocuteur`
--
ALTER TABLE `c_responsable_interlocuteur`
  MODIFY `id_c_responsable_interlocuteur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `devis_mode_paiements`
--
ALTER TABLE `devis_mode_paiements`
  MODIFY `id_devis_mode_paiements` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `devis_objet`
--
ALTER TABLE `devis_objet`
  MODIFY `id_devis_objet` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `devis_paiements`
--
ALTER TABLE `devis_paiements`
  MODIFY `id_devis_paiements` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `document`
--
ALTER TABLE `document`
  MODIFY `document_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `ligne_devis_prestation`
--
ALTER TABLE `ligne_devis_prestation`
  MODIFY `id_ligne_devis_prestation` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=135;

--
-- AUTO_INCREMENT pour la table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT pour la table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `profils`
--
ALTER TABLE `profils`
  MODIFY `id_profil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `societes`
--
ALTER TABLE `societes`
  MODIFY `id_societe` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `year`
--
ALTER TABLE `year`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `clients`
--
ALTER TABLE `clients`
  ADD CONSTRAINT `clients_ibfk_1` FOREIGN KEY (`utilisateurs`) REFERENCES `utilisateurs` (`id_user`),
  ADD CONSTRAINT `clients_ibfk_2` FOREIGN KEY (`client_type`) REFERENCES `client_type` (`id_client_type`),
  ADD CONSTRAINT `clients_ibfk_3` FOREIGN KEY (`client_secteur`) REFERENCES `client_secteur` (`id_secteur`),
  ADD CONSTRAINT `clients_ibfk_4` FOREIGN KEY (`id_societe`) REFERENCES `societes` (`id_societe`);

--
-- Contraintes pour la table `client_devis`
--
ALTER TABLE `client_devis`
  ADD CONSTRAINT `fk_devis_objet` FOREIGN KEY (`devis_objet`) REFERENCES `devis_objet` (`id_devis_objet`);

--
-- Contraintes pour la table `client_devis_client`
--
ALTER TABLE `client_devis_client`
  ADD CONSTRAINT `client_devis_client_ibfk_1` FOREIGN KEY (`id_client_devis`) REFERENCES `client_devis` (`id_client_devis`),
  ADD CONSTRAINT `client_devis_client_ibfk_2` FOREIGN KEY (`id_client`) REFERENCES `clients` (`id_client`),
  ADD CONSTRAINT `client_devis_client_ibfk_3` FOREIGN KEY (`utilisateurs`) REFERENCES `utilisateurs` (`id_user`),
  ADD CONSTRAINT `client_devis_client_ibfk_4` FOREIGN KEY (`id_annulation_cause`) REFERENCES `annulation_cause` (`id_annulation_cause`);

--
-- Contraintes pour la table `client_facture_client`
--
ALTER TABLE `client_facture_client`
  ADD CONSTRAINT `client_Facture_client_ibfk_1` FOREIGN KEY (`id_client_Facture`) REFERENCES `client_devis` (`id_client_devis`),
  ADD CONSTRAINT `client_Facture_client_ibfk_2` FOREIGN KEY (`id_client_devis`) REFERENCES `client_devis` (`id_client_devis`),
  ADD CONSTRAINT `client_Facture_client_ibfk_3` FOREIGN KEY (`id_client`) REFERENCES `clients` (`id_client`),
  ADD CONSTRAINT `client_Facture_client_ibfk_4` FOREIGN KEY (`utilisateurs`) REFERENCES `utilisateurs` (`id_user`);

--
-- Contraintes pour la table `client_ligne_devis`
--
ALTER TABLE `client_ligne_devis`
  ADD CONSTRAINT `client_ligne_devis_ibfk_1` FOREIGN KEY (`client_ligne_devis_type_prestation`) REFERENCES `client_ligne_devis_type_prestation` (`id_client_ligne_devis_type_prestation`),
  ADD CONSTRAINT `client_ligne_devis_ibfk_2` FOREIGN KEY (`client_devis`) REFERENCES `client_devis` (`id_client_devis`),
  ADD CONSTRAINT `fk_client_ligne_devis_type_prestation` FOREIGN KEY (`ligne_devis_prestation`) REFERENCES `ligne_devis_prestation` (`id_ligne_devis_prestation`);

--
-- Contraintes pour la table `client_modalite_payement_avance`
--
ALTER TABLE `client_modalite_payement_avance`
  ADD CONSTRAINT `client_modalite_payement_avance_ibfk_1` FOREIGN KEY (`clients`) REFERENCES `clients` (`id_client`);

--
-- Contraintes pour la table `client_modalite_payement_sans_avance`
--
ALTER TABLE `client_modalite_payement_sans_avance`
  ADD CONSTRAINT `client_modalite_payement_sans_avance_ibfk_1` FOREIGN KEY (`clients`) REFERENCES `clients` (`id_client`);

--
-- Contraintes pour la table `client_responsable_interlocuteur`
--
ALTER TABLE `client_responsable_interlocuteur`
  ADD CONSTRAINT `client_responsable_interlocuteur_ibfk_1` FOREIGN KEY (`clients`) REFERENCES `clients` (`id_client`),
  ADD CONSTRAINT `client_responsable_interlocuteur_ibfk_2` FOREIGN KEY (`c_responsable_interlocuteur`) REFERENCES `c_responsable_interlocuteur` (`id_c_responsable_interlocuteur`);

--
-- Contraintes pour la table `dernier_numero_devis_facture`
--
ALTER TABLE `dernier_numero_devis_facture`
  ADD CONSTRAINT `fk_id_societe` FOREIGN KEY (`id_societe`) REFERENCES `societes` (`id_societe`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Contraintes pour la table `devis_paiements`
--
ALTER TABLE `devis_paiements`
  ADD CONSTRAINT `devis_paiements_ibfk_1` FOREIGN KEY (`devis_mode_paiements`) REFERENCES `devis_mode_paiements` (`id_devis_mode_paiements`),
  ADD CONSTRAINT `devis_paiements_ibfk_2` FOREIGN KEY (`client_devis_client`) REFERENCES `client_devis_client` (`id_client_devis`),
  ADD CONSTRAINT `devis_paiements_ibfk_3` FOREIGN KEY (`document`) REFERENCES `document` (`document_id`);

--
-- Contraintes pour la table `ligne_devis_prestation`
--
ALTER TABLE `ligne_devis_prestation`
  ADD CONSTRAINT `ligne_devis_prestation_ibfk_1` FOREIGN KEY (`client_ligne_devis_type_prestation`) REFERENCES `client_ligne_devis_type_prestation` (`id_client_ligne_devis_type_prestation`);

--
-- Contraintes pour la table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`categories_id`) REFERENCES `categories` (`categories_id`),
  ADD CONSTRAINT `product_ibfk_2` FOREIGN KEY (`id_societe`) REFERENCES `societes` (`id_societe`);

--
-- Contraintes pour la table `societe_prestations`
--
ALTER TABLE `societe_prestations`
  ADD CONSTRAINT `societe_prestations_ibfk_1` FOREIGN KEY (`id_societe`) REFERENCES `societes` (`id_societe`) ON DELETE CASCADE,
  ADD CONSTRAINT `societe_prestations_ibfk_2` FOREIGN KEY (`id_prestation`) REFERENCES `ligne_devis_prestation` (`id_ligne_devis_prestation`) ON DELETE CASCADE;

--
-- Contraintes pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD CONSTRAINT `utilisateurs_ibfk_1` FOREIGN KEY (`profils`) REFERENCES `profils` (`id_profil`);

--
-- Contraintes pour la table `utilisateur_societes`
--
ALTER TABLE `utilisateur_societes`
  ADD CONSTRAINT `utilisateur_societes_ibfk_1` FOREIGN KEY (`id_societe`) REFERENCES `societes` (`id_societe`),
  ADD CONSTRAINT `utilisateur_societes_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `utilisateurs` (`id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
