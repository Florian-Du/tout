-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Mar 10 Novembre 2020 à 13:36
-- Version du serveur :  5.7.11
-- Version de PHP :  7.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `uber_tkt`
--

-- --------------------------------------------------------

--
-- Structure de la table `ingredient`
--

CREATE TABLE `ingredient` (
  `id_ingredient` int(11) NOT NULL,
  `libelle` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `ingredient`
--

INSERT INTO `ingredient` (`id_ingredient`, `libelle`) VALUES
(1, 'pate_brise'),
(2, 'pomme_golden'),
(3, 'sucre_vanille'),
(4, 'beurre'),
(5, 'saumon'),
(6, 'bouillon'),
(7, 'vin_blanc'),
(8, 'oeuf'),
(9, 'riz'),
(10, 'epinard'),
(11, 'champignon'),
(12, 'echalotes'),
(13, 'citron'),
(14, 'bouquet_aneth'),
(15, 'bouquet_ciboulette'),
(16, 'poivre'),
(17, 'sel'),
(18, 'laitue'),
(19, 'parmesan'),
(20, 'pain'),
(21, 'huile'),
(22, 'farine'),
(23, 'gruyere_rape'),
(24, 'levure'),
(25, 'moutarde'),
(26, 'lardons');

-- --------------------------------------------------------

--
-- Structure de la table `login_passeword`
--

CREATE TABLE `login_passeword` (
  `id_personne` int(11) NOT NULL,
  `nom` varchar(20) NOT NULL,
  `mdp` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `login_passeword`
--

INSERT INTO `login_passeword` (`id_personne`, `nom`, `mdp`) VALUES
(1, 'Florian', 'florian');

-- --------------------------------------------------------

--
-- Structure de la table `origine`
--

CREATE TABLE `origine` (
  `id_origine` int(11) NOT NULL,
  `libelle` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `origine`
--

INSERT INTO `origine` (`id_origine`, `libelle`) VALUES
(1, 'Anglais'),
(2, 'Francais'),
(3, 'Allemand'),
(4, 'Espagnol'),
(5, 'Portugais'),
(6, 'Russe'),
(7, 'Mexique');

-- --------------------------------------------------------

--
-- Structure de la table `panier`
--

CREATE TABLE `panier` (
  `id_personne` int(11) NOT NULL,
  `id_plat` int(11) NOT NULL,
  `quantite` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `panier`
--

INSERT INTO `panier` (`id_personne`, `id_plat`, `quantite`) VALUES
(1, 1, 120);

-- --------------------------------------------------------

--
-- Structure de la table `plat`
--

CREATE TABLE `plat` (
  `id_plat` int(11) NOT NULL,
  `prix` int(11) NOT NULL,
  `libelle` varchar(20) NOT NULL,
  `id_origine` int(11) NOT NULL,
  `poids` int(11) NOT NULL,
  `id_type_plat` int(11) NOT NULL,
  `id_type_nourriture` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `plat`
--

INSERT INTO `plat` (`id_plat`, `prix`, `libelle`, `id_origine`, `poids`, `id_type_plat`, `id_type_nourriture`) VALUES
(1, 3, 'Tarte_aux_pommes', 1, 120, 4, 1),
(8, 10, 'Koulibiac', 6, 700, 3, 1),
(9, 5, 'Salade_cesar', 7, 150, 2, 3),
(10, 3, 'Cake_au_lardons', 1, 200, 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `plat_ingredient`
--

CREATE TABLE `plat_ingredient` (
  `id_ingredient` int(11) NOT NULL,
  `id_plat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `plat_ingredient`
--

INSERT INTO `plat_ingredient` (`id_ingredient`, `id_plat`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 8),
(8, 8),
(9, 8),
(11, 8),
(18, 9),
(19, 9),
(20, 9),
(4, 10),
(8, 10),
(22, 10),
(23, 10),
(24, 10);

-- --------------------------------------------------------

--
-- Structure de la table `type_nourriture`
--

CREATE TABLE `type_nourriture` (
  `id_type_nourriture` int(11) NOT NULL,
  `libelle` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `type_nourriture`
--

INSERT INTO `type_nourriture` (`id_type_nourriture`, `libelle`) VALUES
(1, 'Normal'),
(2, 'Vegan'),
(3, 'Vegetarien'),
(4, 'Halal'),
(5, 'Kacher');

-- --------------------------------------------------------

--
-- Structure de la table `type_plat`
--

CREATE TABLE `type_plat` (
  `id_type_plat` int(11) NOT NULL,
  `libelle` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `type_plat`
--

INSERT INTO `type_plat` (`id_type_plat`, `libelle`) VALUES
(1, 'Apero'),
(2, 'Entree'),
(3, 'Plat'),
(4, 'Dessert');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `ingredient`
--
ALTER TABLE `ingredient`
  ADD PRIMARY KEY (`id_ingredient`);

--
-- Index pour la table `login_passeword`
--
ALTER TABLE `login_passeword`
  ADD PRIMARY KEY (`id_personne`);

--
-- Index pour la table `origine`
--
ALTER TABLE `origine`
  ADD PRIMARY KEY (`id_origine`);

--
-- Index pour la table `panier`
--
ALTER TABLE `panier`
  ADD PRIMARY KEY (`id_personne`,`id_plat`),
  ADD KEY `id_plat` (`id_plat`);

--
-- Index pour la table `plat`
--
ALTER TABLE `plat`
  ADD PRIMARY KEY (`id_plat`),
  ADD KEY `id_type_nourriture_2` (`id_type_nourriture`),
  ADD KEY `id_origine` (`id_origine`) USING BTREE,
  ADD KEY `id_type_nourriture` (`id_type_nourriture`) USING BTREE,
  ADD KEY `id_type_plat` (`id_type_plat`) USING BTREE;

--
-- Index pour la table `plat_ingredient`
--
ALTER TABLE `plat_ingredient`
  ADD PRIMARY KEY (`id_ingredient`,`id_plat`),
  ADD KEY `id_plat` (`id_plat`);

--
-- Index pour la table `type_nourriture`
--
ALTER TABLE `type_nourriture`
  ADD PRIMARY KEY (`id_type_nourriture`);

--
-- Index pour la table `type_plat`
--
ALTER TABLE `type_plat`
  ADD PRIMARY KEY (`id_type_plat`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `ingredient`
--
ALTER TABLE `ingredient`
  MODIFY `id_ingredient` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT pour la table `login_passeword`
--
ALTER TABLE `login_passeword`
  MODIFY `id_personne` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `origine`
--
ALTER TABLE `origine`
  MODIFY `id_origine` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT pour la table `plat`
--
ALTER TABLE `plat`
  MODIFY `id_plat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT pour la table `type_nourriture`
--
ALTER TABLE `type_nourriture`
  MODIFY `id_type_nourriture` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `type_plat`
--
ALTER TABLE `type_plat`
  MODIFY `id_type_plat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `panier`
--
ALTER TABLE `panier`
  ADD CONSTRAINT `panier_ibfk_1` FOREIGN KEY (`id_plat`) REFERENCES `plat` (`id_plat`),
  ADD CONSTRAINT `panier_ibfk_2` FOREIGN KEY (`id_personne`) REFERENCES `login_passeword` (`id_personne`);

--
-- Contraintes pour la table `plat`
--
ALTER TABLE `plat`
  ADD CONSTRAINT `plat_ibfk_2` FOREIGN KEY (`id_origine`) REFERENCES `origine` (`id_origine`),
  ADD CONSTRAINT `plat_ibfk_3` FOREIGN KEY (`id_type_plat`) REFERENCES `type_plat` (`id_type_plat`),
  ADD CONSTRAINT `plat_ibfk_4` FOREIGN KEY (`id_type_nourriture`) REFERENCES `type_nourriture` (`id_type_nourriture`);

--
-- Contraintes pour la table `plat_ingredient`
--
ALTER TABLE `plat_ingredient`
  ADD CONSTRAINT `plat_ingredient_ibfk_2` FOREIGN KEY (`id_plat`) REFERENCES `plat` (`id_plat`),
  ADD CONSTRAINT `plat_ingredient_ibfk_3` FOREIGN KEY (`id_ingredient`) REFERENCES `ingredient` (`id_ingredient`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
