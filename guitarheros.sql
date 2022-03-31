-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 31 mars 2022 à 17:33
-- Version du serveur : 10.4.22-MariaDB
-- Version de PHP : 8.1.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `guitarheros`
--

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `pseudo_user` varchar(45) NOT NULL,
  `mail_user` varchar(45) DEFAULT NULL,
  `psw_user` varchar(255) DEFAULT NULL,
  `admin_user` int(11) DEFAULT NULL,
  `deleted_user` int(11) DEFAULT NULL,
  `lastPseudoChange` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id_user`, `pseudo_user`, `mail_user`, `psw_user`, `admin_user`, `deleted_user`, `lastPseudoChange`) VALUES
(1, 'compteTest0', 'daniel@tsoba.com', '$2y$10$U5BU48h2voZ7PdNQdqctsudEK0JXIzlMBD8/xAy1rg1ObQq.0FTqe', NULL, NULL, NULL),
(2, 'DanielStrens', 'daniel.strens.pro@gmail.com', '$2y$10$F9O.qUBRj.XJugGqPSII.u.DW1J4ZYeyc/reNf331CKyv08da6lKK', 1, NULL, NULL),
(14, 'compte_test', 'admin123@fhd.fdjk', '$2y$10$B9phKaHB1FCVNyRSjt3u0uBs/NI.o9DHH161doX2Rs/DzAqZ3NEZa', NULL, NULL, '2022-03-29');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `pseudo_user` (`pseudo_user`),
  ADD UNIQUE KEY `pseudo_user_2` (`pseudo_user`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;