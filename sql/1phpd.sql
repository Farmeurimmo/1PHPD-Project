-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Hôte : mariadb
-- Généré le : mar. 15 avr. 2025 à 16:08
-- Version du serveur : 11.7.2-MariaDB-ubu2404
-- Version de PHP : 8.2.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `1phpd-project`
--

-- --------------------------------------------------------

--
-- Structure de la table `actors`
--

CREATE TABLE `actors` (
  `id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Déchargement des données de la table `actors`
--

INSERT INTO `actors` (`id`, `first_name`, `last_name`) VALUES
(26, 'Aaron', 'Eckhart'),
(16, 'Al', 'Pacino'),
(68, 'Andrew Kevin', 'Walker'),
(70, 'Anthony', 'Hopkins'),
(81, 'Arnold', 'Schwarzenegger'),
(88, 'Billy', 'Dee Williams'),
(13, 'Bob', 'Gunton'),
(53, 'Brad', 'Pitt'),
(107, 'Brian Tyree', 'Henry'),
(52, 'Bruce', 'Willis'),
(87, 'Carrie', 'Fisher'),
(79, 'Carrie-Anne', 'Moss'),
(114, 'Chris', 'Evans'),
(116, 'Chris', 'Hemsworth'),
(24, 'Christian', 'Bale'),
(103, 'Connie', 'Nielsen'),
(112, 'Danny', 'Aiello'),
(23, 'Diane', 'Keaton'),
(83, 'Edward', 'Furlong'),
(54, 'Edward', 'Norton'),
(75, 'Elliot', 'Page'),
(110, 'Gary', 'Oldman'),
(106, 'Hailee', 'Steinfeld'),
(86, 'Harrison', 'Ford'),
(25, 'Heath', 'Ledger'),
(41, 'Henry', 'Fonda'),
(80, 'Hugo', 'Weaving'),
(17, 'James', 'Caan'),
(96, 'Javier', 'Bardem'),
(109, 'Jean', 'Reno'),
(102, 'Joaquin', 'Phoenix'),
(69, 'Jodie', 'Foster'),
(59, 'Joe', 'Pesci'),
(21, 'John', ' Marley'),
(44, 'John', 'Fiedler'),
(49, 'John', 'Travolta'),
(74, 'Joseph', 'Gordon-Levitt'),
(77, 'Keanu', 'Reeves'),
(91, 'Keiko', 'Tsushima'),
(67, 'Kevin', 'Spacey'),
(78, 'Laurence', 'Fishburne'),
(42, 'Lee J.', 'Cobb'),
(73, 'Leonardo', 'DiCaprio'),
(62, 'Lijo Mol', 'Jose'),
(82, 'Linda', 'Hamilton'),
(60, 'Lorraine', 'Bracco'),
(108, 'Luna Lauren', 'Velez'),
(64, 'Manikandan', 'K.'),
(85, 'Mark', 'Hamill'),
(115, 'Mark', 'Ruffalo'),
(15, 'Marlon', 'Brando'),
(43, 'Martin', 'Balsam'),
(55, 'Meat', 'Loaf'),
(27, 'Michael', 'Caine'),
(12, 'Morgan', 'Freeman'),
(111, 'Natalie', 'Portman'),
(104, 'Oliver', 'Reed'),
(63, 'Rajisha', 'Vijayan'),
(58, 'Ray', 'Liotta'),
(95, 'Rebecca', 'Ferguson'),
(22, 'Richard', 'Conte'),
(18, 'Richard', 'S. Castellano'),
(46, 'Robert', 'De Niro'),
(113, 'Robert', 'Downey Jr.'),
(19, 'Robert', 'Duvall'),
(84, 'Robert', 'Patrick'),
(101, 'Russell', 'Crowe'),
(51, 'Samuel L.', 'Jackson'),
(71, 'Scott', 'Glenn'),
(105, 'Shameik', 'Moore'),
(20, 'Sterling', 'Hayden'),
(61, 'Suriya', ' '),
(90, 'Takashi', 'Shimura'),
(72, 'Ted', 'Levine'),
(11, 'Tim', 'Robbins'),
(93, 'Timothée', 'Chalamet'),
(76, 'Tom', 'Hardy'),
(89, 'Toshirô', 'Mifune'),
(50, 'Uma', 'Thurman'),
(14, 'William', 'Sadler'),
(92, 'Yukiko', 'Shimazaki'),
(56, 'Zack', 'Grenier'),
(94, 'Zendaya', '');

-- --------------------------------------------------------

--
-- Structure de la table `actor_films`
--

CREATE TABLE `actor_films` (
  `id` int(11) NOT NULL,
  `actor_id` int(11) NOT NULL,
  `vod_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Déchargement des données de la table `actor_films`
--

INSERT INTO `actor_films` (`id`, `actor_id`, `vod_id`) VALUES
(58, 11, 21),
(59, 12, 21),
(44, 12, 32),
(60, 13, 21),
(61, 14, 21),
(52, 15, 22),
(53, 16, 22),
(56, 17, 22),
(57, 18, 22),
(16, 24, 25),
(17, 25, 25),
(18, 26, 25),
(19, 27, 25),
(20, 41, 26),
(21, 42, 26),
(22, 43, 26),
(23, 44, 26),
(36, 46, 30),
(28, 49, 28),
(29, 50, 28),
(30, 51, 28),
(31, 52, 28),
(45, 53, 32),
(37, 58, 30),
(38, 59, 30),
(39, 60, 30),
(40, 61, 31),
(41, 62, 31),
(42, 63, 31),
(43, 64, 31),
(46, 67, 32),
(47, 68, 32),
(48, 69, 33),
(49, 70, 33),
(50, 71, 33),
(51, 72, 33),
(62, 73, 34),
(63, 74, 34),
(64, 75, 34),
(65, 76, 34),
(70, 81, 37),
(71, 82, 37),
(72, 83, 37),
(73, 84, 36),
(66, 85, 36),
(67, 86, 36),
(68, 87, 36),
(69, 88, 36),
(74, 89, 38),
(75, 90, 38),
(76, 91, 38),
(77, 92, 38),
(78, 93, 39),
(79, 94, 39),
(80, 95, 39),
(81, 96, 39),
(82, 101, 41),
(83, 102, 41),
(84, 103, 41),
(85, 104, 41),
(86, 105, 42),
(87, 106, 42),
(88, 107, 42),
(89, 108, 42),
(90, 109, 43),
(91, 110, 43),
(92, 111, 43),
(93, 112, 43),
(94, 113, 44),
(95, 114, 44),
(96, 115, 44),
(97, 116, 44);

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(33, 'Action'),
(4, 'Drama');

-- --------------------------------------------------------

--
-- Structure de la table `directors`
--

CREATE TABLE `directors` (
  `id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Déchargement des données de la table `directors`
--

INSERT INTO `directors` (`id`, `first_name`, `last_name`) VALUES
(48, 'Akira', 'Kurosawa'),
(54, 'Anthony', 'Russo'),
(33, 'Christopher', 'Nolan'),
(40, 'David', 'Fincher'),
(49, 'Denis', 'Villeneuve'),
(32, 'Francis', 'Ford Coppola'),
(31, 'Frank', 'Darabont'),
(46, 'Irvin', 'Kershner'),
(47, 'James', 'Cameron'),
(52, 'Joaquim', 'Dos Santos'),
(44, 'Jonathan', 'Demme'),
(45, 'Lana', 'Wechowski'),
(53, 'Luc', 'Besson'),
(41, 'Martin', 'Scorsese'),
(39, 'Quentin', 'Tarantino'),
(51, 'Ridley', 'Scott'),
(37, 'Sidney', 'Lumet'),
(42, 'T.J.', 'Gnanavel');

-- --------------------------------------------------------

--
-- Structure de la table `films_purchased`
--

CREATE TABLE `films_purchased` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `vod_id` int(11) NOT NULL,
  `purchase_date` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Déchargement des données de la table `films_purchased`
--

INSERT INTO `films_purchased` (`id`, `user_id`, `vod_id`, `purchase_date`) VALUES
(21, 11, 21, '2025-04-08 11:01:10'),
(22, 11, 22, '2025-04-08 11:02:06'),
(35, 13, 21, '2025-04-13 12:37:58'),
(36, 13, 22, '2025-04-13 12:37:58'),
(37, 11, 30, '2025-04-14 16:25:04'),
(38, 11, 31, '2025-04-14 16:25:04'),
(39, 11, 29, '2025-04-15 15:29:18'),
(40, 11, 28, '2025-04-15 15:29:18'),
(41, 11, 26, '2025-04-15 15:29:18'),
(42, 11, 27, '2025-04-15 15:29:18'),
(43, 11, 25, '2025-04-15 15:30:35'),
(44, 11, 32, '2025-04-15 15:31:11'),
(45, 13, 44, '2025-04-15 15:31:33'),
(46, 11, 38, '2025-04-15 15:36:59'),
(47, 11, 35, '2025-04-15 15:40:51');

-- --------------------------------------------------------

--
-- Structure de la table `sessions`
--

CREATE TABLE `sessions` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `token` varchar(255) NOT NULL,
  `expiration_date` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Déchargement des données de la table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `token`, `expiration_date`) VALUES
(53, 11, '$2y$10$zcq8OkH8qFCoc2cBHuHDN.bLXKY1hPhA82VgyGhSllR1n/KrFR4xC', '2025-04-15 16:28:42'),
(54, 13, '$2y$10$qJ5I2FuODXM7YeQV1s540.j3DBA.905nD.jPwpTKvr383KNjre/YS', '2025-04-15 18:31:21');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password_hashed` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `username`, `password_hashed`, `email`, `created_at`, `updated_at`) VALUES
(11, 'aaaaaaaa', '$2y$10$PdwkwAqXnBvJckmvd1OQuew0AGMYlIkhf91MnySSWd1AEaxMYI1lu', 'aaaaa@gmail.com', '2025-04-03 10:36:02', '2025-04-15 13:34:59'),
(13, 'admin', '$2y$10$75dH0f9E8QRpabwjWzCfDeJWjJxtpv235Qq0dPbqLFbtyfuDTIfBC', 'admin@email.com', '2025-04-08 11:26:37', '2025-04-15 13:59:41');

-- --------------------------------------------------------

--
-- Structure de la table `vods`
--

CREATE TABLE `vods` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `image` varchar(512) NOT NULL,
  `plot` text NOT NULL,
  `director_id` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `release_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Déchargement des données de la table `vods`
--

INSERT INTO `vods` (`id`, `title`, `image`, `plot`, `director_id`, `price`, `release_date`) VALUES
(21, 'The Shawshank Redemption', 'https://m.media-amazon.com/images/M/MV5BMDAyY2FhYjctNDc5OS00MDNlLThiMGUtY2UxYWVkNGY2ZjljXkEyXkFqcGc@._V1_.jpg', 'A banker convicted of uxoricide forms a friendship over a quarter century with a hardened convict, while maintaining his innocence and trying to remain hopeful through simple compassion.', 31, 11.99, '1994-09-23'),
(22, 'The Godfather', 'https://m.media-amazon.com/images/M/MV5BNGEwYjgwOGQtYjg5ZS00Njc1LTk2ZGEtM2QwZWQ2NjdhZTE5XkEyXkFqcGc@._V1_.jpg', 'The aging patriarch of an organized crime dynasty transfers control of his clandestine empire to his reluctant son.', 32, 12.99, '1972-03-24'),
(25, 'The Dark Knight', 'https://m.media-amazon.com/images/M/MV5BMTMxNTMwODM0NF5BMl5BanBnXkFtZTcwODAyMTk2Mw@@._V1_FMjpg_UY2048_.jpg', 'When a menace known as the Joker wreaks havoc and chaos on the people of Gotham, Batman, James Gordon and Harvey Dent must work together to put an end to the madness.', 33, 11.99, '2008-08-13'),
(26, '12 Angry Men', 'https://m.media-amazon.com/images/M/MV5BYjE4NzdmOTYtYjc5Yi00YzBiLWEzNDEtNTgxZGQ2MWVkN2NiXkEyXkFqcGc@._V1_FMjpg_UX974_.jpg', 'The jury in a New York City murder trial is frustrated by a single member whose skeptical caution forces them to more carefully consider the evidence before jumping to a hasty verdict.', 37, 9.99, '1957-10-04'),
(27, 'The Godfather Part II', 'https://m.media-amazon.com/images/M/MV5BMDIxMzBlZDktZjMxNy00ZGI4LTgxNDEtYWRlNzRjMjJmOGQ1XkEyXkFqcGc@._V1_FMjpg_UX854_.jpg', 'The early life and career of Vito Corleone in 1920s New York City is portrayed, while his son, Michael, expands and tightens his grip on the family crime syndicate.', 32, 14.99, '1957-08-27'),
(28, 'Pulp Fiction', 'https://m.media-amazon.com/images/M/MV5BYTViYTE3ZGQtNDBlMC00ZTAyLTkyODMtZGRiZDg0MjA2YThkXkEyXkFqcGc@._V1_FMjpg_UX1055_.jpg', 'The lives of two mob hitmen, a boxer, a gangster and his wife, and a pair of diner bandits intertwine in four tales of violence and redemption.', 39, 12.99, '1994-10-14'),
(29, 'Fight Club', 'https://m.media-amazon.com/images/M/MV5BOTgyOGQ1NDItNGU3Ny00MjU3LTg2YWEtNmEyYjBiMjI1Y2M5XkEyXkFqcGc@._V1_FMjpg_UX1066_.jpg', 'An insomniac office worker and a devil-may-care soap maker form an underground fight club that evolves into much more.', 40, 11.99, '1999-11-10'),
(30, 'Goodfellas', 'https://m.media-amazon.com/images/M/MV5BN2E5NzI2ZGMtY2VjNi00YTRjLWI1MDUtZGY5OWU1MWJjZjRjXkEyXkFqcGc@._V1_FMjpg_UY2972_.jpg', 'The story of Henry Hill and his life in the mafia, covering his relationship with his wife Karen and his mob partners Jimmy Conway and Tommy DeVito.', 41, 9.99, '1990-09-12'),
(31, 'Jai Bhim', 'https://m.media-amazon.com/images/M/MV5BZjEyNDIzNmEtMjdkYS00ZDAwLTljOWYtNDRhYTVhYTlmOTk1XkEyXkFqcGc@._V1_FMjpg_UX1200_.jpg', 'When a tribal man is arrested for a case of alleged theft, his wife turns to a human-rights lawyer to help bring justice.', 42, 12.99, '2021-11-02'),
(32, 'Se7en', 'https://m.media-amazon.com/images/M/MV5BY2IzNzMxZjctZjUxZi00YzAxLTk3ZjMtODFjODdhMDU5NDM1XkEyXkFqcGc@._V1_FMjpg_UY2815_.jpg', 'Two detectives, a rookie and a veteran, hunt a serial killer who uses the seven deadly sins as his motives.', 40, 11.99, '1996-01-31'),
(33, 'The Silence of the Lambs', 'https://m.media-amazon.com/images/M/MV5BNDdhOGJhYzctYzYwZC00YmI2LWI0MjctYjg4ODdlMDExYjBlXkEyXkFqcGc@._V1_FMjpg_UY2968_.jpg', 'A young F.B.I. cadet must receive the help of an incarcerated and manipulative cannibal killer to help catch another serial killer, a madman who skins his victims.', 44, 8.99, '1991-04-10'),
(34, 'Inception', 'https://m.media-amazon.com/images/M/MV5BMjAxMzY3NjcxNF5BMl5BanBnXkFtZTcwNTI5OTM0Mw@@._V1_.jpg', 'A thief who steals corporate secrets through the use of dream-sharing technology is given the inverse task of planting an idea into the mind of a C.E.O., but his tragic past may doom the project and his team to disaster.', 33, 21.99, '2010-04-01'),
(35, 'The Matrix', 'https://m.media-amazon.com/images/M/MV5BN2NmN2VhMTQtMDNiOS00NDlhLTliMjgtODE2ZTY0ODQyNDRhXkEyXkFqcGc@._V1_.jpg', 'When a beautiful stranger leads computer hacker Neo to a forbidding underworld, he discovers the shocking truth--the life he knows is the elaborate deception of an evil cyber-intelligence.', 45, 15.99, '1999-04-15'),
(36, 'Star Wars: Episode V - The Empire Strikes Back', 'https://m.media-amazon.com/images/M/MV5BMTkxNGFlNDktZmJkNC00MDdhLTg0MTEtZjZiYWI3MGE5NWIwXkEyXkFqcGc@._V1_.jpg', 'After the Empire overpowers the Rebel Alliance, Luke Skywalker begins training with Jedi Master Yoda, while Darth Vader and bounty hunter Boba Fett pursue his friends across the galaxy.', 46, 6.99, '1980-05-15'),
(37, 'Terminator 2: Judgment Day', 'https://m.media-amazon.com/images/M/MV5BNGMyMGNkMDUtMjc2Ni00NWFlLTgyODEtZTY2MzBiZTg0OWZiXkEyXkFqcGc@._V1_.jpg', 'A cyborg, identical to the one who failed to kill Sarah Connor, must now protect her ten year old son John from an even more advanced and powerful cyborg.', 47, 12.99, '1991-04-15'),
(38, 'Seven Samurai', 'https://m.media-amazon.com/images/M/MV5BZjliMWExOTMtZDQ3ZS00NWU3LWIyN2EtMjllNzk3ZTNlYzg4XkEyXkFqcGc@._V1_.jpg', 'Farmers from a village exploited by bandits hire a veteran samurai for protection, and he gathers six other samurai to join him.', 48, 12.99, '1954-04-15'),
(39, 'Dune: Part Two', 'https://m.media-amazon.com/images/M/MV5BNTc0YmQxMjEtODI5MC00NjFiLTlkMWUtOGQ5NjFmYWUyZGJhXkEyXkFqcGc@._V1_.jpg', 'Paul Atreides unites with the Fremen while on a warpath of revenge against the conspirators who destroyed his family. Facing a choice between the love of his life and the fate of the universe, he endeavors to prevent a terrible future.', 49, 25.99, '2024-04-15'),
(41, 'Gladiator', 'https://m.media-amazon.com/images/M/MV5BYWQ4YmNjYjEtOWE1Zi00Y2U4LWI4NTAtMTU0MjkxNWQ1ZmJiXkEyXkFqcGc@._V1_FMjpg_UY2599_.jpg', 'A former Roman General sets out to exact vengeance against the corrupt emperor who murdered his family and sent him into slavery.', 51, 15.99, '2000-06-25'),
(42, 'Spider-Man: Across the Spider-Verse', 'https://m.media-amazon.com/images/M/MV5BNThiZjA3MjItZGY5Ni00ZmJhLWEwN2EtOTBlYTA4Y2E0M2ZmXkEyXkFqcGc@._V1_FMjpg_UY1929_.jpg', 'Traveling across the multiverse, Miles Morales meets a new team of Spider-People, made up of heroes from different dimensions. But when the heroes clash over how to deal with a new threat, Miles finds himself at a crossroads.', 52, 19.99, '2023-10-10'),
(43, 'Léon: The Professional', 'https://m.media-amazon.com/images/M/MV5BNGRkYTNhOWQtYmI0Ni00MjZhLWJmMzAtMTA2Mjg4NGNiNDU0XkEyXkFqcGc@._V1_FMjpg_UY2898_.jpg', 'An Italian hit man protects a New York orphan.', 53, 9.99, '1994-11-30'),
(44, 'Avengers: Endgame', 'https://m.media-amazon.com/images/M/MV5BMTc5MDE2ODcwNV5BMl5BanBnXkFtZTgwMzI2NzQ2NzM@._V1_FMjpg_UY2048_.jpg', 'After the devastating events of Avengers: Infinity War (2018), the universe is in ruins. With the help of remaining allies, the Avengers assemble once more in order to reverse Thanos\' actions and restore balance to the universe.', 54, 21.99, '2019-06-13');

-- --------------------------------------------------------

--
-- Structure de la table `vod_categories`
--

CREATE TABLE `vod_categories` (
  `id` int(11) NOT NULL,
  `vod_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Déchargement des données de la table `vod_categories`
--

INSERT INTO `vod_categories` (`id`, `vod_id`, `category_id`) VALUES
(31, 21, 4),
(32, 22, 4),
(40, 25, 4),
(42, 26, 4),
(47, 27, 4),
(46, 28, 4),
(51, 29, 4),
(54, 30, 4),
(56, 31, 4),
(58, 32, 4),
(60, 33, 4),
(61, 34, 33),
(63, 35, 33),
(62, 36, 33),
(64, 37, 33),
(66, 38, 33),
(65, 39, 33),
(67, 41, 33),
(69, 42, 33),
(71, 43, 33),
(73, 44, 33);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `actors`
--
ALTER TABLE `actors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `first_name` (`first_name`,`last_name`);

--
-- Index pour la table `actor_films`
--
ALTER TABLE `actor_films`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `actor_id` (`actor_id`,`vod_id`),
  ADD KEY `vod_id` (`vod_id`);

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Index pour la table `directors`
--
ALTER TABLE `directors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `first_name` (`first_name`,`last_name`);

--
-- Index pour la table `films_purchased`
--
ALTER TABLE `films_purchased`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`,`vod_id`),
  ADD KEY `vod_id` (`vod_id`);

--
-- Index pour la table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `token` (`token`),
  ADD KEY `user_id` (`user_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Index pour la table `vods`
--
ALTER TABLE `vods`
  ADD PRIMARY KEY (`id`),
  ADD KEY `director_id` (`director_id`);

--
-- Index pour la table `vod_categories`
--
ALTER TABLE `vod_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `vod_id` (`vod_id`,`category_id`),
  ADD KEY `category_id` (`category_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `actors`
--
ALTER TABLE `actors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=117;

--
-- AUTO_INCREMENT pour la table `actor_films`
--
ALTER TABLE `actor_films`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT pour la table `directors`
--
ALTER TABLE `directors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT pour la table `films_purchased`
--
ALTER TABLE `films_purchased`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT pour la table `sessions`
--
ALTER TABLE `sessions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT pour la table `vods`
--
ALTER TABLE `vods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT pour la table `vod_categories`
--
ALTER TABLE `vod_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `actor_films`
--
ALTER TABLE `actor_films`
  ADD CONSTRAINT `actor_films_ibfk_1` FOREIGN KEY (`actor_id`) REFERENCES `actors` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `actor_films_ibfk_2` FOREIGN KEY (`vod_id`) REFERENCES `vods` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `films_purchased`
--
ALTER TABLE `films_purchased`
  ADD CONSTRAINT `films_purchased_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `films_purchased_ibfk_2` FOREIGN KEY (`vod_id`) REFERENCES `vods` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `sessions`
--
ALTER TABLE `sessions`
  ADD CONSTRAINT `sessions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `vods`
--
ALTER TABLE `vods`
  ADD CONSTRAINT `vods_ibfk_1` FOREIGN KEY (`director_id`) REFERENCES `directors` (`id`);

--
-- Contraintes pour la table `vod_categories`
--
ALTER TABLE `vod_categories`
  ADD CONSTRAINT `vod_categories_ibfk_1` FOREIGN KEY (`vod_id`) REFERENCES `vods` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `vod_categories_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
