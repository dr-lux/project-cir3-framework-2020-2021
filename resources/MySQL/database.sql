-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Jan 17, 2021 at 01:27 PM
-- Server version: 5.7.30
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `cir3prj`
--

-- --------------------------------------------------------

--
-- Table structure for table `default_param`
--

CREATE TABLE `default_param` (
  `id` int(11) NOT NULL,
  `avg_breath` int(11) DEFAULT NULL,
  `speed_falling` int(11) NOT NULL,
  `speed_rising_before_bearing` int(11) NOT NULL,
  `speed_rising_between_bearing` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `default_param`
--

INSERT INTO `default_param` (`id`, `avg_breath`, `speed_falling`, `speed_rising_before_bearing`, `speed_rising_between_bearing`) VALUES
(1, 20, 20, 10, 6);

-- --------------------------------------------------------

--
-- Table structure for table `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20201207213650', '2020-12-07 21:37:04', 467),
('DoctrineMigrations\\Version20210108152144', '2021-01-08 15:21:53', 252);

-- --------------------------------------------------------

--
-- Table structure for table `profondeur`
--

CREATE TABLE `profondeur` (
  `id` int(11) NOT NULL,
  `correspond_id` int(11) NOT NULL,
  `profondeur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `profondeur`
--

INSERT INTO `profondeur` (`id`, `correspond_id`, `profondeur`) VALUES
(1, 1, 9),
(2, 1, 12),
(3, 1, 15),
(4, 1, 18),
(5, 1, 21),
(6, 1, 24),
(7, 1, 27),
(9, 1, 30),
(10, 1, 33),
(11, 1, 36),
(12, 1, 39),
(13, 1, 42),
(14, 1, 45),
(15, 1, 48),
(16, 1, 51),
(22, 1, 999);

-- --------------------------------------------------------

--
-- Table structure for table `table_plongee`
--

CREATE TABLE `table_plongee` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `table_plongee`
--

INSERT INTO `table_plongee` (`id`, `nom`) VALUES
(1, 'Bulhman');

-- --------------------------------------------------------

--
-- Table structure for table `temps`
--

CREATE TABLE `temps` (
  `id` int(11) NOT NULL,
  `est_a_id` int(11) NOT NULL,
  `temps` int(11) NOT NULL,
  `palier15` int(11) DEFAULT NULL,
  `palier12` int(11) DEFAULT NULL,
  `palier9` int(11) DEFAULT NULL,
  `palier6` int(11) DEFAULT NULL,
  `palier3` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `temps`
--

INSERT INTO `temps` (`id`, `est_a_id`, `temps`, `palier15`, `palier12`, `palier9`, `palier6`, `palier3`) VALUES
(2, 1, 20, NULL, NULL, NULL, NULL, NULL),
(3, 1, 40, NULL, NULL, NULL, NULL, NULL),
(4, 1, 80, NULL, NULL, NULL, NULL, NULL),
(5, 1, 120, NULL, NULL, NULL, NULL, NULL),
(6, 2, 15, NULL, NULL, NULL, NULL, NULL),
(7, 2, 30, NULL, NULL, NULL, NULL, NULL),
(8, 2, 15, NULL, NULL, NULL, NULL, NULL),
(9, 2, 30, NULL, NULL, NULL, NULL, NULL),
(10, 2, 45, NULL, NULL, NULL, NULL, NULL),
(11, 2, 60, NULL, NULL, NULL, NULL, NULL),
(12, 2, 90, NULL, NULL, NULL, NULL, NULL),
(13, 3, 15, NULL, NULL, NULL, NULL, NULL),
(14, 3, 30, NULL, NULL, NULL, NULL, NULL),
(15, 3, 45, NULL, NULL, NULL, NULL, NULL),
(16, 3, 60, NULL, NULL, NULL, NULL, NULL),
(17, 3, 90, NULL, NULL, NULL, NULL, NULL),
(18, 4, 10, NULL, NULL, NULL, NULL, NULL),
(19, 4, 20, NULL, NULL, NULL, NULL, NULL),
(20, 4, 30, NULL, NULL, NULL, NULL, NULL),
(21, 4, 40, NULL, NULL, NULL, NULL, NULL),
(22, 4, 60, NULL, NULL, NULL, NULL, NULL),
(23, 4, 70, NULL, NULL, NULL, NULL, 4),
(24, 4, 80, NULL, NULL, NULL, NULL, 8),
(25, 4, 90, NULL, NULL, NULL, NULL, 15),
(26, 5, 10, NULL, NULL, NULL, NULL, NULL),
(27, 5, 20, NULL, NULL, NULL, NULL, NULL),
(28, 5, 30, NULL, NULL, NULL, NULL, NULL),
(29, 5, 40, NULL, NULL, NULL, NULL, 1),
(30, 5, 60, NULL, NULL, NULL, NULL, 9),
(31, 5, 70, NULL, NULL, NULL, NULL, 16),
(32, 5, 75, NULL, NULL, NULL, NULL, 20),
(33, 6, 10, NULL, NULL, NULL, NULL, NULL),
(34, 5, 20, NULL, NULL, NULL, NULL, NULL),
(35, 6, 30, NULL, NULL, NULL, NULL, 1),
(36, 6, 40, NULL, NULL, NULL, NULL, 4),
(37, 6, 50, NULL, NULL, NULL, NULL, 11),
(38, 6, 60, NULL, NULL, NULL, 1, 19),
(39, 6, 70, NULL, NULL, NULL, 4, 26),
(40, 4, 75, NULL, NULL, NULL, 6, 29),
(41, 7, 10, NULL, NULL, NULL, NULL, NULL),
(42, 7, 20, NULL, NULL, NULL, NULL, NULL),
(43, 7, 30, NULL, NULL, NULL, NULL, 3),
(44, 7, 40, NULL, NULL, NULL, 1, 9),
(45, 7, 50, NULL, NULL, NULL, 3, 17),
(46, 7, 60, NULL, NULL, NULL, 7, 26),
(47, 9, 10, NULL, NULL, NULL, NULL, NULL),
(48, 9, 20, NULL, NULL, NULL, NULL, 2),
(49, 9, 30, NULL, NULL, NULL, 1, 5),
(50, 9, 40, NULL, NULL, NULL, 4, 14),
(51, 9, 50, NULL, NULL, NULL, 8, 24),
(52, 7, 60, NULL, NULL, 2, 13, 30),
(53, 10, 10, NULL, NULL, NULL, NULL, NULL),
(54, 10, 20, NULL, NULL, NULL, NULL, 4),
(55, 10, 30, NULL, NULL, NULL, 3, 8),
(56, 10, 40, NULL, NULL, 1, 6, 19),
(57, 10, 50, NULL, NULL, 3, 12, 26),
(58, 11, 10, NULL, NULL, NULL, NULL, 1),
(59, 11, 20, NULL, NULL, NULL, 1, 4),
(60, 11, 30, NULL, NULL, 1, 4, 13),
(61, 11, 40, NULL, NULL, 3, 9, 24),
(62, 12, 10, NULL, NULL, NULL, NULL, 1),
(63, 12, 20, NULL, NULL, NULL, 3, 5),
(64, 12, 30, NULL, NULL, 3, 5, 16),
(65, 12, 40, NULL, 2, 5, 12, 28),
(66, 13, 10, NULL, NULL, NULL, NULL, 1),
(67, 13, 20, NULL, NULL, 1, 4, 6),
(68, 13, 30, NULL, 1, 4, 7, 20),
(69, 14, 12, NULL, NULL, NULL, NULL, 4),
(70, 14, 21, NULL, NULL, 3, 4, 10),
(71, 14, 30, NULL, 3, 4, 9, 25),
(72, 15, 12, NULL, NULL, NULL, 2, 4),
(73, 15, 21, NULL, 1, 4, 4, 14),
(74, 15, 27, NULL, 4, 4, 8, 24),
(75, 16, 12, NULL, NULL, NULL, 3, 4),
(76, 16, 18, NULL, 1, 3, 4, 11),
(77, 16, 21, NULL, 3, 3, 6, 16);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `default_param`
--
ALTER TABLE `default_param`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `profondeur`
--
ALTER TABLE `profondeur`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_E3804DEA98DE379A` (`correspond_id`);

--
-- Indexes for table `table_plongee`
--
ALTER TABLE `table_plongee`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `temps`
--
ALTER TABLE `temps`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_60B4B72010C32089` (`est_a_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `default_param`
--
ALTER TABLE `default_param`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `profondeur`
--
ALTER TABLE `profondeur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `table_plongee`
--
ALTER TABLE `table_plongee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `temps`
--
ALTER TABLE `temps`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `profondeur`
--
ALTER TABLE `profondeur`
  ADD CONSTRAINT `FK_E3804DEA98DE379A` FOREIGN KEY (`correspond_id`) REFERENCES `table_plongee` (`id`);

--
-- Constraints for table `temps`
--
ALTER TABLE `temps`
  ADD CONSTRAINT `FK_60B4B72010C32089` FOREIGN KEY (`est_a_id`) REFERENCES `profondeur` (`id`);

