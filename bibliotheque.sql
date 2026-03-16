-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 20 mars 2025 à 18:35
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `bibliotheque`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

CREATE TABLE `admin` (
  `idAdmin` int(11) NOT NULL,
  `Nom` varchar(50) NOT NULL,
  `Prenom` varchar(50) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `MotDePasse` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`idAdmin`, `Nom`, `Prenom`, `Email`, `MotDePasse`) VALUES
(1, 'Claude', 'Mugisha', 'claudemug4@gmail.com', '$2y$10$wyCjEb6LD84MtfibVE17eOv7BAm4tTPJYew/DxhbuOvoFUt/yCD/q'),
(7, 'Claude', 'Mugisha Claude', 'aida@reime.com', '$2y$10$BQJvL4PtjR0tQJ3GRXJJ..377vyf963fpB7Bu7SpO9hFVY/pTnA3a'),
(9, 'Mugwaneza', 'Duse Reine', 'reineaydaa@gmail.com', '$2y$10$jdNxjRiJXU4L8QNZwwwhteB.srgZGw4ywFAr3ELoy6zJdxK6YXCgu');

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE `categorie` (
  `idCategorie` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `IdLivre` int(11) DEFAULT NULL,
  `idclient` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`idCategorie`, `name`, `IdLivre`, `idclient`) VALUES
(1, 'Informatique', NULL, NULL),
(2, 'Science', NULL, NULL),
(3, 'Construction', NULL, NULL),
(4, 'Litterature', NULL, NULL),
(5, 'Entreprise et Droit', NULL, NULL),
(6, 'ViePratique', NULL, NULL),
(7, 'BD & Jeunesse', NULL, NULL),
(8, 'Arts & Loisir', NULL, NULL),
(9, 'Mecanique', NULL, NULL),
(10, 'Voyage', NULL, NULL),
(11, 'Graphisme', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `IdCategorie` int(10) NOT NULL,
  `Informatique` varchar(200) NOT NULL,
  `Science` varchar(200) NOT NULL,
  `Construction` varchar(200) NOT NULL,
  `Litterature` varchar(200) NOT NULL,
  `Entreprise et Droit` varchar(200) NOT NULL,
  `ViePratique` varchar(200) NOT NULL,
  `BD & Jeunesse` varchar(200) NOT NULL,
  `Arts & Loisir` varchar(200) NOT NULL,
  `Mecanique` varchar(200) NOT NULL,
  `Voyage` varchar(200) NOT NULL,
  `Graphisme` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

CREATE TABLE `client` (
  `idclient` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `sexe` enum('Homme','Femme','Autre') NOT NULL,
  `email` varchar(100) NOT NULL,
  `pays` varchar(50) NOT NULL,
  `ville` varchar(50) NOT NULL,
  `mot_de_passe` varchar(255) NOT NULL,
  `newsletter` varchar(10) NOT NULL,
  `partner_offers` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`idclient`, `nom`, `prenom`, `sexe`, `email`, `pays`, `ville`, `mot_de_passe`, `newsletter`, `partner_offers`) VALUES
(7, 'Reine', 'Duse', '', 'aida@reine.com', 'Cameroun', 'Yaounde', '$2y$10$72ZRT2NszAV0z1TS0ayLreY0JuFuKWT62R1.t9AonibjhJ5hfMmdS', '0', '1'),
(10, 'Claude', 'Mugisha', '', 'claude.entreprise03@gmail.com', 'Burundi', 'Bujumbura', '$2y$10$/kdFxQqYRqnEvyUViNMNlebNlUA0qs7vVvYckQkkUo9rNZQnxwW3.', '0', '1'),
(11, 'mug', 'Claude', '', 'claudemug1@gmail.com', 'Ghana', 'Nichel', '$2y$10$fz3rdARQJrv9Ej1rQ/3p2ewKx8.09/RAIgB.j7zBnFId5DvJAEVEC', '0', '0');

-- --------------------------------------------------------

--
-- Structure de la table `commandes`
--

CREATE TABLE `commandes` (
  `idCommande` int(11) NOT NULL,
  `idClient` int(11) DEFAULT NULL,
  `Nom` varchar(30) DEFAULT NULL,
  `idLivre` int(11) DEFAULT NULL,
  `quantite` int(11) DEFAULT NULL,
  `date_commande` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `commandes`
--

INSERT INTO `commandes` (`idCommande`, `idClient`, `Nom`, `idLivre`, `quantite`, `date_commande`) VALUES
(2, 7, '0', NULL, 1, '2025-01-21 19:59:46'),
(3, 7, NULL, 2, 2, '2025-01-23 16:20:18'),
(4, 7, NULL, 1, 2, '2025-01-23 16:29:36'),
(5, 7, NULL, 3, 1, '2025-01-23 16:30:07'),
(7, 11, NULL, 1, 2, '2025-01-28 10:15:46'),
(8, 7, NULL, 7, 1, '2025-02-09 18:00:47'),
(9, 7, NULL, 12, 1, '2025-02-09 18:21:56'),
(10, 7, NULL, 26, 1, '2025-02-09 19:53:39');

-- --------------------------------------------------------

--
-- Structure de la table `emprunts`
--

CREATE TABLE `emprunts` (
  `id` int(11) NOT NULL,
  `idClient` int(11) NOT NULL,
  `idLivre` int(11) NOT NULL,
  `date_emprunt` datetime NOT NULL,
  `date_retour` datetime NOT NULL,
  `statut` enum('en_attente','accepte','refuse') DEFAULT 'en_attente',
  `message_refus` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `emprunts`
--

INSERT INTO `emprunts` (`id`, `idClient`, `idLivre`, `date_emprunt`, `date_retour`, `statut`, `message_refus`) VALUES
(1, 11, 3, '2025-02-10 21:25:36', '2025-02-24 21:25:36', 'accepte', NULL),
(2, 11, 3, '2025-02-10 21:26:15', '2025-02-24 21:26:15', 'refuse', 'Plusier fois'),
(7, 11, 1, '2025-02-10 21:33:52', '2025-02-24 21:33:52', 'en_attente', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `historique_connexions`
--

CREATE TABLE `historique_connexions` (
  `id` int(11) NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  `type_utilisateur` enum('client','admin','autre') NOT NULL,
  `date_connexion` datetime DEFAULT current_timestamp(),
  `adresse_ip` varchar(45) NOT NULL,
  `user_agent` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `historique_connexions`
--

INSERT INTO `historique_connexions` (`id`, `id_utilisateur`, `type_utilisateur`, `date_connexion`, `adresse_ip`, `user_agent`) VALUES
(1, 0, 'autre', '2025-02-11 23:53:51', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/132.0.0.0 Safari/537.36'),
(2, 0, 'autre', '2025-02-11 23:57:47', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/132.0.0.0 Safari/537.36'),
(3, 0, 'autre', '2025-02-13 18:45:17', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/132.0.0.0 Safari/537.36'),
(4, 0, 'autre', '2025-02-13 19:02:30', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/132.0.0.0 Safari/537.36'),
(5, 0, 'autre', '2025-02-21 13:34:54', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Safari/537.36');

-- --------------------------------------------------------

--
-- Structure de la table `informatique`
--

CREATE TABLE `informatique` (
  `IdInfo` int(11) NOT NULL,
  `DeveloppementWeb` varchar(255) DEFAULT NULL,
  `DeveloppementApplications` varchar(255) DEFAULT NULL,
  `OutilsDeveloppement` varchar(255) DEFAULT NULL,
  `InformatiqueEntreprise` varchar(255) DEFAULT NULL,
  `ManagementSystemesInformation` varchar(255) DEFAULT NULL,
  `ConceptionDeveloppementWeb` varchar(255) DEFAULT NULL,
  `ReferencementSites` varchar(255) DEFAULT NULL,
  `SystemesExploitation` varchar(255) DEFAULT NULL,
  `HardwareMateriels` varchar(255) DEFAULT NULL,
  `ArchitectureOrdinateurs` varchar(255) DEFAULT NULL,
  `ElectroniqueInformatique` varchar(255) DEFAULT NULL,
  `Peripheriques` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `livreetudiant`
--

CREATE TABLE `livreetudiant` (
  `idLiv` int(11) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `auteur` varchar(100) NOT NULL,
  `categorie` varchar(100) NOT NULL,
  `fichier` text NOT NULL,
  `couverture` varchar(255) NOT NULL,
  `resume` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `livreetudiant`
--

INSERT INTO `livreetudiant` (`idLiv`, `titre`, `auteur`, `categorie`, `fichier`, `couverture`, `resume`) VALUES
(1, 'Analyse numeriques', 'University of burundu', 'Informatique', 'Creer son cite web.pdf', 'FILES/cover/i2.jpg', 'Le livre de développement web présente les fondamentaux des technologies utilisées pour créer des sites et applications en ligne, en couvrant des langages comme HTML, CSS et JavaScript. Il propose également des exemples pratiques et des conseils pour optimiser l\'expérience utilisateur et assurer la performance des projets web.'),
(2, 'Créer un site wb a partant de 0', 'Mugisha Claude.', 'Informatique', 'FILES/file/Creer son cite web.pdf', 'FILES/cover/Site web.jpg', 'Plongez dans l\'univers fascinant des livres grâce à notre site web, où chaque page ouvre une nouvelle porte vers la connaissance et l\'aventure.\"\r\n\r\n\"Découvrez comment créer votre propre site web dédié aux livres, pour partager vos coups de cœur littéraires et échanger avec d\'autres passionnés de lecture'),
(3, 'Cours arduino', 'Electronics-labs', 'Electronique', 'Arduino_cours.pdf', '3.jpg', 'Le livre de cours Arduino représente une ressource inestimable pour quiconque souhaite explorer le monde de l\'électronique et de la programmation. En présentant des concepts de manière accessible, il permet aux débutants de se familiariser avec les bases tout en offrant des projets pratiques qui stimulent la créativité et l\'expérimentation. Les explications claires et les illustrations détaillées guident le lecteur à travers chaque étape, rendant l\'apprentissage engageant et interactif. De plus, les défis proposés à la fin de chaque chapitre encouragent une approche proactive et autonome, favorisant ainsi une compréhension profonde et durable des technologies Arduino. Ce livre est non seulement un outil éducatif, mais aussi une véritable porte d\'entrée vers l\'innovation et la réalisation de projets électroniques'),
(4, 'Algèbres de Boole', 'Université du Burundi', 'Informatiques ', 'ALGEBRE DE BOOLE.pdf', '1000003315.jpg', 'Dans ce livres nous vous donnons une partie qui parle de l\'algèbre de Boole'),
(5, 'Algèbres de Boole', 'Université du Burundi', 'Informatiques ', 'ALGEBRE DE BOOLE.pdf', '1000003315.jpg', 'Dans ce livres nous vous donnons une partie qui parle de l\'algèbre de Boole'),
(6, 'Algèbres de Boole', 'Université du Burundi', 'Informatiques ', 'ALGEBRE DE BOOLE.pdf', '1000003315.jpg', 'Dans ce livres nous vous donnons une partie qui parle de l\'algèbre de Boole'),
(7, 'Algèbres de Boole', 'Université du Burundi', 'Informatiques ', 'ALGEBRE DE BOOLE.pdf', '1000003315.jpg', 'Dans ce livres nous vous donnons une partie qui parle de l\'algèbre de Boole'),
(8, 'Algèbres de Boole', 'Université du Burundi', 'Informatiques ', 'ALGEBRE DE BOOLE.pdf', '1000003315.jpg', 'Dans ce livres nous vous donnons une partie qui parle de l\'algèbre de Boole'),
(9, 'Algèbres de Boole', 'Université du Burundi', 'Informatiques ', 'ALGEBRE DE BOOLE.pdf', '1000003315.jpg', 'Dans ce livres nous vous donnons une partie qui parle de l\'algèbre de Boole'),
(10, 'Algèbres de Boole', 'Université du Burundi', 'Informatiques ', 'ALGEBRE DE BOOLE.pdf', '1000003315.jpg', 'Dans ce livres nous vous donnons une partie qui parle de l\'algèbre de Boole'),
(11, 'Algèbres de Boole', 'Université du Burundi', 'Informatiques ', 'ALGEBRE DE BOOLE.pdf', '1000003315.jpg', 'Dans ce livres nous vous donnons une partie qui parle de l\'algèbre de Boole'),
(12, 'Algèbres de Boole', 'Université du Burundi', 'Informatiques ', 'ALGEBRE DE BOOLE.pdf', '1000003315.jpg', 'Dans ce livres nous vous donnons une partie qui parle de l\'algèbre de Boole'),
(13, 'Algèbres de Boole', 'Université du Burundi', 'Informatiques ', 'ALGEBRE DE BOOLE.pdf', '1000003315.jpg', 'Dans ce livres nous vous donnons une partie qui parle de l\'algèbre de Boole'),
(14, 'Algèbres de Boole', 'Université du Burundi', 'Informatiques ', 'ALGEBRE DE BOOLE.pdf', '1000003315.jpg', 'Dans ce livres nous vous donnons une partie qui parle de l\'algèbre de Boole'),
(15, 'Algèbres de Boole', 'Université du Burundi', 'Informatiques ', 'ALGEBRE DE BOOLE.pdf', '1000003315.jpg', 'Dans ce livres nous vous donnons une partie qui parle de l\'algèbre de Boole'),
(16, 'Algèbres de Boole', 'Université du Burundi', 'Informatiques ', 'ALGEBRE DE BOOLE.pdf', '1000003315.jpg', 'Dans ce livres nous vous donnons une partie qui parle de l\'algèbre de Boole'),
(17, 'Algèbres de Boole', 'Université du Burundi', 'Informatiques ', 'ALGEBRE DE BOOLE.pdf', '1000003315.jpg', 'Dans ce livres nous vous donnons une partie qui parle de l\'algèbre de Boole'),
(18, 'Algèbres de Boole', 'Université du Burundi', 'Informatiques ', 'ALGEBRE DE BOOLE.pdf', '1000003315.jpg', 'Dans ce livres nous vous donnons une partie qui parle de l\'algèbre de Boole'),
(19, 'Algèbres de Boole', 'Université du Burundi', 'Informatiques ', 'ALGEBRE DE BOOLE.pdf', '1000003315.jpg', 'Dans ce livres nous vous donnons une partie qui parle de l\'algèbre de Boole'),
(21, 'Alimentation stabiliser', 'Cyrille', '4', 'Cyrille.pdf', '2.jpg', 'Litterature'),
(22, 'Alimentation stabiliser', 'Cyrille', '4', 'Cyrille.pdf', '2.jpg', 'Litterature'),
(23, 'Alimentation stabiliser', 'Cyrille', '4', 'Cyrille.pdf', '2.jpg', 'Litterature'),
(27, 'Apprendre c++', 'Elo-utra', '1', 'Apprendre le C++.pdf', 'C++.jpg', 'Le C++ pour les nuls\" est un excellent point de départ pour les débutants, offrant une approche simple et accessible au langage.\r\n\"C++ Primer\" de Stanley B. Lippman est souvent recommandé pour ceux qui souhaitent approfondir leurs connaissances et comprendre les concepts avancés.\r\n\"Effective C++\" de Scott Meyers présente des recommandations pratiques et des bonnes pratiques pour écrire un code C++ efficace et maintenable.\r\n\"The C++ Programming Language\" de Bjarne Stroustrup, le créateur du C++, offre une compréhension approfondie du langage et de ses caractéristiques.'),
(28, 'Apprendre c++', 'Elo-utra', '1', 'Apprendre le C++.pdf', 'C++.jpg', 'Le C++ pour les nuls\" est un excellent point de départ pour les débutants, offrant une approche simple et accessible au langage.\r\n\"C++ Primer\" de Stanley B. Lippman est souvent recommandé pour ceux qui souhaitent approfondir leurs connaissances et comprendre les concepts avancés.\r\n\"Effective C++\" de Scott Meyers présente des recommandations pratiques et des bonnes pratiques pour écrire un code C++ efficace et maintenable.\r\n\"The C++ Programming Language\" de Bjarne Stroustrup, le créateur du C++, offre une compréhension approfondie du langage et de ses caractéristiques.'),
(29, 'Miroir plan et projection de lumier', 'Duse reine', '9', 'miroirs2.pdf', 'Projection.jpg', 'La réflexion et la réfraction de la lumière sont deux phénomènes optiques importants que l\'on peut observer avec des miroirs et des milieux transparents.\r\n\r\nLa réflexion se produit lorsqu\'une onde lumineuse rencontre une surface, comme celle d\'un miroir, et rebondit. Dans le cas des miroirs plans, la loi de la réflexion est simple : l\'angle d\'incidence (l\'angle formé entre le rayon incident et la normale à la surface) est égal à l\'angle de réflexion (l\'angle formé entre le rayonnement réfléchi et la normale). '),
(30, 'Analyse de conflits', 'please let ', '5', 'Analyse  des conflits.pdf', 'Analyse  des conflits Page 01 Snapshot 01.png', '\"Analyse de conflit\" est un ouvrage qui explore les dynamiques sous-jacentes des antagonismes humains. L\'auteur y examine les causes profondes des conflits, qu\'elles soient d\'origine culturelle, économique ou politique. À travers des études de cas, il propose des stratégies de résolution et de médiation, soulignant l\'importance de la communication et de l\'empathie. Ce livre est un outil essentiel pour quiconque cherche à mieux comprendre et à naviguer les tensions interpersonnelles et internationales.');

-- --------------------------------------------------------

--
-- Structure de la table `livres`
--

CREATE TABLE `livres` (
  `IdLivre` int(10) NOT NULL,
  `Titre` varchar(200) NOT NULL,
  `Auteur` varchar(200) NOT NULL,
  `Categorie` varchar(200) DEFAULT NULL,
  `SubCategorie` varchar(200) DEFAULT NULL,
  `Prix` int(10) NOT NULL,
  `Devise` varchar(10) NOT NULL,
  `Couverture` varchar(500) NOT NULL,
  `Resume` text NOT NULL,
  `Fichier` blob NOT NULL,
  `DateEdit` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `livres`
--

INSERT INTO `livres` (`IdLivre`, `Titre`, `Auteur`, `Categorie`, `SubCategorie`, `Prix`, `Devise`, `Couverture`, `Resume`, `Fichier`, `DateEdit`) VALUES
(1, 'Concentration', 'Claude mug', 'ViePratique', '4', 200, '$', '4.jpg', 'La concentration mentale est la capacité à diriger son attention sur une tâche spécifique tout en évitant les distractions. Elle est essentielle pour améliorer la productivité et la qualité du travail, que ce soit dans le domaine académique ou professionnel. En développant des techniques de concentration, comme la méditation ou la gestion du temps, on peut optimiser notre performance intellectuelle. Enfin, une bonne concentration contribue également à la gestion du stress, car elle permet de mieux organiser ses pensées et d\'aborder les défis de manière plus sereine.', 0x436f6e63656e74726174696f6e2e706466, 2025),
(2, 'Electronique', 'Claude mug', 'Informatique', '4', 23, '', '2.jpg', 'Nous vous aimons tous', 0x44696575782065742050686172616f6e7320456779707469656e732e706466, 2022),
(3, 'Électronique de puissance', 'Claude mug', 'Informatique', '1', 223, 'Fbu', '1708724317368.jpg', 'L\'électronique de puissance est un domaine crucial qui traite de la conversion, du contrôle et de la gestion de l\'énergie électrique. Elle utilise des dispositifs semi-conducteurs comme les transistors, les diodes et les thyristors pour réguler la tension et le courant, permettant ainsi d\'optimiser les performances des systèmes électriques. \r\n\r\nCette technologie est essentielle pour les applications variées, notamment dans les énergies renouvelables, où elle permet de transformer l\'énergie solaire ou éolienne en électricité utilisable. De plus, l\'électronique de puissance contribue à améliorer l\'efficacité énergétique des moteurs électriques et des systèmes de propulsion dans les véhicules électriques et hybrides.\r\n\r\nLes avancées dans ce domaine favorisent le développement de solutions innovantes pour les défis énergétiques d\'aujourd\'hui, tels que la réduction des pertes d\'énergie et l\'intégration des smart grids. En somme, l\'électronique de puissance joue un rôle stratégique dans la transition énergétique et la durabilité.', 0x5361766f6972207365207461697265207361766f6972207061726c65722e706466, 2025),
(4, 'Livre', 'Claude mug', 'Science', '7', 20, '$', '4.jpg', 'Ces livres est tres populaire merci', 0x44696575782065742050686172616f6e7320456779707469656e732e706466, 2024),
(5, 'ELOS', 'Claude mug', 'Informatique', '1', 223, '', '1708724317368.jpg', 'okokokok', 0x5361766f6972207365207461697265207361766f6972207061726c65722e706466, 2025),
(6, 'Electronique de puissance', 'Mugisha Claude', 'Informatique', '24', 23452, 'Fbu', '6.jpg', 'Ce livre propose une approche holistique pour stabiliser son une alimentation de manière durable et stable ainsi il met en œuvre la théorie et la pratique des notion sur l\'électricité et l\'électronique.  ', 0x616c696d656e746174696f6e2073746162696c6973652e706466, 2024),
(7, 'Electronique de puissance', 'Imen Es', 'Informatique', '1', 6785, 'Fbu', '15.jpg', 'Le livre aborde les principes fondamentaux de l\'électronique de puissance, en mettant l\'accent sur les convertisseurs et les régulateurs. Il présente également des applications pratiques, allant des alimentations à découpage aux systèmes de gestion d\'énergie. Enfin, l\'ouvrage inclut des études de cas, permettant aux lecteurs de mieux comprendre les défis et solutions dans ce domaine en constante évolution.', 0x436f6e76657274697373657572732d44432d44432e706466, 2025),
(8, 'Confiance en soi', 'Mugisha Claude', 'ViePratique', '61', 2000, 'Fbu', '1715169283042.jpg', 'La confiance est la clé', 0x436f6e6669616e636520656e20736f692e706466, 2025),
(9, 'Sexe éducation ', 'Innocent kulondwa', 'ViePratique', '54', 20000, 'Fbu', '1714886220950.jpg', 'E\"Sex Education\" est un livre qui explore les thèmes de la sexualité, des relations et de l\'identité à travers le prisme de l\'adolescence. Il aborde avec sensibilité et humour les défis que rencontrent les jeunes en matière d\'éducation sexuelle, de consentement et de diversité. En offrant des perspectives variées, l\'ouvrage encourage une discussion ouverte et informée sur des sujets souvent jugés tabous.', 0x43616c63756c354e756d65726f6c6f6769652e706466, 2024),
(10, 'Confiance en soi', 'Claude', 'ViePratique', '14', 20000, 'Fbu', '1000031971.jpg', ' Des titres comme \"Le Pouvoir de la confiance en soi\" de Brian Tracy offrent des stratégies pratiques pour développer une meilleure estime de soi. \"Les 4 Accords Toltèques\" de Don Miguel Ruiz aborde également l’importance de la confiance personnelle dans la quête d\'une vie épanouie. Enfin, \"S\'affirmer et oser dire non\" de Laurent Gounelle enseigne comment s\'affirmer tout en restant fidèle à soi-même.', 0x436f6e6669616e636520656e20736f692e706466, 2025),
(11, 'Soudage Mécanique ', 'Electro-mEcan eneg', 'Mecanique', NULL, 200000, 'Fbu', 'Soudage.jpg', 'Maîtrisez l\'art du soudage avec notre collection de livres spécialisés, adaptés aussi bien aux débutants qu\'aux professionnels.', 0x4c6520536f75646167652e706466, 2024),
(12, 'Les instrument de tarage', 'Electro-mEcan eneg', 'Mecanique', NULL, 19, 'USD', 'Tarage.jpg', 'Les instruments de tarage en mécanique sont des dispositifs utilisés pour ajuster et calibrer des machines et des outils afin d\'assurer leur précision et leur efficacité. Parmi ces instruments, on trouve des étalons de mesure, des jauges de contrôle et des dispositifs de réglage qui permettent de vérifier les dimensions et les angles de pièces mécaniques. Ces instruments sont essentiels pour garantir la qualité des productions et éviter les erreurs coûteuses lors de l\'assemblage. Enfin, l\'utilisation appropriée des instruments de tarage contribue à prolonger la durée de vie des équipements et à améliorer la sécurité des opérations industrielles.', 0x4c65732d696e737472756d656e74732d64652d7472616167652e706466, 2024),
(13, 'Mécanisme et constructions des machines', 'Claude-mug', 'Mecanique', NULL, 15, 'USD', 'Mecanisme.jpg', 'Les machines mécaniques fonctionnent grâce à un ensemble de mécanismes qui convertissent l\'énergie en mouvement. Ces mécanismes incluent des éléments tels que des leviers, des poulies, et des engrenages, qui permettent de transmettre la force et de multiplier le mouvement. La construction de machines implique l\'assemblage de pièces en respectant des principes de conception pour garantir leur efficacité et leur durabilité. Enfin, l\'optimisation des matériaux et des formes contribue à améliorer la performance globale des machines et à réduire les coûts de production.', 0x4d6563616e69736d6520657420636f6e737472756374696f6e20646573206d616368696e65732e706466, 2024),
(14, 'Catalogue de soudure', 'Mecano-Ub', 'Mecanique', NULL, 10000, 'Fbu', 'Soudure.jpg', 'Un catalogue de soudure mécanique est une ressource essentielle pour les professionnels du secteur, présentant différents procédés de soudage et leurs applications. Il fournit des illustrations détaillées, des spécifications techniques et des conseils pratiques pour garantir des soudures de qualité. De plus, ce type de catalogue peut inclure des études de cas et des recommandations sur les meilleures pratiques, facilitant ainsi la formation continue des techniciens et ingénieurs.', 0x5f30392d436174616c6f6775652d706f73742d64652d736f75647572652e706466, 2020),
(15, 'Élément des machines connaissance de base ', 'Electro-mEcan eneg', 'Mecanique', NULL, 5, 'USD', 'Element.jpg', 'Les éléments de machines mécaniques sont des composants essentiels qui permettent le mouvement et la transmission de forces dans divers systèmes mécaniques. Parmi eux, on trouve des pièces telles que les engrenages, qui assurent le changement de vitesse et de direction du mouvement, ainsi que des roulements, qui facilitent la rotation en réduisant les frictions. Les arbres de transmission jouent également un rôle crucial, en reliant différentes parties de la machine et en transmettant le couple nécessaire à leur fonctionnement. Enfin, la compréhension des contraintes et des matériaux est primordiale pour garantir la durabilité et l\'efficacité de ces éléments dans des applications variées.', 0x6c6d656e74732d64652d6d616368696e652d636f6e6e61697373616e6365732d64652d626173655f6672656e63682e706466, 2018),
(16, 'Dessin technique polycopie', 'ub-ele-I.S.S.A', 'Mecanique', NULL, 20000, 'Fbu', 'Dessin.jpg', 'Le dessin technique en mécanique est un langage visuel utilisé pour communiquer des informations précises sur les pièces et les assemblages. Il inclut des éléments tels que les cotations, les projections, et les symboles normalisés pour garantir une compréhension uniforme entre ingénieurs et techniciens. Ce type de dessin aide à visualiser les dimensions, les matériaux et les tolérances nécessaires à la fabrication. Dans un livre sur le sujet, on trouverait également des exemples pratiques et des normes internationales comme ISO ou ANSI.', 0x504f4c59434f5049455f5265637565696c5f645f6578657263696365735f656e5f64657373696e5f746563686e697175652e706466, 2022),
(17, 'Resistance des matériaux de A a Z', 'Mugisha Claude', 'Mecanique', NULL, 20, 'USD', 'resistance.jpg', 'La résistance des matériaux est une branche de la mécanique qui étudie le comportement des structures et des matériaux soumis à des charges. Elle analyse les déformations et les contraintes générées par différentes forces, permettant ainsi de concevoir des constructions à la fois sûres et efficaces. Les principes fondamentaux incluent la loi de Hooke pour les matériaux élastiques, ainsi que les critères de rupture pour anticiper les limites de résistance. En combinant théorie et applications pratiques, cette discipline est essentielle pour l\'ingénierie civile, la construction et d\'autres domaines techniques.', 0x52444d2e706466, 2018),
(18, 'Turbines hydrauliques', 'Electro-mEcan eneg', 'Mecanique', NULL, 23000, 'Fbu', 'Turbines.jpg', 'Les turbines hydrauliques sont des machines qui convertissent l\'énergie cinétique et potentielle de l\'eau en énergie mécanique. Elles sont largement utilisées dans les centrales hydroélectriques pour produire de l\'électricité. Les deux types principaux de turbines hydrauliques sont les turbines à réaction et les turbines à impulsion. \r\n\r\nLes turbines à réaction, comme les turbines Francis, fonctionnent avec de l\'eau qui circule en permanence à travers la turbine, tandis que les turbines à impulsion, comme les turbines Pelton, utilisent des jets d\'eau pour faire tourner les pales. Le choix de la turbine dépend de la hauteur de chute d\'eau et du débit disponible. \r\n\r\nLes turbines hydrauliques sont réputées pour leur efficacité et leur durabilité, et elles jouent un rôle crucial dans la gestion des ressources en eau et la production d\'énergie renouvelable. L\'impact environnemental des centrales hydrauliques est souvent un sujet de débat, notamment en ce qui concerne les écosystèmes aquatiques et les communautés locales. \r\n\r\nEn bref découvrez, les turbines hydrauliques qui sont des éléments essentiel de la transition énergétique, permettant de transformer l\'énergie de l\'eau en électricité de manière efficace et durable.', 0x54757262696e6573204879647261756c69717565732e504446, 2024),
(19, 'Les Machines outils ', 'Electro-mEcan eneg', 'Mecanique', NULL, 10, 'USD', 'Machine.jpg', 'Les machines-outils sont des équipements essentiels dans l\'industrialisation, permettant de façonner et de usiner des matériaux grâce à des processus précis. Cet ouvrage détaille leurs différents types, tels que les tours, les fraiseuses et les perceuses, en expliquant leur fonctionnement et leurs applications dans divers secteurs. En outre, il aborde l\'évolution technologique des machines-outils, mettant en lumière l\'impact de l\'automatisation et de la numérisation sur la production moderne.', 0x746f7572253230286d616368696e652d6f7574696c292e706466, 2025),
(20, 'Mirroirs suite 2', 'Electro-mEcan eneg', 'Mecanique', NULL, 5000, 'Fbu', 'Mirroir 2.png', 'Les miroirs en mécanique et en physique sont des surfaces réfléchissantes qui obéissent aux lois de la réflexion. En optique, ils sont utilisés pour manipuler et diriger les faisceaux lumineux, jouant un rôle essentiel dans des dispositifs tels que les télescopes et les lasers. De plus, les miroirs concaves et convexes ont des propriétés distinctes en termes de formation d\'images, ce qui les rend indispensables dans des applications variées, allant de l\'imagerie médicale à la photographie.', 0x6d69726f697273322e706466, 2014),
(21, 'Tournage Mécanique ', 'Electro-mEcan eneg', 'Mecanique', NULL, 12500, 'Fbu', 'turb2.jpg', 'Découvrez l\'univers fascinant du tournage mécanique à travers notre livre captivant, qui vous guide pas à pas dans les techniques essentielles et les astuces des professionnels. Avec des illustrations détaillées et des exemples pratiques, vous apprendrez à maîtriser cette discipline incontournable de l\'usinage. Que vous soyez amateur ou expert, cet ouvrage est l\'outil parfait pour approfondir vos compétences et un véritable compagnon sur la voie de la précision et de la créativité.', 0x746f75726e6167652532306d6563616e697175652e706466, 2023),
(22, 'Les fibres optique ', 'Electro-lab', 'Science', NULL, 10000, 'Fbu', 'fibre.jpg', 'La fibre optique est un fil mince en verre ou en plastique capable de transmettre des données sous forme de lumière, permettant des communications à très haute vitesse sur de longues distances. Grâce à sa capacité à réduire la perte de signal et à résister aux interférences électromagnétiques, elle est devenue essentielle pour les réseaux internet modernes, les télécommunications et la diffusion de contenu multimédia. De plus, son installation et son entretien représentent des défis techniques, mais ses avantages en termes de performance et d\'efficacité énergétique en font une solution privilégiée pour l\'avenir des infrastructures numériques.', 0x436861706974726520315f4f70746fc3a96c656374726f6e697175655f6c657320666962726573206f707469717565732e706466, 2025),
(23, 'Circuits électriques ', 'Université du Burundi', 'Science', NULL, 4000, 'Fbu', 'Circuits.png', 'Les livres sur les circuits électriques offrent une exploration approfondie des principes fondamentaux de l\'électricité, y compris les lois de l\'Ohm et de Kirchhoff, qui sont essentielles pour comprendre le fonctionnement des circuits. Ils couvrent également les différentes configurations de circuits, tels que les circuits en série et en parallèle, et illustrent comment ces agencements influencent le comportement du courant et de la tension. Enfin, ces ouvrages incluent souvent des exemples pratiques et des exercices, permettant aux lecteurs de mettre en œuvre leurs connaissances théoriques à travers des projets et des applications réelles.', 0x4369726375697420456c65637472697175652e706466, 2023),
(24, 'Convertisseur DC - DC ', 'Electro-lab', 'Science', NULL, 33, 'USD', 'dc-dc.png', 'Un convertisseur DC-DC est un dispositif électronique qui modifie une tension continue en une autre tension continue différente. Il permet de transformer efficacement les niveaux de tension tout en minimisant les pertes d\'énergie. Ces convertisseurs sont essentiels dans de nombreux appareils électroniques et systèmes d\'alimentation modernes.', 0x436f6e76657274697373657572732d44432d44432e706466, 2024),
(25, 'Électrostatiques électrocinétique ', 'ub-ele-I.S.S.A', 'Science', NULL, 12, 'USD', 'téléchargement.jpg', 'L\'électrostatique explore les phénomènes des charges électriques au repos, incluant les lois fondamentales de Coulomb et les champs électriques.\r\n\r\nL\'électrocinétique traite du mouvement des charges électriques dans les conducteurs, couvrant la loi d\'Ohm et les circuits électriques.\r\nCet ouvrage complet propose plus de 200 exercices corrigés et des applications pratiques pour maîtriser ces deux domaines essentiels de l\'électricité.', 0x64c3a96c656374726f73746174697175652dc3a96c656374726f63696ec3a974697175652e706466, 2023),
(26, 'Les circuit magnétique vol2', 'Electro-mEcan eneg', 'Science', NULL, 12, 'USD', 'Electromangetique.png', 'Un livre sur l\'électromagnétisme aborde fréquemment les lois fondamentales, comme celles de Coulomb et d\'Ohm, qui régissent les interactions entre charges électriques et courants. Il explore également les concepts de champ électrique et magnétique, en montrant comment ces champs interagissent pour produire des phénomènes comme les ondes électromagnétiques. Enfin, des applications pratiques telles que les moteurs électriques et les transformateurs illustrent l\'importance de l\'électromagnétisme dans la technologie moderne.', 0x454c54315f43697263756974735f6d61676ec3a97469717565732e706466, 2023),
(27, 'Le Transformateur vol2', 'Electro-mEcan eneg', 'Science', NULL, 12000, 'Fbu', 'Trans.jpg', 'L\'électrostatique explore les phénomènes des charges électriques au repos, incluant les lois fondamentales de Coulomb et les champs électriques.\r\n\r\nL\'électrocinétique traite du mouvement des charges électriques dans les conducteurs, couvrant la loi d\'Ohm et les circuits électriques.\r\nCet ouvrage complet propose plus de 200 exercices corrigés et des applications pratiques pour maîtriser ces deux domaines essentiels de l\'électricité.', 0x454c54315f5472616e73666f726d61746575722e706466, 2024),
(28, 'Énergie Renouvelable ', 'ElectricCenter', 'Science', NULL, 21000, 'Fbu', 'Energie.jpg', 'Les énergies renouvelables représentent l\'ensemble des sources d\'énergie naturelles et inépuisables, incluant le solaire, l\'éolien, l\'hydraulique et la biomasse.\r\n\r\nCe manuel explore les technologies modernes de conversion et de stockage d\'énergie, accompagné de schémas techniques et d\'études de cas réels.\r\n\r\nL\'ouvrage aborde également les enjeux environnementaux et économiques de la transition énergétique, avec des analyses détaillées de projets d\'installation et leur rentabilité.', 0x656e65726769657372656e6f7576656c61626c65735f66722e706466, 2022),
(29, 'Espace vectorielle (Math)', 'Ub-Math issa', 'Science', NULL, 3000, 'Fbu', 'Espace.jpg', 'L\'espace vectoriel constitue une structure mathématique fondamentale, présentant les concepts de vecteurs, de bases et de dimensions à travers des définitions rigoureuses et des théorèmes essentiels.\r\n\r\nL\'ouvrage développe les applications pratiques incluant les transformations linéaires, les matrices et les produits scalaires, enrichis d\'exemples concrets.\r\n\r\nUne collection complète d\'exercices corrigés accompagne chaque chapitre, permettant aux étudiants de maîtriser ces concepts clés de l\'algèbre linéaire.', 0x6578657263696365735f636f7272696765735f657370616365735f766563746f7269656c732e706466, 2022),
(30, 'Faisceau hertziens ', 'ub-ele-I.S.S.A', 'Science', NULL, 2000, 'Fbu', '1.jpg', 'Les faisceaux hertziens constituent un système de transmission d\'ondes radioélectriques à haute fréquence permettant la communication directionnelle point à point à travers l\'atmosphère.\r\n\r\nCet ouvrage détaille les aspects techniques essentiels : antennes paraboliques, propagation des micro-ondes, calculs de liaison et techniques de modulation numérique.\r\n\r\nCe guide pratique aborde également le dimensionnement des liaisons, la planification des fréquences et la maintenance des équipements, enrichi de cas concrets d\'installations professionnelles.', 0x666169736365617520686572747a69656e2e706466, 2022),
(31, 'Les Hacheurs', 'ub-ele-I.S.S.A', 'Science', NULL, 25000, 'Fbu', 'Hac 4 quadrant.png', 'Les hacheurs, convertisseurs statiques continu-continu, permettent la variation et le contrôle de la tension continue à travers des composants d\'électronique de puissance.\r\n\r\nL\'ouvrage explore les différentes structures de base (série, parallèle, quatre quadrants) et leurs principes de fonctionnement, accompagnés de schémas détaillés et d\'analyses des formes d\'ondes.\r\n\r\nLes applications industrielles sont largement couvertes, de la variation de vitesse des moteurs à courant continu jusqu\'aux systèmes d\'alimentation régulée, avec des exercices pratiques de dimensionnement.', 0x4c45532048414348455552532e706466, 2025),
(32, 'Les Onduleurs autonomes', 'Electro-mEcan eneg', 'Science', NULL, 6, 'USD', 'dc-dc.png', 'Les onduleurs autonomes sont des convertisseurs statiques transformant une tension continue en tension alternative de fréquence et d\'amplitude réglables, sans connexion au réseau électrique.\r\n\r\nL\'étude approfondie couvre les différentes structures (monophasées, triphasées), les techniques de commande MLI et les filtres de sortie, avec une analyse détaillée des performances harmoniques.\r\n\r\nLes applications pratiques abordent l\'alimentation des systèmes isolés, les UPS (alimentations sans interruption) et les énergies renouvelables, accompagnées de calculs de dimensionnement et de cas concrets.', 0x4c4553204f4e44554c45555253204155544f4e4f4d45532e706466, 2023),
(33, 'Les redresseur', 'ub-ele-I.S.S.A', 'Science', NULL, 22000, 'Fbu', 'Redresseur.png', 'Les redresseurs constituent une famille de convertisseurs statiques permettant la transformation de tensions alternatives en tensions continues.\r\n\r\nCe chapitre présente les différentes structures (monophasées, triphasées, commandées et non commandées) ainsi que leurs principes de fonctionnement fondamentaux.\r\n\r\nLes applications industrielles sont illustrées par des exemples concrets, accompagnés d\'une analyse des performances et du dimensionnement des composants', 0x4c45532052454452455353455552532e706466, 2014),
(34, 'Modulation analogique- Numerique', 'ub-ele-I.S.S.A', 'Informatique', NULL, 23000, 'Fbu', 'Mod A-N.png', 'Découvrez \"Modulations Analogiques et Numériques\", un ouvrage essentiel pour les passionnés d\'électronique et de traitement du signal. À travers des explications claires et des exemples concrets, cet ouvrage vous guide dans l\'univers complexe des modulations, alliant théorie et pratique. Parfait pour les étudiants et les professionnels, il vous permettra de maîtriser les concepts clés et d\'appliquer vos connaissances dans des projets innovants.', 0x4d4f44554c4154494f4e20414e414c4f4749515545204554204e554d455249515545207064662e706466, 2024),
(35, 'La physique générale ', 'Electro-mEcan eneg', 'Science', NULL, 4, 'USD', 'physique.jpg', 'Plongez dans \"Physique Générale\", un livre incontournable pour comprendre les fondamentaux de la physique moderne. Avec des explications accessibles et des illustrations captivantes, cet ouvrage couvre des thèmes essentiels tels que la mécanique, l\'électromagnétisme et la thermodynamique. Idéal pour les étudiants et les curieux, il vous permettra de développer une solide compréhension des lois qui régissent notre univers.', 0x706879736d6174686630336c617267652e706466, 2014),
(36, 'Concentration', 'HAVYARIMANA', 'Arts & Loisir', NULL, 20, 'USD', 'concentration.jpg', '\"Concentration\" est un guide pratique qui explore les techniques et stratégies pour améliorer votre capacité à vous concentrer. À travers des conseils basés sur des recherches scientifiques, l\'auteur propose des exercices et des méthodes de gestion du temps pour surmonter les distractions. Ce livre est idéal pour ceux qui souhaitent optimiser leur productivité et atteindre leurs objectifs personnels et professionnels.', 0x436f6e63656e74726174696f6e2e706466, 2025),
(37, 'DIEUX ET PHARAONS', 'MUGWANEZA', 'Arts & Loisir', NULL, 14, 'USD', '1.jpg', '\"Dieux et Pharaons Égyptiens\" est une exploration fascinante de la mythologie et de la religion de l\'Égypte ancienne. L\'ouvrage examine les principales divinités, leurs rôles et leurs symboles, tout en détaillant la relation étroite entre les pharaons et les puissances divines. À travers des récits captivants et des illustrations riches, ce livre offre une compréhension approfondie de l\'impact de la spiritualité sur la culture, l\'art et la vie quotidienne des anciens Égyptiens.', 0x44696575782065742050686172616f6e7320456779707469656e732e706466, 2025),
(38, 'Nombre sacre', 'Duse reine', 'Arts & Loisir', NULL, 30, 'USD', '3.jpg', '\"Les Nombres Sacrés\" est un ouvrage qui explore l\'importance et la signification des nombres dans diverses cultures et traditions spirituelles. Le livre examine comment certains nombres, comme le 3, le 7 et le 12, sont considérés comme ayant des pouvoirs mystiques et symboliques. À travers des analyses historiques et des exemples contemporains, il révèle comment ces nombres influencent la géométrie sacrée, les rituels et la philosophie, offrant ainsi une perspective fascinante sur la connexion entre mathématiques et spiritualité.', 0x676d37305f4c65734e6f6d627265735361637265732e706466, 2025),
(39, 'Nombre sacre', 'Duse reine', 'Arts & Loisir', NULL, 30, 'USD', '3.jpg', '\"Les Nombres Sacrés\" est un ouvrage qui explore l\'importance et la signification des nombres dans diverses cultures et traditions spirituelles. Le livre examine comment certains nombres, comme le 3, le 7 et le 12, sont considérés comme ayant des pouvoirs mystiques et symboliques. À travers des analyses historiques et des exemples contemporains, il révèle comment ces nombres influencent la géométrie sacrée, les rituels et la philosophie, offrant ainsi une perspective fascinante sur la connexion entre mathématiques et spiritualité.', 0x676d37305f4c65734e6f6d627265735361637265732e706466, 2025),
(40, 'signification des yeux', 'ayda', 'Arts & Loisir', NULL, 39, 'USD', 'téléchargement (1).jpg', '\"Signification des Yeux\" est un livre qui explore le symbolisme et l\'importance des yeux dans différentes cultures et traditions. L\'ouvrage examine comment les yeux sont perçus comme des fenêtres de l\'âme, véhiculant des émotions, des pensées et des vérités cachées. À travers des récits mythologiques, des analyses psychologiques et des études artistiques, le livre met en lumière le rôle des yeux dans la communication non verbale et leur signification spirituelle. Il invite le lecteur à réfléchir sur la manière dont notre perception et notre regard influencent notre compréhension du monde et des autres.', 0x4c61207369676e696669636174696f6e2064657320796575782020496ec3a873206574204777656e2e706466, 2025),
(41, 'la magie des noeuds', 'kiara crus', 'Arts & Loisir', NULL, 14, 'USD', 'téléchargement.jpg', '\"La Magie des Noeuds\" est un ouvrage qui explore l\'art ancien des nœuds et leur signification symbolique dans diverses cultures. Le livre présente les différentes techniques de nouage, tout en mettant en lumière le rôle des nœuds dans les rituels, la spiritualité et même la vie quotidienne.', 0x4c612d6d616769652d6465732d6e6f657564732d50737963686f6c6f6769652e706466, 2025),
(42, 'MAIN', 'zendaya', 'Arts & Loisir', NULL, 65, 'USD', 'téléchargement (2).jpg', 'La chiromancie, ou lecture des lignes de la main, est une pratique divinatoire qui interprète la forme, les lignes et les monts des mains pour révéler des aspects de la personnalité et des événements futurs. Les chiromanciens analysent des éléments tels que la ligne de vie, la ligne de cœur et la ligne de tête pour fournir des insights sur la santé, les relations et le chemin de vie. Cette discipline mêle art, intuition et tradition, offrant une perspective unique sur l\'individu.', 0x4c612d4d61696e2e706466, 2024),
(43, 'Recherche de sagesse', 'Imen Es', 'Arts & Loisir', NULL, 98, 'USD', 'Sagesse.jpg', 'Recherche de Sagesse est un ouvrage qui explore le cheminement vers la connaissance et la compréhension spirituelle. Il examine les enseignements de divers philosophes, sages et traditions spirituelles, soulignant l\'importance de la réflexion personnelle et de l\'expérience vécue. Ce livre invite les lecteurs à cultiver leur sagesse intérieure pour naviguer les défis de la vie avec clarté et compassion.', 0x686f6d6d6520c3a0206c6120726563686572636865206465206c6120736167657373652e706466, 2024),
(44, 'NOMBRES', 'kabebe', 'Arts & Loisir', NULL, 34, 'USD', 'téléchargement.jpg', 'Les Nombres\" est un livre qui explore l\'importance des nombres dans les mathématiques, la culture et la spiritualité. Il examine comment les nombres influencent notre vie quotidienne, des mathématiques pures aux concepts symboliques dans diverses traditions. ', 0x6e6f6d627265732e706466, 2024),
(45, 'POUVOIR INTERIEUR', 'DUSE', 'Arts & Loisir', NULL, 43, 'USD', 'téléchargement (3).jpg', '\"Pouvoir Intérieur\" est un livre qui examine la notion de force et de potentiel que chacun possède en soi. Il aborde des thèmes tels que la confiance en soi, la résilience et la maîtrise de ses émotions. À travers des exercices pratiques et des réflexions inspirantes, l\'ouvrage encourage les lecteurs à se reconnecter avec leur essence intérieure, à surmonter les obstacles et à vivre une vie pleine de sens et d\'authenticité.', 0x506f75766f697273696e74657269657572734e2e706466, 2023),
(46, 'Savoir se taire et parler', 'clo', 'Arts & Loisir', NULL, 18, 'USD', 'téléchargement (4).jpg', '\"Savoir se Taire et Parler\" est un ouvrage qui explore l\'art de la communication équilibrée. Il souligne l\'importance de choisir le bon moment pour s\'exprimer ou se retirer dans le silence. À travers des exemples et des réflexions, le livre montre comment la maîtrise de la parole et du silence peut renforcer les relations, favoriser la compréhension et permettre une meilleure écoute. Il invite les lecteurs à réfléchir sur le pouvoir des mots et l\'impact du silence dans leurs interactions quotidiennes.', 0x5361766f6972207365207461697265207361766f6972207061726c65722e706466, 2024),
(47, 'pleine conscience', 'vince nt', 'BD & Jeunesse', NULL, 297000, 'Fbu', 'téléchargement.jpg', '*Pleune Conscience* est un ouvrage qui explore la notion de conscience à travers divers prismes philosophiques et psychologiques. L\'auteur examine comment la conscience influence nos perceptions, nos actions et nos interactions avec le monde. En s\'appuyant sur des exemples concrets, il met en lumière les défis liés à la compréhension de soi et à la prise de décision. Ce livre invite à une réflexion profonde sur l\'importance de la conscience dans la quête de sens et d\'authenticité.', 0x416263206465206c6120706c65696e6520636f6e736369656e63652e706466, 2025),
(48, 'pleine conscience', 'vince nt', 'BD & Jeunesse', NULL, 297000, 'Fbu', 'téléchargement.jpg', '*Pleune Conscience* est un ouvrage qui explore la notion de conscience à travers divers prismes philosophiques et psychologiques. L\'auteur examine comment la conscience influence nos perceptions, nos actions et nos interactions avec le monde. En s\'appuyant sur des exemples concrets, il met en lumière les défis liés à la compréhension de soi et à la prise de décision. Ce livre invite à une réflexion profonde sur l\'importance de la conscience dans la quête de sens et d\'authenticité.', 0x416263206465206c6120706c65696e6520636f6e736369656e63652e706466, 2025),
(49, 'gestion stress', 'Mugisha Claude', 'BD & Jeunesse', NULL, 22900, 'Fbu', 'téléchargement (1).jpg', '1984 de George Orwell est un roman dystopique qui se déroule dans une société totalitaire où Big Brother surveille chaque aspect de la vie des citoyens. Le protagoniste, Winston Smith, travaille au Ministère de la Vérité, où il falsifie des documents historiques. En quête de liberté et de vérité, il commence une romance interdite et remet en question le régime oppressif. Le livre explore des thèmes comme la surveillance, la manipulation de la vérité et la perte d\'individualité.', 0x6174656c6965722d67657374696f6e2d7374726573732e706466, 2025),
(50, 'L\'Enfant de la Résistance ', 'Duse reine', 'BD & Jeunesse', NULL, 23000, 'USD', 'téléchargement (2).jpg', 'L\'Enfant de la Résistance est une bande dessinée qui se déroule pendant la Seconde Guerre mondiale en France. Elle suit les aventures de trois jeunes amis qui s\'engagent dans la lutte contre l\'occupation allemande. À travers des actions de sabotage et de résistance, ils découvrent le courage, la solidarité et les sacrifices nécessaires pour défendre leur liberté. La série met en lumière le rôle des enfants dans la résistance et les épreuves qu\'ils affrontent. C\'est une œuvre qui allie histoire et fiction, sensibilisant les lecteurs à la bravoure des jeunes durant cette période sombre.', 0x456e66616e74732d526573697374616e63652d646f73736965722d6c612d636c617373652e706466, 2025),
(51, 'princesse de cleve', 'Duse reine', 'BD & Jeunesse', NULL, 343556, 'Fbu', 'téléchargement.png', 'La Princesse de Clèves est un roman classique sur les passions et les dilemmes moraux à la cour de Henri II. L\'histoire suit Mademoiselle de Chartres, qui lutte entre son amour pour le duc de Nemours et sa volonté de rester fidèle à son mari.', 0x466c657572206475206d616c207072696e636573736520646520636c65766520766f6c312e706466, 2025),
(52, 'fleur du mal', 'Duse reine', 'BD & Jeunesse', NULL, 12000, 'USD', 'téléchargement (3).jpg', '*Les Fleurs du mal de Charles Baudelaire est un recueil de poèmes publié en 1857, explorant la beauté, la décadence et la dualité de l\'âme humaine. À travers des thèmes de l\'amour, de la mort et du mal, Baudelaire mêle lyrisme et mélancolie. L\'œuvre, à la fois admirée et controversée, est essentielle à la poésie moderne. Elle illustre la quête de sens dans un monde en mutation.', 0x466c657572206475206d616c20766f6c20322e706466, 2025),
(53, 'Habitudes de vie', 'Duse reine', 'BD & Jeunesse', NULL, 12, 'USD', 'téléchargement (4).jpg', '*Habitudes de vie* est un livre qui explore l\'impact des comportements quotidiens sur notre bien-être. L\'auteur met en avant l\'importance de l\'alimentation, de l\'exercice et du sommeil pour une vie saine. Il propose des stratégies concrètes pour intégrer des habitudes positives dans notre routine. Le livre souligne également l\'importance de la gestion du stress et de la santé mentale. En adoptant des habitudes saines, on peut améliorer sa qualité de vie et son bonheur général.', 0x68616269747564657364657669652e706466, 2025),
(54, 'Les Misérables ', 'victor hugo', 'BD & Jeunesse', NULL, 24, 'USD', 'téléchargement (5).jpg', 'Les Misérables est un roman emblématique de Victor Hugo, publié en 1862. L\'histoire suit Jean Valjean, un ancien forçat, qui cherche la rédemption après avoir purgé une peine de 19 ans pour avoir volé du pain.\r\n\r\nLe roman aborde des thèmes tels que la justice sociale, la misère, l\'amour et le sacrifice, tout en dépeignant la lutte entre le bien et le mal. On y croise des personnages mémorables comme Fantine, Cosette et Javert, le policier obsédé par la loi.', 0x4875676f2d6d6973657261626c65732d312e706466, 2025),
(55, 'orgueul et prejuges', 'jane austin', 'BD & Jeunesse', NULL, 345, 'USD', 'téléchargement (6).jpg', '*Orgueil et Préjugés* est un roman de Jane Austen publié en 1813. Il suit l’histoire d’Elizabeth Bennet, une jeune femme vive et indépendante, alors qu\'elle navigue dans les complexités des relations sociales et amoureuses en Angleterre. La tension entre Elizabeth et le riche Mr. Darcy illustre les thèmes de l\'orgueil, des préjugés et de la recherche de l\'amour véritable. À travers des dialogues brillants et des personnages mémorables, Austen critique les normes sociales de son époque.\r\n', 0x4a616e652061757374696e206e6f727468616e6765722061626265792e706466, 2025),
(56, 'Jerusalem', 'jane austin', 'BD & Jeunesse', NULL, 50, 'USD', 'téléchargement (7).jpg', 'Live à Jérusalem\" est un album captivant qui capture l\'énergie d\'un concert vibrant. Les artistes offrent une performance passionnée, mêlant des styles musicaux variés. Les morceaux évoquent des thèmes de paix et d\'unité, reflétant la richesse culturelle de Jérusalem. Les sonorités traditionnelles se marient avec des influences modernes, créant une atmosphère unique', 0x4a65727573616c656d2e706466, 2025),
(57, 'zohar1', 'albert paris', 'BD & Jeunesse', NULL, 4000, 'Fbu', 'téléchargement (9).jpg', 'La Clé de Zohar\" est une œuvre essentielle de la mystique juive, offrant une interprétation du Zohar, le texte fondamental de la Kabbale. Elle explore des concepts profonds tels que la nature de Dieu, l\'âme et l\'univers. L\'auteur met en lumière les symboles et les enseignements cachés, facilitant ainsi la compréhension des mystères divins. Ce texte invite à la réflexion spirituelle et à la quête de sagesse. En somme, il constitue un guide précieux pour ceux qui cherchent à approfondir leur connaissance de la spiritualité juive.', 0x4c61207072696e636573736520646520636c6576652e706466, 2025),
(58, 'reine de saba', 'albert paris', 'BD & Jeunesse', NULL, 56, 'USD', 'téléchargement (10).jpg', 'La Reine de Saba est une figure emblématique des récits bibliques et des légendes éthiopiennes. Elle est célèbre pour sa visite au roi Salomon, attirée par sa renommée et sa sagesse. Leur rencontre est souvent interprétée comme un échange culturel et spirituel riche. Selon la tradition, elle aurait donné naissance à un fils, Menahem, ancêtre de la dynastie éthiopienne.', 0x4c61207265696e6520646520736162612e706466, 2025),
(59, 'Le Haut de Hurle-Vent', 'Emily Brontë', 'BD & Jeunesse', NULL, 6, 'USD', 'téléchargement (11).jpg', 'Le Haut de Hurle-Vent est un roman d\'Emily Brontë, centré sur la passion tumultueuse entre Heathcliff et Catherine Earnshaw. Situé dans le Yorkshire, le récit explore les thèmes de l\'amour, de la vengeance et des conflits familiaux. Heathcliff, un orphelin, est à la fois un protagoniste tragique et un anti-héros, dont la quête de vengeance le consume. La nature sauvage du paysage reflète les émotions intenses des personnages.', 0x6c652068617574206465206875726c652d76656e742e706466, 2025),
(60, 'Les Aventures de Tom Sawyer', ' Mark Twain', 'BD & Jeunesse', NULL, 9, 'USD', 'téléchargement (12).jpg', 'Les Aventures de Tom Sawyer  est un roman de Mark Twain qui suit les escapades d\'un jeune garçon espiègle vivant sur les rives du Mississippi. Tom, connu pour son imagination débordante, se lance dans des aventures avec ses amis, notamment Huck Finn. Le récit aborde des thèmes comme l\'amitié, la liberté et les défis de l\'enfance.', 0x4c6573206176656e747572657320646520746f6d207361777965722e706466, 2025),
(62, 'Les Burgraves', 'Victor Hugo', 'BD & Jeunesse', NULL, 12, 'USD', 'images.jpg', 'Les Burgraves est une pièce de théâtre écrite par Victor Hugo, publiée en 1843. L\'œuvre explore les thèmes de la famille, de l\'honneur et de la destinée à travers l\'histoire d\'une noble famille en déclin. Le protagoniste, le seigneur de Burgrave, se débat avec les tensions entre ses idéaux et la réalité de son époque', 0x6c65735f6275726772617665735f4875676f5f4c542e706466, 2025),
(63, 'Marre au Diable', ' Paul Féval', 'BD & Jeunesse', NULL, 12, 'USD', 'téléchargement (13).jpg', 'Marre au Diable est une œuvre de l\'écrivain français Paul Féval, publiée en 1854. Ce roman fantastique mêle aventure et éléments surnaturels, suivant un héros qui lutte contre des forces obscures. L\'intrigue se déroule dans un cadre mystérieux, où le protagoniste doit affronter ses démons intérieurs et des adversaires redoutables', 0x6d6172652d61752d646961626c652e706466, 2025),
(64, 'Miracle de la Pleine Conscience', 'Thich Nhat Hanh', 'BD & Jeunesse', NULL, 13, 'USD', 'téléchargement (14).jpg', 'Miracle de la Pleine Conscience est un ouvrage de Thich Nhat Hanh, moine bouddhiste et maître zen, qui explore l\'art de vivre pleinement l\'instant présent. À travers des pratiques de méditation et des réflexions, l\'auteur invite à cultiver la pleine conscience dans la vie quotidienne. Le livre propose des techniques simples pour réduire le stress et développer une connexion profonde avec soi-même et les autres.', 0x4d697261636c65206465206c6120706c65696e6520636f6e736369656e63652e706466, 2024),
(65, 'Miracle de la Pleine Conscience', 'Thich Nhat Hanh', 'BD & Jeunesse', NULL, 13, 'USD', 'téléchargement (14).jpg', 'Miracle de la Pleine Conscience est un ouvrage de Thich Nhat Hanh, moine bouddhiste et maître zen, qui explore l\'art de vivre pleinement l\'instant présent. À travers des pratiques de méditation et des réflexions, l\'auteur invite à cultiver la pleine conscience dans la vie quotidienne. Le livre propose des techniques simples pour réduire le stress et développer une connexion profonde avec soi-même et les autres.', 0x4d697261636c65206465206c6120706c65696e6520636f6e736369656e63652e706466, 2024),
(66, 'Naruto', ' Masashi Kishimoto', 'BD & Jeunesse', NULL, 23, 'USD', 'images (1).jpg', 'Naruto est un manga et anime créé par Masashi Kishimoto, centré sur Naruto Uzumaki, un jeune ninja rêveur qui aspire à devenir Hokage, le chef de son village. Orphelin, il porte en lui le démon renard à neuf queues, ce qui le rend à la fois puissant et ostracisé. L\'histoire suit son parcours, ses amitiés et ses défis, tout en explorant des thèmes de la persévérance, de l\'identité et de l\'amitié', 0x4e617275746f2e706466, 2024),
(67, 'Naruto', ' Masashi Kishimoto', 'BD & Jeunesse', NULL, 23, 'USD', 'images (1).jpg', 'Naruto est un manga et anime créé par Masashi Kishimoto, centré sur Naruto Uzumaki, un jeune ninja rêveur qui aspire à devenir Hokage, le chef de son village. Orphelin, il porte en lui le démon renard à neuf queues, ce qui le rend à la fois puissant et ostracisé. L\'histoire suit son parcours, ses amitiés et ses défis, tout en explorant des thèmes de la persévérance, de l\'identité et de l\'amitié', 0x4e617275746f2e706466, 2024),
(68, 'roman apprentissage', 'victor hugo', 'BD & Jeunesse', NULL, 23, 'USD', 'téléchargement.jpg', 'st un ouvrage de Thich Nhat Hanh, moine bouddhiste et maître zen, qui explore l\'art de vivre pleinement l\'instant présent. À travers des pratiques de méditation et des réflexions, l\'auteur invite à cultiver la pleine conscience dans la vie quotidienne. Le livre propose des techniques simples pour réduire le stress et développer une connexion profonde avec soi-même et les autres', 0x526f6d616e2041707072656e7469737361676520646520766963746f72206d61757661697320706572652e706466, 2025),
(69, 'Petit Poilu', 'Pierre Bailly et Céline Fraipont', 'BD & Jeunesse', NULL, 21, 'USD', 'téléchargement (1).png', 'Petit Poilu est une bande dessinée pour enfants créée par Pierre Bailly et Céline Fraipont. Elle suit les aventures d\'un jeune garçon, Petit Poilu, qui se retrouve plongé dans un monde fantastique rempli d\'amis et d\'étranges créatures. Chaque histoire aborde des thèmes de l\'amitié, du courage et de la curiosité, tout en abordant des situations du quotidien avec humour et tendresse. ', 0x50726978206465206c69747465726174757265206c6520706574697420706f696c752e706466, 2024),
(70, 'Renard Lumière', 'M. de La Fontaine', 'BD & Jeunesse', NULL, 12, 'USD', 'téléchargement (15).jpg', 'Renard Lumière est un conte pour enfants écrit par M. de La Fontaine, qui met en scène un renard rusé et intelligent. Dans cette histoire, le renard utilise sa ruse pour surmonter des obstacles et atteindre ses objectifs. Le récit explore des thèmes tels que la sagesse, l\'ingéniosité et les conséquences de la tromperie', 0x52656e6172642d6c756d696572652e706466, 2024),
(71, 'Mauvais Père', 'La Débâcle', 'BD & Jeunesse', NULL, 33, 'USD', 'téléchargement (16).jpg', 'Mauvais Père est un roman graphique de Dufaux et de la dessinatrice de \"La Débâcle\", qui explore la relation complexe entre un père et son fils. À travers des flashbacks et des scènes contemporaines, l’histoire révèle les échecs parentaux et les conséquences émotionnelles d\'une éducation négligente. Le récit aborde des thèmes de culpabilité, de rédemption et de la quête d\'identité.', 0x526f6d616e2041707072656e7469737361676520646520766963746f72206d61757661697320706572652e706466, 2025),
(72, 'Rosyn', 'Rosyn', 'BD & Jeunesse', NULL, 34, 'USD', 'images (2).jpg', 'Rosyn est un roman de science-fiction qui plonge les lecteurs dans un univers futuriste riche en technologies avancées et en enjeux sociopolitiques. L’histoire suit un protagoniste confronté à des défis interstellaires, explorant des thèmes tels que l’identité, la survie et les conséquences de l\'ingérence humaine dans l\'univers. À travers des aventures palpitantes, le récit soulève des questions sur la moralité, la liberté et le sens de l\'humanité', 0x526f736e795f5265636974735f64655f736369656e63655f66696374696f6e5f312e706466, 2024),
(73, 'Songe d\'une nuit d\'été', 'William Shakespeare', 'BD & Jeunesse', NULL, 12, 'USD', 'téléchargement (17).jpg', 'Songe d\'une nuit d\'été est une comédie de William Shakespeare qui se déroule dans une forêt enchantée, où les destins de plusieurs personnages se croisent. L\'intrigue tourne autour de l\'amour, de la magie et des malentendus. Quatre jeunes amoureux fuient vers la forêt, où ils sont ensorcelés par des fées, notamment Puck, le farceur', 0x5368616b657370656172652d4c652d736f6e67652d64756e652d6e7569742d646574652e706466, 2024),
(74, 'Sur Terre comme au Ciel', 'christian signol', 'BD & Jeunesse', NULL, 20, 'USD', 'téléchargement (18).jpg', 'Sur Terre comme au Ciel est un ouvrage qui explore les concepts de spiritualité, de foi et de la relation entre l\'être humain et le divin. L\'auteur aborde la manière dont les principes spirituels peuvent influencer la vie quotidienne et les interactions humaines. À travers des réflexions philosophiques et des récits inspirants, le livre examine comment instaurer un règne divin sur Terre, en cultivant des valeurs telles que l\'amour, la compassion et la justice.', 0x53757220746572726520636f6d6d65206175206369657578207265676e652064652044696575782e706466, 2025),
(75, 'Tabula', 'christian signol', 'BD & Jeunesse', NULL, 20, 'USD', 'téléchargement (19).jpg', 'Tabula est une œuvre qui explore les thèmes de la mémoire, de l\'identité et de la réinvention de soi. Le récit suit un protagoniste confronté à un événement marquant qui remet en question son passé et sa perception de la réalité. À travers une narration riche en symbolisme et en métaphores, l\'auteur examine comment les expériences façonnent notre compréhension du mon', 0x546162756c615f323030345f345f465f4b6f6d706c65742e706466, 2025),
(76, 'Une Résistance à Arme Égale', 'Duse reine', 'BD & Jeunesse', NULL, 34, 'USD', 'téléchargement (20).jpg', 'Une Résistance à Arme Égale est un récit qui aborde les luttes sociales et politiques à travers les yeux de personnages engagés. L\'histoire se déroule dans un contexte de tensions croissantes, où des groupes marginalisés s\'organisent pour revendiquer leurs droits face à des oppresseurs puissants.', 0x756e655f726573697374616e63655f615f61726d65735f6567616c65735f323032345f7461707573637269745f302e706466, 2025),
(77, 'Yoga dans le cours de l\'esprit', 'André Van Lysebeth', 'BD & Jeunesse', NULL, 9, 'USD', 'téléchargement (21).jpg', 'Yoga dans le cours de l\'esprit: Cet ouvrage présente le yoga comme une voie d\'épanouissement personnel et de développement spirituel. André Van Lysebeth explore les différentes pratiques yogiques, telles que la méditation et les postures, en les reliant à des concepts philosophiques. Il insiste sur l\'importance de l\'harmonie entre le corps et l\'esprit pour atteindre un bien-être durable', 0x596f67612064616e73206c6520636f757273206465207265637265742e706466, 2025),
(78, 'Conception de Base en Construction', 'Jacques F. M. Dufresne', 'Construction', NULL, 5000, 'USD', 'téléchargement (22).jpg', 'Ce livre présente les principes fondamentaux de la conception architecturale et technique dans le domaine de la construction. L\'auteur aborde les étapes essentielles, allant de l\'analyse des besoins à la réalisation des plans, en mettant l\'accent sur l\'importance de la sécurité, de la durabilité et de l\'esthétique. Il explore également le choix des matériaux, les normes de construction et les considérations environnementales.', 0x436f6e63657074696f6e206465206261736520636f6e737472756374696f6e2e706466, 2025),
(79, 'Construction Civile', 'Paul A. S. Naoum', 'Construction', NULL, 13, 'USD', 'téléchargement.jpg', 'Construction Civile : Ce livre traite des principes fondamentaux et des pratiques de la construction civile. Il explore les différentes étapes du processus de construction, de la conception à la réalisation, en mettant l\'accent sur la gestion de projet, la planification et le contrôle des coûts. Naoum aborde également les enjeux contemporains, tels que la durabilité et l\'impact environnemental des projets', 0x436f6e7365696c7320667574757220697220636f6e737472756374696f6e20636976696c652e706466, 2025),
(80, 'Construction Générale', 'Francis D. K. Ching', 'Construction', NULL, 51, 'USD', 'téléchargement (1).jpg', 'Construction Générale : Ce livre offre une vue d\'ensemble complète des principes et pratiques de la construction. Ching aborde les différentes phases d\'un projet, de la conception à la réalisation, en mettant l\'accent sur les matériaux, les méthodes et les technologies utilisés. Il explore également les enjeux de la sécurité sur les chantiers et l\'importance de la gestion de projet.', 0x436f6e737472756374696f6e2067656e6572616c652e706466, 2024),
(81, 'Petit Bâtiment', 'Jean-Pierre B. Lemaire', 'Construction', NULL, 14, 'USD', 'téléchargement (2).jpg', 'Petit Bâtiment : Ce livre se concentre sur la conception et la construction de petits bâtiments, tels que les maisons individuelles et les structures légères. Lemaire aborde les aspects techniques, architecturaux et réglementaires, en fournissant des conseils pratiques pour les professionnels et les particuliers. Il examine également les choix de matériaux et les techniques de construction durables.', 0x47756964655f636f6e737472756374696f6e5f7065746974735f626174696d656e74735f6d61636f6e6e657269655f636861696e65652e706466, 2025),
(82, 'Procédés Généraux de Construction', 'Henri G. L. Dupont', 'Construction', NULL, 130, 'USD', 'téléchargement (3).jpg', 'Procédés Généraux de Construction : Cet ouvrage présente les étapes fondamentales de la construction, de la planification à la finition. Dupont explore les méthodes et techniques utilisées pour chaque phase, en mettant l\'accent sur l\'efficacité et la sécurité. Il aborde également l\'importance de la gestion de projet et de la collaboration entre les différents intervenants.', 0x4d30332d50726f63c3a964c3a9732d47c3a96ec3a9726175782d64652d636f6e737472756374696f6e2d5453474f2e706466, 2024);
INSERT INTO `livres` (`IdLivre`, `Titre`, `Auteur`, `Categorie`, `SubCategorie`, `Prix`, `Devise`, `Couverture`, `Resume`, `Fichier`, `DateEdit`) VALUES
(83, 'Matériaux Généraux de Construction', 'Matériaux Généraux de Construction', 'Construction', NULL, 12, 'USD', 'téléchargement (4).jpg', 'Matériaux Généraux de Construction : Cet ouvrage présente une analyse approfondie des matériaux utilisés dans le secteur de la construction, tels que le béton, l\'acier et le bois. Lavigne discute des propriétés, des applications et des normes de chaque matériau, ainsi que des tendances actuelles en matière de durabilité. Le livre inclut des illustrations et des exemples pratiques pour faciliter la compréhension', 0x4d6174c3a972696175782d64652d436f6e737472756374696f6e2d4c322d47432d424f5542454b4555522d546f7566696b2e706466, 2024),
(84, 'Règles de Construction', 'Pierre M. Fournier', 'Construction', NULL, 14, 'USD', 'téléchargement (5).jpg', 'Règles de Construction: Cet ouvrage explore les normes et réglementations essentielles à respecter dans la construction. Fournier aborde la sécurité structurelle, l\'accessibilité, et la durabilité environnementale, soulignant leur importance pour des projets réussis. Il fournit des exemples concrets et des études de cas pour illustrer l\'application de ces règles. En mettant l’accent sur la qualité des matériaux, l\'auteur guide les professionnels vers des pratiques responsables.', 0x5265676c6520646520636f6e737274756374696f6e2e706466, 2024),
(85, 'Techniques et Règles de Construction', 'Lucille A. Martin', 'Construction', NULL, 11, 'USD', 'téléchargement (6).jpg', 'Techniques et Règles de Construction : Dans cet ouvrage, Martin examine les méthodes de construction modernes tout en intégrant les règles essentielles à respecter. Elle aborde des techniques spécifiques, telles que la maçonnerie, la charpente et l\'installation des systèmes, en soulignant l\'importance de la sécurité et de la durabilité. L\'auteur illustre ses propos avec des exemples pratiques et des schémas clairs.', 0x746563686e69717565206574207265676520646520636f6e73637472756374696f6e2e706466, 2025),
(86, 'Technologie de Construction', 'Antoine J. Moreau', 'Construction', NULL, 14, 'USD', 'images.jpg', 'Technologie de Construction : Moreau explore les innovations technologiques qui transforment le secteur de la construction, telles que la modélisation 3D et les matériaux intelligents. Il analyse l\'impact de ces technologies sur l\'efficacité, la durabilité et la sécurité des projets. L\'ouvrage propose des études de cas illustrant l\'intégration réussie de ces innovations sur le terrain.', 0x546563686e6f6c6f676965206465206c6120636f6e737472756374696f6e2e706466, 2025),
(87, 'Société Le Froit', 'Jean-Claude R. Lefebvre', 'Entreprise et Droit', NULL, 15, 'USD', 'téléchargement (8).jpg', 'Société Le Froit : Cet ouvrage présente une analyse approfondie de la Société Le Froit, mettant en lumière son modèle économique et ses contributions à l\'industrie. Lefebvre explore les stratégies de croissance et d\'innovation adoptées par l\'entreprise, ainsi que son engagement envers la durabilité et la responsabilité sociale.', 0x323032322d5043522d303220536f6369c3a974c3a9204c652046726f69642d76657273696f6e207075626c697175652e706466, 2025),
(88, 'Société Le Froit', 'Jean-Claude R. Lefebvre', 'Entreprise et Droit', NULL, 15, 'USD', 'téléchargement (8).jpg', 'Société Le Froit : Cet ouvrage présente une analyse approfondie de la Société Le Froit, mettant en lumière son modèle économique et ses contributions à l\'industrie. Lefebvre explore les stratégies de croissance et d\'innovation adoptées par l\'entreprise, ainsi que son engagement envers la durabilité et la responsabilité sociale.', 0x323032322d5043522d303220536f6369c3a974c3a9204c652046726f69642d76657273696f6e207075626c697175652e706466, 2025),
(89, 'ABC du Droit International Public', 'Clara D. Rousseau', 'Entreprise et Droit', NULL, 13, 'USD', 'téléchargement.jpg', 'ABC du Droit International Public : Rousseau propose une introduction accessible aux principes fondamentaux du droit international public. L\'ouvrage couvre des thèmes essentiels, tels que la souveraineté des États, les droits de l\'homme et le droit des traités. À travers des explications claires et des exemples concrets, l\'auteur facilite la compréhension des concepts complexes.', 0x4142432d64752064726f697420696e7465726e6174696f6e616c207075626c69635f66722e706466, 2024),
(90, 'Odahat : Droit du Contrat', 'Émile J. Dufour', 'Entreprise et Droit', NULL, 7, 'USD', 'images.jpg', 'Odahat : Droit du Contrat : Dans cet ouvrage, Dufour explore les principes fondamentaux du droit des contrats, en mettant l\'accent sur les obligations des parties et la formation des accords. Il traite des différents types de contrats, des enjeux de la responsabilité et des recours en cas de litige. L\'auteur utilise des exemples pratiques pour illustrer les concepts juridiques et faciliter leur compréhension.', 0x4143544520554e49464f524d45204f4841444120535552204c452044524f49542044455320434f4e54524154532e706466, 2025),
(91, 'Les Affaires et le Droit', 'Marc T. Lemoine', 'Entreprise et Droit', NULL, 9, 'USD', 'téléchargement (1).jpg', 'Les Affaires et le Droit\" : Lemoine examine l\'interaction entre le monde des affaires et le cadre juridique qui le régit. Il aborde des thèmes tels que la création d\'entreprise, les contrats commerciaux, et la réglementation financière. L\'ouvrage met en lumière l\'importance du droit dans la gestion des risques et la protection des droits des entrepreneurs.', 0x4166616972652065742064656f69742e706466, 2024),
(92, 'Bilipo Détective', 'Philippe G. Marceau', 'Entreprise et Droit', NULL, 12, 'USD', 'téléchargement (2).jpg', 'Bilipo Détective : Marceau nous plonge dans l\'univers intrigant de Bilipo, un détective privé au flair exceptionnel. L\'histoire suit ses enquêtes captivantes, mêlant mystère et humour, alors qu\'il déjoue les complots et résout des affaires complexes. À travers une prose vivante, l\'auteur explore les thèmes de la vérité et de la justice, tout en offrant un aperçu du quotidien d\'un enquêteur', 0x62696c69706f5f6465746563746976655f313932395f303031312e706466, 2024),
(93, 'Code du Travail', 'Jean-Pierre Nkurunziza', 'Entreprise et Droit', NULL, 13, 'USD', 'téléchargement (3).jpg', 'Code du Travail : Dans cet ouvrage, Nkurunziza analyse en profondeur le Code du travail burundais, en expliquant ses dispositions clés et leur impact sur les relations de travail. L\'auteur met l\'accent sur la protection des droits des travailleurs, les obligations des employeurs, et les mécanismes de règlement des conflits', 0x427572756e64692d436f64652d323032302d7472617661696c2e706466, 2024),
(94, 'Burundi Labor Code', 'Jean-Pierre Nkurunziza', 'Entreprise et Droit', NULL, 6, 'EUR', 'téléchargement (4).jpg', 'Burundi Labor Code: Nkurunziza fournit une analyse complète du Code du travail du Burundi, détaillant ses principales dispositions et leur application dans le contexte local. L\'ouvrage aborde des thèmes essentiels tels que les droits des travailleurs, les obligations des employeurs, et les procédures de règlement des litiges. À travers des exemples concrets et des explications claires, l\'auteur illustre comment le Code vise à équilibrer les intérêts des parties tout en promouvant un environnement de travail équitable.', 0x427572756e64692d4c61626f722d436f64652e706466, 2024),
(95, 'Loi sur la Faillite', 'alter ego', 'Entreprise et Droit', NULL, 8, 'USD', 'téléchargement (5).jpg', 'Loi sur la Faillite : Dans cet ouvrage, Niyonzima examine les dispositions juridiques régissant la faillite au Burundi. Il aborde les procédures de déclaration de faillite, les droits et obligations des créanciers et débiteurs, ainsi que les mécanismes de redressement et de liquidation.', 0x427572756e64692d4c6f692d323030362d6661696c6c697465732e706466, 2024),
(96, 'Complexité des entreprises et responsabilité juridique', 'Marc B. Huyghe', 'Entreprise et Droit', NULL, 8, 'USD', 'images.png', 'Complexité des entreprises et responsabilité juridique : Huyghe examine les défis juridiques auxquels font face les entreprises modernes en raison de leur structure complexe. L\'ouvrage analyse comment la multiplicité des acteurs et des opérations peut engendrer des responsabilités juridiques variées, tant pour les dirigeants que pour les employés. L\'auteur plaide pour une meilleure compréhension des enjeux juridiques afin d\'anticiper et de gérer les risques', 0x636f6d706c69636974652064657320656e747265707269736520657420726573706f6e736162696c697465206a75726964757175652e706466, 2024),
(97, 'Droit pénal', 'Philippe D. Dufresne', 'Entreprise et Droit', NULL, 7, 'USD', 'téléchargement (7).jpg', 'Droit pénal : Dans cet ouvrage, Dufresne explore les principes fondamentaux du droit pénal, en abordant les notions de crime, délit, et contravention. Il analyse les différentes catégories d\'infractions, les peines encourues, ainsi que les droits des victimes et des accusés. L\'auteur met en lumière l\'importance de la légalité et de l\'équité dans le système judiciaire', 0x43524650412d323032302d44726f69742d50656e616c2d457874726169742d64652d666173636963756c652d64652d636f7572732e706466, 2024),
(98, 'Le Tour de Gaule', 'René Guitton', 'Entreprise et Droit', NULL, 9, 'USD', 'téléchargement (9).jpg', 'Le Tour de Gaule : Dans cet ouvrage, Guitton propose une exploration des régions de la France à travers le prisme de la culture et de l\'histoire. L\'auteur décrit un voyage métaphorique qui met en lumière la richesse des traditions locales, des paysages variés et des personnages emblématiques. En mêlant anecdotes personnelles et réflexions sur l\'identité française, il invite le lecteur à redécouvrir la diversité et la beauté du pays.', 0x64383130382d30352d617374657269782d6c652d746f75722d64652d6761756c652e706466, 2024),
(99, 'Droit Civil', 'Jean-Marie Auby', 'Entreprise et Droit', NULL, 12, 'USD', 'téléchargement (10).jpg', 'Droit Civil: Dans cet ouvrage, Auby présente une analyse approfondie des principes fondamentaux du droit civil, notamment en matière de contrats, de responsabilité, et de droit de la famille. Il explore les relations juridiques entre les individus et les implications de ces relations dans la vie quotidienne. L\'auteur met l\'accent sur l\'importance de la protection des droits des citoyens et des mécanismes de résolution des litiges.', 0x44726f697420436976696c2068616e64626f6f6b202d204652204d4153544552207265763120323032312d30362d30332e706466, 2024),
(100, 'Droit Constitutionnel', 'Louis Favoreu', 'Entreprise et Droit', NULL, 7, 'Fbu', 'téléchargement (11).jpg', 'Droit Constitutionnel: Dans cet ouvrage, Favoreu explore les principes fondamentaux du droit constitutionnel, en mettant l\'accent sur la structure et le fonctionnement des institutions politiques. Il analyse le rôle de la Constitution dans la protection des droits fondamentaux et l\'organisation des pouvoirs publics. L\'auteur aborde également les enjeux contemporains, tels que la séparation des pouvoirs et le contrôle de constitutionnalité.', 0x44726f697420636f6e737469747574696f6e6e656c202d205444203120696e74726f64756374696f6e5f636f6d707265737365642e706466, 2024),
(101, 'Droit de la Famille', 'Marie-Anne Frison-Roche', 'Entreprise et Droit', NULL, 12, 'USD', 'téléchargement (12).jpg', 'Droit de la Famille : Dans cet ouvrage, Frison-Roche analyse les différentes dimensions du droit de la famille, en abordant des thèmes tels que le mariage, le divorce, la filiation et la protection des mineurs. L\'auteur met en lumière l\'évolution des lois et des pratiques familiales, ainsi que les enjeux sociaux et juridiques qui en découlent. Elle souligne l\'importance de la protection des droits des membres de la famille dans un cadre juridique en constante mutation.', 0x44726f6974206465206c612066616d696c6c652e706466, 2024),
(102, 'Droit des Sociétés', 'Philippe G. S. Legrand', 'Entreprise et Droit', NULL, 10, 'USD', 'images.png', 'Droit des Sociétés : Dans cet ouvrage, Legrand explore les principes fondamentaux régissant le droit des sociétés, en se concentrant sur la création, le fonctionnement et la dissolution des entreprises. Il analyse les différentes formes juridiques de sociétés, leurs caractéristiques, ainsi que les droits et obligations des associés.', 0x44726f6974206465206c6120736f6369657474652e706466, 2025),
(103, 'Droit des Affaires', 'Jean-Pierre Thiévenaz', 'Entreprise et Droit', NULL, 15, 'USD', 'd1.jpg', 'Droit des Affaires: Dans cet ouvrage, Thiévenaz examine les principes clés du droit des affaires, en abordant les questions liées aux contrats commerciaux, à la responsabilité des entreprises, et à la réglementation des marchés. L\'auteur met en lumière les enjeux juridiques auxquels font face les acteurs économiques dans un environnement globalisé, notamment en ce qui concerne la concurrence, la propriété intellectuelle, et le droit fiscal.', 0x44726f6974206465732061666661697265732e706466, 2024),
(104, 'Droit Fiscal des Entreprises\'', 'Michel Bouvier', 'Entreprise et Droit', NULL, 12, 'USD', 'd2.jpg', 'Droit Fiscal des Entreprises: Dans cet ouvrage, Bouvier explore les principes fondamentaux du droit fiscal applicable aux entreprises, en analysant les différentes impositions auxquelles elles sont soumises. L\'auteur aborde des thèmes tels que l\'impôt sur les sociétés, la TVA, et les mécanismes de déduction fiscale.', 0x44726f69742066697363616c2064657320656e7472657072697365732e706466, 2024),
(105, 'Droit des Contrats', 'François Terré', 'Entreprise et Droit', NULL, 12, 'USD', 'd3.jpg', 'Droit des Contrats : Dans cet ouvrage, Terré offre une analyse détaillée des principes fondamentaux régissant le droit des contrats, en se concentrant sur la formation, l\'exécution et la rupture des contrats. Il examine les différents types de contrats, leurs caractéristiques, et les obligations des parties. L\'auteur aborde également les enjeux liés à la responsabilité contractuelle et aux recours en cas de non-respect des engagements.', 0x44524f49545f4445535f434f4e54524154532e706466, 2025),
(106, 'Droit du Marketing', 'Philippe Malaval', 'Entreprise et Droit', NULL, 12, 'USD', 'd4.jpg', '\"\\Droit du Marketing : Dans cet ouvrage, Malaval explore les enjeux juridiques liés au marketing, en examinant les lois et régulations qui encadrent les pratiques commerciales. Il aborde des thèmes essentiels tels que la protection des consommateurs, la publicité, les droits de propriété intellectuelle, et la concurrence déloyale. L\'auteur met en lumière les défis auxquels les entreprises sont confrontées dans un environnement en constante évolution, notamment avec l\'essor du marketing digital.', 0x64726f69745f44555f4d41524b4554494e475f323032305f5044462e706466, 2025),
(107, 'Faillite des Entreprises', 'Pierre Catala', 'Entreprise et Droit', NULL, 13, 'USD', 'd5.jpg', 'Faillite des Entreprises : Dans cet ouvrage, Catala analyse les différentes dimensions de la faillite des entreprises, en se concentrant sur les procédures collectives et les mécanismes de redressement. L\'auteur aborde les causes de la faillite, les droits des créanciers, et les implications pour les dirigeants.', 0x4661696c6c6974652d64657320656e7472657072697365732e706466, 2024),
(108, 'L\'Étranger', ' Albert Camus', 'Litterature', NULL, 24000, 'USD', 'a1.jpg', 'Dans L\'Étranger, Meursault, un homme indifférent aux conventions sociales, se retrouve au cœur d\'un meurtre sur une plage algérienne. Son procès met en lumière son aloofness et son incapacité à se conformer aux attentes de la société. Camus explore des thèmes de l\'absurdité et de l\'aliénation. L\'œuvre questionne la nature de l\'existence et le sens de la vie. Ce roman emblématique du XXe siècle illustre la philosophie existentialiste de l\'auteur.', 0x437972696c6c652e706466, 2025);

-- --------------------------------------------------------

--
-- Structure de la table `livres_payer`
--

CREATE TABLE `livres_payer` (
  `id` int(11) NOT NULL,
  `idClient` int(11) NOT NULL,
  `idLivre` int(11) NOT NULL,
  `date_paiement` timestamp NOT NULL DEFAULT current_timestamp(),
  `statut` enum('en_attente','confirme','refuse') DEFAULT 'en_attente',
  `message` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `livres_payer`
--

INSERT INTO `livres_payer` (`id`, `idClient`, `idLivre`, `date_paiement`, `statut`, `message`) VALUES
(1, 7, 2, '2025-02-09 20:08:01', 'refuse', 'En double'),
(2, 7, 1, '2025-02-09 20:08:01', 'refuse', 'Pas en stock pour le moments '),
(3, 7, 2, '2025-02-09 20:09:52', 'confirme', ''),
(4, 7, 1, '2025-02-09 20:09:52', 'confirme', ''),
(5, 7, 2, '2025-02-09 20:20:33', 'en_attente', NULL),
(6, 7, 2, '2025-02-09 20:21:29', 'en_attente', NULL),
(7, 7, 2, '2025-02-09 20:24:27', 'en_attente', NULL),
(8, 7, 2, '2025-02-09 20:27:57', 'confirme', ''),
(9, 7, 2, '2025-02-09 20:51:50', 'en_attente', NULL),
(10, 7, 26, '2025-02-09 21:06:19', 'en_attente', NULL),
(11, 7, 12, '2025-02-09 21:18:32', 'en_attente', NULL),
(12, 11, 1, '2025-02-09 21:36:09', 'confirme', ''),
(13, 11, 1, '2025-02-10 17:00:11', 'confirme', ''),
(14, 11, 1, '2025-02-10 18:07:19', 'en_attente', NULL),
(15, 11, 12, '2025-02-10 18:14:54', 'en_attente', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `message` varchar(255) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `scheduled_date` datetime DEFAULT NULL,
  `idclient` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `notifications`
--

INSERT INTO `notifications` (`id`, `message`, `date`, `scheduled_date`, `idclient`) VALUES
(3, 'En double', '2025-02-11 20:41:09', '2025-02-11 20:42:00', 10),
(4, 'salut', '2025-02-11 20:46:27', '2025-02-11 20:48:00', 10),
(5, 'Pas en stock pour le moments ', '2025-02-11 20:54:32', '2025-02-11 20:56:00', 10);

-- --------------------------------------------------------

--
-- Structure de la table `subcategorie`
--

CREATE TABLE `subcategorie` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `subcategorie`
--

INSERT INTO `subcategorie` (`id`, `name`, `category`) VALUES
(1, 'Développement web', 'Informatique'),
(2, 'Développement d\'applications', 'Informatique'),
(3, 'Outils de développement', 'Informatique'),
(4, 'Informatique d\'entreprise', 'Informatique'),
(5, 'Management des systèmes d\'information', 'Informatique'),
(6, 'Conception et développement web', 'Informatique'),
(7, 'Référencement de sites', 'Informatique'),
(8, 'Systèmes d\'exploitation (Windows, UNIX, Linux)', 'Informatique'),
(9, 'Hardware et matériels', 'Informatique'),
(10, 'Architecture des ordinateurs', 'Informatique'),
(11, 'Electronique pour l\'informatique', 'Informatique'),
(12, 'Mathématiques', 'Sciences'),
(13, 'Physique', 'Sciences'),
(14, 'Mécanique', 'Sciences'),
(15, 'Chimie', 'Sciences'),
(16, 'Sciences de la vie', 'Sciences'),
(17, 'Biologie', 'Sciences'),
(18, 'Sciences de la terre', 'Sciences'),
(19, 'Physique de l\'atmosphère et climatologie', 'Sciences'),
(20, 'Sismologie', 'Sciences'),
(21, 'Géologie', 'Sciences'),
(23, 'Electricité et électrotechnique', 'Sciences'),
(24, 'Electronique', 'Sciences'),
(25, 'Architecture', 'Construction'),
(26, 'Plans - Dessins', 'Construction'),
(27, 'Gros oeuvre et structure', 'Construction'),
(28, 'Construction béton, béton armé et précontraint', 'Construction'),
(29, 'Murs - Sols - Plafonds', 'Construction'),
(30, 'Ouvertures - Escalier - Ascenseur', 'Construction'),
(31, 'Chauffage - Ventilation - Cheminée', 'Construction'),
(32, 'Réhabilitation bâtiment', 'Construction'),
(33, 'Travaux publics', 'Construction'),
(34, 'Ouvrages d\'art - Génie civil', 'Construction'),
(35, 'Ponts', 'Construction'),
(36, 'Hydraulique - Travaux fluviaux et maritimes', 'Construction'),
(37, 'Urbanisme', 'Construction'),
(38, 'Economie', 'Entreprise'),
(39, 'Macroéconomie - Microéconomie', 'Entreprise'),
(40, 'Création d\'entreprise', 'Entreprise'),
(41, 'Consultant - Freelance - TPE - Etc.', 'Entreprise'),
(42, 'PME - Commerçant - Exportation', 'Entreprise'),
(43, 'Business plan', 'Entreprise'),
(44, 'Stratégie - Direction d\'entreprise', 'Entreprise'),
(45, 'Stratégie militaire et politique', 'Entreprise'),
(46, 'RH et formation', 'Entreprise'),
(47, 'Recrutement', 'Entreprise'),
(48, 'Evaluation', 'Entreprise'),
(49, 'Marketing et vente', 'Entreprise'),
(50, 'Management commercial', 'Entreprise'),
(51, 'Romans - Rentrée littéraire 2024', 'Littérature'),
(52, 'Policier - Thriller', 'Littérature'),
(53, 'Science Fiction - Fantasy', 'Littérature'),
(54, 'Roman historique', 'Littérature'),
(55, 'Humour', 'Littérature'),
(56, 'Théâtre', 'Littérature'),
(57, 'Poésie', 'Littérature'),
(58, 'Santé et bien-être', 'ViePratique'),
(59, 'Spiritualité', 'ViePratique'),
(60, 'Sport - Forme - Beauté', 'ViePratique'),
(61, 'Vie de famille', 'ViePratique'),
(62, 'Sexualité', 'ViePratique'),
(63, 'Séduction', 'ViePratique'),
(64, 'Couple', 'ViePratique'),
(65, 'Cuisine, Trucs et astuces', 'ViePratique'),
(66, 'Romans-Rentrée-littéraire', 'Jeunesse'),
(67, 'Policier - Thriller', 'Jeunesse'),
(68, 'Science Fiction_Fantesy', 'Jeunesse'),
(69, 'Roman historique', 'Jeunesse'),
(70, 'Humour', 'Jeunesse'),
(71, 'Théâtre', 'Jeunesse'),
(72, 'Poésie', 'Jeunesse');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`idAdmin`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- Index pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`idCategorie`),
  ADD KEY `idclient` (`idclient`),
  ADD KEY `IdLivre` (`IdLivre`);

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`IdCategorie`);

--
-- Index pour la table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`idclient`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Index pour la table `commandes`
--
ALTER TABLE `commandes`
  ADD PRIMARY KEY (`idCommande`),
  ADD KEY `idClient` (`idClient`),
  ADD KEY `idLivre` (`idLivre`);

--
-- Index pour la table `emprunts`
--
ALTER TABLE `emprunts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idClient` (`idClient`),
  ADD KEY `idLivre` (`idLivre`);

--
-- Index pour la table `historique_connexions`
--
ALTER TABLE `historique_connexions`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `informatique`
--
ALTER TABLE `informatique`
  ADD PRIMARY KEY (`IdInfo`);

--
-- Index pour la table `livreetudiant`
--
ALTER TABLE `livreetudiant`
  ADD PRIMARY KEY (`idLiv`);

--
-- Index pour la table `livres`
--
ALTER TABLE `livres`
  ADD PRIMARY KEY (`IdLivre`),
  ADD KEY `IdCategorie` (`Categorie`),
  ADD KEY `IdSubCategorie` (`SubCategorie`);

--
-- Index pour la table `livres_payer`
--
ALTER TABLE `livres_payer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idClient` (`idClient`),
  ADD KEY `idLivre` (`idLivre`);

--
-- Index pour la table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idclient` (`idclient`);

--
-- Index pour la table `subcategorie`
--
ALTER TABLE `subcategorie`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `admin`
--
ALTER TABLE `admin`
  MODIFY `idAdmin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `idCategorie` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `client`
--
ALTER TABLE `client`
  MODIFY `idclient` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `commandes`
--
ALTER TABLE `commandes`
  MODIFY `idCommande` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `emprunts`
--
ALTER TABLE `emprunts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `historique_connexions`
--
ALTER TABLE `historique_connexions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `informatique`
--
ALTER TABLE `informatique`
  MODIFY `IdInfo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `livreetudiant`
--
ALTER TABLE `livreetudiant`
  MODIFY `idLiv` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT pour la table `livres`
--
ALTER TABLE `livres`
  MODIFY `IdLivre` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;

--
-- AUTO_INCREMENT pour la table `livres_payer`
--
ALTER TABLE `livres_payer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `subcategorie`
--
ALTER TABLE `subcategorie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `commandes`
--
ALTER TABLE `commandes`
  ADD CONSTRAINT `commandes_ibfk_1` FOREIGN KEY (`idClient`) REFERENCES `client` (`idclient`),
  ADD CONSTRAINT `commandes_ibfk_2` FOREIGN KEY (`idLivre`) REFERENCES `livres` (`IdLivre`);

--
-- Contraintes pour la table `emprunts`
--
ALTER TABLE `emprunts`
  ADD CONSTRAINT `emprunts_ibfk_1` FOREIGN KEY (`idClient`) REFERENCES `client` (`idclient`),
  ADD CONSTRAINT `emprunts_ibfk_2` FOREIGN KEY (`idLivre`) REFERENCES `livres` (`IdLivre`);

--
-- Contraintes pour la table `livres_payer`
--
ALTER TABLE `livres_payer`
  ADD CONSTRAINT `livres_payer_ibfk_1` FOREIGN KEY (`idClient`) REFERENCES `client` (`idclient`),
  ADD CONSTRAINT `livres_payer_ibfk_2` FOREIGN KEY (`idLivre`) REFERENCES `livres` (`IdLivre`);

--
-- Contraintes pour la table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`idclient`) REFERENCES `client` (`idclient`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
