-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 24 mars 2022 à 21:56
-- Version du serveur : 10.4.22-MariaDB
-- Version de PHP : 8.0.13

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
  `pseudo_user` varchar(45) NOT NULL,
  `mail_user` varchar(45) DEFAULT NULL,
  `psw_user` varchar(255) DEFAULT NULL,
  `admin_user` int(11) DEFAULT NULL,
  `deleted_user` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`pseudo_user`, `mail_user`, `psw_user`, `admin_user`, `deleted_user`) VALUES
('compteTest0', 'daniel@tsoba.com', '$2y$10$U5BU48h2voZ7PdNQdqctsudEK0JXIzlMBD8/xAy1rg1ObQq.0FTqe', NULL, NULL),
('DanielStrens', 'daniel.strens.pro@gmail.com', '$2y$10$M3xpzBxtpyryov5CVL11feKIzItyLuUHKd4CyqpWIpWhWgzi9YBZW', 1, NULL),
('JMichel', 'zizi4000@zizi.cum', '$2y$10$EAsr1NSxcOi7M402WI6O8./EbFfwxPDA4PEnREtADj3fRv5baMtYm', NULL, NULL),
('Quatre', 'email@at.email', '$2y$10$iTXaktTLyWY8C6pQBD07nuZemVb/ncjx/LMcX/FelPWWfH753bvdG', NULL, NULL);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`pseudo_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
