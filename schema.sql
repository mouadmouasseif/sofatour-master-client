-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : mar. 19 nov. 2024 à 13:09
-- Version du serveur : 10.6.19-MariaDB-cll-lve
-- Version de PHP : 8.1.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `sophato1_ma_thechnologies_gestion_facturation`
--

-- --------------------------------------------------------

--
-- Structure de la table `annulation_cause`
--

CREATE TABLE `annulation_cause` (
  `id_annulation_cause` int(11) NOT NULL,
  `libeller` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `devis_objet` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `client_ligne_devis_type_prestation`
--

CREATE TABLE `client_ligne_devis_type_prestation` (
  `id_client_ligne_devis_type_prestation` int(11) NOT NULL,
  `ligne_devis_type_prestation` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `client_ligne_devis_type_prestation`
--

INSERT INTO `client_ligne_devis_type_prestation` (`id_client_ligne_devis_type_prestation`, `ligne_devis_type_prestation`) VALUES
(1, 'SALLES & ESPACES'),
(2, 'TECHNICIENS & RÉGISSEURS'),
(3, 'Prestations Supplémentaires');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `client_secteur`
--

CREATE TABLE `client_secteur` (
  `id_secteur` int(11) NOT NULL,
  `Secteur` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `annee` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `dernier_numero_devis_facture`
--

INSERT INTO `dernier_numero_devis_facture` (`numero_devis_facture`, `type`, `annee`) VALUES
(136, 'Facture', 2024),
(320, 'Devis', 2024);

--
-- Etablir une relation 1:N `dernier_numero_devis_facture` et 'societe'
--

ALTER TABLE dernier_numero_devis_facture
ADD COLUMN societe_id INT NOT NULL;

ALTER TABLE dernier_numero_devis_facture
ADD CONSTRAINT fk_societe_numero
FOREIGN KEY (societe_id) REFERENCES societes (id_societe)
ON DELETE CASCADE
ON UPDATE CASCADE;


-- --------------------------------------------------------

--
-- Structure de la table `devis_mode_paiements`
--

CREATE TABLE `devis_mode_paiements` (
  `id_devis_mode_paiements` int(11) NOT NULL,
  `libeller` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `document`
--

CREATE TABLE `document` (
  `document_id` int(11) NOT NULL,
  `file_name` varchar(255) DEFAULT NULL,
  `file_path` varchar(255) DEFAULT NULL,
  `file_type` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `ligne_devis_prestation`
--

CREATE TABLE `ligne_devis_prestation` (
  `id_ligne_devis_prestation` int(11) NOT NULL,
  `designation` text DEFAULT NULL,
  `prestation` text DEFAULT NULL,
  `client_ligne_devis_type_prestation` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `ligne_devis_prestation`
--

INSERT INTO `ligne_devis_prestation` (`id_ligne_devis_prestation`, `designation`, `prestation`, `client_ligne_devis_type_prestation`) VALUES
(59, 'Café D\'Accueil', 'Thé, café, eau minérale', 1),
(60, 'Petit Déjeuner', 'Thé, café, eau minérale, lait, jus d’orange, pâtisserie marocaine et française, variété de salé soupe, œuf brouillé, œuf khlie, viennoiserie', 1),
(61, 'Pause Café Matin', 'Thé, café, eau minérale, lait, jus d’orange, pâtisserie marocaine et française, variété de salé, viennoiserie', 1),
(62, 'Pause Café Matin Améliorée', 'Thé, café, eau minérale, lait, jus d’orange, pâtisserie marocaine et française, variété de salé, viennoiserie', 1),
(63, 'Pause Café Après Midi', 'Thé, café, eau minérale, lait, jus d’orange, patisserie marocaine et française, variété de salé et canapés froid', 1),
(64, 'Pause Café Après Midi Améliorée', 'Thé, café, eau minérale, lait, jus d’orange, pâtisserie marocaine et française, variété de salé et canapés froid', 1),
(65, 'Pause Café V.I.P', 'Thé, café capsule, eau minérale, lait, jus d’orange, patisserie marocaine et française, variété de salé, datte Majhoule, acajou, amande griller', 1),
(66, 'Déjeuner servie à Table', 'Déjeuner servis à table avec Boissons Soft', 1),
(67, 'Cocktail Déjeunatoire', 'Cocktail déjeunatoire avec Boissons Soft', 1),
(68, 'Déjeuner Buffet', 'Déjeuner en Buffet international et Marocain avec Boisson soft', 1),
(69, 'Diner servie à Table', 'Diner servis à table avec Boissons Soft', 1),
(70, 'Cocktail Dinatoire', 'Cocktail dinatoire avec Boissons Soft', 1),
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
(116, 'Assistance technique', '', 2);


CREATE TABLE societe_prestations (
    id_societe INT NOT NULL,
    id_prestation INT NOT NULL,
    PRIMARY KEY (id_societe, id_prestation),
    FOREIGN KEY (id_societe) REFERENCES societes(id_societe) ON DELETE CASCADE,
    FOREIGN KEY (id_prestation) REFERENCES ligne_devis_prestation(id_ligne_devis_prestation) ON DELETE CASCADE
);

INSERT INTO societe_prestations (id_societe, id_prestation) VALUES (1, 59);

INSERT INTO societe_prestations (id_societe, id_prestation) VALUES (2, 59);


-- --------------------------------------------------------

--
-- Structure de la table `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_image` text NOT NULL,
  `categories_id` int(11) NOT NULL,
  `quantity_initiale` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `rate` varchar(255) NOT NULL,
  `active` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 0,
  `id_societe` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `profils`
--

CREATE TABLE `profils` (
  `id_profil` int(11) NOT NULL,
  `nom_profil` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `societes`
--

INSERT INTO `societes` (`id_societe`, `societe_name`, `path_image`, `all_name`) VALUES
(1, 'Dar n’zaha', 'entreprise_logo/dar_nzaha.png', 'Dar n’zaha'),
(2, 'Palais des congrès', 'entreprise_logo/palais_de_congres.png', 'Palais des Congres Rabat Bouregreg\n'),
(3, 'Dar lakbira', 'entreprise_logo/dar_lakbira.png', 'Dar lakbira');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur_societes`
--

CREATE TABLE `utilisateur_societes` (
  `id_societe` int(11) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
-- Index pour la table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `categories_id` (`categories_id`),
  ADD KEY `id_societe` (`id_societe`);

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
  MODIFY `id_client` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `client_devis`
--
ALTER TABLE `client_devis`
  MODIFY `id_client_devis` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `client_ligne_devis`
--
ALTER TABLE `client_ligne_devis`
  MODIFY `id_client_ligne_devis` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `client_ligne_devis_type_prestation`
--
ALTER TABLE `client_ligne_devis_type_prestation`
  MODIFY `id_client_ligne_devis_type_prestation` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `client_modalite_payement_avance`
--
ALTER TABLE `client_modalite_payement_avance`
  MODIFY `id_client_modalite_payement_avance` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `client_modalite_payement_sans_avance`
--
ALTER TABLE `client_modalite_payement_sans_avance`
  MODIFY `id_client_modalite_payement_sans_avance` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `client_responsable_interlocuteur`
--
ALTER TABLE `client_responsable_interlocuteur`
  MODIFY `id_client_responsable_interlocuteur` int(11) NOT NULL AUTO_INCREMENT;

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
  MODIFY `id_devis_paiements` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `document`
--
ALTER TABLE `document`
  MODIFY `document_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `ligne_devis_prestation`
--
ALTER TABLE `ligne_devis_prestation`
  MODIFY `id_ligne_devis_prestation` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=117;

--
-- AUTO_INCREMENT pour la table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `profils`
--
ALTER TABLE `profils`
  MODIFY `id_profil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `societes`
--
ALTER TABLE `societes`
  MODIFY `id_societe` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT;

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
