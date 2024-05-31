-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 30 mai 2024 à 04:44
-- Version du serveur : 10.4.27-MariaDB
-- Version de PHP : 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `appweb`
--

-- --------------------------------------------------------

--
-- Structure de la table `ancien_etudiant`
--

CREATE TABLE `ancien_etudiant` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `contrat_id` int(11) DEFAULT NULL,
  `statut_id` int(11) DEFAULT NULL,
  `nom` varchar(25) NOT NULL,
  `prenom` varchar(25) NOT NULL,
  `tel` varchar(50) NOT NULL,
  `annee_sortie` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `poste_occuper` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `ancien_etudiant`
--

INSERT INTO `ancien_etudiant` (`id`, `user_id`, `contrat_id`, `statut_id`, `nom`, `prenom`, `tel`, `annee_sortie`, `poste_occuper`) VALUES
(1, 1, 1, 1, 'Nom0', 'Prenom0', '0601020304', '2024-05-06 02:16:00', 'Poste0'),
(2, 1, 2, 8, 'Nom1', 'Prenom1', '0601020304', '2024-05-06 02:16:00', 'Poste1'),
(3, 1, 3, 5, 'Nom2', 'Prenom2', '0601020304', '2024-05-06 02:16:00', 'Poste2'),
(4, 1, 2, 3, 'Nom3', 'Prenom3', '0601020304', '2024-05-06 02:16:00', 'Poste3'),
(5, 1, 1, 7, 'Nom4', 'Prenom4', '0601020304', '2024-05-06 02:16:00', 'Poste4'),
(6, 1, 1, 1, 'Hanne', 'Amadou', '71210903', '2024-01-01 00:00:00', 'Chef de projet'),
(7, 1, 1, 3, 'Seydou', 'Telly', '6542125', '2022-01-01 00:00:00', 'Chauffeur');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `ancien_etudiant`
--
ALTER TABLE `ancien_etudiant`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_3A88DAD8A76ED395` (`user_id`),
  ADD KEY `IDX_3A88DAD81823061F` (`contrat_id`),
  ADD KEY `IDX_3A88DAD8F6203804` (`statut_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `ancien_etudiant`
--
ALTER TABLE `ancien_etudiant`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `ancien_etudiant`
--
ALTER TABLE `ancien_etudiant`
  ADD CONSTRAINT `FK_3A88DAD81823061F` FOREIGN KEY (`contrat_id`) REFERENCES `contrat` (`id`),
  ADD CONSTRAINT `FK_3A88DAD8A76ED395` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `FK_3A88DAD8F6203804` FOREIGN KEY (`statut_id`) REFERENCES `statut_travail` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
