-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Mer 18 Novembre 2020 à 15:13
-- Version du serveur :  5.7.11
-- Version de PHP :  7.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `skyblog`
--

-- --------------------------------------------------------

--
-- Structure de la table `login_passeword`
--

CREATE TABLE `login_passeword` (
  `Id_Login` int(11) NOT NULL,
  `Identifiant` varchar(30) NOT NULL,
  `Passeword` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `login_passeword`
--

INSERT INTO `login_passeword` (`Id_Login`, `Identifiant`, `Passeword`) VALUES
(1, 'toto', '31f7a65e315586ac198bd798b6629ce4903d0899476d5741a9f32e2e521b6a66');

-- --------------------------------------------------------

--
-- Structure de la table `post`
--

CREATE TABLE `post` (
  `Id_post` varchar(20) NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  `Libelle_Image` varchar(40) NOT NULL,
  `post_date` datetime NOT NULL,
  `Commentaire` varchar(200) NOT NULL,
  `Titre` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `post`
--

INSERT INTO `post` (`Id_post`, `id_utilisateur`, `Libelle_Image`, `post_date`, `Commentaire`, `Titre`) VALUES
('5fb53544244a2', 1, '.', '2020-11-18 15:52:52', 'zebi', 'zebi');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `login_passeword`
--
ALTER TABLE `login_passeword`
  ADD PRIMARY KEY (`Id_Login`),
  ADD UNIQUE KEY `Identifiant` (`Identifiant`);

--
-- Index pour la table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`Id_post`),
  ADD KEY `id_utilisateur` (`id_utilisateur`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `login_passeword`
--
ALTER TABLE `login_passeword`
  MODIFY `Id_Login` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `post_ibfk_1` FOREIGN KEY (`id_utilisateur`) REFERENCES `login_passeword` (`Id_Login`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
