-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : sam. 13 juin 2026 à 13:17
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
-- Base de données : `tcg_card_art`
--

-- --------------------------------------------------------

--
-- Structure de la table `card`
--

CREATE TABLE `card` (
  `id` int(11) NOT NULL COMMENT 'id pk',
  `name` varchar(300) NOT NULL,
  `slug` varchar(200) NOT NULL,
  `artist` varchar(100) NOT NULL,
  `img` varchar(250) NOT NULL,
  `style_id` int(11) DEFAULT NULL COMMENT 'style fk',
  `universe_id` int(11) DEFAULT NULL COMMENT 'universe fk',
  `creation_date` date DEFAULT NULL COMMENT 'date of creation',
  `variant_id` int(11) DEFAULT NULL COMMENT 'variant fk',
  `primary_color_id` int(11) DEFAULT NULL COMMENT 'primary color fk'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `card`
--

INSERT INTO `card` (`id`, `name`, `slug`, `artist`, `img`, `style_id`, `universe_id`, `creation_date`, `variant_id`, `primary_color_id`) VALUES
(3, 'something cool', 'something_cool', 'Sami Khan', 'https://cards.scryfall.io/large/front/5/b/5b11ec26-9e07-45e1-bcaa-5d44d1231586.jpg?1738356473https://cards.scryfall.io/large/front/5/b/5b11ec26-9e07-45e1-bcaa-5d44d1231586.jpg?1738356473', 1, 1, '2026-05-23', 1, 1),
(4, 'Scorching Dragonfire', 'scorching_dragonfire', 'Eric Velhagen', 'https://cards.scryfall.io/large/front/3/b/3b74a806-ed74-458e-8903-d3d084e9f507.jpg?1636491470', 1, 1, '2026-05-23', 1, 1),
(5, 'Surfing Pikachu VMAX', 'surfing_pikachu_VMAX', 'aky CG Works', 'https://limitlesstcg.nyc3.cdn.digitaloceanspaces.com/tpci/CEL/CEL_009_R_EN_LG.png', 2, 2, '2021-10-20', 1, 2),
(7, 'helo', 'helo', 'helo', 'https://limitlesstcg.nyc3.cdn.digitaloceanspaces.com/tpci/VIV/VIV_044_R_EN_LG.png', NULL, NULL, NULL, NULL, NULL),
(8, 'test', 'test', 'test', 'https://limitlesstcg.nyc3.cdn.digitaloceanspaces.com/tpci/SP/SP_039_R_EN_LG.png', NULL, NULL, NULL, NULL, NULL),
(9, 'something crazy', 'something_crazy', 'someone crazy', 'https://cards.scryfall.io/large/front/b/b/bbf5e27b-b1ab-470c-8204-146032e26b5b.jpg?1562417378', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `card_deck`
--

CREATE TABLE `card_deck` (
  `id_card` int(11) NOT NULL COMMENT 'card id fk',
  `id_deck` int(11) NOT NULL COMMENT 'deck id fk'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `card_tag`
--

CREATE TABLE `card_tag` (
  `id_card` int(11) NOT NULL COMMENT 'card id fk',
  `id_tag` int(11) NOT NULL COMMENT 'tag id fk'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `card_tag`
--

INSERT INTO `card_tag` (`id_card`, `id_tag`) VALUES
(3, 1);

-- --------------------------------------------------------

--
-- Structure de la table `color`
--

CREATE TABLE `color` (
  `id` int(11) NOT NULL COMMENT 'id pk',
  `color` varchar(100) NOT NULL COMMENT 'card primary color'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `color`
--

INSERT INTO `color` (`id`, `color`) VALUES
(1, 'red'),
(2, 'Yellow');

-- --------------------------------------------------------

--
-- Structure de la table `deck`
--

CREATE TABLE `deck` (
  `id` int(11) NOT NULL COMMENT 'id pk',
  `id_user` int(11) NOT NULL COMMENT 'user fk',
  `id_card_deck` int(11) NOT NULL,
  `name` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

CREATE TABLE `message` (
  `id` int(11) NOT NULL COMMENT 'id pk',
  `user_id` int(11) DEFAULT NULL COMMENT 'user fk',
  `card_id` int(11) NOT NULL COMMENT 'card fk',
  `mess` text NOT NULL,
  `status` tinyint(1) NOT NULL COMMENT 'assigne/not assigned'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `style`
--

CREATE TABLE `style` (
  `id` int(11) NOT NULL COMMENT 'id pk',
  `style` varchar(100) NOT NULL COMMENT 'card primary style'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `style`
--

INSERT INTO `style` (`id`, `style`) VALUES
(1, 'High-fantasy'),
(2, 'Monster');

-- --------------------------------------------------------

--
-- Structure de la table `tag`
--

CREATE TABLE `tag` (
  `id` int(11) NOT NULL COMMENT 'id pk',
  `tag` varchar(100) NOT NULL COMMENT 'card tag'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `tag`
--

INSERT INTO `tag` (`id`, `tag`) VALUES
(1, 'Crossbow'),
(2, 'cute');

-- --------------------------------------------------------

--
-- Structure de la table `universe`
--

CREATE TABLE `universe` (
  `id` int(11) NOT NULL COMMENT 'is pk',
  `universe` varchar(100) NOT NULL COMMENT 'card primary universe'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `universe`
--

INSERT INTO `universe` (`id`, `universe`) VALUES
(1, 'Runeterra'),
(2, 'Pokemon');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL COMMENT 'pk id',
  `name` varchar(100) NOT NULL COMMENT 'user name',
  `email` varchar(300) NOT NULL COMMENT 'user email',
  `pass` varchar(100) NOT NULL COMMENT 'pass cryptic',
  `is_admin` tinyint(1) NOT NULL DEFAULT 0,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `pass`, `is_admin`, `date`) VALUES
(1, 'sami', 'samikhan199758@gmail.com', '$2y$10$WHS2JhuU1zwiy6Y3JwIaK.L61olsIP8GVoEnL1iLxY6E296hKkyxC', 1, '2026-06-06');

-- --------------------------------------------------------

--
-- Structure de la table `variant`
--

CREATE TABLE `variant` (
  `id` int(11) NOT NULL COMMENT 'id pk',
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
  ADD KEY `variant_id` (`variant_id`);

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
  ADD PRIMARY KEY (`id_card`,`id_tag`),
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id pk', AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `color`
--
ALTER TABLE `color`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id pk', AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `deck`
--
ALTER TABLE `deck`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id pk';

--
-- AUTO_INCREMENT pour la table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id pk';

--
-- AUTO_INCREMENT pour la table `style`
--
ALTER TABLE `style`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id pk', AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `tag`
--
ALTER TABLE `tag`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id pk', AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `universe`
--
ALTER TABLE `universe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'is pk', AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'pk id', AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `variant`
--
ALTER TABLE `variant`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id pk', AUTO_INCREMENT=2;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `card`
--
ALTER TABLE `card`
  ADD CONSTRAINT `card_ibfk_1` FOREIGN KEY (`primary_color_id`) REFERENCES `color` (`id`),
  ADD CONSTRAINT `card_ibfk_2` FOREIGN KEY (`style_id`) REFERENCES `style` (`id`),
  ADD CONSTRAINT `card_ibfk_4` FOREIGN KEY (`universe_id`) REFERENCES `universe` (`id`),
  ADD CONSTRAINT `card_ibfk_5` FOREIGN KEY (`variant_id`) REFERENCES `variant` (`id`);

--
-- Contraintes pour la table `card_deck`
--
ALTER TABLE `card_deck`
  ADD CONSTRAINT `card_deck_ibfk_1` FOREIGN KEY (`id_card`) REFERENCES `card` (`id`),
  ADD CONSTRAINT `card_deck_ibfk_2` FOREIGN KEY (`id_deck`) REFERENCES `deck` (`id`);

--
-- Contraintes pour la table `card_tag`
--
ALTER TABLE `card_tag`
  ADD CONSTRAINT `card_tag_ibfk_1` FOREIGN KEY (`id_card`) REFERENCES `card` (`id`),
  ADD CONSTRAINT `card_tag_ibfk_2` FOREIGN KEY (`id_tag`) REFERENCES `tag` (`id`);

--
-- Contraintes pour la table `deck`
--
ALTER TABLE `deck`
  ADD CONSTRAINT `deck_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `message_ibfk_1` FOREIGN KEY (`card_id`) REFERENCES `card` (`id`),
  ADD CONSTRAINT `message_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
