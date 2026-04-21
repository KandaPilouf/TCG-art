-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le : sam. 28 fév. 2026 à 07:29
-- Version du serveur : 8.0.44
-- Version de PHP : 8.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `tgc_card_art`
--

-- --------------------------------------------------------

--
-- Structure de la table `card`
--

CREATE TABLE `card` (
  `id` int NOT NULL COMMENT 'id pk',
  `name` varchar(300) NOT NULL,
  `artist` varchar(100) NOT NULL,
  `style_id` int NOT NULL COMMENT 'style fk',
  `universe_id` int NOT NULL COMMENT 'universe fk',
  `creation_date` date DEFAULT NULL COMMENT 'date of creation',
  `variant_id` int NOT NULL COMMENT 'variant fk',
  `tag_id` int NOT NULL COMMENT 'tag fk',
  `primary_color_id` int NOT NULL COMMENT 'primary color fk'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `card_deck`
--

CREATE TABLE `card_deck` (
  `id_card` int NOT NULL COMMENT 'card id fk',
  `id_deck` int NOT NULL COMMENT 'deck id fk'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `card_tag`
--

CREATE TABLE `card_tag` (
  `id_card` int NOT NULL COMMENT 'card id fk',
  `id_tag` int NOT NULL COMMENT 'tag id fk',
  `id` int NOT NULL COMMENT 'id pk'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `color`
--

CREATE TABLE `color` (
  `id` int NOT NULL COMMENT 'id pk',
  `color` varchar(100) NOT NULL COMMENT 'card primary color'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `color`
--

INSERT INTO `color` (`id`, `color`) VALUES
(1, 'red');

-- --------------------------------------------------------

--
-- Structure de la table `deck`
--

CREATE TABLE `deck` (
  `id` int NOT NULL COMMENT 'id pk',
  `id_user` int NOT NULL COMMENT 'user fk',
  `id_card_deck` int NOT NULL,
  `name` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

CREATE TABLE `message` (
  `id` int NOT NULL COMMENT 'id pk',
  `user_id` int DEFAULT NULL COMMENT 'user fk',
  `card_id` int NOT NULL COMMENT 'card fk',
  `mess` text NOT NULL,
  `status` tinyint(1) NOT NULL COMMENT 'assigne/not assigned'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `style`
--

CREATE TABLE `style` (
  `id` int NOT NULL COMMENT 'id pk',
  `style` varchar(100) NOT NULL COMMENT 'card primary style'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `style`
--

INSERT INTO `style` (`id`, `style`) VALUES
(1, 'High-fantasy');

-- --------------------------------------------------------

--
-- Structure de la table `tag`
--

CREATE TABLE `tag` (
  `id` int NOT NULL COMMENT 'id pk',
  `tag` varchar(100) NOT NULL COMMENT 'card tag'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `tag`
--

INSERT INTO `tag` (`id`, `tag`) VALUES
(1, 'Crossbow');

-- --------------------------------------------------------

--
-- Structure de la table `universe`
--

CREATE TABLE `universe` (
  `id` int NOT NULL COMMENT 'is pk',
  `universe` varchar(100) NOT NULL COMMENT 'card primary universe'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `universe`
--

INSERT INTO `universe` (`id`, `universe`) VALUES
(1, 'Runeterra');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL COMMENT 'pk id',
  `name` varchar(100) NOT NULL COMMENT 'user name',
  `email` varchar(300) NOT NULL COMMENT 'user email',
  `pass` varchar(100) NOT NULL COMMENT 'pass cryptic'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `variant`
--

CREATE TABLE `variant` (
  `id` int NOT NULL COMMENT 'id pk',
  `variant` varchar(100) NOT NULL COMMENT 'card variation'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `variant`
--

INSERT INTO `variant` (`id`, `variant`) VALUES
(1, 'Rare');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `card`
--
ALTER TABLE `card`
  ADD PRIMARY KEY (`id`),
  ADD KEY `primary_color_id` (`primary_color_id`),
  ADD KEY `style_id` (`style_id`),
  ADD KEY `universe_id` (`universe_id`),
  ADD KEY `variant_id` (`variant_id`),
  ADD KEY `card_ibfk_3` (`tag_id`);

--
-- Index pour la table `card_deck`
--
ALTER TABLE `card_deck`
  ADD PRIMARY KEY (`id_card`,`id_deck`),
  ADD KEY `id_deck` (`id_deck`);

--
-- Index pour la table `card_tag`
--
ALTER TABLE `card_tag`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_card` (`id_card`),
  ADD KEY `id_tag` (`id_tag`);

--
-- Index pour la table `color`
--
ALTER TABLE `color`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `deck`
--
ALTER TABLE `deck`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Index pour la table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`),
  ADD KEY `card_id` (`card_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Index pour la table `style`
--
ALTER TABLE `style`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `tag`
--
ALTER TABLE `tag`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `universe`
--
ALTER TABLE `universe`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `variant`
--
ALTER TABLE `variant`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `card`
--
ALTER TABLE `card`
  MODIFY `id` int NOT NULL AUTO_INCREMENT COMMENT 'id pk', AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `card_tag`
--
ALTER TABLE `card_tag`
  MODIFY `id` int NOT NULL AUTO_INCREMENT COMMENT 'id pk';

--
-- AUTO_INCREMENT pour la table `color`
--
ALTER TABLE `color`
  MODIFY `id` int NOT NULL AUTO_INCREMENT COMMENT 'id pk', AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `deck`
--
ALTER TABLE `deck`
  MODIFY `id` int NOT NULL AUTO_INCREMENT COMMENT 'id pk';

--
-- AUTO_INCREMENT pour la table `message`
--
ALTER TABLE `message`
  MODIFY `id` int NOT NULL AUTO_INCREMENT COMMENT 'id pk';

--
-- AUTO_INCREMENT pour la table `style`
--
ALTER TABLE `style`
  MODIFY `id` int NOT NULL AUTO_INCREMENT COMMENT 'id pk', AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `tag`
--
ALTER TABLE `tag`
  MODIFY `id` int NOT NULL AUTO_INCREMENT COMMENT 'id pk', AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `universe`
--
ALTER TABLE `universe`
  MODIFY `id` int NOT NULL AUTO_INCREMENT COMMENT 'is pk', AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT COMMENT 'pk id';

--
-- AUTO_INCREMENT pour la table `variant`
--
ALTER TABLE `variant`
  MODIFY `id` int NOT NULL AUTO_INCREMENT COMMENT 'id pk', AUTO_INCREMENT=2;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `card`
--
ALTER TABLE `card`
  ADD CONSTRAINT `card_ibfk_1` FOREIGN KEY (`primary_color_id`) REFERENCES `color` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `card_ibfk_2` FOREIGN KEY (`style_id`) REFERENCES `style` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `card_ibfk_3` FOREIGN KEY (`tag_id`) REFERENCES `card_tag` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `card_ibfk_4` FOREIGN KEY (`universe_id`) REFERENCES `universe` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `card_ibfk_5` FOREIGN KEY (`variant_id`) REFERENCES `variant` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Contraintes pour la table `card_deck`
--
ALTER TABLE `card_deck`
  ADD CONSTRAINT `card_deck_ibfk_1` FOREIGN KEY (`id_card`) REFERENCES `card` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `card_deck_ibfk_2` FOREIGN KEY (`id_deck`) REFERENCES `deck` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Contraintes pour la table `card_tag`
--
ALTER TABLE `card_tag`
  ADD CONSTRAINT `card_tag_ibfk_1` FOREIGN KEY (`id_card`) REFERENCES `card` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `card_tag_ibfk_2` FOREIGN KEY (`id_tag`) REFERENCES `tag` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Contraintes pour la table `deck`
--
ALTER TABLE `deck`
  ADD CONSTRAINT `deck_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Contraintes pour la table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `message_ibfk_1` FOREIGN KEY (`card_id`) REFERENCES `card` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `message_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
