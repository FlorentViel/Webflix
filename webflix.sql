-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  lun. 29 oct. 2018 à 17:22
-- Version du serveur :  10.1.26-MariaDB
-- Version de PHP :  7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `webflix`
--

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

CREATE TABLE `category` (
  `idcategory` int(11) NOT NULL,
  `name` varchar(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `category`
--

INSERT INTO `category` (`idcategory`, `name`) VALUES
(1, 'Action'),
(2, 'Horreur'),
(3, 'Aventure'),
(4, 'Animation');

-- --------------------------------------------------------

--
-- Structure de la table `movie`
--

CREATE TABLE `movie` (
  `id` int(11) NOT NULL,
  `title` varchar(75) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `video_link` varchar(255) DEFAULT NULL,
  `cover` varchar(75) DEFAULT NULL,
  `category_idcategory` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `movie`
--

INSERT INTO `movie` (`id`, `title`, `description`, `video_link`, `cover`, `category_idcategory`) VALUES
(1, 'James Bond casino royal', 'Omne recreati omne quae adventu propinquabant nec iuventutis retroque quiete vicos sedibus iuventutis equestrium abierat opulentos casu retroque adventu concedentes casu recreati recreati acciverunt robur omne recreati acciverunt quae digressi.', 'https://www.youtube.com/embed/O1CzgULNRG', 'acciverunt ', 1),
(2, 'Avatar', 'Omne recreati omne quae adventu propinquabant nec iuventutis retroque quiete vicos sedibus iuventutis equestrium abierat opulentos casu retroque adventu concedentes casu recreati recreati acciverunt robur omne recreati acciverunt quae digressi.', 'https://www.youtube.com/embed/O1CzgULNRG', 'acciverunt ', 2),
(3, 'Le roi lion', 'Omne recreati omne quae adventu propinquabant nec iuventutis retroque quiete vicos sedibus iuventutis equestrium abierat opulentos casu retroque adventu concedentes casu recreati recreati acciverunt robur omne recreati acciverunt quae digressi.', 'https://www.youtube.com/embed/O1CzgULNRG', 'acciverunt ', 1),
(4, 'Exorciste', 'Omne recreati omne quae adventu propinquabant nec iuventutis retroque quiete vicos sedibus iuventutis equestrium abierat opulentos casu retroque adventu concedentes casu recreati recreati acciverunt robur omne recreati acciverunt quae digressi.', 'https://www.youtube.com/embed/O1CzgULNRG', 'acciverunt ', 4),
(5, 'Walker, Texas Ranger', 'Omne recreati omne quae adventu propinquabant nec iuventutis retroque quiete vicos sedibus iuventutis equestrium abierat opulentos casu retroque adventu concedentes casu recreati recreati acciverunt robur omne recreati acciverunt quae digressi.', 'https://www.youtube.com/embed/1NuIfInlBII', 'acciverunt ', 2);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `iduser` int(11) NOT NULL,
  `username` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `token` varchar(255) NOT NULL,
  `token_expiration` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`idcategory`);

--
-- Index pour la table `movie`
--
ALTER TABLE `movie`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_movie_category_idx` (`category_idcategory`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`iduser`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
