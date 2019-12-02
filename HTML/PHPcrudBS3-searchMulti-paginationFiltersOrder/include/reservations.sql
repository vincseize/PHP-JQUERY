-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  lun. 02 déc. 2019 à 04:28
-- Version du serveur :  10.1.36-MariaDB
-- Version de PHP :  7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `booking`
--

-- --------------------------------------------------------

--
-- Structure de la table `chambres`
--

CREATE TABLE `chambres` (
  `id` int(6) UNSIGNED NOT NULL,
  `numero` varchar(30) NOT NULL,
  `id_hotel` int(6) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `chambres`
--

INSERT INTO `chambres` (`id`, `numero`, `id_hotel`, `created`) VALUES
(1, '1', 3, '2019-11-28 18:21:38'),
(2, '2', 2, '2019-11-28 18:21:38'),
(3, '3', 1, '2019-11-28 18:21:38'),
(4, '4', 1, '2019-11-28 18:21:38'),
(5, '5', 1, '2019-11-28 18:21:38'),
(6, '6', 5, '2019-11-28 18:21:38'),
(7, '7', 1, '2019-11-28 18:21:38'),
(8, '8', 4, '2019-11-28 18:21:38'),
(9, '9', 4, '2019-11-28 18:21:38'),
(10, '10', 4, '2019-11-28 18:21:38'),
(11, '11', 2, '2019-11-28 18:21:39'),
(12, '12', 3, '2019-11-28 18:21:39'),
(13, '13', 3, '2019-11-28 18:21:39'),
(14, '14', 1, '2019-11-28 18:21:39'),
(15, '15', 5, '2019-11-28 18:21:39'),
(16, '16', 3, '2019-11-28 18:21:39'),
(17, '17', 1, '2019-11-28 18:21:39'),
(18, '18', 4, '2019-11-28 18:21:39'),
(19, '19', 4, '2019-11-28 18:21:39'),
(20, '20', 5, '2019-11-28 18:21:39');

-- --------------------------------------------------------

--
-- Structure de la table `clients`
--

CREATE TABLE `clients` (
  `id` int(6) UNSIGNED NOT NULL,
  `nom` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `adresse` text,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `clients`
--

INSERT INTO `clients` (`id`, `nom`, `email`, `adresse`, `created`) VALUES
(1, 'NOM', 'EMAIL', NULL, '2019-11-28 18:27:56'),
(2, 'NOM2', 'EMAIL2', NULL, '2019-11-28 22:41:07'),
(3, 'NOM2', 'lapin-cretins-tutur@mail.com', NULL, '2019-11-29 00:28:45'),
(4, 'NOM1', 'lapin-cretins-tatar@mail.com', NULL, '2019-11-29 01:15:45'),
(5, 'NOM4', 'lapin@mail.com', NULL, '2019-11-29 12:18:15'),
(6, 'NOM4', 'lapin-cretin-tatar@mail.com', NULL, '2019-11-29 12:21:51'),
(7, 'NOM5', 'lapin-cretin-teter@mail.com', NULL, '2019-11-29 12:24:43'),
(8, 'NOM1', 'lapin-cretin-totor@mail.com', NULL, '2019-11-29 13:18:45');

-- --------------------------------------------------------

--
-- Structure de la table `hotels`
--

CREATE TABLE `hotels` (
  `id` int(6) UNSIGNED NOT NULL,
  `nom` varchar(30) NOT NULL,
  `adresse` text,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `hotels`
--

INSERT INTO `hotels` (`id`, `nom`, `adresse`, `created`) VALUES
(1, 'HOTEL 1', 'Adresse 1', '2019-11-28 18:21:36'),
(2, 'HOTEL 2', 'Adresse 2', '2019-11-28 18:21:36'),
(3, 'HOTEL 3', 'Adresse 3', '2019-11-28 18:21:37'),
(4, 'HOTEL 4', 'Adresse 4', '2019-11-28 18:21:37'),
(5, 'HOTEL 5', 'Adresse 5', '2019-11-28 18:21:37');

-- --------------------------------------------------------

--
-- Structure de la table `reservations`
--

CREATE TABLE `reservations` (
  `id` int(6) UNSIGNED NOT NULL,
  `id_client` int(6) NOT NULL,
  `id_chambre` int(6) NOT NULL,
  `nom` varchar(64) NOT NULL,
  `email` varchar(64) NOT NULL,
  `debut` varchar(30) NOT NULL,
  `fin` varchar(30) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `reservations`
--

INSERT INTO `reservations` (`id`, `id_client`, `id_chambre`, `nom`, `email`, `debut`, `fin`, `created`) VALUES
(28, 0, 0, 'tatar346', '', '', '', '2019-12-02 00:25:46'),
(29, 0, 0, 'toto', '', '', '', '2019-12-02 00:59:57'),
(30, 0, 0, 'tatar22', 'memoirevivequartiernord@gmail.com', '', '', '2019-12-02 01:05:54'),
(32, 0, 0, 'frehuu', 'tatar22@gmail.com', '', '', '2019-12-02 01:12:24'),
(35, 0, 0, 'titi tatar', 'demo@example.com', '', '', '2019-12-02 02:24:38'),
(37, 0, 0, 'za', 'karlova.taare@facebook.com', '', '', '2019-12-02 02:40:32'),
(38, 0, 0, 'za', 'vincseize@gmail.com', '', '', '2019-12-02 03:02:19'),
(39, 0, 0, 'za', 'vincseize@gmail.com', '', '', '2019-12-02 03:02:38');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `chambres`
--
ALTER TABLE `chambres`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `hotels`
--
ALTER TABLE `hotels`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `chambres`
--
ALTER TABLE `chambres`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT pour la table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `hotels`
--
ALTER TABLE `hotels`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
